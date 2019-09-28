<?php
//define('FPDF_FONTPATH',APPPATH .'/libraries/fpdf17/font/');
include_once APPPATH .('libraries\fpdf17\fpdf.php');

class Pdf_notaretur extends FPDF{
	//Page header
	function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
    function terbilang($x){
        $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12)
        return " " . $abil[$x];
        elseif ($x < 20)
        return $this->terbilang($x - 10) . "Belas";
        elseif ($x < 100)
        return $this->terbilang($x / 10) . " Puluh" . $this->terbilang($x % 10);
        elseif ($x < 200)
        return " Seratus" . $this->terbilang($x - 100);
        elseif ($x < 1000)
        return $this->terbilang($x / 100) . " Ratus" . $this->terbilang($x % 100);
        elseif ($x < 2000)
        return " Seribu" . $this->terbilang($x - 1000);
        elseif ($x < 1000000)
        return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang($x % 1000);
        elseif ($x < 1000000000)
        return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang($x % 1000000);
    }

	function Header()
	{
		global $title;
        if($title['head']['kode_cv'] == 'Tanpa CV'){
			$data_alamat = $title['head']['alamat_customer'];
			$yth = $title['head']['nama_customer'];
			$tlp = $title['head']['telp_customer'];
		}else if($title['head']['kode_cv'] != 'Tanpa CV'){
			$data_alamat = $title['head']['alamat_cv'];
			$yth = $title['head']['nama_cv'];
			$tlp = $title['head']['telp_cv'];
		}
		$this->Image(APPPATH .'/libraries/mediatama_f.jpg',111,3,0);
		$this->Ln(17);
		$this->SetFont('Times','B',12);
		$this->Cell(0,0,'NOTA RETUR',0,0,'C');
		$this->Ln(5);
		// header
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		//baris 1
		$w = [29,46,35,29,71];
		$a = $w[0]+$w[1];
		$this->Cell($a,6,'Kepada Yth.','',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'No Nota Retur','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['no_notaretur'],'',0,'L',false);
        $this->Ln();
        //baris 2
		$this->Cell($a,6,'Bapak/Ibu '. $yth,'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'Tanggal Retur','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['tgl_notaretur'],'',0,'L',false);
        $this->Ln();
        //baris 3
		$this->Cell($a,6,$data_alamat,'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'No TTR','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['kode_retur'],'',0,'L',false);
        $this->Ln();
        //baris 4
		$this->Cell($a,6,$tlp,'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'Tanggal TTR','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['tgl_ttr'],'',0,'L',false);
        $this->Ln();
        //baris 5
		$this->Cell($a,6,'','',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'Nama CV/Cust','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['nama_cv'].'/'.$title['head']['nama_customer'],'',0,'L',false);
        $this->Ln();
        //baris 6
		$this->Cell($w[0],6,'Nama Plgn','',0,'L',false);
        $this->Cell($w[1],6,': '.$title['head']['nama_penerima'],'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'Sales','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['nama_sales'],'',0,'L',false);
        $this->Ln();
        //baris 7
		$this->Cell($w[0],6,'No Telp Plgn','',0,'L',false);
        $this->Cell($w[1],6,': '.$title['head']['no_telp_penerima'],'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'Koordinator','',0,'L',false);
        $this->Cell($w[4],6,': '.$title['head']['nama_kaper'],'',0,'L',false);
        $this->Ln();
        //baris 8
		$this->Cell($w[0],6,'Alasan Retur','',0,'L',false);
        $this->Cell($w[1],6,': '.$title['head']['alasan'],'',0,'L',false);
        $this->Cell($w[2],6,'','',0,'L',false);
		$this->Cell($w[3],6,'','',0,'L',false);
        $this->Cell($w[4],6,'','',0,'L',false);
        $this->Ln(10);
	}
	
	//Page Content
	function Content(){
		global $title;
		$this->AddFont('Tahoma','','Tahoma.php');
		$this->SetFont('Tahoma','',9);
		// $this->Line(10,118,210,118);
		$this->Cell(9,6,'No','TB',0,'C',false);
        $this->Cell(20,6,'Kode Buku','TB',0,'C',false);
        $this->Cell(80,6,'Judul','TB',0,'C',false);
        $this->Cell(13,6,'Edisi','TB',0,'C',false);
        $this->Cell(21,6,'Jenjang','TB',0,'C',false);
		$this->Cell(12,6,'Qty','TB',0,'C',false);
        $this->Cell(20,6,'Harga','TB',0,'C',false);
        $this->Cell(25,6,'Total','TB',0,'C',false);
        
        // $this->Line(10,124,210,124);

		//content tabel
		//$garis = 90;
		$no=1;
		$total_harga=0;
		$jumlah = 0;	
		foreach ($title['tabel'] as $tabel ) {
			$total = $tabel['jumlah']*$tabel['harga'];
			$this->Ln();
			$this->Cell(9,6,$no,'B',0,'C',false);//no
	        $this->Cell(20,6,$tabel['kode_buku'],'B',0,'L',false);//kode buku
	        $this->Cell(80,6,substr($tabel['judul'],0,40),'B',0,'L',false);//judul
	        $this->Cell(13,6,$tabel['edisi'],'B',0,'C',false);//edisi
	        $this->Cell(21,6,substr($tabel['jenjang'],0,10),'B',0,'C',false);//jenjang
	        $this->Cell(12,6,$tabel['jumlah'],'B',0,'R',false);//Qty
	        $this->Cell(20,6,number_format($tabel['harga'],0,',','.'),'B',0,'R',false);//harga
	        $this->Cell(25,6,number_format($total,0,',','.'),'B',0,'R',false);//Total
	        $no++;
	        $jumlah=$jumlah+$tabel['jumlah'];
	        $total_harga=$total_harga+$total;
		}
		//footer
			$this->Ln();
			$this->SetFont('Times','B',9);
	        $this->Cell(143,6,'Grand Total','B',0,'C',false);//judul
	        $this->Cell(12,6,$jumlah,'B',0,'R',false);//Qty
	        $this->Cell(20,6,'','B',0,'R',false);//harga
	        $this->Cell(25,6,number_format($total_harga,0,',','.'),'B',0,'R',false);//Total
	    //Terbilang
	        $this->Ln();
			$this->SetFont('Times','I',8);
			$this->Cell(200,6,'Terbilang : '.$this->terbilang($total_harga),'T',0,'L',false);

	}
	//Page footer
	function Footer()
	{
		global $title;
		$this->SetY(-50);
		$this->SetFont('Times','',9);
		//jabatan
		$this->Cell(23,5,'','',0,'C',false);
		$this->Cell(30,5,'Customer','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Manager','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Keuangan','',0,'C',false);
		$this->Cell(10,5,'','',0,'C',false);
		$this->Cell(30,5,'Administrasi','',0,'C',false);
		$this->Ln();
		//kosong
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Cell(4,8,'','',0,'L',false);
		$this->Ln();
		//nama
		$this->Cell(23,7,'','',0,'C',false);
		$this->Cell(30,7,'','',0,'C',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,'','',0,'L',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,'','',0,'L',false);
		$this->Cell(10,7,'','',0,'L',false);
		$this->Cell(30,7,$title['head']['nama_admkeuangan'],'',0,'C',false);
		$this->Ln();
		//jabatan
		$this->Cell(23,5,'','',0,'C',false);
		$this->Cell(30,5,'','T',0,'C',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'','T',0,'C',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'','T',0,'L',false);
		$this->Cell(10,5,'','',0,'L',false);
		$this->Cell(30,5,'','T',0,'L',false);
		$this->Ln();

		$this->SetY(-24);
		$this->SetFont('Times','',10);
		$this->Cell(200,4,'Tembusan:','',0,'L',false);
		$this->Ln();
		$this->Cell(200,4,'1. Keuangan(Putih), 2. Customer(Merah), 3. Penjualan(Kuning), 4. Arsip(Hijau)','',0,'L',false);
		$this->Ln(6);
		$lebar = $this->w;
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
