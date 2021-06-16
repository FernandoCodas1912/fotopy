<?php

defined('BASEPATH') or exit('No direct script access allowed');
//esta funcion retorna todos los registros de nuestra tabla
class Perfiles_model extends CI_MOdel
{
    public $tabla = 'perfil_usuario';

    public function getPerfiles()
    {
        // $this->db->where("estado","1");
        $resultados = $this->db->get($this->tabla);

        return $resultados->result();
    }

    public function getPerfil($id)
    {
        $this->db->where('id_perfil_usuario', $id);
        $resultado = $this->db->get($this->tabla);

        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->tabla, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_perfil_usuario', $id);

        return $this->db->update($this->tabla, $data);
    }
}
