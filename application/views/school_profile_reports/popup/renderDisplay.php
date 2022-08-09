<?php
    $school_name = $schoolInfo['school_name'] ? $schoolInfo['school_name'] : '';
    $contact = $schoolInfo['contact'] ? $schoolInfo['contact'] : '';
    $school_location = $schoolInfo['school_location'] ? $schoolInfo['school_location'] : '';
    $contact_person = $schoolInfo['contact_person'] ? $schoolInfo['contact_person'] : '';
    $status = $schoolInfo['status'] ? $schoolInfo['status'] : '';
    $trn_number = $schoolInfo['trn_number'] ? $schoolInfo['trn_number'] : '';
    $school_email_id = $schoolInfo['school_email_id'] ? $schoolInfo['school_email_id'] : '';
    $created_at = $schoolInfo['created_at'] ? $schoolInfo['created_at'] : '';
    $updated_at = $schoolInfo['updated_at'] ? $schoolInfo['updated_at'] : '';
?>
<div class="row">   
    <div class="col-lg-12">
        <p><strong>School Name: </strong><?php print $school_name?></p>
        <p><strong>School Location: </strong><?php print $school_location?></p>
        <p><strong>Contact Number: </strong><?php print $contact?></p>
        <p><strong>Contact Person: </strong><?php print $contact_person?></p>
        <p><strong>TRN Number: </strong><?php print $trn_number?></p>
        <p><strong>Email Id: </strong><?php print $school_email_id?></p>
        <p><strong>Status: </strong><?php print $status?></p>
        <p><strong>Created At: </strong><?php print $created_at?></p>
        <p><strong>Updated At: </strong><?php print $updated_at?></p>
    </div>
</div><!-- /.row -->
