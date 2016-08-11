<?php
/*

*/
class  asignarPedidos extends  Rta91_Controller
{
       function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('ventas/asignacionPedido_model', 'asigPedidoModel');
    }

     public function index()
    {
        $data['js_data']= array(
            base_url().'assets/custom/asignacionPedido.js'
        );
        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "asignacionPeidoList";
        // $data['modals'] = array(
        //     $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "clientes_registrar", '', TRUE),
        // );
        $this->load->view($this->_container, $data);

    }
    	public function obtener()
	{
		if(!empty($this->session->userdata('id_empresa')))
		{
			$producto=$this->asigPedidoModel->obtener();
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($producto));
		}
	}

	
}
?>