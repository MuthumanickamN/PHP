<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Students extends CI_Controller {  
	public function __construct(){
		parent::__construct();
		error_reporting(0);
	    $this->load->model('Student_Model');
	    $this->load->model('Default_Model', 'default');
	    $this->load->model('School_profile_report_Model', 'schools');
	    $this->load->model('Daily_Transaction_Model', 'transaction');
	}
	
	public function index(){
		$data['title'] = 'Student Registration';
		$role = strtolower($this->session->userdata['role']);
		$username=$this->session->userdata('username');
    	$parentDetails = $this->default->getParentDetail($username);
    	if($role == 'parent'){
    		$query = $this->db->query("select * from parent where `status` = 'Active' and `parent_id` = '".$parentDetails['parent_id']."' ");
    	}else{
			$query = $this->db->query("select * from parent where `status` = 'Active' ");
		}
		
		$data['parentsList'] = $query->result_array();
		$data['edit'] = 0;
		$data['role'] = $role;
		$this->load->view('student_registration', $data);
	}
	public function list_(){
		$data['title'] = 'Student List';
		$role = strtolower($this->session->userdata['role']);
		$username=$this->session->userdata('username');
    	$parentDetails = $this->default->getParentDetail($username);
    	
		if($role == 'parent'){
			$query = $this->db->query("select r.*,p.parent_code from registrations r left join parent p on p.parent_id = r.parent_user_id where r.`parent_user_id` ='".$parentDetails['parent_id']."' and r.deleted=0 order by r.`id` ASC ");
		}else{
			$query = $this->db->query("select r.*,p.parent_code from registrations r left join parent p on p.parent_id = r.parent_user_id where r.deleted=0 order by r.`id` ASC ");
		}
		//echo $this->db->last_query();die;
		$data['studentList'] = $query->result_array();
		$data['role'] = $role;
		$this->load->view('student_list',$data);
	}
	
	public function addStudent() {
		$id=$this->input->post('id');
		$student_name=$this->input->post('student_name');
		$student_dob=$this->input->post('student_dob');
		$nationality=$this->input->post('nationality');
		$country=$this->input->post('country');
		$postal_code=$this->input->post('postal_code');		
		$student_age=$this->input->post('student_age');
		$student_gender=$this->input->post('student_gender');
		$father_name=$this->input->post('father_name');
		$father_contact_no=$this->input->post('father_contact_no');
		$mother_name=$this->input->post('mother_name');
		$emergency_contact_no=$this->input->post('emergency_contact_no');
		$passport_id=$this->input->post('passport_id');
		
		$parent_mobile=$this->input->post('parent_mobile');
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
		$parent_email_id=$this->input->post('parent_email_id');
		$state=$this->input->post('state');
		$district=$this->input->post('district');
		$city=$this->input->post('city');
		$school_name=$this->input->post('school_name');
		$sibling_name=$this->input->post('sibling_name');
		$sibling_reg_no=$this->input->post('sibling_reg_no');
		$father_email_id=$this->input->post('father_email_id');
		$father_office_contact_no=$this->input->post('father_office_contact_no');
		$mother_contact_no=$this->input->post('mother_contact_no');
		$mother_office_contact_no=$this->input->post('mother_office_contact_no');
		$mother_email_id=$this->input->post('mother_email_id');
		$student_email_id=$this->input->post('student_email_id');
		$address1=$this->input->post('address1');
		$address2=$this->input->post('address2');
		$student_emirates_id=$this->input->post('student_emirates_id');
		$email=$this->session->userdata('username');
		$adminDetails=$this->session->userdata('user'); 
		$admin_name = $adminDetails[0]->user_name; 
		
		$role = 'student';

		$email=$this->session->userdata('username');
		$this->db->where('email', $email);  
		$query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_id=$postData1['user_id'];

		$date_of_issue=$this->input->post('date_of_issue');
		$tshirt_size=$this->input->post('tshirt_size');
		$status=$this->input->post('status')!=''?$this->input->post('status'):'Inactive';
		$approval_status=$this->input->post('approval_status')!=''?$this->input->post('approval_status'):'Pending';

		if (empty($student_name)) {
            $json['error']['student_name'] = 'Please enter student name';
        }
        if (empty($student_dob)) {
            $json['error']['student_dob'] = 'Please select DOB';
        }
        if (empty($student_gender)) {
            $json['error']['student_gender'] = 'Please choose Gender';
        }
        if (empty($father_name)) {
            $json['error']['father_name'] = 'Please enter father name';
        }
        if (empty($father_contact_no)) {
            $json['error']['father_contact_no'] = 'Please enter father contact no';
        }
        if (empty($mother_name)) {
            $json['error']['mother_name'] = 'Please enter mother name';
        }
        if (empty($emergency_contact_no)) {
            $json['error']['emergency_contact_no'] = 'Please enter emergency contact no';
        }
        if (empty($father_email_id)) {
           // $json['error']['father_email_id'] = 'Please enter father email id';
        }
        if (empty($mother_contact_no)) {
            //$json['error']['mother_contact_no'] = 'Please enter mother contact no';
        }
        if (empty($mother_email_id)) {
            //$json['error']['mother_email_id'] = 'Please enter mother email id';
        }
        if (empty($student_email_id)) {
            //$json['error']['student_email_id'] = 'Please enter student email id';
        }
        /*if ($id == '' && $status == '') {
            $json['error']['status'] = 'Please select status';
        }
        if ($id == '' && $approval_status == '') {
            $json['error']['approval_status'] = 'Please select approval status';
        }*/
        if ($parent_mobile == '') {
            $json['error']['parent_mobile'] = 'Please select registered parent mobile';
        }
        if ($parent_id == '') {
            $json['error']['parent_id'] = 'Please enter parent id';
        }
        if ($parent_name == '') {
            $json['error']['parent_name'] = 'Please enter parent name';
        }
        if ($parent_email_id == '') {
            $json['error']['parent_email_id'] = 'Please enter parent email id';
        }
        if (empty($json['error']) ) {
            
            $filepath="Student_images";
			$insert_id=$user_id;
			
			$sponsor_passport = isset($_FILES['sponsor_passport']) && $_FILES['sponsor_passport']['name'] != '' ?$this->file_upload($_FILES['sponsor_passport'],$filepath,$insert_id):'';
			
			$sponsor_visa_page = isset($_FILES['sponsor_visa_page']) && $_FILES['sponsor_visa_page']['name'] != '' ?$this->file_upload($_FILES['sponsor_visa_page'],$filepath,$insert_id):'';
			
			$student_passport_image = isset($_FILES['student_passport_image']) && $_FILES['student_passport_image']['name'] != '' ?$this->file_upload($_FILES['student_passport_image'],$filepath,$insert_id):'';
			
			$sponsor_emirates_id = isset($_FILES['sponsor_emirates_id']) && $_FILES['sponsor_emirates_id']['name'] != '' ?$this->file_upload($_FILES['sponsor_emirates_id'],$filepath,$insert_id):'';
			
			$student_emirates_id_image = isset($_FILES['student_emirates_id_image']) && $_FILES['student_emirates_id_image']['name'] != '' ?$this->file_upload($_FILES['student_emirates_id_image'],$filepath,$insert_id):'';
			
			$student_visa_page = isset($_FILES['student_visa_page']) && $_FILES['student_visa_page']['name'] != '' ?$this->file_upload($_FILES['student_visa_page'],$filepath,$insert_id):'';
			
			$student_passport_size_image = isset($_FILES['student_passport_size_image']) && $_FILES['student_passport_size_image']['name'] != '' ?$this->file_upload($_FILES['student_passport_size_image'],$filepath,$insert_id):'';
			

			$created_at=currentDateTime();
			
			
			if($id !=''){
				//echo "<br>sdfsdfsdfsdfsdfsdf";
				$getdata = $this->db->query('select * from registrations where id='.$id);
				$studDetail = $getdata->row_array();
				$sponsor_passport1 = ($sponsor_passport !='')?$sponsor_passport:$studDetail['sponsor_passport_file_name'];
				$sponsor_visa_page1 = ($sponsor_visa_page !='')?$sponsor_visa_page:$studDetail['sponsor_visapage_file_name'];
				$student_passport_image1 = ($student_passport_image !='')?$student_passport_image:$studDetail['image_file_name'];
				$sponsor_emirates_id1 = ($sponsor_emirates_id !='')?$sponsor_emirates_id:$studDetail['sponsor_emid_file_name'];
				$student_emirates_id_image1 = ($student_emirates_id_image !='')?$student_emirates_id_image:$studDetail['student_emid_file_name'];
				$student_visa_page1 = ($student_visa_page !='')?$student_visa_page:$studDetail['student_visapage_file_name'];
				$student_passport_size_image1 = ($student_passport_size_image !='')?$student_passport_size_image:$studDetail['student_passport_file_name'];
				$updated_at = date('Y-m-d H:i:s');
				
				$prev_approval_status = $studDetail['approval_status'];
				
				$sql="Update  registrations set name='$student_name',dob='$student_dob',age='$student_age',gender='$student_gender',father_name='$father_name',father_contact='$father_contact_no',mother_name='$mother_name',emergency_contact='$emergency_contact_no',image_file_name='$student_passport_image1',parent_mobile='$parent_mobile',parent_name='$parent_name',parent_email_id='$parent_email_id',parent_user_id='$parent_id',nationality='$nationality',country='$country',postal_code='$postal_code',state='$state',district='$district',city='$city',school_name='$school_name',sibling_name='$sibling_name',sibling_reg_no='$sibling_reg_no',father_email='$father_email_id',mother_email='$mother_email_id',mother_contact='$mother_contact_no',mother_office_contact='$mother_office_contact_no',student_email='$student_email_id',passport_id='$passport_id',address_1='$address1',address_2='$address2',emirates_id_issue='$date_of_issue',student_emid_file_name='$student_emirates_id_image1',t_shirt_size='$tshirt_size',student_passport_file_name='$student_passport_size_image1',student_visapage_file_name='$student_visa_page1',sponsor_passport_file_name='$sponsor_passport1',sponsor_visapage_file_name='$sponsor_visa_page1',sponsor_emid_file_name='$sponsor_emirates_id1',updated_at='$updated_at',updated_admin_id='$user_id',updated_admin_email='$email',status='$status',approval_status='$approval_status',role='$role',updated_admin_name='$admin_name'  where id='$id'";
				$update=$this->db->query($sql);
				if(isset($update)){
						$json['status'] = "success";
					 $this->output->set_header('Content-Type: application/json');
					 
					 if(($prev_approval_status != $approval_status) && $approval_status== "Approved")
					 {
					    $this->send_email($parent_email_id, $parent_name, $student_name);
					 }
					 
		        	echo json_encode($json);
		        	
				}
				$this->session->set_flashdata('success_msg', 'Student details updated successfully.');
			}else{
			    
			    $checkMail = $this->default->checkexists('users','email',$student_email_id);
	            if($checkMail == 0){
	                
                    $wi = 1;    
                    while($wi==1){	
	                
        				$sql_c = "select sid as code from registrations
                        where  sid is not null and sid != '' order by id desc limit 1";
            			$query_c = $this->db->query($sql_c);
            			if($query_c->num_rows() > 0)
            			{
            			    $row4_code= $query_c->row()->code;
            			    $num_arr=explode("PS",$row4_code);
            			    $new_num=(int)$num_arr[1];  
            			    $new_code_num=str_pad(++$new_num,3,'0',STR_PAD_LEFT);
            			    $code="PS".$new_code_num;
            			}
            			else
            			{
            			    $code="PS001";
            			}
            			
            			$sql_c2 ="Select * from registrations where sid ='$code' ";
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
    		

			    $sql="INSERT into registrations(name,dob,age,gender,father_name,father_contact,mother_name,emergency_contact,image_file_name,parent_mobile,parent_name,parent_email_id, parent_user_id, nationality,country,postal_code,state,district,city,school_name,sibling_name,sibling_reg_no,father_email,father_office_contact,mother_contact,mother_office_contact,mother_email,student_email,address_1,address_2,student_emid_file_name,emirates_id_issue,t_shirt_size,status,approval_status,student_passport_file_name,student_visapage_file_name,sponsor_passport_file_name,sponsor_visapage_file_name,sponsor_emid_file_name,emirates_id,passport_id,created_at, sid, role,updated_admin_id,updated_admin_email, updated_admin_name,country_id) values('".$student_name."','".$student_dob."','".$student_age."','".$student_gender."','".$father_name."','".$father_contact_no."','".$mother_name."','".$emergency_contact_no."','".$student_passport_image."','".$parent_mobile."','".$parent_name."','".$parent_email_id."','".$parent_id."','".$nationality."','".$country."','".$postal_code."','".$state."','".$district."','".$city."','".$school_name."','".$sibling_name."','".$sibling_reg_no."','".$father_email_id."','".$father_office_contact_no."','".$mother_contact_no."','".$mother_office_contact_no."','".$mother_email_id."','".$student_email_id."','".$address1."','".$address2."','".$student_emirates_id_image."','".$date_of_issue."','".$tshirt_size."','".$status."','".$approval_status."','".$student_passport_size_image."','".$student_visa_page."','".$sponsor_passport."','".$sponsor_visa_page."','".$sponsor_emirates_id."','".$student_emirates_id."','".$passport_id."','".$created_at."','".$code."','".$role."','".$user_id."','".$email."','".$admin_name."',1)";
				$insert=$this->db->query($sql);
				
				
					
				
				if(isset($insert)){
					
				
					$json['status'] = "success";
					$this->output->set_header('Content-Type: application/json');
					if($approval_status== "Approved")
					{
				        $this->send_email($parent_email_id, $parent_name, $student_name);
					}
		        	echo json_encode($json);
					
				}
				$this->session->set_flashdata('success_msg', 'New student added successfully.');
            }else{
				$json['error']['error_msg'] = 'Mail id already exists';
	            $this->session->set_flashdata('error', 'Mail id already exists');
	            $this->output->set_header('Content-Type: application/json');
	    		echo json_encode($json);
			}
			}
		}
		else{
	        $this->output->set_header('Content-Type: application/json');
	        echo json_encode($json);
		} 
		
		
	} 
	public function edit($id){
		$query = $this->db->query('select * from registrations where id='.$id);
		$data = $query->row_array();
		$role = strtolower($this->session->userdata['role']);
		$username=$this->session->userdata('username');
    	$parentDetails = $this->default->getParentDetail($username);
    	if($role == 'parent'){
    		$parentList = $this->db->query("select * from parent where `status` = 'Active' and `parent_id` = '".$parentDetails['parent_id']."' ");
    	}else{
			$parentList = $this->db->query("select * from parent where `status` = 'Active' ");
		}
		$data['parentsList'] = $parentList->result_array();
		$data['title'] = 'Edit student Details';
		//echo "<pre>"; print_r($data); die;
		$data['edit'] = 1;
		$data['parent_id'] = $parentDetails['parent_id'];
		
		$activitylists = $this->db->query("select * from activity_selections where student_id=".$id); 
    	$data['activitylists']=$activitylists->result_array();
    	foreach ($data['activitylists'] as $key => $value) {
    		$data['activitylists'][$key]['game'] = ($value['activity_id'] !='')?$this->transaction->getActivityDetail($value['activity_id']):'';
    		$data['activitylists'][$key]['level'] = ($value['level_id'] !='')?$this->default->getLevelDetail($value['level_id']):'';
    	}
    	$prepaidCredits = $this->db->query("select * from prepaid_credits where parent_id=".$data['parent_user_id']); 
    	$balanceDetails=$prepaidCredits->row_array();
    	$data['balance']=isset($balanceDetails)?$balanceDetails['balance_credits']:'0';
    	
    	$query2 = $this->db->query('select * from registration_fees where student_id='.$id.' order by id desc limit 1');
    	$data['registration']=$query2->row_array();
    	
    	$query3 = $this->db->query('select game_id,game from games where active=1');
    	$data['games']=$query3->result_array();
    	$data['role'] = $role;
    	
		$this->load->view('student_registration',$data);
	}
public function edit1($id){
	$query = $this->db->query('select * from registrations where id='.$id);
	$postData=$query->row_array();
	$data['id'] = $postData['id'];
	$data['name']=$postData['name'];
	$data['passport_id']=$postData['passport_id'];
	$data['dob']=$postData['dob'];
	$data['age']=$postData['age'];
	$data['parent_mobile']=$postData['parent_mobile'];
	$data['gender']=$postData['gender'];
	$data['nationality']=$postData['nationality'];
	$data['country']=$postData['country'];
	$data['state']=$postData['state'];
	$data['district']=$postData['district'];
	$data['city']=$postData['city'];
	$data['postal_code']=$postData['postal_code'];
	$data['school_name']=$postData['school_name'];
	$data['sibling_name']=$postData['sibling_name'];
	$data['sibling_reg_no']=$postData['sibling_reg_no'];
	$data['father_name']=$postData['father_name'];
	$data['father_contact']=$postData['father_contact'];
	$data['father_office_contact']=$postData['father_office_contact'];
	$data['father_email']=$postData['father_email'];
	$data['mother_name']=$postData['mother_name'];
	$data['mother_contact']=$postData['mother_contact'];
	$data['mother_office_contact']=$postData['mother_office_contact'];
	$data['mother_email']=$postData['mother_email'];
	$data['student_email']=$postData['student_email'];
	$data['emergency_contact']=$postData['emergency_contact'];
	$data['address_1']=$postData['address_1'];
	$data['address_2']=$postData['address_2'];
	$data['t_shirt_size']=$postData['t_shirt_size'];
	$data['emirates_id']=$postData['emirates_id'];
	$data['emirates_id_issue']=$postData['emirates_id_issue'];
	$data['student_passport_file_name']=$postData['student_passport_file_name'];
	$data['student_visapage_file_name']=$postData['student_visapage_file_name'];
	$data['sponsor_passport_file_name']=$postData['sponsor_passport_file_name'];
	$data['sponsor_visapage_file_name']=$postData['sponsor_visapage_file_name'];
	$data['sponsor_emid_file_name']=$postData['sponsor_emid_file_name'];
	$data['image_file_name']=$postData['image_file_name'];
	$data['student_emid_file_name']=$postData['student_emid_file_name'];

	$data['status']=$postData['status'];
	$data['approval_status']=$postData['approval_status'];
	
	if($this->input->post('submit'))
		{
		$student_name=$this->input->post('student_name');
		$student_dob=$this->input->post('student_dob');
		$nationality=$this->input->post('nationality');
		$country=$this->input->post('country');
		$postal_code=$this->input->post('postal_code');		
		$student_age=$this->input->post('student_age');
		$student_gender=$this->input->post('student_gender');
		$father_name=$this->input->post('father_name');
		$father_contact_no=$this->input->post('father_contact_no');
		$mother_name=$this->input->post('mother_name');
		$emergency_contact_no=$this->input->post('emergency_contact_no');
		$passport_id=$this->input->post('passport_id');
		$parent_name=$this->input->post('parent_name');
		$parent_mobile=$this->input->post('parent_mobile');
		$parent_id=$this->input->post('parent_id');
		$parent_email_id=$this->input->post('parent_email_id');
		$state=$this->input->post('state');
		$district=$this->input->post('district');
		$city=$this->input->post('city');
		$school_name=$this->input->post('school_name');
		$sibling_name=$this->input->post('sibling_name');
		$sibling_reg_no=$this->input->post('sibling_reg_no');
		$father_email_id=$this->input->post('father_email_id');
		$father_office_contact_no=$this->input->post('father_office_contact_no');
		$mother_contact_no=$this->input->post('mother_contact_no');
		$mother_office_contact_no=$this->input->post('mother_office_contact_no');
		$mother_email_id=$this->input->post('mother_email_id');
		$student_email_id=$this->input->post('student_email_id');
		$address1=$this->input->post('address1');
		$address2=$this->input->post('address2');
		$student_emirates_id=$this->input->post('student_emirates_id');
		$student_emirates_id_image=$this->input->post('student_emirates_id_image');
		$date_of_issue=$this->input->post('date_of_issue');
		$tshirt_size=$this->input->post('tshirt_size');	
		
		$status=$this->input->post('status');
		$approval_status=$this->input->post('approval_status');
		
			$sponsor_passport = $_FILES['sponsor_passport']['name'];
			$sponsor_visa_page = $_FILES['sponsor_visa_page']['name'];
			$student_passport_image = $_FILES['student_passport_image']['name'];
			$sponsor_emirates_id = $_FILES['sponsor_emirates_id']['name'];
			$student_emirates_id_image = $_FILES['student_emirates_id_image']['name'];
			$student_visa_page = $_FILES['student_visa_page']['name'];
			$student_passport_size_image = $_FILES['student_passport_size_image']['name'];
	
	
	 if($student_passport_image=="")
		{
			$student_passport_image=$this->input->post('student_passport_image1');
		
		}

		if($student_emirates_id_image=="")
		{
			$student_emirates_id_image=$this->input->post('student_emirates_id_image1');
		
		}
		if($student_passport_size_image=="")
		{
			$student_passport_size_image=$this->input->post('student_passport_size_image1');
		
		}
		$student_visa_page=$this->input->post('student_visa_page');
		if($student_visa_page=="")
		{
			$student_visa_page=$this->input->post('student_visa_page1');

		}
		$sponsor_passport=$this->input->post('sponsor_passport');
		if($sponsor_passport=="")
		{
			$sponsor_passport=$this->input->post('sponsor_passport1');
			
		}
		$sponsor_visa_page=$this->input->post('sponsor_visa_page');
		if($sponsor_visa_page=="")
		{
			$sponsor_visa_page=$this->input->post('sponsor_visa_page1');
		}
			$sponsor_emirates_id=$this->input->post('sponsor_emirates_id');


			if($sponsor_emirates_id=="")
		{
			$sponsor_emirates_id=$this->input->post('sponsor_emirates_id1');
		
		}
        
		
		$email=$this->session->userdata('username');
		$this->db->where('email', $email);  
		$query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_id=$postData1['user_id'];
		$updated_at=currentDateTime();
        $email=$this->session->userdata('username');
	 	$this->db->where('email', $email);  
        $query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_name=$postData1['user_name'];
		$filepath="Student_images";
		$insert_id=$user_id;
		$test11=$this->file_uploads($_FILES['sponsor_passport'],$filepath,$insert_id);
		$test1=$this->file_uploads($_FILES['sponsor_visa_page'],$filepath,$insert_id);
		$test2=$this->file_uploads($_FILES['student_passport_image'],$filepath,$insert_id);
		$test3=$this->file_uploads($_FILES['sponsor_emirates_id'],$filepath,$insert_id);
		$test4=$this->file_uploads($_FILES['student_emirates_id_image'],$filepath,$insert_id);
		$test5=$this->file_uploads($_FILES['student_visa_page'],$filepath,$insert_id);
		$test6=$this->file_uploads($_FILES['student_passport_size_image'],$filepath,$insert_id);  

		 $sql="Update  registrations set name='$student_name',dob='$student_dob',age='$student_age',gender='$student_gender',father_name='$father_name',father_contact='$father_contact_no',mother_name='$mother_name',emergency_contact='$emergency_contact_no',image_file_name='$student_passport_image',parent_mobile='$parent_mobile',parent_name='$parent_name',parent_email_id='$parent_email_id',nationality='$nationality',country='$country',postal_code='$postal_code',state='$state',district='$district',city='$city',school_name='$school_name',sibling_name='$sibling_name',sibling_reg_no='$sibling_reg_no',father_email='$father_email_id',mother_email='$mother_email_id',mother_contact='$mother_contact_no',mother_office_contact='$mother_office_contact_no',student_email='$student_email_id',passport_id='$passport_id',address_1='$address1',address_2='$address2',emirates_id_issue='$date_of_issue',student_emid_file_name='$student_emirates_id_image',t_shirt_size='$tshirt_size',student_passport_file_name='$student_passport_size_image',student_visapage_file_name='$student_visa_page',sponsor_passport_file_name='$sponsor_passport',sponsor_visapage_file_name='$sponsor_visa_page',sponsor_emid_file_name='$sponsor_emirates_id',updated_at='$updated_at',updated_admin_name='$user_name',updated_admin_email='$email',status='$status',approval_status='$approval_status' where id='$id'";
		$insert=$this->db->query($sql);
		setMessage('Student Details Updated Successfully.');
		redirect(base_url().'index.php/student/list_');
	}
	$this->load->view('student_registration',$data);
}
public function delete($id){
	$sql="Delete from registrations  where id='$id'";
	$insert=$this->db->query($sql);
	setMessage('Student Details Deleted Successfully.');
	redirect(base_url().'student/list_');
}
public function view($id){
	$data['title'] = 'View Student Details';
	$query = $this->db->query('select * from registrations where id='.$id);
	$data=$query->row_array();
	$activitylists = $this->db->query("select * from activity_selections where student_id=".$id); 
	$data['activitylists']=$activitylists->result_array();
	foreach ($data['activitylists'] as $key => $value) {
		$data['activitylists'][$key]['game'] = ($value['activity_id'] !='')?$this->transaction->getActivityDetail($value['activity_id']):'';
		$data['activitylists'][$key]['level'] = ($value['level_id'] !='')?$this->default->getLevelDetail($value['level_id']):'';
	}
	$prepaidCredits = $this->db->query("select * from prepaid_credits where parent_id=".$data['parent_user_id']); 
	$balanceDetails=$prepaidCredits->row_array();
	$data['balance']=isset($balanceDetails)?$balanceDetails['balance_credits']:'0';
	
	$query2 = $this->db->query('select * from registration_fees where student_id='.$id.' order by id desc limit 1');
	$data['registration']=$query2->row_array();
	
	$query3 = $this->db->query('select game_id,game from games where active=1');
	$data['games']=$query3->result_array();
	
	
    $osql3= "select * from registration_fees where student_id=".$id;
	$row3 = $this->db->query($osql3)->result_array();

	
     //echo $row3['reg_fee_category'];
	$this->load->view('view_student_registration', $data);
}
  public function student_details(){
	$parent_mobile=$this->input->post('parent_mobile');
	if(isset($parent_mobile) && $parent_mobile!= ''){
		$query=$this->db->query("select * from parent where mobile_no='".$parent_mobile."' and status='Active'");
		$row=$query->row_array();
		$data['parent_id']=$row['parent_id'];
		$data['parent_code']=$row['parent_code'];
		$data['parent_name']=$row['parent_name'];
		$data['email_id']=$row['email_id'];
	}
	$data['opcode']=1;
	$this->load->view('student_registration_ajax', $data);	
}
public function changestatus($id, $field, $value){
	$userData = array(
	  $field => $value,
	);
	$this->db->where('id', $id);
	$updateData = $this->db->update('registrations', $userData);
	$json['status'] = "success";
    $this->session->set_flashdata('success_msg', 'Status updated successfully');
    $this->output->set_header('Content-Type: application/json');
    echo json_encode($json);
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


	public function send_email($parent_email_id, $parent_name, $student_name)
	{
		
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('Phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = true;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;

		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
		
		
		$mail->AddCC(CC_ADDRESS);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($parent_email_id);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Kid Regitration Approval";
		
		$mail->Body = "<!DOCTYPE>
						<html>
						<head>
							<title>Kid Regitration Approval</title>
						</head>
						<body>
							<div><div class='logo' style='float: left;
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
							<div class='main'>
								<p>Dear <b>".$parent_name.",</b></p>
								<p>Your kid <b> ".$student_name."'s </b> Registration is approved successfully.</p>
								<p>please pay registration fees under Academy activities menu use 'Registration fees' options. </p>
								<p><a href='".$login_url."'>Click here</a> to login</p>
								<h4>Thanks & Regards</h4>
								<h4 style='color: grey'>PSSS Admin team</h4>
								<hr>
								<p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
							</div>
							</div>
						</body>
						</html>";
		$mail->AltBody = "This is the plain text version of the email content";
		//<p>now you can continue to select your kids activities in the 'active kids' menu.</p>
		if(!$mail->send()) 
		{
			
		   echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
		    
			return true;
		}
	
		
	}
	
	public function send_test()
	{
		$parent_name = "Parent Name";
		$student_name = "ST";
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('Phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		
		
		$mail =  $this->phpmailer;
       // $mail->isSMTP();
		$mail->SMTPDebug = true;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;

		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        //$mail->AddCC(CC_ADDRESS);
		$mail->AddAddress('nvijaymuthumanickam@gmail.com');
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		
        $mail->isHTML(true);
        
       
        
		$mail->Subject = "Prime Star Sport Academy LLC - Login Details";
		
		$mail->Body = "<!DOCTYPE>
						<html>
						<head>
							<title>Kid Regitration Approval</title>
						</head>
						<body>
							<div style='width:600px; margin:0 auto'><div class='logo' style='float: left;
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
								<h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Academy LLC</span></h2>
							</div>
							<div class='main'>
								<p>Dear <b>".$parent_name.",</b></p>
								<p>Your kid <b> ".$student_name."'s </b> Registration is approval successfully.</p>
								<p>please pay regitration fees under Academy activities menu use 'Registration fees' options. </p>
								<p>now you can continue to select your kids activities in the 'active kids' menu.</p>
								<p><a href='".$login_url."'>Click here</a> to login</p>
								<h4>Thanks & Regards</h4>
								<h4 style='color: grey'>Psa admin team</h4>
								<hr>
								<p>Click here to visit our website:<a href='#'>www.primestaruae.com</a></p>
							</div>
							</div>
						</body>
						</html>";
		$mail->AltBody = "This is the plain text version of the email content";
		//echo "Mailer Error: " . $mail->ErrorInfo;
		if(!$mail->send()) 
		{
		    echo "Mailer Error: " . $mail->ErrorInfo;
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
		    echo 'success';
			return true;
		}
		die;
	}
	
	public function transaction_history()
	{
	    $id = $this->input->post('id');
	    $pid = $this->input->post('parent_id');
	    $qry = "select wt.*, p.parent_code, r.sid from wallet_transactions wt
	    left join parent p on p.parent_id= wt.parent_id
	    left join registrations r on r.id= wt.student_id
	    where wt.parent_id= $pid order by wt.created_at asc";
	    
	    $data = $this->db->query($qry)->result_array();
	    $output = '';
	    
	    foreach($data as $key => $value)
	    {
	        $output .="<tr>";
	        $output .="<td>";
	        $output .=$value['wallet_transaction_id'];
	        $output .="</td>";
	        
	        $output .="<td><span style='display:none;'>";
	        $output .= strtotime($value['created_at']);
	        $output .='</span>';
	        
	        $output .= date('d/m/Y H:i', strtotime($value['created_at']));
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['wallet_transaction_detail'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['parent_code'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['sid'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['gross_amount'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['discount_percentage'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['vat_percentage'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['vat_value'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['credit'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['debit'];
	        $output .="</td>";
	        
	        
	        $output .="</tr>";
	        
	    }
	    
	    echo $output;
	    
	}
	

}
