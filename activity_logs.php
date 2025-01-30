<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_activity_logs','display_list',1 + '&type=')">
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
                          <h4 class="mb-1">Filter Activity Logs<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Filter and View  Activity Logs</p>
                        </div>
                    </div>
                   <div class="col-md-3 col-sm-12">
                     
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3" >
                  <div class="card">
                      <div class="card-body row">

                          <div class="col-7">
                          <div class="input-group">
                          <span class="btn btn-secondary">From: </span>
                            <input type="date" id="txtfrom" class="form-control">
                               <span class="btn btn-secondary">To: </span>
                         <input type="date" id="txtto" class="form-control">

                                <select class="form-control" id="cbotype">
                                    <option value="">-All-</option>
                                 <?php
                                    $sql = "select * from t_activity_logs group by activity order by activity asc";
                                    $data = $db->query($sql)->fetchAll();
                                    foreach($data as $row){
                                    ?>
                                    <option value="<?php echo $row['activity'] ?>"><?php echo $row['activity'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                          <button class="btn btn-outline-secondary btn-sm " onclick="get_activity($('#txtfrom').val(),$('#txtto').val(),$('#cbotype').val())"><i class="ti ti-upload"></i>Go</button>
                        </div>
                              
                          </div>
                      </div>
                      <div class="card-body" id="display_list">
                          
                      </div>
                      
                  </div>
              </div>
            </div>
          </div>

      </div>
<script>
    function get_activity(tfrom,tto,type){
        if(tfrom==""){
            fire_message("Field Required","Filter start date","info")
        }else if(txtto==""){
            fire_message("Field Required","Filter end date","info");
        }else{
            listrecord('listviews/v_activity_logs','display_list',1 + '&txtfrom=' + tfrom + '&txxto=' + tto + '&type=' + type);
        }
    }
</script>
<?php
include('includes/footer.php');
include('includes/mdl_asset_category.php');
require("includes/js_footer.php")
?>

</body>
  <!-- [Body] end -->
</html>
