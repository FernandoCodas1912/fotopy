<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller
{
	//solo el constructor, para llamar a las clases que se van a utilizar
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model("Usuarios_model"); // esto abre el modelo
		$this->load->model("Perfiles_model"); // esto abre el modelo
		$this->load->model("Empleados_model"); // esto abre el modelo
	}
	//esta funcion es la primera que se carga
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'usuarios'=> $this->Usuarios_model->getUsuarios(),
			'perfiles'=> $this->Perfiles_model->getPerfiles(),
			'empleados'=> $this->Empleados_model->getEmpleados(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		
		$this->load->view('usuarios/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('usuarios/script_usuarios');

	}
	
	
	//funcion vista
	public function view($id)
	{
		$data = array (
			'usuarios'=> $this->Usuarios_model->getUsuario($id)
		);
		//abrimos la vista view
		$this->load->view("usuarios/view", $data);
	}
	
	public function store()
	{

		if(isset($_POST['username']))
		{
			//recibimos las variables que necesiten ser formateadas 
			$FechaAltaUSuario = date("Y-m-d H:i:s");

			//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
			$this->form_validation->set_rules("id_empleado", "Empleado", "required");
			$this->form_validation->set_rules("id_perfil", "Tipo usuario", "required");
			$this->form_validation->set_rules("username", "Nombre de usuario", "required|is_unique[usuario.username]");
			$this->form_validation->set_rules('clave', 'Clave del Usuario', 'required|min_length[6]');
			$this->form_validation->set_rules('repetirclave', 'Repetir Clave', 'required|min_length[6]|matches[clave]');

			//SI ESTA BIEN VALIDADO
			if($this->form_validation->run() == TRUE)
			{
				//se reciben las variables y se guardan
				$data = array(
					'id_empleado' 		=>	$_POST['id_empleado'] ,
					'username'    		=>	$_POST['username'] ,
					'id_tipo_usuario' 		=>	$_POST['id_perfil'] ,
					'date_add'		 	=>	$FechaAltaUSuario,
					'estado'	 		=>	1 ,
					'password'				=>	sha1($_POST['clave'])
					//'DirUsuario' 		=>	strtoupper($_POST['DirUsuario']) ,
					//'NivelUsuario' 		=>	$_POST['NivelUsuario'] ,
					//'NivelUsuario' 		=>	1 ,
				//	'ClaveUsuario'		=>	md5($_POST['ClaveUsuario'])
				);
				//guardamos los datos en la base de datos
				if($this->Usuarios_model->save($data))
				{
					//si todo esta bien, emitimos mensaje
					$this->session->set_flashdata('success', 'Usuario registrado correctamente!');
					//redireccionamos al controlador y refrescamos
					redirect(base_url()."Usuarios_controller", "refresh");
				}
				else
				{
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Usuario no registrado error bd!');
						redirect("Usuarios_controller", "refresh");
				}

			}else{
				$this->session->set_flashdata('error', 'Errores en la validacion, reintente!');
				//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
				redirect("Usuarios_controller", "refresh");
				//$this->add();
			}
		}
	}


	//metodo para llamar y cargar vista editar enviando id a editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'usuarios'=> $this->Usuarios_model->getUsuario($id),
			'perfiles'=> $this->Perfiles_model->getPerfiles(),
			'empleados'=> $this->Empleados_model->getEmpleados(),
	
		);
		$this->load->view('usuarios/edit', $data);
	}

	//actualizamos 
	
	public function update()
	{
		$edit_id_usuario     	= $this->input->post("edit_id_usuario");
		$edit_username     	= $this->input->post("edit_username");
	
		 //traemos datos para no duplicarlos
		$Username_actual = $this->Usuarios_model->getUsuario($edit_id_usuario);

		 if($edit_username == $Username_actual->username)
		 {
		 	$unique = '';
		 }
		 else
		 {	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[usuario.username]';
		 }
		//validar
		$this->form_validation->set_rules("edit_username", "Nombre de Usuario", "required".$unique);

		if($this->form_validation->run() == TRUE)
		{
			//indicar campos de la tabla a modificar
			$data = array(
					//'NomApeUsuario' 	=>	strtoupper($_POST['NomApeUsuario']),
					'username'    		=>	$_POST['edit_username'] ,
					//'DirUsuario' 		=>	strtoupper($_POST['DirUsuario']) ,
					'id_tipo_usuario' 		=>	$_POST['edit_id_perfil'] ,
					'id_empleado' 		=>	$_POST['edit_id_empleado'] ,
					//'UltModUsuario'		=>  $fechaUpdate
					'estado' 		=>	1 
			);
			if($this->Usuarios_model->update($edit_id_usuario,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."Usuarios_controller", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."Usuarios_controller/edit/".$edit_id_usuario);
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->edit($edit_id_usuario);
		}
	}
	
	//funcion para borrar
	public function delete($id){
		$data = array(
			'estado' => '3',
		);
		if($this->Usuarios_model->update($id,$data))
		{
				//retornamos a la vista para que se refresque
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			redirect(base_url()."Usuarios_controller", "refresh");
		
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."Usuarios_controller");
		}
		
		
	}
}