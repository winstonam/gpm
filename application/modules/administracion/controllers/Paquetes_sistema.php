<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Paquetes_sistema extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_admin();
        $this->load->model('administracion/Paquetes_sistema_model', 'psistemasmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/paquetes_sistema.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_dir_admin') . "paquetes_sistema_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_admin') . "paquetes_sistema_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        $paquetes_sistema = $this->psistemasmodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($paquetes_sistema));
    }

    public function guardar()
    {

        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Nombre_Paquete', 'Nombre del paquete', 'required|max_length[100]');
        $this->form_validation->set_rules('Precio_Mensual', 'Precio mensual', 'required|decimal');
        $this->form_validation->set_rules('estado', 'Defina el estado del paquete', 'required|integer');
        $this->form_validation->set_rules('Numero_Usuarios_Moviles', 'Cantidad dispositivos moviles', 'required|integer',
            array(
                'required' => 'Debe definir un numero de Usuarios_Moviles para este paquete',
                'integer' => 'Se requiere un numero entero'
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

            unset($data['id_paquete']);
            $data = $this->security->xss_clean($data);

            $this->psistemasmodel->guardar($data);

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
        $this->form_validation->set_rules('id_paquete', 'Paquete de sistema', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar un paquete válido',
                'integer' => 'Paquete seleccionado no válido',
                'greater_than' => 'Paquete seleccionado no válido'
            ));

        $this->form_validation->set_rules('Nombre_Paquete', 'Nombre del paquete', 'required|max_length[100]');
        $this->form_validation->set_rules('Precio_Mensual', 'Precio mensual', 'required|decimal');
        $this->form_validation->set_rules('estado', 'Defina el estado del paquete', 'required|integer');
        $this->form_validation->set_rules('Numero_Usuarios_Moviles', 'Cantidad dispositivos moviles', 'required|integer',
            array(
                'required' => 'Debe definir un numero de Usuarios_Moviles para este paquete',
                'integer' => 'Se requiere un numero entero'
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
            $id = $data['id_paquete'];
            unset($data['id_paquete']);
            $this->psistemasmodel->actualizar($id, $data);

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