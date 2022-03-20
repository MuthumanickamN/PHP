<script src="<?php echo base_url(); ?>assets_booking/js/bulk_booking.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery-ui-1.10.3.custom.min.css">
<script src="<?php echo base_url(); ?>assets_booking/libraries/jquery-ui-1.10.3.custom.min.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Bulk Booking</h1>
<ol class="breadcrumb">
<li><i class="fa fa-file-text-o" aria-hidden="true"></i> Schedule</li>
<li class="active">Bulk Booking</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<h3 class="mar_0">Bulk Booking</h3>
<div class="mar_top_20 add_button"><button type="button" id="check" class="btn btn-success pull-right">Show Bulk Bookings</button>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<?php if($this->session->flashdata('success_message')){ ?>
<div class="col-sm-12 col-md-12" id="hideMe">
<div class="alert alert-success">
<i class="fa fa-check-square" aria-hidden="true"></i>
<?php echo $this->session->flashdata('success_message'); ?>
<a href="#" class="close" data-dismiss="alert">&times;</a>
</div>
</div>
<?php } if($this->session->flashdata('error_message')){ ?>
<div class="error_message">
<?php echo $this->session->flashdata('error_message'); ?>
<a href="#" class="close" data-dismiss="alert">&times;</a>
</div>
<?php } ?>


<div id="show1" style="display: none;">
<h3 class="mar_0">Bulk Booking Details</h3>
<div class="table-responsive">
    <table class="table table-bordered table-striped text-center no-warp" id="bulk_booking_list">
		<thead>
			<tr>
				<th>Name</th>
				<th>Mobile</th>
				<th>Date</th>
				<th>Slot</th>
				<th>Days</th>
				<th>Court</th>
				<th>Gross Amt</th>
				<th>Discount</th>
				<th>Net Amt</th>
				<th>Paid</th>
				<th>Balance</th>
                                <th>Cancel Booking</th>
			</tr>
		</thead>
		<tbody>			
		</tbody>
	</table>
</div>
<div class="clearfix"></div>
</div>
<form action="<?php echo $form_action; ?>" name="bulk_booking" id="bulk_booking" method="post">
    <input type="hidden" name="hidden_form_submit_permission" id="hidden_form_submit_permission" value="">
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Select Activity</p>
<select name="sports" id="sports">
	<option value="">- Select Sport -</option>
	<?php foreach($sports_list as $key => $sports) { ?>
        <option value="<?php echo $sports['id']; ?>" ><?php echo $sports['sportsname']; ?></option>
        <?php } ?>
</select>
</div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Select Location</p>
<select name="location" id="location">
    <option value=''>- Select Location -</option>
</select>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Select Court</p>
<select name="court" id="court">
	<option value="">- Select Court -</option>       
</select>
</div>

<div class="col-sm-12 col-md-6">
<p class="form_text1">Date (dd-mm-yyyy)</p>
<div class="col-sm-12 col-md-6 pad_le_ri_0">
    <input type="text" class="date-picker" id="from_date_bulk" name="from_date_bulk" value="" readonly>
</div>
<div class="col-sm-12 col-md-1">
	<p class="pad_top_10 text-center">to</p>
</div>
<div class="col-sm-12 col-md-5 pad_le_ri_0">
	<input type="text" class="date-picker" id="to_date_bulk" name="to_date_bulk" value="" readonly>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
<p class="form_text1">Select Day</p>
<select id="day_name" name="day_name">
	<option value="">- Select From day -</option>
        <?php foreach($day_list as $key => $days) { ?>
        <option value="<?php echo $days['dayid']; ?>" ><?php echo $days['dayname']; ?></option>
        <?php } ?>
</select>
</div>

