<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->menu = 'profil';
		$this->load->helper('read_helper');
		$this->load->library(array('recaptcha','form_validation'));
		akses(1);
	}

	public function index()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function sambutan()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_sambutan';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function tentang()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_tentang';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function tupoksi()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_tupoksi';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function binamarga()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_binamarga';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function sda()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_sda';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function ciptakarya()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_ciptakarya';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function taru()
	{
		$this->load->model('read');
		$data['title'] = webname().' - Profil';
		$data['view'] = 'frontend/profil_taru';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}
}
