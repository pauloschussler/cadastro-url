<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Url extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        if (!$_SESSION['active']) {
            redirect('Login');
        } else {
            $this->load->view('Import_View');
            $this->load->view('Header_View');
        }
    }
    public function cadastraUrl()
    {
        if (!$_SESSION['active']) {
            redirect('Login');
        } else {

            if (isset($_GET['resposta'])) {
                $resposta = $_GET['resposta'];
                if ($resposta == 1) {
                    $dados['sucesso'] = true;
                } else {
                    $dados['erro'] = true;
                }
            } else {
                $dados = null;
            }

            $this->load->view('Import_View');
            $this->load->view('Header_View');
            $this->load->view('Url/CadastraUrl_View', $dados);
        }
    }

    public function realizaCadastroUrl()
    {
        if (!$_SESSION['active']) {
            redirect('Login');
        } else {

            $email = $_SESSION['email'];

            $this->load->model('Usuario_Model');
            $result = $this->Usuario_Model->getUsuario($email);
            $idusuario = $result->idusuario;
            $data = date('Y-m-d');
            $hora = date('H:m:s');

            $url = $_POST['url'];
            $finalidadeurl = $_POST['finalidadeurl'];
            $descricaourl = $_POST['descricaourl'];

            $url = array(
                'url' => $url,
                'finalidadeurl' => $finalidadeurl,
                'descricaourl' => $descricaourl,
                'datacadastro' => $data,
                'horacadastro' => $hora,
                'usuario_idusuario' => $idusuario
            );

            $this->load->model('Url_Model');

            if ($this->Url_Model->cadastraUrl($url)) {
                redirect('Url/cadastraUrl?resposta=1');
            } else {
                redirect('Url/cadastraUrl?resposta=2');
            }
        }
    }

    public function visualizarUrl()
    {
        if (!$_SESSION['active']) {
            redirect('Login');
        } else {
            $this->load->model('Url_Model');
            $urls = $this->Url_Model->getUrls();
            $i = 0;
            foreach ($urls as $url) {
                $date = new DateTime($url->datacadastro);
                $time = new DateTime($url->horacadastro);

                $urls[$i]->datacadastro = $date->format('d/m/Y');
                $urls[$i]->horacadastro = $time->format('H:m');

                $i++;
            }

            $dados['urls'] = $urls;
            $this->load->view('Import_View');
            $this->load->view('Header_View');
            $this->load->view('Url/VisualizarUrl_View', $dados);
        }
    }
}
