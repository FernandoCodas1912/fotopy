<?php

defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador categorias
class Categorias_controller extends CI_Controller
{
    //constructor
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('Categorias_model');
    }

    //carga una vista llamada list
    public function index()
    {
        $data = [
            'categorias' => $this->Categorias_model->getAll(),
        ];
        $this->load->view('plantilla/header');
        $this->load->view('plantilla/menu');
        $this->load->view('categorias/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('categorias/script_categorias');
    }

    public function view($id)
    {
        $data = [
            'categorias' => $this->Categorias_model->getById($id),
        ];
        $this->load->view('categorias/view', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('descripcion', 'Campo descripcion', 'required|is_unique[categorias.descripcion]');

        if ($this->form_validation->run() == true) {
            $data = [
                'descripcion' => strtoupper($_POST['descripcion']),
                'tipo' => $_POST['tipo'],
                'estado' => '1',
            ];

            if ($this->Categorias_model->save($data)) {
                $this->session->set_flashdata('success', 'Datos Guardados');
                redirect(base_url() . 'Categorias_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo guardar la informacion');
                redirect(base_url() . 'Categorias_controller', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Error de Validacion, datos duplicados');
            redirect(base_url() . 'Categorias_controller', 'refresh');
            //$this->store();
        }
    }

    //metodo para editar
    public function edit($id)
    {
        $data = [
            'categorias' => $this->Categorias_model->getById($id),
        ];
        $this->load->view('categorias/edit', $data);
    }

    //actualizamos
    public function update()
    {
        //recibimos via post algunos datos para poder comparar en la bd
        $id = $this->input->post('edit_id');
        $edit_descripcion = $this->input->post('edit_descripcion');

        //traemos datos para no duplicarlos
        $categoriaBD = $this->Categorias_model->getById($id);

        if ($edit_descripcion == $categoriaBD->descripcion) {
            $unique = '';
        } else {
            //si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
            $unique = '|is_unique[categorias.descripcion]';
        }

        //validar
        $this->form_validation->set_rules('edit_descripcion', 'Descripcion', 'required' . $unique);

        if ($this->form_validation->run() == true) {
            //indicar campos de la tabla a modificar
            $data = [
                'descripcion' => strtoupper($_POST['edit_descripcion']),
                'tipo' => strtoupper($_POST['edit_tipo']),
                'estado' => '1',
            ];
            if ($this->Categorias_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Actualizado correctamente!');
                redirect(base_url() . 'Categorias_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
                redirect(base_url() . 'Categorias_controller', 'refresh');
            }
        } else {
            //si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
            $this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
            redirect(base_url() . 'Categorias_controller', 'refresh');
            //$this->edit($id);
        }
    }

    //funcion para borrar
    public function delete($id)
    {
        $data = [
            'estado' => '3',
        ];
        if ($this->Categorias_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Anulado correctamente!');
            //retornamos a la vista para que se refresque
            redirect(base_url() . 'Categorias_controller', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Errores al Intentar Anular!');
            redirect(base_url() . 'Categorias_controller', 'refresh');
        }
    }


    // se guarda lo que viene desde productos o servicios
    public function storeCategoria()
    {
        $this->form_validation->set_rules('descripcion_categoria', 'Campo descripcion', 'required|is_unique[categorias.descripcion]');

        if ($this->form_validation->run() == true) {
            $data = [
                'descripcion' => strtoupper($_POST['descripcion_categoria']),
                'tipo' => $_POST['tipo_categoria'],
                'estado' => '1',
            ];

            if ($this->Categorias_model->save($data)) {
                $a = $this->db->affected_rows();
                echo json_encode(
                    array(
                        "status"     => "success",
                        "message" => "La Categoria " . $this->db->insert_id() . " fue Agregada correctamente",
                        "id" => $this->db->insert_id(),
                        "name" => strtoupper($_POST['descripcion']),
                    )
                );
            } else {
                echo json_encode(
                    array(
                        "status"     => "error",
                        "message" => "Error al Guardar la Categoria en la Bd " . $this->db->error()
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "status"     => "error",
                    "message" => "Error al Guardar la categoria",
                )
            );
        }
    }
}