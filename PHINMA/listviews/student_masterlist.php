<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];
?>
<input type="hidden" class="form-control" value="Students Information Masterlist SY <?php echo get_column2("sy","select * from m_sy where sy_id = '$sy_id'",$db) ?>" id="txttitle">
 <div class="row">
  <div class="row">
    <div class="col-10">&nbsp;</div>
  <div class="col-2">
    <div class="d-grid">
      <button class="btn btn-success btn-sm" id="exportToExcel"><i class="ti ti-download"></i> Export to Excel</button>  
    </div>
  </div>
  </div>
  <div class="row">
   <div class="col-md-12">
     <table class="table table-bordered" id="tableattend">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Student ID</th>
                              <th>First Name</th>
                              <th>Middle Name</th>
                              <th>Last Name</th> 
                              <th>Gender</th>
                              <th>Birthdate</th>
                              <th>Address</th>
                          </tr>
                      </thead>
                        <?php
                          $no=1;
                          $sql  = "select * from m_student_information where sy_id = '".$sy_id."'";

                          $data = $db->query($sql)->fetchAll();
                          foreach($data as $row){
                        ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                        
                         
                           <td><?php echo $row['student_id']; ?></td>
                           <td><?php echo $row['fn']; ?></td>
                           <td><?php echo $row['mn']; ?></td>
                           <td><?php echo $row['ln']; ?></td>
                           <td><?php echo $row['gender']; ?></td>
                           <td><?php echo $row['birthdate']; ?></td>
                           <td><?php echo $row['address']; ?></td>

                        </tr>   
                        <?php
                        $no++;
                          }
                        ?>
                    </table>
   </div>
  </div>                
</div>  

<script src="../assets/js/table2excel.js" type="text/javascript"></script>
  <!-- Page level custom scripts -->
 
  <script type="text/javascript">

    $(function () {
        $("#exportToExcel").click(function () {
          fire_message("Notifier","Your file has been downloaded! Thank you!","info");
           draw_excel($('#txttitle').val());
      });
    });

    function draw_excel(a)
    {
           $("#tableattend").table2excel({

                filename: a + ".xls"

            });
    }
</script>