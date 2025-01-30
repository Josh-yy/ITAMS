<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];
?>
<input type="hidden" class="form-control" value="Students EQ Records SY <?php echo get_column2("sy","select * from m_sy where sy_id = '$sy_id'",$db) ?>" id="txttitle">
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
                              <th>Student Information</th>
                              <th>EQ_Trustful</th>
                              <th>EQ_Dyscontrolled</th>
                              <th>EQ_Timid</th> 
                              <th>EQ_Depressed</th>
                              <th>EQ_Distrustful</th>
                              <th>EQ_Controlled</th>
                              <th>EQ_Aggresive</th>
                              <th>EQ_Gregarious</th>
                              <th>EQ_Bias</th>
                          </tr>
                      </thead>
                        <?php
                          $no=1;
                          $sql  = "select a.*, concat(b.fn, ' ', b.mn, ' ', b.ln) as ename from t_prediction_variables a inner join m_student_information b on a.student_id = b.id where a.sy_id = '".$sy_id."'";

                          $data = $db->query($sql)->fetchAll();
                          foreach($data as $row){
                        ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['ename']; ?></td>
                         
                           <td><?php echo $row['EQ_Trustful']; ?></td>
                           <td><?php echo $row['EQ_Dyscontrolled']; ?></td>
                           <td><?php echo $row['EQ_Timid']; ?></td>
                           <td><?php echo $row['EQ_Depressed']; ?></td>
                           <td><?php echo $row['EQ_Distrustful']; ?></td>
                           <td><?php echo $row['EQ_Controlled']; ?></td>
                           <td><?php echo $row['EQ_Aggresive']; ?></td>
                           <td><?php echo $row['EQ_Gregarious']; ?></td>
                           <td><?php echo $row['EQ_Bias']; ?></td>
                         
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