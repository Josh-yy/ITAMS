<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
	} else {  
	    $page = $_REQUEST['param'];  
	}
	
	$sql = "select * from t_asset_notification where is_viewed = 0 and type='tagging'";
	
				
	$data = $db->query($sql)->fetchAll();
	$i=1;

?>

	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th>Asset Infomation</th>
					<th>Type</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
				    $asql = "select a.id as aid,b.id as notif_id,a.asset_id ,a.asset_holder_id, a.usage_id,b.*, date_format(a.date_added,'%M-%d-%Y %r') as added_date from t_asset_tagging a inner join m_hardware_assets b on a.asset_id = b.id where is_approve = 0 and a.transaction_code = '".$row['asset_id']."' ";
				    
				    
				 
		
					$class="";
					
				   $notif_id =   $row['id'];
				    
				    
					if($row['type']=="tagging"){
					    
				
					
			?>
				<tr>
				 <td><?php echo $i  ?></td>
				
				<td>
				    <div class="row">
				        <div class="col-md-3 col-sm-12">
				            <img src="../assets/images/asset/<?php echo get_column2("asset_photo",$asql,$db) ?>" style="width:100%">
				        </div>
				        <div class="col-md-9 col-sm-12">
				            	<b>Code : </b> <?php echo get_column2("code",$sql,$db) ?>
                				<br>
                				<b>Machine Name : </b><?php echo get_column2("machine_name",$asql,$db) ?><br>
                				<b>Model Number : </b><?php echo get_column2("model_number",$asql,$db) ?><br>
                				<b>Serial Number : </b><?php echo get_column2("serial_number",$asql,$db) ?><b><br>
                				Date Purchased : </b><?php echo get_column2("date_purchased",$asql,$db) ?>
				        </div>
				        
				    </div>
			
			
				</td>

				
				<td style="width:30%">
				    <div class="card border">
				        <div class="card-header">
				              <b><?php echo "Asset Tagging" ?></b>
				        </div>
				        <div class="card-body">
				            	<div class="row">
            					<div class="col-md-2"><img src="../assets/employee/<?php echo get_column2("qr_code","select * from m_users where id = '".get_column2("asset_holder_id",$asql,$db)."'",$db) ?>/<?php echo get_column2("avatar","select * from m_users where id = '".get_column2("asset_holder_id",$asql,$db)."'",$db) ?>" style="width:60%" class="float-end"></div>
            					<div class="col-md-10">
            						<b class="text-secondary"><i class="ti ti-folder"></i> <?php echo get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".get_column2("asset_holder_id",$asql,$db)."'",$db) ?></b>
            					<br>
            					<small>
            						<?php echo get_column2("added_date",$asql,$db) ?><br>
            						<b>Usage : </b> <span class="text-success"><?php echo get_column2("typename","select * from m_usage where id = '".get_column2("usage_id",$asql,$db)."'",$db) ?>	</span>
            					</small>
            					</div>
            				</div>
				        </div>
				    </div>
				</td>
				<td>
						<button  class="btn btn-outline-success btn-sm" id="btn_delete_user" onclick="approve_record('<?php echo get_column2("aid",$asql,$db) ?>','<?php echo get_column2("machine_name",$asql,$db) ?>','deleteassetinfo','../listviews/v_pending_tags','display_list',1)"><i class="ti ti-check"></i> Approve</button>
				</td>
				
				</tr>
			<?php
					}
					else{
					   ?>
					   	<tr>
				 <td><?php echo $i + (($page - 1) * 10) ?></td>
				
				<td>
				    <div class="row">
				        <div class="col-md-3 col-sm-12">
				            <img src="../assets/images/asset/<?php echo get_column2("asset_photo",$asql,$db) ?>" style="width:100%">
				        </div>
				        <div class="col-md-9 col-sm-12">
				            	<b>Code : </b> <?php echo get_column2("code",$sql,$db) ?>
                				<br>
                				<b>Machine Name : </b><?php echo get_column2("machine_name",$asql,$db) ?><br>
                				<b>Model Number : </b><?php echo get_column2("model_number",$asql,$db) ?><br>
                				<b>Serial Number : </b><?php echo get_column2("serial_number",$asql,$db) ?><b><br>
                				Date Purchased : </b><?php echo get_column2("date_purchased",$asql,$db) ?>
				        </div>
				        
				    </div>
			
			
				</td>

				
				<td style="width:30%">
				    <div class="card border">
				        <div class="card-header">
				              <b><?php echo "Asset Hardware Status Update" ?></b>
				        </div>
				        <div class="card-body">
				            <b>Reasons for Status Update</b><br>
				           <span class="text-primary"> <?php echo get_column2("reasons","select * from t_hardware_update_status where asset_id = (select id from m_hardware_assets where transaction_code = '".$row['asset_id']."')",$db) ?></span><br>
				            the selected hardware has been requested for a hardware asset status update. Approving this request will mark the hardware asset as <b>non-functional</b>
				        </div>
				    </div>
				</td>
				<td>
						<button  class="btn btn-outline-success btn-sm" id="btn_delete_user" onclick="approve_request('<?php echo $notif_id ?>','<?php echo get_column2("machine_name",$asql,$db) ?>','approve_request','../listviews/v_pending_tags','display_list',1)"><i class="ti ti-check"></i> Approve</button>
				</td>
				
				</tr>
					   <?php
					}
			$i++;
				}

				?>
			</tbody>		
		</table>
		</div>
</div>
<script>
function approve_record(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Approve Record?',
  text: "Are you sure you want to approve the tag request " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/approve_tag',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){

             Swal.fire(
            'Approved!',
            'Asset tagging successfulle approved',
            'success'
          )
          listrecord(url,display_area,param + "&search=");
        }
    })
    
 
  }
})
}

function approve_request(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Approve Hardware Asset Status Update?',
  text: "Are you sure you want to approve the tag request " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/approve_request',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){

             Swal.fire(
            'Approved!',
            'Asset tagging successfulle approved ',
            'success'
          )
          listrecord(url,display_area,param + "&search=");
        }
    })
    
 
  }
})
}
</script>