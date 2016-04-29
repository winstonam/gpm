<?php

/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 22/03/2016
 * Time: 10:50 AM
 */
class Cliente_model extends CI_Model
{

    public function obtener()
    {
        //$q = $this->db->getwhere('v_clientes');
        $q = $this->db->get_where('v_clientes', array('id_empresa' => $this->session->userdata('id_empresa')));

        return $q->result_array();
    }

    public function obtener_por_ruta($id_ruta)
    {

        return $this->db
            ->select('c.*')
            ->from('v_clientes c')
            ->where(array('id_empresa' => $this->session->userdata('id_empresa')))
            ->where(array('id_ruta' => $id_ruta))
            ->order_by("latitud", "desc")
            ->order_by("longitud", "desc")
            ->get()
            ->result();
    }

    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('cliente', $data);
        $id_persona = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
            return $id_persona;
        return 0;
    }

    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_cliente', $id);
        $this->db->update('cliente', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

}