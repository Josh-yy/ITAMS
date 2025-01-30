<?php 
require('includes/header.php');
if (!isset($_SESSION['data']['account_id'])){
 
    @header("location:login");
  
}
?>
  <body >
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Header Topbar ] start -->
<?php include('top_head.php') ?>
<!-- [ Header ] end -->
 <!-- [ Sidebar Menu ] start -->
<?php
include('side_nav.php');
?>
<!-- [ Sidebar Menu ] end -->


 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="row">
          <div class="col-xl-4 col-md-6">
          <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden">
              <span class="round small"></span>
              <span class="round big"></span>
          <div class="card-body">
          <div class="row">
              <div class="col">
                  <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                  </div>
              </div>
          <div class="col-auto">
            <div class="btn-group">
            <a href="#" class="avtar bg-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a href="software_asset" class="dropdown-item"><i class="ti ti-list"></i> List record</a></li>
                  <li><a href="assets/pdf_report/hardware_assets" class="dropdown-item" target="_new"><i class="ti ti-printer"></i> Print Report</a></li>
            </ul>
            </div>
          </div>
          </div>
               <span class="text-white d-block f-34 f-w-500 my-2"><?php echo get_exist2("select * from m_hardware_assets",$db) ?></span>
              <p class="mb-0 opacity-50">Hardware Assets</p>
          </div>
          </div>
          </div>
          <div class="col-xl-4 col-md-6">
          <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
              <span class="round small"></span>
              <span class="round big"></span>
          <div class="card-body">
          <div class="row">
              <div class="col">
                  <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                  </div>
              </div>
          <div class="col-auto">
            <div class="btn-group">
            <a href="#" class="avtar bg-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a href="asset_info" class="dropdown-item"><i class="ti ti-list"></i> List record</a></li>
                <li><a href="assets/pdf_report/software_asset" class="dropdown-item" target="_new"><i class="ti ti-printer"></i> Print Report</a></li>
            </ul>
            </div>
          </div>
          </div>
               <span class="text-white d-block f-34 f-w-500 my-2"><?php echo get_exist2("select * from  m_users where is_active = 1",$db) ?></span>
              <p class="mb-0 opacity-50">Software Assets</p>
          </div>
          </div>
          </div>


          <div class="col-xl-4 col-md-6">
            <div class="card bg-warning dashnum-card text-white overflow-hidden">
              <span class="round small"></span>
              <span class="round big"></span>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="avtar avtar-lg">
                      <i class="text-white ti ti-users"></i>
                    </div>
                  </div>
                
                </div>
                <div class="tab-content" id="chart-tab-tabContent">
               
                  <div class="tab-pane active" id="chart-tab-profile" role="tabpanel" aria-labelledby="chart-tab-profile-tab" tabindex="0">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-white d-block f-34 f-w-500 my-2"><?php echo get_exist2("select * from  m_users where is_active = 1",$db) ?></span>
                        <p class="mb-0 opacity-50">System Users</p>
                      </div>
                      <div class="col-6">
                        <div id="tab-chart-2"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <ul class="nav nav-tabs profile-tabs border-bottom mb-3 d-print-none" id="myTab" role="tablist">
        <li class="nav-item">
          
        <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
        <div class="media align-items-center">
        <div class="avtar avtar-s">
        <i class="material-icons-two-tone me-2">description</i>
        </div>
        <div class="media-body ms-3">
         <b>Main Dashboard</b>
        <p class="text-sm mb-0">Dashboard for Assets</p>
        </div>
        </div>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab" aria-selected="true">
        <div class="media align-items-center">
        <div class="avtar avtar-s">
        <i class="material-icons-two-tone me-2">account_circle</i>
        </div>
        <div class="media-body ms-3">
         <b>Users Demographics</b>
        <p class="text-sm mb-0">Demographic Profile of Users</p>
        </div>
        </div>
        </a>
        </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        
          <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header with-border">
                      <b><i class="ti ti-chart-donut"></i> Categorical Distribution of Assets</b>
                    </div>
                    <div class="card-body">
                      <div id="categorydash"></div>
                    </div>
                </div>
            </div>
             <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header with-border">
                      <b><i class="ti ti-chart-donut"></i>Hardware and Software Distribution</b>
                    </div>
                    <div class="card-body">
                      <div id="hardwaresoftware"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header with-border">
                      <b><i class="ti ti-chart-donut"></i>Functional and Non-Fuctional Assets</b>
                    </div>
                    <div class="card-body">
                      <div id="assetstatus"></div>
                    </div>
                </div>
            </div>
             <div class="col-md-7 col-sm-12">
                 <div class="card">
                      <div class="card-body">
                        <div class="row mb-3 align-items-center">
                          <div class="col">
                            <h3><i class="ti ti-folders"></i>Branches Hardware Assets</h3>
                          </div>
                          <div class="col-auto" style="display:none">
                           
                          </div>
                        </div>
                        <div id="growthchart"></div>
                      </div>
                    </div>
           </div>
              <div class="col-md-5 col-sm-12">
                 <div class="card">
                      <div class="card-body">
                        <div class="row mb-3 align-items-center">
                          <div class="col">
                            <h3><i class="ti ti-folders"></i>Yearly Graph of Hardware Assets</h3>
                          </div>
                          <div class="col-auto" style="display:none">
                           asd
                          </div>
                        </div>
                        <div id="yearlychart"></div>
                      </div>
                    </div>
           </div>
        </div>
        </div>
        <div class="tab-pane fade show" id="history" role="tabpanel" aria-labelledby="history-tab">
            <div class="row">
            <div class="col-6">
               <div class="row">
                 <div class="card">
                    <div class="card-header with-border">
                      <b><i class="ti ti-chart-donut"></i> Users Gender Distribution</b>
                    </div>
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div id="genderdash" style="height:300px"></div>
                          </div>
                      </div>
                    </div>
                </div>
               </div>
            </div>
             <div class="col-6">
                <div class="card">
                    <div class="card-header with-border">
                      <b><i class="ti ti-chart-donut"></i>Civil Status Distribution</b>
                    </div>
                    <div class="card-body">
                      <div id="civilstatus" style="height:300px"></div>
                    </div>
                </div>
            </div>
             <div class="col-12">
                 <div class="card">
                      <div class="card-body">
                        <div class="row mb-3 align-items-center">
                          <div class="col">
                            <h3><i class="ti ti-users"></i>No. of Users per Branch</h3>
                          </div>
                          
                        </div>
                        <div id="branch_users" ></div>
                      </div>
                    </div>
           </div>
        </div>
        </div>

      </div>

        
          </div>

      </div>
 
