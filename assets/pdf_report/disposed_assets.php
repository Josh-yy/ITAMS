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
$pdf->SetWidths(Array(10,70,40,20,50,50,50));
$pdf->SetLineHeight(5);

// Logo

// Logo
    // Logo
$pdf->SetFont('Arial','B',12);

$pdf->AddPage('L','Legal',0);
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



$pdf->SetFont('Arial','B',15);
$pdf->Cell(25,5,"",0,0,'C');
$pdf->Cell(190,4,'LIST OF DISPOSED HARDWARE ASSETS',0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(25,5,"",0,0,'C');
$pdf->Cell(190,4,get_column2("name","select * from m_branches where id = '".$_REQUEST['cid']."'",$db),0,0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();

$pdf->Ln(10);
$pdf->SetWidths(Array(10,40,40,35,30,50,50,50,50));
	$pdf->setAligns(Array('C','C','C','C','C','C','C','C','C','C','L'));
$pdf->Row(Array(
					"No",
					"Code",
					"Machine Name",
					"Model Number",
					"Serial Number",
					"Asset Category",
					"Status",
					"Asset Lifespan"
				));
$sql = "SELECT b.id as asset_id,date_format(date_disposal,'%Y'),b.asset_cat_id,b.status,b.added_by,b.date_added,b.code,b.asset_photo, b.machine_name, b.serial_number, b.date_purchased, a.date_disposal, b.auto_qr_code, b.model_number,b.date_purchased, a.date_disposal, CONCAT_WS(', ',CASE WHEN TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) > 0 THEN CONCAT(TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal), ' years') ELSE NULL END, CASE WHEN TIMESTAMPDIFF(MONTH, b.date_purchased, a.date_disposal) % 12 > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, b.date_purchased, a.date_disposal) % 12, ' months') ELSE NULL END,
        CASE WHEN DATEDIFF(a.date_disposal, DATE_ADD(b.date_purchased, INTERVAL TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) YEAR)) % 30 > 0 THEN CONCAT(DATEDIFF(a.date_disposal, DATE_ADD(b.date_purchased, INTERVAL TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) YEAR)) % 30, ' days')
            ELSE NULL END) AS date_difference FROM t_asset_disposal a INNER JOIN m_hardware_assets b ON a.asset_id = b.id where date_format(date_disposal,'%Y')='".$_REQUEST['cid']."'";
$data = $db->query($sql)->fetchAll();
$i=1;
$pdf->SetFont('Arial','',9);
foreach($data as $row){
	$software_installed = "";
	$hardware_properties = "";

	
	$pdf->Row(Array(
					$i,
					$row['code'],
					$row['machine_name'],
					$row['model_number'],
					$row['serial_number'],
					get_column2("name","select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db),
					$row['status'],
					$row['date_difference'],
					
				));
	$i++;
}
$pdf->Output();
?>
