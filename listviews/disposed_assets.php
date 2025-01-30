<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];

$asset_type = get_column2("year","select date_format(date_disposal, '%Y') as year from t_asset_disposal where date_format(date_disposal, '%Y') = '".$sy_id."'",$db);
$get_count = get_exist2("select date_format(date_disposal, '%Y') as year from t_asset_disposal where date_format(date_disposal, '%Y') = '".$sy_id."'",$db);
if($sy_id!==""){
?>

<div class="d-grid">

<div class="card">
<div class="card-body pc-component">

<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-folder"></i>Branch Hardware Records</a>
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
          <th style="width:10%">Images</th>
          <th>Asset Infomation</th>
          <th>Asset Category</th>
          <th>Status</th>
          <th>QR Code</th>
          <th>Record Info.</th>
          <th>Asset Life Span</th>
    </thead>
    <tbody>
      <?php
      $final_sql = "SELECT b.id as asset_id,date_format(date_disposal,'%Y'),b.asset_cat_id,b.status,b.added_by,b.date_added,b.code,b.asset_photo, b.machine_name, b.serial_number, b.date_purchased, a.date_disposal, b.auto_qr_code, b.model_number,b.date_purchased, a.date_disposal, CONCAT_WS(', ',CASE WHEN TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) > 0 THEN CONCAT(TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal), ' years') ELSE NULL END, CASE WHEN TIMESTAMPDIFF(MONTH, b.date_purchased, a.date_disposal) % 12 > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, b.date_purchased, a.date_disposal) % 12, ' months') ELSE NULL END,
        CASE WHEN DATEDIFF(a.date_disposal, DATE_ADD(b.date_purchased, INTERVAL TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) YEAR)) % 30 > 0 THEN CONCAT(DATEDIFF(a.date_disposal, DATE_ADD(b.date_purchased, INTERVAL TIMESTAMPDIFF(YEAR, b.date_purchased, a.date_disposal) YEAR)) % 30, ' days')
            ELSE NULL END) AS date_difference FROM t_asset_disposal a INNER JOIN m_hardware_assets b ON a.asset_id = b.id where date_format(date_disposal,'%Y')='$sy_id'";

            //echo $final_sql;
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
        <td><strong class="text-danger"><?php echo $row['date_difference'] ?></strong></td>
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
     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/disposed_assets?cid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>

</div>
</div>
</div>

</div>
</div>
</div>


</div>  

<?php
}
else
{
?>
<div class="row">
    
   <div class="col-12">
     <div class="alert alert-warning d-flex align-items-center" role="alert">
  
    <div><h3>   <i class="ti ti-info-circle"></i>Select the year you want to view</h3>
      <p>
        Please select a year you wanted to view and click filter.
      </p>
    </div>
    </div>
    </div>

</div>
<?php
}
?>