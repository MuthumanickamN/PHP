<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title><?php echo ucfirst($from);?> Registration</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable({
        
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
    });

} );

 function view_coach(id)
{
    
    window.location='<?php echo site_url('Coach/view/'); ?>'+id; 

}

 $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
</script>
<style type="text/css">

    .btn2
    {
        color: black;
        background-color: white;

    }
	.coach-btn{
		display:flex;
	}
</style>
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Academy Activities</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#"><?php echo ucfirst($from);?> AccountService</a>
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
            <li> <a href="<?php echo site_url('AccountService'); ?>" class="btn btn-primary"   ><b>New AccountService</b></a></li>
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
                    <h4 class="card-title">AccountService List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
											<th style="text-align:center">No</th>
                                            <th style="text-align:center">Accountservice ID	</th>
                                            <th style="text-align:center">Gross_amount</th>
                                            <th style="text-align:center">Vat Percentage</th>
                                            <th style="text-align:center">Vat Amount</th>
                                            <th style="text-align:center">Payable Amount</th>
                                            <th style="text-align:center">Payable Date</th>
                                            <th style="text-align:center">Actions</th>
                                     </tr>
                                </thead>
        <tbody>
        <?php     		
        foreach ($account_service as $coach) {
        ?>
        <tr>
		<td></td>
        <td style="text-align: center"><?php echo $coach['accountservice_id']; ?></td>
        <td style="text-align: center"><?php echo $coach['gross_amount']; ?></td>
        <td style="text-align: center"><?php echo $coach['vat_percentage']; ?></td>
        <td style="text-align: center"><?php echo $coach['vat_amount']; ?></td>
        <td style="text-align: center"><?php echo $coach['payable_amount']; ?></td>
        <td style="text-align: center"><?php echo $coach['payable_date']; ?></td>
        <td align="center" class="coach-btn">
        <a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="<?php echo $coach['Id']; ?>" data-toggle="tooltip" title="Edit" href="<?php echo base_url('AccountService/account_edit/'.$coach['Id']); ?>">
        </a>
		<a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="<?php echo $coach['Id']; ?>" data-toggle="tooltip" title="Delete"  href="<?php echo base_url('AccountService/delete/'.$coach['Id']); ?>">
        </a>
        </td>
        </tr>
        <?php 
		} ?>
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
</body>
</html>

