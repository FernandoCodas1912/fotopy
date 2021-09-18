<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cajas_model");
		$this->load->model('Servicios_model');
		$this->load->model('Categorias_model');
		$this->load->model('Reservas_model');
		$this->load->model('Clientes_model');
		$this->load->model('Tipo_eventos_model');
		$this->load->model('Ciudades_model');
		$this->load->model('Departamentos_model');
		$this->load->model('Paises_model');

		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{

		$data_caja = array(
			'datoscaja' => $this->Cajas_model->getAperturaCierre($this->session->userdata('username'), $this->session->userdata('id_caja')),
		);
		//si ya esta logueado, que me cargue el controlador Dashboard
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('reservas/reservas');
		$this->load->view('reservas/script_calendario');
		$this->load->view('cajas/apertura_cierre_caja', $data_caja);
		$this->load->view('plantilla/footer_plugins');
	}
}