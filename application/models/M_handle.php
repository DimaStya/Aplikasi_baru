<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_handle extends CI_Model{
	public function Getpemasaran(){
		$data = $this->db->query("SELECT tbl_handlepemasaran.kode_handle, tbl_perwakilan.alamat_perwakilan, tbl_admpusat.nama_admpusat, tbl_handlepemasaran.aktif, tbl_handlepemasaran.kondisi, tbl_handlepemasaran.kode_perwakilan, tbl_handlepemasaran.kode_admpusat FROM tbl_perwakilan, tbl_admpusat, tbl_handlepemasaran WHERE tbl_handlepemasaran.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_handlepemasaran.kode_admpusat = tbl_admpusat.kode_admpusat ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
	public function Getkeuangan(){
		$data = $this->db->query("SELECT tbl_handlekeuangan.kode_handle, tbl_perwakilan.alamat_perwakilan, tbl_admkeuangan.nama_admkeuangan, tbl_handlekeuangan.aktif, tbl_handlekeuangan.kondisi, tbl_handlekeuangan.kode_perwakilan, tbl_handlekeuangan.kode_admkeuangan FROM tbl_perwakilan, tbl_admkeuangan, tbl_handlekeuangan WHERE tbl_handlekeuangan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_handlekeuangan.kode_admkeuangan = tbl_admkeuangan.kode_admkeuangan ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
	public function Getgudang(){
		$data = $this->db->query("SELECT tbl_handlegudang.kode_handle, tbl_perwakilan.alamat_perwakilan, tbl_admgudang.nama_admgudang, tbl_handlegudang.aktif, tbl_handlegudang.kondisi, tbl_handlegudang.kode_perwakilan, tbl_handlegudang.kode_admgudang FROM tbl_perwakilan, tbl_admgudang, tbl_handlegudang WHERE tbl_handlegudang.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_handlegudang.kode_admgudang = tbl_admgudang.kode_admgudang ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
}
?>