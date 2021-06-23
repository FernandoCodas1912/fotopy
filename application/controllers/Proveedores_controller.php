<?php
defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador categorias
class Proveedores_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Proveedores_model");
		$this->load->model("Ciudades_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			'proveedores' => $this->Proveedores_model->getAll(),
			'ciudades' => $this->Ciudades_model->getAll(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');

		$this->load->view('proveedores/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('proveedores/script_proveedores');
	}

	public function view($id)
	{
		$data = array(
			'proveedores' => $this->Proveedores_model->getById($id),
			'ciudades' => $this->Ciudades_model->getAll(),
		);
		$this->load->view("proveedores/view", $data);
	}

	public function store()
	{

		$this->form_validation->set_rules("razonsocial", "Nombre del Proveedor", "required");
		$this->form_validation->set_rules("nrodocumento", "Nro de Documento", "required|is_unique[proveedores.nrodocumento]");
		//este metodo retorna un valor verdadero
		if ($this->form_validation->run() == TRUE) {
			$data = array(

				'razonsocial' 	=> strtoupper($_POST['razonsocial']),
				'nrodocumento' 	=> $this->input->post("nrodocumento"),
				'telefono' 		=> $this->input->post("telefono"),
				'direccion' 	=> strtoupper($_POST['direccion']),
				'email'		 	=> $this->input->post("email"),
				'date_add' 		=> date("Y-m-d H:i:s"),
				'id_ciudad' 	=> $this->input->post("id_ciudad"),
				'estado' => "1"
			);
			if ($this->Proveedores_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Proveedores_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Proveedores_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "No se pudo guardar la informacion por errores de validacion");
			redirect(base_url() . "Proveedores_controller", "refresh");
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'proveedores' => $this->Proveedores_model->getById($id),
			'ciudades' => $this->Ciudades_model->getAll(),
		);
		$this->load->view('proveedores/edit', $data);
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_nrodocumento     = $this->input->post("edit_nrodocumento");

		//traemos datos para no duplicarlos
		$nrodocumentoBd = $this->Proveedores_model->getById($id);

		if ($edit_nrodocumento == $nrodocumentoBd->nrodocumento) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[proveedores.nrodocumento]';
		}

		//validar
		$this->form_validation->set_rules("edit_nrodocumento", "Nro Documento", "required" . $unique);
		$this->form_validation->set_rules("edit_id_ciudad", "Ciudad", "required");

		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'razonsocial' 	=> strtoupper($_POST['edit_razonsocial']),
				'nrodocumento' 	=> $this->input->post("edit_nrodocumento"),
				'telefono' 		=> $this->input->post("edit_telefono"),
				'direccion' 	=> strtoupper($_POST['edit_direccion']),
				'email'		 	=> $this->input->post("edit_email"),
				'id_ciudad' 	=> $this->input->post("edit_id_ciudad"),
				'estado' => "1"

			);
			if ($this->Proveedores_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Proveedores_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
				redirect(base_url() . "Proveedores_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			redirect(base_url() . "Proveedores_controller", "refresh");
			//$this->edit($id);
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		$data = array(
			'estado' => '3',
		);
		if ($this->Proveedores_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Proveedores_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Proveedores_controller", "refresh");
		}
	}
}