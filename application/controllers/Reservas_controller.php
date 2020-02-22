<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//se crea el controlador categorias
class Reservas_controller extends CI_Controller {
//constructor
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model("Servicios_model");
		$this->load->model("Categorias_model");
		$this->load->model("Reservas_model");
	}
//carga una vista llamada list
	public function index()
	{
		$data = array(
			"reservas" => $this->Reservas_model->getReservas(),
			'servicios' => $this->Servicios_model->getServicios(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('reservas/list',$data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('reservas/script_reservas');

	}

	public function view($id){
		$data = array(
			'reservas' => $this->Reservas_model->getReserva($id),
		);
			$this->load->view("reservas/view",$data); //se envia a la vista como reservas
		}

		public function store(){

			$this->form_validation->set_rules("id_producto","Nombre del Producto o Servicio","required");

		//este metodo retorna un valor verdadero
			if($this->form_validation->run() == TRUE) {
				$data = array(

					'id_producto' 	=> $this->input->post("id_producto"),
					'fecha_evento' 	=>$_POST['fecha_evento'] ,
					'hora_evento' 	=> $this->input->post("hora_evento"),
					'lugar_evento' 	=>strtoupper($_POST['lugar_evento']) ,
					'estado' 		=> "1"
				);
				if ($this->Reservas_model->save($data)) {
					$this->session->set_flashdata("success","Datos Guardados");
					redirect(base_url()."Reservas_controller", "refresh");
				}
				else{
					$this->session->set_flashdata("error","No se pudo guardar la informacion");
					redirect(base_url()."Reservas_controller", "refresh");

				}
			}
			else{
				$this->store();
			}


		}
	//metodo para editar
		public function edit($id){
			$data = array(
			//'servicios' => $this->Servicios_model->getServicio($id),
				'servicios' => $this->Servicios_model->getServicios(),
				'reservas' => $this->Reservas_model->getReserva($id),
			);
			$this->load->view('reservas/edit', $data); //esto abre la vista edit de la carpeta views/reservas
		}

	//actualizamos 
		public function update()
		{
		//recibimos via post algunos datos para poder comparar en la bd
			$id   				   = $this->input->post("edit_id");
		//validar
			$this->form_validation->set_rules("edit_id","ID Reserva ","required");

			if($this->form_validation->run() == TRUE)
			{
			//indicar campos de la tabla a modificar
				$data = array(
					'id_producto' 	=> $this->input->post("id_producto"),
					'fecha_evento' 	=> $this->input->post("fecha_evento"),
					'hora_evento'	=> $this->input->post("hora_evento"),
					'lugar_evento' 	=>strtoupper($_POST['lugar_evento']) ,
					'estado' => "1"
				);
				if($this->Reservas_model->update($id,$data))
				{
					$this->session->set_flashdata('success', 'Actualizado correctamente!');
					redirect(base_url()."Reservas_controller", "refresh");
				}
				else
				{
					$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
					redirect(base_url()."Reservas_controller", "refresh");
				}
			}
			else
			{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
				$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
					redirect(base_url()."Reservas_controller", "refresh");
			//$this->edit($id);
			}
		}

		
	//funcion para borrar
		public function delete($id){
			$data = array(
				'estado' => '3',
			);
			if($this->Reservas_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
				redirect(base_url()."Reservas_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
				redirect(base_url()."Reservas_controller", "refresh");
			}


		}	
	}
