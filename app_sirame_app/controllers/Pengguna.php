<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->title = webname().' - Pengguna';
        $this->menu = 'pengguna';

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		permission(2);
        $this->load->helper("enum_helper");
        $this->load->helper("read_helper");
        $this->load->model('read');
        $data['title']  = $this->title;
        $data['menu'] 	= $this->menu;
        $data['view'] 	= 'backend/pengguna/pengguna';

        $table = 'pengguna';
        $order = 'nama';
        $sort = 'ASC';
        $where = array('idpengguna !=' => '1');
        $data['pengguna'] = $this->read->read_array_order($order, $sort, $table, $where);

        $this->load->view('backend/main',$data);
	}

	public function form_add()
	{
		permission(3);
		$this->load->model('read');
		$data['title'] = 'SIPETARUNG DINAS PUPR KAB TABALONG - Tambah Pengguna';
		$data['view'] = 'backend/pengguna/pengguna_add';
		$data['menu'] = $this->menu;

		$table = 'group';
		$order = 'idgroup';
		$sort = 'ASC';
		$data['group'] = $this->read->read_one($table, $order, $sort);

		$this->load->view('backend/main', $data);
	}

	public function add()
	{
		permission(3);
		$this->load->model('create');
		$this->load->model('read');

		$username = $this->input->post('username');
		$table = 'pengguna';
		$kode = array('username' => $username);
		$check = $this->read->read_array($table, $kode);

		if (empty($check)) {

			$this->load->library('image_lib');
			$path_parts = pathinfo($_FILES["foto"]["name"]);
			$extension = $path_parts['extension'];
			$file_name = str_replace(" ","_",$username . '.' . $extension);
			$_FILES['foto']['name'] = $file_name;
			$config['upload_path'] = './assets/file/pengguna/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 1603840;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$foto = $this->upload->do_upload('foto');

			if (!$foto) {
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);

				$this->session->set_flashdata('error', 'Gagal Simpan: file foto belum tersimpan ke server.');
				redirect('pengguna/form-add');
			} else {
				$table = 'pengguna';
				$data = array(
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'level' => 'Administrator',
					'email' => $this->input->post('email'),
					'hp' => $this->input->post('hp'),
					'foto' => $file_name,
					'status' => '1',
					'idgroup' => $this->input->post('idgroup')
				);

				if ($this->create->create_one($table, $data)) {
					$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil ditambah.');
					redirect('pengguna');
				} else {
					$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
					redirect('pengguna/form-add');
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: username sudah pernah digunakan.');
			redirect('pengguna/form-add');
		}
	}

    public function form_edit()
    {
		permission(4);
		$this->load->model('read');
		$data['title'] = 'SIPETARUNG DINAS PUPR KAB TABALONG - Ubah Pengguna';
		$data['view'] = 'backend/pengguna/pengguna_edit';
		$data['menu'] = $this->menu;

		$id = $this->uri->segment(3);

		$table = 'pengguna';
		$id = array('idpengguna' => $id);
		$data['pengguna'] = $this->read->read_array($table, $id);

		$table = 'group';
		$order = 'idgroup';
		$sort = 'ASC';
		$data['group'] = $this->read->read_one($table, $order, $sort);

		$this->load->view('backend/main', $data);
    }

    public function edit()
    {
		permission(4);
		$this->load->model('read');
		$this->load->model('update');
		$this->load->helper('read_helper');

		$idpengguna = $this->input->post('idpengguna');
		$username = $this->input->post('username');
		$table = 'pengguna';
		$kode = array('username' => $username, 'idpengguna !=' => $idpengguna);
		$check = $this->read->read_array($table, $kode);

		if (empty($check)) {
			if (!empty($_FILES["foto"]["name"])) {
				$this->load->library('image_lib');
				$path_parts = pathinfo($_FILES["foto"]["name"]);
				$extension = $path_parts['extension'];
				$file_name = str_replace(" ","_",$username . '.' . $extension);
				$_FILES['foto']['name'] = $file_name;
				$config['upload_path'] = './assets/file/pengguna/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 1603840;
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$foto = $this->upload->do_upload('foto');
			} else {
				$foto = TRUE;
				$file_name = $this->input->post('file_name');
			}
			if (!$foto) {
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);

				$this->session->set_flashdata('error', 'Gagal Simpan: file foto belum tersimpan ke server.');
				redirect('pengguna/form-edit/' . $idpengguna);
			} else {
				$by = 'idpengguna';
				$data = array(
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'level' => 'Administrator',
					'email' => $this->input->post('email'),
					'hp' => $this->input->post('hp'),
					'foto' => $file_name,
					'status' => '1',
					'idgroup' => $this->input->post('idgroup')
				);

				if ($this->update->update_one($table, $by, $idpengguna, $data)) {
					$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil diubah.');
					redirect('pengguna/form-edit/' . $idpengguna);
				} else {
					$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
					redirect('pengguna/form-edit/' . $idpengguna);
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: data sudah pernah digunakan.');
			redirect('pengguna/form-edit/' . $idpengguna);
		}
    }

	public function reset()
	{
		permission(6);
		$this->load->model('update');
		$this->load->model('read');

		$table  = 'pengguna';
		$by     = 'idpengguna';
		$id     = $this->uri->segment(3);
		$hp     = $this->uri->segment(4);
		$data   = array(
			'password'  => md5($hp)
		);

		if ($this->update->update_one($table,$by,$id,$data)) {
			$where = array('idpengguna' => $id);
			$check = $this->read->read_array($table, $where);
			$email = $check[0]->email;
			$username = $check[0]->username;

			$this->load->library('PHPMail'); // load library

			$fromEmail = "nizar.radliya@gmail.com";
			$toEmail = $email;
			$isiEmail = "
                    Yth. <br>
                    Anda sudah berhasil melakukan Reset Password 'SIPETARUNG DINAS PUPR KAB TABALONG'. <br><br>
                    Password Baru: ".$hp."<br>
                    Username: ".$username."<br><br>
                    Silakan lakukan perubahan password setelah login untuk keamanan pengguna. <br><br>
                    Sukses untuk Anda, <br>
                    Admin Sistem.
                    ";

			$objMail = $this->phpmail->load();
			$objMail->IsHTML(true); // Set email format to HTML
			$objMail->IsSMTP(); // Set mailer to use SMTP
			$objMail->SMTPAuth   = true; // Enabled SMTP authentication
			$objMail->SMTPSecure = "ssl";  // Enable TLS encryption, `ssl` also accepted
			$objMail->Host       = "smtp.gmail.com"; // Setting GMail as our SMTP server
			$objMail->Port       = 465; // TCP port to connect to GMail
			$objMail->Username   = $fromEmail;  // SMTP Username email
			$objMail->Password   = "aibe020113"; // SMTP Password email

			//Recipients
			$objMail->setFrom($fromEmail, 'noreply');
			$objMail->AddAddress($toEmail); // Add a recipient
			//$objMail->addAddress('ellen@example.com'); // Name is optional
			//$objMail->addReplyTo('info@example.com', 'Information');
			//$objMail->addCC('cc@example.com');
			//$objMail->addBCC('bcc@example.com');

			//Attachments
			//$objMail->addAttachment('assets/lte/img/icon.png'); // Add attachments
			//$objMail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

			// Content
			$objMail->Subject    = "Reset Password 'SIPETARUNG DINAS PUPR KAB TABALONG'";
			$objMail->Body       = $isiEmail;

			if(!$objMail->Send()) {
				echo "Eror: ".$objMail->ErrorInfo;
			} else {
				echo "Email berhasil dikirim";
			}

			$this->session->set_flashdata('success', 'Reset Password: password sudah berubah menjadi Nomor HP dan dikirim ke email Pengguna.');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Gagal Reset: data password tidak tersimpan ke server.');
			redirect('pengguna');
		}
	}

    public function form_pass()
    {
		permission(7);
		$this->load->model('read');
		$data['title'] = 'SIPETARUNG DINAS PUPR KAB TABALONG - Ubah Password';
		$data['menu'] = $this->menu;
		$data['view'] = 'backend/pengguna/pengguna_pass';

		$table = 'pengguna';
		$id = array('idpengguna' => $this->uri->segment(3));
		$data['pengguna'] = $this->read->read_array($table, $id);

		$this->load->view('backend/main', $data);
    }

    public function edit_pass()
    {
		permission(7);
        $this->load->model('update');
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

        $table  = 'pengguna';
        $by     = 'idpengguna';
        $id     = $this->session->userdata['idpengguna'];
        $kode   = array('idpengguna' => $id, 'password' => md5($this->input->post('pass')));
        $check  = $this->read->read_array($table, $kode);

        if (!empty($check)) {
            $data = array(
                'password' => anti(md5($this->input->post('password')))
            );
            $data = $this->security->xss_clean($data);

            if ($this->update->update_one($table, $by, $id, $data)) {
                $this->session->set_flashdata('success', 'Berhasil Simpan: silakan login menggunakan password baru.');
                redirect('main');
            } else {
                $this->session->set_flashdata('error', 'Gagal Simpan: password anda belum diubah.');
                redirect('pengguna/form-pass/'.$id);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal Simpan: password sekarang belum sesuai.');
            redirect('pengguna/form-pass/'.$id);
        }
    }

}
