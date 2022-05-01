<!DOCTYPE html> 
<html lang = "en"> 

   <head> 
      <meta charset = "utf-8"> 
      <title>CodeIgniter Email Example</title> 
   </head>
	
   <body> 
      <?php 
         
         echo form_open('/index.php/Email_controller/send_mail'); 
      ?> 
		
      <input type = "email" name = "email" required /> 
      <input type = "submit" value = "SEND MAIL" href="<?php echo base_url().'index.php/Email_controller/send_mail' ?>"> 
		
      <?php 
         echo form_close(); 
      ?> 
   </body>
	
</html>