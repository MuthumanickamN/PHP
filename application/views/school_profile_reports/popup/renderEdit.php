<?php
$id = $schoolInfo['id'] ? $schoolInfo['id'] : '';
$school_id = $schoolInfo['school_id'] ? $schoolInfo['school_id'] : '';
$school_name = $schoolInfo['school_name'] ? $schoolInfo['school_name'] : '';
$contact = $schoolInfo['contact'] ? $schoolInfo['contact'] : '';
$school_location = $schoolInfo['school_location'] ? $schoolInfo['school_location'] : '';
$contact_person = $schoolInfo['contact_person'] ? $schoolInfo['contact_person'] : '';
$status = $schoolInfo['status'] ? $schoolInfo['status'] : 0;
$trn_number = $schoolInfo['trn_number'] ? $schoolInfo['trn_number'] : '';
$school_email_id = $schoolInfo['school_email_id'] ? $schoolInfo['school_email_id'] : ''; 
?>
<input type="hidden" name="school_id" value="<?php print $id; ?>">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>School Name</label>
            <input type="text" name="school_name" class="form-control input-school-school_name" id="school_name" placeholder="School Name" value="<?php print $school_name; ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>School Location</label>
            <input type="text" name="school_location" class="form-control input-school-school_location" id="school_location" placeholder="School Location" value="<?php print $school_location; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact" class="form-control input-school-contact" id="contact" placeholder="Contact Number" value="<?php print $contact; ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control input-school-contact_person" id="contact_person" placeholder="Contact Person" value="<?php print $contact_person; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>TRN Number</label>
            <input type="text" name="trn_number" class="form-control input-school-trn_number" id="trn_number" placeholder="TRN Number" value="<?php print $trn_number; ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Email-Id</label>
            <input type="text" name="school_email_id" class="form-control input-school-school_email_id" id="Email-Id" placeholder="school_email_id" value="<?php print $school_email_id; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        
        <div class="form-group">
			<legend class="label"><label>Status</label></legend>
			<select name="status" id="status" class="input-school-status">
				<option value="">Status</option>
				<option value="1" <?php echo ($status =='1')?'selected="selected"':'';?>>Active</option>
				<option value="0" <?php echo ($status =='0')?'selected="selected"':'';?>>Inactive</option>
			</select>
		</div>
    </div>
</div>
