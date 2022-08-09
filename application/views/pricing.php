<script src="<?php echo base_url(); ?>assets_booking/js/pricing.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<section class="content-header">
<h1>Pricing</h1>
<ol class="breadcrumb">
<li><i class="fa fa-cogs" aria-hidden="true"></i> Settings</li>
<li class="active">Pricing List</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">    
<h3 class="mar_0">Pricing List</h3>
<div id="dynamic_message"></div>
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
<div class="clearfix"></div>
<div class="mar_top_20"><a href="<?php echo base_url(); ?>pricing/add_pricing" class="btn btn-success pull-right">Add Pricing</a>
<div class="clearfix"></div>
</div>
<div class="table-responsive mar_top_20">
<table id="example2" class="table table-bordered table-striped">
	<thead>
		<tr>
                        <th width="20">S.No</th>
			<th>Court</th>
                        <th>Sports</th>
                        <th>Location</th>
                        <th>Day Type</th>
			<th>Days</th>
			<th class="no-sort">Edit</th>
			<th class="no-sort">Delete</th>
		</tr>
	</thead>
        <tbody>           
        </tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->
<!-- DataTables -->

<script type="text/javascript">
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
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
});
</script>
</body>
</html>