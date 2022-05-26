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
    @media print {
  .dataTables_wrapper th, td {
      white-space: normal;
  }
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
                                            <form action ="<?php echo base_url() . 'reports/wallet_transaction/'.$type ?>" id="searchForm" method="POST">
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Parent ID/ Mobile</b>
                                                    <select class="form-control" id="parent_idval" name="parent_idval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($parentList)){
                                                            foreach ($parentList as $parent) { ?>
                                                                <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_idval) && $parent['parent_id']==$parent_idval ){ echo 'selected';} ?>><?php echo 'PSA00'.$parent['parent_id'].' - '.$parent['mobile_no']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Parent email Id</b>
                                                    <select class="form-control" id="parent_emailval" name="parent_emailval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($parentList)){
                                                            foreach ($parentList as $parent) { ?>
                                                                <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_emailval) && $parent['parent_id']==$parent_emailval ){ echo 'selected';} ?>><?php echo $parent['email_id']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-2">
                                                    <button class="btn btn-success margin-top-20">Search</button>
                                                </div>
                                          

                                            </div>
                                            <div class="row margin-top-20">
                                                <div class="col-lg-2">
                                                    <b>Account code</b>
                                                    <select class="form-control" id="acc_code" name="acc_code">
                                                        <option value="">Select</option>
                                                        <?php if(isset($account_code_data)){
                                                            foreach ($account_code_data as $code) { ?>
                                                                <option value="<?php echo $code['id'] ?>" <?php if(isset($acc_code) && $code['id']==$acc_code ){ echo 'selected';} ?>><?php echo $code['name_of_service']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Transaction Details</b>
                                                    <select class="form-control" id="transDetailVal" name="transDetailVal">
                                                        <option value="">Select</option>
                                                        <?php if(isset($transactionList)){
                                                            foreach ($transactionList as $detail) { ?>
                                                                <option value="<?php echo $detail ?>" <?php if(isset($transDetailVal) && $detail==$transDetailVal ){ echo 'selected';} ?>><?php echo $detail; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <?php if($type == 'master'){ ?>
                                                <div class="col-lg-2">
                                                    <b>Updated email id</b>
                                                    <select class="form-control" id="id_val" name="id_val">
                                                        <option value="">Select</option>
                                                        <?php if(isset($userList)){
                                                            foreach ($userList as $user) { ?>
                                                                <option value="<?php echo $user['user_id'] ?>" <?php if(isset($id_val) && $user['user_id']==$id_val ){ echo 'selected';} ?>><?php echo $user['user_name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                            <?php } 
                                            $paymentArray = array('Cash','Online','Card','Cheque');
                                            ?>
                                            <div class="col-lg-2">
                                                    <b>Payment Type</b>
                                                    <select class="form-control" id="paymentTypeVal" name="paymentTypeVal">
                                                        <option value="">Select</option>
                                                        <?php if(isset($paymentArray)){
                                                            foreach ($paymentArray as $payment) { ?>
                                                                <option value="<?php echo $payment ?>" <?php if(isset($paymentTypeVal) && $payment==$paymentTypeVal ){ echo 'selected';} ?>><?php echo $payment; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                            </div>
                                              </form>
                                            <table id="transactionListing" class="table table-bordered table-hover small table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Trans ID</th>
                                                        <th scope="col">Ac Code</th>
                                                        <th scope="col" style="width:50px !important">Date</th>
                                                        <th scope="col">Transaction Details</th>
                                                        <th scope="col">Updated Admin</th>
                                                        <th scope="col">Parent ID</th>
                                                        <th scope="col">Gross Amount</th>
                                                        <th scope="col">Discount Percentage</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">VAT Amount</th>
                                                        <th scope="col">Credit (AED)</th>
                                                        <th scope="col">Debit (AED)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($arrayList)){
                                                        foreach ($arrayList as $txn) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td ><a style="color:dodgerblue;" href="javascript:void(0);" onclick="show_transaction('<?php echo $txn['wallet_transaction_id'];?>')"><?php echo $txn['wallet_transaction_id'];?></a></td>
                                                        <td><?php echo $txn['ac_code'];?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($txn['wallet_transaction_date']));?></td>
                                                        <td><?php echo $txn['wallet_transaction_detail'];?></td>
                                                        <td><?php echo $txn['updated_admin_id'];?></td>
                                                        <td><?php echo $txn['parent_code'];?></td>
                                                        <td><?php echo $txn['gross_amount'];?></td>
                                                        <td><?php echo $txn['discount_percentage'];?></td>
                                                        <td><?php echo $txn['discount_value'];?></td>
                                                        <td><?php echo $txn['vat_value'];?></td>
                                                        <td><?php echo $txn['credit'];?></td>
                                                        <td><?php echo $txn['debit'];?></td>

                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       <th colspan="8" class="text-right">Total</th><th></th><th></th><th></th><th></th><th></th>
                                                    </tr>
                                                    <tr>
                                                       <th colspan="11" class="text-right">Balance</th><th class="balance"></th><th></th>
                                                    </tr>
                                                </tfoot>

                                            </table>

                                            <hr>

                                            <table id="summary" class="table table-bordered table-hover ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Role</th>
                                                        <th scope="col">Email Id</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($userListArray)){
                                                        foreach ($userListArray as $user) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $user['user_name'];?></td>
                                                        <td><?php echo $user['role'];?></td>
                                                        <td><?php echo $user['email'];?></td>
                                                        <td><?php echo $user['total'];?></td>
                                                        

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
$this->load->view('templates/footer');
?>

<!-- Trigger/Open The Modal -->
<div id="transactionHistoryModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;overflow:scroll;">
  <div class="modal-dialog" style="width: 100%;
    float: none;
    margin: 0 auto;
    max-width: 38%;
    position: absolute;
    left: 4%;">
    <div class="modal-content" style="width: 246%;">
      <div class="modal-body" style="width: 100%;">
      <div class="alert alert-info">
        <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#transactionHistoryModal').hide();">&times;</button>
        <strong> Wallet Transaction Details </strong>
      </div>
      <div class="">
        
        <div class="table-responsive">
            <table class="table mb-0">
            
                <tr>
                  <th class="text-left">Transaction-ID</th>
                  <td class="text-left transaction_id"></td>           
                </tr>
                <tr>
                  <th class="text-left">Student ID</th>
                  <td class="text-left student_code"></td>           
                </tr>
                <tr>
                  <th class="text-left">Parent ID</th>
                  <td class="text-left parent_code"></td>           
                </tr>
                <tr>
                  <th class="text-left">Parent Name</th>
                  <td class="text-left parent_name"></td>           
                </tr>
                <tr>
                  <th class="text-left">Parent Mobile</th>
                  <td class="text-left parent_mobile"></td>           
                </tr>
                <tr>
                  <th class="text-left">Account Code</th>
                  <td class="text-left account_code"></td>           
                </tr>
                <tr>
                  <th class="text-left">Transaction Date</th>
                  <td class="text-left transaction_date"></td>           
                </tr>
                <tr>
                  <th class="text-left">Transaction Type</th>
                  <td class="text-left transaction_type"></td>           
                </tr>
                <tr>
                  <th class="text-left">Transaction Detail</th>
                  <td class="text-left transaction_detail"></td>           
                </tr>
                <tr>
                  <th class="text-left">Description</th>
                  <td class="text-left description"></td>           
                </tr>

                
                <!--<tr>
                  <th class="text-left">Tax Amount</th>
                  <td class="text-left tax_amount"></td>           
                </tr>-->
                <tr>
                  <th class="text-left">Discount %</th>
                  <td class="text-left discount_perc"></td>           
                </tr>
                <tr>
                  <th class="text-left">Discount Amount</th>
                  <td class="text-left discount_amount"></td>           
                </tr>
                <tr>
                  <th class="text-left">VAT %</th>
                  <td class="text-left vat_perc"></td>           
                </tr>
                <tr>
                  <th class="text-left">VAT Amount</th>
                  <td class="text-left vat_amount"></td>           
                </tr>
                <tr>
                  <th class="text-left">Payable Amount</th>
                  <td class="text-left payable_amount"></td>           
                </tr>
                <tr>
                  <th class="text-left">Created At</th>
                  <td class="text-left created_at"></td>           
                </tr>
            </table>
        </div>
        
          <br>
          <br>
          
          <a onClick="$('#transactionHistoryModal').hide();"    class="btn btn-danger" >Cancel</a>
        
      </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

jQuery(document).ready(function() {
    var titlename = '<?php echo $title;?>';
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#transactionListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'pdf', 
            footer: true, 
            messageTop: titlename+' for '+fromdateval+' - '+todateval, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12 ]
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
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            vatpageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over all pages
            crdtotal = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            crdpageTotal = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 // Total over all pages
            dbttotal = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            dbtpageTotal = api
                .column( 12, { page: 'current'} )
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
            jQuery( api.column( 10 ).footer() ).html(
                'AED '+vatpageTotal.toFixed(2) +' <br>(AED '+ vattotal.toFixed(2) +' total)'
            );
            jQuery( api.column( 11 ).footer() ).html(inputVat);
            jQuery( api.column( 12 ).footer() ).html(outputVat);
            jQuery( '.balance' ).html(balanceVal);
        }
    } );
    
    
} );


   var summary = jQuery('#summary').DataTable( {
    dom: 'Bfrtip',
    buttons: [
            { extend: 'pdf', 
            //orientation: 'portrait',
            footer: true, 
            title: 'Wallet summary', 
            exportOptions: {
                    columns: [ 1, 2, 3, 9 ]
                },
            }
        ],
    "paging":   false,
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
            // Total over this page
        /*    cash = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            // Total over this page
            card = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
 
            // Total over this page
            online = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 
            // Total over this page
            cheque = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            wallet = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); */
                // Total over this page
            total = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
        /*    jQuery( api.column( 4 ).footer() ).html(cash);
            jQuery( api.column( 5 ).footer() ).html(card);
            jQuery( api.column( 6 ).footer() ).html(online);
            jQuery( api.column( 7 ).footer() ).html(cheque);
            jQuery( api.column( 8 ).footer() ).html(wallet);*/
            jQuery( api.column( 9 ).footer() ).html(total);
        }
    } );
    
    
    function show_transaction(id)
 {
      $.ajax({
          url:"<?php echo base_url().'Reports/wallet_transaction_details_view/'; ?>",
          data:{wallet_transaction_id:id},
          type:"POST",
          async:false,
          dataType:"json",
          success:function(data){   
            //var obj = JSON.parse(data);
            //console.log(data);
            if(data != 0)
            {
                $('.transaction_id').html(data.wallet_transaction_id);
                $('.student_code').html(data.student_code);
                $('.parent_code').html(data.parent_code);
                $('.parent_name').html(data.parent_name);
                $('.parent_mobile').html(data.parent_mobile);
                $('.account_code').html(data.ac_code);
                $('.transaction_date').html(data.wallet_transaction_date);
                $('.transaction_type').html(data.wallet_transaction_type);
                $('.transaction_detail').html(data.wallet_transaction_detail);
                $('.description').html(data.description_);
                //$('.tax_amount').html(data.wallet_transaction_type);
                $('.discount_perc').html(data.discount_percentage);
                $('.discount_amount').html(data.discount_value);
                $('.vat_perc').html(data.vat_percentage);
                $('.vat_amount').html(data.vat_value);
                $('.payable_amount').html(data.net_amount);
                $('.created_at').html(data.created_at);
            }
           
          }
      });
     $('#transactionHistoryModal').show();
     
 }

</script>