   <?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");


?>


<table style="width:100%; font-size:12px    ">
    <tr>
        <th rowspan="2" class="text-center">No</th>
        <th rowspan="2" class="text-center">Subject Group</th>
        <th rowspan="2" class="text-center">Total Items</th>
        <th colspan="9" class="text-center">Difficulty Index</th>
    </tr>
    <tr>
        <th class="text-center">Difficult</th>
        <th class="text-center">Items</th>
        <th class="text-center">Actual</th>
        <th class="text-center">Average</th>
        <th class="text-center">Items</th>
         <th class="text-center">Actual</th>
        <th class="text-center">Easy</th>
        <th class="text-center">Items</th>
         <th class="text-center">Actual</th>
    </tr>
        <tbody>
                <?php
                    $i=1;
                    $diff_count=[];
                    $average_count=[];
                    $easy_count=[];
                    $sql = "select * from m_subject_category where id IN (1,2,3)";
                    $data  = $db->query($sql)->fetchAll();
                    foreach($data as $row){


                        $total_items = @get_column2("total_items","select * from t_items_per_subject_group where category_id = '".$row['id']."'",$db);
                        $difficult_percent = @get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Difficult'",$db);
                        $difficult_items = @($total_items * (get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Difficult'",$db)/100));
                        $difficult_actual_questions = @get_column2("total_items","select count(*) as total_items from t_questions where category = '".$row['id']."' and difficulty_index = 'Difficult' ",$db); 


                        $average_percent = @get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Average'",$db);
                        $average_items = @($total_items * (get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Average'",$db)/100));
                        $average_actual_questions = @get_column2("total_items","select count(*) as total_items from t_questions where category = '".$row['id']."' and difficulty_index = 'Average' ",$db); 

                         $easy_percent = @get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Easy'",$db);
                        $easy_items = @($total_items * (get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Easy'",$db)/100));
                        $easy_actual_questions = @get_column2("total_items","select count(*) as total_items from t_questions where category = '".$row['id']."' and difficulty_index = 'Easy' ",$db); 

                         if($difficult_items>$difficult_actual_questions){
                            $diff_count[$row['id']] = 1;
                            }
                        if($average_items>$average_actual_questions){
                           
                            $average_count[$row['id']] = 1;
                            }
                        if($easy_items>$easy_actual_questions){
                            
                             $easy_count[$row['id']] = 1;
                            }
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td class="text-center"><?php echo $row['category_name'] ?></td>
                            <td class="text-center"><?php echo get_column2("total_items","select * from t_items_per_subject_group where category_id = '".$row['id']."'",$db) ?></td>

                            <td class="text-center"><?php echo $difficult_percent ?></td>
                            <td class="text-center"><?php echo $difficult_items ?></td>
                            <td class="text-center"><?php echo $difficult_actual_questions ?></td>

                            <td class="text-center"><?php echo $average_percent ?></td>
                            <td class="text-center"><?php echo $average_items ?></td>
                            <td class="text-center"><?php echo $average_actual_questions ?></td>

                            <td class="text-center"><?php echo $easy_percent ?></td>
                            <td class="text-center"><?php echo $easy_items ?></td>
                            <td class="text-center"><?php echo $easy_actual_questions ?></td>
                                              
                        </tr>
                            <?php
                                $i++;
                                }

 $msg = "";
    if(display_counter(count($diff_count),"Difficult",$diff_count,$db)!==""){
        $msg = $msg . display_counter(count($diff_count),"Difficult",$diff_count,$db);
        $msg = $msg . "<hr>";
    }
    if(display_counter(count($average_count),"Average",$average_count,$db)!==""){
        $msg = $msg .  display_counter(count($average_count),"Average",$average_count,$db);
        $msg = $msg . "<hr>";
    }
    if(display_counter(count($easy_count),"Easy",$easy_count,$db)!==""){
         $msg = $msg .  display_counter(count($easy_count),"Easy",$easy_count,$db);
    }
    ?>
        </tbody>
</table>
<hr>
<?php
if($msg!==""){
?>
<div class="alert alert-danger">
    <b>Important Notes : </b>
    <?php echo $msg ?>
</div>

  <?php
  }
else
{


?>
<div class="alert alert-success">
    <b>Note : </b>
    you are now ready to automatically pick question from the test item bank! click the process examination questions to complete the transaction.
</div>
<?php
   }


   

   function display_counter($maxcount,$dindex,$arr,$db){
    $msg ="";
    foreach($arr as $index => $key){
        if($key>0){
               $msg = $msg ."The actual number of <b>easy</b>  question  <b>" . get_column2("category_name","select * from m_subject_category where id = '".$index."'",$db) . "</b>  does not meet the total percentage allocation of the diffculty index. <br>";
        }
    }
   

    return $msg;
   }
    ?>
                                    