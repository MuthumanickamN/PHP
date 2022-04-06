<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Student extends CI_Controller {  
	public function __construct(){
		parent::__construct();
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
		$this->load->view('student_registration', $data);
	}
	public function list_(){
		$data['title'] = 'Student List';
		$role = strtolower($this->session->userdata['role']);
		$username=$this->session->userdata('username');
    	$parentDetails = $this->default->getParentDetail($username);
		if($role == 'parent'){
			$query = $this->db->query("select * from registrations where `parent_user_id` ='".$parentDetails['parent_id']."' order by `id` DESC ");
		}else{
			$query = $this->db->query("select * from registrations order by `id` DESC ");
		}
		$data['studentList'] = $query->result_array();
		$this->load->view('student_list',$data);
	}
	
	public function addStudent(){
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
		$user_id= $this->session->userid;
		$email=$this->session->userdata('username');
		$adminDetails=$this->session->userdata('user'); 
		$admin_name = $adminDetails[0]->user_name; 
		
		$role = 'student';

		$date_of_issue=$this->input->post('date_of_issue');
		$tshirt_size=$this->input->post('tshirt_size');
		$status=$this->input->post('status')!=''?$this->input->post('status'):'Inactive';
		$approval_status=$this->input->post('approval_status')!=''?$this->input->post('approval_status'):'Pending';

		if (empty($student_name)) {
            $json['error']['student_name'] = 'Please enter student name';
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
            $json['error']['father_email_id'] = 'Please enter father email id';
        }
        if (empty($mother_contact_no)) {
            $json['error']['mother_contact_no'] = 'Please enter mother contact no';
        }
        if (empty($mother_email_id)) {
            $json['error']['mother_email_id'] = 'Please enter mother email id';
        }
        if (empty($student_email_id)) {
            $json['error']['student_email_id'] = 'Please enter student email id';
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

				$sponsor_passport = isset($_FILES['sponsor_passport'])?$_FILES['sponsor_passport']['name']:'';
				$sponsor_visa_page = isset($_FILES['sponsor_visa_page'])?$_FILES['sponsor_visa_page']['name']:'';
				$student_passport_image = isset($_FILES['student_passport_image'])?$_FILES['student_passport_image']['name']:'';
				$sponsor_emirates_id = isset($_FILES['sponsor_emirates_id'])?$_FILES['sponsor_emirates_id']['name']:'';
				$student_emirates_id_image = isset($_FILES['student_emirates_id_image'])?$_FILES['student_emirates_id_image']['name']:'';
				$student_visa_page = isset($_FILES['student_visa_page'])?$_FILES['student_visa_page']['name']:'';
				$student_passport_size_image = isset($_FILES['student_passport_size_image'])?$_FILES['student_passport_size_image']['name']:'';
				

				$filepath="Student_images";
				$insert_id=$user_id;
				$test= ($sponsor_passport != '')?$this->file_upload($_FILES['sponsor_passport'],$filepath,$insert_id):'';
				$test1=($sponsor_visa_page != '')?$this->file_upload($_FILES['sponsor_visa_page'],$filepath,$insert_id) :'';
				$test2 = ($student_passport_image != '')?$this->file_upload($_FILES['student_passport_image'],$filepath,$insert_id):'';
				$test3=($sponsor_emirates_id != '')?$this->file_upload($_FILES['sponsor_emirates_id'],$filepath,$insert_id) :'';
				$test4=($student_emirates_id_image != '')?$this->file_upload($_FILES['student_emirates_id_image'],$filepath,$insert_id):'';
				$test5=($student_visa_page != '')?$this->file_upload($_FILES['student_visa_page'],$filepath,$insert_id):'';
				$test6=($student_passport_size_image != '')?$this->file_upload($_FILES['student_passport_size_image'],$filepath,$insert_id) :'';

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
					$sql="Update  registrations set name='$student_name',dob='$student_dob',age='$student_age',gender='$student_gender',father_name='$father_name',father_contact='$father_contact_no',mother_name='$mother_name',emergency_contact='$emergency_contact_no',image_file_name='$student_passport_image1',parent_mobile='$parent_mobile',parent_name='$parent_name',parent_email_id='$parent_email_id',parent_user_id='$parent_id',nationality='$nationality',country='$country',postal_code='$postal_code',state='$state',district='$district',city='$city',school_name='$school_name',sibling_name='$sibling_name',sibling_reg_no='$sibling_reg_no',father_email='$father_email_id',mother_email='$mother_email_id',mother_contact='$mother_contact_no',mother_office_contact='$mother_office_contact_no',student_email='$student_email_id',passport_id='$passport_id',address_1='$address1',address_2='$address2',emirates_id_issue='$date_of_issue',student_emid_file_name='$student_emirates_id_image1',t_shirt_size='$tshirt_size',student_passport_file_name='$student_passport_size_image1',student_visapage_file_name='$student_visa_page1',sponsor_passport_file_name='$sponsor_passport1',sponsor_visapage_file_name='$sponsor_visa_page1',sponsor_emid_file_name='$sponsor_emirates_id1',updated_at='$updated_at',updated_admin_id='$user_id',updated_admin_email='$email',status='$status',approval_status='$approval_status',role='$role',updated_admin_name='$admin_name'  where id='$id'";
					$update=$this->db->query($sql);
					if(isset($update)){
							$json['status'] = "success";
						 $this->output->set_header('Content-Type: application/json');
			        	echo json_encode($json);
					}
					$this->session->set_flashdata('success_msg', 'Student details updated successfully.');
				}else{
					$stud_id = $this->schools->getLastEntry('registrations');
					$sid = 'PS00'.$stud_id;

				    $sql="INSERT into registrations(name,dob,age,gender,father_name,father_contact,mother_name,emergency_contact,image_file_name,parent_mobile,parent_name,parent_email_id, parent_user_id, nationality,country,postal_code,state,district,city,school_name,sibling_name,sibling_reg_no,father_email,father_office_contact,mother_contact,mother_office_contact,mother_email,student_email,address_1,address_2,student_emid_file_name,emirates_id_issue,t_shirt_size,status,approval_status,student_passport_file_name,student_visapage_file_name,sponsor_passport_file_name,sponsor_visapage_file_name,sponsor_emid_file_name,emirates_id,passport_id,created_at, sid, role,updated_admin_id,updated_admin_email, updated_admin_name) values('".$student_name."','".$student_dob."','".$student_age."','".$student_gender."','".$father_name."','".$father_contact_no."','".$mother_name."','".$emergency_contact_no."','".$student_passport_image."','".$parent_mobile."','".$parent_name."','".$parent_email_id."','".$parent_id."','".$nationality."','".$country."','".$postal_code."','".$state."','".$district."','".$city."','".$school_name."','".$sibling_name."','".$sibling_reg_no."','".$father_email_id."','".$father_office_contact_no."','".$mother_contact_no."','".$mother_office_contact_no."','".$mother_email_id."','".$student_email_id."','".$address1."','".$address2."','".$student_emirates_id_image."','".$date_of_issue."','".$tshirt_size."','".$status."','".$approval_status."','".$student_passport_size_image."','".$student_visa_page."','".$sponsor_passport."','".$sponsor_visa_page."','".$sponsor_emirates_id."','".$student_emirates_id."','".$passport_id."','".$created_at."','".$sid."','".$role."','".$user_id."','".$email."','".$admin_name."')";
					$insert=$this->db->query($sql);
					if(isset($insert)){
							$json['status'] = "success";
						 $this->output->set_header('Content-Type: application/json');
			        	echo json_encode($json);
					}
					$this->session->set_flashdata('success_msg', 'New student added successfully.');
				}
			}else{
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
		$data['from'] = "approval";
		//echo "<pre>"; print_r($data); die;
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
	redirect(base_url().'index.php/student/list_');
}
public function view($id){
	$query = $this->db->query('select * from registrations where id='.$id);
	$data=$query->row_array();
	$activitylists = $this->db->query("select * from activity_selections where student_id=".$id); 
	$data['activitylists']=$activitylists->result_array();
	foreach ($data['activitylists'] as $key => $value) {
		$data['activitylists'][$key]['game'] = $this->transaction->getActivityDetail($value['activity_id']);
		$data['activitylists'][$key]['level'] = $this->default->getLevelDetail($value['level_id']);
	}
	$prepaidCredits = $this->db->query("select * from prepaid_credits where parent_id=".$data['parent_user_id']); 
	$data['balance']=$prepaidCredits->row()->balance_credits;
	
	$this->load->view('view_student_registration', $data);
}
  public function student_details(){
	$parent_mobile=$this->input->post('parent_mobile');
	$query=$this->db->query("select * from parent where mobile_no='".$parent_mobile."' and status='Active'");
	$row=$query->row_array();
	$data['parent_id']=$row['parent_id'];
	$data['parent_name']=$row['parent_name'];
	$data['email_id']=$row['email_id'];
	$data['opcode']=1;
	$this->load->view('student_registration_ajax', $data);	
}

function file_upload($FILES,$filepath,$insert_id)
{
		//echo '<pre>';print_r($FILES);exit;
	if(isset($FILES) && !empty($FILES)){
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
