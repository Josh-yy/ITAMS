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
                          <h4 class="mb-1">Asset Category Report<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Filter Asset Infromation per Category</p>
                        </div>
                    </div>
                   <div class="col-4">
                      <div class="d-grid">
                        <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <select class="form-control" id="txtsyfilter" onchange="listrecord('listviews/load_prediction','display_list',$('#txtsyfilter').val())"  required>
                          <option value="">-Select Asset Category-</option>
                            <?php 
                              $sql = "select * from m_asset_category";
                              $data = $db->query($sql)->fetchAll();
                                foreach($data as $row){
                              ?>
                                <option value="<?php echo $row['id'] ?>" ><?php echo $row['name'] ?> - <small><?php echo $row['description'] ?></small></option>
                              <?php
                              }
                              ?>
                          </select>
                         
                          <button class="btn btn-outline-secondary btn-sm " onclick="listrecord('listviews/assets_category','display_list',$('#txtsyfilter').val())"><i class="ti ti-upload"></i>Go</button>
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
