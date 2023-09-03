<?php
class Pemohon_m extends CI_Model
{
	public function getPemohon($id = null)
	{
		if ($id === null) {
			return $this->db->get('pemohon')->result_array();
		} else {
			return $this->db->get_where('pemohon',['idpemohon' => $id])->result_array();
		}
	}

	public function delPemohon($id)
	{
		$this->db->delete('pemohon',['idpemohon' => $id]);
		return $this->db->affected_rows();
	}

	public function postPemohon($data)
	{
		$this->db->insert('pemohon',$data);
		return $this->db->affected_rows();
	}

	public function putPemohon($data,$id)
	{
		$this->db->update('pemohon',$data,['idpemohon' => $id]);
		return $this->db->affected_rows();
	}
}
