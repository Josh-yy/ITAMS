<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	$final_sql = "select b.id, student_id,concat(fn, ' ', mn, ' ', ln)  as ename, gender,birthdate,address,fn,mn,ln,curr_id  from m_student_information a inner join t_class_students b on a.id = b.student where b.class_id ='".$_REQUEST['class_id']."' order by ename ";
	$data = $db->query($final_sql)->fetchAll();

?>
<input type="hidden" class="form-control" value="Students Information Masterlist SY <?php echo get_column2("sy","select * from m_sy where sy_id = '$sy_id'",$db) ?>" id="txttitle">
 <div class="row">
  <div class="row">
    <div class="col-10">&nbsp;</div>
  <div class="col-2">
    <div class="d-grid">
      <button class="btn btn-success btn-sm" id="exportToExcel"><i class="ti ti-download"></i> Export to Excel</button>  
    </div>
  </div>
  </div>
  <div class="row">
   <div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th style="width:10%">Student</th>
					<th>Gender</th>
					<th>Birthdate</th>
					<th>Address</th>
					<th>Add</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1;
				foreach ($data as $row) {
					$class="";
					if($row['gender']=="Female"){
						$class="bg-light-warning";
					}
					else{
						$class="bg-light-primary";
					}	
			?>
				<tr>
				 <td><?php echo $i  ?></td>
				<td>
					<b><?php echo $row['student_id'] ?></b>
					<br>
				<?php echo $row['ename'] ?></td>
				<td><span class="badge <?php echo $class ?>"><?php echo $row['gender'] ?></span></td>
				<td><?php echo $row['birthdate'] ?></td>
				<td><?php echo $row['address'] ?></td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_records('<?php echo $row['id'] ?>','<?php echo $row['ename'] ?>','deleteclasslist','../listviews/v_class_list','display_class_list','<?php echo $_REQUEST['class_id'] ?>')"><i class="ti ti-trash"></i></button>
						</button>
					</div>
				</td>
				</tr>
			<?php
			$i++;
				}

				?>
				<tr style="display: none;">
					<td colspan="6"><b><?php echo get_column2("ename","select concat(fn, ' ',mn, ' ', ln) as ename from m_users where id = (select adviser_id from m_class_info where id ='".$_POST['class_id']."')",$db) ?></b></td>
				</tr>
				<tr style="display: none;">
					<td colspan="6">Adviser</td>
				</tr>
			</tbody>		
		</table>
		</div>
</div>
</div>
<script>


function delete_records(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Delete Record?',
  text: "Are you sure you want to remove " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/delete_records',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){
             Swal.fire(
            'Record Deleted!',
            'Transaction Completed',
            'success'
          )
           listrecord('../listviews/v_class_list','display_class_list',1 + '&class_id=<?php echo $_POST['class_id'] ?>');
        }
    })
    
 
  }
})
}

</script>