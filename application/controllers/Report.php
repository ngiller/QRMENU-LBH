<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('AlphaPdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
    }
 
	public function buat_pdf(){

        //error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        /*$pdf = new FPDF('L', 'mm','Letter');
 
        $pdf->AddPage();
 
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'DAFTAR PEGAWAI AYONGODING.COM',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
 
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(90,6,'Nama Pegawai',1,0,'C');
        $pdf->Cell(120,6,'Alamat',1,0,'C');
        $pdf->Cell(40,6,'Telp',1,1,'C');
 
        $pdf->SetFont('Arial','',10);
        
        $pdf->AddPage();
        $pdf->Image('assets/img/home-bg-01.jpg');*/
        //

        $pdf = new AlphaPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/member-card.jpg',30,30);
        $pdf->SetAlpha(1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->setTextColor(254, 254, 254);
        $pdf->Cell(148);
        $pdf->Cell( 1, 177, '10-1001', 0, 0, 'R' );
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell( 1, 188, 'Fitri Oktavia Sakinah', 0, 0, 'R' ); 

        $path = $_SERVER["DOCUMENT_ROOT"].'/uploads/cards/';
        $pdf->Output($path.'xyz.pdf', 'F');
    
    
    }
}