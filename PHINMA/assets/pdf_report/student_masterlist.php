<?php
@session_start();
require('../main_core/modfunctions.php');
$a=0;
$sql="";
$type="";
$counter = 0;


require('mc_table.php');


// Instanciation of inherited class

$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetWidths(Array(10,60,40,20,50,30,30));
$pdf->SetLineHeight(5);

// Logo
    // Logo


$pdf->AddPage('L','A4',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/anewlogo.png',40,10,25);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(270,5,'Republic of the Philippines',0,0,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(280,5,'',0,0,'C');
// Line break
$pdf->Ln(4);
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(0,100,0);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(270,5,'ISABELA STATE UNIVERSITY',0,0,'C');
    // Line break
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(270,5,'CAUAYAN CAMPUS',0,0,'C');
$pdf->SetFillColor(230,230,230);
$pdf->Ln(3);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','I',8);
$pdf->Cell(10,5,'',0,0,'C');
$pdf->Cell(270,5,'Cauayan City, Isabela',0,0,'C');
$pdf->SetFillColor(230,230,230);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',14);

$pdf->Cell(10,4,'',0,0,'C');
$pdf->SetTextColor(0,50,0);
$pdf->Cell(270,4,"STUDENTS MASTERLIST",0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(275,1,'',0,1,'L',1); //your cell
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetWidths(Array(10,25,50,25,17,50,33,33,25));
$pdf->SetAligns(Array('C','C','L','C','C','C','C','C','C'));
$pdf->Row(Array(
					"NO",
					" STUDENT NO",
					"NAME",
					"BIRTHDATE",
					"GENDER",
					"ADDRESS",
					"FATHER'S NAME",
					"MOTHERS'S NAME",
					"CP NO.",
				));
$i= 1;

$data = $db->query("select student_number,concat(ln, ', ', mn,' ',fn) as Name, substr(gender,1,1) as gender,birthdate,address,cp,mothers_name,fathers_name from m_student_information order by gender, concat(ln, ', ', mn,' ',fn) ASC")->fetchAll();
	
			foreach ($data as $row) {

			$pdf->SetFont('Arial','',9);
			
				$pdf->Row(Array(
					$i,
					$row['student_number'],
					$row['Name'],
					$row['birthdate'],
					$row['gender'],
					$row['address'],
					$row['fathers_name'],
					$row['mothers_name'],
					$row['cp']
				));
				$i++;

		}
$pdf->Cell(280,5,'*********Nothing Follows*********',0,0,'C');


$pdf->Output();
?>
