
<div class="modal fade rotate" id="add-user" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="add-user-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Add user</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="user_name" class="form-control input-user-firstname" id="name-name" placeholder="Name">
                            </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control input-user-email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="role" class="form-control input-user-role" id="role" placeholder="role">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="mobile" class="form-control input-user-contactno" id="mobile" placeholder="Mobile No">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="number" name="status" class="form-control input-user-status" id="status" placeholder="status">
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-secondary" data-addempid="" id="add-user">Add</button> 
                            <button type="button" class="btn rkmd-btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
