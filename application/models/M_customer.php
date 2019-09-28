<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_customer extends CI_Model{
	public function Getcustomer(){
		$data = $this->db->query("SELECT tbl_customer.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional, tbl_perwakilan.alamat_perwakilan FROM tbl_customer, tbl_marea, tbl_mnasional, tbl_perwakilan WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_customer.kode_perwakilan=tbl_perwakilan.kode_perwakilan  AND tbl_customer.aktif='Aktif' ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
    public function Getkodecustomer(){
        $data = $this->db->query("SELECT max(kode_customer) FROM tbl_customer");
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