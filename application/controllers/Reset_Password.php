<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Login controller class
*/
class Reset_Password extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        /*$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');*/
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');		
        // Check Login
/* if(!$this->session->userdata('id')){
            redirect('logout');
        } */
        // Load database
        $this->load->model('User_Booking_Model', 'user_model');
    }

    public function index(){
        // Load our view to be displayed
        // to the user
        
    }
    
    public function check_email_address(){
		
		
        $data = array();
        $data['user_email'] = $this->input->post('email');
		
		
        $result = $this->user_model->get_email_users($data);
        if($result != false){
			
            $this->send_mail($result->user_email, $result->user_name, $result->id);
            	
                    
        }else{
			
            $this->session->set_flashdata('message', 'The email address is not in the user list!');
            redirect('login');
        }
        
    }
    
     public function send_mail($email, $name, $id)
    {
	
       // require_once(APPPATH.'third_party/class.phpmailer.php');
        
        $this->load->helper('string');
        $this->load->library('phpmailer');
        require_once(APPPATH.'libraries/class.smtp.php');
        
        $mail =  $this->phpmailer;
        $mail->SMTPDebug = 0;  
        $mail->isSMTP();                           
         $mail->Host = smpt_host;
        $mail->SMTPAuth = false;                              
        $mail->Username = smpt_username;                 
        $mail->Password = smpt_password;                           
        //$mail->SMTPSecure = "tls";                           

        $mail->Port = 25;                                   

        $mail->From = smpt_fromaddress;
        $mail->FromName = smpt_fromname;

        $mail->addAddress($email, $name);

        $mail->isHTML(true);

        $mail->Subject = "Reset Password";

        $mail->AddEmbeddedImage('images/logo.jpg','logo');
		 $mail->AddEmbeddedImage('images/favicon.jpg','favicon');
		  $mail->AddEmbeddedImage('images/tick_icon.jpg','tick_icon');
        $reset_password_link = base_url().'admin/';
        header('Content-type: text/plain');
        $url = base_url();
        require(APPPATH.'libraries/PasswordHash.php');
        //$this->load->library('PasswordHash');	
        define('PHPASS_HASH_STRENGTH', 8);
        define('PHPASS_HASH_PORTABLE', false);
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE); 
        $correct = random_string('alnum',8);
        $hash = $hasher->HashPassword($correct); 
       
		
		$mail->Body = "<!DOCTYPE html>
						<html>
						<head>
						<meta charset='utf-8'>
						<meta http-equiv='X-UA-Compatible' content='IE=edge'>
						<title>Newsletter</title>
						<!-- Tell the browser to be responsive to screen width -->
						<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
						<link rel='icon' type='image/jpg' href='".base_url()."images/favicon.jpg' />
						<script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
                        <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
						<style type='text/css'>
						.main_container {
						width: 768px;
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
						<div class='main_container' style='background:#FFF; border:1px solid rgba(0, 0, 0, 0.2); padding:1px;'> 
						<!-- HEADER STARTS -->
						<div style='background:#ba272d; padding:10px; text-align:center; margin-bottom:20px;'> <img src='".base_url()."images/logo.jpg' alt='' />
						<div style='clear:both;'></div>
						</div>
						<div style='clear:both;'></div>
						<!-- NAVIGATION ENDS --> 
						<!-- HEADER ENDS --> 
						<!-- MAIN CONTENT STARTS -->
						<section class='main_container'>            
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> Your password has been successfully changed!</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>This email confirms that your password has been changed.</p>
						<p style='padding:0px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>User Name :</strong>".$email."<br/>
						<strong>Password :</strong>".$correct."</p>  
<p style='padding:0px 30px 20px 30px; text-align:left; font-size:13px; line-height:20px; color:#666;'><a href='".ADMIN_PATH."' style='color:#76b130;'>Log in</a> or go back to the homepage</p>						
						<div style='clear:both;'></div>
						</section>
						<!-- MAIN CONTENT ENDS -->
						<div style='clear:both;'></div>
						</div>
						</body>
						</html>";
        $mail->AltBody = "This is the plain text version of the email content";
        if(!$mail->send()) 
        {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {           

          $update_data = array(
            'user_password' => $hash,
            'modified_on' => date('Y-m-d H:i:s')
            );

          // $this->user_model->update_user_email($update_data, $id);
		   if($this->user_model->update_user_email($update_data, $id))
		   {
			   $this->session->set_flashdata('message', 'The password has been sent to your registered email address.!');
           redirect('login');
           exit;
		   }
           
        }                
    }
	
}
?>