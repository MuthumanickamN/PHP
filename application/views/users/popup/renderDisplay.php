<?php
    $name = $userInfo['user_name'] ? $userInfo['user_name'] : '';
    $email = $userInfo['email'] ? $userInfo['email'] : '';
    $role = $userInfo['role'] ? $userInfo['role'] : '';
    $mobile = $userInfo['mobile'] ? $userInfo['mobile'] : '';
    $status = $userInfo['status'] ? $userInfo['status'] : '';
?>
<div class="row">   
    <div class="col-lg-12">
        <p><strong>Name: </strong><?php print $name?></p>
        <p><strong>Email: </strong><?php print $email?></p>
        <p><strong>Role: </strong><?php print $role?></p>
        <p><strong>Phone: </strong><?php print $mobile?></p>
        <p><strong>Status: </strong><?php print $status?></p>
    </div>
</div><!-- /.row -->
