<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Proses extends CI_Controller{
	function __construct(){
		parent::__construct();
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
	}

	function index(){

	}
	function Add_nasional(){
		$data_hidden = $this->input->post('kode_nasional');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_nasional->Getkodenasional();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_nasional' => 'nas_10001',
			        'nama_nasional' => $this->input->post('nama_nasional'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data lebih dari satu
				$kode_nas= $this->m_nasional->getkode();
				$kode = max($kode_nas);
				$kode_nasional = array();
				foreach ($kode as $key) {
					$nas = explode("_", $kode['kode_nasional']);
					array_push($kode_nasional,$nas['1']);
				}
				$kode_asli = max($kode_nasional)+1;

				$data = array(
					'kode_nasional' => 'nas_'.$kode_asli,
			        'nama_nasional' => $this->input->post('nama_nasional'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}
			$data1 = $this->m_nasional->Insert('tbl_mnasional', $data);
			if ($data1){
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');   
			}else{
				 $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Data Gagal di Input!!.</p>
				                </div>');   
			}
			 
	   		redirect(base_url().'Admin/Nasional');
		}else { //update
			$data = array(
			        'nama_nasional' => $this->input->post('nama_nasional'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_nasional' => $data_hidden,
		    );
			$data1 = $this->m_nasional->Update('tbl_mnasional', $data, $where);
			if ($data1){
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');   
			}else{
				 $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Data Gagal di Update!!.</p>
				                </div>');   
			}
			redirect(base_url().'Admin/Nasional');
		}
		

	}
	function Hapus_nasional($kode_nasional){
		$kode_nasional = array('kode_nasional' => $kode_nasional);
		$data = array(
			        'nama_nasional' => '',
			        'email' => '',
			        'no_telp' => '',
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_nasional->Resign('tbl_mnasional', $data, $kode_nasional);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dirubah Menjadi Resign!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Nasional');
		
	}
	function Add_area(){
		$data_hidden = $this->input->post('kode_area');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_area->Getkodearea();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_area' => 'area_10001',
			        'kode_nasional' => $this->input->post('kode_nasional'),
			        'nama_area' => $this->input->post('nama_area'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'area' => $this->input->post('area'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data nomer lebih dari satu
				$kode_area= $this->m_area->getkode();
				$kode = max($kode_area);
				$kode_area1 = array();
				foreach ($kode as $key) {
					$area = explode("_", $kode['kode_area']);
					array_push($kode_area1,$area['1']);
				}
				$kode_asli = max($kode_area1)+1;

				$data = array(
					'kode_area' => 'area_'.$kode_asli,
					'kode_nasional' => $this->input->post('kode_nasional'),
			        'nama_area' => $this->input->post('nama_area'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'area' => $this->input->post('area'),
			        'aktif' => 'Aktif'
		         );
			}
			$data1 = $this->m_area->Insert('tbl_marea', $data);
	   		redirect(base_url().'Admin/Area');
		}else { //update
			$data = array(
			        'nama_area' => $this->input->post('nama_area'),
					'kode_nasional' => $this->input->post('kode_nasional'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'area' => $this->input->post('area'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_area' => $data_hidden,
		    );
			$data1 = $this->m_area->Update('tbl_marea', $data, $where);
		}
		redirect(base_url().'Admin/Area');

	}
	function Hapus_area($kode_area){
		$kode_area = array('kode_area' => $kode_area);
		$data = array(
			        'nama_area' => '',
			        'email' => '',
			        'no_telp' => '',
			        'area' => '',
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_area->Resign('tbl_marea', $data, $kode_area);
	    redirect(base_url().'Admin/Area');
		
	}function Add_perwakilan(){
		$data_hidden = $this->input->post('kode_perwakilan');
		$data_hidden1 = $this->input->post('kode_areanew');
		if (empty($data_hidden)&&empty($data_hidden1)){ //insert
			$kode= $this->m_perwakilan->Getkodeperwakilan();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_perwakilan' => 'kaper_10001',
			        'kode_area' => $this->input->post('kode_area'),
			        'nama_kaper' => $this->input->post('nama_kaper'),
			        'kode_wilayah' => $this->input->post('kode_wilayah'),
			        'alamat_perwakilan' => $this->input->post('alamat_perwakilan'),
			        'email' => strtolower($this->input->post('email')),
			        'kawasan' => $this->input->post('kawasan'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data nomer lebih dari satu
				$kode_perwakilan= $this->m_perwakilan->getkode();
				$kode = max($kode_perwakilan);
				$kode_perwakilan1 = array();
				foreach ($kode as $key) {
					$perwakilan = explode("_", $kode['kode_perwakilan']);
					array_push($kode_perwakilan1,$perwakilan['1']);
				}

				$kode_asli = max($kode_perwakilan1)+1;
				$data = array(
					'kode_perwakilan' => 'kaper_'.$kode_asli,
			        'kode_area' => $this->input->post('kode_area'),
			        'nama_kaper' => $this->input->post('nama_kaper'),
			        'kode_wilayah' => $this->input->post('kode_wilayah'),
			        'alamat_perwakilan' => $this->input->post('alamat_perwakilan'),
			        'email' => strtolower($this->input->post('email')),
			        'kawasan' => $this->input->post('kawasan'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}
			$insert = $this->m_perwakilan->Insert('tbl_perwakilan', $data);
	   		redirect(base_url().'Admin/Perwakilan');

		}else if (!empty($data_hidden) && empty($data_hidden1)) { //update
			$data = array(
			        'kode_area' => $this->input->post('kode_area'),
			        'nama_kaper' => $this->input->post('nama_kaper'),
			        'kode_wilayah' => $this->input->post('kode_wilayah'),
			        'alamat_perwakilan' => $this->input->post('alamat_perwakilan'),
			        'email' => strtolower($this->input->post('email')),
			        'kawasan' => $this->input->post('kawasan'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_perwakilan' => $data_hidden,
		    );
			$update = $this->m_perwakilan->Update('tbl_perwakilan', $data, $where);
			redirect(base_url().'Admin/Perwakilan');
		} else if(empty($data_hidden) && !empty($data_hidden1)){
			$kode_perwakilan= $this->m_perwakilan->getkode();
				$kode = max($kode_perwakilan);
				$kode_perwakilan1 = array();
				foreach ($kode as $key) {
					$perwakilan = explode("_", $kode['kode_perwakilan']);
					array_push($kode_perwakilan1,$perwakilan['1']);
				}

				$kode_asli = max($kode_perwakilan1)+1;
				$data = array(
					'kode_perwakilan' => 'kaper_'.$kode_asli,
			        'kode_area' => $data_hidden1,
			        'nama_kaper' => $this->input->post('nama_kapernew'),
			        'kode_wilayah' => $this->input->post('kode_wilayahnew'),
			        'alamat_perwakilan' => $this->input->post('alamat_perwakilannew'),
			        'email' => strtolower($this->input->post('emailnew')),
			        'kawasan' => $this->input->post('kawasannew'),
			        'no_telp' => $this->input->post('no_telpnew'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
			        'aktif' => 'Tidak Aktif'
		         );
				$data2 = array(
			        'kode_perwakilan' => 'kaper_'.$kode_asli
		         );
				$where = array(
		        'kode_perwakilan' => $this->input->post('kode_perwakilanold'),
		    );
				$insert = $this->m_perwakilan->Insert('tbl_perwakilan', $data);
				$update = $this->m_perwakilan->Update('tbl_perwakilan', $data1, $where);
				$update = $this->m_perwakilan->Update('tbl_handlepemasaran', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_handlekeuangan', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_handlegudang', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_admper', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_sales', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_customer', $data2, $where);
				$update = $this->m_perwakilan->Update('tbl_cvrekanan', $data2, $where);
				redirect(base_url().'Admin/Perwakilan');
		}

	}
	function Add_sales(){
		$data_hidden = $this->input->post('kode_sales');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_sales->Getkodesales();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_sales' => 'sales_10001',
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_sales' => $this->input->post('nama_sales'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data nomer lebih dari satu
				$kode_sales= $this->m_sales->getkode();
				$kode = max($kode_sales);
				$kode_sales1 = array();
				foreach ($kode as $key) {
					$sales = explode("_", $kode['kode_sales']);
					array_push($kode_sales1,$sales['1']);
				}

				$kode_asli = max($kode_sales1)+1;
				$data = array(
					'kode_sales' => 'sales_'.$kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_sales' => $this->input->post('nama_sales'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			}
			$insert = $this->m_sales->Insert('tbl_sales', $data);
	   		redirect(base_url().'Admin/Sales');
		}else { //update
			$data = array(
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_sales' => $this->input->post('nama_sales'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_sales' => $data_hidden,
		    );
			$insert = $this->m_sales->Update('tbl_sales', $data, $where);
		}
		redirect(base_url().'Admin/Sales');

	}
	function Hapus_sales($kode_sales){
		$kode_sales1 = array('kode_sales' => $kode_sales);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_sales->Resign('tbl_sales', $data, $kode_sales1);
	    redirect(base_url().'Admin/Sales');
		
	}
	function Add_admperwakilan(){
		$data_hidden = $this->input->post('kode_admper');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_admperwakilan->Getkodeadmperwakilan();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_admper' => 'admper_10001',
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_admper' => $this->input->post('nama_admper'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'admper_10001',
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '1'
		         );
			}else{ //data nomer lebih dari satu
				$kode_admper= $this->m_admperwakilan->getkode();
				$kode = max($kode_admper);
				$kode_admperwakilan1 = array();
				foreach ($kode as $key) {
					$admperwakilan = explode("_", $kode['kode_admper']);
					array_push($kode_admperwakilan1,$admperwakilan['1']);
				}

				$kode_asli = max($kode_admperwakilan1)+1;
				$data = array(
					'kode_admper' => 'admper_'.$kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_admper' => $this->input->post('nama_admper'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'admper_'.$kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '1'
		         );
			}
		    $user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_admperwakilan->Insert('tbl_admper', $data);
	   		redirect(base_url().'Admin/Adm_perwakilan');
		}else { //update
			$data = array(
			        'nama_admper' => $this->input->post('upnama_admper'),
			        'email' => strtolower($this->input->post('upemail')),
			        'no_telp' => $this->input->post('upno_telp'),
			        'aktif' => 'Aktif'
		         );
			$data1 = array(
			        'username' => strtolower($this->input->post('upemail')),
		         );
			$where = array(
		        'kode_admper' => $data_hidden,
		    );
		     $where1 = array(
		        'kode' => $data_hidden,
		    );
		    $user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_admperwakilan->Update('tbl_admper', $data, $where);
		}
		redirect(base_url().'Admin/Adm_perwakilan');

	}
	function Hapus_admperwakilan($kode_admper){
		$kode_admper1 = array('kode_admper' => $kode_admper);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_admperwakilan->Resign('tbl_admper', $data, $kode_admper1);
	    redirect(base_url().'Admin/Adm_perwakilan');
		
	}
	function Add_pemasaran(){
		$data_hidden = $this->input->post('kode_admpusat');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_pemasaran->Getkodeadmpusat();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_admpusat' => 'pusat_10001',
			        'nama_admpusat' => $this->input->post('nama_admpusat'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'pusat_10001',
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '2'
		         );
			}else{ //data nomer lebih dari satu
				$kode_admpusat= $this->m_pemasaran->getkode();
				$kode = max($kode_admpusat);
				$kode_admpusat1 = array();
				foreach ($kode as $key) {
					$admpusat = explode("_", $kode['kode_admpusat']);
					array_push($kode_admpusat1,$admpusat['1']);
				}
				$kode_asli = max($kode_admpusat1)+1;

				$data = array(
					'kode_admpusat' => 'pusat_'.$kode_asli,
			        'nama_admpusat' => $this->input->post('nama_admpusat'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'pusat_'.$kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '2'
		         );
			}
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_pemasaran->Insert('tbl_admpusat', $data);
	   		redirect(base_url().'Admin/Pemasaran');
		}else { //update
			$data = array(
			        'nama_admpusat' => $this->input->post('nama_admpusat'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$data1 = array(
			        'username' => strtolower($this->input->post('email')),
		         );
			$where = array(
		        'kode_admpusat' => $data_hidden,
		    );
		    $where1 = array(
		        'kode' => $data_hidden,
		    );
		    $user = $this->m_user->Update('tbl_user', $data1, $where1);
			$insert = $this->m_pemasaran->Update('tbl_admpusat', $data, $where);
		}
		redirect(base_url().'Admin/Pemasaran');

	}
	function Hapus_pemasaran($kode_admpusat){
		$kode_admpusat1 = array('kode_admpusat' => $kode_admpusat);
		$kode = array('kode' => $kode_admpusat);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
		$this->m_user->Delete('tbl_user', $kode );
	    $this->m_pemasaran->Resign('tbl_admpusat', $data, $kode_admpusat1);
	    $this->m_pemasaran->Hapus_handle('tbl_handlepemasaran',$kode_admpusat1);
	    redirect(base_url().'Admin/Pemasaran');
		
	}
	function Add_keuangan(){
		$data_hidden = $this->input->post('kode_admkeuangan');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_keuangan->Getadmkeuangan();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_admkeuangan' => 'keu_10001',
			        'nama_admkeuangan' => $this->input->post('nama_admkeuangan'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'keu_10001',
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '3'
		         );
			}else{ //data nomer lebih dari satu
				$kode_admkeuangan= $this->m_keuangan->getkode();
				$kode = max($kode_admkeuangan);
				$kode_admkeuangan1 = array();
				foreach ($kode as $key) {
					$admkeuangan = explode("_", $kode['kode_admkeuangan']);
					array_push($kode_admkeuangan1,$admkeuangan['1']);
				}
				$kode_asli = max($kode_admkeuangan1)+1;

				$data = array(
					'kode_admkeuangan' => 'keu_'.$kode_asli,
			        'nama_admkeuangan' => $this->input->post('nama_admkeuangan'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'keu_'.$kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '3'
		         );
			}
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_keuangan->Insert('tbl_admkeuangan', $data);
	   		redirect(base_url().'Admin/Keuangan');
		}else { //update
			$data = array(
			        'nama_admkeuangan' => $this->input->post('nama_admkeuangan'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$data1 = array(
			        'username' => strtolower($this->input->post('email')),
		         );
			$where = array(
		        'kode_admkeuangan' => $data_hidden,
		    );
		    $where1 = array(
		        'kode' => $data_hidden,
		    );
		    $user = $this->m_user->Update('tbl_user', $data1, $where1);
			$insert = $this->m_keuangan->Update('tbl_admkeuangan', $data, $where);
		}
		redirect(base_url().'Admin/Keuangan');

	}
	function Hapus_keuangan($kode_admkeuangan){
		$kode_admkeuangan1 = array('kode_admkeuangan' => $kode_admkeuangan);
		$kode = array('kode' => $kode_admkeuangan);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
		$this->m_user->Delete('tbl_user', $kode );
	    $this->m_keuangan->Resign('tbl_admkeuangan', $data, $kode_admkeuangan1);
	    $this->m_keuangan->Hapus_handle('tbl_handlekeuangan',$kode_admkeuangan1);
	    redirect(base_url().'Admin/keuangan');
		
	}
	function Add_gudang(){
		$data_hidden = $this->input->post('kode_admgudang');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_gudang->Getadmgudang();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_admgudang' => 'gdg_10001',
			        'nama_admgudang' => $this->input->post('nama_admgudang'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'gdg_10001',
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '4'
		         );
			}else{ //data nomer lebih dari satu
				$kode_admgudang= $this->m_gudang->getkode();
				$kode = max($kode_admgudang);
				$kode_admgudang1 = array();
				foreach ($kode as $key) {
					$admgudang = explode("_", $kode['kode_admgudang']);
					array_push($kode_admgudang1,$admgudang['1']);
				}
				$kode_asli = max($kode_admgudang1)+1;

				$data = array(
					'kode_admgudang' => 'gdg_'.$kode_asli,
			        'nama_admgudang' => $this->input->post('nama_admgudang'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'gdg_'.$kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '4'
		         );
			}
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_gudang->Insert('tbl_admgudang', $data);
	   		redirect(base_url().'Admin/Gudang');
		}else { //update
			$data = array(
			        'nama_admgudang' => $this->input->post('nama_admgudang'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$data1 = array(
			        'username' => strtolower($this->input->post('email')),
		         );
			$where = array(
		        'kode_admgudang' => $data_hidden,
		    );
		    $where1 = array(
		        'kode' => $data_hidden,
		    );
		    $user = $this->m_user->Update('tbl_user', $data1, $where1);
			$insert = $this->m_gudang->Update('tbl_admgudang', $data, $where);
		}
		redirect(base_url().'Admin/Gudang');

	}
	function Hapus_gudang($kode_admgudang){
		$kode_admgudang1 = array('kode_admgudang' => $kode_admgudang);
		$kode = array('kode' => $kode_admgudang);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
		$this->m_user->Delete('tbl_user', $kode );
	    $this->m_gudang->Resign('tbl_admgudang', $data, $kode_admgudang1);
	    $this->m_gudang->Hapus_handle('tbl_handlegudang',$kode_admgudang1);
	    redirect(base_url().'Admin/Gudang');
		
	}
	function Add_produksi(){
		$data_hidden = $this->input->post('kode_admproduksi');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_produksi->Getadmproduksi();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_admproduksi' => 'prod_10001',
			        'nama_admproduksi' => $this->input->post('nama_admproduksi'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'prod_10001',
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '5'
		         );
			}else{ //data nomer lebih dari satu
				$kode_admproduksi= $this->m_produksi->getkode();
				$kode = max($kode_admproduksi);
				$kode_admproduksi1 = array();
				foreach ($kode as $key) {
					$admproduksi = explode("_", $kode['kode_admproduksi']);
					array_push($kode_admproduksi1,$admproduksi['1']);
				}
				$kode_asli = max($kode_admproduksi1)+1;

				$data = array(
					'kode_admproduksi' => 'prod_'.$kode_asli,
			        'nama_admproduksi' => $this->input->post('nama_admproduksi'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => 'prod_'.$kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '12345',
			        'hak_akses' => '5'
		         );
			}
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_produksi->Insert('tbl_admproduksi', $data);
	   		redirect(base_url().'Admin/Produksi');
		}else { //update
			$data = array(
			        'nama_admproduksi' => $this->input->post('nama_admproduksi'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$data1 = array(
			        'username' => strtolower($this->input->post('email')),
		         );
			$where = array(
		        'kode_admproduksi' => $data_hidden,
		    );
		    $where1 = array(
		        'kode' => $data_hidden,
		    );
		    $user = $this->m_user->Update('tbl_user', $data1, $where1);
			$insert = $this->m_produksi->Update('tbl_admproduksi', $data, $where);
		}
		redirect(base_url().'Admin/Produksi');

	}
	function Hapus_produksi($kode_admproduksi){
		$kode_admproduksi1 = array('kode_admproduksi' => $kode_admproduksi);
		$kode = array('kode' => $kode_admproduksi);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
		$this->m_user->Delete('tbl_user', $kode );
	    $this->m_produksi->Resign('tbl_admproduksi', $data, $kode_admproduksi1);
	    redirect(base_url().'Admin/Produksi');
		
	}
	function Add_customer(){
		$data_hidden = $this->input->post('kode_customer');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_customer->Getkodecustomer();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_customer' => 'cust_10001',
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_customer' => $this->input->post('nama_customer'),
			        'alamat_customer' => $this->input->post('alamat_customer'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data nomer lebih dari satu
				$kode_customer= $this->m_customer->Getkode();
				$kode = max($kode_customer);
				$kode_customer1 = array();
				foreach ($kode as $key) {
					$customer = explode("_", $kode['kode_customer']);
					array_push($kode_customer1,$customer['1']);
				}

				$kode_asli = max($kode_customer1)+1;
				$data = array(
					'kode_customer' => 'cust_'.$kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_customer' => $this->input->post('nama_customer'),
			        'alamat_customer' => $this->input->post('alamat_customer'),
			        'aktif' => 'Aktif'
		         );
			}
			$insert = $this->m_customer->Insert('tbl_customer', $data);
	   		redirect(base_url().'Admin/Customer');
		}else { //update
			$data = array(
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_customer' => $this->input->post('nama_customer'),
			        'alamat_customer' => $this->input->post('alamat_customer'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_customer' => $data_hidden,
		    );
			$insert = $this->m_customer->Update('tbl_customer', $data, $where);
		}
		redirect(base_url().'Admin/Customer');

	}
	function Hapus_customer($kode_customer){
		$kode_customer1 = array('kode_customer' => $kode_customer);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_customer->Resign('tbl_customer', $data, $kode_customer1);
	    redirect(base_url().'Admin/Customer');
		
	}

	function Add_cv(){
		$data_hidden = $this->input->post('kode_cv');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_rekanan->Getkodecv();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_cv' => 'cv_10001',
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_cv' => $this->input->post('nama_cv'),
			        'aktif' => 'Aktif'
		         );
			}else{ //data nomer lebih dari satu
				$kode_cv= $this->m_rekanan->Getkode();
				$kode = max($kode_cv);
				$kode_cv1 = array();
				foreach ($kode as $key) {
					$cv = explode("_", $kode['kode_cv']);
					array_push($kode_cv1,$cv['1']);
				}

				$kode_asli = max($kode_cv1)+1;
				$data = array(
					'kode_cv' => 'cv_'.$kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_cv' => $this->input->post('nama_cv'),
			        'aktif' => 'Aktif'
		         );
			}
			$insert = $this->m_rekanan->Insert('tbl_cvrekanan', $data);
	   		redirect(base_url().'Admin/Rekanan');
		}else { //update
			$data = array(
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_cv' => $this->input->post('nama_cv'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_cv' => $data_hidden,
		    );
			$insert = $this->m_customer->Update('tbl_cvrekanan', $data, $where);
		}
		redirect(base_url().'Admin/Rekanan');

	}
	function Hapus_cv($kode_cv){
		$kode_cv1 = array('kode_cv' => $kode_cv);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_rekanan->Resign('tbl_cvrekanan', $data, $kode_cv1);
	    redirect(base_url().'Admin/Rekanan');
		
	}
	function Add_mou(){
		//untuk Penggantian data mou
        $cvold = $this->input->post('kode_cvold');
        $mouold = $this->input->post('no_mouold');
        //untuk perubahan data mou
        $mouedit = $this->input->post('no_mouhidden');
        ///////////////////////////////////////////

        ///////////////////////////////////////////
        //insert
        if(empty($cvold) && empty($mouold) && empty($mouedit)){
        	//insert data post
        	$data = array(
					'no_mou' => $this->input->post('no_mou'),
			        'kode_cv' => $this->input->post('kode_cv'),
			        'tanggal' => $this->input->post('tanggal'),
			        'rabat' => $this->input->post('rabat'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_rekanan->Insert('tbl_mou', $data);
        }
        //update
        else if(empty($cvold) && empty($mouold) && !empty($mouedit)){
        	//update data dengan where $mouedit
        	$where = array('no_mou' => $mouedit, );
        	$data = array(
					'no_mou' => $this->input->post('no_mouedit'),
			        'tanggal' => $this->input->post('tanggaledit'),
			        'rabat' => $this->input->post('rabatedit'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_rekanan->Update('tbl_mou', $data, $where);
        }
        //ganti
        else if(!empty($cvold) && !empty($mouold) && empty($mouedit)){
        	//update data mouold menjadi tidak aktif, buat data baru no_mounew

        	$where = array('no_mou' => $mouold, );
        	$data = array(
					'no_mou' => $this->input->post('no_mounew'),
			        'kode_cv' => $this->input->post('kode_cvold'),
			        'tanggal' => $this->input->post('tanggalnew'),
			        'rabat' => $this->input->post('rabatnew'),
			        'aktif' => 'Aktif'
		         );
        	$data2 = array('aktif' => 'Tidak Aktif', );
			$update = $this->m_rekanan->Update('tbl_mou', $data2, $where);
			$insert = $this->m_rekanan->Insert('tbl_mou', $data);
        }
		redirect(base_url().'Admin/Mou');
	}
	function Add_penerbit(){
		$data_hidden = $this->input->post('kode_penerbit');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_penerbit->Getkodepenerbit();
			if($kode->num_rows()==0){ //data pertama
				$data = array(
					'kode_penerbit' => 'terbit_10001',
			        'nama_penerbit' => $this->input->post('nama_penerbit')
		         );
			}else{ //data lebih dari satu
				$kode_nas= $this->m_penerbit->getkode();
				$kode = max($kode_nas);
				$kode_penerbit = array();
				foreach ($kode as $key) {
					$nas = explode("_", $kode['kode_penerbit']);
					array_push($kode_penerbit,$nas['1']);
				}
				$kode_asli = max($kode_penerbit)+1;

				$data = array(
					'kode_penerbit' => 'terbit_'.$kode_asli,
			        'nama_penerbit' => $this->input->post('nama_penerbit')
		         );
			}
			$data1 = $this->m_penerbit->Insert('tbl_penerbit', $data);
	   		redirect(base_url().'Admin/Penerbit');
		}else { //update
			$data = array(
			        'nama_penerbit' => $this->input->post('nama_penerbit')
		         );
			$where = array(
		        'kode_penerbit' => $data_hidden,
		    );
			$data1 = $this->m_penerbit->Update('tbl_penerbit', $data, $where);
		}
		redirect(base_url().'Admin/Penerbit');

	}
	function Add_buku(){
		$data_hidden = $this->input->post('kode_bukuhidden');
		if (empty($data_hidden)){
			$data = array(
				'kode_buku' => $this->input->post('kode_buku'),
				'kode_penerbit' => $this->input->post('kode_penerbit'),
		        'jenjang' => $this->input->post('jenjang'),
		        'edisi' => $this->input->post('edisi'),
				'kelas' => $this->input->post('kelas'),
				'tipe' => $this->input->post('tipe'),
				'kurikulum' => $this->input->post('kurikulum'),
				'judul' => $this->input->post('judul'),
				'stok_real' => 0,
				'stok_pesan' => 0
	         );
			$data_harga = array(
				'kode_buku' => $this->input->post('kode_buku'),
				'harga_jawa' => $this->input->post('harga_jawa'),
				'harga_luar' => $this->input->post('harga_luar')
	         );

			$data_harga_lalu = array(
				'kode_buku' => $this->input->post('kode_buku'),
				'harga_jawa' => 0,
				'harga_luar' => 0
	         );
					
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
				$data1 = $this->m_buku->Insert('tbl_buku', $data);
				$harga = $this->m_buku->Insert('tbl_harga_'.$tahun_sek, $data_harga);
				$harga2 = $this->m_buku->Insert('tbl_harga_'.$tahun_lalu, $data_harga_lalu);
				$harga2 = $this->m_buku->Insert('tbl_harga_'.$tahun_depan, $data_harga);
			}else if (in_array($tahun_sek, $harga) && in_array($tahun_depan, $harga)){
				//tahun sekarang dan tahun depan
				$data1 = $this->m_buku->Insert('tbl_buku', $data);
				$harga = $this->m_buku->Insert('tbl_harga_'.$tahun_sek, $data_harga);
				$harga2 = $this->m_buku->Insert('tbl_harga_'.$tahun_depan, $data_harga);
			}else if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga)){
				//tahun sekarang, tahun sebelum
				$data1 = $this->m_buku->Insert('tbl_buku', $data);
				$harga = $this->m_buku->Insert('tbl_harga_'.$tahun_sek, $data_harga);
				$harga2 = $this->m_buku->Insert('tbl_harga_'.$tahun_lalu, $data_harga_lalu);
			}else if (in_array($tahun_sek, $harga)){
				//tahun sekarang aja
				$data1 = $this->m_buku->Insert('tbl_buku', $data);
				$harga = $this->m_buku->Insert('tbl_harga_'.$tahun_sek, $data_harga);
			}
   		redirect(base_url().'Admin/Buku');
		}else { //update
			$data = array(
			        'kode_buku' => $this->input->post('kode_bukunew'),
					'kode_penerbit' => $this->input->post('kode_penerbitnew'),
			        'jenjang' => $this->input->post('jenjangnew'),
		        	'edisi' => $this->input->post('edisinew'),
					'kelas' => $this->input->post('kelasnew'),
					'tipe' => $this->input->post('tipenew'),
					'kurikulum' => $this->input->post('kurikulumnew'),
					'judul' => $this->input->post('judulnew')
		         );
			$where = array(
		        'kode_buku' => $data_hidden,
		    );
			$data1 = $this->m_buku->Update('tbl_buku', $data, $where);
		}
		redirect(base_url().'Admin/Buku');

	}
	function Add_paket(){
		$nama_paket = $this->input->post('nama_paket');
		$mkode = $this->m_buku->Getnopaket();
		if(count($mkode) < 1){
				$kode_paket = 'PKT_001';
			}else{
				$angka =  explode('_', $mkode[0]['MAX(kode_paket)']);
				$number = $angka[1];
				$number = sprintf('%03d',$number+1);
				$kode_paket = 'PKT_'.$number;
			}
		$data = array('kode_paket' => $kode_paket,
						'nama_paket' => $nama_paket);
		
		$insert = $this->m_buku->Insert('tbl_paket', $data);
		redirect(base_url().'Admin/Paket');

	}
	function Add_tahun(){
		$tahun = $this->input->post('tahun');
		$sekarang = $tahun-1;
		$data1 = $this->m_tahun->Buat( $tahun);
		$data1 = $this->m_tahun->Insert($tahun,$sekarang);
		redirect(base_url().'Admin/Tahun_depan');
	}
	function Harga(){
		$tahun_depan = $this->input->post('tahun_depan');

		$tahun_sekarang = $this->input->post('tahun_sekarang');

		if(!empty($tahun_depan) && empty($tahun_sekarang)){
			$data = array('harga_jawa' => $this->input->post('depan_jawa'),
						  'harga_luar' => $this->input->post('depan_luar'));

			$where = array('kode_buku' => $this->input->post('kode_bukudepan'));
			$data1 = $this->m_buku->Update('tbl_harga_'.$tahun_depan, $data, $where);
		}else if(empty($tahun_depan) && !empty($tahun_sekarang)){
			$data = array('harga_jawa' => $this->input->post('sekarang_jawa'),
						  'harga_luar' => $this->input->post('sekarang_luar'));

			$where = array('kode_buku' => $this->input->post('kode_bukusekarang'));
			$data1 = $this->m_buku->Update('tbl_harga_'.$tahun_sekarang, $data, $where);
		}
		redirect(base_url().'Admin/Harga');
	}
	function Add_pesanan(){
		date_default_timezone_set("Asia/Jakarta");
		$no_pesanan = $this->input->post('no_pesan');
		$no_mou = $this->input->post('no_mou');
		$kode_customer = $this->input->post('kode_customer');
		$kode_perwakilan = $this->session->userdata('kode_perwakilan');
		$kode_admper = $this->session->userdata('kode_admper');
		$kode_sales = $this->input->post('kode_sales');
		$tanggal = date('Y-m-d');
		$tahun_sek= date('Y');
		$tipe_buku = $this->input->post('tipe_buku');
		$jenjang = $this->input->post('jenjang');
		$sumber_dana = $this->input->post('sumber_dana');
		$nama_penerima = $this->input->post('nama_penerima');
		$alamat_penerima = $this->input->post('alamat_penerima');
		$no_telp = $this->input->post('no_telp');
		$tipe_pesan = 'Jual';
		$proses = 'Menunggu DO';
		$alasan = '-';
		$jenis_pembayaran = $this->input->post('jenis_pembayaran');


		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$data_pesan = array('no_pesanan' => $no_pesanan,
							'no_mou' => $no_mou,
							'kode_customer' => $kode_customer,
							'kode_perwakilan' => $kode_perwakilan,
							'kode_admper' => $kode_admper,
							'kode_sales' => $kode_sales,
							'tanggal' => $tanggal,
							'tahun' => $tahun_sek,
							'tipe_buku' => $tipe_buku,
							'jenjang' => $jenjang,
							'sumber_dana' => $sumber_dana,
							'nama_penerima' => $nama_penerima,
							'alamat_penerima' => $alamat_penerima ,
							'no_telp_penerima' => $no_telp ,
							'tipe_pesan' => $tipe_pesan ,
							'proses' => $proses ,
							'alasan' => $alasan,
							'jenis_pembayaran' => $jenis_pembayaran  );
		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			if ($datajumlah >0){
				array_push($data, array('no_pesanan' => $no_pesanan,
				'jumlah_beli' => $datajumlah,
				'jumlah_kirim' => 0,
				'sisa_kirim' => $datajumlah,
				'kode_buku' => $kode_buku[$no], ));
			}
		$no++;
		}
		if(count($data) > 0){
			$this->m_pesan->save_pesanan($data_pesan);
			$this->m_pesan->save_batch($data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Pesanan Berhasil di Buat...</p>
				                </div>'); 
			redirect(base_url().'Perwakilan/Pesanan');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Pesanan Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/Pesan');
		}
	}
	function Ubah_jumlah(){
		$no_pesanan = $this->input->post('no_pesanan');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');

		$data = array();
		$data_hapus = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			if ($datajumlah > 0){
				array_push($data, array('jumlah_beli' => $datajumlah,
				'jumlah_kirim' => 0,
				'sisa_kirim' => $datajumlah,
				'kode_buku' => $kode_buku[$no], ));
			}else if($datajumlah == 0){
				array_push($data_hapus, array('kode_buku' => $kode_buku[$no]));
			}
		$no++;
		}

		if(count($data) == 0){
			//tidak boleh terhapus semua
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Pesanan Tidak Boleh tanpa Buku!!.</p>
				                </div>');
		}else if(count($data) > 0){
			//update data
			$this->m_pesan->Ubahjumlah($no_pesanan, $data);
			if(count($data_hapus) > 0){
				//hapus data
				$this->m_pesan->Deletbuku($no_pesanan, $data_hapus);
			}
		}
		redirect(base_url().'Perwakilan/Pesanan');
		
	}
	function Tambah_judul(){
		$no_pesanan = $this->input->post('no_pesanan');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');

		$data = array();
		$no =0;
		foreach ($jumlah as $datajumlah) {
			if ($datajumlah >0){
				array_push($data, array('no_pesanan' => $no_pesanan,
				'jumlah_beli' => $datajumlah,
				'jumlah_kirim' => 0,
				'sisa_kirim' => $datajumlah,
				'kode_buku' => $kode_buku[$no], ));
			}
		$no++;
		}
		if(count($data) > 0){
			$this->m_pesan->save_batch($data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Pesanan Berhasil di Tambah...</p>
				                </div>'); 
			redirect(base_url().'Perwakilan/Pesanan');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Pesanan Tidak Beertambah!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/Pesanan');
		}
		
	}


}