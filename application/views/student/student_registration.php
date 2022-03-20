<?php 
      require_once('config.php');

      
 ?>
 <?php $this->load->view('includes/header1'); ?>
 <html>
 <head>
  <title>Student Registration </title>
</head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.woff' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.eot' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.svg' ?>">

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
    
 nav.nav,
    nav.nav-tabs,
    ul.dropdown-toggle,
    ul.dropdown-menu
     li a {
  color: white;
  font: bold;
}
#a1,#a2,#a3,#a4,#a5
{
  color: white;
  font: bold;
  
  
}
p
{
  font-style: italic;
}


  </style>
  
  <script type="text/javascript">
    $(document).ready(function(){
 $('select').chosen({ width:'200px' });
});
    $('select').chosen({allow_single_deselect:true});

    function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z]+$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.form.coach_name.focus();
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
      document.form1.phone1.focus();
      return false;
      }
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
alert("You have entered an invalid email address!");
document.form.email_id.focus();
return false;
}
}
function age()
{
  var filePath = document.getElementById('student_age').value;
  if(filePath.length>2)
  {
    alert("Age Must be Two Digits Only");
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

          
  </script>
 
<body>
 
<header id="login-header"  >
    <div>
      <h1><b>Student Registration</b></h1>
    </div></header>
<div  class="mainbox col-sm-12"   style="width: 100.0%; margin-top: 25px;">
        <div class="panel panel-info" style="background-image: linear-gradient(180deg, #efefef, #dfe1e2);">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">

            <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Student Name*</strong>
                        <input type="text" id="student_name" name="student_name" required="" oninput="allLetter(document.form.student_name)" class="form-control">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Date of Birth*</strong>     
                         <input type="date" id="student_dob" name="student_dob" required="" class="form-control">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Age*</strong>             
                         <input type="text" id="student_age" name="student_age" required="" class="form-control" oninput="allnumeric(document.form.student_age); return age();">
                        </div>
                         <div class="col-md-3 control text-left"><strong>Gender*</strong>
                          <input id="student_gender" type="radio" value="Male" name="student_gender" />
                          <label style="margin-left: 10px; margin-right: 10px">Male</label>
                          <input id="student_gender" type="radio" value="Female" name="student_gender" />
                          <label style="margin-left: 10px; margin-right: 10px">Female</label>
                        </div>
                      </div>

            <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Father's Name*</strong>
                         <input type="text" id="father_name" name="father_name" required="" class="form-control" oninput="allLetter(document.form.father_name)">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Father's Contact No*</strong>
                         <input  type="text" id="father_contact_no" name="father_contact_no" required="" class="form-control" oninput=" allnumeric(document.form.father_contact_no)">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Mother's Name*</strong> <input type="text" id="mother_name" name="mother_name" required="" class="form-control" oninput="allLetter(document.form.mother_name)">
                        </div>
                       <div class="col-md-3 control text-left"><strong>Emergency Contact No*</strong><input type="text" id="emergency_contact_no" name="emergency_contact_no" required="" class="form-control" oninput=" allnumeric(document.form.emergency_contact_no)">
                        </div>
                      </div>          

                      <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Passport-ID*</strong>
                        <input type="text" id="passport_id" name="passport_id" required="" class="form-control">
                        </div>
                        
                        <div class="col-md-3 control text-left"><strong>Student's Passport Image*</strong> <input type="file" name="student_passport_image" id="student_passport_image" onchange="return fileValidation(student_passport_image)" required=""><p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>
                        <div class="col-md-3 control text-left"><strong>Registered Parent Mobile*</strong>
                          <select name="parent_mobile" id="parent_mobile" class="form-control chosen"  required="">
                            <option value="">Select</option>
                            <?php                        
                          $osql = "select mobile_no from parent WHERE status='Active'";                              
                            $oexe = mysqli_query( $con, $osql );
                             while ( $row = mysqli_fetch_assoc( $oexe ) ){ ?>
                        <option value="<?php echo $row['mobile_no'] ?>"><?php echo $row['mobile_no'] ?>
                         </option><?php }  ?></select>
                        </div>
                       <div class="col-md-3 control text-left"><strong>Registered Parent Name*</strong>
                        <select name="parent_id" id="parent_id" class="form-control"  required="">
                            <option value="">Select</option>
                            <?php                        
                          $osql = "select parent_id,parent_name from parent WHERE status='Active'";                              
                            $oexe = mysqli_query( $con, $osql );
                             while ( $row = mysqli_fetch_assoc( $oexe ) ){ ?>
                        <option value="<?php echo $row['parent_id'] ?>"><?php echo $row['parent_name'] ?>
                         </option><?php }  ?></select>
                        </div>
                      </div>   

                      <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Registered Parent E-Mail-id*</strong> 
                         <input type="text" id="parent_email_id" name="parent_email_id" required="" class="form-control">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Registered Parent-id*</strong>
                          <input type="text" id="parent_id" name="parent_id" required=""  class="form-control">
                        </div>
                        <div class="col-md-3 control text-left"><strong>Nationality*</strong> 
                          <input type="text" id="nationality" name="nationality" required=""  class="form-control" oninput="allLetter(document.form.nationality)">
                        </div>
                       <div class="col-md-3 control text-left"><strong>Country*</strong>
                         <input type="text" id="country" name="country"  required="" class="form-control" oninput="allLetter(document.form.country)">
                        </div>
                      </div>  

                       <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>State*</strong>
                      <input type="text" id="state" name="state" required="" class="form-control" oninput="allLetter(document.form.state)">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>District*</strong>
                          <input type="text" id="district" name="district" required="" class="form-control" oninput="allLetter(document.form.District)"> 
                        </div>
                        <div class="col-md-3 control text-left"><strong>City*</strong>  
                          <input type="text" id="city" name="city" required="" class="form-control" oninput="allLetter(document.form.city)">
                        </div>
                       <div class="col-md-3 control text-left"><strong>School Name*</strong>
                         <input type="text" id="school_name" name="school_name" required="" class="form-control" >
                        </div>
                      </div>  

                      <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Sibling Name*</strong>
                         <input type="text" id="sibling_name" name="sibling_name" required="" class="form-control" oninput="allLetter(document.form.sibling_name)">
                        </div>

                        <div class="col-md-3 control text-left"><strong>Sibling Reg No*</strong> 
                         <input type="text" id="sibling_reg_no" name="sibling_reg_no" required="" class="form-control" oninput="allnumeric(document.form.sibling_reg_no)">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Father's E-Mail-ID*</strong>
                          <input type="text" id="father_email_id" name="father_email_id" required="" class="form-control">                
                        </div>
                        <div class="col-md-3 control text-left"><strong>Father's office Contact No*</strong>  
                         <input type="text" id="father_office_contact_no" name="father_office_contact_no" required="" class="form-control" oninput=" allnumeric(document.form.father_office_contact_no)">
                        </div>
                      </div>

                      <div class="form-group lg">
                       <div class="col-md-3 control text-left"><strong>Mother's Contact No*</strong>
                        <input type="text" id="mother_contact_no" name="mother_contact_no" required="" class="form-control" oninput=" allnumeric(document.form.mother_contact_no)">
                        </div>
                      

                       
                        <div class="col-md-3 control text-left"><strong>Mother's office Contact No*</strong> 
                         <input type="text" id="mother_office_contact_no" name="mother_office_contact_no" required="" class="form-control" oninput=" allnumeric(document.form.mother_office_contact_no)">
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Mother's E-Mail-ID*</strong>
                        <input type="text" id="mother_email_id" name="mother_email_id" required="" class="form-control">                
                        </div>
                        <div class="col-md-3 control text-left"><strong>Student's E-Mail-ID*</strong> 
                         <input type="text" id="student_email_id" name="student_email_id" required="" class="form-control">
                        </div></div>

                        <div class="form-group lg">
                       <div class="col-md-3 control text-left"><strong>Address1*</strong>
                        <textarea  id="address1" name="address1" required="" class="form-control"></textarea>
                        </div>
                         

                      
                        <div class="col-md-3 control text-left"><strong>Address2*</strong> 
                         <textarea  id="address2" name="address2" required="" class="form-control"></textarea>
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Postal Code*</strong>
                        <input type="text" id="Postal_code" name="Postal_code" required="" class="form-control">             
                        </div>
                        <div class="col-md-3 control text-left"><strong>Student Emirates ID*</strong>  
                        <input type="text" id="student_emirates_id" name="student_emirates_id" required="" class="form-control">
                        </div>
                      </div>

                      <div class="form-group lg">
                         <div class="col-md-3 control text-left"><strong>Date of Issue*</strong>  
                        <input type="date" id="date_of_issue" name="date_of_issue" required="" class="form-control">
                        </div>
                      
                       <div class="col-md-3 control text-left"><strong>T-Shirt Size*</strong>
                         <select name="tshirt_size" id="tshirt_size" class="form-control"  required="">
                            <option value="">Select</option>
                           <option value="XXXS / 30-32">XXXS / 30-32</option>
                          <option value="XXS / 32-34">XXS / 32-34</option>
                          <option value="XS / 34-36">XS / 34-36</option>
                          <option value="S / 36-38">S / 36-38</option>
                          <option value="M / 38-40">M / 38-40</option>
                          <option value="L / 40-42">L / 40-42</option>
                          <option value="XL / 42-44">XL / 42-44</option>
                          <option value="XXL / 44-46">XXL / 44-46</option>
                          <option value="XXXL / 46-48">XXXL / 46-48</option></select>
                        </div>

                         <div class="col-md-3 control text-left"><strong>Student's Passport Size Image*</strong>
                       <input type="file" name="student_passport_size_image" onchange="return fileValidation(document.form.student_passport_size_image)" id="student_passport_size_image" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>

                         <div class="col-md-3 control text-left"><strong>Student's Visa Page*</strong>
                        <input type="file" name="student_visa_page" id="student_visa_page" onchange="return fileValidation(document.form.student_visa_page)" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>
                      </div>
                         
                       <div class="form-group lg">
                       <div class="col-md-3 control text-left"><strong>Student's Emirates-ID*</strong> 
                         <input type="file" name="student_emirates_id_image" id="student_emirates_id_image" onchange="return fileValidation(document.form.student_emirates_id_image)" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>
                        <div class="col-md-3 control text-left"> <strong>Sponsor's Passport*</strong>
                        <input type="file" name="sponsor_passport" id="sponsor_passport" onchange="return fileValidation(document.form.sponsor_passport)" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>              
                        </div>
                      

                      
                      <div class="col-md-3 control text-left"><strong>Sponsor's Visa Page*</strong> 
                        <input type="file" name="sponsor_visa_page" id="sponsor_visa_page" onchange="return fileValidation(document.form.sponsor_visa_page)" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>
                      

                      
                       <div class="col-md-3 control text-left"><strong>Sponsor's Emirates-ID*</strong>
                        <input type="file" name="sponsor_emirates_id" id="sponsor_emirates_id" onchange="return fileValidation(document.form.sponsor_emirates_id)" required="">
                          <p>(Only .pdf .png and .jpg are allowed)</p>
                        </div>

                      </div>
                      <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                          <input id="loginBtn" type="submit" name="submit" value="Submit" onclick="ValidateEmail(document.form.student_email_id);  ValidateEmail(document.form.father_email_id); ValidateEmail(document.form.mother_email_id);"      class="btn btn-success" />          </div>

                        <div class="col-md-6 control text-center">
                         <a href="<?php echo base_url().'index.php/dashboard' ?>"     class="btn btn-danger" >Cancel</a></div>
                    </div>

                </form></div></div>

             
    </body></html>