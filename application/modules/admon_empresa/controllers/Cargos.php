<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Cargos extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Cargos_model', 'cargosmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/cargos_empresa.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_adm_emp') . "cargos_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_adm_emp') . "cargos_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        //print_r($data);assets\plugins\select2
        // $this->load->model(array('ventas/Cargos_model'));
        $this->load->view($this->_container, $data);
    }

    public function obtener_cargos()
    {
        $cargos = $this->cargosmodel->obtener_cargos();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($cargos));
    }

    public function guardar_cargo()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('descripcion', 'Descripcion cargo', 'required|max_length[100]');
        $this->form_validation->set_rules('nivel_acceso', 'Nivel acceso', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar un nivel de acceso',
                'integer' => 'Nivel de acceso debe ser entero',
                'greater_than' => 'Nivel seleccionado no valido'
            ));

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();
            unset($data['id_cargo']);
            $data = $this->security->xss_clean($data);

            $this->cargosmodel->guardar_cargo($data);

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

    public function actualizar_cargo()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_cargo', 'Cargo', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar un cargo válido',
                'integer' => 'Cargo seleccionado no válido',
                'greater_than' => 'Cargo seleccionado no válido'
            ));

        $this->form_validation->set_rules('descripcion', 'Descripcion cargo', 'required|max_length[100]');
        $this->form_validation->set_rules('nivel_acceso', 'Nivel acceso', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar un nivel de acceso',
                'integer' => 'Nivel de acceso debe ser entero',
                'greater_than' => 'Nivel seleccionado no valido'
            ));

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
            $id = $data['id_cargo'];
            unset($data['id_cargo']);
            $this->cargosmodel->actualizar_cargo($id, $data);

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