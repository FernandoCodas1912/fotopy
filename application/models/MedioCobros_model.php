<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedioCobros_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los registros de la tabla
	public function getMedioCobros(){
		$this->db->select("*"); //selecc campos  "e.*, c.descripcion as categoria"
		$this->db->from("medio_cobro"); //desde tabla con alias
		// $this->db->join("categoria c", "c.id_categoria=p.id_categoria");//une los campos por su pk=fk
		//$this->db->where("p.estado", "1");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
	public function getMedioCobro($id){
		$this->db->where("id_mediocobro",$id);
		$resultado= $this->db->get("medio_cobro");
		return $resultado->row();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("medio_cobro", $data);
	}
	
	
	//esto es para actualizar los datos de la tabla
	public function update($id, $data){
		$this->db->where("id_mediocobro", $id);
		return $this->db->update("medio_cobro", $data);
	}
}