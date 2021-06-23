<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller
{
    //solo el constructor, para llamar a las clases que se van a utilizar
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('Usuarios_model'); // esto abre el modelo
        $this->load->model('Perfiles_model'); // esto abre el modelo
        $this->load->model('Empleados_model'); // esto abre el modelo
    }

    //esta funcion es la primera que se carga
    public function index()
    {
        //cargamos un array usando el modelo
        $data = [
            'usuarios' => $this->Usuarios_model->getUsuarios(),
            'perfiles' => $this->Perfiles_model->getPerfiles(),
            'empleados' => $this->Empleados_model->getEmpleados(),
        ];
        //llamamos a las vistas para mostrar
        $this->load->view('plantilla/header');
        $this->load->view('plantilla/menu');

        $this->load->view('usuarios/list', $data);
        $this->load->view('plantilla/footer_plugins');
        $this->load->view('usuarios/script_usuarios');
    }

    //funcion vista
    public function view($id)
    {
        $data = [
            'usuarios' => $this->Usuarios_model->getUsuario($id),
        ];
        //abrimos la vista view
        $this->load->view('usuarios/view', $data);
    }

    public function store()
    {
        if (isset($_POST['username'])) {
            //recibimos las variables que necesiten ser formateadas
            $FechaAltaUSuario = date('Y-m-d H:i:s');

            //aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
            $this->form_validation->set_rules('id_empleado', 'Empleado', 'required');
            $this->form_validation->set_rules('id_perfil', 'Tipo usuario', 'required');
            $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|is_unique[usuarios.username]');
            $this->form_validation->set_rules('clave', 'Clave del Usuario', 'required|min_length[6]');
            $this->form_validation->set_rules('repetirclave', 'Repetir Clave', 'required|min_length[6]|matches[clave]');

            //SI ESTA BIEN VALIDADO
            if ($this->form_validation->run() == true) {
                //se reciben las variables y se guardan
                $data = [
                    'id_empleado' => $_POST['id_empleado'],
                    'username' => $_POST['username'],
                    'id_perfil_usuario' => $_POST['id_perfil'],
                    'date_add' => $FechaAltaUSuario,
                    'estado' => 1,
                    'password' => sha1($_POST['clave']),
                ];
                //guardamos los datos en la base de datos
                if ($this->Usuarios_model->save($data)) {
                    //si todo esta bien, emitimos mensaje
                    $this->session->set_flashdata('success', 'Usuario registrado correctamente!');
                    //redireccionamos al controlador y refrescamos
                    redirect(base_url() . 'Usuarios_controller', 'refresh');
                } else {
                    //si hubo errores, mostramos mensaje
                    $this->session->set_flashdata('error', 'Usuario no registrado error bd!');
                    redirect('Usuarios_controller', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Errores en la validacion, reintente!');
                //si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
                redirect('Usuarios_controller', 'refresh');
                //$this->add();
            }
        }
    }

    public function update_password()
    {
        if (isset($_POST['id_usuario'])) {
            $id_usuario = $this->input->post('id_usuario');
            $claveAnterior = $this->input->post('clave_anterior');

            //traemos datos para compararlo
            $usuarioDb = $this->Usuarios_model->getUsuario($id_usuario);
            //Buscar si coincide con la clave anterior para continuar
            if (sha1($claveAnterior) == $usuarioDb->password) {
                // echo 'ok si coincide';
            } else {
                $this->session->set_flashdata('error', 'Clave Anterior no coincide!');
                redirect('Usuarios_controller');
            }

            $this->form_validation->set_rules('clave_anterior', 'Clave Anterior del Usuario', 'required|min_length[6]');

            $this->form_validation->set_rules('clave_nueva', 'Clave del Usuario', 'required|min_length[6]');
            $this->form_validation->set_rules('repetirclave_nueva', 'Repetir Clave', 'required|min_length[6]|matches[clave_nueva]');

            //SI ESTA BIEN VALIDADO
            if ($this->form_validation->run() == true) {
                //se reciben las variables y se guardan
                $data = [
                    'date_mod' => date('Y-m-d H:i:s'),
                    'password' => sha1($_POST['clave_nueva']),
                ];
                //guardamos los datos en la base de datos
                if ($this->Usuarios_model->update($id_usuario, $data)) {
                    //si todo esta bien, emitimos mensaje
                    $this->session->set_flashdata('success', 'Clave Actualizada correctamente!');
                    //redireccionamos al controlador y refrescamos
                    redirect(base_url() . 'Usuarios_controller', 'refresh');
                } else {
                    //si hubo errores, mostramos mensaje
                    $this->session->set_flashdata('error', 'Clave no actualizada error en  bd!');
                    redirect('Usuarios_controller', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Errores en la validacion, las claves no coinciden o no tienen 6 caracteres como minimo, reintente!');
                //si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
                redirect('Usuarios_controller');
                //$this->add();
            }
        }
    }

    //metodo para llamar y cargar vista editar enviando id a editar
    public function edit($id)
    {
        //recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

        $data = [
            'usuarios' => $this->Usuarios_model->getUsuario($id),
            'perfiles' => $this->Perfiles_model->getPerfiles(),
            'empleados' => $this->Empleados_model->getEmpleados(),
        ];
        $this->load->view('usuarios/edit', $data);
    }

    //metodo para llamar y cargar vista cambio clave
    public function cambio_clave($id)
    {
        //recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

        $data = [
            'usuarios' => $this->Usuarios_model->getUsuario($id),
            'perfiles' => $this->Perfiles_model->getPerfiles(),
            'empleados' => $this->Empleados_model->getEmpleados(),
        ];
        $this->load->view('usuarios/cambio_clave', $data);
    }

    //actualizamos

    public function update()
    {
        $edit_id_usuario = $this->input->post('edit_id_usuario');
        $edit_username = $this->input->post('edit_username');

        //traemos datos para no duplicarlos
        $Username_actual = $this->Usuarios_model->getUsuario($edit_id_usuario);

        if ($edit_username == $Username_actual->username) {
            $unique = '';
        } else {
            //si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
            $unique = '|is_unique[usuarios.username]';
        }
        //validar
        $this->form_validation->set_rules('edit_username', 'Nombre de Usuario', 'required' . $unique);

        if ($this->form_validation->run() == true) {
            //indicar campos de la tabla a modificar
            $data = [
                'username' => $_POST['edit_username'],
                'id_perfil_usuario' => $_POST['edit_id_perfil'],
                'id_empleado' => $_POST['edit_id_empleado'],
                'estado' => 1,
            ];
            if ($this->Usuarios_model->update($edit_id_usuario, $data)) {
                $this->session->set_flashdata('success', 'Actualizado correctamente!');
                redirect(base_url() . 'Usuarios_controller', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
                redirect(base_url() . 'Usuarios_controller/edit/' . $edit_id_usuario);
            }
        } else {
            //si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
            $this->edit($edit_id_usuario);
        }
    }

    //funcion para borrar
    public function delete($id)
    {
        $data = [
            'estado' => '3',
        ];
        if ($this->Usuarios_model->update($id, $data)) {
            //retornamos a la vista para que se refresque
            $this->session->set_flashdata('success', 'Anulado correctamente!');
            redirect(base_url() . 'Usuarios_controller', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Errores al Intentar Anular!');
            redirect(base_url() . 'Usuarios_controller');
        }
    }
}