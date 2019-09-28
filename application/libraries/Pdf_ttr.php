<?php
//define('FPDF_FONTPATH',APPPATH .'/libraries/fpdf17/font/');
include_once APPPATH .('libraries\fpdf17\fpdf.php');

class Pdf_ttr extends FPDF{
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
        if($title['head']['kode_cv'] == 'Tanpa CV'){
			$data_alamat = $title['head']['alamat_customer'];
			$yth = $title['head']['nama_customer'];
			$tlp = $title['head']['telp_cust'];
		}else if($title['head']['kode_cv'] != 'Tanpa CV'){
			$data_alamat = $title['head']['alamat_cv'];
			$yth = $title['head']['nama_cv'];
			$tlp = $title['head']['telp_cv'];
		}
		$this->SetFont('Times','B',14);
		$this->Cell(0,0,'TANDA TERIMA RETUR',0,0,'C');
		$this->Ln(8);
		// header
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		$w = [33,35,47,20,60];
		//baris 1
		$this->Cell($w[0]+$w[1],5,'Terima dari:','',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No TTR','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['kode_retur'],'',0,'L',false);
        $this->Ln();
        //baris 2
		$this->Cell($w[0]+$w[1],5,'Bapak/Ibu '.$yth,'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Tgl TTR','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['tgl_retur'],'',0,'L',false);
        $this->Ln();
        //baris 3
		$this->Cell($w[0]+$w[1],5,$data_alamat,'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No Retur','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['no_suratretur'],'',0,'L',false);
        $this->Ln();
        //baris 4
		$this->Cell($w[0]+$w[1],5,$tlp,'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Tgl Retur','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['tgl_suratretur'],'',0,'L',false);
        $this->Ln();
        //baris 5
		$this->Cell($w[0]+$w[1],5,'','',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No SJ','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['no_suratjalan'],'',0,'L',false);
        $this->Ln();
        //baris 6
		$this->Cell($w[0],5,'Nama Cust','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['nama_customer'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Tgl SJ','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['tgl_sj'],'',0,'L',false);
        $this->Ln();
        //baris 7
		$this->Cell($w[0],5,'Nama CV','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['nama_cv'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'No Faktur','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['no_faktur'],'',0,'L',false);
        $this->Ln();
        //baris 8
		$this->Cell($w[0],5,'Koordinator/Sales','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['nama_kaper'].' / '.$title['head']['nama_sales'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		$this->Cell($w[3],5,'Tgl Faktur','',0,'L',false);
        $this->Cell($w[4],5,': '.$title['head']['tgl_faktur'],'',0,'L',false);
        $this->Ln();
        //baris 9
		$this->Cell($w[0],5,'Alasan Retur','',0,'L',false);
        $this->Cell($w[1],5,': '.$title['head']['alasan'],'',0,'L',false);
        $this->Cell($w[2],5,'','',0,'L',false);
		
        $this->Ln(10);
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
        $this->Cell(15,6,'Jumlah','TB',0,'C',false);
        
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
	        $this->Cell(15,6,$tabel['jumlah'],'B',0,'R',false);//jumlah
	        $no++;	
		}

	}


	//Page footer
	function Footer()
	{
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
