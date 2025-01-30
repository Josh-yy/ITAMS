<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="frmadddepartment" class="needs-validation-add" onsubmit="event.preventDefault();submit_form('frmadddepartment','btnsaveselected','../controllers/save_usertype','Successfully Saved','../listviews/v_usertype','display_list','addnew')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="addtype" name="action">
                    <div class="form-group">
                         Name:
                        <input type="text" class="form-control" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                        Description:
                        <input type="text" class="form-control" name="desc" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                          
                        </div>
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnsaveselected">Save changes</button>
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
             <form id="frmupdatedepartment" class="needs-validation-edit" onsubmit="event.preventDefault();submit_form('frmupdatedepartment','btnupdate','../controllers/update_usertype','Successfully Updated','../listviews/v_usertype','display_list','mdl_update')" novalidate>
            <div class="modal-body">
                    <input type="hidden" value="edittype" name="action">
                    <input type="hidden" id="eid" name="id">
                    <div class="form-group">
                         Name:
                        <input type="text" class="form-control" id="department" name="name" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div> 
                    <div class="form-group">
                        Description:
                        <input type="text" class="form-control" id="acronym" name="desc" required>
                         <div class="valid-feedback">
                            
                        </div>
                        <div class="invalid-feedback">
                           
                        </div>
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-default" id="close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnupdate">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Assign Navigational Menu</h5>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <input type="hidden" id="txttypeid">
            <div class="modal-body" style="height:400px; overflow-y: scroll;" id="display_facilities">  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="closemodal">Close</button>
                <button type="submit" class="btn btn-secondary" id="btnsaveselection">Save Selection</button>
            </div>
        </form>
        </div>
    </div>
</div>