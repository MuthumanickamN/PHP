<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Extras Pricing</h1>
<ol class="breadcrumb">
<li><i class="fa fa-cogs" aria-hidden="true"></i> Settings</li>
<li class="active">Extras Pricing</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<p class="text-center mar_top_30"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-times"></i></button></p>
<h4 class="text-center" style="border-bottom: none;">You have not subscribed to this feature<br/>(or)<br/>You don't have access to this feature, please contact Primestar.</h4>
<div class="clearfix"></div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker').datepicker({
autoclose: true
});
});
</script>
<!-- DataTables -->
<script type="text/javascript">
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
});
</script>