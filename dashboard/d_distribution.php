  <div class="row" id="display_questions">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Subject Group</th>
                                                <th rowspan="2">Total Items</th>
                                                <th colspan="3" class="text-center">Difficulty Index</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-yellow-100">Difficult</th>
                                                <th class="bg-blue-100">Average</th>
                                                <th class="bg-green-100">Easy</th>
                                               
                                            </tr>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                  $sql = "select * from m_subject_category where id IN (1,2,3)";
                                                  $data  = $db->query($sql)->fetchAll();
                                                  foreach($data as $row){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['category_name'] ?></td>
                                                    <td ><input type="number" value="<?php echo get_column2("total_items","select * from t_items_per_subject_group where category_id = '".$row['id']."'",$db) ?>" class="form-control" id="item<?php echo $row['id'] ?>" onkeyup="set_subject_group_items('<?php echo $row['id'] ?>','controllers/save_items','item','d_timer','timer_view')"  ></td>
                                                    
                                                    <td class="bg-yellow-100">
                                                      <input type="number" id="index<?php echo $row['id'] ?>" onkeyup="set_difficulty_index('<?php echo $row['id'] ?>','controllers/save_difficulty_index','index','d_timer','timer_view','Difficult','<?php echo $row['category_name'] ?>')"  class="form-control" id="timer<?php echo $row['id'] ?>" value="<?php echo get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Difficult'",$db) ?>" >
                                                    </td>
                                                 
                                                     <td class="bg-blue-100">
                                                      <input type="number" id="ave<?php echo $row['id'] ?>" onkeyup="set_difficulty_index('<?php echo $row['id'] ?>','controllers/save_difficulty_index','ave','d_timer','timer_view','Average','<?php echo $row['category_name'] ?>')"  class="form-control" id="timer<?php echo $row['id'] ?>" value="<?php echo get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Average'",$db) ?>" >
                                                    </td>
                                                    <td>
                                                      <input type="number" id="easy<?php echo $row['id'] ?>" onkeyup="set_difficulty_index('<?php echo $row['id'] ?>','controllers/save_difficulty_index','easy','d_timer','timer_view','Easy','<?php echo $row['category_name'] ?>')"  class="form-control" id="timer<?php echo $row['id'] ?>" value="<?php echo get_column2("percentage","select * from t_queston_dindex_distribution where category_id = '".$row['id']."' and difficulty_index = 'Easy'",$db) ?>" >

                                                    </td>
                                                    
                                                </tr>
                                                <?php
                                                $i++;
                                                      }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="card">
                                            <div class="card-footer">
                                                <button class="btn btn-secondary">Process Examination Questions</button>
                                            </div>

                                        </div>
                                  </div>