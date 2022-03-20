
<section class="content-header">
<h1>Edit Profile</h1>
<ol class="breadcrumb">
<li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</li>
</ol>
</section>
<!-- Main content -->
<section class="content admin_table">
<div class="col-sm-12 col-md-6 col-md-push-3">
<form name="emailid_details" id="emailid_details" action="<?php echo base_url(); ?>profile/update_email"  method="POST" class="form-horizontal" role="form" autocomplete="off">
	<div class="panel panel-default">
	
	<div class="clearfix" id="dynamic_message"></div>
	<?php if($this->session->flashdata('success_message')){ ?>
	<div class="col-sm-12 col-md-12" id="hideMe">
	<div class="alert alert-success">
	<i class="fa fa-check-square" aria-hidden="true"></i> 
	<strong><?php echo $this->session->flashdata('success_message'); ?></strong>
	</div>
	</div>
	<?php } if($this->session->flashdata('error_message')){ ?>
	<div class="error_message"><p class="alert alert-danger"><?php echo $this->session->flashdata('error_message'); ?></p></div>
	<?php } ?>
	
	
		<div class="panel-heading"><strong>Email-Id</strong></div>
		<div class="panel-body">
			<div class="form-group">
				<label for="Password" class="col-md-4 control-label">New Email-Id</label>
				<div class="col-md-8">
					<div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
					<input value="<?php  echo $user_email;?>" class="form-control input-md" autocomplete="off" placeholder="Enter your new Emailid" name="emailid" id="emailid" type="text">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="Submit" class="col-md-4 control-label"></label>
			<div class="col-md-4 pull-right">
			<input id="email_hid" name="email_hid" type="hidden" value="<?php echo $id;?>">
			<input id="email_hid_address" name="email_hid_address" type="hidden" value="<?php  echo $user_email;?>">
			<input id="user_hid_name" name="user_hid_name" type="hidden" value="<?php  echo $user_name;?>">
			
				<input class="btn btn-default btn-flat pull-right" data-loading-text="Please wait" name="email_update" id="email_update" value="Update Email ID" type="submit"/>
			</div>
		</div>
	</div>
</div>
</form>
</div>
<div class="clearfix"></div>
<hr>
<div class="col-sm-12 col-md-6 col-md-push-3">
<!-- general form elements -->
<form name="password_details" id="password_details" action="<?php echo base_url(); ?>profile/update_password" method="POST" class="form-horizontal" role="form" autocomplete="off">
<div class="panel panel-default">
	<div class="panel-heading"><strong>Change Password</strong></div>
	<div class="panel-body">
		<div class="form-group">
			<label for="Password" class="col-md-4 control-label">User Name</label>
			<div class="col-md-8">
				<div class="input-group"> <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
				<input disabled="" class="form-control input-md" autocomplete="off" placeholder="admin" name="username" id="username" type="text" value="<?php  echo $user_name;?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="Password" class="col-md-4 control-label">New Password</label>
		<div class="col-md-8">
			<div class="input-group"> <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			<input class="form-control input-md" autocomplete="off" placeholder="Enter your new password" name="newpassword" id="newpassword" type="password">
		</div>
	</div>
</div>
<!-- Password input-->
<div class="form-group">
	<label for="ConfirmPassword" class="col-md-4 control-label">Confirm Password</label>
	<div class="col-md-8">
	<input id="email_hid_address_password" name="email_hid_address_password" type="hidden" value="<?php  echo $user_email;?>">
		<div class="input-group"> <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		<input class="form-control input-md" autocomplete="off" placeholder="Enter your password again" name="confirmpassword" id="confirmpassword" type="password">
	</div>
</div>
</div>
<!-- Button -->
<div class="form-group">
<label for="Submit" class="col-md-4 control-label"></label>
<div class="col-md-4 pull-right">
<input id="pass_hid" name="pass_hid" type="hidden" value="<?php echo $id;?>">
	<input class="btn btn-default btn-flat pull-right" id="submit1" data-loading-text="Please wait" name="submit1" value="Update Password" type="submit"/>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<script>
var base_url = "<?php echo base_url(); ?>";
var user_id = "<?php echo $this->session->userdata('id'); ?>";
$(document).ready(function(){
	
$.validator.addMethod("valid_email", function(value, element) {
return this.optional(element) || /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
});

	$('.alert-success').delay(3000).fadeOut('slow');
	
$('#email_update').on('click',function(){
	var $btn = $(this);
	$("form[name='emailid_details']").validate({
		 
        // Specify validation rules
		ignore: [],
              debug: false,
       rules: {
            emailid: {
                required: true,
				valid_email:true
            }
        },
        messages: {
			emailid: {
                required: "Please enter the email address!",
				valid_email:"Please enter the correct email address"
            }
        },
		submitHandler: function (form) {
			 $btn.button('loading');
            //alert("Validation Success!");
            form.submit();
            return true;
           }
    });
});
	
	
	
	$('#submit1').on('click',function(){
		 var $btn = $(this);
		
	$("#password_details").validate({
        // Specify validation rules
       rules: {
            newpassword: {
                           required: true
                         },
			confirmpassword: {
								required: true,
								equalTo: "#newpassword"
                             }
        },
        messages: {
            newpassword: {
                           required: "Please enter your new password"
                         },
			confirmpassword: {
								required: "Please enter your confirm password",
								equalTo: "Password does not match..!"
                             }
            
        },
		submitHandler: function (form) {
			 $btn.button('loading');
            //alert("Validation Success!");
            form.submit();
            return true;
           }
    });
	
	});
	
	
	
});


</script>

