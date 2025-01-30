<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$asset_id = $_REQUEST['hadware_asset_id'];
	if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
	} else {  
	    $page = $_REQUEST['param'];  
	}  
	$i=1;
	$results_per_page = 10;
	$page_first_result = ($page-1) * $results_per_page;  
	$sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id WHERE  username LIKE '%".$_REQUEST['search']."%' and is_active = 1 ";
		}
		else{
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id WHERE  is_active = 1 LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id WHERE is_active = 1 "  . $page_first_result . ',' . $results_per_page; 
			}

				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_search_users','display_list','<?php echo ($page-(1))  + '&search=' ?>')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_search_users','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
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
				
			
				</tr>
			</thead>
				<?php
				foreach ($data as $row) {
					if(get_exist2("select * from t_user_assignment where user_id = '".$row['id']."'",$db)>0){
					if($row['avatar']!=""){
						$src = "../assets/employee/".$row['qr_code']."/" . $row['avatar'];
					}
					else{
						$src = "../assets/employee/nopic.png";
					}
					$qrcode =  "../assets/images/qrcode/".$row['qr_code'] . ".png";
					$name = $row['fn'] . " " . $row['mn'] . " " . $row['ln'] . " [ ".get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db)." ] ";
			?>	
				<tr role="button" onclick="get_user_info('<?php echo $name ?>','<?php echo $row['id'] ?>','<?php echo $asset_id ?>')"> 
				<td style="width:5%"><img src="<?php echo $src ?>" style="width:100%"></td>
				<td>
					<b class="text-secondary"><?php echo $row['fn'] ?> <?php echo $row['mn'] ?> <?php echo $row['ln'] ?></b>
					
					<br>
					<span class="mb-1"><?php echo $row['gender'] ?></span> | 
					<span class="mb-1"><?php echo $row['civil_status'] ?></span>
					<br>
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
				<td><?php echo get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) =="" ? "NA" : get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) ?></td>
			
			</tr>	
			<?php	
				}
			}
			?>
		</table>
		</div>
</div>

<script>
function get_user_info(user,id,asset_id){
	$('#txtuser').val(user);
	$('#mdl_search_user .close').click();
	loadcontent("listviews/search_selected_user","display_selected_user",id + "&asset_id=" + asset_id);
}
</script>

