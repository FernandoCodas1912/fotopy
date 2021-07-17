<?php
defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador categorias
class Movimientos_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Cajas_model");
		$this->load->model("Movimientos_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			"movimientos" => $this->Movimientos_model->getAll(),
			'cajas' => $this->Cajas_model->getAperturaCierre($this->session->userdata('username'),  $this->session->userdata('id_caja')),
			'saldo_caja' => $this->Movimientos_model->getSaldo($this->session->userdata('id_caja')),

		);
		//var_dump($data);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('movimientos/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('movimientos/script_movimientos');
	}

	# insert apertura de caja
	public function abrir_caja()
	{
		$data = array(
			'f_apertura'       => $this->input->post("f_apertura"),
			'id_cajero'        => $this->input->post("id_cajero"),
			'id_caja'       	=> $this->input->post("id_caja"),
			'monto_apertura' => $this->input->post("monto_apertura"),
			'estado_caja'      => 1,

		);
		if ($this->Movimientos_model->save_apertura($data)) {
			echo json_encode(
				array(
					"Status"     => "OK",
					"textStatus" => "La Caja ha sido Abierta sin Errores ",
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


	public function view($id)
	{
		$data = array(
			'categorias' => $this->Movimientos_model->getCategoria($id),
		);
		$this->load->view("categorias/view", $data);
	}

	public function store()
	{
		$this->form_validation->set_rules("descripcion", "Campo descripcion", "required|is_unique[categoria.descripcion]");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'descripcion' 	=> strtoupper($_POST['descripcion']),
				'estado' => "1"
			);

			if ($this->Movimientos_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Movimientos_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Movimientos_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "Error de Validacion, datos duplicados");
			redirect(base_url() . "Movimientos_controller", "refresh");
			//$this->store();
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'categorias' => $this->Movimientos_model->getCategoria($id),

		);
		$this->load->view('categorias/edit', $data);
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_descripcion     = $this->input->post("edit_descripcion");

		//traemos datos para no duplicarlos
		$id_bd = $this->Movimientos_model->getCategoria($id);

		if ($edit_descripcion == $id_bd->descripcion) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[categoria.descripcion]';
		}

		//validar
		$this->form_validation->set_rules("edit_descripcion", "Descripcion", "required" . $unique);

		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'descripcion' 	=> strtoupper($_POST['edit_descripcion']),
				'estado' => "1"
			);
			if ($this->Movimientos_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Movimientos_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
				redirect(base_url() . "Movimientos_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			redirect(base_url() . "Movimientos_controller", "refresh");
			//$this->edit($id);
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		$data = array(
			'estado' => '3',
		);
		if ($this->Movimientos_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Movimientos_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Movimientos_controller", "refresh");
		}
	}
}