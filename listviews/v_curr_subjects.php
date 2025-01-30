
<div class="col-sm-12">
<div class="card dashnum-card dashnum-card-small overflow-hidden">
  <span class="round bg-success small"></span>
  <span class="round bg-success big"></span>
<div class="card-header">
<b class="text-success"><i class="ti ti-folders"></i> Subjects Added to the Curriculum</b>
 <span class="input-group" style="floar:right">
                         
                         
                          <button class="btn btn-outline-secondary btn-sm " data-bs-toggle="modal" data-bs-target="#addnewcurrsub" onclick="listrecord('listviews/d_subjects','dusplaysubjects','<?php echo $_POST['param']  ?>' + '&search=')"><i class="ti ti-plus"></i> Add New</button>

                        </span>
</div>
<div class="card-body">
<div class="accordion card" id="accordionExample">

<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sql = "select * from t_curr_subjects where curr_id = '".$_POST['param']."'";

$ydata = $db->query("select * from m_year_level")->fetchAll();
foreach($ydata as $row){
?>
<div class="accordion-item">
<h2 class="accordion-header" id="headingThree<?php echo $row['id'] ?>">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['id'] ?>" aria-expanded="false" aria-controls="collapseThree">
<?php echo $row['year_level'] ?>
</button>
</h2>
<div id="collapse<?php echo $row['id'] ?>" class="accordion-collapse collapse" aria-labelledby="headingThree<?php echo $row['id'] ?>" data-bs-parent="#accordionExample">
<div class="accordion-body">
<?php
	$sql = "select * from m_semester";
	$sem_data = $db->query($sql)->fetchAll();
	foreach($sem_data as $srow){
?>
	<div class="card dashnum-card dashnum-card-small overflow-hidden">
  		<span class="round bg-primary small"></span>
  		<div class="card-header">
  			<b class="text-gray-500"><?php echo $srow['semester'] ?></b>
  		</div>
  		<div class="card-body">
  			<table class="table table-bordered">
  				<tr>
  					<th>No</th>
  					<th>Subject</th>
  					<th>Group</th>
  				</tr>
  			<?php
  			$no = 1;
  				$vsql = "select * from t_curr_subjects where curr_id = '".$_POST['param']."' and sem_id = '".$srow['id']."' and year_level_id = '".$row['id']."'";
  				$vdata = $db->query($vsql)->fetchAll();
  				foreach($vdata as $vrow){
  			?>
  				<tr>
  					<td><?php echo $no ?></td>
  					<td><?php echo get_column2("subject_code","select * from m_subjects where id = '".$vrow['subject_id']."'",$db) ?></td>
  					<td><?php echo get_column2("category_name","select * from m_subject_category where id = (select subject_group from m_subjects where id = '".$vrow['subject_id']."')",$db) ?></td>
  				</tr>
  			<?php
  			$no++;
  				}

  			?>
  		</table>
  		</div>
  	</div>

<?php
}
?>
</div>
</div>
</div>
<?php
}
?>

</div>
</div>
</div>
</div>

