<?php

defined('BASEPATH') or exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Movimientos_model extends CI_MOdel
{
    public $tabla = 'caja_apertura_cierre';
    public $idTabla = 'id_cajaaperturacierre';

    public function getAperturaCierreCaja($id)
    {
        $this->db->where($this->idTabla, $id);
        $resultado = $this->db->get($this->tabla);

        return $resultado->row();
    }

    public function save_apertura($data)
    {
        return $this->db->insert($this->tabla, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->idTabla, $id);

        return $this->db->update($this->tabla, $data);
    }
}
