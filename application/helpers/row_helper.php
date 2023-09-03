<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('master_helper')) {

	function row($id, $table, $by)
	{
		$CI = get_instance();
		$CI->load->model('row');

		$kode = array($by => $id);
		$row = $CI->row->row_array($table, $kode);

		return $row;
	}

	function rowpelaporan($idpengawasan, $kategori)
	{
		$CI = get_instance();
		$CI->load->model('row');

		$kode = array('idpengawasan' => $idpengawasan, 'kategori' => $kategori);
		$row = $CI->row->row_array('pelaporan', $kode);

		return $row;
	}
}

?>
