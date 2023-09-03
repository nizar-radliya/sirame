<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('./assets/excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pelaporan_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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
        $data['view'] 	= 'backend/pelaporan/pelaporan';

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('backend/main',$data);
	}

	public function detil()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'backend/pelaporan/pelaporan_detil';

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$query = $this->db->select('SUM(luasrealisasi) AS luas')->from('pelaporan')->where('nomor =',$this->uri->segment(3))->where('statuslaporan =','PELAPORAN DITERIMA')->get();
		$sql = $query->result();
		$luaspelaporan = $sql[0]->luas;
		$data['luaspelaporan'] = $luaspelaporan;

		$table = 'jeniskelengkapan';
		$order = 'idjenis';
		$sort = 'ASC';
		$data['jeniskelengkapan'] = $this->read->read_one($table, $order, $sort);

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$noreg = $this->db->select('*')->from('kkpr')->where('statuskkpr =',"PKKPR VALID")->order_by('tglterbit','DESC')->get();
		$data['noreg'] = $noreg->result();

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$data['kkpr'] = $query;

		if ($query[0]->statuskkpr != 'PKKPR VALID') {
			$this->session->set_flashdata('error', 'Gagal Akses: berdasarkan status maka data PKKPR tersebut belum bisa masuk tahap pelaporan.');
			redirect('pelaporan');
		}

		$table = 'pelaporan';
		$id = array('nomor' => $this->uri->segment(3));
		$data['pelaporan']= $this->read->read_array($table, $id);

		$this->load->view('backend/main', $data);
	}

	public function catatan()
	{
		$this->load->helper("format_helper");
		$this->load->model('read');
		$nomor = $this->input->get('id');

		$table = 'pelaporan';
		$where = array('idpelaporan' => $nomor);
		$data['kkpr'] = $this->read->read_array($table, $where);
		$this->load->view('backend/pelaporan/pelaporan_modal', $data);
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
		$data['view'] 	= 'backend/pelaporan/pelaporan_add';

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$noreg = $this->db->select('*')->from('kkpr')->where('statuskkpr =',"PKKPR VALID")->order_by('tglterbit','DESC')->get();
		$data['noreg'] = $noreg->result();

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$data['kkpr'] = $query;

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		if ($query[0]->statuskkpr != 'PKKPR VALID') {
			$this->session->set_flashdata('error', 'Gagal Akses: berdasarkan status maka data PKKPR tersebut belum bisa masuk tahap pelaporan.');
			redirect('pelaporan-adm');
		}

		$this->load->view('backend/main', $data);
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
			$config['allowed_types'] = '*';
			$config['max_size'] = 1603840000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('filepelaporan')) {
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);

				$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
				redirect('pelaporan-adm/form-add/'.$nomor);
			} else {
				$berkas = $this->upload->data();
				$table = 'pelaporan';
				$data = array(
					'nomor' => $this->input->post('nomor'),
					'tglpelaporan' => $tgl,
					'filepelaporan' => $berkas['file_name'],
					'luasrealisasi' => $this->input->post('luasrealisasi'),
					'statuslaporan' => 'MENUNGGU VERIFIKASI',
					'catatan' => $this->input->post('catatan'),
					'idpemohon' => $this->input->post('idpemohon')
				);

				if ($this->create->create_one($table, $data)) {
					$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
					redirect('pelaporan-adm/detil/'.$nomor);
				} else {
					$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
					redirect('pelaporan-adm/form-add/'.$nomor);
				}
			}
		} else {
			$table = 'pelaporan';
			$data = array(
				'nomor' => $this->input->post('nomor'),
				'tglpelaporan' => $tgl,
				'luasrealisasi' => $this->input->post('luasrealisasi'),
				'statuslaporan' => 'MENUNGGU VERIFIKASI',
				'catatan' => $this->input->post('catatan'),
				'idpemohon' => $this->input->post('idpemohon')
			);

			if ($this->create->create_one($table, $data)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
				redirect('pelaporan-adm/detil/'.$nomor);
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
				redirect('pelaporan-adm/form-add/'.$nomor);
			}
		}
	}

	public function form_edit()
	{
		permission(33);
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'backend/pelaporan/pelaporan_edit';

		$data['jenisdok']  = array('SPH Tanah','Sertifikat Tanah');

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$query = $this->db->select('SUM(luasrealisasi) AS luas')->from('pelaporan')->where('nomor =',$this->uri->segment(3))->where('statuslaporan =','PELAPORAN DITERIMA')->get();
		$sql = $query->result();
		$luaspelaporan = $sql[0]->luas;
		$data['luaspelaporan'] = $luaspelaporan;

		$data['statuslaporan']  = array('MENUNGGU VERIFIKASI','PELAPORAN DITOLAK','PELAPORAN DITERIMA');

		$noreg = $this->db->select('*')->from('kkpr')->where('statuskkpr =',"PKKPR VALID")->order_by('tglterbit','DESC')->get();
		$data['noreg'] = $noreg->result();

		$table = 'pelaporan';
		$id = array('idpelaporan' => $this->uri->segment(3));
		$query = $this->read->read_array($table, $id);
		$data['pelaporan'] = $query;
		/*if ($query[0]->idpengguna != $this->session->userdata('idpengguna')) {
			$this->session->set_flashdata('error', 'Gagal Akses: anda tidak memiliki akses.');
			redirect('pelaporan-adm');
		}*/

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(4).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$query = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		$data['kkpr'] = $query;

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(4).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

	public function edit()
	{
		permission(33);
		$this->load->model('update');

		$tgl = date('Y-m-d H:i:s');
		$nomor = $this->input->post('nomor');
		$idpelaporan = $this->input->post('idpelaporan');
		$filename = $this->input->post('filename');

		if (isset($_FILES['filepelaporan']['name']) && !empty($_FILES['filepelaporan']['name'])) {

			$nmfile = 'pelaporan_' . $nomor . '_' . time();
			$config['file_name'] = $nmfile;
			$config['upload_path'] = './assets/file/kkpr/pelaporan/';
			$config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;
			$config['max_size'] = 1603840000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('filepelaporan')) {
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);

				$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
				redirect('pelaporan-adm/form-edit/'.$idpelaporan.'/'.$nomor);
			} else {
				$berkas = $this->upload->data();

				$catatan = $this->input->post('catatan');
				$statuslaporan = $this->input->post('statuslaporan');
				$tglverifikasi = $tgl;
				$idpengguna = $this->session->userdata('idpengguna');

				if ($this->update->kkpr($catatan,$statuslaporan,$tglverifikasi,$idpengguna,$idpelaporan)) {
					unlink("./assets/file/kkpr/pelaporan/$filename");
					redirect('pelaporan-adm/detil/'.$nomor);
				} else {
					$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
					redirect('pelaporan-adm/form-edit/'.$idpelaporan.'/'.$nomor);
				}
			}
		} else {
			$catatan = $this->input->post('catatan');
			$statuslaporan = $this->input->post('statuslaporan');
			$tglverifikasi = $tgl;
			$idpengguna = $this->session->userdata('idpengguna');

			if ($this->update->kkpr($catatan,$statuslaporan,$tglverifikasi,$idpengguna,$idpelaporan)) {
				redirect('pelaporan-adm/detil/'.$nomor);
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
				redirect('pelaporan-adm/form-edit/'.$idpelaporan.'/'.$nomor);
			}
		}
	}

	public function export_kkpr()
	{
		$this->load->library("PHPExcel");
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->helper("row_helper");
		$this->load->helper("format_helper");
		$this->load->helper("row_helper");
		$this->load->model('read');
		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sirame PKKPR')
			->setLastModifiedBy('Sirame PKKPR')
			->setTitle('Rekap Data Sirame PKKPR')
			->setSubject('Rekap Data Sirame PKKPR Excel')
			->setDescription('Rekap Data Sirame PKKPR')
			->setKeywords('Rekap Data Sirame PKKPR')
			->setCategory('Rekap Data Sirame PKKPR');

		$spreadsheet->getActiveSheet()->getStyle('A1:L5')->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle('A1:L5')->getAlignment()->applyFromArray(
			array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);

		$spreadsheet->getActiveSheet()->mergeCells('A1:L1');
		$spreadsheet->getActiveSheet()->mergeCells('A2:L2');

		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'DATA SIRAME PKKPR')
			->setCellValue('A2', 'DPMPTS KABUPATEN BEKASI')
			->setCellValue('A5', 'No')
			->setCellValue('B5', 'Nomor PKKPR')
			->setCellValue('C5', 'Tanggal Terbit')
			->setCellValue('D5', 'Pelaku Usaha')
			->setCellValue('E5', 'Telepon')
			->setCellValue('F5', 'KBLI')
			->setCellValue('G5', 'Pemanfaatan Ruang')
			->setCellValue('H5', 'Luas Dimohon')
			->setCellValue('I5', 'Luas Disetujui')
			->setCellValue('J5', 'Kecamatan')
			->setCellValue('K5', 'Kelurahan')
			->setCellValue('L5', 'Pelaporan KKPR');


		// Miscellaneous glyphs, UTF-8
		$i=6;
		$j=1 ;
		foreach($kkpr as $field) {
			$spreadsheet ->getDefaultStyle()->getNumberFormat()->setFormatCode('#');
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $i-5)
				->setCellValue('B'.$i, $field->nomor)
				->setCellValue('C'.$i, onlydate($field->tglterbit))
				->setCellValue('D'.$i, $field->namapelaku)
				->setCellValue('E'.$i, $field->tlppelaku)
				->setCellValue('F'.$i, $field->judulkbli)
				->setCellValue('G'.$i, $field->pr)
				->setCellValue('H'.$i, $field->luasdimohon)
				->setCellValue('I'.$i, $field->luasdisetujui)
				->setCellValue('J'.$i, $field->nama_kec)
				->setCellValue('K'.$i, $field->nama_kel)
				->setCellValue('L'.$i, row($field->nomor,'kkpr','nomor').' Laporan') ;
			$j = 1;
			$i++;
		}


		foreach (range('B', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('C', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('D', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet

		foreach (range('G', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('H', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('I', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet
		foreach (range('J', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		foreach (range('K', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		foreach (range('L', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		$spreadsheet->getActiveSheet()->setTitle('SIRAME PKKPR '.date('d-m-Y'));
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Rekap Data Sirame PKKPR.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');


		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		ob_clean();
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
		exit;
	}

	public function export()
	{
		$this->load->library("PHPExcel");
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->helper("row_helper");
		$this->load->helper("format_helper");
		$this->load->helper("row_helper");
		$this->load->model('read');
		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sirame PKKPR')
			->setLastModifiedBy('Sirame PKKPR')
			->setTitle('Rekap Data Sirame PKKPR')
			->setSubject('Rekap Data Sirame PKKPR Excel')
			->setDescription('Rekap Data Sirame PKKPR')
			->setKeywords('Rekap Data Sirame PKKPR')
			->setCategory('Rekap Data Sirame PKKPR');

		$spreadsheet->getActiveSheet()->getStyle('A1:L5')->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle('A1:L5')->getAlignment()->applyFromArray(
			array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);

		$spreadsheet->getActiveSheet()->mergeCells('A1:L1');
		$spreadsheet->getActiveSheet()->mergeCells('A2:L2');

		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'DATA PELAPORAN SIRAME PKKPR')
			->setCellValue('A2', 'DPMPTS KABUPATEN BEKASI')
			->setCellValue('A5', 'No')
			->setCellValue('B5', 'Nomor PKKPR')
			->setCellValue('C5', 'Tanggal Terbit')
			->setCellValue('D5', 'Pelaku Usaha')
			->setCellValue('E5', 'Telepon')
			->setCellValue('F5', 'KBLI')
			->setCellValue('G5', 'Pemanfaatan Ruang')
			->setCellValue('H5', 'Luas Dimohon')
			->setCellValue('I5', 'Luas Disetujui')
			->setCellValue('J5', 'Kecamatan')
			->setCellValue('K5', 'Kelurahan')
			->setCellValue('L5', 'Pelaporan KKPR');


		// Miscellaneous glyphs, UTF-8
		$i=6;
		foreach($kkpr as $field) {
			$spreadsheet ->getDefaultStyle()->getNumberFormat()->setFormatCode('#');
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $i-5)
				->setCellValue('B'.$i, $field->nomor)
				->setCellValue('C'.$i, onlydate($field->tglterbit))
				->setCellValue('D'.$i, $field->namapelaku)
				->setCellValue('E'.$i, $field->tlppelaku)
				->setCellValue('F'.$i, $field->judulkbli)
				->setCellValue('G'.$i, $field->pr)
				->setCellValue('H'.$i, $field->luasdimohon)
				->setCellValue('I'.$i, $field->luasdisetujui)
				->setCellValue('J'.$i, $field->nama_kec)
				->setCellValue('K'.$i, $field->nama_kel)
				->setCellValue('L'.$i, row($field->nomor,'pelaporan','nomor').' Laporan') ;
			$j = $i+1;

			$pelaporan = read($field->nomor,'pelaporan','nomor');
			if (isset($pelaporan)) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A'.$j, 'No')
					->setCellValue('B'.$j, 'Jenis Dokumen')
					->setCellValue('C'.$j, 'Nomor Dokumen')
					->setCellValue('D'.$j, 'Tanggal Dokumen')
					->setCellValue('E'.$j, 'Luas Tanah')
					->setCellValue('F'.$j, 'Pejabat Pengesahan')
					->setCellValue('G'.$j, 'Status Laporan')
					->setCellValue('H'.$j, 'Tanggal Pelaporan');
			}
			$k = 1;
			foreach($pelaporan as $field) {
				$j++;
				$spreadsheet ->getDefaultStyle()->getNumberFormat()->setFormatCode('#');
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A'.$j, $k)
					->setCellValue('B'.$j, $field->jenisdok)
					->setCellValue('C'.$j, $field->nomordok)
					->setCellValue('D'.$j, onlydate($field->tgldok))
					->setCellValue('E'.$j, $field->luasrealisasi)
					->setCellValue('F'.$j, $field->pejabat)
					->setCellValue('G'.$j, $field->statuslaporan)
					->setCellValue('H'.$j, onlydate($field->tglpelaporan));
				$i++;
				$k++;
			}

		}


		foreach (range('B', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('C', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('D', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet

		foreach (range('G', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('H', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		// Rename worksheet
		foreach (range('I', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet
		foreach (range('J', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		foreach (range('K', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		foreach (range('L', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
			$spreadsheet->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);

		}
		// Rename worksheet

		$spreadsheet->getActiveSheet()->setTitle('SIRAME PKKPR '.date('d-m-Y'));
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Rekap Data Pelaporan Sirame PKKPR.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');


		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		ob_clean();
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
		exit;
	}

}
