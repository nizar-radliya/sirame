<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->title = webname().' - Pengumuman';
        $this->menu     = 'pengumuman';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		permission(26);
        $this->load->helper("format_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/pengumuman/pengumuman';

		$table = 'pengumuman';
		$order = 'waktu';
		$sort = 'DESC';
		$data['pengumuman'] = $this->read->read_one($table, $order, $sort);

        $this->load->view('backend/main',$data);
	}

    public function form_add()
	{
		permission(27);
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/pengumuman/pengumuman_add';

        $this->load->view('backend/main',$data);
	}

	public function add()
    {
		permission(27);
        $this->load->model('create');

        $idpengguna = $this->session->userdata['idpengguna'];

        if (isset($_FILES['berkas']['name']) && !empty($_FILES['berkas']['name'])) {

            $nmfile = 'sipetarung_' . $idpengguna . '_' . time();
            $config['file_name'] = $nmfile;
            $config['upload_path'] = './assets/file/pengumuman/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 1603840000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('berkas')) {
                //$error = array('error' => $this->upload->display_errors());
                //$this->load->view('upload_form', $error);

                $this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
                redirect('pengumuman/form-add');
            } else {
                $berkas = $this->upload->data();
                $table = 'pengumuman';
                $data = array(
                    'idPengumuman' => '',
                    'judul' => $this->input->post('judul'),
                    'isi' => $this->input->post('isi'),
                    'waktu' => date('Y-m-d H:i:s'),
                    'berkas' => $berkas['file_name'],
                    'idpengguna' => $idpengguna
                );

                if ($this->create->create_one($table, $data)) {
                    redirect('pengumuman');
                } else {
                    $this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
                    redirect('pengumuman/form-add');
                }
            }
        } else {
            $table = 'pengumuman';
            $data = array(
                'idPengumuman' => '',
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'waktu' => date('Y-m-d H:i:s'),
                'berkas' => NULL,
                'idpengguna' => $idpengguna
            );

            if ($this->create->create_one($table, $data)) {
                redirect('pengumuman');
            } else {
                $this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
                redirect('pengumuman/form-add');
            }
        }
    }

    public function form_edit()
    {
		permission(28);
        $this->load->helper("format_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/pengumuman/pengumuman_edit';

        $table          = 'pengumuman';
        $nim            = array('idPengumuman' => $this->uri->segment(3));
        $data['pengumuman']    = $this->read->read_array($table, $nim);

        $this->load->view('backend/main', $data);
    }

    public function edit()
    {
		permission(28);
        $this->load->model('update');

        $idpengguna = $this->session->userdata['idpengguna'];

        $table  = 'pengumuman';
        $by     = 'idPengumuman';
        $id     = $this->input->post('idPengumuman');
        $data   = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'waktu' => date('Y-m-d H:i:s'),
            'idpengguna' => $idpengguna
        );

        if ($this->update->update_one($table,$by,$id,$data)) {
            redirect('pengumuman');
        } else {
            $this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
            redirect('pengumuman/form-edit/'.$id);
        }
    }

    public function form_del()
    {
		permission(29);
        $data['id'] = $this->input->get('id');
        $this->load->view('backend/pengumuman/pengumuman_del', $data);
    }

    public function del()
    {
		permission(29);
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'pengumuman';
        $by = 'idPengumuman';

        $this->db->where($by, $id);
        $query = $this->db->get($table);
        $row = $query->row();

        if (isset($row)) {
            unlink("./assets/file/pengumuman/$row->berkas");
        }

        $this->delete->delete_one($table, $by, $id);

        redirect('pengumuman');
    }

    public function unduh()
    {
        $name = $this->input->get('file');
        $tipe = substr($name, -3);

        if ($tipe == 'pdf') {
            $this->output
                ->set_content_type('application/pdf')
                ->set_output(file_get_contents('assets/file/pengumuman/' . basename($name)));
        } else if ($tipe == 'jpg' || $tipe == 'jpeg' || $tipe == 'png' || $tipe == 'gif') {
            $this->output
                ->set_content_type('jpeg')
                ->set_output(file_get_contents('assets/file/pengumuman/' . basename($name)));
        } else {
            $this->load->helper('download');
            $data = file_get_contents("assets/file/pengumuman/" . basename($name));
            force_download($name, $data);
            //redirect('berkas', 'refresh');
        }
    }

	public function baca()
	{
		$this->load->library(array('recaptcha','form_validation'));
		$data['recaptcha_html'] = $this->recaptcha->render();
		$this->load->helper("format_helper");
		$this->load->model('read');
		$table  = 'pengumuman';
		$id     = array('idPengumuman' => $this->input->get('id'));
		$data['pengumuman'] = $this->read->read_array($table, $id);

		$this->load->view('frontend/pengumuman_isi',$data);
	}

	public function publik()
	{
		$this->load->helper("format_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'frontend/pengumuman';
		$this->load->library(array('recaptcha','form_validation'));
		$data['recaptcha_html'] = $this->recaptcha->render();
		akses(4);

		$table = 'pengumuman';
		$order = 'waktu';
		$sort = 'DESC';
		$data['pengumuman'] = $this->read->read_one($table, $order, $sort);

		$this->load->view('frontend/main',$data);
	}

	public function pemohon()
	{
		log_pemohon();
		$this->load->helper("format_helper");
		$this->load->model('read');
		$data['title']  = $this->title;
		$data['menu'] 	= $this->menu;
		$data['view'] 	= 'pemohon/pengumuman';

		$table = 'pengumuman';
		$order = 'waktu';
		$sort = 'DESC';
		$data['pengumuman'] = $this->read->read_one($table, $order, $sort);

		$this->load->view('pemohon/main',$data);
	}

}
