<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$userid = $_REQUEST['param'];

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
                     if(get_exist2("select * from t_student_mock where sy_id = '".$_POST['param']."'",$db)==0){
                    ?>
                    <div class="alert alert-warning">
                        <b>No record has been found</b>
                    </div>
                    <?php
                    }else
                    {
                    ?>
                    <table class="table tale-bordered table-striped">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>ID NO</th>
                            <th>Student</th>
                            <?php
                            $a=1;
                              $nsql = "select * from m_subject_category where ID IN (1,2,3)";
                              $ndata = $db->query($nsql)->fetchAll();
                              foreach($ndata as $nrow){
                            ?>
                            <th><?php echo $nrow['category_name'] ?></th>
                            <?php
                              }
                            ?>
                            <th>Final Rating</th>
                            <th>Remarks</th>
                          </tr>
                      </thead>
                    <?php
                      $sql = "select a.*, concat(b.ln, ', ', b.fn, ' ', b.fn) as ename,b.student_id as idno from t_student_mock a inner join m_student_information b on a.student_id = b.id where a.sy_id = '".$_POST['param']."' order by ename";
                      $data = $db->query($sql)->fetchAll();
                      foreach($data as $row){
                    ?>
                       <tr>
                            <th><?php echo $a ?></th>
                             <th><?php echo $row['idno'] ?></th>
                            <th><?php echo $row['ename'] ?></th>
                            <?php
                              $nsql = "select * from m_subject_category where ID IN (1,2,3)";
                              $ndata = $db->query($nsql)->fetchAll();
                              foreach($ndata as $nrow){
                            ?>
                            <th><?php echo get_column2("totals","select concat(total_score, '=>', percentage) as totals from t_mock_subject_group_grade where student_id = '".$row['student_id']."' and exam_id = '".$row['exam_id']."' and subject_group_id = '".$nrow['id']."'",$db) ?></th>
                            <?php
                              }
                            ?>
                            <th><?php echo $row['total_score'] . " => " . $row['total_percentage'] ?></th>
                            <th><?php echo $row['remarks']  ?></th>
                          </tr>
                    <?php
                    $a++;
                      }
                    ?>
                  </table>
                    <?php
                    }
                    ?>
                  </div>
                  </div>
                  <div class="tab-pane fade show" id="pdfreport" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row" id="iframedisplay"> 
                    <div class="ratio ratio-21x9 rounded overflow-hidden">
                     <iframe class="embed-responsive-item" id="empid" src="assets/pdf_report/sy_result?sy_id=<?php echo $_POST['param'] ?>" frameborder="0" allowfullscreen></iframe>
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