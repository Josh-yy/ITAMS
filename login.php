<?php
@session_start();
date_default_timezone_set("Asia/Manila");
require("./assets/settings/db_conn.php");
require("./assets/settings/functions.php");

if (isset($_SESSION['data']['account_id'])){
 
    @header("location:index");
  
}



?>
<!DOCTYPE html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title><?php echo get_column2("name","select * from system_settings",$db) ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Berry is made using Bootstrap 5 design framework. Download the free admin template & use it for your project."
    />
    <meta name="keywords" content="Berry, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template" />
    <meta name="author" content="CodedThemes" />

    <!-- [Favicon] icon -->
   <link rel="icon" href="assets/images/qrimg.png" type="image/x-icon" />
 <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />
<link rel="stylesheet" href="../assets/css/style-preset.css" id="preset-style-link" />
<link rel="stylesheet" href="../assets/scripts/sweetalert2/dist/sweetalert2.min.css">
 <link rel="stylesheet" href="assets/morris.js/morris.css">
 <script src="../assets/scripts/jquery.js"></script>
<script src="../assets/raphael/raphael.min.js"></script>
<script src="../assets/morris.js/morris.min.js"></script>
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
<link rel="stylesheet" href="../assets/css/style-preset.css" id="preset-style-link">
<style type="text/css">
.adderrborder{
  border: red this ;
}
</style>

  </head>
  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
      <div class="auth-wrapper v3">
        <div class="auth-form">
          <div class="card my-5">
            <div class="card-body">
              <a href="#" class="d-flex justify-content-center">
                <img src="../assets/images/<?php echo get_column2("logo","select * from system_settings",$db) ?>" style="width:50%" />
              </a>
              <div class="row">
                <div class="d-flex justify-content-center">
                  <div class="auth-header">
                     <h1 class="text-secondary mt-5 text-center"><b><?php echo get_column2("description","select * from system_settings",$db) ?></b><br>
                      <?php echo get_column2("name","select * from system_settings",$db) ?></b>
                     </h1>
                    
                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                    <small class="text-center" id="err_msg"></small>
                  </div>
                </div>
              </div>
              <form id="sign_in" onsubmit="event.preventDefault();validate_form('sign_in','verify_login','Sign-in Message','Sign-in Successful','err_msg','success',['txtusername','txtpassword'],['username','password'])">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtusername" name="username" placeholder="Email address / Username" />
                <label for="floatingInput">Email address / Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password"  id="txtpassword" placeholder="Password"  />
                <label for="floatingInput">Password</label>
              </div>
              <div class="d-flex mt-1 justify-content-between">
                
              </div>
              <div class="mt-4 row">
                 <div class="col-md-6 col-sm-12 d-grid"><button type="submit" class="btn btn-secondary"><i class="material-icons-two-tone">check</i>  Sign In Account</button></div>
                 <div class="col-md-6 col-sm-12 d-grid"><a href="forgot_password" class="btn btn-outline-secondary"><i class="material-icons-two-tone">info</i> Forgot Password</a></div>
                
                
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>

 <!-- Required Js -->
<?php
require("includes/js_footer.php")
?>

<script>

function validate_form(form_id,url,msg_title,msg_content,err_div,msg_icon,control_arrays,control_names){
  var counter = 0;

    for(var i = 0;i<control_arrays.length; i++){
      if($('#' + control_arrays[i]).val().length>0){
         $('#' + err_div).empty();
        $('#' + control_arrays[i]).removeClass('bg-red-100');
        $('#' + control_arrays[i]).removeClass('adderrborder');
        $('#' + control_arrays[i]).removeClass('text-danger');
      }else{
        counter++;
        $('#' + err_div).addClass('text-red-900');
        $('#' + control_arrays[i]).focus();
        $('#' + control_arrays[i]).addClass('bg-red-100');
        $('#' + err_div).html("Please enter " + control_names[i]);
        $('#' + control_arrays[i]).addClass('adderrborder');
      }
    }
    if(counter==0){
      esubmit("controllers/verify",$('#' + form_id).serialize(),1,"index");
    }
    
}

function esubmit(my_url,data,redirect,redirect_page){
 $.ajax({
  type:'POST',
  cache:false,
  data:data,
  url:my_url,
  success:function(data){
    if(data==0){
       fire_message("Invalid Account","Invalid Username and Password","error");
    }else{
      swal_interval("Account Verification","Verifying Account Please wait",redirect_page,data);
    }
   
  }
 })
}

function swal_interval(msg_title,msg_message,redirect_page,data){
  let timerInterval
    Swal.fire({
      title: msg_title,
      html: msg_message,
      timer: 2000,
      icon:"info",
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
       
        if(data!==0){
          window.location = redirect_page;
        }
        else{
          fire_message("Invalid Account","Invalid Username and Password","error");
        }
      }
    })
}

</script>
  </body>
  <!-- [Body] end -->
</html>
