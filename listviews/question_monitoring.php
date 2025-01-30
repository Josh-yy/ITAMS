<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$question_number = $_REQUEST['qno'];
$exam_id = $_REQUEST['exam_id'];
$sid = $_SESSION['data']['account_id'];

$sql = "select * from t_student_question_aranger a inner join t_questions b on a.question_id = b.id WHERE a.student_id = '$sid' and a.exam_id = '$exam_id' ";
$data = $db->query($sql)->fetchAll();
$counter = 1;
$class="";
$icon="ti ti-circle-x";
foreach($data as $row){
		if(get_exist2("select * from t_student_mock_answer where student_id = '$sid' and exam_id = '$exam_id' and question_id = '".$row['question_id']."'",$db)>0){
			$class="btn btn-outline-success";
			$icon="ti ti-thumb-up";
		}else{
			$class="btn btn-outline-warning";
			$icon="ti ti-circle-x";
		}
	
?>
	<button type="button"  class="<?php echo $class ?>" style="width:50px" class=" d-inline-flex" onclick="move_question('<?php echo $row['qnumber'] ?>','<?php echo $exam_id ?>')"><i class="<?php echo $icon ?>"></i> <?php echo $row['qnumber'] ?></button>
<?php
if($counter==10){
		$counter = 1;
		echo "<br>";
	}
}
?>

