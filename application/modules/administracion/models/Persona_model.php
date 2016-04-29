<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 22/03/2016
 * Time: 10:50 AM
 */
class Persona_model extends CI_Model
{

    public function todos()
    {
        $q = $this->db->get('persona');
        return $q->result_array();
    }
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('persona', $data);
        $id_persona= $this->db->insert_id();
        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE)
            return $id_persona;
        return 0;
    }

    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_persona', $id);
        $this->db->update('persona', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

}