<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Comprobantes_model extends CI_MOdel {

    public function getComprobantes(){
           // $this->db->where("estado","1");
            $resultados = $this->db->get("comprobantes");
            return $resultados->result();
    }

    public function getComprobante($id){
        $this->db->where("id_comprobante",$id);
        $resultado = $this->db->get("comprobantes");
        return $resultado->row();
    }
    
    public function save($data){
        return $this->db->insert("comprobantes",$data);
    }

    public function update($id,$data){
        $this->db->where("id_comprobante",$id);
        return $this->db->update("comprobantes",$data);
    }
}