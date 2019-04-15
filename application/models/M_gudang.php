<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gudang extends CI_Model{
	 public function Getadmgudang(){
		$data = $this->db->query("SELECT * FROM tbl_admgudang WHERE aktif='Aktif'");
		return $data;
	 }
	public function Getkode(){
		$data = $this->db->query("SELECT kode_admgudang FROM tbl_admgudang");
		return $data->result_array();
	}
    public function Getkodeadmgudang(){
        $data = $this->db->query("SELECT kode_admgudang FROM tbl_admgudang");
        return $data;
    }

    public function Kawasan($kode_admgudang){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlegudang WHERE tbl_handlegudang.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlegudang.kode_perwakilan AND tbl_handlegudang.kode_admgudang =  '$kode_admgudang' GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Pesananbaru($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima,  COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul, SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku FROM tbl_do, tbl_customer,tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_pesanan, tbl_datapesan, tbl_mou WHERE tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.proses =  'DO, Menunggu SJ' AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC");
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