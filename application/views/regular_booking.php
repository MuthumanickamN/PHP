<script src="<?php echo base_url(); ?>assets_booking/js/regular_booking.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/libraries/cookie.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<script src="<?php echo base_url(); ?>assets_booking/libraries/jquery-ui-1.10.3.custom.min.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Regular Booking</h1>
<ol class="breadcrumb">
<li><i class="fa fa-file-text-o" aria-hidden="true"></i> Schedule</li>
<li class="active">Regular Booking</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<h3 class="mar_0">View Availability</h3>
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
<form action="<?php echo $form_action; ?>" name="regular_booking" id="regular_booking" method="post">
    <input type="hidden" name="hidden_slot_ids" id="hidden_slot_ids" value="">
<div class="col-sm-12 col-md-3">
<p class="form_text1">Select Sport</p>
<select name="sports" id="sports">
	<option value="">- Select Sport -</option>
	<?php foreach($sports_list as $key => $sports) { ?>
        <option value="<?php echo $sports['id']; ?>" ><?php echo $sports['sportsname']; ?></option>
        <?php } ?>
</select>
</div>
<div class="col-sm-12 col-md-3">
<p class="form_text1">Select Location</p>
<select name="location" id="location">
    <option value=''>- Select Location -</option>
</select>
</div>

<div class="col-sm-12 col-md-3">
<p class="form_text1">Date (dd-mm-yyyy)</p>
<input type="text" class="date-picker" id="datepicker" name="slot_date" value="">
</div>
<div class="col-sm-12 col-md-3">
<p class="form_text1">&nbsp;</p>
<button type="button" id="slots" class="btn btn-primary">Show Slots</button>
</div>
<div class="clearfix"></div>
<div id="hide1" style="display: none;">
    <div class="pull-right"><img  src="<?php echo base_url(); ?>assets_booking/images/status_image.png" alt="Notes" title="Notes"></div>
    <div class="clearfix"></div>
<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
		<tbody></tbody>
	</table>
</div>
<div class="clearfix"></div>
</div>

<div id="hide2" class="border_box" style="display: none;">
<h4>Booking Summary</h4>
<div class="table-responsive">
    
        <input type="hidden" name="hidden_total_price" id="hidden_total_price" value="">
        
        <input type="hidden" name="hidden_gross_amount" id="hidden_gross_amount" value="">
        <input type="hidden" name="hidden_net_amount" id="hidden_net_amount" value="">
        <input type="hidden" name="hidden_balance_amount" id="hidden_balance_amount" value="">
        <table id="example3" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Activity</th>
                                <th>Date</th>
				<th>Time</th>
                                <th>Location</th>
				<th>Court</th>
				<th>Price</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>			
			<tr>
                            <td colspan="7" class="total"><button type="button" title="Checkout" id="checkout" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-ok"></i> &nbsp; Checkout</button> Total : <span id="total_price"><strong></strong></span></td>
			</tr>
		</tbody>
	</table>
    
</div>
<div class="clearfix"></div>
</div>
<div id="hide3" class="border_box" style="display: none;">
<h4>Make Booking</h4>
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
		<tr>
				<td>&nbsp;</td>
                                <td colspan="3"><button type="button" title="Cancel" class="btn btn-danger pull-left btn-cancel">Cancel</button> <button type="submit" title="Book" class="btn btn-warning pull-right">Book</button></td>
		</tr>
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</form>    
<div class="clearfix"></div>
</section>

<div id="viewModal" class="modal fade"></div>

<script>
$(function () { $("[data-toggle = 'tooltip']").tooltip({html: true}); });
</script>

<!-- View Modal HTML -->