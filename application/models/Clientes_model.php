<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_model extends CI_Model
{
	//estos son metodos q tienen q ver con bd

	//este metodo es para mostrar todos los registros
	public function getClientes()
	{
		$this->db->select("c.*, cd.descripcion as ciudad"); //selecc campos
		$this->db->from("cliente c"); //desde tabla con alias
		$this->db->join("ciudad cd", "cd.id_ciudad=c.id_ciudad"); //une los campos por su pk=fk
		//$this->db->where("c.estado", "1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	//esto es una funcion o metodo para mostrar 1 registro por id
	public function getCliente($id)
	{
		$this->db->select("c.*, cd.descripcion as ciudad, p.nombre as pais"); //selecc campos
		$this->db->from("cliente c"); //desde tabla con alias
		$this->db->join("ciudad cd", "cd.id_ciudad=c.id_ciudad"); //une los campos por su pk=fk
		$this->db->join("paises p", "p.id=c.id_pais"); //une los campos por su pk=fk
		$this->db->where("id_cliente", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("cliente", $data);
	}

	//esto es para actualizar
	public function update($id, $data)
	{
		$this->db->where("id_cliente", $id);
		return $this->db->update("cliente", $data);
	}
}
