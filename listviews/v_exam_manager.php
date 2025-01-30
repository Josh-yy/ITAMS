<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

if(get_exist2("select * from t_examination_manager where is_published=1",$db)>0){
  $esql = "select * ,date_format(date_published,'%Y-%m-%d %r') as dateadded from t_examination_manager where is_published=1";
  $edata = $db->query($esql)->fetchAll();
?>

<?php
function get_percentage($sid,$arr){
   foreach ($arr as $key => $value) {
    if($sid==$key)
    {
      return $value[0];
      break;
    }
   }
}
  foreach($edata as $erow){


$exam_percetage = get_column2("subject_group_percentage_arr","select * from t_examination_manager where id = '".$erow['id']."'",$db);
$array_percentage = json_decode($exam_percetage, true);


$exam_items = get_column2("subject_group_total_items_arr","select * from t_examination_manager where id = '".$erow['id']."'",$db);
$array_items = json_decode($exam_items, true);


$exam_timer = get_column2("subject_group_time_arr","select * from t_examination_manager where id = '".$erow['id']."'",$db);
$array_timer= json_decode($exam_timer, true);


$arrays = get_column2("subject_group_diff_index_arr","select * from t_examination_manager where id = '".$erow['id']."'",$db);
$array= json_decode($arrays, true);

?>

<div class="card border follower-card">
  <div class="card-header">
    <b>Examination Setting published on : <span class="text-secondary"><?php echo $erow['dateadded'] ?></span></b>
    <br>
    <b>Passing Rate : <span class="text-secondary"><?php echo $erow['passing_rate'] ?> %  </span></b> | <b>Time Allotment : <span class="text-secondary"><?php echo $erow['subject_group_time_arr'] ?> <i>minutes</i>  </span></b>
    <span class="btn btn-outline-secondary" id="unpublish<?php echo $erow['id'] ?>" onclick="unpublish('<?php echo $erow['id'] ?>')" style="float:right"><i class="ti ti-plus"></i>Unpublish and Set New</span> 
  </div>
  <div class="card-body">
    <table class="table table-bodered">
  <thead>
      <tr class="bg-yellow-100">
        <th rowspan="2">No</th>
        <th rowspan="2">Subject Group</th>
        <th colspan="3">Difficulty Index</th>
        <th rowspan="2">TOtal Items Items</th>
        <th rowspan="2" class="text-center">Subject Percentage</th>
       
      </tr>
      <tr class="bg-yellow-100">
        <th>Easy</th>
        <th>Average</th>
        <th>Difficult</th>
      </tr>
      </thead>
<tbody>
      <?php
      $no=1;
         
            $keys = array_keys($array);
             for($i=0; $i<count($keys); $i++){
                 $total=0;
               $key = $keys[$i];
                $value = $array[$key];
                $difficult=0;
                $average=0;
                $easy=0;
             
                  $total_items = get_column2("total_items","select * from t_items_per_subject_group where category_id = '".$key."'",$db);
                  $difficult = $total_items * ($value['Difficult']/100) ;
                  $average = $total_items * ($value['Average']/100) ;
                  $easy = $total_items * ($value['Easy']/100) ;
                  $total+=($difficult + $average + $easy);
            ?>
          <tr>
              <td><?php echo $no ?></td>
              <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key."'",$db) ?> </td>
              <td class="text-center"><?php echo $easy   ?></td>
              <td class="text-center"><?php echo $average  ?></td>
              <td class="text-center"><?php echo  $difficult ?></td>
              <td class="text-center"><b><?php echo $total ?> </b></td>
              <td class="text-center"><?php echo get_percentage($key,$array_percentage) ?> %</td>

            </tr>
            <?php
            $no++;
              }
            ?>



<?php
  $i=1;
  $newString = str_replace("[", "", get_column2("subject_group_questions_arr","select * from t_examination_manager where id = '".$erow['id']."'",$db));
  $newString = str_replace("]", "", $newString);
  $sql = "select * from t_questions where id IN (".$newString .")";
  $data = $db->query($sql)->fetchAll();
?>

<?php
}
?>
 </tbody>
</table>
  </div>
</div>

<?php
}
else
{
?>
<div class="alert alert-warning">
    <h4>Reminder</h4>
    There is no processed examination yet. Kindly go to the examination settings tab and set all necessary settings to be made, click the <b>Processed Transaction button to automatically pick questions</b>
</div>  
<?php
}
?>

<script>


 function unpublish(id){

     Swal.fire({
                      title: 'Are you sure you want to unpublish this examination settings and set new one?',
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: 'Yes',
                      icon: "question",
                      denyButtonText: `No`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                          $.ajax({

                          url: 'controllers/unpublish',
                          type: 'POST',
                          data: 'id=' + id,
                          cache: false,
                          beforeSend: function() {
                            $('#unpublish' + id).attr('disabled', true);
                          },
                          success: function(data) {
                             $('#unpublish' + id).attr('disabled', true);
                           fire_message("Examination Settings Unpublished","","success");
                            listrecord("listviews/v_exam_manager","question_publisher",1+"&search=");
                          }
                        })
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                      }
                    })
 }

  </script>


