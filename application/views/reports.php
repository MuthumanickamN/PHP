<?php error_reporting(E_ALL);
ini_set("display_errors", 1); ?><script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/excel/excel.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/js/reports.js"></script>
<section class="content-header">
<h1>Reports</h1>
<ol class="breadcrumb">
<li><i class="fa fa-line-chart" aria-hidden="true"></i> Measure</li>
<li class="active">Reports</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<h3 class="mar_0">Generate Report for</h3>
<ul id="tabs" class="nav nav-tabs mar_top_20">
<li class="active"><a data-toggle="tab" href="#sectionA">Transaction</a></li>
<li><a data-toggle="tab" href="#sectionB">Booking</a></li>
<li><a data-toggle="tab" href="#sectionC">Cancellation</a></li>
</ul>
<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active">
	<div class="col-sm-12 col-md-6">
		<h4>Login</h4>
		<select class="form-control" id="adminSelect">
		 <option value="All">All</option>
	<?php
	if($user_name)
	{
      foreach($user_name as  $key=>$value){ ?>
	   <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?></option>
	 <?php	
	     }
	}
?>
	</select>
	</div>
	<div class="col-sm-12 col-md-12 mar_top_20">
<form name="transaction_search" id="transaction_search" method="post" onsubmit="return false;" action="" enctype="multipart-enctype">
		<h4>Range</h4>
		<p><input type="checkbox" id="single" /> Single Day</p>
		<div class="col-sm-12 col-md-6 pad_lef_0">
			<p class="form_text1" id="from">From</p>
			<input type="text" class="date-picker" name="datepicker" id="datepicker">
		</div>
		<div class="col-sm-12 col-md-6 pad_lef_0" id="hide1">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="datepicker1" id="datepicker1">
		</div>

	</div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
		<button type="submit" class="btn btn-primary" name="transaction_generate" id="transaction_generate">Generate</button>
	</div>
</form>
	<div class="col-sm-12 col-md-12"><hr></div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-12">
		<!--<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Total Cash / Card</th>
						<th>Total Credit</th>
						<th>Total Debit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>2400</td>
						<td>0</td>
						<td>780</td>
					</tr>
				</tbody>
			</table>
		</div>-->
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered no-warp">
				<thead>
					<tr>
					    <th>S.No</th>
						<th>Date</th>
						<th>Days</th>
						<th>From Time</th>
						<th>To Time</th>
						<th>Location</th>
						<th>Type</th>
						<th>Booking ID</th>
						<th>Sport</th>
						<th>Name</th>
						<th>Mobile</th>
						<!--<th>Email</th>-->
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12 pad_top_20">
		<button type="button" id="transaction_search_excel" name="transaction_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	<div class="clearfix"></div>
</div>
<div id="sectionB" class="tab-pane fade in">

<form name="booking_search" id="booking_search" method="post" onsubmit="return false;" action="" enctype="multipart-enctype">
	<div class="col-sm-12 col-md-12">
		<h4>Range</h4>
		<p><input type="checkbox" id="single1" /> Single Day</p>
		<div class="col-sm-12 col-md-6 pad_lef_0">
			<p class="form_text1" id="from1">From</p>
			<input type="text" class="date-picker" name="datepicker2" id="datepicker2">
		</div>
		<div class="col-sm-12 col-md-6 pad_lef_0" id="hide2">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="datepicker3" id="datepicker3">
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-12 col-md-6 pad_lef_0">
			<!--<p class="form_text1"><input type="checkbox" name=""> Show bookings made for date range?</p>-->
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
		<button type="submit" name="booking_generate" id="booking_generate"  class="btn btn-primary" >Generate</button>
	</div>
