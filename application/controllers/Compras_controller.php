<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compras_controller extends CI_Controller
{
	//solo el constructor, para llamar a las clases que se van a utilizar
	public function __construct()
	{

		parent::__construct();
		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		//$this->load->model("Ventas_model"); // esto abre el modelo
		$this->load->model("Productos_model"); // esto abre el modelo
		$this->load->model("FormaCobro_model"); // esto abre el modelo
		$this->load->model("Proveedores_model"); // esto abre el modelo
		$this->load->model("Compras_model"); // esto abre el modelo
		$this->load->model("Empresas_model"); // esto abre el modelo
	}
	//esta funcion es la primera que se carga
	public function index()
	{
		//cargamos un array usando el modelo
		$data = array(
			'compras' => $this->Compras_model->getCompras(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('plantilla/menu_costado');
		$this->load->view('compras_view/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('compras_view/script_compras');
	}

	//funcion add para mostrar vistas
	public function add()
	{
		//cargamos un array usando el modelo
		$data = array(
			//'tipo_operaciones'=> $this->Tipo_op_model->gettipo_operaciones(),
			'formacobro' => $this->FormaCobro_model->getFormasCobros(),
			'proveedores' => $this->Proveedores_model->getProveedores(),
			'productos' => $this->Productos_model->getProductos(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('plantilla/menu_costado');
		$this->load->view('compras_view/add', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('compras_view/script_compras');
	}
	//funcion vista para mostrar detalles
	public function view($id)
	{
		//$id = $this->input->post("id"); //esto es el id que quiero ver.
		$data = array(
			'compra' => $this->Compras_model->getCompra($id),
			'detalles' => $this->Compras_model->getDetalleCompra($id),
			'formacobro' => $this->FormaCobro_model->getFormasCobros(),
			'proveedores' => $this->Proveedores_model->getProveedores(),
			'productos' => $this->Productos_model->getProductos(),
			//'empresa'=> $this->Empresas_model->getAll(),

		);

		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('plantilla/menu_costado');
		$this->load->view("compras_view/view", $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('compras_view/script_compras');

		//abrimos la vista view
	}
	public function imprimir($id)
	{
		$data = array(
			'compra'	=> $this->Compras_model->getCompra($id),
			'detalles'	=> $this->Compras_model->getDetalleCompra($id),
			'empresa'	=> $this->Empresas_model->getEmpresa()

		);
		$this->load->view("compras_view/print", $data);
	}

	public function store()
	{

		$id_proveedor = $this->input->post("id_proveedor");
		$idproductos = $this->input->post("idproductos");
		$cantidades = $this->input->post("cantidades");
		$precios = $this->input->post("precios");
		$importes = $this->input->post("importes");

		if (($id_proveedor != '') and ($idproductos != '')) {
			//recibimos las variables que necesiten ser formateadas 
			//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
			$this->form_validation->set_rules("serienrofactura", "Serie y Numero de la Factura", "required");
			//$this->form_validation->set_rules("Username", "Nombre de usuario", "required|is_unique[usuario.Username]");
			//$this->form_validation->set_rules('ClaveUsuario', 'Clave del Usuario', 'required|min_length[6]');
			//$this->form_validation->set_rules('RepiteClaveUsuario', 'Repetir Clave', 'required|min_length[6]|matches[ClaveUsuario]');

			//SI ESTA BIEN VALIDADO
			if ($this->form_validation->run() == TRUE) {
				//se reciben las variables y se guardan

				$data = array(
					//'DirUsuario' 		=>	strtoupper($_POST['DirUsuario']) ,//esto pasa a mayuscula
					//'nro_operacion'    		=>	$_POST['nro_op'] ,
					'id_proveedor' 			=>	$id_proveedor,
					'fecha' 				=>	$_POST['fecha'],
					'serienrocomprobante' 	=>	$_POST['serienrofactura'],
					'tipocomprobante' 		=>	$_POST['tipocomprobante'],
					'montototal' 			=>	$_POST['totales'],
					'id_formacobro' 		=>	$_POST['id_formacobro'],
					'id_usuario' 			=>	$this->session->userdata('idusuario'),
					'estado' 				=>	1
				);

				//guardamos los datos en la base de datos
				if ($this->Compras_model->save($data)) {
					//$this->session->set_flashdata('success', 'Movimiento Cab registrado correctamente!');
					$id_compra = $this->Compras_model->lastID();
					$this->save_detalles($id_compra, $idproductos, $cantidades, $precios, $importes);
					//si todo esta bien, emitimos mensaje
					//redireccionamos al controlador y refrescamos
					redirect(base_url() . "Compras_controller", "refresh");
				} else {
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Compra no registrada, error en la bd!');
					$this->add();
				}
			} else {
				$this->session->set_flashdata('error', 'Errores en la validacion, No se registra Serie y Nro Factura, reintente!');
				//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
				$this->add();
			}
		} else {
			$this->session->set_flashdata('error', 'Proveedor o Producto esta vacio!');
			//redirect(base_url()."Compras_controller/add", "refresh");
			//redirect(base_url()."Compras_controller/add");
			$this->add();
		}
	}

	protected function save_detalles($id_compra, $productos, $cantidades, $precios, $importes)
	{
		for ($i = 0; $i < count($productos); $i++) {
			$data = array(
				'id_producto'	=> $productos[$i],
				'id_compra' 	=> $id_compra,
				'cantidad' 		=> $cantidades[$i],
				'precio' 		=> $precios[$i],
				'importe' 		=> $importes[$i],
				'estado' 		=>	1
			);
			//guarda los datos en tabla detalle compra
			$this->Compras_model->save_detalle($data);
			//sumar la cantidad en tabla productos para aumentar el stock con la compra
			$this->updateProducto($productos[$i], $cantidades[$i]);
			$this->session->set_flashdata('success', 'Compra registrada correctamente!');
		}
	}
	protected function updateProducto($id_producto, $cantidad)
	{
		$productoActual = $this->Productos_model->getProducto($id_producto);
		$data = array(
			'stock'		=>  $productoActual->stock + $cantidad,
		);
		//actualiza el stock desde el modelo
		$this->Productos_model->update($id_producto, $data);
	}

	//metodo para llamar y cargar vista editar enviando id a editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'usuarios' => $this->Usuarios_model->getUsuario($id),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('usuarios_view/edit', $data);
		$this->load->view('template/footer_plugins');
	}

	//actualizamos 

	public function update()
	{
		$IdUsuario     	= $this->input->post("IdUsuario");
		$Username     	= $this->input->post("Username");
		$fechaUpdate    = date("Y-m-d H:i:s");

		//traemos datos para no duplicarlos
		$Username_actual = $this->Usuarios_model->getUsuario($IdUsuario);

		if ($Username == $Username_actual->Username) {
			$unique = '';
		} else {
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[usuario.Username]';
		}
		//validar
		$this->form_validation->set_rules("Username", "Nombre de Usuario", "required" . $unique);

		if ($this->form_validation->run()) {
			//indicar campos de la tabla a modificar
			$data = array(
				'NomApeUsuario' 	=>	strtoupper($_POST['NomApeUsuario']),
				'Username'    		=>	$_POST['Username'],
				'DirUsuario' 		=>	strtoupper($_POST['DirUsuario']),
				'TelUsuario' 		=>	$_POST['TelUsuario'],
				'NivelUsuario' 		=>	$_POST['NivelUsuario'],
				'EstUsuario' 		=>	$_POST['EstUsuario'],
				'UltModUsuario'		=>  $fechaUpdate
			);
			if ($this->Usuarios_model->update($IdUsuario, $data)) {
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url() . "Usuarios_controller", "refresh");
			} else {
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url() . "Usuarios_controller/edit/" . $IdUsuario);
			}
		} else {
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->edit($IdUsuario);
		}
	}

	//funcion para borrar
	public function delete($id)
	{

		$data = array(
			'detalle_compra' => $this->Compras_model->getDetalleCompra($id),
		);

		if ($this->Compras_model->getDetalleCompra($id)) {
			//tengo que restar prod

			//$this->session->set_flashdata('success', 'Actualizado correctamente!');
			//redirect(base_url()."Compras_controller", "refresh");
		} else {
			//	$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			//redirect(base_url()."Compras_controller/edit/".$IdUsuario);
		}
		$data = array(
			'estado' => '3',
		);
		if (($this->Compras_model->update($id, $data)) and ($this->Compras_model->updatedetalle($id, $data))) {
			//al anular debe restar el stock sumado
			//para ello buscar del id compra detalle, traer todos los productos

			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Compras_controller", "refresh");
			//echo "Ventas_controller/";

		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Compras_controller/list/" . $id);
		}
	}
}