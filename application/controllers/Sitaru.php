<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitaru extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('read');
		$this->menu = 'sipetarung';
		$this->title = webname().' - PETA SIMTARU';
    }

	public function index()
	{
		permission(25);
		$this->load->helper("format_helper");
		$data['menu'] = $this->menu;
		$data['title'] = $this->title;
		$data['view'] = 'backend/sipetarung';

		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('ST_AsText(ST_GeomFromWKB(SHAPE)) AS polyline', 'ST_AsText(ST_Centroid(SHAPE)) AS center','X(SHAPE) AS lnga','Y(SHAPE) AS lata','permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.id_kota AS kotapemohon', 'pemohon.noktp', 'pemohon.*', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('backend/main', $data);
	}

	public function permohonan()
	{
		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.id_kota AS kotapemohon', 'pemohon.noktp', 'pemohon.*', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('nopermohonan = '.$this->input->get('id'),'permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/modal_permohonan', $data);
	}
}
