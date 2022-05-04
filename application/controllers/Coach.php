<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Coach extends CI_Controller {  
      
    
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
		$data['title'] ="Coach Registration";
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coach_id'] = '';
		$data['add_from'] = isset($_GET['add'])?$_GET['add']:'';
		$this->load->view('coach_registration', $data);
	}

	public function list_($coach='coach'){
    	$data['title'] ="Coach List";
    	$data['from'] =$coach;
    	$query = $this->db->query("select c.coach_name,u.*, c.coach_id,c.activity_id,c.location_id from users u 
    	left join coach c on c.code = u.code
    	where u.role='$coach' and u.deleted !=1 ");
    	$data['coachList'] = $query->result_array();
    	foreach ($data['coachList'] as $key => $value) {
    		$data['coachList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
    		$data['coachList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
    	}
    	$this->load->view('coach_list',$data);
	}
	
	public function coach_profile_view()
	{
		
		$role = $_SESSION['role'];
		$code = $_SESSION['code'];

		
		$query = $this->db->query("select u.*, c.coach_id,c.activity_id,c.location_id from users u 
    	left join coach c on c.code = u.code
    	where u.role='".$role."' and c.code = '".$code."'and u.deleted !=1 ");
		
		
    	$data['coachList'] = $query->result_array();
    	foreach ($data['coachList'] as $key => $value) {
    	$data['coachList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
    		$data['coachList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
    	}
		
		$this->load->view('coach_profile_view',$data);
		
	}
	
	public function head_coach_single_view()
	{
		
		
		$role = $_SESSION['role'];
		$code = $_SESSION['code'];

		
		$query = $this->db->query("select u.*, c.coach_id,c.activity_id,c.location_id from users u 
    	left join coach c on c.code = u.code
    	where u.role='headcoach' and u.deleted !=1 ");
		
    	$data['coachList'] = $query->result_array();
    	foreach ($data['coachList'] as $key => $value) {
    	$data['coachList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
    		$data['coachList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
    	}
		$this->load->view('head_coach_report_list',$data);
		
	}	

	
	public function add(){
		$data['title'] = 'Coach Registration';
		$coach_id = $this->input->post('coach_id');
		$coach_name=$this->input->post('coach_name');
		$activity_id=$this->input->post('activity_id');
		$location_id=$this->input->post('location_id');
		$experience=$this->input->post('experience');
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

		if (empty($coach_name)) {
            $json['error']['coach_name'] = 'Please enter coach name';
        }
        if ($activity_id == '') {
            $json['error']['activity_id'] = 'Please select activity';
        }
        if ($location_id == '') {
            $json['error']['location_id'] = 'Please select location';
        }
        if (empty($experience)) {
            $json['error']['experience'] = 'Please enter experience';
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
		    
			$filepath="Coach_images";
			$insert_id=$user_id;
			
			$passport_size_image = isset($_FILES['passport_size_image'])&& $_FILES['passport_size_image']['name'] != ''?$this->file_upload($_FILES['passport_size_image'],$filepath,$insert_id):'';
			$passport_image = isset($_FILES['passport_image'])&& $_FILES['passport_image']['name'] != ''?$this->file_upload($_FILES['passport_image'],$filepath,$insert_id):'';
			$visa_image = isset($_FILES['visa_image']) && $_FILES['visa_image']['name'] != '' ?$this->file_upload($_FILES['visa_image'],$filepath,$insert_id):'';
			$emirates_id_image = isset($_FILES['emirates_id_image'])  && $_FILES['emirates_id_image']['name'] != '' ?$this->file_upload($_FILES['emirates_id_image'],$filepath,$insert_id):'';
			$experience_certificate = isset($_FILES['experience_certificate']) && $_FILES['experience_certificate']['name'] != '' ?$this->file_upload($_FILES['experience_certificate'],$filepath,$insert_id):'';
			$police_verification_image = isset($_FILES['police_verification_image']) && $_FILES['police_verification_image']['name'] != '' ?$this->file_upload($_FILES['police_verification_image'],$filepath,$insert_id):'';
			$municipality_certificate_image = isset($_FILES['municipality_certificate_image']) && $_FILES['municipality_certificate_image']['name'] != '' ?$this->file_upload($_FILES['municipality_certificate_image'],$filepath,$insert_id):'';
			
			
			
			$created_at=currentDateTime();
			
			if($coach_id !=''){
				//echo "<br>sdfsdfsdfsdfsdfsdf";
				$getdata = $this->db->query('select * from coach where coach_id='.$coach_id);
				$coachDetail = $getdata->row_array();
				
				$passport_size_image = ($passport_size_image !='')?$passport_size_image:$coachDetail['passport_size_image'];
				$passport_image = ($passport_image !='')?$passport_image:$coachDetail['passport_image'];
				$visa_image = ($visa_image !='')?$visa_image:$coachDetail['visa_image'];
				$emirates_id_image = ($emirates_id_image !='')?$emirates_id_image:$coachDetail['emirates_id_image'];
				$experience_certificate = ($experience_certificate !='')?$experience_certificate:$coachDetail['experience_certificate_image'];
				$police_verification_image = ($police_verification_image !='')?$police_verification_image:$coachDetail['police_verification_image'];
				$municipality_certificate_image = ($municipality_certificate_image !='')?$municipality_certificate_image:$coachDetail['municipality_certificate_image'];

				$updated_at = date('Y-m-d H:i:s');	
				$sql="Update  coach set coach_name='$coach_name',age='$age',dob='$dob',gender='$gender',experience='$experience',role='$role',activity_id='$activity_id',location_id='$location_id',address='$address',address1='$address1',city='$city',state='$state',country='$country',postal_code='$postal_code',phone1='$phone1',phone2='$phone2',email_id='$email_id',emirates_id='$emirates_id',expiry_date='$expiry_date',passport_size_image='$passport_size_image',passport_image='$passport_image',visa_image='$visa_image',emirates_id_image='$emirates_id_image',experience_certificate_image='$experience_certificate',police_verification_image='$police_verification_image',municipality_certificate_image='$municipality_certificate_image',updated_at='$updated_at' where coach_id='$coach_id'";
				$update=$this->db->query($sql);
				if(isset($update)){
					$json['status'] = "success";
					$this->output->set_header('Content-Type: application/json');
		        	echo json_encode($json);
				}
				$this->session->set_flashdata('success_msg', 'Coach details updated successfully.');
			}else{
				$checkMail = $this->default->checkexists('users','email',$email_id);
	            if($checkMail == 0){
	                $wi = 1;    
            	    while($wi==1){	
    	                $sql_c = "select c.code,g.game_code from coach c 
    	                left join games g on g.game_id=c.activity_id
    	                where c.activity_id='$activity_id' and c.code is not null and c.code != '' order by c.coach_id desc limit 1";
            			$query_c = $this->db->query($sql_c);
            			if($query_c->num_rows() > 0)
            			{
            			    $row4_code= $query_c->row()->code;
            			    $row4_g_code = $query_c->row()->game_code;
            		        $num_arr=explode("PS".$row4_g_code."CH",$row4_code);
            			    $new_num=(int)$num_arr[1];  
            			    $new_code_num=str_pad(++$new_num,2,'0',STR_PAD_LEFT);
            			    $code="PS".$row4_g_code."CH".$new_code_num;
            			}
            			else
            			{
            			     $sql_c2 = "select g.game_code from games g 
        	                    where g.game_id='$activity_id' ";
                			$game_code= $this->db->query($sql_c2)->row()->game_code;
        			        $code="PS".$game_code."CH01";
            			}
            			
            			$sql_c2 ="Select * from coach where code ='$code' ";
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
			    $sql="INSERT into coach(coach_name,code,age,dob,gender,experience,role,activity_id,location_id,address,address1,city,state,country,postal_code,phone1,phone2,email_id,emirates_id,expiry_date,status,passport_size_image,passport_image,visa_image,emirates_id_image,experience_certificate_image,police_verification_image,municipality_certificate_image,created_at) values('".$coach_name."','".$code."','".$age."','".$dob."','".$gender."','".$experience."','".$role."','".$activity_id."','".$location_id."','".$address."','".$address1."','".$city."','".$state."','".$country."','".$postal_code."','".$phone1."','".$phone2."','".$email_id."','".$emirates_id."','".$expiry_date."','Active','".$passport_size_image."','".$passport_image."','".$visa_image."','".$emirates_id_image."','".$experience_certificate."','".$police_verification_image."','".$municipality_certificate_image."','".$created_at."')";
				$insert=$this->db->query($sql);
				
				
				$adduser=$this->db->query("INSERT into users(user_name,code,email,mobile,gender,date_of_birth,role,status) values('".$coach_name."','".$code."','".$email_id."','".$phone1."','".$gender."','".$dob."','".strtolower($role)."','Inactive')");
				//setMessage('New Coach Added Successfully.');
				//redirect(base_url().'Coach',$data);
				$this->session->set_flashdata('success_msg', 'Coach details added successfully.');
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

public function edit($coach_id)
{
	$data['title'] ='Edit Coach Details';	
	$query = $this->db->query('select * from coach where coach_id='.$coach_id);
	$data=$query->row_array();
	$data['activityList'] = $this->schools->getAllActivityList();
	$data['locationList'] = $this->schools->getAllLocationList();
	$data['coach_id'] = $coach_id;
	$this->load->view('coach_registration',$data);
}
public function delete($coach_id){
	$sql="update coach set deleted=1  where coach_id='$coach_id'";
	$this->db->query($sql);
	
	$sql2="select code from coach where coach_id='$coach_id'";
	$code=$this->db->query($sql2)->row()->code;
	
	$sql3="update users set deleted=1  where code='$code'";
	$this->db->query($sql3);
	
	$this->session->set_flashdata('error', 'Coach Details Deleted Successfully.');
	redirect(base_url().'coach/list_');
}

public function view($coach_id)
{
	$data['title'] = 'View Coach details';
	$query = $this->db->query('select * from coach where coach_id='.$coach_id);
	$data=$query->row_array();
	$data['activity_id'] = $this->transaction->getActivityDetail($data['activity_id']);
	$data['location_id'] = $this->transaction->getLocationDetail($data['location_id']);
	$this->load->view('view_coach_registration', $data);
		
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
}