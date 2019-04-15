<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penerbit extends CI_Model{
	public function Getpenerbit(){
		$data = $this->db->query("SELECT * FROM tbl_penerbit");
		return $data;
	}
	public function Getkode(){
		$data = $this->db->query("SELECT kode_penerbit FROM tbl_penerbit");
		return $data->result_array();
	}
    public function Getkodepenerbit(){
        $data = $this->db->query("SELECT kode_penerbit FROM tbl_penerbit");
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