<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los registros de la tabla
	public function getReservas(){
		$this->db->select("r.*, p.descripcion as servicio"); //selecc campos
		$this->db->from("reservas r"); //desde tabla con alias
		$this->db->join("producto_servicio p", "p.id_producto=r.id_producto");//une los campos por su pk=fk
		//$this->db->where("p.estado", "1");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
	public function getReserva($id){
		$this->db->select("r.*, p.descripcion as servicio"); //selecc campos
		$this->db->from("reservas r"); //desde tabla con alias
		$this->db->join("producto_servicio p", "p.id_producto=r.id_producto");//une los campos por su pk=fk
		$this->db->where("id_reserva",$id); //campo de la base de datos
		$resultado= $this->db->get(""); //tabla
		return $resultado->row();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("reservas", $data);
	}
	
	
	//esto es para actualizar los datos de la tabla
	public function update($id, $data){
		$this->db->where("id_reserva", $id);
		return $this->db->update("reservas", $data);
	}
}