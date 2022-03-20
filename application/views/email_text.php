<?php require_once('includes/header.php'); ?>

<html>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<body style="background-image: url('<?php echo base_url().'images/swimming2.jpg' ?>');">
<link rel="stylesheet" href="<?php echo base_url().'css/styles.css' ?>"> 
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap.css' ?>">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap.min.css' ?>">
<script src="<?php echo base_url().'assets/modal.js' ?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
<script type="text/javascript">
	function Validation()
	{
		var pass1=document.getElementById('confirm').value;
		var pass2=document.getElementById('reconfirm').value;
		if(pass1!=pass2)
		{
			alert('Password are not same');
			document.getElementById('reconfirm').value="";
			var pass1=document.getElementById('confirm').value="";
			return false;
		}
	}

  
</script>

<div id="loginbox" class="mainbox col-md-5 col-md-offset-3 col-sm-8 col-sm-offset-2" align="center" style="margin-top: 50px" >
       
         <div class="panel panel-info">
       <div style="margin-bottom: 25px; padding: 0px;" class="col-md-12 control text-center">
        <div align="center" style="background-color:#ba272d; color: white; height: 40px; padding: 6px; font-size: 20px"><b>PSA SET PASSWORD</b></div>
        </div>
                
            <?php  echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>'; ?>
            <?php  echo '<label class="text-success">'.$this->session->flashdata("success_msg").'</label>'; ?>
            <div  class="panel-body"> 

             <div class="message col-sm-12"></div>
                

                <form id="loginForm" class="form-horizontal"  role="form" name="form" method="POST" align="center" action="<?php echo base_url().'login/set_password' ?>">                    

                	  <div class="form-group lg">
                        <div class="col-md-5 control text-left"><strong>Confirm Password</strong>*</div>
                        <div class="col-md-7 control text-right">
                       <input id="confirm" type="Password" class="form-control" name="confirm" placeholder="********" required=""  /></div>
                        
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-5 control text-left"><strong>Reconfirm Password</strong>*</div>
                        <div class="col-md-7 control text-left">     
                         <input id="reconfirm" type="Password" class="form-control" name="reconfirm" placeholder="********" required="" /></div>
                         
                    </div>

               <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
               <input type="hidden" id="email_id" name="email_id" value="<?php echo $email; ?>">

                    

                    <div class="form-group lg">
                        <div class="col-md-5 control text-left">
                     
                            
                          

                        </div>

                        <div class="col-md-7 control text-center">

     <input id="loginBtn" type="submit" style ="text-decoration:none;color:white;font-weight: bold; background-color:#000 !important;" name="signin" value="SUBMIT"  class="btn btn1" href="<?php echo base_url('index.php/Login/set_password/'.$user_id); ?>"/>
                             

                        </div>
                    </div>
                  
                
                </form>
            </div>

            </div>
        </div>
</body></html>