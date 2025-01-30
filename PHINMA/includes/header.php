<?php
@session_start();
date_default_timezone_set("Asia/Manila");
require("./assets/settings/db_conn.php");
require("./assets/settings/functions.php");

if(!isset($_SESSION['data']['account_id'])){
    @header("location:login");
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


    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/qrimg.png" type="image/x-icon" />
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
<!-- Font Awesome (optional for icons) -->
<link rel="stylesheet" href="assets/toast/toastify.min.css">
<!-- Font Awesome (optional for icons) -->
<link rel="stylesheet" href="assets/toast/all.min.css">
<!-- Toastify JavaScript -->
<!-- Toastify JavaScript -->
<script src="assets/toast/toastify.js"></script>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->