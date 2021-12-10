<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_model extends CI_Model
{
    public $tabla = 'clientes';
    public $idTabla = 'id_cliente';

    //este metodo es para mostrar todos los registros
    public function getAll()
    {
        $this->db->select('c.*, cd.descripcion as ciudad'); //selecc campos
        $this->db->from('clientes c'); //desde tabla con alias
        $this->db->join('ciudades cd', 'cd.id_ciudad=c.id_ciudad'); //une los campos por su pk=fk
        //$this->db->where("c.estado", "1");
        $resultados = $this->db->get();

        return $resultados->result();
    }
    
    //este metodo es para mostrar todos los registros
    public function getClientePendientes()
    {
        $this->db->select('c.*');
        $this->db->from('clientes c');
        $this->db->join('ventas vs', 'vs.id_cliente=c.id_cliente');
        $this->db->where("vs.estado", "2");
        $this->db->group_by('c.id_cliente');
        $resultados = $this->db->get();

        return $resultados->result();
    }

    //esto es una funcion o metodo para mostrar 1 registro por id
    public function getById($id)
    {
        $this->db->select('c.*, cd.descripcion as ciudad, p.nombre as pais, d.descripcion as departamento'); //selecc campos
        $this->db->from('clientes c'); //desde tabla con alias
        $this->db->join('ciudades cd', 'cd.id_ciudad=c.id_ciudad'); //une los campos por su pk=fk
        $this->db->join('departamentos d', 'c.id_departamento=d.id_departamento'); //une los campos por su pk=fk
        $this->db->join('paises p', 'p.id=c.id_pais'); //une los campos por su pk=fk
        $this->db->where($this->idTabla, $id);
        $resultado = $this->db->get();

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
