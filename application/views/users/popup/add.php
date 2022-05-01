
<div class="modal fade rotate" id="add-user" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="add-user-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Add user</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;<span class="close-x">Close</span></button>
                </div>
                <div class="modal-body panel-body">
                    <div class="error_msg"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Name</label></legend>
                                <input type="text" name="user_name" class="form-control input-user-firstname" id="name-name" placeholder="Name">
                            </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <legend class="label"><label>Email</label></legend>
                                <input class="form-control input-user-email" placeholder="user@domain.com" maxlength="255" id="user_email" type="email" value="" name="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Mobile</label></legend>
                                <input class="form-control input-user-mobile" placeholder="ex:9876543210" maxlength="13" id="user_mobile" type="text" value="" name="mobile">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Password</label></legend>
                                <input class="form-control input-user-password" value="" placeholder="********" maxlength="128" id="user_password" type="password" name="encrypted_password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Confirm Password</label></legend>
                                <input class="form-control input-user-passwordconfirmation" value="" placeholder="********" id="user_password_confirmation" type="password" name="passwordconfirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <fieldset class="choices">
                                    <legend class="label"><label>Gender</label></legend>
                                    <ol class="choices-group input-user-gender">
                                        <li class="choice"><label for="user_gender_male"><input id="user_gender_male" type="radio" value="Male" name="gender">Male</label></li>
                                        <li class="choice"><label for="user_gender_female"><input id="user_gender_female" type="radio" value="Female" name="gender">Female</label></li>
                                    </ol>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Date of Birth</label></legend>
                                <input placeholder="Date of Birth" class="form-control input-user-date_of_birth" maxlength="255" id="user_date_of_birth" type="date" name="date_of_birth">
                            </div>
                        </div>
                    </div>        
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <fieldset class="choices">
                                    <legend class="label"><label>Role</label></legend>
                                    <ol class="choices-group role-choices input-user-role">
                                        <!--<li class="choice"><label for="user_role_superadmin"><input id="user_role_superadmin" type="radio" value="superadmin" name="role">Super Administrator</label></li>
                                        <li class="choice"><label for="user_role_admin"><input id="user_role_admin" type="radio" value="admin" name="role">Administrator</label></li>
                                        
                                        <li class="choice"><label for="user_role_headcoach"><input id="user_role_headcoach" type="radio" value="headcoach" name="role">Head Coach</label></li>
                                        <li class="choice"><label for="user_role_coach"><input id="user_role_coach" type="radio" value="coach" name="role">Coach</label></li>-->
                                        <li class="choice"><label for="user_role_parent"><input id="user_role_parent" type="radio" value="parent" name="role" checked >Parent</label></li>
                                    </ol>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend class="label"><label>Status</label></legend>
                                <select name="status" id="status" class="input-user-status">
                                    <option value="">Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-success" data-addempid="" id="add-user">Add</button> 
                            <button type="button" class="btn rkmd-btn btn-danger" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
<script>
    jQuery('.datepicker').datepicker();
</script>
<style>
legend {
    font-size: 16px;
    margin-bottom: 0;
}
.input-user-gender {
    list-style: none;
    display: flex;
    padding-left: 0;
}
.input-user-gender li {
    padding-right: 10px;
}
.input-user-gender li input, .input-user-role li input {
    margin-right: 5px;
}
.input-user-role {
    list-style: none;
    padding-left: 0;
}
#add-user-form .modal-title {
    color: #ba272d;
}
</style>