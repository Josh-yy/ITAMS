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

$pdf->AddPage('L','A4',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),10,10,20);
$pdf->Ln(4);
$pdf->SetFont('Arial','B',11);

$pdf->CellFitScale(280,5,strtoupper(get_column2("agency_name","select * from system_settings",$db)),0,0,'C');
    // Line break

$pdf->SetFont('Arial','B',12);


$pdf->SetFont('Arial','B',12);


$pdf->SetTextColor(0,50,0);
$pdf->Cell(280,4,"MD5 RESULTS",0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
 if($_REQUEST['date_added']!=="")
 				{
$pdf->SetTextColor(0,50,0);
$pdf->Cell(280,4,$_REQUEST['date_added'],0,0,'C');
$pdf->Ln(5);
}
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetWidths(Array(10,25,50,20,50,70,35));

$pdf->Row(Array(
					"No",
					"ID No",
					"NAME",
					"GENDER",
					"ADDRESS",
					"COURSE","TOTAL SCORE"
				));
$i= 1;
$sql = "";
 if($_REQUEST['date_added']=="")
 				{
                $sql= "select a.*, concat(a.fn, ' ', a.mn, ' ',a.ln) as ename from m_student_information a inner join t_student_answer b on a.id = b.student_id where exam_id = 37 group by b.student_id";
               }
               else{
                $sql= "select a.*,concat(a.fn, ' ', a.mn, ' ',a.ln) as ename from m_student_information a inner join t_student_answer b on a.id = b.student_id where date_format(b.date_added,'%Y-%m-%d') = '".$_REQUEST['date_added']."' and  exam_id = 37 group by b.student_id";   
               }
$data = $db->query($sql)->fetchAll();
	
			foreach ($data as $row) {
			$pdf->SetFont('Arial','',9);
			
				$pdf->Row(Array(
					$i,
					$row['lrn'],
					strtoupper($row['ename']),
					strtoupper($row['gender']),
					strtoupper($row['address']),
					get_column2("name","select * from m_courses where id = '".$row['course_id']."'",$db),
					  get_column2("total","select sum(score) as total from v_md5scores where student_id = '".$row['id']."'",$db),
				));
				$i++;

		}
$pdf->Cell(280,5,'*********Nothing Follows*********',0,0,'C');
$pdf->Ln(25);

foreach($data as $row){
$student_id = $row['id'];
$pdf->AddPage('P','A4',0);
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),10,14,20);
$pdf->Ln(4);
$pdf->SetFont('Arial','B',11);

$pdf->CellFitScale(190,5,strtoupper(get_column2("agency_name","select * from system_settings",$db)),0,0,'C');
    // Line break

$pdf->SetFont('Arial','B',12);

$pdf->Ln(5);
$pdf->CellFitScale(190,5,strtoupper(get_column2("system_name","select * from system_settings",$db)),0,0,'C');
    // Line break

$pdf->SetFont('Arial','B',12);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);


$pdf->SetTextColor(0,50,0);
$pdf->Cell(190,4,"STUDENT's TEST ANSWERS",0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->CellFitScale(20,5,"LRN : ",0,0,'R');
$pdf->CellFitScale(80,5,get_column2("lrn","select * from m_student_information where id = '$student_id'",$db),0,0,'L');
$pdf->CellFitScale(20,5,"GENDER : ",0,0,'L');
$pdf->CellFitScale(80,5,get_column2("gender","select * from m_student_information where id = '$student_id'",$db),0,0,'L');
$pdf->Ln(5);
$pdf->CellFitScale(20,5,"NAME : ",0,0,'R');
$pdf->CellFitScale(80,5,get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_student_information where id = '$student_id'",$db),0,0,'L');
$pdf->CellFitScale(20,5,"DATE : ",0,0,'L');
$pdf->CellFitScale(80,5,get_column2("date_added","select * from t_student_answer where student_id = '".$student_id."'",$db),0,0,'L');

$pdf->Ln(10);
	$pdf->SetWidths(Array(10,100,20,20,20));
	$pdf->setAligns(Array('C','L','C'));
	$pdf->Row(Array(
					"No",
					"Question",
					"Answer",
					"Status",
					"Points Earned"
				));
			$i=1;
			$ssql = "select * from t_questions where exam_id = 37";
			$sdata = $db->query($ssql)->fetchAll();
			$icon="";
                                            $class="";
                                            $points=0;
                                            $total=0;
			foreach ($sdata as $srow) {
				  $answer = strtolower(get_column2("answer","select * from t_student_answer where student_id = '".$student_id."' and question_id = '".$srow['id']."'",$db));
                                            $qanswer = strtolower($srow['answer']);
                                            if($qanswer==$answer){
                                                $class="/";
                                                $icon = "fa fa-check";
                                                $points = 1;
                                            }else {
                                                $class="X";
                                                $icon = "fa fa-times";
                                                $points = 0;
                                            }
                                             $total = $total + $points;
			$pdf->SetFont('Arial','',8);
				$pdf->Row(Array(
					$i,
					strip_tags($srow['question']),
					$answer,
					$class,
					$points
				));
				$i++;
			}

	$pdf->Cell(150,5,'TOTAL POINTS EARNED : ',1,0,'R');
	$pdf->Cell(20,5,$total,1,0,'C');
	$pdf->Cell(180,5,'*********Nothing Follows*********',0,0,'C');
$pdf->Ln(25);
}
$pdf->SetFont('Arial','',10);

$pdf->Cell(25,4,'',0,0,'C');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(280,4,"Prepared by : ",0,0,'L');
$pdf->Ln(10);
$pdf->Cell(55,4,'',0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(280,4,$_SESSION['data']['account_name'],0,0,'L');
$pdf->Ln();
$pdf->Cell(55,4,'',0,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(280,4,$_SESSION['data']['usertype'],0,0,'L');




$pdf->Output();


?>
