<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	$sql = "select * from m_curriculum where id = '".$_REQUEST['param']."'";


?>
 <div class="card dashnum-card dashnum-card-small overflow-hidden">
    <span class="round bg-secondary small"></span>
    <span class="round bg-secondary big"></span>

    <div class="card-header">
    	<h1><span class="text-success"><?php echo get_column2("curr_code",$sql,$db) ?></span> - <?php echo get_column2("curr_name",$sql,$db) ?></h1>
    	<h2 class="text-gray-500"><?php echo get_column2("year",$sql,$db) ?></h2>
    </div>
</div>
	