<?php

defined('BASEPATH') or exit('No direct script access allowed');
//esta funcion retorna todos los registros de nuestra tabla
class Perfiles_model extends CI_MOdel
{
    public $tabla = 'usuario_perfil';
    public $idTabla = 'id_usuario_perfil';

    public function getPerfiles()
    {
        // $this->db->where("estado","1");
        $resultados = $this->db->get($this->tabla);

        return $resultados->result();
    }

    public function getPerfil($id)
    {
        $this->db->where($this->idTabla, $id);
        $resultado = $this->db->get($this->tabla);

        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->tabla, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->idTabla, $id);

        return $this->db->update($this->tabla, $data);
    }
}
