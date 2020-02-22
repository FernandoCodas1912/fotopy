<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//se crea el controlador empleados
class Empleados_controller extends CI_Controller {
//constructor
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		//$this->load->model("Servicios_model");
		$this->load->model("Empleados_model");
    }
//carga una vista llamada list
    public function index()
	{
		$data = array(
		/*	'servicios' => $this->Servicios_model->getServicios(),*/
		"empleados" => $this->Empleados_model->getEmpleados(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('empleados/list',$data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('empleados/script_empleados');

	}

	public function view($id){
		$data = array(
			'empleados' => $this->Empleados_model->getEmpleado($id),
		 );
			$this->load->view("empleados/view",$data);
	}

	public function store(){
		$this->form_validation->set_rules("nomape","Nombre y Apellido","required|is_unique[empleado.nomape]");
		$this->form_validation->set_rules("nrodocumento","Documento","required|is_unique[empleado.nrodocumento]");
		$this->form_validation->set_rules("cargo","Cargo","required|is_unique[empleado.cargo]");
		$this->form_validation->set_rules("telefono","Telefono","required|is_unique[empleado.telefono]");
		$this->form_validation->set_rules("email","Email","required|is_unique[empleado.email]");
		$this->form_validation->set_rules("salario","Salario","required|is_unique[empleado.salario]");
		$this->form_validation->set_rules("id_ciudad","Ciudad","required|is_unique[empleado.id_ciudad]");
		
		if($this->form_validation->run()== TRUE) 
		{
			$data = array(
				'nomape' 		=>strtoupper($_POST['nomape']) ,
				'nrodocumento' 	=>strtoupper($_POST['nrodocumento']) ,
				'cargo' 		=>strtoupper($_POST['cargo']) ,
				'telefono' 		=>strtoupper($_POST['telefono']) ,
				'email' 		=>strtoupper($_POST['email']) ,
				'salario' 		=>strtoupper($_POST['salario']) ,
				'id_ciudad' 	=>strtoupper($_POST['id_ciudad']) ,
				'estado' 		=> "1"
			);
		
			if ($this->Empleados_model->save($data)) {
				$this->session->set_flashdata("success","Datos Guardados");
				redirect(base_url()."Empleados_controller", "refresh");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."Empleados_controller", "refresh");				
			}
		}else{
			$this->session->set_flashdata("error","Error de Validacion, datos duplicados");
			redirect(base_url()."Empleados_controller", "refresh");				
			//$this->store();
		}	
	}
	//metodo para editar
	public function edit($id){
		$data = array(
			'empleados' => $this->Empleados_model->getEmpleado($id),

		);
			$this->load->view('empleados/edit', $data);
    }
	
	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   =$this->input->post("edit_id");
		$edit_nomape     	   =$this->input->post("edit_nomape");
		$edit_doc			   =$this->input->post("edit_doc");
		$edit_car     	   	   =$this->input->post("edit_car");
		$edit_tel			   =$this->input->post("edit_tel");
		$edit_ema			   =$this->input->post("edit_ema");
		$edit_sal			   =$this->input->post("edit_sal");
		$edit_ciu			   =$this->input->post("edit_ciu");
		
	
		//traemos datos para no duplicarlos
		$id_bd = $this->Empleados_model->getEmpleado($id);

		if($edit_nomape == $id_bd->nomape)
		{
			$unique = '';
		}
		if($edit_doc == $id_bd->nrodocumento)
		{
			$unique = '';
		}
		if($edit_car == $id_bd->cargo)
		{
			$unique = '';
		}
		if($edit_tel == $id_bd->telefono)
		{
			$unique = '';
		}
		if($edit_ema == $id_bd->email)
		{
			$unique = '';
		}
		if($edit_sal == $id_bd->salario)
		{
			$unique = '';
		}
		if($edit_ciu == $id_bd->id_ciudad)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[empleado.nomape]';
			$unique = '|is_unique[empleado.documento]';
			$unique = '|is_unique[empleado.cargo]';
			$unique = '|is_unique[empleado.telefono]';
			$unique = '|is_unique[empleado.email]';
			$unique = '|is_unique[empleado.salario]';
			$unique = '|is_unique[empleado.id_ciudad]';
		}
		
		//validar
		$this->form_validation->set_rules("edit_nomape","Nombre y Apellido","required".$unique);
		$this->form_validation->set_rules("edit_doc","Documento","required".$unique);
		$this->form_validation->set_rules("edit_car","Cargo","required".$unique);
		$this->form_validation->set_rules("edit_tel","Telefono","required".$unique);
		$this->form_validation->set_rules("edit_ema","Email","required".$unique);
		$this->form_validation->set_rules("edit_sal","Salario","required".$unique);
		$this->form_validation->set_rules("edit_ciu","Ciudad","required".$unique);

		
		if($this->form_validation->run()== TRUE) 
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'nomape' 		=>strtoupper($_POST['edit_nomape']) ,
				'nrodocumento' 	=>strtoupper($_POST['edit_doc']) ,
				'cargo' 		=>strtoupper($_POST['edit_car']) ,
				'telefono' 		=>strtoupper($_POST['edit_tel']) ,
				'email' 		=>strtoupper($_POST['edit_ema']) ,
				'salario' 		=>strtoupper($_POST['edit_sal']) ,
				'ciudad' 		=>strtoupper($_POST['edit_ciu']) ,
				'estado' 		=> "1"
			);
			if($this->Empleados_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
						redirect(base_url()."Empleados_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
					redirect(base_url()."Empleados_controller", "refresh");
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
					redirect(base_url()."Empleados_controller", "refresh");
			//$this->edit($id);
		}
	}

		
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estado' => '3',
		);
		if($this->Empleados_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
				redirect(base_url()."Empleados_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
				redirect(base_url()."Empleados_controller", "refresh");
			}
		}	
}
