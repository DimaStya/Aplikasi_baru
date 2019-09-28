<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_form extends CI_Model{
	public function Getnasional(){
		$data = $this->db->query("SELECT kode_nasional, nama_nasional FROM tbl_mnasional");
		return $data;
	}
    public function Getarea($where){
        $data = $this->db->query("SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nasional='".$where."'");
        return $data->result();
    }
    public function Getperwakilanform($where){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND kode_area='".$where."'");
        return $data->result();
    }
    public function Getperwakilanpem(){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND kode_perwakilan NOT IN (SELECT kode_perwakilan FROM tbl_handlepemasaran)");
        return $data;
    }
    public function Getperwakilankeu(){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND kode_perwakilan NOT IN (SELECT kode_perwakilan FROM tbl_handlekeuangan)");
        return $data;
    }
    public function Getperwakilangdg(){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND  kode_perwakilan NOT IN (SELECT kode_perwakilan FROM tbl_handlegudang)");
        return $data;
    }
    public function Getperwakilanadm($kode_area){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND kode_area= '$kode_area' AND kode_perwakilan NOT IN (SELECT kode_perwakilan FROM tbl_admper WHERE aktif='Aktif')");
        return $data->result();
    }
    public function Getcustomerform($where){
        $data = $this->db->query("SELECT kode_customer, nama_customer FROM tbl_customer WHERE kode_perwakilan='".$where."'");
        return $data->result();
    }
    public function GetCVpengajuan($where){
        $data = $this->db->query("SELECT kode_cv, nama_cv FROM tbl_cvrekanan WHERE kode_perwakilan='".$where."' AND kode_cv NOT IN (SELECT kode_cv FROM tbl_mou WHERE aktif='Aktif')");
        return $data->result();
    }
    public function GetKerjasamapengajuan($where){
        $data = $this->db->query("SELECT kode_kerjasama, nama_kerjasama FROM tbl_kerjasama WHERE kode_perwakilan='".$where."' AND kode_kerjasama NOT IN (SELECT kode_kerjasama FROM tbl_pengajuan WHERE aktif='Aktif')");
        return $data->result();
    }
    public function GetMou($where){
        $data = $this->db->query("SELECT tbl_mou.no_mou, tbl_cvrekanan.kode_cv FROM tbl_mou, tbl_cvrekanan WHERE tbl_cvrekanan.kode_perwakilan='$where' AND tbl_mou.aktif='Aktif' AND tbl_mou.kode_cv=tbl_cvrekanan.kode_cv");
        return $data->result();
    }
    public function GetMoudefault(){
        $data = $this->db->query("SELECT no_mou FROM tbl_mou WHERE no_mou='Tanpa CV'");
        return $data->result();
    }
    public function GetPengajuandefault(){
        $data = $this->db->query("SELECT no_pengajuan FROM tbl_pengajuan WHERE no_pengajuan='Tanpa Pengajuan'");
        return $data->result();
    }
    public function GetPengajuan($where){
        $data = $this->db->query("SELECT tbl_pengajuan.no_pengajuan FROM tbl_pengajuan, tbl_kerjasama WHERE tbl_kerjasama.kode_perwakilan='$where' AND tbl_pengajuan.aktif='Aktif' AND tbl_kerjasama.kode_kerjasama=tbl_pengajuan.kode_kerjasama");
        return $data->result();
    }
    public function Getcv($where){
        $data = $this->db->query("SELECT tbl_cvrekanan.nama_cv FROM tbl_mou, tbl_cvrekanan WHERE tbl_cvrekanan.kode_cv = tbl_mou.kode_cv AND tbl_mou.no_mou='$where'");
        return $data->row_array();
    }
    public function Getkerjasama($where){
        $data = $this->db->query("SELECT tbl_kerjasama.nama_kerjasama FROM tbl_kerjasama, tbl_pengajuan WHERE tbl_kerjasama.kode_kerjasama = tbl_pengajuan.kode_kerjasama AND tbl_pengajuan.no_pengajuan ='$where'");
        return $data->row_array();
    }
    public function Gettipebuku($where){
        $data = $this->db->query("SELECT tipe FROM tbl_buku WHERE kode_penerbit ='$where' GROUP BY tipe");
        return $data->result();
    }
    public function Getjenjang($where,$where1){
        $data = $this->db->query("SELECT jenjang FROM tbl_buku WHERE kode_penerbit ='$where' AND tipe='$where1' GROUP BY jenjang");
        return $data->result();
    }
    public function Getedisi($where,$where1,$where2){
        $data = $this->db->query("SELECT edisi FROM tbl_buku WHERE kode_penerbit ='$where' AND tipe='$where1' AND jenjang='$where2' GROUP BY edisi");
        return $data->result();
    }
    public function Getkurikulum($where,$where1,$where2,$where3){
        $data = $this->db->query("SELECT kurikulum FROM tbl_buku WHERE kode_penerbit ='$where' AND tipe='$where1' AND jenjang='$where2' AND edisi='$where3' GROUP BY kurikulum");
        return $data->result();
    }
    public function Getkawasan($kaper){
         $data = $this->db->query("SELECT kawasan FROM tbl_perwakilan WHERE kode_perwakilan='$kaper'");
        return $data->row_array();
    }
    public function Getbuku($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek,$kawasan){

        $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_$kawasan AS harga FROM tbl_buku, tbl_harga_$tahun_sek WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum'");
        return $data->result();
    }
    public function Getbuku_oc($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum){

        $data = $this->db->query("SELECT tbl_buku.* FROM tbl_buku WHERE tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum'");
        return $data->result();
    }
    public function Getbukupaket($kode_paket,$tahun_sek,$kawasan){

        $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_$kawasan AS harga FROM tbl_buku, tbl_harga_$tahun_sek, tbl_detpaket WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_buku= tbl_detpaket.kode_buku AND tbl_detpaket.kode_paket='$kode_paket'");
        return $data->result();
    }
    public function Getpaket($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum, $kode_paket){

        $data = $this->db->query("SELECT tbl_buku.* FROM tbl_buku WHERE tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum' AND tbl_buku.kode_buku NOT IN (SELECT kode_buku FROM tbl_detpaket WHERE kode_paket='$kode_paket')");
        return $data->result();
    }
    public function Gettipebuku_mini($where,$kode_perwakilan){
        $data = $this->db->query("SELECT tbl_buku.tipe FROM tbl_buku, tbl_stokmini WHERE tbl_buku.kode_penerbit ='$where' AND tbl_buku.kode_buku=tbl_stokmini.kode_buku AND tbl_stokmini.kode_perwakilan = '$kode_perwakilan' GROUP BY tbl_buku.tipe");
        return $data->result();
    }
    public function Getjenjang_mini($where,$where1,$kode_perwakilan){
        $data = $this->db->query("SELECT tbl_buku.jenjang FROM tbl_buku, tbl_stokmini WHERE tbl_buku.kode_penerbit ='$where' AND tbl_buku.tipe='$where1' AND tbl_buku.kode_buku=tbl_stokmini.kode_buku AND tbl_stokmini.kode_perwakilan = '$kode_perwakilan' GROUP BY jenjang");
        return $data->result();
    }
    public function Getedisi_mini($where,$where1,$where2,$kode_perwakilan){
        $data = $this->db->query("SELECT tbl_buku.edisi FROM tbl_buku, tbl_stokmini WHERE tbl_buku.kode_penerbit ='$where' AND tbl_buku.tipe='$where1' AND tbl_buku.jenjang='$where2' AND tbl_buku.kode_buku=tbl_stokmini.kode_buku AND tbl_stokmini.kode_perwakilan = '$kode_perwakilan' GROUP BY edisi");
        return $data->result();
    }
    public function Getkurikulum_mini($where,$where1,$where2,$where3,$kode_perwakilan){
        $data = $this->db->query("SELECT tbl_buku.kurikulum FROM tbl_buku, tbl_stokmini WHERE tbl_buku.kode_penerbit ='$where' AND tbl_buku.tipe='$where1' AND tbl_buku.jenjang='$where2' AND tbl_buku.edisi='$where3' AND tbl_buku.kode_buku=tbl_stokmini.kode_buku AND tbl_stokmini.kode_perwakilan = '$kode_perwakilan' GROUP BY kurikulum");
        return $data->result();
    }
    public function Getkawasan_mini($kaper){
         $data = $this->db->query("SELECT kawasan FROM tbl_perwakilan WHERE kode_perwakilan='$kaper'");
        return $data->row_array();
    }
    public function Getbuku_mini($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek,$kawasan,$kode_perwakilan){

        $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.harga_$kawasan AS harga, tbl_stokmini.stok FROM tbl_buku, tbl_harga_$tahun_sek, tbl_stokmini WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum' AND tbl_stokmini.kode_buku=tbl_buku.kode_buku AND tbl_stokmini.kode_perwakilan = '$kode_perwakilan'");
        return $data->result();
    }
}
?>