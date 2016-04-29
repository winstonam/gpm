<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Tipos_pago extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Tipos_pago_model', 'tpagosmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/tipos_pago_empresa.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "tipos_pago_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "tipos_pago_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        $this->load->view($this->_container, $data);
    }

    public function obtener_tipos_pagos()
    {
        $tipos_pago = $this->tpagosmodel->obtener_tipos_pagos();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($tipos_pago));
    }

    public function guardar_tipo_pago()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('descripcion', 'Descripcion tipo pago', 'required|max_length[100]');
        $this->form_validation->set_rules('DescripcionCorta', 'Descripcion Corta tipo de pago', 'required|max_length[8]',
            array(
                'required' => 'Debe definir una descripcion corta para el tipo de pago',
                'max_length' => 'Numero maximo de caracteres es 8'
            ));

        $response['estado'] = 0;
        $response['mensaje'] = "Ocurrió un error al guardar el registro";

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();
            $this->db->trans_start();
            unset($data['id_tipo_pago']);
            $data = $this->security->xss_clean($data);

            $this->tpagosmodel->guardar_tipo_pago($data);
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

    public function actualizar_tipo_pago()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_tipo_pago', 'Tipo pago', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar un tipo de pago válido',
                'integer' => 'Tipo de pago seleccionado no válido',
                'greater_than' => 'Tipo de pago seleccionado no válido'
            ));

        $this->form_validation->set_rules('descripcion', 'Descripcion tipo pago', 'required|max_length[100]');
        $this->form_validation->set_rules('DescripcionCorta', 'Descripcion Corta tipo de pago', 'required|max_length[8]',
            array(
                'required' => 'Debe definir una descripcion corta para el tipo de pago',
                'max_length' => 'Numero maximo de caracteres es 8'
            ));

        $response['estado'] = 0;
        $response['mensaje'] = "Ocurrió un error al guardar el registro";

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();
            $this->db->trans_start();
            $data = $this->security->xss_clean($data);
            $id = $data['id_tipo_pago'];
            unset($data['id_tipo_pago']);
            $this->tpagosmodel->actualizar_tipo_pago($id, $data);
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