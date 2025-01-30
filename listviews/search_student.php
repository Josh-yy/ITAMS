<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	$final_sql = "select id, student_id,concat(fn, ' ', mn, ' ', ln)  as ename, gender,birthdate,address,fn,mn,ln,curr_id  from m_student_information a where concat(fn, ' ', mn, ' ', ln)  LIKE '%".$_REQUEST['param']."%' OR a.student_id LIKE '%".$_REQUEST['param']."%' ";
	$data = $db->query($final_sql)->fetchAll();


?>

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
					if(get_exist2("select * from t_class_students where student='".$row['id']."' ",$db)==0){
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
						<button id="btn<?php echo $row['id'] ?>" class="btn btn-success" onclick="add_student('<?php echo $row['id'] ?>','<?php echo $_POST['class_id'] ?>','<?php echo $row['ename'] ?>')">
								<i class="ti ti-plus"></i>
						</button>
					</div>
				</td>
				</tr>
			<?php
			$i++;
				}
			}

				?>
			</tbody>		
		</table>
		</div>
<script>
function add_student(student_id,class_id,name){
  Swal.fire({
  title: 'Add Student?',
  text: "Are you sure you want to add " + name + ' to the class list?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/add_student',
        cache: false,
        data: 'student_id=' + student_id + "&class_id=" + class_id,
        beforeSend: function(){
            $('#btn' + student_id).attr('disabled',true);
        },
        success:function(data){
             Swal.fire(
            name + 'has been Added!',
            'the student is already added on the class list',
            'success'
          );
         listrecord('../listviews/v_class_list','display_class_list',1 + '&class_id=<?php echo $_POST['class_id'] ?>');
        }
    })
    
 
  }
})

}
</script>