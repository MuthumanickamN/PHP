<?php require_once 'config.php'; ?> <html>
 <head>
 <title>Registration Charge Setup</title>
</head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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

   $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });

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
      document.getElementById("registration_fees").focus();
       document.getElementById("registration_fees").value="";

      return false;
      }
   } 

     function limit()
{
 
  var registration_fees = document.getElementById('registration_fees').value;
  if(registration_fees.length>20  )
  {
    alert("Fees Must be Twenty Digits Only");
  document.getElementById("registration_fees").value="";

  } 
}
  function limits()
  {
     var note = document.getElementById('note').value;
   if(note.length>80  )
  {
    alert("Note Must be Eighty Digits Only");
  document.getElementById("note").value="";

  } 
}
</script>

<body> <?php $this->load->view('includes/header3'); ?>
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
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
                  <li class="breadcrumb-item"><a href="#">Registration Charge Setup</a>
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
            <li> <a href="<?php echo site_url('index.php/registration_charge_setup/'); ?>" class="btn btn-primary"   ><b>Registration Charge List</b></a></li>
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
                    <h4 class="card-title">Registration Charge Setup</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
         <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Classes</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <select id="category" name="category" class="form-control choiceChosen" required="">
                          <option value="">Select</option>
                           <option value="Kid" <?php if($category=='Kid'){ echo 'selected';} ?>>Kid</option>
                            <option value="Adult" <?php if($category=='Adult'){ echo 'selected';} ?>>Adult</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Registration Fees (AED)</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="registration_fees" name="registration_fees" required="" class="form-control" value="<?php echo $fees; ?>" oninput="return allnumeric(document.form.registration_fees); limit()">
                        </div>
                    </div>



                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Note</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="note" name="note" required="" class="form-control" value="<?php echo $note; ?>" oninput="limits()">
                        </div>
                    </div>
                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($note=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('index.php/registration_charge_setup/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('index.php/registration_charge_setup/add/'); ?>"       class="btn btn-success" /><?php } ?>


                       



                                

                        
                         <a href="<?php echo base_url().'index.php/registration_charge_setup' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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
