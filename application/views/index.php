<?php require_once('includes/header.php');?><html>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.upsingh.in/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<body style="height:80%;background-image: url('<?php echo base_url().'images/swimming2.jpg' ?>');">
<script src='https://www.google.com/recaptcha/api.js'></script>
  <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
<style type="text/css">
  .btn2
  {
    background-color: #337ab7;
    color: white;
  }
  body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}



/* Add styles to the form container */
.container {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
}
.dashboard .card-content {
    min-height: 273px;
}

/* Full-width input fields */


/* Set a style for the submit button */



    </style>
  
  
<script type="text/javascript">
  $(document).on('click','#loginBtn',function() {
  
  var username    = $('#username').val();
  var password = $('#password').val();
  var org_id  = $('#org_id').val(); 
  var formData = $('#loginForm').serialize();
  var message = '';
  var flag     = 1 ;
  var letters = /^[A-Za-z]+$/;

    
  if( username == "" ){
    message = "Please enter Username";
    flag = 0;
    $('#username').focus();
    $('.message').addClass('error').html(message);
  } 

     

  if ( password == "" ){
    message = "Please enter password";
    flag = 0;
    $('#password').focus();
    $('.message').addClass('error').html(message);
  }
});
  $(document).on('click','#signinBtn',function() {
  
  var parent_name    = $('#parent_name').val();
  var email_id = $('#email_id').val();
  var mobile_no  = $('#mobile_no').val(); 
  var formData = $('#loginForm').serialize();
  var message = '';
  var flag     = 1 ;

    
  if( parent_name == "" ){
    message = "Please enter Parent name";
    flag = 0;
    $('#username').focus();
    $('.message').addClass('error').html(message);
  } 

  if ( email_id == "" ){
    message = "Please enter Email Id";
    flag = 0;
    $('#password').focus();
    $('.message').addClass('error').html(message);
  }
   if( mobile_no == "" ){
    message = "Please enter Mobile No";
    flag = 0;
    $('#username').focus();
    $('.message').addClass('error').html(message);
  } 
});
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
document.form.username.focus();
return false;
}
}
 $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });


  


</script>


            <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-body"><!-- Zero configuration table -->
<section id="configuration" class="dashboard">
    <div class="row">
        <div class="col-12">
            
                    
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>




