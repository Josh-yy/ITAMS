<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_facilities','display_list',1 + '&search=')">
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
                          <h4 class="mb-1">Manage Navigational Links <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Manage Systems Navigational Links</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                        <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <input type="text" class="form-control" id="txtsearch" placeholder="Search here..." onkeyup="listrecord('listviews/v_facilities','display_list',1 + '&search=' + $('#txtsearch').val() )">
                          <button class="btn btn-outline-secondary btn-sm " data-bs-toggle="modal" data-bs-target="#addnewlink"><i class="ti ti-plus"></i> Add New</button>

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
include('includes/mdl_links.php');
include('includes/footer.php');
require("includes/js_footer.php")
?>

  </body>
  <!-- [Body] end -->
</html>
