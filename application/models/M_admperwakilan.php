<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admperwakilan extends CI_Model{
	public function Getadmperwakilan(){
		$data = $this->db->query("SELECT tbl_admper.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper   FROM tbl_admper, tbl_marea, tbl_mnasional, tbl_perwakilan WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_admper.kode_perwakilan=tbl_perwakilan.kode_perwakilan  AND tbl_admper.aktif='Aktif' ORDER BY tbl_admper.kode_admper");
		return $data;
	}
    public function Getkodeadmperwakilan(){
        $data = $this->db->query("SELECT max(kode_admper) FROM tbl_admper");
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