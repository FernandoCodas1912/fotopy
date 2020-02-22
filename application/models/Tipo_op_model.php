<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_op_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function gettipo_operaciones(){
	//	$this->db->where("estServicio", "1");
		$resultados= $this->db->get("tipo_operacion");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("tipo_operacion", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getTipo_operacion($id){
		$this->db->where("id_tipo_op",$id);
		$resultado= $this->db->get("tipo_operacion");
		return $resultado->row();
	}
	//esto es para actualizar los empleados
	public function update($id, $data){
		$this->db->where("id_tipo_op", $id);
		return $this->db->update("tipo_operacion", $data);

	}
}