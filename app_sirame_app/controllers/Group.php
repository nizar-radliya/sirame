<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->menu = 'pengguna';
    }

    public function index()
	{
		permission(8);
        $this->load->model('read');
		$this->load->helper('row_helper');
		$this->load->helper('enum_helper');
		$data['title'] = webname().' - Group';
        $data['view'] = 'backend/group/group';
		$data['menu'] = $this->menu;

        $table = 'group';
        $order = 'idgroup';
        $sort = 'ASC';
        $data['group'] = $this->read->read_one($table, $order, $sort);

        $this->load->view('backend/main', $data);
	}

	public function form_add()
	{
		permission(9);
		$this->load->model('read');
		$data['title'] = webname().' - Tambah Group';
		$data['view'] = 'backend/group/group_add';
		$data['menu'] = $this->menu;

		$this->load->view('backend/main', $data);
	}

	public function add()
	{
		permission(9);
		$this->load->model('create');
		$this->load->model('read');

		$role = $this->input->post('role');
		$table = 'group';
		$kode = array('role' => $role);
		$check = $this->read->read_array($table, $kode);

		if (empty($check)) {
			$data = array(
				'role' => $role
			);

			if ($this->create->create_one($table, $data)) {

				$tables = 'group';
				$orders = 'idgroup';
				$sorts = 'DESC';
				$datagroup = $this->read->read_one($tables, $orders, $sorts);
				$idgroup = $datagroup[0]->idgroup;

				$table = 'menu';
				$order = 'idmenu';
				$sort = 'ASC';
				$datamenu = $this->read->read_one($table, $order, $sort);
				foreach ($datamenu as $row) {
					$permission = 'permission';
					$datas = array(
						'idmenu' => $row->idmenu,
						'idgroup' => $idgroup,
						'akses' => '0'
					);
					$this->create->create_one($permission, $datas);
				}

				$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil ditambah.');
				redirect('group');
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
				redirect('group/form-add');
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: group sudah pernah digunakan.');
			redirect('group/form-add');
		}
	}

	public function form_edit()
	{
		permission(10);
		$this->load->model('read');
		$data['title'] = webname().' - Ubah Group';
		$data['view'] = 'backend/group/group_edit';
		$data['menu'] = $this->menu;

		$id = $this->uri->segment(3);

		$table = 'group';
		$id = array('idgroup' => $id);
		$data['group'] = $this->read->read_array($table, $id);

		$this->load->view('backend/main', $data);
	}

	public function edit()
	{
		permission(10);
		$this->load->model('update');
		$this->load->model('read');

		$id = $this->input->post('idgroup');
		$role = $this->input->post('role');
		$table = 'group';
		$kode = array('role' => $role, 'idgroup !=' => $id);
		$check = $this->read->read_array($table, $kode);

		if (empty($check)) {
			$by = 'idgroup';
			$data = array(
				'role' => $this->input->post('role')
			);

			if ($this->update->update_one($table, $by, $id, $data)) {
				$this->session->set_flashdata('success', 'Berhasil Simpan: data berhasil diubah.');
				redirect('group/form-edit/' . $id);
			} else {
				$this->session->set_flashdata('error', 'Gagal Simpan: data belum tersimpan ke server.');
				redirect('group/form-edit/' . $id);
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal Simpan: role group daerah irigasi sudah pernah digunakan.');
			redirect('group/form-edit' . $id);
		}
	}

	public function form_del()
	{
		permission(11);
		$data['id'] = $this->input->get('id');
		$this->load->view('backend/group_del', $data);
	}

	public function del()
	{
		permission(11);
		$this->load->model('delete');
		$id = $this->uri->segment(3);
		$table = 'group';
		$by = 'idgroup';

		if ($this->delete->delete_one($table, $by, $id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect('group');
		} else {
			$this->session->set_flashdata('error', 'Gagal Hapus: data belum terhapus dari server.');
			redirect('group');
		}
	}

	public function permission()
	{
		permission(12);
		$this->load->model('read');
		$data['title'] = webname().' - Permission';
		$data['view'] = 'backend/group/permission';
		$data['menu'] = $this->menu;

		$idgroup = $this->uri->segment(3);

		$table = 'group';
		$id = array('idgroup' => $idgroup);
		$data['group'] = $this->read->read_array($table, $id);

		$tables = array('permission p', 'menu m');
		$columns = array('p.*', 'm.*');
		$condition = array('p.idmenu = m.idmenu', 'idgroup = '.$idgroup);
		$order = 'm.menu';
		$sort = 'ASC';
		$group = '';
		$data['permission'] = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);

		$this->load->view('backend/main', $data);
	}

	public function permission_del()
	{
		permission(14);
		$data['id'] = $this->input->get('id');
		$data['id2'] = $this->input->get('id2');
		$this->load->view('backend/group/permission_del', $data);
	}

	public function permission_delete()
	{
		permission(14);
		$this->load->model('update');

		$table = 'permission';
		$by = 'idpermission';
		$id = $this->uri->segment(3);
		$data = array(
			'akses' => '0'
		);
		$idgroup = $this->uri->segment(4);

		if ($this->update->update_one($table, $by, $id, $data)) {
			$this->session->set_flashdata('success', 'Berhasil Hapus: akses permission berhasil ditutup.');
			redirect('group/permission/' . $idgroup);
		} else {
			$this->session->set_flashdata('error', 'Gagal Hapus: akses permission belum berhasil ditutup.');
			redirect('group/permission/' . $idgroup);
		}
	}

	public function permission_add()
	{
		permission(13);
		$data['id'] = $this->input->get('id');
		$data['id2'] = $this->input->get('id2');
		$this->load->view('backend/group/permission_add', $data);
	}

	public function permission_plus()
	{
		permission(13);
		$this->load->model('update');

		$table = 'permission';
		$by = 'idpermission';
		$id = $this->uri->segment(3);
		$data = array(
			'akses' => '1'
		);
		$idgroup = $this->uri->segment(4);

		if ($this->update->update_one($table, $by, $id, $data)) {
			$this->session->set_flashdata('success', 'Berhasil Hapus: akses permission berhasil ditutup.');
			redirect('group/permission/' . $idgroup);
		} else {
			$this->session->set_flashdata('error', 'Gagal Hapus: akses permission belum berhasil ditutup.');
			redirect('group/permission/' . $idgroup);
		}
	}

}
