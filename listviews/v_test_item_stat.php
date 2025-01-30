<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

?>



<div class="row">
    <div class="col-md-12 col-xl-3">
        <div class="card social-widget-card bg-secondary">
            <div class="card-body">
                <h5 class="text-white"> Question</h5>
                    <h3 class="text-white"><?php echo get_exist2("select * from t_questions",$db) ?></h3>
                    <p class="m-b-0">Total number of questions in the item bank</p>
                    <i class="material-icons-two-tone d-block f-46 card-icon text-white">receipt</i>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-3">
        <div class="card social-widget-card bg-danger">
            <div class="card-body">
                <h5 class="text-white">Difficult</h5>
                    <h3 class="text-white"><?php echo get_exist2("select * from t_questions where difficulty_index = 'Difficult'",$db) ?></h3>
                    <p class="m-b-0">Questions with high difficulty index</p>
                    <i class="material-icons-two-tone d-block f-46 card-icon text-white">receipt</i>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-xl-3">
        <div class="card social-widget-card bg-warning">    
            <div class="card-body">
                <h5 class="text-white">Average</h5>
                    <h3 class="text-white"><?php echo get_exist2("select * from t_questions where difficulty_index = 'Average'",$db) ?></h3>
                    <p class="m-b-0">Questions with average difficulty index</p>
                    <i class="material-icons-two-tone d-block f-46 card-icon text-white">receipt</i>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-xl-3">
        <div class="card social-widget-card bg-success">
            <div class="card-body">
                <h5 class="text-white">Easy</h5>
                    <h3 class="text-white"><?php echo get_exist2("select * from t_questions where difficulty_index = 'Easy'",$db) ?></h3>
                   <p class="m-b-0">Questions with low difficulty index</p>
                    <i class="material-icons-two-tone d-block f-46 card-icon text-white">receipt</i>
            </div>
        </div>
    </div>


</div>

                        <div class="row">
                               <div class="col-sm-12 col-md-5 col-xl-5">
                                <div class="card">
                                <div class="card-header bg-gray-100"><b><i class="ti ti-chart"></i> Subject Group Distribution</b></div>
                                <div class="card-body">
                                       <div class="scroll-area-lg">
                                    <div id="mychart" style="height:330px; padding:10px;"></div>
                                 </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-7 col-md-7 col-xl-7">
                                <div class="card">
                                <div class="card-header bg-purple-100"><b>Yearly Questions Graph</b></div>
                                <div class="card-body">
                                       <div class="scroll-area-lg">
                                     <div id="questions" style="height:330px; padding:10px; width: 100%;"></div> 
                                 </div>
                                </div>
                            </div>
                            </div>

                             <div class="col-sm-12 col-md-12 col-xl-12">
                                <div class="card profile-back-card">
                                <div class="card-header bg-light-warning">
                                 <h4 class="mb-1">Distribution of Questions per year <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                       <div class="scroll-area-lg">
                                     <div id="prog_attendance" style="height:330px; padding:10px; width: 100%;"></div> 
                                 </div>
                                </div>
                                </div>
                            </div>
                        </div> 

</script>
<?php
$jprogram=array(); 

$program_attendance_sql = "select * from v_exam_cat_per_year group by year";
$program_data = $db->query($program_attendance_sql)->fetchAll();
$ykeys= array();
$labels=array();
$i=0;
$a=0;
$uicolors= array();
$colors = ['#f0932b','#6ab04c','#2ecc71','#130f40'];
foreach($program_data as $row)
{
   $json_array_program['y'] = $row['year'];
   
   $psql = "select * from m_subject_category";
   $pdata = $db->query($psql)->fetchAll();


   foreach($pdata as $prow)
   {
    
    if(get_exist2("select * from t_questions where category = '".$row['category']."' AND date_format(date_added,'%Y') = '".$row['year']."'",$db)==0)
    {
      $json_array_program[$prow['id']] =  0; 
    }
    else
    {
      $json_array_program[$prow['id']] =  get_exist2("select * from t_questions where category = '".$prow['id']."' AND date_format(date_added,'%Y') = '".$row['year']."'",$db); 
    }
   }
   array_push($jprogram,$json_array_program);
}
  $psql = "select * from m_subject_category";
   $pdata = $db->query($psql)->fetchAll();
   foreach($pdata as $prow)
   {
    $uicolors[] = $colors[$a];
     if($a<=3)
     {
      $a=0;
     }
     $a++;
    $ykeys[] = $prow['id'];
    $labels[] = $prow['category_name'];
   }



?>
<script>
Morris.Bar({
      element: 'prog_attendance',
      resize: true,
      data: <?php echo json_encode($jprogram,JSON_UNESCAPED_UNICODE)?>,
      barColors: <?php echo json_encode($uicolors,JSON_UNESCAPED_UNICODE)?>,
      xkey: 'y',
      ykeys: <?php echo json_encode($ykeys,JSON_UNESCAPED_UNICODE)?>,
      labels: <?php echo json_encode($labels,JSON_UNESCAPED_UNICODE)?>,
      hideHover: 'auto'
    });
</script>
<?php
$json_array=array();  

$array = [];
$json_array_dailys=array();  
$array_modules = [];
$json_array_retrieve=array();  
$array_retrieve = [];




$data = $db->query("select date_format(date_added,'%Y') as year, count(*) as counter from t_questions group by date_format(date_added,'%Y')")->fetchAll();
foreach($data as $row){
       $array_modules['label']=$row['year']; 
      $array_modules['value']= $row['counter'];
      array_push($json_array,$array_modules);
}
?>
<script>
Morris.Area({
      element: 'questions',
      // json_encode returns JSON representation of a value
      data: <?php echo json_encode($json_array,JSON_UNESCAPED_UNICODE)?>,
      xkey: ['label'],
      ykeys: ['value'],
      pointFillColors:['#22a6b3'],
      pointStrokeColors: ['#f0932b','#130f40','#22a6b3','#eb4d4b','#95afc0'],
      lineColors: ['#c7ecee', '#079992'],
      hfillOpacity: 0.6,
      hideHover: 'auto',
      parseTime:false,
      labels: ['<b>No. of Questions</b>'],
      xLabelAngle: 90,
      resize: true
      });


  </script>
<script src="includes/graphs.js"></script>