<?php
 $this->load->view('includes/header3');
 ?>
<script>
function allnumeric(inputtxt){
  var numbers = /^[0-9]+$/;
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.value.match(numbers)){  
  if(inputtxt.id == 'postal_code'){
    var filePath = document.getElementById('postal_code').value;
    if(filePath.length>10){          
      jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Postal Code Must be Less Than Ten Digits Only');
      jQuery('#'+inputtxt.id).focus();
      document.getElementById(inputtxt.id).value="";
    }else{
        jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('');
        return true; 
    }
  }else{
     jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('');
     return true;      
   }
   }
  else{
  jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Please input numbers only');
  jQuery('#'+inputtxt.id).focus();
  document.getElementById(inputtxt.id).value="";
  return false;      }
} 


 </script>

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
        <li class="breadcrumb-item"><a href="#"><?php echo $title; ?></a>
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
        <li> <a href="<?php echo site_url('Wallet_transaction/list_'); ?>" class="btn btn-primary"   ><b>Wallet Transaction List</b></a></li>
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
<form id="walletTransactionForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">
    <div class="row">
        <div class="col-md-3 control text-left"><strong>Wallet Transaction Date</strong>*</div>
        <div class="col-md-3 control text-left">
        <input type="date"  name="wallet_transaction_date"   class="form-control" id="wallet_transaction_date"  required="" value="<?php echo isset($wallet_transaction_date)?$wallet_transaction_date:'';  ?>" >
        <span class="errorMsg"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 control">
            <strong>Wallet Transaction Type</strong>*
        </div>                            
        <div class="col-md-3 control">
            <input id="transaction_type" class="transaction_type" type="radio" value="Debit" name="wallet_transaction_type" <?php if(isset($wallet_transaction_type) && $wallet_transaction_type=='Debit'){ echo 'checked';}else{echo "checked";} ?>    />
            <label style="margin-left: 10px; margin-right: 10px">Pay</label>
            <input id="transaction_type" class="transaction_type" type="radio" value="Credit" name="wallet_transaction_type"  <?php if(isset($wallet_transaction_type) && $wallet_transaction_type=='Credit'){ echo 'checked';} ?> />
            <label style="margin-left: 10px; margin-right: 10px">Refund</label>
            <span class="errorMsg"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 control"><strong>Account Code</strong>*</div>                            
        <div class="col-md-3">
        <select name="account_code" id="account_code" class="form-control account_code"  required="">
            <option value="">Select</option>
            <?php if(isset($account_code_data)){ 
              foreach ($account_code_data as $account) { ?>
              <option value="<?php echo $account['id'] ?>" <?php if(isset($account_code) && $account['id']==$account_code ){ echo 'selected';} ?>><?php echo $account['name_of_service']; ?>                              
              </option><?php                            
             } } ?></select>
             <span class="errorMsg"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 control"><strong>Parent ID/Mobile</strong>*</div>                            
        <div class="col-md-3">
        <select name="parent_id" id="parent_id" class="form-control parent_id"  required="" onchange="parent_details()">
            <option value="0">Select</option>
            <?php foreach ($parentList as $key => $parent) {?>
            <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_id) && $parent['parent_id']==$parent_id ){ echo 'selected';} ?>><?php echo 'PS00'.$parent['parent_id'].' / '.$parent['mobile_no']; ?></option>
            <?php }  ?>
        </select>
        <span class="errorMsg"></span>
        </div>
    </div>

    <div id="result123"></div>
    
    <div class="row">
    <div class="col-md-3">
            <b>Transaction Details</b>*
          </div>                            
    <div class="col-md-3">
      <textarea  id="wallet_transaction_detail" name="wallet_transaction_detail" required="" class="form-control"><?php echo isset($wallet_transaction_detail)?$wallet_transaction_detail:''; ?></textarea>
      <span class="errorMsg"></span>
    </div>
    </div>


    <div class="row">
    <div class="col-md-3">
            <b>Transaction Amount (AED)</b>*
          </div>                            
    <div class="col-md-3">
      <input type="text" id="wallet_transaction_amount" name="wallet_transaction_amount" required=""  value="<?php echo isset($wallet_transaction_amount)?$wallet_transaction_amount:'';  ?>"   class="form-control" oninput="" >
      <span class="errorMsg"></span>
    </div>
    </div>
    <div class="row">
        <div class="col-md-3">
                <b>Vat Percentage</b>*
              </div>                            
        <div class="col-md-3">
          <input type="text" id="vat_percentage" name="vat_percentage" required=""  value="<?php echo isset($vat_percentage)?$vat_percentage:$vatPercent;  ?>"   class="form-control" readonly >
          <span class="errorMsg"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
                <b>Vat Amount(AED)</b>*
              </div>                            
        <div class="col-md-3">
          <input type="text" id="vat_value" name="vat_value" required=""  value="<?php echo isset($vat_value)?$vat_value:'';  ?>"   class="form-control" readonly >
          <span class="errorMsg"></span>
        </div>
    </div>
    <div class="refundDiv" style="display:none">
    <div class="row">
        <div class="col-md-3">
                <b>Refund Percentage</b>*
              </div>                            
        <div class="col-md-3">
          <input type="text" id="refund_percentage" name="refund_percentage" required=""  value="<?php echo isset($refund_percentage)?$refund_percentage:$refundPercent;  ?>"   class="form-control" readonly >
          <span class="errorMsg"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
                <b>Refund Amount(AED)</b>*
              </div>                            
        <div class="col-md-3">
          <input type="text" id="refund_value" name="refund_value" required=""  value="<?php echo isset($refund_value)?$refund_value:'';  ?>"   class="form-control" readonly >
          <span class="errorMsg"></span>
        </div>
    </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
                <b>Net Amount(AED)</b>*
              </div>                            
        <div class="col-md-3">
          <input type="text" id="net_amount" name="net_amount" required=""  value="<?php echo isset($net_amount)?$net_amount:'';  ?>"   class="form-control" readonly >
          <span class="errorMsg"></span>
        </div>
    </div>

    

    <div class="row">
    <div class="col-md-6 control text-center">

     <?php if(isset($wallet_transaction_amount) && $wallet_transaction_amount!="") { ?>
        <input value = "<?php echo $id; ?>" name="id" id="id" type="hidden">
       <button type="button" class="btn rkmd-btn btn-secondary add-wallet-transaction" id="add-wallet-transaction">Update</button> 
     <?php } else { ?>
      <button type="button" class="btn rkmd-btn btn-secondary add-wallet-transaction" id="add-wallet-transaction">Submit</button>         
    <?php } ?>

     <a href="<?php echo base_url().'index.php/Wallet_transaction/list_' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
