<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->title = webname().' - File';
		$this->menu = 'file';
		$this->load->library(array('recaptcha','form_validation'));
		akses(3);
	}

	public function index()
	{
		$this->load->model('read');
		$this->load->model('row');
		$this->load->helper("format_helper");
		$data['title'] = $this->title;
		$data['view'] = 'frontend/file';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$table = 'file';
		$order = 'tgl';
		$sort = 'DESC';
		$where = array('sifat' => 'Public');
		$data['file'] = $this->read->read_array_order($order, $sort, $table, $where);

		$this->load->view('frontend/main', $data);
	}

	public function unduh()
	{
		$name = $this->input->get('file');
		$tipe = substr($name, -3);

		if ($tipe == 'pdf') {
			$this->output
				->set_content_type('application/pdf')
				->set_output(file_get_contents('assets/file/file/' . basename($name)));
		} else if ($tipe == 'jpg' || $tipe == 'epg' || $tipe == 'png' || $tipe == 'gif') {
			$this->output
				->set_content_type('jpeg')
				->set_output(file_get_contents('assets/file/file/' . basename($name)));
		} else {
			$this->load->helper('download');
			$data = file_get_contents("assets/file/file/" . basename($name));
			force_download($name, $data);
			//redirect('file', 'refresh');
		}
	}

	public function pemohon()
	{
		log_pemohon();
		$this->load->helper("format_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/file';

		$table = 'file';
		$order = 'tgl';
		$sort = 'DESC';
		$where = array('sifat' => 'Public');
		$data['file'] = $this->read->read_array_order($order, $sort, $table, $where);

		$this->load->view('pemohon/main',$data);
	}

}
