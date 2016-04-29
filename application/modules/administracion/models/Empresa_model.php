<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Empresa_model extends CI_Model {

    public function obtener()
    {
        $q = $this->db->get('v_empresas');
        return $q->result_array();
    }

    public function obtener_empresa_actual()
    {
        $q=$this->db->get_where('v_empresas', array('id_empresa' => $this->session->userdata('id_empresa')));

        return $q->row_array();
    }

    /**
     * Guardar empresa
     * @param array $data
     * @return boolean
     */
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('empresa', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar empresa
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_empresa', $id);
        $this->db->update('empresa', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

