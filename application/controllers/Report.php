<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Report extends CI_Controller{
	function __construct(){
		parent::__construct();
        $this->load->library('excel');
	}

	function index(){

	}
	function Get_sales(){
		$perwakilan = $this->input->post('data');

		$sales = $this->m_report->Getsales($perwakilan);
		$lists = "<option value=''>All</option>";
		foreach($sales->result() as $data){
			$lists .= "<option value='".$data->kode_sales."'>".$data->nama_sales."</option>"; 
		}
		$callback = array('data'=>$lists);
		echo json_encode($callback);
	}
	function Get_customer(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$sales = $data[1];

		$customer = $this->m_report->Getcustomer($perwakilan, $sales);
		$lists = "<option value=''>All</option>";
		foreach($customer->result() as $data){
			$lists .= "<option value='".$data->kode_customer."'>".$data->nama_customer."</option>"; 
		}
		$callback = array('data'=>$lists);
		echo json_encode($callback);
	}
	function Get_cv(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$sales = $data[1];
		$customer = $data[2];

		$sales = $this->m_report->Getcv($perwakilan, $sales, $customer);
		$lists = "<option value=''>All</option>";
		foreach($sales->result() as $data){
			$lists .= "<option value='".$data->kode_cv."'>".$data->nama_cv."</option>"; 
		}
		$callback = array('data'=>$lists);
		echo json_encode($callback);
	}
	function Cari_sales(){
		$perwakilan = $this->input->post('data');
		if(empty($perwakilan)){
			$sales = $this->m_report->Cari_sales_all();
		}else{
			$sales = $this->m_report->Cari_sales($perwakilan);
		}
		$lists = "";
		$no=1;
		foreach($sales->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->nama_sales."</td>
				<td>".$data->alamat_perwakilan."</td>
				<td>".$data->nama_kaper."</td>
				<td>".$data->no_telp."</td>
				<td>".$data->aktif."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_customer(){
		$perwakilan = $this->input->post('data');
		if(empty($perwakilan)){
			$customer = $this->m_report->Cari_customer_all();
		}else{
			$customer = $this->m_report->Cari_customer($perwakilan);
		}
		$lists = "";    ;
		$no=1;
		foreach($customer->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->nama_customer."</td>
				<td>".$data->alamat_perwakilan."</td>
				<td>".$data->alamat_customer."</td>
				<td>".$data->no_telp."</td>
				<td>".$data->aktif."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_rekanan(){
		$perwakilan = $this->input->post('data');
		if(empty($perwakilan)){
			$rekanan = $this->m_report->Cari_rekanan_all();
		}else{
			$rekanan = $this->m_report->Cari_rekanan($perwakilan);
		}
		$lists = "";    ;
		$no=1;
		foreach($rekanan->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->nama_cv."</td>
				<td>".$data->alamat_perwakilan."</td>
				<td>".$data->alamat_cv."</td>
				<td>".$data->no_telp."</td>
				<td>".$data->aktif."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_stok(){
		$data = explode('&', $this->input->post('data'));
		$penerbit = $data[0];
		$jenjang = $data[1];
		$tipe = $data[2];
		$edisi = $data[3];
		$kurikulum = $data[4];
		$stok = $this->m_report->Cari_stok($penerbit, $jenjang, $tipe, $edisi, $kurikulum);
		//echo $this->db->last_query($stok);
		$lists = ''; 
		$no=1;
		foreach($stok->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->kode_buku."</td>
				<td>".$data->judul."</td>
				<td>".$data->edisi."</td>
				<td>".$data->jenjang."</td>
				<td>".$data->kurikulum."</td>
				<td>".$data->stok_real."</td>
				<td>".$data->stok_pesan."</td>
				<td>".$data->stok_oc."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_oc(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$oc = $this->m_report->Cari_oc($awal, $akhir);
		$lists = '';
		$no=1;
		foreach($oc->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->tanggal."</td>
				<td>".$data->kode_oc."</td>
				<td>".$data->kode_buku."</td>
				<td>".$data->judul."</td>
				<td>".$data->jumlah."</td>
				<td>".$data->jadi."</td>
				<td>".$data->kurang."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_lpb(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$lpb = $this->m_report->Cari_lpb($awal, $akhir);
		$lists = '';
		$no=1;
		foreach($lpb->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->tanggal."</td>
				<td>".$data->kode_lpb."</td>
				<td>".$data->kode_buku."</td>
				<td>".$data->judul."</td>
				<td>".$data->kode_oc."</td>
				<td>".$data->total."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_pesanan(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$sales = $data[1];
		$customer = $data[2];
		$cv_rekanan = $data[3];
		$awal = $data[4];
		$akhir = $data[5];

		//ambil pesanan
		$alokasiproduk = $this->m_report->Cari_pesanan($perwakilan, $sales, $customer, $cv_rekanan, $awal, $akhir);
		//$lists = $this->db->last_query($alokasiproduk);
        $no=0;
        $no_buk = 0;
        $data_ = [];
		foreach($alokasiproduk->result() as $data){
			$data_[$no]['tanggal']=$data->tanggal;
			$data_[$no]['nama_sales']=$data->nama_sales;
			$data_[$no]['nama_customer']=$data->nama_customer;
			$data_[$no]['nama_cv']=$data->nama_cv;
			$data_[$no]['no_do']=$data->no_do;
			$data_[$no]['no_mou']=$data->no_mou;
			$data_[$no]['no_pengajuan']=$data->no_pengajuan;
			if($data->sj == 'Sudah SJ' && $data->faktur =='Sudah FT'){
				$sjft = $this->m_report->sjyfty($data->no_do);
			}else if($data->sj == 'Sudah SJ' && $data->faktur =='Belum FT'){
				$sjft = $this->m_report->sjyftn($data->no_do);
			}else if($data->sj == 'Belum SJ' && $data->faktur =='Belum FT'){
				$sjft = $this->m_report->sjnftn($data->no_do);
			}
		$alokasi_buku = $this->m_report->Cari_pesanan_buku($data->no_do);
		$jum_sj = $sjft->num_rows();
		$jum_buk = $alokasi_buku->num_rows();
		$tbl_sj = $sjft->result_array();
		if($jum_sj > $jum_buk){

		}else if($jum_sj < $jum_buk){
			$nu=0;
			foreach($alokasi_buku->result() as $data_buku){
				if($no_buk == $no && $jum_sj > $nu){
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']=$tbl_sj[$nu]['no_suratjalan'];
					$data_[$no_buk]['no_faktur']=$tbl_sj[$nu]['no_faktur'];
				}else if ($no_buk > $no && $jum_sj > $nu){
					$data_[$no_buk]['tanggal']='';
					$data_[$no_buk]['nama_sales']='';
					$data_[$no_buk]['nama_customer']='';
					$data_[$no_buk]['nama_cv']='';
					$data_[$no_buk]['no_do']='';
					$data_[$no_buk]['no_mou']='';
					$data_[$no_buk]['no_pengajuan']='';
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']=$tbl_sj[$nu]['no_suratjalan'];
					$data_[$no_buk]['no_faktur']=$tbl_sj[$nu]['no_faktur'];
				}else if ($no_buk > $no && $jum_sj <= $nu){
					$data_[$no_buk]['tanggal']='';
					$data_[$no_buk]['nama_sales']='';
					$data_[$no_buk]['nama_customer']='';
					$data_[$no_buk]['nama_cv']='';
					$data_[$no_buk]['no_do']='';
					$data_[$no_buk]['no_mou']='';
					$data_[$no_buk]['no_pengajuan']='';
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']='';
					$data_[$no_buk]['no_faktur']='';
				}
			$nu++;
			$no_buk++;}
		}
		$no = $no_buk;}
		$lists ='';
		for ($i=0; $i < count($data_); $i++) {
			$lists .="<tr  class='GridViewScrollItem'>
				<td scope='col'>".$data_[$i]['tanggal']."</td>
				<td scope='col'>".$data_[$i]['nama_sales']."</td>
				<td scope='col'>".$data_[$i]['nama_customer']."</td>
				<td scope='col'>".$data_[$i]['nama_cv']."</td>
				<td scope='col'>".$data_[$i]['no_do']."</td>
				<td scope='col'>".$data_[$i]['no_mou']."</td>
				<td scope='col'>".$data_[$i]['no_pengajuan']."</td>
				<td scope='col'>".$data_[$i]['no_suratjalan']."</td>
				<td scope='col'>".$data_[$i]['no_faktur']."</td>
				<td scope='col'>".$data_[$i]['kode_buku']."</td>
				<td scope='col'>".$data_[$i]['judul']."</td>
				<td scope='col'>".$data_[$i]['jumlah_beli']."</td>
				<td scope='col'>".$data_[$i]['jumlah_kirim']."</td>
				<td scope='col'>".$data_[$i]['sisa_kirim']."</td>
				<td scope='col'>".$data_[$i]['batal']."</td>
			</tr>";
		}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_alokasiproduk(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$jenis = $data[2];
		$lists = '';
	if($jenis == 'detail'){
		$lpb = $this->m_report->Cari_alokasiproduk($awal, $akhir);
		$data = $lpb->result_array();
		
		for ($i=0; $i < count($data); $i++) {
			$no = $i-1;
			if($no < 0 && $i==0){
				$jumlah_beli = $data[$i]['jumlah_beli'];
				$jumlah_kirim = $data[$i]['jumlah_kirim'];
				$batal = $data[$i]['batal'];
				$lists .= "<tr> 
						<td>".$data[$i]['kode_buku']."</td>
						<td>".$data[$i]['judul']."</td>
						<td>".$data[$i]['nama_customer']."</td>
						<td>".$data[$i]['nama_cv']."</td>
						<td>".$data[$i]['no_do']."</td>
						<td>".$data[$i]['jumlah_beli']."</td>
						<td>".$data[$i]['jumlah_kirim']."</td>
						<td>".$data[$i]['batal']."</td>
					</tr>";
			}else if($i == (count($data)-1)){
				if($jumlah_beli == 0){
					$jumlah_beli = $data[$i]['jumlah_beli'];
					$jumlah_kirim = $data[$i]['jumlah_kirim'];
					$batal = $data[$i]['batal'];
				}
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Grand Total=====></b></td>
					<td><b>".$jumlah_beli."</b></td>
					<td><b>".$jumlah_kirim."</b></td>
					<td><b>".$batal."</b></td>
				</tr>";
			}else if ($data[$no]['kode_buku']==$data[$i]['kode_buku']) {
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td>".$data[$i]['nama_customer']."</td>
					<td>".$data[$i]['nama_cv']."</td>
					<td>".$data[$i]['no_do']."</td>
					<td>".$data[$i]['jumlah_beli']."</td>
					<td>".$data[$i]['jumlah_kirim']."</td>
					<td>".$data[$i]['batal']."</td>
				</tr>";
			}else if($data[$no]['kode_buku'] != $data[$i]['kode_buku']){
				if($jumlah_beli == 0){
					$jumlah_beli = $data[$i]['jumlah_beli'];
					$jumlah_kirim = $data[$i]['jumlah_kirim'];
					$batal = $data[$i]['batal'];
				}
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Grand Total=====></b></td>
					<td><b>".$jumlah_beli."</b></td>
					<td><b>".$jumlah_kirim."</b></td>
					<td><b>".$batal."</b></td>
				</tr>";
				$jumlah_beli = 0;
				$jumlah_kirim = 0;
				$batal = 0;
				$lists .= "<tr> 
					<td>".$data[$i]['kode_buku']."</td>
					<td>".$data[$i]['judul']."</td>
					<td>".$data[$i]['nama_customer']."</td>
					<td>".$data[$i]['nama_cv']."</td>
					<td>".$data[$i]['no_do']."</td>
					<td>".$data[$i]['jumlah_beli']."</td>
					<td>".$data[$i]['jumlah_kirim']."</td>
					<td>".$data[$i]['batal']."</td>
				</tr>";
				$jumlah_beli = $data[$i]['jumlah_beli'];
				$jumlah_kirim = $data[$i]['jumlah_kirim'];
				$batal = $data[$i]['batal'];
			}
			
		}
	}else if($jenis == 'global'){
		$lpb = $this->m_report->Cari_alokasiprodukglobal($awal, $akhir);
		foreach ($lpb->result() as $data) {
			$lists .= "<tr> 
						<td>".$data->kode_buku."</td>
						<td>".$data->judul."</td>
						<td>".$data->nama_customer."</td>
						<td>".$data->nama_cv."</td>
						<td>".$data->no_do."</td>
						<td>".$data->jumlah_beli."</td>
						<td>".$data->jumlah_kirim."</td>
						<td>".$data->batal."</td>
					</tr>";
		}
	}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_fakturnr(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$awal = $data[1];
		$akhir = $data[2];

		//ambil pesanan
		$fakturnr = $this->m_report->Cari_fakturnr($perwakilan, $awal, $akhir);
		//$lists = $this->db->last_query($alokasiproduk);
        $no=0;
        $data_ = [];
		foreach($fakturnr->result() as $data){
			$data_[$no]['tanggal']=$data->tanggal;
			$data_[$no]['nama_sales']=$data->nama_sales;
			$data_[$no]['nama_customer']=$data->nama_customer;
			$data_[$no]['nama_cv']=$data->nama_cv;
			$data_[$no]['no_faktur']=$data->no_faktur;
			$data_[$no]['rabat']=$data->rabat;
			$data_[$no]['nilai_fee']=$data->nilai_fee;
			$data_[$no]['bruto']=$data->bruto;
			$data_[$no]['netto']=$data->netto;
			$data_[$no]['terbayar']=$data->terbayar;
			$data_[$no]['kurang']=$data->kurang;
			$data_[$no]['kurang']=$data->kurang;
			$data_[$no]['fee']=$data->fee;
			if($data->no_notaretur == Null){
				$data_[$no]['no_notaretur']='Tanpa Retur';
				$data_[$no]['retur_bruto']=0;
				$data_[$no]['retur_netto']=0;
			}else{
				$nota_retur = $this->m_report->Nota_retur($data->no_faktur);
				$data_[$no]['no_notaretur']=$nota_retur['no_notaretur'];
				$data_[$no]['retur_bruto']=$nota_retur['retur_bruto'];
				$data_[$no]['retur_netto']=$nota_retur['retur_netto'];
			}
			if($data->bkm == 'Ada BKM'){
				$bkm = $this->m_report->Bkm($data->no_faktur);
				if ($bkm->num_rows() > 0) {
					$data_bkm =$bkm->row_array();
					$data_[$no]['no_bkm']=$data_bkm['no_kas'];
					$data_[$no]['jumlah_bkm']=$data_bkm['total'];
					$no ++;
				}else{
					$nu =0;
					foreach ($bkm->result_array() as $data) {
						if ($nu == 0 ) {
							$data_[$no]['no_bkm']=$data_bkm[0]['no_kas'];
							$data_[$no]['jumlah_bkm']=$data_bkm[0]['total'];
						}else{
							$data_[$no]['no_bkm']=$data_bkm[$nu]['no_kas'];
							$data_[$no]['jumlah_bkm']=$data_bkm[$nu]['total'];
							$data_[$no]['tanggal']='';
							$data_[$no]['nama_sales']='';
							$data_[$no]['nama_customer']='';
							$data_[$no]['nama_cv']='';
							$data_[$no]['no_faktur']='';
							$data_[$no]['rabat']='';
							$data_[$no]['nilai_fee']='';
							$data_[$no]['bruto']=0;
							$data_[$no]['netto']=0;
							$data_[$no]['terbayar']=0;
							$data_[$no]['kurang']=0;
							$data_[$no]['fee']=0;
							$data_[$no]['no_notaretur']=0;
							$data_[$no]['retur_bruto']=0;
							$data_[$no]['retur_netto']=0;
						}
					$nu++;$no ++;}
				}
			}else if($data->bkm == 'Belum BKM'){
				$data_[$no]['no_bkm']='Belum ada Pembayaran';
				$data_[$no]['jumlah_bkm']=0;
			}
		}
		$lists ='';
		for ($i=0; $i < count($data_); $i++) {
			$lists .="<tr  class='GridViewScrollItem'>
				<td scope='col'>".$data_[$i]['tanggal']."</td>
				<td scope='col'>".$data_[$i]['nama_sales']."</td>
				<td scope='col'>".$data_[$i]['nama_customer']."</td>
				<td scope='col'>".$data_[$i]['nama_cv']."</td>
				<td scope='col'>".$data_[$i]['no_faktur']."</td>
				<td scope='col'>".$data_[$i]['rabat']." %</td>
				<td scope='col'>".$data_[$i]['nilai_fee']." %</td>
				<td scope='col'>Rp ".number_format($data_[$i]['bruto'],0,',','.')."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['netto'],0,',','.')."</td>
				<td scope='col'>".$data_[$i]['no_notaretur']."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['retur_bruto'],0,',','.')."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['retur_netto'],0,',','.')."</td>
				<td scope='col'>".$data_[$i]['no_bkm']."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['jumlah_bkm'],0,',','.')."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['terbayar'],0,',','.')."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['kurang'],0,',','.')."</td>
				<td scope='col'>Rp ".number_format($data_[$i]['fee'],0,',','.')."</td>
			</tr>";
		}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}	
	function Cari_pengajuan(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$pengajuan = $this->m_report->Cari_pengajuan($perwakilan, $awal, $akhir);
		$lists = '';
		$no=1;
		foreach($pengajuan->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->tanggal."</td>
				<td>".$data->nama_kerjasama."</td>
				<td>".$data->no_pengajuan."</td>
				<td>".$data->rabat." %</td>
				<td>".$data->aktif."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_mou(){
		$data = explode('&', $this->input->post('data'));
		$perwakilan = $data[0];
		$awal = $data[1];
		$akhir = $data[2];
		$mou = $this->m_report->Cari_mou($perwakilan, $awal, $akhir);
		$lists = '';
		$no=1;
		foreach($mou->result() as $data){
			$lists .= "<tr>
				<td>".$no."</td>
				<td>".$data->tanggal."</td>
				<td>".$data->nama_cv."</td>
				<td>".$data->no_mou."</td>
				<td>".$data->fee." %</td>
				<td>".$data->aktif."</td>
			</tr>";
		$no++;}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}
	function Cari_sjttr(){
		$data = explode('&', $this->input->post('data'));
		$awal = $data[0];
		$akhir = $data[1];
		$jenis = $data[2];
		$lists = '';
	if($jenis == 'detail'){
		$sjttr = $this->m_report->Cari_sjttr($awal, $akhir);
		$data = $sjttr->result_array();
		
		for ($i=0; $i < count($data); $i++) {
			$no = $i-1;
			if($no < 0 && $i==0){
				$jumlah = $data[$i]['jumlah'];
				$retur = $data[$i]['retur'];
				$lists .= "<tr> 
						<td>".$data[$i]['kode_buku']."</td>
						<td>".$data[$i]['judul']."</td>
						<td>".$data[$i]['nama_customer']."</td>
						<td>".$data[$i]['nama_cv']."</td>
						<td>".$data[$i]['no_suratjalan']."</td>
						<td>".$data[$i]['kode_retur']."</td>
						<td>".$data[$i]['jumlah']."</td>
						<td>".$data[$i]['retur']."</td>
					</tr>";
			}else if($i == (count($data)-1)){
				if($jumlah == 0){
					$jumlah = $data[$i]['jumlah'];
					$retur = $data[$i]['retur'];
				}
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Grand Total=====></b></td>
					<td><b>".$jumlah."</b></td>
					<td><b>".$retur."</b></td>
				</tr>";
			}else if ($data[$no]['kode_buku']==$data[$i]['kode_buku']) {
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td>".$data[$i]['nama_customer']."</td>
					<td>".$data[$i]['nama_cv']."</td>
					<td>".$data[$i]['no_suratjalan']."</td>
					<td>".$data[$i]['kode_retur']."</td>
					<td>".$data[$i]['jumlah']."</td>
					<td>".$data[$i]['retur']."</td>
				</tr>";
			}else if($data[$no]['kode_buku'] != $data[$i]['kode_buku']){
				if($jumlah == 0){
					$jumlah = $data[$i]['jumlah'];
					$retur = $data[$i]['retur'];
				}
				$lists .="<tr> 
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Grand Total=====></b></td>
					<td><b>".$jumlah."</b></td>
					<td><b>".$retur."</b></td>
				</tr>";
				$jumlah = 0;
				$retur = 0;
				$lists .= "<tr> 
					<td>".$data[$i]['kode_buku']."</td>
					<td>".$data[$i]['judul']."</td>
					<td>".$data[$i]['nama_customer']."</td>
					<td>".$data[$i]['nama_cv']."</td>
					<td>".$data[$i]['no_suratjalan']."</td>
					<td>".$data[$i]['kode_retur']."</td>
					<td>".$data[$i]['jumlah']."</td>
					<td>".$data[$i]['retur']."</td>
				</tr>";
				$jumlah = $data[$i]['jumlah'];
				$retur = $data[$i]['retur'];
			}
			
		}
	}else if($jenis == 'global'){
		$sjttr = $this->m_report->Cari_sjttrglobal($awal, $akhir);
		foreach ($sjttr->result() as $data) {
			$lists .= "<tr> 
						<td>".$data->kode_buku."</td>
						<td>".$data->judul."</td>
						<td>".$data->nama_customer."</td>
						<td>".$data->nama_cv."</td>
						<td>".$data->no_suratjalan."</td>
						<td>".$data->kode_retur."</td>
						<td>".$data->jumlah."</td>
						<td>".$data->retur."</td>
					</tr>";
		}
	}
		
		$callback = array('data'=>$lists);

		echo json_encode($callback);
	}





##############################################################################	
	// create xlsx
    public function Excel_sales() {
        // create file name
        $perwakilan = $this->input->post('perwakilan');
        if(empty($perwakilan)){
			$sales = $this->m_report->Cari_sales_all();
			$fileName = 'data_sales_all';
		}else{
			$sales = $this->m_report->Cari_sales($perwakilan);
			$fileName = 'data_sales_'.$perwakilan;
		}
          
        // load excel library
        $listInfo = $sales->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Sales');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Alamat Perwakilan');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Nama Kaper');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'no_telp');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');     
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama_sales);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->alamat_perwakilan);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->nama_kaper);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "'".$list->no_telp);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->aktif);
            $rowCount++;
            $no++;
        }
        $fileName = $fileName. ".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_customer() {
        // create file name
        $perwakilan = $this->input->post('perwakilan');
        if(empty($perwakilan)){
			$customer = $this->m_report->Cari_customer_all();
			$fileName = 'data_customer_all';
		}else{
			$customer = $this->m_report->Cari_customer($perwakilan);
			$fileName = 'data_customer_'.$perwakilan;
		}
          
        // load excel library
        $listInfo = $customer->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Perwakilan');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Alamat');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'no_telp');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');     
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama_customer);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->alamat_perwakilan);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->alamat_customer);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "'".$list->no_telp);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->aktif);
            $rowCount++;
            $no++;
        }
        $fileName = $fileName. ".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_rekanan() {
        // create file name
        $perwakilan = $this->input->post('perwakilan');
        if(empty($perwakilan)){
			$rekanan = $this->m_report->Cari_rekanan_all();
			$fileName = 'data_rekanan_all';
		}else{
			$rekanan = $this->m_report->Cari_rekanan($perwakilan);
			$fileName = 'data_rekanan_'.$perwakilan;
		}
          
        // load excel library
        $listInfo = $rekanan->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama CV Rekanan');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Perwakilan');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Alamat');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'no_telp');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');     
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama_cv);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->alamat_perwakilan);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->alamat_cv);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "'".$list->no_telp);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->aktif);
            $rowCount++;
            $no++;
        }
        $fileName = $fileName. ".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_stok() {
        // create file name
		$penerbit = $this->input->post('penerbit');
		$jenjang = $this->input->post('jenjang');
		$tipe = $this->input->post('tipe');
		$edisi = $this->input->post('edisi');
		$kurikulum = $this->input->post('kurikulum');
		$stok = $this->m_report->Cari_stok($penerbit, $jenjang, $tipe, $edisi, $kurikulum);
          
        // load excel library
        $listInfo = $stok->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Kode Buku');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Judul');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Edisi');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Jenjang');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kurikulum');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Stok Real');     
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Stok Pesan');     
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Stok OC');       
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->kode_buku);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->judul);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->edisi);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->jenjang);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kurikulum);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->stok_real);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list->stok_pesan);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $list->stok_oc);
            $rowCount++;
            $no++;
        }
        $fileName =  "Report_Stok.xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_oc() {
        // create file name
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$oc = $this->m_report->Cari_oc($awal, $akhir);
          
        // load excel library
        $listInfo = $oc->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'No OC');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kode Buku');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Judul');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Jumlah OC');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Jumlah Jadi');     
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Kekurangan');       
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->tanggal);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->kode_oc);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->kode_buku);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->judul);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->jumlah);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->jadi);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list->kurang);
            $rowCount++;
            $no++;
        }
        $fileName =  "Report_OC(".$awal."-".$akhir.").xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_lpb() {
        // create file name
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$lpb = $this->m_report->Cari_lpb($awal, $akhir);
          
        // load excel library
        $listInfo = $lpb->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'No LPB');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kode Buku');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Judul');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'No OC');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Jumlah Cetak');     
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->tanggal);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->kode_lpb);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->kode_buku);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->judul);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kode_oc);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->total);
            $rowCount++;
            $no++;
        }
        $fileName =  "Report_LPB(".$awal."-".$akhir.").xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_pesanan() {
        // create file name
		$perwakilan = $this->input->post('perwakilan');
		$sales = $this->input->post('sales');
		$customer = $this->input->post('customer');
		$cv_rekanan = $this->input->post('cv_rekanan');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		if(!empty($sales)){$w_sales = " AND tbl_sales.kode_sales='$sales'";}else{$w_sales = "";}

        if(!empty($customer)){$w_customer = " AND tbl_customer.kode_customer='$customer'";}else{$w_customer = "";}

        if(!empty($cv_rekanan)){$w_cv_rekanan = " AND tbl_cvrekanan.kode_cv='$cv_rekanan'";}else{$w_cv_rekanan = "";}

		//ambil pesanan
		$alokasiproduk = $this->m_report->Cari_pesanan($perwakilan, $sales, $customer, $cv_rekanan, $awal, $akhir);
        $no=0;
        $no_buk = 0;
        $data_ = [];
		foreach($alokasiproduk->result() as $data){
			$data_[$no]['tanggal']=$data->tanggal;
			$data_[$no]['nama_sales']=$data->nama_sales;
			$data_[$no]['nama_customer']=$data->nama_customer;
			$data_[$no]['nama_cv']=$data->nama_cv;
			$data_[$no]['no_do']=$data->no_do;
			$data_[$no]['no_mou']=$data->no_mou;
			$data_[$no]['no_pengajuan']=$data->no_pengajuan;
			if($data->sj == 'Sudah SJ' && $data->faktur =='Sudah FT'){
				$sjft = $this->m_report->sjyfty($data->no_do);
			}else if($data->sj == 'Sudah SJ' && $data->faktur =='Belum FT'){
				$sjft = $this->m_report->sjyftn($data->no_do);
			}else if($data->sj == 'Belum SJ' && $data->faktur =='Belum FT'){
				$sjft = $this->m_report->sjnftn($data->no_do);
			}
		$alokasi_buku = $this->m_report->Cari_pesanan_buku($data->no_do);
		$jum_sj = $sjft->num_rows();
		$jum_buk = $alokasi_buku->num_rows();
		$tbl_sj = $sjft->result_array();
		if($jum_sj > $jum_buk){

		}else if($jum_sj < $jum_buk){
			$nu=0;
			foreach($alokasi_buku->result() as $data_buku){
				if($no_buk == $no && $jum_sj > $nu){
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']=$tbl_sj[$nu]['no_suratjalan'];
					$data_[$no_buk]['no_faktur']=$tbl_sj[$nu]['no_faktur'];
				}else if ($no_buk > $no && $jum_sj > $nu){
					$data_[$no_buk]['tanggal']='';
					$data_[$no_buk]['nama_sales']='';
					$data_[$no_buk]['nama_customer']='';
					$data_[$no_buk]['nama_cv']='';
					$data_[$no_buk]['no_do']='';
					$data_[$no_buk]['no_mou']='';
					$data_[$no_buk]['no_pengajuan']='';
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']=$tbl_sj[$nu]['no_suratjalan'];
					$data_[$no_buk]['no_faktur']=$tbl_sj[$nu]['no_faktur'];
				}else if ($no_buk > $no && $jum_sj <= $nu){
					$data_[$no_buk]['tanggal']='';
					$data_[$no_buk]['nama_sales']='';
					$data_[$no_buk]['nama_customer']='';
					$data_[$no_buk]['nama_cv']='';
					$data_[$no_buk]['no_do']='';
					$data_[$no_buk]['no_mou']='';
					$data_[$no_buk]['no_pengajuan']='';
					$data_[$no_buk]['kode_buku']=$data_buku->kode_buku;
					$data_[$no_buk]['judul']=$data_buku->judul;
					$data_[$no_buk]['jumlah_beli']=$data_buku->jumlah_beli;
					$data_[$no_buk]['jumlah_kirim']=$data_buku->jumlah_kirim;
					$data_[$no_buk]['sisa_kirim']=$data_buku->sisa_kirim;
					$data_[$no_buk]['batal']=$data_buku->batal;
					$data_[$no_buk]['no_suratjalan']='';
					$data_[$no_buk]['no_faktur']='';
				}
			$nu++;
			$no_buk++;}
		}
		$no = $no_buk;}
          
        // load excel library
        $list = $data_;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Sales');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nama Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Nama CV');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'No Pesanan');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'No MoU');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'No Pengajuan');     
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'No SJ');     
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'No Faktur');     
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Kode Buku');     
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Judul');     
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Jumlah Pesan');     
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Terkirim');     
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Kurang');     
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Batal');     
        // set Row
        $rowCount = 2;
        for ($no=0; $no < count($list); $no++) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list[$no]['tanggal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list[$no]['nama_sales']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list[$no]['nama_customer']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list[$no]['nama_cv']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list[$no]['no_do']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list[$no]['no_mou']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list[$no]['no_pengajuan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list[$no]['no_suratjalan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $list[$no]['no_faktur']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $list[$no]['kode_buku']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $list[$no]['judul']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $list[$no]['jumlah_beli']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $list[$no]['jumlah_kirim']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $list[$no]['sisa_kirim']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $list[$no]['batal']);
            $rowCount++;
        }
        $fileName =  "Report_Pesanan_".$perwakilan."(".$awal."-".$akhir.").xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_alokasiproduk() {
        // create file name
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$jenis = $this->input->post('tipe');

		$objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Kode Buku');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Judul');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CV Rekanan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'No Do');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Pesan');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Terkirim');  
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Dibatalkan');  
		
	if($jenis == 'detail'){
		$lpb = $this->m_report->Cari_alokasiproduk($awal, $akhir);
		$data = $lpb->result_array();
		// load excel library
        $listInfo = $data;
        
		// set Row
        $rowCount = 2;
		for ($i=0; $i < count($data); $i++) {
			$no = $i-1;
			if($no < 0 && $i==0){
				$jumlah_beli = $data[$i]['jumlah_beli'];
				$jumlah_kirim = $data[$i]['jumlah_kirim'];
				$batal = $data[$i]['batal'];
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data[$i]['kode_buku']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data[$i]['judul']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_do']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['jumlah_beli']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah_kirim']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['batal']);
	            $rowCount++;
			}else if($i == (count($data)-1)){
				if($jumlah_beli == 0){
					$jumlah_beli = $data[$i]['jumlah_beli'];
					$jumlah_kirim = $data[$i]['jumlah_kirim'];
					$batal = $data[$i]['batal'];
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,'Grand Total=====>');
       	 		$objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $jumlah_beli);
       	 		$objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $jumlah_kirim);
       	 		$objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $batal);
       	 		$objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
	            $rowCount++;
				
	            $jumlah_beli = 0;
				$jumlah_kirim = 0;
				$batal = 0;
			}else if ($data[$no]['kode_buku']==$data[$i]['kode_buku']) {
				$jumlah_beli = $jumlah_beli + $data[$i]['jumlah_beli'];
				$jumlah_kirim = $jumlah_kirim + $data[$i]['jumlah_kirim'];
				$batal = $batal + $data[$i]['batal'];

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_do']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['jumlah_beli']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah_kirim']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['batal']);
	            $rowCount++;
			}else if($data[$no]['kode_buku'] != $data[$i]['kode_buku']){
				if($jumlah_beli == 0){
					$jumlah_beli = $data[$i]['jumlah_beli'];
					$jumlah_kirim = $data[$i]['jumlah_kirim'];
					$batal = $data[$i]['batal'];
				}

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,'Grand Total=====>');
       	 		$objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $jumlah_beli);
       	 		$objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $jumlah_kirim);
       	 		$objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $batal);
       	 		$objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
	            $rowCount++;
				
	            $jumlah_beli = 0;
				$jumlah_kirim = 0;
				$batal = 0;

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data[$i]['kode_buku']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data[$i]['judul']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_do']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['jumlah_beli']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah_kirim']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['batal']);
	            $rowCount++;
	            $jumlah_beli = $data[$i]['jumlah_beli'];
				$jumlah_kirim = $data[$i]['jumlah_kirim'];
				$batal = $data[$i]['batal'];
			}
			
		}
	}else if($jenis == 'global'){
		$lpb = $this->m_report->Cari_alokasiprodukglobal($awal, $akhir);
		$listInfo = $lpb->result();
		// set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->kode_buku);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->judul);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->nama_customer);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->nama_cv);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->no_do);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->jumlah_beli);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->jumlah_kirim);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list->batal);
            $rowCount++;
        }
	}

        $fileName = "Report_alokasiproduk_".$jenis.".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_fakturnr() {
        // create file name
		$perwakilan = $this->input->post('perwakilan');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		//ambil pesanan
		$fakturnr = $this->m_report->Cari_fakturnr($perwakilan, $awal, $akhir);
		//$lists = $this->db->last_query($alokasiproduk);
        $no=0;
        $data_ = [];
		foreach($fakturnr->result() as $data){
			$data_[$no]['tanggal']=$data->tanggal;
			$data_[$no]['nama_sales']=$data->nama_sales;
			$data_[$no]['nama_customer']=$data->nama_customer;
			$data_[$no]['nama_cv']=$data->nama_cv;
			$data_[$no]['no_faktur']=$data->no_faktur;
			$data_[$no]['rabat']=$data->rabat;
			$data_[$no]['nilai_fee']=$data->nilai_fee;
			$data_[$no]['bruto']=$data->bruto;
			$data_[$no]['netto']=$data->netto;
			$data_[$no]['terbayar']=$data->terbayar;
			$data_[$no]['kurang']=$data->kurang;
			$data_[$no]['kurang']=$data->kurang;
			$data_[$no]['fee']=$data->fee;
			if($data->no_notaretur == Null){
				$data_[$no]['no_notaretur']='Tanpa Retur';
				$data_[$no]['retur_bruto']=0;
				$data_[$no]['retur_netto']=0;
			}else{
				$nota_retur = $this->m_report->Nota_retur($data->no_faktur);
				$data_[$no]['no_notaretur']=$nota_retur['no_notaretur'];
				$data_[$no]['retur_bruto']=$nota_retur['retur_bruto'];
				$data_[$no]['retur_netto']=$nota_retur['retur_netto'];
			}
			if($data->bkm == 'Ada BKM'){
				$bkm = $this->m_report->Bkm($data->no_faktur);
				if ($bkm->num_rows() > 0) {
					$data_bkm =$bkm->row_array();
					$data_[$no]['no_bkm']=$data_bkm['no_kas'];
					$data_[$no]['jumlah_bkm']=$data_bkm['total'];
					$no ++;
				}else{
					$nu =0;
					foreach ($bkm->result_array() as $data) {
						if ($nu == 0 ) {
							$data_[$no]['no_bkm']=$data_bkm[0]['no_kas'];
							$data_[$no]['jumlah_bkm']=$data_bkm[0]['total'];
						}else{
							$data_[$no]['no_bkm']=$data_bkm[$nu]['no_kas'];
							$data_[$no]['jumlah_bkm']=$data_bkm[$nu]['total'];
							$data_[$no]['tanggal']='';
							$data_[$no]['nama_sales']='';
							$data_[$no]['nama_customer']='';
							$data_[$no]['nama_cv']='';
							$data_[$no]['no_faktur']='';
							$data_[$no]['rabat']='';
							$data_[$no]['nilai_fee']='';
							$data_[$no]['bruto']=0;
							$data_[$no]['netto']=0;
							$data_[$no]['terbayar']=0;
							$data_[$no]['kurang']=0;
							$data_[$no]['fee']=0;
							$data_[$no]['no_notaretur']=0;
							$data_[$no]['retur_bruto']=0;
							$data_[$no]['retur_netto']=0;
						}
					$nu++;
					$no ++;}
				}
			}else if($data->bkm == 'Belum BKM'){
				$data_[$no]['no_bkm']='Belum ada Pembayaran';
				$data_[$no]['jumlah_bkm']=0;
			}
			
		}
          
        // load excel library
        $list = $data_;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Sales');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nama Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Nama CV');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'No Faktur');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Rabat %');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Fee %');     
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Bruto');     
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Netto');     
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Nota Retur');     
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Bruto Retur');     
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Netto Retur');     
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'No BKM');     
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Jumlah Bayar');     
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Terbayar');     
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Kekurangan');     
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Fee');     
        // set Row
        $rowCount = 2;
        for ($no=0; $no < count($list); $no++) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list[$no]['tanggal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list[$no]['nama_sales']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list[$no]['nama_customer']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list[$no]['nama_cv']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list[$no]['no_faktur']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list[$no]['rabat']. ' %');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list[$no]['nilai_fee']. ' %');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Rp ".number_format($list[$no]['bruto'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "Rp ".number_format($list[$no]['netto'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $list[$no]['no_notaretur']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Rp ".number_format($list[$no]['retur_bruto'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "Rp ".number_format($list[$no]['retur_netto'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $list[$no]['no_bkm']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, "Rp ".number_format($list[$no]['jumlah_bkm'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, "Rp ".number_format($list[$no]['terbayar'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, "Rp ".number_format($list[$no]['kurang'],0,',','.'));
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, "Rp ".number_format($list[$no]['fee'],0,',','.'));
            $rowCount++;
        }
        $fileName =  "Report_FakturNR_".$perwakilan."(".$awal."-".$akhir.").xls";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_pengajuan() {
        // create file name
        $perwakilan = $this->input->post('perwakilan');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$pengajuan = $this->m_report->Cari_pengajuan($perwakilan, $awal, $akhir);
          
        // load excel library
        $listInfo = $pengajuan->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nama Kerjasama');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'No Pengajuan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Rabat %');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');  
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->tanggal);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->nama_kerjasama);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->no_pengajuan);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->rabat." %");
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->aktif);
            $rowCount++;
            $no++;
        }
        $fileName = "Pengajuan_".$perwakilan."(".$awal."-".$akhir.").xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_mou() {
        // create file name
        $perwakilan = $this->input->post('perwakilan');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$mou = $this->m_report->Cari_mou($perwakilan, $awal, $akhir);
          
        // load excel library
        $listInfo = $mou->result();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nama CV');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'No MoU');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Fee %');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');  
        // set Row
        $rowCount = 2;
        $no=1;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->tanggal);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->nama_cv);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->no_mou);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->fee." %");
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->aktif);
            $rowCount++;
            $no++;
        }
        $fileName = "MoU_".$perwakilan."(".$awal."-".$akhir.").xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
    public function Excel_sjttr() {
        // create file name
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$jenis = $this->input->post('tipe');

		$objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Kode Buku');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Judul');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CV Rekanan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'No SJ');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'No TTR');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Terkirim');  
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Retur');  
		
	if($jenis == 'detail'){
		$sjttr = $this->m_report->Cari_sjttr($awal, $akhir);
		$data = $sjttr->result_array();
		// load excel library
        $listInfo = $data;
        
		// set Row
        $rowCount = 2;
		for ($i=0; $i < count($data); $i++) {
			$no = $i-1;
			if($no < 0 && $i==0){
				$jumlah = $data[$i]['jumlah'];
				$retur = $data[$i]['retur'];
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data[$i]['kode_buku']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data[$i]['judul']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_suratjalan']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['kode_retur']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['retur']);
	            $rowCount++;
			}else if($i == (count($data)-1)){
				if($jumlah == 0){
					$jumlah = $data[$i]['jumlah'];
					$retur = $data[$i]['retur'];
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,'Grand Total=====>');
       	 		$objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $jumlah);
       	 		$objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $retur);
       	 		$objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
	            $rowCount++;
				
	            $jumlah = 0;
				$retur = 0;
			}else if ($data[$no]['kode_buku']==$data[$i]['kode_buku']) {
				$jumlah = $jumlah + $data[$i]['jumlah'];
				$retur = $retur + $data[$i]['retur'];

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_suratjalan']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['kode_retur']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['retur']);
	            $rowCount++;
			}else if($data[$no]['kode_buku'] != $data[$i]['kode_buku']){
				if($jumlah == 0){
					$jumlah = $data[$i]['jumlah'];
					$retur = $data[$i]['retur'];
				}

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,'');
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,'Grand Total=====>');
       	 		$objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $jumlah);
       	 		$objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $retur);
       	 		$objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
	            $rowCount++;
				
	            $jumlah = 0;
				$retur = 0;

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data[$i]['kode_buku']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data[$i]['judul']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data[$i]['nama_customer']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data[$i]['nama_cv']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data[$i]['no_suratjalan']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data[$i]['kode_retur']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data[$i]['jumlah']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data[$i]['retur']);
	            $rowCount++;
	            $jumlah = $data[$i]['jumlah'];
				$retur = $data[$i]['retur'];
			}
			
		}
	}else if($jenis == 'global'){
		$sjttr = $this->m_report->Cari_sjttrglobal($awal, $akhir);
		$listInfo = $sjttr->result();
		// set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->kode_buku);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->judul);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->nama_customer);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->nama_cv);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->no_suratjalan);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kode_retur);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->jumlah);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list->retur);
            $rowCount++;
        }
	}

        $fileName = "Report_SJ-TTR_".$jenis.".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	    die(); 
    }
}
?>