<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 20/03/2016
 * Time: 10:33 PM
 */
class Proveedores extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('inventario/Proveedor_model', 'proveedormodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/proveedores.js'
            ///       'https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYs1ME3qOjwLWPKG_2DWozGGMkhyGHfo'
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );
        $data['page'] = $this->config->item('gpm_sys_web_template_invent') . "proveedores_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_invent') . "proveedor_registrar", '', TRUE),
        );
        $this->load->view($this->_container, $data);

    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Nombre_Proveedor', 'Nombre_Proveedor', 'required|max_length[100]');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'required|max_length[200]');

        $this->form_validation->set_rules('Contacto_Proveedor', 'Contacto_Proveedor', 'required|max_length[100]');
        $this->form_validation->set_rules('Numero_RUC', 'Numero_RUC', 'required|max_length[20]');

        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');
        $this->form_validation->set_rules('Dias_Plazo', 'Dias_Plazo', 'required|integer');
        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            unset($data['id_proveedor']);

            $data = $this->security->xss_clean($data);


            $this->proveedormodel->guardar($data);

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
        $this->form_validation->set_rules('id_proveedor', 'proveedor', 'required|integer');
        $this->form_validation->set_rules('Nombre_Proveedor', 'Nombre_Proveedor', 'required|max_length[100]');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'required|max_length[200]');

        $this->form_validation->set_rules('Contacto_Proveedor', 'Contacto_Proveedor', 'required|max_length[100]');
        $this->form_validation->set_rules('Numero_RUC', 'Numero_RUC', 'required|max_length[20]');

        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');
        $this->form_validation->set_rules('Dias_Plazo', 'Dias_Plazo', 'required|integer');
        $this->form_validation->set_rules('id_empresa', 'empresa', 'required|integer');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_ACT_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $id_proveedor = $data['id_proveedor'];
            unset($data['id_proveedor']);

            $data = $this->security->xss_clean($data);

            $this->proveedormodel->actualizar($id_proveedor,$data );

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
        if (!empty($this->session->userdata('id_empresa'))) {
            $clientes = $this->proveedormodel->obtener();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($clientes));
        }
    }

}