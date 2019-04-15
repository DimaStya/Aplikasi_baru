<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Pemasaran extends CI_Controller{
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
				if($user['hak_akses'] !='2'){
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
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_dashboard');
		$this->load->view('Pemasaran/view_footer');
	}
	function Pesanan(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Pesanan($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_pesanan',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Dopesan(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Dopesan($this->session->userdata('kode_admpusat'),$datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '2'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_do',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Req(){
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Reqhapus($datakawasan[0]['kode_wilayah']);   

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array());
		$data = array(
			        'angka' => '2',
			        'menu' => '3'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_req',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Hapus(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Terhapus($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '4'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_hapus',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Ambil_data(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Pesanan($kode_wilayah, $awal, $akhir);
		
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

        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'><button name='detail' value='$data->no_pesanan' type='submit' class='btn btn-info'>Detail</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->jenjang."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_do(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Dopesan($this->session->userdata('kode_admpusat'),$kode_wilayah, $awal, $akhir);
		
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
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_pesanan."' type='submit' class='btn btn-primary'>Downlaod PDF</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->jenjang."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_req(){
		$kode_wilayah = $this->input->post('data');
		$data_pesanan = $this->m_pemasaran->Reqhapus($kode_wilayah);
		
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
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_pesanan."' type='submit' class='btn btn-danger'>Hapus Pesanan</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->jenjang."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
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
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_pesandet', $data2);
		$this->load->view('Pemasaran/view_footer');
	}
	function Simpando(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$no_pesanan = $this->input->post('no_pesanan');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');

		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			$kode = $this->m_pemasaran->Getjumlah($kode_buku[$no]);
				array_push($data, array('stok_pesan' => $kode['stok_pesan']+$datajumlah,
				'kode_buku' => $kode_buku[$no], ));
		$no++;
		}
		$datado = array('no_pesanan' => $no_pesanan,
						'no_do' =>$no_pesanan,
						'kode_admpusat' => $this->session->userdata('kode_admpusat'),
						'tanggal' => $tanggal,
						'kondisi' => 'Proses');
		$pesan = array('proses' =>'DO, Menunggu SJ',);
		$where =array('no_pesanan' => $no_pesanan);

		$this->m_pemasaran->Update('tbl_pesanan',$pesan,$where );
		$this->m_pemasaran->Updatebuku($data); 
		$this->m_pemasaran->Insert('tbl_do',$datado);
		$this->session->set_userdata('no_pesanan',$no_pesanan);
		redirect(base_url().'Pemasaran/Cetak');
		
	}
	function Hapuspesan(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$no_pesanan = $this->input->post('no_pesanan');
		$jumlah = $this->m_pemasaran->Getdatapesan($no_pesanan);

		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			$kode = $this->m_pemasaran->Getjumlah($datajumlah['kode_buku']);
			echo $kode['stok_pesan']."<br>";
			echo $datajumlah['jumlah_beli']."<br>";
			array_push($data, array('stok_pesan' => $kode['stok_pesan']-$datajumlah['jumlah_beli'],
				'kode_buku' => $datajumlah['kode_buku'], ));
		$no++;
		}
		$pesan = array('kondisi' =>'Hapus',);
		$where =array('no_pesanan' => $no_pesanan);
		print_r($data);

		// $this->m_pemasaran->Update('tbl_do',$pesan,$where );
		// $this->m_pemasaran->Updatebuku($data); 
		// redirect(base_url().'Pemasaran/Pesanan');
		
	}
	function Tolakpesanan(){
		$no_pesanan = $this->input->post('no_pesanan');
		$alasan = $this->input->post('alasan');
		$pesan = array('proses' =>'Ditolak',
						'alasan' => $alasan);
		$where =array('no_pesanan' => $no_pesanan);

		$this->m_pemasaran->Update('tbl_pesanan',$pesan,$where);
		redirect(base_url().'Pemasaran/Pesanan');
		
	}
	function Cetak(){
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_cetak',$this->session->userdata('no_pesanan'));
		$this->load->view('Pemasaran/view_footer');
		//redirect(base_url().'Pemasaran/Cetakpdf');

		
	}
	function Cetakpdf(){
		$no_pesanan =  $this->input->post('no_pesanan');

        $tabel = $this->m_pemasaran->Cetak($no_pesanan);
		$head = $this->m_pemasaran->Datahead($no_pesanan);

        $pdf = new PDF();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_pesanan.'.pdf','D');
	}
}
?>