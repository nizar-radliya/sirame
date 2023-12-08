<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('recaptcha','form_validation'));
		$this->menu = 'daftar';
		akses(5);
	}

	public function index()
	{
		$data['title'] = webname().' - Daftar Pemohon';
		$data['view'] = 'frontend/daftar';
		$data['menu'] = $this->menu;
		$data['recaptcha_html'] = $this->recaptcha->render();

		$get_kabkota = $this->db->select('*')->from('provinsi')->get();
		$data['provinsi'] = $get_kabkota->result();

		$data['jk']  = array('Laki-Laki','Perempuan');
		$data['wn']  = array('WNI','WNA');

		$this->load->view('frontend/main', $data);
		$this->load->library(array('recaptcha'));
	}

	public function add_ajax_kota($id_prov)
	{
		$this->load->model('read');
		$query = $this->db->get_where('kota', array('id_prov' => $id_prov));
		$data = "<option value='' selected disabled>Pilih Kabupaten/Kota</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id_kota . "'>" . $value->nama_kota . "</option>";
		}
		echo $data;
	}

	public function add_ajax_kec($id_kota)
	{
		$this->load->model('read');
		$query = $this->db->get_where('kecamatan', array('id_kota' => $id_kota));
		$data = "<option value='' selected disabled>Pilih Kecamatan</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id_kec . "'>" . $value->nama_kec . "</option>";
		}
		echo $data;
	}

	public function add()
	{
		$this->load->model('create');
		$this->load->model('read');

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

		$table = 'pemohon';
		$nim = array('email' => $this->input->post('email'),'noktp' => $this->input->post('noktp'));
		$check = $this->read->read_array($table, $nim);

		if (empty($check)) {
			$data = array(
				'password' => anti(md5($this->input->post('password'))),
				'noktp' => anti($this->input->post('noktp')),
				'nama' => anti(ucwords($this->input->post('nama'))),
				'jk' => anti($this->input->post('jk')),
				'alamat' => anti($this->input->post('alamat')),
				'id_prov' => anti($this->input->post('id_prov')),
				'id_kota' => anti($this->input->post('id_kota')),
				'id_kec' => anti($this->input->post('id_kec')),
				'kodepos' => anti($this->input->post('kodepos')),
				'pekerjaan' => anti($this->input->post('pekerjaan')),
				'wn' => "WNI",
				'email' => anti($this->input->post('email')),
				'hp' => anti($this->input->post('hp'))
			);

			$data = $this->security->xss_clean($data);

			if ($this->create->create_one($table, $data)) {
				$this->session->set_flashdata('success', 'Registrasi berhasil: silakan gunakan email dan password untuk login layanan.');
				redirect('daftar');
			} else {
				$this->session->set_flashdata('error', 'Registrasi gagal: data tidak tersimpan ke server.');
				redirect('daftar');
			}
		} else {
			$this->session->set_flashdata('error', 'Registrasi gagal: Email atau Nomor KTP sudah pernah didaftarkan.');
			redirect('daftar');
		}
	}

	public function logout()
	{
		$data_session = array(
			'idpemohon',
			'nama',
			'email',
			'noktp',
			'alamat',
			'hp');
		$this->session->unset_userdata($data_session);
		session_destroy();
		redirect('main');
	}

}

?>
