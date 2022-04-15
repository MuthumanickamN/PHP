<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="<?php echo base_url() . 'assets/view_js/recharge_history.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/libraries/excel/excel.js"></script>
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
			<h4 class="heading1">Recharge History</h4>
			<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
			</div>
			<div class="col-12">
<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active">
<form method="post" name="recharge_history" id="recharge_history" action="" onsubmit="return false;" enctype="multipart/form-data"> 
		<h1>Range</h1>
	
		<div class="col-sm-12 col-md-4 pad_lef_0">
			<p class="form_text1" id="from">From</p>
			<input type="text" class="date-picker" name="from_date" id="from-date" required>
		</div>
		<div class="col-sm-12 col-md-4 pad_lef_0">
			<p class="form_text1">To</p>
			<input type="text" class="date-picker" name="to_date" id="to_date" required>
		</div>

	<div class="col-sm-4">
	<p class="form_text1">&nbsp;</p>
		<button type="submit" name="fetch1" id="fetch1" class="btn btn-primary" id="generate">Fetch</button>
	</div>
</form>









	<div class="col-sm-12 col-md-12"><hr></div>
	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-12">
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr class="noExl1">
					<th>S.No</th>
					<th>Recharged On</th>
					<th>Prepaid Paid (AED)</th>
					<!--<th>Credits (AED)</th>-->
					<th>Name</th>
					<th>Mobile</th>
					<!--<th>Mode</th>-->
					<!--<th>Place</th>-->
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		</div>
		<div class="clearfix"></div>
	</div>
<div class="mar_top_20 text-right">
		<button type="button" id="export_excel_button1" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export to Excel</button>
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