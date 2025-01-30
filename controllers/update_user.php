<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
include('../assets/libs/phpqrcode/qrlib.php');
$newdate = date('Y-m-d h:i:s');
$id = $_POST['id'];
	$fn = $db->sanitize($_POST['fn']);
	$department = $db->sanitize($_POST['department']);
	$mn = $db->sanitize($_POST['mn']);
	$ln = $db->sanitize($_POST['ln']);
	$username = $db->sanitize($_POST['username']);
	$usertype = $db->sanitize($_POST['usertype']);
	$password = encrypt(time());
	$gender = $db->sanitize($_POST['gender']);
	$address = $db->sanitize($_POST['address']);
	$civil_stat = $db->sanitize($_POST['civil_stat']);
	$bdate = $db->sanitize($_POST['bdate']);
	$code = time();
    $position = $db->sanitize($_POST['position']);
	$applicant_dir = "../assets/employee/" . $code . "/";
	$tmpFilePath = $_FILES['picture']['tmp_name'];
	
	 if ($tmpFilePath != ""){
    //Setup our new file path
    	$newFilePath = $applicant_dir . $_FILES['picture']['name'];
  	}
	if (!is_dir($applicant_dir)) {
	    mkdir($applicant_dir, 0777, true);
	}
	@create_qrcode($code,"../assets/images/qrcode/",$code,$db);

    //Setup our new file path

    	$newFilePath = $applicant_dir . $_FILES['picture']['name'];
    	 if(move_uploaded_file($tmpFilePath, $newFilePath)){
    	 	$db->query("update m_users set fn='$fn',mn='$mn',ln='$ln',qr_code='$code',dept_id='$department',username='$username',birthdate='$bdate',position_id='$position',gender='$gender',civil_status='$civil_stat',usertype='$usertype', address='$address',avatar='".$_FILES['picture']['name']."'  where id = '$id'");
		
		echo 0;
    	
  	}
  		else
  	{
  		$db->query("update m_users set fn='$fn',mn='$mn',ln='$ln',qr_code='$code',username='$username',dept_id='$department',birthdate='$bdate',gender='$gender',position_id='$position',civil_status='$civil_stat',usertype='$usertype', address='$address' where id = '$id'");
		echo 0;
	
  	}
  


function create_qrcode($code,$path,$name,$db)
    {
         //$this->load->library('Qrcode');
        $value = $code;//QR code content
        $errorCorrectionLevel = 'H';  //Fault tolerance level
        $matrixPointSize = 10;      //Generate picture size

        //Generate QR code picture
        if(!file_exists($path)){
            mkdir($path, 0700,true);
        }
        $time = $name . '.png';//Generated QR code file name
        $fileName = $path.$time;//1. Path of QR code file generated by assembly
        QRcode::png($value,$fileName , $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = '../assets/images/' . get_column2("logo","select * from system_settings",$db); //logo picture ready
        $QR = $fileName;                //Generated original QR code picture file
        if (file_exists($logo)) {
            $QR = imagecreatefromstring(file_get_contents($QR));    //Target image connection resource.
            $logo = imagecreatefromstring(file_get_contents($logo));  //Source image connection resource.
            $QR_width = imagesx($QR);      //QR code picture width
            $QR_height = imagesy($QR);     //QR code image height
            $logo_width = imagesx($logo);    //logo picture width
            $logo_height = imagesy($logo);   //logo image height
            $logo_qr_width = $QR_width / 4;   //Width of logo after combination (1 / 5 of QR code)
            $scale = $logo_width/$logo_qr_width;  //Width scaling ratio of logo (own width / combined width)
            $logo_qr_height = $logo_height/$scale; //Height of logo after combination
            $from_width = ($QR_width - $logo_qr_width) / 2;  //Coordinate point of upper left corner of logo after combination
            //Recombine and resize pictures
            /*
             * imagecopyresampled() Copy a square area from one image (source image) to another
             */
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
        }
        //Output pictures
        $time =$name . '.png';//Generated QR code file name
        $logo_img_path = $path.$time; 
        imagepng($QR, $logo_img_path);
        imagedestroy($QR);
    }
	
?>