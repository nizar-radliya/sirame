<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->menu = 'dashboard';
		$this->load->model('read');
		$this->load->model('row');
    }

	public function index()
	{
		log_adm();
        $data['title'] = webname().' - Dashboard';
        $data['view'] = 'backend/dashboard';
		$data['menu'] = $this->menu;

		$tables = array('kkpr', 'pemohon');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp');
		$condition = array('kkpr.idpemohon = pemohon.idpemohon');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['nomor'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$table = 'kkpr';
		$data['kkpr'] = $this->row->row_one($table);

		$id = array('statuskkpr' => 'BELUM UPLOAD KELENGKAPAN');
		$data['kkpr1'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'VERIFIKASI KELENGKAPAN');
		$data['kkpr2'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR VALID');
		$data['kkpr3'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR TIDAK VALID');
		$data['kkpr4'] = $this->row->row_array($table, $id);

		$this->load->view('backend/main', $data);
	}
}
