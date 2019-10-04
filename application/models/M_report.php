<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model{
    public function Kawasan(){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan WHERE tbl_perwakilan.aktif='Aktif' GROUP BY tbl_perwakilan.alamat_perwakilan"); 
        return $data;
    }
    public function Getsales($perwakilan){
        $data = $this->db->query("SELECT tbl_sales.nama_sales, tbl_pesanan.kode_sales FROM tbl_sales, tbl_pesanan, tbl_do, tbl_perwakilan WHERE tbl_sales.kode_sales = tbl_pesanan.kode_sales AND tbl_pesanan.no_pesanan = tbl_do.no_pesanan AND tbl_perwakilan.kode_perwakilan = tbl_sales.kode_perwakilan AND tbl_perwakilan.kode_wilayah='$perwakilan' GROUP BY tbl_sales.kode_sales"); 
        return $data;
    }
    public function Getcustomer($perwakilan, $sales){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_pesanan.kode_customer FROM tbl_customer, tbl_pesanan, tbl_do, tbl_perwakilan WHERE tbl_customer.kode_customer = tbl_pesanan.kode_customer 
            AND tbl_pesanan.no_pesanan = tbl_do.no_pesanan 
            AND tbl_perwakilan.kode_perwakilan = tbl_customer.kode_perwakilan 
            AND tbl_pesanan.kode_sales = '$sales'
            AND tbl_perwakilan.kode_wilayah='$perwakilan' GROUP BY tbl_customer.kode_customer"); 
        return $data;
    }
    public function Getcv($perwakilan, $sales, $customer){
        $data = $this->db->query("SELECT tbl_cvrekanan.nama_cv, tbl_cvrekanan.kode_cv FROM tbl_cvrekanan, tbl_mou, tbl_pesanan, tbl_do, tbl_perwakilan 
            WHERE tbl_cvrekanan.kode_cv = tbl_mou.kode_cv
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_pesanan.no_pesanan = tbl_do.no_pesanan 
            AND tbl_pesanan.kode_sales = '$sales'
            AND tbl_pesanan.kode_customer = '$customer'
            AND tbl_perwakilan.kode_wilayah='$perwakilan' GROUP BY tbl_cvrekanan.kode_cv"); 
        return $data;
    }
    public function Penerbit(){
        $data = $this->db->query("SELECT tbl_buku.kode_penerbit, tbl_penerbit.nama_penerbit FROM tbl_buku, tbl_penerbit WHERE tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit GROUP BY tbl_penerbit.kode_penerbit"); 
        return $data;
    }
    public function Buku($penerbit, $kode){
        $data = $this->db->query("SELECT $kode FROM tbl_buku WHERE kode_penerbit = '$penerbit' GROUP BY $kode"); 
        return $data->result();
    }
	public function Cari_sales_all(){
        $data = $this->db->query("SELECT  tbl_sales.*, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper  FROM tbl_sales, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_sales.kode_perwakilan ORDER BY tbl_sales.aktif");
        return $data;
    }
    public function Cari_sales($perwakilan){
        $data = $this->db->query("SELECT  tbl_sales.*, tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.nama_kaper  FROM tbl_sales, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_sales.kode_perwakilan AND tbl_perwakilan.kode_wilayah='$perwakilan'  ORDER BY tbl_sales.aktif");
        return $data;
    }
    public function Cari_customer_all(){
        $data = $this->db->query("SELECT  tbl_customer.*, tbl_perwakilan.alamat_perwakilan FROM tbl_customer, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_customer.kode_perwakilan ORDER BY tbl_customer.aktif");
        return $data;
    }
    public function Cari_customer($perwakilan){
        $data = $this->db->query("SELECT  tbl_customer.*, tbl_perwakilan.alamat_perwakilan FROM tbl_customer, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_customer.kode_perwakilan AND tbl_perwakilan.kode_wilayah='$perwakilan'  ORDER BY tbl_customer.aktif");
        return $data;
    }
    public function Cari_rekanan_all(){
        $data = $this->db->query("SELECT  tbl_cvrekanan.*, tbl_perwakilan.alamat_perwakilan FROM tbl_cvrekanan, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_cvrekanan.kode_perwakilan ORDER BY tbl_cvrekanan.aktif");
        return $data;
    }
    public function Cari_rekanan($perwakilan){
        $data = $this->db->query("SELECT  tbl_cvrekanan.*, tbl_perwakilan.alamat_perwakilan FROM tbl_cvrekanan, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan = tbl_cvrekanan.kode_perwakilan AND tbl_perwakilan.kode_wilayah='$perwakilan'  ORDER BY tbl_cvrekanan.aktif");
        return $data;
    }
    public function Cari_stok($penerbit, $jenjang, $tipe, $edisi, $kurikulum){
        if(!empty($jenjang)){$w_jenjang = " AND tbl_buku.jenjang='$jenjang'";}else{$w_jenjang = "";}

        if(!empty($tipe)){$w_tipe = " AND tbl_buku.tipe='$tipe'";}else{$w_tipe = "";}

        if(!empty($edisi)){$w_edisi = " AND tbl_buku.edisi='$edisi'";}else{$w_edisi = "";}

        if(!empty($kurikulum)){$w_kurikulum = " AND tbl_buku.kurikulum='$kurikulum'";}else{$w_kurikulum = "";}
        $data = $this->db->query("SELECT tbl_penerbit.nama_penerbit,tbl_buku.kode_buku, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang, tbl_buku.tipe, tbl_buku.kurikulum, tbl_buku.stok_real, tbl_buku.stok_pesan, tbl_buku.stok_oc FROM tbl_buku, tbl_penerbit WHERE tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit $w_jenjang $w_tipe $w_edisi $w_kurikulum ORDER BY tbl_buku.kode_buku");
        return $data;
    }
    public function Cari_oc($awal, $akhir){
        $data = $this->db->query("SELECT tbl_oc.tanggal, tbl_buku_oc.*, tbl_buku.judul FROM tbl_oc, tbl_buku_oc, tbl_buku WHERE tbl_oc.kode_oc = tbl_buku_oc.kode_oc AND tbl_buku_oc.kode_buku = tbl_buku.kode_buku AND DATE( tbl_oc.tanggal ) BETWEEN  '$awal' AND  '$akhir' ORDER BY tbl_oc.kode_oc DESC");
        return $data;
    }
    public function Cari_lpb($awal, $akhir){
        $data = $this->db->query("SELECT tbl_lpb.kode_lpb, tbl_lpb.tanggal, tbl_buku_lpb.kode_buku, tbl_buku_lpb.total, tbl_buku_lpb.kode_oc, tbl_buku.judul FROM tbl_lpb, tbl_buku_lpb, tbl_buku 
            WHERE tbl_lpb.kode_lpb = tbl_buku_lpb.kode_lpb AND tbl_buku_lpb.kode_buku = tbl_buku.kode_buku
            AND DATE( tbl_lpb.tanggal ) BETWEEN  '$awal' AND  '$akhir' ORDER BY tbl_lpb.kode_lpb DESC");
        return $data;
    }
    //ambil pesanan
    public function Cari_pesanan($perwakilan, $sales, $customer, $cv_rekanan, $awal, $akhir){
        if(!empty($sales)){$w_sales = " AND tbl_sales.kode_sales='$sales'";}else{$w_sales = "";}

        if(!empty($customer)){$w_customer = " AND tbl_customer.kode_customer='$customer'";}else{$w_customer = "";}

        if(!empty($cv_rekanan)){$w_cv_rekanan = " AND tbl_cvrekanan.kode_cv='$cv_rekanan'";}else{$w_cv_rekanan = "";}

        $data = $this->db->query("SELECT tbl_do.no_do, tbl_do.tanggal, tbl_do.tanggal, tbl_sales.nama_sales, tbl_cvrekanan.nama_cv, tbl_pesanan.no_mou, tbl_pesanan.no_pengajuan, tbl_customer.nama_customer,
            IF(tbl_do.no_do IN (SELECT no_do FROM tbl_suratjalan),'Sudah SJ', 'Belum SJ') as sj,  
            IF(tbl_do.no_do IN (SELECT tbl_do.no_do FROM tbl_suratjalan, tbl_faktur, tbl_do WHERE tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan AND tbl_suratjalan.no_do = tbl_do.no_do),'Sudah FT', 'Belum FT') as faktur 
            FROM tbl_pesanan, tbl_do, tbl_perwakilan, tbl_mou, tbl_cvrekanan, tbl_sales, tbl_customer
            WHERE tbl_pesanan.no_pesanan = tbl_do.no_pesanan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer 
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_perwakilan.kode_wilayah = '$perwakilan'
            $w_sales $w_customer $w_cv_rekanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            
            ORDER BY tbl_do.tanggal DESC");
        return $data;
    }
    public function Cari_pesanan_buku($no_do){
        $data = $this->db->query("SELECT tbl_buku_do.*, tbl_buku.judul FROM tbl_buku_do, tbl_buku WHERE tbl_buku_do.no_do = '$no_do' AND tbl_buku.kode_buku = tbl_buku_do.kode_buku");
        return $data;
    }
    public function sjyfty($no_do){
        $data = $this->db->query("SELECT tbl_suratjalan.no_suratjalan, tbl_faktur.no_faktur FROM tbl_suratjalan, tbl_faktur WHERE tbl_suratjalan.no_do = '$no_do' AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan ORDER BY tbl_suratjalan.no_suratjalan");
        return $data;
    }
    public function sjyftn($no_do){
        $data = $this->db->query("SELECT no_suratjalan, IF(no_do IN (SELECT tbl_do.no_do FROM tbl_suratjalan, tbl_faktur, tbl_do WHERE tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan AND tbl_suratjalan.no_do = tbl_do.no_do),'Sudah FT', 'Belum Faktur') as no_faktur FROM tbl_suratjalan WHERE no_do = '$no_do'");
        return $data;
    }
    public function sjnftn($no_do){
        $data = $this->db->query("SELECT 
            IF(no_do IN (SELECT no_do FROM tbl_suratjalan),'Sudah SJ', 'Belum SJ') as no_suratjalan,  
            IF(no_do IN (SELECT tbl_do.no_do FROM tbl_suratjalan, tbl_faktur, tbl_do WHERE tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan AND tbl_suratjalan.no_do = tbl_do.no_do),'Sudah FT', 'Belum Faktur') as no_faktur FROM tbl_do WHERE no_do ='$no_do'");
        return $data;
    }
    public function Cari_alokasiproduk($awal, $akhir){
        $data = $this->db->query("SELECT tbl_buku_do.kode_buku, tbl_buku.judul, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_do.no_do, tbl_buku_do.jumlah_beli, tbl_buku_do.jumlah_kirim, tbl_buku_do.sisa_kirim, tbl_buku_do.batal FROM tbl_buku, tbl_buku_do, tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_mou WHERE tbl_buku_do.kode_buku = tbl_buku.kode_buku AND tbl_buku_do.no_do = tbl_do.no_do AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou =tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' ORDER BY tbl_buku_do.kode_buku ASC");
        return $data;
    }
    public function Cari_alokasiprodukglobal($awal, $akhir){
        $data = $this->db->query("SELECT tbl_buku_do.kode_buku, tbl_buku.judul, count(tbl_customer.nama_customer) as nama_customer, count(tbl_cvrekanan.nama_cv) as nama_cv, count(tbl_do.no_do) as no_do, SUM(tbl_buku_do.jumlah_beli) as jumlah_beli, SUM(tbl_buku_do.jumlah_kirim) as jumlah_kirim, SUM(tbl_buku_do.sisa_kirim) as sisa_kirim, SUM(tbl_buku_do.batal) as batal FROM tbl_buku, tbl_buku_do, tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_mou WHERE tbl_buku_do.kode_buku = tbl_buku.kode_buku AND tbl_buku_do.no_do = tbl_do.no_do AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou =tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_buku_do.kode_buku ASC");
        return $data;
    }
    public function Cari_fakturnr($perwakilan, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_faktur.tanggal, tbl_sales.nama_sales, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_faktur.no_faktur,tbl_pengajuan.rabat, tbl_mou.fee as nilai_fee, tbl_faktur.bruto, tbl_faktur.netto, tbl_piutang.terbayar, tbl_piutang.kurang, tbl_piutang.fee, tbl_piutang.no_notaretur, IF(tbl_faktur.no_faktur IN(SELECT no_faktur FROM tbl_pembayaran), 'Ada BKM', 'Belum BKM') as bkm
            FROM tbl_piutang, tbl_faktur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_sales, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_pengajuan, tbl_perwakilan
            WHERE tbl_piutang.no_faktur = tbl_faktur.no_faktur
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah ='$perwakilan'
            AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan
            AND DATE( tbl_faktur.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            
            ORDER BY tbl_faktur.tanggal DESC");
        return $data;
    }
    public function Nota_retur($no_faktur){
        $data = $this->db->query("SELECT tbl_notaretur.no_notaretur, tbl_notaretur.bruto as retur_bruto, tbl_notaretur.netto as retur_netto FROM tbl_notaretur, tbl_piutang WHERE tbl_piutang.no_faktur = '$no_faktur' AND tbl_piutang.no_notaretur = tbl_notaretur.no_notaretur");
        return $data->row_array();
    }
    public function Bkm($no_faktur){
        $data = $this->db->query("SELECT no_kas, total FROM tbl_pembayaran WHERE no_faktur = '$no_faktur'");
        return $data;
    }
    public function Cari_pengajuan($perwakilan, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_pengajuan.tanggal, tbl_pengajuan.no_pengajuan, tbl_pengajuan.rabat, tbl_kerjasama.nama_kerjasama, tbl_pengajuan.aktif FROM tbl_pengajuan, tbl_perwakilan, tbl_kerjasama 
            WHERE tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama
            AND tbl_kerjasama.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah ='$perwakilan'
            AND DATE( tbl_pengajuan.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            ORDER BY tbl_pengajuan.tanggal DESC");
        return $data;
    }
    public function Cari_mou($perwakilan, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_mou.no_mou, tbl_mou.tanggal, tbl_mou.fee, tbl_cvrekanan.nama_cv, tbl_mou.aktif
            FROM tbl_mou, tbl_cvrekanan, tbl_perwakilan
            WHERE tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_cvrekanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah ='$perwakilan'
            AND DATE( tbl_mou.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            ORDER BY tbl_mou.tanggal DESC");
        return $data;
    }
    public function Cari_sjttr($awal, $akhir){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku.judul, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_suratjalan.no_suratjalan, tbl_retur.kode_retur, tbl_buku_sj.jumlah, tbl_buku_sj.retur
            FROM tbl_buku_sj, tbl_suratjalan, tbl_suratretur, tbl_retur, tbl_do, tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_buku
            WHERE tbl_buku_sj.kode_buku = tbl_buku.kode_buku
            AND tbl_buku_sj.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_suratretur.no_suratjalan
            AND tbl_suratretur.no_suratretur = tbl_retur.no_suratretur
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND DATE( tbl_suratjalan.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            ORDER BY tbl_suratjalan.tanggal DESC");
        return $data;
    }
    public function Cari_sjttrglobal($awal, $akhir){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku.judul, COUNT(tbl_customer.nama_customer) as nama_customer, COUNT(tbl_cvrekanan.nama_cv) as nama_cv, COUNT(tbl_suratjalan.no_suratjalan) as no_suratjalan, COUNT(tbl_retur.kode_retur) as kode_retur, SUM(tbl_buku_sj.jumlah) as jumlah, SUM(tbl_buku_sj.retur) as retur
            FROM tbl_buku_sj, tbl_suratjalan, tbl_suratretur, tbl_retur, tbl_do, tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_buku
            WHERE tbl_buku_sj.kode_buku = tbl_buku.kode_buku
            AND tbl_buku_sj.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_suratretur.no_suratjalan
            AND tbl_suratretur.no_suratretur = tbl_retur.no_suratretur
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND DATE( tbl_suratjalan.tanggal ) BETWEEN  '$awal' AND  '$akhir'
            GROUP BY tbl_buku_sj.kode_buku ASC");
        return $data;
    }
}
?>