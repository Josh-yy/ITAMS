<?php
@session_start();


function get_percentage($sid,$arr){
   foreach ($arr as $key => $value) {
    if($sid==$key)
    {
      return $value[0];
      break;
    }
   }
}
$a=0;
$sql = "";
$counter = 0;


require('mc_table.php');

$sy_id =$_REQUEST['sy_id'];

// Instanciation of inherited class

$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetWidths(Array(10,60,40,20,60,40,30));
$pdf->SetLineHeight(5);
$pdf->AddPage('L','A4','');
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),250,7,17);

$pdf->Cell(280,5,get_column2("name","select * from system_settings",$db),0,0,'L');
// Line break
$pdf->Ln();


// Line break
$pdf->SetFont('Arial','',12);
$pdf->Cell(280,5,"Institutional Mock Exam EXAMINATION RESULTS OF " . get_column2("sy","select * from m_sy where sy_id = '".$sy_id."'",$db),0,0,'L');

$pdf->Ln();

$pdf->SetFillColor(230,230,230);
$pdf->Cell(270,1,'',0,1,'L',1); //your cell
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,7,'NO',1,0,'L'); //your cell
$pdf->Cell(30,7,'ID NO',1,0,'L'); //your cell
$pdf->Cell(50,7,'NAME',1,0,'L'); //your cell
$a=1;
$nsql = "select * from m_subject_category where ID IN (1,2,3)";
$ndata = $db->query($nsql)->fetchAll();
foreach($ndata as $nrow){
	$pdf->CellFitScale(45,7, $nrow['category_name'] ,1,0,'L'); //your cell
}
$pdf->Cell(20,7,'RATING',1,0,'L'); //your cell
$pdf->Cell(20,7,'REMARKS',1,0,'L'); //your cell

$pdf->Ln();

$a=1;
 $sql = "select a.*, concat(b.ln, ', ', b.fn, ' ', b.fn) as ename,b.student_id as idno from t_student_mock a inner join m_student_information b on a.student_id = b.id where a.sy_id = '".$sy_id."' order by ename";
$data = $db->query($sql)->fetchAll();
foreach($data as $row){
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,7,$a,1,0,'L'); //your cell
$pdf->Cell(30,7,$row['idno'],1,0,'L'); //your cell
$pdf->Cell(50,7,$row['ename'],1,0,'L'); //your cell
$a=1;
$nsql = "select * from m_subject_category where ID IN (1,2,3)";
$ndata = $db->query($nsql)->fetchAll();
foreach($ndata as $nrow){
	$pdf->CellFitScale(45,7, get_column2("totals","select concat(total_score, '=>', percentage) as totals from t_mock_subject_group_grade where student_id = '".$row['student_id']."' and exam_id = '".$row['exam_id']."' and subject_group_id = '".$nrow['id']."'",$db) ,1,0,'C'); //your cell
}
$pdf->Cell(20,7,$row['total_score'] . " => " . $row['total_percentage'],1,0,'C'); //your cell
$pdf->Cell(20,7,$row['remarks'],1,0,'L'); //your cell
$pdf->Ln();
$a++;
}
$pdf->Cell(265,7,"**********Nothing Follows*********",1,0,'C'); //your cell
$pdf->Output();
?>
