<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="<?php echo base_url() . 'assets/view_js/reports.js' ?>"></script>
<div id="active_admin_content" class="without_sidebar">
<div id="main_content_wrapper">
	<div id="main_content">
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-size: 14px !important;">
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Booking_slot">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Booking_reports">Reports</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Recharge_history">Recharge History</a></li>
			</ol>
			</nav>
		<div class="content-body">
		<!-- Zero configuration table -->
		<section id="configuration" class="dashboard">
			<div class="row">
			<div class="col-12">
			<h4 class="heading1">Reports</h4>
			<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
			</div>
			<div class="col-12">
			  <ul id="tabs" class="nav nav-tabs mar_top_20">
				<li class="active"><a data-toggle="tab" href="#sectionA">Transaction History</a></li>
				<li><a data-toggle="tab" href="#sectionB">Booking History</a></li>
				<li><a data-toggle="tab" href="#sectionC">Cancellation History</a></li>
			  </ul>
<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active">
	<form name="transaction_search" id="transaction_search" method="post" onsubmit="return false;" action="" enctype="multipart-enctype">
			<h1>Range</h1>
			<div class="col-sm-12 col-md-12 mar_top_20"><h5><input  id="single" type="checkbox"> Single Day</h5></div>
			<div class="col-sm-4">
				<p class="form_text1" id="from">From</p>
				<input type="text" class="date-picker" name="datepicker" id="datepicker">
			</div>
			<div class="col-sm-4" id="hide1">
				<p class="form_text1">To</p>
				<input type="text" class="date-picker" name="datepicker1" id="datepicker1">
			</div>
		<div class="col-sm-4">
		<p class="form_text1">&nbsp;</p>
			<button type="submit" class="btn btn-primary" name="transaction_generate" id="transaction_generate">Generate</button>
		</div>
	</form>
	<div class="col-sm-12 col-md-12"><hr></div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-12">
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
	<div class="col-sm-12 col-md-12 mar_top_20 text-right">
		<button type="button" id="transaction_search_excel" name="transaction_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	
	<div class="clearfix"></div>
    </div>
	   <div id="sectionB" class="tab-pane fade in">

<form name="booking_search" id="booking_search" method="post" onsubmit="return false;" action="" enctype="multipart-enctype">
		<h1>Range</h1>
		<div class="col-sm-12 col-md-12 mar_top_20"><h5><input type="checkbox" id="single1" /> Single Day</h5></div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<p class="form_text1" id="from1">From</p>
			<input type="text" class="date-picker" name="datepicker2" id="datepicker2">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4" id="hide2">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="datepicker3" id="datepicker3">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
        <p class="form_text1">&nbsp;</p>
			<button type="submit" name="booking_generate" id="booking_generate"  class="btn btn-primary" >Generate</button>
		</div>
	<div class="clearfix"></div>
</form>
	<div class="clearfix"></div>

	<div class="col-sm-12 col-md-12"><hr></div>
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
	<script type="text/javascript" src="<?php echo base_url() ?>/assets/libraries/excel/excel.js"></script>
	<div class="col-sm-12 col-md-12 mar_top_20 text-right">
		<button type="button" id="booking_search_excel" name="booking_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	<div class="clearfix"></div>
</div>
    <div id="sectionC" class="tab-pane fade in">
     <form name="cancellation_search" id="cancellation_search" method="post" action="" enctype="multipart-enctype">
		<h1>Range</h1>
		<div class="col-sm-12 col-md-12 mar_top_20"><h5><input type="checkbox" id="single2" /> Single Day</h5></div>
		<div class="col-sm-4">
			<p class="form_text1" id="from2">From</p>
			<input type="text" class="date-picker" name="datepicker4" id="datepicker4">
		</div>
		<div class="col-sm-4" id="hide3">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="datepicker5" id="datepicker5">
		</div>
	<div class="col-sm-4">
	<p class="form_text1">&nbsp;</p>
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
	<div class="col-sm-12 col-md-12 mar_top_20 text-right">
		<button type="button" id="cancellation_search_excel" name="cancellation_search_excel" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
	</div>
	<div class="clearfix"></div>
    </div>	
</div>
			</div>
			</div>
		</section>
		
		</div>
		</div>
	</div>
	</div>
</div>

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

/* $('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			}); */
			
			
			// booking


	
	$('#single').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker').datepicker('setDate', null);
				 $('#datepicker1').datepicker('setDate', null);
        }
           
    });
	$('#single1').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker2').datepicker('setDate', null);
				 $('#datepicker3').datepicker('setDate', null);
        }
           
    });
	$('#single2').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker4').datepicker('setDate', null);
				 $('#datepicker5').datepicker('setDate', null);
        }
           
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