<?php
include('includes/footer.php');
include('includes/mdl_usertype.php');
require("includes/js_footer.php");

$genderarr = [];
$genderarrlabel = [];
//plot the gender dashboard
$gsql = "select b.name, count(*) as counter from v_hardware_software a inner join m_asset_category b on a.asset_cat_id = b.id  group by a.asset_cat_id;";
$gdata = $db->query($gsql)->fetchAll();
foreach($gdata as $grow){
    $genderarrlabel[] =  $grow['name'] ;
    $genderarr[]=$grow['counter'];
}

//hardware and software
$asset_counter = [];
$asset_label = [];
//plot the gender dashboard
$asql = "select upper(software) as name, count(*) as counter from v_hardware_software a group  by software ";
$adata = $db->query($asql)->fetchAll();
foreach($adata as $grow){
    $asset_label[] =  $grow['name'] ;
    $asset_counter[]=$grow['counter'];
}

$yearhardware = [];
$ysoftware = [];
$yearlabel = [];
//plot the gender dashboard
$gsql = "select * from v_year_purchased_hardware_assets ";
$gdata = $db->query($gsql)->fetchAll();
foreach($gdata as $grow){
    $yearlabel[] =  $grow['eyear'] ;
    $yearhardware[]=get_column2("counter","select sum(counter) as counter from v_year_purchased_hardware_assets where eyear = '".$grow['eyear']."'  and type=1",$db);
    $ysoftware[]=get_column2("counter","select sum(counter) as counter from v_year_purchased_hardware_assets where   eyear = '".$grow['eyear']."' and type=2",$db);
}



  ///gather branches
$sql = "select * from m_branches";
$data = $db->query($sql)->fetchAll();
$array = [];
$arrcategory = [];
$arrpassed = [];
  class User{
    public $name;
    public $data;
  }
foreach($data as $row){
    $arrcategory[] = $row['name'];
    $arrpassed[] = get_exist2("select * from t_asset_tagging where branch_id = '".$row['id']."' and status=1",$db);
   
}
//get gender
$ugender = [];
$genderlabel = [];
//plot the gender dashboard
$usql = "select count(*) as counter, gender from m_users group by gender";
$udata = $db->query($usql)->fetchAll();
foreach($udata as $grow){
    $ugender[] =  $grow['counter'] ;
    $genderlabel[]=$grow['gender'];
}


