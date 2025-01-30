<?php



require '../PHPMailer/PHPMailerAutoload.php';


send_email("User Information","ROnald","ronald09259281@gmail.com","gpvircuprkntkvfw","isu.roxas.campus.2022@gmail.com",12345);


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
                   
                     <hr>
                       <h3>Account Information</h3>
                        <hr>
                    </div>
                    <div class="card-body custom-card-body">
                         Good day <b>'.$username.'</b>!<br>

                     <br>

                    Your account has been successfully registered at online system of Roxas Central <br><hr>
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
                     <b>ROXAS CENTRAL</b>
                    </div>
                </div>
            </div>
         <div class="col-md-2"></div>
        </div>
    </div>

   
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