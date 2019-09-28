<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function verificaLogin($email, $senha)
    {
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        $q = $this->db->get('usuario');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
