<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->menu = 'lapor';
		$this->load->helper('read_helper');
		$this->load->library(array('recaptcha','form_validation'));
	}

	public function index()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Pelaporan PKKPR';
		$data['view'] = 'frontend/pelaporan';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();
		akses(1);

		$this->load->view('frontend/main', $data);
	}
}
