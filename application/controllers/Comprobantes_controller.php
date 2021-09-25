<?php
defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador comprobantes
class Comprobantes_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		//$this->load->model("Servicios_model");
		$this->load->model("Comprobantes_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			"comprobantes" => $this->Comprobantes_model->getAll(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('comprobantes/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('comprobantes/script_comprobantes');
	}

	public function view($id)
	{
		$data = array(
			'comprobantes' => $this->Comprobantes_model->getById($id),
		);
		$this->load->view("comprobantes/view", $data);
	}

	public function store()
	{
		$this->form_validation->set_rules("descripcion", "Campo descripcion", "required|is_unique[comprobantes.descripcion]");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'descripcion' 	=> strtoupper($_POST['descripcion']),
				'serie_comprobante' 	=> $_POST['serie_comprobante'],
				'ultimo_nro' 	=> $_POST['ultimo_nro'],
				'estado' => "1"
			);

			if ($this->Comprobantes_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Comprobantes_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Comprobantes_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "Error de Validacion, datos duplicados");
			redirect(base_url() . "Comprobantes_controller", "refresh");
			//$this->store();
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'comprobantes' => $this->Comprobantes_model->getById($id),

		);
		$this->load->view('comprobantes/edit', $data);
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_descripcion     = $this->input->post("edit_descripcion");

		//traemos datos para no duplicarlos
		$comprobantesBd = $this->Comprobantes_model->getById($id);

		if ($edit_descripcion == $comprobantesBd->descripcion) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[comprobantes.descripcion]';
		}

		//validar
		$this->form_validation->set_rules("edit_descripcion", "Descripcion", "required" . $unique);

		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'descripcion' 	=> strtoupper($_POST['edit_descripcion']),
				'serie_comprobante' 	=> $_POST['edit_serie_comprobante'],
				'ultimo_nro' 	=> $_POST['edit_ultimo_nro'],
				'estado' => "1"
			);
			if ($this->Comprobantes_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente');
				redirect(base_url() . "Comprobantes_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al intentar actualizar en la Base de Datos');
				redirect(base_url() . "Comprobantes_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de validación al intentar actualizar');
			redirect(base_url() . "Comprobantes_controller", "refresh");
			//$this->edit($id);
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		// averiguar primero si ya no esta anulado
		$datadb = $this->Comprobantes_model->getById($id);
		if ($datadb->estado == 3) {
			$this->session->set_flashdata('error', 'Ya estaba anulado previamente!');
			redirect(base_url() . "Comprobantes_controller", "refresh");
		}
		$data = array(
			'estado' => '3',
		);
		if ($this->Comprobantes_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Comprobantes_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al intentar anular!');
			redirect(base_url() . "Comprobantes_controller", "refresh");
		}
	}
}