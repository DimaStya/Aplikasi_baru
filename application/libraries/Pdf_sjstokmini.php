<?php
//define('FPDF_FONTPATH',APPPATH .'/libraries/fpdf17/font/');
include_once APPPATH .('libraries\fpdf17\fpdf.php');

class Pdf_sjstokmini extends FPDF{
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
		global $title;
		$this->SetFont('Times','B',14);
		$this->Cell(0,0,'SURAT JALAN STOK MINI',0,0,'C');
		$this->Ln(5);
		// header
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		$w = [33,35,40,35,60];
		//baris 1
		$this->Cell($w[0]+$w[1],5,'Kepada Yth.','',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Tanggal SJ','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['tanggal'],'',0,'L',false);
        $this->Ln();
        //baris 2
		$this->Cell($w[0]+$w[1],5,'Bapak/Ibu '.$title['head']['nama_kaper'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No SJ','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['no_sj_stkmini'],'',0,'L',false);
        $this->Ln();
        //baris 3
		$this->Cell($w[0]+$w[1],5,'Di '.$title['head']['alamat_perwakilan'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Ekspedisi','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['ekspedisi'],'',0,'L',false);
        $this->Ln();
        //baris 4
		$this->Cell($w[0]+$w[1],5,'','',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Driver/Driver HP','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['nama_sopir'].' / '.$title['head']['no_telp_sopir'],'',0,'L',false);
        $this->Ln();
        //baris 5
		$this->Cell($w[0],5,'Alamat Kirim','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['alamat_kirim'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No Polisi','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['no_polisi'],'',0,'L',false);
        $this->Ln();
        //baris 6
		$this->Cell($w[0],5,'Keterangan','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['keterangan'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'','',0,'L',false);
        $this->Cell($w[4],5,'','',0,'L',false);
        $this->Ln();
	}
	
	//Page Content
	function Content(){
		global $title;
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		// $this->Line(10,118,210,118);
		$this->Cell(9,6,'No','TB',0,'C',false);
        $this->Cell(30,6,'Kode Buku','TB',0,'C',false);
        $this->Cell(77,6,'Judul','TB',0,'C',false);
        $this->Cell(20,6,'Edisi','TB',0,'C',false);
        $this->Cell(20,6,'Jenjang','TB',0,'C',false);
		$this->Cell(20,6,'Kurikulum','TB',0,'C',false);
        $this->Cell(22,6,'Jumlah','TB',0,'C',false);
        
        // $this->Line(10,124,210,124);

		//content tabel
		//$garis = 90;
		$no=1;			
		foreach ($title['tabel'] as $tabel ) {
			$this->Ln();
			$this->Cell(9,6,$no,'B',0,'C',false);//no
	        $this->Cell(30,6,$tabel['kode_buku'],'B',0,'L',false);//kode buku
	        $this->Cell(77,6,substr($tabel['judul'],0,40),'B',0,'L',false);//judul
	        $this->Cell(19,6,$tabel['edisi'],'B',0,'C',false);//edisi
	        $this->Cell(21,6,substr($tabel['jenjang'], 0, 10),'B',0,'C',false);//jenjang
			$this->Cell(20,6,$tabel['kurikulum'],'B',0,'C',false);//kurikulum
	        $this->Cell(22,6,$tabel['jumlah'],'B',0,'R',false);//jumlah
	        $no++;	
		}
		//footer
			$this->Ln();
			$this->SetFont('Times','B',9);
			$this->Cell(9,6,'','T',0,'C',false);
	        $this->Cell(32,6,'','T',0,'C',false);
	        $this->Cell(75,6,'Total','T',0,'C',false);
			$this->Cell(20,6,'','T',0,'C',false);
	        $this->Cell(20,6,'','T',0,'C',false);
	        $this->Cell(20,6,'','T',0,'C',false);
	        $this->Cell(22,6,$title['head']['jumlah'],'T',0,'R',false);

	}


	//Page footer
	function Footer()
	{
		global $title;
		$this->SetY(-60);
		$this->SetFont('Times','',9);
		//jabatan
		$this->Cell(23,5,'','',0,'C',false);
		$this->Cell(30,5,'Petugas','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Diperiksa','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Ekspedisi','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Customer','',0,'C',false);
		$this->Ln();
		//kosong
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Ln();
		//nama
		$this->Cell(23,7,'','',0,'C',false);
		$this->Cell(30,7,$title['head']['nama_admgudang'],'',0,'C',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,'','',0,'L',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,'','',0,'L',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,'','',0,'L',false);
		$this->Ln();
		//jabatan
		$this->Cell(23,5,'','',0,'C',false);
		$this->Cell(30,5,'Administrasi','T',0,'C',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'QC Distributor','T',0,'C',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'','T',0,'L',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'','T',0,'L',false);
		$this->Ln();

		$this->SetY(-34);
		$this->SetFont('Times','',10);
		$this->Cell(200,4,'Tembusan:','',0,'L',false);
		$this->Ln();
		$this->Cell(200,4,'1. Keuangan(Putih), 2. Customer(Merah), 3. Penjualan(Kuning), 4. Arsip(Hijau)','',0,'L',false);
		$this->Ln(6);
		$lebar = $this->w;
		$this->SetFont('Times','I',10);
		$this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
		$this->Cell(200,4,'Jika terfdapat perbedaan antara fisik barang dan yang tertera dalam surat jalan ini, komplain','',0,'C',false);
		$this->Ln();
		$this->Cell(200,4,'dapat diterima dalam waktu 3 x 24 ja, setelah barang diterima.','',0,'C',false);

		date_default_timezone_set("Asia/Jakarta");
		$this->SetY(-15);    
            
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
