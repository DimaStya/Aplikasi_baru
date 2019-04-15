<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesan extends CI_Model{
    public function Getpesanan($kode_admper, $proses){
        $data = $this->db->query("SELECT tbl_pesanan.tanggal, tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_pesanan.tipe_buku, tbl_pesanan.jenjang, COUNT(tbl_datapesan.kode_buku) AS jumlah_judul, SUM(tbl_datapesan.jumlah_beli) AS jumlah_buku , tbl_pesanan.proses FROM tbl_pesanan, tbl_datapesan, tbl_mou, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan WHERE tbl_datapesan.no_pesanan = tbl_pesanan.no_pesanan AND tbl_customer.kode_customer = tbl_pesanan.kode_customer AND tbl_cvrekanan.kode_cv = tbl_mou.kode_cv AND tbl_mou.no_mou = tbl_pesanan.no_mou AND tbl_sales.kode_sales = tbl_pesanan.kode_sales AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan  AND tbl_pesanan.kode_admper='$kode_admper' AND tbl_pesanan.proses='$proses' AND tbl_pesanan.no_pesanan NOT IN(SELECT no_pesanan FROM tbl_do) GROUP BY tbl_pesanan.no_pesanan DESC");
        return $data;
    }
    public function Getdecline($kode_admper, $proses){
        $data = $this->db->query("SELECT tbl_pesanan.tanggal, tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_pesanan.sumber_dana, tbl_pesanan.jenis_pembayaran, tbl_pesanan.tipe_buku, tbl_pesanan.jenjang, tbl_pesanan.proses, tbl_pesanan.alasan FROM tbl_pesanan, tbl_datapesan, tbl_mou, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan WHERE tbl_datapesan.no_pesanan = tbl_pesanan.no_pesanan AND tbl_customer.kode_customer = tbl_pesanan.kode_customer AND tbl_cvrekanan.kode_cv = tbl_mou.kode_cv AND tbl_mou.no_mou = tbl_pesanan.no_mou AND tbl_sales.kode_sales = tbl_pesanan.kode_sales AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan  AND tbl_pesanan.kode_admper='$kode_admper' AND tbl_pesanan.proses='$proses' AND tbl_pesanan.no_pesanan NOT IN(SELECT no_pesanan FROM tbl_do) GROUP BY tbl_pesanan.no_pesanan DESC");
        return $data;
    }
    public function Getapprove($kode_admper, $proses){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan,tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_pesanan.tipe_buku, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul, SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku , tbl_pesanan.proses FROM tbl_pesanan, tbl_do, tbl_datapesan, tbl_sales, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_perwakilan WHERE tbl_pesanan.no_pesanan = tbl_do.no_pesanan AND tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_sales.kode_sales = tbl_pesanan.kode_sales AND tbl_customer.kode_customer = tbl_pesanan.kode_customer AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan AND tbl_mou.no_mou = tbl_pesanan.no_mou AND tbl_cvrekanan.kode_cv = tbl_mou.kode_cv AND tbl_pesanan.kode_admper = '$kode_admper' AND tbl_pesanan.proses='$proses' GROUP BY tbl_do.no_pesanan DESC");
        return $data;
    }
    public function Gethapus($kode_admper, $proses){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan,tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_pesanan.tipe_buku, tbl_pesanan.jenjang, tbl_pesanan.proses, tbl_pesanan.alasan FROM tbl_pesanan, tbl_do, tbl_datapesan, tbl_sales, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_perwakilan WHERE tbl_pesanan.no_pesanan = tbl_do.no_pesanan AND tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_sales.kode_sales = tbl_pesanan.kode_sales AND tbl_customer.kode_customer = tbl_pesanan.kode_customer AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan AND tbl_mou.no_mou = tbl_pesanan.no_mou AND tbl_cvrekanan.kode_cv = tbl_mou.kode_cv AND tbl_pesanan.kode_admper = '$kode_admper' AND tbl_pesanan.proses='$proses' GROUP BY tbl_do.no_pesanan DESC");
        return $data;
    }
	public function Getsales($kode_perwakilan){
		$data = $this->db->query("SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='$kode_perwakilan'");
		return $data;
	}
    public function Getcv($kode_perwakilan){
        $data = $this->db->query("SELECT tbl_mou.kode_cv, tbl_cvrekanan.nama_cv FROM tbl_cvrekanan, tbl_mou WHERE tbl_cvrekanan.kode_cv=tbl_mou.kode_cv AND tbl_cvrekanan.kode_perwakilan='$kode_perwakilan' AND tbl_cvrekanan.aktif='Aktif' GROUP BY tbl_mou.kode_cv ");
        return $data;
    }
    public function Getcustomer($kode_perwakilan){
        $data = $this->db->query("SELECT kode_customer, nama_customer FROM tbl_customer WHERE kode_perwakilan='$kode_perwakilan' AND aktif='Aktif' ");
        return $data;
    }
    public function Getpenerbit(){
        $data = $this->db->query("SELECT tbl_buku.kode_penerbit, tbl_penerbit.nama_penerbit FROM tbl_buku, tbl_penerbit WHERE tbl_buku.kode_penerbit=tbl_penerbit.kode_penerbit GROUP BY tbl_penerbit.kode_penerbit");
        return $data;
    }
    public function Getkodewilayah($kode_perwakilan){
        $data = $this->db->query("SELECT kode_wilayah FROM tbl_perwakilan WHERE kode_perwakilan='$kode_perwakilan'");
        return $data;
    }
    public function Getnopesan($kode){
        $data = $this->db->query("SELECT max(no_pesanan) FROM tbl_pesanan WHERE no_pesanan LIKE '%$kode'");
        return $data;
    }
    public function save_batch($data){
        return $this->db->insert_batch('tbl_datapesan', $data);
    }
    public function save_pesanan($data){
        return $this->db->insert('tbl_pesanan', $data);
    }
    public function Getdetpesan($no_pesan){
        $data = $this->db->query("SELECT tbl_pesanan.no_pesanan, tbl_pesanan.tanggal, tbl_cvrekanan.nama_cv, tbl_pesanan.no_mou, tbl_mou.rabat, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.tipe_buku, tbl_pesanan.jenis_pembayaran, tbl_pesanan.sumber_dana, tbl_pesanan.proses FROM tbl_pesanan, tbl_cvrekanan, tbl_mou, tbl_customer, tbl_sales, tbl_perwakilan WHERE tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_pesanan.no_pesanan ='$no_pesan'");
        return $data;
    }
    public function Getdetbuku($no_pesan){
        $data = $this->db->query("SELECT tbl_datapesan.kode_buku, tbl_buku.judul, tbl_datapesan.jumlah_beli, tbl_penerbit.nama_penerbit, tbl_buku.jenjang, tbl_buku.edisi, tbl_buku.stok_pesan FROM tbl_buku, tbl_datapesan, tbl_penerbit WHERE tbl_buku.kode_buku = tbl_datapesan.kode_buku AND tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit AND tbl_datapesan.no_pesanan='$no_pesan'");
        return $data;
    }
    public function Getdatbuk($no_pesan){
        $data = $this->db->query("SELECT tbl_penerbit.kode_penerbit, tbl_buku.tipe, tbl_buku.jenjang, tbl_buku.edisi, tbl_buku.kurikulum FROM tbl_buku, tbl_datapesan, tbl_penerbit WHERE tbl_buku.kode_buku = tbl_datapesan.kode_buku AND tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit AND tbl_datapesan.no_pesanan='$no_pesan'");
        return $data;
    }
    public function Getbuku($no_pesan){
        $data = $this->db->query("SELECT tbl_datapesan.kode_buku, tbl_buku.judul, tbl_buku.stok_real, tbl_buku.stok_pesan, tbl_datapesan.jumlah_beli FROM tbl_buku, tbl_datapesan WHERE tbl_datapesan.kode_buku = tbl_buku.kode_buku AND tbl_datapesan.no_pesanan ='$no_pesan'");
        return $data;
    }
    public function Getdatapesan($no_pesan){
        $data = $this->db->query("SELECT tbl_pesanan.tahun, tbl_perwakilan.kawasan FROM tbl_pesanan, tbl_perwakilan WHERE tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_pesanan.no_pesanan='$no_pesan'");
        return $data;
    }
    public function Getjudul($no_pesan, $kode_penerbit, $tipe, $jenjang, $edisi, $kurikulum, $tahun, $kawasan){
        $data = $this->db->query("SELECT tbl_buku.kode_buku, tbl_buku.judul,  tbl_buku.stok_real, tbl_buku.stok_pesan, tbl_harga_$tahun.harga_$kawasan AS harga FROM tbl_buku, tbl_harga_$tahun  WHERE tbl_harga_$tahun.kode_buku=tbl_buku.kode_buku AND tbl_buku.kode_penerbit='$kode_penerbit' AND tbl_buku.tipe='$tipe' AND tbl_buku.jenjang='$jenjang' AND tbl_buku.edisi='$edisi' AND tbl_buku.kurikulum='$kurikulum' AND tbl_buku.kode_buku NOT IN (SELECT kode_buku FROM tbl_datapesan WHERE no_pesanan='$no_pesan')");
        return $data;
    }
    public function Ubahjumlah($no_pesanan, $data_ubah){
        $this->db->where('no_pesanan',$no_pesanan);
        $data = $this->db->update_batch('tbl_datapesan',$data_ubah, 'kode_buku');
        return $data;
    }
    public function Deletbuku($no_pesanan, $data_hapus){
        for ($i = 0; $i < count($data_hapus); $i++){
            $this->db->where('no_pesanan',$no_pesanan);
            $this->db->where($data_hapus[$i]);
            $data = $this->db->delete('tbl_datapesan');
    }
        return $data;
    }
    public function Hapuspesan($table, $where){
        $data = $this->db->delete($table,$where);
        return $data;
    }
    public function Reqhapus($data, $where){
        $data = $this->db->update('tbl_pesanan',$data, $where);
        return $data;
    }
}
?>