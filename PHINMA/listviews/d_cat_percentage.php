<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sql = "select * from t_examination_percentage a inner join m_subject_category b on a.category_id = b.id";

?>


  <table style="width:100%">
              <thead>
                <tr>
                 
               
                  <th>Subject Group</th>
                  <th class="text-center">Percentage</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=1;
              $total=0;
                $row = $db->query($sql)->fetchAll();
                foreach ($row as $key) {
                  
                 
              ?>
                <tr>
                
                <td><?php echo $key['category_name'] ?></td>
                <td class="text-center"><?php echo $key['examination_percentage'] ?></td>
                </tr>
              <?php
              $i++;
              $total+=$key['examination_percentage'];
                }
              ?>
               <tr class="bg-blue-100">
                
                <td class="text-center"><b>TOTAL</b></td>
                <td class="text-center"><?php echo $total ?></td>
                </tr>
              </tbody>    
            </table>

            <script type="text/javascript">
               $('#checkall').change(function() {
                // this represents the checkbox that was checked
                // do something with it
                var checked = $(this).is(':checked'); // Checkbox state
                 // Select all
                 if(checked){
                  $(this).closest('table').find('tbody :checkbox')
                    .prop('checked', this.checked)
                    .closest('tr').toggleClass('selected', this.checked);
                 }else{
                   // Deselect All
                    $(this).closest('table').find('tbody :checkbox')
                    .prop('checked', this.checked)
                    .closest('tr').toggleClass('selected', false);
                 }
            });
            </script>