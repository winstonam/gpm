<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 20/03/2016
 * Time: 10:33 PM
 */
class Clientes extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Persona_model', 'personamodel');
        $this->load->model('ventas/Cliente_model', 'clientesmodel');
    }

    public function index()
    {
        $data['js_data']= array(
            base_url().'assets/custom/clientes.js',
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYs1ME3qOjwLWPKG_2DWozGGMkhyGHfo'
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );
        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "clientes_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "clientes_registrar", '', TRUE),
        );
        $this->load->view($this->_container, $data);

    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre_negocio', 'nombre_negocio', 'required|max_length[100]');
        $this->form_validation->set_rules('direccion_negocio', 'direccion_negocio', 'required|max_length[100]');
        $this->form_validation->set_rules('id_ruta', 'ruta', 'required|integer');

        $this->form_validation->set_rules('longitud', 'longitud', 'required|decimal');
        $this->form_validation->set_rules('latitud', 'latitud', 'required|decimal');

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
                $cliente['nombre_negocio'] = $data['nombre_negocio'];
                $cliente['direccion_negocio'] = $data['direccion_negocio'];
                $cliente['longitud'] = $data['longitud'];
                $cliente['latitud'] = $data['latitud'];
                $cliente['id_ruta'] = $data['id_ruta'];
                $cliente['id_persona'] = $id_persona;
                $cliente['estado'] = $data['estado'];
            }
            $this->clientesmodel->guardar($cliente);

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
        $this->form_validation->set_rules('id_cliente', 'cliente', 'required|integer');
        $this->form_validation->set_rules('id_persona', 'persona', 'required|integer');

        $this->form_validation->set_rules('nombre_negocio', 'nombre_negocio', 'required|max_length[100]');
        $this->form_validation->set_rules('direccion_negocio', 'direccion_negocio', 'required|max_length[100]');
        $this->form_validation->set_rules('id_ruta', 'ruta', 'required|integer');

        $this->form_validation->set_rules('longitud', 'longitud', 'required|decimal');
        $this->form_validation->set_rules('latitud', 'latitud', 'required|decimal');

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

            $id_cliente = $data['id_cliente'];

           /// unset($data['id_cliente']);

            $data = $this->security->xss_clean($data);

            if ($id_persona) {
                $cliente['nombre_negocio'] = $data['nombre_negocio'];
                $cliente['direccion_negocio'] = $data['direccion_negocio'];
                $cliente['longitud'] = $data['longitud'];
                $cliente['latitud'] = $data['latitud'];
                $cliente['id_ruta'] = $data['id_ruta'];
                $cliente['id_persona'] = $id_persona;
                $cliente['estado'] = $data['estado'];
            }
            $this->clientesmodel->actualizar($id_cliente,$cliente);

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

    public function cargar_map($latitud,$longuitud){

        $this->load->library('googlemaps');
        $config['center'] = $latitud.','.$longuitud;
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $latitud.','.$longuitud;
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        if(!empty($this->session->userdata('id_empresa'))){
        $clientes = $this->clientesmodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($clientes));
        }
    }

    public function obtener_por_ruta($id_ruta)
    {
        if(!empty($this->session->userdata('id_empresa'))){
            $clientes = $this->clientesmodel->obtener_por_ruta($id_ruta);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($clientes));
        }
    }

}