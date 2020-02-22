<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Empleados_model extends CI_MOdel {

    public function getEmpleados(){
           // $this->db->where("estado","1");
            $resultados = $this->db->get("empleado");
            return $resultados->result();
    }

    public function getEmpleado($id){
        $this->db->where("id_empleado",$id);
        $resultado = $this->db->get("empleado");
        return $resultado->row();
    }
    
    public function save($data){
        return $this->db->insert("empleado",$data);
    }

    public function update($id,$data){
        $this->db->where("id_empleado",$id);
        return $this->db->update("empleado",$data);
    }
}