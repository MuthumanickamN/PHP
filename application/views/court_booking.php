<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<style rel="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></style>
  <style rel="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"></style>
  
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" ></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


<script src="<?php echo base_url(); ?>assets_booking/js/court_booking.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/libraries/cookie.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<script src="<?php echo base_url(); ?>assets_booking/libraries/jquery-ui-1.10.3.custom.min.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Court Booking</h1>
<ol class="breadcrumb">
<li><i class="fa fa-file-text-o" aria-hidden="true"></i> Schedule</li>
<li class="active">Court Booking</li>
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
<form action="<?php echo $form_action; ?>" name="Court_booking" id="Court_booking" method="post" autocomplete="off">
    <input type="hidden" name="hidden_slot_ids" id="hidden_slot_ids" value="" >
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
<p class="form_text1">Select Customer</p>
<select name="parent_id" id="parent_id" class="form-control parent_id"  required="">
	<option value="0">Select</option>
	<?php

	$osql = "select * from parent WHERE status='Active'";                              
	$oexe = $this->db->query( $osql )->result_array();


	foreach ( $oexe as $key => $row ){ ?>
<option data-code="<?php echo $row['parent_code'] ?>" value="<?php echo $row['parent_id'] ?>" <?php if($row['parent_id']==$parent_id ){ echo 'selected';} ?>><?php echo $row['parent_code']; ?>-<?php echo $row['mobile_no']; ?>
		
	</option><?php
	
		}  ?></select>
</div>


<div class="col-sm-12 col-md-1">
<p class="form_text1">&nbsp;</p>
<button type="button" id="slots" class="btn btn-primary">Show Slots</button>
</div>

<div class="col-sm-12 col-md-1">
<p class="form_text1">&nbsp;</p>
<button type="button" id="show_cart" class="btn btn-success" style="display:none;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</button>
</div>

<div class="clearfix"></div>

<div class="row calendarDiv">
	<div class="col-md-12">
		<div id="calendar">
		</div>
	</div>
</div>

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
        <input type="hidden" name="hidden_vat_amount" id="hidden_vat_amount" value="5.00">
        <input type="hidden" name="hidden_vat_perc" id="hidden_vat_perc" value="">
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
			
		</tbody>
		<tfoot>
			<tr>
                <td colspan="7" class="total"><button type="button" title="Checkout" id="checkout" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-ok"></i> &nbsp; Checkout</button> Total : <span id="total_price"><strong></strong></span></td>
			</tr>
		</tfoot>
	</table>
    
</div>
<div class="clearfix"></div>
</div>
<div id="hide3" class="border_box" style="display: none;">
<h4>Make Booking</h4>
<div class="col-sm-12 col-md-6">
	<p class="form_text1">Customer Email</p>
	<input type="text" name="customer_email" id="customer_email" placeholder="Enter Customer Email" value="" readonly>
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
<div class="col-sm-12 col-md-3">
	<p class="form_text1">Customer Wallet Amount</p>
	<input type="text" name="customer_wallet_amount" id="customer_wallet_amount" value="" readonly>
</div>
<div class="col-sm-12 col-md-3">
	<p class="form_text1">Booking For</p>
	<input type="text" name="booking_for" id="Booking_for" value="" >
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
					<td><strong>Vat Percentage</strong><br/>
										<span class="small">(%)</span></td>
					<td id="vat_perc">5%</td>
						<td><strong>Vat Amount</strong></td>
						<td id="vat_amount"></td>
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

<div id="viewModal" class="modal fade">


</div>

<div id="addModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="display: none; ">
    <div class="modal-dialog" style="width: 100%; margin-top: 100px">
  <div class="modal-content" style="width: 100%">
      <div class="modal-body" style="width: 100%">
        <div class="alert alert-info">
          <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#addModal').hide();">&times;</button>
        
        <strong>Time Slot on<input type="text" name="show_date" id="show_date" style="border:0; background-color:#d9edf7"></strong>
        </div>
        <div class="alert alert-info">
     <h4></h4>
     <table id="slotSelection" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color: white" >
    
  </table>
   <br>
   
       
    </div>
  </div>
</div>
</div>
<script>
$(function () { $("[data-toggle = 'tooltip']").tooltip({html: true}); });
</script>

<!-- View Modal HTML -->