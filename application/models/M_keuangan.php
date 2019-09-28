<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model{
	 public function Getadmkeuangan(){
		$data = $this->db->query("SELECT * FROM tbl_admkeuangan WHERE aktif='Aktif'");
		return $data;
	 }
    public function Getkodeadmkeuangan(){
        $data = $this->db->query("SELECT max(kode_admkeuangan) FROM tbl_admkeuangan");
        return $data;
    }
    public function Kawasan($kode_admkeuangan){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlekeuangan WHERE tbl_handlekeuangan.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlekeuangan.kode_perwakilan AND tbl_handlekeuangan.kode_admkeuangan =  '$kode_admkeuangan' GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Kawasan_bkm(){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlekeuangan WHERE tbl_handlekeuangan.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlekeuangan.kode_perwakilan GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Tahun(){
        $data = $this->db->query("SELECT harga_tahun FROM tbl_faktur GROUP BY harga_tahun"); 
        return $data->result_array();
    }
    public function Amb_fak($no_faktur){
        $data = $this->db->query("SELECT tbl_faktur.no_faktur, tbl_faktur.tanggal, tbl_perwakilan.alamat_perwakilan, tbl_faktur.netto,tbl_piutang.kode_piutang, tbl_piutang.kurang FROM tbl_faktur, tbl_perwakilan, tbl_piutang, tbl_suratjalan,tbl_do, tbl_pesanan
            WHERE tbl_faktur.no_faktur = '$no_faktur'
            AND tbl_faktur.no_faktur = tbl_piutang.no_faktur
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan");
        return $data;
    }
    public function Sj($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima 
            FROM tbl_pesanan, tbl_suratjalan, tbl_do, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_sales, tbl_perwakilan
            WHERE tbl_perwakilan.kode_wilayah =  '$kode_wilayah'
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_suratjalan.no_suratjalan NOT IN (SELECT no_suratjalan FROM tbl_faktur)
            AND DATE( tbl_suratjalan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_suratjalan.no_suratjalan DESC");
        return $data;
    }
    public function Faktur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_faktur.no_faktur, tbl_suratjalan.no_suratjalan, tbl_faktur.tanggal, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima 
            FROM tbl_faktur, tbl_pesanan, tbl_suratjalan, tbl_do, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_sales, tbl_perwakilan
            WHERE tbl_perwakilan.kode_wilayah =  '$kode_wilayah'
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND DATE( tbl_faktur.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_faktur.no_faktur DESC");
        return $data;
    }
    public function Ttr($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_retur.kode_retur, tbl_retur.tanggal, tbl_faktur.no_faktur, tbl_suratretur.alasan
            FROM tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_faktur, tbl_do, tbl_pesanan, tbl_perwakilan
            WHERE tbl_perwakilan.kode_wilayah =  '$kode_wilayah'
            AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
            AND tbl_suratretur.keterangan = 'Admin Telah Menerima'
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_retur.kode_retur NOT IN(SELECT kode_retur FROM tbl_notaretur)
            AND DATE( tbl_retur.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_retur.kode_retur DESC");
        return $data;
    }
    public function Nota_retur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_notaretur.no_notaretur, tbl_retur.kode_retur, tbl_notaretur.tanggal, tbl_faktur.no_faktur, tbl_suratretur.alasan, tbl_suratretur.keterangan
            FROM tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_faktur, tbl_do, tbl_pesanan, tbl_perwakilan, tbl_notaretur
            WHERE tbl_perwakilan.kode_wilayah =  '$kode_wilayah'
            AND tbl_notaretur.kode_retur = tbl_retur.kode_retur
            AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND DATE( tbl_retur.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_retur.kode_retur DESC");
        return $data;
    }
    public function Req_update($kode_wilayah){
        $data = $this->db->query("SELECT tbl_notaretur.tanggal, tbl_notaretur.no_notaretur, tbl_retur.kode_retur
        FROM tbl_notaretur, tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_do, tbl_pesanan, tbl_perwakilan
        WHERE tbl_suratretur.keterangan ='Admin Telah Menerima Update'
        AND tbl_perwakilan.kode_wilayah = '$kode_wilayah'
        AND tbl_notaretur.kode_retur = tbl_retur.kode_retur
        AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
        AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
        AND tbl_suratjalan.no_do = tbl_do.no_do
        AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
        AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan ");
        return $data;
    }
    public function Detail_Sj($no_suratjalan){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust,tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal as tgl_sj, tbl_kerjasama.nama_kerjasama, tbl_pesanan.no_mou, tbl_pesanan.no_pengajuan, tbl_pesanan.sumber_dana, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_mou.fee, tbl_pengajuan.rabat
        FROM tbl_customer, tbl_cvrekanan, tbl_pesanan, tbl_suratjalan, tbl_do, tbl_sales, tbl_perwakilan, tbl_mou, tbl_kerjasama, tbl_pengajuan 
        WHERE tbl_suratjalan.no_suratjalan = '$no_suratjalan'
        AND tbl_suratjalan.no_do = tbl_do.no_do
        AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
        AND tbl_pesanan.no_mou = tbl_mou.no_mou 
        AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
        AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
        AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan
        AND tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama
        AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
        AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan");
        return $data->row_array();
    }
    public function Detail_Ttr($kode_retur){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_retur.kode_retur, tbl_retur.tanggal, tbl_mou.fee, tbl_pengajuan.rabat, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_suratretur.alasan
            FROM tbl_customer, tbl_cvrekanan, tbl_mou, tbl_pesanan, tbl_do, tbl_suratjalan, tbl_suratretur, tbl_retur, tbl_pengajuan, tbl_sales, tbl_perwakilan
            WHERE tbl_retur.kode_retur = '$kode_retur'
            AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv");
        return $data->row_array();
    }
    public function Detail_notaretur($no_notaretur, $kode_admkeuangan){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_retur.kode_retur, tbl_retur.tanggal as tgl_ttr,tbl_notaretur.no_notaretur, tbl_notaretur.tanggal as tgl_notaretur, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_suratretur.alasan, tbl_admkeuangan.nama_admkeuangan
            FROM tbl_customer, tbl_cvrekanan, tbl_mou, tbl_pesanan, tbl_do, tbl_suratjalan, tbl_suratretur, tbl_retur, tbl_sales, tbl_perwakilan, tbl_notaretur, tbl_admkeuangan
            WHERE tbl_notaretur.no_notaretur = '$no_notaretur'
            AND tbl_retur.kode_retur = tbl_notaretur.kode_retur
            AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_admkeuangan.kode_admkeuangan = '$kode_admkeuangan'
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv");
        return $data->row_array();
    }
    public function Buku_sj($no_suratjalan){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku_sj.jumlah, tbl_buku_sj.harga, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang
            FROM tbl_buku_sj, tbl_buku
            WHERE tbl_buku_sj.no_suratjalan = '$no_suratjalan' AND tbl_buku_sj.kode_buku = tbl_buku.kode_buku");
        return $data->result();
    }
    public function Buku_ttr($kode_retur){
        $data = $this->db->query("SELECT tbl_buku_retur.kode_buku, tbl_buku_retur.jumlah, tbl_buku_retur.harga, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang
            FROM tbl_buku_retur, tbl_buku
            WHERE tbl_buku_retur.kode_retur = '$kode_retur' AND tbl_buku_retur.kode_buku = tbl_buku.kode_buku");
        return $data->result();
    }
    public function Buku_notaretur($no_notaretur){
        $data = $this->db->query("SELECT tbl_buku_retur.kode_buku, tbl_buku_retur.jumlah, tbl_buku_retur.harga, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang
            FROM tbl_buku_retur, tbl_buku, tbl_notaretur, tbl_retur
            WHERE tbl_notaretur.no_notaretur='$no_notaretur' AND tbl_notaretur.kode_retur = tbl_retur.kode_retur AND tbl_buku_retur.kode_retur = tbl_retur.kode_retur AND tbl_buku_retur.kode_buku = tbl_buku.kode_buku");
        return $data->result_array();
    }
    public function Cetak($no_faktur){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku_sj.jumlah, tbl_buku_sj.harga, tbl_buku.judul, tbl_buku.edisi, tbl_buku.jenjang
            FROM tbl_buku_sj, tbl_suratjalan, tbl_faktur, tbl_buku
            WHERE tbl_faktur.no_faktur =  '$no_faktur'
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_buku_sj.kode_buku = tbl_buku.kode_buku");
        return $data;
    }
    public function Datahead($no_faktur, $kode_admgudang){
        $data = $this->db->query("SELECT tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_customer.no_telp as telp_cust, tbl_cvrekanan.kode_cv, tbl_cvrekanan.nama_cv, tbl_cvrekanan.alamat_cv, tbl_cvrekanan.no_telp as telp_cv, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_faktur.no_faktur, tbl_faktur.tanggal as tgl_faktur, tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal as tgl_sj, tbl_kerjasama.kode_kerjasama, tbl_kerjasama.nama_kerjasama, tbl_pesanan.no_mou, tbl_pesanan.no_pengajuan, tbl_pesanan.sumber_dana, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_admkeuangan.nama_admkeuangan
            FROM tbl_customer, tbl_cvrekanan, tbl_pesanan,tbl_faktur, tbl_suratjalan, tbl_do, tbl_sales, tbl_perwakilan, tbl_mou, tbl_kerjasama, tbl_pengajuan, tbl_admkeuangan
            WHERE tbl_faktur.no_faktur = '$no_faktur'
            AND tbl_admkeuangan.kode_admkeuangan = '$kode_admgudang'
            AND tbl_faktur.no_suratjalan = tbl_suratjalan.no_suratjalan 
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.no_mou = tbl_mou.no_mou 
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_pengajuan = tbl_pengajuan.no_pengajuan
            AND tbl_pengajuan.kode_kerjasama = tbl_kerjasama.kode_kerjasama
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan");
        return $data;
    }
    public function Bkm($kode_admkeuangan, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_kas.* FROM tbl_kas
            WHERE kode_admkeuangan = '$kode_admkeuangan'
            AND DATE(tanggal) BETWEEN  '$awal' AND  '$akhir'");
        return $data;
    }
    public function Bkm_dat($no_kas){
        $data = $this->db->query("SELECT no_kas, total, terpakai FROM tbl_kas WHERE no_kas='$no_kas'");
        return $data->row_array();
    }
    public function Pembayaran($no_kas){
        $data = $this->db->query("SELECT * FROM tbl_pembayaran WHERE no_kas='$no_kas'");
        return $data->result_array();
    }
    public function Delete_bayar($no_kas,$no_faktur,$tanggal,$total){
        $data = $this->db->query("DELETE FROM tbl_pembayaran WHERE no_kas='$no_kas' AND no_faktur='$no_faktur' AND tanggal='$tanggal' AND total='$total'");
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
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
    public function Hapus_handle($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
}
?>