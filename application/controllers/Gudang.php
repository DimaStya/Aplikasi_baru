<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Gudang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		header('Last-Modified:'.gmdate('D, d M Y H:i:s'),'GMT');
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no cache');

		$this->load->helper('cookie');
		//hapus saat cookie sudah kadaluarsa
		date_default_timezone_set("Asia/Jakarta");
		$tanggal= date('d-m-Y H:i:s');
		$cek_login = $this->m_login->stay();
		$login=$cek_login->row_array();
		if (is_array($login) || is_object($login)){
			foreach ($login as $cek){
			$hour = strtotime($login['tanggal']);
	        if($hour<=strtotime($tanggal)){
	        	$data  = array('cookie_user' => $cek['cookie_user']);
        	 	$this->m_login->habis('tbl_login', $data);
        	 	$cookie_name = 'Username';
				unset($_COOKIE[$cookie_name]);
				$res = setcookie($cookie_name, '', time() - 3600*4);
	        }
			}
		}
		//batas hapus saat cookie sudah kadaluarsa
		//cek ketersediaan cookie
		$cookie_user = $this->input->cookie('Username',true);
		if (empty($cookie_user)){
			redirect(base_url());
		}else{
			$cek_cookie = $this->m_login->cookie($cookie_user);
			if($cek_cookie->num_rows()==0){
				redirect(base_url());
			}else{
				$login = $cek_cookie->row_array();
				$cek_login = $this->m_login->user($login['username']);
				$user = $cek_login->row_array();
				if($user['hak_akses'] !='4'){
					redirect(base_url());
				}	
			}
		}//batas cek ketersediaan cookie
	}
	function index(){
		$data = array(
			        'angka' => '1',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_dashboard');
		$this->load->view('Gudang/view_footer');
	}
	function Pesanan(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_gudang->Pesananbaru($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_pesanan',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Detailpesanan(){
		$no_pesan = $this->input->post('detail');
		$no_pesanan = $this->input->post('no_pesanan');

		

		if(!empty($no_pesan)){
		//detail
		$pesanan = $this->m_pesan->Getdetpesan($no_pesan);
		$bukupesan = $this->m_pesan->Getdetbuku($no_pesan);
		$datbuk = $this->m_pesan->Getdatbuk($no_pesan);
		
		$data2 = array('pesanan' => $pesanan->row_array(),
						'buku' => $bukupesan->result_array(),
						'datbuk' => $datbuk->row_array(),
						'button' => 'ada');
		}else if(!empty($no_pesanan)){
		//detail
		$pesanan = $this->m_pesan->Getdetpesan($no_pesanan);
		$bukupesan = $this->m_pesan->Getdetbuku($no_pesanan);
		$datbuk = $this->m_pesan->Getdatbuk($no_pesanan);

		$data2 = array('pesanan' => $pesanan->row_array(),
						'buku' => $bukupesan->result_array(),
						'datbuk' => $datbuk->row_array(),
						'button' => 'no');
		}

		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_pesandet', $data2);
		$this->load->view('Gudang/view_footer');
	}
	
}
?>