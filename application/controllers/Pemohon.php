<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		log_pemohon();
		$this->menu = 'dashboard';
		$this->title = webname().' - Dashboard';
		$this->load->model('read');
		$this->load->model('row');
		$this->load->helper('read_helper');
    }

	public function index()
	{
		$data['title'] = $this->title;
		$data['menu'] = $this->menu;
		$data['view'] = 'pemohon/dashboard';

		$idpemohon = $this->session->userdata('idpemohon');

		$table = 'pemohon';
		$id = array('idpemohon' => $idpemohon);
		$data['pemohon'] = $this->read->read_array($table, $id);

		$data['jk']  = array('Laki-Laki','Perempuan');
		$data['wn']  = array('WNI','WNA');

		$get_kabkota = $this->db->select('*')->from('provinsi')->get();
		$data['provinsi'] = $get_kabkota->result();

		$table = 'kkpr';
		$order = 'tglterbit';
		$sort = 'DESC';
		$where = array('idpemohon' => $idpemohon);
		$data['nomor'] = $this->read->read_array_order($order, $sort, $table, $where);

		$id = array('idpemohon' => $idpemohon);
		$data['kkpr'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'BELUM UPLOAD KELENGKAPAN','idpemohon' => $idpemohon);
		$data['kkpr1'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'VERIFIKASI KELENGKAPAN','idpemohon' => $idpemohon);
		$data['kkpr2'] = $this->row->row_array($table, $id);
		
		$id = array('statuskkpr' => 'PKKPR VALID','idpemohon' => $idpemohon);
		$data['kkpr3'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR TIDAK VALID','idpemohon' => $idpemohon);
		$data['kkpr4'] = $this->row->row_array($table, $id);

		$this->load->view('pemohon/main', $data);
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

	public function edit()
	{
		$this->load->model('update');
		$idpemohon = $this->session->userdata('idpemohon');
		$table = 'pemohon';
		$by = 'idpemohon';
		$data = array(
			'nama' => ucwords($this->input->post('nama')),
			'jk' => $this->input->post('jk'),
			'alamat' => $this->input->post('alamat'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kota' => $this->input->post('id_kota'),
			'id_kec' => $this->input->post('id_kec'),
			'kodepos' => $this->input->post('kodepos'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'email' => $this->input->post('email'),
			'hp' => $this->input->post('hp')
		);

		if ($this->update->update_one($table, $by, $idpemohon, $data)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil diubah.');
			redirect('pemohon');
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('pemohon');
		}
	}

	public function form_pass()
	{
		$data['title'] = $this->title;
		$data['menu'] = $this->menu;
		$data['view'] = 'pemohon/password';

		$idpemohon = $this->session->userdata('idpemohon');
		$table = 'pemohon';
		$id = array('idpemohon' => $idpemohon);
		$data['pemohon'] = $this->read->read_array($table, $id);

		$this->load->view('pemohon/main', $data);
	}

	public function pass()
	{
		$this->load->model('update');
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

		$table  = 'pemohon';
		$by     = 'idpemohon';
		$id     = $this->session->userdata['idpemohon'];
		$kode   = array('idpemohon' => $id, 'password' => md5($this->input->post('pass')));
		$check  = $this->read->read_array($table, $kode);

		if (!empty($check)) {
			$data = array(
				'password' => anti(md5($this->input->post('password')))
			);
			$data = $this->security->xss_clean($data);

			if ($this->update->update_one($table, $by, $id, $data)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: silakan login menggunakan password baru.');
				redirect('main');
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: password anda belum diubah.');
				redirect('pemohon');
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: password sekarang belum sesuai.');
			redirect('pemohon');
		}
	}
}
