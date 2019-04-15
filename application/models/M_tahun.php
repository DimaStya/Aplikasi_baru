<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tahun extends CI_Model{
    public function Buat($tahun){
        $data = $this->db->query("CREATE TABLE tbl_harga_$tahun (
                  kode_buku VARCHAR(32) NOT NULL,
                  harga_jawa INTEGER UNSIGNED NULL,
                  harga_luar INTEGER UNSIGNED NULL,
                  FOREIGN KEY(kode_buku)
                    REFERENCES tbl_buku(kode_buku)
                      ON DELETE RESTRICT
                      ON UPDATE CASCADE
                );");
        return $data;
    }
    public function Insert($tahun,$sekarang){
         $data = $this->db->query("INSERT tbl_harga_$tahun SELECT * FROM tbl_harga_$sekarang");
         return $data;
    }
}
?>