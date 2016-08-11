<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 22/03/2016
 * Time: 10:50 AM
 */
class RutaEmpleado_Model extends CI_Model
{

    public function obtenerRutas()
    {
        //$q = $this->db->getwhere('v_clientes');
        $q=$this->db->get_where('rutas', array('id_empresa' => $this->session->userdata('id_empresa')));
        return $q->result_array();
    }

        public function obtenerAllRutas()
    {
        //$q = $this->db->getwhere('v_clientes');
        $q=$this->db->get_where('vw_empleadoruta', array('id_empresa' => $this->session->userdata('id_empresa')));
        return $q->result_array();
    }

    public function obtenerEmpleado()
    {
        $idemp=$this->session->userdata('id_empresa');
        $where="id_empresa='$idemp' and (id_cargo=4 or id_cargo=5)";
        $this->db->where($where);
        $this->db->from('v_empleados');
        $query=$this->db->get();

        return $query->result_array();
    }

        public function obtenerRutaEmpleado( $data)
    {
        $idemp=$this->session->userdata('id_empresa');
        $where="id_empresa='$idemp' and id_ruta='$data'";
        $this->db->where($where);
        $this->db->from('vw_empleadoruta');
        $query=$this->db->get();
        /* $q = $this->db->get_where('vw_empleadoruta', array('id_ruta' => $data, 'id_empresa'=$idemp));
        return $q->result_array();*/

        return $query->result_array();
    }
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('ruta_empleado', $data);
        $id_persona= $this->db->insert_id();
        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE)
            return $id_persona;
        return 0;
    }

    // public function actualizar($id, $data)
    // {
    //     $this->db->trans_start();
    //     $this->db->where('id_empleado', $id);
    //     $this->db->update('empleado', $data);
    //     $this->db->trans_complete();
    //     if($this->db->trans_status() === FALSE)
    //         return false;
    //     return true;
    // }

}