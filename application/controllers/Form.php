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
	public function Kerjasamapengajuan(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_perwakilan = $this->input->post('kode_perwakilan');
		$kerjasama = $this->m_form->GetKerjasamapengajuan($kode_perwakilan);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Nama Kerjasama--</option>";
		foreach($kerjasama as $data){
			$lists .= "<option value='".$data->kode_kerjasama."'>".$data->nama_kerjasama."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('kerjasama'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}public function Perwakilanadm(){
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
		$sumber_dana = $this->input->post('sumber_dana');
		$lists_mou = "<option value= ''>--Pilih No MoU--</option>";
		$lists_pengajuan = "<option value= ''>--Pilih No Pengajuan--</option>";
		$pengajuand = $this->m_form->GetPengajuandefault();
		foreach($pengajuand as $data1){
			$lists_pengajuan .= "<option value='".$data1->no_pengajuan."'>".$data1->no_pengajuan."</option>";
		}

		if($sumber_dana == "SISWA"){
			$moud = $this->m_form->GetMoudefault();
			$pengajuan = $this->m_form->GetPengajuan($this->session->userdata('kode_perwakilan'));
			foreach($moud as $data1){
			  $lists_mou .= "<option value='".$data1->no_mou."'>".$data1->no_mou."</option>";
			}
			foreach($pengajuan as $data1){
				$lists_pengajuan .= "<option value='".$data1->no_pengajuan."'>".$data1->no_pengajuan."</option>";
			}
		}else{
			$mou = $this->m_form->GetMou($this->session->userdata('kode_perwakilan'));
			$pengajuan = $this->m_form->GetPengajuan($this->session->userdata('kode_perwakilan'));
			foreach($mou as $data){
				$lists_mou .= "<option value='".$data->no_mou."'>".$data->no_mou."</option>";
			}
			foreach($pengajuan as $data1){
			$lists_pengajuan .= "<option value='".$data1->no_pengajuan."'>".$data1->no_pengajuan."</option>";
		}

		}
		$callback = array('no_mou'=>$lists_mou, 'no_pengajuan'=>$lists_pengajuan); 

		echo json_encode($callback);
	}
	public function Cv(){
		$no_mou = $this->input->post('no_mou');
		$cv = $this->m_form->Getcv($no_mou);
		$callback = array('nama_cv'=>$cv['nama_cv']); 
		echo json_encode($callback);

	}
	public function Kerjasama(){
		$no_pengajuan = $this->input->post('no_pengajuan');
		$kerjasama = $this->m_form->Getkerjasama($no_pengajuan);
		$callback = array('nama_kerjasama'=>$kerjasama['nama_kerjasama']); 
		echo json_encode($callback);

	}
	public function Tipebuku(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_penerbit = $this->input->post('kode_penerbit');
		$tipebuku = $this->m_form->Gettipebuku($kode_penerbit);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value= ''>--Pilih Tipe Buku--</option>";
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
		$kawasan = $this->m_form->Getkawasan($this->session->userdata('kode_perwakilan'));
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$buku = $this->m_form->Getbuku($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek, $kawasan['kawasan']);
		 $lists = "";
        $no=1;
        foreach ($buku as $data) {
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td>".$data->stok_real."</td><td>".$data->stok_pesan."</td><td>".$data->harga."</td><td><input class='form-control' type='text' name='jumlah[]' id='jumlah[]' placeholder='Jumlah' onkeypress='return hanyaAngka(event);'><input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'><input type='hidden' name='harga[]' id='harga[]' value='".$data->harga."'></td></tr>";
            $no++;
        }
		
		$callback = array('buku'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Buku_paket(){
		$kawasan = $this->m_form->Getkawasan($this->session->userdata('kode_perwakilan'));
		$kode_paket = explode('&', $this->input->post('data'));
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$buku = $this->m_form->Getbukupaket($kode_paket[0],$tahun_sek, $kawasan['kawasan']);
		 $lists = "<thead> 
		 <tr>
		 <td>Qty</td>
		 <td><input class='form-control' type='text' name='jumlah' id='jumlah' placeholder='Jumlah' onkeypress='return hanyaAngka(event);' required></td>
		 </tr>
			 <tr> 
			 <th>No</th> 
			 <th>Kode Buku</th> 
			 <th>Judul Buku</th> 
			 <th>Stok Real</th> 
			 <th>Stok Pesan</th> 
			 <th>Harga</th>
			</tr>
			</thead>
			<tbody>";
        $no=1;
        foreach ($buku as $data) {
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td>".$data->stok_real."</td><td>".$data->stok_pesan."</td><td>".$data->harga."<input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'><input type='hidden' name='harga[]' id='harga[]' value='".$data->harga."'></td></tr>";
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
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td><input type='checkbox' name='tambah[]' id='tambah[]' value='".$data->kode_buku."'></td></tr>";
            $no++;
        }
		
		$callback = array('buku'=>$lists.'</tbody>');

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Tipebuku_mini(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$kode_penerbit = $this->input->post('kode_penerbit_mini');
		$tipebuku = $this->m_form->Gettipebuku_mini($kode_penerbit,$this->session->userdata('kode_perwakilan'));
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value= ''>--Pilih Tipe Buku--</option>";
		foreach($tipebuku as $data){
			$lists .= "<option value='".$data->tipe."'>".$data->tipe."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('tipe_buku'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Jenjang_mini(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $this->m_form->Getjenjang_mini($kode_penerbit, $tipe_buku, $this->session->userdata('kode_perwakilan'));
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Jenjang--</option>";
		foreach($jenjang as $data){
			$lists .= "<option value='".$data->jenjang."'>".$data->jenjang."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('jenjang'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Edisi_mini(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $this->m_form->Getedisi_mini($kode_penerbit, $tipe_buku, $jenjang, $this->session->userdata('kode_perwakilan'));
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Edisi--</option>";
		foreach($edisi as $data){
			$lists .= "<option value='".$data->edisi."'>".$data->edisi."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('edisi'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Kurikulum_mini(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $this->m_form->Getkurikulum_mini($kode_penerbit, $tipe_buku, $jenjang,$edisi,$this->session->userdata('kode_perwakilan'));
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--Pilih Kurikulum--</option>";
		foreach($kurikulum as $data){
			$lists .= "<option value='".$data->kurikulum."'>".$data->kurikulum."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('kurikulum'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Buku_mini(){
		$kawasan = $this->m_form->Getkawasan($this->session->userdata('kode_perwakilan'));
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$buku = $this->m_form->Getbuku_mini($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum,$tahun_sek, $kawasan['kawasan'],$this->session->userdata('kode_perwakilan'));
		 $lists = "";
        $no=1;
        foreach ($buku as $data) {
        	$lists .= "<tr><td>".$no."</td><td>".$data->kode_buku."</td><td>".$data->judul."</td><td>".$data->stok."</td><td>".$data->stok_pesan."</td><td>".$data->harga."</td><td><input class='form-control' type='number' name='jumlah[]' id='jumlah[]' placeholder='Jumlah' onkeypress='return hanyaAngka(event);' max='".$data->stok."'><input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'><input type='hidden' name='harga[]' id='harga[]' value='".$data->harga."'></td></tr>";
            $no++;
        }
		
		$callback = array('buku'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	public function Buku_oc(){
		$data = explode('&', $this->input->post('data'));
		$kode_penerbit = $data[0];
		$tipe_buku = $data[1];
		$jenjang = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$buku = $this->m_form->Getbuku_oc($kode_penerbit, $tipe_buku, $jenjang,$edisi,$kurikulum);
		 $lists = "";
        $no=1;
        $number = "'number'";
        $text = "'hidden'";
        $min = "'0'";
        $jumlah = "'jumlah[]'";
        $kodebuku = "'kode_buku[]'";
        $checkbox = "'checkbox'";
        $record = "'record'";
        $class = "'form-control'";
        foreach ($buku as $data) {
        	$kode_buku = "'".$data->kode_buku."'";
        	$lists .= '<tr>
        	<td>'.$no.'</td>
        	<td>'.$data->kode_buku.'</td>
        	<td>'.$data->judul.'</td>
        	<td>
        	<button type="button" class="btn-success" name="add'.$no.'" id="add'.$no.'" data-dismiss="modal">Add</button>
        	<input type="hidden" name="kode_buku'.$no.'" id="kode_buku'.$no.'" value="'.$data->kode_buku.'">
        	<input type="hidden" name="judul'.$no.'" id="judul'.$no.'" value="'.$data->judul.'">
        	</td>
        	</tr>
<script>
$("#add'.$no.'").click(function(){            
            var markup = "<tr><td>'.$data->kode_buku.'</td><td>'.$data->judul.'</td><td><input  class='.$class.' type='.$text.' name='.$kodebuku.' id='.$kodebuku.' value='.$kode_buku.' required><input  class='.$class.' type='.$number.' min='.$min.' name='.$jumlah.' id='.$jumlah.' required></td><td><input type='.$checkbox.' name='.$record.'></td></tr>";
            $("#data").append(markup);
        });
        </script>
        	';
            $no++;
        }
		
		$callback = array('buku_oc'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
