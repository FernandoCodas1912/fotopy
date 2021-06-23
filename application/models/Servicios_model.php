<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Servicios_model extends CI_Model
{
    //estos son metodos q tienen q ver con bd

    public $tabla = 'productos_servicios';
    public $idTabla = 'id_producto';

    //este metodo es para mostrar todos los registros de la tabla
    public function getAll()
    {
        $this->db->select('p.*, c.descripcion as categoria');
        $this->db->from('productos_servicios p'); //desde tabla con alias
        $this->db->join('categorias c', 'c.id_categoria=p.id_categoria'); //une los campos por su pk=fk
        $this->db->where('p.tipo', '2'); //1 es producto tipo 2 es servicio
        $this->db->where('p.estado', '1'); //1 es activo 2 inactivo 3 anulado
        $result = $this->db->get();

        return $result->result();
    }

    //esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
    public function getById($id)
    {
        $this->db->select('p.*, c.descripcion as categoria');
        $this->db->from('productos_servicios p'); //desde tabla con alias
        $this->db->join('categorias c', 'c.id_categoria=p.id_categoria'); //une los campos por su pk=fk
        $this->db->where('p.id_producto', $id); //1 es activo 2 inactivo 3 anulado
        $result = $this->db->get();

        return $result->row();
    }

    //esta es la parte para guardar en la bd
    public function save($data)
    {
        return $this->db->insert($this->tabla, $data);
    }

    //esto es para actualizar los datos de la tabla
    public function update($id, $data)
    {
        $this->db->where($this->idTabla, $id);

        return $this->db->update($this->tabla, $data);
    }
}