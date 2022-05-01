<?php
    $id = $userInfo['user_id'] ? $userInfo['user_id'] : '';
    $name = $userInfo['user_name'] ? $userInfo['user_name'] : '';    
    $email = $userInfo['email'] ? $userInfo['email'] : '';
    $role = $userInfo['role'] ? $userInfo['role'] : '';
    $mobile = $userInfo['mobile'] ? $userInfo['mobile'] : '';
    $status = $userInfo['status'] ? $userInfo['status'] : '';
    $encryptedpassword = $userInfo['encrypted_password'] ? $userInfo['encrypted_password'] : '';
    $gender = $userInfo['gender'] ? $userInfo['gender'] : '';
    $dateofbirth = $userInfo['date_of_birth'] ? $userInfo['date_of_birth'] : '';
?>
<input type="hidden" name="user_id" value="<?php print $id; ?>">

<input type="hidden" name="user_name" class="form-control input-user-firstname" id="name" placeholder="Name" value="<?php print $name; ?>">
<input type="hidden" name="email" class="form-control input-user-email" id="email" placeholder="Email" value="<?php print $email; ?>">
<input type="hidden" name="role" class="form-control input-user-address" id="role" placeholder="Role" value="<?php print $role; ?>">

<input type="hidden" name="mobile" class="form-control input-user-mobile" id="mobile" placeholder="mobile No" value="<?php print $mobile; ?>">

<input type="hidden" name="status" class="form-control input-user-status" id="status" placeholder="Status" value="<?php print $status; ?>">
           
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Name</label></legend>
            <input type="text" value="<?php print $name; ?>" name="user_name" class="form-control input-user-firstname" id="name-name" placeholder="Name">
        </div>
    </div>                        
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
        <legend class="label"><label>Email</label></legend>
            <input class="form-control input-user-email" placeholder="user@domain.com" maxlength="255" id="user_email" type="email" value="<?php print $email; ?>" name="email">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Mobile</label></legend>
            <input class="form-control input-user-mobile" placeholder="ex:9876543210" maxlength="13" id="user_mobile" type="text" value="<?php print $mobile; ?>" name="mobile">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Password</label></legend>
            <input class="form-control input-user-password" value="<?php print $encryptedpassword; ?>" placeholder="********" maxlength="128" id="user_password" type="password" name="encrypted_password">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Confirm Password</label></legend>
            <input class="form-control input-user-passwordconfirmation" value="<?php print $encryptedpassword; ?>" placeholder="********" id="user_password_confirmation" type="password" name="passwordconfirmation">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <fieldset class="choices">
                <legend class="label"><label>Gender</label></legend>
                <ol class="choices-group input-user-gender">
                    <li class="choice"><label for="user_gender_male"><input <?php if($gender=="Male") echo "checked"; ?> id="user_gender_male" type="radio" value="Male" name="gender">Male</label></li>
                    <li class="choice"><label for="user_gender_female"><input <?php if($gender=="Female") echo "checked"; ?> id="user_gender_female" type="radio" value="Female" name="gender">Female</label></li>
                </ol>
            </fieldset>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Date of Birth</label></legend>
            <input placeholder="Date of Birth" value="<?php print $dateofbirth; ?>"  class="form-control input-user-date_of_birth datepicker" maxlength="255" id="user_date_of_birth" type="date" name="date_of_birth">
        </div>
    </div>
</div>        

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <fieldset class="choices">
                <legend class="label"><label>Role</label></legend>
                <ol class="choices-group input-user-role">
                    <!--<li class="choice"><label for="user_role_superadmin"><input <?php if($role=="superadmin") echo "checked"; ?> id="user_role_superadmin" type="radio" value="superadmin" name="role">SuperAdministrator</label></li>
                    <li class="choice"><label for="user_role_admin"><input <?php if($role=="admin") echo "checked"; ?> id="user_role_admin" type="radio" value="admin" name="role">Administrator</label></li>-->
                    <li class="choice"><label for="user_role_parent"><input <?php if($role=="parent") echo ''; //"checked"; ?> checked id="user_role_parent" type="radio" value="parent" name="role">Parent</label></li>
                    <!--<li class="choice"><label for="user_role_headcoach"><input <?php if($role=="headcoach") echo "checked"; ?> id="user_role_headcoach" type="radio" value="headcoach" name="role">HeadCoach</label></li>
                    <li class="choice"><label for="user_role_coach"><input <?php if($role=="coach") echo "checked"; ?> id="user_role_coach" type="radio" value="coach" name="role">Coach</label></li>-->
                </ol>
            </fieldset>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <legend class="label"><label>Status</label></legend>
            <select name="status" id="status" class="input-user-status" 
            <?php if($this->session->userdata('role') == 'superadmin' || $this->session->userdata('role') == 'admin' ) { echo ''; }else { 
                echo 'disabled';
                }?>>
                <option value="">Status</option>
                <option value="Active" <?php if($status=="Active") echo "selected"; ?>>Active</option>
                <option value="Inactive" <?php if($status=="Inactive") echo "selected"; ?>>Inactive</option>
            </select>
        </div>
    </div>
</div>    