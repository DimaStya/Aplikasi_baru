<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handle extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
	}
	
	public function Pemasaran(){
		$data_hidden = $this->input->post('kode_handle');
		if (empty($data_hidden)){ //insert
			$kaper = $this->input->post('kaper');
			$kode_admpusat = $this->input->post('kode_admpusat');
			for($i=0; $i<sizeof($kaper); $i++){
				$data = array(
					'kode_handle' => $kode_admpusat.'_'.$kaper[$i],
			        'kode_perwakilan' => $kaper[$i],
			        'kode_admpusat' => $kode_admpusat,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Asli'
		         );
				$insert = $this->m_pemasaran->Tambah_handle('tbl_handlepemasaran', $data);
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil dimasukkan!!.</p>
				                </div>');
			}
	   		redirect(base_url().'Admin/Wilayah_pemasaran');
		}else { //update
			$kaper1 = $this->input->post('kode_perwakilan');
			$kode_admpusat1 = $this->input->post('kode_admpusat1');
			$data = array(
					'kode_handle' => $kode_admpusat1.'_'.$kaper1,
			        'kode_perwakilan' => $kaper1,
			        'kode_admpusat' => $kode_admpusat1,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Sementara'
		         );
			$data1 = array(
			        'aktif' => 'Tidak Aktif'
		         );
			$where = array(
			        'kode_handle' => $data_hidden
		         );
			$insert = $this->m_pemasaran->Tambah_handle('tbl_handlepemasaran', $data);
			$update = $this->m_pemasaran->Ubah_handle('tbl_handlepemasaran', $data1, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Wilayah_pemasaran');
	}
	public function Hapus_pemasaran($kode_handle){
		$kode = array('kode_handle' => $kode_handle);
		$handle = explode("_", $kode_handle);
		$data1 = array(
			        'aktif' => 'Aktif'
		         );
		$where = array(
		        'kode_perwakilan' => 'kaper_'.$handle[3]
	         );
		$del = $this->m_pemasaran->Hapus_handle('tbl_handlepemasaran', $kode );
		$update = $this->m_pemasaran->Ubah_handle('tbl_handlepemasaran', $data1, $where);
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil dihapus !!.</p>
				                </div>');
		redirect(base_url().'Admin/Wilayah_pemasaran');
	}

	public function Keuangan(){
		$data_hidden = $this->input->post('kode_handle');
		if (empty($data_hidden)){ //insert
			$kaper = $this->input->post('kaper');
			$kode_admkeuangan = $this->input->post('kode_admkeuangan');
			for($i=0; $i<sizeof($kaper); $i++){
				$data = array(
					'kode_handle' => $kode_admkeuangan.'_'.$kaper[$i],
			        'kode_perwakilan' => $kaper[$i],
			        'kode_admkeuangan' => $kode_admkeuangan,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Asli'
		         );
				$insert = $this->m_keuangan->Tambah_handle('tbl_handlekeuangan', $data);
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di input!!.</p>
				                </div>');
			}
	   		redirect(base_url().'Admin/Wilayah_keuangan');
		}else { //update
			$kaper1 = $this->input->post('kode_perwakilan');
			$kode_admkeuangan1 = $this->input->post('kode_admkeuangan1');
			$data = array(
					'kode_handle' => $kode_admkeuangan1.'_'.$kaper1,
			        'kode_perwakilan' => $kaper1,
			        'kode_admkeuangan' => $kode_admkeuangan1,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Sementara'
		         );
			$data1 = array(
			        'aktif' => 'Tidak Aktif'
		         );
			$where = array(
			        'kode_handle' => $data_hidden
		         );
			$insert = $this->m_keuangan->Tambah_handle('tbl_handlekeuangan', $data);
			$update = $this->m_keuangan->Ubah_handle('tbl_handlekeuangan', $data1, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Wilayah_keuangan');
	}
	public function Hapus_keuangan($kode_handle){
		$kode = array('kode_handle' => $kode_handle);
		$handle = explode("_", $kode_handle);
		$data1 = array(
			        'aktif' => 'Aktif'
		         );
		$where = array(
		        'kode_perwakilan' => 'kaper_'.$handle[3]
	         );
		$del = $this->m_pemasaran->Hapus_handle('tbl_handlekeuangan', $kode );
		$update = $this->m_pemasaran->Ubah_handle('tbl_handlekeuangan', $data1, $where);
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di hapus!!.</p>
				                </div>');
		redirect(base_url().'Admin/Wilayah_keuangan');
	}

	public function Gudang(){
		$data_hidden = $this->input->post('kode_handle');
		if (empty($data_hidden)){ //insert
			$kaper = $this->input->post('kaper');
			$kode_admgudang = $this->input->post('kode_admgudang');
			for($i=0; $i<sizeof($kaper); $i++){
				$data = array(
					'kode_handle' => $kode_admgudang.'_'.$kaper[$i],
			        'kode_perwakilan' => $kaper[$i],
			        'kode_admgudang' => $kode_admgudang,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Asli'
		         );
				$insert = $this->m_gudang->Tambah_handle('tbl_handlegudang', $data);
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di masukkan!!.</p>
				                </div>');
			}
	   		redirect(base_url().'Admin/Wilayah_gudang');
		}else { //update
			$kaper1 = $this->input->post('kode_perwakilan');
			$kode_admgudang1 = $this->input->post('kode_admgudang1');
			$data = array(
					'kode_handle' => $kode_admgudang1.'_'.$kaper1,
			        'kode_perwakilan' => $kaper1,
			        'kode_admgudang' => $kode_admgudang1,
			        'aktif' => 'Aktif',
			        'kondisi' => 'Sementara'
		         );
			$data1 = array(
			        'aktif' => 'Tidak Aktif'
		         );
			$where = array(
			        'kode_handle' => $data_hidden
		         );
			$insert = $this->m_gudang->Tambah_handle('tbl_handlegudang', $data);
			$update = $this->m_gudang->Ubah_handle('tbl_handlegudang', $data1, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Wilayah_gudang');
	}
	public function Hapus_gudang($kode_handle){
		$kode = array('kode_handle' => $kode_handle);
		$handle = explode("_", $kode_handle);
		$data1 = array(
			        'aktif' => 'Aktif'
		         );
		$where = array(
		        'kode_perwakilan' => 'kaper_'.$handle[3]
	         );
		$del = $this->m_pemasaran->Hapus_handle('tbl_handlegudang', $kode );
		$update = $this->m_pemasaran->Ubah_handle('tbl_handlegudang', $data1, $where);
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil dihapus!!.</p>
				                </div>');
		redirect(base_url().'Admin/Wilayah_gudang');
		
	}
}
