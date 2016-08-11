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
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "asignacionPedidoRegistar", '', TRUE),
        );
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

	public function guardar()
	{
		//Validar archivo
	        $this->load->library('form_validation');
	        $this->form_validation->set_rules('id_repartidor', 'Seleccione el Repartidor', 'required');

	        $response['mensaje'] = MSJ_RG_FAIL;

	        if ($this->form_validation->run() == FALSE) {
	            //Si la validación falla
	            $response['estado'] = 0;
	            $response['mensaje'] = validation_errors();
	        } else {
	            $data = $this->input->post();
	            $this->db->trans_start();

	            $pedido['id_repartidor']=$data['id_repartidor'];
	            $pedido['id_pedido']=$data['id_pedido'];


	            $pedido = $this->security->xss_clean($pedido);
	            $this->asigPedidoModel->guardar($pedido);

	            $this->db->trans_complete();
	            if ($this->db->trans_status() === FALSE) {
	                $response['estado'] = 0;
	                $response['mensaje'] = MSJ_RG_FAIL;
	            } else {
	                $response['estado'] = 1;
	                $response['mensaje'] = MSJ_RG_EXITO;
	            }

	        }
	        $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($response, JSON_UNESCAPED_SLASHES))
	            ->_display();
	        exit;
	}
}
?>