<div class="row">
                <div class="col-12 col-md-5" align="center" style="margin-left: 29%; margin-top: 60px" id="loginbox">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">PSSS LOGIN </h4>
       
      </div>
      <div class="card-content collapse show">
           <form id="loginForm" class="form-horizontal" action="<?php echo base_url().'login/login_validation' ?>" role="form" name="form" method="POST" align="center" style="margin-top: 20px">  

          
   <?php  echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>'; ?>
   <?php  echo '<label class="text-success">'.$this->session->flashdata("success_msg").'</label>'; ?>
            
                                <div class="form-group lg" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-12 control text-left" style="text-align: left"><strong>Username</strong></div>
                        <div class="col-md-12 control text-left">
                        <input type="text" id="username" name="username" required=""  class="form-control" placeholder="user@domain.com" >

                                  </div>
                    </div>



                                <div class="form-group lg" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-12 control text-left" style="text-align: left"><strong>Password</strong></div>
                        <div class="col-md-12 control text-left">
                        <input type="password" id="password" name="password" required=""  class="form-control" placeholder="********************">
                        </div>
                    </div>

                     <div class="row" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-6 control text-left">
                        <a type="button" style ="text-decoration:none;color:white;" onClick="$('#loginbox').hide(); $('#signupbox').show()" class="btn btn-primary btn-xs"   id="sign_up"> <i class="fa fa-user"></i> &nbsp; New Parent Signup</a>
                        </div>
                        <div class="col-md-6 control text-right"> 
                         <input id="loginBtn" type="submit"  name="signin" value="SIGN IN" style ="color:white;background-color: black; height: 41px; width: 93px"     />
                        </div>
                      </div>


                
                    <div style="margin-top:10px" class="form-group">

                        <div class="col-sm-12 control text-left">
                            <a id="Forgot" href="login.php">Forgot Password? </a>
                        </div>
                    </div>

                  </form>

                   
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
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
      if(inputtxt.id == 'mobile_no'){
        var filePath = document.getElementById('mobile_no').value;
        if(filePath.length>12){          
          jQuery('#'+inputtxt.id).parent().find(".errorMsg").html('Mobile number must be less than 12 digits');
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

   function ValidateEmail()
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
var email_id = document.getElementById('email_id').value;
if(email_id.match(mailformat))
{

return true;
}
else
{
alert("You have entered an invalid email address!");
document.getElementById("email_id").value="";
return false;
}
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

$(document).ready(function() {
    $('#signinBtn').on('click', function(){
         
            
               
            
            
            if($('#parent_name').val()=='')
            {
               jQuery('#parent_name').parent().find(".errorMsg").html("Please enter Parent Name");
               jQuery('#parent_name').focus();
            }
            else if($('#email_id').val()=='')
            {
               jQuery('#email_id').parent().find(".errorMsg").html("Please enter Email");
               jQuery('#email_id').focus();
            }
            else if($('#mobile_no').val()=='')
            {
               jQuery('#mobile_no').parent().find(".errorMsg").html("Please enter Mobile No.");
               jQuery('#mobile_no').focus();
            }
            else if($('#emirate_id').val()=='')
            {
               jQuery('#emirate_id').parent().find(".errorMsg").html("Please enter Emirates ID");
               jQuery('#emirate_id').focus();
            }
            else if(grecaptcha.getResponse() == "")
            {
               //alert("Sorry, You can't proceed!. Please confirm Captcha");
               jQuery('#g-recapt').parent().find(".errorMsg").html(" &nbsp; &nbsp; Please confirm Captcha");
            }
            else if(!$('#Condition').is(':checked'))
            {
               //alert('Please agree Terms and Conditions.')
                jQuery('#Condition').parent().find(".errorMsg").html(" </br>Please agree Terms and Conditions.");
            }
            else
            {
                $('form#signupform').submit();
            }
                
            
        
    });
});

</script>

<div id="signupbox" class="col-12 col-md-6" align="center" style="display:none; margin-left: 25%; margin-top: 20px">
<div class="card">
<div class="card-header">
<h4 class="card-title">NEW PARENT SIGNUP </h4>
</div>
<form id="signupform" class="form-horizontal" role="form" name="form" method="post" action="<?php echo base_url().'login/add_parent' ?>" style="margin-top: 10px">
  <div class="row" style="margin-left: 10px; margin-right: 10px">
   <div class="col-md-6 control text-left"><strong>Parent Name*</strong>
   <input type="text" id="parent_name" name="parent_name" class="form-control" required="" placeholder="Name" oninput="" />
   <span class="errorMsg"></span>
    </div>
       <div class="col-md-6 control text-left"><strong>Parent E-Mail*</strong>     
      <input type="text" id="email_id" name="email_id" class="form-control" required="" placeholder="Enter E-Mail" onchange="ValidateEmail(email_id)"  />
      <span class="errorMsg"></span>
    </div>
  </div>
     <div class="row" style="margin-left: 10px; margin-right: 10px">
    <div class="col-md-6 control text-left"><strong>Parent Mobile*</strong>                           
      <input type="text" id="mobile_no" name="mobile_no" class="form-control" required="regex_match[/^[0-9]{10}$/]" placeholder="Enter Mobile with(971*******)" oninput="allnumeric(mobile_no);">
      <span class="errorMsg"></span>
    </div>
          <div class="col-md-6 control text-left"><strong>Parent Emirates-ID*</strong>
        <input type="text" id="emirate_id" name="emirate_id" class="form-control" required="" placeholder="Emirates id">
        <span class="errorMsg"></span>
    </div>
  </div>
  
  <div class="row" style="margin-left: 10px; margin-right: 10px; display:none;">
    <div class="col-md-6 control text-left"><strong>Country*</strong>                           
      <select name="parent_country"  id="parent_country"  class="form-control">
       <!-- <option value="" >-Select-</option>-->
        <?php
        foreach($countries as $key => $value)
        {
        
        echo "<option value='".$value['id']."'>".$value['country_name']."</option>";
        }
        ?>
        
      </select>
      <span class="errorMsg"></span>
    </div>
      
        
  </div>
  
 <div class="row" style="margin-left: 15px; margin-right: 10px">
   <div id="g-recapt" class="g-recaptcha" data-sitekey="6LcZiPQaAAAAAOqMB829NRKYOhs7IIL5wfj_ExgS"></div>
    <span class="errorMsg"></span>
</div>
<div class="form-group"> <div class="col-md-12 control text-left">
      <input type="checkbox" id="Condition" name="Condition" required="">
      <label for="Condition"> I have read and agree to the as in the link</label>
      <a href="#"  data-toggle="modal" data-target="#myModal" onClick="$('#myModal').show(); $('#signupbox').hide()">Terms & Conditions</a> &nbsp;as in the link.
      
       <span class="errorMsg"></span>
  </div>
  </div>
     <div class="row" style="margin-left: 10px; margin-right: 10px; margin-bottom: 10px">
    <div class="col-md-8 control text-left">                       
      <a type="button" href= "#" style = "text-decoration:none;color:white;" class="btn btn-primary btn-xs" onClick="$('#loginbox').show(); $('#signupbox').hide()" id="back2"><span class="fa fa-user"></span> &nbsp; Back To Login</a>
      
      
    </div>
        <div class="col-md-4 control text-right"><span>
         <input id="signinBtn" type="button" style ="color:white;background-color: black; height: 41px; width: 93px"  name="register" value="SUBMIT" /> 
    </div>
  </div>

</form>

    </div>
</div>
    </div></div></div></section></div></div></div>

    <div class="modal " id="myModal">
    <div class="modal-dialog modal-xl"  >
  <div class="modal-content" >
      <div class="modal-body" >
        <div class="alert alert-info">
          <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="$('#myModal').hide(); $('#signupbox').show()">&times;</button>
        <strong> Venues / Facilities RULES AND REGULATIONS </strong>
        </div>
        <div class="alert alert-info">

  
 <p>Prime Star work together with all Venues to ensure a safe and secure facility for all to benefit. Please take note of the following rules when attending Training / Practice / Play at Prime Star Sport Academy LLC Training Venues.</p>
<p>The User should abide by the rules and regulations below; any breakage of below rules and regulations may lead to termination of Training / Usage without refund.
For security purposes, you will be asked to sign in before entering. There will be a sign in book at the security gate. Please make sure you adhere to signing in. (You may also be asked to leave ID, please be prepared to do so.)</p>
<p>The Indoor hall / Badminton hall / Multipurpose hall should be used only for Badminton Play by you and your guests / Training withPrime Star Sport Academy LLC Coaches.</p>
<p>Registered User/Player/Trainee once venue/slot booked cancellation or carry forward not allowed for any reason.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Adult use only :</strong></p>
<p>minor under 18 years to spectate the session, should always be accompanied by an adult.</p>
<p>Please restrict your movements to the school facility in use after school hours. Do not enter any classrooms, theatres or offices.</p>
<p>Always respect the facility and do not leave any rubbish or empty water bottles on indoor and outdoor facilities.</p>
<p>There is to be No Smoking, food or beverage is permitted in any of the sports facilities. A fine of AED 2,000 will be issued to the Trainee / Player / User for Smoking violations.</p>
<p>Littering will be fined. Please ensure everyone cleans up before they leave</p>
<p>No Studded boots on the AstroTurf/Wooden floor, correct sports footwear should be worn at all times. Non-marking Shoes should be worn in Badminton hall / Multipurpose hall during badminton use.</p>
<p>No Equipment is included in rental-do not attempt to use Venue equipment’s except Badminton Posts and Nets.All equipment needed for your activity should be provided by you (Badminton Racket, Shuttles etc.). It should not be stored or left at the facility, if any missed or lost,Prime Star Sport Academy LLCwill not be responsible for that.</p>
<p>Be Solely Responsible for the cost of any damage to venue property done by you are your guest ( Including, for the avoidance of doubt, both real property and chattels), whether caused by (i) the Registered User/Player/Trainee or the persons using the school premises at the request or invitation of the Registered User/Player/Trainee and/or otherwise in connection with the Registered User/Player/Trainee Guest (While the Prime Star Sport Academy LLC may, at its sole discretion, deduct such cost from the security deposit, the Registered User/Player/Trainee shall pay the Prime Star for such damages not covered by the security deposit immediately upon the school request.</p>
<p>Be solely responsible for supervising all guests. Registered User/Player/Trainee must take particular care to ensure proper and adequate supervision of children to avoid accident, injury, loss or damage;</p>
<p>Not to enter the venue or place any equipment or other property on the venue before the commencement of the hire period without the prior written consent of the Prime Star Sport Academy LLC and remove all of its property from the venue and otherwise ensure the venue is fully vacated to the Prime Star Sport Academy LLC satisfaction by the conclusion of hire period. If the Registered User/Player/Trainee fails to strictly abide by this clause, it shall incur the overtime charges. In addition, if the premises is not fully vacated to the Prime Star Sports Academy LLC satisfaction within (1 Hour) after the end of the hire period, the Prime Star Sport Academy LLC may, at its sole discretion, do what it deems necessary to fully vacate the premises (Including, but not limited to, removal or destruction of the Registered User/Player/Trainee property), and deduct any costs relating to such removal from the security deposit;</p>
<p>Leave the Venue clean and tidy and in the same condition it was in prior to such use. Failure to do so may result in the school:<br/>
(a) barring the Registered User/Player/Traineefrom future use of the premises, and<br/>
(b) deducting the cost of cleaning and otherwise returning the school to the condition it was in before such use began from the security deposit (While Prime Star may, at its sole discretion, deduct such costs from the security deposit, Registered User/Player/Trainee shall pay the Prime Star Sport Academy LLC for any such costs that are not covered by the security deposit immediately upon the Prime Star Sport Academy request).</p>
<p>Prime Star Sport Academy LLC will ensure that the Venue are regularly maintained to avoid any disruption to the Registered User/Player/Trainee. However, the Prime Star Sport Academy LLC will not be held responsible to Registered User/Player/Trainee if the school facilities not be available due to circumstances beyond the control of Prime Star Sport Academy LLC, such situation to include but not be limited to, power shut downs, emergency closure of any venue and loss to use of facility due to the Registered User/Player/Trainee negligence.</p>
<p>Registered User/Player/Trainee agrees that should there be a pre-arranged school events, then this event will take priority. The Prime Star Sport Academy LLC will use best endeavors to inform the Registered User/Player/Trainee of such pre-arranged school events, in such case the parties will work together to make suitable alternate arrangements.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Indemnity :</strong><br/>
    Registered User/Player/Trainee shall to the fullest extent permitted by law, indemnify, defend and hold harmless Prime Star Sport Academy LLC, the officers, directors, shareholders, partners, agents, member and employees from and against any and all of its or of Registered User/Player/Trainee expenses, demands, claims, damages to persons or property, losses and liabilities (Including attorney’s fees) that arise in connection with the commercial use, including without limitation: (a) death or injury to Registered User/Player/Trainee/Guest for any reason and (b) any expenses, demands, claims, damages to person or property, losses and liabilities (Including attorney’s fees) resulting from Prime Star Sport Academy LLC removal or destruction of property as a result of the Registered User/Player/Trainee/Guests breach of not or place any equipment or other property on the school premises before the commencement of the hire period without the prior written consent of the Prime Star Academy and remove all of its property from the school premises and otherwise ensure the premises is fully vacated to the Prime Star Sport Academy satisfaction by the conclusion of hire period.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Unavailable Session :</strong><br/>
Prime Star Sport Academy LLC reserves the right to cancel commercial user activities if it is required for other school activities. Adequate notice will be given where ever possible. If the facility is not available for use for a session the commercial user has hired it the pro-rated amount for that session will be deducted from the monthly payment or credited to the Registered User/Player/Trainee/Guests for use at a future date.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Severability :</strong><br/>
If any provision in this agreement shall be held to be illegal, invalid or unenforceable, in whole or in part, under any enactment or rule of law or otherwise, such provision (or part) shall to that extent be deemed not to form part of this letter but the legality, validity and enforceability of the remainder of this agreement shall not be affected.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Governing Law and Dispute Resolution :</strong><br/>
The agreement shall be governed by and construed in all respect in accordance with the laws of the UAE. Any dispute arising out of or in connection with this agreement, including any question regarding its existence, validity or termination, any dispute or difference between parties which arises in connection with this agreement shall be submitted to the exclusive jurisdiction of the UAE.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Venues / Facilities Rules of Use</strong><br/>
TheRegistered User/Player/Trainee shall ensure that guests adhere to the school's parking regulations.</p>
<p>The Registered User/Player/Trainee/Guests must not merchandise refreshment and foodstuffs or any kind in the premises.</p>
<p>Registered User/Player/Trainee/Guests should not entertain third party contractors on the venue premises for any reason.</p>
<p>No Items may be affixed to any surface unless they can be removed leaving no sticky residue or damage. Blue tack is recommended. No masking tape or sticky tape is to be used. All signage is to be removed by the Registered User/Player/Trainee/Guests at the end of each date of hire.</p>
<p>None of the school’s equipment may be used unless specified in Rules and Regulation. No third-party personnel will be allowed to operate any school equipment.</p>
<p>All trash shall be disposed of in receptacles designated by the Venue.</p>
<p>The Registered User/Player/Trainee/Guests shall ensure that use of venue does not interfere with normal activities of the Venue or disrupt such activities in any way.</p>
<p>The venue is strictly a non-smoking environment. The Registered User/Player/Trainee/Guestsshall not, and shall ensure that the Registered User/Player/Trainee/Guests or any third-party present at the venue shall not, use, carry, consume, sell or otherwise provide any types of tobacco or alcoholic beverages at the venue at all times.</p>
<p>The Registered User/Player/Trainee/Guests shall ensure that it, its guests and any third party present the venue, abide by any and all applicable rules, regulation and local customs.</p>
<p>The Registered User/Player/Trainee/Guests may not use or store any dangerous, combustible, or explosive materials in the venue and much comply with the direction of the venue and any rules relating to the use.</p>
<p>Potential tripping hazards must be avoided e.g. temporary electrical wires etc.</p>
<p>Open fire, torches, glass lanterns, smoke machines, combustible material and explosives, pyrotechnics, etc. are strictly forbidden on the school premises.</p>
<p>The Registered User/Player/Trainee/Guests must be aware of and follow the venue fire prevention measures, procedures and systems.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Cancelling a Booking :</strong><br/>Cancelling for booked time slot / Classes are not possible for any reason.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Clothing/Footwear :</strong><br/>Correct sports footwear should be work at all times. Non-Marking sports shoes should be worn all time during training. Studded footwear is not permitted for use on any Astroturf/wooden floor or in sports halls. Ladies are reminded to dress respectfully in correct sports attire.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Storage of Equipment :</strong><br/>The Registered User/Player/Trainee/Guests must not store equipment inside or immediately outside the school premises. Prime Star Sport Academy LLC takes no responsibility for any damage/loss of equipment stored at the venue premises.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Purpose of Booking :</strong><br/>The Registered User/Player/Trainee/Guests shall use the facilities for the purpose of Training/playing badminton only and refrain from using the facilities for any other purposes whatsoever. In the event of the clause is breached, the Prime Star Sport Academy LLC reserves the right to terminate the play/training/booking with immediate effect. Facilities should not be used other than Badminton Training/Playing, (e.g. social gatherings, services of worship)</p>
<p><strong style="font-size:17px; color:#ee1d23;">Fixed Equipment :</strong><br/>The Registered User/Player/Trainee/Guests is able to use the fixed equipment for the activity that they are the facility to play. This includes Badminton Post and nets. The Prime Star Sport Academy LLC does not accept any responsibility for any individual who sustains injury from use of fixed equipment.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Children's:</strong><br/>Child spectators are not permitted during evening / weekends sessions unless they are constantly supervised on a 1 adult to 1 child ratio. The Prime Star Sport Academy LLC/ the Venue Securities reserves the right to ask any unattended children’s and the parents/guardian to leave immediately if this policy is not adhered to.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Pets/Animals :</strong><br/>Pets or animals of any kind are not permitted on any venues. </p>
<p><strong style="font-size:17px; color:#ee1d23;">Food/Drink :</strong><br/>The Registered User/Player/Trainee/Guests can bring water and sports drinks only. Food and hot drinks of any kind are not permitted in the sports halls. Anyone caught eating in sports hall will be asked to leave the venue immediately.</p>
<p><strong style="font-size:17px; color:#ee1d23;">Damage to School Facility :</strong><br/>The Registered User/Player/Trainee/Guests mush report any damage to the venue facility to the Prime Star Sport Academy Manager and venue security immediately upon its occurrence.</p>


<div class="clearfix"></div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
