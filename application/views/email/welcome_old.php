<html> 
<head> 
<title>Welcome to Primestar Sport Academy</title> 
</head> 
<body> 
<header id="login-header" style="background-color: #ba272d; height: 80px; text-align: center;">
<div align="center" style="padding: 10px">
<img src="http://app.primestaruae.com:3001/assets/PSA_logo.jpg">
</div></header>
<h1 style="color: red; text-align:center">Welcome to Prime Star Sport Academy LLC</h1>
<h2>Dear <?php echo $username;?>,</h2><br/>
<p style="text-color:black"> Your  Registration is approved Successfully.
<a href="<?php echo base_url().'index.php/Mail?email='.$email_id ;?>">Click here</a> to Set Password</p><br/>
<p>Thanks & Regards<br/>PSA Admin team</p>
<br/>
<br/>
Click here to visit our website:<a href="<?php echo base_url();?>"><?php echo base_url();?></a>   </body> 
</html>