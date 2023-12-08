<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelengkapan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		log_pemohon();
        $this->title    = webname().' - Kelengkapan PKKPR';
        $this->menu     = 'kkpr';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/kelengkapan/kelengkapan';

		$table = 'jeniskelengkapan';
		$order = 'idjenis';
		$sort = 'ASC';
		$data['jeniskelengkapan'] = $this->read->read_one($table, $order, $sort);

		$table = 'kkpr';
		$order = 'tglterbit';
		$sort = 'DESC';
		$where = array('idpemohon' => $this->session->userdata('idpemohon'));
		$data['noreg'] = $this->read->read_array_order($order, $sort, $table, $where);

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		if ($kkpr[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('kkpr');
		}

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"',"jeniskelengkapan.jeniskelengkapan = 'Dokumen PKKPR'", 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('pemohon/main', $data);
	}

	public function add()
	{
		$this->load->model('read');
		$id = $this->input->get('id');
		$id2 = $this->input->get('id2');

		$table          = 'kkpr';
		$where            = array('nomor' => $id);
		$data['kkpr']    = $this->read->read_array($table, $where);

		$table          = 'jeniskelengkapan';
		$where            = array('idjenis' => $id2);
		$data['jenis']    = $this->read->read_array($table, $where);

		$this->load->view('pemohon/kelengkapan/kelengkapan_add', $data);
	}

	public function add_kelengkapan()
	{
		$this->load->model('create');
		$this->load->model('update');

		$nomor = $this->input->post('nomor');
		$idpemohon = $this->input->post('idpemohon');
		$idjenis = $this->input->post('idjenis');
		$type = $this->input->post('type');
		$init = $this->input->post('init');

		$nmfile = $nomor . $init;
		$config['file_name'] = $nmfile;
		$config['upload_path'] = './assets/file/kkpr/kelengkapan/';
		$config['allowed_types'] = $type;
		$config['max_size'] = 1024 * 3;
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('filekelengkapan')) {
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);

			$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
			redirect('kelengkapan/index/'.$nomor);
		} else {
			$file = $this->upload->data();
			$table = 'kkpr_kelengkapan';
			$data = array(
				'filekelengkapan' => $file['file_name'],
				'idpemohon' => $idpemohon,
				'nomor' => $nomor,
				'statuskelengkapan' => 'MENUNGGU VERIFIKASI',
				'tglupload' => date('Y-m-d H:i:s'),
				'idjenis' => $idjenis,
				'idpengguna' => $this->session->userdata('idpengguna')
			);

			if ($this->create->create_one($table, $data)) {
				$this->load->helper('read_helper');
				$kkpr = read($nomor,'kkpr','nomor');
				$status = $kkpr[0]->statuskkpr;
				if ($status == 'BELUM UPLOAD KELENGKAPAN' || $status == 'KELENGKAPAN DITOLAK') {
					$table = 'kkpr';
					$by = 'nomor';
					$data = array(
						'statuskkpr' => 'VERIFIKASI KELENGKAPAN'
					);
					$this->update->update_one($table, $by, $nomor, $data);
				}

				$this->session->set_flashdata('success', 'Berhasil Simpan: data kelengkapan berhasil diupload.');
				redirect('kelengkapan/index/'.$nomor);
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data kelengkapan gagal diupload.');
				redirect('kelengkapan/index/'.$nomor);
			}
		}
	}

	public function unduh()
	{
		$name = $this->input->get('file');
		$tipe = substr($name, -3);

		if ($tipe == 'pdf') {
			$this->output
				->set_content_type('application/pdf')
				->set_output(file_get_contents('assets/file/kkpr/kelengkapan/' . basename($name)));
		} else if ($tipe == 'jpg' || $tipe == 'jpeg' || $tipe == 'png' || $tipe == 'gif') {
			$this->output
				->set_content_type('jpeg')
				->set_output(file_get_contents('assets/file/kkpr/kelengkapan/' . basename($name)));
		} else {
			$this->load->helper('download');
			$data = file_get_contents("assets/file/kkpr/kelengkapan/" . basename($name));
			force_download($name, $data);
			//redirect('file', 'refresh');
		}
	}

	public function kelengkapan_del()
	{
		$data['id'] = $this->input->get('id');
		$data['id2'] = $this->input->get('id2');
		$this->load->view('pemohon/kelengkapan/kelengkapan_del', $data);
	}

	public function del()
	{
		$this->load->model('delete');
		$id = $this->uri->segment(3);
		$id2 = $this->uri->segment(4);
		$table = 'kkpr_kelengkapan';
		$by = 'idkelengkapan';

		$this->db->where($by, $id2);
		$query = $this->db->get($table);
		$row = $query->row();

		if ($row->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('kelengkapan/index/'.$id);
		}

		if (isset($row)) {
			unlink("./assets/file/kkpr/kelengkapan/$row->filekelengkapan");
		}

		if ($this->delete->delete_one($table, $by, $id2)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect('kelengkapan/index/'.$id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Hapus: data belum terhapus dari server.');
			redirect('kelengkapan/index/'.$id);
		}

	}

	public function kelengkapan_cek()
	{
		$this->load->model('read');
		$this->load->helper('read');
		$data['id'] = $this->input->get('id');
		$data['id2'] = $this->input->get('id2');

		$table = 'kkpr_kelengkapan';
		$id = array('idkelengkapan' => $this->input->get('id2'));
		$data['kelengkapan'] = $this->read->read_array($table, $id);

		$data['statuskelengkapan']  = array('MENUNGGU VERIFIKASI','KELENGKAPAN DITOLAK','KELENGKAPAN DITERIMA');
		$this->load->view('pemohon/kelengkapan/kelengkapan_cek', $data);
	}

	public function cek()
	{
		$this->load->model('update');

		$id = $this->input->post('nomor');
		$id2 = $this->input->post('idkelengkapan');
		$table = 'kkpr_kelengkapan';
		$by = 'idkelengkapan';
		$data = array(
			'statuskelengkapan' => $this->input->post('statuskelengkapan'),
			'tglverifikasi' => date('Y-m-d H:i:s'),
			'catatan' => $this->input->post('catatan'),
			'idpengguna' => $this->session->userdata('idpengguna')
		);

		if ($this->update->update_one($table, $by, $id2, $data)) {

			if ($this->input->post('statuskelengkapan') == 'KELENGKAPAN DITOLAK') {
				$table = 'kkpr';
				$by = 'nomor';
				$data = array(
					'statuskkpr' => 'KELENGKAPAN DITOLAK'
				);
				$this->update->update_one($table, $by, $id, $data);
			}

			$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
			redirect('kelengkapan/index/'.$id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('kelengkapan/index/'.$id);
		}
	}

	public function tanda_terima()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('create');
		$this->load->model('read');

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$this->data['kkpr'] = $query;

		if ($query[0]->statuskkpr != 'PKKPR VALID') {
			$this->session->set_flashdata('error', 'Gagal Cetak: berdasarkan status maka data kkpr tersebut belum bisa dicetak.');
			redirect('kelengkapan');
		}

		// panggil library yang kita buat sebelumnya yang bernama pdfgenerator
		$this->load->library('pdfgenerator');

		// title dari pdf
		$this->data['title_pdf'] = 'Bukti Tanda Terima Berkas';

		// filename dari pdf ketika didownload
		$file_pdf = 'bukti_tanda_terima_berkas_kkpr';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('pemohon/kkpr/kkpr_tandaterima',$this->data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}
}
