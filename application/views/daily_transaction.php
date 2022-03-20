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
                  <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
            <div class="media float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right ">
                 <ul class="list-inline mb-0">
                  <li>
                    <a href="#" data-toggle="modal" data-target="#voucher_reverse2" class="btn btn-warning" style="padding: 9px;border-radius: 0px;"><b><i class="fa fa-redo"></i> Voucher Reversal</b></a>
                  </li>
            <li> <a href="<?php //echo site_url('Daily_transaction/list'); ?>" class="btn btn-primary"   ><b><i class="fa fa-file-alt"></i>Transaction List</b></a></li>
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
                      <form id="daily_transaction" class="form-horizontal daily_transaction_div" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">
                      <div class="row">
                          <div class="col-md-3 control ">
                            <span><strong>Transaction Date</strong>*</span>
                          <input type="date"  name="transaction_date" id="transaction_date" class="form-control input-transaction-transaction_date" value="<?php echo $transaction_date; ?>">
                          </div>
                          <div class="col-md-3 control ">
                            <span><strong>Account Code</strong>*</span>
                            <select name="account_code" id="account_code" class="form-control input-transaction-account_code account_code"  required="" > 
                            <option value="">Select</option>
                            <?php if(isset($account_code_data)){ 
                              foreach ($account_code_data as $account) { ?>
                              <option value="<?php echo $account['id'] ?>" <?php if(isset($account_code) && $account['id']==$account_code ){ echo 'selected';} ?>><?php echo $account['name_of_service']; ?>                              
                              </option><?php                            
                             } } ?></select>
                            </div>
                            <div class="col-md-3 control ">
                              <span><strong>Transaction Type</strong>*</span>
                              <select name="transaction_type" id="transaction_type" class="form-control input-transaction-transaction_type"  required="" > 
                                  <option value="">Select</option>    
                                  <option value="Debit" <?php if(isset($transaction_type) && $transaction_type=='Debit' ){ echo 'selected';} ?>>Debit</option>
                                  <option value="Credit" <?php if(isset($transaction_type) && $transaction_type=='Credit' ){ echo 'selected';} ?>>Credit</option>
                              </select>
                            </div>
                          </div>
                    
                    <div class="row">
                        <div class="col-md-3 control ">
                          <span><strong>Activity</strong></span>
                          <select name="activity_id" id="activity_id" class="form-control input-transaction-activity_id activity_id"  > 
                            <option value="">Select</option>
                            <?php 
                            if(isset($activityList)){ 
                            foreach ($activityList as $row) { ?>
                              <option value="<?php echo $row['game_id'] ?>" <?php if(isset($activity_id) && $row['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $row['game']; ?></option>
                          <?php } } ?>
                          </select>
                        </div>
                        <div class="col-md-3 control ">
                          <span><strong>Location</strong></span>
                         <select name="location_id" id="location_id" class="form-control input-transaction-location_id location_id"  > 
                            <option value="">Select</option>
                            <?php foreach ($locationList as $location) { ?>
                            <option value="<?php echo $location['location_id'] ?>" <?php if(isset($location_id) && $location['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $location['location']; ?></option>
                          <?php } ?>
                          </select>
                        </div>
					
                        <div class="col-md-3 control ">
                          <span><strong>Coach</strong></span>
                         <select name="coach_id" id="coach_id" class="form-control input-transaction-coach_id coach_id"  > 
                            <option value="">Select</option>
                            <?php foreach ($coachList as $coach) { ?>
                            <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_id) && $coach['coach_id']==$coach_id ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 control ">
                          <span><strong>Approved by</strong>*</span>
                         <select name="approved_by" id="approved_by" class="form-control input-transaction-approved_by approved_by" required="" > 
                            <option value="">Select</option>
                            <?php foreach ($userList as $approvedbyList) { ?>
                            <option value="<?php echo $approvedbyList['user_id'] ?>" <?php if(isset($approved_by) && $approvedbyList['user_id']==$approved_by ){ echo 'selected';} ?>><?php echo $approvedbyList['user_name']; ?></option>
                          <?php } ?>
                          </select>
                        </div>

                        <div class="col-md-3 control ">
                          <span><strong>Settled by</strong>*</span>
                         <select name="settled_by" id="settled_by" class="form-control input-transaction-settled_by settled_by" required=""  > 
                            <option value="">Select</option>
                            <?php foreach ($userList as $settledbyList) { ?>
                            <option value="<?php echo $settledbyList['user_id'] ?>" <?php if(isset($settled_by) && $settledbyList['user_id']==$settled_by ){ echo 'selected';} ?>><?php echo $settledbyList['user_name']; ?></option>
                          <?php } ?>
                          </select>
                        </div>
						
                        <div class="col-md-3 control ">
                          <span><b>Transaction Detail</b>*</span>
                           <textarea  id="transaction_detail" name="transaction_detail" required="" class="form-control input-transaction-transaction_detail" ><?php echo isset($transaction_detail)?$transaction_detail:''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                          <div class="col-md-2 control ">
                            <span><strong>Invoice no</strong>*</span>
                          <input type="text" required="" name="invoice" id="invoice" class="form-control input-transaction-invoice" value="<?php echo (isset($invoice))?$invoice:$invoice_id; ?>" >
                          </div>
                          <div class="col-md-2 control ">
                            <span><strong>Date</strong>*</span>
                          <input type="date" required=""  name="invoice_date" id="invoice_date" class="form-control input-transaction-invoice_date" value="<?php echo isset($invoice_date)?$invoice_date:''; ?>">
                          </div>
                          <div class="col-md-2 control ">
                            <span><strong>TRN No.</strong>*</span>
                          <input type="text"  name="trn_no" required="" id="trn_no" class="form-control input-transaction-trn_no" value="<?php echo isset($trn_no)?$trn_no:''; ?>">
                          </div>
                          <div class="col-md-3 control ">
                            <span><strong>Paid to</strong>*</span>
                           <select name="paid_to" id="paid_to" class="form-control input-transaction-paid_to paid_to"  > 
                              <option value="">Select</option>
                              <?php foreach ($userList as $paidtoList) { ?>
                              <option value="<?php echo $paidtoList['user_id'] ?>" <?php if(isset($paid_to) && $paidtoList['user_id']==$paid_to ){ echo 'selected';} ?>><?php echo $paidtoList['user_name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                    </div>

                      <div class="row">
                        <div class="col-md-2 control ">
                          <span><b>Transaction Amount (AED)</b>*</span>
                           <input type="text"  id="transaction_amount" name="transaction_amount" required="" class="form-control input-transaction-transaction_amount" value="<?php echo isset($transaction_amount)?$transaction_amount:''; ?>" oninput="allnumeric(document.form.transaction_amount);">
                           <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-2 control ">
                          <span> <b>Vat Percentage</b>*</span>
                              <input type="text"  id="vat_percentage" name="vat_percentage" required="" class="form-control input-transaction-vat_percentage" value="<?php echo $vatPercent; ?>">
                        </div>
                        <div class="col-md-2 control ">
                          <span><b>Vat Amount(AED)</b>*</span>
                              <input type="text"  id="vat_value" name="vat_value" required="" readonly="" class="form-control input-transaction-vat_value" value="<?php echo isset($vat_value)?$vat_value:''; ?>">
                        </div>
                        <div class="col-md-3 control ">
                          <span><b>Net Amount(AED)</b>*</span>
                              <input type="text"  id="net_amount" name="net_amount" required="" readonly=""  class="form-control input-transaction-net_amount" value="<?php echo isset($net_amount)?$net_amount:''; ?>">
                        </div>
                    </div>
                    <div class="row">
                                                
                        <div class="col-md-8 control">
                          <span><strong>Payment Type</strong>*</span>
                          <span class="input-transaction-payment_type">
                            <input id="payment_type" class="payment_cash" type="radio" value="Cash" name="payment_type" onclick="cashPayment()" <?php if(isset($payment_type) && $payment_type== 'Cash'){ echo 'checked';} ?>    />
                          <label style="margin-left: 10px; margin-right: 10px">Cash</label>
                          <input id="payment_type" type="radio" value="Card" name="payment_type"  onclick="payment_details(this.value); $('#result').show();" <?php if(isset($payment_type) && $payment_type=='Card'){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Card</label>
                           <input id="payment_type" type="radio" value="Online" name="payment_type" onclick="payment_details(this.value); $('#result').show();" <?php if(isset($payment_type) && $payment_type=='Online'){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Online</label>
                          <input id="payment_type" type="radio" value="Cheque" name="payment_type"  onclick="payment_details(this.value); $('#result').show();" <?php if(isset($payment_type) && $payment_type=='Cheque'){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Cheque</label>
                         </span>
                          
                        </div>
                    </div>
                    <?php if(isset($payment_type) && $payment_type != '' && $payment_type != 'Cash') {
                      if($payment_type=="Cheque") { ?>
                      <div class="row edit_payment_hideDiv" >
                        <div class="col-md-3 control ">
                          <p><b>Cheque No</b>*</p>
                           <input type="text"  id="cheque_number" name="cheque_number" required="" class="form-control input-transaction-cheque_number" value="<?php echo isset($cheque_number)?$cheque_number:''; ?>">
                        </div>
                        <div class="col-md-3 control ">
                          <p><b>Cheque Date</b>*</p>
                            <input type="date"  name="cheque_date" id="cheque_date" class="form-control input-transaction-cheque_date" value="<?php echo isset($cheque_date)?$cheque_date:''; ?>">
                        </div>
                        <div class="col-md-3 control ">
                          <p><strong>Bank Name</strong>*</p>
                         <select name="bank" id="bank" class="form-control input-transaction-bank bank_name"  required="">
                            <option value="">Select</option>
                            <?php if(isset($bankdetails)){
                              foreach($bankdetails as $row){?>
                                <option value="<?php echo $row['bank_name'] ?>" <?php if($row['bank_name']==$bank ){ echo 'selected';} ?>><?php echo $row['bank_name']; ?></option><?php
                            
                             } } ?></select>
                        </div>
                    </div>
                    <?php }else{?>
                      <div class="row edit_payment_hideDiv">
                      <div class="col-md-3 control ">
                          <p><strong>Bank Name</strong>*</p>
                         <select name="bank" id="bank" class="form-control input-transaction-bank bank_name"  required="">
                            <option value="">Select</option>
                            <?php if(isset($bankdetails)){
                              foreach($bankdetails as $row){?>
                                <option value="<?php echo $row['bank_name'] ?>" <?php if($row['bank_name']==$bank ){ echo 'selected';} ?>><?php echo $row['bank_name']; ?></option><?php
                            
                             } } ?></select>
                        </div>
                      </div>
                   <?php }

                  }?>
                  <?php if(isset($payment_type) && $payment_type!="") { ?>
                      <input value = "<?php echo $id; ?>" name="id" id="id" type="hidden">
                  <?php } else{ ?>
                    <input value = "0" name="is_submit" id="is_submit" type="hidden">
                  <?php } ?>
                    <div id="result" class="result"></div>

                     <div class="row">
                      <div class="col-md-6 control text-center">
                         <?php if(isset($payment_type) && $payment_type!="") { ?>
                           <button type="button" class="btn rkmd-btn btn-success add-daily-transaction" id="add-daily-transaction">Update</button>
                         <?php } else { ?>
                          <button type="button" id="preview_transaction_popup"  class="btn btn-success" ><b> Submit</b></button>
                          <!--<button type="button" class="btn rkmd-btn btn-success" id="add-daily-transaction">Submit</button>      -->
                          <?php } ?>
                         <a href="<?php echo base_url().'index.php/Daily_transaction/list/' ?>" class="btn btn-danger" >Cancel</a></div></div>
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


<?php $this->load->view('popup/voucher'); ?>

<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script src="<?php echo site_url();?>/assets/js/academy_activities.js"></script>
<script type="text/javascript">
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
function payment_details(payment_type){
  console.log(payment_type);
$.ajax({
    url:"<?php echo base_url().'index.php/Daily_transaction/payment_type/'; ?>?payment_type=payment_type",
    type:"POST",
    data:{payment_type:payment_type},
    success:function(data)
    {       
    document.getElementById('result').innerHTML=data;
    jQuery('.edit_payment_hideDiv').css('display','none'); //edit form
    if (jQuery('.input-transaction-payment_type').parent().hasClass('edit_view')) {
      document.getElementById('result1').innerHTML=data;
      //jQuery('.edit_view_payment').css('display','block');
      jQuery('.hideDiv').css('display','none');
      jQuery('.edit_view_payment').html('');
      jQuery('.edit_paymentDiv').css('display','block');
    }
    }
});
}
function cashPayment(){
jQuery('#result').hide();
jQuery('.edit_payment_hideDiv').css('display','none'); // edit form
jQuery('.edit_view_payment').html('');
jQuery('#result').html('');
jQuery('#result1').html('');
jQuery('.result input').val('');
jQuery('.result select').val('');
}

</script>



