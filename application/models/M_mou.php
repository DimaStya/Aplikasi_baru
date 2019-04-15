<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mou extends CI_Model{
	public function Getmou(){
		$data = $this->db->query("SELECT tbl_mou.*, tbl_mnasional.kode_nasional, tbl_mnasional.nama_nasional, tbl_marea.nama_area, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper, tbl_cvrekanan.nama_cv FROM tbl_perwakilan, tbl_cvrekanan, tbl_mou, tbl_marea, tbl_mnasional WHERE tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_cvrekanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_area = tbl_marea.kode_area AND tbl_mnasional.kode_nasional = tbl_marea.kode_nasional AND tbl_mou.aktif='Aktif'");
		return $data;
	}
	public function Getkode(){
		$data = $this->db->query("SELECT no_mou FROM tbl_mou");
		return $data->result_array();
	}
    public function Getkodemou(){
        $data = $this->db->query("SELECT no_mou FROM tbl_mou");
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