<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->title = webname().' - Pemohon';
        $this->menu = 'pemohon';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		permission(15);
        $this->load->helper("read_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/pemohon/pemohon';

		$table = 'pemohon';
		$order = 'nama';
		$sort = 'ASC';
		$data['pemohon'] = $this->read->read_one($table, $order, $sort);

        $this->load->view('backend/main',$data);
	}

	public function form_add()
	{
		permission(16);
		$data['title'] = $this->title;
		$data['menu'] = $this->menu;
		$data['view'] = 'backend/pemohon/pemohon_add';

		$data['jk']  = array('Laki-Laki','Perempuan');
		$data['wn']  = array('WNI','WNA');

		$get_kabkota = $this->db->select('*')->from('provinsi')->get();
		$data['provinsi'] = $get_kabkota->result();

		$this->load->view('backend/main', $data);
	}

	public function add()
	{
		permission(16);
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
				$this->session->set_flashdata('success', 'Pendaftaran berhasil: silakan gunakan nomor KTP untuk masuk ke halaman pemohon.');
				redirect('pemohon-adm');
			} else {
				$this->session->set_flashdata('error', 'Pendaftaran gagal: data tidak tersimpan ke server.');
				redirect('pemohon-adm/form-add');
			}
		} else {
			$this->session->set_flashdata('error', 'Pendaftaran gagal: Email atau Nomor KTP sudah pernah didaftarkan.');
			redirect('pemohon-adm/form-add');
		}
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

    public function form_edit()
    {
		permission(17);
		$this->load->model('read');
		$this->load->helper('read_helper');
		$data['title']  = $this->title;
		$data['view'] = 'backend/pemohon/pemohon_edit';
		$data['menu'] = $this->menu;

		$id = $this->uri->segment(3);

		$table = 'pemohon';
		$id = array('idpemohon' => $id);
		$data['pemohon'] = $this->read->read_array($table, $id);

		$data['jk']  = array('Laki-Laki','Perempuan');
		$data['wn']  = array('WNI','WNA');

		$get_kabkota = $this->db->select('*')->from('provinsi')->get();
		$data['provinsi'] = $get_kabkota->result();

		$this->load->view('backend/main', $data);
    }

    public function edit()
    {
		permission(17);
		$this->load->model('read');
		$this->load->model('update');
		$this->load->helper('read_helper');

		$id = $this->input->post('idpemohon');
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
			/*'wn' => $this->input->post('wn'),*/
			'email' => $this->input->post('email'),
			'hp' => $this->input->post('hp')
		);

		if ($this->update->update_one($table, $by, $id, $data)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
			redirect('pemohon-adm');
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('pemohon-adm/form-edit/'.$id);
		}
    }

    public function form_pass()
    {
		permission(17);
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] = $this->menu;
		$data['view'] = 'backend/pemohon/pemohon_pass';

		$table = 'pemohon';
		$id = array('idpemohon' => $this->uri->segment(3));
		$data['pemohon'] = $this->read->read_array($table, $id);

		$this->load->view('backend/main', $data);
    }

    public function edit_pass()
    {
		permission(17);
        $this->load->model('update');

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
		$id     = $this->input->post('idpemohon');
		$data = array(
			'password' => anti(md5($this->input->post('password')))
		);
		$data = $this->security->xss_clean($data);

		if ($this->update->update_one($table, $by, $id, $data)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: silakan login menggunakan password baru.');
			redirect('pemohon-adm');
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: password anda belum diubah.');
			redirect('pemohon-adm/form-pass/'.$id);
		}
    }

	public function form_del()
	{
		permission(18);
		$data['id'] = $this->input->get('id');
		$this->load->view('backend/pemohon/pemohon_del', $data);
	}

	public function del()
	{
		permission(18);
		$this->load->model('read');
		$this->load->model('delete');

		$table = 'permohonan';
		$id = array('idpemohon' => $this->uri->segment(3));
		$permohonan = $this->read->read_array($table, $id);

		if (empty($permohonan)) {
			$id = $this->uri->segment(3);
			$table = 'pemohon';
			$by = 'idpemohon';

			$this->delete->delete_one($table, $by, $id);

			$this->session->set_flashdata('success', 'Berhasil Hapus: data pemohon sudah dihapus.');
			redirect('pemohon-adm');
		} else {
			$this->session->set_flashdata('error', 'Gagal Hapus: pemohon sedang melakukan pengajuan permohonan.');
			redirect('pemohon-adm');
		}
	}

}
