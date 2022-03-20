
<div class="modal fade rotate" id="update-password" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="update-password-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Change password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="hidden" name="id"  id="id_value">
                <div class="modal-body panel-body" id="render-update-data">
                    <!--<div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Old password</label></legend>
                                <input type="password" name="old_password" class="form-control input-user-old_password" id="email" placeholder="Old password" value="" required="">
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>New password</label></legend>
                                <input type="password" name="new_password" class="form-control input-user-new_password" id="email" placeholder="New password" value="" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Confirm password</label></legend>
                                <input type="password" name="confirm_password" class="form-control input-user-confirm_password" id="email" placeholder="confirm password" value="" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-success" data-addempid="" id="update-password">Update</button> 
                            <button type="button" class="btn rkmd-btn btn-danger" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
