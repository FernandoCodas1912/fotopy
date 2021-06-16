<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//se crea el controlador 
class Staffs_controller extends CI_Controller {
//constructor
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		//$this->load->model("Servicios_model");
		$this->load->model("Staffs_model");
    }
//carga una vista llamada list
    public function index()
	{
		$data = array(
		/*	'servicios' => $this->Servicios_model->getServicios(),*/
		"staffs" => $this->Staffs_model->getStaffs(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('staffs/list',$data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('staffs/script_staffs');

	}

	public function view($id){
		$data = array(
			'staffs' => $this->Staffs_model->getStaff($id),
		 );
			$this->load->view("staffs/view",$data);
	}

	public function store(){
		$this->form_validation->set_rules("nrodocumento","Documento","required|is_unique[staff.nrodocumento]");
		$this->form_validation->set_rules("nomape","Nombre y Apellido","required|is_unique[staff.nomape]");
		$this->form_validation->set_rules("direccion","Dirección","required|is_unique[staff.direccion]");
		$this->form_validation->set_rules("id_ciudad","Ciudad","required|is_unique[staff.id_ciudad]");
		$this->form_validation->set_rules("descripcion","Descripción","required|is_unique[ciudad.descripcion]");
		$this->form_validation->set_rules("telefono","Telefono","required|is_unique[staff.telefono]");
		$this->form_validation->set_rules("telefono2","Telefono 2","required|is_unique[staff.telefono2]");
		$this->form_validation->set_rules("email","Email","required|is_unique[staff.email]");	
		$this->form_validation->set_rules("ocupacion","Ocupación","required|is_unique[staff.ocupacion]");
		$this->form_validation->set_rules("ingreso","Año de ingreso","required|is_unique[staff.ingreso]");

		if($this->form_validation->run()== TRUE) 
		{
			$data = array(
				'nrodocumento' 	=>strtoupper($_POST['nrodocumento']) ,
				'nomape' 		=>strtoupper($_POST['nomape']) ,
				'direccion' 	=>strtoupper($_POST['direccion']) ,
				'id_ciudad' 	=>strtoupper($_POST['id_ciudad']) ,
				// 'descripcion' 	=>strtoupper($_POST['descripcion']) ,
				'telefono' 		=>strtoupper($_POST['telefono']) ,
				'telefono2' 	=>strtoupper($_POST['telefono2']) ,
				'email' 		=>strtoupper($_POST['email']) ,
				'ocupacion' 	=>strtoupper($_POST['ocupacion']) ,
				'ingreso' 		=>strtoupper($_POST['ingreso']) ,
				'estado' 		=> "1"
			);
		
			if ($this->Staffs_model->save($data)) {
				$this->session->set_flashdata("success","Datos Guardados");
				redirect(base_url()."Staffs_controller", "refresh");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."Staffs_controller", "refresh");				
			}
		}else{
			$this->session->set_flashdata("error","Error de Validacion, datos duplicados");
			redirect(base_url()."Staffs_controller", "refresh");				
			//$this->store();
		}	
	}
	//metodo para editar
	public function edit($id){
		$data = array(
			'staff' => $this->Staffs_model->getStaff($id),

		);
			$this->load->view('staffs/edit', $data);
    }
	
	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   =$this->input->post("edit_id");
		$edit_doc			   =$this->input->post("edit_doc");
		$edit_nomape     	   =$this->input->post("edit_nomape");
		$edit_dir			   =$this->input->post("edit_dir");
		$edit_ciu			   =$this->input->post("edit_ciu");
		$edit_tel			   =$this->input->post("edit_tel");
		$edit_tel2			   =$this->input->post("edit_tel2");
		$edit_ema			   =$this->input->post("edit_ema");
		$edit_ocu			   =$this->input->post("edit_ocu");
		
	
		//traemos datos para no duplicarlos
		$id_bd = $this->Staffs_model->getStaff($id);

		if($edit_doc == $id_bd->nrodocumento)
		{
			$unique = '';
		}
		if($edit_nomape == $id_bd->nomape)
		{
			$unique = '';
		}
		if($edit_dir == $id_bd->direccion)
		{
			$unique = '';
		}
		if($edit_ciu == $id_bd->id_ciudad)
		{
			$unique = '';
		}
		if($edit_tel == $id_bd->telefono)
		{
			$unique = '';
		}
		if($edit_tel2 == $id_bd->telefono2)
		{
			$unique = '';
		}
		if($edit_ema == $id_bd->email)
		{
			$unique = '';
		}
		if($edit_ocu == $id_bd->ocupacion)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[staff.nrodocumento]';
			$unique = '|is_unique[staff.nomape]';
			$unique = '|is_unique[staff.direccion]';
			$unique = '|is_unique[staff.id_ciudad]';
			$unique = '|is_unique[staff.telefono]';
			$unique = '|is_unique[staff.telefono2]';
			$unique = '|is_unique[staff.email]';
			$unique = '|is_unique[staff.ocupacion]';
	
		}
		
		//validar
		$this->form_validation->set_rules("edit_doc","Documento","required".$unique);
		$this->form_validation->set_rules("edit_nomape","Nombre y Apellido","required".$unique);
		$this->form_validation->set_rules("edit_dir","Dirección","required".$unique);
		$this->form_validation->set_rules("edit_ciu","Ciudad","required".$unique);
		$this->form_validation->set_rules("edit_tel","Teléfono","required".$unique);
		$this->form_validation->set_rules("edit_tel2","Teléfono 2","required".$unique);
		$this->form_validation->set_rules("edit_ema","Email","required".$unique);
		$this->form_validation->set_rules("edit_ocu","Ocupación","required".$unique);
		

		
		if($this->form_validation->run()== TRUE) 
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'nrodocumento' 	=>strtoupper($_POST['edit_doc']) ,
				'nomape' 		=>strtoupper($_POST['edit_nomape']) ,
				'direccion'		=>strtoupper($_POST['edit_dir']) ,
				'ciudad' 		=>strtoupper($_POST['edit_ciu']) ,
				'telefono' 		=>strtoupper($_POST['edit_tel']) ,
				'telefono2' 	=>strtoupper($_POST['edit_tel2']) ,
				'email' 		=>strtoupper($_POST['edit_ema']) ,
				'ocupacion' 	=>strtoupper($_POST['edit_ocu']) ,
				'estado' 		=> "1"
			);
			if($this->Staffs_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente');
						redirect(base_url()."Staffs_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al intentar actualizar en la Base de Datos');
					redirect(base_url()."Staffs_controller", "refresh");
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de validación al intentar actualizar');
					redirect(base_url()."Staffs_controller", "refresh");
			//$this->edit($id);
		}
	}

		
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estado' => '3',
		);
		if($this->Staffs_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente');
				//retornamos a la vista para que se refresque
				redirect(base_url()."Staffs_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al intentar anular');
				redirect(base_url()."Staffs_controller", "refresh");
			}
		}	
}
