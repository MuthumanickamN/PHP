<?php $this->load->view('includes/header3'); ?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green"><?php echo $title; ?></h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                    </div>
                </div>
            </div>
           
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $title; ?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="mainbox col-sm-12">
                                        <div class="panel panel-info">
                                            <table id="creditListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Trans ID</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">School Id</th>
                                                        <th scope="col">School name</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Contact</th>
                                                        <th scope="col">Email Id</th>
                                                        <th scope="col">Gross amount</th>
                                                        <th scope="col">Vat value</th>
                                                        <th scope="col">Net amount</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                        <th scope="col">Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php 
                                                	foreach($credit as $key=>$value){	
                                                	?>
                                                	<tr>
                                                		<td></td>
                                                		<td><?php echo $value['wtx_id'];?></td>
                                                		<td><?php echo date('d-m-Y', strtotime($value['transaction_date']));?></td>
                                                		<td><?php echo $value['school_id'];?></td>
                                                		<td><?php echo $value['school_name'];?></td>
                                                		<td><?php echo $value['activity_id'];?></td>
                                                		<td><?php echo $value['contact'];?></td>
                                                		<td><?php echo $value['email_id'];?></td>
                                                		<td><?php echo $value['gross_amount'];?></td>
                                                		<td><?php echo $value['vat_value'];?></td>
                                                		<td><?php echo $value['net_amount'];?></td>
                                                		<td>
                                                            <?php if($value['status'] == 0){?>
                                                            <label style="padding: 2px 8px; " class="btn-danger">NOT PAID</label>
                                                            <?php }else { ?>
                                                            <label style="padding: 2px 8px; " class="btn-success">PAID</label>
                                                        <?php } ?>
                                                        </td>
                                                            
                                                		<td><a href="#" data-toggle="modal" data-target="#update_invoice" onclick="jQuery('#id_val').val(<?php echo $value['id'];?>)" class="btn btn-primary">Update</a></td>
                                                		<td><a href="#" style="color: #fff !important;border-radius: 0;" onclick="sendmail(<?php echo $value['id'];?>)" class="btn btn-warning">Resend</a></td>
                                                		

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
                </div>
            </section>
        </div>
    </div>
</div>
<?php
$this->load->view('school_credits/popup/invoice');
?>
<script type="text/javascript">
	$(function () { 
	 var t = $('#creditListing').DataTable( {
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
function sendmail(id){
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/School_credits/send_mail/'+id,
        dataType:'json',    
        complete: function () {
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 4000);
            
        },          
        success: function (json) {
            $('.text-danger').remove();
            if(json['status']){
                if(json['status']=='success'){
                jQuery('span#success-msg').html('<div class="alert alert-success">Invoice sent successfully</div>');
                location.reload();
                }
            }else{
                jQuery('span#success-msg').html('<div class="alert alert-danger">Error in sending mail</div>');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
</script>