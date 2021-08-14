<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas_model extends CI_Model {
	
	
	//este metodo es para mostrar todos los campos de la tabla
	public function getEmpresa(){
		$resultados= $this->db->get("empresa");
		return $resultados->row();
		//	return $resultados->result();
	}
	
}