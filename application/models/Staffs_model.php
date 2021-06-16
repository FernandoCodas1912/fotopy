<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staffs_model extends CI_Model
{
	//estos son metodos q tienen q ver con bd

	//este metodo es para mostrar todos los registros
	public function getStaffs()
	{
		$this->db->select("s.*, cd.descripcion as ciudad"); //selecc campos
		$this->db->from("staff s"); //desde tabla con alias
		$this->db->join("ciudad cd", "cd.id_ciudad=s.id_ciudad"); //une los campos por su pk=fk
		//$this->db->where("c.estado", "1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	//esto es una funcion o metodo para mostrar 1 registro por id
	public function getStaff($id)
	{
		$this->db->select("c.*, cd.descripcion as ciudad"); //selecc campos
		$this->db->from("staff s"); //desde tabla con alias
		$this->db->join("ciudad cd", "cd.id_ciudad=s.id_ciudad"); //une los campos por su pk=fk
		// $this->db->join("paises p", "p.id=c.id_pais"); //une los campos por su pk=fk
		$this->db->where("id_staff", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("staff", $data);
	}

	//esto es para actualizar
	public function update($id, $data)
	{
		$this->db->where("id_staff", $id);
		return $this->db->update("staff", $data);
	}
}
