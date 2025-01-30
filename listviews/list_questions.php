<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
  if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
  } else {  
      $page = $_REQUEST['param'];  
  }  
  $i=1;
  $results_per_page = 10;
  $page_first_result = ($page-1) * $results_per_page;  
  $sql = "select * from t_questions ";
  $number_of_result = get_exist2($sql,$db);
  $number_of_page = ceil ($number_of_result / $results_per_page); 
  $final_sql = "";
    if(isset($_REQUEST['search'])){
      if($_REQUEST['search']!==""){
        $final_sql = "select * from t_questions WHERE question LIKE '%".$_REQUEST['search']."%' OR a LIKE '%".$_REQUEST['search']."%' OR b LIKE '%".$_REQUEST['search']."%' OR c LIKE '%".$_REQUEST['search']."%' OR b LIKE '%".$_REQUEST['search']."%'";
    }
    else{
        $final_sql = "select * from t_questions LIMIT " . $page_first_result . ',' . $results_per_page; 
      }
    }else{
        $final_sql = "sselect * from t_questions LIMIT " . $page_first_result . ',' . $results_per_page; 
      }
        
  $data = $db->query($final_sql)->fetchAll();

?>
   
<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <td colspan="10">
              
                <?php
                  if($page>1){ 
                  ?>
                  <button class="btn btn-secondary" onclick="listrecord('listviews/list_questions','display_questions','<?php echo ($page-1) ?>' + '&search=' )"><i class="ti ti-arrow-left"></i> Prev</button>
                  <?php
                  }
                ?>
                <button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
                  <?php
                  if($number_of_page>$page){
                  ?>
                  <button class="btn btn-secondary" onclick="listrecord('listviews/list_questions','display_questions','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
                  <?php
                  }
                ?>
                
                <a class="btn btn-default float-end" ><i class="ti ti-printer"></i> Print</a>
                <a class="btn btn-default float-end" href="../views/export_questions" target="_new" ><i class="ti ti-download"></i> Export Excel</a>
           
                

            </td>
        </tr>
        <tr>
          <th>No</th>
          <th style="width:10%">Image</th>
          <th  style="width:35%">Question</th>
          <th>Choice A</th>
          <th>Choice B</th>
          <th>Choice C</th>
          <th>Choice D</th>
          <th>Answer</th>
          <th style="width:5%">Difficulty Index</th>
          <th>Task</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $row) {
          $img = ($row['attachment']!==null) ? '../questions/' . $row['attachment']  : '../assets/images/noimage.jpg';
          $class="";
      ?>
        <tr>
        <td><?php echo $i ?></td>
        <td><img src="<?php echo $img ?>"  alt="user image" class="img-radius wid-40 align-top m-r-15"></td>
        <td><?php echo $row['question'] ?></td>
        <td><?php echo $row['a'] ?></td>
        <td><?php echo $row['b'] ?></td>
        <td><?php echo $row['c'] ?></td>
        <td><?php echo $row['d'] ?></td>
        <td><?php echo $row['answer'] ?></td>
        <td>
          <?php
            if($row['difficulty_index']=="Difficult"){
              $class = 'badge bg-light-danger';
            }else if($row['difficulty_index']=="Average"){
              $class = 'badge bg-light-warning';
            }
            else if($row['difficulty_index']=="Easy"){
              $class = 'badge bg-light-success ';
            }
          ?>
          <span class="<?php echo $class ?> rounded-pill f-14"><?php echo $row['difficulty_index'] ?></span>
        </td>
        <td>
          <button class="btn btn-warning btn-sm" id="btn_edit_user" onclick='get_edit("<?php echo $row['id'] ?>","<?php echo $db->sanitize($row['question']) ?>","<?php echo $db->sanitize($row['a']) ?>","<?php echo $db->sanitize($row['b']) ?>","<?php echo $db->sanitize($row['c']) ?>","<?php echo $db->sanitize($row['d']) ?>","<?php echo $db->sanitize($row['answer']) ?>","<?php echo $db->sanitize($row['category']) ?>","<?php echo $db->sanitize($row['difficulty_index']) ?>","<?php echo $db->sanitize($img) ?>")' data-bs-toggle="modal" data-bs-target="#editquestion"><i class="ti ti-edit"></i></button>


          <button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['facility_name'] ?>','deletedelete_questions_facility','../listviews/list_questions','display_list','1')"><i class="ti ti-trash"></i></button>
        </td>
        </tr>
      <?php
      $i++;
        }

        ?>
      </tbody>    
    </table>
<script>

function get_edit(id,a,b,c,d,e,f,g,h,i)
{


  $('#eid').val(id);
  eeditor.setData(a);
  echoicea.setData(b);
  echoiceb.setData(c);
  echoicec.setData(d);
  echoiced.setData(e);
  $('#eanswer').val(f);
  $('#ecategory').val(g);
  $('#edifficulty_index').val(h);
  $('#avatars').attr("src",i);

}

function get_delete_id(id)
{
  $('#did').val(id);
}

</script>

