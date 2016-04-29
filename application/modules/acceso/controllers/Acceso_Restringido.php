<?php 
class Acceso_Restringido extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->permisos->verificar_usuario_logueado();

	}
	public function index()
	{
		$data['page'] = $this->config->item('gpm_sys_web_template_dir_public') . "error_permiso";
		//$data['module'] = 'acceso';
		$this->load->view($this->_container, $data);
	}
}