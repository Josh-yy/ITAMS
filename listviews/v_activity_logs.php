<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

	$final_sql = "";
	
			if($_REQUEST['type']!==""){
				$final_sql = "select *,date_format(date_performed,'%Y-%m-%d  %r') as timeprint  from t_activity_logs a where date_format(date_performed,'%Y-%m-%d') between  '".$_REQUEST['txtfrom']."' and '".$_REQUEST['txxto']."' and activity='".$_REQUEST['type']."' ";
        		}
        		else{
        				$final_sql = "select *,date_format(date_performed,'%Y-%m-%d  %r') as timeprint from t_activity_logs order by id desc";
        		}
	
	
$i=1;
				
	$data = $db->query($final_sql)->fetchAll();

?>
	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th>Activity</th>
					<th>Processed by</th>
					<th>Date Processed</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
				
			?>
				<tr>
				 <td><?php echo $i ?></td>
				<td><?php echo strtoupper($row['activity']) ?></td>
				<td><?php echo get_column2("ename","select concat(fn, ' ', mn, ' ',ln) as ename from m_users where id='".$row['performed_by']."'",$db) ?></td>
				<td><?php echo $row['timeprint'] ?></td>
			
			
				</tr>
			<?php
			$i++;
				}

				?>
			</tbody>		
		</table>
		</div>
</div>
