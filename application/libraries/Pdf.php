<?php
define('FPDF_FONTPATH',APPPATH .'/libraries/fpdf17/font/');
include_once APPPATH .('libraries\fpdf17\fpdf.php');

class Pdf extends FPDF{
	//Page header
	function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }

	function Header()
	{
		//Logo
		global $title;
		$this->Image(APPPATH .'/libraries/mediatama.jpg',75,3,'R');
		$this->SetFont('Arial','',9);
		$this->Cell(25,4,'Admin','',0,'L',false);
		$this->Cell(25,4,': '.$title['head']['nama_admpusat'],'',0,'L',false);
		$this->ln();
		$this->Cell(25,4,'No Pesanan','',0,'L',false);
		$this->Cell(25,4,': '.$title['head']['no_do'],'',0,'L',false);
		$this->Ln(20);
		$this->SetLineWidth(1);
		$this->Line(10,30,210,30);
		$this->Ln(3);

	}
	
	//Page Content
	function Content(){
		global $title;
		$this->SetFont('Times','B',12);
		$this->Cell(0,0,'SURAT PESANAN',0,0,'C');
		$this->Ln(5);
		// header
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		//baris 1
		$this->Cell(40,6,'No Pesanan','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['no_do'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Nama Customer','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['nama_customer'],'',0,'L',false);
        $this->Ln();
        //baris 2
		$this->Cell(40,6,'Tanggal','',0,'L',false);
		$tanggal = explode("-", $title['head']['tanggal']);
        $this->Cell(35,6,': '.$tanggal['2'].'/'.$tanggal['1'].'/'.$tanggal['0'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Alamat Customer',0,'L',false);
        $this->MultiCell(60,6,': '.$title['head']['alamat_customer'],0);
        //baris 3
		$this->Cell(40,6,'CV Rekanan','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['nama_cv'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Nama Sales','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['nama_sales'],'',0,'L',false);
        $this->Ln();
        //baris 4
		$this->Cell(40,6,'No MoU','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['no_mou'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Nama Kaper','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['nama_kaper'],'',0,'L',false);
        $this->Ln();
        //baris 5
		$this->Cell(40,6,'Kerjasama','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['nama_kerjasama'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Tipe Buku','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['tipe_buku'],'',0,'L',false);
        $this->Ln();
        //baris 6
		$this->Cell(40,6,'No Pengajuan','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['no_pengajuan'],'',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Jenis Pembayaran','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['jenis_pembayaran'],'',0,'L',false);
        $this->Ln();
        //baris 7
		$this->Cell(40,6,'','',0,'L',false);
        $this->Cell(35,6,'','',0,'L',false);
        $this->Cell(45,6,'','',0,'L',false);
		$this->Cell(40,6,'Sumber Dana','',0,'L',false);
        $this->Cell(60,6,': '.$title['head']['sumber_dana'],'',0,'L',false);
        $this->Ln();
        //baris 8
        $this->Cell(40,6,'Nama Pelanggan','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['nama_penerima'],'',0,'L',false);
        $this->Ln();
        //baris 9
		$this->Cell(40,6,'No Telp Pelanggan','',0,'L',false);
        $this->Cell(35,6,': '.$title['head']['no_telp_penerima'],'',0,'L',false);
        $this->Ln();
        //baris 10
		$this->Cell(40,6,'Alamat Kirim','',0,'L',false);
        $this->MultiCell(130,6,': '.$title['head']['alamat_penerima'],0);
		$this->Ln(2);
		//baris 11
		$this->Cell(40,6,'Keterangan','',0,'L',false);
        $this->MultiCell(130,6,': '.$title['head']['keterangan'].' // '.$title['head']['stok'],0);
		$this->Ln(6);

		// $this->Line(10,118,210,118);
		$this->Cell(9,6,'No','TB',0,'C',false);
        $this->Cell(26,6,'Kode Buku','TB',0,'C',false);
        $this->Cell(82,6,'Judul','TB',0,'C',false);
		$this->Cell(20,6,'Jumlah DO','TB',0,'C',false);
        $this->Cell(14,6,'Penerbit','TB',0,'C',false);
        $this->Cell(18,6,'Jenjang','TB',0,'C',false);
        $this->Cell(11,6,'Edisi','TB',0,'C',false);
        $this->Cell(20,6,'Stok Pesan','TB',0,'C',false);
        
        // $this->Line(10,124,210,124);

		//content tabel
		//$garis = 90;
		$no=1;			
		foreach ($title['tabel'] as $tabel ) {
			$this->Ln();
			$this->Cell(9,6,$no,'B',0,'C',false);//no
	        $this->Cell(26,6,$tabel['kode_buku'],'B',0,'L',false);//kode buku
	        $this->Cell(82,6,substr($tabel['judul'],0,40),'B',0,'L',false);//judul
			$this->Cell(20,6,$tabel['jumlah_beli'],'B',0,'R',false);//jumlah beli
	        $this->Cell(14,6,$tabel['nama_penerbit'],'B',0,'C',false);//penerbit
	        $this->Cell(18,6,substr($tabel['jenjang'],0,10),'B',0,'C',false);//jenjang
	        $this->Cell(11,6,$tabel['edisi'],'B',0,'C',false);//edisi
	        $this->Cell(20,6,$tabel['stok_pesan'],'B',0,'R',false);//stok pesan
	        $no++;			
		}
		//footer
			$this->Ln();
			$this->SetFont('Times','B',9);
			$this->Cell(9,6,'','T',0,'C',false);
	        $this->Cell(26,6,'','T',0,'C',false);
	        $this->Cell(82,6,'Total','T',0,'C',false);
			$this->Cell(20,6,$title['head']['jumlah'],'T',0,'R',false);
	        $this->Cell(14,6,'','T',0,'C',false);
	        $this->Cell(18,6,'','T',0,'C',false);
	        $this->Cell(11,6,'','T',0,'C',false);
	        $this->Cell(20,6,'','T',0,'C',false);

	}


	//Page footer
	function Footer()
	{

	  //       // untuk surat jalan, faktur, retur
			// $this->Ln(30); // --> harus sama dengan ttd 
			// $this->Cell(9,6,'','',0,'',false);

	  // //   //ttd
	  //       $this->SetY(-30); // -->harus sama dengan dengan tambahan footer
			// // $this->SetFont('Times','B',9);
			//  $this->Cell(9,6,'','T',0,'C',false);
	  //       $this->Cell(30,6,'','T',0,'C',false);
	  //       $this->Cell(65,6,'Total','T',0,'C',false);
			// $this->Cell(22,6,'kkk','T',0,'C',false);
	  //       $this->Cell(25,6,'','T',0,'C',false);
	  //       $this->Cell(18,6,'','T',0,'C',false);
	  //       $this->Cell(11,6,'','T',0,'C',false);
	  //       $this->Cell(20,6,'','T',0,'C',false);

		date_default_timezone_set("Asia/Jakarta");
		$this->SetY(-15);    
        $lebar = $this->w;    
        $this->SetFont('Arial','I',8);            
        $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
        $this->SetY(-15);
        $this->SetX(0);        
        $this->Ln(1);
        $hal = 'Page : '.$this->PageNo().'/{nb}' ;
        $this->Cell($this->GetStringWidth($hal ),10,$hal );    
        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
        $tanggal  = 'Printed : '.date('d-m-Y  h:i-a').' ';
        $this->Cell($lebar-$this->GetStringWidth($hal )-$this->GetStringWidth($tanggal)-20);    
        $this->Cell($this->GetStringWidth($tanggal),10,$tanggal );
	}
}
?>
