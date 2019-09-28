<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model{
	public function Getpengajuan(){
		$data = $this->db->query("SELECT tbl_pengajuan.*, tbl_mnasional.kode_nasional, tbl_mnasional.nama_nasional, tbl_marea.nama_area, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper, tbl_kerjasama.nama_kerjasama FROM tbl_perwakilan, tbl_kerjasama, tbl_pengajuan, tbl_marea, tbl_mnasional WHERE tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama AND tbl_kerjasama.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_area = tbl_marea.kode_area AND tbl_mnasional.kode_nasional = tbl_marea.kode_nasional AND tbl_pengajuan.aktif='Aktif'");
		return $data;
	}
	public function Getkode(){
		$data = $this->db->query("SELECT no_pengajuan FROM tbl_pengajuan");
		return $data->result_array();
	}
    public function Getkodepengajuan(){
        $data = $this->db->query("SELECT no_pengajuan FROM tbl_pengajuan");
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