<div id="addnewlink" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-light-secondary">
           
            <h4 class="modal-title">Add New Facility</h4>
             <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
        
              <form id="frmaddnew" onsubmit="event.preventDefault();submit_form('frmaddnew','btnsave','../controllers/save_facility','Successfully Saved Facility','listviews/v_facilities','display_list','addnewlink')">
                <div class="col-lg-12">
                     <div class="form-group">
                        Facility Name : 
                        <input type="text"  name="facility" placeholder="please enter  name" class="form-control" required>
                      </div>
                      <div class="form-group">
                        Description : 
                        <input type="text"  name="desc" placeholder="please enter description" class="form-control" required>
                      </div>
                       <div class="form-group">
                        Node / Category : 
                        <select class="form-control" name="node">
                          <option value="1">System Settings</option>
                          <option value="2">Setup</option>
                          <option value="3">Asset Setup Manager</option>
                          <option value="4">File Manager</option>
                          <option value="5">Transaction</option>
                          <option value="6">Reports</option>
                          <option value="7">Dashboard</option>
                           <option value="8">Views</option>
                           <option value="9">Quick Links</option>
                        </select>
                      </div>
                      <div class="form-group">
                        Facility Link : 
                        <input type="text" name="facility_link" placeholder="please enter facility link" class="form-control" required>
                      </div>
                      <div class="form-group">
                        Order: 
                        <input type="number" name="order" placeholder="please enter order number" class="form-control" required>
                      </div>
                       <div class="form-group">
                        isSideBarMenu : 
                        <select class="form-control" name="ismenu" required>
                          <option value="">--</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                </div>
         
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default close" id="close" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsave"><i class="ti ti-folder"></i> Save Information </button>
              </form>
          </div>
      
        </div>

      </div>
</div>
<div id="mdlupdate" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-light-secondary">
          
            <h4 class="modal-title">Update Facility</h4>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&times;</button>
          </div>
           <!--end of modal header -->
          <div class="modal-body">
            <form id="frmupdate"  onsubmit="event.preventDefault();submit_form('frmupdate','btnupdateuser','../controllers/update_facility','Successfully Updated Facility','listviews/v_facilities','display_list','mdlupdate');">
          <input type="hidden" id="eid" name="eid" />
       
                
                <div class="form-group">
                        Facility Name : 
                        <input type="text" id="a"  name="facility" placeholder="please enter facility name" class="form-control" required>
                      </div>
                      <div class="form-group">
                        Description : 
                        <input type="text" id="b"  name="desc" placeholder="please enter description" class="form-control" required>
                      </div>
                       <div class="form-group">
                        Node / Category : 
                        <select class="form-control" id="d" name="node">
                           <option value="1">System Settings</option>
                          <option value="2">Setup</option>
                          <option value="3">Asset Setup Manager</option>
                          <option value="4">File Manager</option>
                          <option value="5">Transaction</option>
                          <option value="6">Reports</option>
                          <option value="7">Dashboard</option>
                           <option value="8">Views</option>
                           <option value="9">Quick Links</option>
                        </select>
                      </div>
                      <div class="form-group">
                        Facility Link : 
                        <input type="text" id="c" name="facility_link" placeholder="please facility link" class="form-control" required>
                      </div>
                         <div class="form-group">
                        Order: 
                        <input type="number" id="order" name="order" placeholder="please enter order number" class="form-control" required>
                      </div>
                       <div class="form-group">
                        isSideBarMenu : 
                        <select class="form-control" id="ismenu" name="ismenu" required>
                          <option value="">--</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
        
          </div>
           <!--end of modal body -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default pull-left close" id="close" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-secondary" id="btnupdateuser"><i class="ti ti-folder"></i>Update </button>
          </div>
          <!--end of modal footer -->
        </div>
         <!--end of modal footer -->
      </form>
      </div>
</div>