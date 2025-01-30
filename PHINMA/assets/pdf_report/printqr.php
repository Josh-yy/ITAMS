<?php
@session_start();

$a=0;
$sql="";
$type="";
$counter = 0;
require('mc_table.php');


// Instanciation of inherited class

$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetWidths(Array(10,70,40,20,50,30,50));
$pdf->SetLineHeight(5);

// Logo

// Logo
    // Logo

$pdf->AddPage('P','A4',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('qrback.jpg',12,15,70);
$pdf->Image('../img/qr_codes/' . get_column2("auto_qr_code","select * from m_hardware_assets WHERE ID ='".$_REQUEST['eid']."'",$db) . '.png',25,23,46);

$pdf->Ln();
$pdf->Ln(6);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'',0,0,'C');
$pdf->Cell(45,5,get_column2("code","select * from m_hardware_assets WHERE ID ='".$_REQUEST['eid']."'",$db),0,0,'C');
$pdf->Ln(4);




$pdf->Output();
?>
