<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{
	public function cek($username, $pass){
		$data = $this->db->query("SELECT * FROM tbl_user WHERE username='$username' AND pass='$pass'");
		return $data;
	}public function Getaktivitas(){
		$data = $this->db->query("SELECT tbl_login.username, tbl_login.tanggal, tbl_user.kode, tbl_user.hak_akses FROM tbl_user, tbl_login WHERE tbl_login.username = tbl_user.username");
		return $data;
	}
	public function cookie($cookie_user){
		$data = $this->db->query("SELECT * FROM tbl_login WHERE cookie_user='$cookie_user'");
		return $data;
	}
	public function user($data){
		$data = $this->db->query("SELECT * FROM tbl_user WHERE username='$data'");
		return $data;
	}
	public function login($username){
		$data = $this->db->query("SELECT * FROM tbl_login WHERE username='$username'");
		return $data;
	}
	public function insert($table, $data){
		$res = $this->db->insert($table, $data);
        return $res;
	}
	public function stay(){
		$data = $this->db->query("SELECT * FROM tbl_login");
		return $data;
	}
	public function habis($table, $where){
		$res = $this->db->delete($table, $where); 
        return $res;
	}
	public function Admper($kodeadm){
		$data = $this->db->query("SELECT tbl_admper.kode_admper, tbl_admper.nama_admper, tbl_perwakilan.alamat_perwakilan,tbl_perwakilan.kode_wilayah, tbl_admper.kode_perwakilan FROM tbl_perwakilan, tbl_admper WHERE tbl_admper.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_admper.kode_admper='$kodeadm'");
		return $data;
	}
	public function Admpusat($kodeadm){
		$data = $this->db->query("SELECT kode_admpusat, nama_admpusat FROM tbl_admpusat WHERE kode_admpusat='$kodeadm'");
		return $data;
	}
	public function Admgudang($kodeadm){
		$data = $this->db->query("SELECT tbl_admgudang.kode_admgudang, tbl_admgudang.nama_admgudang FROM tbl_admgudang WHERE tbl_admgudang.kode_admgudang='$kodeadm'");
		return $data;
	}
	public function Admkeu($kodeadm){
		$data = $this->db->query("SELECT kode_admkeuangan, nama_admkeuangan FROM tbl_admkeuangan WHERE kode_admkeuangan='$kodeadm'");
		return $data;
	}
	public function Admproduksi($kodeadm){
		$data = $this->db->query("SELECT kode_admproduksi, nama_produksi FROM tbl_admproduksi WHERE kode_admproduksi='$kodeadm'");
		return $data;
	}
}
?>