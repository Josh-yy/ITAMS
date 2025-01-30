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
$pdf->Image('../images/' . get_column2("logo","select * from system_settings",$db),10,14,20);
$pdf->Ln(4);
$pdf->SetFont('Arial','B',11);

$pdf->CellFitScale(280,5,strtoupper(get_column2("agency_name","select * from system_settings",$db)),0,0,'C');
    // Line break

$pdf->SetFont('Arial','B',12);


$pdf->SetFont('Arial','B',12);


$pdf->SetTextColor(0,50,0);
$pdf->Cell(280,4,"EQ TEST RESULTS",0,0,'C');
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
					"COURSE","INCONSISTENCY INDEX"
				));
$i= 1;
$sql = "";
 if($_REQUEST['date_added']=="")
 				{
                $sql= "select a.*, concat(a.fn, ' ', a.mn, ' ',a.ln) as ename from m_student_information a inner join t_student_answer b on a.id = b.student_id  where exam_id = 36 group by b.student_id";
               }
               else{
                $sql= "select a.*,concat(a.fn, ' ', a.mn, ' ',a.ln) as ename from m_student_information a inner join t_student_answer b on a.id = b.student_id where date_format(b.date_added,'%Y-%m-%d') = '".$_REQUEST['date_added']."'  and  exam_id = 37group by b.student_id";   
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
					get_incosistency_index($row['id'],$db) 
				));
				$i++;

		}
$pdf->Cell(280,5,'*********Nothing Follows*********',0,0,'C');
$pdf->Ln(25);
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
$pdf->SetFont('Arial','B',12);
$pdf->CellFitScale(180,10,"BAR ON " . get_column2("exam_name","select * from t_exam_maker where id = 37",$db) . "i:S Scoring Page" ,1,1,'C');

$pdf->SetWidths(Array(180));
$pdf->setAligns(Array('C'));
$pdf->SetFont('Arial','',8);
				$pdf->Row(Array(
					'Instructions : Transfer the Circled numbers into the boxes accross each row as indicated at the top of the scoring grids. For items 1 to 26, write the shaded bozes, for 26 to 51 write on the unshaded boxes. Each circled number will be copied onec. The obtained raw scores for the scales, A,B,C,D,E and G, add the numbers in each column and enter the sum in the box at the bottom columns. The raw score for scale F is the sum of the raw scores for scales A-E, divided by 5. Once boxes A,B,C,D,E,F and G have filled in, use the appropriate Profile Sheet in the complete assessment set to plot the scores.',
				));
$array_letters = ['A','B','C','D','E','F','G'];

$pdf->SetFont('Arial','B',9);
$array_left_wing_answer = [27,28,29,30,31,32,33,34,0,35,36,37,38,39,40,0,41,42,43,44,45,46,47,48,49,50,51];
$array_right_wing_answer = [1,2,3,4,5,6,7,8,9,10,0,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26];
$pdf->Cell(20,5,"",0,0,'C');
$pdf->Cell(20,5,"QUESTION",1,0,'C');
foreach($array_letters as $nletter){
		$pdf->Cell(15,5,$nletter,1,0,'C');
	}
$pdf->Cell(20,5,"QUESTION",1,0,'C');
	$pdf->Ln();

for($i=0; $i<count($array_left_wing_answer); $i++)
{
	$pdf->Cell(20,5,"",0,0,'C');
	//push left wing questions
	if($array_left_wing_answer[$i]!==0){
		$pdf->Cell(20,5,"No. " . $array_left_wing_answer[$i] ,1,0,'C');
	}else{
		$pdf->Cell(20,5,"",1,0,'C');
	}
	
	foreach($array_letters as $nletter){
		$get_answer_column_left = get_column2("answer_column","select * from t_questions where id= '".$array_left_wing_answer[$i]."' ",$db);
		$get_answer_column_right = get_column2("answer_column","select * from t_questions where id= '".$array_right_wing_answer[$i]."' ",$db);
		$answer_right = get_column2("answer","select * from t_student_answer where student_id = '".$student_id."' and question_id = '".$array_right_wing_answer[$i]."' ",$db);
		$answer_left = get_column2("answer","select * from t_student_answer where student_id = '".$student_id."' and question_id = '".$array_left_wing_answer[$i]."' ",$db);

		if($get_answer_column_left==$nletter){
			$pdf->Cell(15,5,$answer_left,1,0,'C',0);
		}
		else if($get_answer_column_right==$nletter){
			$pdf->Cell(15,5,$answer_right,1,0,'C',0);
		}else{
			$pdf->Cell(15,5,"",1,0,'C',1);
		}		
	}
	//push right wing questions
	if($array_right_wing_answer[$i]!==0){
		$pdf->Cell(20,5,"No. " . $array_right_wing_answer[$i],1,0,'C');
	}else{
		$pdf->Cell(20,5,"",1,0,'C');
	}
	
	$pdf->Ln();
}

