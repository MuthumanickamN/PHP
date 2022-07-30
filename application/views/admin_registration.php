<?php
 $this->load->view('includes/header3'); 
?>
 <html>
 <head>
  <title>Admin Registration </title>
</head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.woff' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.eot' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.svg' ?>">


<link href="font/glyphicons-halflings-regular.woff2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
<style type="text/css">
p{font-style: italic;}  
</style>
  <script type="text/javascript">
  var admin_id = "<?php echo $admin_id;?>";
  var add_from = "<?php echo $add_from;?>";
  	$(document).ready(function() {
  	    //alert(add_from);
  	    if(add_from)
  	    {
  	        if(add_from == "admin")
  	        {
  	            $('input[name="role"][value="admin"]').prop('checked', true);
  	        }
  	        else if(add_from == "superadmin")
  	        {
  	            $('input[name="role"][value="superadmin"]').prop('checked', true);
  	        }
  	        
  	    }
  	    
      $("#dob").change(function(){
        var dob = $('#dob').val();
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        if(age < 100){
        $('#age').val(age);
        }else{
          $('#dob').val('');
          jQuery('#dob').parent().find(".errorMsg").html('Age Must be Two Digits Only');
        }
        //$('select').chosen({ width:'200px' });
      });
  });
    function allLetter(inputtxt){ 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { 
         jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('');
         return true; 
       }
      else{ 
      jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Please enter alphabet characters only');
      document.getElementById(inputtxt.id).value="";
      jQuery('#'+inputtxt.id).focus();
      return false;
      }
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
   function ValidateEmail(inputText){
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(inputText.value.match(mailformat)){
      jQuery('#'+inputText.id).parent().find(".errorMsg").html('');
      return true;
    }
    else
    {
    jQuery('#'+inputText.id).parent().find(".errorMsg").html("Please enter valid email address");
    jQuery('#'+inputText.id).focus();
    document.getElementById(inputText.id).value="";
    return false;
    }
  }
function contact_check(inputtxt){
  var contact_no = inputtxt.value;
  if(contact_no.length>12  ){
    jQuery('#'+inputtxt.id).parent().find(".errorMsg").html("Contact number must be twelve digits only");
    jQuery('#'+inputtxt.id).focus();
    document.getElementById(inputtxt.id).value="";
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
  </head>
<body>
 
<?php displayMessage(); ?>
 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Academy Activities</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Admin Registration</a>
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
            <li><?php if($add_from=='superadmin') { ?> <a href="<?php echo site_url('Admin/superadmin_list'); ?>" class="btn btn-primary"   ><b>Superadmin List</b></a>
            <?php } else {?>
            <a href="<?php echo site_url('Admin/list_'); ?>" class="btn btn-primary"   ><b>Admin List</b></a>
            <?php } ?>
            </li>
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
          <h4 class="card-title">Admin Registration</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
         
      </div>
      <div class="card-content collapse show">
          <div class="card-body card-dashboard">
            <div  class="mainbox col-sm-12">
            <div class="panel panel-info">
            <form id="adminForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" enctype="multipart/form-data">
              <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id;?>">
              <input type="hidden" name="add_from" id="add_from" value="<?php echo $add_from;?>">
            <div class="row">
              <div class="col-md-3 control text-left"> <strong>Name</strong>*</div>
                <div class="col-md-3">
                <input type="text" id="admin_name" name="admin_name"   class="form-control" value="<?php if(isset($admin_name)){ echo $admin_name; } ?>">
                <span class="errorMsg"></span>
                </div>
              </div>

           <!--   <div class="row">
              <div class="col-md-3 control text-left"> <strong>Password</strong>*</div>
                <div class="col-md-3">
                <input type="password" id="encrypted_password" name="encrypted_password"   class="form-control" autocomplete="off" value="<?php if(isset($encrypted_password)){ echo $encrypted_password; } ?>">
                <span class="errorMsg"></span>
                </div>
              </div>  -->
            
            
              <?php if($coach_id){ ?>
              <div class="row">  
              <div class="col-md-3 control text-left"> <strong>Admin ID</strong> </div>
              <div class="col-md-3">
                <input type="text" id="hid_admin_id" name="hi_admin_id"   class="form-control" value="<?php if(isset($code)){ echo $code; } ?>" readonly>
                <span class="errorMsg"></span>
              </div>
              </div>
              
            <?php } ?>
            <!--<div class="row">  
              <div class="col-md-3 control text-left"><strong>Activity</strong>*
              </div>
              <div class="col-md-3">
                <select name="activity_id" id="activity_id" class="form-control js-example-basic-single activity_select2"  >
                  <option value="">Select</option>
                  <?php foreach ($activityList as $key => $activity) { ?>
                  <option value="<?php echo $activity['game_id'] ?>" <?php if($activity['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $activity['game'] ?></option>
                  <?php }  ?>
                  </select>
                  <span class="errorMsg"></span>
              </div>
          </div>
              
              <div class="row">  
              <div class="col-md-3 control text-left"> <strong>Country</strong>*
              </div>
              <div class="col-md-3">
                  <select name="country_id" id="country_id" class="form-control"  <?php if($role != "superadmin"){ echo 'readonly';} ?> >
                   <option value="">Select</option>
                  <?php foreach ($locationList as $key => $location) { ?> ?>
                  <option value="<?php echo $location['location_id'] ?>" <?php if($location['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $location['location'] ?></option>
                  <?php }  ?>
                </select>
                <span class="errorMsg"></span>

              </div>
              </div> -->
              
              <div class="row">  
              <div class="col-md-3 control text-left"> <strong>Location</strong>*
              </div>
              <div class="col-md-3">
                  <select name="location_id" id="location_id" class="form-control location_select2"  >
                   <option value="">Select</option>
                  <?php foreach ($locationList as $key => $location) { ?> ?>
                  <option value="<?php echo $location['location_id'] ?>" <?php if($location['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $location['location'] ?></option>
                  <?php }  ?>
                </select>
                <span class="errorMsg"></span>

              </div>
              </div>
              
              

           

           <div class="row">
              <div class="col-md-3 control text-left"><strong>Role</strong>*
              </div>
              <div class="col-md-3">
              <input id="role" type="radio" value="admin" name="role" <?php if (isset($role) && ($role=='admin')){ echo 'checked';} ?>/>
                <label style="margin-left: 10px; margin-right: 10px" >Admin</label>
                <input id="role" type="radio" value="superadmin" name="role" <?php if(isset($role) && $role=='superadmin'){ echo 'checked';} ?>/>
                <label style="margin-left: 10px; margin-right: 10px">Superadmin</label>
                <br/><span class="errorMsg"></span>
              </div>
          </div>
          
          <div class="row">
              <div class="col-md-3 control text-left"><strong>Date of Birth</strong>*</div>
              <div class="col-md-3">
                <input type="date" id="dob" name="dob" class="form-control" placeholder="DD/MM/YYYY" value="<?php if(isset($dob)){ echo $dob; } ?>" >
                <span class="errorMsg"></span>
              </div>
              </div>
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Age</strong></div>
              <div class="col-md-3">
                <input type="text" id="age" name="age" class="form-control" oninput="allnumeric(document.form.age); return ages();" value="<?php if(isset($age)){ echo $age; } ?>" readonly="">
                <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Gender</strong>*  </div><div class="col-md-3">         
                <input id="gender" type="radio" value="Male" name="gender"  <?php if(isset($gender) && $gender=='Male'){ echo 'checked';} ?>/>
                <label style="margin-left: 10px; margin-right: 10px">Male</label>
                <input id="gender" type="radio" value="Female" name="gender"  <?php if(isset($gender) && $gender=='Female'){ echo 'checked';} ?>/>
                <label style="margin-left: 10px; margin-right: 10px">Female</label>
                <br/><span class="errorMsg"></span>
              </div>
            </div>

               <br/>

            <div class="row">
              <div class="col-md-3 control text-left"><strong>Address</strong></div><div class="col-md-3">
                <textarea id="address" name="address" class="form-control" ><?php if(isset($address)){ echo $address; } ?></textarea>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-3 control text-left"><strong>Address 1</strong> </div><div class="col-md-3">  
                <textarea id="address1" name="address1" class="form-control" ><?php if(isset($address1)){ echo $address1; } ?></textarea>
                <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>City</strong></div><div class="col-md-3">             
                <input type="text" id="city" name="city" class="form-control" oninput="allLetter(document.form.city)" value="<?php if(isset($city)){ echo $city; } ?>">
                <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>State</strong> </div><div class="col-md-3">          
                <input type="text" id="state" name="state" class="form-control" oninput="allLetter(document.form.state)" value="<?php if(isset($state)){ echo $state; } ?>">
                <span class="errorMsg"></span>
                </div>
              </div>

             


              <div class="row">
              <div class="col-md-3 control text-left"><strong>Country</strong>
              </div><div class="col-md-3">
              <input type="text" id="country" name="country" class="form-control" oninput="allLetter(document.form.country)" value="<?php if(isset($country)){ echo $country; } ?>">
              <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Postal Code</strong>   </div><div class="col-md-3">
              <input type="text" id="postal_code" name="postal_code" class="form-control" oninput="allnumeric(document.form.postal_code)"value="<?php  if(isset($postal_code)){ echo $postal_code; } ?>">
              <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Phone-1</strong>*</div> <div class="col-md-3">
                <input type="text" id="phone1" name="phone1"   class="form-control" oninput="allnumeric(document.form.phone1); contact_check(document.form.phone1);" value="<?php if(isset($phone1)){ echo $phone1; } ?>">
                <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Phone-2</strong>*
               </div> <div class="col-md-3">
                   <input type="text" id="phone2" name="phone2"   class="form-control" oninput="allnumeric(document.form.phone2); contact_check(document.form.phone2);" value="<?php if(isset($phone2)){ echo $phone2; } ?>">
               <span class="errorMsg"></span>
              </div></div>

              


              <div class="row">
              <div class="col-md-3 control text-left"><strong>E-Mail</strong>*
              </div> <div class="col-md-3"><input type="text" id="email_id" name="email_id" placeholder="user@domain.com" onchange="ValidateEmail(document.form.email_id)"  class="form-control" value="<?php if(isset($email_id)){  echo $email_id; } ?>">
              <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Emirates-Id</strong>  </div> <div class="col-md-3"> 
              <input type="text" id="emirates_id" name="emirates_id" class="form-control" value="<?php if(isset($emirates_id)){  echo $emirates_id; } ?>">
              <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Date of Expiry</strong>
              </div> <div class="col-md-3">
               <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="<?php if(isset($expiry_date)){ echo $expiry_date; } ?>">
               <span class="errorMsg"></span>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-3 control text-left"><strong>Status</strong>
              </div> <div class="col-md-3">
               <select name="status" id="status" class="form-control" >
                  <option value="">Select</option>
                  <option value="Active" <?php if(isset($status) && $status=='Active' ){ echo 'selected';} ?>>Active</option>
                  <option value="Inactive" <?php if(isset($status) && ($status=='Inactive' || $status == "") ){ echo 'selected';} ?>>Inactive</option>
                  </select>
                  <span class="errorMsg"></span>
              </div>
            </div>

              

              <div class="row">

                  <?php if(!isset($passport_size_image) || $passport_size_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Photo</strong> 
                </div> <div class="col-md-5"><input type="file" name="passport_size_image" id="passport_size_image" onchange="return fileValidation(document.form.passport_size_image)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Photo*</strong> </div> <div class="col-md-5">
                <input type="file" name="passport_size_image" id="passport_size_image" onchange="return fileValidation(document.form.passport_size_image)" >
                 <input type="hidden" id="passport_size_image1" name="passport_size_image1" value="<?php echo $passport_size_image; ?>"> 
                
                (<?php echo $passport_size_image; ?>) </div> <?php } ?>
                <span class="errorMsg"></span>
                  
              </div>     

            <div class="row">
              <?php if(!isset($passport_image) || $passport_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Passport Image</strong> </div> <div class="col-md-5">
                <input type="file" name="passport_image" id="passport_image" onchange="return fileValidation(document.form.passport_image)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Passport Image*</strong> </div>
                <div class="col-md-5">
                <input type="file" name="passport_image" id="passport_image" onchange="return fileValidation(document.form.passport_image)" >
                 <input type="hidden" id="passport_image1" name="passport_image1" value="<?php echo $passport_image; ?>">
                
                (<?php echo $passport_image; ?>) </div> <?php } ?>
                <span class="errorMsg"></span>
            </div>

            <div class="row">
                <?php if(!isset($visa_image) || $visa_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Visa Image</strong> </div><div class="col-md-5">
                <input type="file" name="visa_image" id="visa_image" onchange="return fileValidation(document.form.visa_image)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Visa-Page Image*</strong> </div> <div class="col-md-5">
                <input type="file" name="visa_image" id="visa_image" onchange="return fileValidation(document.form.visa_image)" >
                 <input type="hidden" id="visa_image1" name="visa_image1" value="<?php echo $visa_image; ?>">
                
                (<?php echo $visa_image; ?>) </div> <?php } ?>
                <span class="errorMsg"></span>
              </div>
            
            <div class="row">
                <?php if(!isset($emirates_id_image) || $emirates_id_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Emirates-Id Image</strong> </div> <div class="col-md-5">
                <input type="file" name="emirates_id_image" id="emirates_id_image" onchange="return fileValidation(document.form.emirates_id_image)" ><p>(Only .pdf .png and .jpg are allowed)</p> </div> <?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Emirates-Id Image*</strong> </div> <div class="col-md-5">
                <input type="file" name="emirates_id_image" id="emirates_id_image" onchange="return fileValidation(document.form.emirates_id_image)" >
                 <input type="hidden" id="emirates_id_image1" name="emirates_id_image1" value="<?php echo $emirates_id_image; ?>">
                 
                (<?php echo $emirates_id_image; ?>) </div> <?php } ?>
               
                <span class="errorMsg"></span>
              </div>
              
              
             
               
               
               <div class="row">
                 <?php if(!isset($experience_certificate_image) || $experience_certificate_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Experience Certificate Image</strong> </div> <div class="col-md-5">
                <input type="file" name="experience_certificate" id="experience_certificate" onchange="return fileValidation(document.form.experience_certificate)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Experience Certificate Image*</strong> </div> <div class="col-md-5">
                <input type="file" name="experience_certificate" id="experience_certificate" onchange="return fileValidation(document.form.experience_certificate)" >
                 <input type="hidden" id="experience_certificate1" name="experience_certificate1" value="<?php echo $experience_certificate_image; ?>">
                
                (<?php echo $experience_certificate_image; ?>) </div> <?php } ?>
               
                <span class="errorMsg"></span>
              </div>
            
            <div class="row">
                
                 <?php if(!isset($police_verification_image) || $police_verification_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Police Verification Image</strong> </div> <div class="col-md-5">
                <input type="file" name="police_verification_image" id="police_verification_image" onchange="return fileValidation(document.form.police_verification_image)" ><p>(Only .pdf .png and .jpg are allowed)</p></div> <?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Police Verification Image*</strong> </div> <div class="col-md-5">
                <input type="file" name="police_verification_image" id="police_verification_image" onchange="return fileValidation(document.form.police_verification_image)" >
                 <input type="hidden" id="police_verification_image1" name="police_verification_image1" value="<?php echo $police_verification_image; ?>">
                
                (<?php echo $police_verification_image; ?>) </div> <?php } ?>
                
                <span class="errorMsg"></span>
          </div>

            <div class="row">
               <?php if(!isset($municipality_certificate_image) || $municipality_certificate_image=="") { ?>
              <div class="col-md-3 control text-left"><strong>Municipality Certificate Image</strong> </div> <div class="col-md-5">
                <input type="file" name="municipality_certificate_image" id="municipality_certificate_image" onchange="return fileValidation(document.form.municipality_certificate_image)" ><p>(Only .pdf .png and .jpg are allowed)</p></div><?php } else { ?>
                    <div class="col-md-3 control text-left"><strong>Municipality Certificate Image*</strong> </div> <div class="col-md-5">
                <input type="file" name="municipality_certificate_image" id="municipality_certificate_image" onchange="return fileValidation(document.form.municipality_certificate_image)" >
                 <input type="hidden" id="municipality_certificate_image1" name="municipality_certificate_image1" value="<?php echo $municipality_certificate_image; ?>">
                
                (<?php echo $municipality_certificate_image; ?>) </div> <?php } ?>
                
                <span class="errorMsg"></span>
              </div> 
             
               
               
            <div class="row">
              <div class="col-md-6 control text-center">
                <?php if(isset($admin_id) && $admin_id!="") { ?>
                <button type="submit" name="submit" class="btn btn-secondary" >Update</button>   
                <?php } else { ?>
                <button type="submit" id="save" class="btn btn-secondary" ><b> Submit</b></button>
                <?php } ?>        
                <a href="<?php echo base_url().'dashboard' ?>"     class="btn btn-secondary" >Cancel</a>
              </div>
            </div>
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
<?php
	 $this->load->view('includes/footer_select2');
	 
?>



<script type="text/javascript">
$(document).ready(function() {
    $('.activity_select2').select2();
	$('.location_select2').select2();
});

$(document).ready(function (e) {
	
$("#adminForm").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
    url: baseurl+'Admin/add',
   type: "POST",
   data:  new FormData(this),
   contentType: false,
    cache: false,
   processData:false,
   success: function(json){
       console.log(json);
    $('.text-danger').remove();
          if (json['error']) {             
              for (i in json['error']) {
                  if(i == 'error_msg'){
                    location.reload();
                  }
                  //var element = $('.input-school-' + i.replace('_', '-'));
                  var element = $('#'+ i);
                  $(element).parent().find(".errorMsg").html(json['error'][i]);
              }
          } else {
              if(json['status'] == 'success'){
                //alert('sfd')
                jQuery('form#registrationForm').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
                //window.location.href = baseurl+'users?role='+add_from;
                if(add_from == 'superadmin')
                {
                window.location.href = baseurl+'Admin/superadmin_list';
                }
                else
                {
                    window.location.href = baseurl+'Admin/list_';
                }
          }
              
          }
      },
     error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }          
    });
 }));
 
 
    
});
  
</script>