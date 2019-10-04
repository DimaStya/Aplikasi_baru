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
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'NAS_001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_nasional)']);
				$number = $angka[1];
				$number = sprintf('%03d',$number+1);
				$kode_asli = 'NAS_'.$number;
			}
			$data = array(
					'kode_nasional' => $kode_asli,
			        'nama_nasional' => $this->input->post('nama_nasional'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
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
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'AREA_001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_area)']);
				$number = $angka[1];
				$number = sprintf('%03d',$number+1);
				$kode_asli = 'AREA_'.$number;
			}
			$data = array(
					'kode_area' => $kode_asli,
					'kode_nasional' => $this->input->post('kode_nasional'),
			        'nama_area' => $this->input->post('nama_area'),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'area' => $this->input->post('area'),
			        'aktif' => 'Aktif'
		         );
			$data1 = $this->m_area->Insert('tbl_marea', $data);
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
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dirubah Menjadi Resign!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Area');
		
	}

	function Add_perwakilan(){
		$data_hidden = $this->input->post('kode_perwakilan');
		$data_hidden1 = $this->input->post('kode_areanew');
		if (empty($data_hidden)&&empty($data_hidden1)){ //insert
			$kode= $this->m_perwakilan->Getkodeperwakilan();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'KAPER_001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_perwakilan)']);
				$number = $angka[1];
				$number = sprintf('%03d',$number+1);
				$kode_asli = 'KAPER_'.$number;
			}
			$data = array(
					'kode_perwakilan' => $kode_asli,
			        'kode_area' => $this->input->post('kode_area'),
			        'nama_kaper' => $this->input->post('nama_kaper'),
			        'kode_wilayah' => $this->input->post('kode_wilayah'),
			        'alamat_perwakilan' => $this->input->post('alamat_perwakilan'),
			        'email' => strtolower($this->input->post('email')),
			        'kawasan' => $this->input->post('kawasan'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_perwakilan->Insert('tbl_perwakilan', $data);
			if ($insert){
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
	   		redirect(base_url().'Admin/Perwakilan');

		}else if (!empty($data_hidden) && empty($data_hidden1)) { //update saat kode perwakilan tidak kosong
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
			if ($update){
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
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
			redirect(base_url().'Admin/Perwakilan');
		} else if(empty($data_hidden) && !empty($data_hidden1)){ //update saat pergantian kaper
			$kode= $this->m_perwakilan->Getkodeperwakilan();
			$kode_ = $kode->row_array();//data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_perwakilan)']);
				$number = $angka[1];
				$number = sprintf('%03d',$number+1);
				$kode_asli = 'KAPER_'.$number;

				$data = array(
					'kode_perwakilan' => $kode_asli,
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
			        'kode_perwakilan' => $kode_asli
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
				$update = $this->m_perwakilan->Update('tbl_stokmini', $data2, $where);
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
				redirect(base_url().'Admin/Perwakilan');
		}

	}

	function Add_sales(){
		$data_hidden = $this->input->post('kode_sales');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_sales->Getkodesales();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'SALES_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_sales)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'SALES_'.$number;
			}
			$data = array(
					'kode_sales' => $kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_sales' => $this->input->post('nama_sales'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_sales->Insert('tbl_sales', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Sales');

	}
	function Hapus_sales($kode_sales){
		$kode_sales1 = array('kode_sales' => $kode_sales);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_sales->Resign('tbl_sales', $data, $kode_sales1);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Sales');
		
	}
	function Add_admperwakilan(){
		$data_hidden = $this->input->post('kode_admper');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_admperwakilan->Getkodeadmperwakilan();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'ADMPER_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_admper)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'ADMPER_'.$number;
			}
			$data = array(
					'kode_admper' => $kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_admper' => strtoupper($this->input->post('nama_admper')),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => $kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '827ccb0eea8a706c4c34a16891f84e7b',
			        'hak_akses' => '1'
		         );
		    $user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_admperwakilan->Insert('tbl_admper', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Adm_perwakilan');

	}
	function Hapus_admperwakilan($kode_admper){
		$kode_admper1 = array('kode_admper' => $kode_admper);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_admperwakilan->Resign('tbl_admper', $data, $kode_admper1);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Adm_perwakilan');
		
	}
	function Add_pemasaran(){
		$data_hidden = $this->input->post('kode_admpusat');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_pemasaran->Getkodeadmpusat();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'PUSAT_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_admpusat)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'PUSAT_'.$number;
			}
			$data = array(
					'kode_admpusat' => $kode_asli,
			        'nama_admpusat' => strtoupper($this->input->post('nama_admpusat')),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => $kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '827ccb0eea8a706c4c34a16891f84e7b',
			        'hak_akses' => '2'
		         );
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_pemasaran->Insert('tbl_admpusat', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Pemasaran');
		
	}
	function Add_keuangan(){
		$data_hidden = $this->input->post('kode_admkeuangan');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_keuangan->Getkodeadmkeuangan();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'KEU_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_admkeuangan)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'KEU_'.$number;
			}
			$data = array(
					'kode_admkeuangan' => $kode_asli,
			        'nama_admkeuangan' => strtoupper($this->input->post('nama_admkeuangan')),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => $kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '827ccb0eea8a706c4c34a16891f84e7b',
			        'hak_akses' => '3'
		         );
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_keuangan->Insert('tbl_admkeuangan', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/keuangan');
		
	}
	function Add_gudang(){
		$data_hidden = $this->input->post('kode_admgudang');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_gudang->Getkodeadmgudang();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'GDG_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_admgudang)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'GDG_'.$number;
			}
			$data = array(
					'kode_admgudang' => $kode_asli,
			        'nama_admgudang' => strtoupper($this->input->post('nama_admgudang')),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => $kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '827ccb0eea8a706c4c34a16891f84e7b',
			        'hak_akses' => '4'
		         );
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_gudang->Insert('tbl_admgudang', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Gudang');
		
	}
	function Add_produksi(){
		$data_hidden = $this->input->post('kode_admproduksi');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_produksi->Getkodeadmproduksi();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'PROD_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_admproduksi)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'PROD_'.$number;
			}
				$data = array(
					'kode_admproduksi' => $kode_asli,
			        'nama_produksi' => strtoupper($this->input->post('nama_admproduksi')),
			        'email' => strtolower($this->input->post('email')),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
				$data1 = array(
					'kode' => $kode_asli,
			        'username' => strtolower($this->input->post('email')),
			        'pass' => '827ccb0eea8a706c4c34a16891f84e7b',
			        'hak_akses' => '5'
		         );
			$user = $this->m_user->Insert('tbl_user', $data1);
			$insert = $this->m_produksi->Insert('tbl_admproduksi', $data);
			if ($insert){
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
	   		redirect(base_url().'Admin/Produksi');
		}else { //update
			$data = array(
			        'nama_produksi' => $this->input->post('nama_admproduksi'),
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Produksi');
		
	}
	function Add_customer(){
		$data_hidden = $this->input->post('kode_customer');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_customer->Getkodecustomer();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'CSTM_00001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_customer)']);
				$number = $angka[1];
				$number = sprintf('%05d',$number+1);
				$kode_asli = 'CSTM_'.$number;
			}
			$data = array(
					'kode_customer' => $kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_customer' => strtoupper($this->input->post('nama_customer')),
			        'alamat_customer' => $this->input->post('alamat_customer'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_customer->Insert('tbl_customer', $data);
			if ($insert){
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Customer');

	}
	function Hapus_customer($kode_customer){
		$kode_customer1 = array('kode_customer' => $kode_customer);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_customer->Resign('tbl_customer', $data, $kode_customer1);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Customer');
		
	}
	function Add_kerjasama(){
		$data_hidden = $this->input->post('kode_kerjasama');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_kerjasama->Getkodekerjasama();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'KJSM_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_kerjasama)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'KJSM_'.$number;
			}
				$data = array(
					'kode_kerjasama' => $kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_kerjasama' => strtoupper($this->input->post('nama_kerjasama')),
			        'alamat_kerjasama' => $this->input->post('alamat_kerjasama'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_rekanan->Insert('tbl_kerjasama', $data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');
	   		redirect(base_url().'Admin/Kerjasama');
		}else { //update
			$data = array(
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_kerjasama' => $this->input->post('nama_kerjasama'),
			        'alamat_kerjasama' => $this->input->post('alamat_kerjasama'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_kerjasama' => $data_hidden,
		    );
			$insert = $this->m_kerjasama->Update('tbl_kerjasama', $data, $where);
			if ($insert){
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
		}
		redirect(base_url().'Admin/Kerjasama');

	}
	function Hapus_kerjasama($kode_kerjasama){
		$kode_kerjasama1 = array('kode_kerjasama' => $kode_kerjasama);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_kerjasama->Resign('tbl_kerjasama', $data, $kode_kerjasama1);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
	    redirect(base_url().'Admin/Kerjasama');
		
	}
	function Add_pengajuan(){
		//untuk Penggantian data mou
        $kerjasamaold = $this->input->post('kode_kerjasamaold');
        $pengajuanold = $this->input->post('no_pengajuanold');
        //untuk perubahan data mou
        $pengajuanedit = $this->input->post('no_pengajuanhidden');
        ///////////////////////////////////////////

        ///////////////////////////////////////////
        //insert
        if(empty($kerjasamaold) && empty($pengajuanold) && empty($pengajuanedit)){
        	//insert data post
        	$data = array(
					'no_pengajuan' => $this->input->post('no_pengajuan'),
			        'kode_kerjasama' => $this->input->post('kode_kerjasama'),
			        'tanggal' => $this->input->post('tanggal'),
			        'rabat' => $this->input->post('rabat'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_pengajuan->Insert('tbl_pengajuan', $data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');
        }
        //update
        else if(empty($kerjasamaold) && empty($pengajuanold) && !empty($pengajuanedit)){
        	//update data dengan where $mouedit
        	$where = array('no_pengajuan' => $pengajuanedit, );
        	$data = array(
					'no_pengajuan' => $this->input->post('no_pengajuanedit'),
			        'tanggal' => $this->input->post('tanggaledit'),
			        'rabat' => $this->input->post('rabatedit'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_pengajuan->Update('tbl_pengajuan', $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
        }
        //ganti
        else if(!empty($kerjasamaold) && !empty($pengajuanold) && empty($pengajuanedit)){
        	//update data mouold menjadi tidak aktif, buat data baru no_mounew

        	$where = array('no_pengajuan' => $pengajuanold, );
        	$data = array(
					'no_pengajuan' => $this->input->post('no_pengajuannew'),
			        'kode_kerjasama' => $this->input->post('kode_kerjasamaold'),
			        'tanggal' => $this->input->post('tanggalnew'),
			        'rabat' => $this->input->post('rabatnew'),
			        'aktif' => 'Aktif'
		         );
        	$data2 = array('aktif' => 'Tidak Aktif', );
			$update = $this->m_pengajuan->Update('tbl_pengajuan', $data2, $where);
			$insert = $this->m_pengajuan->Insert('tbl_pengajuan', $data);
			if ($insert){
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
		redirect(base_url().'Admin/Pengajuan');
	 	}
	}
	function Add_cv(){
		$data_hidden = $this->input->post('kode_cv');
		if (empty($data_hidden)){ //insert
			$kode= $this->m_rekanan->Getkodecv();
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'CV_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_cv)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'CV_'.$number;
			}
				$data = array(
					'kode_cv' => $kode_asli,
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_cv' => strtoupper($this->input->post('nama_cv')),
			        'alamat_cv' => $this->input->post('alamat_cv'),
			        'no_telp' => $this->input->post('no_telp'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_rekanan->Insert('tbl_cvrekanan', $data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');
	   		redirect(base_url().'Admin/Rekanan');
		}else { //update
			$data = array(
			        'kode_perwakilan' => $this->input->post('kode_perwakilan'),
			        'nama_cv' => $this->input->post('nama_cv'),
			        'alamat_cv' => $this->input->post('alamat_cv'),
			        'aktif' => 'Aktif'
		         );
			$where = array(
		        'kode_cv' => $data_hidden,
		    );
			$insert = $this->m_rekanan->Update('tbl_cvrekanan', $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Rekanan');

	}
	function Hapus_cv($kode_cv){
		$kode_cv1 = array('kode_cv' => $kode_cv);
		$data = array(
			        'aktif' => 'Tidak Aktif'
		         );
	    $this->m_rekanan->Resign('tbl_cvrekanan', $data, $kode_cv1);
	    $this->session->set_flashdata('pesan', 
				                '<div class="alert alert-warning">
				                    <h4>Resign </h4>
				                    <p>Data Telah Dihapus!!!</p>
				                </div>'); 
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
			        'fee' => $this->input->post('fee'),
			        'aktif' => 'Aktif'
		         );
			$insert = $this->m_rekanan->Insert('tbl_mou', $data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');
        }
        //update
        else if(empty($cvold) && empty($mouold) && !empty($mouedit)){
        	//update data dengan where $mouedit
        	$where = array('no_mou' => $mouedit, );
        	$data = array(
					'no_mou' => $this->input->post('no_mouedit'),
			        'tanggal' => $this->input->post('tanggaledit'),
			        'fee' => $this->input->post('feeedit'),
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
			        'fee' => $this->input->post('feenew'),
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
			$kode_ = $kode->row_array();
			if($kode->num_rows()==0){ //data pertama
				$kode_asli = 'PNB_0001';
			}else{ //data lebih dari satu
				$angka =  explode('_', $kode_['max(kode_penerbit)']);
				$number = $angka[1];
				$number = sprintf('%04d',$number+1);
				$kode_asli = 'PNB_'.$number;
			}
				$data = array(
					'kode_penerbit' => $kode_asli,
			        'nama_penerbit' => strtoupper($this->input->post('nama_penerbit'))
		         );
			$data1 = $this->m_penerbit->Insert('tbl_penerbit', $data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Input!!.</p>
				                </div>');
	   		redirect(base_url().'Admin/Penerbit');
		}else { //update
			$data = array(
			        'nama_penerbit' => $this->input->post('nama_penerbit')
		         );
			$where = array(
		        'kode_penerbit' => $data_hidden,
		    );
			$data1 = $this->m_penerbit->Update('tbl_penerbit', $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
				'judul' => strtoupper($this->input->post('judul')),
				'stok_real' => 0,
				'stok_pesan' => 0,
				'stok_mini' => 0,
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Buku');

	}
	function Add_paket(){
		$nama_paket = $this->input->post('nama_paket');
		$kode_paket = $this->input->post('kode_paket');
		if(empty($kode_paket)){
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
							'nama_paket' => strtoupper($nama_paket));
			
			$insert = $this->m_buku->Insert('tbl_paket', $data);
		}else{ //update
			$data = array('nama_paket' => $nama_paket, );
			$where = array('kode_paket' => $kode_paket,);
			$update = $this->m_buku->Update('tbl_paket', $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		
		redirect(base_url().'Admin/Paket');

	}
	function Hapus_paket($kode_paket = ''){
		if(!empty($kode_paket)){
			$where = array('kode_paket' => $kode_paket,);
			$insert = $this->m_buku->Delete('tbl_paket', $where);
			redirect(base_url().'Admin/Paket');
		}
	}
	function Add_buku_paket($kode_paket){
		$tambah = $this->input->post('tambah');
		$data_tambah = array();
		foreach ($tambah as $tambah) {
			array_push($data_tambah, array('kode_buku' => $tambah, 'kode_paket' => $kode_paket,));
		}
		if(count($data_tambah)>0){
			$this->m_buku->save_batch('tbl_detpaket', $data_tambah);
		}
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di tambah!!!</p>
				                </div>');
		redirect(base_url('Admin/Detpaket/'.$kode_paket));
		//print_r($data_tambah);
		// for ($i=0; $i < count($this->input->post('tambah'))  ; $i++) { 
		// 	echo $this->input->post('kode_buku')[$i];
		// }
	}
	function Add_tahun(){
		$tahun = $this->input->post('tahun');
		$sekarang = $tahun-1;
		$data1 = $this->m_tahun->Buat( $tahun);
		$data1 = $this->m_tahun->Insert($tahun,$sekarang);
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
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
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}else if(empty($tahun_depan) && !empty($tahun_sekarang)){
			$data = array('harga_jawa' => $this->input->post('sekarang_jawa'),
						  'harga_luar' => $this->input->post('sekarang_luar'));

			$where = array('kode_buku' => $this->input->post('kode_bukusekarang'));
			$data1 = $this->m_buku->Update('tbl_harga_'.$tahun_sekarang, $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di Update!!.</p>
				                </div>');
		}
		redirect(base_url().'Admin/Harga');
	}
	function Add_pesanan(){
		date_default_timezone_set("Asia/Jakarta");
		$no_pesanan = $this->input->post('no_pesan');
		$no_mou = $this->input->post('no_mou');
		$no_pengajuan = $this->input->post('no_pengajuan');
		$kode_customer = $this->input->post('kode_customer');
		$kode_perwakilan = $this->session->userdata('kode_perwakilan');
		$kode_admper = $this->session->userdata('kode_admper');
		$kode_sales = $this->input->post('kode_sales');
		$tanggal = date('Y-m-d');
		$tahun_sek= date('Y');
		$sumber_dana = $this->input->post('sumber_dana');
		$nama_penerima = $this->input->post('nama_penerima');
		$alamat_penerima = $this->input->post('alamat_penerima');
		$keterangan = $this->input->post('keterangan');
		$no_telp = $this->input->post('no_telp');
		$tipe_pesan = 'Jual';
		$proses = 'Menunggu DO';
		$alasan = '-';
		$jenis_pembayaran = $this->input->post('jenis_pembayaran');
		$paket = $this->input->post('kode_paket');
		$stok = $this->input->post('stok');
		if (empty($paket)){
			if($stok == 'stok_real'){
				$tipe_buku = $this->input->post('tipe_buku');
				$jenjang = $this->input->post('jenjang');
			}else if ($stok == 'stok_mini') {
				$tipe_buku = $this->input->post('tipe_buku_mini');
				$jenjang = $this->input->post('jenjang_mini');
			}
		}else if(!empty($paket)){
			$nama_paket = explode('&', $paket);
			$tipe_buku = 'Buku Paket';
			$jenjang = $nama_paket[1];
		}
		

		$kode_buku = $this->input->post('kode_buku');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$data_pesan = array('no_pesanan' => $no_pesanan,
							'no_mou' => $no_mou,
							'no_pengajuan' => $no_pengajuan,
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
							'stok' => $stok ,
							'alasan' => $alasan,
							'jenis_pembayaran' => $jenis_pembayaran,
							'keterangan' => $keterangan  );
		$data = array();
		if (empty($paket)){
			$no =0;
			foreach ($jumlah as $datajumlah) {
				if ($datajumlah >0){
					array_push($data, array('no_pesanan' => $no_pesanan,
					'jumlah_beli' => $datajumlah,
					'harga' => $harga[$no],
					'ket' => $stok,
					'kode_buku' => $kode_buku[$no], ));
				}
			$no++;
			}
		}else if(!empty($paket)){
			$no =0;
			foreach ($kode_buku as $kode_buku) {
				array_push($data, array('no_pesanan' => $no_pesanan,
				'jumlah_beli' => $jumlah,
				'harga' => $harga[$no],
				'ket' => $stok,
				'kode_buku' => $kode_buku, ));
				$no++;
			}
		}
		
		if(count($data) > 0){
			$this->m_pesan->save_pesanan($data_pesan);
			$this->m_pesan->save_batch('tbl_datapesan',$data);
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
	function Add_pesan_stokmini(){
		date_default_timezone_set("Asia/Jakarta");
		$no_stokmini = $this->input->post('no_stokmini');
		$alamat_kirim = $this->input->post('alamat_kirim');
		$keterangan = $this->input->post('keterangan');
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$kode_perwakilan = $this->session->userdata('kode_perwakilan');
		$kode_admper = $this->session->userdata('kode_admper');

		$kode_buku = $this->input->post('kode_buku');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$data_pesan = array('no_stokmini' => $no_stokmini,
							'alamat_kirim' => $alamat_kirim,
							'kode_perwakilan' => $kode_perwakilan,
							'kode_admper' => $kode_admper,
							'tanggal' => $tanggal,
							'keterangan' => $keterangan);
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$data = array();
		if (empty($paket)){
			$no =0;
			foreach ($jumlah as $datajumlah) {
				if ($datajumlah >0){
					array_push($data, array('no_stokmini' => $no_stokmini,
					'jumlah' => $datajumlah,
					'kode_buku' => $kode_buku[$no], ));
				}
			$no++;
			}
		}
		
		if(count($data) > 0){
			$this->m_perwakilan->Insert('tbl_pesan_stokmini',$data_pesan);
			$this->m_pesan->save_batch('tbl_buku_psnstk',$data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Pesanan Berhasil di Buat...</p>
				                </div>'); 
			redirect(base_url().'Perwakilan/Pesanan_stokmini');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Pesanan Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/Pesan_stokmini');
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
	function Add_bkm(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$array_bln= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$no =$this->input->post('no_kas');
		$bank =$this->input->post('bank');
		$nama_penyetor =$this->input->post('nama_penyetor');
		$total =$this->input->post('total');
		$no_kas = $no.'/'.$bulan_sek.'/'.date('Y');
		$data_bkm = array('no_kas' => $no_kas,
						  'bank' => $bank,
						  'nama_penyetor' => $nama_penyetor,
						  'tanggal' => $tanggal,
						  'terpakai' => 0,
						  'kode_admkeuangan' => $this->session->userdata('kode_admkeuangan'),
						  'total' => $total, );
		$in_bkm = $this->m_keuangan->Insert('tbl_kas', $data_bkm);
		if($in_bkm){
			$this->session->set_userdata('no_kas',$no_kas);
			redirect(base_url().'Keuangan/Bayar');
		}
	}
	function Add_retur(){
		date_default_timezone_set("Asia/Jakarta");
		$no_do = $this->input->post('no_do');
		$no_suratjalan = $this->input->post('no_suratjalan');
		$kode_buku = $this->input->post('kode_buku');
		$jum_retur = $this->input->post('jum_retur');
		$harga = $this->input->post('harga');
		$no_suratretur = $this->input->post('no_suratretur');
		$alasan = $this->input->post('alasan');
		$tanggal = date('Y-m-d');		
		$data_suratretur = array(
							'no_suratjalan' => $no_suratjalan[0],
							'tanggal' => $tanggal,
							'no_suratretur' => $no_suratretur,
							'alasan' => $alasan,
							'keterangan' => 'Menunggu Admin');
		$data = array();
		$no =0;
		foreach ($jum_retur as $jum_retur) {
			if($jum_retur > 0){
				array_push($data, array('no_suratretur' => $no_suratretur,
					'no_suratjalan' => $no_suratjalan[$no],
					'no_do' => $no_do[$no],
					'jumlah' => $jum_retur,
					'kode_buku' => $kode_buku[$no],
					'harga' => $harga[$no],));
			}
			
			$no++;
		}
		
		if(count($data) > 0){
			$this->m_perwakilan->Insert('tbl_suratretur',$data_suratretur);
			$this->m_pesan->save_batch('tbl_buku_reqretur',$data);
			$this->session->set_userdata('no_suratretur',$no_suratretur);
			redirect(base_url().'Perwakilan/Cetak');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Retur Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Perwakilan/TerFaktur');
		}
	}

}