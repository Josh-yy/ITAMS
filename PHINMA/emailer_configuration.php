<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_recepients','display_recepients',1 + '&search=');">
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
                           <h4 class="mb-1">Emailer Configuration<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Setup / Manage Emailer configuration that automatically sends email notifications</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                      
                      </div>
                   </div>
                </div>
              </div>
              <div class="card-body p-3">
                  <div class="col-12">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <div><h3>   <i class="ti ti-info-circle"></i>Important Note! <b></b></h3>
                        <p>
                          Setting up and managing an email system to send automated email notifications involves configuring the system initially and then maintaining it to ensure it operates smoothly. The system is designed to send emails automatically without manual intervention, delivering notifications to recipients for various purposes, such as alerts, updates, or reminders. This automation ensures that important information is shared via email efficiently and reliably.
                        </p>
                      </div>
                      </div>
                      </div>
                 <div class="row">
                  <div class="col-1"></div>
               
                <div class="col-md-5 col-sm-12">
                   <form id="frmemailsettings" class="needs-validation-add" onsubmit="event.preventDefault();submit_hardware('frmemailsettings','btnsaveselected','../controllers/save_settings','Successfully Saved Email Settings','../listviews/v_assets_info','display_list','sample'); " novalidate>
                    <div class="card border">
                      <div class="card-header with-border" style="background:#f1f1f1">
                        <b><i class="ti ti-info-circle"></i>Email Settings Configuration</b>
                      </div>
                        <div class="card-body">
                           
                                     <div class="form-group">
                                        Email Sender Address : 
                                        <input type="email" value="<?php echo get_column2("email_address","select * from t_email_facility_settings",$db) ?>" placeholder="please enter the gmail address here." class="form-control" name="email_address" required>
                                         <div class="valid-feedback">

                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 
                               
                               
                                     <div class="form-group">
                                         API Key : 
                                        <input type="text" value="<?php echo get_column2("email_api_key","select * from t_email_facility_settings",$db) ?>" class="form-control" name="api_key" placeholder="Please enter the API key here" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-secondary"  id="btnsaveselected"><i class="ti ti-check"></i> Save Settings</button>
                        </div>  
                      </div>
                    </form>

                    <div class="card border">
                        <div class="card-body">
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                            <div><h3>   <i class="ti ti-info-circle"></i>Important Note! <b></b></h3>
                            <p>
                              Switching email notification ON will allow the system to automatically send email notifications to its respective recepients.
                            </p>
                          </div>
                          </div>
                        </div>
                        <div class="card-header text-lg">
                        

                          <div class="form-check form-switch custom-switch-v1 form-check-inline">
                            <input type="checkbox" class="form-check-input input-primary" id="customCheckinlh1" <?php  echo (get_column2("is_enabled","select * from t_email_facility_settings",$db)==1) ? 'checked' : ''  ?>>
                            <label class="form-check-label" for="customCheckinlh1">Switch Email Notification</label>
                            </div>
                        </div>
                     
                    </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card border">
                            <div class="card-header bg-dark text-white">
                              <b class="card-title"><i class="ti ti-list"></i> Hardware Disposal and Asset Expiration Notification Recepients</b>
                              <span class="btn btn-secondary btn-sm float-end" data-bs-target="#mdlrecepients" onclick="listrecord('listviews/v_recepients_list','display_users',1+'&search=')" data-bs-toggle="modal" id="btnclick"><i class="ti ti-search"></i> Add Recepients </span>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-12 col-sm-12" id="display_recepients"></div>
                            </div>
                           
                        </div>
                          <div class="card border">
                            <div class="card-header bg-dark text-white">
                              <b class="card-title"><i class="ti ti-list"></i>Asset Tagging Approver</b>
                            
                            </div>
                            <div class="card-body row">
                                <div class="col-md-12 col-sm-12" id="display_recepients">
                                  <div class="input-group">
                                  <select class="form-control" id="cboapprover">
                                      <?php
                                        $sql = "select id, concat(fn, ' ', mn, ' ',ln) as ename from m_users  order by ename";
                                        $data = $db->query($sql)->fetchAll();
                                        foreach($data as $row){
                                          $selected = "";
                                          if($row['id']==get_column2("approver_id","select * from m_approver",$db)){
                                            $selected = "selected";
                                          }
                                      ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['ename'] ?></option>
                                      <?php
                                        }
                                      ?>
                                  </select>
                                  <button class="btn btn-outline-secondary" id="btnsaveapprover" type="button"><i class="ti ti-check"></i> Save</button>
                                </div>
                                </div>
                            </div>
                        </div>
                          <div class="card border">
                            <div class="card-header bg-dark text-white">
                              <b class="card-title"><i class="ti ti-list"></i>Software Notification Baseline</b>
                            
                            </div>
                            <div class="card-body row">
                                <div class="col-md-12 col-sm-12">
                                  <div class="input-group">
                                    <input type="number" value="<?php echo get_column2("number_of_days","select * from t_trigger_notification",$db) ?>" class="form-control" placeholder="number of days to notify software expiration" id="number_of_days">
                                  <button class="btn btn-outline-secondary" id="btnsavetrigger" type="button"><i class="ti ti-check"></i> Save</button>
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

      </div>
 <div id="mdlrecepients" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
           
            <h4 class="modal-title"><i class="mdi mdi-camera"></i>Select Notification Recepients</h4>
             <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body text-center">
          
            <div class="row" id="display_users" style="height:500px; overflow-y:scroll; overflow-x: hidden"></div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" id="btnsaveselectedusers"> <i class="ti ti-check"></i> Save Information</button>
            <button class="btn btn-outline-secondary close" data-bs-dismiss="modal">Close</button>
          
            </div>
          </div>
        </div>
      </div>
