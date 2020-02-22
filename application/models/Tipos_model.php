<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos_model extends CI_Model {
	
	
	//este metodo es para mostrar todos los campos de la tabla
	public function getTipos(){
		$this->db->where("estado", "1");
		$resultados= $this->db->get("tipo_usuario");
		return $resultados->result();
	}
	
}