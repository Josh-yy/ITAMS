<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
include('../assets/libs/phpqrcode/qrlib.php');
require '../PHPMailer/PHPMailerAutoload.php';
$newdate = date('Y-m-d h:i:s');
	$fn = $db->sanitize($_POST['fn']);
	$mn = $db->sanitize($_POST['mn']);
	$ln = $db->sanitize($_POST['ln']);
	$username = $db->sanitize($_POST['username']);
	$department = $db->sanitize($_POST['department']);
	
	$password = encrypt(time());
	$usertype = $db->sanitize($_POST['usertype']);
	$position = $db->sanitize($_POST['position']);
	$gender = $db->sanitize($_POST['gender']);
	$address = $db->sanitize($_POST['address']);
	$civil_stat = $db->sanitize($_POST['civil_stat']);
	$bdate = $db->sanitize($_POST['bdate']);
	$code = time();
	$applicant_dir = "../assets/employee/" . $code . "/";
	$tmpFilePath = $_FILES['picture']['tmp_name'];
	//create_qrcode($code,"../assets/images/qrcode/",$code,$db);

	 if ($tmpFilePath != ""){
    //Setup our new file path
    	$newFilePath = $applicant_dir . $_FILES['picture']['name'];
  	}
	if (!is_dir($applicant_dir)) {
	    mkdir($applicant_dir, 0777, true);
	}

	if(get_exist2("select * from m_users where username = '$username'",$db)>0){
		echo 1;
	}else{
         $api_key = get_column2("email_api_key","select  * from t_email_facility_settings",$db);
        $sender_email = get_column2("email_address","select  * from t_email_facility_settings",$db);
        send_email("User Information",$fn . ' ' . $ln,$username,$api_key,$sender_email,decrypt($password));
		move_uploaded_file($tmpFilePath, $newFilePath);
		$db->query("insert into m_users values (id, '$fn','$mn','$ln','$username','$password','$usertype','$bdate','$gender','$civil_stat','$address','".$_FILES['picture']['name']."','$code','$newdate','".$_SESSION['data']['account_id']."',1,'$department','$position')");
       
        echo 0;
	}

	

    function send_email($email_subject,$username,$email,$apikey,$sender_email,$password){
   $message = '
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Card Design</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for clean, white card design */
        .custom-card {
          
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Box shadow */
        }
        .custom-card-header {
            background-color: #fff; /* Header background color */
          
        }
        .custom-card-body {
            background-color: #fff; /* Body background color */
        }
    </style>
</head>
<body>
    <div class="container ">
        <div class="row">
         <div class="col-md-2"></div>
            <div class="col-md-8">
                <!-- Bootstrap Card with clean, white design -->
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                     <img src="https://phinma.online/assets/images/itams.png">
                     <hr>
                       <h3>ITAMS Account Information</h3>
                        <hr>
                    </div>
                    <div class="card-body custom-card-body">
                         Good day <b>'.$username.'</b>!<br>

                     <br>

                    Your account has been successfully registered at the IT Asset Management System of Phinma Education. <br><hr>
                    <b>Account Information</b>
                    <hr>
                    Username : '.$email.' <br>
                    Password : '.$password.'

                     <br>

                     <br>

                     Thank you and more power!


                     Truly yours,
                     <br>
                     <br>

                     <small><b>Note : </b> This is a system generated email. Please do not reply this email</small>
<br>
                     <br><br>
                     <br>
                     <b>PHINMA EDUCATION</b>
                    </div>
                </div>
            </div>
         <div class="col-md-2"></div>
        </div>
    </div>

    <!-- Add Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>';
      $mail = new PHPMailer(true);                            
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = $sender_email;     
        $mail->Password = $apikey;             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                          
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom($sender_email);
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo($sender_email);
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $email_subject;
        $mail->Body    = $message;

        $mail->send();
}
?>