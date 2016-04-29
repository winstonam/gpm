<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 23/03/2016
 * Time: 01:22 AM
 */
class Usuario_model extends CI_Model {


    public function validar_usuario($usuario,$contrasena)
    {
        $stored_procedure = "CALL VerificarDatosWeb(?,?) ";
        $result = $this->db->query($stored_procedure,array('usuario'=>$usuario,'contrasena'=>sha1($contrasena)));
        return $result->row();
    }

    public function validar_usuario_admin($usuario,$contrasena)
    {
        $stored_procedure = "CALL VerificarDatosWebAdmin(?,?) ";
        $result = $this->db->query($stored_procedure,array('usuario'=>$usuario,'contrasena'=>sha1($contrasena)));
        return $result->row();
    }
}