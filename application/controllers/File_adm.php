<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->title    = webname().' - File';
        $this->menu     = 'file-adm';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		permission(26);
        $this->load->helper("format_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/file/file';

		$table = 'file';
		$order = 'tgl';
		$sort = 'DESC';
		$data['file'] = $this->read->read_one($table,$order,$sort);

        $this->load->view('backend/main',$data);
	}

    public function form_add()
	{
		permission(27);
        $this->load->model('backend/read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/file/file_add';

		$data['sifat']  = array('Private','Public');

        $this->load->view('backend/main',$data);
	}

	public function add()
    {
		permission(27);
        $this->load->model('create');

		$filename=$_FILES['file_rtrw']['name'];
		$nmfile = str_replace(" ","_",$filename);
		$config['file_name'] = $nmfile;
		$config['upload_path'] = './assets/file/file/';
		$config['allowed_types'] = '*';
		$config['max_size'] = 1603840000;
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_rtrw')) {
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);

			$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
			redirect('file-adm/form-add');
		} else {
			$file = $this->upload->data();
			$table = 'file';
			$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'file' => $file['file_name'],
				'tgl' => date('Y-m-d H:i:s'),
				'sifat' => $this->input->post('sifat')
			);

			if ($this->create->create_one($table, $data)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil ditambah.');
				redirect('file-adm');
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data tidak tersimpan ke server.');
				redirect('file-adm/form-add');
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
        $data['view'] 	= 'backend/file/file_edit';

		$data['sifat']  = array('Private','Public');

        $table          = 'file';
        $nim            = array('idfile' => $this->uri->segment(3));
        $data['file']    = $this->read->read_array($table, $nim);

        $this->load->view('backend/main', $data);
    }

    public function edit()
    {
		permission(28);
        $this->load->model('update');

		$id = $this->input->post('idfile');

		if (!empty($_FILES["file_rtrw"]["name"])) {
			$file_old = $this->input->post('file_name');
			unlink("./assets/file/file/$file_old");

			$filename=$_FILES['file_rtrw']['name'];
			$nmfile = str_replace(" ","_",$filename);
			$config['file_name'] = $nmfile;
			$config['upload_path'] = './assets/file/file/';
			$config['allowed_types'] = '*';
			$config['max_size'] = 1603840000;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$upload = $this->upload->do_upload('file_rtrw');
			$file = $this->upload->data();
			$file_name = $file['file_name'];
		} else {
			$file_name = $this->input->post('file_name');
			$upload = TRUE;
		}

		if (!$upload) {
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);

			$this->session->set_flashdata('error', 'Gagal Unggah: file tidak tersimpan ke server.');
			redirect('file-adm/form-edit/' . $id);
		} else {
			$table = 'file';
			$by = 'idfile';
			$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'file' => $file_name,
				'tgl' => date('Y-m-d H:i:s'),
				'sifat' => $this->input->post('sifat')
			);

			if ($this->update->update_one($table, $by, $id, $data)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: data sudah tersimpan ke server.');
				redirect('file-adm');
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
				redirect('file-adm/form-edit/' . $id);
			}
		}
    }

    public function form_del()
    {
		permission(29);
        $data['id'] = $this->input->get('id');
        $this->load->view('backend/file/file_del', $data);
    }

    public function del()
    {
		permission(29);
        $this->load->model('delete');
        $id = $this->uri->segment(3);
        $table = 'file';
        $by = 'idfile';

        $this->db->where($by, $id);
        $query = $this->db->get($table);
        $row = $query->row();

        if (isset($row)) {
            unlink("./assets/file/file/$row->file");
        }

        $this->delete->delete_one($table, $by, $id);

        redirect('file-adm');
    }

    public function unduh()
    {
        $name = $this->input->get('file');
        $tipe = substr($name, -3);

        if ($tipe == 'pdf') {
            $this->output
                ->set_content_type('application/pdf')
                ->set_output(file_get_contents('assets/file/file/' . basename($name)));
        } else if ($tipe == 'jpg' || $tipe == 'jpeg' || $tipe == 'png' || $tipe == 'gif') {
            $this->output
                ->set_content_type('jpeg')
                ->set_output(file_get_contents('assets/file/file/' . basename($name)));
        } else {
            $this->load->helper('download');
            $data = file_get_contents("assets/file/file/" . basename($name));
            force_download($name, $data);
            //redirect('file', 'refresh');
        }
    }

}
