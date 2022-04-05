<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Login extends CI_Controller {  
	
	public function __construct()
	{
	    error_reporting(0);
	    //echo 1;die;
	    
	    parent::__construct();
	    
      $this->load->model('Default_Model', 'default');
      $this->load->model('Main_model','main_model');  
    $this->load->model('MPermissions_Model');
    
	}
	public function index()
	{
	    
	    $data['countries'] = $this->default->countries_list();
	    $this->load->view('index', $data);
	}


	
function login_validation(){  
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('username', 'Username', 'required');  
           $this->form_validation->set_rules('password', 'Password', 'required');  
           if($this->form_validation->run())  
           {  
                //true  
                $username = $this->input->post('username');  
                $password = $this->input->post('password');  
                //model function  
          
                if($userdata = $this->main_model->can_login($username, $password))  
                { 
                     $menu_module = $this->MPermissions_Model->get_menu_by_module(strtolower($userdata[0]->role));
                     $session_data = array(  
                          'username'     =>     $username  ,
                          'userid'     =>     $userdata[0]->user_id  ,
                          'id'     =>     $userdata[0]->user_id  ,
                          //'user'        => $userdata,
                          'code'        => $userdata[0]->code,
                          'role'     =>     $userdata[0]->role  ,
                          'name'     =>     $userdata[0]->user_name  ,
                          'country_id'     =>  $userdata[0]->country_id  ,
                          'menu_model' =>$menu_module

                     );  
                     $this->session->set_userdata($session_data);
                     $data['username']=$username;
                     $signincount = $userdata[0]->sign_in_count;
                     $lastsignin = $userdata[0]->current_sign_in_at;
                     $logindata = array(
                      'sign_in_count' => $signincount+1,
                      'current_sign_in_at' => date('Y-m-d H:i:s'),
                      'current_sign_in_ip'=>$_SERVER['REMOTE_ADDR'],
                      'last_sign_in_at'=>$lastsignin,
                    );
                    $this->db->where('user_id', $userdata[0]->user_id);
                    $this->db->update('users', $logindata);
                    
                     redirect(base_url().'dashboard/','$data');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url() . 'login');  
                }  
           }  
             
      }  
