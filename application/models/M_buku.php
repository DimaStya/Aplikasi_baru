<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buku extends CI_Model{
	public function Getbuku($tahun_sek){
		$data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_jawa AS sekarang_jawa, tbl_harga_$tahun_sek.harga_luar AS sekarang_luar FROM tbl_buku, tbl_harga_$tahun_sek WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku GROUP BY tbl_buku.kode_buku");
		return $data;
	}
    public function Getbuku1($tahun_sek, $tahun_lalu){
        $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_jawa AS sekarang_jawa, tbl_harga_$tahun_sek.harga_luar AS sekarang_luar, tbl_harga_$tahun_lalu.harga_jawa AS lalu_jawa, tbl_harga_$tahun_lalu.harga_luar AS lalu_luar FROM tbl_buku, tbl_harga_$tahun_sek, tbl_harga_$tahun_lalu WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_buku = tbl_harga_$tahun_lalu.kode_buku GROUP BY tbl_buku.kode_buku");
        return $data;
    }
    public function Getbuku2($tahun_sek, $tahun_depan){
         $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_jawa AS sekarang_jawa, tbl_harga_$tahun_sek.harga_luar AS sekarang_luar, tbl_harga_$tahun_depan.harga_jawa AS depan_jawa, tbl_harga_$tahun_depan.harga_luar AS depan_luar FROM tbl_buku, tbl_harga_$tahun_sek, tbl_harga_$tahun_depan WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_buku = tbl_harga_$tahun_depan.kode_buku GROUP BY tbl_buku.kode_buku");
        return $data;
    }
    public function Getbuku3($tahun_sek, $tahun_lalu, $tahun_depan){
         $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_jawa AS sekarang_jawa, tbl_harga_$tahun_sek.harga_luar AS sekarang_luar, tbl_harga_$tahun_lalu.harga_jawa AS lalu_jawa, tbl_harga_$tahun_lalu.harga_luar AS lalu_luar, tbl_harga_$tahun_depan.harga_jawa AS depan_jawa, tbl_harga_$tahun_depan.harga_luar AS depan_luar FROM tbl_buku, tbl_harga_$tahun_sek, tbl_harga_$tahun_lalu, tbl_harga_$tahun_depan WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_buku = tbl_harga_$tahun_lalu.kode_buku AND tbl_buku.kode_buku = tbl_harga_$tahun_depan.kode_buku GROUP BY tbl_buku.kode_buku");
        return $data;
    }
	public function Insert($table,$data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function save_batch($table, $data){
        return $this->db->insert_batch($table, $data);
    }
    public function Update($table, $data, $where){
        $res = $this->db->update($table, $data, $where);
        return $res;
    }
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where);
        return $res;
    }
    public function Deletbuku($kode_paket, $data_hapus){
        for ($i = 0; $i < count($data_hapus); $i++){
            $this->db->where('kode_paket',$kode_paket);
            $this->db->where($data_hapus[$i]);
            $data = $this->db->delete('tbl_detpaket');
    }
        return $data;
    }
    public function Gettahun(){
        $data = $this->db->query("SHOW TABLES LIKE 'tbl_harga%'");
        return $data->result_array();
    }
    public function Gettahun_(){
        $data = $this->db->query("SHOW TABLES LIKE 'tbl_harga%'");
        return $data;
    }
    public function Getnopaket(){
        $data = $this->db->query("SELECT MAX(kode_paket)  FROM tbl_paket");
        return $data->result_array();
    }
    public function Getpaket(){
        $data = $this->db->query("SELECT nama_paket, kode_paket  FROM tbl_paket");
        return $data->result_array();
    }
    public function Getbukupaket($kode_paket){
        $data = $this->db->query("SELECT COUNT(kode_buku) AS jumlah FROM tbl_detpaket WHERE kode_paket='$kode_paket'");
        return $data->row_array();
    }
    public function Getdetpaket($kode_paket){
        $data = $this->db->query("SELECT tbl_paket.nama_paket, tbl_paket.kode_paket, COUNT(tbl_detpaket.kode_buku) AS jumlah FROM tbl_paket, tbl_detpaket WHERE tbl_detpaket.kode_paket = tbl_paket.kode_paket AND tbl_paket.kode_paket='$kode_paket'");
        return $data->row_array();
    }
    public function Getpaketdetail($kode_paket){
        $data = $this->db->query("SELECT tbl_buku.kode_buku, tbl_buku.judul FROM tbl_buku, tbl_detpaket WHERE tbl_buku.kode_buku = tbl_detpaket.kode_buku AND tbl_detpaket.kode_paket='$kode_paket'");
        return $data->result_array();
    }
}
?>