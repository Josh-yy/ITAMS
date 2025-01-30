<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$userid = $_REQUEST['param'];
echo get_column2('id',"select * from m_student_information where student_id = '".$_POST['param']."'",$db);
function get_percentage($sid,$arr){
   foreach ($arr as $key => $value) {
    if($sid==$key)
    {
      return $value[0];
      break;
    }
   }
}
?>
  <div class="card">
              <div class="card-body">
                  <ul class="nav nav-tabs profile-tabs border-bottom mb-3 d-print-none" id="myTab" role="tablist">
                   <li class="nav-item">
                  <a class="nav-link active" id="test_item_analysis" data-bs-toggle="tab" href="#listrecord" role="tab" aria-selected="true">
                  <i class="material-icons-two-tone me-2">info</i>Records List
                  </a>
                  </li>
               <li class="nav-item">
                  <a class="nav-link " id="profile-tab-2" data-bs-toggle="tab" href="#pdfreport" role="tab" aria-selected="true">
                  <i class="material-icons-two-tone me-2">post_add</i>PDF REPORT
                  </a>
                  </li>
                </ul>
                 <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="listrecord" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row" id="display_record"> 
                    <?php
                     if(get_exist2("select * from t_student_mock where student_id = '".get_column2('id',"select * from m_student_information where student_id = '".$_POST['param']."'",$db)."' and sy_id = (select sy_id from m_sy where is_active = 1)",$db)==0){
                    ?>
                    <div class="alert alert-warning">
                        <b>No record has been found</b>
                    </div>
                    <?php
                    }else
                    {
                    ?>
                     <div class="card border">
                  <div class="card-header">
                    <h3><i class="ti ti-folder"></i> Institutional Mock Exam Examination Result</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                              <div class="row">
                                <div class="alert alert-success">
                                  <h4><i class="ti ti-file-info"></i> Target and Actual Institutional Mock Exam Rating</h4>
                                </div>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Subject Group</th>
                                      <th class="text-center">Total Items</th>
                                      <th class="text-center">Passing Percentage</th>
                                      <th class="text-center">Raw Score</th>
                                      <th class="text-center">Percentage</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                              <?php
                                  $sql = "select *,date_format(date_published,'%M-%D-%Y %r') as dateadded from t_examination_manager where id = (select exam_id from t_student_mock where student_id = '".get_column2('id',"select * from m_student_information where student_id = '".$_POST['param']."'",$db)."' and sy_id = (select sy_id from m_sy where is_active = 1))";
                                  $data = $db->query($sql)->fetchAll();
                                  foreach($data as $row){
                                      $exam_percetage = get_column2("subject_group_percentage_arr","select * from t_examination_manager where id = '".$row['id']."'",$db);
                                      $array_percentage = json_decode($exam_percetage, true);


                                      $exam_items = get_column2("subject_group_total_items_arr","select * from t_examination_manager where id = '".$row['id']."'",$db);
                                      $array_items = json_decode($exam_items, true);


                                      $exam_timer = get_column2("subject_group_time_arr","select * from t_examination_manager where id = '".$row['id']."'",$db);
                                      $array_timer= json_decode($exam_timer, true);


                                      $arrays = get_column2("subject_group_diff_index_arr","select * from t_examination_manager where id = '".$row['id']."'",$db);
                                      $array= json_decode($arrays, true);
                                      $arrays = get_column2("subject_group_diff_index_arr","select * from t_examination_manager where id = '".$row['id']."'",$db);
                                      $array= json_decode($arrays, true);

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
                                      <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key."'",$db) ?></td>
                                      <td class="text-center"><?php echo $total ?></td>
                                      <td class="text-center"><?php echo get_percentage($key,$array_percentage) ?> %</td>
                                      <td class="text-center"><?php echo get_column2("total_score","select * from t_mock_subject_group_grade where student_id = '".$_SESSION['data']['account_id']."' and exam_id = (select exam_id from t_student_mock where sy_id = (select sy_id from m_sy where is_active = 1) and student_id = '".$_SESSION['data']['account_id']."') and subject_group_id = '".$key."'",$db) ?> </td>
                                      <td class="text-center"><?php echo get_column2("percentage","select * from t_mock_subject_group_grade where student_id = '".$_SESSION['data']['account_id']."' and exam_id = (select exam_id from t_student_mock where sy_id = (select sy_id from m_sy where is_active = 1) and student_id = '".$_SESSION['data']['account_id']."') and subject_group_id = '".$key."'",$db) ?> % </td>
                                  </tr>
                                  
                              <?php
                                  }
                                  }
                                  $class = "";
                                  $remarks = get_column2("remarks","select * from t_student_mock where student_id = '".$_SESSION['data']['account_id']."' and sy_id = (select sy_id from m_sy where is_active = 1)",$db);
                                  if($remarks=="Passed"){
                                    $class = "bg-green-100";
                                  }else{
                                    $class = "bg-red-100";
                                  }
                              ?>
                              <tr class="<?php echo $class ?>">
                                  <td align="right" colspan="4"><b>TOTAL</b></td>
                                  <td class="text-center"><b><?php echo get_column2("total_percentage","select * from t_student_mock where student_id = '".$_SESSION['data']['account_id']."' and sy_id = (select sy_id from m_sy where is_active = 1)",$db)  ?> % </b></td>
                              </tr>
                              <tr class="<?php echo $class ?>">
                                  <td align="right" colspan="4"><b>REMARKS</b></td>
                                  <td class="text-center"><b><?php echo $remarks  ?></b></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                               
                      

                        </div>
                        <div class="col-6">
                          <div class="card">
                                <div class="card-header bg-gray-100"><b><i class="ti ti-chart"></i> Your Subject Group Ratings</b></div>
                                <div class="card-body">
                                       <div class="scroll-area-lg">
                                    <div id="subject_group" style="height:380px; padding:10px;"></div>
                                 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
                    <?php
                    }
                    ?>
                  </div>
                  </div>
                  <div class="tab-pane fade show" id="pdfreport" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row" id="iframedisplay"> 
                    <div class="ratio ratio-21x9 rounded overflow-hidden">
                     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/individual_result?sid=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>
                   </div>
                  </div>
                  </div>  
              </div>
              </div>
            </div>
<?php

$json_array=array();  

$array = [];
$json_array_dailys=array();  
$array_modules = [];
$data = $db->query("select * from v_student_subject_group_percentage where student_id = '".$_SESSION['data']['account_id']."' and sy_id = (select sy_id from m_sy where is_active = 1)")->fetchAll();
foreach($data as $row){
       $array_modules['label']=$row['category_name']; 
      $array_modules['value']= $row['percentage'];
      array_push($json_array,$array_modules);
}
?>
<script>
Morris.Bar({
  element: 'subject_group',
  data: <?php echo json_encode($json_array, JSON_UNESCAPED_UNICODE) ?>,
  xkey: ['label'],
  ykeys: ['value'],
  barColors: function(row, series, type) {
    var colors = ['#c0392b', '#d35400', '#f39c12', '#eb4d4b', '#95afc0'];
    var color = colors[row.x % colors.length];
    return color;
  },
  hfillOpacity: 0.6,
  hideHover: 'auto',
  parseTime: false,
  labels: ['<b>Percent Rating</b>'],
  xLabelAngle: 90,
  resize: false,labelOffset: 10,
  labelDirection: 'horizontal'

});

  </script>