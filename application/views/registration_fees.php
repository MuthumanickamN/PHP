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
var edit = "<?php echo $edit;?>";
$( document ).ready(function() {
    wallet_details();
    $("input[type='radio']").click(function()
    {
      var previousValue = $(this).attr('previousValue');
      var name = $(this).attr('name');
    
      if (previousValue == 'checked')
      {
        $(this).removeAttr('checked');
        $(this).attr('previousValue', false);
        document.getElementById('result1').innerHTML="";  
        
      }
      else
      {
        $("input[name="+name+"]:radio").attr('previousValue', false);
        $(this).attr('previousValue', 'checked');
        
        wallet_details();
      }
    });
});

function student_details(){	
  var student_id=document.getElementById('student_id').value;
  if(student_id !== '0' && student_id != '')
  {
      $.ajax({
        url:"<?php echo base_url().'registration_fees/student_details/'; ?>",
        type:"POST",
        data:{student_id:student_id},
        async:false,
        success:function(data){		
          document.getElementById('result').innerHTML=data;
          
          if($('#payment_type').is(":checked"))
          {
            wallet_details();
          }
          else
          {
            document.getElementById('result1').innerHTML="";  
          }
          
        }
      });
     
      $.ajax({
        url:"<?php echo base_url().'registration_fees/get_category_fees'; ?>",
        type:"POST",
        async:false,
        data:{student_id:student_id},
        success:function(data){		
          var obj = JSON.parse(data);
          $('#catagory').val(obj['category']);
          $('#reg_fee_amount').val(obj['reg_fee']);
          
          var vat_perc = $('#vat_percentage').val();
          //console.log(vat_perc);
          var vat_value = parseFloat((parseFloat(obj['reg_fee'])*parseFloat(vat_perc))/100).toFixed(2);
          //console.log(vat_value);
          var total_value = (parseFloat(obj['reg_fee'])+parseFloat(vat_value)).toFixed(2);
          //console.log(total_value);
          //console.log(obj['reg_fee']);
          
          $('#reg_fee_amount').val(obj['reg_fee']);
          $('#vat_value').val(vat_value);
          $('#payable_amount').val(total_value);
          var wallet_amount =  $('#wallet_amount').val();
          if (parseFloat(total_value) > parseFloat(wallet_amount))
          {
              
            $('#wallet_amount').css('border-color','red');  
            $('#wallet_amount').css('border-width','2px'); 
            $('#save').attr('disabled', true);
            $('.errorWalletMsg').text('Insufficient amount in Wallet.');
          }
          else
          {
              
            $('#wallet_amount').css('border-color','green');  
            $('#wallet_amount').css('border-width','2px'); 
            $('#save').attr('disabled', false);
            $('.errorWalletMsg').text('');
          }
        }
      });
  }
  else
  {
    document.getElementById('result').innerHTML="";   
    document.getElementById('result1').innerHTML="";  
  }
  
  

}
function wallet_details(){
    
    if(document.getElementById('parent_id'))
    {
    var parent_id=document.getElementById('parent_id').value;
    if(parent_id !=''){
      $.ajax({
      url:"<?php echo base_url().'registration_fees/wallet_details/'; ?>",
      async:false,
      type:"POST",
      data:{parent_id:parent_id},
      success:function(data)
      {		
      document.getElementById('result1').innerHTML=data;
    
      }
      });
    }
    else
    {
        document.getElementById('result1').innerHTML="";
    }
    }
    else
    {
        document.getElementById('result1').innerHTML="";
    }


}
function calculate(){

  var amount = jQuery('#reg_fee_amount').val();

    var vatpercent = jQuery('#vat_percentage').val();
    var percentvalue = (amount*vatpercent /100);
    var netamount = parseFloat(amount) + parseFloat(percentvalue);
    jQuery('#vat_value').val(percentvalue);
    jQuery('#payable_amount').val(netamount);


}

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
 <ul class="list-inline mb-0">
