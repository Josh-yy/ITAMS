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
$pdf->Image('../images/' . get_column2("top_head_logo","select * from system_settings",$db),270,10,30);

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
$pdf->SetFont('Arial','B',13);
$pdf->Cell(25,5,"",0,0,'C');
if($_REQUEST['cid']!==""){
$pdf->Cell(190,4,'PURCHASED ON ' . $_REQUEST['cid'],0,0,'L');
$pdf->Ln(5);
}
$pdf->SetFont('Arial','B',13);
$pdf->Cell(25,5,"",0,0,'C');
$pdf->Cell(190,4,get_column2("name","select * from m_branches where id = '".$_REQUEST['cid']."'",$db),0,0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();

$pdf->Ln(10);
$pdf->SetWidths(Array(10,30,50,50,50,50,35,35,30,25,50));
	$pdf->setAligns(Array('C','C','C','C','C','C','C','C','C','C','L'));
$pdf->Row(Array(
					"No",
					"Code",
					"Machine Name",
					"Model Number",
					"Serial Number",
					"Asset Category",

					"DP","Year Acquired"
				));
$sql="";
if($_REQUEST['cid']==""){
     $sql = "select *, date_format(date_purchased,'%Y') as edate from m_hardware_assets order by date_format(date_purchased,'%Y')";
}
else
{
     $sql = "select *, date_format(date_purchased,'%Y') as edate from m_hardware_assets where  date_format(date_purchased,'%Y') = '".$_REQUEST['cid']."'";
}
$data = $db->query($sql)->fetchAll();
$i=1;
$pdf->SetFont('Arial','',9);
foreach($data as $row){
	$pdf->Row(Array(
					$i,
					$row['code'],
					$row['machine_name'],
					$row['model_number'],
					$row['serial_number'],
					get_column2("name","select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db),
					$row['date_purchased'],
					$row['edate'],
				));
$i++;
}
$pdf->Output();
?>
