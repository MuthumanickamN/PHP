<?php require_once 'config.php'; ?> <html>
 
 <head>
  <title>Discount Setup</title>
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
      
       document.getElementById("discount_name").value="";
        
      return false;
      }
    }


     function limit()
{
  var discount_name = document.getElementById('discount_name').value;
  
  if(discount_name.length > 30  )
  {
    alert("Discount Name Must be Twenty Digits Only");
     document.getElementById("discount_name").value="";
  } 
}

 function limits()
{
  var discount_percentage = document.getElementById('discount_percentage').value;
  
  if(discount_percentage.length > 20  )
  {
    alert("Discount Percentage Must be Twenty Digits Only");
     document.getElementById("discount_percentage").value="";
  } 
}

function allnumeric(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    
      return true;
      }
      
      else
      {
      alert('Please input numbers only');
      document.getElementById("discount_percentage").focus();
       document.getElementById("discount_percentage").value="";

      return false;
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
                  <li class="breadcrumb-item"><a href="#">Discount Setup</a>
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
            <li><a href="<?php echo site_url('index.php/discount_setup'); ?>" class="btn btn-primary"   ><b>Discount List</b></a></li>
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
                    <h4 class="card-title">Discount Setup</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Discount Name</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="discount_name" name="discount_name" required="" oninput="allLetter(document.form.discount_name); limit()" class="form-control" value="<?php echo $discount_name; ?>">
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Discount Percentage</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="discount_percentage" name="discount_percentage" required="" class="form-control" value="<?php echo $discount_percentage; ?>" oninput="allnumeric(document.form.discount_percentage); limits()">
                        </div>
                    </div>
                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($discount_name=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary"onclick="<?php echo base_url('index.php/discount_setup/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('index.php/discount_setup/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                 

                        
                         <a href="<?php echo base_url().'index.php/discount_setup' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                    
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
