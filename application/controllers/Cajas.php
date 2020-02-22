<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cajas extends CI_Controller
{
    //el constructor, siempre se carga al inicio
    public function __construct()
    {
        parent::__construct();
        // si no esta logueado redireccionar a base url
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }

        //cargamos todos los modelos que usaremos
        $this->load->model("Cajas_model"); // esto abre el modelo
    }

    //esta es la primera funcion que se carga
    public function index()
    {
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
        $array = array(
            'titulopage'     => "Cajas",
            'expandirVentas' => "is-expanded",
            'activeCajas'   => "active",
        );

        $datoshoy = array(
            'SumComprasHoy' => $this->Estadisticas_model->TotalHoy("compra"),
            'SumVentasHoy'  => $this->Estadisticas_model->TotalHoy("venta"),

        );
        $data = array(
            'ventas' => $this->Ventas_model->getAll(),
        );
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head', $datoshoy);
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('ventas/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('ventas/script_ventas');
    }


    /*--------------------------------------------
    ------CARGAMOS EL MODAL CLIENTES VIA AJAX-----
    ----------------------------------------------*/
    public function ajax_list_clientes()
    {
        $draw   = 0;
        $search = '';
        $list   = $this->Clientes_model->get_datatables();
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $cliente) {
            $no++;
            $row         = array();
            $row[]       = $cliente->IdCliente;
            $row[]       = $cliente->NroDocumento;
            $row[]       = $cliente->RazonSocial;
            $row[]       = $cliente->Direccion;
            $row[]       = $cliente->Telefono;
            $datacliente = $cliente->IdCliente . "*" . $cliente->RazonSocial;
            //add html for action
            $row[] = '<button type="button" class="btn btn-success btn-check" data-toggle="tooltip" data-placement="left" title="CLICK PARA SELECCIONAR EL CLIENTE" data-original-title="ELEGIR " value="' . $datacliente . '"><i class="fa fa-check"></i>';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Clientes_model->count_all(),
            "recordsFiltered" => $this->Clientes_model->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
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
            $row[] = $product->Stock;
            $row[] = number_format(($product->PrecioCompra), 0, ",", ".");
            $row[] = number_format(($product->PrecioVenta), 0, ",", ".");

            $dataproducto = $product->IdProducto . "*" . $product->Nombre . "*" . $product->PrecioCompra . "*" . $product->PrecioVenta . "*" . $product->Codigo;

            $empresa = $this->Empresa_model->getEmpresa();
            $conf    = $empresa->StockNegativo;

            if (($product->Stock <= 0) and ($conf == 0)) {
                $row[] = '<button type="button" class="btn btn-danger btn-danger" data-toggle="tooltip" data-placement="left" title="NO PUEDE VENDER, PRODUCTO SIN EXISTENCIA!" value=""><i class="fa fa-minus"></i>';
            } else {
                $row[] = '<button type="button" class="btn btn-success btn-agregar" data-toggle="tooltip" data-placement="left" title="CLICK PARA SELECCIONAR EL PRODUCTO" data-original-title="ELEGIR " value="' . $dataproducto . '"><i class="fa fa-check"></i>';
            }
            $data[] = $row;
            //add html for action

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

    public function imprimir($id)
    {
        $data = array(
            'venta'    => $this->Ventas_model->get_by_id($id),
            'detalles' => $this->Ventas_model->getDetalleVenta($id),
            'empresa'  => $this->Empresa_model->getEmpresa(),

        );
        $venta1          = $this->Ventas_model->get_by_id($id);
        $TipoComprobante = $venta1->TipoComprobante;

        if ($TipoComprobante == 3) {

            $this->load->view("ventas/printTicket2", $data);
        } elseif ($TipoComprobante == 2) {
            $this->load->view("ventas/printBoleta", $data);
        } else {
            $this->load->view("ventas/printFactura", $data);
        }
    }

    public function ajax_list()
    {
        $list = $this->Ventas_model->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $venta) {
            $no++;
            $row   = array();
            $row[] = $venta->IdVenta;
            $row[] = date('d-m-Y', strtotime($venta->Fecha));
            $row[] = $venta->Cliente;
            $row[] = number_format(($venta->Total), 0, ",", ".");
            $row[] = $venta->FormaPago;
            $row[] = '<b>' . $venta->Comprobante;
            $row[] = $venta->SerieComprobante . "-" . $venta->NroComprobante;

            $estado = $venta->EstadoVenta;
            if ($estado == 1) {
                $estado2    = "Activo";
                $text_class = 'text-success';
            } else {
                if ($estado == 2) {
                    $estado2    = "Inactivo";
                    $text_class = 'text-warning';
                } else {
                    $estado2    = "Anulado";
                    $text_class = 'text-danger';
                }
            }

            $row[] = '<span class="text ' . $text_class . '"><b>' . $estado2 . '</b></span>';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-secondary" href="javascript:void()" title="VER DETALLES" onclick="view_item(' . "'" . $venta->IdVenta . "'" . ')"><i class="fa fa-eye"></i> VER DETALLES </a>
			<a class="btn btn-sm btn-danger" href="javascript:void()" title="ANULAR" onclick="delete_item(' . $venta->IdVenta . ')"><i class="fa fa-trash"></i> ANULAR </a>';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Ventas_model->count_all(),
            "recordsFiltered" => $this->Ventas_model->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_by_id($id)
    {
        $data = array(
            'venta'    => $this->Ventas_model->get_by_id($id),
            'detalles' => $this->Ventas_model->getDetalleVenta($id),
            'empresa'  => $this->Empresa_model->getEmpresa(),

        );
        $venta1          = $this->Ventas_model->get_by_id($id);
        $TipoComprobante = $venta1->TipoComprobante;

        if ($TipoComprobante == 3) {

            $this->load->view("ventas/printTicket2", $data);
        } elseif ($TipoComprobante == 2) {
            $this->load->view("ventas/printBoleta", $data);
        } else {
            $this->load->view("ventas/printFactura", $data);
        }
    }

    public function ajax_add()
    {
        $id_caja = $this->session->userdata('id_caja');
        $data = array(
            'f_apertura'         => date('Y-m-d'),
            'id_cajero'        => $this->session->userdata('IdUsuario'),
            'id_caja'        => $id_caja,
            'id_sucursal'        => 1,
            'monto_apertura' => $_POST['monto_apertura'],
            'estado_caja'      => 1,

        );
        if ($this->Cajas_model->save_apertura($data)) {
            echo json_encode(
                array(
                    "Status"     => "OK",
                    "textStatus" => "La Caja $id_caja ha sido Abierta sin Errores ",
                )
            );
        } else {
            echo json_encode(
                array(
                    //"Status" => FALSE,
                    "textStatus" => "ERROR EN LA BD",
                )
            );
        }
    }

    function updateComprobante($IdTipoComprobante, $NroComprobante)
    {
        $data = array(
            'UltimoNroComprobante' => $NroComprobante,
        );

        if (!$this->Comprobantes_model->update(array('IdTipoComprobante' => $IdTipoComprobante), $data)) {

            echo json_encode(array(
                "textStatus" => "NO se pudo actualizar el comprobante  $IdTipoComprobante con $NroComprobante",
            ));
        }
    }

    function save_detalles($id_venta, $productos, $cantidades, $precios, $importes)
    {
        for ($i = 0; $i < count($productos); $i++) {

            if ($precios[$i] <= 0) {
                echo json_encode(array(
                    //"Status" => FALSE,
                    "textStatus" => "Intenta vender algun producto sin precio!",
                ));
                return false;
            }
            $data = array(
                'IdProducto'     => $productos[$i],
                'IdVenta'        => $id_venta,
                'Cantidad'       => $cantidades[$i],
                'Precio'         => $precios[$i],
                'Importe'        => $importes[$i],
                'EstadoDetVenta' => 1,
            );
            $this->updateProducto($productos[$i], $cantidades[$i]);
            if (!$this->Ventas_model->save_detalle($data)) {
                echo json_encode(array(
                    //    "Status" => FALSE,
                    "textStatus" => "No se Pudo guardar los detalles de la venta en la bd",
                ));
            };
        }
    }
    function updateProducto($id_producto, $cantidad)
    {
        $productoActual = $this->Productos_model->get_by_id($id_producto);
        $data           = array(
            'Stock' => $productoActual->Stock - $cantidad,
        );
        if (!$this->Productos_model->update(array('IdProducto' => $id_producto), $data)) {
            echo json_encode(array(
                //    "Status" => FALSE,
                "textStatus" => "NO se pudo descontar $cantidad del stock en producto $id_producto",
            ));
        };
    }

    function reporte()
    {
        //cargamos un array usando el modelo
        $array = array(
            'titulopage'     => "Reporte de Ventas",
            'expandirVentas' => "is-expanded",
            'activeRpt'      => "active",
        );
        $data = array(
            'clientes' => $this->Clientes_model->getAll(),
        );
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head');
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('ventas/reporte', $data);
        $this->load->view('plantilla/footer_plugins');
    }
    function generarreporte()
    {
        if (isset($_POST['fechaini'])) {
            $fecha_ini = $_POST['fechaini'];
        }
        if (isset($_POST['fechafin'])) {
            $fecha_fin = $_POST['fechafin'];
        }
        if (isset($_POST['id_cliente'])) {
            $id_cliente = $_POST['id_cliente'];
        }
        $where = "1=1";

        if ($fecha_ini != "") {
            $where .= " AND v.Fecha >='$fecha_ini'";
        }
        if ($fecha_fin != "") {
            $where .= " AND v.Fecha <='$fecha_fin'";
        }
        if ($id_cliente != "") {
            $where .= " AND c.IdCliente ='$id_cliente'";
        }
        //cargamos un array usando el modelo
        $array = array(
            'titulopage'     => "Reporte de Ventas desde $fecha_ini hasta $fecha_fin",
            'expandirVentas' => "is-expanded",
            'activeRpt'      => "active",
        );
        $data = array(
            //'tipo_operaciones'=> $this->Tipo_op_model->gettipo_operaciones(),
            'reporteventas' => $this->Ventas_model->getReporte($where),
            'clientes'      => $this->Clientes_model->getAll(),
            //    'productos'=> $this->Productos_model->getProductos(),
        );
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head');
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('ventas/reporte', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('ventas/script_ventas');
    }

    function ajax_delete($id)
    {
        $data = array(
            'estado_caja' => 2,
        );

        if ($this->Cajas_model->delete_by_id($id, $data)) {
            echo json_encode(array(
                "Status"     => "OK",
                "textStatus" => " La Caja Nro. $id fue Cerrada\n ",
            ));
        } else {

            echo json_encode(array(
                //    "Status" => FALSE,
                "textStatus" => "Error al Intentar  Anular la Venta $id en la BD.",
            ));
        }
    }
    function DevolverProducto($idproducto, $cantidad)
    {
        $productoActual = $this->Productos_model->get_by_id($idproducto);
        $dataStock      = array(
            'Stock' => $productoActual->Stock + $cantidad,
        );
        if (!$this->Productos_model->update(array('IdProducto' => $idproducto), $dataStock)) {
            echo json_encode(array(
                //    "Status" => FALSE,
                "textStatus" => "Error al Intentar Regresar $dataStock al Producto  $idproducto en la BD",
            ));
        };
    }
}
