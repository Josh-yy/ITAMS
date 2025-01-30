<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

if(get_exist2("select * from t_examination_manager where is_published = 0 and unpublished is null",$db)>0){
$exam_percetage = get_column2("subject_group_percentage_arr","select * from t_examination_manager",$db);
$array_percentage = json_decode($exam_percetage, true);

$exam_items = get_column2("subject_group_total_items_arr","select * from t_examination_manager where is_published = 0 and unpublished is null",$db);
$array_items = json_decode($exam_items, true);

$exam_timer = get_column2("subject_group_time_arr","select * from t_examination_manager where is_published = 0 and unpublished is null",$db);
$array_timer= json_decode($exam_timer, true);

$arrays = get_column2("subject_group_diff_index_arr","select * from t_examination_manager where is_published = 0 and unpublished is null",$db);
$array= json_decode($arrays, true);

?>
<input type="hidden" id="setting_id" value="<?php echo  get_column2("id","select * from t_examination_manager where is_published = 0 and unpublished is null",$db) ?>">
<div class="row">
  <div class="col-9">
    <div class="row">
        <div class="col-12">
           <div class="card">
          <div class="card-header  bg-gray-100"><h3>Subject Group Difficulty Index</h3></div>
          <div class="card-body">
            <div class="table-responsive">
            <div class="customers-scroll" style="height: 310px; position: relative">
            <table style="width:100%">
              <tr>
                  <th>Subject Group</th>
                  <th class="text-center">Difficult</th>
                  <th class="text-center">Average</th>
                  <th class="text-center">Easy</th>
                  <th class="text-center">Total</th>
              </tr>

            <?php
            $total=0;
            $keys = array_keys($array);
             for($i=0; $i<count($keys); $i++){
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
                <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key."'",$db) ?> </td>
                <td class="text-center"><?php echo  $difficult ?></td>
                 <td class="text-center"><?php echo $average  ?></td>
                  <td class="text-center"><?php echo $easy   ?></td>
                  <td class="text-center"><b><?php echo $total ?> </b></td>
            </tr>
            <?php
            
              }
            ?>
             
          </table>
        </div>
      </div>
          </div>
      </div>
        </div>
    </div>
     <div class="row">
        <div class="col-6">
        <div class="card">
          <div class="card-header  bg-gray-100"><h3>Subject Percentage</h3></div>
          <div class="card-body">
            <table style="width:100%">
              <tr>
              <th>Subject Group</th>
              <th class="text-center">Percentage</th>
              </tr>

            <?php
            $total=0;
              foreach ($array_percentage as $key => $value) {
                 
            ?>
            <tr>
                <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key."'",$db) ?> </td>
                <td class="text-center"><?php echo $value[0] ?> %</td>
            </tr>
            <?php
            $total+=$value[0];
              }
            ?>
             <tr class="bg-blue-100">
                <td class="text-center"><b>Total</b></td>
                <td class="text-center"><b><?php echo $total ?> %</b></td>
            </tr>
          </table>
          </div>
      </div>
    </div>
   <div class="col-6">
      <div class="card">
          <div class="card-header  bg-gray-100"><h3>Examination Items</h3></div>
          <div class="card-body">
            <table style="width:100%">
              <tr>
              <th>Subject Group</th>
              <th class="text-center">Total Items</th>
              </tr>

            <?php
            $total=0;
              foreach ($array_items as $key => $value) {
                 
            ?>
            <tr>
                <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key."'",$db) ?> </td>
                <td class="text-center"><?php echo $value[0] ?> </td>
            </tr>
            <?php
            $total+=$value[0];
              }
            ?>
             <tr class="bg-blue-100">
                <td class="text-center"><b>Total</b></td>
                <td class="text-center"><b><?php echo $total ?> </b></td>
            </tr>
          </table>
          </div>
      </div>
  </div>
  
     </div> 
  </div>
  <div class="col-3">
    <div class="d-grid">
        <div class="card">
            <div class="card-header bg-yellow-100"><b>Passing Rate</b></div>
            <div class="card-body bg-gray-100 text-center">
                <h1 class="bg-gray-100"><?php echo get_column2("passing_rate","select * from t_examination_manager where is_published = 0 and unpublished is null",$db); ?> %</h1>
            </div>
        </div>
    </div>
      <div class="d-grid">
        <div class="card">
            <div class="card-header bg-gree-100"><b>Time Allotment</b></div>
            <div class="card-body bg-gray-100 text-center">
                <h1 class="bg-gray-100"><?php echo get_column2("subject_group_time_arr","select * from t_examination_manager where is_published = 0 and unpublished is null",$db); ?> minutes</h1>
            </div>
        </div>
    </div>
    <div class="d-grid">
      <button class="btn btn-secondary btn-block" id="btnpublished"> <i class="ti ti-check" ></i> Publish Examination</button>
     </div>
     <div class="d-grid">
       <button class="btn btn-danger btn-block" id="btndecline"><i class="ti ti-trash"></i> Decline and Reprocess</button>
     </div>
  </div>
