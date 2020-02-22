<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comprobantes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
        $this->load->model('Comprobantes_model'); //llama al modelo y luego usa un alias
    }

    public function index()
    {
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
        $array = array(
            'titulopage'          => "Comprobantes",
            'expandir_config'     => "is-expanded",
            'active_comprobantes' => "active",
        );

        $this->load->helper('url');
        $this->load->view('plantilla/head', $array);
        $this->load->view('plantilla/menu_head', $datoshoy);
        $this->load->view('plantilla/menu_costado');
        $this->load->view('comprobantes/list', $array);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('comprobantes/script_comprobantes');
    }

    public function ajax_list()
    {
        $list = $this->Comprobantes_model->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $comprobante) {
            $no++;
            $row   = array();
            $row[] = $comprobante->IdTipoComprobante;
            $row[] = $comprobante->Descripcion;
            $row[] = $comprobante->SerieComprobante;
            $row[] = $comprobante->UltimoNroComprobante;

            $estado = $comprobante->EstadoComprobante;
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
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="MODIFICAR " onclick="edit_item(' . "'" . $comprobante->IdTipoComprobante . "'" . ')"><i class="fa fa-pencil"></i> EDITAR </a>
			<a class="btn btn-sm btn-danger" href="javascript:void()" title="ANULAR" onclick="delete_item(' . $comprobante->IdTipoComprobante . ')"><i class="fa fa-trash"></i> ANULAR </a>';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Comprobantes_model->count_all(),
            "recordsFiltered" => $this->Comprobantes_model->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->Comprobantes_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->form_validation->set_rules("Descripcion", "Descripcion", "required|is_unique[tipocomprobante.Descripcion]");

        if ($this->form_validation->run() == true) {
            $data = array(
                'IdTipoComprobante'    => $this->input->post('id'),
                'Descripcion'          => strtoupper($_POST['Descripcion']),
                'SerieComprobante'     => strtoupper($_POST['SerieComprobante']),
                'UltimoNroComprobante' => strtoupper($_POST['UltimoNroComprobante']),
                'date_add'             => date("Y-m-d H:i:s"),
                'EstadoComprobante'    => 1,
            );
            if ($insert = $this->Comprobantes_model->save($data)) {
                echo json_encode(
                    array(
                        "Status"     => "OK",
                        "textStatus" => "AGREGADO CORRECTAMENTE ",
                    )
                );
            } else {
                echo json_encode(
                    array(
                        "Status"     => false,
                        "textStatus" => "Error en la BD.",
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "Status"     => false,
                    "textStatus" => "COMPROBANTE DUPLICADO",
                )
            );
        }
    }

    public function ajax_update()
    {
        //recibimos via post algunos datos para poder comparar en la bd
        $id          = $this->input->post("id");
        $edit_Codigo = $this->input->post("Descripcion");

        //traemos datos para no duplicarlos
        $CodigoBd = $this->Comprobantes_model->get_by_id($id); //get_by_id

        if ($edit_Codigo == $CodigoBd->Descripcion) {
            $unique = '';
        } else {
            //si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
            $unique = '|is_unique[tipocomprobante.Descripcion]';
        }

        //validamos del lado del servidor
        $this->form_validation->set_rules("Descripcion", "Descripcion", "required" . $unique);

        if ($this->form_validation->run() == true) {
            $data = array(
                'Descripcion'          => strtoupper($_POST['Descripcion']),
                'SerieComprobante'     => strtoupper($_POST['SerieComprobante']),
                'UltimoNroComprobante' => strtoupper($_POST['UltimoNroComprobante']),
                'Estadocomprobante'    => 1,
                //'date_add'        =>    date("Y-m-d H:i:s"),
            );
            $this->Comprobantes_model->update(array('IdTipoComprobante' => $this->input->post('id')), $data);

            echo json_encode(
                array(
                    "Status"     => "OK",
                    "textStatus" => "ACTUALIZADO CORRECTAMENTE ",

                )
            );
        } else {
            echo json_encode(
                array(
                    "Status"     => false,
                    "textStatus" => "COMPROBANTE DUPLICADO!",
                )
            );
        }
    }

    public function ajax_delete($id)
    {
        //    $this->product->update(array('IdProducto' => $this->input->post('id')), $data);
        $data = array(
            'EstadoComprobante' => 3,
        );
        $this->Comprobantes_model->delete_by_id($id, $data);
        echo json_encode(
            array(
                "Status"     => "OK",
                "textStatus" => "ANULADO CORRECTAMENTE",
            )
        );
    }
}
