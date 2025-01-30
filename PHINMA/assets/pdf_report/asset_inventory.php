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

$pdf->AddPage('L','Legal',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),10,10,20);
$pdf->Image('../images/' . get_column2("top_head_logo","select * from system_settings",$db),280,10,30);

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
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();

$pdf->Ln(10);
	$pdf->SetWidths(Array(10,30,30,30,30,30,20,20,30,50,50));
	$pdf->setAligns(Array('C','C','C','C','C','C','C','C','C','C','L'));
$pdf->Row(Array(
					"No",
					"Code",
					"Machine Name",
					"Model Number",
					"Serial Number",
					"Asset Category",
					"Status",
					"DP",
					"Holder",
					"Software Installed",
					"Asset Properties"
				));
$sql = "select * from m_hardware_assets order by machine_name ASC";
$data = $db->query($sql)->fetchAll();
$i=1;
$pdf->SetFont('Arial','',8);
foreach($data as $row){
	$software_installed = "";
	$hardware_properties = "";
	  $asql = "select *,a.id as installed_id, date_format(a.date_added,'%M-%d-%Y %r') as date_installed from t_hardware_software_installed a inner join m_software_assets b on a.software_id = b.id where asset_id = '".$row['id']."'";
	   if(get_exist2($asql,$db)){
              $adata = $db->query($asql)->fetchAll();
              foreach($adata as $arow)
              {
              	$software_installed .= $arow['software_name'] . "\n";
              }
        }
        else{
        	$software_installed = "NA";
        }
         $hsql = "select * from t_asset_properties a inner join t_asset_cat_property b on a.property_id = b.id where a.asset_id = '".$row['id']."'";


            if(get_exist2($hsql,$db)>0){
              $hdata = $db->query($hsql)->fetchAll();
              foreach($hdata as $hrow)
              {
              	$hardware_properties .= $hrow['property_name'] . " : " . $hrow['prop_value'] . "\n";
              }
             }
             else{

             }
	$pdf->Row(Array(
					$i,
					$row['code'],
					$row['machine_name'],
					$row['model_number'],
					$row['serial_number'],
					get_column2("name","select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db),
					$row['status'],
					$row['date_purchased'],
					get_column2("ename","select concat(fn, ' ',mn, ' ', ln) as ename from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id ='".$row['id']."' and status = 1)",$db),
					$software_installed,
					$hardware_properties
				));

				$i++;
}
$pdf->Output();
?>
