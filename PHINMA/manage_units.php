<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_units','dusplay_curr_subjects',1 + '&search=' + '&bid=' + <?php echo $_REQUEST['bid'] ?>)">
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
           
              <div class="card-body p-3">
                <div class="d-flex align-items-center">
                  <div class="avtar avtar-lg bg-light-success">
                    <i class="text-success ti ti-credit-card"></i>
                  </div>
                    <div class="col">
                         <div class="ms-2">
                          <h4 class="mb-1">Manage Branch Units<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Branch Units Manager</p>
                        </div>
                        

                    </div>


                </div>

              </div>
              <div class="card-body p-3">
                <div class="row">
                 
                     <div class="card dashnum-card dashnum-card-small overflow-hidden">
                    
                      <div class="card-header ">

                        <b style="font-size:20px"><a href="manage_branch"><i class="ti ti-arrow-left"></i></a><b class="text-gray-500"><?php echo get_column2("code","select * from m_branches where id = '".$_REQUEST['bid']."'",$db) ?>-</b><?php echo get_column2("name","select * from m_branches where id = '".$_REQUEST['bid']."'",$db) ?></b>
                        <span style="float: right">

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                          <button class="btn btn-secondary" id="add_subject"  data-bs-toggle="modal" data-bs-target="#addnew"><i class="ti ti-plus"></i> Add New Unit</button>
                      
                         
                        </div>  
                        
                        </span>
                      </div>
                      <div class="card-body row">
                         
                          
                      </div>
                     
                    </div>
             

                <div class="row" id="dusplay_curr_subjects">

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
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmadddepartment" class="needs-validation-add" onsubmit="event.preventDefault();submit_form_with_data('frmadddepartment','btnsaveselected','../controllers/save_unit','Successfully Saved','../listviews/v_units','display_list','addnew','<?php echo $_REQUEST['bid'] ?>')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="addtype" name="action">
                    <input type="hidden" name="branch_id" value="<?php echo $_REQUEST['bid'] ?>">
                     <div class="form-group">
                         Code:
                        <input type="text" class="form-control"  name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                         Name:
                        <input type="text" class="form-control" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary"  id="btnsaveselected">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-sunny-morning">
                <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmupdatedepartment" class="needs-validation-edit" onsubmit="event.preventDefault();submit_form_with_data('frmupdatedepartment','btnupdate','../controllers/update_unit','Successfully Updated','../listviews/v_units','display_list','mdl_update','<?php echo $_REQUEST['bid'] ?>')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="edittype" name="action">
                    <input type="hidden" id="eid" name="id">

                     <div class="form-group">
                         Code:
                        <input type="text" class="form-control" id="code" name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                         Name:
                        <input type="text" class="form-control" id="name" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                  
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close"  data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnupdate">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
function submit_form_with_data(form_name,btn_name,url,message,listurl,div,modal,edata)
{
    var logForm = $('#' + form_name).serialize();
    //alert(logForm);
        $.ajax({type: 'POST',
        url: url,
        data: logForm ,
        cache:false,
        beforeSend: function (){
        $("#" + btn_name).attr("disabled",true);
      },success: function(data){
          $("#" + btn_name).attr("disabled",false);
          $("#" + modal + ' .close').click();
          if(data==1){

          fire_message("Record exist","The item you want to add is already existing","error");
          $("#" + btn_name).attr("disabled",false);
          }else if(data==0){
             fire_message("Notifier",message ,"success");
            if(modal!=='')
            { 
               document.getElementById(form_name).reset();
              $("#" + btn_name).attr("disabled",false); 
             listrecord('listviews/v_units','dusplay_curr_subjects',1 + '&search=' + '&bid=' + <?php echo $_REQUEST['bid'] ?>);

            }
            else
            {
              setTimeout("reload_window()",1000);
            }
           
          }
          else
          {
            fire_message("System Message","Sorry but you cannot delete this item because there is a data referenced to this item." + data ,"info");
          }

        }})
  
}
</script>
</body>
  <!-- [Body] end -->
</html>
