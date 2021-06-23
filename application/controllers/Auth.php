<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model'); //esto abre el modelo
    }

    //funcion indice, abrir la vista login
    public function index()
    {
        //si ya esta logueado, que me cargue el controlador Dashboard
        if ($this->session->userdata('login')) {
            redirect(base_url() . 'Dashboard_controller'); //llama al controlador
        } else {
            //si login es !true, entonces q me diriga al login
            $this->load->view('plantilla/header');
            $this->load->view('login_view');
            $this->load->view('plantilla/footer_plugins');
        }
    }

    public function login()
    {
        //otra manera de recibir los datos via post
        $username = $this->input->post('username');
        $password = $this->input->post('clave');
        $res = $this->Usuarios_model->login($username, sha1($password));

        if (!$res) {
            $this->session->set_flashdata('error', 'Problemas al iniciar Sesion, error en usuario o clave');
            //si no hay datos que me recargue login
            redirect(base_url());
        } else {
            //si existe datos, que me cargue las variables de sesion
            $data = [
                'id_usuario' => $res->id_usuario,
                'username' => $res->username,
                'login' => true,
            ];
            $this->session->set_userdata($data);
            $this->session->set_flashdata('success', 'Usuario Logueado Satisfactoriamente!');
            //y me rediriga al controlador Dashboard
            redirect(base_url() . 'Dashboard_controller');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}