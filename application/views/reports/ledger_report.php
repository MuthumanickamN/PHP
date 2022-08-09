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
                                            <form action ="<?php echo base_url() . 'reports/ledger_report' ?>" id="searchForm" method="POST">
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-3">
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
                                                <div class="col-lg-3">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-3">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
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
                                                        <th scope="col">Acc code</th>
                                                        <th scope="col">Transaction Details</th>
                                                        <th scope="col">Parent ID</th>
                                                        <th scope="col">Credit (AED)</th>
                                                        <th scope="col">Debit (AED)</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($transactionList)){
                                                        foreach ($transactionList as $txn) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $txn['transaction_id'];?></td>
                                                        <td><?php echo $txn['transaction_date'];?></td>
                                                        <td><?php echo $txn['account_code_val'];?></td>
                                                        <td><?php echo $txn['transaction_detail'];?></td>
                                                        <td><?php echo $txn['parent_id'];?></td>
                                                        <td><?php echo $txn['credit'];?></td>
                                                        <td><?php echo $txn['debit'];?></td>
                                                        <td>
                                                           <!-- <a data-toggle="modal" data-target="#display_transaction" onclick="viewTransaction(<?php echo $txn['id'];?>)" title="View transaction" class="display-transaction ml-1 btn-ext-small btn btn-sm btn-info"  ><i class="fas fa-eye"></i></a>

                                                        <a  href="<?php echo base_url('index.php/Daily_transaction/edit/'.$txn['id']); ?>" title="Edit transaction" class="edit-transaction ml-1 btn-ext-small btn btn-sm btn-warning"  data-schoolid="' + row[0] + '"><i class="fas fa-edit"></i></a>-->
                                                        </td>


                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       <th colspan="6" class="text-right">Total</th><th></th><th colspan="2"></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="6" class="text-right">Balance</th><th colspan="3" class="balance"></th>
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
$this->load->view('users/popup/display');
$this->load->view('users/popup/edit');
$this->load->view('users/popup/add');
$this->load->view('users/popup/delete');
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
        //paging: true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        buttons: [
            { extend: 'print',
            className: 'btn btn-secondary', 
            footer: true, 
            messageTop: 'Ledger report for '+fromdateval+' - '+todateval, 
            title: 'Ledger report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7 ]
                },
            },
            
                //'pageLength'
            
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
           
            crdtotal = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            crdpageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 // Total over all pages
            dbttotal = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            dbtpageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             var pageBalance = crdpageTotal-dbtpageTotal;
            var totalBalance = crdtotal-dbttotal;
            var balanceVal =  'AED '+pageBalance.toFixed(2) +' <br>(AED '+ totalBalance.toFixed(2) +' total)';
            // Update footer
            jQuery( api.column( 6 ).footer() ).html(
                'AED'+crdpageTotal.toFixed(2) +' <br>(AED'+ crdtotal.toFixed(2) +' total)'
            );
            jQuery( api.column( 7 ).footer() ).html(
                'AED'+dbtpageTotal.toFixed(2) +' <br>(AED'+ dbttotal.toFixed(2) +' total)'
            );
            jQuery( '.balance' ).html(balanceVal);
            
        }
    } );
} );

</script>
