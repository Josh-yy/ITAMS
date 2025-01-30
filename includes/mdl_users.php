<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close bg-light-default" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmadduser" class="needs-validation-add"  novalidate>
            <div class="modal-body row">
                    <div class="col-md-8 col-sm-12">
                        <input type="hidden" value="adduser" name="action">
                    <div class="row">
                        <div class="form-group col-md-4 col-sm-12">
                         First Name:
                        <input type="text" class="form-control" name="fn" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div> 
                     <div class="form-group col-md-4 col-sm-12">
                         Middle Name:
                        <input type="text" class="form-control" name="mn" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback col-md-4 col-sm-12">
                        </div>
                    </div>
                     <div class="form-group col-md-4 col-sm-12">
                         Last Name:
                        <input type="text" class="form-control" name="ln" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                         Email Address:
                        <input type="email" class="form-control" name="username" v>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12" style="display:none">
                                                   Gender :
                                                    <select class="form-control" name="gender">

                                                            <option value="">-Select Gender-</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>   
                                                         <div class="valid-feedback">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select gender
                                                        </div>
                                                    </div>
                                                     <div class="form-group col-md-6 col-sm-12" style="display:none">
                                                                   Birthdate : 
                                                                    <input type="date" class="form-control" name="bdate" placeholder="" max="<?php echo date('Y-m-d') ?>">
                                                                     <div class="valid-feedback">
                                                                        
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Please enter Birthdate
                                                                    </div>
                                                                </div>
                                                     <div class="form-group col-md-12 col-sm-12">
                                                        Address : 
                                                        <textarea class="form-control" name="address" required></textarea>
                                                         <div class="valid-feedback">
                                                            
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please enter address
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-groupcol-md-12 col-sm-12 " style="display:none">
                                                        Civil Status : 
                                                    <select class="form-control" name="civil_stat" >
                                                            <option value="">-Select Civil Status-</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widow">Widow</option>
                                                            <option value="Separated">Separated</option>
                                                        </select>   
                                                         <div class="valid-feedback">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select civil status
                                                        </div>
                                                    </div>
                    </div> 
                      <div class="form-group">
                        Position Level:
                        <select class="form-control" name="position"  required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_positions";
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
                        Department:
                        <select class="form-control" name="department"  required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_department";
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
                        User Type:
                        <select class="form-control" name="usertype" required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_usertype";
                            $data = $db->query($sql)->fetchAll();
                            foreach($data as $row)
                            {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['typename'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                         <img src="assets/images/capture.png" style="width:100%; border:solid    2px" id="avatar">
                                                <input type="hidden" name="action" value="addemployee">
                                                 <input type="file" name="picture" id="scanned_pic" class="form-control" accept="image/png, image/gif, image/jpeg" onchange="previewFile('scanned_pic','avatar'); " required>

                                                
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnsaveemp">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
                <button type="button" class="close bg-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmupdate" class="needs-validation-edit"  novalidate>
                <div class="modal-body row">
                    <input type="hidden" value="edituser" name="action">
                    <input type="hidden" id="eid" name="id">
                   
                   <div class="col-md-8 col-sm-12">
                        <input type="hidden" value="adduser" name="action">
                    <div class="row">
                        <div class="form-group col-md-4 col-sm-12">
                         First Name:
                        <input type="text" class="form-control" id="fn" name="fn" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div> 
                     <div class="form-group col-md-4 col-sm-12">
                         Middle Name:
                        <input type="text" class="form-control" id="mn" name="mn" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback col-md-4 col-sm-12">
                        </div>
                    </div>
                     <div class="form-group col-md-4 col-sm-12">
                         Last Name:
                        <input type="text" class="form-control" id="ln" name="ln" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                         Email Address:
                        <input type="email" class="form-control" id="username" name="username" v>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12" style="display:none">
                                                   Gender :
                                                    <select class="form-control" id="gender" name="gender">

                                                            <option value="">-Select Gender-</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>   
                                                         <div class="valid-feedback">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select gender
                                                        </div>
                                                    </div>
                                                     <div class="form-group col-md-6 col-sm-12" style="display:none">
                                                                   Birthdate : 
                                                                    <input type="date" id="bdate" class="form-control" name="bdate" placeholder="" max="<?php echo date('Y-m-d') ?>">
                                                                     <div class="valid-feedback">
                                                                        
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Please enter Birthdate
                                                                    </div>
                                                                </div>
                                                     <div class="form-group col-md-12 col-sm-12">
                                                        Address : 
                                                        <textarea class="form-control" id="address" name="address" required></textarea>
                                                         <div class="valid-feedback">
                                                            
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please enter address
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-groupcol-md-12 col-sm-12 " style="display:none">
                                                        Civil Status : 
                                                    <select class="form-control"  name="civil_stat" >
                                                            <option value="">-Select Civil Status-</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widow">Widow</option>
                                                            <option value="Separated">Separated</option>
                                                        </select>   
                                                         <div class="valid-feedback">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select civil status
                                                        </div>
                                                    </div>
                    </div> 
                     <div class="form-group">
                        Position Level:
                        <select class="form-control" name="position" id="position" required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_positions";
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
                        Department:
                        <select class="form-control" name="department" id="department" required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_department";
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
                        Position Level:
                        <select class="form-control" name="usertype" id="usertype" required>
                            <option value=""></option>
                            <?php
                            $sql = "select * from m_usertype";
                            $data = $db->query($sql)->fetchAll();
                            foreach($data as $row)
                            {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['typename'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                         <img src="assets/images/capture.png" style="width:100%; border:solid  2px" id="avatars">
                                                <input type="hidden" name="action" value="addemployee">
                                                 <input type="file" name="picture" id="scanned_pics" class="form-control" accept="image/png, image/gif, image/jpeg" onchange="previewFile('scanned_pics','avatars'); " required>

                                                
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="btnclosing" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnupdate">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="add_assignment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Assign Branch Assignment</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <form id="frmassign" class="needs-validation-assign" onsubmit="event.preventDefault();submit_form('frmassign','btnassign','../controllers/save_branch_assignment','Successfully Saved Branch Assignment','../listviews/v_users','display_list','add_assignment','needs-validation-assign')" novalidate>
             <input type="hidden" id="userid" name="userid">
            <div class="modal-body">  
                <div class="form-group">
                    Select Branch Assignment : 
                    <select name="branch_id" class="form-control" required>
                            <option value="">-Select-</option>
                            <?php
                            $sql="select * from m_branches";
                            $data = $db->query($sql)->fetchAll();
                            foreach($data as $row){
                            ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close"  id="close" data-bs-dismiss="modal" id="close">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnassign">Save Selection</button>
            </div>
        </form>
        </div>
    </div>
</div>