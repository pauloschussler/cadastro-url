<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	if(!function_exists('set_msg')){
		function set_msg($msg=null){
			$ci = & get_instance();
			$ci->session->set_userdata('aviso', $msg);
		}
	}
	if (!function_exists('get_msg')){
		$ci = & get_instance();
		$retorno = $ci->session->unset_userdata('aviso');
		return $retorno;
	}
	

?>