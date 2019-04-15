<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{
	public function cek($username, $pass){
		$data = $this->db->query("SELECT * FROM tbl_user WHERE username='$username' AND pass='$pass'");
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
		$data = $this->db->query("SELECT tbl_admper.kode_admper, tbl_admper.nama_admper, tbl_perwakilan.alamat_perwakilan, tbl_admper.kode_perwakilan FROM tbl_perwakilan, tbl_admper WHERE tbl_admper.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_admper.kode_admper='$kodeadm'");
		return $data;
	}
	public function Admpusat($kodeadm){
		$data = $this->db->query("SELECT kode_admpusat, nama_admpusat FROM tbl_admpusat WHERE kode_admpusat='$kodeadm'");
		return $data;
	}
	public function Admgudang($kodeadm){
		$data = $this->db->query("SELECT kode_admgudang, nama_admgudang FROM tbl_admgudang WHERE kode_admgudang='$kodeadm'");
		return $data;
	}
}
?>