<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		log_pemohon();
        $this->title    = webname().' - Pelaporan PKKPR';
        $this->menu     = 'pelaporan';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/pelaporan/pelaporan';

		$idpemohon = $this->session->userdata('idpemohon');

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.idpemohon = '.$idpemohon, 'kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('pemohon/main',$data);
	}

	public function detil()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/pelaporan/pelaporan_detil';

		$table = 'jeniskelengkapan';
		$order = 'idjenis';
		$sort = 'ASC';
		$data['jeniskelengkapan'] = $this->read->read_one($table, $order, $sort);

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$query = $this->db->select('SUM(luasrealisasi) AS luas')->from('pelaporan')->where('nomor =',$this->uri->segment(3))->where('statuslaporan =','PELAPORAN DITERIMA')->get();
		$sql = $query->result();
		$luaspelaporan = $sql[0]->luas;
		$data['luaspelaporan'] = $luaspelaporan;

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$noreg = $this->db->select('*')->from('kkpr')->where('idpemohon',$this->session->userdata('idpemohon'))->where('statuskkpr =',"PKKPR VALID")->order_by('tglterbit','DESC')->get();
		$data['noreg'] = $noreg->result();

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$data['kkpr'] = $query;

		if ($query[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('pelaporan');
		}

		if ($query[0]->statuskkpr != 'PKKPR VALID') {
			$this->session->set_flashdata('error', 'Gagal Akses: berdasarkan status maka data PKKPR tersebut belum bisa masuk tahap pelaporan.');
			redirect('pelaporan');
		}

		$table = 'pelaporan';
		$id = array('nomor' => $this->uri->segment(3));
		$data['pelaporan']= $this->read->read_array($table, $id);

		$this->load->view('pemohon/main', $data);
	}

	public function catatan()
	{
		$this->load->helper("format_helper");
		$this->load->model('read');
		$nomor = $this->input->get('id');

		$table = 'pelaporan';
		$where = array('idpelaporan' => $nomor);
		$data['kkpr'] = $this->read->read_array($table, $where);
		$this->load->view('pemohon/pelaporan/pelaporan_modal', $data);
	}

	public function unduh()
	{
		$name = $this->input->get('file');
		$tipe = substr($name, -3);

		if ($tipe == 'pdf') {
			$this->output
				->set_content_type('application/pdf')
				->set_output(file_get_contents('assets/file/kkpr/pelaporan/' . basename($name)));
		} else if ($tipe == 'jpg' || $tipe == 'jpeg' || $tipe == 'png' || $tipe == 'gif') {
			$this->output
				->set_content_type('jpeg')
				->set_output(file_get_contents('assets/file/kkpr/pelaporan/' . basename($name)));
		} else {
			$this->load->helper('download');
			$data = file_get_contents("assets/file/kkpr/pelaporan/" . basename($name));
			force_download($name, $data);
			//redirect('file', 'refresh');
		}
	}

	public function form_add()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/pelaporan/pelaporan_add';

		$data['jenisdok']  = array('SPH Tanah','Sertifikat Tanah');

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$query = $this->db->select('SUM(luasrealisasi) AS luas')->from('pelaporan')->where('nomor =',$this->uri->segment(3))->where('statuslaporan =','PELAPORAN DITERIMA')->get();
		$sql = $query->result();
		$luaspelaporan = $sql[0]->luas;
		$data['luaspelaporan'] = $luaspelaporan;

		$noreg = $this->db->select('*')->from('kkpr')->where('statuskkpr =',"PKKPR VALID")->order_by('tglterbit','DESC')->get();
		$data['noreg'] = $noreg->result();

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$data['kkpr'] = $query;

		if ($query[0]->statuskkpr != 'PKKPR VALID') {
			$this->session->set_flashdata('error', 'Gagal Akses: berdasarkan status maka data PKKPR tersebut belum bisa masuk tahap pelaporan.');
			redirect('pelaporan');
		}

		$this->load->view('pemohon/main', $data);
	}

	public function add()
	{
		$this->load->model('create');
		$this->load->model('update');

		$nomor = $this->input->post('nomor');
		$tgl = date('Y-m-d H:i:s');

		if (isset($_FILES['filepelaporan']['name']) && !empty($_FILES['filepelaporan']['name'])) {

			$nmfile = 'pelaporan_' . $nomor . '_' . time();
			$config['file_name'] = $nmfile;
			$config['upload_path'] = './assets/file/kkpr/pelaporan/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['max_size'] = 1024 * 3;;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('filepelaporan')) {
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);

				$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
				redirect('pelaporan/form-add/'.$nomor);
			} else {
				$berkas = $this->upload->data();

				$nomor = $this->input->post('nomor');
				$shape = $this->input->post('SHAPE');
				$tglpelaporan = $tgl;
				$filepelaporan = $berkas['file_name'];
				$luasrealisasi = $this->input->post('luasrealisasi');
				$statuslaporan = 'MENUNGGU VERIFIKASI';
				$catatan = $this->input->post('catatan');
				$idpemohon = $this->input->post('idpemohon');
				$jenisdok = $this->input->post('jenisdok');
				$nomordok = $this->input->post('nomordok');
				$tgldok = $this->input->post('tgldok');
				$pejabat = $this->input->post('pejabat');

				if ($this->create->kkpr($nomor,$shape,$tglpelaporan,$filepelaporan,$luasrealisasi,$statuslaporan,$catatan,$idpemohon,$jenisdok,$nomordok,$tgldok,$pejabat)) {
					$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
					redirect('pelaporan/detil/'.$nomor);
				} else {
					$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
					redirect('pelaporan/form-add/'.$nomor);
				}
			}
		} else {
			$nomor = $this->input->post('nomor');
			$shape = $this->input->post('SHAPE');
			$tglpelaporan = $tgl;
			$filepelaporan = NULL;
			$luasrealisasi = $this->input->post('nomor');
			$statuslaporan = 'MENUNGGU VERIFIKASI';
			$catatan = $this->input->post('catatan');
			$idpemohon = $this->input->post('idpemohon');
			$jenisdok = $this->input->post('jenisdok');
			$nomordok = $this->input->post('nomordok');
			$tgldok = $this->input->post('tgldok');
			$pejabat = $this->input->post('pejabat');

			if ($this->create->kkpr($nomor,$shape,$tglpelaporan,$filepelaporan,$luasrealisasi,$statuslaporan,$catatan,$idpemohon,$jenisdok,$nomordok,$tgldok,$pejabat)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
				redirect('pelaporan/detil/'.$nomor);
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
				redirect('pelaporan/form-add/'.$nomor);
			}
		}
	}

}
