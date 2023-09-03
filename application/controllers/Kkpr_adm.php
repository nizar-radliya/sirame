<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kkpr_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->title    = webname().' - PKKPR';
        $this->menu     = 'kkpr';

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
        $data['view'] 	= 'backend/kkpr/kkpr';

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('backend/main',$data);
	}

    public function form_add()
	{
		permission(20);
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/kkpr/kkpr_add';

		$data['jenis']  = array('UMK','Informasi');
		$data['kategori']  = array('Perorangan','Perusahaan');

		$pemohon = $this->db->select('*')->from('pemohon')->order_by('nama','ASC')->get();
		$data['pemohon'] = $pemohon->result();
		$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 3216)->order_by('nama_kec','ASC')->get();
		$data['kecamatan'] = $kecamatan->result();

        $this->load->view('backend/main',$data);
	}

	public function add_ajax_kel($id_kec)
	{
		$this->load->model('read');
		$query = $this->db->get_where('kelurahan', array('id_kec' => $id_kec));
		$data = "<option value='' selected disabled>Pilih Kelurahan/Desa</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id_kel . "'>" . $value->nama . "</option>";
		}
		echo $data;
	}

	public function add()
    {
		permission(20);
        $this->load->model('create');
        $this->load->model('read');

		$table = 'kkpr';
		$nim = array('nomor' => $this->input->post('nomor'));
		$check = $this->read->read_array($table, $nim);

		if (empty($check)) {
			$data = array(
				'nomor' => $this->input->post('nomor'),
				'namapelaku' => $this->input->post('namapelaku'),
				'npwp' => $this->input->post('npwp'),
				'alamatpelaku' => $this->input->post('alamatpelaku'),
				'tlppelaku' => $this->input->post('tlppelaku'),
				'emailpelaku' => $this->input->post('emailpelaku'),
				'spm' => $this->input->post('spm'),
				'kodekbli' => $this->input->post('kodekbli'),
				'judulkbli' => $this->input->post('judulkbli'),
				'skalausaha' => $this->input->post('skalausaha'),
				'alamatusaha' => $this->input->post('alamatusaha'),
				'id_kec' => $this->input->post('id_kec'),
				'id_kel' => $this->input->post('id_kel'),
				'luasdimohon' => $this->input->post('luasdimohon'),
				'luasdisetujui' => $this->input->post('luasdisetujui'),
				'pr' => $this->input->post('pr'),
				'kdbmak' => $this->input->post('kdbmak'),
				'klbmak' => $this->input->post('klbmak'),
				'gsbmin' => $this->input->post('gsbmin'),
				'jbbmin' => $this->input->post('jbbmin'),
				'kdhmin' => $this->input->post('kdhmin'),
				'ktbmin' => $this->input->post('ktbmin'),
				'juk' => $this->input->post('juk'),
				'tglterbit' => $this->input->post('tglterbit'),
				'idpemohon' => $this->session->userdata('idpemohon'),
				'statuskkpr' => 'BELUM UPLOAD KELENGKAPAN'
			);

			$data = $this->security->xss_clean($data);

			if ($this->create->create_one($table, $data)) {
				$this->session->set_flashdata('success', 'Simpan data berhasil: silakan upload kelengkapan untuk tahapan berikutnya.');
				redirect('kkpr-adm');
			} else {
				$this->session->set_flashdata('error', 'Simpan data gagal: data tidak tersimpan ke server.');
				redirect('kkpr-adm/form-add');
			}
		} else {
			$this->session->set_flashdata('error', 'Simpan data gagal: Nomor PKKPR sudah pernah didaftarkan.');
			redirect('kkpr-adm/form-add');
		}
    }

    public function form_edit()
    {
		permission(21);
        $this->load->helper("format_helper");
		$this->load->helper("read_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/kkpr/kkpr_edit';

		$data['jenis']  = array('UMK','Informasi');
		$data['kategori']  = array('Perorangan','Perusahaan');

		$query = $this->db->select('*')->from('rtrw_rencana_polaruang')->group_by('nama')->order_by('nama','ASC')->get();
		$data['rtrw_rencana_polaruang'] = $query->result();
		$query = $this->db->select('*')->from('rdtr_rencana_polaruang')->group_by('nama')->order_by('nama','ASC')->get();
		$data['rdtr_rencana_polaruang'] = $query->result();

		$table          = 'kkpr';
		$id            = array('nomor' => $this->uri->segment(3));
		$data['kkpr']    = $this->read->read_array($table, $id);

		$kkpr = $this->read->read_array($table, $id);
		if ($kkpr[0]->statuskkpr == 'BELUM UPLOAD KELENGKAPAN' || $kkpr[0]->statuskkpr == 'VERIFIKASI KELENGKAPAN' || $kkpr[0]->statuskkpr == 'KELENGKAPAN DITOLAK') {

			$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 3216)->order_by('nama_kec', 'ASC')->get();
			$data['kecamatan'] = $kecamatan->result();

			$this->load->view('backend/main', $data);
		} else {
			$this->session->set_flashdata('error', 'Data PKKPR tidak dapat diubah sesuai dengan ketentuan yang berlaku.');
			redirect('kkpr-adm');
		}
    }

    public function edit()
    {
		permission(21);
        $this->load->model('update');

		$id = $this->input->post('nomor');
		$shape = $this->input->post('SHAPE');
		$jenis = $this->input->post('jenis');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$atasnama = $this->input->post('atasnama');
		$kategori = $this->input->post('kategori');
		if ($kategori == 'Perusahaan') {
			$perusahaan = $this->input->post('perusahaan');
			$nib = $this->input->post('nib');
		} else {
			$perusahaan = NULL;
			$nib = NULL;
		}
		$peruntukan = $this->input->post('peruntukan');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$alamatkkpr = $this->input->post('alamatkkpr');
		$luastanah = $this->input->post('luastanah');
		$luastanahdimohon = $this->input->post('luastanahdimohon');
		$buktipenguasaantanah = $this->input->post('buktipenguasaantanah');

		if ($this->update->kkpr($shape,$jenis,$lat,$lng,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$peruntukan,$id_kec,$id_kel,$alamatkkpr,$luastanah,$luastanahdimohon,$buktipenguasaantanah,$id)) {
			$this->session->set_flashdata('success', 'Berhasil Simpan: data kkpr sudah berhasil diubah. Berikutnya silakan lengkapi upload file persyaratan');
			redirect('kkpr-adm/form-edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('kkpr-adm/form-edit/' . $id);
		}
    }

    public function form_del()
    {
		permission(22);
        $data['id'] = $this->input->get('id');
        $this->load->view('backend/kkpr/kkpr_del', $data);
    }

    public function del()
    {
		permission(22);
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'kkpr';
        $by = 'nomor';

		if ($kkpr[0]->statuskkpr == 'BELUM UPLOAD KELENGKAPAN' || $kkpr[0]->statuskkpr == 'VERIFIKASI KELENGKAPAN') {

			if ($this->delete->delete_one($table, $by, $id)) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus.');
				redirect('kkpr-adm');
			} else {
				$this->session->set_flashdata('error', 'Gagal Hapus: data belum terhapus dari server.');
				redirect('kkpr-adm');
			}

		} else {
			$this->session->set_flashdata('error', 'Data permohonan PKKPR tidak dapat dihapus sesuai dengan ketentuan yang berlaku.');
			redirect('kkpr-adm');
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
		$data['view'] 	= 'backend/kkpr/kkpr_detil';

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

		$table = 'kkpr';
		$order = 'tglterbit';
		$sort = 'DESC';
		$data['noreg'] = $this->read->read_one($table, $order, $sort);

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'pemohon.id_kota AS kotapemohon', 'pemohon.id_kec AS kecpemohon', 'pemohon.*', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('nomor = "'.$this->uri->segment(3).'"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

	public function grafik()
	{
		permission(23);
		$this->load->helper("format_helper");
		$this->load->helper("row_helper");
		$this->load->model('row');
		$data['title']  = $this->title;
		$data['menu'] 	= 'grafik';
		$data['view'] 	= 'backend/kkpr/kkpr_grafik';

		$tables = array('kkpr');
		$columns = array('year(tglterbit) as year');
		$condition = array('kkpr.idpemohon > 0');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = 'year';
		$data['tahun'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$table = 'kkpr';
		$data['kkpr'] = $this->row->row_one($table);

		$id = array('statuskkpr' => 'BELUM UPLOAD KELENGKAPAN');
		$data['kkpr1'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'VERIFIKASI KELENGKAPAN');
		$data['kkpr2'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR VALID');
		$data['kkpr3'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR TIDAK VALID');
		$data['kkpr4'] = $this->row->row_array($table, $id);

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
		$data['view'] 	= 'backend/kkpr/kkpr_grafik_pertahun';

		$data['year'] = $this->uri->segment(3);
		$year = $this->uri->segment(3);

		$tables = array('kkpr');
		$columns = array('year(tglterbit) as year');
		$condition = array('kkpr.idpemohon > 0');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = 'year';
		$data['tahun'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$table = 'kkpr';
		$id = array('year(tglterbit)' => $year);
		$data['kkpr'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'BELUM UPLOAD KELENGKAPAN', 'year(tglterbit)' => $year);
		$data['kkpr1'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'VERIFIKASI KELENGKAPAN', 'year(tglterbit)' => $year);
		$data['kkpr2'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR VALID', 'year(tglterbit)' => $year);
		$data['kkpr3'] = $this->row->row_array($table, $id);

		$id = array('statuskkpr' => 'PKKPR TIDAK VALID', 'year(tglterbit)' => $year);
		$data['kkpr4'] = $this->row->row_array($table, $id);

		$this->load->view('backend/main',$data);
	}

}
