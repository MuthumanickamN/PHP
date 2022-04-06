<?php require_once 'config.php'; ?> <html>
 <head>
  <title>Attendance Book</title>
</head>
 <?php $this->load->view('includes/header3'); ?>


 <meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <style type="text/css">
    .limitedNumbChosen, .limitedNumbSelect2{
  width: 308px;
}
.choiceChosen, .productChosen {
  width: 308px ;
}
 </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
 	function payment_details()
{	
  
	var payment_type=document.getElementById('payment_type').value;
  
$.ajax({
	
	url:"<?php echo base_url().'index.php/Daily_transaction/payment_type/'; ?>?payment_type=payment_type",
	type:"POST",
	data:{payment_type:payment_type},
	success:function(data)
	{		
	document.getElementById('result').innerHTML=data;
	
	}
});

}
  function payment_detailss()
{ 
  
  var payment_type=document.getElementById('payment_type').value;
  
$.ajax({
  
  url:"<?php echo base_url().'index.php/Daily_transaction/payment_types/'; ?>?payment_type=payment_type",
  type:"POST",
  data:{payment_type:payment_type},
  success:function(data)
  {   
  document.getElementById('result').innerHTML=data;
  
  }
});

}

function calculate()
{

var transaction_amount=parseFloat(document.getElementById('transaction_amount').value);
var vat_percentage=parseFloat(document.getElementById('vat_percentage').value);

var payable_amount=parseFloat(transaction_amount) + parseFloat(transaction_amount * vat_percentage / 100);

var vat_amount= parseFloat(transaction_amount * vat_percentage / 100);

document.getElementById('vat_amount').value=vat_amount;


document.getElementById('net_amount').value=payable_amount;

}
  $(document).ready(function(){
  //Chosen
  $(".limitedNumbChosen").chosen({
    max_selected_options: 2,
    placeholder_text_multiple: "Select Time From"
  })
  .bind("chosen:maxselected", function (){
    window.alert("You reached your limited number of selections which is 2 selections!");
  })
  //Select2
  $(".limitedNumbSelect2").select2({
    maximumSelectionLength: 2,
    placeholder: "Select Time From"
  })
});

  $(document).ready(function(){
  //Chosen
  $(".choiceChosen, .productChosen").chosen({});
  //Logic
  $(".choiceChosen").change(function(){
    if($(".choiceChosen option:selected").val()=="no"){
      $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
    } else {
      $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
    }
  })
})

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
                  <li class="breadcrumb-item"><a href="#">Attendance Book</a>
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
            <li> <a href="<?php echo site_url('index.php/Attendance_book/list_'); ?>" class="btn btn-primary"   ><b>Attendance List</b></a></li>
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
                    <h4 class="card-title">Attendance Book</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
    <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">

         <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Traansaction Date</strong>*
                              </div>                            
                    <div class="col-md-4 control text-right">
                  <input type="date"  name="transaction_date" id="transaction_date" class="form-control" value="<?php echo $transaction_date; ?>">
                        </div>
                    </div>

                    

                   
                    
                    
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Transaction Type</strong>*
                              </div>                            
                        <div class="col-md-4 control">
                           <input id="transaction_type" type="radio" value="Credit" name="transaction_type" <?php if($transaction_type==Credit){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Credit</label>
                          <input id="transaction_type" type="radio" value="Debit" name="transaction_type"  <?php if($transaction_type==Debit){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px">Debit</label>
                          
                        </div>
                    </div>

                    <div id="result1"></div>

                     
                     <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Account Code</strong>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                         <select name="account_code" id="account_code" class="form-control"  required="" > 
                            <option value="0">Select</option>
                            <?php
                        
                          $osql = "select * from account_codes WHERE status='Active'";                              
                          $oexe = mysqli_query( $con, $osql );

    
                         while ( $row = mysqli_fetch_assoc( $oexe ) ){ ?>
                        <option value="<?php echo $row['name_of_service'] ?>" <?php if($row['name_of_service']==$account_code ){ echo 'selected';} ?>><?php echo $row['name_of_service']; ?>
                              
                            </option><?php
                            
                             }  ?></select>
                        </div>
                    </div>
                     <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Transaction Detail</b>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                           <textarea  id="transaction_detail" name="transaction_detail" required="" class="form-control" ><?php echo $transaction_detail; ?></textarea>
                        </div>
                    </div>

                      <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Transaction Amount (AED)</b>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                           <input type="text"  id="transaction_amount" name="transaction_amount" required="" class="form-control" value="<?php echo $transaction_amount; ?>" oninput="calculate()">
                        </div>
                    </div>

                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Vat Percentage</b>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                              <input type="text"  id="vat_percentage" name="vat_percentage" required="" class="form-control" value="5">
                        </div>
                    </div>

                      <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Vat Amount(AED)</b>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                              <input type="text"  id="vat_amount" name="vat_amount" required="" class="form-control" value="<?php echo $vat_value; ?>">
                        </div>
                    </div>

                      <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Net Amount</b>*
                              </div>                            
                        <div class="col-md-4 control text-right">
                              <input type="text"  id="net_amount" name="net_amount" required="" class="form-control" value="<?php echo $net_amount; ?>">
                        </div>
                    </div>


                        <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Payment Type</strong>*
                              </div>                            
                        <div class="col-md-4 control">
                            <input id="payment_type" type="radio" value="Cash" name="payment_type" onclick="$('#result').hide();" <?php if($payment_type==Cash){ echo 'checked';} ?>    />
                          <label style="margin-left: 10px; margin-right: 10px">Cash</label>
                          <input id="payment_type" type="radio" value="Card" name="payment_type"  onclick="payment_details(); $('#result').show();" <?php if($payment_type==Card){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Card</label>
                           <input id="payment_type" type="radio" value="Online" name="payment_type" onclick="payment_details(); $('#result').show();" <?php if($payment_type==Online){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Online</label>
                          <input id="payment_type" type="radio" value="Cheque" name="payment_type"  onclick="payment_detailss(); $('#result').show();" <?php if($payment_type==Cheque){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Cheque</label>
                         
                          
                        </div>
                    </div>

                    <div id="result"></div>


                   

                    








                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">

                         <?php if($payment_type!="") { ?>

                           <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('index.php/Daily_transaction/edit/'); ?>"       class="btn btn-success" />   
                         <?php } else { ?>

                          <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('index.php/Daily_transaction/add/'); ?>"       class="btn btn-success" />          
<?php } ?>
                        
                         <a href="<?php echo base_url().'index.php/Daily_transaction/add/' ?>"     class="btn btn-danger" >Cancel</a></div></div>

             
                  





                  
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

  <script>
    student_details();
    calculate();

</script>