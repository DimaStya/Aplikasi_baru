<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {
 
function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
}



    public function index(){

    }
    function Pesanan(){
        $no_pesanan =  $this->input->post('no_pesanan');
        //insert tbl_do

        //update tbl_buku

        //cetak pdf
        $pdf = new PDF();
        global $title;
        $title = array('satu' => array('ada' => 'hehehe', ), );
        $pdf->AliasNbPages();
        $pdf->AddPage('P','Letter');
        $pdf->Content();
        $pdf->Output($no_pesanan.'.pdf','D');
        redirect(base_url('Pemasaran/Dopesan'));
    }
}

