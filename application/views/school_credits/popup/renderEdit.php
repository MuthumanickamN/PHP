<?php
$school_id = $schoolInfo['school_id'] ? $schoolInfo['school_id'] : '';
$school_name = $schoolInfo['school_name'] ? $schoolInfo['school_name'] : '';
$contact = $schoolInfo['contact'] ? $schoolInfo['contact'] : '';
$school_location = $schoolInfo['school_location'] ? $schoolInfo['school_location'] : '';
$contact_person = $schoolInfo['contact_person'] ? $schoolInfo['contact_person'] : '';
$status = $schoolInfo['status'] ? $schoolInfo['status'] : '';
$trn_number = $schoolInfo['trn_number'] ? $schoolInfo['trn_number'] : '';
$school_email_id = $schoolInfo['school_email_id'] ? $schoolInfo['school_email_id'] : '';
?>
<input type="hidden" name="school_id" value="<?php print $school_id; ?>">
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
            <input type="text" name="school_location" class="form-control input-school-school_name" id="school_location" placeholder="School Location" value="<?php print $school_location; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact" class="form-control input-school-email" id="contact" placeholder="Contact Number" value="<?php print $contact; ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control input-school-address" id="contact_person" placeholder="Contact Person" value="<?php print $contact_person; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>TRN Number</label>
            <input type="text" name="trn_number" class="form-control input-school-mobile" id="trn_number" placeholder="TRN Number" value="<?php print $trn_number; ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Email-Id</label>
            <input type="text" name="school_email_id" class="form-control input-school-status" id="Email-Id" placeholder="school_email_id" value="<?php print $school_email_id; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Status</label>
            <input type="text" name="status" class="form-control input-school-status" id="status" placeholder="Status" value="<?php print $status; ?>">
        </div>
    </div>
</div>