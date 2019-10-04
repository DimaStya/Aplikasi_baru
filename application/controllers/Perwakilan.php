<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Perwakilan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf_suratretur');
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
		//$cv = $this->m_pesan->Getcv($this->session->userdata('kode_perwakilan'));
		$customer = $this->m_pesan->Getcustomer($this->session->userdata('kode_perwakilan'));
		$paket = $this->m_pesan->Getpaket();
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
						'customer' => $customer->result_array(),
						'penerbit' => $penerbit->result_array(),
						'penerbit_mini' => $penerbit->result_array(),
						'no_pesan' => $pesan,
						'paket' => $paket,);
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
	function TerFaktur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$pesanan = $this->m_perwakilan->Terfaktur($this->session->userdata('kode_wilayah'), $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array( 'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '3',
			        'menu' => '5'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_terfaktur',$data1);
		$this->load->view('Perwakilan/view_footer');
	}
	function Det_terfaktur(){
		$no_do = $this->input->post('no_do');
		$SJ = $this->m_perwakilan->SJ($no_do);
		//echo $this->db->last_query($SJ);

		$data1 = array( 'pesanan' => $SJ->result_array(),
						'no_do' => $no_do);
		$data = array(
			        'angka' => '3',
			        'menu' => '5'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_det_terfaktur',$data1);
		$this->load->view('Perwakilan/view_footer');
	}
	function TerRetur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$pesanan = $this->m_perwakilan->Terretur($this->session->userdata('kode_wilayah'), $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array( 'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '3',
			        'menu' => '6'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_terretur',$data1);
		$this->load->view('Perwakilan/view_footer');
	}
	function Det_terretur(){
		$no_do = $this->input->Get('no_do');
		$SJ = $this->m_perwakilan->SJ_retur($no_do);
		//echo $this->db->last_query($SJ);

		$data1 = array( 'pesanan' => $SJ->result_array(),
						'no_do' => $no_do);
		$data = array(
			        'angka' => '3',
			        'menu' => '6'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_det_terretur',$data1);
		$this->load->view('Perwakilan/view_footer');
	}
	function Pesan_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$sales = $this->m_pesan->Getsales($this->session->userdata('kode_perwakilan'));
		//$cv = $this->m_pesan->Getcv($this->session->userdata('kode_perwakilan'));
		$customer = $this->m_pesan->Getcustomer($this->session->userdata('kode_perwakilan'));
		$paket = $this->m_pesan->Getpaket();
		$penerbit = $this->m_pesan->Getpenerbit();
		$wilayah = $this->m_pesan->Getkodewilayah($this->session->userdata('kode_perwakilan'));
		$kodewilayah = $wilayah->row_array();
		$kode= '/STK-MN/'.$kodewilayah['kode_wilayah'].'/'.$bulan_sek.'/'.$tahun_sek;

		$nopesan = $this->m_pesan->Getnopesan($kode);
		$nomor = $nopesan->row_array();
		if ($nomor['max(no_pesanan)'] == ''){
			$number = 1;
			$no_stokmini = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_pesanan)']);
			$number = $no[0];
			$no_stokmini = sprintf('%03d',$number+1).$kode;
		}

		$data2 = array('penerbit' => $penerbit->result_array(),
						'no_stokmini' => $no_stokmini,);
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesanstkmini', $data2);
		$this->load->view('Perwakilan/view_footer');
	}
	function Pesanan_stokmini(){
		// proses menunggu Do
		$pesanan = $this->m_pesan->Getpesananstkmini($this->session->userdata('kode_wilayah'));
		$data2 = array('pesanan' => $pesanan->result_array(),);
		$data = array(
			        'angka' => '4',
			        'menu' => '2'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_pesananstkmini', $data2);
		$this->load->view('Perwakilan/view_footer');
	}
	function Approve_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$pesanan = $this->m_perwakilan->Approve_stokmini($this->session->userdata('kode_wilayah'), $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);

		$data1 = array( 'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_approve_stokmini',$data1);
		$this->load->view('Perwakilan/view_footer');
	}
	function Stok_mini(){
		$pesanan = $this->m_perwakilan->Stok_mini($this->session->userdata('kode_wilayah'));
		$data1 = array('pesanan' => $pesanan->result_array(),);
		$data = array(
			        'angka' => '4',
			        'menu' => '4'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_stokmini',$data1);
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
			$where =array('no_pesanan' => $no_pesanan);
			$cek = $this->m_pesan->Data_pesan('tbl_pesanan', $where);
			if($cek['proses']=='DO, Menunggu SJ'){
				$pesan = array('proses' =>'Hapus',
						'alasan' => $alasan);
				$reqhapus = $this->m_pesan->Reqhapus($pesan, $where);
				$this->session->set_flashdata('pesan', 
					                '<div class="alert alert-info">
					                    <h4>Berhasil !!! </h4>
					                    <p>Request telah di masuk!!.</p>
					                </div>');
				redirect(base_url().'Perwakilan/Request');
			}else{
				$this->session->set_flashdata('pesan', 
					                '<div class="alert alert-danger">
					                    <h4>Gagal !!! </h4>
					                    <p>Request gagal di minta Karena telah masuk gudang!!.</p>
					                </div>');
				redirect(base_url().'Perwakilan/Pesanan');
			}
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
	function Ambil_faktur(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$terfaktur = $this->m_perwakilan->Terfaktur($this->session->userdata('kode_wilayah'), $awal, $akhir);

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

        foreach ($terfaktur->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='no_do' value='$data->no_do' type='submit' class='btn btn-info'>Detail</button></td>
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
	function Ambil_retur(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$terfaktur = $this->m_perwakilan->Terretur($this->session->userdata('kode_wilayah'), $awal, $akhir);

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

        foreach ($terfaktur->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do."</td>
                    <td scope='col'><button name='no_do' value='$data->no_do' type='submit' class='btn btn-info'>Detail</button></td>
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
	function Ambil_data_sj(){
		$no_sj = $this->input->post('data');
		$terfaktur = $this->m_perwakilan->Data_sj($no_sj);

		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '';
        $no=1;
        foreach ($terfaktur->result() as $data) {
        	$lists .= "<tr>
        			<td>".$no."</td>
                    <td>".$data->kode_buku."</td>
                    <td>".$data->judul."
                    	<input type='hidden' name = 'no_do[]' id='no_do[]' value='".$data->no_do."'>
                    	<input type='hidden' name = 'no_suratjalan[]' id='no_suratjalan' value='".$data->no_suratjalan."'>
                    	<input type='hidden' name = 'kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
                    	<input type='hidden' name = 'harga[]' id='harga[]' value='".$data->harga."'>
                    </td>
                    <td>".$data->jumlah."</td>
                    <td><input type='number' name='jum_retur[]' id='jum_retur[]' max='".$data->jumlah."' min='0'</td>
                    ";
            $no++;
        }
		
		$callback = array('data_sj'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_approve_stokmimni(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$terfaktur = $this->m_perwakilan->Approve_stokmini($this->session->userdata('kode_wilayah'), $awal, $akhir);

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

        foreach ($terfaktur->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_do_stokmini."</td>
                    <td scope='col'>".$data->alamat_kirim."</td>
                    <td scope='col'>".$data->keterangan."</td>
                    <td scope='col'>".$data->sj."</td>
                    <td scope='col'><button type='button' class='btn-info' data-toggle='modal' name='pencet".$no."' id='pencet".$no."' data-target='#myModal'>Detail</button></td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $('#stokmini').hide();
      $.ajax({
        type: 'POST',
        url: '".base_url('Perwakilan/Detail_stokmini')."',
        data: {data : '".$data->no_do_stokmini."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#stokmini').html(response.stokmini).show();
          $('#button').html(response.button).show();
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
	function Detail_stokmini(){
		$no_do_stokmini = $this->input->post('data');
		$stokmini = $this->m_perwakilan->Buku_stokmini($no_do_stokmini);
		$ket_sj = $this->m_perwakilan->Ket_sj($no_do_stokmini);
		//echo $this->db->last_query($faktur);
		$lists = '';		
        $no=1;
        foreach ($stokmini->result() as $data) {
        	$lists .= "<tr>
        	<input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
        	<input type='hidden' name='jumlah[]' id='jumlah[]' value='".$data->jumlah."'>        	
        				<td align='center'>".$no."</td>
        				<td>".$data->no_do_stokmini."</td>
        				<td>".$data->kode_buku."</td>
        				<td>".$data->judul."</td>
        				<td>".$data->jumlah."</td>
        			  </tr>";
            $no++;
        }
		if ($ket_sj->num_rows() == 1) {
			$data = $ket_sj->row_array();
			if($data['ket'] == "Menunggu Diterima"){
				$button = '<input type="hidden" name="no_sj_stkmini" id="no_sj_stkmini" value="'.$data['no_sj_stkmini'].'">
				<button type="submit" class="btn btn-primary">Submit</button>';
			}elseif ($data['ket'] == "Stok Mini Ditambah") {
				$button = 'Sudah Disimpan';
			}			
		}else{
			$button='Belum Ter SJ';
		}
		
		$callback = array('stokmini'=>$lists, 'button'=>$button);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Add_stokmini(){
		$kode_buku = $this->input->post('kode_buku');
		$no_sj_stkmini = $this->input->post('no_sj_stkmini');
		$jumlah = $this->input->post('jumlah');
		$kode_perwakilan = $this->session->userdata('kode_perwakilan');
		$data = array('ket' => 'Stok Mini Ditambah', );
		$where = array('no_sj_stkmini' => $no_sj_stkmini, );
		$this->m_perwakilan->Update('tbl_sj_stok', $data, $where);
		$no =0;
		foreach ($jumlah as $datajumlah){
			$read = $this->m_perwakilan->Stokmini($kode_perwakilan, $kode_buku[$no]);
			if($read->num_rows()==1){ //update
				$up = $this->m_perwakilan->Updatestokmini($kode_perwakilan, $kode_buku[$no], $datajumlah);
			}else{ //insert
				$dat = array('kode_perwakilan' => $kode_perwakilan,
							 'kode_buku' => $kode_buku[$no],
							 'stok' => $datajumlah);
				$in = $this->m_perwakilan->Insert('tbl_stokmini', $dat);
				$up = $this->m_perwakilan->Updatebukustokmini($kode_buku[$no], $datajumlah);
			} $no++;
		}
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil ditambah!!.</p>
				                </div>');
		redirect(base_url().'Perwakilan/Stok_mini');
		

	}
	function Buat_noretur(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$kode= '/RTR-MDT/'.$this->session->userdata('kode_wilayah').'/'.$bulan_sek.'/'.$tahun_sek;

		$noretur = $this->m_pesan->Getnoretur($kode);
		$nomor = $noretur->row_array();
		if ($nomor['max(no_suratretur)'] == ''){
			$number = 1;
			$retur = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_suratretur)']);
			$number = $no[0];
			$retur = sprintf('%03d',$number+1).$kode;
		}

		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '<input class="form-control" type="text" name="no_suratretur" id="no_suratretur" value="'.$retur.'" readonly="">';		
		$callback = array('no_retur'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_add_buku(){
		$no_suratretur = $this->input->post('data');
		$add_buku = $this->m_perwakilan->Data_add_buku($no_suratretur);

		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '';
        $no=1;
        foreach ($add_buku->result() as $data) {
        	$lists .= "<tr>
        			<td>".$no."</td>
                    <td>".$data->kode_buku."</td>
                    <td>".$data->judul."
                    	<input type='hidden' name = 'no_do[]' id='no_do[]' value='".$data->no_do."'>
                    	<input type='hidden' name = 'no_suratjalan[]' id='no_suratjalan' value='".$data->no_suratjalan."'>
                    	<input type='hidden' name = 'no_suratretur[]' id='no_suratretur' value='".$data->no_suratretur."'>
                    	<input type='hidden' name = 'kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
                    </td>
                    <td>".$data->jum_sj."</td>
                    <td><input type='number' name='jum_retur[]' id='jum_retur[]' max='".$data->jum_sj."' min='0' value ='".$data->jum_ret."'</td>
                    ";
            $no++;
        }
		
		$callback = array('data_add_buku'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_add_judul(){
		$no_suratjalan = $this->input->post('data');
		$add_judul = $this->m_perwakilan->Data_add_judul($no_suratjalan);

		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '';
        $no=1;
        foreach ($add_judul->result() as $data) {
        	$lists .= "<tr>
        			<td>".$no."</td>
                    <td>".$data->kode_buku."</td>
                    <td>".$data->judul."
                    	<input type='hidden' name = 'no_do[]' id='no_do[]' value='".$data->no_do."'>
                    	<input type='hidden' name = 'no_suratjalan[]' id='no_suratjalan' value='".$data->no_suratjalan."'>
                    	<input type='hidden' name = 'no_suratretur[]' id='no_suratretur' value='".$data->no_suratretur."'>
                    	<input type='hidden' name = 'kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
                    	<input type='hidden' name = 'harga[]' id='harga[]' value='".$data->harga."'>
                    </td>
                    <td>".$data->jumlah."</td>
                    <td><input type='number' name='jum_retur[]' id='jum_retur[]' max='".$data->jumlah."' min='0'</td>
                    ";
            $no++;
        }
		
		$callback = array('data_add_judul'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function add_bukuretur(){
		$no_do = $this->input->post('no_do');
		$no_suratjalan = $this->input->post('no_suratjalan');
		$kode_buku = $this->input->post('kode_buku');
		$jum_retur = $this->input->post('jum_retur');
		$no_suratretur = $this->input->post('no_suratretur');
		$data_ubah = array();
		$data_kurang = array();
		$no =0;
		foreach ($jum_retur as $jum_retur) {
			if($jum_retur > 0){
				array_push($data_ubah, array('jumlah' => $jum_retur,
					'kode_buku' => $kode_buku[$no]));
			}else if($jum_retur == 0){
				array_push($data_kurang, array('kode_buku' => $kode_buku[$no]));
			}
			$no++;
		}
		if(count($data_ubah) > 0){
			$this->m_perwakilan->Ubahjumlah($no_do[0], $no_suratjalan[0], $no_suratretur[0], 'tbl_buku_reqretur', $data_ubah);
		}
		if(count($data_kurang) > 0){
			$this->m_perwakilan->Deletbuku($no_do[0], $no_suratjalan[0], $no_suratretur[0], 'tbl_buku_reqretur', $data_kurang);
		}
		$this->session->set_userdata('no_suratretur',$no_suratretur[0]);
		
	}
	function add_judulretur(){
		$no_do = $this->input->post('no_do');
		$no_suratjalan = $this->input->post('no_suratjalan');
		$kode_buku = $this->input->post('kode_buku');
		$jum_retur = $this->input->post('jum_retur');
		$harga = $this->input->post('harga');
		$no_suratretur = $this->input->post('no_suratretur');

		$data = array();
		$no =0;
		foreach ($jum_retur as $jum_retur) {
			if($jum_retur > 0){
				array_push($data, array('no_suratretur' => $no_suratretur[$no],
					'no_suratjalan' => $no_suratjalan[$no],
					'no_do' => $no_do[$no],
					'jumlah' => $jum_retur,
					'kode_buku' => $kode_buku[$no],
					'harga' => $harga[$no],));
			}			
			$no++;
		}
		
		if(count($data) > 0){
			$this->m_pesan->save_batch('tbl_buku_reqretur',$data);
			$this->session->set_userdata('no_suratretur',$no_suratretur[0]);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil ditambah!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/Cetak');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Retur Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/TerRetur');
		}
	}
	function Ambil_buku_stokmini(){
		$no_stokmini = $this->input->post('data');
		$add_buku = $this->m_perwakilan->Data_buku_stokmini($no_stokmini);

		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = '';
        $no=1;
        foreach ($add_buku->result() as $data) {
        	$lists .= "<tr>
        			<td>".$no."</td>
                    <td>".$data->kode_buku."</td>
                    <td>".$data->judul."
                    	<input type='hidden' name = 'no_stokmini[]' id='no_stokmini[]' value='".$data->no_stokmini."'>
                    	<input type='hidden' name = 'kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
                    </td>
                    <td><input type='number' name='jumlah[]' id='jumlah[]' min='0' value ='".$data->jumlah."'</td>
                    ";
            $no++;
        }
		
		$callback = array('data_add_buku'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function add_bukustokmini(){
		$no_stokmini = $this->input->post('no_stokmini');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$data_ubah = array();
		$data_kurang = array();
		$no =0;
		foreach ($jumlah as $jumlah) {
			if($jumlah > 0){
				array_push($data_ubah, array('jumlah' => $jumlah,
					'kode_buku' => $kode_buku[$no]));
			}else if($jumlah == 0){
				array_push($data_kurang, array('kode_buku' => $kode_buku[$no]));
			}
			$no++;
		}
		if(count($data_ubah) > 0){
			$this->m_perwakilan->Ubahjumlahstokmini($no_stokmini[0], 'tbl_buku_psnstk', $data_ubah);
		}
		if(count($data_kurang) > 0){
			$this->m_perwakilan->Deletbukustokmini($no_stokmini[0], 'tbl_buku_psnstk', $data_kurang);
		}
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil diubah!!.</p>
				                </div>');
		redirect(base_url().'Perwakilan/Pesanan_stokmini');
	}
	function UpdateRetur(){
		$data = array('keterangan' => 'Update Di mohon', );
		$where = array('no_suratretur' => $this->input->get('no_suratretur'), );
		$up = $this->m_perwakilan->Update('tbl_suratretur', $data, $where);
		if ($up) {
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil diubah!!.</p>
				                </div>');
			redirect(base_url()."Perwakilan/Det_terretur/?no_do=".$this->input->get('no_do'));
		}
	}
	function HapusRetur(){
		$where = array('no_suratretur' => $this->input->get('no_suratretur'), );
		$del_ = $this->m_perwakilan->Delete('tbl_buku_reqretur',$where);
		$del = $this->m_perwakilan->Delete('tbl_suratretur',$where);
		if ($del) {
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil Dihapus!!.</p>
				                </div>');
			redirect(base_url()."Perwakilan/Det_terretur/?no_do=".$this->input->get('no_do'));
		}
	}
	function Cetak(){
		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Perwakilan/view_head');
		$this->load->view('Perwakilan/view_asside', $data);
		$this->load->view('Perwakilan/view_content_cetak',$this->session->userdata('no_suratretur'));
		$this->load->view('Perwakilan/view_footer');
		//redirect(base_url().'Pemasaran/Cetakpdf');

		
	}
	function Cetakpdf(){
		$no_suratretur =  $this->input->post('no_suratretur');
		

        $tabel = $this->m_perwakilan->Cetak($no_suratretur);
		$head = $this->m_perwakilan->Datahead($no_suratretur, $this->session->userdata('kode_admper'));

        $pdf = new pdf_suratretur();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
		//$pdf->SetAutoPageBreak(true, 60); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','A4');
        $pdf->Content();
        $pdf->Output($no_suratretur.'.pdf','D');
	}
	function Ubah_pass(){
		$this->load->view('v_reset_pass');
	}
}
?>