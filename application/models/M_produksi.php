<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produksi extends CI_Model{
	 public function Getadmproduksi(){
		$data = $this->db->query("SELECT * FROM tbl_admproduksi WHERE aktif='Aktif'");
		return $data;
	 }
    public function Getkodeadmproduksi(){
        $data = $this->db->query("SELECT max(kode_admproduksi) FROM tbl_admproduksi");
        return $data;
    }
	public function Insert($table,$data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function save_batch($table,$data){
        return $this->db->insert_batch($table, $data);
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
    public function Getkodeoc($kode){
        $data = $this->db->query("SELECT max(kode_oc) FROM tbl_oc WHERE kode_oc LIKE '%$kode'");
        return $data;
    }
    public function OC($awal, $akhir){
        $data = $this->db->query("SELECT tbl_oc.*, tbl_admproduksi.nama_produksi FROM tbl_oc, tbl_admproduksi
            WHERE tbl_oc.kode_admproduksi =tbl_admproduksi.kode_admproduksi
             AND DATE( tbl_oc.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_oc.kode_oc DESC");
        return $data;
    }
    public function Buku_oc($kode_oc){
        $data = $this->db->query("SELECT tbl_buku_oc.kode_buku, tbl_buku.judul, tbl_buku_oc.jumlah, tbl_buku_oc.kurang, tbl_buku_oc.kode_oc FROM tbl_buku, tbl_buku_oc WHERE tbl_buku_oc.kode_buku = tbl_buku.kode_buku AND tbl_buku_oc.kode_oc = '$kode_oc'");
        return $data;
    }
    public function Updatestok_oc($kode_oc, $kode_buku, $jumlah){
        $data = $this->db->query("UPDATE tbl_buku_oc, tbl_buku SET tbl_buku.stok_oc = tbl_buku.stok_oc - $jumlah, tbl_buku_oc.jumlah = tbl_buku_oc.jumlah-$jumlah, tbl_buku_oc.kurang = tbl_buku_oc.kurang - $jumlah WHERE tbl_buku_oc.kode_oc = '$kode_oc' AND tbl_buku_oc.kode_buku = tbl_buku.kode_buku AND tbl_buku_oc.kode_buku = '$kode_buku' ");
        return $data;
    }
}
?>