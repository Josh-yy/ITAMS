<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];

$asset_type = get_column2("description","select * from m_asset_category where id = '".$_POST['param']."'",$db);
?>
<div class="row">
    
   <div class="col-12">
     <div class="alert alert-primary d-flex align-items-center" role="alert">
  
    <div><h3>   <i class="ti ti-info-circle"></i>You have selected the <b><?php echo get_column2("ename","select concat(name,'-', description) as ename from m_asset_category where id = '".$_POST['param']."'",$db) ?></b></h3>
      <p>
        The following are the records below regarding the asset category you have selected
      </p>
    </div>
    </div>
    </div>

</div>
<div class="d-grid">

<div class="card">
<div class="card-body pc-component">

<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-folder"></i> Record and Analytics</a>
</li>
<li class="nav-item">
<a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-printer"></i> PDF File</a>
</li>

</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php
$i=1;              
if($asset_type=="Hardware"){
?>
<table class="table table-bordered"> 
    <thead>
      <th>No</th>
          <th style="width:10%">Image</th>
          <th>Asset Infomation</th>
          <th>Asset Category</th>
          <th>Status</th>
          <th>QR Code</th>
          <th>Record Info.</th>
          <th>Task</th>
    </thead>
    <tbody>
      <?php
      $final_sql = "select *  from m_hardware_assets a where asset_cat_id = '".$_POST['param']."'";
      $data = $db->query($final_sql)->fetchALl();
        foreach ($data as $row) { 
      ?>
        <tr>
         <td><?php echo $i ?></td>
        <td style="width:10%"><img src="../assets/images/asset/<?php echo $row['asset_photo'] ?>" style="width:100%"></td>
        <td>
        <b>Code : </b> <?php echo $row['code'] ?>
        <br>
        <b>Machine Name : </b><?php echo $row['machine_name'] ?><br>
        <b>Model Number : </b><?php echo $row['model_number'] ?><br>
        <b>Serial Number : </b><?php echo $row['serial_number'] ?><b><br>
        Date Purchased : </b><?php echo $row['date_purchased'] ?></td>

        <td><?php echo get_column2("name", "select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db) ?></td>
        <td><?php echo $row['status'] ?></td>
        <td style="width:10%"><img src="../assets/img/qr_codes/<?php echo $row['auto_qr_code'] ?>.png" style="width:100%"></td>
        <td>
          <b class="text-secondary"><i class="ti ti-folder"></i> <?php echo get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$row['added_by']."'",$db) ?></b>
          <br>
          <small>
            <?php echo $row['date_added'] ?>
          </small>
        </td>
        <td>
          <div role="group" class="btn-group-sm btn-group btn-group-toggle">
            <?php
              if($row['installable_with_software']=="Yes"){


            ?>
           
              <?php
                }
              ?>
              <a href="assets/pdf_report/printqr?eid=<?php echo $row['id'] ?>" title="Print Hardware Asset QR Code" class="btn btn-secondary" target="_new"><i class="ti ti-printer"></i></a>
             
          </div>
        </td>
        </tr>
      <?php
      $i++;
        }


        ?>
      </tbody>
</table>
<?php
}
else{
  $final_sql = "select * from m_software_assets where asset_cat_id = '".$_POST['param']."' "; 
  $data = $db->query($final_sql)->fetchAll();
        
?>
<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>QR Code</th>
          <th>Software Info</th>
          <th>Type</th>
         
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $row) {
          $class="";
          
      ?>
        <tr>
         <td><?php echo $i ?></td>
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

        ?>
      </tbody>    
    </table>
<?php
}
?>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
 <div class="row" id="iframedisplay"> 
                    <div class="ratio ratio-21x9 rounded overflow-hidden">

  <?php
$i=1;              
if($asset_type=="Hardware"){
?>
     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/hardware_asset_cat?cid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>
<?php
}else{
?>
  <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/software_asset_cat?cid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>
<?php
}
?>
</div>
</div>
</div>

</div>
</div>
</div>


</div>  

<script>
  $('#process_prediction').on("click", function() {
   var mydata = "sy_id=" + $('#txtsyfilter').val();
   $.ajax({
    type:'POST',
    url:'controllers/process_prediction',
    data:mydata,
    cache:false,
    beforeSend: function(){
      $('#process_prediction').attr('disabled', true);
    },success:function(data){
      fire_message("Notifier","Successfully Processed Prediction to qualified data sets in the selected SY","success");
      $('#process_prediction').attr('disabled', false);
      listrecord('listviews/load_prediction','display_list',$('#txtsyfilter').val());
    }
  })
})

</script>