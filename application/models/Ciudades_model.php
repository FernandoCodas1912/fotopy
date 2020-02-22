<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudades_model extends CI_Model {
	
	
	//este metodo es para mostrar todos los campos de la tabla
	public function getCiudades(){
		$this->db->where("estado", "1");
		$resultados= $this->db->get("ciudad");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("ciudad", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 registro por id
	public function getUsuario($id){
		$this->db->where("id_ciudad",$id);
		$resultado= $this->db->get("ciudad");
		return $resultado->row();
	}
	//esto es para actualizar los registros
	public function update($id, $data){
		$this->db->where("id_ciudad", $id);
		return $this->db->update("ciudad", $data);

	}
}