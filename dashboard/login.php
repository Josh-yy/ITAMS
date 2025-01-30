<?php 
require('includes/header.php');
if (isset($_SESSION['data']['account_id'])){
 
    @header("location:index");
  
}
?>
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
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary">Sign In Account</button>
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


  </body>
  <!-- [Body] end -->
</html>
