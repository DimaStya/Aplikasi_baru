<?php
define('FPDF_FONTPATH',APPPATH .'/libraries/fpdf17/font/');
include_once APPPATH .('libraries\fpdf17\fpdf.php');

class Pdf_suratretur extends FPDF{
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
		$this->Cell(0,0,'FORM RETUR',0,0,'C');
		$this->Ln(3);
		$this->SetFont('Times','B',10);
		$this->Cell(0,6,'No Retur : '.$title['head']['no_suratretur'],0,0,'C');
		$this->Ln(10);
		// header
		$this->SetFont('Times','B',12);
		//baris 1
		$this->Cell(75,6,'NAMA SALES','',0,'L',false);
        $this->Cell(75,6,': '.$title['head']['nama_sales'],'B',0,'L',false);
        $this->Ln();
		//baris 2
		$this->Cell(75,6,'WILAYAH','',0,'L',false);
        $this->Cell(75,6,': '.$title['head']['alamat_perwakilan'],'B',0,'L',false);
        $this->Ln();
		//baris 3
		$this->Cell(75,6,'SEKOLAH','',0,'L',false);
        $this->Cell(75,6,': '.$title['head']['nama_customer'],'B',0,'L',false);
        $this->Ln();
		//baris 4
		$this->Cell(75,6,'NAMA GURU','',0,'L',false);
        $this->Cell(75,6,': '.$title['head']['nama_penerima'],'B',0,'L',false);
        $this->Ln(15);
        
	}
	
	//Page Content
	function Content(){
		global $title;
		// $this->Line(10,118,210,118);
		$this->SetFont('Times','',10);

		$w = [9,45,75,15,20,15,15];
		$this->Cell($w[0],12,'No','TBRL',0,'C',false);
        $this->Cell($w[1],12,'No Surat Jalan','TBRL',0,'C',false);
        $this->Cell($w[2],12,'Judul Buku','TBRL',0,'C',false);
        $this->Cell($w[3],12,'Kelas','TBRL',0,'C',false);
        $this->Cell($w[4],12,'Jenjang','TBRL',0,'C',false);
		$this->Cell($w[5]+$w[6],6,'EKS','TBRL',0,'C',false);
		$this->Ln();
		$this->Cell($w[0],0,'','',0,'C',false);
        $this->Cell($w[1],0,'','',0,'C',false);
        $this->Cell($w[2],0,'','',0,'C',false);
        $this->Cell($w[3],0,'','',0,'C',false);
        $this->Cell($w[4],0,'','',0,'C',false);
        $this->Cell($w[5],6,'Kirim','TBRL',0,'C',false);
        $this->Cell($w[6],6,'Retur','TBRL',0,'C',false);
        
		//content tabel
		$no=1;
		$total_sj = 0;
		$total_ret = 0;
		foreach ($title['tabel'] as $table) {
			$this->Ln();
			$total_sj = $total_sj + $table['jum_sj'];
			$total_ret = $total_ret + $table['jum_ret'];
			$this->Cell($w[0],6,$no,'TBRL',0,'C',false);
	        $this->Cell($w[1],6,$table['no_suratjalan'],'TBRL',0,'L',false);
	        $this->Cell($w[2],6,substr($table['judul'],0,40),'TBRL',0,'L',false);
	        $this->Cell($w[3],6,$table['kelas'],'TBRL',0,'C',false);
	        $this->Cell($w[4],6,$table['jenjang'],'TBRL',0,'C',false);
	        $this->Cell($w[5],6,$table['jum_sj'],'TBRL',0,'C',false);
	        $this->Cell($w[6],6,$table['jum_ret'],'TBRL',0,'C',false);
		$no++; }
		if($no<21){
			$k = 21 - $no;
			for ($i=1; $i < $k; $i++) { 
				$this->Ln();
				$this->Cell($w[0],6,'','TBRL',0,'C',false);
		        $this->Cell($w[1],6,'','TBRL',0,'L',false);
		        $this->Cell($w[2],6,'','TBRL',0,'L',false);
		        $this->Cell($w[3],6,'','TBRL',0,'C',false);
		        $this->Cell($w[4],6,'','TBRL',0,'C',false);
		        $this->Cell($w[5],6,'','TBRL',0,'C',false);
		        $this->Cell($w[6],6,'','TBRL',0,'C',false);
			}
		}
		// footer table
		$this->SetFont('Times','',12);

		$this->Ln();
		$this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4],6,'JUMLAH','TBRL',0,'C',false);
        $this->Cell($w[5],6,$total_sj,'TBRL',0,'C',false);
        $this->Cell($w[6],6,$total_ret,'TBRL',0,'C',false);


		$this->Ln(13);
		$this->Cell($w[0]+$w[1]+$w[2],6,'','',0,'C',false);
		date_default_timezone_set("Asia/Jakarta");
		$this->Cell($w[3]+5,6,'. . . . . . . . . . . . . . .','',0,'C',false);
		$this->Cell($w[4]+24,6,', '. date('d').' '.date('F').' '.date('Y'),'',0,'C',false);

		$this->Ln(7);
		$this->Cell(26,6,'Alasan Retur : ','',0,'L',false);
		$this->MultiCell(165, 6, $title['head']['alasan'] , '' , 'J',false);
		

	}
	function Footer(){
		global $title;
		$this->SetY(-70);
		$this->SetFont('Times','',11);

		$this->Cell(65,5,'PELANGGAN','',0,'C',false);
		$this->Cell(65,5,'SALES','',0,'C',false);
		$this->Cell(65,5,'ADMIN PERWAKILAN','',0,'C',false);
		$this->Ln(23);
		$this->Cell(65,5,$title['head']['nama_penerima'],'',0,'C',false);
		$this->Cell(65,5,$title['head']['nama_sales'],'',0,'C',false);
		$this->Cell(65,5,$title['head']['nama_admper'],'',0,'C',false);
		$this->Ln(10);
		$this->Cell(65,5,'KEPALA PERWAKILAN','',0,'C',false);
		$this->Cell(65,5,'','',0,'C',false);
		$this->Cell(65,5,'GUDANG PUSAT','',0,'C',false);
		$this->Ln(23);
		$this->Cell(65,5,$title['head']['nama_kaper'],'',0,'C',false);
		$this->Cell(75,5,'','',0,'C',false);
		$this->Cell(45,5,'','B',0,'C',false);

	} 
}
?>
