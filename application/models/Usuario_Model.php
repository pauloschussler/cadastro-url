<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getTipo($email)
    {
        $this->db->select('tipousuario_idtipousuario');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getUsuario($email)
    {
        $this->db->select('idusuario');
        $this->db->from('usuario');
        $this->db->where('usuario.email', $email);
        $query = $this->db->get()->row();
        return $query;
    }
}
