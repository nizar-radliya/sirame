<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alte extends CI_Controller {

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
		$data['view'] = 'temp/publik';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->helper("format_helper");
		$table = 'pengumuman';
		$order = 'waktu';
		$sort = 'DESC';
		$data['pengumuman'] = $this->read->read_one($table, $order, $sort);

		$this->load->view('temp/main', $data);
	}
}
