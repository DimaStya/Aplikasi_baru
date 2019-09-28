<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sales extends CI_Model{
	public function Getsales(){
		$data = $this->db->query("SELECT tbl_sales.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper   FROM tbl_sales, tbl_marea, tbl_mnasional, tbl_perwakilan WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_sales.kode_perwakilan=tbl_perwakilan.kode_perwakilan  AND tbl_sales.aktif='Aktif' ORDER BY tbl_sales.kode_sales");
		return $data;
	}
    public function Getkodesales(){
        $data = $this->db->query("SELECT max(kode_sales) FROM tbl_sales");
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