<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Paquetes_sistema_model extends CI_Model {

    public function obtener()
    {
        $q = $this->db->get('paquetes_sistema');
        return $q->result_array();
    }

    /**
     * Guardar paquetes_sistema
     * @param array $data
     * @return boolean
     */
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('paquetes_sistema', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar paquetes_sistema
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_paquete', $id);
        $this->db->update('paquetes_sistema', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

