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
</style>

<script>
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
          $("div.vat").show();
        }
        else if(this.value == 'no')
        {
        $("div.vat").hide();
        }
    });
});




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
<?php if($role == 'superadmin' || $role == 'admin'){?>
<div class="media-body media-right text-right">
 

</div>
<?php } ?>
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
<form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">




<div class="form-group lg-btm">
    <div class="row">
        <div class="col-md-3 control">
                <strong>Type</strong>*
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
  <div class="col-md-3 control"><strong>Service</strong>*</div>                            
  <div class="col-md-3 control text-right">
  
<select class="form-control" id="service" name="service" required="">
                <option value="">Select</option>
                   <?php if(isset($account_service)){
                         foreach ($account_service as $account_service) { ?>
                            <option value="<?php echo $account_service['Id'] ?>" <?php if(isset($service) && $account_service['Id']==$service ){ echo 'selected';} ?>><?php echo $account_service['Name']; ?></option>
                                <?php }
                                   }?>
                
          </select>
    <span class="errorMsg"></span>
  </div>
  </div>
  </div>


  <div id="result123"></div>
        <div class="row">
            <div class="col-md-3">
                    <b>Amount</b>*
                  </div>                            
            <div class="col-md-3">
              <input type="text" id="paid_amount" name="paid_amount" required=""  value="<?php echo isset($amount_paid)?$amount_paid:'';  ?>"   class="form-control"  oninput="allnumeric(document.form.paid_amount); calculate_amount();">
              <span class="errorMsg"></span>
            </div>
        </div>

  <div class="form-group lg-btm">
    <div class="row">
        <div class="col-md-3 control">
                <strong>VAT</strong>*
              </div>                            
        <div class="col-md-3 control">
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
                          <input type="text" id="vat_percentage" name="vat_percentage" required="" value="<?php echo isset($vat_perc)?    $vat_perc:'0'; ?>" class="form-control" readonly="">
                          <span class="errorMsg"></span>
                        </div>
              </div>
         </div>
      
        <div class="form-group lg-btm">
          <div class="row">
                <div class="col-md-3 control">
                <strong>Vat Value</strong>*
                </div>                            
              <div class="col-md-3">
              <input type="text" id="vat_value" name="vat_value" required="" value="" readonly=""  class="form-control">
              <span class="errorMsg"></span>        
              </div>
          </div>
        </div>
    </div>
    
     <div class="form-group lg-btm">
         <div class="row">
        <div class="col-md-3 control">
                <b>Payable Amount</b>*
              </div>     
              <div class="col-md-3">
<input type="text" id="payable_amount" name="payable_amount" value="<?php echo isset($wallet['payable_amount'])?$wallet['payable_amount']:0; ?>"  readonly=""  class="form-control">
<span class="errorMsg"></span>
        </div>
    </div>
     </div>
     
    
    <div class="row">
        <div class="col-md-3 control text-left"><strong>Payable Date</strong>*</div>
        <div class="col-md-3 control text-left">
        <input type="date"  name="payable_date"   class="form-control" id="payable_date"  required="" value="<?php echo isset($payable_date)?$payable_date:'';  ?>" >
        <span class="errorMsg"></span>
        </div>
    </div>

    
     <div class="form-group lg-btm">
      <div class="col-md-6 control text-center">
        <input id="save" type="submit" name="submit" value="Submit" class="btn btn-success" />           
        <a href="<?php echo base_url().'accountservice' ?>"     class="btn btn-danger" >Cancel</a></div></div>
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


