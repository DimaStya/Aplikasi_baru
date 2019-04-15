<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Perwakilan extends CI_Controller{
	function __construct(){
		parent::__construct();
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
				if($user['hak_akses'] !='1'){
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
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_dashboard');
		$this->load->view('Perwakilan/view_footer');
	}
	function Pesan(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$sales = $this->m_pesan->Getsales($this->session->userdata('kode_perwakilan'));
		$cv = $this->m_pesan->Getcv($this->session->userdata('kode_perwakilan'));
		$customer = $this->m_pesan->Getcustomer($this->session->userdata('kode_perwakilan'));
		$penerbit = $this->m_pesan->Getpenerbit();
		$wilayah = $this->m_pesan->Getkodewilayah($this->session->userdata('kode_perwakilan'));
		$kodewilayah = $wilayah->row_array();
		$kode= '/PSN/'.$kodewilayah['kode_wilayah'].'/'.$bulan_sek.'/'.$tahun_sek;

		$nopesan = $this->m_pesan->Getnopesan($kode);
		$nomor = $nopesan->row_array();
		if ($nomor['max(no_pesanan)'] == ''){
			$number = 1;
			$pesan = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_pesanan)']);
			$number = $no[0];
			$pesan = sprintf('%03d',$number+1).$kode;
		}

		$data2 = array('sales' => $sales->result_array(),
						'cv' => $cv->result_array(),
						'customer' => $customer->result_array(),
						'penerbit' => $penerbit->result_array(),
						'no_pesan' => $pesan);
		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesan', $data2);
		$this->load->view('Perwakilan/view_footer');
	}
	function Pesanan(){
		// proses menunggu Do
		$pesanan = $this->m_pesan->Getpesanan($this->session->userdata('kode_admper'),'Menunggu DO');
		$data2 = array('pesanan' => $pesanan->result_array(),);
		$data = array(
			        'angka' => '3',
			        'menu' => '1'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/Pesanan/head');
		$this->load->view('Perwakilan/Pesanan/view_content_pesanan', $data2);
		$this->load->view('Perwakilan/Pesanan/foot');
		$this->load->view('Perwakilan/view_footer');
	}
	function Decline(){
		// proses Ditolak
		$pesanan = $this->m_pesan->Getdecline($this->session->userdata('kode_admper'),'Ditolak');
		$data2 = array('pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '2'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/Pesanan/head');
		$this->load->view('Perwakilan/Pesanan/view_content_decline', $data2);
		$this->load->view('Perwakilan/Pesanan/foot');
		$this->load->view('Perwakilan/view_footer');
	}
	function Approve(){
		// proses DO, Meunggu SJ
		$pesanan = $this->m_pesan->Getapprove($this->session->userdata('kode_admper'),'DO, Menunggu SJ');
		//echo $this->db->last_query($pesanan);
		$data2 = array('pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '3'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/Pesanan/head');
		$this->load->view('Perwakilan/Pesanan/view_content_approve', $data2);
		$this->load->view('Perwakilan/Pesanan/foot');
		$this->load->view('Perwakilan/view_footer');
	}
	function Request(){
		// proses Req Hapus -> Berisi alasan
		$pesanan = $this->m_pesan->Gethapus($this->session->userdata('kode_admper'),'Hapus');
		$data2 = array('pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '4'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/Pesanan/head');
		$this->load->view('Perwakilan/Pesanan/view_content_req', $data2);
		$this->load->view('Perwakilan/Pesanan/foot');
		$this->load->view('Perwakilan/view_footer');
	}
	function Suratjalan(){
		// proses Proses SJ -> tidak bisa di hapus
		$pesanan = $this->m_pesan->Getpesanan($this->session->userdata('kode_admper'),'Proses SJ');
		$data2 = array('pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '5'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesanan', $data2);
		$this->load->view('Perwakilan/view_footer');
	}
	function Selesai(){
		// proses SJ habis
		$pesanan = $this->m_pesan->Getpesanan($this->session->userdata('kode_admper'),'SJ Selesai');
		$data2 = array('pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '6'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesanan', $data2);
		$this->load->view('Perwakilan/view_footer');
	}
	function Detailpesanan(){

		$no_pesan = $this->input->post('detail');
		$hapus = $this->input->get('no_pesanan');
		$alasan = $this->input->post('alasan');
		if(!empty($no_pesan)){
		//detail
		$pesanan = $this->m_pesan->Getdetpesan($no_pesan);
		$bukupesan = $this->m_pesan->Getdetbuku($no_pesan);
		$datbuk = $this->m_pesan->Getdatbuk($no_pesan);

		$data2 = array('pesanan' => $pesanan->row_array(),
						'buku' => $bukupesan->result_array(),
						'datbuk' => $datbuk->row_array());

		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesandet', $data2);
		$this->load->view('Perwakilan/view_footer');

		}else if(!empty($hapus)){
		//hapus		
			$where = array(
			        'no_pesanan' => $hapus,
		         );
			$deldata = $this->m_pesan->Hapuspesan('tbl_datapesan', $where);
			$delbuk = $this->m_pesan->Hapuspesan('tbl_pesanan', $where);
			if($delbuk){
				$this->session->set_flashdata('pesan', 
					                '<div class="alert alert-info">
					                    <h4>Gagal !!! </h4>
					                    <p>Pesanan Berhasil Dihapus!!.</p>
					                </div>');
				redirect(base_url().'Perwakilan/Pesanan');
			}else{
				$this->session->set_flashdata('pesan', 
					                '<div class="alert alert-danger">
					                    <h4>Gagal !!! </h4>
					                    <p>Pesanan Gagal Dihapus!!.</p>
					                </div>');
				redirect(base_url().'Perwakilan/Pesanan');
			}
		}else if(!empty($alasan)){
			//request hapus
			$no_pesanan = $this->input->post('no_pesanan');
			$pesan = array('proses' =>'Hapus',
						'alasan' => $alasan);
			$where =array('no_pesanan' => $no_pesanan);
			$reqhapus = $this->m_pesan->Reqhapus($pesan, $where);
			$this->session->set_flashdata('pesan', 
					                '<div class="alert alert-info">
					                    <h4>Berhasil !!! </h4>
					                    <p>Request telah di masuk!!.</p>
					                </div>');
				redirect(base_url().'Perwakilan/Request');

		}

	}
	function Editpesanan(){

		$tam_buku = $this->input->post('tam_buku');
		$tam_judul = $this->input->post('tam_judul');

		$no_pesanan = $this->input->post('no_pesanan');

		$kode_penerbit = $this->input->post('kode_penerbit');
		$tipe = $this->input->post('tipe');
		$jenjang = $this->input->post('jenjang');
		$edisi = $this->input->post('edisi');
		$kurikulum = $this->input->post('kurikulum');

		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);

		if(!empty($tam_buku)){
			$datbuk = $this->m_pesan->Getbuku($no_pesanan);
			$data2 = array('datbuk' => $datbuk->result_array(), 'no_pesanan' => $no_pesanan);
			$this->load->view('Perwakilan/view_content_tambuk',$data2);

		}else if(!empty($tam_judul)){
			$tahun = $this->m_pesan->Getdatapesan($no_pesanan);
			$datatahun = $tahun->row_array();
			$datbuk = $this->m_pesan->Getjudul($no_pesanan, $kode_penerbit, $tipe, $jenjang, $edisi, $kurikulum, $datatahun['tahun'], $datatahun['kawasan']);
			$data2 = array('datbuk' => $datbuk->result_array(), 'no_pesanan' => $no_pesanan);
			$this->load->view('Perwakilan/view_content_tamjud', $data2);
		}else{
			redirect(base_url().'Perwakilan');
		}
		$this->load->view('Perwakilan/view_footer');
	}
}
?>