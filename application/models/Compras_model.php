<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model {
	
	//este metodo es para mostrar todos los campos de la tabla
	public function getCompras(){
		$this->db->select("c.*, p.razonsocial as proveedor, fc.descripcion as formacobro"); //selecc campos
		$this->db->from("compra c"); //desde tabla con alias
		$this->db->join("proveedor p", "c.id_proveedor=p.id_proveedor");//une los campos por su pk=fk
		$this->db->join("formacobro fc", "fc.id_formacobro=c.id_formacobro");
		//$this->db->where("c.estado", "1");// esto es para ver los activos solamente.
		$resultados= $this->db->get();
		return $resultados->result();
	}
	//esta es la funcion para mostrar 1 solo campo

	public function getCompra($id)
	{ 
		$this->db->select("c.*, p.razonsocial as proveedor, p.nrodocumento, p.telefono, p.email, p.direccion, fc.descripcion as formacobro");
		$this->db->from("compra c");
		$this->db->join("proveedor p", "c.id_proveedor=p.id_proveedor");
		$this->db->join("formacobro fc", "fc.id_formacobro=c.id_formacobro");
		$this->db->where("c.id_compra",$id);
		$resultados= $this->db->get();
		return $resultados->row();// row en vez  de result
	}
	//get detalles de compra
	public function getDetalleCompra($id)
	{
		$this->db->select("dc.*, ps.descripcion as producto, ps.codigobarra");
		$this->db->from("detallecompra dc");
		$this->db->join("productoservicio ps", "ps.id_producto=dc.id_producto");//union de dos tablas
		//$this->db->join("compra c", "c=id_compra=dc.id_compra"); 
		$this->db->where("dc.id_compra",$id);//where para identificar uno solo
		//$this->db->where("dm.id_movimiento",$id);
		$resultados= $this->db->get();
		return $resultados->result();
	}

	//esta es la parte para guardar en la bd
	public function lastID()
	{
		return $this->db->insert_id();
	}
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("compra", $data);
		echo $this->db->insert("compra", $data);
	}
	
	//esto es para actualizar los empleados
	public function update($id, $data){
		$this->db->where("id_compra", $id);
		return $this->db->update("compra", $data);
	}

	//esto es para actualizar los empleados
	public function updatedetalle($id, $data){
		$this->db->where("id_compra", $id);
		return $this->db->update("detallecompra", $data);

	}
	//esto es para actualizar los empleados
	public function save_detalle($data){
		$this->db->insert("detallecompra", $data);
		//return $this->db->update("cliente", $data);
	}
}