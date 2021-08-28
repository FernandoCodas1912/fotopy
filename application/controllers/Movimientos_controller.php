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
}