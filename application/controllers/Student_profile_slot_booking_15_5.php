<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Student_profile_slot_booking extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
  $this->load->model('Default_Model', 'default');
  $this->load->model('School_profile_report_Model', 'school');
  $this->load->model('Daily_Transaction_Model', 'transaction');
	
	
	}
	public function index()
	{
    $data['title'] = 'Student profile/ Slot Booking';
    $username=$this->session->userdata('username');
    $user_id = $this->session->userid;
    $parentDetails = $this->default->getParentDetail($username);
    $data['studentDetails'] = $this->default->getStudentByParent($parentDetails['parent_id']);
    $data['activityList'] = $this->school->getAllActivityList();
    $query = $this->db->query( "select * from activity_selections where `user_id` ='".$parentDetails['parent_id']."'");
    $selectedActivities = $query->result_array();
    foreach($selectedActivities as $key => $value){
      $selectedActivities[$key]['activity'] = ($value['activity_id'] != '')?$this->transaction->getActivityDetail($value['activity_id']):'--';
      $selectedActivities[$key]['level_id'] = ($value['level_id'] != '')?$this->default->getLevelDetail($value['level_id']):''; 
    }
    $data['selectedActivities'] = $selectedActivities;
		$this->load->view('student_profile_slot_booking', $data);
	}
  public function addActivity(){
    $data = $this->input->post();
    if ($data['activity_id'] == '') {
        $json['error']['activity_id'] = 'Please select activity';
    }
    if (empty($json['error']) ) {
      $username=$this->session->userdata('username');
      $user_id = $this->session->userid;
      $studentDetails = $this->default->getStudentDetails($data['sid']);
      $parentDetails = $this->default->getParentDetail($username);
      
      $data['sid'] = $studentDetails['sid'];
      $data['student_id'] = $studentDetails['id'];
      $data['student_name'] = $studentDetails['name'];
      $data['status'] = 'Inactive';
      $data['contract'] = 'Yes';
      $data['psa_id'] = 'PSA00'.$parentDetails['parent_id'];
      $data['parent_user_id'] = $parentDetails['parent_id'];
      $data['user_id'] = $parentDetails['parent_id'];
      $data['parent_name'] = $parentDetails['parent_name'];
      $data['parent_mobile'] = $parentDetails['mobile_no'];
      $data['parent_email_id'] = $parentDetails['email_id'];
      $data['approval_status'] = 'Pending';
      $data['updated_admin_id'] = $user_id;
      $this->db->insert('activity_selections', $data);
      $insert =  $this->db->insert_id();
      if(isset($insert)){
          $json['status'] = "success";
            $this->session->set_flashdata('success_msg', 'New activity created successfully');
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
      }
    }else{
          $this->output->set_header('Content-Type: application/json');
          echo json_encode($json);
    } 
    
  }
	
public function book($activity_id, $sid){ 
  $data['activity_id']=$activity_id;
  $data['sid']=$sid;
  $data['activityList'] = $this->school->getAllActivityList();
  $data['locationList'] = $this->school->getAllLocationList();
  $data['coachList'] = $this->transaction->getAllCoachList();
  
  $this->load->view('slot_booking_activity',$data);
}
public function view_calender(){ 
    if($this->input->post('submit')){
    $data['activity_id']=$this->input->post('activity_id');
    $data['location_id']=$this->input->post('location_id');
    $data['coach_id']=$this->input->post('coach_id');
    $data['hour']=$this->input->post('hour');
    $data['sid']=$this->input->post('sid');
    $slotQuery = $this->db->query('select * from slot_selections where hour ="'.$data['hour'].'" and game_id ="'.$data['activity_id'].'" and coach_id ="'.$data['coach_id'].'" and location_id ="'.$data['location_id'].'" ');
    $data['slot_selection'] = $slotQuery->result_array();
   $this->load->view('slot_booking_activity_calander',$data);
}

       }
