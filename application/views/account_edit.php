<?php $this->load->view('includes/header3'); ?>
<style>
.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: relative;
    vertical-align: middle;
    text-align:left !important;
}
.upload-remove img {
    width: 30% !important;
}
</style>

<script>
  var vat_perc = "<?php echo $vat_perc;?>";
  jQuery(document).ready(function(){
    $('input[type="radio"][name="service"]').on('change',function() {
      var selected = $(this).val(); 
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>"+"AccountService/service_list",
        data:{selected:selected},
        datatype: "html",
        success : function(result)
        {
          $('#service').html(result);
        }
      });

    });
});

$(document).ready(function() {
    $("input[name='vat']").change(function() {
      //  var test = $(this).val();
        if(this.value == 'yes')
        {
          $('#vat_percentage').val(vat_perc);
          $("div.vat").show();
            var paid_amount=parseFloat(document.getElementById('paid_amount').value); 
            var vat_percentage=parseFloat(document.getElementById('vat_percentage').value);
            if (!paid_amount) { paid_amount = 0.00;  }
            var vat_value = parseFloat((vat_percentage/100)*paid_amount).toFixed(2);
            $('#vat_value').val(vat_value);
            var a=(parseFloat((vat_value)?vat_value:0.00) + parseFloat((paid_amount)?paid_amount:0.00)).toFixed(2);
            document.getElementById('payable_amount').value=parseFloat(a).toFixed(2);

        }
        else if(this.value == 'no')
        {
        $("div.vat").hide();
          var paid_amount=parseFloat(document.getElementById('paid_amount').value); 
          var vat_percentage= 0;
          if (!paid_amount) { paid_amount = 0.00;  }
          var vat_value = parseFloat((vat_percentage/100)*paid_amount).toFixed(2);
          $('#vat_value').val(vat_value);
          $('#vat_percentage').val(0.00);
          var a=(parseFloat((vat_value)?vat_value:0.00) + parseFloat((paid_amount)?paid_amount:0.00)).toFixed(2);
          document.getElementById('payable_amount').value=parseFloat(a).toFixed(2);

        }
    });
});

/*function calculation()
{

  var paid_amount=parseFloat(document.getElementById('paid_amount').value); 
  var vat_percentage= 0;
  if (!paid_amount) { paid_amount = 0.00;  }
  var vat_value = parseFloat((vat_percentage/100)*paid_amount).toFixed(2);
  $('#vat_value').val(vat_value);
  var a=(parseFloat((vat_value)?vat_value:0.00) + parseFloat((paid_amount)?paid_amount:0.00)).toFixed(2);
document.getElementById('payable_amount').value=parseFloat(a).toFixed(2);
}  */




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
  jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Please enter numbers only');
  jQuery('#'+inputtxt.id).focus();
  document.getElementById(inputtxt.id).value="";
  return false;      }
}

function calculate_amount()
{

  var paid_amount=parseFloat(document.getElementById('paid_amount').value); 
  var vat_percentage=parseFloat(document.getElementById('vat_percentage').value);
  if (!paid_amount) { paid_amount = 0.00;  }
  var vat_value = parseFloat((vat_percentage/100)*paid_amount).toFixed(2);
  $('#vat_value').val(vat_value);
  var a=(parseFloat((vat_value)?vat_value:0.00) + parseFloat((paid_amount)?paid_amount:0.00)).toFixed(2);
document.getElementById('payable_amount').value=parseFloat(a).toFixed(2);
}
function remove_upload(id)
{	

     $.ajax({
         type: "POST",
         url: "<?php echo site_url();?>AccountService/remove_upload", 
         data: {id: id},
         cache:false,
         success: 
              function(data){
				$('#upload_remove_'+id).remove();
                alert('Removed successfully');
              }
          });
}



