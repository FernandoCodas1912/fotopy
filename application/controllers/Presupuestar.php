<?php
class Presupuestar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("Categorias_model"); // esto abre el modelo
        $this->load->model("Marcas_model"); // esto abre el modelo
        $this->load->model("Clientes_model"); // esto abre el modelo
        $this->load->model("Comprobantes_model"); // esto abre el modelo
        $this->load->model("Ventas_model"); // esto abre el modelo
        $this->load->model("Empresa_model"); // esto abre el modelo
        $this->load->model("Productos_model"); // esto abre el modelo

        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }


    public function index()
    {
        if (!$this->session->has_userdata("carrito_presupuesto"))
            $this->session->set_userdata("carrito_presupuesto", array());
        $array = array(
            'titulopage'     => "Nuevo Presupuesto",
            'expandirPresupuestos' => "is-expanded",
            'active_presupuestos'   => "active",
        );

        $this->load->model("Cajas_model");
        $where = "1=1";
        $tabla = "ape_cie_caja";
        //averiguar si ya se abrio la caja hoy. traemos todos ape cie caja de ese usuario y de ese dia
        $id_usuario_activo = $this->session->userdata('IdUsuario');
        $usuario_caja = $this->session->userdata('id_caja');
        $hoy = date('Y-m-d');
        $where .= " AND $tabla.id_cajero =$id_usuario_activo";
        $where .= " AND $tabla.id_caja =$usuario_caja";
        $where .= " AND $tabla.estado_caja =1";
        $where .= " AND $tabla.f_apertura  ='$hoy'";

        $datoshoy = array(
            'SumComprasHoy' => $this->Estadisticas_model->TotalHoy("compra"),
            'SumVentasHoy'  => $this->Estadisticas_model->TotalHoy("venta"),
            'cajas'      => $this->Cajas_model->todos($tabla, $where), //buscamos todas las ape cie caja del usuario en sesion si corresponden a hoy y estan estado 1

        );
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        $data = array(
            'carrito_presupuesto' => $carrito_presupuesto,

            'comprobantes' => $this->Comprobantes_model->getAll(), //se usa en nueva venta
            'empresa'      => $this->Empresa_model->getEmpresa(), //se usa en ticket y boleta
            'categorias'   => $this->Categorias_model->getAll(), // se usa en nuevo producto
            'marcas'       => $this->Marcas_model->getAll(), //se usa en nuevo producto
            'clientes'    => $this->Clientes_model->getAll(), //se usa en nueva venta


        );
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head', $datoshoy);
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('presupuestos/add', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('presupuestos/script_nuevo_presupuesto');
    }


    /*--------------------------------------------
    ------CARGAMOS EL MODAL PRODUCTOS VIA AJAX-----
    ----------------------------------------------*/
    public function ajax_list_productos()
    {
        $list = $this->Productos_model->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $product) {
            $no++;
            $row   = array();
            $row[] = $product->IdProducto;
            $row[] = $product->Codigo;
            //    $row[] = $product->Descripcion;
            $row[] = $product->Nombre;
            $stock_minimo = $product->StockMinimo;
            $stock = $product->Stock;
            if ($stock <= $stock_minimo) {
                $label_class_stock = 'label-danger';
            } else {
                $label_class_stock = 'label-success';
            }
            $row[] = '<span class="badge ' . $label_class_stock . '">' . $stock . '</span>';

            $row[] = number_format(($product->PrecioCompra), 0, ",", ".");
            $row[] = '<input type="hidden" class="form-control" style="text-align:right" id="stock_' . $product->IdProducto . '" value="' . $product->Stock . '">
            <input type="hidden" class="form-control" style="text-align:right" id="codigo_' . $product->IdProducto . '" value="' . $product->Codigo . '">
            <input type="hidden" class="form-control" style="text-align:right" id="nombre_' . $product->IdProducto . '" value="' . $product->Nombre . '">
            <div class="pull-right">
                <input type="number" min="1" class="form-control" style="text-align:right" id="cantidad_' . $product->IdProducto . '" value="1"></div>';

            $row[] = '<div class="pull-right">
            <input type="text" class="form-control" min="1" style="text-align:right" id="precio_venta_' . $product->IdProducto . '"  value="' . $product->PrecioVenta . '"></div>';
            //$dataproducto = $product->IdProducto . "*" . $product->Nombre . "*" . $product->PrecioCompra . "*" . $product->PrecioVenta . "*" . $product->Codigo;
            $empresa = $this->Empresa_model->getEmpresa();
            $conf    = $empresa->StockNegativo;
            if (($product->Stock <= 0) and ($conf == 0)) {
                $row[] = '<button type="button" class="btn btn-danger btn-danger" data-toggle="tooltip" data-placement="left" title="NO PUEDE VENDER, PRODUCTO SIN EXISTENCIA!" value=""><i class="fa fa-minus"></i>';
            } else {

                $row[] = '<a class="btn btn-success" data-toggle="tooltip" data-placement="left" title="CLICK PARA SELECCIONAR EL PRODUCTO" data-original-title="ELEGIR "  href="#" title="AGREGAR A LA OPERACION" onclick="agregar(' . $product->IdProducto . ')"><i class="fa fa-plus"></i></a>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Productos_model->count_all(),
            "recordsFiltered" => $this->Productos_model->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function quitarDelCarrito($indice)
    {
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        array_splice($carrito_presupuesto, $indice, 1);
        $this->session->set_userdata("carrito_presupuesto", $carrito_presupuesto);
        redirect("Presupuestar/");
    }

    public function cancelarVenta()
    {
        $this->vaciarCarrito();
        $this->session->set_flashdata(array(
            "mensaje" => "Operacion cancelada correctamente",
            "clase" => "success",
        ));
        redirect("Presupuestar/");
    }

    private function vaciarCarrito()
    {
        $this->session->set_userdata("carrito_presupuesto", array());
    }

    public function terminarVenta()
    {
        # Primero ver si hay algo en el carrito, si no, indicarlo
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        if (count($carrito_presupuesto) < 1) {
            $this->session->set_flashdata(array(
                "mensaje" => "Error realizando la operacion, Item Vacio",
                "clase" => "danger",
            ));
            redirect('Presupuestar/');
        } else {
            $cabecera = array(
                "TipoComprobante" => $this->input->post("IdTipoComprobante"),
                "NroComprobante" => $this->input->post("NroComprobante"),
                "SerieComprobante" => $this->input->post("SerieComprobante"),
                "Total" => $this->input->post("total"),
                "IdCliente" => $this->input->post("IdCliente"),
                "IdFormaPago" => $this->input->post("IdFormaPago"),
                "Fecha" => date('Y-m-d'),
                "date_add" => date('Y-m-d H:i:s'),
                "Vencimiento" => $this->input->post("Vencimiento"),
                "IdUsuario" => $this->session->userdata('IdUsuario'),
                "CondicionVenta" => 1,
                "IdFormaPago" => 1,
                'TipoVenta'        => 1, //1 presup, 2 pedido, 3 venta, 4 devolucion
                "EstadoVenta" => 1,

            );

            $this->load->model("Vender_model");

            $resultado_cabecera = $this->Vender_model->guardar_cabecera($cabecera);
            $id_venta = $this->db->insert_id();
            # Recorrer el carrito
            foreach ($carrito_presupuesto as $detalle) {
                //  print_r($detalle);
                $detalleventa = array(
                    "IdVenta" => $id_venta,
                    "IdProducto" => $detalle['IdProducto'],
                    "Cantidad" => $detalle['Cantidad'],
                    "Precio" => $detalle['PrecioVenta'],
                    "Importe" => $detalle['total'],
                    "EstadoDetVenta" => 1,
                );
                //  $resultado_productos =  $this->updateProducto($detalle['IdProducto'], $detalle['Cantidad']);
                $resultado_detalles = $this->Vender_model->guardar_detalles($detalleventa);
            }
            $NroComprobante    = $this->input->post("NroComprobante");
            $IdTipoComprobante = $this->input->post("IdTipoComprobante");
            $resultado_comprobante = $this->updateComprobante($IdTipoComprobante, $NroComprobante);
        }
        if (($resultado_cabecera) || ($resultado_detalles) || ($resultado_comprobante)) {
            $this->vaciarCarrito();
            echo json_encode(
                array(
                    "Status"     => "OK",
                    "IdVenta"     => $id_venta,
                    "textStatus" => "Operacion $id_venta realizada correctamente",
                )
            );
        } else {
            $this->session->set_flashdata(array(
                "mensaje" => "Error realizando la Operacion, intente de nuevo",
                "clase" => "danger",
            ));
            redirect("Presupuestar/");
        }
    }
    protected function updateProducto($IdProducto, $cantidad)
    {

        $this->load->model("Productos_model");
        $productoActual = $this->Productos_model->get_by_id($IdProducto);
        $data           = array(
            'Stock' => $productoActual->Stock - $cantidad,
        );
        if (!$this->Productos_model->update(array('IdProducto' => $IdProducto), $data)) {
            echo json_encode(array(
                //    "Status" => FALSE,
                "textStatus" => "NO se pudo descontar $cantidad del stock en producto $IdProducto",
            ));
        };
    }

    protected function updateComprobante($IdTipoComprobante, $NroComprobante)
    {
        $data = array(
            'UltimoNroComprobante' => $NroComprobante,
        );
        $this->load->model("Comprobantes_model");
        if (!$this->Comprobantes_model->update(array('IdTipoComprobante' => $IdTipoComprobante), $data)) {

            echo json_encode(array(
                "textStatus" => "NO se pudo actualizar el comprobante  $IdTipoComprobante con $NroComprobante",
            ));
        }
    }
    private function agregarAlCarrito($producto)
    {
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        // $producto->cantidad = 1; //comentar 
        $producto->total = $producto->cantidad * $producto->PrecioVenta;
        array_push($carrito_presupuesto, $producto);
        $this->session->set_userdata("carrito_presupuesto", $carrito_presupuesto);
    }

    private function obtenerIndiceSiExiste($codigo)
    {
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        $conteo = count($carrito_presupuesto);
        for ($indice = 0; $indice < $conteo; $indice++) {
            if ($carrito_presupuesto[$indice]->Codigo === $codigo) return $indice;
        }
        return -1;
    }

    private function aumentarCantidad($indice)
    {
        $carrito_presupuesto = $this->session->carrito_presupuesto;
        $producto = $carrito_presupuesto[$indice];
        $producto->cantidad++;
        $producto->total = $producto->cantidad * $producto->PrecioVenta;
        $carrito_presupuesto[$indice] = $producto;
        $this->session->set_userdata("carrito_presupuesto", $carrito_presupuesto);
    }

    public function agregar()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if (isset($_POST['codigo'])) {
            $codigo = $this->input->post("codigo");
        }
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['cantidad'])) {
            $cantidad = $_POST['cantidad'];
        }
        if (isset($_POST['precio_venta'])) {
            $precio_venta = $_POST['precio_venta'];
        };
        $total = $cantidad * $precio_venta;
        $producto = array(
            'Codigo' => $codigo,
            'IdProducto' => $id,
            'Nombre' => $nombre,
            'Cantidad' => $cantidad,
            'PrecioVenta' => $precio_venta,
            'total' => $total,
        );
        # Pero puede que no exista un producto con ese c贸digo
        if (null === $producto) {
            $this->session->set_flashdata(array(
                "mensaje" => "No existe un producto registrado con el codigo de barras que se proporciono",
                "clase" => "danger",
            ));
            # O que no tenga existencia 
        } else {
            # Y caso de que s铆 exista y la existencia sea suficiente
            //aca recibir idproducto, cant y precio

            $this->agregarAlCarrito($producto);
        }

        # Al final, en cualquier caso redireccionamos, ya sea con o sin mensajes
        redirect("Presupuestos/");
    }





    public function edit($id)
    {
        $array = array(
            'titulopage'     => "Editar Presupuesto",
            'expandirPresupuestos' => "is-expanded",
            'active_presupuestos'   => "active",
        );

        $this->load->model("Cajas_model");
        $where = "1=1";
        $tabla = "ape_cie_caja";
        //averiguar si ya se abrio la caja hoy. traemos todos ape cie caja de ese usuario y de ese dia
        $id_usuario_activo = $this->session->userdata('IdUsuario');
        $usuario_caja = $this->session->userdata('id_caja');
        $hoy = date('Y-m-d');
        $where .= " AND $tabla.id_cajero =$id_usuario_activo";
        $where .= " AND $tabla.id_caja =$usuario_caja";
        $where .= " AND $tabla.estado_caja =1";
        $where .= " AND $tabla.f_apertura  ='$hoy'";

        $datoshoy = array(
            'SumComprasHoy' => $this->Estadisticas_model->TotalHoy("compra"),
            'SumVentasHoy'  => $this->Estadisticas_model->TotalHoy("venta"),
            'cajas'      => $this->Cajas_model->todos($tabla, $where), //buscamos todas las ape cie caja del usuario en sesion si corresponden a hoy y estan estado 1

        );

        $datos_venta = array(
            'editar_presupuesto' => $this->Ventas_model->getDetalleVenta($id),
            'venta'    => $this->Ventas_model->get_by_id($id),
            'comprobantes' => $this->Comprobantes_model->getAll(), //se usa en nueva venta
            //   'clientes'    => $this->Clientes_model->getAll(), //se usa en nueva venta
        );
        //print_r($datos_venta);
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head', $datoshoy);
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('presupuestos/edit', $datos_venta);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('presupuestos/script_nuevo_presupuesto');
    }
}
