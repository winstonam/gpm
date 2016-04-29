<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos_Navegacion
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Verifica si existe la sesión y si el usuario tiene acceso al panel
     */
    public function verificar_usuario_logueado()
    {
        $usuario_conectado = $this->CI->session->userdata('logueado');

        if (empty($usuario_conectado))
            redirect('acceso');
    }

    public function verificar_permiso_admin()
    {
        $usuario_tipo = $this->CI->session->userdata('admin');

        if (empty($usuario_tipo)){
            $this->CI->session->set_flashdata('mensaje', 'Lo sentimos, usted no tiene permiso para ver esta sección <span class="text-red">' . uri_string() . '</span>');
        redirect('acceso/acceso_restringido');
        }
    }

    public function verificar_permiso_personal_empresa()
    {
        $usuario_tipo = $this->CI->session->userdata('admin');
        $empresa_id = $this->CI->session->userdata('id_empresa');
        if ((!empty($usuario_tipo)||$usuario_tipo)){
            $this->CI->session->set_flashdata('mensaje', 'Lo sentimos, usted no tiene permiso para ver esta sección <span class="text-red">' . uri_string() . '. Solo es posible acceder con usuarios de una empresa.</span>');
            redirect('acceso/acceso_restringido');
        }
    }

    public function verificar_logueo()
    {
        $usuario_conectado = $this->CI->session->userdata('logueado');

        $respuesta = false;
        if (!empty($usuario_conectado)) {
            $respuesta = true;

        }

        return $respuesta;

    }
}