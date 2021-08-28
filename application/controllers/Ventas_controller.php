<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_controller extends CI_Controller
{
	//solo el constructor, para llamar a las clases que se van a utilizar
	public function __construct()
	{

		parent::__construct();
		// si no esta logueado redireccionar a base url
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		//verificamos apertura caja
		$this->load->model('Cajas_model'); // esto abre el modelo

		$username = $this->session->userdata('username');
		$id_caja = $this->session->userdata('id_caja');
		$caja =  $this->Cajas_model->getAperturaCierre($username, $id_caja);
		if (!$caja->estadocaja || $caja->estadocaja == 2) {
			$this->session->set_flashdata('error', 'No se puede Realizar Operaciones de Caja sin antes realizar la Apertura de Caja, Complete los datos abajo y Abra la Caja');
			redirect(base_url() . 'Dashboard_controller');
		}


		$this->load->model("Ventas_model"); // esto abre el modelo
		$this->load->model("FormasPago_model"); // esto abre el modelo
		$this->load->model("Clientes_model"); // esto abre el modelo
		$this->load->model("Servicios_model"); // esto abre el modelo
		$this->load->model("Productos_model"); // esto abre el modelo
		$this->load->model("Empresas_model"); // esto abre el modelo
		$this->load->model("Comprobantes_model"); // esto abre el modelo
		$this->load->model("Movimientos_model"); // esto abre el modelo
	}
	//esta funcion es la primera que se carga
	public function index()
	{
		//cargamos un array usando el modelo
		$data = array(
			'ventas' => $this->Ventas_model->getVentas(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('ventas/list', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');
	}
	//funcion vista para mostrar detalles
	public function view($id)
	{
		//$id = $this->input->post("id"); //esto es el id que quiero ver.
		$data = array(
			'venta' => $this->Ventas_model->getVenta($id),
			'detalles' => $this->Ventas_model->getDetalleVenta($id),
			'formapago' => $this->FormasPago_model->getAll(),
			'clientes' => $this->Clientes_model->getAll(),
			'servicios' => $this->Servicios_model->getAll(),


		);

		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view("ventas/view", $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');

		//abrimos la vista view
	}

	public function imprimir($id)
	{
		$data = array(
			'venta'	=> $this->Ventas_model->getVenta($id),
			'detalles'	=> $this->Ventas_model->getDetalleVenta($id),
			'empresa'	=> $this->Empresas_model->getEmpresa()

		);

		$this->load->view("ventas/print", $data);
		$this->load->view('ventas/script_ventas');
	}
	//funcion add para mostrar vistas
	public function add()
	{
		//cargamos un array usando el modelo
		$data = array(
			'formapago' => $this->FormasPago_model->getAll(),
			'clientes' => $this->Clientes_model->getAll(),
			'productos_servicios' => $this->Servicios_model->getAllProductosServicios(),
			'comprobantes' => $this->Comprobantes_model->getAll(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('ventas/add', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');
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
			$condicion = 	$_POST['condicion'];

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
					'tipoventa' 			=>	2, // 1 presupuesto, 2 venta
					'condicionventa' 		=> $condicion,
					'estado' 			=>	1
				);


				//guardamos los datos en la base de datos
				if ($this->Ventas_model->save($data)) {
					$id_venta = $this->Ventas_model->lastID();
					$this->updateComprobante($tipocomprobante, $nrocomprobante);
					$this->save_detalles($id_venta, $idproductos, $cantidades, $precios, $importes);
					//preparamos para insertar movimiento en caja
					$id_operacion = $id_venta;
					$id_motivo = 13; //ingreso por ventas
					$tipo_movimiento = 1; //1= es ingreso 2 = es egreso
					$obs_movimiento = "Ingreso - por Venta # " . $id_venta;
					$importe_movimiento = $_POST['totales'];

					if ($condicion == 1) {
						//obtener saldo anterior
						$id_caja = $this->session->userdata('id_caja');
						$movimientos = $this->Movimientos_model->getSaldo($id_caja);

						if ($movimientos) {
							$saldo = $movimientos->saldo_movimiento +  $importe_movimiento;
						} else {
							$saldo = $importe_movimiento;
						}

						$this->insertar_movimiento($id_operacion, $id_motivo, $tipo_movimiento, $importe_movimiento, $obs_movimiento, $saldo);
					}

					echo json_encode(
						array(
							"status"     => "success",
							"message" => "La Venta ha sido guardada sin Errores ",
						)
					);
				} else {
					echo json_encode(
						array(
							"status" => "ERROR al intentar guardar la Venta",
						)
					);
				}
			} else {
				$this->session->set_flashdata('error', 'Errores en la validacion, reintente!');
				//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
				redirect("Ventas_controller/add", "refresh");
			}
		} else {
			$this->session->set_flashdata('error', 'Cantidad, Cliente o Producto esta Vacio!');
			//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
			redirect("Ventas_controller/add", "refresh");
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
			$operacion = 'resta';
			$this->Ventas_model->save_detalle($data);
			$this->updateStock($productos[$i], $cantidades[$i], $operacion);
			$this->session->set_flashdata('success', 'Venta Nro ' . $id_venta . ' registrado correctamente!');
		}
	}

	protected function updateStock($id_producto, $cantidad, $operacion)
	{
		$productoActual = $this->Productos_model->getById($id_producto);

		//solo si es producto se toca stock
		if ($productoActual->tipo == 1) { //tipo 1 es producto tipo2 es servicio

			if ($operacion == 'resta') {
				$stock = $productoActual->stock - $cantidad;
			} elseif ($operacion == 'suma') {
				$stock = $productoActual->stock + $cantidad;
			}
			$data = [
				'stock' => $stock,
			];

			//actualiza el stock desde el modelo
			if ($this->Productos_model->update($id_producto, $data)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	//funcion add para mostrar vistas
	public function reporte()
	{
		//cargamos un array usando el modelo
		$data = array(
			'clientes' => $this->Clientes_model->getAll(),
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
			'clientes' => $this->Clientes_model->getAll(),
			//	'productos'=> $this->Productos_model->getProductos(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('ventas/reporte', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('ventas/script_ventas');
	}



	//funcion para anular venta
	public function delete($id)
	{

		$venta = $this->Ventas_model->getVenta($id);
		$detalles = $this->Ventas_model->getDetalleVenta($id);
		$operacion = 'suma';
		foreach ($detalles  as $key => $value) {
			//al anular debe restar el stock sumado
			if ($this->updateStock($value->id_producto, $value->cantidad, $operacion)) {
				$this->session->set_flashdata('success', 'Stock Actualizado correctamente!');
			} else {
				$this->session->set_flashdata('error', 'Error al Intentar Actualizar el stock!');
			}
		}
		$data = [
			'estado' => '3',
		];

		if (($this->Ventas_model->update($id, $data)) and ($this->Ventas_model->updatedetalle($id, $data))) {

			//insertar movimiento
			$id_operacion = $id;
			$id_motivo = 17; //Salida - Anulacion de una Venta
			$tipo_movimiento = 2; //1= es ingreso 2 = es egreso
			$importe_movimiento = $venta->total;
			$obs_movimiento = "Salida - Anulacion de Venta #" . $id;

			//obtener saldo anterior


			if ($venta->condicionventa == 1) {
				$id_caja = $this->session->userdata('id_caja');
				$movimientos = $this->Movimientos_model->getSaldo($id_caja);

				if ($movimientos) {
					$saldo = $movimientos->saldo_movimiento -  $importe_movimiento;
				} else {
					$saldo = $importe_movimiento;
				}

				$insertar_movimiento = $this->insertar_movimiento($id_operacion, $id_motivo, $tipo_movimiento, $importe_movimiento, $obs_movimiento, $saldo);
			}

			// echo json_encode(
			// 	array(
			// 		"status"     => "success",
			// 		"message" => "La venta se ha anulado ",
			// 	)
			// );

			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Ventas_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Ventas_controller/list/" . $id);
			// echo json_encode(
			// 	array(
			// 		"status"     => "error",
			// 		"message" => "ERROR EN LA BD",
			// 	)
			// );
		}
	}





	//insertamos las operaciones en movimientos
	public function insertar_movimiento($id_operacion, $id_motivo, $tipo_movimiento, $importe_movimiento, $obs_movimiento, $saldo)
	{
		$id_caja = $this->session->userdata('id_caja');
		$id_usuario = $this->session->userdata('id_usuario');

		$data_movimiento = array(
			'id_operacion'       	=> $id_operacion,
			'id_motivo'       		=> $id_motivo,
			'id_caja'       		=> $id_caja,
			'id_usuario'  			=>  $id_usuario,
			'fecha_hora'    		=> date('Y-m-d H:i:s'),
			'tipo_movimiento'   	=> $tipo_movimiento,
			'obs_movimiento'     	=> $obs_movimiento,
			'importe_movimiento' 	=> $importe_movimiento,
			'saldo_movimiento'      => $saldo,
			'estado'       			=> 1,

		);

		if ($this->Movimientos_model->save($data_movimiento)) {
			return true;
		} else {
			return false;
		}
	}
}