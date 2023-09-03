<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('recaptcha','form_validation'));
	}

	public function index()
	{
		akses(6);
		$this->load->model('read');
		$data['title'] = webname().' - Masuk';
		$data['view'] = 'frontend/login';
		$data['menu'] = 'masuk';
		$this->load->library(array('recaptcha','form_validation'));
		$data['recaptcha_html'] = $this->recaptcha->render();

		$this->load->view('frontend/main', $data);
	}

	public function login()
	{
		$this->load->model('read');
		$this->load->helper('read_helper');

		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);

		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('error', 'Gagal Masuk: validasi reCAPTCHA wajib dilakukan.');
			redirect('log');
		} else {
			function get_mysqli()
			{
				$db = (array)get_instance()->db;
				return mysqli_connect('localhost', $db['username'], $db['password'], $db['database']);
			}

			function anti($data)
			{
				$filter_sql = mysqli_real_escape_string(get_mysqli(), stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
				return $filter_sql;
			}

			$table = 'pengguna';
			$user = array(
				'username' => anti($this->input->post('user')),
				'password' => md5(anti($this->input->post('pass'))),
				'status' => '1'
			);

			$check = $this->read->read_array($table, $user);

			if (!empty($check)) {
				foreach ($check as $ses) {
					$data_session = array(
						'idpengguna' => $ses->idpengguna,
						'nama' => $ses->nama,
						'username' => $ses->username,
						'level' => $ses->level,
						'idgroup' => $ses->idgroup,
						'role' => read($ses->idgroup,'group','idgroup')[0]->role,
						'email' => $ses->email,
						'hp' => $ses->hp,
						'foto' => $ses->foto
					);
					$this->session->set_userdata($data_session);
					redirect('dashboard');
				}
			} else {
				$table = 'pemohon';
				$user = array(
					'email' => anti($this->input->post('user')),
					'password' => md5(anti($this->input->post('pass')))
				);

				$check = $this->read->read_array($table, $user);

				if (!empty($check)) {
					foreach ($check as $ses) {
						$data_session = array(
							'idpemohon' => $ses->idpemohon,
							'nama' => $ses->nama,
							'email' => $ses->email,
							'hp' => $ses->hp,
							'noktp' => $ses->noktp,
							'alamat' => $ses->alamat
						);
						$this->session->set_userdata($data_session);
						redirect('pemohon');
					}
				} else {
					$this->session->set_flashdata('error', 'Gagal Masuk: username dan/atau password tidak terdaftar.');
					redirect('log');
				}
			}
		}
	}

	public function logout()
	{
		$data_session = array(
			'idpengguna',
			'nama',
			'username',
			'level',
			'email',
			'hp',
			'foto');
		$this->session->unset_userdata($data_session);
		session_destroy();
		redirect('log');
	}

}

?>
