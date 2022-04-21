<section class="content-header">
<h1>Manage Users</h1>
<ol class="breadcrumb">
<li><i class="fa fa-user" aria-hidden="true"></i> Manage Users</li>
<li class="active">Users</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<div class="clearfix"></div>

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
	
        <div class="clearfix"></div>
<section class="content admin_table">
<div class="col-sm-12 col-md-12 add_button"><button type="button"  data-toggle="modal" data-target="#editModal" class="btn btn-success pull-right add_user"><i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; Add New User</button>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped">
	<thead>
		<tr>
		    <th>S.No</th>
			<th>Name</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Date of Birth</th>
			<th class="no-sort">View</th>
			<th class="no-sort">Edit</th>
			<th class="no-sort">Delete</th>
			<th class="no-sort">Change password</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->


<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/js/manage_user.js"></script>
<script type="text/javascript">
$(function () {
	
	
	
$("#example1").DataTable();
/* $('#example2').DataTable({
	"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
}); */
});
</script>
<!-- Bootstrap Date Picker -->
<script type="text/javascript">
$(function () {
//Date picker
/* $('#datepicker1').datepicker({
autoclose: true
}); */

$('#datepicker').datepicker({
    format: "dd-mm-yyyy", 
    autoclose: true,
    todayHighlight: true,
   // startDate: '-0d',
    endDate: '+0d'
    }).on("changeDate", function (e) {
             $('#datepicker').valid();
    });
	
	$('#datepicker1').datepicker({
    format: "dd-mm-yyyy", 
    autoclose: true,
    //todayHighlight: true,
    startDate: '-0d',
    //endDate: '+0d'
    }).on("changeDate", function (e) {
             $('#datepicker1').valid();
    });
});
</script>
<script>
$(function () { 

$("[data-toggle = 'tooltip']").tooltip({html: true}); });
</script>
<!-- Include the plugin's for Multiselect: -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap-multiselect.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery.simpleLens.css">

<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/jquery.simpleLens.js"></script>


<style type='text/css'>
		.simpleLens-lens-element {
    height:350px;
    left: 105%;
    width:350px;
}
		</style>
<script type="text/javascript">

$(document).ready(function() {
	
/* $('#court').multiselect({
enableClickableOptGroups: true,
enableCollapsibleOptGroups: true,
enableFiltering: false,
includeSelectAllOption: true
}); */
$('#day').multiselect({
enableClickableOptGroups: true,
enableCollapsibleOptGroups: true,
enableFiltering: false,
includeSelectAllOption: true
});
});
</script>
<!-- Include the plugin's for Timepicker: -->

<script type="text/javascript">
$('#timepicker1').timepicker();
$('#timepicker2').timepicker();
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#check').click(function(){
$("#show1").show("slow");
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#slots').click(function(){
$("#hide1").toggle("slow");
});
});
</script>
<!-- View Modal HTML -->
<div id="viewModal" class="modal fade">
<div class="modal-dialog" style="width:85%;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="close-x">Close</span></button>
<h4 class="modal-title">View User Details</h4>
</div>
<div class="modal-body">
<div class="table-responsive">
	<table id="view_table" class="table table-bordered table-striped">
		<tbody>
			
		</tbody>
	</table>
</div>
<div class="clearfix"></div>
<div>
<input class="btn btn-success" data-id="" name="sub_edit" id="sub_edit" value="Edit" type="submit"/> 
<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>

<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="modal_close()">&times;<span class="close-x">Close</span></button>
<h4 class="modal-title">Edit / Create New User</h4>
</div>
<div class="modal-body">