<div class="col-sm-12 col-md-6">
<p class="form_text1">Time</p>
<!--<p><input type="checkbox" id="slots" /> All Slots</p>-->
<div id="hide1">
	<div class="col-sm-12 col-md-6 pad_le_ri_0">
		<div class="input-group bootstrap-timepicker timepicker">
                    <input type="text" class="form-control input-small timepickertext" id="timepicker1" name="from_time" value="" readonly>
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>
	<div class="col-sm-12 col-md-1">
		<p class="pad_top_10 text-center">to</p>
	</div>
	<div class="col-sm-12 col-md-5 pad_le_ri_0">
		<div class="input-group bootstrap-timepicker timepicker">
			<input id="timepicker2" type="text" class="form-control input-small" id="timepicker2" name="to_time" value="" readonly>
			<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12"><p class="form_text1"><button type="button" class="btn btn-primary check_availability"><i class="glyphicon glyphicon-ok"></i> &nbsp; Check Availability and Get Pricing</button></p></div>
<div class="clearfix"></div>
<h3>Payment</h3>

<div id="hide3" class="border_box">
<h4>Make Booking</h4>

<input type="hidden" name="hidden_slot_ids" id="hidden_slot_ids" value="">
<input type="hidden" name="hidden_gross_amount" id="hidden_gross_amount" value="">
<input type="hidden" name="hidden_net_amount" id="hidden_net_amount" value="">
<input type="hidden" name="hidden_balance_amount" id="hidden_balance_amount" value="">
<div class="col-sm-12 col-md-12"><p class="form_text1 slot-count"></p></div>


<div class="col-sm-12 col-md-6">
	<p class="form_text1">Customer Email</p>
	<input type="text" name="customer_email" id="customer_email" placeholder="Enter Customer Email" value="" >
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Customer Name</p>
	<input type="text" name="customer_name" id="customer_name" value="" readonly>
        <input type="hidden" name="cus_hid" id="cus_hid" value="" />
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Customer Mobile Number</p>
        <input type="text" name="customer_mobile" id="customer_mobile" value="" readonly>
</div>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Customer Wallet Amount</p>
	<input type="text" name="customer_wallet_amount" id="customer_wallet_amount" value="" readonly>
</div>
<div class="col-sm-12 col-md-12 pad_top_20">
	<div class="table-responsive">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td><strong>Gross Amount</strong></td>
                                        <td id="gross_amount"></td>
                                        <td><strong>Discount</strong></td>
					<td><div class="col-sm-6 col-md-6"><div class="input-group">
                                                    <input class="form-control" type="hidden" name="hidden_discount_amount" id="hidden_discount_amount" value="" readonly="">
                                                    <input class="form-control numeric_input" type="text" name="discount_amount" id="discount_amount" value="">
						<div class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="discount_btn">Apply</button>
						</div>
					</div></div>
				</td>
				</tr>				
			<tr>
				<td><strong>Net Amount</strong><br/>
                                    <span class="small">(Inclusive of 5% VAT)</span></td>
				<td id="net_amount"></td>
                                <td><strong>Balance Amount</strong></td>
                                <td id="balance_amount"></td>
			</tr>
	
                        <tr>
                            <td><strong>Mode</strong></td>
                            <td><input type="checkbox" name="pay_mode" id="wallet" value="1"> Wallet</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>


<div class="col-sm-12 col-md-12 pad_top_10"><button type="submit" class="btn btn-success pull-right">Confirm Bulk Booking</button></div>
<div class="clearfix"></div>
</form>
</section>
<!-- /.content -->

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
//$('#court').multiselect({
//enableClickableOptGroups: true,
//enableCollapsibleOptGroups: true,
//enableFiltering: false,
//includeSelectAllOption: true
//});
//$('#day').multiselect({
//enableClickableOptGroups: true,
//enableCollapsibleOptGroups: true,
//enableFiltering: false,
//includeSelectAllOption: true
//});
});
</script>
<!-- Include the plugin's for Timepicker: -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$('#check').click(function(){
$("#show1").toggle("slow");
$('#check').html($('#check').text() == 'Hide Details' ? 'Show Bulk Bookings' : 'Hide Details');
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