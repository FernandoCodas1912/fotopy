<?php

defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador categorias
class Reservas_controller extends CI_Controller
{
    //constructor
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('Servicios_model');
        $this->load->model('Categorias_model');
        $this->load->model('Reservas_model');
        $this->load->model('Clientes_model');
        $this->load->model('Tipo_eventos_model');
        $this->load->model('Ciudades_model');
        $this->load->model('Departamentos_model');
        $this->load->model('Paises_model');
    }

    //carga una vista llamada list
    public function index()
    {
        $data = [
            'reservas' => $this->Reservas_model->getAll(),
            'servicios' => $this->Servicios_model->getAll(),
            'tipo_eventos' => $this->Tipo_eventos_model->getAll(),
            'clientes' => $this->Clientes_model->getAll(),
            'departamentos' => $this->Departamentos_model->getAll(),
            //   'paises' => $this->Paises_model->getAll(),

        ];
        $this->load->view('plantilla/header');
        $this->load->view('plantilla/menu');
        $this->load->view('reservas/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('reservas/script_reservas');
    }

    public function view($id)
    {
        $data = [
            'reservas' => $this->Reservas_model->getById($id),
        ];
        $this->load->view('reservas/view', $data); //se envia a la vista como reservas
    }

    public function chargeCalendar()
    {
        $reservas = $this->Reservas_model->getReservasCalendar();
        echo json_encode($reservas);
    }

    public function store()
    {
        $this->form_validation->set_rules('id_producto', 'Nombre del Producto o Servicio', 'required');

        //este metodo retorna un valor verdadero
        if ($this->form_validation->run() == true) {
            $data = [
                'id_producto' => $this->input->post('id_producto'),
                'id_cliente' => $this->input->post('id_cliente'),
                'id_tipoevento' => $this->input->post('id_tipoevento'),
                'fecha_evento' => $_POST['fecha_evento'],
                'hora_evento' => $this->input->post('hora_evento'),
                'ciudad_evento' => $this->input->post('ciudad_evento'),
                'departamento_evento' => $this->input->post('departamento_evento'),
                'lugar_evento' => strtoupper($_POST['lugar_evento']),
                'estado' => '1',
            ];
            if ($this->Reservas_model->save($data)) {
                $this->session->set_flashdata('success', 'Datos Guardados');
                redirect(base_url() . 'Reservas_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo guardar la informacion');
                redirect(base_url() . 'Reservas_controller', 'refresh');
            }
        } else {
            $this->store();
        }
    }

    //metodo para editar
    public function edit($id)
    {
        $data = [
            'servicios' => $this->Servicios_model->getAll(),
            'clientes' => $this->Clientes_model->getAll(),
            'tipo_eventos' => $this->Tipo_eventos_model->getAll(),
            'reservas' => $this->Reservas_model->getById($id),
            'ciudades' => $this->Ciudades_model->getAll(),
            'departamentos' => $this->Departamentos_model->getAll(),
        ];
        $this->load->view('reservas/script_reservas');
        $this->load->view('reservas/edit', $data); //esto abre la vista edit de la carpeta views/reservas
    }

    //actualizamos
    public function update()
    {
        //recibimos via post algunos datos para poder comparar en la bd
        $id = $this->input->post('edit_id');
        //validar
        $this->form_validation->set_rules('edit_id', 'ID Reserva ', 'required');

        if ($this->form_validation->run() == true) {
            //indicar campos de la tabla a modificar
            $data = [
                'id_producto' => $this->input->post('id_producto'),
                'id_cliente' => $this->input->post('id_cliente'),
                'id_tipoevento' => $this->input->post('id_tipoevento'),
                'fecha_evento' => $this->input->post('fecha_evento'),
                'ciudad_evento' => $this->input->post('ciudad_evento'),
                'departamento_evento' => $this->input->post('departamento_evento'),
                'hora_evento' => $this->input->post('hora_evento'),
                'lugar_evento' => strtoupper($_POST['lugar_evento']),
                'estado' => '1',
            ];
            if ($this->Reservas_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Actualizado correctamente!');
                redirect(base_url() . 'Reservas_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
                redirect(base_url() . 'Reservas_controller', 'refresh');
            }
        } else {
            //si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
            $this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
            redirect(base_url() . 'Reservas_controller', 'refresh');
            //$this->edit($id);
        }
    }

    //funcion para borrar
    public function delete($id)
    {
        $datadb = $this->Reservas_model->getById($id);
        if ($datadb->estado == 3) {
            $this->session->set_flashdata('error', 'Ya estaba anulado previamente!');
            redirect(base_url() . "Reservas_controller", "refresh");
        }

        $data = [
            'estado' => '3',
        ];
        if ($this->Reservas_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Anulado correctamente!');
            //retornamos a la vista para que se refresque
            redirect(base_url() . 'Reservas_controller', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Errores al Intentar Anular!');
            redirect(base_url() . 'Reservas_controller', 'refresh');
        }
    }
}