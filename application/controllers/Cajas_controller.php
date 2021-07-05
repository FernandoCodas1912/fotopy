<?php
defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador cajas
class Cajas_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Cajas_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			"cajas" => $this->Cajas_model->getAll(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('cajas/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cajas/script_cajas');
	}

	public function view($id)
	{
		$data = array(
			'caja' => $this->Cajas_model->getById($id),
		);
		$this->load->view("cajas/view", $data);
	}

	public function store()
	{
		$this->form_validation->set_rules("descripcion", "Campo descripcion", "required|is_unique[tipo_eventos.descripcion]");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'descripcion' 	=> strtoupper($_POST['descripcion']),
				'estado' => "1"
			);

			if ($this->Cajas_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Cajas_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Cajas_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "Error de Validacion, datos duplicados");
			redirect(base_url() . "Cajas_controller", "refresh");
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'caja' => $this->Cajas_model->getById($id),

		);
		$this->load->view('cajas/edit', $data);
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_descripcion     = $this->input->post("edit_descripcion");

		//traemos datos para no duplicarlos
		$tipo_eventosBd = $this->Cajas_model->getById($id);

		if ($edit_descripcion == $tipo_eventosBd->descripcion) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[cajas.descripcion]';
		}

		//validar
		$this->form_validation->set_rules("edit_descripcion", "Descripcion", "required" . $unique);

		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'descripcion' 	=> strtoupper($_POST['edit_descripcion']),
				'estado' => "1"
			);
			if ($this->Cajas_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Cajas_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
				redirect(base_url() . "Cajas_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			redirect(base_url() . "Cajas_controller", "refresh");
			//$this->edit($id);
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		$data = array(
			'estado' => '3',
		);
		if ($this->Cajas_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Cajas_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Cajas_controller", "refresh");
		}
	}



	//esto usado en dashboard para el modal abrir cajas
	public function abrir_caja()
	{
		$data = array(
			'id_caja'       	=> $_POST['id_caja'],
			'usuario_apertura'  => $_POST['usuario_ape'],
			'fecha_apertura'    => date('Y-m-d'),
			'monto_apertura'    => $_POST['monto_apertura'],
			'estadocaja'       	=> 1,

		);
		if ($this->Cajas_model->save("aperturacierre", $data)) {
			echo json_encode(
				array(
					"Status"     => "OK",
					"textStatus" => "La Caja ha sido Abierta sin Errores ",
				)
			);
		} else {
			echo json_encode(
				array(
					"textStatus" => "ERROR EN LA BD",
				)
			);
		}
	}
	public function cerrar_caja()
	{
		$id_caja =  $_POST['id_caja'];
		$data = array(
			'id_caja'       	=> $id_caja,
			'usuario_cierre'  => $_POST['usuario_cierre'],
			'fecha_cierre'    => date('Y-m-d'),
			'monto_cierre'    => $_POST['monto_cierre'],
			'estadocaja'       	=> 2,

		);
		if ($this->Cajas_model->cierreCaja($id_caja, $data)) {
			echo json_encode(
				array(
					"Status"     => "OK",
					"textStatus" => "La Caja ha sido Cerrada sin Errores ",
				)
			);
		} else {
			echo json_encode(
				array(
					"textStatus" => "ERROR EN LA BD",
				)
			);
		}
	}
}