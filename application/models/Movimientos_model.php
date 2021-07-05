<?php

defined('BASEPATH') or exit('No direct script access allowed');

//esta funcion retorna todos los registros de nuestra tabla
class Movimientos_model extends CI_MOdel
{
    public $tabla = 'movimientos';
    public $idTabla = 'id_movimiento';
    //esta funcion retorna todos los registros de nuestra tabla

    public function getAll()
    {
        $this->db->where('estado', '1');
        $resultados = $this->db->get($this->tabla);

        return $resultados->result();
    }
    public function getSaldo()
    {
        $this->db->select('saldo_movimiento'); //selecc campos
        $this->db->order_by($this->idTabla, "DESC"); //campo de la base de datos
        $resultado = $this->db->get($this->tabla);
        return $resultado->row();
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

    //esta funcion actualiza en db
    public function update($id, $data)
    {
        $this->db->where($this->idTabla, $id);

        return $this->db->update($this->tabla, $data);
    }
}