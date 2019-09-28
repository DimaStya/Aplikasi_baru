<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemasaran extends CI_Model{
	 public function Getadmpusat(){
		$data = $this->db->query("SELECT * FROM tbl_admpusat WHERE aktif='Aktif'");
		return $data;
	 }
    public function Getkodeadmpusat(){
        $data = $this->db->query("SELECT max(kode_admpusat) FROM tbl_admpusat");
        return $data;
    }
	public function Insert($table,$data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function save_batch($data){
        return $this->db->insert_batch('tbl_buku_do', $data);
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
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
    public function Hapus_handle($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
    public function Kawasan($kode_admpusat){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlepemasaran WHERE tbl_handlepemasaran.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlepemasaran.kode_perwakilan AND tbl_handlepemasaran.kode_admpusat =  '$kode_admpusat' GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Pesanan($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_pesanan.no_pesanan, tbl_pesanan.tanggal, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul, SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku FROM tbl_pesanan, tbl_datapesan, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_sales, tbl_perwakilan WHERE tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.proses =  'Menunggu DO' AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC "); 
        return $data;
    }
    public function Dopesan($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku FROM tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_buku_do, tbl_mou WHERE tbl_do.no_do = tbl_buku_do.no_do AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.proses =  'DO, Menunggu SJ' AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_pesanan DESC "); 
        return $data;
    }
    public function Reqhapus($kode_wilayah){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan, tbl_pesanan.alasan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_kerjasama.nama_kerjasama  
            FROM tbl_do, tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan,tbl_pengajuan, tbl_kerjasama, tbl_perwakilan
            WHERE tbl_do.no_pesanan = tbl_pesanan.no_pesanan 
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer 
            AND tbl_pesanan.no_mou = tbl_mou.no_mou 
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv 
            AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan 
            AND tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama
            AND tbl_pesanan.proses='Hapus'
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' 
            GROUP BY tbl_do.no_pesanan DESC");
        return $data;
    }
    public function Terhapus($kode_wilayah,$awal,$akhir){
        $data = $this->db->query("SELECT tbl_pesanan.tanggal, tbl_pesanan.no_pesanan, tbl_pesanan.alasan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_kerjasama.nama_kerjasama, tbl_perwakilan.nama_kaper, tbl_admper.nama_admper
            FROM tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan,tbl_pengajuan, tbl_kerjasama, tbl_perwakilan, tbl_admper
            WHERE tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou=tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan
            AND tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_admper = tbl_admper.kode_admper
            AND tbl_pesanan.proses = 'Hapus'
            AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah'
            AND tbl_pesanan.no_pesanan NOT IN (SELECT no_pesanan FROM tbl_do) 
            AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' 
            GROUP BY tbl_pesanan.no_pesanan DESC");
        return $data;
    }
    public function Proses_kirim($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku FROM tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_buku_do, tbl_mou WHERE tbl_do.no_do = tbl_buku_do.no_do AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_do.no_do IN (SELECT no_do FROM tbl_suratjalan)  AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_pesanan DESC HAVING SUM(tbl_buku_do.sisa_kirim) > 0"); 
        return $data;
    }
    public function Selesai($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku FROM tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_buku_do, tbl_mou WHERE tbl_do.no_do = tbl_buku_do.no_do AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_do.no_do IN (SELECT no_do FROM tbl_suratjalan)  AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_pesanan DESC HAVING SUM(tbl_buku_do.sisa_kirim) = 0"); 
        return $data;
    }
    public function Reqretur($kode_wilayah){
        $data = $this->db->query("SELECT tbl_suratretur.tanggal, tbl_suratretur.alasan,tbl_suratretur.no_suratretur, tbl_do.no_do, IF(STRCMP(tbl_suratretur.keterangan,'Menunggu Admin') = 0, 'Yes', 'No') AS button
            FROM tbl_suratretur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_perwakilan
            WHERE tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah' 
            AND tbl_suratretur.no_suratretur NOT IN (SELECT no_suratretur FROM tbl_retur)");
        return $data;
    }
    public function Retur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_suratretur.tanggal, tbl_suratretur.no_suratretur, tbl_suratjalan.no_suratjalan, tbl_faktur.no_faktur,
            IF( tbl_suratretur.no_suratretur IN (SELECT tbl_suratretur.no_suratretur FROM tbl_retur, tbl_notaretur, tbl_suratretur WHERE tbl_suratretur.no_suratretur = tbl_retur.no_suratretur AND tbl_notaretur.kode_retur = tbl_retur.kode_retur), 'Sudah Nota Retur', 'Belum Nota Retur' ) AS nota_retur , 
            IF( tbl_suratretur.no_suratretur IN (SELECT tbl_suratretur.no_suratretur FROM tbl_retur, tbl_suratretur WHERE tbl_suratretur.no_suratretur = tbl_retur.no_suratretur), 'Sudah TTR', 'Belum TTR' ) AS ttr
                FROM tbl_suratretur,tbl_suratjalan, tbl_faktur, tbl_do, tbl_pesanan, tbl_perwakilan

            WHERE tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND DATE( tbl_suratretur.tanggal ) BETWEEN  '$awal' AND  '$akhir'");
        return $data;
    }
    public function Requpdate($kode_wilayah){
        $data = $this->db->query("SELECT tbl_suratretur.tanggal, tbl_suratretur.alasan,tbl_suratretur.no_suratretur, tbl_do.no_do, IF(STRCMP(tbl_suratretur.keterangan,'Update Di mohon') = 0, 'Yes', 'No') AS button
            FROM tbl_suratretur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_perwakilan
            WHERE tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah' 
            AND tbl_suratretur.no_suratretur IN (SELECT no_suratretur FROM tbl_retur)");
        return $data;
    }
    public function sisa_kirim($no_do){
        $data = $this->db->query("SELECT tbl_buku_do.kode_buku, tbl_buku.judul, tbl_buku_do.jumlah_beli, tbl_buku_do.jumlah_kirim, tbl_buku_do.sisa_kirim FROM tbl_buku_do, tbl_buku WHERE tbl_buku_do.no_do = '$no_do' AND tbl_buku_do.kode_buku = tbl_buku.kode_buku "); 
        return $data;
    }
    public function Data_reqretur($no_suratretur){
        $data = $this->db->query("SELECT tbl_buku_sj.jumlah as jumlah_kirim, tbl_buku_reqretur.jumlah as jumlah_retur, tbl_buku.judul, tbl_buku_reqretur.kode_buku, tbl_buku_reqretur.no_do, tbl_buku_reqretur.no_suratretur, tbl_buku_reqretur.no_suratjalan
            FROM tbl_buku_reqretur, tbl_buku_sj, tbl_buku
            WHERE tbl_buku_reqretur.no_suratretur = '$no_suratretur'
            AND tbl_buku_reqretur.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_buku_reqretur.no_do = tbl_buku_sj.no_do
            AND tbl_buku_reqretur.kode_buku = tbl_buku_sj.kode_buku
            AND tbl_buku_reqretur.kode_buku = tbl_buku.kode_buku"); 
        return $data;
    }
    public function Pesanan_stokmini($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_pesan_stokmini.tanggal, tbl_pesan_stokmini.no_stokmini, tbl_pesan_stokmini.alamat_kirim, tbl_pesan_stokmini.keterangan, COUNT( tbl_buku_psnstk.kode_buku ) AS jumlah_judul, SUM( tbl_buku_psnstk.jumlah ) AS jumlah_buku FROM tbl_pesan_stokmini, tbl_buku_psnstk, tbl_perwakilan 
            WHERE tbl_pesan_stokmini.no_stokmini = tbl_buku_psnstk.no_stokmini
            AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_pesan_stokmini.no_stokmini NOT IN (SELECT no_stokmini FROM tbl_do_stokmini)
            AND DATE( tbl_pesan_stokmini.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesan_stokmini.no_stokmini DESC "); 
        return $data;
    }
    public function Dopesan_stokmini($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do_stokmini.tanggal, tbl_do_stokmini.no_do_stokmini, tbl_pesan_stokmini.alamat_kirim, tbl_pesan_stokmini.keterangan, COUNT( tbl_buku_psnstk.kode_buku ) AS jumlah_judul, SUM( tbl_buku_psnstk.jumlah ) AS jumlah_buku FROM tbl_pesan_stokmini, tbl_buku_psnstk, tbl_perwakilan, tbl_do_stokmini
            WHERE tbl_pesan_stokmini.no_stokmini = tbl_buku_psnstk.no_stokmini
            AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini
            AND DATE( tbl_pesan_stokmini.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesan_stokmini.no_stokmini DESC "); 
        return $data;
    }
    public function Data_headretur($no_suratretur){
        $data = $this->db->query("SELECT tbl_pesanan.nama_penerima, tbl_perwakilan.nama_kaper, tbl_sales.nama_sales, tbl_suratretur.alasan, tbl_suratretur.tanggal, tbl_suratretur.keterangan 
            FROM tbl_suratretur, tbl_suratjalan, tbl_do, tbl_perwakilan, tbl_sales, tbl_pesanan
            WHERE tbl_suratretur.no_suratretur ='$no_suratretur'
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales"); 
        return $data;
    }
    public function Updatebuku($data_ubah){
        $data = $this->db->update_batch('tbl_buku',$data_ubah, 'kode_buku');
        return $data;
    }
    public function Cetak($no_pesanan){
        $data = $this->db->query("SELECT tbl_datapesan.kode_buku, tbl_buku.judul, tbl_datapesan.jumlah_beli, tbl_penerbit.nama_penerbit, tbl_buku.jenjang, tbl_buku.edisi, tbl_buku.stok_pesan FROM tbl_datapesan, tbl_buku, tbl_penerbit WHERE tbl_datapesan.no_pesanan = '$no_pesanan' AND tbl_datapesan.kode_buku=tbl_buku.kode_buku AND tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit");
        return $data;
    }
    public function Datahead($no_pesanan, $kode_admpusat){
        $data = $this->db->query("SELECT tbl_do.no_do, tbl_admpusat.nama_admpusat, tbl_do.tanggal, tbl_cvrekanan.nama_cv, tbl_pesanan.no_mou, tbl_kerjasama.nama_kerjasama, tbl_pengajuan.no_pengajuan, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.tipe_buku, tbl_pesanan.jenis_pembayaran, tbl_pesanan.sumber_dana, SUM(tbl_datapesan.jumlah_beli) AS jumlah, tbl_pesanan.keterangan, tbl_do.stok FROM tbl_pesanan, tbl_datapesan, tbl_admpusat, tbl_customer, tbl_sales, tbl_perwakilan, tbl_do, tbl_mou, tbl_cvrekanan, tbl_kerjasama, tbl_pengajuan WHERE tbl_do.no_do ='$no_pesanan' AND tbl_do.no_pesanan=tbl_pesanan.no_pesanan AND tbl_pesanan.no_pesanan=tbl_datapesan.no_pesanan AND tbl_pesanan.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.no_mou =tbl_mou.no_mou AND tbl_mou.kode_cv=tbl_cvrekanan.kode_cv AND tbl_pesanan.no_pengajuan =tbl_pengajuan.no_pengajuan AND tbl_pengajuan.kode_kerjasama=tbl_kerjasama.kode_kerjasama AND tbl_admpusat.kode_admpusat='$kode_admpusat'");
        return $data;
    }
    public function Cetak_stokmini($no_stokmini){
        $data = $this->db->query("SELECT tbl_buku_psnstk.kode_buku, tbl_buku.judul, tbl_buku_psnstk.jumlah, tbl_penerbit.nama_penerbit, tbl_buku.jenjang, tbl_buku.edisi, tbl_buku.stok_pesan FROM tbl_buku_psnstk, tbl_buku, tbl_penerbit WHERE tbl_buku_psnstk.no_stokmini = '$no_stokmini' AND tbl_buku_psnstk.kode_buku=tbl_buku.kode_buku AND tbl_buku.kode_penerbit = tbl_penerbit.kode_penerbit");
        return $data;
    }
    public function Datahead_stokmini($no_stokmini, $kode_admpusat){
        $data = $this->db->query("SELECT tbl_do_stokmini.no_do_stokmini, tbl_do_stokmini.tanggal, tbl_perwakilan.nama_kaper, tbl_pesan_stokmini.alamat_kirim, tbl_admpusat.nama_admpusat, tbl_pesan_stokmini.keterangan,SUM(tbl_buku_psnstk.jumlah) AS jumlah FROM tbl_buku_psnstk, tbl_do_stokmini, tbl_pesan_stokmini, tbl_perwakilan, tbl_admpusat WHERE tbl_do_stokmini.no_do_stokmini = '$no_stokmini' AND tbl_do_stokmini.no_stokmini= tbl_pesan_stokmini.no_stokmini AND tbl_buku_psnstk.no_stokmini = tbl_pesan_stokmini.no_stokmini AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_admpusat.kode_admpusat='$kode_admpusat'");
        return $data;
    }
    public function Getjumlah($kode_buku){
        $data = $this->db->query("SELECT stok_pesan FROM tbl_buku WHERE kode_buku='$kode_buku'");
        return $data->row_array();
    }
    public function Getdatapesan($no_pesanan){
        $data = $this->db->query("SELECT kode_buku, jumlah_beli FROM tbl_datapesan WHERE no_pesanan='$no_pesanan'");
        return $data->result_array();
    }
    public function Stok_mini($kode_wilayah){
        $data = $this->db->query("SELECT tbl_stokmini.kode_buku, tbl_stokmini.stok, tbl_buku.judul FROM tbl_buku, tbl_stokmini, tbl_perwakilan 
            WHERE tbl_stokmini.kode_buku = tbl_buku.kode_buku
            AND tbl_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah='$kode_wilayah'");
        return $data;
    }
}
?>