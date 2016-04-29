<?php

class Acceso extends MY_Controller
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
            $data['page'] = $this->config->item('gpm_sys_web_template_dir_public') . "login_form";
            $data['module'] = 'acceso';
            $this->load->view($this->_container, $data);
        }
    }

    public function autenticar()
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
            $usuario = $this->usuariomodel->validar_usuario($usuario, $contrasena);

            if ($usuario) {
                //print_r($usuario);
                $usuario_data = array(
                    'id_empleado' => $usuario->id_empleado,
                    'usuario' => $usuario->usuario,
                    'nombres' => $usuario->nombres,
                    'apellidos' => $usuario->apellidos,
                    'id_empresa' => $usuario->id_empresa,
                    'codigo_empleado' => $usuario->codigo_empleado,
                    'desc_cargo' => $usuario->desc_cargo,
                    'Nombre_Empresa' => $usuario->Nombre_Empresa,
                    'Direccion_empresa' => $usuario->Direccion_empresa,
                    'id_cargo' => $usuario->id_cargo,
                    'cedula' => $usuario->cedula,
                    'email' => $usuario->email,
                    'logueado' => TRUE
                );
                $this->session->set_userdata($usuario_data);
                redirect('bienvenida/principal');
            } else {

                $this->session->set_flashdata('mensaje', 'Usuario o contraseña no válidos');
                redirect('acceso');
            }
        }
    }

    public function cerrar_sesion()
    {
        $tipo_admin = $this->session->userdata('admin');

        $usuario_data = array(
            'logueado' => FALSE
        );
        $this->session->sess_destroy();
        //$this->session->set_userdata($usuario_data);

        if (!empty($tipo_admin) && $tipo_admin) {
            redirect('acceso/admin');
        } else {
            redirect('acceso');
        }
    }

}
