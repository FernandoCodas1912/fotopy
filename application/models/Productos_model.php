<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los registros de la tabla
	public function getProductos(){
		$this->db->select("p.*, c.descripcion as categoria"); //selecc campos
		$this->db->from("productoservicio p"); //desde tabla con alias
		$this->db->join("categoria c", "c.id_categoria=p.id_categoria");//une los campos por su pk=fk
		//$this->db->where("p.estado", "1");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
	public function getProducto($id){
		$this->db->where("id_producto",$id);
		$resultado= $this->db->get("productoservicio");
		return $resultado->row();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("productoservicio", $data);
	}
	
	
	//esto es para actualizar los datos de la tabla
	public function update($id, $data){
		$this->db->where("id_producto", $id);
		return $this->db->update("productoservicio", $data);
	}
}