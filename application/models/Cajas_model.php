<?php

defined('BASEPATH') or exit('No direct script access allowed');
//esta funcion retorna todos los registros de nuestra tabla
class Cajas_model extends CI_MOdel
{
  public $tabla = 'cajas';
  public $idTabla = 'id_caja';
  //esta funcion retorna todos los registros de nuestra tabla
  public function getAll()
  {
    // $this->db->where('estado', '1');
    $resultados = $this->db->get($this->tabla);

    return $resultados->result();
  }

  //esto es una funcion o metodo para mostrar 1 registro por id
  public function getbyId($id)
  {
    $this->db->where($this->idTabla, $id);
    $resultado = $this->db->get($this->tabla);

    return $resultado->row();
  }

  //esta funcion guarda en db
  public function save($data)
  {
    return $this->db->insert($this->tabla, $data);
  }

  //esta funcion guarda apertura en db
  public function saveApertura($data)
  {
    $this->db->insert("caja_aperturas_cierres", $data);
    return $this->db->insert_id();
  }
  public function lastID()
  {
    return $this->db->insert_id();
  }
  //esta funcion actualiza en db
  public function update($id, $data)
  {
    $this->db->where($this->idTabla, $id);
    return $this->db->update($this->tabla, $data);
  }

  public function getAperturaCierre($username, $id_caja)
  {
    $this->db->where("id_caja", $id_caja);
    $this->db->where("usuario_apertura", $username);
    $this->db->order_by("id_aperturacierre", "DESC");
    $resultado = $this->db->get("caja_aperturas_cierres");
    return $resultado->row();
  }


  public function cierreCaja($id_caja, $usuario, $data)
  {
    $this->db->where("id_caja", $id_caja);
    $this->db->where("usuario_apertura", $usuario);
    return  $this->db->update("caja_aperturas_cierres", $data);
    //	return $this->db->affected_rows();
  }
}