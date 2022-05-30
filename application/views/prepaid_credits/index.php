<?php
 $this->load->view('includes/header3');
 ?>
 <script>

function allnumeric(inputtxt){
  var numbers = /^[0-9]*\.?[0-9]*$/;
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

function parent_details(){ 
var parent_id=document.getElementById('parent_id').value;
  $.ajax({
  url:"<?php echo base_url().'Prepaid_credits/payment/'; ?>?parent_id=parent_id",
  type:"POST",
  data:{parent_id:parent_id},
  success:function(data){   
  document.getElementById('result123').innerHTML=data;
  }
});
}

function payment_details(){	
	var payment_type=document.getElementById('payment_type').value;
$.ajax({
	url:"<?php echo base_url().'Prepaid_credits/payment_type/'; ?>?payment_type=payment_type",
	type:"POST",
	data:{payment_type:payment_type},
	success:function(data){		
	document.getElementById('result').innerHTML=data;
	}
});

}
  function payment_detailss(){ 
  var payment_type=document.getElementById('payment_type').value;
  
$.ajax({
  
  url:"<?php echo base_url().'Prepaid_credits/payment_types/'; ?>?payment_type=payment_type",
  type:"POST",
  data:{payment_type:payment_type},
  success:function(data)
  {   
  document.getElementById('result').innerHTML=data;
  
  }
});

}

function calculate_amount()
{

  var paid_amount=parseFloat(document.getElementById('paid_amount').value);
  var balance_credits=parseFloat(document.getElementById('balance_credits').value);

  var a=(parseFloat((balance_credits)?balance_credits:0.00) + parseFloat((paid_amount)?paid_amount:0.00)).toFixed(2);



document.getElementById('total_credits').value=parseFloat(a).toFixed(2);

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
      <li class="breadcrumb-item"><a href="">Academy Activites</a>
      </li>
      <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
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
<li> <a href="<?php echo site_url('Prepaid_credits/list_'); ?>" class="btn btn-primary"   ><b>Credit List</b></a></li>
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
      <form id="prepaidCreditForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">

        <div class="row">
            <div class="col-md-3">
                    <strong>Parent ID/Mobile</strong>*
                  </div>                            
        <div class="col-md-3">
          <select name="parent_id" id="parent_id" class="form-control js-example-basic-single parent_id_select2"  required="" oninput="parent_details()">
              <option value="">Select</option>
              <?php foreach ($parentList as $key => $parent) {?>
              <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_id) && $parent['parent_id']==$parent_id ){ echo 'selected';} ?>><?php echo $parent['parent_code'].' / '.$parent['mobile_no']; ?></option>
              <?php }  ?>
          </select>
          <span class="errorMsg"></span>
        </div>
        </div>

        <div id="result123"></div>
        <div class="row">
            <div class="col-md-3">
                    <b>Amount (AED)</b>*
                  </div>                            
            <div class="col-md-3">
              <input type="text" id="paid_amount" name="paid_amount" required=""  value="<?php echo isset($amount_paid)?$amount_paid:'';  ?>"   class="form-control"  oninput="allnumeric(document.form.paid_amount); calculate_amount();">
              <span class="errorMsg"></span>
            </div>
        </div>
         <div class="row">
            <div class="col-md-3">
                    <b>Description</b>*
                  </div>                            
            <div class="col-md-3">
              <textarea  id="description" name="description" required="" class="form-control"><?php echo isset($description)?$description:''; ?></textarea>
              <span class="errorMsg"></span>
            </div>
        </div>
        <div class="row">
          <div class="col-md-3">
                <strong>Payment Type</strong>*
              </div>                            
          <div class="col-md-4 control">
            <input id="payment_type" type="radio" value="Cash" name="payment_type" onclick="$('#result').hide();" <?php if(isset($payment_type) && $payment_type==Cash){ echo 'checked';} ?>    />
          <label style="margin-left: 10px; margin-right: 10px">Cash</label>
          <input id="payment_type" type="radio" value="Card" name="payment_type"  onclick="payment_details(); $('#result').show();" <?php if(isset($payment_type) && $payment_type==Card){ echo 'checked';} ?> />
          <label style="margin-left: 10px; margin-right: 10px">Card</label>
           <input id="payment_type" type="radio" value="Online" name="payment_type" onclick="payment_details(); $('#result').show();" <?php if(isset($payment_type) && $payment_type==Online){ echo 'checked';} ?> />
          <label style="margin-left: 10px; margin-right: 10px">Online</label>
          <input id="payment_type" type="radio" value="Cheque" name="payment_type"  onclick="payment_detailss(); $('#result').show();" <?php if(isset($payment_type) && $payment_type==Cheque){ echo 'checked';} ?> />
          <label style="margin-left: 10px; margin-right: 10px">Cheque</label>
          <br><span class="errorMsg"></span>
        </div>
        </div>

        <div id="result"></div>
        <div class="row">
          <div class="col-md-6 control text-center">
             <?php if(isset($payment_type) && $payment_type!="") { ?>
               <button type="button" class="btn rkmd-btn btn-success add-prepaid-credit" id="add-prepaid-credit">Update</button>          
             <?php } else { ?>
              <button type="button" class="btn rkmd-btn btn-success add-prepaid-credit" id="add-prepaid-credit">Submit</button>          
              <?php } ?>
             <a href="<?php echo base_url().'prepaid_credits/list_' ?>"     class="btn btn-danger" >Cancel</a>
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
<script>
  $(document).ready(function (ev) {
    parent_details();
    $('.parent_id_select2').select2();
    jQuery(document).on('click', '#add-prepaid-credit', function(e){
      //alert(2);
      e.stopImmediatePropagation();
      e.preventDefault();
      if(!$('#add-prepaid-credit').hasClass('locked'))
      {
        $('#add-prepaid-credit').addClass('locked');
        $('#add-prepaid-credit').prop('disabled', true);
        
        add();
        $('#add-prepaid-credit').prop('disabled', false);
      }
    
});
});
function add()
{
  jQuery.ajax({
        type:'POST',
        url:baseurl+'Prepaid_credits/save',
        data:jQuery("form#prepaidCreditForm").serialize(),
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
                jQuery('form#prepaidCreditForm').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'Prepaid_credits/list_';
            }
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(this_).prop('disabled', false);
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
</script>