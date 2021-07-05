<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cajas_model");

		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{

		$data = array(
			'datoscaja' => $this->Cajas_model->getAperturaCierre($this->session->userdata('username')),
		);
		//echo var_dump($data);
		//si ya esta logueado, que me cargue el controlador Dashboard
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('reservas/reservas', $data);
		$this->load->view('cajas/apertura_cierre_caja', $data);
		$this->load->view('plantilla/footer_plugins');
	}
}