</form>
	<div class="clearfix"></div>

	<div class="col-sm-12 col-md-12"><hr></div>
	<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<!--<table class="table table-bordered">
				<thead>
					<tr>
						<th>Total Cash</th>
						<th>Total Credits</th>
						<th>Total Card</th>
						<th>Booking Grand Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>2400</td>
						<td>0</td>
						<td>780</td>
						<td>2400</td>
					</tr>
				</tbody>
			</table>-->
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="example2" class="table table-bordered no-warp">
				<thead>
					<tr>
						<!--<th>Timestamp</th>-->
						<th>S.No</th>
						<th>Date</th>
						<th>Days</th>
						<th>From Time</th>
						<th>To Time</th>
						<!--<th>Time</th>-->
						<th>Booking ID</th>
						<th>Location</th>
						<th>Sport</th>
						<!--<th>Court</th>-->
						<th>Type</th>
						<th>Gross</th>
						<th>Discount</th>
						<th>Net Amt</th>
						<th>Paid Amt</th>
						<th>Name</th>
						<th>Mobile</th>
						<!--<th>Email</th>-->
						<!--<th>Handler</th>-->
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12 pad_top_20">
		<button type="button" id="booking_search_excel" name="booking_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	<div class="clearfix"></div>
</div>
<div id="sectionC" class="tab-pane fade in">

<form name="cancellation_search" id="cancellation_search" method="post" action="" enctype="multipart-enctype">
	<div class="col-sm-12 col-md-12">
		<h4>Range</h4>
		<p><input type="checkbox" id="single2" /> Single Day</p>
		<div class="col-sm-12 col-md-6 pad_lef_0">
			<p class="form_text1" id="from2">From</p>
			<input type="text" class="date-picker" name="datepicker4" id="datepicker4">
		</div>
		<div class="col-sm-12 col-md-6 pad_lef_0" id="hide3">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="datepicker5" id="datepicker5">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
		<button type="button" name="cancellation_generate" id="cancellation_generate" class="btn btn-primary" id="generate">Generate</button>
	</div>
</form>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-12"><hr></div>
	<div class="col-sm-12 col-md-12">
		<!--<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Total Refunds</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>780</td>
					</tr>
				</tbody>
			</table>
		</div>-->
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="example3" class="table table-bordered no-warp">
				<thead>
					<tr>
					    <th>S.No</th>
						<th>Cancelled On</th>
						<!--<th>Booked Slot</th>-->
						<!--<th>Mode</th>-->
						<th>Type</th>
						<th>Booking ID</th>
						<th>Paid</th>
						<!--<th>Refund</th>-->
						<th>Sport</th>
						<!--<th>Court</th>-->
						<th>Name</th>
						<th>Mobile</th>
						<!--<th>Handler</th>-->
					</tr>
				</thead>
				<tbody>
	
					
				</tbody>
			</table>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12 pad_top_20">
		<button type="button" id="cancellation_search_excel" name="cancellation_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<!-- AdminLTE for demo purposes -->


<script type="text/javascript">
$(function () {
/* $('#example1').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			}); */
/* $('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			});
$('#example3').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
}); */
});
</script>

<!--<script type="text/javascript">
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});
$('#example3').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});
});
</script>-->
<script type="text/javascript">
$(document).ready(function(){
$('#single').click(function(){
$("#hide1").toggle("slow");
$('#from').html($('#from').text() == 'On' ? 'From' : 'On');
});
$('#single1').click(function(){
$("#hide2").toggle("slow");
$('#from1').html($('#from1').text() == 'On' ? 'From' : 'On');
});
$('#single2').click(function(){
$("#hide3").toggle("slow");
$('#from2').html($('#from2').text() == 'On' ? 'From' : 'On');
});
});
</script>
<!-- Bootstrap Date Picker -->

<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker, #datepicker1, #datepicker2, #datepicker3, #datepicker4, #datepicker5').datepicker({
autoclose: true
});
});
</script>
<script type="text/javascript">
$(function(){
 
   $("#transaction_search_excel").click(function(){
	   var d = new Date();
       var n = d.getTime();

  $("#example1").table2excel({

    // exclude CSS class

    exclude:".noExl",

    name:"Worksheet Name",

    filename:"transaction_history_"+n //do not include extension

  });

});


$("#booking_search_excel").click(function(){
	   var d = new Date();
       var n = d.getTime();

  $("#example2").table2excel({

    // exclude CSS class

    exclude:".noExl",

    name:"Worksheet Name",

    filename:"booking_history_"+n //do not include extension

  });

});

$("#cancellation_search_excel").click(function(){
	   var d = new Date();
       var n = d.getTime();

  $("#example3").table2excel({

    // exclude CSS class

    exclude:".noExl",

    name:"Worksheet Name",

    filename:"cancellation_history_"+n //do not include extension

  });

});

});
</script>