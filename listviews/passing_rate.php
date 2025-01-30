<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
?>

<h1 class="text-secondary"><?php echo get_column2("passing_rate","select * from t_passing_rate",$db) ?> % </h1>
