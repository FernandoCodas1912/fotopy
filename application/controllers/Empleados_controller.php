<?php
defined('BASEPATH') or exit('No direct script access allowed');
//se crea el controlador empleados
class Empleados_controller extends CI_Controller
{
	//constructor
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Empleados_model");
		$this->load->model("Cargos_model");
		$this->load->model("Ciudades_model");
		$this->load->model("Departamentos_model");
	}
	//carga una vista llamada list
	public function index()
	{
		$data = array(
			"empleados" => $this->Empleados_model->getAll(),
			"cargos" => $this->Cargos_model->getAllSelect(),
			"ciudades" => $this->Ciudades_model->getAll(),
			"departamentos" => $this->Departamentos_model->getAll(),

		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('empleados/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('empleados/script_empleados');
	}

	public function view($id)
	{
		$data = array(
			'empleados' => $this->Empleados_model->getById($id),
		);
		$this->load->view("empleados/view", $data);
	}

	public function store()
	{
		$this->form_validation->set_rules("nrodocumento", "Documento", "required|is_unique[empleados.nrodocumento]");
		$this->form_validation->set_rules("email", "Email", "required|is_unique[empleados.email]");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nomape' 		=> strtoupper($_POST['nomape']),
				'nrodocumento' 	=> $_POST['nrodocumento'],
				'telefono' 		=> $_POST['telefono'],
				'direccion' 	=> strtoupper($_POST['direccion']),
				'email' 		=> $_POST['email'],
				'id_ciudad' 	=> $_POST['id_ciudad'],
				'id_departamento' 	=> $_POST['id_departamento'],
				'salario' 		=> $_POST['salario'],
				'id_cargo' 		=> $_POST['id_cargo'],
				'estado' 		=> "1"
			);

			if ($this->Empleados_model->save($data)) {
				$this->session->set_flashdata("success", "Datos Guardados");
				redirect(base_url() . "Empleados_controller", "refresh");
			} else {
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url() . "Empleados_controller", "refresh");
			}
		} else {
			$this->session->set_flashdata("error", "Error de Validacion, datos duplicados");
			redirect(base_url() . "Empleados_controller", "refresh");
			//$this->store();
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$data = array(
			'empleados' => $this->Empleados_model->getById($id),
			"cargos" => $this->Cargos_model->getAllSelect(),
			"ciudades" => $this->Ciudades_model->getAll(),
			"departamentos" => $this->Departamentos_model->getAll(),
		);
		$this->load->view('empleados/edit', $data);
		$this->load->view('empleados/script_empleados');
	}

	//actualizamos 
	public function update()
	{
		//recibimos via post algunos datos para poder comparar en la bd
		$id   				   = $this->input->post("edit_id");
		$edit_nrodocumento	   = $this->input->post("edit_nrodocumento");

		//traemos datos para no duplicarlos
		$empleado = $this->Empleados_model->getById($id);
		//var_dump($empleado);
		if ($edit_nrodocumento == $empleado->nrodocumento) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[empleados.nrodocumento]';
		}
		//validar
		$this->form_validation->set_rules("edit_nrodocumento", "Documento", "required" . $unique);


		if ($this->form_validation->run() == TRUE) {
			//indicar campos de la tabla a modificar
			$data = array(
				'nomape' 		=> strtoupper($_POST['edit_nomape']),
				'nrodocumento' 	=> $_POST['edit_nrodocumento'],
				'telefono' 		=> $_POST['edit_telefono'],
				'direccion' 	=> strtoupper($_POST['edit_direccion']),
				'email' 		=> $_POST['edit_email'],
				'id_departamento' 	=> $_POST['id_departamento'],
				'id_ciudad' 	=> $_POST['edit_id_ciudad'],
				'salario' 		=> $_POST['edit_salario'],
				'id_cargo' 		=> $_POST['edit_id_cargo'],
				'estado' 		=> "1"
			);
			if ($this->Empleados_model->update($id, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Empleados_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar en la Bd!');
				redirect(base_url() . "Empleados_controller", "refresh");
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->session->set_flashdata('error', 'Errores de Validacion al Intentar Actualizar!');
			redirect(base_url() . "Empleados_controller", "refresh");
		}
	}


	//funcion para borrar
	public function delete($id)
	{
		$data = array(
			'estado' => '3',
		);
		if ($this->Empleados_model->update($id, $data)) {
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Empleados_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Empleados_controller", "refresh");
		}
	}
}