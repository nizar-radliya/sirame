<?php
class Update extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function update_one($table,$by,$id,$data) {
        $this->db->where($by,$id);
        $this->db->update($table,$data);
        return true;
    }

	public function kkpr($catatan,$statuslaporan,$tglverifikasi,$idpengguna,$id) {
		$this->db->set("catatan",$catatan,true);
		$this->db->set("statuslaporan",$statuslaporan,true);
		$this->db->set("tglverifikasi",$tglverifikasi,true);
		$this->db->set("idpengguna",$idpengguna,true);
		$this->db->where("idpelaporan",$id);
		$this->db->update("pelaporan");
		return true;
	}

	public function skrr($shape,$jenis,$lat,$lng,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$peruntukan,$id_kec,$id_kel,$alamatskrr,$luastanah,$luastanahdimohon,$buktipenguasaantanah,$id) {
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("jenis",$jenis,true);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
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
		$this->db->where("kodeskrr",$id);
		$this->db->update("skrr");
		return true;
	}

	public function siteplan($shape,$lat,$lng,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$luas,$statustanah,$penggunaansekarang,$rencana,$id_kec,$id_kel,$jalan,$rt,$rw,$id) {
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
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
		$this->db->where("kodesiteplan",$id);
		$this->db->update("siteplan");
		return true;
	}

	public function dokumen_skrr($shape,$jenis,$lat,$lng,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$peruntukan,$id_kec,$id_kel,$alamatskrr,$luastanah,$luastanahdimohon,$buktipenguasaantanah,$statusskrr,$kbli,$polaruang,$kdb,$klb,$gsp,$gsb,$gss,$tglskrr,$nomor,$id) {
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("jenis",$jenis,true);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
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
		$this->db->set("statusskrr",$statusskrr,true);
		$this->db->set("kbli",$kbli,true);
		$this->db->set("polaruang",$polaruang,true);
		$this->db->set("kdb",$kdb,true);
		$this->db->set("klb",$klb,true);
		$this->db->set("gsp",$gsp,true);
		$this->db->set("gsb",$gsb,true);
		$this->db->set("gss",$gss,true);
		$this->db->set("tglskrr",$tglskrr,true);
		$this->db->set("nomor",$nomor,true);
		$this->db->where("kodeskrr",$id);
		$this->db->update("skrr");
		return true;
	}

	public function dokumen_siteplan($shape,$lat,$lng,$idpemohon,$atasnama,$kategori,$perusahaan,$nib,$luas,$statustanah,$penggunaansekarang,$rencana,$id_kec,$id_kel,$jalan,$rt,$rw,$statussiteplan,$tglsiteplan,$nomor,$id) {
		$this->db->set("SHAPE",'geomfromtext("'.$shape.'")',false);
		$this->db->set("lat",$lat,true);
		$this->db->set("lng",$lng,true);
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
		$this->db->set("statussiteplan",$statussiteplan,true);
		$this->db->set("tglsiteplan",$tglsiteplan,true);
		$this->db->set("nomor",$nomor,true);
		$this->db->where("kodesiteplan",$id);
		$this->db->update("siteplan");
		return true;
	}

}
?>