//civil status
$ucivilstat = [];
$ucivilcounter = [];
//plot the gender dashboard
$usql = "select count(*) as counter, civil_status from m_users group by civil_status";
$udata = $db->query($usql)->fetchAll();
foreach($udata as $grow){
    $ucivilcounter[] =  $grow['counter'] ;
    $ucivilstat[]=$grow['civil_status'];
}


//Asset status
$fhardwarestat = [];
$f_hardwarecounter = [];
//plot the gender dashboard
$fsql = "select status, count(*) as counter from m_hardware_assets group by status;";
$fdata = $db->query($fsql)->fetchAll();
foreach($fdata as $frow){
    $f_hardwarecounter[] =  $frow['counter'] ;
    $fhardwarestat[]=$frow['status'];
}
//get branch users
//select a.id,b.branch_id from m_users a inner join t_user_assignment b on a.id = b.user_id;
$bsql = "select * from m_branches";
$bdata = $db->query($bsql)->fetchAll();
$branch = [];
$branchcounter = [];
foreach($bdata as $row){
    $branch[] = $row['name'];
    $branchcounter[] = get_exist2("select * from m_users a inner join t_user_assignment b on a.id = b.user_id where branch_id = '".$row['id']."'",$db);
}
  ?>
 <script src="../assets/js/plugins/apexcharts.min.js"></script>
   <script>
'use strict';
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);
});

function floatchart() {


(function () {
     var options = {
          series: [{
            name:'Hardware Assets',
          data: <?php echo json_encode($yearhardware) ?>
        }, {
        name:'Software Assets',
          data: <?php echo json_encode($ysoftware) ?>
        }],
          chart: {
          type: 'bar',
          height: 320
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
          categories: <?php echo json_encode($yearlabel) ?>,
        },
        };

    var chart = new ApexCharts(document.querySelector('#yearlychart'), options);
    chart.render();
  })();

   (function () {
    var options = {
        series: <?php echo json_encode($f_hardwarecounter,true) ?>,
        chart: {
            height: 250,
            type: 'pie',
        },
        labels: <?php echo json_encode($fhardwarestat,true) ?>,
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#assetstatus"), options);
    chart.render();
})();
  
  (function () {
    var options = {
        series: <?php echo json_encode($asset_counter,true) ?>,
        chart: {
            height: 250,
            type: 'pie',
        },
        labels: <?php echo json_encode($asset_label,true) ?>,
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#hardwaresoftware"), options);
    chart.render();
})();

  (function () {
    var options = {
        series: <?php echo json_encode($ucivilcounter,true) ?>,
        chart: {
            height: 250,
            type: 'pie',
        },
        labels: <?php echo json_encode($ucivilstat,true) ?>,
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#civilstatus"), options);
    chart.render();
})();

   (function () {
      var options = {
          series: <?php echo json_encode($ugender,true) ?> ,
          chart: {
            height:250,
          type: 'donut',
        },
        labels: <?php echo json_encode($genderlabel,true) ?>,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#genderdash"), options);
        chart.render();
  })();

  (function () {
      var options = {
          series: <?php echo json_encode($genderarr,true) ?> ,
          chart: {

          type: 'donut',
          height:250,
        },
        labels: <?php echo json_encode($genderarrlabel,true) ?>,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#categorydash"), options);
        chart.render();
  })();

 (function () {
    var options = {
        series: [{
            name: 'No. Hardware Assets',
            data: <?php echo json_encode($arrpassed) ?>
        }],
        chart: {
            type: 'line', // Change the chart type to 'line'
            height: 320
        },
        dataLabels: {
            enabled: false, // Disable data labels for line charts
        },
        stroke: {
            curve: 'smooth', // Use a smooth curve for the line
        },
        markers: {
            size: 6, // Customize marker size
        },
        tooltip: {
            shared: true,
        },
        xaxis: {
            categories: <?php echo json_encode($arrcategory) ?>
        }
    };

    var chart = new ApexCharts(document.querySelector('#growthchart'), options);
    chart.render();
})();


  //banch users for demographic profile
  (function () {
     var options = {
          series: [{
            name:'No. of Users',
          data: <?php echo json_encode($branchcounter) ?>
        }],
          chart: {
          type: 'line',
          height: 310
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
          categories: <?php echo json_encode($branch) ?>,
        },
        };

    var chart = new ApexCharts(document.querySelector('#branch_users'), options);
    chart.render();
  })();
  }

</script>

<script>

 
  </script>
</body>
  <!-- [Body] end -->
</html>
