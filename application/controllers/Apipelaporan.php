<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Apipelaporan extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->methods['index_get']['limit'] = 200;
	}

	public function index_get()
	{
		$this->load->model('read');
		$this->load->helper("read_helper");
		$id = $this->get('nomor');

		if ($id === null) {
			$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
			$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
			$condition = array('kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
			$order = 'kkpr.tglterbit';
			$sort = 'DESC';
			$group = '';
			$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		} else {
			$tables = array('kkpr', 'pemohon', 'kecamatan', 'kelurahan');
			$columns = array('kkpr.*', 'pemohon.nama AS namapemohon', 'pemohon.noktp', 'kecamatan.*', 'kelurahan.nama AS nama_kel');
			$condition = array('kkpr.statuskkpr = "PKKPR VALID"', 'kkpr.nomor = '.$id, 'kkpr.idpemohon = pemohon.idpemohon', 'kkpr.id_kec = kecamatan.id_kec', 'kkpr.id_kel = kelurahan.id_kel');
			$order = 'kkpr.tglterbit';
			$sort = 'DESC';
			$group = '';
			$kkpr = $this->read->read_many($tables, $columns, $condition, $order, $sort, $group);
		}

		if ($kkpr) {

			$data   =   array();
			foreach ($kkpr as $row):
				$kelengkapan = array();
				foreach (read($row->nomor,'kkpr_kelengkapan','nomor') as $field):
					$kelengkapan[] = [
						"jeniskelengkapan" => read($field->idjenis,'jeniskelengkapan','idjenis')[0]->jeniskelengkapan,
						"filekelengkapan" => base_url()."kelengkapan-adm/unduh/?file=". $field->filekelengkapan
					];
				endforeach;
				$pelaporan = array();
				foreach (read($row->nomor,'pelaporan','nomor') as $col):
					$pelaporan[] = [
						"tglpelaporan" => $col->tglpelaporan,
						"filepelaporan" => base_url()."pelaporan-adm/unduh/?file=". $col->filepelaporan,
						"luasrealisasi" => $col->luasrealisasi,
						"statuslaporan" => $col->statuslaporan,
						"catatan" => $col->catatan,
						"tglverifikasi" => $col->tglverifikasi,
						"jenisdok" => $col->jenisdok,
						"nomordok" => $col->nomordok,
						"tgldok" => $col->tgldok,
						"pejabat" => $col->pejabat
					];
				endforeach;

				$data[] = [
					"nomor" => $row->nomor,
					"namapelaku" => $row->namapelaku,
					"npwp" => $row->npwp,
					"alamatpelaku" => $row->alamatpelaku,
					"tlppelaku" => $row->tlppelaku,
					"emailpelaku" => $row->emailpelaku,
					"spm" => $row->spm,
					"kodekbli" => $row->kodekbli,
					"judulkbli" => $row->judulkbli,
					"skalausaha" => $row->skalausaha,
					"alamatusaha" => $row->alamatusaha,
					"id_kec" => $row->id_kec,
					"id_kel" => $row->id_kel,
					"luasdimohon" => $row->luasdimohon,
					"luasdisetujui" => $row->luasdisetujui,
					"pr" => $row->pr,
					"kdbmak" => $row->kdbmak,
					"klbmak" => $row->klbmak,
					"ippr" => $row->ippr,
					"ppkpr" => $row->ppkpr,
					"gsbmin" => $row->gsbmin,
					"jbbmin" => $row->jbbmin,
					"kdhmin" => $row->kdhmin,
					"ktbmin" => $row->ktbmin,
					"juk" => $row->juk,
					"tglterbit" => $row->tglterbit,
					"idpemohon" => $row->idpemohon,
					"statuskkpr" => $row->statuskkpr,
					"namapemohon" => $row->namapemohon,
					"noktp" => $row->noktp,
					"id_kota" => $row->id_kota,
					"nama_kec" => $row->nama_kec,
					"nama_kel" => $row->nama_kel,
					"kelengkapan" =>[$kelengkapan],
					"pelaporan" =>[$pelaporan],
				];
			endforeach;

			$this->response([
				'status' => true,
				//'data' => $kkpr,
				'data' => $data,
			], RestController::HTTP_OK);

		} else {
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], RestController::HTTP_NOT_FOUND);
		}
	}
}
