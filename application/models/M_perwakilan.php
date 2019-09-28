<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perwakilan extends CI_Model{
	public function Getperwakilan(){
		$data = $this->db->query("SELECT tbl_perwakilan.*, tbl_marea.nama_area, tbl_mnasional.nama_nasional, tbl_mnasional.kode_nasional FROM tbl_perwakilan, tbl_marea, tbl_mnasional WHERE tbl_marea.kode_area=tbl_perwakilan.kode_area AND tbl_marea.kode_nasional=tbl_mnasional.kode_nasional AND tbl_perwakilan.aktif='Aktif' ORDER BY tbl_perwakilan.kode_perwakilan");
		return $data;
	}
    public function Getkodeperwakilan(){
        $data = $this->db->query("SELECT max(kode_perwakilan) FROM tbl_perwakilan");
        return $data;
    }
    public function Terfaktur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku
            FROM tbl_buku_do, tbl_do, tbl_pesanan, tbl_customer, tbl_sales, tbl_perwakilan, tbl_cvrekanan, tbl_suratjalan, tbl_mou
            WHERE tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_do.no_do = tbl_buku_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_do.no_do IN (SELECT no_do FROM tbl_suratjalan)
            AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC "); 
        return $data;
    }
    public function Terretur($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do.tanggal, tbl_do.no_do, tbl_customer.nama_customer, tbl_cvrekanan.nama_cv, tbl_sales.nama_sales, tbl_perwakilan.nama_kaper, tbl_pesanan.nama_penerima, tbl_pesanan.jenjang, COUNT( tbl_buku_do.kode_buku ) AS jumlah_judul, SUM( tbl_buku_do.jumlah_beli ) AS jumlah_buku
            FROM tbl_buku_do, tbl_do, tbl_pesanan, tbl_customer, tbl_sales, tbl_perwakilan, tbl_cvrekanan, tbl_suratjalan, tbl_mou
            WHERE tbl_perwakilan.kode_wilayah = '$kode_wilayah'
            AND tbl_do.no_do = tbl_buku_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_do.no_do = tbl_suratjalan.no_do
            AND tbl_suratjalan.no_suratjalan IN (SELECT no_suratjalan FROM tbl_suratretur)
            AND DATE( tbl_do.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_pesanan.no_pesanan DESC "); 
        return $data;
    }
    public function Approve_stokmini($kode_wilayah, $awal, $akhir){
        $data = $this->db->query("SELECT tbl_do_stokmini.no_do_stokmini, tbl_do_stokmini.tanggal, tbl_pesan_stokmini.alamat_kirim, tbl_pesan_stokmini.keterangan, IF(tbl_do_stokmini.no_do_stokmini IN (SELECT no_do_stokmini FROM tbl_sj_stok), 'Sudah Terima', 'Belum Terima' ) AS sj FROM tbl_do_stokmini, tbl_pesan_stokmini, tbl_perwakilan WHERE tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini AND tbl_pesan_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_wilayah='$kode_wilayah'
            AND DATE( tbl_do_stokmini.tanggal ) BETWEEN  '$awal' AND  '$akhir' GROUP BY tbl_do_stokmini.no_do_stokmini DESC "); 
        return $data;
    }
    public function SJ($no_do){
        $data = $this->db->query("SELECT tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal, tbl_cvrekanan.nama_cv, tbl_customer.nama_customer, COUNT( tbl_buku_sj.kode_buku ) AS jumlah_judul, SUM( tbl_buku_sj.jumlah) AS jumlah_buku, IF(tbl_suratjalan.no_suratjalan IN (SELECT no_suratjalan FROM tbl_faktur), 'Sudah Faktur', 'Belum Faktur' ) AS terfaktur, IF(tbl_suratjalan.no_suratjalan IN (SELECT no_suratjalan FROM tbl_suratretur), 'Sudah Retur', 'Belum Retur' ) AS terretur
            FROM tbl_suratjalan, tbl_buku_sj, tbl_do, tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan
            WHERE tbl_suratjalan.no_do = '$no_do'
            AND tbl_suratjalan.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            "); 
        return $data;
    }
    public function SJ_retur($no_do){
        $data = $this->db->query("SELECT tbl_suratjalan.no_suratjalan, tbl_suratjalan.tanggal, tbl_cvrekanan.nama_cv, tbl_customer.nama_customer, COUNT( tbl_buku_sj.kode_buku ) AS jumlah_judul, SUM( tbl_buku_sj.jumlah) AS jumlah_buku, IF(tbl_suratretur.no_suratretur IN (SELECT no_suratretur FROM tbl_retur), 'Sudah Terima', 'Belum Terima' ) AS ttr, tbl_suratretur.no_suratretur, tbl_suratretur.keterangan
            FROM tbl_suratjalan, tbl_buku_sj, tbl_do, tbl_pesanan, tbl_customer, tbl_mou, tbl_cvrekanan, tbl_suratretur
            WHERE tbl_suratjalan.no_do = '$no_do'
            AND tbl_suratjalan.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_suratjalan.no_suratjalan = tbl_suratretur.no_suratjalan
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer
            AND tbl_pesanan.no_mou = tbl_mou.no_mou
            AND tbl_mou.kode_cv = tbl_cvrekanan.kode_cv
            "); 
        return $data;
    }
    public function Data_sj($no_sj){
        $data = $this->db->query("SELECT tbl_buku_sj.kode_buku, tbl_buku_sj.harga, tbl_buku.judul, tbl_buku_sj.jumlah, tbl_buku_sj.no_do, tbl_buku_sj.no_suratjalan FROM tbl_buku_sj, tbl_buku WHERE tbl_buku_sj.no_suratjalan = '$no_sj' AND tbl_buku_sj.kode_buku = tbl_buku.kode_buku"); 
        return $data;
    }
    public function Data_add_buku($no_suratretur){
        $data = $this->db->query("SELECT tbl_buku_sj.jumlah as jum_sj, tbl_buku_reqretur.jumlah as jum_ret, tbl_buku.judul, tbl_buku_reqretur.kode_buku, tbl_buku_reqretur.no_do, tbl_buku_reqretur.no_suratretur, tbl_buku_reqretur.no_suratjalan
            FROM tbl_buku_reqretur, tbl_buku_sj, tbl_buku
            WHERE tbl_buku_reqretur.no_suratretur = '$no_suratretur'
            AND tbl_buku_reqretur.no_suratjalan = tbl_buku_sj.no_suratjalan
            AND tbl_buku_reqretur.no_do = tbl_buku_sj.no_do
            AND tbl_buku_reqretur.kode_buku = tbl_buku_sj.kode_buku
            AND tbl_buku_reqretur.kode_buku = tbl_buku.kode_buku"); 
        return $data;
    }
    public function Data_add_judul($no_surajalan){
        $data = $this->db->query("SELECT tbl_suratretur.no_suratretur, tbl_buku_sj.kode_buku, tbl_buku_sj.harga, tbl_buku.judul, tbl_buku_sj.jumlah, tbl_buku_sj.no_do, tbl_buku_sj.no_suratjalan FROM tbl_buku_sj, tbl_buku, tbl_suratretur WHERE tbl_buku_sj.no_suratjalan = '$no_surajalan' AND tbl_suratretur.no_suratjalan ='$no_surajalan' AND tbl_buku_sj.kode_buku = tbl_buku.kode_buku AND tbl_buku_sj.kode_buku NOT IN (SELECT kode_buku FROM tbl_buku_reqretur WHERE no_suratjalan = '$no_surajalan')"); 
        return $data;
    }
    public function Data_buku_stokmini($no_stokmini){
        $data = $this->db->query("SELECT tbl_buku_psnstk.kode_buku, tbl_buku_psnstk.no_stokmini, tbl_buku_psnstk.jumlah, tbl_buku.judul FROM tbl_buku_psnstk, tbl_buku WHERE tbl_buku_psnstk.kode_buku = tbl_buku.kode_buku AND tbl_buku_psnstk.no_stokmini ='$no_stokmini'"); 
        return $data;
    } 
    public function Buku_stokmini($no_do_stokmini){
        $data = $this->db->query("SELECT tbl_do_stokmini.no_do_stokmini,tbl_buku_psnstk.kode_buku, tbl_buku_psnstk.jumlah, tbl_buku.judul FROM tbl_buku_psnstk, tbl_buku, tbl_do_stokmini,tbl_pesan_stokmini WHERE tbl_buku_psnstk.kode_buku = tbl_buku.kode_buku AND tbl_do_stokmini.no_stokmini = tbl_pesan_stokmini.no_stokmini AND tbl_do_stokmini.no_do_stokmini = '$no_do_stokmini'"); 
        return $data;
    }  
    public function Ket_sj($no_do_stokmini){
        $data = $this->db->query("SELECT no_sj_stkmini, ket FROM tbl_sj_stok WHERE no_do_stokmini='$no_do_stokmini'"); 
        return $data;
    }
    public function Stok_mini($kode_wilayah){
        $data = $this->db->query("SELECT tbl_stokmini.kode_buku, tbl_stokmini.stok, tbl_buku.judul FROM tbl_buku, tbl_stokmini, tbl_perwakilan 
            WHERE tbl_stokmini.kode_buku = tbl_buku.kode_buku
            AND tbl_stokmini.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_perwakilan.kode_wilayah='$kode_wilayah'");
        return $data;
    }  	
    public function Cetak($no_suratretur){
        //001/RTR-MDT/SLO/VIII/2019
        $data = $this->db->query("SELECT tbl_buku_reqretur.jumlah as jum_ret, tbl_buku_sj.jumlah as jum_sj, tbl_buku.judul, tbl_buku.kelas, tbl_buku.jenjang, tbl_suratretur.no_suratjalan, tbl_buku_reqretur.kode_buku
        FROM tbl_buku_reqretur, tbl_buku_sj, tbl_buku, tbl_suratretur
        WHERE tbl_suratretur.no_suratretur = '$no_suratretur'
        AND tbl_suratretur.no_suratretur = tbl_buku_reqretur.no_suratretur
        AND tbl_buku_reqretur.no_suratjalan = tbl_buku_sj.no_suratjalan 
        AND tbl_buku_reqretur.kode_buku = tbl_buku.kode_buku
        AND tbl_buku_reqretur.kode_buku = tbl_buku_sj.kode_buku"); 
        return $data;
    }

    public function Datahead($no_suratretur, $kodeadmper){
        $data = $this->db->query("SELECT tbl_suratretur.no_suratretur, tbl_sales.nama_sales, tbl_perwakilan.alamat_perwakilan, tbl_customer.nama_customer, tbl_pesanan.nama_penerima, tbl_suratretur.alasan, tbl_admper.nama_admper, tbl_perwakilan.nama_kaper
            FROM tbl_suratretur, tbl_sales, tbl_perwakilan, tbl_customer, tbl_pesanan, tbl_admper, tbl_suratjalan, tbl_do
            WHERE tbl_suratretur.no_suratretur ='001/RTR-MDT/SLO/VIII/2019' AND tbl_admper.kode_admper='ADMPER_0001'
            AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
            AND tbl_suratjalan.no_do = tbl_do.no_do
            AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
            AND tbl_pesanan.kode_sales = tbl_sales.kode_sales
            AND tbl_pesanan.kode_perwakilan = tbl_perwakilan.kode_perwakilan
            AND tbl_pesanan.kode_customer = tbl_customer.kode_customer"); 
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
    public function Ubahjumlah($no_do, $no_suratjalan, $no_suratretur, $table, $data_ubah){
        $this->db->where('no_do',$no_do);
        $this->db->where('no_suratjalan',$no_suratjalan);
        $this->db->where('no_suratretur',$no_suratretur);
        $data = $this->db->update_batch($table, $data_ubah, 'kode_buku');
        return $data;
    }    
    public function Deletbuku($no_do, $no_suratjalan, $no_suratretur, $table, $kode_buku){
        for ($i = 0; $i < count($kode_buku); $i++){
            $this->db->where('no_do',$no_do);
            $this->db->where('no_suratjalan',$no_suratjalan);
            $this->db->where('no_suratretur',$no_suratretur);
            $this->db->where($kode_buku[$i]);
            $data = $this->db->delete($table);
        }
        return $data;
    }
    public function Ubahjumlahstokmini($no_stokmini, $table, $data_ubah){
        $this->db->where('no_stokmini',$no_stokmini);
        $data = $this->db->update_batch($table, $data_ubah, 'kode_buku');
        return $data;
    }    
    public function Deletbukustokmini($no_stokmini, $table, $kode_buku){
        for ($i = 0; $i < count($kode_buku); $i++){
            $this->db->where('no_stokmini',$no_stokmini);
            $this->db->where($kode_buku[$i]);
            $data = $this->db->delete($table);
        }
        return $data;
    }
    public function Delete($table, $where){
        $res = $this->db->Delete($table, $where);
        return $res;
    }
    public function Stokmini($kode_perwakilan, $kode_buku){
        $data = $this->db->query("SELECT kode_perwakilan FROM tbl_stokmini WHERE kode_perwakilan='$kode_perwakilan' AND kode_buku='$kode_buku'");
        return $data;
    }
    public function Updatestokmini($kode_perwakilan, $kode_buku, $jumlah){
        $data = $this->db->query("UPDATE tbl_stokmini, tbl_buku SET tbl_stokmini.stok=tbl_stokmini.stok+$jumlah, tbl_buku.stok_mini = tbl_buku.stok_mini+ $jumlah WHERE tbl_stokmini.kode_buku='$kode_buku' AND tbl_stokmini.kode_perwakilan='$kode_perwakilan' AND tbl_buku.kode_buku = tbl_stokmini.kode_buku");
        return $data;
    }
    public function Updatebukustokmini($kode_buku, $jumlah){
        $data = $this->db->query("UPDATE tbl_buku SET stok_mini=stok_mini+$jumlah WHERE kode_buku='$kode_buku'");
        return $data;
    }
}
?>