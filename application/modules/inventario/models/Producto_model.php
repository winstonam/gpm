<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 27/03/2016
 * Time: 12:28 AM
 */
class Producto_model extends CI_Model
{

    public function obtener()
    {
        //$q = $this->db->getwhere('v_clientes');
        $q = $this->db->get_where('vw_producto', array('id_empresa' => $this->session->userdata('id_empresa')));
        return $q->result_array();
    }


    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('producto', $data);
        $id_proveedor = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
            return $id_proveedor;
        return 0;
    }

    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_producto', $id);
        $this->db->update('producto', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

}