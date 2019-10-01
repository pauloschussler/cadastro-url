<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
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

			$dados['navbar'] = 1;
			
			$this->load->view('Import_View');
			$this->load->view('Header_View', $dados);
			$this->load->view('Menu_View');
		}
	}
}
