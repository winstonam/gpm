<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Rutas extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('ventas/Rutas_model', 'rutasmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/rutas.js',
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYs1ME3qOjwLWPKG_2DWozGGMkhyGHfo'
        );
        //$data['empresa'] = array('id_empresa'=>$this->session->userdata('id_empresa'),'Nombre_Empresa'=>$this->session->userdata('Nombre_Empresa'));
        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "rutas_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "rutas_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        //var_dump($this->config->item('gpm_sys_web_template_dir_ventas') . "rutas_lista");
        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        if (!empty($this->session->userdata('id_empresa'))) {
            $empresa = $this->rutasmodel->obtener();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($empresa));
        }
    }

    public function guardar()
    {

        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Nombre_ruta', 'Nombre_ruta', 'required|max_length[100]');
        $this->form_validation->set_rules('id_empresa', 'Empresa', 'required|integer');
        $this->form_validation->set_rules('estado', 'Estado', 'required|integer');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            unset($data['id_ruta']);
            unset($data['Nombre_Empresa']);

            $data = $this->security->xss_clean($data);

            $this->rutasmodel->guardar($data);

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


    public function actualizar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_ruta', 'Ruta', 'required|integer|greater_than[0]');

        $this->form_validation->set_rules('Nombre_ruta', 'Nombre_ruta', 'required|max_length[100]');
        $this->form_validation->set_rules('id_empresa', 'Empresa', 'required|integer');
        $this->form_validation->set_rules('estado', 'Estado', 'required|integer');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_ACT_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $id_ruta = $data['id_ruta'];
            unset($data['id_ruta']);
            unset($data['Nombre_Empresa']);

            $data = $this->security->xss_clean($data);

            $this->rutasmodel->actualizar($id_ruta, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response['estado'] = 0;
                $response['mensaje'] = MSJ_ACT_FAIL;
            } else {
                $response['estado'] = 1;
                $response['mensaje'] = MSJ_ACT_EXITO;
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}