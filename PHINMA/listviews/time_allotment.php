<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
?>

<h1 class="text-secondary"><?php echo get_column2("time_allotment","select * from t_time_allotment",$db) ?> minutes </h1>
