<?php $this->load->view('includes/header3'); ?>
<style>
    .dataTables_filter {
        display: none;
    }

    .dataTables_wrapper .dt-buttons {
        float: right;
        text-align: center;
        font-size: 12px;
    }

    .dataTables_paginate {
        font-size: 10px;
        margin-bottom: 5px;
    }

    .dataTables_length {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .dataTables_info {
        font-size: 12px;
    }
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
                <div class="row breadcrumbs-top">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
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
                            <li>
                                <a href="<?php echo base_url() . 'index.php/Daily_transaction' ?>" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12"><span id="success-msg"></span></div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $title;?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="mainbox col-sm-12">
                                        <div class="panel panel-info">
                                          
                                            <table id="transactionListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Trans ID</th>
                                                        <th scope="col">Acc code</th>
                                                        <th scope="col">Transaction Date</th>
                                                        <th scope="col">Transaction Details</th>
                                                        <th scope="col">Updated admin</th>
                                                        <th scope="col">Gross amount</th>
                                                        <th scope="col">VAT %</th>
                                                        <th scope="col">VAT Amount</th>
                                                        <th scope="col">Credit (AED)</th>
                                                        <th scope="col">Debit (AED)</th>
                                                        <th scope="col" style="width:80px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($transactionList)){
                                                        foreach ($transactionList as $txn) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $txn['transaction_id'];?></td>
                                                        <td><?php echo $txn['account_code_val'];?></td>
                                                        <td><?php echo $txn['transaction_date'];?></td>
                                                        <td><?php echo $txn['transaction_detail'];?></td>
                                                        <td><?php echo $txn['updated_admin'];?></td>
                                                        <td><?php echo $txn['transaction_amount'];?></td>
                                                        <td><?php echo $txn['vat_percentage'];?></td>
                                                        <td><?php echo $txn['vat_value'];?></td>
                                                        <td><?php echo $txn['credit'];?></td>
                                                        <td><?php echo $txn['debit'];?></td>
                                                        <td><a data-toggle="modal" data-target="#display_transaction" onclick="viewTransaction(<?php echo $txn['id'];?>)" title="View transaction" class="display-transaction ml-1 btn-ext-small btn btn-sm btn-info"  ><i class="fas fa-eye"></i></a>

                                                        <a  href="<?php echo base_url('index.php/Daily_transaction/edit/'.$txn['id']); ?>" title="Edit transaction" class="edit-transaction ml-1 btn-ext-small btn btn-sm btn-warning"  data-schoolid="' + row[0] + '"><i class="fas fa-edit"></i></a>
                                                      </td>
                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
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
$this->load->view('popup/transaction');
?>
<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    var t = jQuery('#transactionListing').DataTable( {
        
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
     
    } );
} );
function viewTransaction(trans_id){
  jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/getdetail',
        data:{transaction_idVal: trans_id},
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#voucher_reverse-form').button('loading');
        },
        complete: function () {
            $('html, body').animate({
                scrollTop: $(".content-wrapper").offset().top
            }, 100);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['data']) {             
                for (i in json['data']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-txn-' + i);
                    if(json['data'][i] !='' || json['data'][i]!= 0){
                        $(element).html(json['data'][i]);
                    }else{
                        $(element).html('-');
                    }
                    if(json['data']['payment_type'] !='Cheque' ){
                        $('.input-txn-cheque_number').html('-');
                        $('.input-txn-cheque_date').html('-');
                    }
                    if(json['data']['payment_type']  == 'Cash' ){
                        $('.input-txn-bank').html('-');
                    }
                    
                }
            } else {
                jQuery('span.alertMsg').html('<div class="alert alert-danger">No data available.</div>');
                
                jQuery('form#add-school-credit-form').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });

}

</script>