$pdf->Cell(20,5,"",0,0,'C');
$pdf->Cell(20,5,"",0,0,'C');
foreach($array_letters as $nletter){
	$sql_reader = "select SUM(b.answer) as totalsum,a.answer_column from t_questions a inner join t_student_answer b on a.id = b.question_id where student_id = '".$student_id."' and a.exam_id  = 36 and a.answer_column = '".$nletter."' group by a.answer_column ";
	$sum = get_column2("totalsum",$sql_reader,$db);
		$pdf->Cell(15,5,$sum,1,0,'C');
	}
$sum_ae = "select SUM(b.answer) as totalsum,a.answer_column from t_questions a inner join t_student_answer b on a.id = b.question_id where student_id = '".$student_id."' and a.exam_id  = 36 and a.answer_column IN ('A','B','C','D','E')  ";
$pdf->Cell(20,5,"",0,0,'C');
$pdf->Ln();
$pdf->Cell(20,5,"",0,0,'C');
$pdf->Cell(20,5,"",0,0,'C');
$pdf->Cell(60,5,"Sum of Row Scores A-E",1,0,'C');
$pdf->Cell(15,5,get_column2("totalsum",$sum_ae,$db),1,0,'C');
$pdf->Cell(15,5," / 5 = ",1,0,'C');
$pdf->Cell(15,5,get_column2("totalsum",$sum_ae,$db) / 5,1,0,'C');

$pdf->Ln();
$pdf->Cell(20,5,"INCONSISTENCY INDEX",0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','B',4);
	$pdf->Cell(5,2,"Item 14",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 10",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 34",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 13",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 46",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 17",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 23",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 22",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 40",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 27",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 9",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 31",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 37",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 33",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 48",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 35",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 41",0,0,'C');
	$pdf->Cell(5,2,"",0,0,'C');
	$pdf->Cell(5,2,"Item 43",0,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,2,"Item 47",0,0,'C');
	

	$pdf->Ln();
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 14 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 10 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 34 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 13 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 46 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 17 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 23 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 22 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 40 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 27 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 9 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 31 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 37 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 33 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 48 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 35 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 41 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 43 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(1,1,"",0,0,'C');
	$pdf->Cell(5,5,get_column2("answer","select answer from t_student_answer where question_id = 47 and student_id = '$student_id' and exam_id = 36",$db),1,0,'C');
	$pdf->Cell(5,5,"",0,0,'C');
	$pdf->SetFont('Arial','B',8);
	
	$pdf->CellFitScale(25,5,"INCONSISTENCY INDEX TOTAL",1,0,'C');
	$pdf->Ln();

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(5,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 14 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');
	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 10 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 34 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');
	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 13 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 46 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');//

	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 17 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 23 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');//
	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 22 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 40 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');//

	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 27 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 9 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C'); //

	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 31 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 37 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');

	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 33 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 48 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');//
	
	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 35 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 41 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');
	
	$pdf->Cell(5,5,"+",0,0,'C');
	$pdf->Cell(11,5,abs(get_column2("answer","select answer from t_student_answer where question_id = 43 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 47 and student_id = '$student_id' and exam_id = 36",$db)),1,0,'C');
	$pdf->Cell(5,5,"=",0,0,'C');
	$pdf->SetFont('Arial','B',8);
	
	

	$final_total = get_column2("answer","select answer from t_student_answer where question_id = 14 and student_id = '$student_id' and exam_id = 36",$db) + abs(get_column2("answer","select answer from t_student_answer where question_id = 10 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 34 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 13 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 46 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 17 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 23 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 22 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 40 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 27 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 9 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 31 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 37 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 33 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 48 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 35 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 41 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 43 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 47 and student_id = '$student_id' and exam_id = 36",$db));
	$pdf->CellFitScale(25,5,$final_total,1,0,'C');
$pdf->Ln();
$pdf->Ln(25);
}
$pdf->Output();

function get_incosistency_index($student_id,$db){
    $final_total = get_column2("answer","select answer from t_student_answer where question_id = 14 and student_id = '$student_id' and exam_id = 36",$db) + abs(get_column2("answer","select answer from t_student_answer where question_id = 10 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 34 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 13 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 46 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 17 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 23 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 22 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 40 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 27 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 9 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 31 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 37 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 33 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 48 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 35 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 41 and student_id = '$student_id' and exam_id = 36",$db)) + abs(get_column2("answer","select answer from t_student_answer where question_id = 43 and student_id = '$student_id' and exam_id = 36",$db) - get_column2("answer","select answer from t_student_answer where question_id = 47 and student_id = '$student_id' and exam_id = 36",$db));
    return $final_total;
}
?>