<li> <a href="<?php echo site_url('Registration_fees/list_'); ?>" class="btn btn-primary"   ><b>Registration Fees List</b></a></li>
</ul>

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
  <div class="col-md-3 control"><strong>Registration ID/Name</strong>*</div>                            
  <div class="col-md-3 control text-right">
    <select name="student_id" id="student_id" class="form-control student_id"  required="" onchange="student_details()">
      <option value="">Select</option>
      <?php foreach ($studentList as $key => $row){ ?>
      <option value="<?php echo $row['id'] ?>" <?php if(isset($student_id) && $row['id']==$student_id ){ echo 'selected';} ?>><?php echo $row['sid']; ?>-<?php echo $row['name']; ?>
      </option><?php } ?>
    </select>
    <span class="errorMsg"></span>
  </div>
  </div>
  </div>

    <div id="result"></div> 
    
    <div class="form-group lg-btm">
    <div class="row">
        <div class="col-md-3 control">
                <strong>Payment Type</strong>*
              </div>                            
        <div class="col-md-3 control">
          <input id="payment_type" type="radio" value="Wallet" previousValue="" name="payment_type" <?php if(isset($pay_type) && $pay_type=='wallet'){ echo 'checked';} else { 'checked'; }?> checked required/>
          <label style="margin-left: 10px; margin-right: 10px">Wallet</label>
          <span class="errorMsg"></span>
          
        </div>
    </div>
     </div>

    <div id="result1"></div>
    
    <div class="form-group lg-btm">
        <div class="row">
      <div class="col-md-3 control">
              <strong>Category</strong>*
            </div>                            
      <div class="col-md-3 control text-right">
        <input type="text" id="catagory" name="catagory" required="" value="<?php echo isset($category)?$category:''; ?>" readonly=""  class="form-control">
      </div>
  </div>
  </div>
  
    <div class="form-group lg-btm">
        <div class="row">
      <div class="col-md-3 control">
              <strong>Reg-Fee Amount(AED)</strong>*
            </div>                            
      <div class="col-md-3 control text-right">
        <input type="text" id="reg_fee_amount" name="reg_fee_amount" value="<?php echo isset($reg_fee)?$reg_fee:''; ?>" oninput="calculate()" readonly=""  class="form-control">
      </div>
  </div>
   </div>
    
     <div class="form-group lg-btm">
          <div class="row">
        <div class="col-md-3 control">
                <strong>VAT Percentage(%)</strong>*
              </div>                            
        <div class="col-md-3 control text-right">
          <input type="text" id="vat_percentage" name="vat_percentage" required="" value="<?php echo isset($vat_perc)?$vat_perc:'0'; ?>" class="form-control" readonly="">
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
          <input type="text" id="vat_value" name="vat_value" required="" value="" readonly=""  class="form-control">
          <span class="errorMsg"></span>
        </div>
    </div>
 </div>
    
     <div class="form-group lg-btm">
         <div class="row">
        <div class="col-md-3 control">
                <b>Payable Amount(inclusive of VAT)</b>*
              </div>                            
        <div class="col-md-3 control text-right">
          <input type="text" id="payable_amount" name="payable_amount" required="" readonly="" value="<?php echo isset($wallet_balance)?$wallet_balance:'';  ?>" oninput="allnumeric(document.form.payable_amount);"   class="form-control" >
          <span class="errorMsg"></span>
        </div>
    </div>
     </div>
     <div class="row">
            <div class="col-md-3">
                    <strong>Location</strong>*
                  </div>                            
        <div class="col-md-3">
        <select class="form-control location" id="location_id" name="location_id">
                  <option value="">Select</option>
                      <?php if(isset($locationList)){
                      foreach ($locationList as $key=>$location) { ?>
                      <option value="<?php echo $location['location_id'] ?>" <?php if($location['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $location['location'] ?></option>
                  
                  <?php }
                  }?>
          </select>
          <span class="errorMsg"></span>
        </div>
        </div>


     <div class="form-group lg-btm">
      <div class="col-md-6 control text-center">
      <?php if(isset($student_id) && $student_id!="") { ?>
         <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('registration_fees/edit/'); ?>"       class="btn btn-success" />     <?php } else { ?>
          <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" onclick="<?php echo base_url('registration_fees/add/'); ?>"       class="btn btn-success" />          
          <?php } ?>
        
         <a href="<?php echo base_url().'Registration_fees' ?>"     class="btn btn-secondary" >Cancel</a></div></div>





  
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
<?php
	 $this->load->view('includes/footer_select2');
?>
<script>
$(document).ready(function (e) {
	$('.student_id').select2();
  $('#location_id').select2();
});

if(edit == 1)
{
  student_details();
  calculate();
}
</script>