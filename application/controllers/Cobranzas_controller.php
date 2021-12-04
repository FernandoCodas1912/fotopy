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
		$this->load->model("Ventas_model"); // esto abre el modelo
		$this->load->model("FormasPago_model"); // esto abre el modelo
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
		$cobranza = $this->Cobranzas_model->getCobranza($id);
		$venta = $this->Ventas_model->getVenta($cobranza->id_venta);
		$otras_cobranzas = $this->Cobranzas_model->getCobranzaByVenta($cobranza->id_venta);
		$detalle_venta = $this->Ventas_model->getDetalleVenta($cobranza->id_venta);

		$data = array(
			'cobranza' => $cobranza,
			'otras_cobranzas' => $otras_cobranzas,
			'venta' => $venta,
			'detalles' => $detalle_venta,
			// 'clientes' => $this->Clientes_model->getById()
		);

		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view("cobranzas/view", $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cobranzas/script_cobranzas');

		//abrimos la vista view
	}


	// funcion para realizar cobros

	public function cobrar()
	{
		$idpersona = $this->input->post("id_persona");
		$IdFormaPago = $this->input->post("IdFormaPago");
		$id_operacion = $this->input->post("id_operacion");
		$total_operacion = $this->input->post("total_operacion");
		// procesar, guardar en cobros, guardar en cta cte, generar movimiento
		//preparamos para insertar movimiento en caja
		$id_motivo = 15; //Ingreso - Por Cobro de Cuotas Cred.
		$tipo_movimiento = 1; //1= es ingreso 2 = es egreso
		$obs_movimiento = "Ingreso - por Venta # " . $id_operacion;
		$importe_movimiento = $_POST['totales'];

		// if ($condicion == 1) {
		// 	//obtener saldo anterior
		// 	$id_caja = $this->session->userdata('id_caja');
		// 	$movimientos = $this->Movimientos_model->getSaldo($id_caja);

		// 	if ($movimientos) {
		// 		$saldo = $movimientos->saldo_movimiento +  $importe_movimiento;
		// 	} else {
		// 		$saldo = $importe_movimiento;
		// 	}

		//	$movimiento =  	$this->insertar_movimiento($id_operacion, $id_motivo, $tipo_movimiento, $importe_movimiento, $obs_movimiento, $saldo);
		// }
		$movimiento = 1;
		if ($movimiento) {

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
	}

	//funcion add para mostrar vistas
	public function add()
	{
		//cargamos un array usando el modelo
		$data = array(
			//'tipo_operaciones'=> $this->Tipo_op_model->gettipo_operaciones(),
			'cobranza' => $this->Cobranzas_model->getCobranzas(),
			'formapago' => $this->FormasPago_model->getAll(),
			'clientes' => $this->Clientes_model->getClientePendientes(),
			'ventas' => $this->Ventas_model->getVentas(),
			'servicios' => $this->Servicios_model->getAll(),
			'comprobantes' => $this->Comprobantes_model->getAll(),
		);
		$this->load->view('plantilla/header');
		$this->load->view('plantilla/menu');
		$this->load->view('cobranzas/add', $data);
		$this->load->view('plantilla/footer_plugins');
		$this->load->view('cobranzas/script_cobranzas');
	}

	public function store()
	{
		//recibimos las variables que necesiten ser formateadas 
		$id_cliente = $this->input->post("id_cliente");
		$id_venta = $this->input->post("id_venta");
		$id_formapago = $this->input->post("id_formapago");
		$monto_entregado = $this->input->post("monto_entregado");
		$total_venta = $this->input->post("total_venta");

		if($monto_entregado > 0){

			if (($id_cliente != '') and ($id_venta != '')) {
				$fecha_mov = date("Y-m-d");

				$estado = 2; // total
				
				$total_cobrado = $this->Cobranzas_model->getPagos($id_venta);
				$total_cobrado = $total_cobrado + $monto_entregado;
				$vuelto = $total_cobrado - $total_venta;

				if($total_cobrado < $total_venta){
					/**
					 * solamente si la suma del 
					 * (monto entregado por el cliente + montos cobrados anteriormente) 
					 * es menor al total pendiente, 
					 * el estado del registro es "parcial" y
					 * el vuelto es cero
					 */
					$estado = 1; // parcial
					$vuelto = 0;
				}else{
					// cambiar el estado de la venta a PAGADO
					// estado 1
					$data = [
						'estado' => '3',
					];
			
					$this->Ventas_model->update($id_venta, $data);
				}
				// $estado = 3; // anulado

				$data = array(
					'id_cliente' 	=> $id_cliente,
					'fecha' 		=> $fecha_mov,
					'monto' 		=> $monto_entregado,
					'id_formapago' 	=> $id_formapago,
					'cajero'	 	=> $this->session->userdata('id_usuario'),
					'id_venta'		=> $id_venta,
					'id_formapago'	=> $id_formapago,
					'estado'		=> $estado,
					'vuelto'		=> $vuelto
				);

				//guardamos los datos en la base de datos
				if ($this->Cobranzas_model->save($data)) {
					$id_venta = $this->Cobranzas_model->lastID();
					//$this->session->set_flashdata('success', 'Cobro registrado!');
					redirect(base_url() . "Cobranzas_controller", "refresh");
				} else {
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Cobro no registrado, error bd!');
					$this->add();
				}
	
			} else {
				//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
				$this->session->set_flashdata('error', 'Cantidad, Cliente o Producto esta Vacio!');
				$this->add();
			}
		}else{
			//si el monto entregado por el cliente es menor a cero, rellamamos al metodo add mas arriba detallado
			$this->session->set_flashdata('error', 'El monto entregado NO puede ser menor a CERO!');
			$this->add();
		}
	}


	//funcion para anular venta
	public function delete($id)
	{
		$cobranza = $this->Cobranzas_model->getCobranza($id);
		$pagos = $this->Cobranzas_model->getPagos($cobranza->id_venta, $id);
		$venta = $this->Ventas_model->getVenta($cobranza->id_venta);

		$cob_data = [
			'estado' => 3
		];
		
		if ($this->Cobranzas_model->update($id, $cob_data)) {
			
			if($pagos < $venta->total){
				/**
				 * si el resto de cobros es inferior al monto de venta, 
				 * se cambia de estado a 2
				 * NO PAGADO
				 */
				$data = [
					'estado' => '2',
				];
				$this->Ventas_model->update($cobranza->id_venta, $data);
			}
			
			$this->session->set_flashdata('success', 'Anulado correctamente!');
			//retornamos a la vista para que se refresque
			redirect(base_url() . "Cobranzas_controller", "refresh");
		} else {
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url() . "Cobranzas_controller/list/" . $id);
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

	// ajax para vista de cobranza
	public function clienteVentas()
	{
		$result['status'] = "fail";
		if (isset($_POST['id_cliente'])) {
			$id_cliente = $_POST['id_cliente'];
			$result['status'] = "success";
			$result['ventas'] = $this->Ventas_model->getVentasByCliente($id_cliente);
		}

		echo json_encode($result);
	}

	// ajax para vista de cobranza
	public function detallesVenta()
	{
		$result['status'] = "fail";
		if (isset($_POST['id_venta'])) {
			$id_venta = $_POST['id_venta'];
			$result['status'] = "success";
			$result['detalles'] = $this->Ventas_model->getDetalleVenta($id_venta);
		}

		echo json_encode($result);
	}
}