<form method="post" action="<?php echo base_url(); ?>manage_user/add_user" name="add_user" id="add_user" enctype="multipart/form-data" >
<div class="col-sm-6 col-md-6">
	<p class="form_text1">Upload User Image</p>
	<div class="upload_image" id="upload_image">
	
	<img name="upload_image1"  id="upload_image1" class="upload_image" src="" style="height:70px;width:70px;">
	
	</div>
	
	<input type="file" onchange="load_user_image(this)" name="user_image" id="user_image" value="" class="btn btn-primary btn-xs"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image (Only .png and .jpg are allowed)
	<input type="hidden" name="user_hid_image" id="user_hid_image" value="">
</div>
<div class="col-sm-6 col-md-6">
	<p class="form_text1">Upload Emirates ID</p>
	<div class="upload_image" id="upload_image">
	
	<div class="simpleLens-gallery-container" id="demo-1">
        <div class="simpleLens-container">
            <div class="simpleLens-big-image-container">
	<a class="simpleLens-lens-image" data-lens-image="">
	<img name="upload_id_image1"  id="upload_id_image1" class="upload_image img-responsive simpleLens-big-image" src="" style="height:70px;width:70px;">
	</a>
	</div></div></div>
	
	</div>
	
	<input type="file" onchange="load_id_image(this)" name="user_id_image" id="user_id_image" value="" class="btn btn-primary btn-xs"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image (Only .png and .jpg are allowed)
	<input type="hidden" name="user_id_hid_image" id="user_id_hid_image" value="">
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Name</p>
	<input type="text" name="user_name" id="user_name" value="">
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Mobile (ex: 900123456789)</p>
	<input type="text" name="user_mobile" placeholder="12-digit mobile number" id="user_mobile" class="mobile_input" value="">
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Email</p>
	<input type="text" name="user_email" id="user_email" value="">
	<input type="hidden" name="user_email_hidden" id="user_email_hidden" value="">
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Date of Birth (dd-mm-yyyy)</p>
	<input type="text" class="date-picker" id="datepicker" name="datepicker">
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Gender</p>
	<label><input type="radio" name="gender" value="male"> Male</label> &nbsp; 
	<label><input type="radio" name="gender" value="female"> Female</label>
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Emirates-ID Expiry Date (dd-mm-yyyy)</p>
	<input type="text" class="date-picker" id="datepicker1" name="datepicker1">
</div>

<input type="hidden" id="hiddenselect" name="hiddenselect" value="">
<!--<div class="col-sm-12 col-md-6">
	<p class="form_text1">Sports</p>
	<select id="court" name="court" multiple="multiple" >
		 <?php foreach($sports_list as $key => $sports) { ?>
        <option value="<?php echo $sports['id']; ?>"><?php echo $sports['sportsname']; ?></option>
        <?php } ?>
		
	</select>
</div>-->
<!--<div class="col-sm-12 col-md-6">
	<p class="form_text1">Fee</p>
	<input type="text" name="register_fee" id="register_fee" value="" placeholder="One Time Registration Fee">
</div>-->
<div class="col-sm-12 col-md-6" id="pass">
	<p class="form_text1">Passsword</p>
	<input type="text" name="Password" id="Password" value="" placeholder="Password">
</div>
<div class="col-sm-12 col-md-6" id="c_pass">
	<p class="form_text1">Confirm Passsword</p>
	<input type="text" name="confirm_Password" id="confirm_Password" value="" placeholder="Re-enter Password">
</div>
<div class="clearfix"></div>
<input type="hidden" name="user_hidden_id" id="user_hidden_id" value="">
<div class="col-sm-12 col-md-12 pad_top_20"><input class="btn btn-success" name="submit1" id="submit1" data-loading-text="Loading..." value="Save" type="submit"/> <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true" onclick="modal_close()"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</form>


</div>
</div>
</div>
</div>




<div id="passwordModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="modal_close_password()">&times;<span class="close-x">Close</span></button>
<h4 class="modal-title">Change Passsword</h4>
</div>
<div class="modal-body">

