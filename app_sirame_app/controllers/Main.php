<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->menu = 'main';
		$this->load->helper('read_helper');
		$this->load->library(array('recaptcha','form_validation'));
	}

	public function index()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Beranda';
		$data['view'] = 'frontend/publik';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->helper("format_helper");
		$table = 'pengumuman';
		$order = 'waktu';
		$sort = 'DESC';
		$limit = 1;
		$start = 0;
		$data['pengumuman'] = $this->read->read_limit($table,$order,$sort,$limit,$start);

		$table = 'file';
		$order = 'tgl';
		$sort = 'DESC';
		$limit = 3;
		$start = 0;
		$data['file'] = $this->read->read_limit($table,$order,$sort,$limit,$start);

		$this->load->view('frontend/main', $data);
	}
}
