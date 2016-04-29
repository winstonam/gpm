<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */
class Categoria_productos_model extends CI_Model
{

    public function obtener()
    {
        $q = $this->db->get('categoria_prod');
        return $q->result_array();
    }

    /**
     * Guardar categoria_prod
     * @param array $data
     * @return boolean
     */
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('categoria_prod', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar categoria_prod
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_categoria', $id);
        $this->db->update('categoria_prod', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

}

