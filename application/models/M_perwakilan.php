<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perwakilan extends CI_Model{
	public function Getperwakilan(){
		$data = $this->db->query("SELECT tbl_perwakilan.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional FROM tbl_perwakilan, tbl_marea, tbl_mnasional WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_perwakilan.aktif='Aktif' ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
	public function Getkode(){
		$data = $this->db->query("SELECT kode_perwakilan FROM tbl_perwakilan");
		return $data->result_array();
	}
    public function Getkodeperwakilan(){
        $data = $this->db->query("SELECT kode_perwakilan FROM tbl_perwakilan");
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
}
?>