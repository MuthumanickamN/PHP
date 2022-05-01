 <html>
 <head>
  <title>Fees Package Setup</title>
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

  $(document).ready(function(){
  //Chosen
  //$(".choiceChosen, .productChosen").chosen({});
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
      document.form1.phone1.focus();
      return false;
      }
   } 

 
    function show_three()
   {
      
var slot_classes_max=document.getElementById('slot_classes_max').value;
  
$.ajax({
  
  url:"<?php echo base_url().'fees_package_setup/slot_classes3'; ?>?slot_classes_max=slot_classes_max",
  type:"POST",
  data:{slot_classes_max:slot_classes_max},
  success:function(data)
  {   
  document.getElementById('classes').innerHTML=data;
  
  }
});

   }

    function show_one()
   {
      
var slot_classes_max=document.getElementById('slot_classes_max').value;
  
$.ajax({
  
  url:"<?php echo base_url().'fees_package_setup/slot_classes1'; ?>?slot_classes_max=slot_classes_max",
  type:"POST",
  data:{slot_classes_max:slot_classes_max},
  success:function(data)
  {   
  document.getElementById('classes').innerHTML=data;
  
  }
});

   }
function fees_limit()
{
	var slot_classes_fees = document.getElementById('slot_classes_fees').value;

	if(slot_classes_fees.length > 20)
	{
		alert("Fees Must be 20 Digits Only");
		 
		document.getElementById("slot_classes_fees").value="";
	} 
}
  function fees_limits()
{
    var slot_classes_fees1 = document.getElementById('slot_classes_fees1').value;
  
  if(slot_classes_fees1.length > 20)
  {
    alert("Fees Must be 20 Digits Only");
     
      document.getElementById("slot_classes_fees1").value="";
  } 
}
  function limits()
{
    var slot_classes_min1 = document.getElementById('slot_classes_min1').value;
  var slot_classes_max1 = document.getElementById('slot_classes_max1').value;
  if(parseInt(slot_classes_min1) > parseInt(slot_classes_max1))
  {
    alert("Max Classes are Less than Min Classes are not accepted ");
     document.getElementById("slot_classes_max1").value="";
     
      
  } 
}
function limit()
{
  var slot_classes_min = document.getElementById('slot_classes_min').value;
  var slot_classes_max = document.getElementById('slot_classes_max').value;
  
  if(parseInt(slot_classes_min) > parseInt(slot_classes_max))
  {
     alert("Max Classes are Less than Min Classes are not accepted ");
     document.getElementById("slot_classes_max").value="";
     
      
  } 
}
 function allnumeric(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	  alert(inputtxt)
	  console.log(inputtxt.value.match(numbers));
      if(inputtxt.value.match(numbers))
      {    
		return true;
      }
      
      else
      {
		alert('Please input numbers only');
		document.getElementById("slot_classes_fees").focus();
		document.getElementById("slot_classes_fees").value="";
       

      return false;
      }
   } 
   function allnumeric1(inputtxt)
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
      document.getElementById("slot_classes_fees1").focus();
       document.getElementById("slot_classes_fees1").value="";

      return false;
      }
   } 
    
     function show_two()
   { 
      
var slot_classes_max1=document.getElementById('slot_classes_max1').value;
  
$.ajax({
  
  url:"<?php echo base_url().'fees_package_setup/slot_classes2'; ?>?slot_classes_max1=slot_classes_max1",
  type:"POST",
  data:{slot_classes_max1:slot_classes_max1},
  success:function(data)
  {   
  document.getElementById('classes1').innerHTML=data;
  
  }
});

   }
    function show_four()
   { 
      
var slot_classes_max1=document.getElementById('slot_classes_max1').value;
  
$.ajax({
  
  url:"<?php echo base_url().'fees_package_setup/slot_classes4'; ?>?slot_classes_max1=slot_classes_max1",
  type:"POST",
  data:{slot_classes_max1:slot_classes_max1},
  success:function(data)
  {   
  document.getElementById('classes1').innerHTML=data;
  
  }
});

   }


</script>

