<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekanan extends CI_Model{
	public function Getcv(){
		$data = $this->db->query("SELECT tbl_cvrekanan.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional, tbl_perwakilan.alamat_perwakilan FROM tbl_cvrekanan, tbl_marea, tbl_mnasional, tbl_perwakilan WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_cvrekanan.kode_perwakilan=tbl_perwakilan.kode_perwakilan  AND tbl_cvrekanan.aktif='Aktif' ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
    public function Getkodecv(){
        $data = $this->db->query("SELECT max(kode_cv) FROM tbl_cvrekanan WHERE kode_cv LIKE 'CV_%'");
        return $data;
    }
	public function Insert($table,$data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function Update($table, $data, $where){
        $res = $this->db->update($table, $data, $where);
        return $res;
    }
    public function Resign($table, $data, $where){
        $res = $this->db->update($table, $data, $where);
        return $res;
    }
}
?>