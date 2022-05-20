<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Admin extends CI_Controller {  
      
    
	public function __construct(){
		parent::__construct();
		$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
		
	}
	public function index()
	{
	    if(!$this->session->userdata('userid'))
	    {
	        redirect('login/logout');
	    }
	    $data['role'] = strtolower($this->session->userdata('role'));
	    $data['country_id'] = $this->session->userdata('country_id');
		$data['title'] ="Admin Registration";
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['admin_id'] = '';
		$data['add_from'] = isset($_GET['add'])?$_GET['add']:'';
		if($data['add_from'] == 'superadmin' && $data['role'] !='superadmin')
		{
		    echo 'Sorry, only SuperAdmin can add Superadmin user.';die;
		}
		
	/*	$email_data = $this->db->query("SELECT * FROM users where user_id = '$user_id'");
		$email_data_array = $email_data->row_array();
		$this->send_email($email_data_array); */
		$this->load->view('admin_registration', $data);
	}
	
	public function list_(){
    	$data['title'] ="Admin List";
    	$query = $this->db->query("select u.*, a.admin_id from users u 
    	left join admin a on a.code = u.code
    	where u.role='admin' and u.deleted !=1 ");
    	$data['adminList'] = $query->result_array();
    	//print_r($data);die;
    	$data['from'] = "admin";
    	$this->load->view('admin_list',$data);
	}
	
	public function superadmin_list(){
    	$data['title'] ="Admin List";
    	$data['from'] = "superadmin";
    	$query = $this->db->query("select u.*, a.admin_id from users u 
    	left join admin a on a.code = u.code
    	where u.role='superadmin' and u.deleted !=1 ");
    	$data['adminList'] = $query->result_array();
    	//print_r($data);die;
    	
    	$this->load->view('admin_list',$data);
	}

	public function add(){
		$data['title'] = 'Admin Registration';
		$admin_id = $this->input->post('admin_id');
		$admin_name=$this->input->post('admin_name');
		$encrypted_password=$this->input->post('encrypted_password');
		$location_id=$this->input->post('location_id');
		$role=$this->input->post('role');
		$dob=$this->input->post('dob');
		$age=$this->input->post('age');
		$gender=$this->input->post('gender');
		$address=$this->input->post('address');
		$address1=$this->input->post('address1');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$country=$this->input->post('country');
		$postal_code=$this->input->post('postal_code');
		$phone1=$this->input->post('phone1');
		$phone2=$this->input->post('phone2');
		$email_id=$this->input->post('email_id');
		$emirates_id=$this->input->post('emirates_id');
		$expiry_date=$this->input->post('expiry_date');
		$status=$this->input->post('status');

		$email=$this->session->userdata('username');
		$this->db->where('email', $email);  
		$query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_id=$postData1['user_id'];

		if (empty($admin_name)) {
            $json['error']['admin_name'] = 'Please enter name';
        }
        
		//if (empty($encrypted_password)) {
        //   $json['error']['encrypted_password'] = 'Please enter password';
        //}

        if ($location_id == '') {
            $json['error']['location_id'] = 'Please select location';
        }
        
        if (empty($role)) {
            $json['error']['role'] = 'Please enter role';
        }
        if (empty($dob)) {
            $json['error']['dob'] = 'Please enter date of birth';
        }
        if (empty($gender)) {
            $json['error']['gender'] = 'Please enter gender';
        }
        if (empty($phone1)) {
            $json['error']['phone1'] = 'Please enter phone number';
        }
        if (empty($phone2)) {
            $json['error']['phone2'] = 'Please enter phone number';
        }
        if (empty($email_id)) {
            $json['error']['email_id'] = 'Please enter email id';
        }
		if (empty($json['error']) ) {
		    
			$filepath="Admin_images";
			$insert_id=$user_id;
			
			$passport_size_image = isset($_FILES['passport_size_image'])&& $_FILES['passport_size_image']['name'] != ''?$this->file_upload($_FILES['passport_size_image'],$filepath,$insert_id):'';
			$passport_image = isset($_FILES['passport_image'])&& $_FILES['passport_image']['name'] != ''?$this->file_upload($_FILES['passport_image'],$filepath,$insert_id):'';
			$visa_image = isset($_FILES['visa_image']) && $_FILES['visa_image']['name'] != '' ?$this->file_upload($_FILES['visa_image'],$filepath,$insert_id):'';
			$emirates_id_image = isset($_FILES['emirates_id_image'])  && $_FILES['emirates_id_image']['name'] != '' ?$this->file_upload($_FILES['emirates_id_image'],$filepath,$insert_id):'';
			$experience_certificate = isset($_FILES['experience_certificate']) && $_FILES['experience_certificate']['name'] != '' ?$this->file_upload($_FILES['experience_certificate'],$filepath,$insert_id):'';
			$police_verification_image = isset($_FILES['police_verification_image']) && $_FILES['police_verification_image']['name'] != '' ?$this->file_upload($_FILES['police_verification_image'],$filepath,$insert_id):'';
			$municipality_certificate_image = isset($_FILES['municipality_certificate_image']) && $_FILES['municipality_certificate_image']['name'] != '' ?$this->file_upload($_FILES['municipality_certificate_image'],$filepath,$insert_id):'';
			
			
			
			$created_at=currentDateTime();
			
			if($admin_id !=''){
				//echo "<br>sdfsdfsdfsdfsdfsdf";
				$getdata = $this->db->query('select * from admin where admin_id='.$admin_id);
				$coachDetail = $getdata->row_array();
				$admin_code = $coachDetail['code'];
				$passport_size_image = ($passport_size_image !='')?$passport_size_image:$coachDetail['passport_size_image'];
				$passport_image = ($passport_image !='')?$passport_image:$coachDetail['passport_image'];
				$visa_image = ($visa_image !='')?$visa_image:$coachDetail['visa_image'];
				$emirates_id_image = ($emirates_id_image !='')?$emirates_id_image:$coachDetail['emirates_id_image'];
				$experience_certificate = ($experience_certificate !='')?$experience_certificate:$coachDetail['experience_certificate_image'];
				$police_verification_image = ($police_verification_image !='')?$police_verification_image:$coachDetail['police_verification_image'];
				$municipality_certificate_image = ($municipality_certificate_image !='')?$municipality_certificate_image:$coachDetail['municipality_certificate_image'];

				$updated_at = date('Y-m-d H:i:s');	
				$sql="Update admin set admin_name='$admin_name',age='$age',dob='$dob',gender='$gender',role='$role',location_id='$location_id',address='$address',address1='$address1',city='$city',state='$state',country='$country',postal_code='$postal_code',phone1='$phone1',phone2='$phone2',email_id='$email_id',emirates_id='$emirates_id',expiry_date='$expiry_date',passport_size_image='$passport_size_image',passport_image='$passport_image',visa_image='$visa_image',emirates_id_image='$emirates_id_image',experience_certificate_image='$experience_certificate',police_verification_image='$police_verification_image',municipality_certificate_image='$municipality_certificate_image',updated_at='$updated_at',status='$status' where admin_id='$admin_id'";
				$update=$this->db->query($sql);
				
				$sql2="Update users set status='$status' where code='$admin_code'";
				//echo $sql2;die;
				$this->db->query($sql2);
				
				if(isset($update)){
					$json['status'] = "success";
					$this->output->set_header('Content-Type: application/json');
		        	echo json_encode($json);
				}
				$this->session->set_flashdata('success_msg', 'Admin details updated successfully.');
			}else{
				$checkMail = $this->default->checkexists('users','email',$email_id);
	            if($checkMail == 0){
	                $wi = 1;    
            	    while($wi==1){	
    	                $sql_c = "select code from admin
    	                where code is not null and code != '' order by admin_id desc limit 1";
            			$query_c = $this->db->query($sql_c);
            			if($query_c->num_rows() > 0)
            			{
            			    $row4_code= $query_c->row()->code;
            			    $num_arr=explode("PSADMIN",$row4_code);
            			    $new_num=(int)$num_arr[1];  
            			    $new_code_num=str_pad(++$new_num,2,'0',STR_PAD_LEFT);
            			    $code="PSADMIN".$new_code_num;
            			}
            			else
            			{
            			   $code="PSADMIN01";
            			}
            			
            			$sql_c2 ="Select * from admin where code ='$code' ";
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
        		$created_at = date('Y-m-d H:i:s');	
			    $sql="INSERT into admin(admin_name,code,age,dob,gender,role,location_id,address,address1,city,state,country,postal_code,phone1,phone2,email_id,emirates_id,expiry_date,status,passport_size_image,passport_image,visa_image,emirates_id_image,experience_certificate_image,police_verification_image,municipality_certificate_image,created_at) values('".$admin_name."','".$code."','".$age."','".$dob."','".$gender."','".$role."','".$location_id."','".$address."','".$address1."','".$city."','".$state."','".$country."','".$postal_code."','".$phone1."','".$phone2."','".$email_id."','".$emirates_id."','".$expiry_date."','".$status."','".$passport_size_image."','".$passport_image."','".$visa_image."','".$emirates_id_image."','".$experience_certificate."','".$police_verification_image."','".$municipality_certificate_image."','".$created_at."')";
				$insert=$this->db->query($sql);
				
				
				$adduser=$this->db->query("INSERT into users(user_name,code,email,encrypted_password,mobile,gender,date_of_birth,role,status) values('".$admin_name."','".$code."','".$email_id."','123456','".$phone1."','".$gender."','".$dob."','".strtolower($role)."','$status')");
				//setMessage('New Coach Added Successfully.');

				//redirect(base_url().'Coach',$data);
				$this->session->set_flashdata('success_msg', 'Admin details added successfully.');
				$json['status'] = "success";
				$this->output->set_header('Content-Type: application/json');
	        	echo json_encode($json);
			}else{
				$json['error']['error_msg'] = 'Mail id already exists';
	            $this->session->set_flashdata('error', 'Mail id already exists');
	            $this->output->set_header('Content-Type: application/json');
	    		echo json_encode($json);
			}
		}
	}else{
	    $this->output->set_header('Content-Type: application/json');
	    echo json_encode($json);
	} 
}

public function edit($admin_id)
{
	$data['title'] ='Edit Admin Details';	
	$query = $this->db->query('select * from admin where admin_id='.$admin_id);
	$data=$query->row_array();
	$data['activityList'] = $this->schools->getAllActivityList();
	$data['locationList'] = $this->schools->getAllLocationList();
	$data['admin_id'] = $admin_id;
	$data['add_from'] = 'admin';
	$this->load->view('admin_registration',$data);
}

public function superadmin_edit($admin_id)
{
	$data['title'] ='Edit Superadmin Details';	
	$data['role'] = strtolower($this->session->userdata('role'));
	$query = $this->db->query('select * from admin where admin_id='.$admin_id);
	$data=$query->row_array();
	$data['activityList'] = $this->schools->getAllActivityList();
	$data['locationList'] = $this->schools->getAllLocationList();
	$data['admin_id'] = $admin_id;
	$data['add_from'] = 'superadmin';
	if($data['add_from'] == 'superadmin' && $data['role'] !='superadmin')
	{
	    echo 'Sorry, only SuperAdmin can edit Superadmin user.';die;
	}
	$this->load->view('admin_registration',$data);
}

public function delete($admin_id){
	$sql="update admin set deleted=1  where admin_id='$admin_id'";
	$this->db->query($sql);
	
	$sql2="select code from admin where admin_id='$admin_id'";
	$code=$this->db->query($sql2)->row()->code;
	
	$sql3="update users set deleted=1  where code='$code'";
	$this->db->query($sql3);
	
	$this->session->set_flashdata('success', 'Admin Details Deleted Successfully.');
	redirect(base_url().'Admin/list_');
}

public function superadmin_delete($admin_id){
	$sql="update admin set deleted=1  where admin_id='$admin_id'";
	$this->db->query($sql);
	
	$sql2="select code from admin where admin_id='$admin_id'";
	$code=$this->db->query($sql2)->row()->code;
	
	$sql3="update users set deleted=1  where code='$code'";
	$this->db->query($sql3);
	
	$this->session->set_flashdata('error', 'Superadmin Details Deleted Successfully.');
	redirect(base_url().'Admin/superadmin_list');
}

public function view($coach_id)
{
	$data['title'] = 'View Admin details';
	$query = $this->db->query('select * from admin where admin_id='.$coach_id);
	$data=$query->row_array();
	$data['location_id'] = $this->transaction->getLocationDetail($data['location_id']);
	$data['add_from'] = 'admin';
	$this->load->view('view_admin_registration', $data);
		
}  

public function superadmin_view($coach_id)
{
	$data['title'] = 'View Admin details';
	$query = $this->db->query('select * from admin where admin_id='.$coach_id);
	$data=$query->row_array();
	$data['location_id'] = $this->transaction->getLocationDetail($data['location_id']);
	$data['add_from'] = 'superadmin';
	$this->load->view('view_admin_registration', $data);
		
}  

function file_upload($FILES,$filepath,$insert_id)
{
		//echo '<pre>';print_r($FILES);exit;
	if(isset($FILES)){
			//echo "stringaa";
		$errors= array();
		$file_name = $FILES['name'];
		$file_size =$FILES['size'];
		$file_tmp =$FILES['tmp_name'];
		$file_type=$FILES['type'];


		$file_ext=explode('.',$file_name);
		$file_ext = $file_ext[1];
        $time = time();
        $flname = (string)$time."_".$file_name;
		$upload_filename = 'assets/'.$filepath.'/'.$flname;
		$makefilepath =  'assets/'.$filepath;
		if (!is_dir($makefilepath)) {
			mkdir('./'. $makefilepath, 0777, TRUE);
		}
			//echo '<pre>';print_r($upload_filename);exit;
		$extensions= array("jpeg","jpg","png");
//    $extensions= array("pdf","doc",'docx','xlsx');

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a pdf or doc file.";
		}

//if($file_size > 2097152){
  //   $errors[]='File size must be excately 2 MB';
// }

		if(empty($errors)==true){
			move_uploaded_file($file_tmp,$upload_filename);


			return $filepath.'/'.$flname;
				//echo "Success";
		}else{
			return false;
			print_r($errors);
		}
			//exit();
	}
}
function file_uploads($FILES,$filepath,$insert_id)
{
		//echo '<pre>';print_r($FILES);exit;
	if(isset($FILES)){
			//echo "stringaa";
		$errors= array();
		$file_name = $FILES['name'];
		$file_size =$FILES['size'];
		$file_tmp =$FILES['tmp_name'];
		$file_type=$FILES['type'];


		$file_ext=explode('.',$file_name);
		$file_ext = $file_ext[1];

		$upload_filename = 'assets/'.$filepath.'/'.$insert_id.'/'.$insert_id.$file_name;
		$makefilepath =  'assets/'.$filepath.'/'.$insert_id;
		if (!is_dir($makefilepath)) {
			mkdir('./'. $makefilepath, 0777, TRUE);
		}
			//echo '<pre>';print_r($upload_filename);exit;
		$extensions= array("jpeg","jpg","png");
//    $extensions= array("pdf","doc",'docx','xlsx');

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a pdf or doc file.";
		}

//if($file_size > 2097152){
  //   $errors[]='File size must be excately 2 MB';
// }

		if(empty($errors)==true){
			move_uploaded_file($file_tmp,$upload_filename);


			return true;
				//echo "Success";
		}else{
			return false;
			print_r($errors);
		}
			//exit();
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
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
        
		$mail->isHTML(true);
		
		$mail->Body = "<!DOCTYPE>
<html>
<head>
    <title></title>
    <style>
        table, th, td{ border: 1px solid black;
  border-collapse: collapse;
  height: 41px;
    width: -webkit-fill-available;
        }
        th{
            background-color: #f5efef;
            text-align: left;
        }
    </style>
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
        <p>Dear <b>".$email_data_array['admin_name'].",</b></p>
        <p>Your password is ".$email_data_array['encrypting_password']." </p>
        
    </div>";
		
		if(!$mail->send()) 
		{
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			return true;
		}
		
	}

}