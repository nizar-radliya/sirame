<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		log_pemohon();
        $this->title    = webname().' - Permohonan';
        $this->menu     = 'permohonan';

        date_default_timezone_set('Asia/Jakarta');
		akses(3);
    }

    public function index()
	{
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/permohonan';

		$idpemohon = $this->session->userdata('idpemohon');

		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('permohonan.idpemohon = '.$idpemohon, 'permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('pemohon/main',$data);
	}

    public function form_add()
	{
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/permohonan_add';

		$data['kategori']  = array('Pribadi','Perusahaan');
		$data['kepemilikan']  = array('Pemilik','Sewa');
		$data['kebutuhan']  = array('Investasi','Perubahan Fungsi Lahan','Pengadaan Lahan Pemerintah Daerah','Penerbitan Rekomendasi Kesesuaian Tata Ruang');
		$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 2104)->order_by('nama_kec','ASC')->get();
		$data['kecamatan'] = $kecamatan->result();
		$pemanfaatan = $this->db->select('*')->from('pemanfaatan')->order_by('pemanfaatan','ASC')->get();
		$data['pemanfaatan'] = $pemanfaatan->result();

        $this->load->view('pemohon/main',$data);
	}

	public function add()
    {
        $this->load->model('create');
        $this->load->model('read');

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
		$idpemohon = $this->session->userdata('idpemohon');
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
			redirect('permohonan');
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('permohonan/form-add');
		}
    }

    public function form_edit()
    {
        $this->load->helper("format_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/permohonan_edit';

        $table          = 'permohonan';
        $id            = array('nopermohonan' => $this->uri->segment(3));
        $data['permohonan']    = $this->read->read_array($table, $id);

        $permohonan = $this->read->read_array($table, $id);
        if ($permohonan[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('permohonan');
		}
        if ($permohonan[0]->statuspermohonan == 'PERSYARATAN BELUM LENGKAP' || $permohonan[0]->statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN' || $permohonan[0]->statuspermohonan == 'PERSYARATAN DITOLAK') {

			$data['kategori'] = array('Pribadi', 'Perusahaan');
			$data['kepemilikan'] = array('Pemilik', 'Sewa');
			$data['kebutuhan'] = array('Investasi', 'Perubahan Fungsi Lahan', 'Pengadaan Lahan Pemerintah Daerah', 'Penerbitan Rekomendasi Kesesuaian Tata Ruang');
			$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 2104)->order_by('nama_kec', 'ASC')->get();
			$data['kecamatan'] = $kecamatan->result();
			$pemanfaatan = $this->db->select('*')->from('pemanfaatan')->order_by('pemanfaatan', 'ASC')->get();
			$data['pemanfaatan'] = $pemanfaatan->result();
			$pemohon = $this->db->select('*')->from('pemohon')->order_by('nama', 'ASC')->get();
			$data['pemohon'] = $pemohon->result();

			$this->load->view('pemohon/main', $data);
		} else {
			$this->session->set_flashdata('error', 'Data permohonan tidak dapat diubah sesuai dengan aturan.');
			redirect('permohonan');
		}
    }

    public function edit()
    {
        $this->load->model('update');

		$id = $this->input->post('nopermohonan');
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
		$idpemohon = $this->session->userdata('idpemohon');
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
			redirect('permohonan/form-edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('permohonan/form-edit/' . $id);
		}
    }

    public function form_del()
    {
        $data['id'] = $this->input->get('id');
        $this->load->view('pemohon/permohonan_del', $data);
    }

    public function del()
    {
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'permohonan';
        $by = 'nopermohonan';

        $where = array('nopermohonan' => $this->uri->segment(3));
		$permohonan = $this->read->read_array($table, $where);
		if ($permohonan[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('permohonan');
		}
		if ($permohonan[0]->statuspermohonan == 'PERSYARATAN BELUM LENGKAP' || $permohonan[0]->statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {

			$this->delete->delete_one($table, $by, $id);

			redirect('permohonan');

		} else {
			$this->session->set_flashdata('error', 'Data permohonan tidak dapat dihapus sesuai dengan aturan.');
			redirect('permohonan');
		}
    }

	public function detil()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/permohonan_detil';

		$table = 'permohonan';
		$order = 'tgl';
		$sort = 'DESC';
		$where = array('idpemohon' => $this->session->userdata('idpemohon'));
		$data['noreg'] = $this->read->read_array_order($order, $sort, $table, $where);

		$tables = array('permohonan', 'pemohon', 'kecamatan', 'pemanfaatan');
		$columns = array('permohonan.*', 'pemohon.nama AS namapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.id_kota AS kotapemohon', 'pemohon.noktp', 'pemohon.*', 'kecamatan.*', 'pemanfaatan.*');
		$condition = array('nopermohonan = '.$this->uri->segment(3),'permohonan.idpemohon = pemohon.idpemohon', 'permohonan.id_kec = kecamatan.id_kec', 'permohonan.idpemanfaatan = pemanfaatan.idpemanfaatan');
		$order = 'permohonan.tgl';
		$sort = 'DESC';
		$group = '';
		$data['permohonan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$permohonan = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		if ($permohonan[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('permohonan');
		}

		$this->load->view('pemohon/main', $data);
	}

}
