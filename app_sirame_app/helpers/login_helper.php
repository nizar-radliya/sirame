<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('login_helper'))
{
	function log_admopr(){
		$CI =& get_instance();
		$level = $CI->session->userdata('level');
		if ($level!='Administrator' AND $level!='Operator') {
			redirect('main');
		}
	}

	function log_adm(){
		$CI =& get_instance();
		$level = $CI->session->userdata('level');
		if ($level!='Administrator') {
			redirect('main');
		}
	}

	function log_opr(){
		$CI =& get_instance();
		$level = $CI->session->userdata('level');
		if ($level!='Operator') {
			redirect('main');
		}
	}

	function log_pemohon(){
		$CI =& get_instance();
		$idpemohon = $CI->session->userdata('idpemohon');
		if (empty($idpemohon)) {
			redirect('main');
		}
	}

	function log_pengunjung(){
		$CI =& get_instance();
		$idpengunjung = $CI->session->userdata('idpengunjung');
		if (empty($idpengunjung)) {
			redirect('main');
		}
	}

	function permission($idmenu){
		$CI = get_instance();
		$CI->load->model('read');
		$idgroup = $CI->session->userdata('idgroup');
		$table = 'permission';
		$kode = array(
			'idmenu' => $idmenu,
			'idgroup' => $idgroup,
			'akses' => '1'
		);
		$permission = $CI->read->read_array($table, $kode);
		if (empty($permission)) {
			$CI->session->set_flashdata('error', 'Saat ini anda tidak memiliki akses untuk halaman tersebut.');
			redirect('dashboard');
		}
	}

	function menu($idmenu){
		$CI = get_instance();
		$CI->load->model('read');
		$idgroup = $CI->session->userdata('idgroup');
		$table = 'permission';
		$kode = array(
			'idmenu' => $idmenu,
			'idgroup' => $idgroup,
			'akses' => '1'
		);
		$permission = $CI->read->read_array($table, $kode);
		if (empty($permission)) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
?>
