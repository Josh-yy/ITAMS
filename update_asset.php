<?php 
require('includes/header.php');
if(get_exist2("select * from m_hardware_assets where id = '".$_REQUEST['eid']."'",$db)==0){
  @header("location:asset_info");
}
?>
  <body onload="listrecord('listviews/v_assets_info','display_list',1 + '&search=')">
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
                          <h4 class="mb-1">Update Hardware Asset Information<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Update Hardware Information</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">

                        <div class="input-group">
                        
                          <a href="asset_info" class="btn btn-secondary"><i class="ti ti-list"></i>List of Hardware Assets</a>
                        </div>
                        
                      </div>
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3">
                  
                 <div class="row">
                  <div class="col-1"></div>
                  <div class="col-4">
                     <div class="col-md-12 row">
                             <div class="card">

                                <div class="card-body" style="background: #f3f3f3;">
                                   <div class="alert alert-success">
                                    <b>Update Asset Photo</b>You can capture another asset information to be updated.
                                  </div>
                                   <img style="width: 100%;" class="after_capture_frame" src="assets/images/asset/<?php echo get_column2("asset_photo","select asset_photo from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>"  />
                                </div>
                                <div class="card-footer">
                                   <button class="btn btn-primary" onclick="open_camera()" id="btnopencam" data-bs-toggle="modal" data-bs-target="#mdlcamera"><i class="ti ti-camera"></i>Open Camera to Capture Image</button>
                                </div>
                             </div> 
                      </div>
                  </div>
                <div class="col-5">
                   <form id="frmaddnewhardwareasset" class="needs-validation-add" onsubmit="event.preventDefault();submit_hardware('frmaddnewhardwareasset','btnsaveselected','../controllers/update_asset_info','Successfully Updated Hardware Asset Information','../listviews/v_assets_info','display_list','addnewasset'); " novalidate>
                    <div class="card">
                      <div class="card-header with-border bg-secondary text-white">
                        <b><i class="ti ti-info-circle"></i> Hardware Asset Information</b>
                      </div>
                        <div class="card-body">
                             <div class="form-group">
                                 Transaction Code :
                                <input type="text" class="form-control"  name="transaction_code" value="<?php echo get_column2("transaction_code","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" readonly="">
                                 <div class="valid-feedback">
                                    <input type="text" name="eid" value="<?php echo get_column2("id","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>">
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                                     <div class="form-group">
                                         Asset Code : 
                                        <input type="text" value="<?php echo get_column2("code","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="asset_code" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 
                               
                               
                                     <div class="form-group">
                                         Machine Name : 
                                        <input type="text" value="<?php echo get_column2("machine_name","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="machinename" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 
                                
                             
                                     <div class="form-group row">
                                      <div class="form-group col-6">
                                         Model Number : 
                                        <input type="text" value="<?php echo get_column2("model_number","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="modelno" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 

                                      <div class="form-group  col-6">
                                         Serial Number : 
                                        <input type="text" value="<?php echo get_column2("serial_number","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="serialno" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                     </div> 
                                     <div class="form-group">
                                         Manufacturer Name : 
                                        <input type="text" value="<?php echo get_column2("manufacturer_name","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="manufacturer_name" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                
                          
                             <div class="form-group">
                                         Date Purchased : 
                                        <input type="date" value="<?php echo get_column2("date_purchased","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db) ?>" class="form-control" name="datepurchase" required>
                                         <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div> 
                             <div class="form-group">
                                Asset Category:
                                <select class="form-control" name="assetcat" id="assetcat" required>
                                    <option value=""></option>
                                    <?php
                                    $sql = "select * from m_asset_category where description='Hardware'";
                                    $data = $db->query($sql)->fetchAll();
                                    foreach($data as $row)
                                    {
                                      $selected = "";
                                      if(get_column2("asset_cat_id","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db)==$row['id']){
                                        $selected = "selected";
                                      }
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                  
                                </div>
                            </div> 
                            
                              <div class="form-group">
                                Can be Installed with Software? : 
                                <select class="form-control" name="installable" required>
                                    <option value=""></option>
                                    <option value="Yes" <?php   if(get_column2("installable_with_software","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db)=='Yes'){echo 'selected';} ?>>Yes</option>
                                    <option value="No" <?php   if(get_column2("installable_with_software","select *  from m_hardware_assets where id='".$_REQUEST['eid']."'",$db)=='No'){echo 'selected';} ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-secondary"  id="btnsaveselected"><i class="ti ti-check"></i> Update Asset Information</button>
                        </div>  
                      </div>
                    </form>
                    </div>
                </div>
            </div>
              </div>
            </div>
          </div>

      </div>
 <div id="mdlcamera" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
           
            <h4 class="modal-title"><i class="mdi mdi-camera"></i> Capture Student Photo</h4>
             <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body text-center">
          
              <center><div id="my_camera" ></div></center>
              <input type="hidden" name="captured_image_data" id="captured_image_data">

          </div>
          <div class="modal-footer">
            <button id="btnshot" class="btn btn-primary " data-bs-dismiss="modal" onClick="take_snapshot()" style="display:none"><i class="mdi mdi-image"></i> Capture </button> 
          
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
function submit_hardware(form_name,btn_name,url,message,listurl,div,modal)
{
    var logForm = $('#' + form_name).serialize();
    //alert(logForm);
        $.ajax({type: 'POST',
        url: url,
        data: logForm,
        cache:false,
        beforeSend: function (){
        $("#" + btn_name).attr("disabled",true);
      },success: function(data){
        //alert(data);
          $("#" + btn_name).attr("disabled",false);
          $("#" + modal + ' .close').click();
          if(data==1){

          fire_message("Record exist","The item you want to add is already existing","error");
          $("#" + btn_name).attr("disabled",false);
          }else if(data==0){
              fire_message("Notifier",message ,"success");
              $('#after_capture_frame').attr('src','assets/images/capture1.png');
             setTimeout(function() {
              window.location = "asset_info";
             }, 2000); 
           
          }
           else if(data==5){
          fire_message("Invalid Data Entry","The head of the family should not be set as member of the household","error");
        
          }
          else
          {
            fire_message("System Message","Sorry but you cannot delete this item because there is a data referenced to this item." + data ,"info");
          }

        }})
  
}
   function open_camera(){
   Webcam.set({
    width: 400,
    height: 287,
    image_format: 'jpeg',
    jpeg_quality: 90
   });   
    $('#my_camera').show(1000);
   Webcam.attach( '#my_camera' );
    $('#btnshot').show(1000);
   }
    function take_snapshot() {
   // play sound effect
   //shutter.play();
   // take snapshot and get image data
   Webcam.snap( function(data_uri) {
   // display results in page
   //document.getElementById('results').innerHTML = 
    '<img class="after_capture_frame" src="'+data_uri+'"/>';
    $('.after_capture_frame').attr("src",data_uri);
   $("#captured_image_data").val(data_uri);
   $('#my_camera').hide(1000);
   $('#btnopencam').show(1000);
    $('#btnshot').hide(1000);
    saveSnap();
      Webcam.reset();
   });   
  }
  function saveSnap(){
  var base64data = $("#captured_image_data").val();
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "controllers/saveimage",
      data: {image: base64data},
      success: function(data) { 
        alert(data);
      }
    });
  }

function stopCam(){
  stream.getTracks().forEach(function(track) {
  track.stop();
});
}
$('#register').on("submit", function(e){
  e.preventDefault();
  var logForm = $('#register').serialize();
   var base64data = $("#captured_image_data").val();
  
  $.ajax({
    type:'POST',
    url:'save_registration',
    cache:false,
    data: logForm,
    beforeSend:function(){
      $('#btnsaveinfo').attr('disabled',true);
    },success:function(data){

       $('#btnsaveinfo').attr('disabled',false);
       if(data==2){
        fire_message("Image Required!","Capture an image first!","error");
       }
       else if(data==0){
        fire_message("Student Successfully Registered!","Student information saved","success");
        setInterval("location.reload();",2000);
       }
    }
  })
})
</script>
</body>
  <!-- [Body] end -->
</html>
