<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Url_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cadastraUrl($url)
    {
        if ($this->db->insert('url', $url)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUrls()
    {
        $this->db->select('*');
        $this->db->from('url');
        $this->db->join('usuario', 'url.usuario_idusuario = usuario.idusuario');
        $this->db->join('pessoa', 'pessoa.idpessoa = usuario.pessoa_idpessoa');
        $this->db->join('requisicao', 'url.idurl = requisicao.url_idurl');
        $this->db->order_by('url.inserido');

        $query = $this->db->get()->result();
        return $query;
    }
}
