<?php
@session_start();
require('../modfunctions.php');
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

$pdf->AddPage('P','A4','');
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/acr.png',170,10,20);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(280,5,'Republic of the Philippines',0,0,'L');
// Line break
$pdf->Ln(4);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,100,0);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->CellFitScale(150,5,strtoupper('ISABELA STATE UNIVERSITY ROXAS CAMPUS'),0,0,'L');
    // Line break
$pdf->Ln(3);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','I',8);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->CellFitScale(150,5,strtoupper('ROXAS, ISABELA'),0,0,'L');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(10,4,'',0,0,'C');
$pdf->SetTextColor(0,50,0);
$pdf->Cell(280,4,"ACTIVITY LOGS",0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetWidths(Array(10,100,20,60));
$pdf->SetAligns(Array('C','L','C','C'));
$pdf->Row(Array(
					"No",
					"Activity",
					"Type",
					"Log Date",
				));
$i= 1;

$data = $db->query("select * from t_activity_logs where performed_by = '".$_SESSION['data']['voter_id']."' order by date_performed desc")->fetchAll();
	
			foreach ($data as $row) {
			$pdf->SetFont('Arial','',9);
			
				$pdf->Row(Array(
					$i,
					$row['activity_log'],
					$row['activity'],
					$row['date_performed'],
				));
				$i++;

		}
$pdf->Cell(180,5,'*********Nothing Follows*********',0,0,'C');


$pdf->Output();
?>