/*function service_details(){	
	var type=document.getElementById('type').value;
$.ajax({
	url:"<?php echo base_url().'AccountService/type/'; ?>?type=type",
	type:"POST",
	data:{type:type},
	success:function(data){		
	document.getElementById('result').innerHTML=data;
	}
});

}
function service_details1(){	
	var type=document.getElementById('type').value;
$.ajax({
	url:"<?php echo base_url().'AccountService/type/'; ?>?type=type",
	type:"POST",
	data:{type:type},
	success:function(data){		
	document.getElementById('result').innerHTML=data;
	}
});

}*/

</script>



<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
<div class="content-header-left col-md-6 col-12 mb-2">
<h3 class="content-header-title" style="color: green">Academy Activities</h3>
<div class="row breadcrumbs-top">
<div class="breadcrumb-wrapper col-12">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="">Academy Activities</a>
  </li>
  <li class="breadcrumb-item"><a href="">AccountService</a>
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
          <li> <a href="<?php echo site_url('AccountService/all_list'); ?>" class="btn btn-primary"><b>AccountService List</b></a></li>
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
<form action="<?php echo site_url('AccountService/edit_details'); ?>" id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $result['Id'] ?>">
  <div class="form-group lg-btm">
  <div class="row">
  <div class="col-md-3 control"><strong>Type</strong>*
              </div>                            
        <div class="col-md-3 control">
        
          <input id="type" type="radio" value="Expenses" name="service"   <?php if(isset($type) && $type==Expense){ echo 'checked';} else { 'checked'; } ?>checked required />
          <label style="margin-left: 10px; margin-right: 10px">Expense</label>
           <input id="type" type="radio" value="Income" name="service" 
           <?php if(isset($type) && $type==Income){ echo 'checked';} ?> />
          <label style="margin-left: 10px; margin-right: 10px">Income</label>

    <span class="errorMsg"></span>
  </div>
  </div>
  </div>
  
  
  

    
    
    <div class="form-group lg-btm">
    <div class="row">
        <div class="col-md-3 control">
                <strong>Service</strong>*
              </div>                            
        <div class="col-md-3 control">
          <select class="form-control" id="service" name="service" required="">
                <option value="">Select</option>
                   <?php if(isset($account_service)){
                         foreach ($account_service as $account_service) { ?>
                            <option value="<?php echo $account_service['Id'] ?>" <?php if(isset($result['accountservice_id']) && $account_service['Id']==$result['accountservice_id'] ){ echo 'selected';} ?>><?php echo $account_service['Name']; ?></option>
                                <?php }
                                   }?>
                
          </select>
          <span class="errorMsg"></span>
          
        </div>
    </div>
     </div>




    <div id="result1"></div>
    
    <div class="form-group lg-btm">
        <div class="row">
           <div class="col-md-3 control">
              
                <strong>Amount</strong>*
              </div>                            
        <div class="col-md-3 control">
              <input type="text" id="paid_amount" name="paid_amount" required=""  value="<?php echo $result['gross_amount'];  ?>"   class="form-control" onkeyup="calculate_amount();" oninput="allnumeric(document.form.paid_amount);">
              <span class="errorMsg"></span>
			  </div>
  </div>
  </div>
  
  
  
    <div class="form-group lg-btm">
        <div class="row">
      <div class="col-md-3 control">
              <strong>VAT</strong>*
            </div>                            
      <div class="col-md-3 control ">
        
          <input id="vat" type="radio" value="yes" previousValue="" name="vat" <?php if(isset($pay_type) && $pay_type=='yes'){ echo 'checked';} else { 'checked'; }?> checked required/>
          <label style="margin-left: 10px; margin-right: 10px">Yes</label>
          <input id="vat" type="radio" value="no" previousValue="" name="vat" <?php if(isset($pay_type) && $pay_type=='no'){ echo 'checked';}?> >
          <label style="margin-left: 10px; margin-right: 10px">No</label>
          <span class="errorMsg"></span>
      </div>
  </div>
   </div>


   <div class="vat">  
     <div class="form-group lg-btm">
          <div class="row">
        <div class="col-md-3 control">
                <strong>VAT Percentage(%)</strong>*
              </div>                            
        <div class="col-md-3 control text-right">
                          <input type="text" id="vat_percentage" name="vat_percentage" required="" value="<?php echo $result['vat_percentage'];  ?>" class="form-control" readonly="">
          <span class="errorMsg"></span>
        </div>
    </div>
     </div>
    
    <div class="form-group lg-btm">
        <div class="row">
        <div class="col-md-3 control">
                <strong>VAT Value</strong>*
              </div>                            
        <div class="col-md-3 control text-right">
              <input type="text" id="vat_value" name="vat_value" required="" value="<?php echo $result['vat_amount'];?>" readonly=""  class="form-control">
          <span class="errorMsg"></span>
        </div>
    </div>
 </div>
