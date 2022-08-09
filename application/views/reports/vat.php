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
                                            <form action ="<?php echo base_url() . 'reports/vat_report' ?>" id="searchForm" method="POST">
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-3">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-3">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Account code</b>
                                                    <select class="form-control account_code" id="acc_code" name="acc_code">
                                                        <option value="">Select</option>
                                                        <?php if(isset($account_code_data)){
                                                            foreach ($account_code_data as $code) { ?>
                                                                <option value="<?php echo $code['id'] ?>" <?php if(isset($acc_code) && $code['id']==$acc_code ){ echo 'selected';} ?>><?php echo $code['name_of_service']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-secondary margin-top-20">Search</button>
                                                </div>
                                          

                                            </div>
                                              </form>
                                            <table id="transactionListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Trans ID</th>
                                                        <th scope="col">Transaction Date</th>
                                                        <th scope="col">Account code</th>
                                                        <th scope="col">Transaction type</th>
                                                        <th scope="col">Gross amount</th>
                                                        <th scope="col">Transaction amount</th>
                                                        <th scope="col">Input VAT</th>
                                                        <th scope="col">Output VAT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($arrayList)){
                                                        foreach ($arrayList as $txn) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $txn['wallet_transaction_id'];?></td>
                                                        <td><?php echo $txn['wallet_transaction_date'];?></td>
                                                        <td><?php echo $txn['ac_code'];?></td>
                                                        <td><?php echo $txn['wallet_transaction_type'];?></td>
                                                        <td><?php echo $txn['wallet_transaction_amount'];?></td>
                                                        <td><?php echo $txn['net_amount'];?></td>
                                                        <td><?php echo ($txn['wallet_transaction_type'] == 'Debit')?$txn['vat_value']:'';?></td>
                                                        <td><?php echo ($txn['wallet_transaction_type'] == 'Credit')?$txn['vat_value']:'';?></td>


                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       <th colspan="6" class="text-right">Total</th><th></th><th></th><th></th>
                                                    </tr>
                                                    <tr>
                                                       <th colspan="7" class="text-right">Balance</th><th class="balance"></th><th></th>
                                                    </tr>
                                                </tfoot>

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
$this->load->view('templates/footer');
?>
<script type="text/javascript">
$(document).ready(function(){
$('.account_code').select2();
});


jQuery(document).ready(function() {
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#transactionListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print',
            className: 'btn btn-secondary', 
            footer: true, 
            messageTop: 'Daily transaction report for '+fromdateval+' - '+todateval, 
            title: 'Daily transaction report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8 ]
                },
            }
        ],
        "fnRowCallback" : function(nRow, aData, iDisplayIndex ){
                var info = $(this).DataTable().page.info();
                $("td:first", nRow).html(info.start + iDisplayIndex +1);
               return nRow;
            },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            vattotal = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            vatpageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over all pages
            crdtotal = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            crdpageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 // Total over all pages
            dbttotal = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            dbtpageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            var inputVat = 'AED '+crdpageTotal.toFixed(2) +' <br>(AED '+ crdtotal.toFixed(2) +' total)';
            var outputVat = 'AED '+dbtpageTotal.toFixed(2) +' <br>(AED '+ dbttotal.toFixed(2) +' total)';
            var pageBalance = crdpageTotal-dbtpageTotal;
            var totalBalance = crdtotal-dbttotal;
            var balanceVal =  'AED '+pageBalance.toFixed(2) +' <br>(AED '+ totalBalance.toFixed(2) +' total)';
            // Update footer
            jQuery( api.column( 6 ).footer() ).html(
                'AED '+vatpageTotal.toFixed(2) +' <br>(AED '+ vattotal.toFixed(2) +' total)'
            );
            jQuery( api.column( 7 ).footer() ).html(inputVat);
            jQuery( api.column( 8 ).footer() ).html(outputVat);
            jQuery( '.balance' ).html(balanceVal);
        }
    } );
} );

</script>
