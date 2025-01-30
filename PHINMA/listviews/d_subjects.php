<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$userid = $_REQUEST['param'];
function get_included($subject_id,$curr_id,$db)
{
  $sql = "select * from t_curr_subjects where subject_id = '$subject_id' and curr_id ='$curr_id'";
   
  return $db->query($sql)->numROws();
}
?>


  <table class="table table-hover table-striped text-sm"  id="example">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkall" value="<?php echo $row[0] ?>">All</th>
                  <th>Code</th>
                  <th>Subject Name</th>
                  <th>Units</th>
                  <th>Subject Group</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=1;
                $row = $db->query("select * from m_subjects")->fetchAll();
                foreach ($row as $key) {
                  
                  if(get_included($key['id'],$userid,$db)==0)
                  {
              ?>
                <tr>
                 <td><input type="checkbox" name="lab_id[]" value="<?php echo $key['id'] ?>">
                
                 </td>
                <td><?php echo $key['subject_code'] ?></td>
                <td><?php echo $key['subject_name'] ?></td>
                <td><?php echo $key['units'] ?></td>
               
                 <td><?php echo get_column2("category_name","select * from m_subject_category where id = '".$key['subject_group']."'",$db) ?></td>
                </tr>
              <?php
              $i++;
                }
                }
              ?>
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