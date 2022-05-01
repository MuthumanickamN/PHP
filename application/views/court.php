<script src="<?php echo base_url(); ?>assets_booking/js/court.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<section class="content-header">
<h1>Manage Court</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker" aria-hidden="true"></i> Manage Court</li>
<li class="active">Add Court</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<div class="col-sm-12 col-md-12 add_button"><button type="button"  data-toggle="modal" data-target="#editModal" class="btn btn-success pull-right add_court"><i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; Add New Court</button>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
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
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped">
	<thead>
		<tr>
            <th>S.No</th>
			<th>Sports</th>
			<th>Location</th>
			<th>Court</th>
			<th class="no-sort">Edit</th>
			<th class="no-sort">Status</th>
		</tr>
	</thead>
        <tbody>
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script type="text/javascript">
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
	"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": false,
"autoWidth": true
});
});
</script>
<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close close-icon" data-dismiss="modal" aria-hidden="true">&times;<span class="close-x">Close</span></button>
<h4 class="modal-title">Edit / Add New Court</h4>
</div>
<div class="modal-body">
<form method="post"  action="<?php echo $form_action; ?>" name="add_court" id="add_court" enctype="multipart/form-data" >   
    <input type="hidden" id="hidden_id" name="hidden_id" value="" /> 
    <div class="col-sm-12 col-md-6">
    <p class="form_text1">Activities</p>
    <select name="sports_id" id="sports_id">
        <option value="">Select Activity</option> 
         <?php foreach($sports_list as $key => $sports) { ?>
        <option value="<?php echo $sports['id']; ?>"><?php echo $sports['sportsname']; ?></option>
        <?php } ?>
    </select>
    </div>
    <div class="col-sm-12 col-md-6">
    <p class="form_text1">Location</p>
    <select name="location_id" id="location_id">
        <option value="">Select Location</option>
        <?php foreach($location_list as $key => $location) { ?>
        <option value="<?php echo $location['id']; ?>"><?php echo $location['location']; ?></option>
        <?php } ?>
    </select>
    </div>
	
    <div class="col-sm-12 col-md-6">
    <p class="form_text1">Court</p>
    <input type="text" id="court_name" name="court_name" value="" placeholder="Egyptian Club in Oudmetha Road">
    </div>
	<div class="col-sm-12 col-md-6">
    <p class="form_text1">Type</p>
    <select name="court_type" id="court_type">
        <option value="">Select Type</option>
       <option value="1">Indoor</option>
	   <option value="2">Outdoor</option>
    </select>
    </div>
	 <div class="col-sm-12 col-md-6">
    <!--<p class="form_text1">Timings</p>
    <input type="text" id="court_timings" name="court_timings" value="" placeholder="5.00 AM - 12.00 AM">-->
	<p class="form_text1">From</p>
	<div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker1" name="timepicker1" type="text" class="form-control input-small" value="" readonly>
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
    </div>
	<div class="col-sm-12 col-md-6">
    <!--<p class="form_text1">Timings</p>
    <input type="text" id="court_timings" name="court_timings" value="" placeholder="5.00 AM - 12.00 AM">-->
	<p class="form_text1">To</p>
	<div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker2" name="timepicker2" type="text" class="form-control input-small" value="" readonly>
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
    </div>
	 <div class="col-sm-12 col-md-12">
    <p class="form_text1">Address</p>
	 <textarea id="court_address" name="court_address" rows="2" cols="25" class="textarea_input"></textarea> 
     </div>
	 <div class="col-sm-12 col-md-12">
    <p class="form_text1">Location Map</p>
	 <textarea id="court_location_map" name="court_location_map" rows="2" cols="25" class="textarea_input"></textarea> 
     </div>
	 <div id="ad_inf" class="col-sm-12 col-md-12">
    <p class="form_text1">Add info</p>
	 <textarea id="court_add_info" name="court_add_info"  rows="2" cols="25" class="textarea_input txtarea"></textarea> 
     </div>
	 <div class="col-sm-12 col-md-12">
	 <input type="hidden" name="image_hidden" id="image_hidden" value="">
    <p class="form_text1">Court Image</p>
	 <input type="file" onchange="LoadImage(this)" id="court_file" name="court_file" class="textarea_input" value="">
     </div>
	 <div class="col-sm-12 col-md-12 pad_top_20">
	 <img src="" id="courtimage"  alt="" height="80" width="80">
     </div>
	 
    <div class="clearfix"></div>
    <div class="col-sm-12 col-md-12 pad_top_20">
        <input class="btn btn-success" name="submit1" id="submit1" value="Save" type="submit"/> 
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true">
        <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
    </div>
    <div class="clearfix"></div>
</form>
</div>


<script type="text/javascript">
var file = "valid";
function LoadImage(input) {
	var ext = $('#court_file').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
    alert('invalid file type. png , jpeg are only allowed !');
	 file = "invalid";
	// return false;
	
}
else{
	
	 file = "valid";
	
	
	    if (input.files && input.files[0]) {
			var reader = new FileReader();
            reader.onload = function(e) {
                jQuery('#courtimage').attr('src', e.target.result);
				jQuery('#image_hidden').val(e.target.result);
		   };
            reader.readAsDataURL(input.files[0]);
        }
    }
}
$(function () {
	
	$('.alert-success').delay(3000).fadeOut('slow');
	CKEDITOR.replace('court_add_info');
	CKEDITOR.instances.court_add_info.updateElement();
	// for popup ck editor problem
	$.fn.modal.Constructor.prototype.enforceFocus = function() {
			modal_this = this
			$(document).on('shown.bs.modal', function (e) {
			if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
			&& !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
			&& !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
			  modal_this.$element.focus()
			}
		  })
      };

});

</script>
</div>
</div>
</div>
