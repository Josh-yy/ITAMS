<?php
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
	$sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id WHERE username LIKE '%".$_REQUEST['search']."%' ";
		}
		else{
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id " . $page_first_result . ',' . $results_per_page; 
			}

				
	$data = $db->query($final_sql)->fetchAll();

?>
<link rel="stylesheet" href="fa/font-awesome/css/font-awesome.min.css">
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_users','display_list','<?php echo ($page - 1) ?>' + '&search=' )"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_users','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th style="width:5%">Photo</th>
					<th>User Information</th>
					<th>Account Information</th>
					<th>User Type</th>
					<th>Branch Assignment</th>
					
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					if($row['avatar']!=""){
						$src = "../assets/employee/".$row['qr_code']."/" . $row['avatar'];
					}
					else{
						$src = "../assets/employee/nopic.png";
					}
					$qrcode =  "../assets/images/qrcode/".$row['qr_code'] . ".png";
					

			?>
				<tr>
				<td style="width:5%"><img src="<?php echo $src ?>" style="width:100%"></td>
				<td>
					<b class="text-secondary"><?php echo $row['fn'] ?> <?php echo $row['mn'] ?> <?php echo $row['ln'] ?></b>
					<br>
				    <b class="text-secondary"><?php echo get_column2("name","select * from m_positions where id = '".$row['position_id'] ."'",$db)?></b>
				    <hr>
					<?php
						if($row['is_active']==1){
							echo '<span class="badge bg-success">Active</span>';
						}else{
							echo '<span class="badge bg-danger">In-active</span>';
						}
					?>

				</td>
				<td><span class="badge bg-secondary"><?php echo $row['username'] ?></span>				</td>

				<td><?php echo $row['typename'] ?></td>
				<td><?php echo get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) =="" ? "NA" : get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) ?><br>
				<?php echo get_column2("name","select * from m_department where id = '".$row['dept_id']."'",$db) ?>
				</td>
				
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
							<button class="btn btn-success" data-bs-target="#add_assignment" data-bs-toggle="modal" onclick="get_userid('<?php echo $row['id'] ?>')">
								<i class="ti ti-plus"></i> User Assignment 
							</button>
							<button class="btn-pill btn btn-warning" onclick="get_edit('<?php echo $row['id'] ?>','<?php echo $row['fn'] ?>','<?php echo $row['mn'] ?>','<?php echo $row['ln'] ?>','<?php echo $row['username'] ?>','<?php echo $row['usertype'] ?>','<?php echo $row['gender'] ?>','<?php echo $row['birthdate'] ?>','<?php echo $db->sanitize($row['address']) ?>','<?php echo $row['civil_status'] ?>','<?php echo $db->sanitize($row['avatar'])?>','<?php echo $db->sanitize($row['qr_code']) ?>','<?php echo $row['dept_id'] ?>','<?php echo $row['position_id'] ?>')" data-bs-toggle="modal" data-bs-target="#update"><i class="ti ti-edit"></i></button>
				<?php
				    if($row['is_active']==1){
				?>
				    <button class="btn-pill btn btn-danger" onclick="deactivate_record('<?php echo $row['id'] ?>','<?php echo $row['username'] ?>','deactivateuser','listviews/v_users','display_list','1')" ><i class="ti ti-user-minus"></i></button>
				<?php
				    }
				    else{
				    ?>
				    <button class="btn-pill btn btn-primary" onclick="activate_record('<?php echo $row['id'] ?>','<?php echo $row['username'] ?>','activateuser','listviews/v_users','display_list','0')" ><i class="ti ti-user-plus"></i></button>
				    <?php
				    }
				?>
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
function get_edit(id,a,b,c,d,e,f,g,h,i,j,k,l,m){
	//alert("../assets/images/" + k + "/" + j);
	$('#eid').val(id);
	$('#fn').val(a);
	$('#mn').val(b);
	$('#ln').val(c);
	$('#username').val(d);
	$('#usertype').val(e);
	$('#gender').val(f);
	$('#bdate').val(g);
	$('#address').val(h);
	$('#civil_status').val(i);
	$('#department').val(l);
	$('#position').val(m);
	if(j!==""){
		
		$('#avatars').attr("src","../assets/employee/" + k + "/" + j);
	}
	
}
function get_delete(id){
	$('#did').val(id);
}
function get_userid(userid){
	$('#userid').val(userid);
}
</script>

