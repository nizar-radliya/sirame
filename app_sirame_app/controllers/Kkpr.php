<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kkpr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		log_pemohon();
        $this->title    = webname().' - PKKPR';
        $this->menu     = 'kkpr';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
        $this->load->helper("format_helper");
        $this->load->helper("row_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/kkpr/kkpr';

		$idpemohon = $this->session->userdata('idpemohon');

		$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
		$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
		$condition = array('kkpr.idpemohon = '.$idpemohon, 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
		$order = 'kkpr.tglterbit';
		$sort = 'DESC';
		$group = '';
		$data['kkpr'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

        $this->load->view('pemohon/main',$data);
	}

    public function form_add()
	{
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/kkpr/kkpr_add';

		$data['jenis']  = array('UMK','Informasi');
		$data['kategori']  = array('Perorangan','Perusahaan');

		$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 3216)->order_by('nama_kec','ASC')->get();
		$data['kecamatan'] = $kecamatan->result();

        $this->load->view('pemohon/main',$data);
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
				redirect('kkpr');
			} else {
				$this->session->set_flashdata('error', 'Simpan data gagal: data tidak tersimpan ke server.');
				redirect('kkpr/form-add');
			}
		} else {
			$this->session->set_flashdata('error', 'Simpan data gagal: Nomor PKKPR sudah pernah didaftarkan.');
			redirect('kkpr/form-add');
		}
    }

    public function form_edit()
    {
        $this->load->helper("format_helper");
		$this->load->helper("read_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'pemohon/kkpr/kkpr_edit';

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
		if ($kkpr[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('kkpr');
		}

		$kkpr = $this->read->read_array($table, $id);
		if ($kkpr[0]->statuskkpr == 'BELUM UPLOAD KELENGKAPAN' || $kkpr[0]->statuskkpr == 'VERIFIKASI KELENGKAPAN' || $kkpr[0]->statuskkpr == 'KELENGKAPAN DITOLAK') {

			$kecamatan = $this->db->select('*')->from('kecamatan')->where('id_kota', 3216)->order_by('nama_kec', 'ASC')->get();
			$data['kecamatan'] = $kecamatan->result();

			$this->load->view('pemohon/main', $data);
		} else {
			$this->session->set_flashdata('error', 'Data PKKPR tidak dapat diubah sesuai dengan ketentuan yang berlaku.');
			redirect('kkpr');
		}
    }

    public function edit()
    {
        $this->load->model('update');

		$id = $this->input->post('nomor');
		$shape = $this->input->post('SHAPE');
		$jenis = $this->input->post('jenis');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$idpemohon = $this->session->userdata('idpemohon');
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
			redirect('kkpr/form-edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
			redirect('kkpr/form-edit/' . $id);
		}
    }

    public function form_del()
    {
        $data['id'] = $this->input->get('id');
        $this->load->view('pemohon/kkpr/kkpr_del', $data);
    }

    public function del()
    {
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'kkpr';
        $by = 'nomor';

		$where = array('nomor' => $this->uri->segment(3));
		$kkpr = $this->read->read_array($table, $where);
		if ($kkpr[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('kkpr');
		}
		if ($kkpr[0]->statuskkpr == 'BELUM UPLOAD KELENGKAPAN' || $kkpr[0]->statuskkpr == 'VERIFIKASI KELENGKAPAN') {

			if ($this->delete->delete_one($table, $by, $id)) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus.');
				redirect('kkpr');
			} else {
				$this->session->set_flashdata('error', 'Gagal Hapus: data belum terhapus dari server.');
				redirect('kkpr');
			}

		} else {
			$this->session->set_flashdata('error', 'Data permohonan PKKPR tidak dapat dihapus sesuai dengan ketentuan yang berlaku.');
			redirect('kkpr');
		}
    }

	public function detil()
	{
		$this->load->helper("format_helper");
		$this->load->helper("read_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/kkpr/kkpr_detil';

		$query = $this->db->select('*')->from('rtrw_kabbekasi_pr_ar')->order_by('namobj','ASC')->get();
		$data['rtrw_kabbekasi_pr_ar'] = $query->result();

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

		$tables = array('kkpr', 'kkpr_kelengkapan', 'jeniskelengkapan');
		$columns = array('kkpr.*', 'kkpr_kelengkapan.*', 'jeniskelengkapan.*');
		$condition = array('kkpr_kelengkapan.nomor = "'.$this->uri->segment(3).'"', 'kkpr.nomor = kkpr_kelengkapan.nomor', 'kkpr_kelengkapan.idjenis = jeniskelengkapan.idjenis');
		$order = 'kkpr_kelengkapan.idjenis';
		$sort = 'ASC';
		$group = '';
		$data['kelengkapan'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		if ($kkpr[0]->idpemohon <> $this->session->userdata('idpemohon')) {
			redirect('kkpr');
		}

		$this->load->view('pemohon/main', $data);
	}

}
