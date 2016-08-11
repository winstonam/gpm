<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:14 AM
 */
class RutaEmpleado extends Rta91_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->permisos->verificar_usuario_logueado();
        $this->permisos->verificar_permiso_personal_empresa();
        $this->load->model('admon_empresa/RutaEmpleado_model', 'RutaEmpModel');
    }

    public function index()
    {
        $data['js_data'] = array(
            base_url() . 'assets/custom/rutaEmpleado.js',
            //  base_url().'assets/plugins/select2/select2.full.min.js',
        );

        $data['page'] = $this->config->item('gpm_sys_web_template_adm_emp') . "VwRutaEmpleado";
        $data['modals'] = array(
            $this->load->view($this->config->item('gpm_sys_web_template_adm_emp') . "RegistarRutaEmpleado", '', TRUE),
        );

        $this->load->view($this->_container, $data);
    }

    public function obtenerRutas()
    {
        $cargos = $this->RutaEmpModel->obtenerRutas();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($cargos));
    }

    public function obtnerEmpleado()
    {
        $empleado=$this->RutaEmpModel->obtenerEmpleado();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($empleado));
    }

        public function obtnerRutaEmpleado($data=null)
    {
  
        $empleado=$this->RutaEmpModel->obtenerRutaEmpleado($data);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($empleado));
    }
       public function obtenerAllRutas()
       {
           $empleado=$this->RutaEmpModel->obtenerAllRutas();
          $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($empleado));
       }
    public function guardar(){
    //Validar archivo
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_ruta', 'No seleccion la Ruta', 'required|integer');
            $this->form_validation->set_rules('id_empleado', 'Seleccione el Empleado', 'required|integer');

            $response['mensaje'] = MSJ_RG_FAIL;

            if ($this->form_validation->run() == FALSE) {
                //Si la validación falla
                $response['estado'] = 0;
                $response['mensaje'] = validation_errors();
            } else {
                $data = $this->input->post();
                $this->db->trans_start();

                $rutaEmp['id_ruta']=$data['id_ruta'];
                $rutaEmp['id_empleado']=$data['id_empleado'];

                $rutaEmp = $this->security->xss_clean($rutaEmp);
                $this->RutaEmpModel->guardar($rutaEmp);

                $data = $this->security->xss_clean($data);

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
}