</form>

</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<?php $this->load->view('includes/footer_select2'); ?>
<script type="text/javascript">
function parent_details(){ 
    var parent_id=document.getElementById('parent_id').value;
    $.ajax({
        url:"<?php echo base_url().'index.php/Wallet_transaction/payment/'; ?>?parent_id=parent_id",
        type:"POST",
        data:{parent_id:parent_id},
        success:function(data){   

           document.getElementById('result123').innerHTML=data;
				$('.student_id').select2();
        }
    });
}

$( document ).ready(function() {
	$('.parent_id').select2();
	$('.account_code').select2();
	$('.student_id').select2();
});
jQuery(document).on('keyup', '#wallet_transaction_amount', function(){

    var amount = (jQuery(this).val())?jQuery(this).val():0.00;
    var total_credit = jQuery('#total_credit').val();

    var vatpercent = jQuery('#vat_percentage').val();
    var type = $("input[name='wallet_transaction_type']:checked").val();
    var percentvalue = parseFloat(amount*vatpercent /100).toFixed(2);
    var netamount = (parseFloat(amount) + parseFloat(percentvalue)).toFixed(2);
    jQuery('#vat_value').val(percentvalue);
    
    //alert(type);
    // refund amount
    if(type == 'Credit'){
        var refundpercent = jQuery('#refund_percentage').val();
        var refundvalue = (parseFloat(amount*refundpercent /100)+parseFloat(percentvalue)).toFixed(2);
        jQuery('#refund_value').val(refundvalue);
        jQuery('#net_amount').val(refundvalue);
    }else{
        jQuery('#net_amount').val(netamount);
        if(parseFloat(netamount) > parseFloat(total_credit) ){
        $('#wallet_transaction_amount').parent().find(".errorMsg").html('Insufficent wallet balance.');
        $('#wallet_transaction_amount').focus();
        $('#wallet_transaction_amount').val('');
        }
    }
    

});
    jQuery('.transaction_type').change(function(){
        var type = $(this).val();
        $('#wallet_transaction_amount').val('');
        $('#vat_value').val('');
        $('#refund_value').val('');
        $('#refund_value').val('');
        $('#net_amount').val('');
        if(type == 'Credit'){
            $('.refundDiv').css('display','block');
        }else{
            $('.refundDiv').css('display','none');
        }
    });
parent_details();

jQuery(document).on('click', 'button.add-wallet-transaction', function(e){

      jQuery.ajax({
        type:'POST',
        url:baseurl+'Wallet_transaction/save',
        data:jQuery("form#walletTransactionForm").serialize(),
        dataType:'json',    
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                     var element = $('#'+ i);
                    $(element).parent().find(".errorMsg").html(json['error'][i]);
                }
            } else {
                if(json['status'] == 'success'){
                jQuery('form#walletTransactionForm').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'Wallet_transaction/list_';
            }
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
</script>