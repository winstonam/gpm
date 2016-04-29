<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 21/03/2016
 * Time: 01:21 AM
 */

class Rutas_model extends CI_Model {

    public function obtener()
    {
        return $this->db
            ->select('rutas.*,empresa.Nombre_Empresa')
            ->from('rutas')
            ->join('empresa', 'rutas.id_empresa = empresa.id_empresa',"left")
            ->where(array('empresa.id_empresa' => $this->session->userdata('id_empresa')))
            ->get()
            ->result();
    }

    /**
     * Guardar empresa
     * @param array $data
     * @return boolean
     */
    public function guardar($data)
    {
        $this->db->trans_start();
        $this->db->insert('rutas', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }

    /**
     * Actualizar empresa
     * @param integer $id
     * @param array
     * @return boolean
     */
    public function actualizar($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id_ruta', $id);
        $this->db->update('rutas', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
            return false;
        return true;
    }
}

