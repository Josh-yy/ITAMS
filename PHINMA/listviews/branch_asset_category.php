<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];

$asset_type = get_column2("description","select * from m_asset_category where id = '".$_POST['param']."'",$db);

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
          <th style="width:10%">Image</th>
          <th>Asset Infomation</th>
          <th>Asset Category</th>
          <th>Status</th>
          <th>QR Code</th>
          <th>Record Info.</th>
          <th>Installed Software</th>
          <th>Hardware Properties</th>
          
        
       
    </thead>
    <tbody>
      <?php
      $final_sql = "select b.* from t_asset_tagging a inner join m_hardware_assets b on a.asset_id = b.id where a.status = 1 and a.branch_id = '".$_POST['param']."'";
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
          <table class="table table-border">
          <?php
          $asql = "select *,a.id as installed_id, date_format(a.date_added,'%M-%d-%Y %r') as date_installed from t_hardware_software_installed a inner join m_software_assets b on a.software_id = b.id where asset_id = '".$row['id']."'";
            if(get_exist2($asql,$db)){
              $adata = $db->query($asql)->fetchAll();
              foreach($adata as $arow)
              {
          ?>
          <tr>
            <td><h3><?php echo $arow['software_name'] ?> </h3></td>
            <td><p><?php echo $arow['serial_number'] ?><br><?php echo $arow['date_installed'] ?></p></td>
          </tr>
          <?php
              }
            }
          ?>
        </table>
        </td>
         <td>
          <table class="table table-sm">
          <?php
          $hsql = "select * from t_asset_properties a inner join t_asset_cat_property b on a.property_id = b.id where a.asset_id = '".$row['id']."'";


            if(get_exist2($hsql,$db)>0){
              $hdata = $db->query($hsql)->fetchAll();
              foreach($hdata as $hrow)
              {
          ?>
          <tr>
            <td><b><?php echo $hrow['property_name'] ?> </b></td>
            <td><?php echo $hrow['prop_value'] ?></td>
          </tr>
          <?php
              }
            }
          ?>
        </table>
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
     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/branch_assets?cid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>

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
  
    <div><h3>   <i class="ti ti-info-circle"></i>Select a Branch you want to view</h3>
      <p>
        Please select a branch you wanted to view and click filter.
      </p>
    </div>
    </div>
    </div>

</div>
<?php
}
?>