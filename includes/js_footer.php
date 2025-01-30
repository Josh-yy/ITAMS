

<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/config.js"></script>
<script src="../assets/scripts/jquery.js"></script>
<script src="../assets/scripts/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="includes/js_scripts.js"></script>
<script src="assets/js/plugins/ckeditor/ckeditor.js"></script>
<script src="assets/echarts/dist/echarts.min.js"></script>
<script src="../assets/raphael/raphael.min.js"></script>
<script src="../assets/morris.js/morris.min.js"></script>
 <link rel="stylesheet" href="../assets/morris.js/morris.css">

<script src="../assets/js/webcam.js"></script>

<script src="../assets/js/config.js"></script>
<script src="../assets/js/pcoded.js"></script>
    <!-- [Page Specific JS] start -->
    <!-- Apex Chart -->


<script>
var interval = setInterval(function() {
  get_software_expiration('<?php echo $_SESSION['data']['utype'] ?>');
}, 5000);
function get_software_expiration(usertype){
        $.ajax({
        type:'POST',
        url:'controllers/check_expiration',
        data:'',
        cache:false,
        success:function(data){
          if(usertype==2 || usertype ==6){
            if(data==1){
              showToast('There is a software that will expire soon!', 'danger');
            }else if(data>1){
              showToast('There are ' + data + ' software that are about to expire soon!' , 'danger');
            }
        }
      }
      });
}




function showToast(message, type = 'info') {
    Toastify({
        text: message,
        duration: 2000, // Duration in milliseconds (3 seconds in this example)
        newWindow: true,
        close: true,
        gravity: 'bottom', // or 'bottom'
        position: 'right', // 'left', 'right', 'center'
        backgroundColor: type === 'error' ? '#FF6B6B' : '', // Customize background color for error messages
        className: 'toastify-' + type, // Add custom CSS class based on type
    }).showToast();
}
$('#frmaddquestion').submit(function(e) {
    e.preventDefault();
    var logForm = new FormData(this);

                        $.ajax({type: 'POST',
                        url: '../controllers/save_question',
                        data: logForm,
                          contentType: false,
                          cache: false,
                          processData:false,
                        beforeSend: function (){
                        $("#btnsavequestion").attr("disabled",true);  
                      },success: function(data){
                          $("#btnsavequestion").attr("disabled",false);
                          $('#frmaddquestion')[0].reset();
                                                           
                            editor4.setData('');
                            editor1.setData('');
                            editor2.setData('');
                            editor3.setData('');
                            editor.setData('');
                          
                          if(data==1){
                                fire_message("Record exist","The item you want to add is already existing","error");
                          }
                          else if(data==0){
                            $("#update .close").click();
                                fire_message("Question Saved","You have successfully saved the new questions" ,"success");
                                
                          }
                          else
                          {
                            fire_message("Error in saving",data ,"info");
                          } 
                    }
                })
})

$('#frmeditquestion').submit(function(e) {
    e.preventDefault();
    var logForm = new FormData(this);

                        $.ajax({type: 'POST',
                        url: '../controllers/update_question',
                        data: logForm,
                          contentType: false,
                          cache: false,
                          processData:false,
                        beforeSend: function (){
                        $("#btnsavequestion").attr("disabled",true);  
                      },success: function(data){
                        //alert(data);
                          $("#btnsavequestion").attr("disabled",false);
                          $('#frmaddquestion')[0].reset();
                                                           
                            equestion.setData('');
                            echoicea.setData('');
                            echoiceb.setData('');
                            echoicec.setData('');
                            echoiced.setData('');
                          
                          if(data==1){
                                fire_message("Record exist","The item you want to add is already existing","error");
                          }
                          else if(data==0){
                            $("#update .close").click();
                                fire_message("Question Updated","You have successfully updated the question" ,"success");
                                
                          }
                          else
                          {
                            fire_message("Error in saving",data ,"info");
                          } 
                    }
                })
})

</script>