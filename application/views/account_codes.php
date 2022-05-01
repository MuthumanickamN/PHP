<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
<title>Account Code</title>
</head>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<style type="text/css">
  .limitedNumbChosen, .limitedNumbSelect2{
  width: 308px;
}
.choiceChosen, .productChosen {
  width: 308px ;
}
#loginForm
{
  font-size: 15px;
  line-height: 20px;
  font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 12px;
  line-height: 20px;
}
</style>
<script type="text/javascript">

   function allLetter(inputtxt)
      { 
        
  var name_of_service = document.getElementById('name_of_service').value;
      var letters = /^[A-Za-z ']*$/;
      if(name_of_service.value.match(letters)) {
       return true;
        }
      else      { 
        alert('Please input alphabet characters only');
      
       document.getElementById("name_of_service").value="";
        
      return false;
      }
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

     function limit()
{
  

  var name_of_service = document.getElementById('name_of_service').value;
  
  if(name_of_service.length>40)
  {
    alert("Name Must be 40 Characters Only");
     document.getElementById("name_of_service").value="";
  } 
}
 function Validation()
{
  var status = document.getElementById('status').value;
  var category = document.getElementById('category').value;
  var name_of_service = document.getElementById('name_of_service').value;
  

  if(category=="")
  {
    alert("Please Select Category");
     return false;
  } 
  else  if(status=="")
  {
    alert("Please Select Level of Status");
     return false;
  } 
</script>

<?php displayMessage(); ?>
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
                  <li class="breadcrumb-item"><a href="#">Account Code</a>
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
            <li><a href="<?php echo site_url('index.php/account_codes'); ?>" class="btn btn-primary"   ><b>Account Code List</b></a></li>
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
                    <h4 class="card-title">Account Code</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Name of Service</strong>*</div>
                        <div class="col-md-3 control text-left">
                       <input type="text"  name="name_of_service" class="form-control" id="name_of_service" placeholder="Name of Service" required="" value="<?php echo $name_of_service;  ?>" oninput="allLetter(document.form.name_of_service); limit()" >
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Description</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <textarea id="description" name="description"  value="" class="form-control" required="" placeholder="Enter Discription"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Category</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <select name="category" id="category" class="form-control choiceChosen" required="">
                            <option value="">Select Category</option>
                             <option value="Income" <?php if($category=='Income'){ echo 'selected';} ?> >Income</option>
                              <option value="Expenses" <?php if($category=='Expenses'){ echo 'selected';} ?>>Expenses</option>
                               <option value="Assets" <?php if($category=='Assets'){ echo 'selected';} ?>>Assets</option>
                                <option value="Liabilities" <?php if($category=='Liabilities'){ echo 'selected';} ?>>Liabilities</option>
                           </select>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Level</strong>*</div>
                        <div class="col-md-3 control text-left">     
                           <select name="status" id="status" class="form-control choiceChosen"  required="">
                            <option value="">Select Status</option>
                             <option value="Active" <?php if($status=='Active'){ echo 'selected';} ?>>Active</option>
                              <option value="Inactive" <?php if($status=='Inactive'){ echo 'selected';} ?>>Inactive</option>
                              
                           </select>
                        </div></div>

                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($status=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="return Validation()","<?php echo base_url('index.php/account_codes/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('index.php/account_codes/add/'); ?>"       class="btn btn-success" /><?php } ?>

                              

                        
                         <a href="<?php echo base_url().'index.php/account_codes' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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
