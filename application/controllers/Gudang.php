<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Gudang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdfsj');
		$this->load->library('pdf_sjstokmini');
		$this->load->library('pdf_ttr');
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
				$user = $this->session->userdata('username');
				if(empty($user)){
					redirect('Login');
				}
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
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Pesananbaru($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));

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
	function Proses(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Proses($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '2'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_proses',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Selesai(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Selesai($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '3'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_selesai',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Pesan_selesai(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Proses($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '4'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_pesanselesai',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Reqretur(){
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$reqretur = $this->m_pemasaran->Reqretur($alamat);   
		$data1 = array('kawasan' => $datakawasan,
						'reqretur' => $reqretur->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '1'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_reqretur',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Retur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$retur = $this->m_gudang->Retur($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   
		//echo $this->db->last_query($retur);
		$data1 = array('kawasan' => $datakawasan,
						'retur' => $retur->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '3',
			        'menu' => '2'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_retur',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Update(){
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$req_update = $this->m_gudang->Requpdate($alamat);
		//echo $this->db->last_query($ttr);
		$data1 = array('kawasan' => $datakawasan,
						'requpdate' => $req_update->result_array(),);
		$data = array(
			        'angka' => '3',
			        'menu' => '3'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_requpdate',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Pesanan_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Pesananbaru_stokmini($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_pesanan_stokmini',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Proses_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Proses_stokmini($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '2'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_proses_stokmini',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Stok_mini(){
		date_default_timezone_set("Asia/Jakarta");
		$kawasan = $this->m_gudang->Kawasan($this->session->userdata('kode_admgudang'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_gudang->Stok_mini($alamat);
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),);
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_stokmini',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Lpb_baru(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$penerbit = $this->m_pesan->Getpenerbit();
		$kode= '/LPB-MDT/'.$bulan_sek.'/'.$tahun_sek;

		$kode_lpb = $this->m_gudang->Getkodelpb($kode);
		$nomor = $kode_lpb->row_array();
		if ($nomor['max(kode_lpb)'] == ''){
			$number = 1;
			$pesan = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(kode_lpb)']);
			$number = $no[0];
			$pesan = sprintf('%03d',$number+1).$kode;
		}
		$buku_oc = $this->m_gudang->Buku_oc();
		$data1 = array( 'buku_oc' => $buku_oc->result(),
						'kode_lpb' => $pesan,);
		$data = array(
			        'angka' => '5',
			        'menu' => '1'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_lpb',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Daftar_lpb(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$lpb = $this->m_gudang->Lpb($awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		$data1 = array( 'lpb' => $lpb->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
	        'angka' => '5',
	        'menu' => '2'
         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_daftarlpb',$data1);
		$this->load->view('Gudang/view_footer');
	}
	function Add_lpb(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$kode_lpb = $this->input->post('kode_lpb');
		$kode_buku = $this->input->post('kode_buku');
		$kode_oc = $this->input->post('kode_oc');
		$jumlah = $this->input->post('jumlah');
		$kode_admgudang =$this->session->userdata('kode_admgudang');
		$data_lpb = array('kode_lpb' => $kode_lpb,
							'kode_admgudang' => $kode_admgudang,
							'tanggal' => $tanggal,);
		$data = array();
			$no =0;
			foreach ($jumlah as $datajumlah) {
				if ($datajumlah >0){
					array_push($data, array('kode_lpb' => $kode_lpb,
					'total' => $datajumlah,
					'kode_oc' => $kode_oc[$no],
					'kode_buku' => $kode_buku[$no], ));
				}
			$no++;
			}		
		if(count($data) > 0){
			$this->m_gudang->Insert('tbl_lpb',$data_lpb);
			$this->m_gudang->save_batch('tbl_buku_lpb',$data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Order Cetak Berhasil di Buat...</p>
				                </div>'); 
			redirect(base_url().'Gudang/Daftar_lpb');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Order Cetak Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Gudang/Lpb_baru');
		}
	}
	function Hapus_bukulpb(){
		$kode_lpb = $this->input->get('kode_lpb');
		$kode_buku = $this->input->get('kode_buku');
		$kode_oc = $this->input->get('kode_oc');
		
		$this->m_gudang->Hapus($kode_lpb,$kode_buku,$kode_oc);
		$this->session->set_flashdata('pesan', 
			                '<div class="alert alert-danger">
			                    <h4>Berhasil </h4>
			                    <p>Buku Lpb Dihapus...</p>
			                </div>'); 
		redirect(base_url().'Gudang/Daftar_lpb');

	}
	function Detailpesanan(){
		$no_pesan = $this->input->post('approve');
		$no_pesanan = $this->input->post('buat_sj');

		if(!empty($no_pesan)){
			//Pesanan Baru 
			$pesanan = $this->m_pesan->Getdetpesan($no_pesan);
			$bukupesan = $this->m_pesan->Getdetbuku($no_pesan);
			$datbuk = $this->m_pesan->Getdatbuk($no_pesan);
			
			$data2 = array('pesanan' => $pesanan->row_array(),
							'buku' => $bukupesan->result_array(),
							'datbuk' => $datbuk->row_array(),
							'button' => 'approve');
		}else if(!empty($no_pesanan)){
			//Pesanan Terproses
			$pesanan = $this->m_pesan->Getdetpesan($no_pesanan);
			$bukupesan = $this->m_pesan->Getdetbuku($no_pesanan);
			$datbuk = $this->m_pesan->Getdatbuk($no_pesanan);

			$data2 = array('pesanan' => $pesanan->row_array(),
							'buku' => $bukupesan->result_array(),
							'datbuk' => $datbuk->row_array(),
							'button' => 'Proses SJ');
		}else{
			redirect('Gudang/Pesanan');
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
	function Detailpesanan_stokmini(){
		$no_pesan = $this->input->post('approve');

		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$ambil_kode = explode('/', $no_pesan);
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$kode= '/SJSTK-MDT/'.$ambil_kode[2].'/'.$bulan_sek.'/'.$tahun_sek;

		$no_suratjalan = $this->m_pesan->Getnosuratjalan_stokmini($kode);
		$nomor = $no_suratjalan->row_array();
		if ($nomor['max(no_sj_stkmini)'] == ''){
			$number = 1;
			$sj = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_sj_stkmini)']);
			$number = $no[0];
			$sj = sprintf('%03d',$number+1).$kode;
		}
			//Pesanan Baru 
			$pesanan = $this->m_pesan->Getdetpesan_stokmini($no_pesan);
			$bukupesan = $this->m_pesan->Getdetbuku_stokmini($no_pesan);
			
			$data2 = array('pesanan' => $pesanan->row_array(),
							'buku' => $bukupesan->result_array(),
							'sj' => $sj,
						);

		$data = array(
			        'angka' => '4',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_pesandet_stokmini', $data2);
		$this->load->view('Gudang/view_footer');
	}
	function Ambil_data(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Pesananbaru($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		//$lists = $this->db->last_query($pesanan);
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='approve' value='".$data->no_do."' type='submit' class='btn btn-info'>Detail</button></td></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_datasj(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Proses($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td colspan="3" scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'>
                    <form method='POST' action='".base_url().'Gudang/Detailpesanan/'."'>
                    	<button name='buat_sj' value='".$data->no_do."' type='submit' class='btn btn-info'>Detail</button>
                    </form>
                    </td>
                    <td>
                    <form method='POST' action='".base_url().'Gudang/Simpansj/'."'>
                    <input type='hidden' name='no_pesanan' id='no_pesanan' value='".$data->no_do."'>
                    	<button type='submit' name='klik' id='klik' value='sj' class='btn btn-success'>SJ Baru</button>
                    </form>	
                    </td>
                    <td scope='col'><button type='button' name='klik".$no."' id='klik".$no."' value='".$data->no_do."' class='btn btn-warning' data-toggle='modal' data-target='#myModal'>Cek SJ</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>
                    <td scope='col'>".$data->jumlah_kirim."</td>
                    <td scope='col'>".$data->sisa_kirim."</td>
<script>
$('#klik".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Gudang/Data_sj')."',
        data: {data : '".$data->no_do."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#data_sj').html(response.data_sj).show();
          document.getElementById('no_do').innerHTML = '".$data->no_do."';
        },
      });
    });
</script>
                    ";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_dataselesai(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Selesai($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tgl_sj."</td>
                    <td scope='col'>".$data->no_suratjalan."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'>
                    <form method='POST' action='".base_url().'Gudang/Cetakpdf/'."'>
                    	<button name='no_suratjalan' value='".$data->no_suratjalan."' type='submit' class='btn btn-info'>Cetak Ulang SJ</button>
                    </form>
                    </td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_dataretur(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$retur = $this->m_gudang->Retur($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($retur->result() as $data) {
        	if($data->nota_retur == 'Belum Nota Retur' && $data->nota_retur == 'Admin Telah Menerima'){
        		$button = "<button onclick='Klik".$no."()' type='button' class='btn btn-danger'>Hapus</button>
<script type='text/javascript'>
      function Klik".$no."(){
        var r = confirm('Yakin Data dihapus?');
        if(r == true){
          window.location = '".base_url().'Gudang/Hapus_ttr/'.md5($data->kode_retur)."';
        }
      }
</script>";
        	}else{ $button ='';}
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>
                    <form action='".base_url().'Gudang/Cetakpdf_ttr/'."' method='POST'>
                          <button name='kode_retur' value='".$data->kode_retur."' type='submit' class='btn btn-info'>Cetak Ulang</button>
                        </form>
                    </td>
                    <td scope='col'>".$button."
                    </td>                    
                    <td scope='col'>".$data->kode_retur."</td>
                    <td scope='col'>".$data->no_suratretur."</td>
                    <td scope='col'>".$data->no_suratjalan."</td>
                    <td scope='col'>".$data->no_faktur."</td>
                    <td scope='col'>".$data->nota_retur."</td>
                    ";
            $no++;
        }
		
		$callback = array('data_retur'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_pesanselesai(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Pesan_selesai($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button type='button' name='klik".$no."' id='klik".$no."' value='".$data->no_do."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>
                    <td scope='col'>".$data->jumlah_kirim."</td>
                    <td scope='col'>".$data->sisa_kirim."</td>
<script>
$('#klik".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Gudang/Data_sj')."',
        data: {data : '".$data->no_do."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#data_sj').html(response.data_sj).show();
          document.getElementById('no_do').innerHTML = '".$data->no_do."';
        },
      });
    });
</script>
                    ";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_requpdate(){
		$kode_wilayah = $this->input->post('data');
		$pesanan = $this->m_gudang->Requpdate($kode_wilayah);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->kode_retur."</td>
                    <td scope='col'>".$data->no_suratretur."</td>
                    <td scope='col'>
                        <form action='".base_url()."Gudang/Hapus_nota/update/' method='GET'>
                        <button name='kode_retur' id='kode_retur' value='".$data->kode_retur."' type='submit' class='btn btn-warning'>Update</button></form></td>

                        ";
            $no++;
        }
		
		$callback = array('data_requpdate'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Data_sj(){
		$no_do = $this->input->post('data');
		$data_sj = $this->m_gudang->Data_sj($no_do);
		//echo $this->db->last_query($data_sj);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Plih
		$lists = '';
        $no=1;
        foreach ($data_sj->result() as $data) {
        	$lists .= "<tr>
        				<td align='center'>".$no."</td>
        				<td>".$data->tanggal."</td>
        				<td>".$data->no_suratjalan."</td>
        				<td>".$data->nama_admgudang."</td>
        				<td>".$data->jumlah_judul."</td>
        				<td>".$data->jumlah_buku."</td>
        			  </tr>";
            $no++;
        }
		
		$callback = array('data_sj'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_data_stokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Pesananbaru_stokmini($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		//$lists = $this->db->last_query($pesanan);
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do_stokmini."</td>
                    <td scope='col'><button name='approve' value='".$data->no_do_stokmini."' type='submit' class='btn btn-info'>Detail</button></td></td>
                    <td scope='col'>".$data->alamat_kirim."</td>
                    <td scope='col'>".$data->keterangan."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td></tr>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_stokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$pesanan = $this->m_gudang->Stok_mini($kode_wilayah);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		//$lists = $this->db->last_query($pesanan);
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->kode_buku."</td>
                    <td scope='col'>".$data->judul."</td>
                    <td scope='col'>".$data->stok."</td></tr>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_dataselesai_stokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_gudang->Proses_stokmini($kode_wilayah, $awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_sj_stkmini."</td>
                    <td scope='col'>
                    	<form method='POST' action='".base_url().'Gudang/Cetakpdf_stokmini/'."'>
                    	<button name='no_sj_stkmini' value='".$data->no_sj_stkmini."' type='submit' class='btn btn-info'>Cetak SJ</button>
                    </form>
                    </td>
                    <td scope='col'><a href='".base_url().'Gudang/Hapus_sjstokmini?no_sj_stkmini='.$data->no_sj_stkmini."' onclick=\"return(confirm('Yakin data akan dihapus?'));\"><button type='button' class='btn btn-danger'>Hapus</button></a></td>
                    <td scope='col'>".$data->alamat_kirim."</td>
                    <td scope='col'>".$data->keterangan."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td></tr>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_lpb(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$lpb = $this->m_gudang->Lpb($awal, $akhir);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($lpb->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->kode_lpb."</td>
                    <td scope='col'><button type='button' name='klik".$no."' id='klik".$no."' class='btn btn-success' data-toggle='modal' data-target = '#myModal'> Update </button>
                    </td></tr>
<script>
$('#klik".$no."').click(function(){ 
      $('#loading_buk').show();
      $('#buku_lpb').hide();
      $.ajax({
        type: 'POST',
        url: '".base_url('Gudang/Ambil_bukulpb')."',
        data: {data : '".$data->kode_lpb."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loading_buk').hide();
          $('#buku_lpb').html(response.buku_lpb).show();
          document.getElementById('kode_lpb').innerHTML = '".$data->kode_lpb."';
        },
      });
    });
</script>
                    ";
            $no++;
        }
		
		$callback = array('data_lpb'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_bukulpb(){
		$data = $this->input->post('data');
		$buku_lpb = $this->m_gudang->Buku_lpb($data);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($buku_lpb->result() as $data) {
        	if ($data->stok_real > $data->total) {
        		$link = "<a href='".base_url()."Gudang/Hapus_bukulpb?kode_buku=".$data->kode_buku."&&kode_oc=".$data->kode_oc."&&kode_lpb=".$data->kode_lpb."'><button  type='button' class='btn btn-danger'>Hapus</button></a>";
        	}else{
        		$link ="Stok Tidak mencukupi";
        	}
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->kode_oc."</td>
                    <td scope='col'>".$data->kode_buku."</td>
                    <td scope='col'>".$data->judul."</td>
                    <td scope='col'>".$data->total."</td>
                    <td scope='col'>".$link."</td>
                    </tr>";
            $no++;
        }
		
		$callback = array('buku_lpb'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Simpansj(){
		$klik = $this->input->post('klik');
		$no_pesanan = $this->input->post('no_pesanan');
		$where =array('no_pesanan' => $no_pesanan);
		$cek = $this->m_pesan->Data_pesan('tbl_pesanan', $where);
		$ambil_kode = explode('/', $no_pesanan);
		if($cek['proses']=='DO, Menunggu SJ' || $cek['proses']=='Proses SJ'){
			$data = array('proses' => 'Proses SJ', );
			$up = $this->m_gudang->Update('tbl_pesanan', $data, $where);
			if($klik=='sj'){
				$alamat = $this->m_gudang->Alamat($no_pesanan);
				if ($alamat['stok'] == 'stok_real') {
					$buku = $this->m_gudang->Data_buku_sj($no_pesanan);
				}else if($alamat['stok'] == 'stok_mini'){
					$buku = $this->m_gudang->Data_buku_sj_mini($no_pesanan);
				}
				
				if($alamat['kode_cv'] == 'Tanpa CV'){
					$data_alamat = $alamat['alamat_customer'];
					$yth = $alamat['nama_customer'];
				}else if($alamat['kode_cv'] != 'Tanpa CV'){
					$data_alamat = $alamat['alamat_cv'];
					$yth = $alamat['nama_cv'];
				}
				date_default_timezone_set("Asia/Jakarta");
				$tahun_sek= date('Y');
				$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
				$bulan_sek= $array_bln[date('n')];
				$kode= '/SJ-MDT/'.$ambil_kode[2].'/'.$bulan_sek.'/'.$tahun_sek;

				$no_suratjalan = $this->m_pesan->Getnosuratjalan($kode);
				$nomor = $no_suratjalan->row_array();
				if ($nomor['max(no_suratjalan)'] == ''){
					$number = 1;
					$sj = sprintf('%03d',$number).$kode;
				}else{
					$no = explode('/', $nomor['max(no_suratjalan)']);
					$number = $no[0];
					$sj = sprintf('%03d',$number+1).$kode;
				}
				$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
				$data_sj = array('no_suratjalan' => $sj,
									'alamat' => $data_alamat,
									'yth' => $yth,
									'stok' => $alamat['stok'],
									'buku' => $buku );
				$this->load->view('Gudang/view_head');
				$this->load->view('Gudang/view_asside', $data);
				$this->load->view('Gudang/view_content_simpansj', $data_sj);
				$this->load->view('Gudang/view_footer');
			}else if($klik=='approve'){
				redirect('Gudang/Pesanan');
			}
			
		}else if($cek['proses']=='DO, Menunggu SJ'){
			//data pesanan dalam proses request hapus
		}
	}
	function ProsesSJ(){
		date_default_timezone_set("Asia/Jakarta");
		$no_suratjalan = $this->input->post('no_suratjalan');
		$nopol = $this->input->post('nopol');
		$ekspedisi = $this->input->post('ekspedisi');
		$nama_driver = $this->input->post('nama_driver');
		$no_telp = $this->input->post('no_telp');
		$koli = $this->input->post('koli');
		$ket = $this->input->post('ket');
		$stok = $this->input->post('stok');
		$tanggal = date('Y-m-d');	

		$karung = $this->input->post('karung');
		$jumlah = $this->input->post('jumlah');
		$no_do = $this->input->post('no_do');
		$harga = $this->input->post('harga');
		$kode_buku = $this->input->post('kode_buku');
		$data_sj = array('no_suratjalan' => $no_suratjalan,
							'no_do' => $no_do[0],
							'kode_admgudang' => $this->session->userdata('kode_admgudang'),
							'no_polisi' => $nopol,
							'ekspedisi' => $ekspedisi,
							'nama_sopir' => $nama_driver,
							'no_telp_sopir' => $no_telp,
							'koli' => $koli,
							'stok' => $stok,
							'Karung' => $karung,
							'tanggal' => $tanggal,);
		$data = array();
			$no =0;
			foreach ($jumlah as $datajumlah) {
				if ($datajumlah >0){
					array_push($data, array('no_suratjalan' => $no_suratjalan,
					'jumlah' => $datajumlah,
					'no_do' => $no_do[$no],
					'harga' => $harga[$no],
					'ket' => $ket[$no],
					'kode_buku' => $kode_buku[$no], ));
				}
			$no++;
			}	
		if(count($data) > 0){
			$this->session->set_userdata('no_suratjalan',$no_suratjalan);
			$this->m_gudang->Insert('tbl_suratjalan',$data_sj);
			$this->m_gudang->save_batch('tbl_buku_sj',$data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Surat Jalan Berhasil di Buat...</p>
				                </div>'); 
			redirect(base_url().'Gudang/Cetak');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Surat Jalan Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Gudang/Pesanan');
		}
	}
	function ProsesSJstok(){
		date_default_timezone_set("Asia/Jakarta");
		$no_stokmini = $this->input->post('no_stokmini');
		$no_sj_stokmini = $this->input->post('no_sj_stokmini');
		$ekspedisi = $this->input->post('ekspedisi');
		$no_polisi = $this->input->post('no_polisi');
		$nama_sopir = $this->input->post('nama_sopir');
		$no_telp_sopir = $this->input->post('no_telp_sopir');
		$tanggal = date('Y-m-d');	

		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$data_sj = array('no_do_stokmini' => $no_stokmini,
							'no_sj_stkmini' => $no_sj_stokmini,
							'kode_admgudang' => $this->session->userdata('kode_admgudang'),
							'no_polisi' => $no_polisi,
							'ekspedisi' => $ekspedisi,
							'nama_sopir' => $nama_sopir,
							'no_telp_sopir' => $no_telp_sopir,
							'ket' => 'Menunggu Diterima',
							'tanggal' => $tanggal,);
		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah){
			array_push($data, array('no_sj_stkmini' => $no_sj_stokmini,
			'jumlah' => $datajumlah,
			'no_stokmini' => $no_stokmini,
			'kode_buku' => $kode_buku[$no], ));
		$no++;
		}
		$this->session->set_userdata('no_sj_stkmini',$no_sj_stokmini);
		$this->m_gudang->Insert('tbl_sj_stok',$data_sj);
		$this->m_gudang->save_batch('tbl_buku_stkmini',$data);
		$this->session->set_flashdata('pesan', 
			                '<div class="alert alert-success">
			                    <h4>Berhasil </h4>
			                    <p>Surat Jalan Berhasil di Buat...</p>
			                </div>'); 
		redirect(base_url().'Gudang/Cetak_sj_stokmini');

	}
	function Hapus_sjstokmini(){
		$no_sj_stkmini = $this->input->get('no_sj_stkmini');
		$where = array('no_sj_stkmini' => $no_sj_stkmini, );
		$hap_buku = $this->m_gudang->Delete('tbl_buku_stkmini', $where);
		if ($hap_buku) {
			$hap_sj = $this->m_gudang->Delete('tbl_sj_stok', $where);
			redirect(base_url().'Gudang/Proses_stokmini');
		}
	}
	function Ambil_reqretur(){
		$kode_wilayah = $this->input->post('data');
		$req_retur = $this->m_gudang->Reqretur($kode_wilayah);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>';
        $no=1;
        foreach ($req_retur->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'>".$data->no_suratretur."</td>
                    <td scope='col' width='380' style='white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word'>".$data->alasan."</td>
                    <td scope='col'><button type='button' name='klik".$no."' id='klik".$no."' value='".$data->no_suratretur."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
<script>
$('#klik".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Gudang/Data_reqretur')."',
        data: {data : '".$data->no_suratretur."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#reqretur').html(response.reqretur).show();
        },
      });
    });
</script>
                    ";
            $no++;
        }
		
		$callback = array('reqretur'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Data_reqretur(){
		$no_suratretur = $this->input->post('data');
		$req_retur = $this->m_gudang->Data_reqretur($no_suratretur);
		$head_retur = $this->m_gudang->Data_headretur($no_suratretur);
		date_default_timezone_set("Asia/Jakarta");
		$ambil_kode = explode('/', $no_suratretur);
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$kode= '/TTR-MDT/'.$ambil_kode[2].'/'.$bulan_sek.'/'.$tahun_sek;

		$ttr = $this->m_pesan->Getnottr($kode);
		$nomor = $ttr->row_array();
		if ($nomor['max(kode_retur)'] == ''){
			$number = 1;
			$ttr = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(kode_retur)']);
			$number = $no[0];
			$ttr = sprintf('%03d',$number+1).$kode;
		}
		//echo $this->db->last_query($faktur);
		$lists = '';
        $no=1;
        foreach ($req_retur->result() as $data) {
        	$lists .= "<tr>
        				<input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
        				<input type='hidden' name='no_suratretur[]' id='no_suratretur[]' value='".$data->no_suratretur."'>
        				<input type='hidden' name='no_do[]' id='no_do[]' value='".$data->no_do."'>
        				<input type='hidden' name='no_suratjalan[]' id='no_suratjalan[]' value='".$data->no_suratjalan."'>
        				<input type='hidden' name='jumlah[]' id='jumlah[]' value='".$data->jumlah_retur."'>
        				<input type='hidden' name='harga[]' id='harga[]' value='".$data->harga."'>
        				<td align='center'>".$no."</td>
        				<td>".$data->kode_buku."</td>
        				<td>".$data->judul."</td>
        				<td align='center'>".$data->jumlah_kirim."</td>
        				<td align='center'>".$data->jumlah_retur."</td>
        			  </tr>";
            $no++;
        }
		$data = $head_retur->row_array();
		if($data['kode_cv'] == 'Tanpa CV'){
			$data_alamat = $data['alamat_customer'];
			$dari = $data['nama_customer'];
			$tlp = $data['telp_cust'];
		}else if($data['kode_cv'] != 'Tanpa CV'){
			$data_alamat = $data['alamat_cv'];
			$dari = $data['nama_cv'];
			$tlp = $data['telp_cv'];
		}
		$data_ = '
            <form action="'.base_url('Gudang/Buat_retur').'" method="POST">
            <u><b><center>No TTR : '.$ttr.'</center></b></u>
            <br>
            <input type="hidden" name="kode_retur" id="kode_retur" value="'.$ttr.'">
              <table>
                <tr>
                  <td colspan="2">Terima Dari</td>
                  <td width="30%"></td>
                  <td width="20%">No Retur</td>
                  <td>: '.$data['no_suratretur'].'</td>
                </tr>
                <tr>
                  <td colspan="2">Bapak/Ibu '.$dari.'</td>
                  <td></td>
                  <td>Tgl Retur</td>
                  <td>: '.$data['tgl_suratretur'].'</td>
                </tr>
                <tr>
                  <td colspan="2">'.$data_alamat.'</td>
                  <td></td>
                  <td>No SJ</td>
                  <td>: '.$data['no_suratjalan'].'</td>
                </tr>
                <tr>
                  <td colspan="2">'.$tlp.'</td>
                  <td></td>
                  <td>Tgl SJ</td>
                  <td>: '.$data['tgl_sj'].'</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td></td>
                  <td>No Faktur</td>
                  <td>: '.$data['no_faktur'].'</td>
                </tr>
                <tr>
                  <td>Nama Cust</td>
                  <td>: '.$data['nama_customer'].'</td>
                  <td></td>
                  <td>Tgl Faktur</td>
                  <td>: '.$data['tgl_faktur'].'</td>
                </tr>
                <tr>
                  <td>Nama CV</td>
                  <td>: '.$data['nama_cv'].'</td>
                  <td></td>
                  <td>Koordinator/Sales</td>
                  <td>: '.$data['nama_kaper'].'/'.$data['nama_sales'].'</td>
                </tr>
                <tr>
                  <td width="20%">Alasan Retur</td>
                  <td>: '.$data['alasan'].'</td>
                </tr>
              </table>
              <br>  
               <table width="100%"  rules="rows" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th width="15%">Kode Buku</th>
                      <th width="50%">Judul</th>
                      <th width="10%">Jumlah Kirim</th>
                      <th width="10%">Jumlah Retur</th>
                    </tr> 
                  </thead>
                  <tbody>
                    '.$lists.'
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5" align="right">
                      <button type="submit" class="btn btn-success right">Buat TTR</button></td>
                    </tr>
                  </tfoot>     
                </table>
            </form>';
		$callback = array('reqretur'=>$data_);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Buat_retur(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$no_suratretur = $this->input->post('no_suratretur');
		$kode_buku = $this->input->post('kode_buku');
		$no_do = $this->input->post('no_do');
		$no_suratjalan = $this->input->post('no_suratjalan');
		$kode_retur = $this->input->post('kode_retur');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');

		$data_retur = array('kode_retur' => $kode_retur,
						  'kode_admgudang' => $this->session->userdata('kode_admgudang'),
						  'no_suratretur' => $no_suratretur[0],
						  'tanggal' => $tanggal);
		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			array_push($data, array('no_suratretur' => $no_suratretur[$no],
			'kode_buku' => $kode_buku[$no],
			'no_do' => $no_do[$no],
			'no_suratjalan' => $no_suratjalan[$no],
			'kode_retur' => $kode_retur,
			'jumlah' => $jumlah[$no],
			'harga' => $harga[$no], ));
		$no++;}

		$this->session->set_userdata('kode_retur',$kode_retur);
		$this->m_gudang->Insert('tbl_retur',$data_retur);
		$this->m_gudang->save_batch('tbl_buku_retur',$data);
		redirect(base_url().'Gudang/Cetak_ttr');
		

	}
	function Hapus_nota($dari){
		$kode_retur =  $this->input->get('kode_retur');

		$where = array('kode_retur' => $kode_retur, );
		$del_bukuttr = $this->m_gudang->Delete('tbl_buku_retur', $where);
		if($del_bukuttr){
			$upd = $this->m_gudang->Updateretur($kode_retur);
			$del_ttr = $this->m_gudang->Delete('tbl_retur', $where);
			if($dari =='update'){
				redirect('Gudang/Update');
			}else if($dari == 'hapus'){
				redirect('Gudang/Retur');
			}
		}
	}
	function Cetak(){
		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_cetak',$this->session->userdata('no_suratjalan'));
		$this->load->view('Gudang/view_footer');		
	}
	function Cetakpdf(){
		$no_suratjalan =  $this->input->post('no_suratjalan');
		

        $tabel = $this->m_gudang->Cetak($no_suratjalan);
		$head = $this->m_gudang->Datahead($no_suratjalan, $this->session->userdata('kode_admgudang'));

        $pdf = new PDFSJ();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(true, 60); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_suratjalan.'.pdf','D');
	}
	function Cetak_ttr(){
		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_cetak_ttr',$this->session->userdata('kode_retur'));
		$this->load->view('Gudang/view_footer');		
	}
	function Cetakpdf_ttr(){
		$kode_retur =  $this->input->post('kode_retur');
		

        $tabel = $this->m_gudang->Data_ttr($kode_retur);
		$head = $this->m_gudang->Data_headttr($kode_retur);

        $pdf = new Pdf_ttr();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
        $pdf->AddPage('P','A4');
        $pdf->Content();
        $pdf->Output($kode_retur.'.pdf','D');
	}
	function Cetak_sj_stokmini(){
		$data = array(
			        'angka' => '4',
			        'menu' => '0'
		         );
		$this->load->view('Gudang/view_head');
		$this->load->view('Gudang/view_asside', $data);
		$this->load->view('Gudang/view_content_cetak_stokmini',$this->session->userdata('no_sj_stkmini'));
		$this->load->view('Gudang/view_footer');		
	}
	function Cetakpdf_stokmini(){
		$no_sj_stkmini =  $this->input->post('no_sj_stkmini');
		

        $tabel = $this->m_gudang->Data_stokmini($no_sj_stkmini);
		$head = $this->m_gudang->Data_headstokmini($no_sj_stkmini);

        $pdf = new Pdf_sjstokmini();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
        $pdf->AddPage('P','A4');
        $pdf->Content();
        $pdf->Output($no_sj_stkmini.'.pdf','D');
	}				
}
?>