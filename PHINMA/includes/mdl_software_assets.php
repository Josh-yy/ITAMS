<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmadddepartment" class="needs-validation-add" onsubmit="event.preventDefault();submit_form('frmadddepartment','btnsaveselected','../controllers/save_software_asset','Successfully Saved','../listviews/v_software_assets','display_list','addnew')" novalidate>
            <div class="modal-body">
            <input type="hidden" value="addtype" name="action">
                <div class="form-group">
                         Code:
                        <input type="text" class="form-control"  name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                         Software Name:
                        <input type="text" class="form-control" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="form-group">
                         Serial Number:
                        <input type="text" class="form-control" name="serial_number" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                      <div class="form-group">
                         Date Purchased:
                        <input type="date" class="form-control" name="date_purchased" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                     <div class="form-group">
                         Expiration Date:
                        <input type="date" class="form-control" name="expiration_date" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="form-group">
                          Licensed Type:
                        <select name="ltype" class="form-control">
                            <option value="">-Select Type-</option>
                            <option value="OEM">OEM</option>
                            <option value="FPP">FPP</option>
                            <option value="VLS">VLS</option>
                            <option value="Web/Online">Web/Online</option>
                            <option value="Free">Free</option>
                            <option value="Unlicensed">Unlicensed</option>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div>
                     <div class="form-group">
                                Asset Category:
                                <select class="form-control" name="assetcat"  required>
                                    <option value=""></option>
                                    <?php
                                    $sql = "select * from m_asset_category where description='Software'";
                                    $data = $db->query($sql)->fetchAll();
                                    foreach($data as $row)
                                    {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary"  id="btnsaveselected">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-sunny-morning">
                <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmupdatedepartment" class="needs-validation-edit" onsubmit="event.preventDefault();submit_form('frmupdatedepartment','btnupdate','../controllers/update_software_asset','Successfully Updated','../listviews/v_software_assets','display_list','mdl_update')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="edittype" name="action">
                    <input type="hidden" id="eid" name="id">
                    
                  
                   <div class="form-group">
                         Code:
                        <input type="text" class="form-control" id="code"  name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                         Software Name:
                        <input type="text" class="form-control" id="name" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="form-group">
                         Serial Number:
                        <input type="text" class="form-control" id="serial_number" name="serial_number" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                      <div class="form-group">
                         Date Purchased:
                        <input type="date" class="form-control" id="date_purchased" name="date_purchased" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                      <div class="form-group">
                         Expiration Date:
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="form-group">
                          Licensed Type:
                        <select name="ltype" class="form-control" id="ltype">
                            <option value="">-Select Type-</option>
                            <option value="OEM">OEM</option>
                            <option value="FPP">FPP</option>
                            <option value="VLS">VLS</option>
                            <option value="Web/Online">Web/Online</option>
                            <option value="Free">Free</option>
                            <option value="Unlicensed">Unlicensed</option>
                        </select>
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
                                    $sql = "select * from m_asset_category where description='Software'";
                                    $data = $db->query($sql)->fetchAll();
                                    foreach($data as $row)
                                    {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close"  data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnupdate">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


