<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Categorias_model extends CI_MOdel {

    public function getCategorias(){
           // $this->db->where("estado","1");
            $resultados = $this->db->get("categoria");
            return $resultados->result();
    }

    public function getCategoria($id){
        $this->db->where("id_categoria",$id);
        $resultado = $this->db->get("categoria");
        return $resultado->row();
    }
    
    public function save($data){
        return $this->db->insert("categoria",$data);
    }

    public function update($id,$data){
        $this->db->where("id_categoria",$id);
        return $this->db->update("categoria",$data);
    }
}