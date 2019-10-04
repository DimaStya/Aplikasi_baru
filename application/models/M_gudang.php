<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gudang extends CI_Model{
	 public function Getadmgudang(){
		$data = $this->db->query("SELECT * FROM tbl_admgudang WHERE aktif='Aktif'");
		return $data;
	 }
    public function Getkodeadmgudang(){
        $data = $this->db->query("SELECT max(kode_admgudang) FROM tbl_admgudang");
        return $data;
    }
    public function Kawasan($kode_admgudang){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlegudang WHERE tbl_handlegudang.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlegudang.kode_perwakilan AND tbl_handlegudang.kode_admgudang =  '$kode_admgudang' GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Pesananbaru($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima,  COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku 
            FROM tbl_do, tbl_customer,tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_pesanan, tbl_buku_do, tbl_mou 
            WHERE tbl_perwakilan.kode_wilayah =  '$kode_wilayah' 
            AND tbl_pesanan.proses =  'DO, Menunggu SJ' 
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_do.no_do = tbl_buku_do.no_do
            AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_do DESC");
        return $data;
    }
    public function Proses($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima,  SUM( tbl_buku_do.jumlah_kirim ) AS jumlah_kirim, SUM( tbl_buku_do.sisa_kirim ) AS sisa_kirim FROM tbl_do, tbl_customer,tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_pesanan, tbl_mou, tbl_buku_do 
            WHERE tbl_do.no_do = tbl_buku_do.no_do 
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer 
            AND tbl_pesanan.no_mou = tbl_mou.no_mou 
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv 
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales 
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan 
            AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' 
            AND tbl_pesanan.proses =  'Proses SJ' 
            AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC HAVING SUM(tbl_buku_do.sisa_kirim) > 0");
        return $data;
    }
    public function Selesai($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_suratjalan.no_suratjalan, tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_suratjalan.tanggal AS tgl_sj, tbl_do.tanggal AS tgl_do, tbl_pesanan.tanggal AS tgl_pesan 
            FROM tbl_suratjalan, tbl_do, tbl_pesanan, tbl_customer,tbl_sales, tbl_perwakilan, tbl_mou, tbl_cvrekanan 
            WHERE tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer 
            AND tbl_pesanan.no_mou = tbl_mou.no_mou 
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv 
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales 
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan 
            AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah'  AND DATE( tbl_suratjalan.tanggal ) BETWEEN  '$awal' AND  '$akhir'  ");
        return $data;
    }
    public function Pesan_selesai($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima,  SUM( tbl_buku_do.jumlah_kirim ) AS jumlah_kirim, SUM( tbl_buku_do.sisa_kirim ) AS sisa_kirim FROM tbl_do, tbl_customer,tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_pesanan, tbl_mou, tbl_buku_do 
            WHERE tbl_do.no_do = tbl_buku_do.no_do 
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer 
            AND tbl_pesanan.no_mou = tbl_mou.no_mou 
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv 
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales 
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan 
            AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' 
            AND tbl_pesanan.proses =  'Proses SJ' 
            AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC HAVING SUM(tbl_buku_do.sisa_kirim) = 0");
        return $data;
    }
    public function Reqretur($kode_wilayah){
        $data = $this->db->query("SELECT tbl_suratretur.tanggal, tbl_suratretur.alasan,tbl_suratretur.no_suratretur, tbl_do.no_do
            FROM tbl_suratretur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_perwakilan
            WHERE tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratretur.keterangan = 'Admin Telah Menerima'
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah' 
            AND tbl_suratretur.no_suratretur NOT IN (SELECT no_suratretur FROM tbl_retur)");
        return $data;
    }
    public function Retur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_suratretur.no_suratretur, tbl_retur.kode_retur, tbl_faktur.no_faktur,tbl_suratjalan.no_suratjalan, tbl_retur.tanggal, tbl_suratretur.keterangan,
            IF(tbl_retur.kode_retur IN(SELECT kode_retur FROM tbl_notaretur), 'Sudah Nota Retur', 'Belum Nota Retur') as nota_retur
            FROM tbl_suratretur, tbl_suratjalan, tbl_faktur, tbl_retur, tbl_do, tbl_pesanan, tbl_perwakilan

            WHERE tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_suratjalan.no_suratjalan = tbl_suratretur.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan
            AND tbl_suratretur.no_suratretur = tbl_retur.no_suratretur
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND DATE( tbl_retur.tanggal ) BETWEEN  '$awal' AND  '$akhir'");
        return $data;
    }
    public function Requpdate($kode_wilayah){
        $data = $this->db->query("SELECT tbl_retur.tanggal, tbl_retur.kode_retur, tbl_suratretur.no_suratretur
            FROM tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_perwakilan
            WHERE tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratretur.keterangan = 'Admin Telah Menerima Update'
            AND tbl_suratretur.no_suratretur = tbl_retur.no_suratretur
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah' 
            AND tbl_retur.kode_retur NOT IN (SELECT kode_retur FROM tbl_notaretur)");
        return $data;
    }
    public function Pesananbaru_stokmini($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do_stokmini.no_do_stokmini, tbl_do_stokmini.tanggal, tbl_pesan_stokmini.alamat_kirim, tbl_pesan_stokmini.keterangan, COUNT( tbl_buku_psnstk.kode_buku ) AS jumlah_judul, SUM( tbl_buku_psnstk.jumlah ) AS jumlah_buku FROM tbl_do_stokmini, tbl_pesan_stokmini, tbl_perwakilan, tbl_buku_psnstk
            WHERE tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND tbl_buku_psnstk.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_do_stokmini.no_do_stokmini NOT IN (SELECT no_do_stokmini FROM tbl_sj_stok)
            AND DATE( tbl_do_stokmini.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do_stokmini.no_do_stokmini DESC");
        return $data;
    }
    public function Proses_stokmini($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_sj_stok.no_sj_stkmini, tbl_sj_stok.tanggal, tbl_pesan_stokmini.alamat_kirim,tbl_sj_stok.ket, tbl_pesan_stokmini.keterangan, COUNT( tbl_buku_psnstk.kode_buku ) AS jumlah_judul, SUM( tbl_buku_psnstk.jumlah ) AS jumlah_buku
            FROM tbl_do_stokmini, tbl_pesan_stokmini, tbl_perwakilan, tbl_buku_psnstk, tbl_sj_stok
            WHERE tbl_do_stokmini.no_do_stokmini = tbl_sj_stok.no_do_stokmini
            AND tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND tbl_buku_psnstk.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND DATE( tbl_sj_stok.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_sj_stok.no_sj_stkmini DESC");
        return $data;
    }
    public function Stok_mini($kode_wilayah){
        $data = $this->db->query("SELECT tbl_stokmini.kode_buku, tbl_stokmini.stok, tbl_buku.judul FROM tbl_buku, tbl_stokmini, tbl_perwakilan 
            WHERE tbl_stokmini.kode_buku = tbl_buku.kode_buku
            AND tbl_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah='$kode_wilayah'");
        return $data;
    }
    public function Data_reqretur($no_suratretur){
        $data = $this->db->query("SELECT tbl_buku_sj.jumlah as jumlah_kirim, tbl_buku_reqretur.jumlah as jumlah_retur, tbl_buku.judul, tbl_buku_reqretur.kode_buku, tbl_buku_reqretur.no_do, tbl_buku_reqretur.no_suratretur, tbl_buku_reqretur.no_suratjalan, tbl_buku_reqretur.harga
            FROM tbl_buku_reqretur, tbl_buku_sj, tbl_buku
            WHERE tbl_buku_reqretur.no_suratretur = '$no_suratretur'
            AND tbl_buku_reqretur.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_buku_reqretur.no_do = tbl_buku_sj.no_do
            AND tbl_buku_reqretur.kode_buku = tbl_buku_sj.kode_buku
            AND tbl_buku_reqretur.kode_buku = tbl_buku.kode_buku"); 
        return $data;
    }
    public function Data_headretur($no_suratretur){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_suratretur.no_suratretur, tbl_suratretur.tanggal as tgl_suratretur, tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal as tgl_sj, tbl_faktur.no_faktur, tbl_faktur.tanggal as tgl_faktur, tbl_perwakilan.nama_kaper, tbl_sales.nama_sales, tbl_suratretur.alasan
            FROM tbl_customer, tbl_cvrekanan, tbl_mou, tbl_pesanan, tbl_suratretur, tbl_suratjalan, tbl_faktur, tbl_do, tbl_perwakilan, tbl_sales
            WHERE tbl_suratretur.no_suratretur ='$no_suratretur'
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan
            AND tbl_do.no_do = tbl_suratjalan.no_do
            AND tbl_pesanan.no_pesanan = tbl_do.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv"); 
        return $data;
    }
    public function Data_ttr($kode_retur){
        $data = $this->db->query("SELECT tbl_buku_retur.kode_buku, tbl_buku_retur.jumlah, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang, tbl_buku.kurikulum
            FROM tbl_buku_retur, tbl_buku
            WHERE tbl_buku_retur.kode_retur = '$kode_retur'
            AND tbl_buku_retur.kode_buku=tbl_buku.kode_buku"); 
        return $data;
    }
    public function Data_headttr($no_suratretur){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.kode_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_retur.kode_retur, tbl_retur.tanggal as tgl_retur, tbl_suratretur.no_suratretur, tbl_suratretur.tanggal as tgl_suratretur, tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal as tgl_sj, tbl_faktur.no_faktur, tbl_faktur.tanggal as tgl_faktur, tbl_perwakilan.nama_kaper, tbl_sales.nama_sales, tbl_suratretur.alasan
            FROM tbl_customer, tbl_cvrekanan, tbl_mou, tbl_pesanan, tbl_suratretur, tbl_suratjalan, tbl_faktur, tbl_do, tbl_perwakilan, tbl_sales, tbl_retur
            WHERE tbl_retur.kode_retur ='$no_suratretur'
            AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan
            AND tbl_do.no_do = tbl_suratjalan.no_do
            AND tbl_pesanan.no_pesanan = tbl_do.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv"); 
        return $data;
    }
    public function Data_stokmini($no_sj_stkmini){
        $data = $this->db->query("SELECT tbl_buku_stkmini.kode_buku, tbl_buku_stkmini.jumlah, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang, tbl_buku.kurikulum
            FROM tbl_buku_stkmini, tbl_buku
            WHERE tbl_buku_stkmini.no_sj_stkmini = '$no_sj_stkmini'
            AND tbl_buku_stkmini.kode_buku=tbl_buku.kode_buku"); 
        return $data;
    }
    public function Data_headstokmini($no_sj_stkmini){
        $data = $this->db->query("SELECT tbl_sj_stok.tanggal, tbl_sj_stok.no_sj_stkmini, tbl_perwakilan.nama_kaper, tbl_perwakilan.alamat_perwakilan, tbl_sj_stok.ekspedisi, tbl_sj_stok.nama_sopir, tbl_sj_stok.no_telp_sopir, tbl_pesan_stokmini.alamat_kirim, tbl_pesan_stokmini.keterangan, tbl_sj_stok.no_polisi, tbl_admgudang.nama_admgudang, SUM(tbl_buku_stkmini.jumlah) AS jumlah FROM tbl_sj_stok, tbl_buku_stkmini, tbl_pesan_stokmini, tbl_perwakilan, tbl_admgudang, tbl_do_stokmini
            WHERE tbl_sj_stok.no_sj_stkmini = '$no_sj_stkmini'
            AND tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND tbl_sj_stok.no_sj_stkmini = tbl_buku_stkmini.no_sj_stkmini
            AND tbl_sj_stok.no_do_stokmini = tbl_do_stokmini.no_do_stokmini
            AND tbl_sj_stok.no_do_stokmini = tbl_buku_stkmini.no_stokmini
            AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_sj_stok.kode_admgudang = tbl_admgudang.kode_admgudang
            "); 
        return $data;
    }
    public function Data_sj($no_do){
        $data = $this->db->query("SELECT tbl_suratjalan.no_do,tbl_suratjalan.tanggal, tbl_suratjalan.no_suratjalan, SUM( tbl_buku_sj.jumlah ) AS jumlah_buku, COUNT( tbl_buku_sj.kode_buku ) AS jumlah_judul, tbl_admgudang.nama_admgudang FROM tbl_suratjalan, tbl_buku_sj, tbl_admgudang WHERE tbl_suratjalan.no_do = '$no_do' AND tbl_suratjalan.no_suratjalan = tbl_buku_sj.no_suratjalan AND tbl_suratjalan.kode_admgudang=tbl_admgudang.kode_admgudang GROUP BY tbl_suratjalan.no_suratjalan ASC");
        return $data;
    }
    public function Alamat($no_pesanan){
        $data = $this->db->query("SELECT tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.stok
            FROM tbl_pesanan, tbl_mou, tbl_kerjasama, tbl_customer, tbl_cvrekanan 
            WHERE tbl_pesanan.no_pesanan = '$no_pesanan'
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            GROUP BY tbl_pesanan.no_pesanan");
        return $data->row_array();
    }
    public function Data_buku_sj($no_pesanan){
        $data = $this->db->query("SELECT tbl_buku_do.*, tbl_buku.judul, tbl_buku.stok_real as stok, tbl_buku.stok_pesan FROM tbl_buku_do, tbl_buku WHERE tbl_buku_do.no_do='$no_pesanan' AND tbl_buku_do.kode_buku = tbl_buku.kode_buku AND tbl_buku_do.sisa_kirim > 0");
        return $data->result();
    }
    public function Data_buku_sj_mini($no_pesanan){
        $data = $this->db->query("SELECT tbl_buku_do.*, tbl_buku.judul, tbl_stokmini.stok as stok, tbl_buku.stok_pesan FROM tbl_buku_do, tbl_buku, tbl_stokmini, tbl_do, tbl_pesanan 
            WHERE tbl_buku_do.no_do='$no_pesanan'
            AND tbl_do.no_do = tbl_buku_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_stokmini.kode_perwakilan
            AND tbl_stokmini.kode_buku = tbl_buku.kode_buku
            AND tbl_buku_do.kode_buku = tbl_buku.kode_buku 
            AND tbl_buku_do.sisa_kirim > 0");
        return $data->result();
    }
    public function Cetak($no_suratjalan){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku_sj.jumlah, tbl_buku.judul, tbl_buku.jenjang, tbl_buku.edisi, tbl_buku.kurikulum FROM tbl_buku, tbl_buku_sj WHERE tbl_buku_sj.no_suratjalan = '$no_suratjalan' AND tbl_buku.kode_buku = tbl_buku_sj.kode_buku");
        return $data;
    }
    public function Datahead($no_suratjalan, $kode_admgudang){
        $data = $this->db->query("SELECT tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_pesanan.sumber_dana, tbl_suratjalan.tanggal, tbl_suratjalan.no_suratjalan, tbl_suratjalan.ekspedisi, tbl_suratjalan.nama_sopir, tbl_suratjalan.no_telp_sopir, tbl_suratjalan.no_polisi, tbl_suratjalan.koli, tbl_suratjalan.karung, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_admgudang.nama_admgudang, SUM(tbl_buku_sj.jumlah) AS jumlah
            FROM tbl_pesanan, tbl_suratjalan,tbl_do, tbl_sales, tbl_perwakilan, tbl_admgudang, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_buku_sj
        WHERE tbl_suratjalan.no_suratjalan = '$no_suratjalan'
        AND tbl_suratjalan.no_suratjalan = tbl_buku_sj.no_suratjalan
        AND tbl_suratjalan.no_do = tbl_do.no_do
        AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
        AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
        AND tbl_pesanan.no_mou = tbl_mou.no_mou
        AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
        AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
        AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
        AND tbl_admgudang.kode_admgudang='$kode_admgudang'");
        return $data;
    }
    public function Buku_oc(){
        $data = $this->db->query("SELECT tbl_buku_oc.*, tbl_buku.judul FROM tbl_buku, tbl_buku_oc WHERE tbl_buku_oc.kode_buku = tbl_buku.kode_buku AND tbl_buku_oc.kurang > 0");
        return $data;
    }
    public function Updateretur($kode_retur){
        $data = $this->db->query("UPDATE tbl_retur, tbl_suratretur SET tbl_suratretur.keterangan='Menunggu Admin' WHERE tbl_retur.kode_retur='$kode_retur' AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur");
        return $data;
    }
    public function Getkodelpb($kode){
        $data = $this->db->query("SELECT max(kode_lpb) FROM tbl_lpb WHERE kode_lpb LIKE '%$kode'");
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
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
    public function save_batch($table ,$data){
        return $this->db->insert_batch($table, $data);
    }
    public function Lpb($awal, $akhir){
        $data = $this->db->query("SELECT tbl_lpb.* FROM tbl_lpb
            WHERE DATE( tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY kode_lpb DESC");
        return $data;
    }
    public function Buku_lpb($kode_lpb){
        $data = $this->db->query("SELECT tbl_buku_lpb.*, tbl_buku.judul, tbl_buku.stok_real FROM tbl_buku, tbl_buku_lpb WHERE tbl_buku.kode_buku = tbl_buku_lpb.kode_buku AND tbl_buku_lpb.kode_lpb = '$kode_lpb'");
        return $data;
    }
    public function Hapus($kode_lpb,$kode_buku,$kode_oc){
        $data = $this->db->query("DELETE FROM tbl_buku_lpb WHERE kode_lpb='$kode_lpb' AND kode_buku='$kode_buku' AND kode_oc='$kode_oc' ");
        return $data;
    }
}
?>