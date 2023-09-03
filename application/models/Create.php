<?php
class Create extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function create_one($table,$data) {
        $this->db->insert($table,$data);
        return true;
    }

	public function kkpr($nomor,$shape,$tglpelaporan,$filepelaporan,$luasrealisasi,$statuslaporan,$catatan,$idpemohon,$jenisdok,$nomordok,$tgldok,$pejabat) {
		$this->db->set("nomor",$nomor,true);
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("tglpelaporan",$tglpelaporan,true);
		$this->db->set("filepelaporan",$filepelaporan,true);
		$this->db->set("luasrealisasi",$luasrealisasi,true);
		$this->db->set("statuslaporan",$statuslaporan,true);
		$this->db->set("catatan",$catatan,true);
		$this->db->set("tglverifikasi",NULL,true);
		$this->db->set("idpemohon",$idpemohon,true);
		$this->db->set("idpengguna",NULL,true);
		$this->db->set("jenisdok",$jenisdok,true);
		$this->db->set("nomordok",$nomordok,true);
		$this->db->set("tgldok",$tgldok,true);
		$this->db->set("pejabat",$pejabat,true);
		$this->db->insert("pelaporan");
		return true;
	}

	public function skrr($kodeskrr,$shape,$tgl,$jenis,$lat,$lng,$statusskrr,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$peruntukan,$id_kec,$id_kel,$alamatskrr,$luastanah,$luastanahdimohon,$buktipenguasaantanah) {
		$this->db->set("kodeskrr",$kodeskrr,true);
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("nama",$kodeskrr,true);
		$this->db->set("tgl",$tgl,true);
		$this->db->set("jenis",$jenis,true);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
		$this->db->set("statusskrr",$statusskrr,true);
		$this->db->set("idpemohon",$idpemohon,true);
		$this->db->set("atasnama",$atasnama,true);
		$this->db->set("kategori",$kategori,true);
		$this->db->set("atasnama",$atasnama,true);
		$this->db->set("perusahaan",$perusahaan,true);
		$this->db->set("nib",$nib,true);
		$this->db->set("peruntukan",$peruntukan,true);
		$this->db->set("id_kec",$id_kec,true);
		$this->db->set("id_kel",$id_kel,true);
		$this->db->set("alamatskrr",$alamatskrr,true);
		$this->db->set("luastanah",$luastanah,true);
		$this->db->set("luastanahdimohon",$luastanahdimohon,true);
		$this->db->set("buktipenguasaantanah",$buktipenguasaantanah,true);
		$this->db->insert("skrr");
		return true;
	}

	public function siteplan($kodesiteplan,$shape,$tgl,$lat,$lng,$statussiteplan,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$luas,$statustanah,$penggunaansekarang,$rencana,$id_kec,$id_kel,$jalan,$rt,$rw) {
		$this->db->set("kodesiteplan",$kodesiteplan,true);
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("nama",$kodesiteplan,true);
		$this->db->set("tgl",$tgl,true);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
		$this->db->set("statussiteplan",$statussiteplan,true);
		$this->db->set("idpemohon",$idpemohon,true);
		$this->db->set("atasnama",$atasnama,true);
		$this->db->set("kategori",$kategori,true);
		$this->db->set("atasnama",$atasnama,true);
		$this->db->set("perusahaan",$perusahaan,true);
		$this->db->set("nib",$nib,true);
		$this->db->set("luas",$luas,true);
		$this->db->set("statustanah",$statustanah,true);
		$this->db->set("penggunaansekarang",$penggunaansekarang,true);
		$this->db->set("rencana",$rencana,true);
		$this->db->set("id_kec",$id_kec,true);
		$this->db->set("id_kel",$id_kel,true);
		$this->db->set("jalan",$jalan,true);
		$this->db->set("rt",$rt,true);
		$this->db->set("rw",$rw,true);
		$this->db->insert("siteplan");
		return true;
	}
}
?>
