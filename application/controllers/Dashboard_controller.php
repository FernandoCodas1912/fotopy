<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cajas_model");
		$this->load->model('Reservas_model');
    
		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{
	$a = $this->Reservas_model->getAll();

	foreach ($a as $key => $value) {
		$dataCalendar = array(
			'id' => $value->id_reserva,
			'title' => $value->servicio,
			'descripcion' => $value->servicio,
			'start' => $value->fecha_evento .' '. $value->hora_evento,
		);
	}
	
	
		$data = array(
			'datoscaja' => $this->Cajas_model->getAperturaCierre($this->session->userdata('username'), $this->session->userdata('id_caja')),
		);


		//echo json_encode($dataCalendar);
		//si ya esta logueado, que me cargue el controlador Dashboard
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('reservas/reservas', json_encode($dataCalendar) );
		$this->load->view('reservas/script_calendario', json_encode($dataCalendar));
		$this->load->view('cajas/apertura_cierre_caja', $data);
		$this->load->view('plantilla/footer_plugins');
	}
}