</div>
<?php
  $i=1;
  $newString = str_replace("[", "", get_column2("subject_group_questions_arr","select * from t_examination_manager where is_published = 0 and unpublished is null",$db));
  $newString = str_replace("]", "", $newString);
  $sql = "select * from t_questions where id IN (".$newString .")";
  $data = $db->query($sql)->fetchAll();
?>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
       
        <tr>
          <th>No</th>
          <th style="width:10%">Image</th>
          <th  style="width:35%">Question</th>
          <th>Choice A</th>
          <th>Choice B</th>
          <th>Choice C</th>
          <th>Choice D</th>
          <th>Answer</th>
          <th style="width:5%">Difficulty Index</th>
       
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $row) {
          
         
          $img = ($row['attachment']!==null) ? '../questions/' . $row['attachment']  : '../assets/images/noimage.jpg';
          $class="";
      ?>
        <tr>
        <td><?php echo $i ?></td>
        <td><img src="<?php echo $img ?>"  alt="user image" class="img-radius wid-40 align-top m-r-15"></td>
        <td><?php echo $row['question'] ?></td>
        <td><?php echo $row['a'] ?></td>
        <td><?php echo $row['b'] ?></td>
        <td><?php echo $row['c'] ?></td>
        <td><?php echo $row['d'] ?></td>
        <td><?php echo $row['answer'] ?></td>
        <td>
          <?php
            if($row['difficulty_index']=="Difficult"){
              $class = 'badge bg-light-danger';
            }else if($row['difficulty_index']=="Average"){
              $class = 'badge bg-light-warning';
            }
            else if($row['difficulty_index']=="Easy"){
              $class = 'badge bg-light-success ';
            }
          ?>
          <span class="<?php echo $class ?> rounded-pill f-14"><?php echo $row['difficulty_index'] ?></span>
        </td>
       
        </tr>
      <?php
      $i++;
        
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
$(document).ready(function() {
 $('#btnpublished').click(function(){
         Swal.fire({
                      title: 'Are you sure you want to publish this examination settings?',
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: 'Yes',
                      icon: "question",
                      denyButtonText: `No`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                          $.ajax({
                          url: 'controllers/publish',
                          type: 'POST',
                          data: 'id=' + $('#setting_id').val(),
                          cache: false,
                          beforeSend: function() {
                            $('#btnpublished').attr('disabled', true);
                          },
                          success: function(data) {
                            $('#btnpublished').attr('disabled', true);
                           fire_message("Examination Settings Published","You can now view the published examination settings in the ","success");
                            listrecord("listviews/v_exam_publisher","question_publisher",1+"&search=");
                          }
                        })
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                      }
                    })
  })

 $('#btndecline').click(function(){
     Swal.fire({
                      title: 'Are you sure you want to decline this examination settings?',
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: 'Yes',
                      icon: "question",
                      denyButtonText: `No`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                          $.ajax({
                          url: 'controllers/decline',
                          type: 'POST',
                          data: 'id=' + $('#setting_id').val(),
                          cache: false,
                          beforeSend: function() {
                            $('#btnpublished').attr('disabled', true);
                          },
                          success: function(data) {
                            $('#btnpublished').attr('disabled', true);
                           fire_message("Examination Settings Declined","You can now set another  examination settings in the ","success");
                            listrecord("listviews/v_exam_publisher","question_publisher",1+"&search=");
                          }
                        })
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                      }
                    })
  })
  })

</script>
