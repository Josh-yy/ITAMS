<?php
$usertypeid = get_column2("id","select * from m_usertype where typename='".$_SESSION['data']['usertype']."'",$db);
?>
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="#" class="b-brand">
        <!-- ========   Change your logo from here   ============ -->
        <img src="../assets/images/<?php echo get_column2("top_head_logo","select * from system_settings",$db) ?>" alt="" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <?php
        ?>
        <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 7 and ismenu=1",$db)){
        ?>
        <li class="pc-item">
          <a href="index" class="pc-link"><span class="pc-micon"><i class="ti ti-dashboard"></i></span><span
              class="pc-mtext">Dashboard </span></a>
        </li>
        <?php
          }
        ?>
        
        <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 9 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-caption">
          <label>Quick Links</label>
          <i class="ti ti-apps"></i>
        </li>
         
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 9 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><span class="pc-micon"><i
                class="ti ti-folder"></i> <?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          
      <?php
        }
      ?>
       
      
       <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 4 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-caption">
          <label>File Manager</label>
          <i class="ti ti-apps"></i>
        </li>
         
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 4 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><span class="pc-micon"><i
                class="ti ti-folder"></i> <?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          
      <?php
        }
      ?>
      <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 5 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-caption">
          <label>Transaction</label>
          <i class="ti ti-apps"></i>
        </li>
         
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 5 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><span class="pc-micon"><i
                class="ti ti-folder"></i> <?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          
      <?php
        }
      ?>
      <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 8 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-caption">
          <label>Views</label>
          <i class="ti ti-apps"></i>
        </li>
         
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 8 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><span class="pc-micon"><i
                class="ti ti-folder"></i> <?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          
      <?php
        }
      ?>

       
       <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 6 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-caption">
          <label>Reports</label>
          <i class="ti ti-apps"></i>
        </li>
         
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 6 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
         
             <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><span class="pc-micon"><i class="ti ti-vocabulary"></i> <?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          
      <?php
        }
      ?>
      
       <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 1 and ismenu=1",$db)){
        ?>
         <li class="pc-item pc-caption">
          <label>Setup and Configuration</label>
          <i class="ti ti-news"></i>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-key"></i></span><span
              class="pc-mtext">System Settings</span><span class="pc-arrow"><i class="ti ti-chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 1 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
      <?php
        }
      ?>
        
       
      <?php
          if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 2 and ismenu=1",$db)){
        ?>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-folder"></i></span><span
              class="pc-mtext"> Setup</span><span class="pc-arrow"><i class="ti ti-chevron-right"></i></span></a>
                <ul class="pc-submenu">
                   <?php
                if(get_exist2("select a.* from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 3 and ismenu=1",$db)){
              ?>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-folder"></i></span><span
                    class="pc-mtext"> Asset Config</span><span class="pc-arrow"><i class="ti ti-chevron-right"></i></span></a>
                <ul class="pc-submenu">
                  <?php
                    $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 3 and ismenu=1";
                    $data = $db->query($sql)->fetchAll();
                    foreach($data as $row){
                  ?>
                  <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><?php echo $row['facility_name'] ?></a></li>
                  <?php
                    }
                  ?>
                </ul>
              </li>
            <?php
              }
            ?>
            <?php
              $sql = "select * from t_user_roles a inner join m_facilities b on a.facility_id = b.id where a.usertype_id = '$usertypeid' and b.node = 2 and ismenu=1";
              $data = $db->query($sql)->fetchAll();
              foreach($data as $row){
            ?>
            <li class="pc-item"><a class="pc-link"  href="<?php echo $row['facility_link'] ?>"><?php echo $row['facility_name'] ?></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
      <?php
        }
      ?>
      </ul>
    
    </div>
  </div>
</nav>