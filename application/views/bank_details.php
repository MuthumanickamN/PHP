<html>
 
 <head>
  <title>Bank Details</title>
</head>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<body> <?php $this->load->view('includes/header3'); ?>

<script type="text/javascript">
    function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      
       document.getElementById("bank_name").value="";
      
      return false;
      }
    }
   function allLetters(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      
       document.getElementById("bank_location").value="";
      
      return false;
      }
    }

    function limit()
{
  var bank_name = document.getElementById('bank_name').value;
  
  if(bank_name.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("bank_name").value="";
  } 
}

 function limits()
{
  var bank_location = document.getElementById('bank_location').value;
  
  if(bank_location.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("bank_location").value="";
  } 
}

function limits()
{
  var IBAN_No = document.getElementById('IBAN_No').value;
  
  if(IBAN_No.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("IBAN_No").value="";
  } 
}
function limits()
{
  var Account_No = document.getElementById('Account_No').value;
  
  if(Account_No.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("Account_No").value="";
  } 
}
function limits()
{
  var Swift_Code = document.getElementById('Swift_Code').value;
  
  if(Swift_Code.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("Swift_Code").value="";
  } 
}
function limits()
{
  var IFSC_Code = document.getElementById('IFSC_Code').value;
  
  if(IFSC_Code.length>40   )
  {
    alert("Activity Must be 40 characters Only");
     document.getElementById("IFSC_Code").value="";
  } 
}
</script>

<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Maintenance</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Maintenance</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Bank</a>
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
            <li><a href="<?php echo site_url('bank_details'); ?>" class="btn btn-primary"   ><b>Bank List</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bank Detail</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
            <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Bank Name</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="bank_name" name="bank_name" required=""  class="form-control" value="<?php echo $bank_name; ?>">
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Bank Location</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="bank_location" name="bank_location" required="" class="form-control" value="<?php echo $bank_location; ?>" >
                        </div>
                    </div>

                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>IBAN No</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="IBAN_No" name="IBAN_No" required="" class="form-control" value="<?php echo $IBAN_No; ?>" >
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Account No</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="Account_No" name="Account_No" required="" class="form-control" value="<?php echo $Account_No; ?>" >
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Swift Code</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="Swift_Code" name="Swift_Code" required="" class="form-control" value="<?php echo $Swift_Code; ?>" >
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>IFSC Code</strong></div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="IFSC_Code" name="IFSC_Code"  class="form-control" value="<?php echo $IFSC_Code; ?>" >
                        </div>
                    </div>
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($bank_location=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" onclick="<?php echo base_url('bank_details/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('bank_details/add/'); ?>"       class="btn btn-success" /><?php } ?>

                        
                        
                         <a href="<?php echo base_url().'bank_details' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                    
                </form>
            </div>
        </div></div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</body>

</html>  


