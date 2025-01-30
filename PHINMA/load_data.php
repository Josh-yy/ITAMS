<?php
@session_start();
require("assets/settings/db_conn.php");
require("assets/settings/functions.php");


if(!empty($_POST["id"])){

    
    // Count all records except already displayed
    //$query = $db->query()->fetchAll();
    $row = get_column2("num_rows","SELECT COUNT(*) as num_rows FROM t_activity_logs WHERE id < ".$_POST['id']." ORDER BY id DESC",$db);
    $totalRowCount =  $row ;
    
    $showLimit = 5;
    
   
   
  
 if($totalRowCount > $showLimit){ 
 

     $data = $db->query("SELECT * FROM t_activity_logs WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT $showLimit")->fetchAll();
     foreach($data as $row){
           $postID = $row['id'];
                                $imgsrc = "";
                                if(get_column2("avatar","select * from m_users where id = '".$row['performed_by']."'",$db)==""){
                                    $imgsrc = 'assets/employee/nopic.png';
                                }else{
                                     $imgsrc = 'assets/employee/' .   get_column2("qr_code","select * from m_users where id = '".$row['performed_by']."'",$db) . '/' . get_column2("avatar","select * from m_users where id = '".$row['performed_by']."'",$db);
                                }
 ?>
        <tr>
            
        <td>
                        <div class="media align-items-center">
                        <div class="flex-shrink-0 wid-40"><img class="img-radius img-fluid wid-40" src="<?php echo  $imgsrc ?>" alt="User image"></div> 
                        <div class="media-body ms-3">
                        <h5 class="mb-1"><?php echo $row['date_performed']; ?> </b></h5> 
                        <p class="text-muted f-12 mb-0"><a href="#" class="__cf_email__" data-cfemail="b0c7d9d5d7d1ded4f0d8dfc4ddd1d9dc9ed3dfdd"><?php echo $row['activity_log']; ?></a></p>
                        </div>
                        </div>
                        </td>
        </tr>
 <?php
     }
 ?>
        <tr class="show_more_main" id="show_more_main<?php echo $postID; ?>">
          <td>
                            <span id="<?php echo $postID; ?>" class="btn btn-outline-primary show_more" title="Load more activity logs"><i class="ti ti-list"></i> Show more</span>
                            <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span></td>
                        </tr>
        
    <?php } ?>
<?php
    }

?>