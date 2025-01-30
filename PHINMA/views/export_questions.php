<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$filename = "Questions.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$data = $db->query('select strip_tags(question),a,b,c,d,answer, (select category_name from m_subject_category where id = category), difficulty_index from t_questions')->fetchAll();

// Write data to file
$flag = false;
foreach($data as $row){
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}

?>
