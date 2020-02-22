<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//se crea el controlador categorias
class Servicios_controller extends CI_Controller {
//constructor
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model("Servicios_model");
		$this->load->model("Categorias_model");
    }
//carga una vista llamada list
    public function index()
	{
		$data = array(
			'servicios' => $this->Servicios_model->getServicios(),
			"categorias" => $this->Categorias_model->getCategorias(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('servicios/list',$data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('servicios/script_servicios');

	}

	public function view($id){
		$data = array(
			'servicios' => $this->Servicios_model->getServicio($id),
		 );
			$this->load->view("servicios/view",$data);
	}

	public function store(){

		$this->form_validation->set_rules("codigobarra","Codigo","required|is_unique[producto_servicio.codigobarra]");
		$this->form_validation->set_rules("descripcion","Nombre del Producto o Servicio","required");
		$this->form_validation->set_rules("id_categoria","Categoria","required");
		$this->form_validation->set_rules("stock","Stock","required");
//este metodo retorna un valor verdadero
		if($this->form_validation->run() == TRUE) {
			$data = array(

				'codigobarra' 	=> $this->input->post("codigobarra"),
				'descripcion' 	=>strtoupper($_POST['descripcion']) ,
				'id_categoria' 	=> $this->input->post("id_categoria"),
				'stock'		 	=> $this->input->post("stock"),
				'precio_compra' => $this->input->post("precio_compra"),
				'precio_venta'  => $this->input->post("precio_venta"),
				'impuesto' => "10",
				'estado' => "1"
			);
			if ($this->Servicios_model->save($data)) {
				$this->session->set_flashdata("success","Datos Guardados");
				redirect(base_url()."Servicios_controller", "refresh");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."Servicios_controller", "refresh");
				
			}
		}
		else{
			$this->store();
		}
		
		
	}
	//metodo para editar
	public function edit($id){
		$data = array(
			'servicios' => $this->Servicios_model->getServicio($id),
			'categorias' => $this->Categorias_model->getCategorias(),
		);
			$this->load->view('servicios/edit', $data);
    }
	
	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_codigobarra     = $this->input->post("edit_codigobarra");
	
		//traemos datos para no duplicarlos
		$codigobarraBd = $this->Servicios_model->getServicio($id);

		if($edit_codigobarra == $codigobarraBd->codigobarra)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[producto_servicio.codigobarra]';
		}
		
		//validar
		$this->form_validation->set_rules("edit_codigobarra","Codigo","required".$unique);
		$this->form_validation->set_rules("edit_descripcion","Nombre del Producto","required");
		$this->form_validation->set_rules("edit_id_categoria","Categoria","required");
		$this->form_validation->set_rules("edit_stock","Stock","required");
	
		if($this->form_validation->run() == TRUE)
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'codigobarra' 	=> $this->input->post("edit_codigobarra"),
				'descripcion' 	=>strtoupper($_POST['edit_descripcion']) ,
				'id_categoria' 	=> $this->input->post("edit_id_categoria"),
				'stock'		 	=> $this->input->post("edit_stock"),
				'precio_compra' => $this->input->post("edit_precio_compra"),
				'precio_venta'  => $this->input->post("edit_precio_venta"),
				'impuesto' => "10",
				'estado' => "1"
			);
			if($this->Servicios_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
						redirect(base_url()."Servicios_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
					//redirect(base_url()."Servicios_controller", "refresh");
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			//$this->edit($id);
		}
	}

		
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estado' => '3',
		);
		if($this->Servicios_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
				redirect(base_url()."Servicios_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
				redirect(base_url()."Servicios_controller", "refresh");
			}
		
		
	}	
}
