<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Keuangan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf_faktur');
		$this->load->library('pdf_notaretur');

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
				if($user['hak_akses'] !='3'){
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
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_dashboard');
		$this->load->view('Keuangan/view_footer');
	}
	function Suratjalan(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_keuangan->Kawasan($this->session->userdata('kode_admkeuangan'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_keuangan->SJ($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '1'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_sj',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Faktur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_keuangan->Kawasan($this->session->userdata('kode_admkeuangan'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$pesanan = $this->m_keuangan->Faktur($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($pesanan);
		$data1 = array('kawasan' => $datakawasan,
						'pesanan' => $pesanan->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '2',
			        'menu' => '2'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_faktur',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Bkm(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$bkm = $this->m_keuangan->Bkm($this->session->userdata('kode_admkeuangan'), $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($bkm);
		$data1 = array('bkm' => $bkm->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_bkm',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Ttr(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_keuangan->Kawasan($this->session->userdata('kode_admkeuangan'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$ttr = $this->m_keuangan->Ttr($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($ttr);
		$data1 = array('kawasan' => $datakawasan,
						'ttr' => $ttr->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '1'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_ttr',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Nota_retur(){
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_keuangan->Kawasan($this->session->userdata('kode_admkeuangan'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$nota = $this->m_keuangan->Nota_retur($alamat, $awal->format('Y-m-d'), $akhir->format('Y-m-d'));
		//echo $this->db->last_query($ttr);
		$data1 = array('kawasan' => $datakawasan,
						'nota' => $nota->result_array(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$data = array(
			        'angka' => '4',
			        'menu' => '2'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_nota',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Req_update(){
		$kawasan = $this->m_keuangan->Kawasan($this->session->userdata('kode_admkeuangan'));
		$datakawasan = $kawasan->result_array();
		$perwakilan = $kawasan->num_rows();
		if($perwakilan == 0){
			$alamat = '';
		}else{
			$alamat = $datakawasan[0]['kode_wilayah'];
		}
		$req_update = $this->m_keuangan->Req_update($alamat);
		//echo $this->db->last_query($ttr);
		$data1 = array('kawasan' => $datakawasan,
						'requpdate' => $req_update->result_array(),);
		$data = array(
			        'angka' => '4',
			        'menu' => '3'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_requpdate',$data1);
		$this->load->view('Keuangan/view_footer');
	}
	function Report_fakturnr(){
		$data = array(
			        'angka' => '5',
			        'menu' => '1'
		         );
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan= $this->m_report->Kawasan();
		$data1 = array('kawasan' => $kawasan->result(),
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'));
		$this->load->view('Report/view_head');
		$this->load->view('Co_keuangan/view_asside', $data);
		$this->load->view('Report/view_content_fakturnr', $data1);
		$this->load->view('Report/view_footer');
	}
	function Bayar(){
		$no_kas = $this->input->post('no_kas');
		date_default_timezone_set("Asia/Jakarta");
		$akhir= new DateTime('last day of this month');
		$awal = new DateTime('first day of this month');
		$kawasan = $this->m_keuangan->Kawasan_bkm();
		$tahun = $this->m_keuangan->Tahun();
		$datakawasan = $kawasan->result_array();
		if($this->session->userdata('no_kas') == Null && $no_kas == Null){
			redirect(base_url().'Keuangan/Bkm');
		}else if($no_kas != Null){		
			$bkm = $this->m_keuangan->Bkm_dat($no_kas);
		//echo $this->db->last_query($bkm);
		}else if($this->session->userdata('no_kas') != Null){
			$bkm = $this->m_keuangan->Bkm_dat($this->session->userdata('no_kas'));
		}
		$data1 = array('kawasan' => $datakawasan,
						'tahun' => $tahun,
						'bkm' => $bkm,
						'awal' => $awal->format('Y-m-d'),
 						'akhir' => $akhir->format('Y-m-d'),);
		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_bayar',$data1);
		$this->load->view('Keuangan/view_footer');
		
	}
	function Detail_bayar(){
		$no_kas = $this->input->post('no_kas');
		$pembayaran = $this->m_keuangan->Pembayaran($no_kas);
		$data1 = array('pembayaran' => $pembayaran,);
		$data = array(
			        'angka' => '3',
			        'menu' => '0'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_pembayaran',$data1);
		$this->load->view('Keuangan/view_footer');
		
	}
	function Pembayaran(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$pembayaran = $this->input->post('pembayaran');
		$no_faktur = $this->input->post('no_faktur');
		$kode_piutang = $this->input->post('kode_piutang');
		$no_kas = $this->input->post('no_kas');
		$data = array();
		$no =0;
		foreach ($pembayaran as $pembayaran) {
			if ($pembayaran >0){
				array_push($data, array(
					'no_faktur' => $no_faktur[$no],
					'kode_piutang' => $kode_piutang[$no],
					'no_kas' => $no_kas,
					'total' => $pembayaran,
					'tanggal' => $tanggal,));
			}
		$no++;
		}
		$in_pembayaran = $this->m_keuangan->save_batch('tbl_pembayaran', $data);
		if($in_pembayaran){
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil di input!!.</p>
				                </div>');
			redirect('Keuangan/Bkm');
		}
	}
	function DetailFaktur(){
		$suratjalan = $this->m_keuangan->Detail_Sj($this->input->post('SJ'));
		$buku_sj = $this->m_keuangan->Buku_Sj($this->input->post('SJ'));
		$ambil_kode = explode('/', $this->input->post('SJ'));
		//echo $this->db->last_query($suratjalan);
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$kode= '/FT-MDT/'.$ambil_kode[2].'/'.$bulan_sek.'/'.$tahun_sek;

		$no_faktur = $this->m_pesan->Getnofaktur($kode);
		$nomor = $no_faktur->row_array();
		if ($nomor['max(no_faktur)'] == ''){
			$number = 1;
			$faktur = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_faktur)']);
			$number = $no[0];
			$faktur = sprintf('%03d',$number+1).$kode;
		}
		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$data_sj = array('head' => $suratjalan,
						 'no_faktur' => $faktur,
						 'buku_sj' => $buku_sj,
						 'tanggal_faktur' => $tanggal );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_detailfaktur', $data_sj);
		$this->load->view('Keuangan/view_footer');
	}
	function Proses_faktur(){
		date_default_timezone_set("Asia/Jakarta");
		$tahun_sek= date('Y');
		$data_faktur = array('no_faktur' => $this->input->post('no_faktur'),
							 'kode_admkeuangan' => $this->session->userdata('kode_admkeuangan'),
							 'no_suratjalan' => $this->input->post('no_suratjalan'),
							 'tanggal' => $this->input->post('tanggal_faktur'),
							 'harga_tahun' => $tahun_sek,
							 'tenggang' => $this->input->post('tenggang'),
							 'bruto' => $this->input->post('bruto'),
							 'netto' => $this->input->post('netto'),);

		$data_piutang = array('kode_piutang' => $this->input->post('no_faktur'),
							  'no_faktur' => $this->input->post('no_faktur'),
							  'jumlah' => $this->input->post('netto'),
							  'terbayar' => 0,
							  'kurang' => $this->input->post('netto'),
							  'fee' => $this->input->post('fee'),
							  'status_hutang' => 'Cicil', );
		$in_faktur = $this->m_keuangan->Insert('tbl_faktur', $data_faktur);
		if($in_faktur){
			$in_piutang = $this->m_keuangan->Insert('tbl_piutang', $data_piutang);
			if($in_piutang){
				$this->session->set_userdata('no_faktur',$this->input->post('no_faktur'));
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil diproses!!</p>
				                </div>');
				redirect('Keuangan/Cetak');
			}
		}
	}
	function Hapus_bayar(){
		$no_kas = $this->input->post('no_kas');
		$no_faktur = $this->input->post('no_faktur');
		$tanggal = $this->input->post('tanggal');
		$total = $this->input->post('total');
		$del_bayar = $this->m_keuangan->Delete_bayar($no_kas, $no_faktur, $tanggal, $total);
		$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil dihapus!!.</p>
				                </div>');
		redirect('Keuangan/Bkm');

	}
	function Ambil_data(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_keuangan->SJ($kode_wilayah, $awal, $akhir);
		
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
                  </tr>';
        $no=1;
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_suratjalan."</td>
                    <td scope='col'><button name='SJ' value='".$data->no_suratjalan."' type='submit' class='btn btn-info'>Detail</button></td></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_dataF(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_keuangan->Faktur($kode_wilayah, $awal, $akhir);
		
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
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_suratjalan."</td>
                    <td scope='col'>".$data->no_faktur."</td>
                    <td scope='col'><button name='no_faktur' value='".$data->no_faktur."' type='submit' class='btn btn-info'>Cetak Faktur</button></td></td>
                    <td scope='col'>".$data->nama_customer."</td>
                    <td scope='col'>".$data->nama_cv."</td>
                    <td scope='col'>".$data->nama_sales."</td>
                    <td scope='col'>".$data->nama_kaper."</td>
                    <td scope='col'>".$data->nama_penerima."</td>
                    <td scope='col'>".$data->no_telp_penerima."</td>
                    <td scope='col'>".$data->alamat_penerima."</td>";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}function Ambil_faktur(){
		$data = explode('&', $this->input->post('data'));
		$no_faktur = $data[0].'/FT-MDT/'.$data[1].'/'.$data[2].'/'.$data[3];
		$faktur = $this->m_keuangan->Amb_fak($no_faktur);
		//echo $this->db->last_query($faktur);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Plih
		$lists = '';
        $no=1;
        foreach ($faktur->result() as $data) {
        	$lists .= "<tr>
        				<td>".$data->no_faktur."</td>
        				<td>".$data->tanggal."</td>
        				<td>".$data->alamat_perwakilan."</td>
        				<td>".$data->netto."</td>
        				<td>".$data->kurang."</td>
        				<td>
        					<input type='hidden' name='no_faktur' id='no_faktur' value='".$data->no_faktur."'>
        					<input type='hidden' name='kode_piutang' id='kode_piutang' value='".$data->kode_piutang."'>
        					<input type='hidden' name='tanggal' id='tanggal' value='".$data->tanggal."'>
        					<input type='hidden' name='alamat_perwakilan' id='alamat_perwakilan' value='".$data->alamat_perwakilan."'>
        					<input type='hidden' name='netto' id='netto' value='".$data->netto."'>
        					<input type='hidden' name='kurang' id='kurang' value='".$data->kurang."'>

        				</td>
        			  </tr>";
            $no++;
        }
		
		$callback = array('data_faktur'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_ttr(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_keuangan->Ttr($kode_wilayah, $awal, $akhir);
		
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
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_faktur."</td>
                    <td scope='col'>".$data->kode_retur."</td>
                    <td scope='col'>".$data->alasan."</td>
                    <td scope='col'><button type='button' name='pencet".$no."' id='pencet".$no."' value='".$data->kode_retur."' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Cek SJ</button></td>
<script>
$('#pencet".$no."').click(function(){ 
      $('#loadingklik').show();
      $('#ttr').hide();
      $.ajax({
        type: 'POST',
        url: '".base_url('Keuangan/Data_ttr')."',
        data: {data : '".$data->kode_retur."'}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#ttr').html(response.ttr).show();
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
	function Ambil_nota(){
		$data = explode('&', $this->input->post('data'));
		$kode_wilayah = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pesanan = $this->m_keuangan->Nota_retur($kode_wilayah, $awal, $akhir);
		
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
        foreach ($pesanan->result() as $data) {
        	if ($data->keterangan == 'Admin Telah Menerima') {
        		$hapus = "<button type='button' class='btn btn-danger' onclick='pencet".$no."()'>Hapus</button>
                        <script type='text/javascript'>
                            function pencet".$no."(){
                              var r = confirm('Yakin Nota Dihapus?');
                              if(r == true){
                                window.location = '".base_url()."Keuangan/Hapus_nota/?dari=hapus&&no_notaretur=".$data->no_notaretur."';
                              }
                            }
                          </script>";
        	}else{
        		$hapus = '';
        	}
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_notaretur."</td>
                    <td scope='col'>".$data->kode_retur."</td>
                    <td scope='col'>".$data->no_faktur."</td>
                    <td scope='col'>".$data->alasan."</td>
                    <td scope='col'>
                        <form action='".base_url()."Keuangan/Cetakpdf_notaretur/' method='POST'>
                        <button name='no_notaretur' id='no_notaretur' value='".$data->no_notaretur."' type='submit' class='btn btn-info'>Download</button></form></td>
                    <td scope='col'>
                    		".$hapus."
                        </td>
                        ";
            $no++;
        }
		
		$callback = array('data_pesanan'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Ambil_requpdate(){
		$kode_wilayah = $this->input->post('data');
		$pesanan = $this->m_keuangan->Req_update($kode_wilayah);
		
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
        foreach ($pesanan->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->tanggal."</td>
                    <td scope='col'>".$data->no_notaretur."</td>
                    <td scope='col'>".$data->kode_retur."</td>
                    <td scope='col'>
                        <form action='".base_url()."Keuangan/Hapus_nota/update/' method='GET'>
                        <button name='no_notaretur' id='no_notaretur' value='".$data->no_notaretur."' type='submit' class='btn btn-warning'>Update</button></form></td>

                        ";
            $no++;
        }
		
		$callback = array('data_requpdate'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Data_ttr(){
		$kode_retur = $this->input->post('data');
		$ambil_kode = explode('/', $kode_retur);
		$head = $this->m_keuangan->Detail_Ttr($kode_retur);
		$table = $this->m_keuangan->buku_ttr($kode_retur);

		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$tahun_sek= date('Y');
		$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan_sek= $array_bln[date('n')];
		$kode= '/NR-MDT/'.$ambil_kode[2].'/'.$bulan_sek.'/'.$tahun_sek;
		$no_notaretur = $this->m_pesan->Getnotaretur($kode);
		$nomor = $no_notaretur->row_array();
		if ($nomor['max(no_notaretur)'] == ''){
			$number = 1;
			$nota_retur = sprintf('%03d',$number).$kode;
		}else{
			$no = explode('/', $nomor['max(no_notaretur)']);
			$number = $no[0];
			$nota_retur = sprintf('%03d',$number+1).$kode;
		}
		if($head['kode_cv'] == 'Tanpa CV'){
        	$nama =  $head['nama_customer'];
        	$alamat =  $head['alamat_customer'];
        	$telp =  $head['telp_cust'];
      	}else{
        	$nama =  $head['nama_cv'];
        	$alamat =  $head['alamat_cv'];
        	$telp =  $head['telp_cv'];
      	}
      	$list = '';
	$no =1;
    $jumlah_buku = 0;
    $harga_bruto = 0;
    $harga_nett = 0;
    $harga_fee = 0;
    foreach ($table as $table) {
    	$netto = $table->harga -($table->harga*$head['rabat']/100);
    	$fee = $netto*$head['fee']/100;
	    $jumlah_buku = $jumlah_buku + $table->jumlah;
	    $harga_bruto = $harga_bruto + ($table->harga*$table->jumlah);
	    $harga_nett = $harga_nett + ($netto*$table->jumlah);
	    $harga_fee = $harga_fee + ($fee*$table->jumlah);
    	$list .= '<tr>
    	<td>'.$no.'</td>
    	<td>'.$table->kode_buku.'</td>
    	<td>'.$table->judul.'</td>
    	<td>'.$table->jenjang.'</td>
    	<td>'.$table->edisi.'</td>
    	<td>'.$table->jumlah.'</td>
    	<td>'.number_format($table->harga,0,',','.').'</td>
    	<td>'.number_format($netto,0,',','.').'</td>
    	<td>'.number_format($fee,0,',','.').'</td>
    	<td>'.number_format($table->harga*$table->jumlah,0,',','.').'</td>
    	<td>'.number_format($netto*$table->jumlah,0,',','.').'</td>
    	<td>'.number_format($fee*$table->jumlah,0,',','.').'</td>
    	</tr>';
    $no++;}
    $list .= '<tr>
    	<td colspan="5" align="center"><b>Grand Total</b></td>
    	<td><b>'.$jumlah_buku.'</b></td>
    	<td colspan="3"></td>
		<input type="hidden" name="harga_bruto" id="harga_bruto" value="'.$harga_bruto.'">
		<input type="hidden" name="harga_nett" id="harga_nett" value="'.$harga_nett.'">
		<input type="hidden" name="harga_fee" id="harga_fee" value="'.$harga_fee.'">
    	<td><b>'.number_format($harga_bruto,0,',','.').'</b></td>
    	<td><b>'.number_format($harga_nett,0,',','.').'</b></td>
    	<td><b>'.number_format($harga_fee,0,',','.').'</b></td>
    </tr>';
$lists = '<center  size="6"><b>NOTA RETUR</b></center><br>
<form action="'.base_url().'Keuangan/Simpan_notaretur/" method="POST">
<table>
	<tr>
		<td colspan="2">Kepada Yth:</td>
		<td width="12%"></td>
		<td width="12%">No Nota Retur</td>
		<input type="hidden" name="nota_retur" id="nota_retur" value="'.$nota_retur.'">
		<input type="hidden" name="kode_retur" id="kode_retur" value="'.$kode_retur.'">
		<td width="18%">: '.$nota_retur.'</td>
		<td width="8%"></td>
	</tr>
	<tr>
		<td colspan="2">Bapak/Ibu '.$nama.'</td>
		<td></td>
		<td>Tanggal Retur</td>
		<input type="hidden" name="tanggal" id="tanggal" value="'.$tanggal.'">
		<td>: '.$tanggal.'</td>
	</tr>
	<tr>
		<td colspan="2">'.$alamat.' </td>
		<td></td>
		<td>No TTR</td>
		<td>: '.$head['kode_retur'].'</td>
	</tr>
	<tr>
		<td colspan="2">'.$telp.' </td>
		<td></td>
		<td>Tanggal TTR</td>
		<td>: '.$head['tanggal'].'</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td></td>
		<td>Nama CV / Cust</td>
		<td>: '.$head['nama_cv'].' / '.$head['nama_customer'].'</td>
	</tr>
	<tr>
		<td width="12%">Nama Pelanggan</td>
		<td width="12%">: '.$head['nama_penerima'].'</td>
		<td></td>
		<td>Sales</td>
		<td>: '.$head['nama_sales'].'</td>
	</tr>
	<tr>
		<td>No Telp Plg</td>
		<td>: '.$head['no_telp_penerima'].'</td>
		<td></td>
		<td>Koordinator</td>
		<td>: '.$head['nama_kaper'].'</td>
	</tr>
	<tr>
		<td>Alasan Retur</td>
		<td>: '.$head['alasan'].'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
</br>
<style>
th{
vertical-align:middle}
</style>
<table class="table table-bordered table-striped">
	<tr>
	  <th rowspan="2" class="text-center" valign="midle">No</th>
	  <th rowspan="2" class="text-center">Kode Buku</th>
	  <th rowspan="2" class="text-center">Judul</th>
	  <th rowspan="2" class="text-center">Jenjang</th>
	  <th rowspan="2" class="text-center">Edisi</th>
	  <th rowspan="2" class="text-center">Qty</th>
	  <th colspan="3" class="text-center">Rabat: '.$head['rabat'].'% Fee: '.$head['fee'].'%</th>
	  <th colspan="3" class="text-center">Total</th>
	</tr>
	<tr>
	  <th class="text-center">Bruto</th>
	  <th class="text-center">Netto</th>
	  <th class="text-center">Fee</th>
	  <th class="text-center">Bruto</th>
	  <th class="text-center">Netto</th>
	  <th class="text-center">Fee</th>
	</tr>
	'.$list.'
</table>
<i>
<table>

<tr>
  <td rowspan="3" valign="Top"  width="70px">Terbilang &nbsp;</td>
  <td valign="Top" width="50px"><b>Bruto</b> &nbsp;</td>
  <td valign="Top">:&nbsp;</td>
  <td valign="Top">'.$this->terbilang($harga_bruto).' Rupiah</td>
</tr>
<tr>
  <td valign="Top"  width="50px"><b>Netto</b> &nbsp;</td>
  <td valign="Top"> :&nbsp;</td>
  <td valign="Top">'.$this->terbilang($harga_nett).' Rupiah</td> 
</tr>
<tr>
  <td valign="Top"  width="50px"><b>Fee</b> &nbsp;</td>
  <td valign="Top"> :&nbsp;</td>
  <td valign="Top">'.$this->terbilang($harga_fee).' Rupiah</td>
</tr>
</table></i>
<button type="submit" class="btn btn-success pull-right">Proses Nota</button>
</form>
';
	
		//echo $lists;
		$callback = array('ttr'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Simpan_notaretur(){
		$no_notaretur =  $this->input->post('nota_retur');
		$kode_retur =  $this->input->post('kode_retur');
		$tanggal =  $this->input->post('tanggal');
		$bruto =  $this->input->post('harga_bruto');
		$netto =  $this->input->post('harga_nett');
		$fee =  $this->input->post('harga_fee');

		$data_nota = array('no_notaretur' => $no_notaretur,
							'kode_retur' => $kode_retur,
							'tanggal' => $tanggal,
							'bruto' => $bruto,
							'netto' => $netto,
							'fee' => $fee,
							 );
		$in_faktur = $this->m_keuangan->Insert('tbl_notaretur', $data_nota);
		if($in_faktur){
			$this->session->set_userdata('no_notaretur',$no_notaretur);
			$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-info">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil disimpan!!.</p>
				                </div>');
			redirect('Keuangan/Cetak_notaretur');
		}
	}
	function Ambil_databkm(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$bkm = $this->m_keuangan->Bkm($this->session->userdata('kode_admkeuangan'), $awal, $akhir);
		
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
        foreach ($bkm->result() as $data) {
        	$lists .= "<tr class='GridViewScrollItem'>
        			<td scope='col'>".$no."</td>
                    <td scope='col'>".$data->no_kas."</td>
                    <td scope='col'>".$data->nama_penyetor."</td>
                    <td scope='col'>".$data->bank."</td>
                    <td scope='col'  align='right'>".number_format($data->total,0,',','.')."</td>
                    <td scope='col'  align='right'>".number_format($data->terpakai,0,',','.')."</td>
                    <td>
                      <form action='".base_url()."Keuangan/Bayar/' method='POST'>
                        <button type='submit' class='btn-info' name='no_kas' id='no_kas' value='".$data->no_kas."'><i class='fa fa-fw fa-pencil-square-o'></i>Kelola</button>
                      </form>
                    </td>
                    <td>
                      <form action='".base_url()."'Keuangan/Detail_bayar/' method='POST'>
                        <button type='submit' class='btn-success' name='no_kas' id='no_kas' value='".$data->no_kas.">'><i class='fa fa-fw fa-list-alt'></i>Detail</button>
                      </form>
                    </td>

                        ";
            $no++;
        }
		
		$callback = array('data_bkm'=>$lists);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}
	function Hapus_nota($dari){
		$no_notaretur =  $this->input->get('no_notaretur');
		$where = array('no_notaretur' => $no_notaretur, );
		$del_nota = $this->m_keuangan->Delete('tbl_notaretur', $where);
		if($del_nota){
			if($dari =='hapus'){
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil dihapus!!.</p>
				                </div>');
				redirect('Keuangan/Nota_retur');
			}else if($dari == 'update'){
				$this->session->set_flashdata('pesan', 
				                '<div class="alert alert-success">
				                    <h4>Berhasil </h4>
				                    <p>Data Berhasil diupdate!!.</p>
				                </div>');
				redirect('Keuangan/Req_update');
			}
		}
	}
	function Cetak(){
		$data = array(
			        'angka' => '2',
			        'menu' => '0'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_cetak',$this->session->userdata('no_faktur'));
		$this->load->view('Keuangan/view_footer');		
	}function Cetak_notaretur(){
		$data = array(
			        'angka' => '4',
			        'menu' => '0'
		         );
		$this->load->view('Keuangan/view_head');
		$this->load->view('Keuangan/view_asside', $data);
		$this->load->view('Keuangan/view_content_cetak_notaretur',$this->session->userdata('no_notaretur'));
		$this->load->view('Keuangan/view_footer');		
	}
	function Cetakpdf(){
		$no_faktur =  $this->input->post('no_faktur');
		

        $tabel = $this->m_keuangan->Cetak($no_faktur);
		$head = $this->m_keuangan->Datahead($no_faktur, $this->session->userdata('kode_admkeuangan'));

        $pdf = new PDF_FAKTUR();
        global $title;
        $title = array('head' => $head->row_array(),
						'tabel' => $tabel->result_array());
        $pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(true, 50); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_faktur.'.pdf','D');
	}
	function Cetakpdf_notaretur(){
		$no_notaretur =  $this->input->post('no_notaretur');
		

        $tabel = $this->m_keuangan->Buku_notaretur($no_notaretur);
		$head = $this->m_keuangan->Detail_notaretur($no_notaretur, $this->session->userdata('kode_admkeuangan'));

        $pdf = new PDF_notaretur();
        global $title;
        $title = array('head' => $head,
						'tabel' => $tabel);
        $pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(true, 50); //untuk sj, faktur, retur ttd di footer
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_notaretur.'.pdf','D');
	}
	function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = $this->penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
      $temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " Seratus" . $this->penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " Seribu" . $this->penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = $this->penyebut($nilai/1000000000) . " Milyar" . $this->penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = $this->penyebut($nilai/1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
  function terbilang($nilai) {
	    if($nilai<0) {
	      $hasil = "minus ". trim($this->penyebut($nilai));
	    } else if($nilai==0) {
	      $hasil = "Nol";
	    } else{
	      $hasil = trim($this->penyebut($nilai));
	    }        
	    return $hasil;
	}
	function Ubah_pass(){
		$this->load->view('v_reset_pass');
	}
}
?>