<section class="content-header">
<h1>Search</h1>
<ol class="breadcrumb">
<li><i class="fa fa-file-text-o" aria-hidden="true"></i> Schedule</li>
<li class="active">Search</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
        <script src="<?php echo base_url(); ?>assets_booking/libraries/jquery-ui-1.10.3.custom.min.js"></script>
		
		 <script src="<?php echo base_url(); ?>assets_booking/js/search.js"></script>
		
<section class="content admin_table">

<form name="search_form" id="search_form" method="post" enctype="multipart/form-data" action="" onsubmit="return false;" >
<h3 class="mar_0">Search by Email / Booking ID</h3>
<div class="col-sm-12 col-md-4 col-lg-5 pad_top_20">
<input type="text" name="mobile_book_id" id="mobile_book_id">
<input type="hidden" name="mobile_book_id_hid" id="mobile_book_id_hid" value="">
</div>
<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
<input type="submit" name="search_submit" id="search_submit" class="btn btn-primary" value="Search">
</div>
</form>

<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="table-responsive" id="hide_search">
<table id="booking_table" class="table table-bordered table-striped">
	<thead>
		<tr>
		    <th>S.No</th>
			<th>Booking ID</th>
			<th>Booking Status</th>
			<th>View</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		
		</tr>
		
	</tbody>
</table>
</div>
<div class="clearfix"></div>


<div class="clearfix"></div>
</section>


<div id="viewModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">View Booking Details</h4>
</div>
<div class="modal-body">
<div class="table-responsive table_res" id="table_res">

</div>
<div class="clearfix"></div>
<div>
<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>

<script>

$(function(){
$("#hide_search").hide();
});

</script>
<!-- /.content -->