public function add_slot_booking(){

    if($this->input->post('activity_id')){
     $location_id=$this->input->post('location_id');
     $hour=$this->input->post('hour');
     $coach_id=$this->input->post('coach_id');
     $activity_id=$this->input->post('activity_id');
     $slot_from_time=$this->input->post('slot_from_time');
     $slot_to_time=$this->input->post('slot_to_time');
     $dates=$this->input->post('dates');
     $sid=$this->input->post('sid');
     $from = $this->input->post('slot_from_time');
     $to = $this->input->post('slot_to_time');
     $activityselection_id = $this->input->post('activityselection_id');


     /*

   $this->db->where('email', $email);  
           
  $query1 = $this->db->get('users');
  $postData1=$query1->row_array();
  $user_name=$postData1['user_name'];
   $user_id=$postData1['user_id'];*/
   $email=$this->session->userdata('username');
   $user_id = $this->session->userid;
   $parentDetails = $this->default->getParentDetail($email);
   $studentDetails = $this->default->getStudentDetails($sid);

  /*$querys = $this->db->query('select * from parent where parent_id='.$user_id);
  $postDatas=$querys->row_array();
  $parent_id=$postDatas['parent_id'];
  $email_id=$postDatas['email_id'];
  $mobile_no=$postDatas['mobile_no'];

   $query3 = $this->db->query('select * from registrations where parent_user_id='.$parentDetails['parent_id']);
  $postData3=$query3->row_array();
  $student_id=$postData3['id'];*/

   $query4 = $this->db->query('select * from activity_selections where sid="'.$studentDetails['sid'].'" and `activity_id` = "'.$activity_id.'" ');
  $postData4=$query4->row_array();
  $level_id=$postData4['level_id'];
  $parent_id = $parentDetails['parent_id'];


  $query1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
  $postData1=$query1->row_array();
  if(empty($postData1)){
      $this->session->set_flashdata('error', 'Please add prepaid credit to book slot.');
  }else{
  $bal_credits=$postData1['amount_paid'];
  $fees=110;
  $balance_credits=$bal_credits-$fees;
  $amount=$fees;
  $status='Pending';
  $checkexists = $this->db->query('select * from booking_approvals where parent_id ="'.$parent_id.'" and  student_id ="'.$sid.'" and activity_id ="'.$activity_id.'" and level_id ="'.$level_id.'" and checkout_date ="'.$dates.'" ');
  print_r($checkexists); die;
  if (empty($checkexists->result_array())){
      $sql="Update  prepaid_credits set balance_credits='$balance_credits',total_credits='$balance_credits' where parent_id='$parent_id'";
      $insert=$this->db->query($sql);


      $query11 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
      $postData11=$query11->row_array();
      $bal_credits1=$postData11['balance_credits'];

      $ticket = $this->school->getLastEntry('booking_approvals');
      $ticket_no='SCR#0000'.$ticket;
      $created_at=date("Y-m-d H:i:s");

      $sql1="INSERT into booking_approvals(ticket_no,parent_id,parent_name,parent_mobile,parent_email,activityselection_id,student_id,activity_id,level_id,checkout_date,status,amount,wallet_amount,deducted_amount,wallet_balance,created_at,user_id,from_time,to_time) values('".$ticket_no."','".$parent_id."','".$parentDetails['parent_name']."','".$parentDetails['mobile_no']."','".$parentDetails['email_id']."','".$activityselection_id."','".$sid."','".$activity_id."','".$level_id."','".$dates."','".$status."','".$amount."','".$postData11['amount_paid']."','".$amount."','".$bal_credits1."','".$created_at."','".$user_id."','".$from."','".$to."')";
      $insert=$this->db->query($sql1);


      $sql22="INSERT into slot_booking_carts(user_id,start,end,checkout,status,created_at) values('".$user_id."','".$slot_from_time."','".$slot_to_time."','".$dates."','".$status."','".$created_at."')";
      $insert22=$this->db->query($sql22);

      if(isset($insert)){
      setMessage('My Cart Added Successfully.');  
      $json['status'] = 'success';  
      $this->session->set_flashdata('success_msg', 'New slot created successfully');
      echo json_encode($json);
      }
  }
}
    $this->load->view('slot_booking_activity_calander');
}
	}

  public function view($sid){
    $this->db->select('*');
    $this->db->where('id', $sid);
    $registrations = $this->db->get('registrations');
    $data = $registrations->result_array();
    $data['registrations'] = $data[0];
    $this->load->view('student/student_list.php',$data);
  }

  public function viewbooking($activity, $sid){
    $data['title'] = 'Slot Schedule Report';
    $postdate = $this->input->post('from_date');
    $acc_code = $this->input->post('acc_code');
    $id_val = $this->input->post('id_val');
    $from_date = date('Y-m-1');
    $to_date = date('Y-m-d');
    if(isset($postdate)){
      $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
      $to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
    }
    $where = "where `checkout_date` BETWEEN '".$from_date."' AND '".$to_date."' AND  `activity_id` = '".$activity."' AND `student_id` = '".$sid."' ";
    $bookingList = $this->db->query("select * from booking_approvals ".$where." order by `id` DESC ");
    $data['bookingList']=$bookingList->result_array();
    $data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
    $data['toDateVal'] = date('Y-m-d',strtotime($to_date));
    
    $this->load->view('slot/viewBooking.php',$data);
  }

  public function get_events(){
    $start =date('Y-m-d', ($this->input->get("start")));
    $end =date('Y-m-d', ($this->input->get("end")));
    $events = $this->db->query("select id, ticket_no as title, from_time as start, to_time as end from booking_approvals where `checkout_date` BETWEEN '".$start."' AND '".$end."' ");
    $getEvents=$events->result_array();
    /*foreach($getEvents as $r) { 

            $data_events = array(
                "id" => $r['id'],
                "title" => $r['ticket_no'],
                "description" => 'PS00'.$r['student_id'],
                "end" => '2021-05-16 15:00:00',
                "start" => '2021-05-16 17:00:00',
            );
        }*/

        echo json_encode($getEvents);
    
    die;
  }

}