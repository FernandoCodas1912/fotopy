<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//se crea el controlador categorias
class 	Productos_controller extends CI_Controller {
//constructor
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model("Productos_model");
		// $this->load->model("Ciudades_model");
    }
//carga una vista llamada list
    public function index()
	{
		$data = array(
			'productos' => $this->Productos_model->getProductos(),
			// 'ciudades' => $this->Ciudades_model->getCiudades(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		
		$this->load->view('productos/list',$data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('productos/script_productos');

	}

	public function view($id){
		$data = array(
			'productos' => $this->Productos_model->getProducto($id),
			// 'ciudades' => $this->Ciudades_model->getCiudades(),
		 );
			$this->load->view("productos/view",$data);
	}

	public function store(){

		$this->form_validation->set_rules("descripcion_producto","Descripción","required");
		// $this->form_validation->set_rules("detalle","Nro de Documento","required|is_unique[proveedor.nrodocumento]");
	//este metodo retorna un valor verdadero
		if($this->form_validation->run() == TRUE){
			$data = array(

				'id_producto' 	=>($_POST['id_prod']) ,
				'descripcion' 	=> strtoupper($_POST['descripcion']),
				'precio_compra' => $this->input->post("precio_compra"),
				'precio_venta' => $this->input->post("precio_compra"),
				'impuesto' => "10",
				// strtoupper$this->input->post("descripcion_tipoevento"),
				'estado' => "1"
			);
			if ($this->Productos_model->save($data)) {
				$this->session->set_flashdata("success","Datos Guardados");
				redirect(base_url()."Productos_controller", "refresh");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."Productos_controller", "refresh");
				
			}
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion por errores de validacion");
				redirect(base_url()."Productos_controller", "refresh");
		}
		
		
	}
	//metodo para editar
	public function edit($id){
		$data = array(
			'productos' => $this->Productos_model->getProducto($id),
			// 'ciudades' => $this->Ciudades_model->getCiudades(),
		);
			$this->load->view('productos/edit', $data);
    }
	
	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_descripcion_producto     = $this->input->post("edit_descripcion_producto");
	
		//traemos datos para no duplicarlos
		$descripcion_productoBd = $this->Productos_model->getProducto($id);

		if($edit_descripcion_producto == $descripcion_productoBd->descripcion_producto)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[producto.descripcion_producto]';
		}
		
		//validar
		$this->form_validation->set_rules("edit_descripcion_producto","Descripcion","required".$unique);
		// $this->form_validation->set_rules("edit_id_ciudad","Ciudad","required");
	
		if($this->form_validation->run() == TRUE)
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'descripcion_producto' 	=>strtoupper($_POST['edit_descripcion_producto']) ,
				'estado' => "1"
	
			);
			if($this->Productos_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
						redirect(base_url()."Productos_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al intentar actualizar en la Base de Datos');
					redirect(base_url()."Productos_controller", "refresh");
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de validación al intentar actualizar');
			redirect(base_url()."Productos_controller", "refresh");
			//$this->edit($id);
		}
	}

		
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estado' => '3',
		);
		if($this->Productos_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente');
				//retornamos a la vista para que se refresque
				redirect(base_url()."Productos_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al intentar anular');
				redirect(base_url()."Productos_controller", "refresh");
			}
		
		
	}	
}
