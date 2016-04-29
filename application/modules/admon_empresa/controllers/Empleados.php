<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 25/03/2016
 * Time: 10:42 PM
 */

class Empleados extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Persona_model', 'personamodel');
        $this->load->model('admon_empresa/Empleado_model', 'empleadomodel');
    }

    public function index()
    {
        $data['js_data']= array(
            base_url().'assets/custom/empleados.js'
        );
        $data['page'] = $this->config->item('gpm_sys_web_template_adm_emp') . "empleados_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_adm_emp') . "empleado_registrar", '', TRUE),
        );
        $this->load->view($this->_container, $data);

    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('codigo_empleado', 'codigo empleado', 'required|max_length[10]');
         $this->form_validation->set_rules('id_cargo', 'cargo', 'required|integer');
        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');

        $this->form_validation->set_rules('estado', 'estado', 'required|integer');

        $this->form_validation->set_rules('nombres', 'Defina nombre del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('primer_apellido', 'Defina apellido del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('cedula', 'Defina numero identificacion del contacto', 'required');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
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

            unset($data['id_cliente']);

            $data = $this->security->xss_clean($data);

            if ($id_persona) {
                $empleado['codigo_empleado'] = $data['codigo_empleado'];
                $empleado['id_cargo'] = $data['id_cargo'];
                $empleado['id_empresa'] = $data['id_empresa'];
                $empleado['id_persona'] = $id_persona;
                $empleado['estado'] = $data['estado'];
            }
            $this->empleadomodel->guardar($empleado);

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
        $this->form_validation->set_rules('id_empleado', 'empleado', 'required|integer');
        $this->form_validation->set_rules('id_persona', 'persona', 'required|integer');

        $this->form_validation->set_rules('codigo_empleado', 'codigo empleado', 'required|max_length[10]');
        $this->form_validation->set_rules('id_cargo', 'cargo', 'required|integer');
        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');

        $this->form_validation->set_rules('estado', 'estado', 'required|integer');

        $this->form_validation->set_rules('nombres', 'Defina nombre del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('primer_apellido', 'Defina apellido del contacto', 'required|max_length[100]');
        $this->form_validation->set_rules('cedula', 'Defina numero identificacion del contacto', 'required');

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

            $id_empleado = $data['id_empleado'];

            /// unset($data['id_cliente']);

            $data = $this->security->xss_clean($data);

            if ($id_persona) {
                $empleado['codigo_empleado'] = $data['codigo_empleado'];
                $empleado['id_cargo'] = $data['id_cargo'];
                $empleado['id_persona'] = $id_persona;
                $empleado['estado'] = $data['estado'];
            }
            $this->empleadomodel->actualizar($id_empleado,$empleado);

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


    public function obtener()
    {
        if(!empty($this->session->userdata('id_empresa'))){
            $empleados = $this->empleadomodel->obtener();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($empleados));
        }
    }

}