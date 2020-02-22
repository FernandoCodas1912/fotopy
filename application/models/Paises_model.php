<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paises_model extends CI_Model
{
    //estos son metodos q tienen q ver con bd

    //este metodo es para mostrar todos los servicios
    public function getPaises()
    {
        //	$this->db->where("estServicio", "1");
        $resultados = $this->db->get("paises");
        return $resultados->result();
    }

    //esta es la parte para guardar en la bd
    public function save($data)
    {
        return $this->db->insert("paises", $data);
    }

    //esto es una funcion o metodo para mostrar 1 servicio por id
    public function getPais($id)
    {
        $this->db->where("id", $id);
        $resultado = $this->db->get("paises");
        return $resultado->row();
    }
    //esto es para actualizar los servicios
    public function update($id, $data)
    {
        $this->db->where("id", $id);
        return $this->db->update("paises", $data);
    }
}
