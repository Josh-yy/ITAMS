<div class="modal fade" id="addnewasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmaddasset" class="needs-validation-add" onsubmit="event.preventDefault();submit_form('frmaddasset','btnsaveselected','../controllers/save_asset_info','Successfully Saved Hardware Asset Information','../listviews/v_assets_info','display_list','addnewasset')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="addtype" name="action">
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                             <div class="form-group">
                         Code :
                        <input type="text" class="form-control"  name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                             <div class="form-group">
                                 Asset Name : 
                                <input type="text" class="form-control" name="assetname" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                       
                       
                             <div class="form-group">
                                 Machine Name : 
                                <input type="text" class="form-control" name="machinename" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                        
                     
                             <div class="form-group">
                                 Model Number : 
                                <input type="text" class="form-control" name="modelno" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 

                              <div class="form-group">
                                 Serial Number : 
                                <input type="text" class="form-control" name="serialno" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                        
                  
                     <div class="form-group">
                                 Date Purchased : 
                                <input type="date" class="form-control" name="datepurchase" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                     <div class="form-group">
                        Asset Category:
                        <select class="form-control" name="assetcat" id="assetcat" required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_asset_category";
                            $data = $db->query($sql)->fetchAll();
                            foreach($data as $row)
                            {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div> 
                    <div class="form-group">
                        Status : 
                        <select class="form-control" name="status" required>
                            <option value=""></option>
                            <option value="Functional">Functional</option>
                            <option value="Non-Fontional">Non-Fontional</option>
                        </select>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary"  id="btnsaveselected">Save Asset Information</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editstudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmupdatestudent" class="needs-validation-add" onsubmit="event.preventDefault();submit_form('frmupdatestudent','btnupdate','../controllers/update_student','Successfully Updated Student Information','../listviews/v_students','display_list','editstudent')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="addtype" name="action">
                    <input type="hidden" id="eid" name="id" >
                     <div class="form-group">
                         Student ID No:
                        <input type="text" class="form-control"  name="student_id" id="student_id" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                             <div class="form-group">
                                 First Name:
                                <input type="text" class="form-control" name="fn" id="fn" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                 Middle Name:
                                <input type="text" class="form-control" name="mn" id="mn" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                 Last Name:
                                <input type="text" class="form-control" name="ln" id="ln" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                        </div>
                    </div>
                     <div class="form-group">
                                 Birthdate : 
                                <input type="date" class="form-control" name="dob" id="dob" required>
                                 <div class="valid-feedback">
                                    
                                </div>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div> 
                    <div class="form-group">
                        Address:
                        <input type="text" class="form-control" name="address" id="address" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div> 
                    <div class="form-group">
                        Gender : 
                        <select class="form-control" name="gender" id="gender" required>
                            <option value=""></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                           
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary"  id="btnsaveselected">Save changes</button>
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
             <h4 class="modal-title">Import Students Excel Template</h4>
            <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal">&times;</button>
           
          </div>
          <div class="modal-body">
           
              <form id="frmimport">
                 <input type="hidden"  name="class_subject_id" value="<?php echo $class_subject_id ?>" class="form-control" required>
                 <input type="hidden"  name="class_id" value="<?php echo $class_id ?>" class="form-control" required>
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

