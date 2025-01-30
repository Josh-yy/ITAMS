<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_pending_tags','display_list',1 + '&search=tagging')">
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Header Topbar ] start -->
<?php include('top_head.php') ?>
<!-- [ Header ] end -->
 <!-- [ Sidebar Menu ] start -->
<?php
include('side_nav.php');
?>
<!-- [ Sidebar Menu ] end -->


 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
              <span class="round bg-success small"></span>
              <span class="round bg-success big"></span>
              <div class="card-body p-3">
                <div class="d-flex align-items-center">
                  <div class="avtar avtar-lg bg-light-success">
                    <i class="text-success ti ti-credit-card"></i>
                  </div>
                    <div class="col">
                         <div class="ms-2">
                          <h4 class="mb-1">Pending Asset Tags<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Pending Asset Tagging Records</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                       
                        
                      </div>
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3" id="display_list"></div>
            </div>
          </div>

      </div>
 
<?php
include('includes/footer.php');
include('includes/mdl_asset_category.php');
require("includes/js_footer.php")
?>

</body>
  <!-- [Body] end -->
</html>
