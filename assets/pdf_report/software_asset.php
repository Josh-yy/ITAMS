<?php
@session_start();

$a=0;
$sql="";
$type="";
$counter = 0;
require('mc_table.php');

$total=0;

// Instanciation of inherited class

$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetWidths(Array(10,70,40,20,50,30,50));
$pdf->SetLineHeight(5);

// Logo

// Logo
    // Logo
$pdf->SetFont('Arial','B',12);

$pdf->AddPage('L','A4',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),10,10,20);
$pdf->Image('../images/' . get_column2("top_head_logo","select * from system_settings",$db),250,10,30);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(25,5,"",0,0,'C');
$pdf->CellFitScale(190,5,strtoupper(get_column2("name","select * from system_settings",$db)),0,0,'L');
    // Line break


    // Line break

$pdf->SetFont('Arial','B',12);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);


$pdf->SetTextColor(0,50,0);
$pdf->Cell(25,5,"",0,0,'C');
$pdf->Cell(190,4,"HARDWARE ASSETS MASTERLIST",0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();

$pdf->Ln(10);
	$pdf->SetWidths(Array(10,40,50,50,35,50,30,30));
$pdf->Row(Array(
					"No",
					"Asset Code",
					"Software Name",
					"Serial Number",
					"Asset Category",
					"Licensed Type",
					"Date Purchased",
				));
$sql = "select * from m_software_assets order by software_name ASC";
$data = $db->query($sql)->fetchAll();
$i=1;
$pdf->SetFont('Arial','',9);
foreach($data as $row){

	$pdf->Row(Array(
					$i,
					$row['code'],
					$row['software_name'],
				
					$row['serial_number'],
					get_column2("name","select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db),
					$row['license_type'],
						$row['date_purchased'],
				));

				$i++;
}
$pdf->Output();
?>
