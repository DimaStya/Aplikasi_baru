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
    public function Getperwakilanadm(){
        $data = $this->db->query("SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE aktif='Aktif' AND kode_perwakilan NOT IN (SELECT kode_perwakilan FROM tbl_admper WHERE aktif='Aktif')");
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
    public function GetMou($where){
        $data = $this->db->query("SELECT no_mou, rabat FROM tbl_mou WHERE kode_cv='$where' AND aktif='Aktif'");
        return $data->result();
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
    public function Getbuku($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek){

        $data = $this->db->query("SELECT tbl_buku.*, tbl_harga_$tahun_sek.* FROM tbl_buku, tbl_harga_$tahun_sek WHERE tbl_buku.kode_buku = tbl_harga_$tahun_sek.kode_buku AND tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum'");
        return $data->result();
    }
    public function Getpaket($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum, $kode_paket){

        $data = $this->db->query("SELECT tbl_buku.* FROM tbl_buku WHERE tbl_buku.kode_penerbit= '$kode_penerbit' AND tbl_buku.tipe='$tipe_buku' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum' AND tbl_buku.kode_buku NOT IN (SELECT kode_buku FROM tbl_detpaket WHERE kode_paket='$kode_paket')");
        return $data->result();
    }
}
?>