<?php
@session_start();
@date_default_timezone_set("Asia/Manila");


     //counter check FACILITIES TO BE VISITED by the user
    $uri = $_SERVER['REQUEST_URI'];
    //echo $uri; // Outputs: URI

    //echo "<br>";
    $facility =  (explode("/",$uri));
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
     
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //echo $url; // Outputs: Full URL
     
    //header("location:" . $_SERVER['QUERY_STRING']); 
    $facility_link =  $facility[count($facility) - 1];

   
   
        
        $sql ="select * from t_user_roles a where usertype_id = '".$_SESSION['data']['utype']."' and  facility_id = '".get_column2("id","select * from m_facilities where facility_link='".$facility_link."' ",$db)."'";
        
      $counter = get_exist2($sql,$db);
      if($counter==0)
      {
        echo "<script>window.history.back();</script>";
      }
?>