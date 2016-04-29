<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 23/03/2016
 * Time: 02:25 AM
 */

class Principal extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_admin();
    }

    public function index()
    {
        $data['page'] = $this->config->item('gpm_sys_web_template_dir_admin') . "dashboard";
        //var_dump($this->config->item('gpm_sys_web_template_dir_admin') . "dashboard");
        $this->load->view($this->_container, $data);
    }

}