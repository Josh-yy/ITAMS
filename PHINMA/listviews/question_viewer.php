<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$question_number = $_REQUEST['qno'];
$exam_id = $_REQUEST['exam_id'];
$sid = $_SESSION['data']['account_id'];

$sql = "select * from t_student_question_aranger a inner join t_questions b on a.question_id = b.id WHERE a.student_id = '$sid' and a.exam_id = '$exam_id' and a.qnumber='$question_number '";

?>
<div class="card">
	<div class="card-header ">
		<b class="btn btn-secondary rounded-pill">Question # <?php echo get_column2("qnumber",$sql,$db) ?></b>
	</div>
	<div class="card-body bg-gray-200" style="height: 200px;">
		<b style="font-size:18px"><?php echo get_column2("question",$sql,$db) ?></b>
		<?php
			function get_checked($qid,$exam_id,$sid,$answer,$db){
				if(get_column2("answer","select * from t_student_mock_answer where student_id = '$sid' and exam_id = '$exam_id' and question_id = '$qid'",$db)==$answer){
					return "checked";
				}else{
					return "";
				}
			}
		?>
	</div>
	<div class="card-footer">
		<table class="table table-striped">
			
				<tr>
					<td>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" onchange="pre_store_answer('<?php echo $exam_id ?>','A','<?php echo get_column2("id",$sql,$db) ?>','choicea')" name="group4" value id="choicea" <?php echo get_checked(get_column2("id",$sql,$db),$exam_id,$sid,"A",$db) ?>>
						<b class="form-check-label" for="flexCheckChecked"><?php echo get_column2("a",$sql,$db) ?></b>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" name="group4" onchange="pre_store_answer('<?php echo $exam_id ?>','B','<?php echo get_column2("id",$sql,$db) ?>','choiceb')" value id="choiceb" <?php echo get_checked(get_column2("id",$sql,$db),$exam_id,$sid,"B",$db) ?>>
						<b class="form-check-label" for="flexCheckChecked"><?php echo get_column2("b",$sql,$db) ?></b>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" name="group4" onchange="pre_store_answer('<?php echo $exam_id ?>','C','<?php echo get_column2("id",$sql,$db) ?>','choicec')" value id="choicec" <?php echo get_checked(get_column2("id",$sql,$db),$exam_id,$sid,"C",$db) ?>>
						<b class="form-check-label" for="flexCheckChecked"><?php echo get_column2("c",$sql,$db) ?></b>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" name="group4" onchange="pre_store_answer('<?php echo $exam_id ?>','D','<?php echo get_column2("id",$sql,$db) ?>','choiced')" value id="choiced" <?php echo get_checked(get_column2("id",$sql,$db),$exam_id,$sid,"D",$db) ?>>
						<b class="form-check-label" for="flexCheckChecked"><?php echo get_column2("d",$sql,$db) ?></b>
						</div>
					</td>
				</tr>
				
			
		</table>
	</div>
</div>
<script>
//this function pre-stores the answer to the database to have an easier access for counting scores
function pre_store_answer(exam_id,answer,question_id,checkboxid){
	if($('#' + checkboxid).is(':checked'))
		{
		 $.ajax({	
				type:'POST',
				data: 'exam_id=' + exam_id + '&answer=' + answer + '&question_id=' + question_id,
				cache:false,
				url:'../controllers/prestore_answer',
				success:function(data){
					listrecord("listviews/question_monitoring","question_monitoring",1+"&qno=" + '<?php echo $question_number ?>' + "&exam_id=" + exam_id);
				}
			})
		}
	
}
</script>