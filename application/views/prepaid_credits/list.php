<?php
$this->load->view('includes/header3');
?>
<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
<div class="content-header-left col-md-6 col-12 mb-2">
<h3 class="content-header-title" style="color: green">Academy Activites</h3>
<div class="row breadcrumbs-top">
<div class="breadcrumb-wrapper col-12">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="">Academy Activites</a>
</li>
<li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
</li>

</ol>
</div>
</div>
</div>
<div class="content-header-right col-md-6 col-12">
<div class="media width-250 float-right">
<media-left class="media-middle">
<div id="sp-bar-total-sales"></div>
</media-left>
<div class="media-body media-right text-right">
<ul class="list-inline mb-0">
<li> <a href="<?php echo site_url('Prepaid_credits'); ?>" class="btn btn-primary"   ><b>Add Prepaid credit</b></a></li>
</ul>

</div>
</div>
</div>
</div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4 class="card-title"><?php echo $title;?></h4>
<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

</div>
<div class="card-content collapse show">
<div class="card-body card-dashboard">
   
<div class="table-responsive">
<table id="creditList" class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
    <thead>
        <tr> 
            <th style="text-align: center">S.No</th>
            <th style="text-align: center">Parent Name</th>
            <th style="text-align: center">Parent ID</th>
            <th style="text-align: center">Location</th>
            <th style="text-align: center">Mobile</th>
            <th style="text-align: center">Amount Paid</th>
            <th style="text-align: center">Total Credits</th>
            <th style="text-align: center">Balance Credits</th>
            <th style="text-align: center" >Created At</th>
            <th style="text-align: center" >Action</th>
        </tr>
    </thead>
    <tbody>
    <?php                        
    foreach ($creditList as $key => $value) {?>
    <tr>
        <td></td>
        <td ><?php echo $value['name_id']; ?></td>
        <td ><?php echo $value['parent_code']; ?></td>
        <td ><?php echo $value['location_id']?></td>
        <td ><?php echo $value['mobile_id']; ?></td>
        <td > <?php echo $value['amount_paid']; ?></td>
        <td > <?php echo $value['total_credits']; ?></td>
        <td ><?php echo $value['balance_credits'];  ?></td>
        <td ><?php echo date("d/m/Y h:i A", strtotime($value['created_at'])); ?></td>
        <td >
            <a  href="<?php echo base_url('Prepaid_credits/view/'.$value['id']); ?>" title="View prepaid credit details" class="view-booking ml-1 btn-ext-small btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>
        </td>

    </tr>
<?php } ?>

        
    </tbody>
  
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<script type="text/javascript">
    $(function () { 
     var t = $('#creditList').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,              
            "pageLength": 25,
        });
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>





