
<div class="modal fade rotate" id="add-school" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="add-school-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">School registration</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;<span class="close-x">Close</span></button>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>School Name</label></legend>
                                <input type="text" name="school_name" class="form-control input-school-school_name" id="school_name" placeholder="School name">
                            </div>
                        </div>   
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>School Location</label></legend>
                                <input type="text" name="school_location" class="form-control input-school-school_location" id="school_location" placeholder="School location">
                            </div>
                        </div>
                                          
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>Contact number</label></legend>
                                <input type="number" name="contact" class="form-control input-school-contact" id="contact" placeholder="Contact number">
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>Contact person</label></legend>
                                <input type="text" name="contact_person" class="form-control input-school-contact_person" id="contact_person" placeholder="Contact person">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>TRN number</label></legend>
                                <input type="number" name="trn_number" class="form-control input-school-trn_number" id="trn_number" placeholder="TRN number">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
								<legend class="label"><label>Email id</label></legend>
                                <input type="text" name="school_email_id" class="form-control input-school-school_email_id" id="school_email_id" placeholder="School Email id">
                            </div>
                        </div>
                    </div>  
                    
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Status</label></legend>
                                <select name="status" id="status" class="input-school-status">
                                    <option value="">Status</option>
                                    <option value="1" selected="selected">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>        
                
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-success" data-addempid="" id="add-school">Add</button> 
                            <button type="button" class="btn rkmd-btn btn-danger" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#status').select2();
});
</script>