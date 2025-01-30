<?php 
require('includes/header.php');
if(get_exist2("select * from m_class_info where id = '".$_REQUEST['class_id']."'",$db)==0){
  @header("location:class_manager");
}
?>
  <body onload="listrecord('../listviews/v_class_list','display_class_list',1 + '&class_id=<?php echo $_REQUEST['class_id'] ?>');">
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
                          <h4 class="mb-1">Manage Class <span class='text-danger'><?php echo get_column2("class_name","select * from m_class_info where id = '".$_REQUEST['class_id']."'",$db) ?></span><i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Manage class/section information</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                        <div class="input-group">
                          
                          <a href="class_manager" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Back to Classes</a>

                        </div>
                        
                      </div>
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3" >
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                              <div class="card border">
                                  <div class="card-header">Add Students</div>
                                  <div class="card-body">
                                    <input type="text" id="txtsearch" onkeyup="listrecord('listviews/search_student','display_area',$('#txtsearch').val() + '&class_id=' + '<?php echo $_REQUEST['class_id'] ?>')" placeholder="enter search here" class="form-control">
                                  </div>

                                  <div class="card-body" id="display_area" style="height:500px; overflow-y:scroll">

                                  </div>  
                              </div>
                            </div>
                            <div class="col-7">
                                <div class="card border">
                                    <div class="card-header bg-gray-100"><b>Class List</b></div>
                                    <div class="card-body" id="display_class_list">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

      </div>
 
<?php
include('includes/footer.php');
include('includes/mdl_class.php');
require("includes/js_footer.php")
?>

</body>
  <!-- [Body] end -->
</html>
