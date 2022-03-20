<style type="text/css">
    .table td{
        padding: 3px 12px !important;
        width:25%;
    }
    .table td p{
        margin-bottom: 0px;
    }
    #preview_transaction .row{
        margin:0px !important;
    }
    .preview_transaction .modal-lg{
        max-width:70% !important;
    }
    .payment_type_Div{
        width:42% !important;
    }
</style>
<!-- Voucher -->
<div class="modal fade rotate" id="voucher_reverse" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="voucher_reverse-form" class="voucher_reverse-form " method="post">   
            <div class="modal-content panel panel-warning">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Voucher reversal</h4>
                    <button type="button" class="close close_button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <p><span class="alertMsg"></span></p>
                    <table class="table table-bordered" >
                        <tr>
                            <td>Transaction Id</td>
                            <td>
                                <select class="form-control input-voucher-transaction_idVal" id="transaction_idVal" name="transaction_idVal" onchange="getdetails(this.value)">
                                    <option value="">Select</option>
                                    <?php if(isset($transactionList)){
                                        foreach ($transactionList as $txn) { ?>
                                            <option value="<?php echo $txn['id'] ?>"><?php echo $txn['transaction_id']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </td>
                            <td>Transaction created on</td>
                            <td><p id="created_on" class="voucher_text input-voucher-created_on"></p></td>
                        </tr>
                        <tr>
                            <td>Transaction Date</td>
                            <td><p id="transaction_date" class="voucher_text input-voucher-transaction_date"></p></td>
                            <td>Transaction type</td>
                            <td><p id="transaction_type" class="voucher_text input-voucher-transaction_type"></p></td>
                        </tr>
                        <tr>
                            <td>Activity</td>
                            <td><p id="activity_id" class="voucher_text input-voucher-activity_id"></p></td>
                            <td>Location</td>
                            <td><p id="location_id" class="voucher_text input-voucher-location_id"></p></td>
                        </tr>
                        <tr>
                            <td>Coach</td>
                            <td><p id="coach_id" class="voucher_text input-voucher-coach_id"></p></td>
                            <td>Account code</td>
                            <td><p id="account_code" class="voucher_text input-voucher-account_code"></p></td>
                        </tr>
                        <tr>
                            <td>TRN no</td>
                            <td><p id="trn_no" class="voucher_text input-voucher-trn_no"></p></td>
                            <td>Paid to</td>
                            <td><p id="paid_to" class="voucher_text input-voucher-paid_to"></p></td>
                        </tr>
                        <tr>
                            <td>Transaction amount</td>
                            <td><p id="transaction_amount" class="voucher_text input-voucher-transaction_amount"></p></td>
                            <td>VAT Percentage</td>
                            <td><p id="vat_percentage" class="voucher_text input-voucher-vat_percentage"></p></td>
                        </tr>
                        <tr>
                            <td>VAT amount</td>
                            <td><p id="vat_value" class="voucher_text input-voucher-vat_value"></p></td>
                            <td>NET Amount</td>
                            <td><p id="net_amount" class="voucher_text input-voucher-net_amount"></p></td>
                        </tr>
                        <tr>
                            <td>Payment type</td>
                            <td><p id="payment_type" class="voucher_text input-voucher-payment_type"></p></td>
                            <td>Bank name</td>
                            <td><p id="bank" class="voucher_text input-voucher-bank"></p></td>
                        </tr>
                        <tr>
                            <td>Cheque number</td>
                            <td><p id="cheque_no" class="voucher_text input-voucher-cheque_number"></p></td>
                            <td>Cheque date</td>
                            <td><p id="cheque_date" class="voucher_text input-voucher-cheque_date"></p></td>
                        </tr>
                        <tr>
                            <td>Approved by</td>
                            <td><p id="approved_by" class="voucher_text input-voucher-approved_by"></p></td>
                            <td>Settled by</td>
                            <td><p id="settled_by" class="voucher_text input-voucher-settled_by"></p></td>
                        </tr>
                        <tr>
                            <td>Created at</td>
                            <td><p id="created_at" class="voucher_text input-voucher-created_at"></p></td>
                            <td>Created by</td>
                            <td><p id="created_by" class="voucher_text input-voucher-created_by"></p></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td colspan="3"><p id="transaction_detail" class="voucher_text input-voucher-transaction_detail"></p></td>
                        </tr>
                        <tr>
                            <td>Reversal reason</td>
                            <td colspan="3"><textarea class="form-control input-voucher-refund_reason" id="refund_reason" name="refund_reason"></textarea></td>
                        </tr>
                        
                    </table>
                
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-success" data-addempid="" id="voucher_reversal_btn" onclick="reversal()">Update</button> 
                            <button type="button" class="btn rkmd-btn btn-danger close_button" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
   
    </div>
</div>
<!-- Voucher -->
<!-- Preview transaction -->
<div class="modal fade rotate preview_transaction" id="preview_transaction" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <div class="previewDiv">
            <form id="preview_transaction-form" method="post">   
            <div class="modal-content panel panel-success">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title editTitle">Daily Transaction voucher entry confirmation!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <table class="table table-bordered" >
                        
                        <tr>
                            <td>Transaction Date</td>
                            <td ><p id="transaction_date" class="input-preview-transaction_date"></p></td>
                            <td>Transaction type</td>
                            <td ><p id="transaction_type" class="input-preview-transaction_type"></p></td>
                        </tr>
                        <tr>
                            <td>Activity</td>
                            <td ><p id="activity_id" class="input-preview-activity_id"></p></td>
                            <td>Location</td>
                            <td ><p id="location_id" class="input-preview-location_id"></p></td>
                        </tr>
                        <tr>
                            <td>Coach</td>
                            <td ><p id="coach_id" class="input-preview-coach_id"></p></td>
                            <td>Account code</td>
                            <td ><p id="account_code" class="input-preview-account_code"></p></td>
                        </tr>
                        <tr>
                            <td>Invoice no</td>
                            <td ><p id="invoice" class="input-preview-invoice"></p></td>
                            <td>Date</td>
                            <td ><p id="invoice_date" class="input-preview-invoice_date"></p></td>
                        </tr>
                        <tr>
                            <td>TRN no</td>
                            <td ><p id="trn_no" class="input-preview-trn_no"></p></td>
                            <td>Paid to</td>
                            <td ><p id="paid_to" class="input-preview-paid_to"></p></td>
                        </tr>
                        <tr>
                            <td>Transaction amount</td>
                            <td ><p id="transaction_amount" class="input-preview-transaction_amount"></p></td>
                            <td>VAT Percentage</td>
                            <td ><p id="vat_percentage" class="input-preview-vat_percentage"></p></td>
                        </tr>
                        <tr>
                            <td>Payment type</td>
                            <td ><p id="payment_type" class="input-preview-payment_type"></p></td>
                            <td >Bank name</td>
                            <td><p id="bank" class="input-preview-bank"></p></td>
                        </tr>
                        <tr >
                            <td >Cheque number</td>
                            <td ><p id="cheque_no" class="input-preview-cheque_number"></p></td>
                            <td >Cheque date</td>
                            <td ><p id="cheque_date" class="input-preview-cheque_date"></p></td>
                        </tr> 
                        <tr>
                            <td>VAT amount</td>
                            <td ><p id="vat_value" class="input-preview-vat_value"></p></td>
                            <td>NET Amount</td>
                            <td ><p id="net_amount" class="input-preview-net_amount"></p></td>
                        </tr>
                        <tr>
                            <td>Approved by</td>
                            <td ><p id="approved_by" class="input-preview-approved_by"></p></td>
                            <td>Settled by</td>
                            <td ><p id="settled_by" class="input-preview-settled_by"></p></td>
                        </tr>
                        <tr>
                            <td>Description details</td>
                            <td colspan="3" ><p id="transaction_detail" class="input-preview-transaction_detail"></p></td>
                        </tr>
                        
                        
                    </table>
                    
                
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">  
                            <button type="button" id="preview_edit" onclick="inline_edit()"  class="btn btn-warning" ><b> Edit</b></button>
                            <button type="button" class="btn rkmd-btn btn-success add-daily-transaction" id="add-daily-transaction">Save</button>
                        
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      

    </div>
    <div class="InlineEditDiv" style="display:none;">
        <form id="preview_transaction-form" method="post">   
            <div class="modal-content panel panel-warning">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title editTitle">Daily Transaction voucher -Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <table class="table table-bordered" >
                        
                        <tr>
                            <td>Transaction Date</td>
                            <td class="edit_view edit-transaction_date"></td>
                            <td>Transaction type</td>
                            <td class="edit_view edit-transaction_type"></td>
                        </tr>
                        <tr>
                            <td>Activity</td>
                            <td class="edit_view edit-activity_id"></td>
                            <td>Location</td>
                            <td class="edit_view edit-location_id"></td>
                        </tr>
                        <tr>
                            <td>Coach</td>
                            <td class="edit_view edit-coach_id"></td>
                            <td>Account code</td>
                            <td class="edit_view edit-account_code"></td>
                        </tr>
                        <tr>
                            <td>Invoice no</td>
                            <td class="edit_view edit-invoice"></td>
                            <td>Date</td>
                            <td class="edit_view edit-invoice_date"></td>
                        </tr>
                        <tr>
                            <td>TRN no</td>
                            <td class="edit_view edit-trn_no"></td>
                            <td>Paid to</td>
                            <td class="edit_view edit-paid_to"></td>
                        </tr>
                        <tr>
                            <td>Transaction amount</td>
                            <td class="edit_view edit-transaction_amount"></td>
                            <td>VAT Percentage</td>
                            <td class="edit_view edit-vat_percentage"></td>
                        </tr>
                        <tr>
                            <td>VAT amount</td>
                            <td class="edit_view edit-vat_value"></td>
                            <td>NET Amount</td>
                            <td class="edit_view edit-net_amount"></td>
                        </tr>
                        <tr>
                            <td>Approved by</td>
                            <td class="edit_view edit-approved_by"></td>
                            <td>Settled by</td>
                            <td class="edit_view edit-settled_by"></td>
                        </tr>
                        <tr>
                            <td>Description details</td>
                            <td colspan="3" class="edit_view edit-transaction_detail"></td>
                        </tr>
                        <tr>
                            <td>Payment type</td>
                            <td class="edit_view payment_type_Div edit-payment_type"></td>
                            <td class=" edit_view_payment">Bank name</td>
                            <td class="edit_view edit-bank edit_view_payment"></td>
                        </tr>
                        <tr class="hideDiv">
                            <td class="edit_view_payment">Cheque number</td>
                            <td class="edit_view edit-cheque_number edit_view_payment"><p id="cheque_no"></p></td>
                            <td class="edit_view_payment">Cheque date</td>
                            <td class="edit_view edit-cheque_date edit_view_payment"><p id="cheque_date"></p></td>
                        </tr> 
                        <tr>
                            <td colspan="4" style="width: 100%;" id="result1">
                        </tr>
                        
                    </table>
                    <input value = "1" name="is_submit" id="is_submit" type="hidden">
                
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">  
                            <button type="button" class="btn rkmd-btn btn-success" id="add-popup-daily-transaction">Save</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
   
    </div>
</div>
<!-- Preview transaction -->

<script type="text/javascript">
    jQuery('.voucher_reverse-form .close_button').click(function(){
        jQuery('#transaction_idVal').val('');
        jQuery('.voucher_text').html('');
    });

    function getdetails(val){
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/getdetail',
        data:jQuery("form#voucher_reverse-form").serialize(),
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
                    var element = $('.input-voucher-' + i);
                    if(json['data'][i] !='' || json['data'][i]!= 0){
                        $(element).html(json['data'][i]);
                    }else{
                        $(element).html('-');
                    }
                    if(json['data']['payment_type'] !='Cheque' ){
                        $('.input-voucher-cheque_number').html('-');
                        $('.input-voucher-cheque_date').html('-');
                    }
                    if(json['data']['payment_type']  == 'Cash' ){
                        $('.input-voucher-bank').html('-');
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

function reversal(){
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/reversalrequest',
        data:jQuery("form#voucher_reverse-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#voucher_reverse-form').button('loading');
        },
        complete: function () {
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 4000);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {   
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-voucher-' + i);
                    $(element).after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    
                    
                }
            } else {
                if(json['status']=='success'){
                    jQuery('span#success-msg').html('<div class="alert alert-success">Voucher reversed successfully</div>');
                    
                    jQuery('form#add-school-credit-form').find('textarea, input, select').each(function () {
                        jQuery(this).val('');
                    });
                    jQuery('#voucher_reverse').modal('hide');
                jQuery('.modal-backdrop.fade').css('display','none');
                }
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
function inline_edit(){
    jQuery('.InlineEditDiv').css('display','block');
    jQuery('.previewDiv').css('display','none');
    var inputs = $('#daily_transaction').serializeArray();
    jQuery('.edit_view').html('');
    jQuery.each(inputs, function (i, input) {
        //$('#is_submit').val('1');
         //jQuery('.edit_view').html('');
        console.log(input.name+'--')
        //var field = $('.input-transaction-'+input.name)
        var clonedField = jQuery('.input-transaction-'+input.name).clone();
        jQuery('.edit-'+input.name).html(clonedField);
        
        var dropdownfield = ['account_code','transaction_type','activity_id','location_id','coach_id','approved_by','settled_by','paid_to','bank'];
        if(jQuery.inArray( input.name, dropdownfield ) != -1){
            var selectedval = jQuery('#'+input.name).children("option:selected").val();
            jQuery('.edit-'+input.name+' #'+input.name).val(selectedval);
        }
        jQuery('#result1').html('');
    });
}

</script>
