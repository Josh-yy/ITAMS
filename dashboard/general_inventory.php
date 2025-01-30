<?php 
require('includes/header.php');

?>
  <body>
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
                    <div class="col-7">
                         <div class="ms-2">
                          <h4 class="mb-1">Asset General Inventory<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">View, Download or Print Assets General Inventory</p>
                        </div>
                    </div>
                   <div class="col-4">
                      <div class="d-grid">
                        <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <select class="form-control" id="cbotype" required>
                          <option value="Hardware">Hardware</option>
                          <option value="Software">Software</option>                         
                          </select>
                         
                          <button class="btn btn-outline-secondary btn-sm " onclick="get_report($('#cbotype').val())"><i class="ti ti-upload"></i>Filter</button>
                        </div>
                        
                      </div>
                   </div>
                    <div class="col-1">
                    </div>
               
                </div>
              </div>
              <div class="card-body p-3" id="display_list">
               
              </div>
            </div>
          </div>

      </div>
<?php
include('includes/footer.php');
require("includes/js_footer.php");
?>

</body>
<script>
function get_report(etype){
listrecord('listviews/load_software','display_list',etype)
}
  </script>
  <!-- [Body] end -->
</html>
