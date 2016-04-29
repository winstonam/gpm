<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Empresa extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Empresa_model', 'empresamodel');
        $this->load->model('administracion/Persona_model', 'personamodel');
        $this->load->model('administracion/Paquetes_sistema_model', 'psistemasmodel');
    }

    public function index()
    {
        $data['empresa'] = $this->empresamodel->obtener_empresa_actual();
        $data['js_data'] = array(
            base_url() . 'assets/custom/admon_empresa.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_adm_emp') . "empresa_editar";

        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        $empresa = $this->empresamodel->obtener_empresa_actual();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($empresa));
    }

    public function obtener_paquetes()
    {
        $paquetes_sistema = $this->psistemasmodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($paquetes_sistema));
    }

    public function actualizar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_empresa', 'Empresa', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una Empresa válida',
                'integer' => 'Empresa seleccionada no válida',
                'greater_than' => 'Empresa seleccionada no válida'
            ));

        $this->form_validation->set_rules('id_persona', 'persona', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una persona válida',
                'integer' => 'persona seleccionada no válida',
                'greater_than' => 'persona seleccionada no válida'
            ));

        $this->form_validation->set_rules('Nombre_Empresa', 'Nombre_Empresa', 'required|max_length[100]');
        $this->form_validation->set_rules('Direccion_empresa', 'Direccion_empresa', 'required|max_length[100]');
        $this->form_validation->set_rules('id_paquete', 'Defina el estado del paquete', 'required|integer');
        $this->form_validation->set_rules('id_persona', 'Defina los datos del contacto', 'required|integer');
        $this->form_validation->set_rules('estado', 'estado', 'required|integer');

        $this->form_validation->set_rules('nombres', 'nombres contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('primer_apellido', 'primer_apellido', 'required|max_length[100]');
        $this->form_validation->set_rules('cedula', 'cedula', 'required');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_ACT_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $id_persona = $data['id_persona'];

            $persona['nombres'] = $data['nombres'];
            $persona['primer_apellido'] = $data['primer_apellido'];
            $persona['segundo_apellido'] = $data['segundo_apellido'];
            $persona['cedula'] = $data['cedula'];
            $persona['email'] = $data['email'];
            $persona['direccion'] = $data['direccion'];
            $persona['telefono'] = $data['telefono'];
            $persona['estado'] = 1;

            $persona = $this->security->xss_clean($persona);

            $this->personamodel->actualizar($id_persona, $persona);

            $id_empresa = $data['id_empresa'];

            $data = $this->security->xss_clean($data);

            if ($id_empresa) {
                $empresa['Nombre_Empresa'] = $data['Nombre_Empresa'];
                $empresa['Direccion_empresa'] = $data['Direccion_empresa'];
                $empresa['id_paquete'] = $data['id_paquete'];
                $empresa['estado'] = $data['estado'];
            }
            $this->empresamodel->actualizar($id_empresa, $empresa);

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