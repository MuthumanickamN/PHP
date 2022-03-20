
<script src="<?php echo base_url(); ?>assets_booking/js/booking_approval.js"></script>

<section class="content-header">
<h1>Customer Booking Approval</h1>
<ol class="breadcrumb">
<li><i class="fa fa-file-text-o" aria-hidden="true"></i> Schedule</li>
<li class="active">Customer Booking Approval</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">    
<h3 class="mar_0">Booking List</h3>
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

<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50"></th>
                <th>S.No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Booking ID</th>
<!--                <th>Booking Date</th>-->
<!--                <th>Location</th>-->
<!--                <th>Slot</th>
                <th width="80">Court</th>-->
                <th>Approve</th>
                <th>Reject</th>
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
//$('#example2').DataTable({
//"paging": true,
//"lengthChange": true,
//"searching": true,
//"ordering": true,
//"info": true,
//"autoWidth": true
//});
});
</script>
<div id="rejectModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Reason</h4>
</div>
<div class="modal-body">
    <form action="<?php echo $form_action; ?>" name="reject_form" id="reject_form" method="post" >
        <input type="hidden" name="hidden_id" id="hidden_id" value="">
    <div class="col-sm-12 col-md-12">
    <p class="form_text1">Reason</p>
    <textarea name="reject_reason" id="reject_reason"></textarea>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12 col-md-12 pad_top_20"><button type="button" class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button><input class="btn btn-success pull-right" name="submit1" id="submit1" value="Reject" type="submit"/></div>
    <div class="clearfix"></div>
    </form>
</div>
</div>
</div>
</div>
<!-- Plus Minus Data Table -->
<script type="text/javascript">
/* Formatting function for row details - modify as you need */

</script>
</body>
</html>

