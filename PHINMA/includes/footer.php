    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0">Copyright &copy; <a href="#" target="_blank" class="text-primary">Cental Luzon State University <small></small></a></p>
          </div>
       
        </div>
      </div>
    </footer>
<div id="change_password" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <?php 

            $password = "";
            if($_SESSION['data']['usertype']=="student"){
               $password = get_column2("password","select * from t_student_account where user_id = '".$_SESSION['data']['account_id']."'",$db);
            }else{
              $password = get_column2("password","select * from m_users where id = '".$_SESSION['data']['account_id']."'",$db);
            }
            ?>
            <input type="hidden" id="current" value='<?php echo decrypt($password) ?>'>
              
              <div class="form-group">
                Enter Current Password :  
                <input type="password" class="form-control"  id="txtcurrent">
              </div>
              <div class="form-group">
                Enter New Password :  
                <input type="password" class="form-control"  id="txtnew">
              </div>
              <div class="form-group">
                Re-enter Password :  
                <input type="password" class="form-control"  id="txtreenter">
              </div>
              <div class="form-group">
                <span class="err_msg"></span>
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="btnclosechange" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="btnchangepassword"><i class="glyphicon glyphicon-saved"></i>Save Changes </button>
            </div>
          </div>
        </div>
      </div>
</div>

<script>
$('#btnchangepassword').on("click",function() {
  var current,txtcurrent,txtnew,txtenter;

  current = $('#current').val();
  txtcurrent = $('#txtcurrent').val();
  txtnew = $('#txtnew').val();
  txtenter = $('#txtreenter').val();

    if(txtcurrent=="")
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Enter Current Password</span>')
  }
 
  else if(txtnew=="")
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Enter New Password</span>')
  }
   else if(txtenter=="")
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Re-enter Password</span>')
  }
   else if($('#txtnew').val().length < 8)
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Password must be at least 8 characters</span>')
  }
  else if(current!==txtcurrent)
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Wrong Password!</span>')
  }
  else if(txtnew!==txtenter)
  {
    $('.err_msg').html('<span class="btn btn-block btn-danger">Password does not match!</span>')
  }
  else
  {
   
    var mydata = "newpassword=" + txtnew;
    //alert(mydata);
     $.ajax({
    url: 'controllers/change_password',
    type: 'POST',
    data: mydata,
    cache: false,
    beforeSend:function(){
      $('#btnsave').attr("disabled",true);
    },
      success: function(data){
      $('#btnsave').attr("disabled",false);
      $('#btnclosechange').click();
       fire_message("Password Updated","Your Password has been successfully changed","success");
      }
      })
  }

})
  </script>