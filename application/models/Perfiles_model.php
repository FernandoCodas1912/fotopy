<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Perfiles_model extends CI_MOdel {

    public function getPerfiles(){
           // $this->db->where("estado","1");
            $resultados = $this->db->get("perfil");
            return $resultados->result();
    }

    public function getPerfil($id){
        $this->db->where("id_perfil",$id);
        $resultado = $this->db->get("perfil");
        return $resultado->row();
    }
    
    public function save($data){
        return $this->db->insert("perfil",$data);
    }

    public function update($id,$data){
        $this->db->where("id_perfil",$id);
        return $this->db->update("perfil",$data);
    }
}