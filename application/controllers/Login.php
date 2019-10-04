<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('cookie');
		//hapus saat cookie sudah kadaluarsa
		date_default_timezone_set("Asia/Jakarta");
		$tanggal= date('d-m-Y H:i:s');
		$cek_login = $this->m_login->stay();
		if ($cek_login->num_rows()>0){
			$login=$cek_login->result_array();
			for ($i=0; $i < count($login) ; $i++) { 
				$hour = strtotime($login[$i]['tanggal']);
		        if($hour<=strtotime($tanggal)){
		        	$data  = array('cookie_user' => $login[$i]['cookie_user']);
	        	 	$this->m_login->habis('tbl_login', $data);
	        	 	$cookie_name = 'Username';
					unset($_COOKIE[$cookie_name]);
					$res = setcookie($cookie_name, '', time() - 3600*4);
		        }
			}
		}
		
		
		//batas
	}
	function index(){
		$cookie_user = $this->input->cookie('Username',true);
		if (empty($cookie_user)){
			$this->load->view('v_login');
		}else{
			$cek_cookie = $this->m_login->cookie($cookie_user);
			if($cek_cookie->num_rows()==1){
				$data=$cek_cookie->row_array();
				$cek_user = $this->m_login->user($data['username']);
				$login=$cek_user->row_array();
				$this->session->set_userdata('hak_akses',$login['hak_akses']);
				if($login['hak_akses']=='10'){//admin
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Administrator');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Admin');
					redirect('Admin');
				}else if($login['hak_akses']=='1'){//adm perwakilan
					$cek_admper = $this->m_login->Admper($login['kode']);
					$data = $cek_admper->row_array();
					$this->session->set_userdata('username',$data['nama_admper']);
					$this->session->set_userdata('alamat',$data['alamat_perwakilan']);
					$this->session->set_userdata('kode_wilayah',$data['kode_wilayah']);
					$this->session->set_userdata('kode_perwakilan',$data['kode_perwakilan']);
					$this->session->set_userdata('kode_admper',$data['kode_admper']);
					$this->session->set_userdata('siapa','Admin Perwakilan');
					$this->session->set_userdata('link','Perwakilan');
					redirect('Perwakilan');
				}else if($login['hak_akses']=='2'){//adm Pusat
					$cek_admpusat = $this->m_login->Admpusat($login['kode']);
					$data = $cek_admpusat->row_array();
					$this->session->set_userdata('username',$data['nama_admpusat']);
					$this->session->set_userdata('kode_admpusat',$data['kode_admpusat']);
					$this->session->set_userdata('siapa','Admin Pemasaran');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Pemasaran');
					redirect('Pemasaran');
				}else if($login['hak_akses']=='3'){//adm Keuangan
					$cek_admkeu = $this->m_login->Admkeu($login['kode']);
					$data = $cek_admkeu->row_array();
					$this->session->set_userdata('username',$data['nama_admkeuangan']);
					$this->session->set_userdata('kode_admkeuangan',$data['kode_admkeuangan']);
					$this->session->set_userdata('siapa','Admin Keuangan');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Keuangan');
					redirect('Keuangan');
				}else if($login['hak_akses']=='4'){//adm Gudang
					$cek_admgudang = $this->m_login->Admgudang($login['kode']);
					$data = $cek_admgudang->row_array();
					$this->session->set_userdata('username',$data['nama_admgudang']);
					$this->session->set_userdata('kode_admgudang',$data['kode_admgudang']);
					$this->session->set_userdata('siapa','Admin Gudang');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Gudang');
					redirect('Gudang');
				}else if($login['hak_akses']=='5'){//adm Produksi
					$cek_admproduksi = $this->m_login->Admproduksi($login['kode']);
					$data = $cek_admproduksi->row_array();
					$this->session->set_userdata('username',$data['nama_produksi']);
					$this->session->set_userdata('kode_admproduksi',$data['kode_admproduksi']);
					$this->session->set_userdata('siapa','Admin Produksi');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Produksi');
					redirect('Produksi');
				}else if($login['hak_akses']=='11'){//Co Pemasaran
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Koordinator Pemasaran');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Co_pemasaran');
					redirect('Co_pemasaran');
				}else if($login['hak_akses']=='12'){//Co Keuangan
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Koordinator Keuangan');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Co_keuangan');
					redirect('Co_keuangan');
				}else if($login['hak_akses']=='13'){//Co Gudang
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Koordinator Gudang');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Co_gudang');
					redirect('Co_gudang');
				}else if($login['hak_akses']=='14'){//Direksi
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Direksi');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Direksi');
					redirect('Direksi');
				}else if($login['hak_akses']=='15'){//Pajak
					$this->session->set_userdata('username',$login['username']);
					$this->session->set_userdata('siapa','Pajak');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Pajak');
					redirect('Pajak');
				}
			}else{
				$this->load->view('v_login');
			}
		}
		
	}
	function proses(){
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $pass=htmlspecialchars(md5($this->input->post('pass',TRUE)),ENT_QUOTES);
		$cek_user = $this->m_login->cek($username,$pass);

		if($cek_user->num_rows()==1){
			$cek_login = $this->m_login->login($username);
			if($cek_login->num_rows()==1){
				 redirect(base_url(''));
			}else{
				$user=$cek_user->row_array();

				$cookie_name = 'Username';
				$cookie_value = $username.rand(10,100);
				setcookie($cookie_name, $cookie_value, time() + (3600*4), '/');

				date_default_timezone_set("Asia/Jakarta");
				$tanggal= date('d-m-Y H:i:s', strtotime('+4 hours', strtotime( date('d-m-Y H:i:s') )));
				

			    $data = array(
			        'username' => $username,
			        'cookie_user' => $cookie_value,
			        'tanggal' => $tanggal
		         );

				$data1 = $this->m_login->Insert('tbl_login', $data);

		       	$this->session->set_userdata('hak_akses',$user['hak_akses']);
				if($user['hak_akses']=='10'){//admin
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Administrator');
					$this->session->set_userdata('link','Admin');
					redirect('Admin');
				}else if($user['hak_akses']=='1'){//admin perwakilan
					$cek_admper = $this->m_login->Admper($user['kode']);
					$data = $cek_admper->row_array();
					$this->session->set_userdata('username',$data['nama_admper']);
					$this->session->set_userdata('alamat',$data['alamat_perwakilan']);
					$this->session->set_userdata('kode_perwakilan',$data['kode_perwakilan']);
					$this->session->set_userdata('kode_wilayah',$data['kode_wilayah']);
					$this->session->set_userdata('kode_admper',$data['kode_admper']);
					$this->session->set_userdata('siapa','Admin Perwakilan');
					$this->session->set_userdata('link','Perwakilan');
					redirect('Perwakilan');
				}else if($user['hak_akses']=='2'){//adm Pusat
					$cek_admpusat = $this->m_login->Admpusat($user['kode']);
					$data = $cek_admpusat->row_array();
					$this->session->set_userdata('username',$data['nama_admpusat']);
					$this->session->set_userdata('kode_admpusat',$data['kode_admpusat']);
					$this->session->set_userdata('siapa','Admin Pemasaran');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Pemasaran');
					redirect('Pemasaran');
				}else if($user['hak_akses']=='3'){//adm Keuangan
					$cek_admkeu = $this->m_login->Admgudang($user['kode']);
					$data = $cek_admkeu->row_array();
					$this->session->set_userdata('username',$data['nama_admkeuangan']);
					$this->session->set_userdata('kode_admkeuangan',$data['kode_admkeuangan']);
					$this->session->set_userdata('siapa','Admin Keuangan');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Keuangan');
					redirect('Keuangan');
				}else if($user['hak_akses']=='4'){//adm Gudang
					$cek_admgudang = $this->m_login->Admgudang($user['kode']);
					$data = $cek_admgudang->row_array();
					$this->session->set_userdata('username',$data['nama_admgudang']);
					$this->session->set_userdata('kode_admgudang',$data['kode_admgudang']);
					$this->session->set_userdata('siapa','Admin Gudang');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Gudang');
					redirect('Gudang');
				}else if($user['hak_akses']=='5'){//adm Produksi
					$cek_admproduksi = $this->m_login->Admproduksi($user['kode']);
					$data = $cek_admproduksi->row_array();
					$this->session->set_userdata('username',$data['nama_produksi']);
					$this->session->set_userdata('kode_admproduksi',$data['kode_admproduksi']);
					$this->session->set_userdata('siapa','Admin Produksi');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Produksi');
					redirect('Produksi');
				}else if($user['hak_akses']=='11'){//Co Pemasaran
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Koordinator Pemasaran');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Pajak');
					redirect('Co_pemasaran');
				}else if($user['hak_akses']=='12'){//Co Keuangan
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Koordinator Keuangan');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Co_keuangan');
					redirect('Co_keuangan');
				}else if($user['hak_akses']=='13'){//Co Gudang
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Koordinator Gudang');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Co_gudang');
					redirect('Co_gudang');
				}else if($user['hak_akses']=='14'){//Direksi
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Direksi');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Direksi');
					redirect('Direksi');
				}else if($user['hak_akses']=='15'){//Pajak
					$this->session->set_userdata('username',$user['username']);
					$this->session->set_userdata('siapa','Pajak');
					$this->session->set_userdata('alamat','');
					$this->session->set_userdata('link','Pajak');
					redirect('Pajak');
				}

			}
		}else{
			redirect(base_url());
		}
	}
	function out(){
		$cookie_user = $this->input->cookie('Username',true);
		$data = array('cookie_user' => $cookie_user);
		$this->m_login->habis('tbl_login', $data);
	 	$cookie_name = 'Username';
		unset($_COOKIE[$cookie_name]);
		// empty value and expiration one hour before
		$res = setcookie($cookie_name, '', time() - (3600*4), '/');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	function Ubah_pass(){
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
        $password_konfirmasi=htmlspecialchars($this->input->post('password_konfirmasi',TRUE),ENT_QUOTES);
        if($password == $password_konfirmasi){
        	$data = array('pass' => md5($password), );
        	$where = array('username' => $this->session->userdata('username'), );
			$up = $this->m_login->Update('tbl_user', $data, $where);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Password Berhasil Dirubah!!.</p>
				                </div>');
			redirect(base_url().$this->session->userdata('link'));
        }else{
        	$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal </h4>
				                    <p>Password Gagal dirubah!!.</p>
				                </div>');
        	redirect(base_url().$this->session->userdata('link').'/Ubah_pass');
        }
		
	}
}