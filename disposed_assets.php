<?php 
require('includes/header.php');

?>
  <body onload="listrecord('listviews/disposed_assets','display_list','')">
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
                 
                    <div class="col-md-7 col-sm-12">
                         <div class="ms-2">
                          <h4 class="mb-1">Disposed Assets<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Filter and View the Lifespan of the Disposed Assets</p>
                        </div>
                    </div>
                   <div class="col-md-5 col-sm-12">
                      <div class="d-grid">
                        <div class="input-group">
                         
                          <select class="form-control" id="cbobranch"   required>
                          <option value="">-Select Year-</option>
                            <?php 
                              $sql = "select date_format(date_disposal, '%Y') as year from t_asset_disposal WHERE date_format(date_disposal, '%Y') <> ''  group by date_format(date_disposal, '%Y')";
                              $data = $db->query($sql)->fetchAll();
                                foreach($data as $row){
                              ?>
                                <option value="<?php echo $row['year'] ?>" ><?php echo $row['year'] ?></option>
                              <?php
                              }
                              ?>
                          </select>
                         
                          <button class="btn btn-outline-secondary btn-sm " onclick="listrecord('listviews/disposed_assets','display_list',$('#cbobranch').val())"><i class="ti ti-upload"></i>Go</button>
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
  <!-- [Body] end -->
</html>
