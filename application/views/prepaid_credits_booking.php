<section class="content-header">
<h1>Prepaid Credits</h1>
<ol class="breadcrumb">
<li><i class="fa fa-user" aria-hidden="true"></i> Manage Users</li>
<li class="active">Prepaid Credits</li>
</ol>
</section>
<!--start auto complete-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery-ui-1.10.3.custom.min.css">
        <script src="<?php echo base_url(); ?>assets_booking/libraries/jquery-ui-1.10.3.custom.min.js"></script>
		
		
		
	    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.7/css/tableexport.css">	
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.7/js/tableexport.js"></script>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Base64/1.0.0/base64.min.js"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/excel/jquery.btechco.excelexport.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/excel/jquery.base64.js"></script>-->
		
		<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/excel/excel.js"></script>
		
		
		<!--end auto complete-->
		
		
		
        

<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
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
<ul id="tabs" class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#sectionA">Recharging Wallet</a></li>
<li><a data-toggle="tab" href="#sectionB">User List</a></li>
<li><a data-toggle="tab" href="#sectionC">Recharge History</a></li>
</ul>
<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active">

<form method="post" action="" onsubmit="return false;" name="customer_number_fetch" id="customer_number_fetch" enctype="multipart/form-data" >
	<h4>Recharge user account</h4>
	<div class="col-sm-12 col-md-4 col-lg-5 pad_top_20">
		<input type="text" name="customer_email" id="customer_email" placeholder="Enter Customer Email">
	</div>
	<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
		<input type="submit" id="fetch" class="btn btn-primary" value="Fetch">
	</div>
	<div class="clearfix"></div>
	</form>
	
	
	
	<div id="hide1" style="display: none;">
	<form method="post" action="<?php echo base_url(); ?>prepaid_credits_booking/recharge_process" name="recharge_form" id="recharge_form" enctype="multipart/form-data" >
		<div class="col-sm-12 col-md-6">
		<input type="hidden" name="cus_hid" id="cus_hid" value="">
		<input type="hidden" name="wal_hid" id="wal_hid" value="">
			<p class="form_text1">Customer Name</p>
			<input type="text" name="customer_name" id="customer_name" value="" readonly>
		</div>
		<div class="col-sm-12 col-md-6">
			<p class="form_text1">Customer Email</p>
			<input type="text" name="customer_email_field" id="customer_email_field" value="" readonly>
		</div>
		<div class="col-sm-12 col-md-6">
			<p class="form_text1">Balance Credits (AED)</p>
			<input type="text" name="balance_credits" id="balance_credits" value="" readonly>
		</div>
		<!--<div class="col-sm-12 col-md-6">
		<p class="form_text1">Date</p>
		<input type="text" class="date-picker" name="datepicker2" id="datepicker2">
	</div>-->
		<!--<div class="col-sm-12 col-md-6">
			<p class="form_text1">Recharge Credits</p>
			<input type="text" name="recharge_credits" id="recharge_credits" value="">
		</div>-->
		<div class="col-sm-12 col-md-6">
			<p class="form_text1">Amount Paid (AED) <span class="small">(Inclusive of 5% VAT)</span></p>
                        <input type="text" class="numeric_input" name="amount_paid" id="amount_paid" value="">
		</div>
		<!--<div class="col-sm-12 col-md-6">
			<p class="form_text1">Payment Type</p>
			<label>
			<input type="radio" name="type" value="1">Cash</label> &nbsp; <label>
			<input type="radio" name="type" value="2">Card</label> &nbsp; <label>
			<input type="radio" name="type" value="3">Online</label>
		</div>-->
		<div class="col-sm-12 col-md-12 pad_top_20">
			<input type="submit" name="submit_recharge" id="submit_recharge" class="btn btn-success" value="Rechage Now!">
		</div>
		</form>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<div id="sectionB" class="tab-pane fade in" id="tab111">
	<h4>All Users List</h4>
	<div class="table-responsive">
		<table id="example2" class="table table-bordered table-striped">
			<thead>
				<tr class="noExl">
				    <th>S.No</th>
					<th>Member</th>
					<th>Mobile</th>
					<th>Balance (AED)</th>
					<!--<th>Last Transaction</th>-->
				</tr>
			</thead>
			<tbody>
				<!--<tr>
					<td>Rajkumar</td>
					<td>507649410</td>
					<td>60</td>
					<td>Nill</td>
				</tr>-->
			</tbody>
		</table>
	</div>
	<div class="col-sm-12 col-md-12 pad_top_20">
	<!--<a href="#" onClick ="$('#example2').tableExport({type:'excel',escape:'false'});">Export Data</a>-->
		<button type="button" id="export_excel_button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
		
	</div>
	<div class="clearfix"></div>
</div>
<div id="sectionC" class="tab-pane fade in">
<form method="post" name="recharge_history" id="recharge_history" action="" onsubmit="return false;" enctype="multipart/form-data"> 
	<h4>Recharge History</h4>
	<div class="col-sm-12 col-md-4">
		<p class="form_text1">From</p>
		<input type="text" class="date-picker" name="datepicker" id="datepicker">
	</div>
	<div class="col-sm-12 col-md-4">
		<p class="form_text1">To</p>
		<input type="text" class="date-picker" name="datepicker1" id="datepicker1">
	</div>
	<div class="col-sm-12 col-md-4">
		<p class="form_text1">&nbsp;</p>
		<input type="submit" id="fetch1" class="btn btn-primary" value="Fetch">
	</div>
	
	</form>
	<div class="clearfix"></div>
	<div id="hide2" class="pad_top_20" style="display: none;">
		<!--<div class="col-sm-4 col-md-4">
			<h4><strong>Cash : <span id="cash"> </span></strong></h4>
		</div>
		<div class="col-sm-4 col-md-4">
			<h4><strong>Card : <span id="card"> </span></strong></h4>
		</div>
		<div class="col-sm-4 col-md-4">
			<h4><strong>Total : <span id="total"> </span></strong></h4>
		</div>-->
		<div class="clearfix"></div>
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr class="noExl1">
					    <th>S.No</th>
						<th>Recharged On</th>
						<th>Amount Paid (AED)</th>
						<th>Credits (AED)</th>
						<th>Name</th>
						<th>Mobile</th>
						<!--<th>Mode</th>-->
						<!--<th>Place</th>-->
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			<div class="clearfix"></div>
		</div>
		<div class="col-sm-12 col-md-12 pad_top_20">
			<button type="button" id="export_excel_button1" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/js/prepaid_credits_booking.js"></script>
<script type="text/javascript">
$(function () {
	$('.alert-success').delay(3000).fadeOut('slow');
/* $("#example1").DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
}); */
$('#example2').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});
});
</script>
<script type="text/javascript">
$(function(){
 
   $("#export_excel_button").click(function(){

  $("#example2").table2excel({

    // exclude CSS class

    exclude:".noExl",

    name:"Worksheet Name",

    filename:"SomeFile" //do not include extension

  });

});

$("#export_excel_button1").click(function(){

  $("#example1").table2excel({

    // exclude CSS class

    exclude:".noExl1",

    name:"Worksheet Name",

    filename:"SomeFile" //do not include extension

  });

});
   
 
   });
 </script>

<!-- Bootstrap Date Picker -->

<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker, #datepicker1').datepicker({
autoclose: true
}).on("changeDate", function(e){
	//$('#datepicker2').valid();	
});


});
</script>
</body>
</html>