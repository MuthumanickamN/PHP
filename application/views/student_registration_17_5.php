
 <?php 
 require_once 'config.php';

 $this->load->view('includes/header3'); 
 ?>
 <html>
 <head>
  <title>Student Registration </title>
</head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="font/glyphicons-halflings-regular.woff2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
  <style type="text/css">

p
{
  font-style: italic;
}
input:invalid {
  /*background-color: #ffdddd;*/
}
form:invalid {
  /*border: 5px solid #ffdddd;*/
}
input:valid {
  /*background-color: #ddffdd;*/
}
form:valid {
  /*border: 5px solid #ddffdd;*/
}
input:required {
  border-color: rgb(255 0 0 / 50%);
  border-width: 1px;
}

  </style>
  
  <script type="text/javascript">
    $(document).ready(function(){
      // age calculator
      $("#student_dob").change(function(){
        var dob = $('#student_dob').val();
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#student_age').val(age);
        //$('select').chosen({ width:'200px' });
      });
    });
    //$('select').chosen({allow_single_deselect:true});

    function allLetter(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("student_name").value="";
      return false;
      }
    }
     function allLettern(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("nationality").value="";
      return false;
      }
    }
     function allLetterstate(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("state").value="";
      return false;
      }
    }
     function allLetterc(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("country").value="";
      return false;
      }
    }
     function allLettercc(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("city").value="";
      return false;
      }
    }
     function allLettersn(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("sibling_name").value="";
      return false;
      }
    }
     function allLetters(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("father_name").value="";
      return false;
      }
    }
      function allLetterd(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("district").value="";
      return false;
      }
    }
     function allLetterss(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("mother_name").value="";
      return false;
      }
    }
    function allnumeric(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("student_age").value="";
      return false;      }
   } 
    function allnumerics(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("father_contact_no").value="";
      return false;      }
   } 
    function allnumericsrn(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("sibling_reg_no").value="";
      return false;      }
   } 
    function allnumericfoc(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("father_office_contact_no").value="";
      return false;      }
   } 
    function allnumericmcn(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("mother_contact_no").value="";
      return false;      }
   }
    function allnumericmoc(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("mother_office_contact_no").value="";
      return false;      }
   }  
   function allnumericpc(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("postal_code").value="";
      return false;      }
   }  
    function allnumericss(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {    return true;      }
      else       {
      alert('Please input numbers only');
      document.getElementById("emergency_contact_no").value="";
      return false;      }
   } 
   function ValidateEmail(inputText)
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if(inputText.value.match(mailformat))
{

return true;
}
else
{
alert("You have entered an invalid email address! for Student Email ID");
document.getElementById("student_email_id").value="";
document.form.student_email_id.focus();
return false;
}
}
 function ValidateEmails(inputText)
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if(inputText.value.match(mailformat))
{

return true;
}
else
{
alert("You have entered an invalid email address! for Father Email ID");
document.getElementById("father_email_id").value="";
document.form.father_email_id.focus();
return false;
}
}
 function ValidateEmailss(inputText)
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if(inputText.value.match(mailformat))
{

return true;
}
else
{
alert("You have entered an invalid email address! for Mother Email ID");
document.getElementById("mother_email_id").value="";
document.form.mother_email_id.focus();
return false;
}
}
function age()
{
  var filePath = document.getElementById('student_age').value;
  if(filePath.length>2)
  {
    alert("Age Must be Two Digits Only");
    document.getElementById("student_age").value="";
  } 
}
function postal_code()
{
  var filePath = document.getElementById('postal_code').value;
  if(filePath.length>10)
  {
    alert("Postal Code Must be Less Than Ten Digits Only");
    document.getElementById("postal_code").value="";
    return false;
  } 
}
function fileValidation(fileInput) { 
            
              
            var filePath = fileInput.value; 
          
            // Allowing file type 
            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                alert('Invalid file type accept only(jpeg,png,jpg,gif)'); 
                fileInput.value = ''; 
                return false; 
            }  
            else  
            { 
              
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

          

  function parent_details()
{ 


var parent_mobile=document.getElementById('parent_mobile').value;
  
$.ajax({
  
  url:"<?php echo base_url().'index.php/student/student_details/'; ?>?parent_mobile=parent_mobile",
  type:"POST",
  data:{parent_mobile:parent_mobile},
  success:function(data)
  {   
  document.getElementById('result').innerHTML=data;
  
  }
});

}
 function father_contact()
{
 
  var father_contact_no = document.getElementById('father_contact_no').value;
  if(father_contact_no.length>12  )
  {
    alert("Father Contact No Must be Twenty Digits Only");
  document.getElementById("father_contact_no").value="";

  } 
}
 function mother_contact()
{
 
  var mother_contact_no = document.getElementById('mother_contact_no').value;
  if(mother_contact_no.length>12  )
  {
    alert("Mother Contact No Must be Twenty Digits Only");
  document.getElementById("mother_contact_no").value="";

  } 
}
 function emergency_contact()
{
 
  var emergency_contact_no = document.getElementById('emergency_contact_no').value;
  if(emergency_contact_no.length>12  )
  {
    alert("Emergency Contact No Must be Twenty Digits Only");
  document.getElementById("emergency_contact_no").value="";

  } 
}
  </script>
 
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
                  <li class="breadcrumb-item"><a href="#">Student Registration</a>
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
            <li><a href="<?php echo site_url('index.php/student/list'); ?>" class="btn btn-primary"   ><b>Student List</b></a></li>
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
                    <h4 class="card-title">Student</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                    <p> (Please fill all mandatory fields marked with * and complete your registration)</p>
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal"  action="<?php echo base_url('index.php/Student/add'); ?>" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" enctype="multipart/form-data">
          <div class="row">
                        <div class="col-md-3 control text-left"><strong>Student Name*</strong>
                        <input type="text" id="student_name" name="student_name" required oninput="allLetter(document.form.student_name)" class="form-control" value="<?php echo $name; ?>">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Date of Birth</strong>     
                         <input type="date" id="student_dob" name="student_dob"   class="form-control" value="<?php echo $dob; ?>"  max="<?php echo date("Y-m-d");?>" >
                        </div>
                        <div class="col-md-3 control text-left"><strong>Age</strong>             
                         <input type="text" id="student_age" name="student_age"  class="form-control" oninput="allnumeric(document.form.student_age); return age();" value="<?php echo $age; ?>" readonly>
                        </div>
                         <div class="col-md-3 control text-left"><strong>Gender</strong>
                          <input id="student_gender" type="radio" value="Male" name="student_gender" <?php if($gender==Male){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Male</label>
                          <input id="student_gender" type="radio" value="Female" name="student_gender" <?php if($gender==Female){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Female</label>
                        </div>
                      </div>

                      <br/>


            <div class="row">
                        <div class="col-md-3 control text-left"><strong>Father's Name*</strong>
                         <input type="text" id="father_name" name="father_name" required class="form-control" oninput="allLetters(document.form.father_name)" value="<?php echo $father_name; ?>">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Father's Contact No*</strong>
                         <input  type="text" id="father_contact_no" name="father_contact_no" required class="form-control" oninput=" allnumerics(document.form.father_contact_no); return father_contact();" value="<?php echo $father_contact; ?>">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Mother's Name*</strong> <input type="text" required id="mother_name" name="mother_name"  class="form-control" oninput="allLetterss(document.form.mother_name)" value="<?php echo $mother_name; ?>">
                        </div>
                       <div class="col-md-3 control text-left"><strong>Emergency Contact No*</strong><input type="text" required id="emergency_contact_no" name="emergency_contact_no"  class="form-control" oninput=" allnumericss(document.form.emergency_contact_no); return emergency_contact();" value="<?php echo $emergency_contact; ?>">
                        </div>
                      </div>      

                      <br/>
    

                      <div class="row">
                        <div class="col-md-3 control text-left"><strong>Passport-ID</strong>
                        <input type="text" id="passport_id" name="passport_id"  class="form-control" value="<?php echo $passport_id; ?>">
                        </div>
                        

                        <?php if($image_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Student's Passport Image</strong> 
                          <input type="file" name="student_passport_image" id="student_passport_image" onchange="return fileValidation(student_passport_image)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Student's Passport Image</strong> 
                          <input type="file" name="student_passport_image" id="student_passport_image" onchange="return fileValidation(student_passport_image)" >
                           <input type="hidden" id="student_passport_image1" name="student_passport_image1" value="<?php echo $image_file_name; ?>">
                          
                          (<?php echo $image_file_name; ?>)<?php } ?>
                        </div>


                         <div class="col-md-3 control text-left"><strong>Nationality</strong> 
                          <input type="text" id="nationality" name="nationality"   class="form-control" oninput="allLettern(document.form.nationality)" value="<?php echo $nationality; ?>">
                        </div>

                      
                       <div class="col-md-3 control text-left"><strong>Country</strong>
                         <input type="text" id="country" name="country"   class="form-control" oninput="allLetterc(document.form.country)" value="<?php echo $country; ?>">
                        </div>
                      </div>  

                      <br/>


                      <?php
                        $role = strtolower($this->session->userdata['role']);
                        if($role=='superadmin'):
                        ?>
                      <div class="row">
                        <div class="col-md-3 control text-left"><strong>Registered Parent Mobile*</strong>
                          <select name="parent_mobile" id="parent_mobile" class="form-control"  required oninput="parent_details()" >
                         <option value="0">Select</option>
                            <?php
                        
                          $osql = "select * from users WHERE status='Active'";                              
                          $oexe = mysqli_query( $con, $osql );

    
                         while ( $row = mysqli_fetch_assoc( $oexe ) ){ ?>
                        <option value="<?php echo $row['mobile'] ?>" <?php if($row['mobile']==$parent_mobile ){ echo 'selected';} ?>><?php echo $row['mobile']; ?>
                              
                            </option><?php
                            
                             }  ?></select>
                        </div>

                        <div id="result" class="row col-md-9 control text-left">
                      </div></div>
                      <br/>
                      <?php endif; ?>

                       <div class="row">
                        <div class="col-md-3 control text-left"><strong>State</strong>
                      <input type="text" id="state" name="state"  class="form-control" oninput="allLetterstate(document.form.state)" value="<?php echo $state; ?>">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>District</strong>
                          <input type="text" id="district" name="district"  class="form-control" oninput="allLetterd(document.form.district)" value="<?php echo $district; ?>"> 
                        </div>
                        <div class="col-md-3 control text-left"><strong>City</strong>  
                          <input type="text" id="city" name="city"  class="form-control" oninput="allLettercc(document.form.city)" value="<?php echo $city; ?>">
                        </div>
                       <div class="col-md-3 control text-left"><strong>School Name</strong>
                         <input type="text" id="school_name" name="school_name"  class="form-control" value="<?php echo $school_name; ?>" >
                        </div>
                      </div>  

                      <br/>


                      <div class="row">
                        <div class="col-md-3 control text-left"><strong>Sibling Name</strong>
                         <input type="text" id="sibling_name" name="sibling_name" class="form-control" oninput="allLettersn(document.form.sibling_name)" value="<?php echo $sibling_name; ?>">
                        </div>

                        <div class="col-md-3 control text-left"><strong>Sibling Reg No</strong> 
                         <input type="text" id="sibling_reg_no" name="sibling_reg_no"  class="form-control" oninput="allnumericsrn(document.form.sibling_reg_no)" value="<?php echo $sibling_reg_no; ?>">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Father's E-Mail-ID*</strong>
                          <input type="text" id="father_email_id" name="father_email_id" required class="form-control" value="<?php echo $father_email; ?>">                
                        </div>
                        <div class="col-md-3 control text-left"><strong>Father's office Contact No</strong>  
                         <input type="text" id="father_office_contact_no" name="father_office_contact_no"  class="form-control" oninput=" allnumericfoc(document.form.father_office_contact_no)" value="<?php echo $father_office_contact; ?>">
                        </div>
                      </div>

                      <br/>


                      <div class="row">
                       <div class="col-md-3 control text-left"><strong>Mother's Contact No*</strong>
                        <input type="text" id="mother_contact_no" name="mother_contact_no" required class="form-control" oninput="allnumericmcn(document.form.mother_contact_no); return mother_contact();" value="<?php echo $mother_contact; ?>">
                        </div>




                      

                       
                        <div class="col-md-3 control text-left"><strong>Mother's office Contact No</strong> 
                         <input type="text" id="mother_office_contact_no" name="mother_office_contact_no"  class="form-control" oninput=" allnumericmoc(document.form.mother_office_contact_no)" value="<?php echo $mother_office_contact; ?>">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Mother's E-Mail-ID*</strong>
                        <input type="text" id="mother_email_id" name="mother_email_id" required  class="form-control" value="<?php echo $mother_email; ?>">                
                        </div>
                        <div class="col-md-3 control text-left"><strong>Student's E-Mail-ID*</strong> 
                         <input type="text" id="student_email_id" name="student_email_id" required class="form-control" value="<?php echo $student_email; ?>">
                        </div></div>


                        <br/>


                        <div class="row">
                       <div class="col-md-3 control text-left"><strong>Address1</strong>
                        <textarea  id="address1" name="address1"  class="form-control"><?php echo $address_1; ?></textarea>
                        </div>
                         

                      
                        <div class="col-md-3 control text-left"><strong>Address2</strong> 
                         <textarea  id="address2" name="address2"  class="form-control"><?php echo $address_2; ?></textarea>
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Postal Code</strong>
                        <input type="text" id="postal_code" name="postal_code"  class="form-control" value="<?php echo $postal_code; ?>"  oninput="allnumericpc(document.form.postal_code); return postal_code();">             
                        </div>
                        <div class="col-md-3 control text-left"><strong>Student Emirates ID</strong>  
                        <input type="text" id="student_emirates_id" name="student_emirates_id"  class="form-control" value="<?php echo $emirates_id; ?>">
                        </div>
                      </div>


                      <br/>


                      <div class="row">
                         <div class="col-md-3 control text-left"><strong>Date of Issue</strong>  
                        <input type="date" id="date_of_issue" name="date_of_issue"  class="form-control" value="<?php echo $emirates_id_issue; ?>">
                        </div>
                      
                       <div class="col-md-3 control text-left"><strong>T-Shirt Size</strong>
                         <select name="tshirt_size" id="tshirt_size" class="form-control"  >
                            <option value="">Select</option>
                           <option value="XXXS / 30-32" <?php if($t_shirt_size=="XXXS / 30-32"){ echo 'selected';} ?>>XXXS / 30-32</option>
                          <option value="XXS / 32-34" <?php if($t_shirt_size=="XXS / 32-34"){ echo 'selected';} ?>>XXS / 32-34</option>
                          <option value="XS / 34-36" <?php if($t_shirt_size=="XS / 34-36"){ echo 'selected';} ?>>XS / 34-36</option>
                          <option value="S / 36-38" <?php if($t_shirt_size=="S / 36-38"){ echo 'selected';} ?>>S / 36-38</option>
                          <option value="M / 38-40" <?php if($t_shirt_size=="M / 38-40"){ echo 'selected';} ?>>M / 38-40</option>
                          <option value="L / 40-42" <?php if($t_shirt_size=="L / 40-42"){ echo 'selected';} ?>>L / 40-42</option>
                          <option value="XL / 42-44" <?php if($t_shirt_size=="XL / 42-44"){ echo 'selected';} ?>>XL / 42-44</option>
                          <option value="XXL / 44-46" <?php if($t_shirt_size=="XXL / 44-46"){ echo 'selected';} ?>>XXL / 44-46</option>
                          <option value="XXXL / 46-48" <?php if($t_shirt_size=="XXXL / 46-48"){ echo 'selected';} ?>>XXXL / 46-48</option></select>
                        </div>



                        <?php if($student_passport_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Student's Passport Size Image</strong> 
                          <input type="file" name="student_passport_size_image" id="student_passport_size_image" onchange="return fileValidation(student_passport_image)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Student's Passport Size Image</strong> 
                          <input type="file" name="student_passport_size_image" id="student_passport_size_image" onchange="return fileValidation(student_passport_image)" >
                           <input type="hidden" id="student_passport_size_image1" name="student_passport_size_image1" value="<?php echo $student_passport_size_image; ?>">
                          
                          (<?php echo $student_passport_file_name; ?>)<?php } ?>
                        </div>

                         <?php if($student_visapage_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Student's Visa Page</strong> 
                          <input type="file" name="student_visa_page" id="student_visa_page" onchange="return fileValidation(document.form.student_visa_page)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Student's Visa Page</strong> 
                          <input type="file" name="student_visa_page" id="student_visa_page" onchange="return fileValidation(document.form.student_visa_page)" >
                           <input type="hidden" id="student_visa_page1" name="student_visa_page1" value="<?php echo $student_visapage_file_name; ?>">
                          
                          (<?php echo $student_visapage_file_name; ?>)<?php } ?>
                        </div>


</div>
                        

                      



                      <br/>

                         
                       <div class="row">

                         <?php if($student_emid_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Student's Emirates-ID</strong> 
                          <input type="file" name="student_emirates_id_image" id="student_emirates_id_image" onchange="return fileValidation(document.form.student_emirates_id_image)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Student's Emirates-ID</strong> 
                          <input type="file" name="student_emirates_id_image" id="student_emirates_id_image" onchange="return fileValidation(document.form.student_emirates_id_image)" >
                           <input type="hidden" id="student_emirates_id_image1" name="student_emirates_id_image1" value="<?php echo $student_emid_file_name; ?>">
                          
                          (<?php echo $student_emid_file_name; ?>)<?php } ?>
                        </div>


                         <?php if($sponsor_passport_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Sponsor's Passport</strong> 
                          <input type="file" name="sponsor_passport" id="sponsor_passport" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Sponsor's Passport</strong> 
                          <input type="file" name="sponsor_passport" id="sponsor_passport" onchange="return fileValidation(document.form.sponsor_passport)" >
                           <input type="hidden" id="sponsor_passport1" name="sponsor_passport1" value="<?php echo $sponsor_passport_file_name; ?>">
                          
                          (<?php echo $sponsor_passport_file_name; ?>)<?php } ?>
                        </div>


                          <?php if($sponsor_visapage_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Sponsor's Visa Page</strong> 
                          <input type="file" name="sponsor_visa_page" id="sponsor_visa_page" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Sponsor's Visa Page</strong> 
                          <input type="file" name="sponsor_visa_page" id="sponsor_visa_page" onchange="return fileValidation(document.form.sponsor_passport)" >
                           <input type="hidden" id="sponsor_visa_page1" name="sponsor_visa_page1" value="<?php echo $sponsor_visapage_file_name; ?>">
                          
                          (<?php echo $sponsor_visapage_file_name; ?>)<?php } ?>
                        </div>

                          <?php if($sponsor_emid_file_name=="") { ?>
                        <div class="col-md-3 control text-left"><strong>Sponsor's Emirates-ID</strong> 
                          <input type="file" name="sponsor_emirates_id" id="sponsor_emirates_id" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              <div class="col-md-3 control text-left"><strong>Sponsor's Emirates-ID</strong> 
                          <input type="file" name="sponsor_emirates_id" id="sponsor_emirates_id" onchange="return fileValidation(document.form.sponsor_passport)" >
                           <input type="hidden" id="sponsor_emirates_id1" name="sponsor_emirates_id1" value="<?php echo $sponsor_emid_file_name; ?>">
                          
                          (<?php echo $sponsor_emid_file_name; ?>)<?php } ?>
                        </div>     

                        </div>  

                        <br/>
                        <?php
                        $role = strtolower($this->session->userdata['role']);
                        if($role=='superadmin'):
                        ?>
                           <div class="row">
                         <div class="col-md-3 control text-left"><strong>Status</strong>  
                         <select name="status" id="status" class="form-control"  >
                            <option value="">Select</option>
                           <option value="Active" <?php if($status=="Active"){ echo 'selected';} ?>>Active</option>
                          <option value="Inactive" <?php if($status=="Inactive"){ echo 'selected';} ?>>Inactive</option>
                        </select>
                        </div>
                      
                         <div class="col-md-3 control text-left"><strong>Approval Status</strong>  
                         <select name="approval_status" id="approval_status" class="form-control"  >
                            <option value="">Select</option>
                           <option value="Pending" <?php if($approval_status=="Pending"){ echo 'selected';} ?>>Pending</option>
                          <option value="Approved" <?php if($approval_status=="Approved"){ echo 'selected';} ?>>Approved</option>
                        </select>
                        </div>
                      </div>
                      <?php endif; ?>
                      
                  <br/>
                   
                
                     <div class="row">
                      <div class="col-md-12 control text-center">
                          <input id="save" type="submit" name="submit" value="Submit" onclick="ValidateEmail(document.form.student_email_id);  ValidateEmails(document.form.father_email_id); ValidateEmailss(document.form.mother_email_id);"       class="btn btn-success" />    
                          

                         
                         <a href="<?php echo base_url().'index.php/student' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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
<?php
$role = strtolower($this->session->userdata['role']);
if($role=='superadmin'):
?>
<script type="text/javascript">
  parent_details();
</script>
<?php
endif;
?>