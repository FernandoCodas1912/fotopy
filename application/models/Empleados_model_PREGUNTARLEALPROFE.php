<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	//este metodo es para mostrar todos los empleados
	public function getEmpleados(){
	//	$this->db->where("estServicio", "1");
		$resultados= $this->db->get("empleado");
		return $resultados->result();
	}
	public function getCargos(){
	//	$this->db->where("estServicio", "1");
		$resultados= $this->db->get("cargo_empleado");
		return $resultados->result();
	}
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("empleado", $data);
	}
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getEmpleado($id){
		$this->db->where("idEmpleado",$id);
		$resultado= $this->db->get("empleado");
		return $resultado->row();
	}
	//esto es para actualizar los empleados
	public function update($id, $data){
		$this->db->where("idEmpleado", $id);
		return $this->db->update("empleado", $data);
	}
}