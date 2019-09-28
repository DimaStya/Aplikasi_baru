<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Produksi extends CI_Controller{
	function __construct(){
		parent::__construct();
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
				if($user['hak_akses'] !='5'){
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
		$this->load->view('Produksi/view_head');
		$this->load->view('Produksi/view_asside', $data);
		$this->load->view('Produksi/view_content_dashboard');
		$this->load->view('Produksi/view_footer');
	}
	function Order_cetak(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$penerbit = $this->m_pesan->Getpenerbit();
		$kode= '/OC-MDT/'.$bulan_sek.'/'.$tahun_sek;

		$kode_oc = $this->m_produksi->Getkodeoc($kode);
		$nomor = $kode_oc->row_array();
		if ($nomor['max(kode_oc)'] == ''){
			$number = 1;
			$pesan = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(kode_oc)']);
			$number = $no[0];
			$pesan = sprintf('%03d',$number+1).$kode;
		}
		$data2 = array('penerbit' => $penerbit->result_array(),
						'kode_oc' => $pesan,);
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Produksi/view_head');
		$this->load->view('Produksi/view_asside', $data);
		$this->load->view('Produksi/view_content_ordercetak',$data2);
		$this->load->view('Produksi/view_footer');
	}
	function Daftar_oc(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$order_cetak = $this->m_produksi->OC($awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		$data1 = array( 'order_cetak' => $order_cetak->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
	        'angka' => '2',
	        'menu' => '2'
         );
		$this->load->view('Produksi/view_head');
		$this->load->view('Produksi/view_asside', $data);
		$this->load->view('Produksi/view_content_daftaroc',$data1);
		$this->load->view('Produksi/view_footer');

	}
	function Ambil_oc(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$data_oc = $this->m_produksi->OC($awal, $akhir);

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

        foreach ($data_oc->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->kode_oc."</td>
                    <td scope='col'>".$data->nama_produksi."</td>
                    <td scope='col'><button type='button' name='klik".$no."' id='klik".$no."' class='btn btn-success' data-toggle='modal' value='".$data->kode_oc."' data-target='#myModal'>Update</button></td>
<script>
$('#klik".$no."').click(function(){ 
      $('#loading_buk').show();
      $('#buku_oc').hide();

      $.ajax({
        type: 'POST',
        url: '".base_url('Produksi/Ambil_bukuoc')."',
        data: {data : '".$data->kode_oc."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loading_buk').hide();
          $('#buku_oc').html(response.buku_oc).show();
          document.getElementById('kode_oc').innerHTML = '".$data->kode_oc."';
        },
      });
    });
</script>
                    ";
            $no++;
        }
		
		$callback = array('data_oc'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Ambil_bukuoc(){
		$data = $this->input->post('data');
		$data_oc = $this->m_produksi->Buku_oc($data);

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

        foreach ($data_oc->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->kode_buku."</td>
                    <td scope='col'>".$data->judul."</td>
                    <td scope='col'>".$data->jumlah."</td>
                    <td scope='col'>
                    	<input type='number' name='kurang[]' id='kurang[]' min='0' max='".$data->kurang."'>
                    	<input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$data->kode_buku."'>
                    	<input type='hidden' name='kode_oc[]' id='kode_oc[]' value='".$data->kode_oc."'>
                    </td>
                    <td scope='col'>Maksimum Pengurangan ".$data->kurang."</td>";
            $no++;
        }
		
		$callback = array('buku_oc'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	function Add_oc(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$kode_oc = $this->input->post('kode_oc');
		$kode_buku = $this->input->post('kode_buku');
		$jumlah = $this->input->post('jumlah');
		$kode_admproduksi =$this->session->userdata('kode_admproduksi');
		$data_oc = array('kode_oc' => $kode_oc,
							'kode_admproduksi' => $kode_admproduksi,
							'tanggal' => $tanggal,);
		$data = array();
			$no =0;
			foreach ($jumlah as $datajumlah) {
				if ($datajumlah >0){
					array_push($data, array('kode_oc' => $kode_oc,
					'jumlah' => $datajumlah,
					'jadi' => 0,
					'kurang' => $datajumlah,
					'kode_buku' => $kode_buku[$no], ));
				}
			$no++;
			}		
		if(count($data) > 0){
			$this->m_produksi->Insert('tbl_oc',$data_oc);
			$this->m_produksi->save_batch('tbl_buku_oc',$data);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Order Cetak Berhasil di Buat...</p>
				                </div>'); 
			redirect(base_url().'Produksi/Daftar_oc');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Order Cetak Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Produksi/Order_cetak');
		}
	}
	function Update_oc(){
		$kode_oc = $this->input->post('kode_oc');
		$kode_buku = $this->input->post('kode_buku');
		$kurang = $this->input->post('kurang');
		$no =0;
		$data =0;
		foreach ($kurang as $datajumlah) {
			if ($datajumlah >0){
				$up = $this->m_produksi->Updatestok_oc($kode_oc[$no], $kode_buku[$no], $datajumlah);
				$data++;
			}
		$no++;
		}		
		if($data > 0){
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Order Cetak Berhasil di Update...</p>
				                </div>'); 
			redirect(base_url().'Produksi/Daftar_oc');
		}else{
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-danger">
				                    <h4>Gagal !!! </h4>
				                    <p>Order Cetak Tidak Diproses tanpa pemilihan buku!!.</p>
				                </div>');
			redirect(base_url().'Produksi/Daftar_oc');
		}
	}
}
?>