<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmadddepartment" class="needs-validation-add" onsubmit="event.preventDefault();submit_form('frmadddepartment','btnsaveselected','../controllers/save_asset_category','Successfully Saved','../listviews/v_assets','display_list','addnew')" novalidate>
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
                         Category Name:
                        <input type="text" class="form-control" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                          Type:
                        <select name="desc" class="form-control">
                            <option value="">-Select Type-</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Software">Software</option>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="form-check mb-2">
                            <input class="form-check-input input-primary" type="checkbox" name="has_properties" checked>
                            <label class="form-check-label" for="customCheckc1">Has Properties</label>
                        </div>
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
             <form id="frmupdatedepartment" class="needs-validation-edit" onsubmit="event.preventDefault();submit_form('frmupdatedepartment','btnupdate','../controllers/update_asset_category','Successfully Updated','../listviews/v_assets','display_list','mdl_update')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="edittype" name="action">
                    <input type="hidden" id="eid" name="id">
                     <div class="form-group">
                         Code:
                        <input type="text" class="form-control" id="code" name="code" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                         Category Name:
                        <input type="text" class="form-control" id="name" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                        Type:
                         <select name="desc" class="form-control" id="description">
                            <option value="">-Select Type-</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Software">Software</option>
                        </select>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                           
                        </div>
                    </div> 
                      <div class="form-group">
                        <div class="form-check mb-2">
                            <input class="form-check-input input-primary" type="checkbox" id="has_properties" name="has_properties" checked>
                            <label class="form-check-label" for="customCheckc1">Has Properties</label>
                        </div>
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


