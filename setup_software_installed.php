<?php 
require('includes/header.php');
?>
  <body onload="listrecord('listviews/v_installed_software','display_records','<?php echo $_REQUEST['hid'] ?>');">
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
                <div class="row">
                 
                     <div class="card dashnum-card dashnum-card-small overflow-hidden">
                    
                    <div class="card-header">
                           Setup Software Installed
                                        <p class="text-sm mb-0">Manage Installed Software on the selected hardware asset</p>
                                         <a class="nav-link " style="border:0px" id="profile-tab-2" data-bs-toggle="tab" href="#another-tab" role="tab" aria-selected="true">
                               <button class="btn btn-secondary float-end" id="add_subject"  data-bs-toggle="modal" data-bs-target="#addsoftware" onclick="listrecord('../listviews/v_software_list','display_software_list',1 + '&search=' + '&hardware_id=<?php echo $_REQUEST['hid'] ?>');"><i class="ti ti-plus"></i> Add Software</button>
                            </a>
                    </div>
                      <div class="card-body row">
                         
                          <div class="row" id="display_records">

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
require("includes/js_footer.php")
?>

<div class="modal fade" id="addsoftware" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Software</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <input type="hidden" id="txttypeid" value="<?php echo $_REQUEST['hid'] ?>">
            <div class="modal-body" style="height:400px; overflow-y: scroll;" id="display_software_list">  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="closemodal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnsavesoftware">Save Selection</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
//save usertype
  $('#btnsavesoftware').on("click",function() {
  var letters = $('input[name="lab_id[]"]:checked').map(function(){return this.value;}).get()
  var mydata = "action=addrole" + "&asset_id=" + $('#txttypeid').val()  + "&facility=" + letters;

  if(letters=="")
  {
      fire_message("Notifier","Please select facilities" ,"info");
  }
  else
    {
     $.ajax({
                  url: '../controllers/save_software',
                  type: 'POST',
                  data: mydata,
                  cache:false,
                  beforeSend: function() {
                    $('#btnsaveselection').attr('disabled', true);
                  },
                  success: function(data) {
                   //alert(data);
                    $('#closemodal').click();
                    $('#btnsaveselection').attr('disabled', false);
                   window.location.reload();
                    
                  }
                })
    }
})
</script>

</body>
  <!-- [Body] end -->
</html>
