<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model{
	 public function Getadmkeuangan(){
		$data = $this->db->query("SELECT * FROM tbl_admkeuangan WHERE aktif='Aktif'");
		return $data;
	 }
	public function Getkode(){
		$data = $this->db->query("SELECT kode_admkeuangan FROM tbl_admkeuangan");
		return $data->result_array();
	}
    public function Getkodeadmkeuangan(){
        $data = $this->db->query("SELECT kode_admkeuangan FROM tbl_admkeuangan");
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
    public function Tambah_handle($table, $data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function Ubah_handle($table, $data, $where){
        $res = $this->db->update($table, $data, $where);
        return $res;
    }
    public function Hapus_handle($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
}
?>