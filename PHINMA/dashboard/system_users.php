<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_users','display_list',1 + '&search=')">
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
                          <h4 class="mb-1">Manage System Users <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Manage Systems Users</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                        <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <input type="text" class="form-control" id="txtsearch" placeholder="Search here..." onkeyup="listrecord('listviews/v_users','display_list',1 + '&search=' + $('#txtsearch').val() )">
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
include('includes/mdl_users.php');
require("includes/js_footer.php")
?>
<script>
$('#frmadduser').on('submit', function(e){
    e.preventDefault();
    var logForm = new FormData(this);

        $.ajax({
                type: 'POST',
                url: 'controllers/save_user',
                data: logForm,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function(){
                    $('#btnsaveemp').attr('disabled',true);
                },
                success: function(data){  
                 
                
                    $('#btnsaveemp').attr('disabled',false);
                 if(data==1){

                    fire_message("Record exist","The item you want to add is already existing","error");

                    $("#btnsaveproduct").attr("disabled",false);
                    }else{
                        $("#addnew .close").click();
                      listrecord('listviews/v_users','display_list',1 + '&search=');
                       fire_message("System User Added","Successfully Registered System User" ,"success");  
                    }
                }
                })
        })
$('#frmupdate').on('submit', function(e){
    e.preventDefault();
    var logForm = new FormData(this);
        $.ajax({
                type: 'POST',
                url: 'controllers/update_user',
                data: logForm,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function(){
                    $('#btnsaveemp').attr('disabled',true);
                },
                success: function(data){  
                    $('#btnsaveemp').attr('disabled',false);
                   
                 if(data==1){

                    fire_message("Record exist","The item you want to add is already existing","error");

                    $("#btnsaveproduct").attr("disabled",false);
                    }else{
                         $("#update .close").click();
                         listrecord('listviews/v_users','display_list',1 + '&search=');
                       fire_message("Record Updated","System User Information Successfully Updated" ,"success");
                    }
                }
                })
        })
</script>
  </body>
  <!-- [Body] end -->
</html>
