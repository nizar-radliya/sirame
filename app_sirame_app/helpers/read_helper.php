<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('read_helper')) {

	function readgroup($idpengguna)
	{
		$CI = get_instance();
		$get = $CI->db->select('pengguna.*, group.*')->from('pengguna, group')->where('pengguna.idgroup = group.idgroup')->where('pengguna.idpengguna = '.$idpengguna)->get();
		$read = $get->result();
		return $read;
	}

    function read($id, $table, $by)
    {
        $CI = get_instance();
        $CI->load->model('read');
        $kode = array($by => $id);
        $read = $CI->read->read_array($table, $kode);
        return $read;
    }

    function read_kkpr($id, $table, $by)
    {
        $CI = get_instance();
        $CI->load->model('read');
        $kode = array($by => "$id");
        $read = $CI->read->read_array($table, $kode);
        return $read;
    }

	function readkelengkapan($id, $idjenis)
	{
		$CI = get_instance();
		$CI->load->model('read');
		$kode = array('nomor' => $id, 'idjenis' => $idjenis);
		$read = $CI->read->read_array('kkpr_kelengkapan', $kode);
		return $read;
	}

	function readkota($idkota)
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'kota';
		$kode = array('id_kota' => $idkota);
		$readkel = $CI->read->read_array($table, $kode);

		return $readkel;
	}

	function readkec($idkec)
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'kecamatan';
		$kode = array('id_kec' => $idkec);
		$readkel = $CI->read->read_array($table, $kode);

		return $readkel;
	}

	function readkotabyprov($idprov)
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'kota';
		$kode = array('id_prov' => $idprov);
		$readkel = $CI->read->read_array($table, $kode);

		return $readkel;
	}

	function readkecbykota($idkota)
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'kecamatan';
		$kode = array('id_kota' => $idkota);
		$readkel = $CI->read->read_array($table, $kode);

		return $readkel;
	}

	function readkelbykec($idkec)
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'kelurahan';
		$kode = array('id_kec' => $idkec);
		$readkel = $CI->read->read_array($table, $kode);

		return $readkel;
	}

	function readluas($thn, $idlahan)
	{
		$CI = get_instance();
		$CI->load->model('read');
		$kode = array('thn' => $thn, 'idlahan' => $idlahan);
		$read = $CI->read->read_array('penggunaan', $kode);
		return $read;
	}

	function read_rs2($id, $table, $by, $nourut)
	{
		$CI = get_instance();
		$CI->load->model('read');
		$kode = array($by => $id, 'nourut >' => $nourut);
		$read = $CI->read->read_array($table, $kode);
		return $read;
	}

	function read_xy($idbangunan)
	{
		$CI = get_instance();
		$get = $CI->db->select('X(SHAPE) AS lat, Y(SHAPE) AS lng')->from('bangunan_shp')->where('idbangunan = '.$idbangunan)->get();
		$read = $get->result();
		return $read;
	}

	function readtahun()
	{
		$CI = get_instance();
		$CI->load->model('read');

		$table = 'tahun';
		$kode = array('status' => '1');
		$readtahun = $CI->read->read_array($table, $kode);

		return $readtahun;
	}
}

?>