</div>
<?php
include('includes/footer.php');
include('includes/mdl_hardware_asset.php');
require("includes/js_footer.php");
?>

<script language="JavaScript">
  $('#btnsavetrigger').on("click", function() {
    var mydata = 'no_days=' + $('#number_of_days').val();
     $.ajax({
    type:'POST',
    url:'controllers/save_trigger',
    data:mydata,
    cache:false,
     beforeSend: function() {
      $('#btnsavetrigger').attr('disabled', true);
    },
    success:function(data){
      $('#btnsavetrigger').attr('disabled', false);
      fire_message("Notified","Software expiration triggering day has been set","success");
    }
  })
  })

    $('#btnsaveapprover').on("click", function() {
    var mydata = 'approver_id=' + $('#cboapprover').val();
     $.ajax({
    type:'POST',
    url:'controllers/save_approver',
    data:mydata,
    cache:false,
     beforeSend: function() {
      $('#btnsaveapprover').attr('disabled', true);
    },
    success:function(data){

      $('#btnsaveapprover').attr('disabled', false);
      fire_message("Notified","Disposal approver has been set","success");
    }
  })
  })
 $(document).ready(function() {
        $('#customCheckinlh1').change(function() {
            if (this.checked) {
                // Checkbox is checked (ON)
                send_state(1,"Activated");
                // You can add your code for the ON state here
            } else {
                // Checkbox is unchecked (OFF)
                send_state(0,"Deactivated");
                // You can add your code for the OFF state here
            }
        });
    });
 function send_state(state,type){
  $.ajax({
    type:'POST',
    url:'controllers/save_enable_settings',
    cache:false,
    data:'state=' + state,
    success:function(data){
      fire_message("Notified","Email notification has been " + type,"success");
    }
  })
 }
//save usertype
  $('#btnsaveselectedusers').on("click",function() {
  var letters = $('input[name="lab_id[]"]:checked').map(function(){return this.value;}).get()
  var mydata = "action=addrole" + "&facility=" + letters;

  if(letters=="")
  {
       $('#mdlrecepients .close').click();
      fire_message("Notifier","Please select email recepients" ,"info");
  }
  else
    {
     $.ajax({
                  url: '../controllers/save_recepients',
                  type: 'POST',
                  data: mydata,
                  cache:false,
                  beforeSend: function() {
                    $('#btnsaveselected').attr('disabled', true);
                  },
                  success: function(data) { 
                    $('#mdlrecepients .close').click();
                    $('#btnsaveselected').attr('disabled', false);
                    fire_message("Notifier","Successfulyl added email recepients" ,"success");
                    listrecord('listviews/v_recepients','display_recepients',1 + '&search=');
                    
                  }
                })
    }
})

</script>
</body>
  <!-- [Body] end -->
</html>
