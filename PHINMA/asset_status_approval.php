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
                    <div class="col">
                         <div class="ms-2">
                          <h4 class="mb-1">Asset Status Approval<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Approve Asset Status Approval</p>
                        </div>
                    </div>
                   <div class="col-auto">
                     
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3" id="display_list">
                   <div class="table-responsive">
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Asset Information</th>
                                    <th>Status</th>
                                    <th>Reasons</th>
                                    <th>Date Requested</th>
                                   <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                  $sql  = "select * from t_hardware_update_status  where is_approved = 0";
                                  $data = $db->query($sql)->fetchAll();
                                  
                            
                                  foreach($data as $row){
                                      
                               
                                ?>
                                  <tr>
                                    <td><?php echo $i ?></td>
                                        <td>
                                          <div class="media align-items-center">
                                          <div class="flex-shrink-0 wid-40"><img class="img-radius img-fluid wid-40" src="assets/img/qr_codes/<?php echo get_column2("auto_qr_code","select * from m_hardware_assets where id = '".$row['asset_id']."'",$db) ?>.png" alt="User image"></div> 
                                        
                                          <div class="media-body ms-3">
                                          <h5 class="mb-1"><?php echo get_column2("machine_name","select * from m_hardware_assets where id = '".$row['asset_id']."'",$db) ?> </b></h5> 
                                          <p class="text-muted f-12 mb-0"><a href="#" class="__cf_email__" data-cfemail="b0c7d9d5d7d1ded4f0d8dfc4ddd1d9dc9ed3dfdd"><?php echo get_column2("serial_number","select * from m_hardware_assets where id = '".$row['asset_id']."'",$db) ?></a></p>
                                          </div>
                                          </div>
                                          </td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><span class="badge bg-secondary"><?php echo $row['reasons'] ?></span></td>
                                    <td><?php echo $row['date_added'] ?></td>
                                    <td> 
                                        <button id="btn<?php echo $row['id'] ?>" onclick="approve_selection('<?php echo $row['id'] ?>','<?php echo get_column2("serial_number","select * from m_hardware_assets where id = '".$row['asset_id']."'",$db) ?>','approve','','','')" class="btn btn-outline-secondary btn-sm"><i class="ti ti-check"></i> Approve</button>
                                    </td>
                                  </tr>
                                <?php
                                $i++;
                                  }
                                ?>
                            </tbody>
                          </table>
                        
                      </div>
              </div>
            </div>
          </div>

      </div>
 
<?php
include('includes/footer.php');
include('includes/mdl_asset_category.php');
require("includes/js_footer.php")
?>
<script>
    
    function approve_selection(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Approve selected item?',
  text: "Are you sure you want to approve  asset " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'controllers/approve_hardware_status',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){
             
             Swal.fire(
            'Record Approved!',
            'Transaction Completed' ,
            'success'
          )
          setTimeout(meload,2000);
        }
    })
    
 
  }
})
}
function meload(){
    location.reload();
}
</script>
</body>
  <!-- [Body] end -->
</html>
