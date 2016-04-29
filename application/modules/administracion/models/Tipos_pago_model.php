<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Tipos_pago_model extends CI_Model {

    public function obtener_tipos_pagos()
    {
        $q = $this->db->get('tipo_pago');
        return $q->result_array();
    }

    /**
     * Guardar tipo_pago
     * @param array $data
     * @return boolean
     */
    public function guardar_tipo_pago($data)
    {
        $this->db->trans_start();
        $this->db->insert('tipo_pago', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar tipo_pago
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar_tipo_pago($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_tipo_pago', $id);
        $this->db->update('tipo_pago', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

