<?php

require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$arrEQ = [];
$high = [];
$low = [];
$average = [];

$syid = $_POST['param'];
$edata = $db->query("select * from v_sample where sy_id = '$syid' group by title")->fetchAll();
foreach($edata as $row){
    $arrEQ[] = $row['title'];
     $high[] = get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='high'",$db) > 0 ? get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='high'",$db) : 0;
    $low[] = get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='low'",$db) > 0 ? get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='low'",$db) : 0;
    $average[] = get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='average'",$db) > 0 ? get_column2("counter","select * from v_sample where title='".$row['title']."' and ename='average'",$db) : 0 ;
}

   


?>
 <div id="eqresults"></div>

   <script>

var options = {
         series: [{
            name:'High',
          data: <?php echo json_encode($high) ?>
        },
        {
            name:'Average',
          data: <?php echo json_encode($average) ?>
        }, {
        name:'Low',
          data: <?php echo json_encode($low) ?>
        }],
          chart: {
          type: 'bar',
          height: 430
        },
        plotOptions: {
          bar: {
            horizontal: false,
            dataLabels: {
              position: 'top',
            },
          }
        },
        dataLabels: {
          enabled: true,
          offsetX: -6,
          style: {
            fontSize: '12px',
            colors: ['#fff']
          }
        },
        stroke: {
          show: true,
          width: 1,
          colors: ['#fff']
        },
        tooltip: {
          shared: true,
          intersect: false
        },
        xaxis: {
          categories: <?php echo json_encode($arrEQ) ?>,
        },
        };

    var chart = new ApexCharts(document.querySelector('#eqresults'), options);
    chart.render();

   </script>

