<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Pemasaran extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->library('pdf_stokmini');
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
		$pesanan = $this->m_pemasaran->Dopesan($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   

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
	function Proses_kirim(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Proses_kirim($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '5'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_proses',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Selesai(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Selesai($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '6'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_selesai',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Reqretur(){
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$reqretur = $this->m_pemasaran->Reqretur($datakawasan[0]['kode_wilayah']);   

		$data1 = array('kawasan' => $datakawasan,
						'reqretur' => $reqretur->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '1'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_reqretur',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Retur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$retur = $this->m_pemasaran->retur($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'retur' => $retur->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '3',
			        'menu' => '2'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_retur',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Update(){
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$reqretur = $this->m_pemasaran->Requpdate($datakawasan[0]['kode_wilayah']);   
		//echo $this->db->last_query($reqretur);
		$data1 = array('kawasan' => $datakawasan,
						'reqretur' => $reqretur->result_array());
		$data = array(
			        'angka' => '3',
			        'menu' => '3'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_requpdate',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Pesanan_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Pesanan_stokmini($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_pesananstokmini',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function DO_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Dopesan_stokmini($datakawasan[0]['kode_wilayah'], $awal->format('Y-m-d'), $akhir->format('Y-m-d'));   

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '2'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_do_stokmini',$data1);
		$this->load->view('Pemasaran/view_footer');
	}
	function Stok_mini(){
		date_default_timezone_set("Asia/Jakarta");
		$kawasan = $this->m_pemasaran->Kawasan($this->session->userdata('kode_admpusat'));
		$datakawasan = $kawasan->result_array();
		$pesanan = $this->m_pemasaran->Stok_mini($datakawasan[0]['kode_wilayah']);
		//echo $this->db->last_query($pesanan);

		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),);
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_stokmini',$data1);
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
		$data_pesanan = $this->m_pemasaran->Dopesan($kode_wilayah, $awal, $akhir);
		
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
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_do."' type='submit' class='btn btn-primary'>Downlaod PDF</button></td>
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
                  </tr>';
        $no=1;
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_pesanan."' type='submit' class='btn btn-danger'>Hapus Pesanan</button></td>
                    <td scope='col' width='380' style='white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word'>".$data->alasan."</td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_kerjasama."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_hapus(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Terhapus($kode_wilayah, $awal, $akhir);
		
		
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
                  </tr>';
        $no=1;
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_pesanan."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_pesanan."' type='submit' class='btn btn-primary'>Detail</button></td>
                    <td scope='col' width='380' style='white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word'>".$data->alasan."</td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_kerjasama."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_admper."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_proses(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Proses_kirim($kode_wilayah, $awal, $akhir);
		
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
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_do."' type='submit' class='btn btn-primary'>Downlaod PDF</button></td>
                    <td scope='col'><button type='button' name='pencet".$no."' id='pencet".$no."' value='".$data->no_do."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->jenjang."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Sisa_kirim')."',
        data: {data : '".$data->no_do."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#sisa_kirim').html(response.sisa_kirim).show();
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
	function Ambil_selesai(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Selesai($kode_wilayah, $awal, $akhir);
		
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
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='no_pesanan' id='no_pesanan' value='".$data->no_do."' type='submit' class='btn btn-primary'>Downlaod PDF</button></td>
                    <td scope='col'><button type='button' name='pencet".$no."' id='pencet".$no."' value='".$data->no_do."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->jenjang."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Sisa_kirim')."',
        data: {data : '".$data->no_do."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#sisa_kirim').html(response.sisa_kirim).show();
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
	function Ambil_reqretur(){
		$kode_wilayah = $this->input->post('data');
		$req_retur = $this->m_pemasaran->Reqretur($kode_wilayah);
		
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
                    <td scope='col'><button type='button' name='pencet".$no."' id='pencet".$no."' value='".$data->no_suratretur."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Data_reqretur')."',
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
          $('#headretur').html(response.headretur).show();
          $('#button').html(response.button).show();
          document.getElementById('no_suratretur').innerHTML = '".$data->no_suratretur."';
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
	function Ambil_requpdate(){
		$kode_wilayah = $this->input->post('data');
		$req_retur = $this->m_pemasaran->Requpdate($kode_wilayah);
		
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
                    <td scope='col'><button type='button' name='pencet".$no."' id='pencet".$no."' value='".$data->no_suratretur."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button></td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Data_requpdate')."',
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
          $('#headretur').html(response.headretur).show();
          $('#button').html(response.button).show();
          document.getElementById('no_suratretur').innerHTML = '".$data->no_suratretur."';
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
	function Ambil_retur(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_retur = $this->m_pemasaran->Retur($kode_wilayah, $awal, $akhir);
		
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
                  </tr>';
        $no=1;
        foreach ($data_retur->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_suratretur."</td>
                    <td scope='col'>".$data->no_suratjalan."</td>
                    <td scope='col'>".$data->no_faktur."</td>
                    <td scope='col'>".$data->ttr."</td>
                    <td scope='col'>".$data->nota_retur."</td>
                    </tr>";
            $no++;
        }
		
		$callback = array('data_retur'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Sisa_kirim(){
		$no_do = $this->input->post('data');
		$sisa_kirim = $this->m_pemasaran->Sisa_kirim($no_do);
		//echo $this->db->last_query($faktur);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Plih
		$lists = '';
        $no=1;
        foreach ($sisa_kirim->result() as $data) {
        	$lists .= "<tr>
        				<td align='center'>".$no."</td>
        				<td>".$data->kode_buku."</td>
        				<td>".$data->judul."</td>
        				<td align='center'>".$data->jumlah_beli."</td>
        				<td align='center'>".$data->jumlah_kirim."</td>
        				<td align='center'>".$data->sisa_kirim."</td>
        			  </tr>";
            $no++;
        }
		
		$callback = array('sisa_kirim'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Data_reqretur(){
		$no_suratretur = $this->input->post('data');
		$req_retur = $this->m_pemasaran->Data_reqretur($no_suratretur);
		$head_retur = $this->m_pemasaran->Data_headretur($no_suratretur);
		//echo $this->db->last_query($faktur);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Plih
		$data = $head_retur->row_array();
		$listt = "<table width='100%'> 
			<tr>
				<td width='10%'>Nama Pelanggan</td>
				<td width='30%'>: ".$data['nama_penerima']."</td>
			</tr>
			<tr>
				<td width='10%'>Nama Koordinator</td>
				<td width='00%'>: ".$data['nama_kaper']."</td>
			</tr>
			<tr>
				<td width='10%'>Nama Sales</td>
				<td width='00%'>: ".$data['nama_sales']."</td>
			</tr>
			<tr>
				<td width='10%'>Alasan</td>
				<td width='30%'>: ".$data['alasan']."</td>
			</tr>
		</table>";
		if ($data['keterangan'] == 'Menunggu Admin') {
			$button =  "<button type='button' id='terima' name='terima' class='btn btn-success right' data-dismiss='modal'>Terima</button>
<script>
$('#terima').click(function(){ 
      $('#loadingklik1').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Terima_retur')."',
        data: {data : '".$no_suratretur."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik1').hide();
          $('#alert').html(response.alert).show();
        },
      });
    });
</script>
			";
		}else{
			$button =  "Data Telah Di Terima Admin";
		}
		$lists = '';
        $no=1;
        foreach ($req_retur->result() as $data) {
        	$lists .= "<tr>
        				<td align='center'>".$no."</td>
        				<td>".$data->kode_buku."</td>
        				<td>".$data->judul."</td>
        				<td align='center'>".$data->jumlah_kirim."</td>
        				<td align='center'>".$data->jumlah_retur."</td>
        			  </tr>";
            $no++;
        }
		
		$callback = array('reqretur'=>$lists, 'headretur'=>$listt, 'button'=>$button);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Data_requpdate(){
		$no_suratretur = $this->input->post('data');
		$req_retur = $this->m_pemasaran->Data_reqretur($no_suratretur);
		$head_retur = $this->m_pemasaran->Data_headretur($no_suratretur);
		//echo $this->db->last_query($faktur);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Plih
		$data = $head_retur->row_array();
		$listt = "<table width='100%'> 
			<tr>
				<td width='10%'>Nama Pelanggan</td>
				<td width='30%'>: ".$data['nama_penerima']."</td>
			</tr>
			<tr>
				<td width='10%'>Nama Koordinator</td>
				<td width='00%'>: ".$data['nama_kaper']."</td>
			</tr>
			<tr>
				<td width='10%'>Nama Sales</td>
				<td width='00%'>: ".$data['nama_sales']."</td>
			</tr>
			<tr>
				<td width='10%'>Alasan</td>
				<td width='30%'>: ".$data['alasan']."</td>
			</tr>
		</table>";
		if ($data['keterangan'] == 'Update Di mohon') {
			$button =  "<button type='button' id='terima' name='terima' class='btn btn-success right' data-dismiss='modal'>Terima</button>
<script>
$('#terima').click(function(){ 
      $('#loadingklik1').show();
      $.ajax({
        type: 'POST',
        url: '".base_url('Pemasaran/Terima_requpdate')."',
        data: {data : '".$no_suratretur."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik1').hide();
          $('#alert').html(response.alert).show();
        },
      });
    });
</script>
			";
		}else{
			$button =  "Data Telah Di Terima Admin";
		}
		$lists = '';
        $no=1;
        foreach ($req_retur->result() as $data) {
        	$lists .= "<tr>
        				<td align='center'>".$no."</td>
        				<td>".$data->kode_buku."</td>
        				<td>".$data->judul."</td>
        				<td align='center'>".$data->jumlah_kirim."</td>
        				<td align='center'>".$data->jumlah_retur."</td>
        			  </tr>";
            $no++;
        }
		
		$callback = array('reqretur'=>$lists, 'headretur'=>$listt, 'button'=>$button);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Terima_retur(){
		$no_suratretur = $this->input->post('data');
		$pesan = array('keterangan' =>'Admin Telah Menerima',);
		$where =array('no_suratretur' => $no_suratretur);

		$up = $this->m_pemasaran->Update('tbl_suratretur',$pesan,$where );
		if($up){
			$lists = '<script> alert("Data Telah Diterima!!!"); </script>';
		}else{
			$lists = '<script> alert("Data Gagal Di update!!!"); </script>';

		}
		$callback = array('alert'=>$lists,);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Terima_requpdate(){
		$no_suratretur = $this->input->post('data');
		$pesan = array('keterangan' =>'Admin Telah Menerima Update',);
		$where =array('no_suratretur' => $no_suratretur);

		$up = $this->m_pemasaran->Update('tbl_suratretur',$pesan,$where );
		if($up){
			$lists = '<script> alert("Data Telah Diterima!!!"); </script>';
		}else{
			$lists = '<script> alert("Data Gagal Di update!!!"); </script>';

		}
		$callback = array('alert'=>$lists,);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_datastokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Pesanan_stokmini($kode_wilayah, $awal, $akhir);
		
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
                  </tr>';
        $no=1;

        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_stokmini."</td>
                    <td scope='col'><button name='detail' value='$data->no_stokmini' type='submit' class='btn btn-info'>Detail</button></td>
                    <td scope='col'>".$data->alamat_kirim."</td>
                    <td scope='col'>".$data->keterangan."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_do_stokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$data_pesanan = $this->m_pemasaran->Dopesan_stokmini($kode_wilayah, $awal, $akhir);
		
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
                  </tr>';
        $no=1;
        foreach ($data_pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do_stokmini."</td>
                    <td scope='col'><button name='no_stokmini' id='no_stokmini' value='".$data->no_do_stokmini."' type='submit' class='btn btn-primary'>Downlaod PDF</button></td>
                    <td scope='col'>".$data->alamat_kirim."</td>
                    <td scope='col'>".$data->keterangan."</td>
                    <td scope='col'>".$data->jumlah_judul."</td>
                    <td scope='col'>".$data->jumlah_buku."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_stokmini(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$pesanan = $this->m_pemasaran->Stok_mini($kode_wilayah);
		
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
	function Detailpesanan_stokmini(){
		$no_pesan = $this->input->post('detail');
		//echo $no_pesan;
		$pesanan = $this->m_pesan->Getdetpesan_stokmini($no_pesan);
		$bukupesan = $this->m_pesan->Getdetbuku_stokmini($no_pesan);
		$datbuk = $this->m_pesan->Getdatbuk($no_pesan);
		
		$data2 = array('pesanan' => $pesanan->row_array(),
						'buku' => $bukupesan->result_array(),
						'button' => 'ada');
		$data = array(
			        'angka' => '4',
			        'menu' => '0'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_pesandetstokmini', $data2);
		$this->load->view('Pemasaran/view_footer');
	}
	function Simpando(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$no_pesanan = $this->input->post('no_pesanan');
		$stok = $this->input->post('stok');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$ket = $this->input->post('ket');

		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			//$kode = $this->m_pemasaran->Getjumlah($kode_buku[$no]);
				array_push($data, array('no_do' => $no_pesanan,
				'kode_buku' => $kode_buku[$no],
				'jumlah_beli' => $datajumlah,
				'jumlah_kirim' => 0,
				'ket' => $ket[$no],
				'sisa_kirim' => $datajumlah,
				'harga' => $harga[$no], ));
		$no++;
		}
		$datado = array('no_pesanan' => $no_pesanan,
						'no_do' =>$no_pesanan,
						'kode_admpusat' => $this->session->userdata('kode_admpusat'),
						'tanggal' => $tanggal,
						'stok' => $stok,
						'kondisi' => 'Proses');
		$pesan = array('proses' =>'DO, Menunggu SJ',);
		$where =array('no_pesanan' => $no_pesanan);

		$this->m_pemasaran->Update('tbl_pesanan',$pesan,$where );
		$this->m_pemasaran->Insert('tbl_do',$datado);
		$this->m_pemasaran->save_batch($data);
		$this->session->set_userdata('no_pesanan',$no_pesanan);
		redirect(base_url().'Pemasaran/Cetak');
		
	}
	function Simpando_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$no_stokmini = $this->input->post('no_stokmini');

		$datado = array('no_stokmini' => $no_stokmini,
						'no_do_stokmini' =>$no_stokmini,
						'kode_admpusat' => $this->session->userdata('kode_admpusat'),
						'tanggal' => $tanggal);

		$this->m_pemasaran->Insert('tbl_do_stokmini',$datado);
		$this->session->set_userdata('no_stokmini',$no_stokmini);
		redirect(base_url().'Pemasaran/Cetak_stokmini');
		
	}
	function Hapuspesan(){
		$no_pesanan = $this->input->post('no_pesanan');
		$where =array('no_pesanan' => $no_pesanan);
		$this->m_pemasaran->Delete('tbl_do',$where);
		redirect(base_url().'Pemasaran/Req');
		
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
		$this->load->view('Pemasaran/view_content_cetak',$this->session->userdata('no_stokmini'));
		$this->load->view('Pemasaran/view_footer');
		//redirect(base_url().'Pemasaran/Cetakpdf');

		
	}
	function Cetakpdf(){
		$no_pesanan =  $this->input->post('no_pesanan');
		

        $tabel = $this->m_pemasaran->Cetak($no_pesanan);
		$head = $this->m_pemasaran->Datahead($no_pesanan, $this->session->userdata('kode_admpusat'));

        $pdf = new PDF();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
		//$pdf->SetAutoPageBreak(true, 60); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_pesanan.'.pdf','D');
	}
	function Cetak_stokmini(){
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$this->load->view('Pemasaran/view_head');
		$this->load->view('Pemasaran/view_asside', $data);
		$this->load->view('Pemasaran/view_content_cetak_stokmini',$this->session->userdata('no_pesanan'));
		$this->load->view('Pemasaran/view_footer');
		//redirect(base_url().'Pemasaran/Cetakpdf');

		
	}
	function Cetakpdf_stokmini(){
		$no_stokmini =  $this->input->post('no_stokmini');
		

        $tabel = $this->m_pemasaran->Cetak_stokmini($no_stokmini);
		$head = $this->m_pemasaran->Datahead_stokmini($no_stokmini, $this->session->userdata('kode_admpusat'));

        $pdf = new PDF_stokmini();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
		//$pdf->SetAutoPageBreak(true, 60); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_stokmini.'.pdf','D');
	}
}
?>