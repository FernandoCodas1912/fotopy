<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empleados_model extends CI_Model
{

	public $tabla = 'empleados';
	public $idTabla = 'id_empleado';

	//esta funcion retorna todos los registros de nuestra tabla
	public function getAll()
	{
		$this->db->select('e.*, cd.descripcion as ciudad, ca.descripcion as cargo'); //selecc campos
		$this->db->from('empleados e'); //desde tabla con alias
		$this->db->join('ciudades cd', 'e.id_ciudad=cd.id_ciudad'); //une los campos por su pk=fk
		$this->db->join('cargos ca', 'e.id_cargo=ca.id_cargo'); //une los campos por su pk=fk
		//$this->db->where("c.estado", "1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	//esto es una funcion o metodo para mostrar 1 registro por id
	public function getbyId($id)
	{
		$this->db->select('e.*, cd.descripcion as ciudad, ca.descripcion as cargo'); //selecc campos
		$this->db->from('empleados e'); //desde tabla con alias
		$this->db->join('ciudades cd', 'e.id_ciudad=cd.id_ciudad'); //une los campos por su pk=fk
		$this->db->join('cargos ca', 'e.id_cargo=ca.id_cargo'); //une los campos por su pk=fk
		$this->db->where($this->idTabla, $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	//esta funcion guarda en db
	public function save($data)
	{
		return $this->db->insert($this->tabla, $data);
	}

	//esta funcion actualiza en db
	public function update($id, $data)
	{
		$this->db->where($this->idTabla, $id);

		return $this->db->update($this->tabla, $data);
	}
}