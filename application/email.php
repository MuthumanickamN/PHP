<?php 
 

 $config = new PHPMailer();
$config->SMTPDebug = true;
$config->IsSMTP();  // telling the class to use SMTP
$config->SMTPAuth   = true; // SMTP authentication

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_user'] = 'rrameshkannan8@gmail.com';
$config['smtp_pass'] = '9042625362';
$config['smtp_port'] = 465;
 
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n"; 

