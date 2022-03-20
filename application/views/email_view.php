<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<style type="text/css">
body{
background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
}
.contact-form{
background: #fff;
margin-top: 10%;
margin-bottom: 5%;
width: 70%;
}
.contact-form .form-control{
border-radius:1rem;
}
.contact-image{
text-align: center;
}
.contact-image img{
border-radius: 6rem;
width: 11%;
margin-top: -3%;
transform: rotate(29deg);
}
.contact-form form{
padding: 14%;
}
.contact-form form .row{
margin-bottom: -7%;
}
.contact-form h3{
margin-bottom: 8%;
margin-top: -10%;
text-align: center;
color: #0062cc;
}
.contact-form .btnContact {
width: 50%;
border: none;
border-radius: 1rem;
padding: 1.5%;
background: #dc3545;
font-weight: 600;
color: #fff;
cursor: pointer;
}
.btnContactSubmit
{
width: 50%;
border-radius: 1rem;
padding: 1.5%;
color: #fff;
background-color: #0062cc;
border: none;
cursor: pointer;
}
.error{
color:red;
}
</style>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<div class="container contact-form">
<div class="contact-image">
<img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
</div>
<form name="form" action="<?php echo site_url('index.php/Email/send_mail/'); ?>">
<div class="alert alert-success d-none" id="msg_div">
<span id="res_message"></span>
</div><br>
<h3>Drop Us a Message</h3>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<input type="text" name="name" class="form-control" placeholder="Your Name " value="" />
</div>
<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="Your Email" value="" />
</div>
<div class="form-group">
<input type="text" name="mobile_number" class="form-control" placeholder="Your Phone Number" maxlength="10" value="" />
</div>
<div class="form-group">
<input type="submit" name="submit"  value="Send Message" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
</div>
</div>
</div>
</form>
</div>
</body>
</html>