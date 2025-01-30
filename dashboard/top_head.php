<?php
@session_start();


?>
<style>
.counter {
  position: absolute;
  top: 0;
  right: 10px; /* Adjust this value to control the separation from the right edge */
  background-color: red; /* Background color for the counter */
  color: white; /* Text color for the counter */
  padding: 4px 8px; /* Adjust padding as needed */
  border-radius: 50%; /* Make it a circle */
  font-size: 12px; /* Adjust the font size as needed */
}
</style>
<header class="pc-header">
  <div class="m-header ">
    <a href="index.html" class="b-brand ">
      <!-- ========   change your logo hear   ============ -->
      <img src="../assets/images/<?php echo get_column2("top_head_logo","select * from system_settings",$db) ?>" alt="" class="logo logo-lg" />
    </a>
    <!-- ======= Menu collapse Icon ===== -->
    <div class="pc-h-item">
      <a href="#" class="pc-head-link head-link-secondary m-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </div>
  </div>
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <li class="pc-h-item header-mobile-collapse">
      <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item d-none d-md-inline-flex">
     <strong><?php echo get_column2("name","select * from system_settings",$db) ?></strong>
    </li>
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
  <?php
  if($_SESSION['data']['account_id']==43){
  ?>
   <li class="dropdown pc-h-item  header-user-profile">
<a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
 <span class="counter"> <?php
  if(get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db)==0){

  }else{
    echo get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db);
  }
  ?></span>
<i class="ti ti-bell"></i>
</a>
<div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
<div class="dropdown-header">
<h5>Asset Pending Tags Notification <span class="badge bg-warning rounded-pill ms-1"><?php
  if(get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db)==0){

  }else{
    echo get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db);
  }
  ?></span></h5>
</div>
<div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
<div class="list-group list-group-flush w-100">
  <div class="list-group-item list-group-item-action">

    <?php
    if(get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db)>0)
    {
    $tsql = "select a.id as aid,a.asset_id ,a.asset_holder_id, a.usage_id,b.*, date_format(a.date_added,'%M-%d-%Y %r') as added_date from t_asset_tagging a inner join m_hardware_assets b on a.asset_id = b.id where is_approve = 0;";
    $tdata = $db->query($tsql)->fetchAll();
    foreach($tdata as $trow){
    ?>
      <div class="d-flex">
           <div class="flex-shrink-0">
              <img src="assets/employee/<?php echo get_column2("qr_code","select * from m_users where id = '".$trow['asset_holder_id']."'",$db) ?>/<?php echo get_column2("avatar","select * from m_users where id = '".$trow['asset_holder_id']."'",$db) ?>" style="width:100%"  alt="user-image" class="user-avtar float-end">
          </div>
          <div class="flex-grow-1 ms-1">
          <span class="float-end text-muted"><?php echo $trow['added_date'] ?></span>
          <h5></h5>
          <p>
            <b class="text-secondary"><i class="ti ti-folder"></i> <?php echo get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$trow['asset_holder_id']."'",$db) ?></b>
            <br>
            <b>Usage : </b> <span class="text-success"><?php echo get_column2("typename","select * from m_usage where id = '".$trow['usage_id']."'",$db) ?>  
          </p>
             
          </div>
      </div>
    <?php
      }
    }
    else
    {
    ?>
    <div class="alert alert-success">No pending tags</div>
    <?php
    }
    ?>
  </div>
</div>
</div>
<div class="dropdown-divider"></div>

  <?php
    if(get_exist2("select * from t_asset_notification where user_id = '".$_SESSION['data']['account_id']."' and is_viewed = 0",$db)>0)
    {
      ?>
<div class="text-center py-2">
<a href="pending_tags" class="link-primary">View all requests</a>
</div>
<?php
    }
?>
</div>
</li>
<?php
}
?>
    <li class="dropdown pc-h-item header-user-profile">
      <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
          <img src="../assets/employee/<?php echo get_column2("qr_code","select * from m_users where id = '".$_SESSION['data']['account_id']."'",$db) ?>/<?php echo get_column2("avatar","select * from m_users where id = '".$_SESSION['data']['account_id']."'",$db) ?>" alt="user-image" class="user-avtar">
          <span>
          <i class="ti ti-settings"></i>
          </span>
          </a>
      


      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header">
          <h4>Good Day, <span class="small text-muted"> <?php echo strtoupper($_SESSION['data']['account_name']) ?></span></h4>
          <p class="text-muted"><?php echo strtoupper($_SESSION['data']['usertype']) ?></p>
     
          <hr />
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
          
          
            <a href="#" data-bs-toggle="modal" data-bs-target="#change_password" class="dropdown-item" >
              <i class="ti ti-settings"></i>
              <span>Change Password</span>
            </a>
           
            <a href="controllers/sign_out" class="dropdown-item">
              <i class="ti ti-logout"></i>
              <span>Logout</span>
            </a>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div> </div>
</header>

