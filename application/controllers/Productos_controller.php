<?php

defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador categorias
class Productos_controller extends CI_Controller
{
    //constructor
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('Productos_model');
        $this->load->model('Categorias_model');
    }

    //carga una vista llamada list
    public function index()
    {
        $data = [
            'productos' => $this->Productos_model->getAll(),
            'categorias' => $this->Categorias_model->getAllProductos(),
        ];
        $this->load->view('plantilla/header');
        $this->load->view('plantilla/menu');

        $this->load->view('productos/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('productos/script_productos');
    }

    public function view($id)
    {
        $data = [
            'producto' => $this->Productos_model->getById($id),
        ];

        $this->load->view('productos/view', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
        $this->form_validation->set_rules('codigobarra', 'Codigo', 'required|is_unique[productos_servicios.codigobarra]');

        //este metodo retorna un valor verdadero
        if ($this->form_validation->run() == true) {
            $data = [
                'codigobarra' => $this->input->post('codigobarra'),
                'descripcion' => strtoupper($_POST['descripcion']),
                'id_categoria' => $_POST['id_categoria'],
                'impuesto' => $_POST['impuesto'],
                'precio_compra' => $this->input->post('precio_compra'),
                'precio_venta' => $this->input->post('precio_venta'),
                'stock' => $this->input->post('stock'),
                'stock_minimo' => $this->input->post('stock_minimo'),
                'tipo' => '1', //1 es producto
                'estado' => '1',
                'date_add' => date('Y-m-d H:i:s'),
                'date_mod' => date('Y-m-d H:i:s'),
            ];
            if ($this->Productos_model->save($data)) {
                $this->session->set_flashdata('success', 'Datos Guardados');
                redirect(base_url() . 'Productos_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo guardar la informacion');
                redirect(base_url() . 'Productos_controller', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'No se pudo guardar la informacion por errores de validacion, el codigo ingresado ya existe');
            redirect(base_url() . 'Productos_controller', 'refresh');
        }
    }

    //metodo para editar
    public function edit($id)
    {
        $data = [
            'productos' => $this->Productos_model->getById($id),
            'categorias' => $this->Categorias_model->getAllProductos(),
        ];
        $this->load->view('productos/edit', $data);
        $this->load->view('productos/script_productos');
    }

    //actualizamos
    public function update()
    {
        //recibimos via post algunos datos para poder comparar en la bd
        $id = $this->input->post('edit_id');
        $edit_codigobarra = $this->input->post('edit_codigobarra');

        //traemos datos para no duplicarlos
        $productoBd = $this->Productos_model->getById($id);

        if ($edit_codigobarra == $productoBd->codigobarra) {
            $unique = '';
        } else {
            //si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
            $unique = '|is_unique[productos_servicios.codigobarra]';
        }

        //validar
        $this->form_validation->set_rules('edit_codigobarra', 'Codigo', 'required' . $unique);

        if ($this->form_validation->run() == true) {
            //indicar campos de la tabla a modificar
            $data = [
                'codigobarra' => $edit_codigobarra,
                'descripcion' => strtoupper($this->input->post('edit_descripcion_producto')),
                'id_categoria' => $this->input->post('edit_id_categoria'),
                'impuesto' => $this->input->post('edit_impuesto'),
                'precio_compra' => $this->input->post('edit_precio_compra'),
                'precio_venta' => $this->input->post('edit_precio_venta'),
                'stock' => $this->input->post('edit_stock'),
                'stock_minimo' => $this->input->post('edit_stock_minimo'),
                'tipo' => '1', //1 es producto
                'estado' => '1',
                'date_mod' => date('Y-m-d H:i:s'),
            ];
            if ($this->Productos_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Actualizado correctamente!');
                redirect(base_url() . 'Productos_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errores al intentar actualizar en la Base de Datos');
                redirect(base_url() . 'Productos_controller', 'refresh');
            }
        } else {
            //si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
            $this->session->set_flashdata('error', 'Errores de validación al intentar actualizar, ya existe un producto con el mismo codigo');
            redirect(base_url() . 'Productos_controller', 'refresh');
        }
    }

    //funcion para borrar
    public function delete($id)
    {
        // averiguar primero si ya no esta anulado
        $datadb = $this->Productos_model->getById($id);
        if ($datadb->estado == 3) {
            $this->session->set_flashdata('error', 'Ya estaba anulado previamente!');
            redirect(base_url() . "Productos_controller", "refresh");
        }
        $data = [
            'estado' => '3',
            'date_mod' => date('Y-m-d H:i:s'),
        ];
        if ($this->Productos_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Anulado correctamente');
            //retornamos a la vista para que se refresque
            redirect(base_url() . 'Productos_controller', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Errores al intentar anular');
            redirect(base_url() . 'Productos_controller', 'refresh');
        }
    }
}