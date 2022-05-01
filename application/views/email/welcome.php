<!DOCTYPE html>
			<html>
			<head>
			<meta charset='utf-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<title>Welcome to Primestar Sport Academy</title>
			<!-- Tell the browser to be responsive to screen width -->
			<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
			<link rel='icon' type='image/jpg' href='".base_url()."images/favicon.jpg' />
			<script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
			<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
			<style type='text/css'>
			.main_container {
			width: 500px;
			margin: 0 auto;
			}
			@media screen and (max-width: 768px) {
			.main_container {
			width: auto;
			}
			}
			</style>
			</head>
			<body style='padding:20px; margin:0; background:rgba(0, 0, 0, 0.1); font-family:Tahoma, Arial, Helvetica, sans-serif;'>
			<div class='main_container' style='background:#FFF; border:1px solid rgba(0, 0, 0, 0.2);  border-bottom:5px solid rgba(0, 0, 0, 0.15); padding:1px;'> 
			<!-- HEADER STARTS -->
			<div style='background:#ba272d; color:white; padding:10px; text-align:center; margin-bottom:20px; font-size:16px; font-weight:600; '> Welcome to Prime Star Sports Services
			<div style='clear:both;'></div>
			</div>
			<div style='clear:both;'></div>
			<!-- NAVIGATION ENDS --> 
			<!-- HEADER ENDS --> 
			<!-- MAIN CONTENT STARTS -->
			<section class='main_container'>						
			<p style='padding:0px 30px 20px 30px; margin:0px; line-height:30px; text-align:left; font-size:13px; color:#666;'>
			Dear <strong><?php echo $username;?></strong>,<br/>
			Your Registration is approved Successfully.<br/>
			</p>
			<p style='padding:0px 30px 20px 30px; margin:0px; line-height:30px; text-align:left; font-size:13px; color:#666;'>
			<a href="<?php echo base_url().'Mail?email='.$email_id ;?>">Click here</a> to Set Password</p><br/>
<p style='padding:0px 30px 20px 30px; margin:0px; line-height:30px; text-align:left; font-size:13px; color:#666;'>Thanks & Regards<br/>PSSS Admin team</p>
			<div style='clear:both;'></div>
			</section>
			<!-- MAIN CONTENT ENDS -->
			<div style='clear:both;'></div>
			</div>
			</body>
			</html>