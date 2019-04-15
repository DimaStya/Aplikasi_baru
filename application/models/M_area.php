<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_area extends CI_Model{
	public function Getarea(){
		$data = $this->db->query("SELECT tbl_marea.*, tbl_mnasional.nama_nasional FROM tbl_marea, tbl_mnasional WHERE tbl_marea.kode_nasional=tbl_mnasional.kode_nasional");
		return $data;
	}
	public function Getkode(){
		$data = $this->db->query("SELECT kode_area FROM tbl_marea");
		return $data->result_array();
	}
    public function Getkodearea(){
        $data = $this->db->query("SELECT kode_area FROM tbl_marea");
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