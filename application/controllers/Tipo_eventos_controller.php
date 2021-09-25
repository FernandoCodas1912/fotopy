<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipo_eventos_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Tipo_eventos_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			"tipo_eventos" => $this->Tipo_eventos_model->getAll(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('tipo_evento/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('tipo_evento/script_tipo_evento');
	}

	public function view($id)
	{
		$data = array(
			'tipo_evento' => $this->Tipo_eventos_model->getById($id),
		);
		$this->load->view("tipo_evento/view", $data);
	}

	public function store()
	{
		$this->form_validation->set_rules("descripcion", "Campo descripcion", "required|is_unique[tipo_eventos.descripcion]");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'descripcion' 	=> strtoupper($_POST['descripcion']),
				'observacion' 	=> strtoupper($_POST['observacion']),
				'estado' => "1"
			);

			if ($this->Tipo_eventos_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Tipo_eventos_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Tipo_eventos_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "Error de Validacion, datos duplicados");
			redirect(base_url() . "Tipo_eventos_controller", "refresh");
			//$this->store();
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'tipo_evento' => $this->Tipo_eventos_model->getById($id),

		);
		$this->load->view('tipo_evento/edit', $data);
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_descripcion     = $this->input->post("edit_descripcion");

		//traemos datos para no duplicarlos
		$tipo_eventosBd = $this->Tipo_eventos_model->getById($id);

		if ($edit_descripcion == $tipo_eventosBd->descripcion) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[tipo_eventos.descripcion]';
		}

		//validar
		$this->form_validation->set_rules("edit_descripcion", "Descripcion", "required" . $unique);

		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'descripcion' 	=> strtoupper($_POST['edit_descripcion']),
				'observacion' 	=> strtoupper($_POST['edit_observacion']),
				'estado' => "1"
			);
			if ($this->Tipo_eventos_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Tipo_eventos_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
				redirect(base_url() . "Tipo_eventos_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			redirect(base_url() . "Tipo_eventos_controller", "refresh");
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		// averiguar primero si ya no esta anulado
		$evento = $this->Tipo_eventos_model->getById($id);
		if ($evento->estado == 3) {
			$this->session->set_flashdata('error', 'Ya estaba anulado previamente!');
			redirect(base_url() . "Tipo_eventos_controller", "refresh");
		}
		$data = array(
			'estado' => '3',
		);
		if ($this->Tipo_eventos_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Tipo_eventos_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Tipo_eventos_controller", "refresh");
		}
	}
}