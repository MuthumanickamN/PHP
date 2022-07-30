 <?php $this->load->view('includes/header3'); ?>

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title" style="color: green">Academy Activites</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Academy Activites</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Wallet Transaction</a>
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
            <li> <a href="<?php echo site_url('index.php/Wallet_transaction'); ?>" class="btn btn-primary"   ><b>New Transaction</b></a></li>
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
              <h4 class="card-title">Wallet Transaction</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

            </div>
            <div class="card-content collapse show">
              <div class="card-body card-dashboard">

                <div class="table-responsive">
                  <table id="walletList" class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0" style="width:150%">
                    <thead>
                      <tr> 
                        <th >S.No</th>
                        <th>Wallet Id</th>
                        <th>Parent Name</th>
                        <th >Parent Mobile</th>
                        <th >Account Code</th>
                        <th >Date</th>
                        <th >Type</th>
                        <th >Amount</th>
                        <th >Wallet Transaction Detail</th>
                        
                        <th >Vat %</th>
                        <th >Vat Value</th>
                        <th >Refund %</th>
                        <th >Refund Value</th>
                        <th >Net Amount</th>               
                        
                        <th >Credit</th>  
                        <th >Debit</th>
                        <th >Updated by</th>
                        <th >Action</th>  

                      </tr>
                    </thead>
                    <tbody>
                      <?php                        
                      if(isset($transactionList)){
                        foreach ($transactionList as $key => $value) {?>
                        <tr>
                          <td></td>
                          <td ><?php echo $value['wallet_transaction_id']; ?></td>
                          <td><?php echo $value['parent_name'];  ?></td>
                          <td> <?php echo $value['parent_mobile']; ?></td>
                          <td><?php echo $value['ac_code'] ?></td>
                          <td ><?php echo date('d-m-Y H:i:s', strtotime($value['created_at'])); ?></td>
                          <td><?php echo $value['wallet_transaction_type']; ?></td>
                          <td ><?php echo $value['wallet_transaction_amount']; ?></td>
                          <td><?php echo $value['wallet_transaction_detail']; ?></td>
                          <td><?php echo $value['vat_percentage']; ?>%</td>
                          <td><?php echo $value['vat_value']; ?></td>
                          <td><?php echo isset($value['refund_percentage']) && !empty($value['refund_percentage'])?$value['refund_percentage'].'%':''; ?></td>
                          <td><?php echo isset($value['refund_value'])?$value['refund_value']:'';  ?></td>
                          <td><?php echo $value['net_amount']; ?></td>
                          <td ><?php echo $value['credit']; ?></td>
                          <td><?php echo $value['debit']; ?></td>
                          
                          <td><?php echo $value['updated_admin']; ?></td>
                           <td >
                            <a type="button" style="color:white;text-decoration:none" onClick="view_wallet_transaction(<?php echo $value['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

                            <?php /*<a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('index.php/Wallet_transaction/edit/'.$value['id']); ?>">
                            </a>

                            <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('index.php/Wallet_transaction/delete/'.$value['id']); ?>">
                            </a>*/ ?>
                  </td>


                    



                      </tr>
                    <?php } } ?>


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
     var t = $('#walletList').DataTable( {
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



