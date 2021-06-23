<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reservas_model extends CI_Model
{
    //estos son metodos q tienen q ver con bd

    public $tabla = 'reservas';
    public $idTabla = 'id_reserva';

    //este metodo es para mostrar todos los registros de la tabla
    public function getAll()
    {
        $this->db->select('r.*, p.descripcion as servicio, c.razonsocial as cliente, c.telefono as telefono'); //selecc campos
        $this->db->from('reservas r'); //desde tabla con alias
        $this->db->join('productos_servicios p', 'r.id_producto=p.id_producto'); //une los campos por su pk=fk
        $this->db->join('clientes c', 'r.id_cliente=c.id_cliente'); //une los campos por su pk=fk
        //$this->db->where("p.estado", "1");
        $resultados = $this->db->get();

        return $resultados->result();
    }

    //esto es una funcion o metodo para mostrar 1 registro de la tabla x su id
    public function getById($id)
    {
        $this->db->select('r.*, p.descripcion as servicio, c.razonsocial as cliente, c.telefono as telefono'); //selecc campos
        $this->db->from('reservas r'); //desde tabla con alias
        $this->db->join('productos_servicios p', 'p.id_producto=r.id_producto'); //une los campos por su pk=fk
        $this->db->join('clientes c', 'r.id_cliente=c.id_cliente'); //une los campos por su pk=fk
        $this->db->where($this->idTabla, $id); //campo de la base de datos
        $resultado = $this->db->get(''); //tabla

        return $resultado->row();
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