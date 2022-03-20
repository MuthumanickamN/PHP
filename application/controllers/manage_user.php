<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_user extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
if(!$this->session->userdata('id')){
            redirect('logout');
        }
		 $this->load->library('form_validation');
		 
		 $this->load->model('manage_user_model');
		 $this->load->model('sports_model');
		 
       
    }

	
    public function index(){
		$data = array();
		$data['sports_list'] = $this->sports_model->get_sports_list();
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('users',$data);
        //$this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	public function get_user_details(){
        $id = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $get_details = $this->manage_user_model->get_user_details($id);
        echo json_encode($get_details);
    }
	
	public function delete_user(){
		
		$id = $this->input->post('id');
	
		$get_details = $this->manage_user_model->delete_user($id);
	}
	
	public function get_user_list(){
        $data = array();
        $get_details = $this->manage_user_model->get_user_list();
        $output ='';
        if($get_details){
                foreach($get_details as $key => $get_list)
                {
					if($get_list['dob'] == "0000-00-00")
					{
					$newDate = "--";
					}
					else{
					$newDate = date("d-m-Y", strtotime($get_list['dob']));
					}
                    
					
                        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
                        $output .= "<td>". $get_list['name'] ."</td>";
						 $output .= "<td>". $get_list['mobile'] ."</td>";
						  $output .= "<td>". $get_list['email'] ."</td>";
						   $output .= "<td>". $newDate ."</td>";
						   
						   $output .= "<td><a href='#' title='View' class='btn btn-primary btn-xs view' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#viewModal'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";
						   $output .= "<td><a href='#' title='Edit' class='btn btn-warning btn-xs edit' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o' aria-hidden='strue'></i></a></td>";
						
						
                       $output .= "<td><button type='submit' title='Remove' data-id='". $get_list['id'] ."' class='btn btn-danger btn-xs delete_user'><i class='glyphicon glyphicon-trash'></i></button></td>";
					   
					   $output .= "<td><a href='#' title='Edit' class='btn btn-warning btn-xs password_change' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#passwordModal'><i class='fa fa-key' aria-hidden='true'></i></a></td>";
                       
                        
                        $output .= "</tr>";
                }
        }
        /* else{
            
                $output .= "<tr><td colspan='8' align='center'>No Record Found!</td></tr>";
            
        } */
        echo $output;
	}
	
	
	// for-view-page
	public function get_user_list_view(){
		$id = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $data = array();
        $get_details = $this->manage_user_model->get_user_list_view($id);
        $output ='';
		$output1 ='';
		//$sports_name = $this->sports_model->get_sports_details_userview($get_details['sports']);
		$i=1;
		/* if($sports_name){
			
			foreach($sports_name as $row) {
			$output1 .= $row['sportsname'];
			
			if(count($sports_name) !== $i )
			{
				$output1 .= ',';
			}
			$i++;
			
		  }
		}
		else{
			$output1 ='--';
		} */
		

		
        if($get_details){
			if($get_details['dob'] == "0000-00-00")
			{
				$dob = "--";
			}
			else{
				$dob = date("d-m-Y", strtotime($get_details['dob']));
			}
			$expiry_date = date("d-m-Y", strtotime($get_details['id_expiry_date']));
			
			$user_imag_pth = base_url()."uploads/user_images/".$get_details['user_image'];
			$user_id_imag_pth = base_url()."uploads/user_images/".$get_details['user_id_image'];
			//echo $user_imag_pth ;exit;
                
					$output .= "<tr><td width='40%'>";
								
								
								
		 $output .= "<div class='col-sm-12 col-md-6'>
            <p class='form_text1'>User Profile Image</p>
            <img name='upload_image2'  id='upload_image2' class='img-responsive' src='".$user_imag_pth."' width='200' height='200'>
          
        </div></td>";
		
		
		$output .= "<td>
		<style type='text/css'>
		.simpleLens-lens-element {
    height:350px;
    left: 105%;
    width:350px;
}
		</style>
		<div class='col-sm-12 col-md-6'>
            <p class='form_text1'>User Emirates ID</p>
            <div id='upload_id_image'>
			
			
			<div class='simpleLens-gallery-container' id='demo-2' style='width:200px; height:200px;'>
        <div class='simpleLens-container'>
            <div class='simpleLens-big-image-container' style='width:200px; height:200px;'>
	<a class='simpleLens-lens-image' data-lens-image='".$user_id_imag_pth."' style='width:200px; height:200px;'>
	<img name='upload_id_image2' id='upload_id_image2' class='img-responsive simpleLens-big-image' src='".$user_id_imag_pth."'  width='200' height='200'>
	</a>
	</div></div></div>
		 </div> </div>";
		
		$output .= "</td></tr>";
		
					
					
					
					
				$output .= "<tr><td><strong>Name :</strong></td>
				<td>".$get_details['name']."</td>
			</tr>
			<tr>
				<td><strong>Mobile :</strong></td>
				<td>".$get_details['mobile']."</td>
			</tr>
			<tr>
				<td><strong>Email :</strong> </td>
				<td>".$get_details['email']."</td>
			</tr>
			<tr>
				<td><strong>Date of Birth :</strong> </td>
				<td>".$dob."</td>
			</tr>
			<tr>
				<td><strong>Gender :</strong></td>
				<td>".$get_details['gender']."</td>
			</tr>
			<tr>
				<td><strong>Emirates ID Expiry Date :</strong></td>
				<td>".$expiry_date."</td>
			</tr>";

               
        }
        else{
            
                $output .= "<tr><td colspan='8' align='center'>No Record Found!</td></tr>";
		}
        
        echo $output;
	}
	//
	
	 public function check_mobile_exist(){
        $data = array();
        $data['mobile_number'] = $this->input->post('mobile_number');
		$data['user_hidden_id'] = $this->input->post('user_hidden_id');
		
        $get_details = $this->manage_user_model->check_mobile_exist($data);
        //header("Content-type: application/json");		
        echo json_encode($get_details);
        //echo $this->db->last_query();
		
    }
	
	 public function check_email_exist(){
        $data = array();
        $data['user_email'] = $this->input->post('user_email');
		$data['user_hidden_id'] = $this->input->post('user_hidden_id');
		
        $get_details = $this->manage_user_model->check_email_exist($data);
        //header("Content-type: application/json");		
        echo json_encode($get_details);
        //echo $this->db->last_query();
		
    }
	
	public function change_user_password(){
		
		$id = $this->input->post('user_password_hidden_id');
		$email = $this->input->post('user_password_hidden_email');
			$name = $this->input->post('user_password_hidden_name');
			$user_pass = $this->input->post('user_password');
			$status = "change_password";
			$password = $this->send_password($email, $name, $user_pass,$status);
			
			$update_data = array(
				'password' => $password
			);
			
		if($this->manage_user_model->update_user_details($update_data,$id))
            {			
                $this->session->set_flashdata('success_message', 'User Password changed successfully!');
                redirect('manage_user');
            }else{
				
                $this->session->set_flashdata('success_message', 'User Password is not changed!');
                redirect('manage_user');
            }
		
		
		
	}
	
	
	public function add_user(){
			
	
	if(!empty($_FILES['user_image']['name'])){
               
               
	    $config['upload_path'] = "uploads/user_images/";
        $config['upload_url'] = base_url() . "uploads/user_images/";
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['overwrite'] = TRUE;
        
        $config['encrypt_name'] = TRUE;
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('user_image')){
					
					//resize
		$config_resize['source_image'] = $this->upload->upload_path.$this->upload->file_name;
		$config_resize['maintain_ratio'] = FALSE;
		$config_resize['width'] = 400;
		$config_resize['height'] = 413;
		$this->load->library('image_lib', $config_resize);
		 $this->image_lib->initialize($config_resize);
		$this->image_lib->resize();
		//-resize
					
					
                    $uploadData = $this->upload->data();
                    $user_picture = $uploadData['file_name'];
					
                }else{
                    $user_picture = 'upload failed'.$_FILES['user_image']['name'];
                }
            }else{
                
				if($this->input->post('user_hid_image') != ''){
				          $user_picture = $this->input->post('user_hid_image');
				}
				else{
					$user_picture = '';
				}
				
            }
		//$picture = '';
		
		if(!empty($_FILES['user_id_image']['name'])){
               
               
	    $config['upload_path'] = "uploads/user_images/";
        $config['upload_url'] = base_url() . "uploads/user_images/";
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['overwrite'] = TRUE;
        
        $config['encrypt_name'] = TRUE;
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('user_id_image')){
					
					//resize
		$config_resize['source_image'] = $this->upload->upload_path.$this->upload->file_name;
		$config_resize['maintain_ratio'] = FALSE;
		$config_resize['width'] = 400;
		$config_resize['height'] = 413;
		$this->load->library('image_lib', $config_resize);
		 $this->image_lib->initialize($config_resize);
		$this->image_lib->resize();
		//-resize
					
                    $uploadData = $this->upload->data();
                    $user_id_picture = $uploadData['file_name'];
					
                }else{
                    $user_id_picture = 'upload failed'.$_FILES['user_id_image']['name'];
                }
            }else{
                
				if($this->input->post('user_hid_image') != ''){
				          $user_id_picture = $this->input->post('user_id_hid_image');
				}
				else{
					$user_id_picture = '';
				}
				
            }
		
		
			if($this->input->post('user_hidden_id') == ''){
	
           
			$passw = $this->input->post('Password');
			
			$email = $this->input->post('user_email');
			$name = $this->input->post('user_name');
			$id = '';
			$status = "new_user";
			$password = $this->send_password($email, $name, $passw, $status);
			
			 $insert_data = array(
			    'user_image' => $user_picture,
                'name' => $this->input->post('user_name'),
                'mobile' => $this->input->post('user_mobile'),
                'email' => $this->input->post('user_email'),
                'dob' => change_date_format($this->input->post('datepicker')),
				'id_expiry_date' => change_date_format($this->input->post('datepicker1')),
				'gender' => $this->input->post('gender'),
				'user_id_image' => $user_id_picture,
				'password' => $password
			);
			//print_r($insert_data);exit;
			$insert_id = $this->manage_user_model->add_user_details($insert_data);
			
			
			
			
			
			if($this->manage_user_model->add_wallet_details($insert_id))
            {	
                $this->session->set_flashdata('success_message', 'User Details added successfully!');
                redirect('manage_user');
            }else{
                $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
                redirect('manage_user');
            } 
			
			
			
				
        }
        else{
			$id = $this->input->post('user_hidden_id');
			$hidden_email = $this->input->post('user_email_hidden');
			if($hidden_email != $this->input->post('user_email'))
			{
				$this->send_email($this->input->post('user_email'), $this->input->post('user_name'));
			}
			
            $update_data = array(
			    'user_image' => $user_picture,
                'name' => $this->input->post('user_name'),
                'mobile' => $this->input->post('user_mobile'),
                'email' => $this->input->post('user_email'),
                'dob' => change_date_format($this->input->post('datepicker')),
				'id_expiry_date' => change_date_format($this->input->post('datepicker1')),
				'gender' => $this->input->post('gender'),
				'user_id_image' => $user_id_picture
							
            );
			//print_r($update_data);exit;

            if($this->manage_user_model->update_user_details($update_data,$this->input->post('user_hidden_id')))
            {			
                $this->session->set_flashdata('success_message', 'User Details Updated successfully!');
                redirect('manage_user');
            }else{
				
                $this->session->set_flashdata('success_message', 'Data are not updated!');
                redirect('manage_user');
            }

        }
		
		
 }
    
   
    public function send_password($email, $name, $passw, $status)
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
			if($status == "change_password")
			{
			   $mail->Subject = "Updated Password";
			}
			else if($status == "new_user")
			{
			   $mail->Subject = "User Password";
			}
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


	//$correct = random_string('alnum',8);
	
	$correct = ($passw!='') ? $passw : '';

	//$correct = "";

        
        $hash = $hasher->HashPassword($correct); 
		
		if($status == "new_user")
		{

		$mail->Body = "<!DOCTYPE html>
						<html>
						<head>
						<meta charset='utf-8'>
						<meta http-equiv='X-UA-Compatible' content='IE=edge'>
						<title>Newsletter</title>
						<!-- Tell the browser to be responsive to screen width -->
						<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
						<link rel='icon' type='image/jpg' href='".base_url()."images/favicon.jpg />
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
						<p style='padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); '>Welcome to <strong style='color:#ba272d; font-weight:300;'>Prime Star Sport Academy</strong></p>
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> You have been Successfully Registered.</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>Your account is now active!</p>
						<p style='padding:10px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>User Name :</strong> ".$email."<br/>
						<strong>Password :</strong>".$correct."</p>
						<p style='padding:0px 30px 20px 30px; text-align:left; font-size:13px; line-height:20px; color:#666;'><a href='".USER_PATH."' style='color:#76b130;'>Log in</a> or go back to the homepage</p>
						<div style='clear:both;'></div>
						</section>
						<!-- MAIN CONTENT ENDS -->
						<div style='clear:both;'></div>
						</div>
						</body>
						</html>";
		}
		else if($status == "change_password")
		{
       
		
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
						<div style='background:#ee1d23; padding:10px; text-align:center; margin-bottom:20px;'> <img src='".base_url()."images/logo.jpg' alt='' />
						<div style='clear:both;'></div>
						</div>
						<div style='clear:both;'></div>
						<!-- NAVIGATION ENDS --> 
						<!-- HEADER ENDS --> 
						<!-- MAIN CONTENT STARTS -->
						<section class='main_container'>  
<p style='padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); '>Welcome to <strong style='color:#ee1d23; font-weight:300;'>Prime Star Sport Academy</strong></p>						
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> Your password has been successfully changed!</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>This email confirms that your password has been changed.</p>
						<p style='padding:0px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>User Name :</strong>".$email."<br/>
						<strong>Password :</strong>".$correct."</p>  
<p style='padding:0px 30px 20px 30px; text-align:left; font-size:13px; line-height:20px; color:#666;'><a href='".USER_PATH."' style='color:#76b130;'>Log in</a> or go back to the homepage</p>						
						<div style='clear:both;'></div>
						</section>
						<!-- MAIN CONTENT ENDS -->
						<div style='clear:both;'></div>
						</div>
						</body>
						</html>";
		}
        $mail->AltBody = "This is the plain text version of the email content";
		//$hash ="";
        if(!$mail->send()) 
        {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {           
          return $hash;
        }                
    }
	
	
	 public function send_email($email, $name)
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

        $mail->Subject = "Updated email";

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


