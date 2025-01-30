<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
require '../PHPMailer/PHPMailerAutoload.php';
$newdate = date('Y-m-d h:i:s');
$non_functional_date = $_POST['non_functional_date'];
$asset_id = $_POST['asset_id'];
$reasons = $_POST['reasons'];



		$db->query("insert into t_asset_disposal values (id, '$asset_id','$non_functional_date','$reasons','$newdate')");
		$db->query("UPDATE m_hardware_assets set status = 'Disposed' where id = '".$asset_id."'");
		//save notification
       // $db->query("INSERT INTO t_asset_disposal VALUES ()");
        echo 0;

if(get_column2("is_enabled","select  * from t_email_facility_settings",$db)==1){
    $machine_name  = get_column2("machine_name","select * from m_hardware_assets where id = '".$asset_id."'",$db);
    $activity =  $_SESSION['data']['account_name'] . " processed the asset disposal of the hardware asset " . $machine_name;
    activity_log_maker("Asset Disposal",$activity,$_SESSION['data']['account_id'],$db);
	$sql = "select * from t_asset_disposal_recepients";
	$data = $db->query($sql)->fetchAll();
	foreach($data as $row){
		$username = get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$row['user_id']."'",$db);
		$email = get_column2("username","select * from m_users where id = '".$row['user_id']."'",$db);
		//send email here
		$serial = get_column2("serial_number","select  * from m_hardware_assets where id = '$asset_id'",$db);
		$api_key = get_column2("email_api_key","select  * from t_email_facility_settings",$db);
		$sender_email = get_column2("email_address","select  * from t_email_facility_settings",$db);

			send_email($serial,"Asset Disposal Notification",$email,$username,$api_key,$sender_email,$reasons,$non_functional_date);
	}

}

function send_email($serial,$email_subject,$email,$username,$apikey,$sender_email,$reason,$edate){
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
                       <h3> Asset Disposal Notification</h3>
                        <hr>
                    </div>
                    <div class="card-body custom-card-body">
                         Good day <b>'.$username.'</b>!<br>

                     <br>

                     This email informs you that the asset with a serial number <b>'.$serial.'</b> is for disposal due to <b>'.$reason.'</b> effective <b>' .$edate.'</b>.
                     In this regard we are sending this email for you to be notified of its replacement as soon as possible. 

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