public function add_parent()
{
        
		$parent_name=$this->input->post('parent_name');
		$email_id=$this->input->post('email_id');
		$mobile_no=$this->input->post('mobile_no');
		$emirate_id=$this->input->post('emirate_id');
		$parent_country=$this->input->post('parent_country');
    if (empty($parent_name)) {
      $json['error']['parent_name'] = 'Please enter parent name';
    }
    if (empty($email_id)) {
      $json['error']['email_id'] = 'Please enter email id';
    }
    if (empty($mobile_no)) {
      $json['error']['mobile_no'] = 'Please enter Mobile number';
    }
    if (empty($emirate_id)) {
      $json['error']['emirate_id'] = 'Please enter emirateid';
    }
     if (empty($parent_country)) {
      $json['error']['parent_country'] = 'Please Select Country';
    }
    
    if (empty($json['error']) ) {
    		$date_time=date("Y-m-d H:i:s"); 
        $checkMail = $this->default->checkexists('users','email',$email_id);
        if($checkMail == 0){
            
        $wi = 1;    
	    while($wi==1){	
			$sql_c = "Select * from parent order by parent_id desc limit 1";
			$query_c = $this->db->query($sql_c);
			if($query_c->num_rows() > 0)
			{
			    $row4 = $query_c->row()->parent_code;
		        $num_arr=explode("PSA",$row4);
			    $new_num=(int)$num_arr[1];  
			    $new_code_num=str_pad(++$new_num,3,'0',STR_PAD_LEFT);
			    $code='PSA'.$new_code_num;
			}
			else
			{
			     $code='PSA001';
			}
			
			$sql_c2 ="Select * from parent where parent_code ='$code' ";
			if($this->db->query($sql_c2)->num_rows() > 0)
			{
			    $wi = 1;
			}
			else
			{
			    $wi = 0;
			    break;
			}
        }
        $sql1="INSERT into parent(parent_name,parent_code, email_id,mobile_no,emirate_id,date_time,status,country_id) values('".$parent_name."','".$code."','".$email_id."','".$mobile_no."','".$emirate_id."','".$date_time."','Active','".$parent_country."')";
		$insert1=$this->db->query($sql1);
		
        $sql="INSERT into users(user_name,code, email,role,mobile,emirates_id,created_at,status,country_id) values('".$parent_name."','".$code."','".$email_id."','Parent','".$mobile_no."','".$emirate_id."','".$date_time."','Active','".$parent_country."')";
		$insert=$this->db->query($sql);
            
            
        
        /* send mail */
        
        
        $login_url = base_url() .'login';
		$this->load->helper('string');
		$this->load->library('Phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_id);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);
        
		$mail->Subject = "Welcome to Primestar Sports Services";
		$data['username'] = $parent_name;
        $data['email_id'] = $email_id;
        
        $mail->Body = $this->load->view('email/welcome', $data,  TRUE);
		
		
		if(!$mail->send()) 
		{
			
		   $json['status'] ='failure';
		}
		else{
		   $json['status'] ='success';
		}
		$this->session->set_flashdata('success_msg', 'You have signed up successfully. Please check your mail for verification.');
		
          }else{
            $this->session->set_flashdata('error', 'Mail id already exists');
          }
          echo json_encode( $json);
          redirect(base_url() . 'login'); 
    	}else{
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
      }
    

  }


public function set_password(){ 
  $confirm=$this->input->post('confirm');
  $reconfirm=$this->input->post('reconfirm');
  $email_id = $this->input->post('email_id');
  $user_id=$this->input->post('user_id');
  $checkMail = $this->default->checkexists('users','email',$email_id);
  if($checkMail == 1){
    if($confirm == $reconfirm){
		$sql="Update  users set encrypted_password='$confirm' where user_id='$user_id'";
		$insert=$this->db->query($sql);
		$email_data = $this->db->query("SELECT * from users where user_id = ".$user_id."");
															  
		$email_data_array = $email_data->row_array();	
		
      
      $this->send_email($email_data_array);		
      $this->session->set_flashdata('success_msg', 'Password changed successfully. ');
      redirect(base_url().'login');
    }else{
      $this->session->set_flashdata('error', 'Confirm password should be same as password.');
      redirect(base_url().'Mail?email='.$email_id);  
    }
  }else{
      $this->session->set_flashdata('error', 'Mail id not exist. Please register your mail id.');
      redirect(base_url().'login');
  }
}

	public function send_email($email_data_array)
	{
	

		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('Phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		//$mail->addAddress($parent_email_id);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['email']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Login Details";
		
		$mail->Body = "<!DOCTYPE>
					<html>

					<head>
						<title>Login details</title>
						
					</head>
					<body>
						<div class='logo' style='float: left;
						width: 100%;
						text-align: center;
						background: #ba272d;
						height: 100px; 
						margin-bottom: 20px;'>
							<img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
						</div>
						<div class='header' style='float: left;
						width: 100%;
						text-align: center;
						font-size: 21px;'>
							<h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h2>
						</div>
						<div class='main' style='font-family: sans-serif;'>
							<p style='line-height: 60px;'>Dear <b>".$email_data_array['user_name'].",</b></p>
							<p>Your Registration is successful..</p>
							<P>Please use the below credentials for your next login.</P>
							<p>User-id: ".$email_data_array['email']."</p>
							<p>Password:<b>".$email_data_array['encrypted_password']."</b></p>
							<p>Note:For recharging your wallet account, please contact admin team</p>
							<p><a href='http://sports.primestaruae.com/'>Click here </a>to login</p>
							<h4>Thanks & Regards</h4>
							<h4 style='color: grey'>PSSS Admin team</h4>
							<hr>
							<p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
						</div>";
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
		    //echo 'sent';die;
			return true;
		}
		
	}
	

  public function logout(){  
    $userid = $this->session->userid;
        $logindata = array(
          'last_sign_in_at' => date('Y-m-d H:i:s'),
          'last_sign_in_ip'=>$_SERVER['REMOTE_ADDR']
        );
        $this->db->where('user_id', $userid);
        $this->db->update('users', $logindata);
       $this->session->unset_userdata('username');  
       redirect(base_url() . 'login');  
  }  
/*function _404(){
  if($this->session->userdata['username']!=''){
    $this->session->set_flashdata('error', 'Page not found.');
    redirect('dashboard');
  }else{
    $this->session->set_flashdata('error', 'You need to sign in or sign up before continuing.');
    redirect(base_url() . 'login');  
  }
}*/


		
}  
