<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sy_id = $_POST['param'];
?>
<input type="hidden" class="form-control" value="SY <?php echo get_column2("sy","select * from m_sy where sy_id = '$sy_id'",$db) ?>" id="txttitle">
 <div class="row">
  <div class="row">
   
  <div class="col-3">
    
      <button class="btn btn-primary btn-sm" onclick="reprocess('<?php echo $sy_id ?>')">
          <i class="ti ti-key"></i> Reprocess
      </button>
      <button class="btn btn-success btn-sm" id="exportToExcel"><i class="ti ti-download"></i> Export to Excel</button>  
  
  </div>
  </div>
  <div class="row">
   <div class="col-md-12">
     <table class="table table-bordered" id="tableattend">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Student Information</th>
                              <th>School Year</th>
                              <th>Institutional Mock Exam Percentage</th>
                              <th>SInstitutional Mock Exam Results</th> 
                              <th>Learning Styles</th>
                              <th>EQ Controlled</th>
                              <th>EQ Trustful</th>
                              <th>Comments</th>
                              <th>Final Remarks</th>
                          </tr>
                      </thead>
                        <?php
                          $no=1;
                          $sql  = "select a.*, concat(b.fn, ' ', b.mn, ' ', b.ln) as ename from t_prediction_records a inner join m_student_information b on a.student_id = b.id where a.sy_id = '".$sy_id."'";

                          $data = $db->query($sql)->fetchAll();
                          foreach($data as $row){
                        ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['ename']; ?></td>
                          <td class="text-center"><?php echo get_column2("sy","select * from m_sy where sy_id = '$sy_id'",$db) ?></td>
                          <td class="text-center"><?php echo $row['mock_board_results']; ?></td>
                          <td class="text-center"><?php echo $row['subject_group_average']; ?></td>
                          <td class="text-center">
                            <?php
                          $counter = 0;
                          $arr_learning_styles = [1,2,3];
                            $ename =json_decode($row['Learning_styles']);
                                 $learning_style="";
                            foreach($ename as $learnstyle){
                         
                            if($learnstyle==1){
                              $learning_style = $learning_style . "<p>" . get_column2("learning_style","select * from m_learning_style where id = '".$arr_learning_styles[$counter]."'",$db) . "</p>";
                            }
                            $counter++;
                            }

                            echo $learning_style;
                          ?>
                           </td>
                          <td class="text-center"><?php echo $row['eq_controlled']; ?></td>
                          <td class="text-center"><?php echo $row['eq_trustful']; ?></td>
                          <td>
                          <?php
                          $ecomments =json_decode($row['comments']);
                          foreach($ecomments as $erow){
                            echo "<p>".$erow."</p>";
                          }
                          ?>
                          </td>
                          <td class="text-center"><?php echo $row['final_remarks']; ?></td>
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

function reprocess(sy_id){
  Swal.fire({
  title: 'Reprocess Prediction Records?',
  text: "Are you sure you want to reprocess the prediction record?",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, reprocess it'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/delete_records',
        cache: false,
        data: 'action=reprocess'+ "&id=" + sy_id,
        success:function(data){
             Swal.fire(
            'Record has been cleared!',
            'Transaction Completed',
            'success'
          );
      listrecord('listviews/load_previous_predictions','display_list',$('#txtsyfilter').val())
          
        }
    })
    
 
  }
})
}
</script>