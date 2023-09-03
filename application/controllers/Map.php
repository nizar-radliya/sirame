<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->menu = 'map';
		$this->title = webname().' - Peta RTRW';
    }

	public function index()
	{
		permission(1);
		$this->load->model('read');
		$data['menu'] = $this->menu;
		$data['title'] = $this->title;
		$data['view'] = 'backend/map';

        $this->load->view('backend/main', $data);
	}

	public function rtrw()
	{
		$data['menu'] = 'map';
		$data['title'] = $this->title;
		$data['view'] = 'pemohon/map';
		$this->load->model('read');

        $this->load->view('pemohon/main', $data);
	}

	public function skrr()
	{
		permission(25);
		$this->load->model('read');
		$this->load->helper("format_helper");
		$data['menu'] = 'peta-skrr';
		$data['title'] = webname().' - Peta SKRR';
		$data['view'] = 'backend/skrr/skrr_peta';

		$tables = array('skrr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('skrr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('skrr.idpemohon = pemohon.idpemohon', 'skrr.id_kec = kecamatan.id_kec', 'skrr.id_kel = kelurahan.id_kel');
		$order = 'skrr.tgl';
		$sort = 'DESC';
		$group = '';
		$data['skrr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

	public function siteplan()
	{
		permission(45);
		$this->load->model('read');
		$this->load->helper("format_helper");
		$data['menu'] = 'peta-siteplan';
		$data['title'] = webname().' - Peta Site Plan';
		$data['view'] = 'backend/siteplan/siteplan_peta';

		$tables = array('siteplan', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('siteplan.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('siteplan.idpemohon = pemohon.idpemohon', 'siteplan.id_kec = kecamatan.id_kec', 'siteplan.id_kel = kelurahan.id_kel');
		$order = 'siteplan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['siteplan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

	public function polaruang()
	{
		$this->load->model('read');

		$id = $this->input->get('id');
		$table          = 'polaruang';
		$where            = array('idpr' => $id);
		$data['polaruang']    = $this->read->read_array($table, $where);

		$this->load->view('frontend/modal_polaruang', $data);
	}

	public function cetak()
	{
		permission(1);
		$data['title'] = $this->title;
		$data['view'] = 'backend/map_cetak';
		$data['menu'] = $this->menu;

		$this->load->view('backend/main', $data);
	}
}