<body> <?php $this->load->view('includes/header3'); ?>
<?php displayMessage();  ?>
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
                  <li class="breadcrumb-item"><a href="#">Fees Package Setup</a>
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
            <li><a href="<?php echo site_url('index.php/fees_package_setup'); ?>" class="btn btn-primary"   ><b>Fees Package List</b></a></li>
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
                    <h4 class="card-title">Fees Package Setup</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
							<form id="loginForm" class="form-horizontal" role="form" name="form" method="POST">
          	
              
			  
				<!--
				<div class="row">
                        <div class="col-md-3 control text-left"><strong>Classes</strong>*</div>
                        <div class="col-md-1 control text-left"><span align="center">Min Classes</span>
                        <input type="text" id="slot_classes_min" required=""  name="slot_classes_min" value="<?php echo $slot_classes_min; ?>" placeholder="Min" class="form-control"></div>
                        <div class="col-md-1 control text-left">Max Classes
                        <input type="text" id="slot_classes_max" required="" name="slot_classes_max" oninput="limit()" value="<?php echo $slot_classes_max; ?>" placeholder="Max" class="form-control" ></div>
                         <div class="col-md-1 control text-left">Fees (AED)
                        <input type="text" id="slot_classes_fees" required="" oninput="allnumeric(document.form.slot_classes_fees); fees_limit();"  name="slot_classes_fees" value="<?php echo $fees; ?>" placeholder="Fees" class="form-control" ></div>
                          <div class="col-md-1 control text-left">&nbsp;
                            <?php if($fees=="") {?>
                        <input type="button"  onclick="show_one()" value="+Add" placeholder="Max" class="form-control" >
                        <?php } else { ?> <input type="button"  onclick="show_three()" value="+Add" placeholder="Max" class="form-control" > <?php } ?></div>
                        </div>

                        <br/>

                        
                        <div id="classes"></div>
                        <br/>
                         <div id="classes1"></div>



                        
