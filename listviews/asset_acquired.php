<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];


?>

<div class="d-grid">

<div class="card">
<div class="card-body pc-component">

<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-folder"></i> Hardware Records</a>
</li>
<li class="nav-item">
<a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-printer"></i> PDF File</a>
</li>

</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php
$i=1;              
?>
<table class="table table-bordered"> 
    <thead>
      <th>No</th>
          <th style="width:10%">Image</th>
          <th>Asset Information</th>
          <th>Asset Category</th>
          <th>Status</th>
          <th>QR Code</th>
          <th>Record Info.</th>
          <th>Year Acquired</th>
          
        
       
    </thead>
    <tbody>
      <?php
       $final_sql="";
      if($sy_id==""){
              $final_sql = "select *, date_format(date_purchased,'%Y') as edate from m_hardware_assets ORDER BY  date_format(date_purchased,'%Y')";
          }else{
              $final_sql = "select *, date_format(date_purchased,'%Y') as edate from m_hardware_assets where  date_format(date_purchased,'%Y') = '".$_POST['param']."'";
          }
      
      
        
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
          <?php echo $row['edate'] ?>
        </td>
        </tr>
      <?php
      $i++;
        }


        ?>
      </tbody>
</table>

</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
 <div class="row" id="iframedisplay"> 
                    <div class="ratio ratio-21x9 rounded overflow-hidden">

  <?php

?>
     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/lasset_acquired?cid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>

</div>
</div>
</div>

</div>
</div>
</div>


</div>  

