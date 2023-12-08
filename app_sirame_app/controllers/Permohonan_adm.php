<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->title    = webname().' - Permohonan';
        $this->menu     = 'permohonan';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		permission(19);
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/permohonan';

		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('backend/main',$data);
	}

    public function grafik()
	{
		permission(23);
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('row');
        $data['title']  = $this->title;
        $data['menu'] 	= 'grafik';
        $data['view'] 	= 'backend/permohonan_grafik';

		$tables = array('permohonan');
		$columns = array('year(tgl) as year');
		$condition = array('permohonan.idpemohon > 0');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = 'year';
		$data['tahun'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$table = 'permohonan';
		$data['permohonan'] = $this->row->row_one($table);

		$id = array('statuspermohonan' => 'PERSYARATAN BELUM LENGKAP');
		$data['permohonan1'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'MENUNGGU VERIFIKASI PERSYARATAN');
		$data['permohonan2'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PERSYARATAN DITOLAK');
		$data['permohonan3'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PERSYARATAN DISETUJUI');
		$data['permohonan4'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PROSES SURVEY');
		$data['permohonan5'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'RAPAT TKPRD');
		$data['permohonan6'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DITOLAK');
		$data['permohonan7'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DISETUJUI');
		$data['permohonan8'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DISETUJUI BERSYARAT');
		$data['permohonan9'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DITUNDA');
		$data['permohonan10'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Investasi');
		$data['kebutuhan1'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Perubahan Fungsi Lahan');
		$data['kebutuhan2'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Pengadaan Lahan Pemerintah Daerah');
		$data['kebutuhan3'] = $this->row->row_array($table, $id);

        $this->load->view('backend/main',$data);
	}

    public function grafik_pertahun()
	{
		permission(23);
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('row');
        $data['title']  = $this->title;
        $data['menu'] 	= 'grafik';
        $data['view'] 	= 'backend/permohonan_grafik_pertahun';

		$data['year'] = $this->uri->segment(3);
		$year = $this->uri->segment(3);

		$tables = array('permohonan');
		$columns = array('year(tgl) as year');
		$condition = array('permohonan.idpemohon > 0');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = 'year';
		$data['tahun'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$table = 'permohonan';
		$id = array('year(tgl)' => $year);
		$data['permohonan'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PERSYARATAN BELUM LENGKAP', 'year(tgl)' => $year);
		$data['permohonan1'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'MENUNGGU VERIFIKASI PERSYARATAN', 'year(tgl)' => $year);
		$data['permohonan2'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PERSYARATAN DITOLAK', 'year(tgl)' => $year);
		$data['permohonan3'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PERSYARATAN DISETUJUI', 'year(tgl)' => $year);
		$data['permohonan4'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'PROSES SURVEY', 'year(tgl)' => $year);
		$data['permohonan5'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'RAPAT TKPRD', 'year(tgl)' => $year);
		$data['permohonan6'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DITOLAK', 'year(tgl)' => $year);
		$data['permohonan7'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DISETUJUI', 'year(tgl)' => $year);
		$data['permohonan8'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DISETUJUI BERSYARAT', 'year(tgl)' => $year);
		$data['permohonan9'] = $this->row->row_array($table, $id);

		$id = array('statuspermohonan' => 'REKOMENDASI DITUNDA', 'year(tgl)' => $year);
		$data['permohonan10'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Investasi', 'year(tgl)' => $year);
		$data['kebutuhan1'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Perubahan Fungsi Lahan', 'year(tgl)' => $year);
		$data['kebutuhan2'] = $this->row->row_array($table, $id);

		$id = array('kebutuhan' => 'Pengadaan Lahan Pemerintah Daerah', 'year(tgl)' => $year);
		$data['kebutuhan3'] = $this->row->row_array($table, $id);

        $this->load->view('backend/main',$data);
	}

    public function form_add()
	{
		permission(20);
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/permohonan_add';

		$data['kategori']  = array('Pribadi','Perusahaan');
		$data['kepemilikan']  = array('Pemilik','Sewa');
		$data['kebutuhan']  = array('Investasi','Perubahan Fungsi Lahan','Pengadaan Lahan Pemerintah Daerah');
		$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 2104)->order_by('nama_kec','ASC')->get();
		$data['kecamatan'] = $kecamatan->result();
		$pemanfaatan = $this->db->select('*')->from('pemanfaatan')->order_by('pemanfaatan','ASC')->get();
		$data['pemanfaatan'] = $pemanfaatan->result();
		$pemohon = $this->db->select('*')->from('pemohon')->order_by('nama','ASC')->get();
		$data['pemohon'] = $pemohon->result();

        $this->load->view('backend/main',$data);
	}

	public function add()
    {
		permission(20);
        $this->load->model('create');

		//kodifikasi nomor registrasi permohonan
		$tgl = date('Y-m-d');
		$this->db->where('tgl', $tgl);
		$query = $this->db->get('permohonan');
		$row = $query->num_rows();
		$nextrow = $row+1;
		$nourut = sprintf('%03d',$nextrow);
		$nopermohonan = date('dmY').$nourut;

		$shape = $this->input->post('SHAPE');
		$kategori = $this->input->post('kategori');
		$kepemilikan = $this->input->post('kepemilikan');
		$kebutuhan = 'Penerbitan Rekomendasi Kesesuaian Tata Ruang';
		$idpemanfaatan = $this->input->post('idpemanfaatan');
		$lokasi = $this->input->post('lokasi');
		$id_kec = $this->input->post('id_kec');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$luas = $this->input->post('luas');
		$idpemohon = $this->input->post('idpemohon');
		$perihal = $this->input->post('perihal');
		$statuspermohonan = "PERSYARATAN BELUM LENGKAP";
		if ($kategori == 'Perusahaan') {
			$perusahaan = $this->input->post('perusahaan');
		} else {
			$perusahaan = NULL;
		}
		if ($kebutuhan == 'Investasi' || $kebutuhan == 'Penerbitan Rekomendasi Kesesuaian Tata Ruang') {
			$nosurat = $this->input->post('nosurat');
			$tglsurat = $this->input->post('tglsurat');
		} else {
			$nosurat = NULL;
			$tglsurat = NULL;
		}
		if ($idpemanfaatan == 'lainnya') {
			$pemanfaatan = $this->input->post('pemanfaatan');
			$tablep = 'pemanfaatan';
			$kodep = array('pemanfaatan' => $pemanfaatan);
			$check = $this->read->read_array($tablep, $kodep);

			if (empty($check)) {
				$datap = array(
					'pemanfaatan' => $this->input->post('pemanfaatan')
				);
				$this->create->create_one($tablep, $datap);
				$order = 'idpemanfaatan';
				$sort = 'DESC';
				$lastdata = $this->read->read_one($tablep, $order, $sort);
				$idpemanfaatan = $lastdata[0]->idpemanfaatan;
			} else {
				$idpemanfaatan = $check[0]->idpemanfaatan;
			}
		} else {
			$idpemanfaatan = $this->input->post('idpemanfaatan');
		}

		if ($this->create->permohonan($nopermohonan,$shape,$tgl,$kategori,$kepemilikan,$kebutuhan,$idpemanfaatan,$nosurat,$tglsurat,$lokasi,$id_kec,$lat,$lng,$luas,$idpemohon,$statuspermohonan,$perusahaan,$perihal)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: data permohonan sudah berhasil diajukan. Berikutnya silakan lengkapi upload file persyaratan');
			redirect('permohonan-adm');
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('permohonan-adm/form-add');
		}
    }

    public function form_edit()
    {
		permission(21);
        $this->load->helper("format_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/permohonan_edit';

        $table          = 'permohonan';
        $id            = array('nopermohonan' => $this->uri->segment(3));
        $data['permohonan']    = $this->read->read_array($table, $id);

        $permohonan = $this->read->read_array($table, $id);
        if ($permohonan[0]->statuspermohonan != 'REKOMENDASI DISETUJUI') {

			$data['kategori'] = array('Pribadi', 'Perusahaan');
			$data['kepemilikan'] = array('Pemilik', 'Sewa');
			$data['kebutuhan'] = array('Investasi', 'Perubahan Fungsi Lahan', 'Pengadaan Lahan Pemerintah Daerah');
			$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 2104)->order_by('nama_kec', 'ASC')->get();
			$data['kecamatan'] = $kecamatan->result();
			$pemanfaatan = $this->db->select('*')->from('pemanfaatan')->order_by('pemanfaatan', 'ASC')->get();
			$data['pemanfaatan'] = $pemanfaatan->result();
			$pemohon = $this->db->select('*')->from('pemohon')->order_by('nama', 'ASC')->get();
			$data['pemohon'] = $pemohon->result();

			$this->load->view('backend/main', $data);
		} else {
			$this->session->set_flashdata('error', 'Data permohonan tidak dapat diubah sesuai dengan aturan.');
			redirect('permohonan-adm');
		}
    }

    public function edit()
    {
		permission(21);
        $this->load->model('update');

		$id = $this->input->post('nopermohonan');
		$shape = $this->input->post('SHAPE');
		$kategori = $this->input->post('kategori');
		$kepemilikan = $this->input->post('kepemilikan');
		$kebutuhan ='Penerbitan Rekomendasi Kesesuaian Tata Ruang';
		$idpemanfaatan = $this->input->post('idpemanfaatan');
		$lokasi = $this->input->post('lokasi');
		$id_kec = $this->input->post('id_kec');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$luas = $this->input->post('luas');
		$idpemohon = $this->input->post('idpemohon');
		$perihal = $this->input->post('perihal');
		if ($kategori == 'Perusahaan') {
			$perusahaan = $this->input->post('perusahaan');
		} else {
			$perusahaan = NULL;
		}
		if ($kebutuhan == 'Investasi' || $kebutuhan == 'Penerbitan Rekomendasi Kesesuaian Tata Ruang') {
			$nosurat = $this->input->post('nosurat');
			$tglsurat = $this->input->post('tglsurat');
		} else {
			$nosurat = NULL;
			$tglsurat = NULL;
		}

		if ($this->update->permohonan($shape,$kategori,$kepemilikan,$kebutuhan,$idpemanfaatan,$nosurat,$tglsurat,$lokasi,$id_kec,$lat,$lng,$luas,$idpemohon,$perusahaan,$perihal,$id)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: data permohonan sudah berhasil diubah. Berikutnya silakan lengkapi upload file persyaratan');
			redirect('permohonan-adm/form-edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('permohonan-adm/form-edit/' . $id);
		}
    }

    public function form_del()
    {
		permission(22);
        $data['id'] = $this->input->get('id');
        $this->load->view('backend/permohonan_del', $data);
    }

    public function del()
    {
		permission(22);
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'permohonan';
        $by = 'nopermohonan';

        $where = array('nopermohonan' => $this->uri->segment(3));
		$permohonan = $this->read->read_array($table, $where);
		if ($permohonan[0]->statuspermohonan == 'PERSYARATAN BELUM LENGKAP' || $permohonan[0]->statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {

			$this->delete->delete_one($table, $by, $id);

			redirect('permohonan-adm');

		} else {
			$this->session->set_flashdata('error', 'Data permohonan tidak dapat dihapus sesuai dengan aturan.');
			redirect('permohonan-adm');
		}
    }

	public function detil()
	{
		permission(24);
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'backend/permohonan_detil';

		$table = 'permohonan';
		$order = 'tgl';
		$sort = 'DESC';
		$data['noreg'] = $this->read->read_one($table, $order, $sort);

		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.id_kota AS kotapemohon', 'pemohon.noktp', 'pemohon.*', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('nopermohonan = '.$this->uri->segment(3),'permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

}
