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
                <div class="d-flex align-items-center row">
                 
                    <div class="col-md-9 col-sm-12">
                         <div class="ms-2">
                          <h4 class="mb-1">Manage System Users <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Manage Systems Users</p>
                        </div>
                    </div>
                   <div class="col-md-3 col-sm-12">
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
              <div class="card-body p-3" >
                  <div class="table-responsive">
                     <div id="display_list"></div> 
                     
                  </div>
              </div>
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
                // alert(data);
                
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
                    $('#btnupdateuser').attr('disabled',true);
                },
                success: function(data){  
                    $('#btnupdateuser').attr('disabled',false);
                   
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
        
        function deactivate_record(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Deactivate User?',
  text: "Are you sure you want to deactivate " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, deactivate it!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/delete_records',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){
             Swal.fire(
            'User Account Deactivated!',
            'Transaction Completed',
            'success'
          )
         listrecord('listviews/v_users','display_list',1 + '&search=');
        }
    })
  }
})
}
function activate_record(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Activate User?',
  text: "Are you sure you want to activate " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, activate it!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/delete_records',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){
             Swal.fire(
            'User Account Activated!',
            'Transaction Completed',
            'success'
          )
          listrecord('listviews/v_users','display_list',1 + '&search=');
        }
    })
  }
})
}
</script>
  </body>
  <!-- [Body] end -->
</html>
