<?php

class Acceso_admin extends MY_Controller
{
    public $captcha_config;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('administracion/Usuario_model', 'usuariomodel');
    }

    public function index()
    {
        if ($this->permisos->verificar_logueo()) {
            redirect('administracion/principal');
        } else {
            $data['page'] = $this->config->item('gpm_sys_web_template_dir_public') . "login_form_admin";
            $data['module'] = 'acceso';
            $this->load->view($this->_container, $data);
        }
    }


    public function autenticar_admin()
    {
        //Validar datos
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('mensaje', validation_errors());
            redirect('acceso/');
        } else {
            $data = $this->input->post();
            $data = $this->security->xss_clean($data);
            $usuario = $data['usuario'];
            $contrasena = $data['contrasena'];

            //Autenticar Usuario
            $usuario = $this->usuariomodel->validar_usuario_admin($usuario, $contrasena);

            if ($usuario) {
                //print_r($usuario);

                $usuario_data = array(
                    'usuario' => $usuario->usuario,
                    'nombres' => $usuario->nombres,
                    'apellidos' => $usuario->apellidos,
                    'admin' => TRUE,
                    'cedula' => $usuario->cedula,
                    'email' => $usuario->email,
                    'logueado' => TRUE
                );
                $this->session->set_userdata($usuario_data);
                redirect('administracion/principal');
            } else {
                redirect('acceso/acceso_admin');
            }
        }
    }

}
