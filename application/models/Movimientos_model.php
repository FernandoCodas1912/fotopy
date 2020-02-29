<?php
defined('BASEPATH') or exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Movimientos_model extends CI_MOdel
{


  public function getAperturaCierreCaja($id)
  {
    $this->db->where("id_caja", $id);
    $resultado = $this->db->get("apertura_cierre_caja");
    return $resultado->row();
  }

  public function save_apertura($data)
  {
    return $this->db->insert("apertura_cierre_caja", $data);
  }

  public function update($id, $data)
  {
    $this->db->where("id_caja", $id);
    return $this->db->update("apertura_cierre_caja", $data);
  }
}