</div>
    
     <div class="form-group lg-btm">
         <div class="row">
        <div class="col-md-3 control">
                <b>Payable Amount(inclusive of VAT)</b>*
              </div>                            
        <div class="col-md-3 control text-right">
                <input type="text" id="payable_amount" name="payable_amount" value="<?php echo $result['payable_amount'];?>"  readonly=""  class="form-control">
          <span class="errorMsg"></span>
        </div>
    </div>
     </div>
	 

     <div class="form-group lg-btm">
        <div class="row">
              <div class="col-md-3 control">
                <b>Description</b>*
              </div>                            
          <div class="col-md-3 control text-right">
            <textarea  id="description_detail" name="description_detail" required="" class="form-control input-description-description_detail" ><?php echo $result['description_detail'];?></textarea>
            <span class="errorMsg"></span>
          </div>
        </div>
        </div>


	 
	    <div class="form-group lg-btm">
         <div class="row">
        <div class="col-md-3 control">
                <b>Payable Date</b>*
              </div>                            
        <div class="col-md-3 control text-right">
                  <input type="date"  name="payable_date" class="form-control" id="payable_date"  required="" value="<?php echo $result['payable_date'];?>" >
          <span class="errorMsg"></span>
        </div>
    </div>
     </div>
	 
	 
	 
	 <div class="form-group lg-btm">	
            <div class="row">
                  <div class="col-md-3 control"><strong>Upload</strong></div>
             <div class="col-md-3 control">
               <input name="userfile[]" type="file" multiple="multiple" />
             </div>
            </div>	
            	<?php if(!empty($upload_items)) { ?>
                  <div class="row">
                      <div class="col-md-3 control"><strong>Uploaded List</strong></div>
                        <div class="col-md-3 control">
                          <?php 
                              foreach($upload_items as $uploads){ ?>
                                <p class="upload-remove" id="upload_remove_<?php echo $uploads['id']; ?>"><img src="<?php echo base_url().'assets/accounts_documents/'.$uploads['filename']; ?>">
                                <span title="Remove" id="hover-remove" style="cursor:pointer; padding-left:10px;" onclick="remove_upload('<?php echo $uploads['id']; ?>')"><i class="fa fa-remove"></i></span></p>
                          <?php } ?>
                        </div>
                      </div>	
               <?php } ?>
        </div> 

        <?php $payment_type = $result['payment_type'];
        $bank = $result['bank'];
        $cheque_date = $result['cheque_date'];
        $cheque_number = $result['cheque_number'];
        ?>
        <div class="form-group lg-btm">
        <div class="row">
          <div class="col-md-3 control">
              <strong>Payment Type</strong>*
          </div>                            
          <div class="col-md-6 control ">
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
                            
                             } } ?>
                         </select>
                        </div>
                      </div>
                   <?php }

                  }?>

<div id="result"></div> 
	 

<div class="form-group lg-btm">
              <div class="col-md-6 control text-center">
                <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" />      
                <a href="" onClick="window.location.reload();" class="btn btn-secondary" >Cancel</a>
              </div>
            </div>





  
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
</html>
<?php $this->load->view('popup/voucher'); ?>

<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script src="<?php echo site_url();?>/assets/js/academy_activities.js"></script>
<script type="text/javascript">

function payment_details(payment_type){
  //console.log(payment_type);
$.ajax({
    url:"<?php echo base_url().'index.php/AccountService/payment_type/'; ?>?payment_type=payment_type",
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



