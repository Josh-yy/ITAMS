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

$sid = get_column2("id","select * from m_student_information where student_id = '".$_REQUEST['sid']."'",$db);

// Instanciation of inherited class

$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetWidths(Array(10,60,40,20,60,40,30));
$pdf->SetLineHeight(5);
$pdf->AddPage('P','A4','');
    // Arial bold 15
$pdf->SetFont('Arial','',8);
// Title
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),180,7,17);

$pdf->Cell(280,5,get_column2("name","select * from system_settings",$db),0,0,'L');
// Line break
$pdf->Ln(5);


// Line break
$pdf->SetFont('Arial','',12);
$pdf->Cell(280,5,"INDIVIDUAL RESULTS",0,0,'L');

$pdf->Ln(5);

$pdf->SetFillColor(230,230,230);
$pdf->Cell(185,1,'',0,1,'L',1); //your cell
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,5,"ID # : ",0,0,'L');
$pdf->Cell(100,5,get_column2("student_id","select student_id from m_student_information where id = '".$sid."'",$db) ,0,0,'L');
$pdf->Ln();
$pdf->Cell(40,5,"NAME: ",0,0,'L');
$pdf->Cell(100,5,get_column2("ename","select concat(ln, ' ', fn, ' ', mn) as ename from m_student_information where id = '".$sid."'",$db),0,0,'L');
$pdf->Ln();
$pdf->Cell(40,5,"GENDER: ",0,0,'L');
$pdf->Cell(100,5,get_column2("gender","select gender from m_student_information where id = '".$sid."'",$db),0,0,'L');
$pdf->Ln();
$pdf->Cell(40,5,"ADDRESS: ",0,0,'L');
$pdf->Cell(100,5,get_column2("address","select * from m_student_information where id = '".$sid."'",$db),0,0,'L');
$pdf->Ln();
$pdf->SetFillColor(230,230,230);
$pdf->Cell(185,1,'',0,1,'L',1); //your cell
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(Array(10,100,35,40));
$pdf->SetAligns(Array('C','L','C','C'));
$pdf->Row(Array(
					"NO",
					"SUBJECT GROUP",
					"SCORE",
					"PERCENTAGE",
				));
$i= 1;
$pdf->SetFont('Arial','',10);
$total_percentage=0;
$total_score=0;
 $sql = "select * from t_mock_subject_group_grade where student_id = '".$sid."' and exam_id = (select exam_id from t_student_mock where student_id = '$sid' and sy_id = (select sy_id from m_sy where is_active = 1))";
 $data = $db->query($sql)->fetchAll();
 
                                  foreach($data as $row){
                                  	$exam_percetage = get_column2("subject_group_percentage_arr","select * from t_examination_manager where id = '".$row['exam_id']."'",$db);
                                      $array_percentage = json_decode($exam_percetage, true);

                                  	$total_percentage+=$row['percentage'];
                                  	$total_score+=$row['total_score'];
                                  	$total_items = get_column2("total_items","select * from t_items_per_subject_group where category_id = '".$row['subject_group_id']."'",$db) ;
									$pdf->SetFont('Arial','',9);
									$pdf->Row(Array(
										$i,
										get_column2("category_name","select * from m_subject_category where id = '".$row['subject_group_id']."'",$db) . " [ " . get_percentage($row['subject_group_id'],$array_percentage) . " % ]",
										$row['total_score'] . " / " . $total_items,
										$row['percentage'] . " %" ,
									));
									$i++;
								}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(110,5,"TOTAL",1,0,'R');								
$pdf->Cell(35,5,$total_score,1,0,'C');
$pdf->Cell(40,5,$total_percentage . " %",1,0,'C');
$pdf->Ln();
 $remarks = get_column2("remarks","select * from t_student_mock where student_id = '".$sid."' and sy_id = (select sy_id from m_sy where is_active = 1)",$db);
                                  if($remarks=="Passed"){
                                    $class = "bg-green-100";
                                  }else{
                                    $class = "bg-red-100";
                                  }
$pdf->Cell(145,5,"REMARKS",1,0,'R');								
$pdf->Cell(40,5,$remarks,1,0,'C');
$pdf->Ln(10);
$pdf->Cell(185,1,'',0,1,'L',1); //your cell
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

$i=1;
$pdf->SetFont('Arial','',7);
//get the questions here and the earned points
$sql = "select * from t_mock_questions where exam_setting_id = (select exam_id from t_student_mock where student_id = '$sid' and sy_id = (select sy_id from m_sy where is_active = 1))";
$data = $db->query($sql)->fetchAll();
$pdf->SetWidths(Array(10,100,25,25,25));
$pdf->SetAligns(Array('C','L','C','C','C'));
$pdf->Row(Array(
					"NO",
					"QUESTION",
					"YOUR ANSWER",
					"CORRECT ANSWER",
					"POINTS EARNED"
				));
foreach($data as $row){
$pdf->Row(Array(
				$i,
				strip_tags(get_column2("question","select question from t_questions where id = (select question_id from t_student_mock_answer where student_id = '".$sid."' and exam_id = '".$row['exam_setting_id']."' and question_id = '".$row['question_id']."')",$db)) ,
				get_column2("answer","select * from t_student_mock_answer where student_id = '".$sid."' and exam_id = '".$row['exam_setting_id']."'",$db),
				get_column2("correct_answer","select * from t_student_mock_answer where student_id = '".$sid."' and exam_id = '".$row['exam_setting_id']."'",$db),
				get_column2("points_earned","select * from t_student_mock_answer where student_id = '".$sid."' and exam_id = '".$row['exam_setting_id']."'",$db),
				));
		$i++;
}
$pdf->Output();
?>
