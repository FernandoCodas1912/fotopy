<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    public $tabla = 'usuarios';
    public $idTabla = 'id_usuario';

    public function login($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('estado', 1);

        $results = $this->db->get($this->tabla);

        if ($results->num_rows() > 0) {
            return $results->row();
        } else {
            //echo "error en user y clave";
            return false;
        }
    }

    //este metodo es para mostrar todos los campos de la tabla
    public function getAll()
    {
        $this->db->select('u.*, t.descripcion as perfil, e.nomape as nombre'); //selecc campos
        $this->db->from('usuarios u'); //desde tabla con alias
        $this->db->join('usuarios_perfiles t', 'u.id_perfil_usuario=t.id_usuario_perfil'); //une los campos por su pk=fk
        $this->db->join('empleados e', 'e.id_empleado=u.id_empleado'); //une los campos por su pk=fk
        //$this->db->where("u.estado", "1");
        $resultados = $this->db->get();

        return $resultados->result();
    }

    //esta es la parte para guardar en la bd
    public function save($data)
    {
        return $this->db->insert($this->tabla, $data);
    }

    //esto es una funcion o metodo para mostrar 1 reg por id
    public function getById($id)
    {
        $this->db->select('u.*, t.descripcion as perfil, e.nomape as nombre'); //selecc campos
        $this->db->from('usuarios u'); //desde tabla con alias
        $this->db->join('usuarios_perfiles t', 'u.id_perfil_usuario=t.id_usuario_perfil'); //une los campos por su pk=fk
        $this->db->join('empleados e', 'e.id_empleado=u.id_empleado'); //une los campos por su pk=fk
        $this->db->where($this->idTabla, $id);
        $resultado = $this->db->get();

        return $resultado->row();
    }

    //esto es para actualizar los servicios
    public function update($id, $data)
    {
        $this->db->where($this->idTabla, $id);

        return $this->db->update($this->tabla, $data);
    }
}