<form method="post" action="<?php echo base_url(); ?>manage_user/change_user_password" name="change_password" id="change_password" enctype="multipart/form-data" >
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">New Password</p>
	<input type="text" name="user_password" id="user_password" value="" placeholder="password">
	<input type="hidden" name="user_password_hidden_id" id="user_password_hidden_id" value="">
	<input type="hidden" name="user_password_hidden_name" id="user_password_hidden_name" value="">
	<input type="hidden" name="user_password_hidden_email" id="user_password_hidden_email" value="">
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12 pad_top_20">
<input class="btn btn-success" name="password_user" id="password_user" value="Save" type="submit"/> 
<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true" onclick="modal_close_password()"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</form>

</div>

<script>
var user_image_file = "valid";
var user_id_file = "valid";
jQuery(document).ready(function(){
	
	$('#demo-1 .simpleLens-big-image').simpleLens({
            loading_image: 'images/loading.gif'
        });
		
		 /* $('#demo-2 .simpleLens-big-image').simpleLens({
            loading_image: 'images/loading.gif'
        }); */ 
	
	
	
	$(".mobile_input").keydown(function (e) {
       // alert(value);
        //keycode fr dot is 190
        // Allow: backspace, delete, tab, escape, enter and 
        if ($.inArray(e.keyCode, [16,61,187,46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.shiftKey === true || e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
     
    $(".mobile_input").keyup(function(){
        var value = $(this).val();
        value = value.replace(/^(0*)/,"");
        $(this).val(value);
    });
	
$('.alert-success').delay(3000).fadeOut('slow');



jQuery(document).on('click','#submit1', function(e){

	if($("form[name='add_user']").valid())
	{
		if(user_image_file == "valid" && user_id_file == "valid")
		{

		$("#submit1").button('loading');
		$('#add_user').submit();
		}
		else{
			alert('You have choosen invalid file type! please select valid image');
			return false;
		}
	}
	

});

jQuery(document).on('click','#password_user', function(e){
	if($("form[name='change_password']").valid())
	{
		$("#password_user").button('loading');
	}
	

});		



$("form[name='change_password']").validate({
        // Specify validation rules
		ignore: [],
              debug: false,
       rules: {
            user_password: {
                required: true
            }
        },
        messages: {
			user_password: {
                required: "Please enter the new password..!"
            }
        }
    });


});

</script>
<script>
function load_user_image(input) {
	var ext = $('#user_image').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
    alert('invalid file type. png , jpeg are only allowed !');
	 user_image_file = "invalid";
	 $('#user_image').val("");
	 jQuery('#upload_image1').attr('src', '');
	 jQuery('#user_hid_image').val('');
	 $('#user_image').valid();
	
}
else{
	
	 user_image_file = "valid";
	
	
	if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                jQuery('#upload_image1').attr('src', e.target.result);
				//jQuery('#obj_img').attr('data', e.target.result);
				
				jQuery('#user_hid_image').val(e.target.result);
				 $('#user_image').valid();
				
            };

            reader.readAsDataURL(input.files[0]);
        }
	
      }
        
    }
	
	function load_id_image(input) {
	var ext = $('#user_id_image').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
    alert('invalid file type. png , jpeg are only allowed !');
	 user_id_file = "invalid";
	 $('#user_id_image').val("");
	 jQuery('#upload_id_image1').attr('src', '');
	 jQuery('#user_id_hid_image').val('');
	 $('.simpleLens-lens-image').attr('data-lens-image', '');
	 $('#user_id_image').valid();
	
}
else{
	
	 user_id_file = "valid";
	
	
	if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                jQuery('#upload_id_image1').attr('src', e.target.result);
				//jQuery('#obj_img').attr('data', e.target.result);
				
				$('.simpleLens-lens-image').attr('data-lens-image', e.target.result);
				
				jQuery('#user_id_hid_image').val(e.target.result);
				$('#user_id_image').valid();
				
            };

            reader.readAsDataURL(input.files[0]);
        }
	
}
        
    }
</script>

</div>
</div>
</div>
