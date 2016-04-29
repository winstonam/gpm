<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Empresa extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_admin();
        $this->load->model('administracion/Empresa_model', 'empresamodel');
        $this->load->model('administracion/Persona_model', 'personamodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/empresas.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_dir_admin') . "empresas_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_admin') . "empresa_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        $empresa = $this->empresamodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($empresa));
    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Nombre_Empresa', 'Nombre_Empresa', 'required|max_length[100]');
        $this->form_validation->set_rules('Direccion_empresa', 'Direccion_empresa', 'required|max_length[100]');
        $this->form_validation->set_rules('id_paquete', 'paquete', 'required|integer');
        $this->form_validation->set_rules('estado', 'estado', 'required|integer');

        $this->form_validation->set_rules('nombres', 'Defina nombre del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('primer_apellido', 'Defina apellido del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('cedula', 'Defina numero identificacion del contacto', 'required');


        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validaci�n falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $persona['nombres'] = $data['nombres'];
            $persona['primer_apellido'] = $data['primer_apellido'];
            $persona['segundo_apellido'] = $data['segundo_apellido'];
            $persona['cedula'] = $data['cedula'];
            $persona['email'] = $data['email'];
            $persona['direccion'] = $data['direccion'];
            $persona['telefono'] = $data['telefono'];
            $persona['estado'] = 1;

            $persona = $this->security->xss_clean($persona);

            $id_persona = $this->personamodel->guardar($persona);

            unset($data['id_empresa']);

            $data = $this->security->xss_clean($data);

            if ($id_persona) {
                $empresa['Nombre_Empresa'] = $data['Nombre_Empresa'];
                $empresa['Direccion_empresa'] = $data['Direccion_empresa'];
                $empresa['id_paquete'] = $data['id_paquete'];
                $empresa['id_persona'] = $id_persona;
                $empresa['estado'] = $data['estado'];
            }
            $this->empresamodel->guardar($empresa);

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
        $this->form_validation->set_rules('id_empresa', 'Empresa', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una Empresa v�lida',
                'integer' => 'Empresa seleccionada no v�lida',
                'greater_than' => 'Empresa seleccionada no v�lida'
            ));

        $this->form_validation->set_rules('id_persona', 'persona', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una persona v�lida',
                'integer' => 'persona seleccionada no v�lida',
                'greater_than' => 'persona seleccionada no v�lida'
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
            //Si la validaci�n falla
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