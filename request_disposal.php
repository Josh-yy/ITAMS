<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_class','display_list',1 + '&search=')">
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
                          <h4 class="mb-1">Asset Disposal<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                          <p class="mb-0 opacity-50 text-sm">Filter Assets to be Disposed.</p>
                        </div>
                    </div>
                   <div class="col-auto">
                      <div class="ms-2">
                      </div>
                   </div>
               
                </div>
              </div>
              <div class="card-body p-3" id="">
                <div class="row">
                   <div class="card">
                      <div class="card-body">
                         <div class="row">
                           <div class="col-md-4 col-sm-12">
                            <div class="card border ">
                              <div class="card-header">
                                   <div class="input-group">
                                     
                                      <input type="text" placeholder="Enter Hardware Asset Code" id="txtsearch" class="form-control">
                                      <button class="btn btn-outline-secondary btn-sm" onclick="loadcontent('listviews/v_hardware_info_list','display_hardware_assets',1 + '&search=' + '&locator=1')" data-bs-toggle="modal" data-bs-target="#mdl_search_list"><i class="ti ti-list"></i></button>
                                       <button class="btn btn-outline-secondary btn-sm" onclick="load_camera()" data-bs-toggle="modal" data-bs-target="#capture_qrcode"><i class="ti ti-camera"></i></button>
                                      
                                    </div>
                              </div>
                          </div>
                          </div>
                          <div class="col-md-8 col-sm-12">
                            <div class="card border">
                                    <div class="card-header"> <h1 class="text-muted" id="txtassetname"></h1></div>
                            </div>
                             
                          </div>
                          </div>
                          <div class="row">
                            
                              <div class="col-md-12 col-sm-12">
                                 <div class="card border dashnum-card dashnum-card-small overflow-hidden">
                                     
                                      <div class="card-body" id="asset_other_information">
                                        <img src='assets/images/load_content.gif' style='width:100%' />
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
 
<?php
include('includes/footer.php');
require("includes/js_footer.php");
?>
<div class="modal fade" id="capture_qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                   <h5 class="modal-title">Scan QR Code</h5>
                 
                <button type="button" class="btn btn-light-secondary" onclick="stopCamera()" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" >
                    <div class="card-body">
                        <video id="preview" autoplay playsinline style="width:100%;"></video>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close" onclick="stopCamera()"  data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdl_search_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
               
                <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <input type="text" class="form-control" id="txtsearch" placeholder="Search here..." onkeyup="listrecord('listviews/v_hardware_assets_list','display_hardware_assets',1 + '&search=' + $('#txtsearch').val())">
                     

                        </div>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="display_hardware_assets" style="height:400px; background-color:#f1f1f1; overflow-x: hidden; overflow-y: overflow;">
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close"    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_search_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
               
                <div class="input-group">
                          <button class="btn btn-secondary"><span class="ti ti-search"></span></button>
                          <input type="text" class="form-control" id="txtsearch" placeholder="Search here..." onkeyup="listrecord('listviews/v_search_user_locator','display_users',1 + '&search=' + $('#txtsearch').val())">
                     

                        </div>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="display_users" style="height:400px; background-color:#f1f1f1; overflow-x: hidden; overflow-y: overflow;">
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close"    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/camera/adapter.min.js"></script>
    <script type="text/javascript" src="assets/camera/vue.min.js"></script>
    <script type="text/javascript" src="assets/camera/instascan.min.js"></script>

<script>
    $("#txtsearch").on('keyup', function(e) {
        if (e.key === "Enter") {
          var searchText = $(this).val();
          get_display(searchText);
          // You can perform actions with the typed text here.
        }
      });
  let currentCamera = null;
   let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

   function get_display(content){
    var mydata="param=" + content ;
                  $.ajax({type: 'POST',
                    url: 'search_hardware_asset',
                    data: mydata,
                    cache:false,
                    beforeSend: function (){
                    $("#asset_information_viewer").html("<br><br><center><img src='assets/images/load_content.gif' style='width:50%' /></center>");},
                   success: function(data){
                    scanner.stop(currentCamera);
                      $("#capture_qrcode" + ' .close').click();
                    if(data==0){
                        // textToAudio("Hardware Asset Not found!");
                       $("#asset_information").html("<br><br><center><img src='assets/images/norecord.gif' style='width:100%' /></center>");
                        $("#asset_other_information").html("<br><br><center><img src='assets/images/norecord.gif' style='width:100%' /></center>");
                    }
                    else{
                       // textToAudio("Hardware asset found!");

                      $("#asset_information").html(data);
                      listrecord('get_serial_no','txtassetname',content);
                      listrecord('listviews/asset_information_viewer','asset_other_information',content);
                    }
                  }
                  })
   }
   function load_camera(){
                
                scanner.addListener('scan', function (content) {
               

                var logtype="";
                //insert the reader function here
                 get_display(content);
               
              });
            Instascan.Camera.getCameras().then(function (cameras) {
                var i;
               
                if(cameras.length>0){
                  currentCamera = cameras[1];
                     scanner.start(currentCamera);
                   
                }
                
                
              }).catch(function (e) {
                console.error(e);
              });

   }
   function stopCamera() {
                    if (currentCamera) {
                      scanner.stop(currentCamera);
                      currentCamera = null;
                    }
                  }
               function startCamera(e)
                  {
                    currentCamera = cameras[1];
                     scanner.start(currentCamera);
                 
                  }


function textToAudio(message) {
                let msg = message;
                
                let speech = new SpeechSynthesisUtterance();
                speech.lang = "en-US";
                
                speech.text = msg;
                speech.volume = 1;
                speech.rate = 1;
                speech.pitch = 1;
                
                window.speechSynthesis.speak(speech);
            } 
  $('#asset_information').html("<img src='assets/images/load_content.gif' style='width:100%' />");
 function loadcontent(url,display_div,a)
        {
          var mydata="param=" + a ;
          $.ajax({type: 'POST',
            url: url,
            data: mydata,
            cache:false,
            beforeSend: function (){
            $("#" + display_div).html("<br><br><center><img src='assets/images/load_content.gif' style='width:50%' /></center>");},
           success: function(data){$("#" + display_div).html(data);}
          })
        }   


</script>
  



</body>
  <!-- [Body] end -->
</html>
