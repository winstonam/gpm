<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Cargos_model extends CI_Model {

    public function obtener_cargos()
    {
        $q = $this->db->get('cargos');
        return $q->result_array();
    }

    /**
     * Guardar cargos
     * @param array $data
     * @return boolean
     */
    public function guardar_cargo($data)
    {
        $this->db->trans_start();
        $this->db->insert('cargos', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar cargos
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar_cargo($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_cargo', $id);
        $this->db->update('cargos', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

