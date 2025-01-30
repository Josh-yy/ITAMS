<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_software_assets','display_list',1 + '&search=')">
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
                <div class="d-flex align-items-center row">
                  
                    <div class="col-md-9 col-sm-12">
                         <div class="ms-2">
                          <h4 class="mb-1"> <i class="text-success ti ti-credit-card"></i> Software Assets<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Manage Software Assets</p>
                        </div>
                    </div>
                    </div>
                   <div class="col-md-3 col-sm-12">
                      <div class="ms-2">
                        <div class="input-group">
                          
                          <input type="text" class="form-control" id="txtsearch" placeholder="Search here..." onkeyup="listrecord('listviews/v_software_assets','display_list',1 + '&search=' + $('#txtsearch').val())">
                          <button class="btn btn-outline-secondary btn-sm " data-bs-toggle="modal" data-bs-target="#addnew"><i class="ti ti-plus"></i> Add New</button>

                        </div>
                        
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
include('includes/mdl_software_assets.php');
require("includes/js_footer.php")
?>

</body>
  <!-- [Body] end -->
</html>
