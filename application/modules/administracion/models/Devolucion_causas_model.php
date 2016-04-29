<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Devolucion_causas_model extends CI_Model {

    public function obtener()
    {
        $q = $this->db->get('devolucion_causa');
        return $q->result_array();
    }

    /**
     * Guardar devolucion_causa
     * @param array $data
     * @return boolean
     */
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('devolucion_causa', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar devolucion_causa
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_causa_devolucion', $id);
        $this->db->update('devolucion_causa', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

