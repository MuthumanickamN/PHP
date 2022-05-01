<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model', 'users');
        $this->load->model('Default_Model', 'default');
        $role = strtolower($this->session->userdata['role']);
        
    }    
    public function index() {
        $data['page'] = 'users-list';
        $data['title'] = 'Users';   
        $data['filter'] = 'all';
        if(isset($_GET['role']))
        {
            $data['filter'] = $_GET['role'];
        }
        $this->load->view('users/index', $data);
    }
    public function getUserListing(){
        $json = array();    
        $role = strtolower($this->input->post('filter'));
        $userid = $this->session->userid;
        $userrole = $this->session->role;
        
        $list = $this->users->getUserListbyRole($role, $userrole, $userid);
        $countAll = $this->users->countAll($role, $userrole, $userid);
        //$countFilter = $this->users->countFiltered($role, $userrole, $userid);
        
        $data = array();
        foreach ($list as $element) {
            $row = array();
            $row[] = '';
            $row[] = $element['code'];
            $row[] = $element['user_name'];
            $row[] = $element['email'];
            
            $row[] = ucfirst($element['role']);
            $row[] = $element['mobile'];
            $row[] = ($element['current_sign_in_at'] != '')?date('d-m-Y h:i A', strtotime($element['current_sign_in_at'])):'-';
            $row[] = $element['sign_in_count'];
            $row[] = ($element['last_sign_in_at'] != '')?date('d-m-Y h:i A', strtotime($element['last_sign_in_at'])):'-';
            if($element['status'] == 'Active'){
                $statusVal = "<label class='btn-success'>Active</label>";
            }else{
                $statusVal = "<label class='btn-danger'>Inactive</label>";
            }
            $row[] = $statusVal;
            $row[] = $element['user_id'];
            $data[] = $row;
        }
        $json['data'] = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countAll,
            "recordsFiltered" => $countAll,
            "data" => $data,
        );       
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json['data']);
    }    
    public function save() {
        $json = array();        
        $user_name = $this->input->post('user_name');        
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('encrypted_password');
        $confirm_password = $this->input->post('passwordconfirmation');
        $gender = $this->input->post('gender');
        $date_of_birth = $this->input->post('date_of_birth');
        $role = ucfirst($this->input->post('role'));
        $status = $this->input->post('status');  
		
        if(empty(trim($user_name))){
            $json['error']['user_name'] = 'Please enter name';
        }      

        if(empty(trim($email))){
            $json['error']['email'] = 'Please enter email address';
        }

        if ($this->users->validateEmail($email) == FALSE) {
            $json['error']['email'] = 'Please enter valid email address';
        }
        if(empty($role)){
            $json['error']['role'] = 'Please enter role';
        }
        if($this->users->validateMobile($mobile) == FALSE) {
            $json['error']['mobile'] = 'Please enter valid mobile no';
        }

        if($password != $confirm_password) {
            $json['error']['passwordconfirmation'] = 'Password Mismatch';
        }

        if(empty($status)){
            $json['error']['status'] = 'Please enter status';
        }

        if(empty($json['error'])){
            $this->users->setName($user_name);            
            $this->users->setEmail($email);
            $this->users->setMobile($mobile);
            $this->users->setEncryptedPassword($password);
            $this->users->setGender($gender);
            $this->users->setDateOfBirth($date_of_birth);
            $this->users->setRole($role);
            $this->users->setStatus($status);
            try {
                $checkMail = $this->default->checkexists('users','email',$email);
                if($checkMail == 0){
                
                
                    if(strtolower($role) == 'parent'){
                        
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
                        
                        $addParent=$this->db->query("INSERT into parent(parent_name,parent_code,email_id,mobile_no,date_time,status) values('".$user_name."','".$code."','".$email."','".$mobile."','".date("Y-m-d H:i:s")."','".$status."')");
                        $this->users->setCode($code);
                        $last_id = $this->users->createUser();
                        
                    }
                    
                    if(strtolower($role) == 'headcoach' || strtolower($role) == 'coach'){
                        $dob = date('Y-m-d',strtotime($date_of_birth));
                        $addUser=$this->db->query("INSERT into users(coach_name,dob,email_id,phone1,gender,role,status) values('".$user_name."','".$dob."','".$email."','".$mobile."','".$gender."','".ucfirst($role)."','".$status."')");
                    }
                    

                
            }else{
                $json['error']['error_msg'] = 'Mail id already exists';
                $this->session->set_flashdata('error', 'Mail id already exists');
              }

            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
                
            if (!empty($last_id) && $last_id > 0) {
                $userID = $last_id;
                $this->users->setUserID($userID);
                $userInfo = $this->users->getUser();                    
                $json['user_id'] = $userInfo['user_id'];
                $json['name'] = $userInfo['user_name'];                
                $json['email'] = $userInfo['email'];
                $json['role'] = $userInfo['role'];
                $json['mobile'] = $userInfo['mobile'];
                $json['ustatus'] = $userInfo['status'];
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }    
    public function edit() {
        $json = array();
        $userID = $this->input->post('user_id');
        $this->users->setUserID($userID);
        $json['userInfo'] = $this->users->getUser();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('users/popup/renderEdit', $json);
    }   
    public function update() {
        $json = array();        
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('user_name');        
        $email = $this->input->post('email');
        $role = ucfirst($this->input->post('role'));
        $mobile = $this->input->post('mobile');
        $status = $this->input->post('status');            
        $password = $this->input->post('encrypted_password');
        $confirm_password = $this->input->post('passwordconfirmation');
        $gender = $this->input->post('gender');
        $date_of_birth = $this->input->post('date_of_birth');         
            
        if(empty(trim($name))){
            $json['error']['name'] = 'Please enter name';
        }
        
        if(empty(trim($email))){
            $json['error']['email'] = 'Please enter email address';
        }

        if ($this->users->validateEmail($email) == FALSE) {
            $json['error']['email'] = 'Please enter valid email address';
        }

        $sql="select * from users where user_id !='$user_id' and email='$email'";
        if($this->db->query($sql)->num_rows() > 0)
        {
            $json['error']['email'] = 'Sorry, Email ID already Exists.';
        }

        if(empty($role)){
            $json['error']['role'] = 'Please enter role';
        }
        if($this->users->validateMobile($mobile) == FALSE) {
            $json['error']['mobile'] = 'Please enter valid mobile no';
        }

        if(empty($status)){
            $json['error']['status'] = 'Please enter status';
        }

        if($password != $confirm_password) {
            $json['error']['passwordconfirmation'] = 'Password Mismatch';
        }

        
        if(empty($json['error'])){

            
            $this->users->setUserID($user_id);
            $this->users->setName($name);
            $this->users->setEmail($email);
            $this->users->setRole($role);
            $this->users->setStatus($status);
            $this->users->setMobile($mobile);
            $this->users->setEncryptedPassword($password);
            $this->users->setGender($gender);
            $this->users->setDateOfBirth($date_of_birth);
            try {
                $last_id = $this->users->updateUser();
                if(strtolower($role) == 'parent')
                {
                    
                    $query = $this->db->query("SELECT parent_id FROM `parent` p
                    left join users u on u.code = p.parent_code
                    where u.user_id=$user_id");
                    $parent_id = $query->row()->parent_id;
                    
                    $userData = array(
                    'parent_name' => $name,
                    'email_id' => $email,
                    'mobile_no' => $mobile,
                    'status' => $status,
                    );
                    $this->db->where('parent_id', $parent_id);
                    $updateData = $this->db->update('parent', $userData);
                    
                    $userData2 = array(
                    'parent_name' => $name,
                    'parent_email_id' => $email,
                    'parent_mobile' => $mobile
                    );
                    $this->db->where('parent_user_id', $parent_id);
                    $this->db->update('registrations', $userData2);
                    
                    $userData3 = array(
                    'name_id' => $name,
                    'mobile_id' => $mobile
                    );
                    $this->db->where('parent_id', $parent_id);
                    $this->db->update('prepaid_credits', $userData3);
                    
                    $userData4 = array(
                    'parent_name' => $name,
                    'parent_mobile' => $mobile,
                    'parent_email_id' => $email
                    );
                    $this->db->where('parent_id', $parent_id);
                    $this->db->update('wallet_transactions', $userData4);
                    
                    $userData5 = array(
                    'parent_name' => $name,
                    'parent_mobile' => $mobile,
                    'parent_email' => $email
                    );
                    $this->db->where('parent_id', $parent_id);
                    $this->db->update('tmp_booking', $userData5);
                    
                    

                }
                if(strtolower($role) == 'headcoach' || strtolower($role) == 'coach'){
                    $userData = array(
                    'coach_name' => $name,
                    'email_id' => $email,
                    'phone1' => $mobile,
                    'dob' => date('Y-m-d',strtotime($date_of_birth)),
                    'status' => $status,
                    'gender' => $gender,
                    );
                    $this->db->where('email_id', $email);
                    $updateData = $this->db->update('coach', $userData);
                }

            
            
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
                
            if (!empty($user_id) && $user_id > 0) { 
                $this->users->setUserID($user_id);
                $userInfo = $this->users->getUser();                    
                $json['user_id'] = $userInfo['user_id'];
                $json['name'] = $userInfo['user_name'];
                $json['email'] = $userInfo['email'];
                $json['role'] = $userInfo['role'];
                $json['mobile'] = $userInfo['mobile'];
                $json['ustatus'] = $userInfo['status'];                   
                $json['status'] = 'success';
            }
            

        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }    
    public function display() {
        $json = array();
        $userID = $this->input->post('user_id');
        $this->users->setUserID($userID);
        $json['userInfo'] = $this->users->getUser();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('users/popup/renderDisplay', $json);
    }   
    public function delete() {
        $json = array();
        $userID = $this->input->post('user_id');        
        $this->users->setUserID($userID);
        $this->users->deleteUser();
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);        
    }
    public function changepassword(){
        $id=$this->input->post('id');
        //$old_password=$this->input->post('old_password');
        $new_password=$this->input->post('new_password');
        $confirm_password=$this->input->post('confirm_password');
        /*if(empty(trim($old_password))){
            $json['error']['old_password'] = 'Please enter old password';
        }*/
        if(empty(trim($new_password))){
            $json['error']['new_password'] = 'Please enter new password';
        }
        if(empty(trim($confirm_password))){
            $json['error']['confirm_password'] = 'Please enter confirm password';
        }
        $userDetails = $this->db->query('select * from users where `user_id` = "'.$id.'" ');
        $user = $userDetails->row_array();
        /*if($user['encrypted_password'] != $old_password){
            $json['error']['old_password'] = 'Old password does not match.';
        }*/
        if($new_password != $confirm_password){
            $json['error']['confirm_password'] = 'Confirm password should same as new password.';
        }

        if(empty($json['error'])){
            $logindata = array(
              'encrypted_password' => $new_password,
              'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->where('user_id', $id);
            $updatepwd = $this->db->update('users', $logindata);
            //echo $this->db->last_query();die;
            if($updatepwd){
                $json['status'] = 'success';
                $this->session->set_flashdata('success_msg', 'Password Updated successfully. ');
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
        
    }

    public function transaction_history()
	{
		//$id = $this->input->post('id');
	    $userid = $this->input->post('user_id');
        //if(strtolower($role) == 'parent')
        //{
            
        $query = $this->db->query("SELECT parent_id FROM `parent` p
        left join users u on u.code = p.parent_code
        where u.user_id=$userid");
        $parent_id = $query->row()->parent_id;
    
	    $qry = "select wt.*, p.parent_code, r.sid from wallet_transactions wt
	    left join parent p on p.parent_id= wt.parent_id
	    left join registrations r on r.id= wt.student_id
	    where wt.parent_id= $parent_id order by wt.created_at asc";
	    
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

            $output .="<td>";
	        $output .=$value['balance_credit'];
	        $output .="</td>";	        
	        
	        $output .="</tr>";
	        
	    }
 //   }
        
	    
	    echo $output;
	    
	}


}

?>