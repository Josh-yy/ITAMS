<div class="modal fade" id="editquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Update Question</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                 <form id="frmeditquestion">
                    <input type="hidden" value="addtype" name="action">
                    <input type="hidden" value="" name="id" id="eid">
                     <div class="card">
                         
                           
                          <div class="card-body row">
                              <div class = "col-4">
                                   <div class="form-group">
                                    <img src="../assets/images/noimage.jpg" style="width:100%; border:solid   2px" id="avatars"><br>
                                                
                                  <small><b>Upload Image (<small class="text-danger">Optional</small>) </b></small> 
                               <input type="file" accept="image/png, image/gif, image/jpeg" id="scanned_pics" onchange="previewFile('scanned_pics','avatars'); " class="form-control" name="image"  aria-label="Username">
                                   </div>
                              </div>
                              <div class="col-8">
                                
                            <div class="form-group">
                              <small><b>Enter your question below : </b></small>
                              <textarea name="question" id="eeditor" style="height:300px" placeholder="enter the question here"></textarea>
                            </div>
                            <div class="form-group">
                              
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Option A &nbsp; </span>
                                            </div>
                                            <textarea name="a" id="echoicea" placeholder="enter choice here" ></textarea>
                                      </div>
                                </div>
                                  <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Option C &nbsp; </span>
                                            </div>
                                            <textarea name="b" id="echoicec" placeholder="enter choice here" ></textarea>
                                      </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Option B &nbsp; </span>
                                            </div>
                                            <textarea name="c" id="echoiceb" placeholder="enter choice here" ></textarea>
                                      </div>
                                </div>
                                  <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Option D &nbsp; </span>
                                            </div>
                                            <textarea name="d" id="echoiced" placeholder="enter choice here" ></textarea>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    Choose Option Answer : 
                                   <select name="answer" class="form-control" id="eanswer" required>
                                    <option value="">Select Answer</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    Subject Group Caterogy :  
                                   <select name="category" id="ecategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php
                                      $sql = "select * from m_subject_category";
                                      $data = $db->query($sql)->fetchAll();
                                      foreach($data as $row){  
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['category_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                </div>
                                 <div class="col-12">
                                  <div class="form-group">
                                    Difficulty Index : 
                                   <select name="difficulty_index" id="edifficulty_index" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Average">Average</option>
                                    <option value="Difficult">Difficult</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        
                          
                              </div>
                          </div>
                          
                
                      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-secondary close" id="close" data-bs-dismiss="modal">Close</button>
                   <button class="btn btn-secondary" type="submit" id="btnsavequestion"><i class="ti ti-folder"></i> Save Changes</button>
                </form>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="importcsv" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Import Questions Excel Template</h4>
            <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal">&times;</button>
           
          </div>
          <div class="modal-body">
           
              <form id="frmimport">
                <div class="col-md-12">
                  <div class="form-group">
                   Select File
                  <input type="file" accept=".xls"  name="student_data" class="form-control" required>
                </div>
                </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default pull-left close" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnimportemp"><i class="glyphicon glyphicon-saved"></i>Save Information </button>
          </div>
        </form>
        </div>

      </div>
</div>

