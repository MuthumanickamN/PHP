<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Dashboard controller class
*/
class Profile extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
if(!$this->session->userdata('id')){
            redirect('logout');
        }
        $this->load->model('User_Booking_Model', 'user_model');
    }

	
    public function index(){
        // Load our view to be displayed
        // to the user

       /*  $data = array();
        $data['title'] = 'Dashboard';
        $data['user_name'] = $this->session->userdata('username');

        $this->load->view('header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer', $data); */
    }
    
    public function edit_profile(){
		
		$user_id=$this->session->userdata('id');
		
		$data = $this->user_model->get_user_details($user_id);
		
		
		
		$this->load->view('templates/header');
        $this->load->view('edit_profile',$data);
        $this->load->view('templates/footer');
		
    }
    
	 public function update_email(){
		
		 $email_hid = $this->input->post('email_hid');
		  $emailid = $this->input->post('emailid');
		  $user_name = $this->input->post('user_hid_name');
		  
		  
		  $this->send_mail($emailid, $user_name, $email_hid);
		 
		/*  $update_data = array(
		                'user_email' => $this->input->post('emailid')
					);
		
		 
		 if($this->user_model->update_user_email($update_data,$email_hid))
				{	
					$this->session->set_flashdata('success_message', 'User Email Updated successfully!');
					redirect('profile/edit_profile');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not Updated Properly!');
					redirect('profile/edit_profile');
				} */
		
		 
    }
    public function update_password(){
		header('Content-type: text/plain');
        require(APPPATH.'libraries/PasswordHash.php');
        //$this->load->library('PasswordHash');	
        define('PHPASS_HASH_STRENGTH', 8);
        define('PHPASS_HASH_PORTABLE', false);
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $hash_password = $hasher->HashPassword($this->input->post('newpassword'));
		
		 $password_hid = $this->input->post('pass_hid');
		 
		 $username = $this->input->post('username');
		  $newpassword = $this->input->post('newpassword');
		   $emailid = $this->input->post('email_hid_address_password');
		  
		  
		  $this->send_mail_password($emailid, $username, $password_hid ,$newpassword ,$hash_password);
		 
		 
		
		 
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

        $mail->Subject = "Updated Email Address";

        $mail->AddEmbeddedImage('images/logo.jpg','logo');
		 $mail->AddEmbeddedImage('images/favicon.jpg','favicon');
		  $mail->AddEmbeddedImage('images/tick_icon.jpg','tick_icon');
       
        
       
		
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
<p style='padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); '>Welcome to <strong style='color:#ba272d; font-weight:300;'>Prime Star Sports Academy</strong></p>						
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> Your email has been successfully changed!</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>This email confirms that your user email address has been changed.</p>
						<p style='padding:0px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>Your new user name :</strong>".$email."<br/>
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
		                'user_email' => $this->input->post('emailid')
					);

          // $this->user_model->update_user_email($update_data, $id);
		   if($this->user_model->update_user_email($update_data, $id))
		   {
			   $this->session->set_flashdata('success_message', 'User Email Updated successfully!');
			   redirect('profile/edit_profile');
           exit;
		   }
		   else{
					$this->session->set_flashdata('error_message', 'Data are not Updated Properly!');
					redirect('profile/edit_profile');
				}
           
        }                
    }
	
	//send_mail($emailid, $username, $password_hid ,$newpassword)
	
	public function send_mail_password($emailid, $username, $password_hid ,$newpassword ,$hash_password)
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

        $mail->addAddress($emailid, $username);

        $mail->isHTML(true);

        $mail->Subject = "Updated password";

        $mail->AddEmbeddedImage('images/logo.jpg','logo');
		 $mail->AddEmbeddedImage('images/favicon.jpg','favicon');
		  $mail->AddEmbeddedImage('images/tick_icon.jpg','tick_icon');
       
        
       
		
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
<p style='padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); '>Welcome to <strong style='color:#ba272d; font-weight:300;'>Prime Star Sports Academy</strong></p>						
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> Your password has been successfully changed!</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>This email confirms that your password has been changed.</p>
						<p style='padding:0px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>Your user name :</strong>".$emailid."<br/>
						<strong>Password :</strong>".$newpassword."</p>  
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
		                'user_password' => $hash_password
					);
		
		 
		 if($this->user_model->update_user_password($update_data,$password_hid))
				{	
					$this->session->set_flashdata('success_message', 'User Password Updated successfully!');
					redirect('profile/edit_profile');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not Updated Properly!');
					redirect('profile/edit_profile');
				}
           
        }                
    }
	
}
/* class dd extends Profile{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');

       
    }

	
    public function index(){
      
}
} */
?>