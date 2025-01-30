<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

  $sql = "select * from m_subject_category";
  $data = $db->query($sql)->fetchAll();
 $array= array();
  class User{
    public $name;
    public $value;
  }
foreach($data as $row)
{
	$user=new User();
    $user->name =  $row['category_name'] ;
    $user->value = get_exist2("select * from t_questions where category = '".$row['id']."'",$db) / get_exist2("select * from t_questions",$db) * 100;
    $array[]=$user;
}

echo json_encode($array);
?>