<br/>
-->

					<div class="row">
					   <div class="col-md-3 control text-left"><strong>Classes</strong>*</div>
					   <div class="col-md-1 control text-left" style="display:none"><span align="center">Min Classes</span>
						  <input type="text" id="slot_classes_min"  name="slot_classes_min" value="1" placeholder="Min" class="form-control"> 
					   </div>
					   <div class="col-md-1 control text-left">Max Classes
						  <input type="text" id="slot_classes_max"  name="slot_classes_max"  value="" placeholder="Max" class="form-control" >
					   </div>
					   <div class="col-md-1 control text-left">Fees (AED)
						  <input type="text" id="slot_classes_fees" oninput="fees_limit();"  name="slot_classes_fees" value="" placeholder="Fees" class="form-control" >
					   </div>
					   <div class="col-md-1 control text-left">&nbsp;
						  <input type="button" style="color:white" value="+Add" class="form-control btn btn-info btn-flat class_framehtml">
					   </div>
					</div>
					
					<?php
						if(!empty($fee_package_setups_id))
						{
							foreach($slot_class as $values)
							{
								#echo '<pre>'; print_r($values); echo '</pre>'; 
					?>
					
					<div class="row feature_div_<?php echo $values['id']; ?>">
					   <div class="col-md-3 control text-left"></div>
					   <div class="col-md-1 control text-left" style="display:none">
							<span align="center">Min Classes</span>
							<input type="text" id="slot_classes_min"  name="slot_classes_min[]" value="<?php echo $values['slot_classes_min']; ?>" placeholder="Min" class="form-control">
						</div>
					   <div class="col-md-1 control text-left">Max Classes
							<input type="text" id="slot_classes_max" required="" name="slot_classes_max[]" value="<?php echo $values['slot_classes_max']; ?>" placeholder="Max" class="form-control" >
						</div>
					   <div class="col-md-1 control text-left">Fees (AED)
							<input type="text" id="slot_classes_fees"  name="slot_classes_fees[]" value="<?php echo $values['fees']; ?>" placeholder="Fees" class="form-control">
						</div>
					   <div class="col-md-1 control text-left">&nbsp;<input type="button" style="color:white" value="X" class="form-control delete_btn btn btn-danger btn-flat" data-id_1="<?php echo $values['id']; ?>"></div>
					</div>
					
					<?php
							
							}							
						}
					?>
					
					


					<div class="class_preview" style="margin-top:20px;"></div>  
					
						<div class="row">
							<div class="col-md-3 control text-left"><strong>Activity</strong>*</div>
							<div class="col-md-3 control text-left">
							<select name="game_id" id="game_id" class="form-control choiceChosen"  required="">
								<option value="">Select</option>
							<?php     

					   
							$osql1 = "select game_id,game from games ORDER BY game ASC";  


							$result = $this->db->query($osql1)->result_array();
							foreach($result as $row1)
							{
							?>
							<option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$game_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
							 </option><?php }  ?></select>
							</div>
						</div>

                    <br/>

                     <div class="row">
                        <div class="col-md-3 control text-left"><strong>Level</strong>*</div>
                        <div class="col-md-3 control text-left">     
                           <select id="level_id" name="level_id" class="form-control choiceChosen" required="">
                             <option value="">Select</option>
                            <?php                        
							$osql8 = "select games_level_id,level from game_levels ORDER BY level ASC";       
							$result = $this->db->query($osql8)->result_array();
							foreach($result as $row8)
							{
		                    ?>
                        <option value="<?php echo $row8['games_level_id'] ?>" <?php if($row8['games_level_id']==$level_id ){ echo 'selected';} ?>><?php echo $row8['level'] ?>
                         </option><?php }  ?></select>
                        </div></div>


                        <br/>
						
						

                        <div class="row">
                        <div class="col-md-3 control text-left"><strong>Hour</strong>*</div>
                        <div class="col-md-3 control text-left"> 
                          <input id="hour" type="radio" value="One" name="hour" required="" <?php if($hour=='One'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px" >One</label>
                          <input id="hour" type="radio" value="Two" name="hour" <?php if($hour=='Two'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px">Two</label>
                           <input id="hour" type="radio" value="Three" name="hour"  <?php if($hour=='Three'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px">Three</label>
                        </div>
                      </div>

                     
				 
					<br/>
                   

                 

                         <?php 
							if(empty($fee_package_setups_id))
							{ 
						?>
						<div class="row">
						<div class="col-md-4 control text-right"> 
						<!-- onclick="<?php echo base_url('fees_package_setup/add/'); ?>" -->
						<input id="save" type="submit" name="submit" value="Submit"  class="btn btn-success" /> 
						</div>
						<div class="col-md-3 control text-left">
						<a href="<?php echo base_url().'fees_package_setup'?>" class="btn btn-danger" >Cancel</a>
						</div>
						</div>
						 <?php 
							}
						 ?>
						 <?php 
							if(!empty($fee_package_setups_id))
							{ 
						 ?>
						<div class="row">
						<div class="col-md-4 control text-right">
						<input type="hidden" id="h_package_setups_id" name="h_package_setups_id" value="<?php echo $fee_package_setups_id;  ?>"/>
						<input id="save" type="submit" name="submit" value="Update"  class="btn btn-success" /> 
						</div>
						<div class="col-md-3 control text-left">
							<a href="<?php echo base_url().'fees_package_setup'?>" class="btn btn-danger" >Cancel</a>
						</div>
						</div>

						 <?php 
							}
						 ?>
						 

                        
                    
				
                </form>
         </div>
       </div>
     </div>
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

    
<script>
jQuery(document).ready(function(){
	var maxField = 30; 
	var addButton = $('.class_framehtml'); 
	var wrapper = $('.class_preview');
	var x = 1; 	
	$(wrapper).html(''); 	
	$(addButton).click(function(){
			
			var slot_classes_min = $("#slot_classes_min").val(1);
			var slot_classes_max = $("#slot_classes_max").val();
			var slot_classes_fees = $("#slot_classes_fees").val();
			
			if (slot_classes_min=="")
			{
				//alert("Please enter the fields");
				//return false;
			}
			if (slot_classes_max=="")
			{
				alert("Please enter the fields");
				return false;
			}
			if (slot_classes_fees=="")
			{
				alert("Please enter the fields");
				return false;
			}
				
		if(x < maxField){ 
			x++; 
			
				/*
			 var fieldHTML = '<div class="feature_div_'+x+'"><div class="col-sm-12 col-md-3"><input type="text" name="slot_classes_min[]" id="slot_classes_min" value="'+slot_classes_min+'" placeholder="" ></div><div class="col-sm-12 col-md-3"><input type="text" name="slot_classes_max[]" id="slot_classes_max" value="'+slot_classes_max+'" placeholder="" class="slot_classes_max" ></div><div class="col-sm-12 col-md-3"><input type="text" name="slot_classes_fees[]" id="slot_classes_fees" value="'+slot_classes_fees+'" placeholder="" class="slot_classes_fees"></div><div class="col-md-3"><button style="margin-bottom:20px;" data-id_1="'+x+'" class="btn btn-danger btn-flat delete_btn" type="button"><i class="fa fa-trash"></i></button></div></div>'; 
			 */
			 
			 var fieldHTML = '<div class="row feature_div_'+x+'"><div class="col-md-3 control text-left"></div><div class="col-md-1 control text-left" style="display:none"><span align="center">Min Classes</span><input type="text" id="slot_classes_min" required=""  name="slot_classes_min[]" value="'+slot_classes_min+'" placeholder="Min" class="form-control"></div><div class="col-md-1 control text-left">Max Classes<input type="text" id="slot_classes_max" required="" name="slot_classes_max[]" value="'+slot_classes_max+'" placeholder="Max" class="form-control" ></div><div class="col-md-1 control text-left">Fees (AED)<input type="text" id="slot_classes_fees"  name="slot_classes_fees[]" value="'+slot_classes_fees+'" placeholder="Fees" class="form-control"></div><div class="col-md-1 control text-left">&nbsp;<input type="button" style="color:white" value="X" class="form-control delete_btn btn btn-danger btn-flat" data-id_1="'+x+'"></div></div>';
			 
			$(wrapper).append(fieldHTML);
			
			$("#slot_classes_min").val("");
			$("#slot_classes_max").val("");
			$("#slot_classes_fees").val("");
		}
	});	

    $(document).on('click', '.delete_btn', function (e) {
    e.preventDefault();
    $(".feature_div_"+$(this).attr("data-id_1")+"").remove();
     x--;
    });	
});	
</script>