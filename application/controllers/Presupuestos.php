<?php
class Presupuestos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("Productos_model"); // esto abre el modelo
        $this->load->model("Clientes_model"); // esto abre el modelo
        $this->load->model("Comprobantes_model"); // esto abre el modelo
        $this->load->model("Categorias_model"); // esto abre el modelo
        $this->load->model("Ciudades_model"); // esto abre el modelo
        $this->load->model("Marcas_model"); // esto abre el modelo
        $this->load->model("Empresa_model"); // esto abre el modelo
        $this->load->model("Ventas_model"); // esto abre el modelo
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }


    public function index()
    {
        if (!$this->session->has_userdata("carrito"))
            $this->session->set_userdata("carrito", array());
        $array = array(
            'titulopage'     => "Presupuestos",
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
        $data = array(
            'presupuestos' => $this->Ventas_model->getAll(),
        );

        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head', $datoshoy);
        $this->load->view('plantilla/menu_costado', $array);
        $this->load->view('presupuestos/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('presupuestos/script_presupuestos');
    }

    public function ajax_list()
    {
        $list = $this->Ventas_model->get_datatables_presupuesto();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $venta) {
            //   if ($venta->TipoVenta == 1) {
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
                <a class="btn btn-sm btn-danger" href="javascript:void()" title="ANULAR" onclick="delete_item(' . $venta->IdVenta . ')"><i class="fa fa-trash"></i> ANULAR </a>
            <a class="btn btn-sm btn-primary" href="' .  base_url() . 'Presupuestar/edit/' . $venta->IdVenta . '" title="CONVERTIR A VENTA" ><i class="fa fa-cart-arrow-down fa-lg"></i> Conv. a Venta </a>';

            $data[] = $row;
        }
        //  }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Ventas_model->count_all_presupuesto(),
            "recordsFiltered" => $this->Ventas_model->count_filtered_presupuesto(),
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

        if ($TipoComprobante == 4) {
            $this->load->view("presupuestos/printPresupuesto", $data);
        } else {
            echo json_encode(array(
                "textStatus" => "ERROR AL SELECCIONAR COMPROBANTE",
            ));
        }
    }


    public function imprimir($id)
    {
        $data = array(
            'venta'    => $this->Ventas_model->get_by_id($id),
            'detalles' => $this->Ventas_model->getDetalleVenta($id),
            'empresa'  => $this->Empresa_model->getEmpresa(),

        );
        $this->load->view("presupuestos/printPresupuesto", $data);
    }


    public function ajax_delete($id)
    {
        $data = array(
            'EstadoVenta' => 3,
        );
        $data2 = array(
            'EstadoDetVenta' => 3,
        );

        if ($this->Ventas_model->delete_by_id($id, $data)) {
            $this->Ventas_model->delete_by_id_det($id, $data2);

            echo json_encode(array(
                "Status"     => "OK",
                "textStatus" => "La Operacion Nro. $id fue Anulada\n ",
            ));
        } else {

            echo json_encode(array(
                "textStatus" => "Error al Intentar  Anular la Operacion $id en la BD.",
            ));
        }
    }
}
