<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los registros de la tabla
	public function getEventos(){
		$this->db->select("*"); //selecc campos  "e.*, c.descripcion as categoria"
		$this->db->from("tipo_evento"); //desde tabla con alias
		// $this->db->join("categoria c", "c.id_categoria=p.id_categoria");//une los campos por su pk=fk
		//$this->db->where("p.estado", "1");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
	public function getEvento($id){
		$this->db->where("id_tipoevento",$id);
		$resultado= $this->db->get("tipo_evento");
		return $resultado->row();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("tipo_evento", $data);
	}
	
	
	//esto es para actualizar los datos de la tabla
	public function update($id, $data){
		$this->db->where("id_tipoevento", $id);
		return $this->db->update("tipo_evento", $data);
	}
}