<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Generate Coupons</h1>
<ol class="breadcrumb">
<li><i class="fa fa-ticket" aria-hidden="true"></i> Promote</li>
<li class="active">Generate Coupons</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<h3 class="mar_0">Generate Coupons</h3>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Select Activity</p>
<select name="activity">
	<option selected="">- Select Activity -</option>
	<option>Badminton</option>
	<option>Tennis</option>
	<option>Basketball</option>
</select>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12"><h4 class="pad_top_0">Date</h4></div>
<div class="col-sm-12 col-md-6">
<p><input type="checkbox" id="single"> Single Day</p>
<div class="col-sm-12 col-md-6 pad_le_ri_0">
	<input type="text" class="date-picker" id="datepicker">
</div>
<div class="col-sm-12 col-md-1 hide_single">
	<p class="pad_top_10 text-center">to</p>
</div>
<div class="col-sm-12 col-md-5 pad_le_ri_0 hide_single">
	<input type="text" class="date-picker" id="datepicker1">
</div>
<div class="clearfix"></div>
</div>
<div class="col-sm-12 col-md-6 hide_single">
<p>Select Day</p>
<select id="day" multiple="multiple" name="day">
	<option>Monday</option>
	<option>Tuesday</option>
	<option>Wednesday</option>
	<option>Thusday</option>
	<option>Friday</option>
	<option>Saturday</option>
	<option>Sunday</option>
</select>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12"><h4 class="pad_top_0">Time</h4></div>
<div class="col-sm-12 col-md-6">
<div class="col-sm-12 col-md-6 pad_lef_0"><p><input type="checkbox" id="slots" /> All Slots</p></div>
<div class="col-sm-12 col-md-6 pad_lef_0"><p><input type="checkbox" /> Applicable to more than 1 slot</p></div>
<div class="clearfix"></div>
<div id="hide1">
	<div class="col-sm-12 col-md-6 pad_le_ri_0">
		<div class="input-group bootstrap-timepicker timepicker">
			<input id="timepicker1" type="text" class="form-control input-small">
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>
	<div class="col-sm-12 col-md-1">
		<p class="pad_top_10 text-center">to</p>
	</div>
	<div class="col-sm-12 col-md-5 pad_le_ri_0">
		<div class="input-group bootstrap-timepicker timepicker">
			<input id="timepicker2" type="text" class="form-control input-small">
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12"><h4 class="pad_top_0">Type</h4></div>
<div class="col-sm-12 col-md-6">
<div class="col-sm-12 col-md-6 pad_lef_0"><p><label><input type="radio" name="type" id="cash" checked="" /> Cash Discount</label></p>
<input type="text" id="cash_show" placeholder="Enter Amount" name="">
</div>
<div class="col-sm-12 col-md-6 pad_lef_0"><p><label><input type="radio" name="type" id="percentage" /> Percentage Discount</label></p>
<div id="percentage_show" style="display: none;">
<div class="col-sm-12 col-md-5 pad_le_ri_0 mar_bot_20"><input type="text" name="" placeholder="Percentage"></div>
<div class="col-sm-12 col-md-5 pad_le_ri_0 pull-right"><input type="text" name="" placeholder="Upper Limit"></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12"><h4 class="pad_top_0">Permanent</h4></div>
<div class="col-sm-12 col-md-6">
<p><input type="checkbox" id="yes" /> <strong>Yes</strong> &nbsp; <span class="color_red">** If yes, coupon can be used multiple times over specified period**</span></p>
<div id="hide2" style="display: none;">
<div class="col-sm-12 col-md-12 pad_le_ri_0"><p class="form_text1">Max usage</p>
<input type="text" placeholder="1" name="">
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Remarks</p>
<input type="text" placeholder="Coupon Remarks">
</div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Email</p>
<input type="text" placeholder="Send Coupons to this Email">
</div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Coupon Count</p>
<input type="text" placeholder="No of Coupons to Generage">
</div>
<div class="col-sm-12 col-md-12 pad_top_20">
<button type="button" class="btn btn-success"><i class="fa fa-ticket" aria-hidden="true"></i> &nbsp; Generate Coupon</button>
</div>
<div class="clearfix"></div>
</section>


<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker, #datepicker1').datepicker({
autoclose: true
});
});
</script>
<script>
$(function () { $("[data-toggle = 'tooltip']").tooltip({html: true}); });
</script>
<!-- Include the plugin's for Multiselect: -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#court').multiselect({
enableClickableOptGroups: true,
enableCollapsibleOptGroups: true,
enableFiltering: false,
includeSelectAllOption: true
});
$('#day').multiselect({
enableClickableOptGroups: true,
enableCollapsibleOptGroups: true,
enableFiltering: false,
includeSelectAllOption: true
});
});
</script>
<!-- Include the plugin's for Timepicker: -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
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
$('#single').click(function(){
$(".hide_single").toggle("slow");
});
$('#slots').click(function(){
$("#hide1").toggle("slow");
});
$('#percentage').click(function(){
$("#cash_show").hide("slow");
$("#percentage_show").show("slow");
});
$('#cash').click(function(){
$("#cash_show").show("slow");
$("#percentage_show").hide("slow");
});
$('#yes').click(function(){
$("#hide2").toggle("slow");
});
});
</script>
<!-- View Modal HTML -->
<div id="viewModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Bulk Booking Info</h4>
</div>
<div class="modal-body">
<p class="form_text1">Remarks</p>
<textarea name="remarks"></textarea>
<div class="clearfix"></div>
<div class="mar_top_20"><input class="btn btn-primary" name="submit1" id="submit1" value="Update" type="submit"/> &nbsp;
<input class="btn btn-primary" name="reset1" id="reset1" value="Reset" type="reset"/> <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
