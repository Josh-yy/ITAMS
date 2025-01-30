<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
include('../assets/libs/phpqrcode/qrlib.php');
require '../PHPMailer/PHPMailerAutoload.php';
$newdate = date('Y-m-d h:i:s');
$password = time();	
$sql = "select * from m_users where username = '".$_POST['email']."'";
         $api_key = get_column2("email_api_key","select  * from t_email_facility_settings",$db);
        $sender_email = get_column2("email_address","select  * from t_email_facility_settings",$db);
        $username = get_column2("fn",$sql,$db) . " " .  get_column2("ln",$sql,$db);
		 send_email("Password Reset",$username,$_POST['email'],$api_key,$sender_email,$password);
		$db->query("UPDATE m_users set password = '".encrypt($password)."' where username = '".$_POST['email']."'");
        
        echo 0;


	

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
                       <h3>Forgot Password</h3>
                        <hr>
                    </div>
                    <div class="card-body custom-card-body">
                         Good day <b>'.$username.'</b>!<br>

                     <br>

                    We have successfully reset your accounts password. your new password is <b>'.$password.'</b>

                     <br>

                     <br>

                     Thank you and more power!


                     Truely yours,
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