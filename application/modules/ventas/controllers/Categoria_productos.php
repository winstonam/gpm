<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class Categoria_productos extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('administracion/Categoria_productos_model', 'cpmodel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/categorias_producto_empresa.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_dir_ventas') . "categorias_producto_lista";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_dir_ventas') . "categorias_producto_registrar", '', TRUE),
        );
        // $data['css_data'] = base_url().'assets/plugins/select2/select2.min.css';

        $this->load->view($this->_container, $data);
    }

    public function obtener()
    {
        $categoria_productos = $this->cpmodel->obtener();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($categoria_productos));
    }

    public function guardar()
    {
        //Validar archivo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Nombre_categoria', 'Nombre de la categoria', 'required|max_length[35]');
        $this->form_validation->set_rules('descripcion', 'Precio mensual', 'required|max_length[100]');
        $this->form_validation->set_rules('estado', 'Defina el estado de la categoría', 'required');
        $response['estado'] = 0;
        $response['mensaje'] = MSJ_RG_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();
            $this->db->trans_start();
            unset($data['id_categoria']);
            $data = $this->security->xss_clean($data);

            $this->cpmodel->guardar($data);
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
        $this->form_validation->set_rules('id_categoria', 'Categoria de producto', 'required|integer|greater_than[0]',
            array(
                'required' => 'Debe seleccionar una categoria válida',
                'integer' => 'Categoria seleccionada no válida',
                'greater_than' => 'Categoria seleccionada no válida'
            ));

        $this->form_validation->set_rules('Nombre_categoria', 'Nombre de la categoria', 'required|max_length[35]');
        $this->form_validation->set_rules('descripcion', 'descripción categoria', 'max_length[100]');
        $this->form_validation->set_rules('estado', 'Defina el estado de la categoría', 'required|integer');

        $response['estado'] = 0;
        $response['mensaje'] = MSJ_ACT_FAIL;

        if ($this->form_validation->run() == FALSE) {
            //Si la validación falla
            // $response['estado'] = 0;
            $response['mensaje'] = validation_errors();
        } else {
            $data = $this->input->post();

            $this->db->trans_start();

            $data = $this->security->xss_clean($data);
            $id = $data['id_categoria'];
            unset($data['id_categoria']);

            $this->cpmodel->actualizar($id, $data);

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