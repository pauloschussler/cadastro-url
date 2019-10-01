<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        if ( !isset($_SESSION['active']) || !$_SESSION['active']) {
            redirect('Login');
        } else {
            $email = $_SESSION['email'];

            $this->load->model('Usuario_Model');
            $result = $this->Usuario_Model->getTipo($email);
            $tipo = $result->tipousuario_idtipousuario;

            $this->load->view('Import_View');
            $this->load->view('Header_View');
            $this->load->view('Usuario/Usuario_View');
        }
    }
}
