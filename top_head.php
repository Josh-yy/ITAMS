<?php
@session_start();

include(index.php);
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
    <a href="index" class="b-brand ">
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
  if($_SESSION['data']['utype']==14 || $_SESSION['data']['utype']==2){
  ?>
   <li class="dropdown pc-h-item  header-user-profile">
<a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
 <?php
  if(get_exist2("select * from t_hardware_update_status where  is_approved = 0",$db)==0){
    
  }else{
?>
     <span class="counter">
    <?php
    echo get_exist2("select * from t_hardware_update_status where  is_approved = 0",$db);
    ?>
        </span>
    <?php
  }
  ?>
<i class="ti ti-edit"></i>
</a>
<div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">

<div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
<div class="list-group list-group-flush w-100">

<div class="list-group-item list-group-item-action">
             <div class="d-flex">
        
          <div class="flex-grow-1 ms-1">
          <span class="float-end text-muted"><?php echo $trow['added_date'] ?></span>
          <h5></h5>
          <p>
              <?php
                 if(get_exist2("select * from t_hardware_update_status where  is_approved = 0",$db)>0){
              ?>
            You have <b><?php
              if(get_exist2("select * from t_hardware_update_status where  is_approved = 0",$db)==0){
            
              }else{
                echo get_exist2("select * from t_hardware_update_status where  is_approved = 0",$db);
              }
              ?></b> Pending Asset Update status  
              
              <?php
                 }
                 else{
                     echo "You have no pending asset status update";
                 }
              ?>
          </p>
          
             
          </div>
      </div>
       </div>
</div>
</div>
<div class="dropdown-divider"></div>

  <?php
    if(get_exist2("select * from t_hardware_update_status where is_approved = 0",$db)>0)
    {
      ?>
<div class="text-center py-2">
<a href="asset_status_approval" class="link-primary">View all</a>
</div>
<?php
    }
?>
</div>
</li>
<?php
}
?>
  <?php
  if($_SESSION['data']['utype']==2){
  ?>
   <li class="dropdown pc-h-item  header-user-profile">
<a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
<?php
  if(get_exist2("select * from t_asset_notification where  is_viewed = 0 and type='tagging'",$db)==0){

  }else{
      ?>
       <span class="counter"> 
      <?php
    echo get_exist2("select * from t_asset_notification where  is_viewed = 0 and type='tagging'",$db);
    ?>
    </span>
    <?php
  }
  ?>
<i class="ti ti-users"></i>
</a>
<div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">

<div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
<div class="list-group list-group-flush w-100">

<div class="list-group-item list-group-item-action">
             <div class="d-flex">
        
          <div class="flex-grow-1 ms-1">
          <span class="float-end text-muted"><?php echo $trow['added_date'] ?></span>
          <h5></h5>
          <p>
               <?php
                 if(get_exist2("select * from t_asset_notification where  is_viewed = 0 and type='tagging'",$db)>0){
              ?>
            You have <b><?php
              if(get_exist2("select * from t_asset_notification where  is_viewed = 0 and type='tagging'",$db)==0){
            
              }else{
                echo get_exist2("select * from t_asset_notification where  is_viewed = 0 and type='tagging'",$db);
              }
              ?></b> Pending Asset Tagging requests
              <?php
                 }
                 else{
              ?>
              You have no pending tagging approval
              <?php
                 }
              ?>
          </p>
             
          </div>
      </div>
       </div>
</div>
</div>
<div class="dropdown-divider"></div>

  <?php
    if(get_exist2("select * from t_asset_notification where is_viewed = 0 and type='tagging'",$db)>0)
    {
      ?>
<div class="text-center py-2">
<a href="pending_tags" class="link-primary">View all</a>
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

