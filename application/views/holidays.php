<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<section class="content-header">
<h1>Holidays</h1>
<ol class="breadcrumb">
<li><i class="fa fa-cogs" aria-hidden="true"></i> Settings</li>
<li class="active">Holidays</li>
</ol>
</section>
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
	
<form name="holidays_form" id="holidays_form" action="<?php echo base_url(); ?>holidays/add_holidays"  method="POST" class="form-horizontal" role="form" autocomplete="off">
<h3 class="mar_0">Add Holiday</h3>
<div class="col-sm-12 col-md-4 col-lg-5 pad_top_20 pad_le_ri_0">
<input type="text" name="datepicker" class="date-picker" id="datepicker">
</div>
<div class="col-sm-12 col-md-4 col-lg-2 pad_top_20">
<button type="button" name="holiday_add" id="holiday_add" class="btn btn-primary">Add</button>
</div>
</form>
<div class="clearfix"></div>
<div class="table-responsive">
<table id="hol_list_table" class="table table-bordered">
	<thead>
		<tr>
			<th>Holiday Date</th>
			<th class="no-sort">Action</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>assets_booking/js/holidays.js"></script>
<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker').datepicker({
autoclose: true
}).on("changeDate", function (e) {		
        $('#datepicker').valid();		
    });;
});
</script>
<!-- DataTables -->

<script type="text/javascript">
$(function () {
	$('.alert-success').delay(3000).fadeOut('slow');
$("#example1").DataTable();
$('#hol_list_table').DataTable({
	"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});

$(document).on('click', '#holiday_add', function () {
	
	
     
    $("#holidays_form").validate({
        // Specify validation rules
       rules: {
            datepicker: "required"
        },
        messages: {
            datepicker: "Please select the date"
            
        }
    });
		var loc=$('#datepicker').val();
		var $form = $('#holidays_form');
	if($form.valid())
	{
		
		$form.submit();
		
		             
						
	}
		
		
	});



});
</script>
