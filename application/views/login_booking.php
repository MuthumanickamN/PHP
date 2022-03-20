<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Primestar - Admin Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/jpg" href="images/favicon.jpg" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/style.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-logo">
            <img src="<?php echo base_url(); ?>assets_booking/images/logo.jpg" alt="" />
        </div>
		
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
			 <div id="show1">
                <form method="post" name="login" id="login" action="<?php echo $form_action; ?>">
                   
					<?php if($this->session->flashdata('message')){ ?><p class="alert alert-success"><i class="fa fa-check-square" aria-hidden="true"></i>  <?php echo $this->session->flashdata('message'); ?></p><?php } ?>
					
					<?php if($this->session->flashdata('error_message')){ ?><p class="alert alert-success"><i class="fa fa-check-square" aria-hidden="true"></i>  <?php echo $this->session->flashdata('error_message'); ?></p><?php } ?>
                        <p class="login-box-msg">Admin Login</p>
                        <div class="form-group has-feedback">
                            <input id="email" name="email"  class="form-control" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" id="login_btn" name="login_btn" class="btn btn-default btn-flat">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="text-right"><a href="#" id="for_pass">Forgot Password?</a></div>
                    
					</form>
					</div>
					
                    <div id="show2" style="display: none;">
					<form name="forgot_password" id="forgot_password" action="<?php echo base_url(); ?>reset_password/check_email_address" method="POST" class="form-horizontal" role="form" autocomplete="off">
					 <?php if($this->session->flashdata('message')){ ?><p class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $this->session->flashdata('message'); ?></p><?php } ?> 
                        <p class="login-box-msg">Forgot Password</p>
                        <div class="form-group has-feedback">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Valid Email ID">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" name="submit" id="submit" class="btn btn-default btn-flat">Submit</button>
                            </div>
                            <!-- /.col -->
							<div class="col-sm-8 text-right"><button type="button" class="btn btn-primary btn-xs" id="back1"><span class="glyphicon glyphicon-user"></span> &nbsp; Back To Login</button></div>
                        </div>
						
						</form>
                    </div>
					
                
                <div class="clearfix"></div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	   
	   
        <!-- Fontawsone (necessary for Fontawsone Icons) -->
        <script src="https://use.fontawesome.com/58287d3ef3.js"></script>
        <!-- Latest compiled and minified JavaScript -->
       <script src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap.min.js"></script>
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
		
		<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/1.10.0_jquery.validate.min.js"></script> 
		<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/jquery-validate.bootstrap-tooltip.js"></script>


       
	
    <script>
var base_url = "<?php echo base_url(); ?>";
$(document).ready(function(){
	
	$("#back1").click(function () {
        $("#show1").show("slow");
        $("#show2").hide("slow");
    });
	
	$("#for_pass").click(function () {
        $("#show2").show("slow");
        $("#show1").hide("slow");
        });
    $('[data-toggle="tooltip"]').tooltip();  
	
	
	$('#login_btn').on('click', function(){
	     
		  $("form[name='login']").validate({
        // Specify validation rules
       rules: {
            email: {
                required: true,
				email:true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter the email address!",
				email:"Please enter the valid email address!"
            },
            password: {
                required: "Please enter the password!"
            }
        }
    });
	
	
	if($("#form[name='login']").valid())
	{
		$("form[name='login']").submit();
	}
	
	});
     
   
	$('#submit').on('click', function(){
		
		
	 $("form[name='forgot_password']").validate({
        // Specify validation rules
        rules: {
            email: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter the email address!"
            }                 
        }
    });
	
	
	});
    
});
</script>

</script>

    </body>
</html>