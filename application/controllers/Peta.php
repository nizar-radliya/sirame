<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peta extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->menu = 'peta';
		$this->load->helper('read_helper');
		$this->load->library(array('recaptcha','form_validation'));
		akses(2);
    }

	public function index()
	{
		$this->load->model('read');
        $data['title'] = webname().' - Peta';
        $data['view'] = 'frontend/peta/peta';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

        $this->load->view('frontend/peta/main_map', $data);
	}

	public function kkpr()
	{
		$this->load->model('read');
        $data['title'] = webname().' - Peta';
        $data['view'] = 'frontend/peta/kkpr';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

        $this->load->view('frontend/peta/main_map', $data);
	}

	public function polaruang()
	{
		$this->load->model('read');
		$this->load->helper('read_helper');

		$id = $this->input->get('id');
		$table          = 'polaruang';
		$where            = array('idpr' => $id);
		$data['polaruang']    = $this->read->read_array($table, $where);

		$this->load->view('frontend/modal_polaruang', $data);
	}

	public function jalankab()
	{
		$this->load->model('read');

		$id = $this->input->get('id');
		$table          = 'tr_jalankab';
		$where            = array('idjalankab' => $id);
		$data['jalankab']    = $this->read->read_array($table, $where);

		$this->load->view('frontend/modal_jalankab', $data);
	}

	public function jalanlain()
	{
		$this->load->model('read');

		$id = $this->input->get('id');
		$table          = 'tr_jalanlain';
		$where            = array('idjalanlain' => $id);
		$data['jalanlain']    = $this->read->read_array($table, $where);

		$this->load->view('frontend/modal_jalanlain', $data);
	}
}
