<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cobranzas_controller extends CI_Controller
{
	//solo el constructor, para llamar a las clases que se van a utilizar
	public function __construct()
	{

		parent::__construct();
		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Cobranzas_model"); // esto abre el modelo
		$this->load->model("Tipo_op_model"); // esto abre el modelo
		$this->load->model("FormaPago_model"); // esto abre el modelo
		$this->load->model("Clientes_model"); // esto abre el modelo
		$this->load->model("Servicios_model"); // esto abre el modelo
		$this->load->model("Empresas_model"); // esto abre el modelo
		$this->load->model("Comprobantes_model"); // esto abre el modelo
	}
	//esta funcion es la primera que se carga
	public function index()
	{
		//cargamos un array usando el modelo
		$data = array(
			'cobranzas' => $this->Cobranzas_model->getCobranzas(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('cobranzas/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cobranzas/script_cobranzas');
	}
	//funcion vista para mostrar detalles
	public function view($id)
	{
		//$id = $this->input->post("id"); //esto es el id que quiero ver.
		$data = array(
			'cobranza' => $this->Cobranzas_model->getCobranza($id),
			'detalles' => $this->Ventas_model->getDetalleVenta($id),
			'formapago' => $this->FormaPago_model->getFormaspagos(),
			'clientes' => $this->Clientes_model->getClientes(),
			'servicios' => $this->Servicios_model->getServicios(),
			//'empresa'=> $this->Empresas_model->getAll(),

		);

		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view("cobranzas/view", $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cobranzas/script_cobranza');

		//abrimos la vista view
	}

	public function imprimir($id)
	{
		$data = array(
			'cobranza'	=> $this->Cobranzas_model->getCobranza($id),
			'detalles'	=> $this->Ventas_model->getDetalleVenta($id),
			'empresa'	=> $this->Empresas_model->getEmpresa()

		);
		$this->load->view("cobranzas/print", $data);
	}
	//funcion add para mostrar vistas
	public function add()
	{
		//cargamos un array usando el modelo
		$data = array(
			//'tipo_operaciones'=> $this->Tipo_op_model->gettipo_operaciones(),
			'cobranza' => $this->Cobranzas_model->getCobranzas(),
			'formapago' => $this->FormaPago_model->getFormaspagos(),
			'clientes' => $this->Clientes_model->getClientes(),
			'servicios' => $this->Servicios_model->getServicios(),
			'comprobantes' => $this->Comprobantes_model->getComprobantes(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('cobranzas/add', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cobranzas/script_cobranzas');
	}

	public function store()
	{
		$id_cliente = $this->input->post("id_cliente");
		$idproductos = $this->input->post("idproductos");
		$cantidades = $this->input->post("cantidades");
		$precios = $this->input->post("precios");
		$importes = $this->input->post("importes");
		$tipocomprobante = $this->input->post("tipo_comprobante");
		$nrocomprobante = $this->input->post("nro_op");

		if (($idproductos != '') and ($id_cliente != '') and ($cantidades != '')) {
			//recibimos las variables que necesiten ser formateadas 
			$fecha_mov = date("Y-m-d");

			//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
			$this->form_validation->set_rules("nro_op", "Nro. Op", "required");

			//SI ESTA BIEN VALIDADO
			if ($this->form_validation->run() == TRUE) {
				//se reciben las variables y se guardan

				$data = array(
					//'DirUsuario' 		=>	strtoupper($_POST['DirUsuario']) ,//esto pasa a mayuscula
					'id_cliente' 		=>	$_POST['id_cliente'],
					'fecha' 			=>	$_POST['fecha'],
					'nrocomprobante'    =>	$nrocomprobante,
					'seriecomprobante'  =>	$_POST['serie_comprobante_venta'],
					'total' 			=>	$_POST['totales'],
					'id_formapago' 		=>	$_POST['id_formapago'],
					'tipocomprobante' 	=>  $tipocomprobante,
					'id_usuario' 		=>	$this->session->userdata('id_usuario'),
					'tipoventa' 			=>	2,
					'estado' 			=>	1
				);


				//guardamos los datos en la base de datos
				if ($this->Ventas_model->save($data)) {
					$id_venta = $this->Ventas_model->lastID();
					$this->updateComprobante($tipocomprobante, $nrocomprobante);
					$this->save_detalles($id_venta, $idproductos, $cantidades, $precios, $importes);
					//$this->session->set_flashdata('success', 'Venta  registrada..!');
					redirect(base_url() . "Ventas_controller", "refresh");
				} else {
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Venta no registrada error bd!');
					$this->add();
					//	redirect("usuarios_view/list", "refresh");
				}
			} else {
				$this->session->set_flashdata('error', 'Errores en la validacion, reintente!');
				//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
				$this->add();
			}
		} else {
			$this->session->set_flashdata('error', 'Cantidad, Cliente o Producto esta Vacio!');
			//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
			$this->add();
		}
	}
	protected function updateComprobante($tipocomprobante, $nrocomprobante)
	{
		$data = array(
			'ultimo_nro' => $nrocomprobante,
		);

		if (!$this->Comprobantes_model->update($tipocomprobante, $data)) {

			$this->session->set_flashdata('error', 'Ultimo Nro Comprobante ' . $nrocomprobante . ' con errores!');
		}
	}
	protected function save_detalles($id_venta, $productos, $cantidades, $precios, $importes)
	{
		for ($i = 0; $i < count($cantidades); $i++) {
			$data = array(
				'id_producto'	=> $productos[$i],
				'id_venta' 		=> $id_venta,
				'cantidad' 		=> $cantidades[$i],
				'precio' 		=> $precios[$i],
				'importe' 		=> $importes[$i],
				'estado' 		=>	1
			);
			//if($this->Ventas_model->save_detalle($data))
			//	{	
			$this->Ventas_model->save_detalle($data);
			$this->updateProducto($productos[$i], $cantidades[$i]);
			$this->session->set_flashdata('success', 'Venta Nro ' . $id_venta . ' registrado correctamente!');
			//redirect("Ventas_controller", "refresh");
			//}
			//else
			//{
			//si hubo errores, mostramos mensaje
			//	$this->session->set_flashdata('error', 'Venta detalle no registrada error bd!');
			//	$this->add();
			//}
		}
	}
	protected function updateProducto($id_producto, $cantidad)
	{
		$productoActual = $this->Servicios_model->getServicio($id_producto);
		$data = array(
			'stock'		=>  $productoActual->stock - $cantidad,
		);
		//actualiza el stock desde el modelo
		$this->Servicios_model->update($id_producto, $data);
	}

	//funcion add para mostrar vistas
	public function reporte()
	{
		//cargamos un array usando el modelo
		$data = array(
			'clientes' => $this->Clientes_model->getClientes(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('ventas/reporte', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');
	}
	public function generarreporte()
	{
		if (isset($_POST['fechaini'])) {
			$fecha_ini = $_POST['fechaini'];
		}
		if (isset($_POST['fechafin'])) {
			$fecha_fin = $_POST['fechafin'];
		}
		if (isset($_POST['id_cliente'])) {
			$id_cliente = $_POST['id_cliente'];
		}


		//$fecha_ini2=date_format( new DateTime($fecha_ini), 'Y-m-d');
		//$fecha_fin2=date_format( new DateTime($fecha_fin), 'Y-m-d');
		$where = "1=1";

		if ($fecha_ini != "") {
			$where .= " AND v.fecha >='$fecha_ini'";
		}
		if ($fecha_fin != "") {
			$where .= " AND v.fecha <='$fecha_fin'";
		}
		if ($id_cliente != "") {
			$where .= " AND cl.id_cliente ='$id_cliente'";
		}
		//cargamos un array usando el modelo
		$data = array(
			//'tipo_operaciones'=> $this->Tipo_op_model->gettipo_operaciones(),
			'reporteventas' => $this->Ventas_model->getReporte($where),
			'clientes' => $this->Clientes_model->getClientes(),
			//	'productos'=> $this->Productos_model->getProductos(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('ventas/reporte', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');
	}


	//funcion para borrar
	public function delete($id)
	{

		$databd = $this->Clientes_model->getById($id);
		if ($databd->estado == 3) {
			$this->session->set_flashdata('error', 'Ya estaba anulado previamente!');
			redirect(base_url() . "Clientes_controller", "refresh");
		}

		$data = array(
			'detalle_venta' => $this->Ventas_model->getDetalleVenta($id),
		);

		if ($this->Ventas_model->getDetalleVenta($id)) {
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
		if (($this->Ventas_model->update($id, $data)) and ($this->Ventas_model->updatedetalle($id, $data))) {
			//al anular debe restar el stock sumado
			//para ello buscar del id compra detalle, traer todos los productos

			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Ventas_controller", "refresh");
			//echo "Ventas_controller/";

		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Ventas_controller/list/" . $id);
		}
	}
}