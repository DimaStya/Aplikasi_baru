<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
	}
	
	public function Area(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_nasional = $this->input->post('kode_nasional');
		$area = $this->m_form->Getarea($kode_nasional);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Nama Manajer Area--</option>";
		foreach($area as $data){
			$lists .= "<option value='".$data->kode_area."'>".$data->nama_area."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('area'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Perwakilan(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_area = $this->input->post('kode_area');
		$perwakilan = $this->m_form->Getperwakilanform($kode_area);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Alamat Perwakilan--</option>";
		foreach($perwakilan as $data){
			$lists .= "<option value='".$data->kode_perwakilan."'>".$data->alamat_perwakilan."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('perwakilan'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function CVpengajuan(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_perwakilan = $this->input->post('kode_perwakilan');
		$cv = $this->m_form->GetCVpengajuan($kode_perwakilan);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Nama CV--</option>";
		foreach($cv as $data){
			$lists .= "<option value='".$data->kode_cv."'>".$data->nama_cv."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('cv'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Perwakilanadm(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_area = $this->input->post('kode_area');
		$perwakilan = $this->m_form->Getperwakilanadm($kode_area);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Alamat Perwakilan--</option>";
		foreach($perwakilan as $data){
			$lists .= "<option value='".$data->kode_perwakilan."'>".$data->alamat_perwakilan."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('perwakilan'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Mou(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_cv = $this->input->post('kode_cv');
		$mou = $this->m_form->GetMou($kode_cv);
		foreach($mou as $data){
		$callback = array('no_mou'=>$data->no_mou, 'rabat'=>$data->rabat); // Masukan variabel 
		}
		
		//lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Tipebuku(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_penerbit = $this->input->post('kode_penerbit');
		$tipebuku = $this->m_form->Gettipebuku($kode_penerbit);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Tipe Buku--</option>";
		foreach($tipebuku as $data){
			$lists .= "<option value='".$data->tipe."'>".$data->tipe."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('tipe_buku'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Jenjang(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $this->m_form->Getjenjang($kode_penerbit, $tipe_buku);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Jenjang--</option>";
		foreach($jenjang as $data){
			$lists .= "<option value='".$data->jenjang."'>".$data->jenjang."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('jenjang'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Edisi(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $this->m_form->Getedisi($kode_penerbit, $tipe_buku, $jenjang);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Edisi--</option>";
		foreach($edisi as $data){
			$lists .= "<option value='".$data->edisi."'>".$data->edisi."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('edisi'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Kurikulum(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $this->m_form->Getkurikulum($kode_penerbit, $tipe_buku, $jenjang,$edisi);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Kurikulum--</option>";
		foreach($kurikulum as $data){
			$lists .= "<option value='".$data->kurikulum."'>".$data->kurikulum."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('kurikulum'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Buku(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$buku = $this->m_form->Getbuku($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek);
		 $lists = "<thead> 
			 <tr> 
			 <th>No</th> 
			 <th>Kode Buku</th> 
			 <th>Judul Buku</th> 
			 <th>Stok Real</th> 
			 <th>Stok Pesan</th> 
			 <th>Harga Jawa</th> 
			 <th>Harga Luar</th> 
			 <th>Jumlah</th>
			</tr>
			</thead>
			<tbody>";
        $no=1;
        foreach ($buku as $data) {
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td>".$data->stok_real."</td><td>".$data->stok_pesan."</td><td>".$data->harga_jawa."</td><td>".$data->harga_luar."</td><td><input class='form-control' type='text' name='jumlah[]' id='jumlah[]' placeholder='Jumlah' onkeypress='return hanyaAngka(event);'><input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'></td></tr>";
            $no++;
        }
		
		$callback = array('buku'=>$lists.'</tbody>');

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Paket(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		$kode_paket = $data[5];
		$buku = $this->m_form->Getpaket($kode_penerbit, $tipe_buku, $jenjang, $edisi, $kurikulum, $kode_paket);
		 $lists = "<thead> 
			 <tr> 
			 <th>No</th> 
			 <th>Kode Buku</th> 
			 <th>Judul Buku</th> 
			 <th>Tambah</th>
			</tr>
			</thead>
			<tbody>";
        $no=1; 
        foreach ($buku as $data) {
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td><input type='checkbox' name='tambah[]' id='tambah[]'></td></tr>";
            $no++;
        }
		
		$callback = array('buku'=>$lists.'</tbody>');

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
