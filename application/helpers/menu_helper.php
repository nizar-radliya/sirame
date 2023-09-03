<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('menu_helper'))
{
	function menus($idmenu){
		$CI = get_instance();
		$CI->load->model('read');
		$table = 'front';
		$kode = array(
			'idmenu' => $idmenu,
			'akses' => '1'
		);
		$permission = $CI->read->read_array($table, $kode);
		if (empty($permission)) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function akses($idmenu){
		$CI = get_instance();
		$CI->load->model('read');
		$table = 'front';
		$kode = array(
			'idmenu' => $idmenu,
			'akses' => '1'
		);
		$permission = $CI->read->read_array($table, $kode);
		if (empty($permission)) {
			$CI->session->set_flashdata('error', 'Saat ini anda tidak memiliki akses untuk halaman tersebut.');
			redirect('dashboard');
		}
	}
}
?>
