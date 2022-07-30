<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>VAT Setup</title>
</head>
<script type="text/javascript">
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
    function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
    
      
       document.getElementById("tax").value="";
      return false;
      }
    }
    
    function fileValidation(fileInput) {
  var filePath = fileInput.value; 
  // Allowing file type 
  var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
  if (!allowedExtensions.exec(filePath)) { 
      jQuery('#'+fileInput.id).parent().find(".errorMsg").html('Invalid file type (Accept only jpeg, png, jpg, gif)'); 
      fileInput.value = ''; 
      return false; 
  }  
  else{ 
      // Image preview 
      if (fileInput.files && fileInput.files[0]) { 
          var reader = new FileReader(); 
          reader.onload = function(e) { 
              document.getElementById( 
                  'imagePreview').innerHTML =  
                  '<img src="' + e.target.result 
                  + '"/>'; 
          }; 
          reader.readAsDataURL(fileInput.files[0]); 
      } 
  } 
}
</script>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


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
                  <li class="breadcrumb-item"><a href="#">VAT Setup</a>
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
            <li><a href="<?php echo site_url('vat_setup'); ?>" class="btn btn-primary"   ><b>VAT List</b></a></li>
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
                    <h4 class="card-title">VAT Setup</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" enctype="multipart/form-data"  role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
         <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Tax</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="tax" name="tax" required=""  class="form-control" value="<?php echo $tax; ?>">
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
                         <input type="text" id="percentage" name="percentage" required=""  class="form-control" value="<?php echo $percentage; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>VAT No.</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="vat_no" name="vat_no" required=""  class="form-control" value="<?php echo $vat_no; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group lg">

                      <?php if(!isset($vat_pdf) || $vat_pdf=="") { ?>
                  <div class="col-md-3 control text-left"><strong>VAT PDF DOC</strong> 
                    </div> <div class="col-md-5"><input type="file" name="vat_pdf" id="vat_pdf" onchange="return fileValidation(document.form.vat_pdf)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                        <div class="col-md-3 control text-left"><strong>>VAT PDF DOC</strong> </div> <div class="col-md-5">
                    <input type="file" name="vat_pdf" id="vat_pdf" onchange="return fileValidation(document.form.vat_pdf)" >
                     <input type="hidden" id="vat_pdf1" name="vat_pdf1" value="<?php echo $vat_pdf; ?>"> 
                    
                    (<?php echo $vat_pdf; ?>) </div> <?php } ?>
                    <span class="errorMsg"></span>
                      
                  </div>   

                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($percentage=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" onclick="<?php echo base_url('vat_setup/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                     <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('vat_setup/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                 

                        
                         <a href="<?php echo base_url().'vat_setup' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                    
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
