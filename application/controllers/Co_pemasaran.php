<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Co_pemasaran extends CI_Controller{
	function __construct(){
		parent::__construct();
		//$this->load->view("view");

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
				$user = $this->session->userdata('username');
				if(empty($user)){
					redirect('Login');
				}
				$login = $cek_cookie->row_array();
				$cek_login = $this->m_login->user($login['username']);
				$user = $cek_login->row_array();
				if($user['hak_akses'] !='11'){
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
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_dashboard');
		$this->load->view('Admin/view_footer');
	}
	function Nasional(){
		$data1 = $this->m_nasional->Getnasional();
		$data2 = array('data' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_nasional',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Area(){
		$data1 = $this->m_area->Getarea();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '2'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_area',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Perwakilan(){
		$data1 = $this->m_perwakilan->Getperwakilan();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '3'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_perwakilan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Sales(){
		$data1 = $this->m_sales->Getsales();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '4'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_sales',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Adm_perwakilan(){
		$data1 = $this->m_admperwakilan->Getadmperwakilan();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '5'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_admperwakilan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Customer(){
		$data1 = $this->m_customer->Getcustomer();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '6'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_customer',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Kerjasama(){
		$data1 = $this->m_kerjasama->Getkerjasama();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '7'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_kerjasama',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Pengajuan(){
		$data1 = $this->m_pengajuan->Getpengajuan();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '8'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_pengajuan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Rekanan(){
		$data1 = $this->m_rekanan->Getcv();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '9'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_rekanan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Mou(){
		$data1 = $this->m_mou->Getmou();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '10'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_mou',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Wilayah_pemasaran(){
		$data1 = $this->m_handle->Getpemasaran();
		$data3 = $this->m_pemasaran->Getadmpusat();
		$data4 = $this->m_form->Getperwakilanpem();
		$data2 = array(
			'data1' => $data1->result_array(), 
			'data2' => $data3->result_array(), 
			'data3' => $data4->result_array()
		);
		$data = array(
			        'angka' => '3',
			        'menu' => '1'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Admin/view_content_handle_pemasaran',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Report_sales(){
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(), );
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_sales', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_customer(){
		$data = array(
			        'angka' => '4',
			        'menu' => '2'
		         );
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(), );
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_customer', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_rekanan(){
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(), );
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_rekanan', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_stok(){
		$data = array(
			        'angka' => '4',
			        'menu' => '4'
		         );
		$penerbit= $this->m_report->Penerbit();
		$kode_penerbit = $penerbit->result();
		$jenjang =$this->m_report->Buku($kode_penerbit[0]->kode_penerbit,'jenjang');
		$tipe=$this->m_report->Buku($kode_penerbit[0]->kode_penerbit,'tipe');
		$edisi=$this->m_report->Buku($kode_penerbit[0]->kode_penerbit,'edisi');
		$kurikulum=$this->m_report->Buku($kode_penerbit[0]->kode_penerbit,'kurikulum');
		$data1 = array('penerbit' => $kode_penerbit,'jenjang' => $jenjang,'tipe' => $tipe,'edisi' => $edisi,'kurikulum' => $kurikulum);
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_stok', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_pesanan(){
		$data = array(
			        'angka' => '4',
			        'menu' => '5'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');

		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(), 
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_pesanan', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_alokasiproduk(){
		$data = array(
			        'angka' => '4',
			        'menu' => '6'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');

		$data1 = array('awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_alokasiproduk', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_pengajuan(){
		$data = array(
			        'angka' => '4',
			        'menu' => '7'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_pengajuan', $data1);
		$this->load->view('Report/view_footer');
	}
	function Report_mou(){
		$data = array(
			        'angka' => '4',
			        'menu' => '8'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$this->load->view('Report/view_head');
		$this->load->view('Co_pemasaran/view_asside', $data);
		$this->load->view('Report/view_content_mou', $data1);
		$this->load->view('Report/view_footer');
	}
	function Ubah_pass(){
		$this->load->view('v_reset_pass');
	}
	
}
?>