<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_model extends CI_Model
{
	//estos son metodos q tienen q ver con bd

	//este metodo es para mostrar todos los empleado
	public function getVentas()
	{
		$this->db->select("v.*, c.razonsocial as nombre, f.descripcion as formadepago");
		$this->db->from("venta v");
		$this->db->join("cliente c", "c.id_cliente=v.id_cliente");
		$this->db->join("formapago f", "f.id_formapago=v.id_formapago");
		//	$this->db->where("estServicio", "1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getPresupuestos()
	{
		$this->db->select("v.*, c.razonsocial as nombre, f.descripcion as formadepago");
		$this->db->from("venta v");
		$this->db->join("cliente c", "c.id_cliente=v.id_cliente");
		$this->db->join("formapago f", "f.id_formapago=v.id_formapago");
		$this->db->where("tipoventa", "1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("venta", $data);
	}
	//esta es la parte para guardar en la bd
	public function getVenta($id)
	{
		$this->db->select("v.*, c.razonsocial as cliente, c.nrodocumento as nrodocumento, c.telefono as telefono, c.direccion as direccion,f.descripcion as formadepago");
		$this->db->from("venta v");
		$this->db->join("cliente c", "c.id_cliente=v.id_cliente");
		$this->db->join("formapago f", "f.id_formapago=v.id_formapago");
		$this->db->where("v.id_venta", $id);
		$resultados = $this->db->get();
		return $resultados->row(); //modifico marcelo row en vez  de result
	}
	//get detalles de venta
	public function getDetalleVenta($id)
	{
		$this->db->select("dv.*, p.id_producto, p.codigobarra as codigobarra, p.descripcion as producto");
		$this->db->from("detalle_venta dv");
		$this->db->join("producto_servicio p", "p.id_producto=dv.id_producto"); //modifico marcelo
		//$this->db->join("productos_servicio p", "p=id_producto=dm.fk_id_producto"); 
		$this->db->where("dv.id_venta", $id); //modifico marcelo
		//$this->db->where("dm.id_movimiento",$id);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	//esta es la parte para guardar en la bd
	public function lastID()
	{
		return $this->db->insert_id();
	}


	public function update($id, $data)
	{
		$this->db->where("id_venta", $id);
		return $this->db->update("venta", $data);
	}

	public function updatedetalle($id, $data)
	{
		$this->db->where("id_venta", $id);
		return $this->db->update("detalle_venta", $data);
	}
	//esto es para actualizar los empleados
	public function save_detalle($data)
	{
		return $this->db->insert("detalle_venta", $data);
		//return $this->db->update("cliente", $data);
	}

	public function getReporte($where)
	{
		$this->db->select("v.fecha, v.total, cl.razonsocial, u.username, f.descripcion");
		$this->db->from("venta v");
		$this->db->join("cliente cl", "v.id_cliente=cl.id_cliente");
		$this->db->join("usuario u", "v.id_usuario=u.id_usuario");
		$this->db->join("formapago f", "v.id_formapago=f.id_formapago");
		$this->db->where($where);
		$resultados = $this->db->get();
		return $resultados->result();
		//	return $resultados->row();// row en vez  de result
	}
}
