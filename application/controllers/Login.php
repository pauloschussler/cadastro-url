<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        if ((isset($_SESSION['active'])) && $_SESSION['active']) {
            redirect('Index');
        } else {
            $this->load->view('Import_View');
            $this->load->view('Login_View');
        }
    }


    public function verificaLogin()
    {
        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);

        $this->load->model('Login_Model');

        if ($this->Login_Model->verificaLogin($email, $senha)) {
            $this->session->set_userdata('email', $_POST['email']);
            $_SESSION['active'] = true;
            redirect('Index');
        } else {
            $dados['erro'] = true;
            $this->load->view('Import_View');
            $this->load->view('Login_View', $dados);
        }
    }
    public function Logout()
    {
        $_SESSION['active'] = false;
        $this->session->sess_destroy();
        redirect('Login');
    }
}
