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
	$sql = "select * from m_asset_category ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_software_assets a where a.code LIKE '%".$_REQUEST['search']."%' OR a.software_name LIKE '%".$_REQUEST['search']."%' OR a.serial_number LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_software_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_software_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_assets','display_list','<?php echo ($page-(1))  + '&search=' ?>')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_assets','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th><input type="checkbox" id="checkall" value="<?php echo $row[0] ?>">All</th>
					<th>QR Code</th>
					<th>Software Info</th>
					<th>Type</th>
					
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					$class="";
						if(get_exist2("select * from t_hardware_software_installed where asset_id = '".$_REQUEST['hardware_id']."' and software_id = '".$row['id']."'",$db)==0){
			?>
				<tr>
				 <td><input type="checkbox" name="lab_id[]" value="<?php echo $row['id'] ?>">
				<td style="width:10%"><img src="../assets/img/qr_codes/<?php echo $row['qr_auto_code'] ?>.png" style="width:100%"></td>
				<td>
					<b>Code : </b><?php echo $row['code'] ?><br>
					<b>Name : </b><?php echo $row['software_name'] ?><br>
					<b>Serial No. : </b><?php echo $row['serial_number'] ?><br>
					<b>Date Purchased : </b><?php echo $row['date_purchased'] ?><br>
					<b class="badge bg-warning"><?php echo $row['license_type'] ?></b>
				</td>
				<td><?php echo get_column2("name", "select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db) ?></td>
			
				</tr>
			<?php
			$i++;
				}
			}
				?>
			</tbody>		
		</table>
		</div>
</div>
 <script type="text/javascript">
               $('#checkall').change(function() {
                // this represents the checkbox that was checked
                // do something with it
                var checked = $(this).is(':checked'); // Checkbox state
                 // Select all
                 if(checked){
                  $(this).closest('table').find('tbody :checkbox')
                    .prop('checked', this.checked)
                    .closest('tr').toggleClass('selected', this.checked);
                 }else{
                   // Deselect All
                    $(this).closest('table').find('tbody :checkbox')
                    .prop('checked', this.checked)
                    .closest('tr').toggleClass('selected', false);
                 }
            });
            </script>