<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin extends CI_Controller{
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
				if($user['hak_akses'] !='10'){
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
		$this->load->view('Admin/view_asside', $data);
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
		$this->load->view('Admin/view_asside', $data);
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
		$this->load->view('Admin/view_asside', $data);
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
		$this->load->view('Admin/view_asside', $data);
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
		$this->load->view('Admin/view_asside', $data);
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
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_admperwakilan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Pemasaran(){
		$data1 = $this->m_pemasaran->Getadmpusat();
		$data2 = array('data1' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '6'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_pemasaran',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Keuangan(){
		$data1 = $this->m_keuangan->Getadmkeuangan();
		$data2 = array('data1' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '7'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_keuangan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Gudang(){
		$data1 = $this->m_gudang->Getadmgudang();
		$data2 = array('data1' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '8'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_gudang',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Produksi(){
		$data1 = $this->m_produksi->Getadmproduksi();
		$data2 = array('data1' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '9'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_produksi', $data2);
		$this->load->view('Admin/view_footer');
	}
	function Customer(){
		$data1 = $this->m_customer->Getcustomer();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '10'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_customer',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Kerjasama(){
		$data1 = $this->m_kerjasama->Getkerjasama();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '11'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_kerjasama',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Pengajuan(){
		$data1 = $this->m_pengajuan->Getpengajuan();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '12'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_pengajuan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Rekanan(){
		$data1 = $this->m_rekanan->Getcv();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '13'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_rekanan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Mou(){
		$data1 = $this->m_mou->Getmou();
		$data3 = $this->m_nasional->Getnasional();
		$data2 = array('data1' => $data1->result_array(), 'data2' => $data3->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '14'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_mou',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Penerbit(){
		$data1 = $this->m_penerbit->Getpenerbit();
		$data2 = array('data' => $data1->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '15 '
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_penerbit',$data2);
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
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_handle_pemasaran',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Wilayah_keuangan(){
		$data1 = $this->m_handle->Getkeuangan();
		$data3 = $this->m_keuangan->Getadmkeuangan();
		$data4 = $this->m_form->Getperwakilankeu();
		$data2 = array(
			'data1' => $data1->result_array(), 
			'data2' => $data3->result_array(), 
			'data3' => $data4->result_array()
		);
		$data = array(
			        'angka' => '3',
			        'menu' => '2'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_handle_keuangan',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Wilayah_gudang(){
		$data1 = $this->m_handle->Getgudang();
		$data3 = $this->m_gudang->Getadmgudang();
		$data4 = $this->m_form->Getperwakilangdg();
		$data2 = array(
			'data1' => $data1->result_array(), 
			'data2' => $data3->result_array(), 
			'data3' => $data4->result_array()
		);
		$data = array(
			        'angka' => '3',
			        'menu' => '3'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_handle_gudang',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Buku(){
		$penerbit = $this->m_penerbit->Getpenerbit();
		$data = array(
	        'angka' => '4',
	        'menu' => '1'
         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);

		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$tahun_lalu = $tahun_sek-1;
		$tahun_depan = $tahun_sek+1;
		$tahun= $this->m_buku->Gettahun_();

		$harga = array();
		foreach ($tahun->result_array() as $key) {
			$tah = explode("_", $key['Tables_in_new_sistem (tbl_harga%)']);
			array_push($harga,$tah['2']);
		}

		if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga) && in_array($tahun_depan, $harga)){
			//tahun sebelu, sekarang, tahun depan
			$data1 = $this->m_buku->Getbuku3($tahun_sek, $tahun_lalu,$tahun_depan);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'3');
		}else if (in_array($tahun_sek, $harga) && in_array($tahun_depan, $harga)){
			//tahun sekarang dan tahun depan
			$data1 = $this->m_buku->Getbuku2($tahun_sek, $tahun_depan);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'2');
		}else if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga)){
			//tahun sekarang, tahun sebelum
			$data1 = $this->m_buku->Getbuku1($tahun_sek, $tahun_lalu);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'1');
		}else if (in_array($tahun_sek, $harga)){
			//tahun sekarang aja
			$data1 = $this->m_buku->Getbuku($tahun_sek);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'-1');
		}

		$this->load->view('Admin/view_content_buku',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Harga(){
		$penerbit = $this->m_penerbit->Getpenerbit();
		$data = array(
	        'angka' => '4',
	        'menu' => '2'
         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);

		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$tahun_lalu = $tahun_sek-1;
		$tahun_depan = $tahun_sek+1;
		$tahun= $this->m_buku->Gettahun_();

		$harga = array();
		foreach ($tahun->result_array() as $key) {
			$tah = explode("_", $key['Tables_in_new_sistem (tbl_harga%)']);
			array_push($harga,$tah['2']);
		}

		if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga) && in_array($tahun_depan, $harga)){
			//tahun sebelu, sekarang, tahun depan
			$data1 = $this->m_buku->Getbuku3($tahun_sek, $tahun_lalu,$tahun_depan);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'3');
		}else if (in_array($tahun_sek, $harga) && in_array($tahun_depan, $harga)){
			//tahun sekarang dan tahun depan
			$data1 = $this->m_buku->Getbuku2($tahun_sek, $tahun_depan);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'2');
		}else if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga)){
			//tahun sekarang, tahun sebelum
			$data1 = $this->m_buku->Getbuku1($tahun_sek, $tahun_lalu);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'1');
		}else if (in_array($tahun_sek, $harga)){
			//tahun sekarang aja
			$data1 = $this->m_buku->Getbuku($tahun_sek);
			$data2 = array('data' => $data1->result_array(),'data2'=>$penerbit->result_array(), 'tahun'=>$tahun_sek, 'harga'=>'-1');
		}

		$this->load->view('Admin/view_content_harga',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Import(){
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_import');
		$this->load->view('Admin/view_footer');
	}
	function Paket(){
		$data = array(
			        'angka' => '4',
			        'menu' => '4'
		         );
		$paket = $this->m_buku->Getpaket();
		// echo $this->db->last_query($paket);
		$data1 = array();
		foreach ($paket as $paket) {
			$detpaket = $this->m_buku->Getbukupaket($paket['kode_paket']);
			if($detpaket['jumlah'] > 0){
				$datapaket = $this->m_buku->Getdetpaket($paket['kode_paket']);
				array_push($data1, array('kode_paket' => $datapaket['kode_paket'],
										 'nama_paket' => $datapaket['nama_paket'],
										 'jumlah' => $datapaket['jumlah'], ));
			}else{
				array_push($data1, array('kode_paket' => $paket['kode_paket'],
										 'nama_paket' => $paket['nama_paket'],
										 'jumlah' => '0', ));
			}
		}
		$data2 = array('data' => $data1, );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_paket',$data2);
		$this->load->view('Admin/view_footer');
	}
	function Detpaket($kode_paket){
		$data = array(
			        'angka' => '4',
			        'menu' => '4'
		         );
		$paket = $this->m_buku->Getpaketdetail($kode_paket);
		$data2 = array('data' => $paket,
						'kode_paket' => $kode_paket );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_detpaket',$data2);
		//tanpa footer karena boostrap nolak
	}
	function Proses_detpaket(){
		$tambah = $this->input->post('tambah');
		$kurang = $this->input->post('kurang');
		if(!empty($tambah) ){//tampilkan menambah
			$data = array(
				        'angka' => '4',
				        'menu' => '4'
			         );
			$penerbit = $this->m_pesan->Getpenerbit();
			$data2 = array('penerbit' => $penerbit->result_array(),
							'kode_paket' => $tambah);

			$this->load->view('Admin/view_head');
			$this->load->view('Admin/view_asside', $data);
			$this->load->view('Admin/view_content_addpaket',$data2);
			$this->load->view('Admin/view_footer');
		}else if(!empty($kurang)){//proses kurang
			$data_hapus = array();
			$hapus = $this->input->post('hapus');
			foreach ($hapus as $hapus) {
				array_push($data_hapus, array('kode_buku' => $hapus));
			}
			// for ($i=0; $i < count($this->input->post('hapus')); $i++) {
			// 	array_push($data_hapus, array('kode_buku' => $this->input->post('kode_buku')[$i]));
			// }
			if(count($hapus)>0){
				$this->m_buku->Deletbuku($kurang, $data_hapus);
			}
			redirect(base_url('Admin/Detpaket/'.$kurang));
		}
		
	}
	function Aktivitas(){
		$aktivitas = $this->m_login->Getaktivitas();
		$data = array(
			        'angka' => '5',
			        'menu' => '0'
		         );
		$data2 = array('data1' => $aktivitas->result_array(), );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_aktivitas',$data2);
		$this->load->view('Admin/view_footer');
	}

	function Tahun_depan(){
		$data = array(
			        'angka' => '6',
			        'menu' => '0'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$tahun_depan = $tahun_sek+1;
		$tahun= $this->m_buku->Gettahun_();

		$harga = array();
		foreach ($tahun->result_array() as $key) {
			$tah = explode("_", $key['Tables_in_new_sistem (tbl_harga%)']);
			array_push($harga,$tah['2']);
		}

		if (in_array($tahun_depan, $harga)){
			$data2  = array('tahun_sek' => $tahun_sek, 'tahun_depan'=> $tahun_depan,'status'=>'1' );
		}else{
			$data2  = array('tahun_sek' => $tahun_sek, 'tahun_depan'=> $tahun_depan,'status'=>'2' );
		}
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data);
		$this->load->view('Admin/view_content_tahun',$data2);
		$this->load->view('Admin/view_footer');
	}
	
}
?>