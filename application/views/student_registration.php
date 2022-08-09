
 <?php 

$this->load->view('includes/header3'); 

?>
<html>
<head>
 <title>Student Registration </title>
 <style rel="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></style>
 <style rel="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"></style>
 <style>
  #showmore {display:none;}
  .select2-container { width:100% !important;}
 </style>
<script type="text/javascript" src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
 
 <script>
$(document).ready(function(){
     // age calculator
    
  /*$('#example').DataTable({
       "order": [],
   }); 
   $('#listTable').DataTable({
       "order": [],
   });*/
   var role = "<?php echo $role;?>";
   var student_id = "<?php echo $id;?>";
   
   
});
</script>
<!--<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<style rel="stylesheet" src="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"></style>

<style rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" ></style>
<style rel="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"></style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<link href="font/glyphicons-halflings-regular.woff2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>-->
</head>

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
/*input:required {
 border-color: rgb(255 0 0 / 50%);
 border-width: 1px;
}*/


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

   function allLetter(inputtxt){ 
     var letters = /^[A-Za-z ']*$/;
     if(inputtxt.value.match(letters)) { 
        jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('');
        return true; 
      }
     else{ 
     jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Please input alphabet characters only');
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
     jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Please input numbers only');
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

         

function parent_details(){ 
 var parent_mobile=document.getElementById('parent_mobile').value;
 $.ajax({
   url:"<?php echo base_url().'Students/student_details/'; ?>?parent_mobile=parent_mobile",
   type:"POST",
   data:{parent_mobile:parent_mobile},
   success:function(data){   
   document.getElementById('result').innerHTML=data;
   }
});

}
function contact_check(inputtxt){
 var contact_no = inputtxt.value;
 if(contact_no.length>12  ){
   jQuery('#'+inputtxt.id).parent().find(".errorMsg").html("Contact number must be twelve digits only");
   jQuery('#'+inputtxt.id).focus();
   document.getElementById(inputtxt.id).value="";
 } 
}
 </script>
<style>
#loading_image {
 position: fixed;
 left: 50%;
 top: 50%;
 height: 80px;
 display: flex;
 justify-content: center;
 align-items: center;
   background: rgba(0,0,0,0.6);
 z-index:100;
}
</style>
<body>
<div id="loader_div">
    <img id="loading_image" src="<?php echo base_url() ?>/images/loader.gif" style="display:none;"/>
</div>
 
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
         <?php if($this->session->userdata('role') != 'parent') { ?>
         <div class="content-header-right col-md-6 col-12">
           <div class="media width-250 float-right">
             <media-left class="media-middle">
               <div id="sp-bar-total-sales"></div>
             </media-left>
             <div class="media-body media-right text-right">
                <ul class="list-inline mb-0">
           <li><a href="<?php echo site_url('Students/list_'); ?>" class="btn btn-primary"   ><b>Student List</b></a></li>
         </ul>
               
             </div>
           </div>
         </div>
         <?php } ?>
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
         <form id="registrationForm" class="form-horizontal" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" enctype="multipart/form-data">
           <input type="hidden" name="id" id="id" value="<?php if(isset($id)){echo $id;}?>">
   <div class="row">
                         <div class="col-md-3">
                           <label><strong>Student Name*</strong></label>
                         </div>
                       <div class="col-md-3">
                          <input type="text" id="student_name" name="student_name"  oninput="" class="form-control" value="<?php if(isset($name)) { echo $name; } ?>">
                         <span class="errorMsg"></span>
                       </div>
                       <div class="col-md-3">
                         <label><strong>Date of Birth*</strong></label>
                       </div>
                     <div class="col-md-3">
                       <input type="date" id="student_dob" name="student_dob"   class="form-control" value="<?php if(isset($dob)) { echo $dob; } ?>"  max="<?php echo date("Y-m-d");?>" >
                       <span class="errorMsg"></span>
                     </div>
                     </div>
                     <div class="row">
                       <div class="col-md-3">
                       <label><strong>Age*</strong></label>
                       </div>
                       <div class="col-md-3">
                          <input type="text" id="student_age" name="student_age"  class="form-control" oninput="allnumeric(document.form.student_age); return age();" value="<?php if(isset($age)) { echo $age; } ?>" readonly>
                        <span class="errorMsg"></span>
                       </div>
           
           <div class="col-md-3">
                       <label><strong>Gender*</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input id="student_gender" type="radio" value="Male" name="student_gender" <?php if(isset($gender) && $gender=="Male"){ echo 'checked';} ?> />
                         <label style="margin-left: 10px; margin-right: 10px">Male</label>
                         <input id="student_gender" type="radio" value="Female" name="student_gender" <?php if(isset($gender) && $gender=='Female'){ echo 'checked';} ?> />
                         <label style="margin-left: 10px; margin-right: 10px">Female</label>    
                         
                         <span class="errorMsg"></span>
                       </div>
                     </div>                        
                                          
                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Father's Name*</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="father_name" name="father_name"  class="form-control" oninput="" value="<?php if(isset($father_name)) { echo $father_name; } ?>">
                          <span class="errorMsg"></span>
                       </div>
           
           <div class="col-md-3">
                        <label><strong>Father's Contact No*</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input  type="text" id="father_contact_no" name="father_contact_no"  class="form-control" oninput=" allnumeric(document.form.father_contact_no); return contact_check(document.form.father_contact_no);" value="<?php if(isset($father_contact)) { echo $father_contact; } ?>">
                          <span class="errorMsg"></span>
                       </div>
                     </div>
                      
                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Mother's Name*</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text"  id="mother_name" name="mother_name"  class="form-control" oninput="" value="<?php if(isset($mother_name)) { echo $mother_name; } ?>">
                          <span class="errorMsg"></span>
                       </div>
           
           <div class="col-md-3">
                        <label><strong>Emergency Contact No*</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text"  id="emergency_contact_no" name="emergency_contact_no"  class="form-control" oninput=" allnumeric(document.form.emergency_contact_no); return contact_check(document.form.emergency_contact_no);" value="<?php if(isset($emergency_contact)) { echo $emergency_contact; } ?>">
                          <span class="errorMsg"></span>
                       </div>
                     </div>
                     
    <button type="button" onclick="moretext()"  id="btntxt"  class="btn btn-success">Show More <i> &#9660;</i></button>
  
    <div id="showmore" style="display:none;">
            <div class="row">
                   <div class="col-md-3">
                    <label><strong>Registered Parent Mobile*</strong></label>
                   </div>
                   <div class="col-md-3">
                   <select name="parent_mobile" id="parent_mobile" class="form-control parent_mobile"   onchange="parent_details()" >
                      <option value="">Select</option>
                       <?php foreach ($parentsList as $key => $parent) {?>
                       <option value="<?php echo $parent['mobile_no'] ?>" <?php if($parent['mobile_no']==$parent_mobile ){ echo 'selected';} ?>><?php echo $parent['mobile_no']; ?></option>
                       <?php }  ?>
                     </select>
                    <span class="errorMsg"></span>
                   </div>
                    <?php
                       $role = strtolower($this->session->userdata['role']);
                       
                       ?>
                    <div class="col-md-6" id="result"  <?php if($role == 'parent') echo "style='display:none;' "?> >
                   </div> 
               </div>
               
             
              
                     
                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Passport-ID</strong></label>
                       </div>
                       <div class="col-md-3">
                        <input type="text" id="passport_id" name="passport_id"  class="form-control" value="<?php if(isset($passport_id)) { echo $passport_id; } ?>">
            <span class="passport_id_errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Student's Passport Image</strong></label>
                       </div>
                       <div class="col-md-3">
                         <?php if(!isset($image_file_name) || $image_file_name=="") { ?>
                         <input type="file" name="student_passport_image" id="student_passport_image" onchange="return fileValidation(document.form.student_passport_image)" >
                         <p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p>
                       <?php } else { ?>
                         <input type="file" name="student_passport_image" id="student_passport_image" onchange="return fileValidation(document.form.student_passport_image)" >
                         <span class="errorMsg"></span>
                          <input type="hidden" id="student_passport_image1" name="student_passport_image1" value="<?php if($image_file_name) { echo $image_file_name; } ?>">
                         
                         (<?php if($image_file_name) { echo $image_file_name; } ?>)<?php } ?>
                       </div>
                     </div>
                     
                     
                   
                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Nationality</strong></label>
                       </div>
                       <div class="col-md-3">
                        <input type="text" id="nationality" name="nationality"   class="form-control" oninput="allLetter(document.form.nationality)" value="<?php if(isset($nationality)) { echo $nationality; } ?>">
                       </div>
           <div class="col-md-3">
                        <label><strong>Country</strong></label>
                       </div>
                       <div class="col-md-3">
                       <input type="text" id="country" name="country"   class="form-control" oninput="allLetter(document.form.country)" value="<?php if(isset($country)) { echo $country; } ?>">
                        <span class="errorMsg"></span>
                       </div>
                    
                    
                     </div>
                         
                    <div class="row">
                     <div class="col-md-3">
                    <label><strong>State</strong></label>
                   </div>
                   <div class="col-md-3">
                   <input type="text" id="state" name="state"  class="form-control" oninput="allLetter(document.form.state)" value="<?php echo $state; ?>">
                    <span class="errorMsg"></span>
                   </div>
                   </div>
                   
         <div class="row">
                       <div class="col-md-3">
                        <label><strong>District</strong></label>
                       </div>
                       <div class="col-md-3">
                       <input type="text" id="district" name="district"  class="form-control" oninput="allLetter(document.form.district)" value="<?php echo $district; ?>">
                        <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>City</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="city" name="city"  class="form-control" oninput="allLetter(document.form.city)" value="<?php echo $city; ?>">
                        <span class="errorMsg"></span>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>School Name</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="school_name" name="school_name"  class="form-control" value="<?php echo $school_name; ?>" >
                        <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Sibling Name</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="sibling_name" name="sibling_name" class="form-control" oninput="allLetter(document.form.sibling_name)" value="<?php echo $sibling_name; ?>">
                        <span class="errorMsg"></span>
                       </div>
                     </div>

                    <div class="row">
                       <div class="col-md-3">
                        <label><strong>Sibling Reg No</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="sibling_reg_no" name="sibling_reg_no"  class="form-control" oninput="allnumeric(document.form.sibling_reg_no)" value="<?php echo $sibling_reg_no; ?>">
                        <span class="errorMsg"></span>
                       </div>
                                   <div class="col-md-3">
                        <label><strong>Father's E-Mail-ID</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="father_email_id" name="father_email_id"  class="form-control" onchange="ValidateEmail(document.form.father_email_id)" value="<?php echo $father_email; ?>"> 
                        <span class="errorMsg"></span>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Father's office Contact No</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="father_office_contact_no" name="father_office_contact_no"  class="form-control" oninput=" allnumeric(document.form.father_office_contact_no)" value="<?php echo $father_office_contact; ?>"> 
                        <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Mother's Contact No</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="mother_contact_no" name="mother_contact_no"  class="form-control" oninput="allnumeric(document.form.mother_contact_no); return contact_check(document.form.mother_contact_no);" value="<?php echo $mother_contact; ?>">
                        <span class="errorMsg"></span>
                       </div>
                     </div> 

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Mother's office Contact No</strong></label>
                       </div>
                       <div class="col-md-3">
                         <input type="text" id="mother_office_contact_no" name="mother_office_contact_no"  class="form-control" oninput=" allnumeric(document.form.mother_office_contact_no)" value="<?php echo $mother_office_contact; ?>">
                        <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Mother's E-Mail-ID</strong></label>
                       </div>
                       <div class="col-md-3">
                          <input type="text" id="mother_email_id" name="mother_email_id"   class="form-control" onchange="ValidateEmail(document.form.mother_email_id)" value="<?php echo $mother_email; ?>">
                        <span class="errorMsg"></span>
                       </div>
                     </div> 

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Student's E-Mail-ID</strong></label>
                       </div>
                       <div class="col-md-3">
                          <input type="text" id="student_email_id" name="student_email_id"  class="form-control" onchange="ValidateEmail(document.form.student_email_id)" value="<?php echo $student_email; ?>">
                        <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Address1</strong></label>
                       </div>
                       <div class="col-md-3">
                        <textarea  id="address1" name="address1"  class="form-control"><?php echo $address_1; ?></textarea>
                       </div>
                     </div> 

                      <div class="row">
                       <div class="col-md-3">
                        <label><strong>Address2</strong></label>
                       </div>
                       <div class="col-md-3">
                        <textarea  id="address2" name="address2"  class="form-control"><?php echo $address_2; ?></textarea>
                       </div>
            <div class="col-md-3">
                        <label><strong>Postal Code</strong></label>
                       </div>
                       <div class="col-md-3">
                        <input type="text" id="postal_code" name="postal_code"  class="form-control" value="<?php echo $postal_code; ?>"  oninput="allnumeric(document.form.postal_code);">  
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Student Emirates ID</strong></label>
                       </div>
                       <div class="col-md-3">
                        <input type="text" id="student_emirates_id" name="student_emirates_id"  class="form-control" value="<?php echo $emirates_id; ?>">  
                       </div>
           <div class="col-md-3">
                        <label><strong>Date of Issue</strong></label>
                       </div>
                       <div class="col-md-3">
                       <input type="date" id="date_of_issue" name="date_of_issue"  class="form-control" value="<?php echo $emirates_id_issue; ?>">  
                       </div>
                   </div>
                   <div class="row">
           <div class="col-md-3">
                        <label><strong>T-Shirt Size</strong></label>
                       </div>
                       <div class="col-md-3">
                        <select name="tshirt_size" id="tshirt_size" class="form-control tshirt_size"  >
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
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Student's Photo</strong></label>
                       </div>
                       <div class="col-md-3">
                         <?php if($student_passport_file_name=="") { ?>
                           <input type="file" name="student_passport_size_image" id="student_passport_size_image" onchange="return fileValidation(document.form.student_passport_size_image)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p>
                           
                         <?php } else { ?>
                           <input type="file" name="student_passport_size_image" id="student_passport_size_image" onchange="return fileValidation(document.form.student_passport_size_image)" >
                            <input type="hidden" id="student_passport_size_image1" name="student_passport_size_image1" value="<?php echo $student_passport_size_image; ?>">
                           
                           (<?php echo $student_passport_file_name; ?>)<?php } ?>
                           <span class="errorMsg"></span>
                       </div>
            <div class="col-md-3">
                        <label><strong>Student's Visa Page</strong></label>
                       </div>
                       <div class="col-md-3">
                          <?php if($student_visapage_file_name=="") { ?>
                         <input type="file" name="student_visa_page" id="student_visa_page" onchange="return fileValidation(document.form.student_visa_page)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p>
                       <?php } else { ?>
                         <input type="file" name="student_visa_page" id="student_visa_page" onchange="return fileValidation(document.form.student_visa_page)" >
                          <input type="hidden" id="student_visa_page1" name="student_visa_page1" value="<?php echo $student_visapage_file_name; ?>">
                         
                         (<?php echo $student_visapage_file_name; ?>)<?php } ?>
                         <span class="errorMsg"></span>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Student's Emirates-ID</strong></label>
                       </div>

                       <div class="col-md-3">
                          <?php if($student_emid_file_name=="") { ?>
                         <input type="file" name="student_emirates_id_image" id="student_emirates_id_image" onchange="return fileValidation(document.form.student_emirates_id_image)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              
                         <input type="file" name="student_emirates_id_image" id="student_emirates_id_image" onchange="return fileValidation(document.form.student_emirates_id_image)" >
                          <input type="hidden" id="student_emirates_id_image1" name="student_emirates_id_image1" value="<?php echo $student_emid_file_name; ?>">
                         
                         (<?php echo $student_emid_file_name; ?>)<?php } ?>
                         <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Sponsor's Passport</strong></label>
                       </div>
                       <div class="col-md-3">
                          <?php if($sponsor_passport_file_name=="") { ?>
                         <input type="file" name="sponsor_passport" id="sponsor_passport" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                            
                         <input type="file" name="sponsor_passport" id="sponsor_passport" onchange="return fileValidation(document.form.sponsor_passport)" >
                          <input type="hidden" id="sponsor_passport1" name="sponsor_passport1" value="<?php echo $sponsor_passport_file_name; ?>">
                         
                         (<?php echo $sponsor_passport_file_name; ?>)<?php } ?>
                         <span class="errorMsg"></span>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-3">
                        <label><strong>Sponsor's Visa Page</strong></label>
                       </div>
                       <div class="col-md-3">
                          <?php if($sponsor_visapage_file_name=="") { ?>
                          <input type="file" name="sponsor_visa_page" id="sponsor_visa_page" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                            <!--  <div class="col-md-3 control text-left"><strong>Sponsor's Visa Page</strong>  -->
                         <input type="file" name="sponsor_visa_page" id="sponsor_visa_page" onchange="return fileValidation(document.form.sponsor_passport)" >
                          <input type="hidden" id="sponsor_visa_page1" name="sponsor_visa_page1" value="<?php echo $sponsor_visapage_file_name; ?>">
                         
                         (<?php echo $sponsor_visapage_file_name; ?>)<?php } ?>
                         <span class="errorMsg"></span>
                       </div>
           <div class="col-md-3">
                        <label><strong>Sponsor's Emirates-ID</strong></label>
                       </div>
                       <div class="col-md-3">
                           <?php if($sponsor_emid_file_name=="") { ?>
                          <input type="file" name="sponsor_emirates_id" id="sponsor_emirates_id" onchange="return fileValidation(document.form.sponsor_passport)" ><p>(Only .pdf .png and .jpg are allowed) - max upload size 2MB</p><?php } else { ?>
                              
                         <input type="file" name="sponsor_emirates_id" id="sponsor_emirates_id" onchange="return fileValidation(document.form.sponsor_passport)" >
                          <input type="hidden" id="sponsor_emirates_id1" name="sponsor_emirates_id1" value="<?php echo $sponsor_emid_file_name; ?>">
                         
                         (<?php echo $sponsor_emid_file_name; ?>)<?php } ?>
                         <span class="errorMsg"></span>
                       </div>
                     </div> 
           </div>

                    
                      
                       <?php
                       $role = strtolower($this->session->userdata['role']);
                       if($role=='superadmin' || $role=='admin'):
                       ?>
                          <div class="row">
                        <div class="col-md-3 control text-left"><strong>Status*</strong> 
                        <select name="status" id="status" class="form-control status"  >
                           <option value="">Select</option>
                          <option value="Active" <?php if($status=="Active"){ echo 'selected';} ?>>Active</option>
                         <option value="Inactive" <?php if($status=="Inactive"){ echo 'selected';} ?>>Inactive</option>
                       </select>
                       <span class="errorMsg"></span>
                       </div>
                     
                        <div class="col-md-3 control text-left"><strong>Approval Status*</strong>  
                        <select name="approval_status" id="approval_status" class="form-control approval"  >
                           <option value="">Select</option>
                          <option value="Pending" <?php if($approval_status=="Pending"){ echo 'selected';} ?>>Pending</option>
                         <option value="Approved" <?php if($approval_status=="Approved"){ echo 'selected';} ?>>Approved</option>
                       </select>
                       <span class="errorMsg"></span>
                       </div>
                     </div>
                     <?php endif; ?>
                 <br/>
                    <div class="row">
                     <div class="col-md-12 control text-center">
                       <?php if(isset($id) && $id!="") { ?>
                       <button type="submit" name="submit" class="btn btn-secondary" >Update</button>   
                       <?php } else { ?>
                         <button type="submit" id="save" class="btn btn-secondary" ><b> Submit</b></button>
                         <?php } ?> 
                         
                         <?php if(isset($from) && $from ="approval") { ?>
                        <a href="<?php echo base_url().'Students' ?>"     class="btn btn-secondary" >Cancel</a>
                         <?php } else { ?>
                         <a href="<?php echo base_url().'Students' ?>"     class="btn btn-secondary" >Cancel</a>
                         <?php } ?> 
                      </div>
                    </div>
                   
               </form>
           </div>
       </div></div>
</div>
</div>
</div>
</div>
<?php if($edit == 1) { ?>
<div class="row">
   <div class="col-sm-12">
       <div class="card">
           <div class="card-header">
               <h4 class="card-title">Activity</h4>
               <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              
           </div>
           <div class="card-content collapse show">
               <div class="card-body card-dashboard">
               <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                   <thead>
                   <tr>
                        <td>Balance <?php echo isset($balance)?number_format((float)$balance, 2, '.', ''):'0.00';?> AED</td>
                         
                         
                         <td colspan="6"></td>
                         <td style="text-align: center;"><button type="button" id="transactionHistoryBtn" class="btn btn-info" onClick="show_transaction('<?php echo $role;?>');">Transaction History</button></td>
                         <td style="text-align: center; width: 150px; height: 50px">
                           <?php if($status == 'Active'){ ?>
                             <button id="my1Btn" class="btn btn-primary" onClick="$('#myModal').show()">New Activity</button>
                           <?php } ?>
                           </td>
                   </tr>
                     <tr>
                     <th style="text-align: center">PSA-ID</th>
                     <th style="text-align: center">Activity</th>
                     <th style="text-align: center">Level</th>
                     <th style="text-align: center">Contract</th>
                     <th style="text-align: center">Contract Details</th>
                      
                     <th style="text-align: center">Action</th>
                     <th style="text-align: center">Book Slot</th>
                     <th style="text-align: center">View Booked Slot</th>
                     <th style="text-align: center">Refund / Swap Slot</th>
                     
   
                   </tr>
                 
           </thead>
           <tbody>
              <?php                      
                 foreach ($activitylists as $key => $row1) { ?>
                   <tr>
                      <td style="text-align: center"><?php   echo $row1['psa_id'];  ?></td>
                   <td style="text-align: center"><?php echo $row1['game']; ?></td>
                   <td style="text-align: center"><?php echo $row1['level']; ?></td>
                   <td style="text-align: center"><?php echo $row1['contract']; ?></td>
                   <td style="text-align: center">
                       <a type="button" style="color:white;text-decoration:none;" class="btn btn-info fa fa-info"  href="<?php echo base_url('Contract_details' );?>">
                       </a>
                       
                   </td>
                   <td style="text-align: center;" >
                     <a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit"  href="<?php echo base_url('activity_selections/edit/'.$row1['id'].'/'.$id )?>">
                     </a>
                   </td>
                   
                   <!--<td style="text-align: center"><a type="button" style="color:white;text-decoration:none;" class="btn btn-success fa fa-calendar-check-o"  href="<?php echo base_url('Student_profile_slot_booking/book/'.$row1['activity_id'].'/'.$id )?>"></a>
                   </td>-->
                   <td style="text-align: center"><button style="color:white;text-decoration:none;" class="btn btn-success fa fa-calendar-check-o  student_book"  data-activity_id="<?php echo $row1['activity_id'];?>" data-id="<?php echo $id;?>"></button>
                   </td>
                   
                   <td style="text-align: center;" >
                     <a id="myBtn" class="btn btn-info fa fa-eye"  href="<?php echo base_url('student_profile_slot_booking/viewbooking/'.$row1['activity_id'].'/'.$row1['student_id']); ?>"></a>
                   </td>
                    <td style="text-align: center;" >
                     <a id="myBtn2" class="btn btn-danger fa fa-exchange"  href="<?php echo base_url('student_profile_slot_booking/swap_slot_list/'.$row1['activity_id'].'/'.$row1['student_id'].'/'.$id); ?>"></a>
                   </td>
                  
                       
                   </tr>
                 <?php } ?>
               </tbody>
             </table>
   </div>
               </div>
         </div>
       </div>
   </div>
</div>
<?php } ?>
</section>
</div>
</div>
</div>

<!-- Trigger/Open The Modal -->
<div id="myModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="display: none;">
 <div class="modal-dialog" style="width: 30%; margin-top: 100px">
   <div class="modal-content" style="width: 100%">
     <div class="modal-body" style="width: 100%">
     <div class="alert alert-info">
       <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black; opacity:0.6" onClick="$('#myModal').hide();">&times;<span style="font-size:15px">Close</span></button>
       <strong> Activity Selection </strong>
     </div>
     <div class="alert alert-info">
       <form id="addActivityForm" class="form-horizontal"  name="form" method="POST">
         <label > Activity </label>&nbsp;&nbsp;&nbsp;
         <input type="hidden" name="sid" class="sid" value="<?php echo $id; ?>">
         <input type="hidden" name="registration_id" class="registration_id" value="<?php echo $parent_user_id; ?>">
         <input type="hidden" name="parent_id" class="parent_id" value="<?php echo $parent_id; ?>">
         <select name="activity_id" id="activity_id" class="form-control"  required="">
           <option value="">Select</option>
           <?php                        
           
           foreach($games as $key => $row5){ ?>
           <option value="<?php echo $row5['game_id'] ?>" ><?php echo $row5['game'] ?>
           </option><?php   }  ?>
         </select>
         <br>
         <span class="errorMsg activityError"></span>
         <br>
         <br>
         <button id="save"  type="button" name="submit" class="btn btn-success activity_submit" onClick="createActivity();" >Submit</button>
         <!--<input id="save" type="submit" value="Submit" name="submit" class="btn btn-success" >-->
         <a onClick="$('#myModal').hide();"    class="btn btn-danger" >Cancel</a>
       </form>
     </div>
     </div>
   </div>
 </div>
</div>

<!-- Trigger/Open The Modal -->
<div id="transactionHistoryModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;">
 <div class="modal-dialog" style="width: 100%;
   float: none;
   margin: 0 auto;
   max-width: 38%;">
   <div class="modal-content">
     <div class="modal-body" style="width: 100%;">
     <div class="alert alert-info">
       <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;opacity:0.6" onClick="$('#transactionHistoryModal').hide();">&times;<span class="close-x">Close</span></button>
       <strong> Transaction History </strong>
     </div>
     <div class="">
       
       <div class="table-responsive">
       <table id="listTable" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
           <thead>
               <tr>
                   <th>Wallet Transaction ID</th>
                   <th>Date</th>
                   <th>Transaction Details</th>
                   <th>Parent ID</th>
                   <th>Student ID</th>
                   <th>Location</th>
                   <th>Gross Amount</th>
                   <th>Discount %</th>
                   <th>VAT %</th>
                   <th>VAT Amount</th>
                   <th>Credit (AED)</th>
                   <th>Debit (AED)</th>
                   <th>Balance</th>

               </tr>
           </thead>
           <tbody>
           </tbody>
           
       </table>
       </div>
       
         <br>
         <br>
         
         <a onClick="$('#transactionHistoryModal').hide();"    class="btn btn-danger" >Cancel</a>
       
     </div>
     </div>
   </div>
 </div>
</div>




<div id="prepaidcreditsModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;">
 <div class="modal-dialog" style="width: 100%;
   float: none;
   margin: 0 auto;
   max-width: 38%;">
   <div class="modal-content">
     <div class="modal-body" style="width: 100%;">
     <div class="alert alert-info">
       <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;opacity:0.6" onClick="$('#prepaidcreditsModal').hide();">&times;<span class="close-x">Close</span></button>
       <strong> Transaction History </strong>
     </div>
     <div class="">
       
     <div class="form-group lg-btm">
 <div class="row">
 <div class="col-md-3 control"><strong>Registration ID/Name</strong>*</div>                            
 <div class="col-md-3 control text-right">
   <select name="student_id" id="student_id" class="form-control student_id"  required="" onchange="student_details()">
     <option value="">Select</option>
     <?php foreach ($studentList as $key => $row){ ?>
     <option value="<?php echo $row['id'] ?>" <?php if(isset($student_id) && $row['id']==$student_id ){ echo 'selected';} ?>><?php echo $row['sid']; ?>-<?php echo $row['name']; ?>
     </option><?php } ?>
   </select>
   <span class="errorMsg"></span>
 </div>
 </div>
 </div>

   <div id="result"></div> 
   
   <div class="form-group lg-btm">
   <div class="row">
       <div class="col-md-3 control">
               <strong>Payment Type</strong>*
             </div>                            
       <div class="col-md-3 control">
         <input id="payment_type" type="radio" value="wallet" previousValue="" name="payment_type" <?php if(isset($pay_type) && $pay_type=='wallet'){ echo 'checked';} else { 'checked'; }?> checked required/>
         <label style="margin-left: 10px; margin-right: 10px">Wallet</label>
         <span class="errorMsg"></span>
         
       </div>
   </div>
    </div>

   <div id="result1"></div>
   
   <div class="form-group lg-btm">
       <div class="row">
     <div class="col-md-3 control">
             <strong>Category</strong>*
           </div>                            
     <div class="col-md-3 control text-right">
       <input type="text" id="catagory" name="catagory" required="" value="<?php echo isset($category)?$category:''; ?>" readonly=""  class="form-control">
     </div>
 </div>
 </div>
 
   <div class="form-group lg-btm">
       <div class="row">
     <div class="col-md-3 control">
             <strong>Reg-Fee Amount(AED)</strong>*
           </div>                            
     <div class="col-md-3 control text-right">
       <input type="text" id="reg_fee_amount" name="reg_fee_amount" value="<?php echo isset($reg_fee)?$reg_fee:''; ?>" oninput="calculate()" readonly=""  class="form-control">
     </div>
 </div>
  </div>
   
    <div class="form-group lg-btm">
         <div class="row">
       <div class="col-md-3 control">
               <strong>VAT Percentage(%)</strong>*
             </div>                            
       <div class="col-md-3 control text-right">
         <input type="text" id="vat_percentage" name="vat_percentage" required="" value="<?php echo isset($vat_perc)?$vat_perc:'0'; ?>" class="form-control" readonly="">
         <span class="errorMsg"></span>
       </div>
   </div>
    </div>
   
   <div class="form-group lg-btm">
       <div class="row">
       <div class="col-md-3 control">
               <strong>VAT Value</strong>*
             </div>                            
       <div class="col-md-3 control text-right">
         <input type="text" id="vat_value" name="vat_value" required="" value="" readonly=""  class="form-control">
         <span class="errorMsg"></span>
       </div>
   </div>
</div>
   
    <div class="form-group lg-btm">
        <div class="row">
       <div class="col-md-3 control">
               <b>Payable Amount(inclusive of VAT)</b>*
             </div>                            
       <div class="col-md-3 control text-right">
         <input type="text" id="payable_amount" name="payable_amount" required="" readonly="" value="<?php echo isset($wallet_balance)?$wallet_balance:'';  ?>" oninput="allnumeric(document.form.payable_amount);"   class="form-control" >
         <span class="errorMsg"></span>
       </div>
   </div>
    </div>


    <div class="form-group lg-btm">
     <div class="col-md-6 control text-center">
     <?php if(isset($student_id) && $student_id!="") { ?>
        <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('registration_fees/edit/'); ?>"       class="btn btn-success" />     <?php } else { ?>
         <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('registration_fees/add/'); ?>"       class="btn btn-success" />          
         <?php } ?>
       
         <a onClick="$('#prepaidcreditsModal').hide();"    class="btn btn-danger" >Cancel</a>





 
 </form>
 
</div>
</div>
</div>
</div>
</div>

</div>
</div>

<!-- pay fees -->
<div class="modal fade rotate" id="payregistrationfeesModel" style="display:none;">
   <div class="modal-dialog modal-lg"> 
       <form id="voucher_reverse-form" method="post">   
           <div class="modal-content panel panel-success">
               <div class="modal-header panel-heading">
                   <h4 class="modal-title -remove-title">REGISTRATION FEES </h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body panel-body">
                   <p><span class="alertMsg"></span></p>
                   <table class="table table-striped table-bordered" >
                       <tr>
                           <td><b>Student ID</b></td>
                           <td><p class="student_id"></p></td>
                       </tr>
                       <tr>
                           <td><b>Student Name</b></td>
                           <td><p class="student_name"></p></td>
                       </tr>
                       <tr>
                           <td><b>Parent ID</b></td>
                           <td><p class="parent_id"></p></td>
                       </tr>
                       <tr>
                           <td><b>Parent Name</b></td>
                           <td><p class="parent_name"></p></td>
                       </tr>
                       <tr>
                           <td><b>Mobile No</b></td>
                           <td><p class="mobile_no"></p></td>
                       </tr>
                   
                       <tr>
                           <td><b>Student Category</b></td>
                           <td><p class="student_category"></p></td>
                       </tr>
                       <tr>
                           <td><b>Registration Fees Amount</b></td>
                           <td><p class="registration_fees"></p></td>
                       </tr>
                       <tr>
                           <td><b>Mode</b></td>
                           <td><p class="mode"></p></td>
                       </tr>
                       <tr>
                           <td><b>Wallet Balance</b></td>
                           <td><p class="wallet_balance"></p></td>
                       </tr>
                       <tr>
                           <td><b>VAT</b></td>
                           <td><p class="vat"></p></td>
                       </tr>
                       <tr>
                           <td><b>VAT Amount</b></td>
                           <td><p class="vat_amount"></p></td>
                       </tr>
                       <tr>
                           <td><b>Payable Amount(Inclusive of 5.0% VAT)</b></td>
                           <td><p class="payable_amount"></p></td>
                       </tr>
                       <div>
                       <button type="button" class="btn btn-success" id="paynow">Pay Now</button>
                       <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
                       </div> 
                      
                   </table>
               
               </div>
               
           </div>
       </form>      
  
   </div>
</div> 
</body>

</html>  

<?php
  //$this->load->view('includes/footer_select2');
?>
<script>
   function moretext() {
       var textmore = document.getElementById("showmore");
       var txtbtn = document.getElementById("btntxt");
       if (textmore.style.display === "none") {
           textmore.style.display = "block";
           txtbtn.innerHTML ="Show Less &#9650;";
       
       } else {
           textmore.style.display = "none";
           txtbtn.innerHTML ="Show More &#9660";
       }
   }
</script>

<script type="text/javascript">
 parent_details();
 function createActivity(){
   activity_id = jQuery('#activity_id').val();
   if(activity_id == ''){
     var element = $('.activityError');
     $(element).html('<div class="text-danger left_align" style="font-size: 14px;">Please select activity.</div>');
   }else{
     jQuery.ajax({
         type:'POST',
         url:baseurl+'student_profile_slot_booking/addActivity',
         data:jQuery("form#addActivityForm").serialize(),
         dataType:'json',    
         beforeSend: function () {
             jQuery('button.activity_submit').text('loading');
         },
         success: function (json) {
             $('.text-danger').remove();
             if (json['error']) {             
               var element = $('.activityError');
               $(element).html('<div class="text-danger left_align" style="font-size: 14px;">'+json['error']+'</div>');
               
               jQuery('button.activity_submit').text('Submit');
           } else {
             
             if(json['status']=='success'){
               location.reload();
             }
           }

         },
         error: function (xhr, ajaxOptions, thrownError) {
             console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
         }        
     });
   }
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

<script type="text/javascript">

 $(document).ready(function (e) {

   

$('.parent_mobile').select2();
$('.tshirt_size').select2();
$('.status').select2();
$('.approval').select2();

$(".student_book").on('click',function(e) {
 
 var activity_id = $(this).attr('data-activity_id');
 var id = $(this).attr('data-id');
 $.ajax({
   type: "POST",
   url: base_url+"Student_profile_slot_booking/check_student_to_book_by_admin",
   data: {id:id, activity_id:activity_id},
   async: true,
   datatype: "text",
   success : function(data)
   {
       //$('#contract_form_data').html(data);
       //var obj = JSON.parse(data);
       if(data==0)
       {
           //swal('Registration Fees Due!..','Please pay registration fees and proceed for slot booking','warning');
           swal({
               title: "Registration Fees Due!..",
               text: "Please pay registration fees and proceed for slot booking",
               icon: "warning",
               buttons: ["Pay now", "Cancel"],
               
             }).then((Button) => {
               if (!Button) {
                 

                // var student_id = $('#hidden_student_id').val();
                 jQuery.ajax({
                       type:'POST',
                       url:baseurl+'Reports/getDialog2/',
                       data:{id:id},
                       dataType:'json',    
                       success: function (result) {
                       //  var obj = JSON.parse(result);
                       var obj = result;
                       
                            
                          
                          $('.student_id').html(obj.sid);
                        $('.student_name').html(obj.name);
                        $('.parent_id').html(obj.code);
                        $('.parent_name').html(obj.parent_name);
                        $('.mobile_no').html(obj.parent_mobile);
                        $('.student_category').html(obj.reg_fee_category);
                        $('.registration_fees').html(obj.reg_fee);
                        $('.mode').html('Wallet');
                        $('.wallet_balance').html(obj.balance_credits);
                        $('.vat').html(obj.vat_perc);
                        var vat_amount = (parseFloat(obj.reg_fee)*parseFloat(obj.vat_perc)/100);
                        var net_amount = parseFloat(obj.reg_fee)+parseFloat(vat_amount);
                        $('.vat_amount').html(vat_amount.toFixed(2)); 
                        $('.payable_amount').html(net_amount.toFixed(2)); 

                           $('#payregistrationfeesModel').modal('show');
                           
                       },
                       error: function (xhr, ajaxOptions, thrownError) {
                           console.log(thrownError + "\r\n" + xhr.fees_paidText + "\r\n" + xhr.responseText);
                       }         
               });

                 /*swal("Poof! Your imaginary file has been deleted!", {
                   icon: "success",
                 });*/
               }else {
                 
               }
             });
       }
       else
       {
           window.location=base_url+'Student_profile_slot_booking/book/'+activity_id+'/'+id;
       }
       
   }
   });
});

    $('#cancel').click(function(){
      $("#payregistrationfeesModel .close").click();
    }); 

    $('#paynow').click(function(){
        
        
        //$("#payregistrationfeesModel .close").click();
        //var modal = $("#payregistrationfeesModel");
        //alert('Payment completed Successfully!');   
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Registration_fees/payRegistration',
            data:{id:"<?php echo $id;?>"},
            dataType:'html', 
            success: function(output) {
                if(!output)
                {
                  swal('Insufficient Balance','Please recharge your wallet and proceed for slot booking','warning');
                }
                else
                {
                    $("#payregistrationfeesModel .close").click();
                    swal('Registration Fees Paid','','success');
                }
          }       
        });
    });




$("#registrationForm").on('submit',(function(e) {
    var role = "<?php echo $role;?>";
 e.preventDefault();
 // $("#loading_image").show();
 $.ajax({
   url: baseurl+'Students/addStudent',
  type: "POST",
  data:  new FormData(this),
  contentType: false,
   cache: false,
  processData:false,
  success: function(json){
   var firstId = '';
   $(".errorMsg").html('');
 $('.passport_id_errorMsg').html('');
   $('.text-danger').remove();
         if (json['error']) {             
             for (i in json['error']) {
               if(firstId == ''){
                 firstId = i;
               }
                 //var element = $('.input-school-' + i.replace('_', '-'));
                 var element = $('#'+ i);
                 $(element).parent().find(".errorMsg").html(json['error'][i]);
             }
             $('#'+firstId).focus();
               var textmore = document.getElementById("showmore");
               var txtbtn = document.getElementById("btntxt");
               if (textmore.style.display === "none") {
                   $( "#btntxt" ).trigger( "click" );
               
               } 
               
             
         } else {
      //  $("#loading_image").hide();
             if(json['status'] == 'success'){
               jQuery('form#registrationForm').find('textarea, input, select').each(function () {
                   jQuery(this).val('');
               });
       if(role == 'parent'){
           window.location.href = baseurl+'Active_kids';
       
       }
       else
       {
            window.location.href = baseurl+'Students/list_';
       }
         }
          if(json['status'] == 'Passport Number Already Exists.')
      {
     $('.passport_id_errorMsg').html('Passport number already exists.');
      }		  		 
         }
     },
    error: function (xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
       }          
   });
}));




});
function show_transaction(role)
{
    $('#transactionHistoryModal').show();
    var id = $('#id').val();
    var pid = $('#parent_id').val();
    
    $.ajax({ 	
           type: "POST",   
           url: base_url+"Students/transaction_history",
           data:{ id: id, parent_id:pid},		
           async: false,
           datatype: "html",
           success : function(data)
           {
                 
       $('#listTable').dataTable().fnDestroy();
       $('#listTable tbody').html(data);
       
       if(role == "superadmin" || role == "admin")
       {
       $('#listTable').dataTable({
           dom: 'Bfrtip',
                   buttons: [
                   {
                       extend: 'print',
                       title: "Transaction History",
                       
                   },
                   { 
                       extend: 'pdf', 
                       title: 'Transaction History', 
                   },
                   { 
                       extend: 'excel', 
                       title: 'Transaction History', 
                   
                   }],
           "order":[1, 'asc'],
           "ordering": false
           
       });
       }
       else
       {
           $('#listTable').dataTable({
               "order":[1, 'asc'],
               "ordering": false
           
           });
       }
       
     },
           fail: function( jqXHR, textStatus, errorThrown ) {
                   console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
           }
   });
    
}


 
</script>
