<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Refund Discount Percentage</title>
</head>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<script type="text/javascript">
    function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
    
       document.getElementById("name").value="";
      
      return false;
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
      document.getElementById("percentage").focus();
       document.getElementById("percentage").value="";

      return false;
      }
   } 
   function limit()
   {
     var name = document.getElementById('name').value;
     if(name.length >30 )
     {
      alert('Dicount name Must be 30 Digits');
      document.getElementById("name").value="";


     }
   }
     function limits()
   {
     var percentage = document.getElementById('percentage').value;
     if(percentage.length >20 )
     {
      alert('Dicount Percentage Must be 20 Digits');
      document.getElementById("percentage").value="";


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
                  <li class="breadcrumb-item"><a href="#">Refund Discount Percentage</a>
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
            <li><a href="<?php echo site_url('index.php/refund_discount_percentages'); ?>" class="btn btn-primary"   ><b>Refund Discount List</b></a></li>
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
                    <h4 class="card-title">Refund Discount Percentage</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Name</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="name" name="name" placeholder="Enter Name" required="" oninput="allLetter(document.form.name); limit()" class="form-control" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Description</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <textarea id="description" name="description"  value="" class="form-control" required="" placeholder="Enter Discription"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Percentage</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="percentage" name="percentage" required="" class="form-control" value="<?php echo $percentage; ?>" placeholder="Enter Percentage"  oninput="allnumeric(document.form.percentage); limits()">
                        </div>
                    </div>

                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                          <?php if($name=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('index.php/refund_discount_percentages/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('index.php/refund_discount_percentages/add/'); ?>"       class="btn btn-success" /><?php } ?>

                        
                        
                         <a href="<?php echo base_url().'index.php/refund_discount_percentages' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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