$correct = $email;
        
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
						<div style='background:#ee1d23; padding:10px; text-align:center; margin-bottom:20px;'> <img src='".base_url()."images/logo.jpg' alt='' />
						<div style='clear:both;'></div>
						</div>
						<div style='clear:both;'></div>
						<!-- NAVIGATION ENDS --> 
						<!-- HEADER ENDS --> 
						<!-- MAIN CONTENT STARTS -->
						<section class='main_container'>
<p style='padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); '>Welcome to <strong style='color:#ee1d23; font-weight:300;'>Primestar Sport Academy</strong></p>						
						<p style='padding:20px 30px; margin:0px; text-align:left; font-size:20px; line-height:28px; color:#000;'><img src='".base_url()."images/tick_icon.png' alt='' style='margin-right:15px; float:left;' /> Your email has been successfully changed!</p>
						<p style='padding:10px 30px; margin:0px; text-align:left; font-size:18px; line-height:20px; color:#333;'>This email confirms that your email has been changed.</p>
						<p style='padding:0px 30px 20px 30px; margin:0px; text-align:left; font-size:13px; line-height:20px; color:#666;'><strong>Your new email is :</strong>".$correct."<br/></p>           
						<div style='clear:both;'></div>
						</section>
						<!-- MAIN CONTENT ENDS -->
						<div style='clear:both;'></div>
						</div>
						</body>
						</html>";
        $mail->AltBody = "This is the plain text version of the email content";
		//$hash ="";
        if(!$mail->send()) 
        {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {           

         //return $hash;
           
        }                
    }
   
	
}

?>