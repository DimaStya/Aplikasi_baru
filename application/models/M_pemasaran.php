<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemasaran extends CI_Model{
	 public function Getadmpusat(){
		$data = $this->db->query("SELECT * FROM tbl_admpusat WHERE aktif='Aktif'");
		return $data;
	 }
	public function Getkode(){
		$data = $this->db->query("SELECT kode_admpusat FROM tbl_admpusat");
		return $data->result_array();
	}
    public function Getkodeadmpusat(){
        $data = $this->db->query("SELECT kode_admpusat FROM tbl_admpusat");
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
    public function Kawasan($kode_admpusat){
        $data = $this->db->query("SELECT tbl_perwakilan.alamat_perwakilan, tbl_perwakilan.kode_wilayah FROM tbl_perwakilan, tbl_handlepemasaran WHERE tbl_handlepemasaran.aktif =  'Aktif' AND tbl_perwakilan.kode_perwakilan = tbl_handlepemasaran.kode_perwakilan AND tbl_handlepemasaran.kode_admpusat =  '$kode_admpusat' GROUP BY tbl_perwakilan.alamat_perwakilan DESC"); 
        return $data;
    }
    public function Pesanan($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_pesanan.no_pesanan, tbl_pesanan.tanggal, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul, SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku FROM tbl_pesanan, tbl_datapesan, tbl_customer, tbl_cvrekanan, tbl_mou, tbl_sales, tbl_perwakilan WHERE tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.proses =  'Menunggu DO' AND DATE( tbl_pesanan.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC "); 
        return $data;
    }
    public function Dopesan($kode_admpusat, $kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_pesanan.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul, SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku FROM tbl_do, tbl_pesanan, tbl_customer, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_datapesan, tbl_mou WHERE tbl_do.kode_admpusat = '$kode_admpusat' AND tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.proses =  'DO, Menunggu SJ' AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_pesanan DESC "); 
        return $data;
    }
    public function Reqhapus($kode_wilayah){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul , SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku , tbl_pesanan.alasan, tbl_admpusat.nama_admpusat FROM tbl_pesanan, tbl_do, tbl_datapesan, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_admpusat WHERE tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_pesanan.proses =  'Hapus' AND tbl_do.kondisi =  'Proses' AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan AND tbl_do.kode_admpusat = tbl_admpusat.kode_admpusat GROUP BY tbl_do.no_pesanan DESC");
        return $data;
    }
    public function Terhapus($kode_wilayah,$awal,$akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_pesanan, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_datapesan.kode_buku ) AS jumlah_judul , SUM( tbl_datapesan.jumlah_beli ) AS jumlah_buku , tbl_pesanan.alasan, tbl_admpusat.nama_admpusat FROM tbl_pesanan, tbl_do, tbl_datapesan, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_sales, tbl_perwakilan, tbl_admpusat WHERE tbl_do.no_pesanan = tbl_pesanan.no_pesanan AND tbl_pesanan.no_pesanan = tbl_datapesan.no_pesanan AND tbl_pesanan.proses =  'Hapus' AND tbl_do.kondisi =  'Hapus' AND tbl_perwakilan.kode_wilayah =  '$kode_wilayah' AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.no_mou = tbl_mou.no_mou AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_perwakilan.kode_perwakilan = tbl_pesanan.kode_perwakilan AND tbl_do.kode_admpusat = tbl_admpusat.kode_admpusat AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do.no_pesanan DESC");
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
    public function Datahead($no_pesanan){
        $data = $this->db->query("SELECT tbl_do.no_do, tbl_admpusat.nama_admpusat, tbl_do.tanggal, tbl_cvrekanan.nama_cv, tbl_pesanan.no_mou, tbl_mou.rabat, tbl_pesanan.nama_penerima, tbl_pesanan.no_telp_penerima, tbl_pesanan.alamat_penerima, tbl_customer.nama_customer, tbl_customer.alamat_customer, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.tipe_buku, tbl_pesanan.jenis_pembayaran, tbl_pesanan.sumber_dana, SUM(tbl_datapesan.jumlah_beli) AS jumlah FROM tbl_pesanan, tbl_datapesan, tbl_admpusat, tbl_customer, tbl_sales, tbl_perwakilan, tbl_do, tbl_mou, tbl_cvrekanan WHERE tbl_do.no_do ='$no_pesanan' AND tbl_do.no_pesanan=tbl_pesanan.no_pesanan AND tbl_pesanan.no_pesanan=tbl_datapesan.no_pesanan AND tbl_pesanan.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_pesanan.kode_customer = tbl_customer.kode_customer AND tbl_pesanan.kode_sales = tbl_sales.kode_sales AND tbl_pesanan.no_mou =tbl_mou.no_mou AND tbl_mou.kode_cv=tbl_cvrekanan.kode_cv ");
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
}
?>