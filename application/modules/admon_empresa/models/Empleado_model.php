<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 22/03/2016
 * Time: 10:50 AM
 */
class Empleado_model extends CI_Model
{

    public function obtener()
    {
        //$q = $this->db->getwhere('v_clientes');
        $q=$this->db->get_where('v_empleados', array('id_empresa' => $this->session->userdata('id_empresa')));

        return $q->result_array();
    }
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('empleado', $data);
        $id_persona= $this->db->insert_id();
        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE)
            return $id_persona;
        return 0;
    }

    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_empleado', $id);
        $this->db->update('empleado', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

}