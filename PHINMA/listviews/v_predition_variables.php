<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
	} else {  
	    $page = $_REQUEST['param'];  
	}  
	$i=1;
	$results_per_page = 10;
	$page_first_result = ($page-1) * $results_per_page;  
	$sql = "select * FROM t_prediction_variables ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * FROM t_prediction_variables ";
		}
		else{
				$final_sql = "select *  FROM t_prediction_variables LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select *  FROM t_prediction_variables LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_predition_variables','display_list','<?php echo ($page-(1))  ?>' + '&search')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_predition_variables','display_list','<?php echo ($page+1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th style="width:10%">Student No</th>
					<th>SHS Ave</th>
					<th>Learning Style</th>
					<th>Way of understandng the topic </th>
					<th>Review Mode</th>
					<th>EQ_Trustful</th>
					<th>EQ_Dyscontrolled</th>
					<th>EQ_Timid</th>
					<th>EQ_Depressed</th>
					<th>EQ_Distrustful</th>
					<th>EQ_Controlled </th>
					<th>EQ_Aggresive </th>
					<th>EQ_Gregarious</th>
					<th>EQ_Bias</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					
			?>
				<tr>
				 <td><?php echo $i + (($page - 1) * 10) ?></td>
				<td><?php echo get_column2("student_id","select * from m_student_information where id = '".$row['student_id']."'",$db) ?></td>
				<td><?php echo $row['shs_grade'] ?></td>
				<td><?php echo $row['learning_style'] ?></td>
				<td><?php echo $row['review_mode'] ?></td>
				<td><?php echo $row['understanding_topic'] ?></td>
				<td><?php echo $row['EQ_Trustful'] ?></td>
				<td><?php echo $row['EQ_Dyscontrolled'] ?></td>
				<td><?php echo $row['EQ_Timid'] ?></td>
				<td><?php echo $row['EQ_Depressed'] ?></td>
				<td><?php echo $row['EQ_Distrustful'] ?></td>
				<td><?php echo $row['EQ_Controlled'] ?></td>
				<td><?php echo $row['EQ_Aggresive'] ?></td>
				<td><?php echo $row['EQ_Gregarious'] ?></td>
				<td><?php echo $row['EQ_Bias'] ?></td>

				
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo get_column2("student_id","select * from m_student_information where id = '".$row['student_id']."'",$db) ?>','deletepredictor','../listviews/v_predition_variables','display_list',1)"><i class="ti ti-trash"></i></button>
					</div>
				</td>
				</tr>
			<?php
			$i++;
				}

				?>
			</tbody>		
		</table>
		</div>
</div>
<script>
function get_edit(id,a,b,c,d,e,f,g){
	$('#eid').val(id);
	$('#student_id').val(a);
	$('#fn').val(b);
	$('#mn').val(c);
	$('#ln').val(d);
	$('#gender').val(e);
	$('#dob').val(f);
	$('#address').val(g);
}
function get_delete(id){
	$('#did').val(id);
}
function get_deleterole(id){
	$('#ddid').val(id);
}
function get_id(id){
	$('#txttypeid').val(id);
	listrecord('../listviews/d_facilities','display_facilities',id);
}
</script>