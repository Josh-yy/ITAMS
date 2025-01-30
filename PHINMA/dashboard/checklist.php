<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_curriculum','display_subjects',1 + '&search=')">
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
                          <h4 class="mb-1">Students Checklist<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">View and Print Student Checklist</p>
                        </div>
                        

                    </div>

                   <div class="col-4">
                      <div class="ms-2">
                        <div class="row">
                          <div class="form-group">
                            <div class="input-group">
                           
                            <input type="text" class="form-control" id="txtsearch" placeholder="Enter Student Number here" >
                            <button class="btn btn-outline-secondary" type="button"><i class="ti ti-adjustments-horizontal"></i></button>
                            </div>
                        </div>
                      </div>
                   </div>
                 </div>
                
                </div>

              </div>
           
              <div class="card-body p-3">
                  <div class="card">
                      <div class="card-body" id="display_student_information">

                      </div>
                  </div>
              </div>
            </div>
          </div>

      </div>


<?php
include('includes/footer.php');
require("includes/js_footer.php")
?>
<script>
 $("#txtsearch").keypress(function(event) {
        // Check if the Enter key is pressed (keycode 13)
        if (event.which === 13) {
          var txtsearch = $(this).val();
          listrecord("search_student_checklist","display_student_information",txtsearch)
        }
      })
</script>
</body>
  <!-- [Body] end -->
</html>
