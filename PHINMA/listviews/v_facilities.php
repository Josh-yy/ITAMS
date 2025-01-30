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
	$sql = "select a.id, a.facility_name,a.description,a.facility_link,a.orderno,a.ismenu, CASE WHEN a.node = 1 then 'Configuration Settings' when a.node = 2 then 'File Manager' when a.node = 3 then 'Transaction' when a.node = 4 then 'Report' when a.node = 5 then 'Dashboard' END as node,a.date_added,a.node as anode from m_facilities a ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select a.id, a.facility_name,a.description,a.facility_link,a.orderno,a.ismenu, CASE WHEN a.node = 1 then 'Configuration Settings' when a.node = 2 then 'File Manager' when a.node = 3 then 'Transaction' when a.node = 4 then 'Report' when a.node = 5 then 'Dashboard' END as node,a.date_added,a.node as anode from m_facilities a where a.description LIKE '%".$_REQUEST['search']."%' OR a.facility_link LIKE '%".$_REQUEST['search']."%' OR a.facility_name LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select a.id, a.facility_name,a.description,a.facility_link,a.orderno,a.ismenu, CASE WHEN a.node = 1 then 'Configuration Settings' when a.node = 2 then 'File Manager' when a.node = 3 then 'Transaction' when a.node = 4 then 'Report' when a.node = 5 then 'Dashboard' END as node,a.date_added,a.node as anode from m_facilities a LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select a.id, a.facility_name,a.description,a.facility_link,a.orderno,a.ismenu, CASE WHEN a.node = 1 then 'Configuration Settings' when a.node = 2 then 'File Manager' when a.node = 3 then 'Transaction' when a.node = 4 then 'Report' when a.node = 5 then 'Dashboard' END as node,a.date_added,a.node as anode from m_facilities a LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_facilities','display_list','<?php echo ($page-1) ?>' + '&search=' )"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_facilities','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th>Facility Name</th>
					<th>Description</th>
					<th>Node</th>
					<th>Link</th>
					<th>Date Added</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
			?>
				<tr>
				 <td><?php echo $i ?></td>
				<td><?php echo $row['facility_name'] ?></td>
				<td><?php echo $row['description'] ?></td>
				<td><?php echo $row['node'] ?></td>
				<td><?php echo $row['facility_link'] ?></td>
				<td><?php echo $row['date_added'] ?></td>

				<td>
					<div class="btn-group">
					<button class="btn btn-warning btn-sm" id="btn_edit_user" onclick='get_edit("<?php echo $row['id'] ?>","<?php echo $row['facility_name'] ?>","<?php echo $row['description'] ?>","<?php echo $row['facility_link'] ?>","<?php echo $row['anode'] ?>","<?php echo $row['orderno'] ?>","<?php echo $row['ismenu'] ?>")' data-bs-toggle="modal" data-bs-target="#mdlupdate"><i class="ti ti-edit"></i></button>


					<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['facility_name'] ?>','delete_facility','../listviews/v_facilities','display_list','1')"><i class="ti ti-trash"></i></button>
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

function get_edit(id,a,b,c,d,e,f)
{
  $('#a').val(a);
  $('#b').val(b);
  $('#c').val(c);
  $('#d').val(d);
  $('#order').val(e);
  $('#ismenu').val(f);
  $('#eid').val(id);
}

function get_delete_id(id)
{
  $('#did').val(id);
}

</script>