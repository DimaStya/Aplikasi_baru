<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {
	private $filename = "import_data"; // Kita tentukan nama filenya
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('M_import');
	}
	
	public function index(){
		
	}
	
	public function form(){
		$data2 = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Admin/view_head');
		$this->load->view('Admin/view_asside', $data2);
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di M_import.php
			$upload = $this->M_import->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->load->view('Admin/view_content_import',$data);
		$this->load->view('Admin/view_footer');
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data_buku = array();
		$data_harga = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data_buku, array(
					'kode_buku'=>$row['A'], 
					'kode_penerbit'=>$row['B'], 
					'judul'=>$row['C'], 
					'edisi'=>$row['D'],
					'jenjang'=>$row['E'],
					'kelas'=>$row['F'],
					'tipe'=>$row['G'],
					'kurikulum'=>$row['H'],
					'stok_real'=>0,
					'stok_pesan'=>0,
					'ukuran_kertas'=>$row['I'],
					'warna_kertas'=>$row['J'],
				));
				array_push($data_harga, array(
					'kode_buku'=>$row['A'], 
					'harga_jawa'=>$row['K'], 
					'harga_luar'=>$row['L'], 
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		
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
				$this->M_import->insert_multiple_buku($data_buku);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_sek,$data_harga);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_lalu,$data_harga);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_depan,$data_harga);

			}else if (in_array($tahun_sek, $harga) && in_array($tahun_depan, $harga)){
				//tahun sekarang dan tahun depan
				$this->M_import->insert_multiple_buku($data_buku);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_sek,$data_harga);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_depan,$data_harga);

			}else if (in_array($tahun_sek, $harga) && in_array($tahun_lalu, $harga)){
				//tahun sekarang, tahun sebelum
				$this->M_import->insert_multiple_buku($data_buku);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_sek,$data_harga);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_lalu,$data_harga);

			}else if (in_array($tahun_sek, $harga)){
				//tahun sekarang aja
				$this->M_import->insert_multiple_buku($data_buku);
				$this->M_import->insert_multiple_harga('tbl_harga_'.$tahun_sek,$data_harga);
			}
		
		
		redirect(base_url().'Admin/Buku'); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}
