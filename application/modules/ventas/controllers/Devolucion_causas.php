<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Devolucion_causas extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Devolucion_causas_model', 'dcmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/causas_devolucion_empresa.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "devolucion_causas_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "devolucion_causas_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        //print_r($data);assets\plugins\select2
        // $this->load->model(array('ventas/Cargos_model'));
        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        $devoluciones_causas = $this->dcmodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($devoluciones_causas));
    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Descripcion', 'Descripcion causa', 'required|max_length[200]');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            unset($data['id_causa_devolucion']);
            $data = $this->security->xss_clean($data);

            $this->dcmodel->guardar($data);

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
        $this->form_validation->set_rules('id_causa_devolucion', 'Causa devolucion', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una causa devolucion válido',
                'integer' => 'Causa devolucion seleccionada no válida',
                'greater_than' => 'Causa devolucion seleccionada no válida'
            ));

        $this->form_validation->set_rules('Descripcion', 'Descripcion cargo', 'required|max_length[100]');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_ACT_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $data = $this->security->xss_clean($data);
            $id = $data['id_causa_devolucion'];
            unset($data['id_causa_devolucion']);

            $this->dcmodel->actualizar($id, $data);

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