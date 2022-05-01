<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Student_profile_slot_booking extends CI_Controller {  
      
    
	public function __construct()
	{
	    error_reporting(0);
	    parent::__construct();
        $this->load->model('Default_Model', 'default');
        $this->load->model('School_profile_report_Model', 'school');
        $this->load->model('Daily_Transaction_Model', 'transaction');
        $this->load->model('Invoice_Model', 'invoice_model');
	
	
	}
	public function index()
	{
    $data['title'] = 'Student profile/ Slot Booking';
    $username=$this->session->userdata('username');
    $user_id = $this->session->userid;
    $role = $this->session->userdata('role');
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
    $data['role'] = strtolower($role);
	$this->load->view('student_profile_slot_booking', $data);
	}
  public function addActivity(){
    $data = $this->input->post();
    unset($data["parent_id"]);
    if ($data['activity_id'] == '') {
        $json['error'] = 'Please select activity';
    }
    if (empty($json['error']) ) {
      //$username=$this->session->userdata('username');
      $user_id = $this->session->userid;
      $studentDetails = $this->default->getStudentDetails($data['sid']);
      //print_r($studentDetails);die;
      //$parentDetails = $this->default->getParentDetail($username);
      
      $query = $this->db->query( "select * from parent where `parent_id` ='".$data['registration_id']."'");
      $parentDetails = $query->row_array();
      
      $sql_c ="select * from activity_selections where activity_id='".$data['activity_id']."' and sid='".$studentDetails['sid']."'";
      //echo $sql_c;die;
      $query_c = $this->db->query($sql_c)->num_rows();
      
      
      
      $sql_c2 ="select * from games where game_id='".$data['activity_id']."'";
      $game_code = $this->db->query($sql_c2)->row()->game_code;
      
      if($query_c > 0)
      {
        $json['error'] = 'Sorry, Activity Already Added.';
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
      }
      else
      {
          
          $num_arr=explode("PS",$studentDetails['sid']);
          $new_num=(int)$num_arr[1];  
    	  $new_code_num=str_pad($new_num,3,'0',STR_PAD_LEFT);
    	  $code="PS".$game_code.$new_code_num;
          
      
          $data['sid'] = $studentDetails['sid'];
          $data['student_id'] = $studentDetails['id'];
          $data['student_name'] = $studentDetails['name'];
          $data['status'] = 'Inactive';
          $data['contract'] = 'No';
          $data['level_id'] = 1;
          $data['psa_id'] = $code;
          $data['parent_user_id'] = $parentDetails['parent_id'];
          $data['user_id'] = $parentDetails['parent_id'];
          $data['parent_name'] = $parentDetails['parent_name'];
          $data['parent_mobile'] = $parentDetails['mobile_no'];
          $data['parent_email_id'] = $parentDetails['email_id'];
          $data['approval_status'] = 'Pending';
          $data['updated_admin_id'] = $user_id;
          $data['created_at'] = date('Y-m-d H:i:s');
          $this->db->insert('activity_selections', $data);
          //echo $this->db->last_query();die;
          $insert =  $this->db->insert_id();
          if(isset($insert)){
              $json['status'] = "success";
                $this->session->set_flashdata('success_msg', 'New activity created successfully');
                $this->output->set_header('Content-Type: application/json');
                echo json_encode($json);
          }
      }
    }else{
          $this->output->set_header('Content-Type: application/json');
          echo json_encode($json);
    } 
    
  }
	
public function book($activity_id, $sid, $slot_id=0){ 
  $data['activity_id']=$activity_id;
  $data['slot_id']=$slot_id;
  $data['sid']=$sid;
  
  if($slot_id != 0)
  {
       $slotData = $this->db->query('select bs.hours,bs.location_id,bs.coach_id from booked_slots bs where id = "'.$slot_id.'" ')->row_array();
       $data['hours'] = $slotData['hours'];
       $data['location_id'] = $slotData['location_id'];
       $data['coach_id'] = $slotData['coach_id'];
  }
  $activityList = $this->db->query('select * from games where `game_id` = "'.$activity_id.'" ');
  $data['activityList'] = $activityList->result_array();

  $locationList = $this->db->query('select DISTINCT locations.location_id,locations.location from locations
                            INNER JOIN slot_selections ON locations.location_id=slot_selections.location_id  
                            where slot_selections.game_id = "'.$activity_id.'" and slot_selections.status="Active" order by locations.location_id ');
  $data['locationList'] = $locationList->result_array();

  $coachList = $this->db->query('select DISTINCT coach.coach_id,coach.coach_name from coach
                            INNER JOIN slot_selections ON coach.coach_id=slot_selections.coach_id  
                            where slot_selections.game_id = "'.$activity_id.'" and slot_selections.status="Active"  order by coach.coach_id ');
  $data['coachList'] = $coachList->result_array();
  
  $this->load->view('slot_booking_activity',$data);
}
public function view_calender(){ 
  $data['title'] = 'Slot Booking';
    if($this->input->post('submit')){
    $activity_id = $this->input->post('activity_id');
    $slot_id = $this->input->post('slot_id');
    $data['activity_id']=$activity_id;
    $data['slot_id']=$slot_id;
    $data['location_id']=$this->input->post('location_id');
    $data['coach_id']=$this->input->post('coach_id');
    $data['hour']=$this->input->post('hour');
    $sid=$this->input->post('sid');
    $data['sid'] = $sid;
    $studDetails = $this->default->getStudentDetails($data['sid']);
    $data['stud_name'] = $studDetails['name'];
    $data['activity_name'] = $this->transaction->getActivityDetail($activity_id);
   $data['parent_id'] = $studDetails['parent_user_id']; 
    $activityList = $this->db->query('select * from games where `game_id` = "'.$activity_id.'" ');
    $data['activityList'] = $activityList->result_array();

    $locationList = $this->db->query('select DISTINCT locations.location_id,locations.location from locations
                              INNER JOIN slot_selections ON locations.location_id=slot_selections.location_id  
                              where slot_selections.game_id = "'.$activity_id.'"  and slot_selections.status="Active" order by locations.location_id ');
    $data['locationList'] = $locationList->result_array();

    $coachList = $this->db->query('select DISTINCT coach.coach_id,coach.coach_name from coach
                              INNER JOIN slot_selections ON coach.coach_id=slot_selections.coach_id  
                              where slot_selections.game_id = "'.$activity_id.'"  and slot_selections.status="Active" order by coach.coach_id ');
    $data['coachList'] = $coachList->result_array();
    $data['contract']='No';
    $activitySelectionList = $this->db->query('select contract from activity_selections
                              where student_id = "'.$sid.'"  and activity_id="'.$activity_id.'" and status="Active" and approval_status="Approved" 
                              order by id desc limit 1 ');
    
    $data['contract'] = $activitySelectionList->row()->contract;
    
    $slotQuery = $this->db->query('select s.*,ssd.days from slot_selections s 
    left join slot_selections_days  ssd on ssd.slot_selections_id = s.id 
    where s.hour ="'.$data['hour'].'" and s.game_id ="'.$data['activity_id'].'" and s.coach_id ="'.$data['coach_id'].'" and s.location_id ="'.$data['location_id'].'" and s.status="Active"');
    $data['slot_selection'] = $slotQuery->result_array();
    
    //print_r($data['slot_selection']);die;
    $getRows = $this->db->query('SELECT * FROM `tmp_booking` where student_id ="'.$data['sid'].'" and activity_id ="'.$data['activity_id'].'"');
    $data['count'] =  $getRows->num_rows();
    $data['role'] = strtolower($this->session->userdata('role'));
   $this->load->view('slot_booking_activity_calander',$data);
}

}

public function set_form()
{
    $activity_id = $this->input->post('activity_id');
    $slot_id = $this->input->post('slot_id');
   
    $location_id=$this->input->post('location_id');
    $coach_id=$this->input->post('coach_id');
    $hour=$this->input->post('hour');
    $day=$this->input->post('clickDay');
    $date=$this->input->post('date');
    $sid=$this->input->post('sid');
    
    $weekdays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];          
    $day = $weekdays[$day];
              
    $slotQuery = $this->db->query('select s.*,ssd.days from slot_selections s 
    left join slot_selections_days  ssd on ssd.slot_selections_id = s.id 
    where s.hour ="'.$hour.'" and s.game_id ="'.$activity_id.'" and s.coach_id ="'.$coach_id.'" and s.location_id ="'.$location_id.'" and s.status="Active" and ssd.days="'.$day.'"');
    $slot_selection = $slotQuery->result_array();
    $output = '';
     foreach($slot_selection as $slot) { 
          $dayvalue = array_search($slot['days'],$weekdays);
          $slot_limit = $slot['slot_id'];
          $slot_from = $slot['slot_from_time'];
          $slot_to  = $slot['slot_to_time'];
          
            $c_count =  "select count(0) as cnt from booked_slots bs 
            left join booking_approvals as ba on ba.id=bs.booking_id
            where  ba.activity_id='$activity_id' and bs.booked_date= '$date' 
            and bs.from_time = '$slot_from' and bs.to_time='$slot_to' and bs.status=1" ;
            // and MONTH(bs.booked_date)=MONTH('$date') and YEAR(bs.booked_date)=YEAR('$date') 
            $cnt = $this->db->query($c_count)->row()->cnt;
            
            $c_count2 =  "select count(0) as cnt from tmp_booking  
            where  activity_id='$activity_id' and checkout_date = '$date'
            and from_time = '$slot_from' and to_time='$slot_to' " ;
            // and MONTH(checkout_date)=MONTH('$date') and YEAR(checkout_date)=YEAR('$date') 
            $cnt2 = $this->db->query($c_count2)->row()->cnt;
            
          $tot_cnt = $cnt + $cnt2 +1;
          //echo $slot_limit.' '.$tot_cnt;die;
          $output .= '<form id="addSlotSelection_'.$slot['id'].'" class="form-horizontal " name="form" method="POST" >
                <input type="hidden" name="dates" id="dates"  class="dates" >
                <input type="hidden" name="hour" id="hour" value="'.$hour.'">
                <input type="hidden" name="activity_id" id="activity_id" value="'.$activity_id.'">
                <input type="hidden" name="location_id" id="location_id"  value="'.$location_id.'">
                <input type="hidden" name="coach_id" id="coach_id" value="'.$coach_id.'">
                <input type="hidden" name="sid" id="sid" value="'.$sid.'">
                <input type="hidden" name="lane_id" id="lane_id" value="'.$slot['lane_court_id'].'">
                <input type="hidden" name="day_val" id="day_val" value="'.array_search($slot['days'],$weekdays).'">
        <tr class="daysDiv showDays_'.$dayvalue.'">       
        <td style="text-align: center;">'.$slot['slot_from_time'].'-'.$slot['slot_to_time'].'</td>
        <td style="text-align: center;"> ';
        
        if($slot_id == 0) { 
            
            if($tot_cnt <= $slot_limit)
            {
                $output .= " <button  type='button' name='submit'
                data-activity_id='".$activity_id."' 
                data-location_id='".$location_id."' 
                data-coach_id='".$coach_id."' 
                data-lane_id='".$slot['lane_court_id']."' 
                data-slot_from_time='".$slot['slot_from_time']."' 
                data-slot_to_time='".$slot['slot_to_time']."' 
                data-dates='' 
                data-hour='$hour' 
                data-sid='".$sid."' 
                data-activityselection_id='".$slot['id']."' 
                data-slot_id='".$slot['id']."' 
                onClick='addSlot(this)'
                class='btn btn-success form_date addSlot' > ADD TO CART</button>";
            }
            else
            {
                $output .= " <button  type='button' name='submit'
                data-activity_id='".$activity_id."' 
                data-location_id='".$location_id."' 
                data-coach_id='".$coach_id."' 
                data-lane_id='".$slot['lane_court_id']."' 
                data-slot_from_time='".$slot['slot_from_time']."' 
                data-slot_to_time='".$slot['slot_to_time']."' 
                data-dates='' 
                data-hour='$hour' 
                data-sid='".$sid."' 
                data-activityselection_id='".$slot['id']."' 
                data-slot_id='".$slot['id']."' 
                onClick='addSlot(this)'
                class='btn btn-danger form_date addSlot' disabled> ADD TO CART</button>";
                
            }
         }else { 
        
        $output .= " <button  type='button' name='submit'
                data-activity_id='".$activity_id."' 
                data-location_id='".$location_id."' 
                data-coach_id='".$coach_id."' 
                data-lane_id='".$slot['lane_court_id']."' 
                data-slot_from_time='".$slot['slot_from_time']."' 
                data-slot_to_time='".$slot['slot_to_time']."' 
                data-dates='' 
                data-hour='$hour' 
                data-sid='".$sid."' 
                data-activityselection_id='".$slot['id']."' 
                data-slot_id='".$slot['id']."' 
                data-slotid='".$slot_id."' 
                onClick='swapSlot(this)'
                class='btn btn-warning form_date swapSlot' > Confirm to Swap</button>";
                
       } 
      $output .= '   </td>
        <input type="hidden" name="slot_from_time" id="slot_from_time" value="'.$slot['slot_from_time'].'">
        <input type="hidden" name="slot_to_time" id="slot_to_time" value="'.$slot['slot_to_time'].'">
        <input type="hidden" name="activityselection_id" id="activityselection_id" value="'.$slot['id'].'">
        <input type="hidden" name="hid_slot_id" id="hid_slot_id" value="'.$slot_id.'">
      </tr>
      </form>';
      }
      
      echo $output;die;

}

public function swap_slot_booking()
{
   
    
     $location_id=$this->input->post('location_id');
     $hour=$this->input->post('hour');
     $coach_id=$this->input->post('coach_id');
     $activity_id=$this->input->post('activity_id');
     $date=$this->input->post('dates');
     $sid=$this->input->post('sid');
     $slot_from_time=$this->input->post('slot_from_time');
     $slot_to_time=$this->input->post('slot_to_time');
     $activityselection_id = $this->input->post('activityselection_id');
     $slot_id = $this->input->post('hid_slot_id');
     
    $ticket = $this->school->getLastEntry('booked_slots');
    $new_num=(int)$ticket;  
    $new_code_num=str_pad(++$new_num,4,'0',STR_PAD_LEFT);
    $ticket_no='BKNO-'.$new_code_num;
    $created_at=date("Y-m-d H:i:s");
    $no_of_slots=1;
    
    $query1 = "select * from booked_slots where id='$slot_id'";
    $row1 = $this->db->query($query1)->row_array();
    
    $insertarr1 = array(
        'booking_id' => $row1['booking_id'],
        'location_id' => $row1['location_id'],
        'coach_id' => $row1['coach_id'],
        'lane_court_id' => $row1['lane_court_id'],
        'booking_no' => $ticket_no,
        'booked_date' => $date,
        'hours' => $hour,
        'from_time' => $slot_from_time,
        'to_time' => $slot_to_time,
        'amount' => $row1['amount'],
        'payable_amount' => $row1['payable_amount'],
        'deducted_amount' => $row1['deducted_amount'],
        'approval_status' => 'Approved',
        'vat_perc' => $row1['vat_perc'],
        'vat_amount' => $row1['vat_amount'],
        );
    $this->db->insert('booked_slots', $insertarr1);
    $insert_id = $this->db->insert_id();
   
    $this->db->query("update booked_slots set status=0, info='Swapped',swapped_slot_id='$insert_id' where id='$slot_id'");
    //$this->session->set_flashdata('success_msg', 'Slot Swapped successfully');
    echo 'student_profile_slot_booking/swap_slot_list/'.$activity_id.'/'.$sid.'/'.$sid;  
     
}
public function add_slot_booking(){
    //echo $this->input->post('activity_id');die;
    if($this->input->post('activity_id')){
     $location_id=$this->input->post('location_id');
     $hour=$this->input->post('hour');
     $coach_id=$this->input->post('coach_id');
     $lane_id=$this->input->post('lane_id');
     $activity_id=$this->input->post('activity_id');
     $slot_from_time=$this->input->post('slot_from_time');
     $slot_to_time=$this->input->post('slot_to_time');
     $dates=$this->input->post('dates');
     $sid=$this->input->post('sid');
     $from = $this->input->post('slot_from_time');
     $to = $this->input->post('slot_to_time');
     $activityselection_id = $this->input->post('activityselection_id');

   $email=$this->session->userdata('username');
   $user_id = $this->session->userid;
   
   $studentDetails = $this->default->getStudentDetails($sid);
   
   $query4 = $this->db->query('select a_s.*,ds.discount_name, COALESCE(ds.discount_percentage,0.00) from activity_selections a_s 
   left join discount_setups ds on ds.id= a_s.discount_type
   where a_s.sid="'.$studentDetails['sid'].'" and a_s.`activity_id` = "'.$activity_id.'" 
   and a_s.status="Active" and a_s.approval_status="Approved" 
   order by a_s.id desc limit 1');
   
  $postData4=$query4->row_array();
  $level_id=$postData4['level_id'];
  if($level_id == ''){$level_id=1;}
  $discount_name=$postData4['discount_name'];
  $discount_percentage=$postData4['discount_percentage'];
  $discount_applicable=$postData4['discount_applicable'];
  $discount_val = 0.00;
  //$parent_id = $parentDetails['parent_id'];
  $parent_id = $studentDetails['parent_user_id'];
  $parentDetails = $this->default->getParentDetailById($parent_id);
  
  $query1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
  $postData1=$query1->row_array();
  if(empty($postData1)){
      $json['status'] = 'error';  
      echo json_encode($json);
      $this->session->set_flashdata('error', 'Please add prepaid credit to book slot.');
  }else{
    
   $c_count =  "select count(0) as cnt from booked_slots bs 
    left join booking_approvals as ba on ba.id=bs.booking_id
    where ba.student_id='$sid' and ba.activity_id='$activity_id' and MONTH(bs.booked_date)=MONTH('$dates') and YEAR(bs.booked_date)=YEAR('$dates') and bs.status=1" ;
   $cnt = $this->db->query($c_count)->row()->cnt;
   
   $c_count2 =  "select count(0) as cnt from tmp_booking  
    where student_id='$sid' and activity_id='$activity_id' and MONTH(checkout_date)=MONTH('$dates') and YEAR(checkout_date)=YEAR('$dates') " ;
   $cnt2 = $this->db->query($c_count2)->row()->cnt;
  
   $tot_cnt = $cnt + $cnt2 + 1;
    
   $s_fee = "select s.fees from fee_package_setups f 
    left join slot_class_registrations s on s.fee_package_setups_id=f.fee_package_setups_id
    where f.game_id='$activity_id' and f.level_id='$level_id' and f.hour='$hour' and s.slot_classes_min <= $tot_cnt and s.slot_classes_max >= $tot_cnt order by s.slot_classes_max asc limit 1 ";
    $f_query = $this->db->query($s_fee);
    //echo $s_fee;die;
    if($f_query->num_rows() > 0)
    {
        $fees_price= sprintf("%2f",$f_query->row()->fees);
        if($discount_applicable == "Yes")
        {
            if($discount_percentage > 0)
            {
                $discount_val = ($fees_price *  $discount_percentage)/100;
                $fees = sprintf("%2f", $fees_price - $discount_val);
            }
            else
            {
                $fees = $fees_price;
            }
        }
        else
        {
            $fees = $fees_price;
        }
    }
    else
    {
       $fees=100.00;  
    }
        $sql_as = "select * from activity_selections where student_id=$sid and activity_id=$activity_id";
        $query_as = $this->db->query($sql_as);
        if($query_as->num_rows() > 0)
        {
            $as_id = $query_as->row()->id; 
            $as_sql="SELECT * FROM contract_details where activity_selection_id='$as_id' and status=1 and active_contract=1";
            //echo $as_sql;die;
            $as_row = $this->db->query($as_sql);
            $as_rows = $as_row->num_rows();
            if($as_rows > 0)
            {
                $fees=1.00;
    
            }
        }
        
    //echo $fees_price.' '.$fees;die;
    $status='Pending';
    $checkexists = $this->db->query('select * from tmp_booking where parent_id ="'.$parent_id.'" and  student_id ="'.$sid.'" and activity_id ="'.$activity_id.'" and level_id ="'.$level_id.'" and checkout_date ="'.$dates.'"  and from_time="'.$from.'" and to_time="'.$to.'"');
    if (empty($checkexists->result_array())){
          $getRowsCount = $this->db->query('SELECT * FROM `tmp_booking`');
          $count =  $getRowsCount->num_rows();
          $ticket = $this->school->getLastEntry('booking_approvals');
          $ticketVal = $ticket + $count;
          $ticket_no='BKNO-000'.$ticketVal;
          $created_at=date("Y-m-d H:i:s");
          
          $sql1="INSERT into tmp_booking(ticket_no,parent_id,parent_name,parent_mobile,parent_email,activityselection_id,student_id,activity_id,level_id,checkout_date,status,amount,created_at,user_id,from_time,to_time,discount,discount_percentage, location_id,coach_id,hours,lane_court_id) values('".$ticket_no."','".$parent_id."','".$parentDetails['parent_name']."','".$parentDetails['mobile_no']."','".$parentDetails['email_id']."','".$activityselection_id."','".$sid."','".$activity_id."','".$level_id."','".$dates."','".$status."','".$fees."','".$created_at."','".$user_id."','".$from."','".$to."','".$discount_val."','".$discount_percentage."','".$location_id."','".$coach_id."','".$hour."','".$lane_id."')";
          $insert=$this->db->query($sql1);
          
          $sql2="UPDATE tmp_booking set amount='".$fees."' where student_id='$sid' and activity_id='$activity_id' and MONTH(checkout_date)=MONTH('$dates') and YEAR(checkout_date)=YEAR('$dates')";
          $update=$this->db->query($sql2);
          
          if(isset($insert)){
            $getRows = $this->db->query('SELECT * FROM `tmp_booking` where student_id ="'.$sid.'" and activity_id ="'.$activity_id.'" ');
            $json['count'] =  $getRows->num_rows();
          //setMessage('My Cart Added Successfully.');  
          $json['status'] = 'success';  
          //$this->session->set_flashdata('success_msg', 'New slot created successfully');
          echo json_encode($json);
          }
    }else{
      $json['status'] = 'error';  
        $this->session->set_flashdata('error', 'You have already booked a slot on selected date.');
        echo json_encode($json);
    }
  }
  }else{
    $this->load->view('slot_booking_activity_calander');
  }

	}
  public function getCartDetails($sid, $activity_id, $parent_id){
    $this->db->select('bk.id,bk.student_id,bk.ticket_no, bk.checkout_date,  bk.activity_id, bk.level_id, bk.from_time, bk.to_time, slot.coach_id, slot.lane_court_id, slot.location_id,bk.amount, slot.hour');
    $this->db->from('tmp_booking bk');
    $this->db->join('slot_selections slot', 'slot.id = bk.activityselection_id','left');
    $this->db->where('bk.activity_id',$activity_id);
    $this->db->where('bk.student_id',$sid);
    $this->db->order_by('bk.checkout_date','ASC');
    //echo $this->db->last_query();
    $query = $this->db->get();
    $data['cartList']=$query->result_array();
    $data['total'] = 0;
    /*$getRows = $this->db->query('SELECT * FROM `tmp_booking`');
    $data['count'] =  $getRows->num_rows();*/
    foreach ($data['cartList'] as $key => $value) {
      $data['cartList'][$key]['activity'] = $this->transaction->getActivityDetail($value['activity_id']);
      $data['cartList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
      $data['cartList'][$key]['level_id'] = $this->default->getLevelDetail($value['level_id']);
      $data['cartList'][$key]['lane_court_id'] = $this->default->getLaneDetail($value['lane_court_id']);
      $data['cartList'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
      $data['total'] += $value['amount'];
    }
    $data['opcode']=1;
    $data['parent_id']=$parent_id;
    $data['total'] = sprintf("%.2f",$data['total']);
    $this->load->view('myCart', $data);  
  }

  public function deletetmp($id){
      $getRows = $this->db->query('SELECT * FROM `tmp_booking` where `id`='.$id);
      $getRowsDetails =  $getRows->row_array();
      $sid= $getRowsDetails['student_id'];
      $activity_id= $getRowsDetails['activity_id'];
      $parent_id= $getRowsDetails['parent_id'];
      $dates= $getRowsDetails['checkout_date'];
      $hour= $getRowsDetails['hours'];
      
      $query4 = $this->db->query('select a_s.*,ds.discount_name, COALESCE(ds.discount_percentage,0.00) from activity_selections a_s 
       left join discount_setups ds on ds.id= a_s.discount_type
       where a_s.student_id="'.$sid.'" and a_s.`activity_id` = "'.$activity_id.'" 
       and a_s.status="Active" and a_s.approval_status="Approved" 
       order by a_s.id desc limit 1');
      
      $postData4=$query4->row_array();
      $level_id=$postData4['level_id'];
      if($level_id == ''){$level_id=1;}
      $discount_name=$postData4['discount_name'];
      $discount_percentage=$postData4['discount_percentage'];
      $discount_applicable=$postData4['discount_applicable'];
      $discount_val = 0.00;
      
      $sql="Delete from tmp_booking  where id='$id'";
      $delete=$this->db->query($sql);
      if(isset($delete)){
          
            $c_count =  "select count(0) as cnt from booked_slots bs 
                left join booking_approvals as ba on ba.id=bs.booking_id
                where ba.student_id='$sid' and ba.activity_id='$activity_id' and MONTH(bs.booked_date)=MONTH('$dates') and YEAR(bs.booked_date)=YEAR('$dates') and bs.status=1" ;
           $cnt = $this->db->query($c_count)->row()->cnt;
           
           $c_count2 =  "select count(0) as cnt from tmp_booking  
            where student_id='$sid' and activity_id='$activity_id' and MONTH(checkout_date)=MONTH('$dates') and YEAR(checkout_date)=YEAR('$dates') " ;
           $cnt2 = $this->db->query($c_count2)->row()->cnt;
          
           $tot_cnt = $cnt + $cnt2;
            
           $s_fee = "select s.fees from fee_package_setups f 
            left join slot_class_registrations s on s.fee_package_setups_id=f.fee_package_setups_id
            where f.game_id='$activity_id' and f.level_id='$level_id' and f.hour='$hour' and s.slot_classes_min <= $tot_cnt and s.slot_classes_max >= $tot_cnt order by s.slot_classes_max asc limit 1 ";
            $f_query = $this->db->query($s_fee);
            //echo $s_fee;die;
            if($f_query->num_rows() > 0)
            {
                $fees_price= sprintf("%2f",$f_query->row()->fees);
                if($discount_applicable == "Yes")
                {
                    if($discount_percentage > 0)
                    {
                        $discount_val = ($fees_price *  $discount_percentage)/100;
                        $fees = sprintf("%2f", $fees_price - $discount_val);
                    }
                    else
                    {
                        $fees = $fees_price;
                    }
                }
                else
                {
                    $fees = $fees_price;
                }
            }
            else
            {
               $fees=100.00;  
            }
            
            $sql_as = "select * from activity_selections where student_id=$sid and activity_id=$activity_id";
            $query_as = $this->db->query($sql_as);
            if($query_as->num_rows() > 0)
            {
                $as_id = $query_as->row()->id; 
                $as_sql="SELECT * FROM contract_details where activity_selection_id='$as_id' and status=1 and active_contract=1";
                //echo $as_sql;die;
                $as_row = $this->db->query($as_sql);
                $as_rows = $as_row->num_rows();
                if($as_rows > 0)
                {
                    $fees=1.00;
        
                }
            }
            
            $sql2="UPDATE tmp_booking set amount='".$fees."' where student_id='$sid' and activity_id='$activity_id' and MONTH(checkout_date)=MONTH('$dates') and YEAR(checkout_date)=YEAR('$dates')";
            $update=$this->db->query($sql2);
            
          $json['status'] = 'success';  
          return $this->getCartDetails($sid, $activity_id, $parent_id);
      }
      
  }
   public function checkout(){
      
      $sid=$this->input->post('sid');
      $activity_id=$this->input->post('activity_id');
      $total_amount=$this->input->post('total_amount');
      $vat_percentage=$this->input->post('vat_percentage');
      $payable_amount_chk=$this->input->post('payable_amount_chk');
      $payable_amount=$this->input->post('payable_amount');
      $cartList = $this->db->query('SELECT * FROM `tmp_booking` where `student_id` ="'.$sid.'" and `activity_id` ="'.$activity_id.'" ');
      $cartListArray =  $cartList->result_array();
      
      $activityList = $this->db->query('SELECT * FROM `activity_selections` where `student_id` ="'.$sid.'" and `activity_id` ="'.$activity_id.'" order by id desc limit 1 ');
      $activityListArray =  $activityList->row();
      $activity_discount = $activityListArray->discount_applicable;
      $activity_discount_perc = $activityListArray->discount_percentage;
      $discount_value = 0.00;
      $slot_count =  $cartList->num_rows();
      $parent_id = $cartListArray[0]['parent_id'];
      
      $list_arr = array();
     
      $booking_id = '';
      if(isset($cartListArray) && !empty($cartListArray)){
        $tot_vat_amount = 0.00;
        $tot_ded_amount = 0.00;
        $approval_status = 'Approved';
        
        foreach ($cartListArray as $key => $value) {
            
            $discount_value += $value['discount'];
            if($key == 0)
            {
            $data = array();
            $data['parent_id'] = $value['parent_id'];
            
            $data['activityselection_id'] = $value['activityselection_id'];
            $data['student_id'] = $sid;
            $data['activity_id'] = $activity_id;
            $data['psa_id'] = $value['psa_id'];
            $data['level_id'] = $value['level_id'];
            
            $data['vat_perc'] =  $vat_percentage;
            
            $ticket = $this->school->getLastEntry('booking_approvals');
            $new_num=(int)$ticket;  
		    $new_code_num=str_pad(++$new_num,4,'0',STR_PAD_LEFT);
            $data['ticket_no']='BKNO-'.$new_code_num;
            $data['created_at']=date("Y-m-d H:i:s");
            $data['no_of_slots']=$slot_count;
            $data['created_by']=$this->session->userid;
            
            $insertBooking = $this->db->insert('booking_approvals', $data); 
            $booking_id = $this->db->insert_id();
            }
            
            if($payable_amount_chk==1)
            {
                $amount = sprintf("%2f",$payable_amount/$slot_count);
                $status = "Pending";
            }
            else
            {
                $amount = $value['amount'];
                $status = "Approved";
            }
            
            $vat_val1 =  sprintf("%2f",($amount*$vat_percentage)/100);
            $tot_amount = $amount + $vat_val1;
            
            $ticket2 = $this->school->getLastEntry('booked_slots');
            $new_num2=(int)$ticket2;  
            $new_code_num2=str_pad(++$new_num2,4,'0',STR_PAD_LEFT);
            $ticket_no2='BKNO-'.$new_code_num2;
            
            $data2= array(
                'booking_id' => $booking_id,
                'booking_no' => $ticket_no2,
                'booked_date' => $value['checkout_date'],
                'from_time' => $value['from_time'],
                'to_time' => $value['to_time'],
                'amount' => $value['amount'],
                'payable_amount' => $amount,
                'vat_perc' => $vat_percentage,
                'vat_amount' => $vat_val1,
                'deducted_amount' => $tot_amount,
                'approval_status' => $approval_status,
                'hours' => $value['hours'],
                'location_id' => $value['location_id'],
                'coach_id' => $value['coach_id'],
                'lane_court_id' => $value['lane_court_id'],
                'discount_perc' => $value['discount_percentage'],
                'discount_val' => $value['discount']
                );
            array_push($list_arr, $data2);
            $this->db->insert('booked_slots',$data2);
            $tot_vat_amount += $vat_val1;
            $tot_ded_amount += sprintf("%2f",$tot_amount);
            $tot_amount_wov += sprintf("%2f",$amount);
           }
            
            $creditsDetails1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
            $creditsDetailsData1 = $creditsDetails1->row_array();
            $wallet_amount = $creditsDetailsData1['balance_credits'];
            
            $balance_credits = sprintf("%2f",$wallet_amount - $tot_ded_amount);
           
            
            $update_arr = array(
                'amount'=> $tot_amount_wov,
                'payable_amount'=> $tot_ded_amount,
                'vat_amount'=> $tot_vat_amount,
                'wallet_amount'=> $wallet_amount,
                'checkout_status'=> 'Paid',
                'net_payable_amount_approval'=>  $approval_status,
                'payable_status'=>  $payable_amount_chk,
                'wallet_balance'=>  $balance_credits,
                'status' => $status
               
            );
            $this->db->where('id',$booking_id);
            $this->db->update('booking_approvals', $update_arr);
            
            $this->db->query('DELETE FROM `tmp_booking` where `student_id` ="'.$sid.'" and `activity_id` ="'.$activity_id.'" ');
            
            
            
            $update2=array(
                'balance_credits' => $balance_credits,
                'total_credits' => $balance_credits,
            );
            
            $this->db->where('parent_id',$parent_id);
            $this->db->update('prepaid_credits', $update2);
            
            
            
              $txn_id = $this->school->getLastEntry('wallet_transactions');
              $wallet_transaction_id = 'WTXNO-'.$txn_id;
    
              $inv_id = $this->default->getInvoiceId('wallet_transactions');
              $invoice_id = 'PS'.date('Y').'-'.$inv_id;
             $sqlp="SELECT p.parent_code, p.parent_name, p.mobile_no,p.email_id FROM `parent` p 
            where p.parent_id=$parent_id";
            $resultp = $this->db->query($sqlp)->row_array();
            if($activity_discount == "Yes")
            {
                
              $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'ac_code' => 'SBWT',
                'discount_percentage' => $activity_discount_perc,
                'discount_value' => $discount_value,
                'wallet_transaction_date' =>date('Y-m-d'),
                'wallet_transaction_type' =>'Debit',
                'wallet_transaction_detail' => 'Slot Booking Fees Discount',
                'updated_admin_id' => $parent_id,
                'reg_id' => $sid,
                'wallet_transaction_amount' => $tot_ded_amount,
                'gross_amount' => $tot_amount_wov+$discount_value,
                'vat_percentage' => $vat_percentage,
                'vat_value' => $tot_vat_amount,
                'net_amount' => $tot_ded_amount,
                'debit' => $tot_ded_amount,
                'invoice' => 'yes',
                'invoice_id' =>$invoice_id,
                'slot_booking'=>$booking_id,
                'student_id'=> $sid,
                'parent_id'=> $parent_id,
				'balance_credit'=>$balance_credits,
                'parent_name'=> $resultp['parent_name'],
                'parent_mobile'=> $resultp['mobile_no'],
                'parent_email_id'=> $resultp['email_id'],
                'description'=> 'Slot Booking Fees Discount',
                'created_at' => date('Y-m-d H:i:s')
            );
            }
            else
            {
                $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'ac_code' => 'SBWT',
                'wallet_transaction_date' =>date('Y-m-d'),
                'wallet_transaction_type' =>'Debit',
                'wallet_transaction_detail' => 'Slot Booking Fees',
                'updated_admin_id' => $parent_id,
                'reg_id' => $sid,
                'wallet_transaction_amount' => $tot_ded_amount,
                'gross_amount' => $tot_amount_wov,
                'vat_percentage' => $vat_percentage,
                'vat_value' => $tot_vat_amount,
                'net_amount' => $tot_ded_amount,
                'debit' => $tot_ded_amount,
                'invoice' => 'yes',
                'invoice_id' =>$invoice_id,
                'slot_booking'=>$booking_id,
                'student_id'=> $sid,
                'parent_id'=> $parent_id,
				'balance_credit'=>$balance_credits,
                'parent_name'=> $resultp['parent_name'],
                'parent_mobile'=> $resultp['mobile_no'],
                'parent_email_id'=> $resultp['email_id'],
                'description'=> 'Slot Booking Fees',
                'created_at' => date('Y-m-d H:i:s')
            );
            
            }
            $checkexists = $this->db->query('select id from wallet_transactions where slot_booking ="'.$booking_id.'" and  ac_code ="SBWT" and wallet_transaction_type = "Debit"  ');
            $checkexistsArr = $checkexists->row_array();
            if (empty($checkexistsArr)){
              $this->db->insert('wallet_transactions', $walletArray); 
              $wallet_transaction_id = $this->db->insert_id();
            }else{
              $this->db->where('id', $checkexistsArr['id']);
              $this->db->update('wallet_transactions', $walletArray); 
              $wallet_transaction_id = $checkexistsArr['id'];
            }
            
            
            $sql2="select p.parent_name, r.name as student_name,p.email_id as parent_email from booking_approvals ba 
            left join parent p on p.parent_id = ba.parent_id
            left join registrations r on r.id = ba.student_id
            where ba.id= '$booking_id'";
            $email_details = $this->db->query($sql2)->row_array();
            
            if($status == "Pending"){
            $this->send_email_booked_for_approval($booking_id, $walletArray,  $resultp['parent_code'], $wallet_amount, $balance_credits, $email_details);
            $this->session->set_flashdata('success_msg', 'Your Slot(s) Booking Requested successfully. It is under Approval/Reject process');
            }
            else
            {
                $this->send_email_booked_direct($booking_id, $walletArray,  $resultp['parent_code'], $wallet_amount, $balance_credits);
                $this->session->set_flashdata('success_msg', 'Your Slot(s) Booking Request Approved successfully');
            }
            $this->invoice_model->send_email_invoice($wallet_transaction_id, "SlotBookingFees");
            $json['status'] = 'success';  
            
            echo json_encode($json);
        }
        
    else{
        $json['status'] = 'error';  
        $this->session->set_flashdata('error', 'Please book a slot. ');
        echo json_encode($json);
    }
  }
    
    public function send_email_booked_direct($booking_id,$wallet_data_array, $parent_code, $wallet_amount, $balance_credits)
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
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($wallet_data_array['parent_email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Slots Booked";
		
		$body = '';
		$body .= "<!DOCTYPE>
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
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
        <p>We are pleased to inform you that your slot booking for your kid ".$email_data_array['parent_name']." is successful.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Level</th>
                <th>Time</th>
                <th>Lane/Court</th>
                <th>Coach</th>
            </tr>";
            $sql ="select bs.booking_no,bs.booked_date, g.game,l.location,c.coach_name,lv.level,bs.from_time,bs.to_time,
            lc.lane_court
            from booking_approvals ba 
            left join booked_slots bs on bs.booking_id=ba.id
           left join games g on ba.activity_id=g.game_id
           left join locations l on l.location_id=bs.location_id
           left join game_levels lv on ba.level_id=lv.games_level_id
           left join lane_courts lc on bs.lane_court_id=lc.id
           left join coach c on bs.coach_id=c.coach_id
            where ba.id='$booking_id' and bs.status=1
            ";
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['level']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['lane_court']."</td>
                <td>".$value['coach_name']."</td>
                
            </tr>";
        }
         $body .= "</table>
        <p>Your Wallet details as follows</p>
        <p style='text-align: right;'>Transaction ID :<b>".$wallet_data_array['wallet_transaction_id']."</b></p>
         <table>
            <tr>
                <th>Parent-Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Previous balance(AED)</th>
                <th>Detected amount(AED)</th>
                <th>Total balance(AED)</th>
            </tr>
            <tr>
                <td>".$parent_code."</td>
                <td>".$wallet_data_array['parent_name']."</td>
                <td>".$wallet_data_array['wallet_transaction_date']."</td>
                <td>".round(sprintf("%2f",$wallet_amount),2)."</td>
                <td>".round(sprintf("%2f",$wallet_data_array['wallet_transaction_amount']),2)."</td>
                <td>".round(sprintf("%2f",$balance_credits),2)."</td>
            </tr>
        </table>
        
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
    $mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
			return true;
		}
		
	}
	
	 public function send_email_booked($booking_id, $email_data_array)
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

		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['parent_email']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Slots Booking Approved";
		
		$body = '';
		$body .= "<!DOCTYPE>
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
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
        <p>We are pleased to inform you that your slot booking for your kid ".$email_data_array['student_name']." is approved successfully.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Level</th>
                <th>Time</th>
                <th>Lane/Court</th>
                <th>Coach</th>
            </tr>";
            $sql ="select bs.booking_no,bs.booked_date, g.game,l.location,c.coach_name,lv.level,bs.from_time,bs.to_time,
            lc.lane_court
            from booking_approvals ba 
            left join booked_slots bs on bs.booking_id=ba.id
           left join games g on ba.activity_id=g.game_id
           left join locations l on l.location_id=bs.location_id
           left join game_levels lv on ba.level_id=lv.games_level_id
           left join lane_courts lc on bs.lane_court_id=lc.id
           left join coach c on bs.coach_id=c.coach_id
            where ba.id='$booking_id' and bs.status=1
            ";
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['level']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['lane_court']."</td>
                <td>".$value['coach_name']."</td>
                
            </tr>";
        }
         $body .= "</table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
    $mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
			return true;
		}
		
	}
	
	public function send_email_rejected($booking_id, $email_data_array)
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
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['parent_email']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
        
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Slots Booking Request Rejected";
		
		$body = '';
		$body .= "<!DOCTYPE>
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
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
        <p>We are pleased to inform you that your slot booking for your kid ".$email_data_array['student_name']." is rejected.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Level</th>
                <th>Time</th>
                <th>Lane/Court</th>
                <th>Coach</th>
            </tr>";
            $sql ="select bs.booking_no,bs.booked_date, g.game,l.location,c.coach_name,lv.level,bs.from_time,bs.to_time,
            lc.lane_court
            from booking_approvals ba 
            left join booked_slots bs on bs.booking_id=ba.id
           left join games g on ba.activity_id=g.game_id
           left join locations l on l.location_id=bs.location_id
           left join game_levels lv on ba.level_id=lv.games_level_id
           left join lane_courts lc on bs.lane_court_id=lc.id
           left join coach c on bs.coach_id=c.coach_id
            where ba.id='$booking_id' and bs.status=1
            ";
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['level']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['lane_court']."</td>
                <td>".$value['coach_name']."</td>
                
            </tr>";
        }
         $body .= "</table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
    $mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
			return true;
		}
		
	}
	
	public function send_email_booked_for_approval($booking_id,$wallet_data_array, $parent_code, $wallet_amount, $balance_credits, $email_data_array)
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
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['parent_email']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
        
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Slots Booking Requested Successfully";
		
		$body = '';
		$body .= "<!DOCTYPE>
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
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
        <p>We are pleased to inform you that your slot booking for your kid ".$email_data_array['student_name']." with discounted price is under approval/reject process.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Level</th>
                <th>Time</th>
                <th>Lane/Court</th>
                <th>Coach</th>
            </tr>";
            $sql ="select bs.booking_no,bs.booked_date, g.game,l.location,c.coach_name,lv.level,bs.from_time,bs.to_time,
            lc.lane_court
            from booking_approvals ba 
            left join booked_slots bs on bs.booking_id=ba.id
           left join games g on ba.activity_id=g.game_id
           left join locations l on l.location_id=bs.location_id
           left join game_levels lv on ba.level_id=lv.games_level_id
           left join lane_courts lc on bs.lane_court_id=lc.id
           left join coach c on bs.coach_id=c.coach_id
            where ba.id='$booking_id' and bs.status=1
            ";
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['level']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['lane_court']."</td>
                <td>".$value['coach_name']."</td>
                
            </tr>";
        }
         $body .= "</table>
        <p>Your Wallet details as follows</p>
        <p style='text-align: right;'>Transaction ID :<b>".$wallet_data_array['wallet_transaction_id']."</b></p>
         <table>
            <tr>
                <th>Parent-Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Previous balance(AED)</th>
                <th>Detected amount(AED)</th>
                <th>Total balance(AED)</th>
            </tr>
            <tr>
                <td>".$parent_code."</td>
                <td>".$wallet_data_array['parent_name']."</td>
                <td>".$wallet_data_array['wallet_transaction_date']."</td>
                <td>".round(sprintf("%2f",$wallet_amount),2)."</td> 
                <td>".round(sprintf("%2f",$wallet_data_array['wallet_transaction_amount']),2)."</td>
                <td>".round(sprintf("%2f",$balance_credits),2)."</td>
            </tr>
        </table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
    $mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		   return false;
		}
		else{
			return true;
		}
		
	}
	
  public function add_slot_booking1(){

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

   $email=$this->session->userdata('username');
   $user_id = $this->session->userid;
   $parentDetails = $this->default->getParentDetail($email);
   $studentDetails = $this->default->getStudentDetails($sid);

   $query4 = $this->db->query('select a_s.*,d.discount_name, COALESCE(d.discount_percentage,0.00) from activity_selections a_s 
   left join discount_setups ds on ds.id= a_s.discount_type
   where a_s.sid="'.$studentDetails['sid'].'" and a_s.`activity_id` = "'.$activity_id.'" 
   and a_s.status="Active" and a_s.approval_selection="Approved" 
   order by a_s.id desc limit 1');
  $postData4=$query4->row_array();
  $level_id=$postData4['level_id'];
  $discount_name=$postData4['discount_name'];
  $discount_percentage=$postData4['discount_percentage'];
  $discount_applicable=$postData4['discount_applicable'];
  
  $level_id=$postData4['level_id'];
  $parent_id = $parentDetails['parent_id'];


  $query1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
  $postData1=$query1->row_array();
  if(empty($postData1)){
      $json['status'] = 'error';  
      echo json_encode($json);
      $this->session->set_flashdata('error', 'Please add prepaid credit to book slot.');
  }else{
    $bal_credits=$postData1['amount_paid'];
    $fees=110;
    $balance_credits=$bal_credits-$fees;
    $amount=$fees;
    $status='Pending';
    $checkexists = $this->db->query('select * from booking_approvals where parent_id ="'.$parent_id.'" and  student_id ="'.$sid.'" and activity_id ="'.$activity_id.'" and level_id ="'.$level_id.'" and checkout_date ="'.$dates.'" and `status`= "Approved" ');
    if (empty($checkexists->result_array())){
          $sql="Update  prepaid_credits set balance_credits='$balance_credits',total_credits='$balance_credits' where parent_id='$parent_id'";
          $insert=$this->db->query($sql);


          $query11 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
          $postData11=$query11->row_array();
          $bal_credits1=$postData11['balance_credits'];

          $ticket = $this->school->getLastEntry('booking_approvals');
          $ticket_no='BK-0000'.$ticket;
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
    }else{
      $json['status'] = 'success';  
        $this->session->set_flashdata('error', 'You have already booked a slot on selected date.');
        echo json_encode($json);
    }
  }
  }else{
    $this->load->view('slot_booking_activity_calander');
  }

  }

  public function view($sid){
    $this->db->select('*');
    $this->db->where('id', $sid);
    $registrations = $this->db->get('registrations');
    $data = $registrations->result_array();
    $data['registrations'] = $data[0];
    $this->load->view('student/student_list',$data);
  }
  
  
   public function swap_slot_list($activity_id='', $stud_id='', $activity_selection_id){
    $data['title'] = 'Upcoming Slots to Swap/Refund';
    $from_date = date('Y-m-d');
    $activity = $activity_id;
    $sid = $stud_id;
    
    $this->db->select('bs.id as slot_id,bs.is_refunded, bs.refund_approval_status,bs.booking_no as ticket_no, bs.booked_date as checkout_date, bk.student_id, reg.name, bk.parent_id, bk.activity_id, bk.level_id, bs.from_time, bs.to_time, slot.coach_id, slot.lane_court_id, slot.location_id, bk.attendance,bs.refund_requested');
    $this->db->from('booking_approvals bk');
    $this->db->join('booked_slots bs', 'bs.booking_id = bk.id','left');
    $this->db->join('slot_selections slot', 'slot.id = bk.activityselection_id','left');
    $this->db->join('registrations reg', 'reg.id = bk.student_id','left'); 
    $this->db->where('bs.booked_date > "'. $from_date. '" ');
    if($activity)
    {
        $this->db->where('bk.activity_id',$activity);
    }
    if($sid)
    {
        $this->db->where('bk.student_id',$sid);
    }
    $this->db->where('bs.status',1);
    $this->db->order_by('bs.booked_date','ASC');
    
    $query = $this->db->get();
   // echo $this->db->last_query();die;
    $data['bookingList']=  $query->result_array();
    foreach($data['bookingList'] as $key => $value){
        $data['bookingList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
        $data['bookingList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
        $data['bookingList'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
        $data['bookingList'][$key]['level_id'] = $this->default->getLevelDetail($value['level_id']);
        $data['bookingList'][$key]['lane_court_id'] = $this->default->getLaneDetail($value['lane_court_id']);
    }
    
   
    $data['activity_id'] = $activity;
    $data['activity_selection_id'] = $activity_selection_id;
    $data['sid'] = $sid;
    //echo "<pre>"; print_r($data); die;
    $this->load->view('slot/viewUpcomingSlots',$data);
  }
  
  
  public function viewbooking($activity='',$sid=''){
    $data['title'] = 'Slot Schedule Report';
    $postdate = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $activity_id = $this->input->post('activity_id');
    $stud_id = $this->input->post('sid');
    $from_date = date('Y-m-1');
    $to_date = date('Y-m-t', strtotime($from_date));
    if(isset($postdate)){
      $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
      $to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
      $activity = $activity_id;
      $sid = $stud_id;
    }
    
    $this->db->select('bs.booking_no as ticket_no, bs.booked_date as checkout_date, bk.student_id, reg.name, p.parent_code, reg.sid as student_code, bk.parent_id, bk.activity_id, bk.level_id, bs.from_time, bs.to_time, slot.coach_id, slot.lane_court_id, slot.location_id, bk.attendance');
    $this->db->from('booking_approvals bk');
    $this->db->join('booked_slots bs', 'bs.booking_id = bk.id','left');
    $this->db->join('parent p', 'p.parent_id = bk.parent_id','left');
    $this->db->join('slot_selections slot', 'slot.id = bk.activityselection_id','left');
    $this->db->join('registrations reg', 'reg.id = bk.student_id','left'); 
    $this->db->where('bs.booked_date BETWEEN "'. $from_date. '" and "'. $to_date.'"');
    $this->db->where('bs.status',1);
    $this->db->where('bk.status','Approved');
    if($activity)
    {
        $this->db->where('bk.activity_id',$activity);
    }
    if($sid)
    {
        $this->db->where('bk.student_id',$sid);
    }
    $this->db->order_by('bs.booked_date','ASC');
    
    $query = $this->db->get();
   // echo $this->db->last_query();die;
    $data['bookingList']=  $query->result_array();
    foreach($data['bookingList'] as $key => $value){
        $data['bookingList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
        $data['bookingList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
        $data['bookingList'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
        $data['bookingList'][$key]['level_id'] = $this->default->getLevelDetail($value['level_id']);
        $data['bookingList'][$key]['lane_court_id'] = $this->default->getLaneDetail($value['lane_court_id']);
    }
    
    $data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
    $data['toDateVal'] = date('Y-m-d',strtotime($to_date));
    $data['activity_id'] = $activity;
    $data['sid'] = $sid;
    //echo "<pre>"; print_r($data); die;
    $this->load->view('slot/viewBooking',$data);
  }

  public function get_events($stud_id, $parent_id, $activity_id, $slot_id=0){
    $data_events = array();
    $start =date('Y-m-d', strtotime($this->input->get("start")));
    $end =date('Y-m-d', strtotime($this->input->get("end")));
    /*$username=$this->session->userdata('username');
    $parentDetails = $this->default->getParentDetail($username);*/
    
    if($slot_id == 0)
    {
    $events = $this->db->query("select *,bs.booked_date as checkout_date,bs.from_time, bs.to_time from booking_approvals ba 
    left join booked_slots as bs on bs.booking_id = ba.id
    where ba.student_id='$stud_id' and ba.`parent_id` ='".$parent_id."' and ba.`activity_id` ='".$activity_id."' and ba.is_refunded = 0 and bs.booked_date BETWEEN '".$start."' AND '".$end."' and (ba.`status` = 'Approved' or ba.status = 'Pending') and bs.status ='1' ");
    }
    else
    {
        $events = $this->db->query("select *,bs.booked_date as checkout_date,bs.from_time, bs.to_time from booking_approvals ba 
            left join booked_slots as bs on bs.booking_id = ba.id
        where ba.student_id='$stud_id' and ba.`parent_id` ='".$parent_id."' and ba.`activity_id` ='".$activity_id."' and ba.is_refunded = 0 and bs.booked_date BETWEEN '".$start."' AND '".$end."' and (ba.`status` = 'Approved' or ba.status = 'Pending') and bs.status='1' and bs.id != $slot_id");
    }
    $eventList=$events->result_array();
    //echo $this->db->last_query();die;

    $cartList = $this->db->query("select * from tmp_booking where `parent_id` ='".$parent_id."' and `activity_id` ='".$activity_id."' and `checkout_date` BETWEEN '".$start."' AND '".$end."' ");
    $cartEvent=$cartList->result_array();

    $colorArray = ['#FF0000', '#006400','#00008B','#800080','#8B0000','#556B2F'];
    $studentArr =[];
    foreach($eventList as $key => $value) { 
      $startTime = $value['checkout_date'].' '.$value['from_time'];
      $endTime = $value['checkout_date'].' '.$value['to_time'];
      $studentdetails = $this->default->getStudentDetails($value['student_id']);
      $activity_name= $this->transaction->getActivityDetail($value['activity_id']);
      $studentArr[] = $value['student_id'];
      $studArray = array_values(array_unique($studentArr)); 
      $keyvalue = array_search($value['student_id'],$studArray); 
          $data_events[] = array(
              "id" => $value['id'],
              //"title" => 'PS00'.$value['student_id'].'('. $value['from_time'].'-'.$value['to_time'].')',
              "title" => $studentdetails['name'].'-'.$activity_name.'</br> (Timing: '.$value['from_time'].'-'.$value['to_time'].')',
              "start" => date('Y-m-d H:i:s', strtotime($startTime)),
              "end" => date('Y-m-d H:i:s', strtotime($endTime)),
              "color" => $colorArray[$keyvalue],
              "textColor" => '#fff'
          );
      }
      foreach($cartEvent as $key => $value) { 
      $startTime = $value['checkout_date'].' '.$value['from_time'];
      $endTime = $value['checkout_date'].' '.$value['to_time'];
      $studentdetails = $this->default->getStudentDetails($value['student_id']);
      $activity_name= $this->transaction->getActivityDetail($value['activity_id']);
          $data_events[] = array(
              "id" => $value['id'],
              //"title" => 'PS00'.$value['student_id'].'('. $value['from_time'].'-'.$value['to_time'].')',
              "title" => 'My Cart -'.$studentdetails['name'].'-'.$activity_name.'</br> (Timing: '.$value['from_time'].'-'.$value['to_time'].')',
              "start" => date('Y-m-d H:i:s', strtotime($startTime)),
               "end" => date('Y-m-d H:i:s', strtotime($endTime)),
              "textColor" => '#fff'
          );
      }
    echo json_encode($data_events);
    
    die;
  }
  public function changestatus($id, $field, $value){
    $userData = array(
      $field => $value,
    );
    $this->db->where('id', $id);
    $updateData = $this->db->update('slot_selections', $userData);
    $json['status'] = "success";
      $this->session->set_flashdata('success_msg', 'Status updated successfully');
      $this->output->set_header('Content-Type: application/json');
      echo json_encode($json);
  }

  public function approval(){
    $data['title'] = 'Booking Approval';
    $this->db->select('bk.*, reg.name,p.parent_name, p.parent_code,p.email_id as parent_email, p.mobile_no as parent_mobile, 
    u.user_name, u.role');
    $this->db->from('booking_approvals bk');
    $this->db->join('registrations reg', 'reg.id = bk.student_id','left'); 
    $this->db->join('parent p', 'p.parent_id = bk.parent_id','left'); 
    $this->db->join('users u', 'u.user_id = bk.created_by','left'); 
    $this->db->where('bk.status !=','Approved');
    $this->db->order_by('bk.id','ASC');
    $query = $this->db->get();
    $data['bookingList']=  $query->result_array();
    foreach($data['bookingList'] as $key => $value){
        $data['bookingList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
        $data['bookingList'][$key]['level_id'] = $this->default->getLevelDetail($value['level_id']);
        $data['bookingList'][$key]['user_id'] = $this->transaction->getUserDetail($value['user_id']);
        
    }
    $this->load->view('slot/approval',$data);
  }

  public function changebookingstatus(){
    $booking_id = $this->input->post('booking_id');
    $status = $this->input->post('status');
    $reason = $this->input->post('reason');
    $user_id = $this->session->userid;
    if ($status == '') {
        $json['error']['status'] = 'Please select approval status';
    }
    if (empty($json['error']) ) {
        /*$booking = $this->db->query('select * from booking_approvals where id='.$booking_id);
        $data=$booking->row_array();
        $credit = $this->db->query('select * from prepaid_credits where parent_id='.$data['parent_id']);
        $creditVal=$credit->row_array();
        $total_credits=$creditVal['balance_credits'];
        if($status == 'Approved'){
          
          //wallet transaction 
           
          $txn_id = $this->school->getLastEntry('wallet_transactions');
          $wallet_transaction_id = 'WTXNO-'.$txn_id;

          $inv_id = $this->default->getInvoiceId('wallet_transactions');
          $invoice_id = 'PS'.date('Y').'-'.$inv_id;

          $walletArray = array(
            'wallet_transaction_id' =>$wallet_transaction_id,
            'ac_code' => 'SBWT',
            'wallet_transaction_date' =>$data['checkout_date'],
            'wallet_transaction_type' =>'Debit',
            'wallet_transaction_detail' => 'Slot Booking Fees',
            'updated_admin_id' => $user_id,
            'reg_id' => 'PSA00'.$data['parent_id'],
            'wallet_transaction_amount' => $data['amount'],
            'gross_amount' => $data['amount'],
            'vat_percentage' => $data['vat_percent'],
            'vat_value' => $data['vat_amount'],
            'net_amount' => $data['net_amount'],
            'debit' => $data['net_amount'],
            'invoice' => 'yes',
            'invoice_id' =>$invoice_id,
            'slot_booking'=>$booking_id,
            'student_id'=> $data['student_id'],
            'parent_id'=> $data['parent_id'],
            'parent_name'=> $data['parent_name'],
            'parent_mobile'=> $data['parent_mobile'],
            'parent_email_id'=> $data['parent_email'],
            'description'=> 'Slot Booking Fees',
        );
        $checkexists = $this->db->query('select id from wallet_transactions where slot_booking ="'.$booking_id.'" and  ac_code ="SBWT" and wallet_transaction_type = "Debit"  ');
        $checkexistsArr = $checkexists->row_array();
        if (empty($checkexistsArr)){
          $this->db->insert('wallet_transactions', $walletArray); 
        }else{
          $this->db->where('id', $checkexistsArr['id']);
           $this->db->update('wallet_transactions', $walletArray); 

        }
        //prepaid creedit
        //$fees=110;
        $balance_credits=$total_credits-$data['net_amount'];
        
        $sql="Update  prepaid_credits set balance_credits='".$balance_credits."',total_credits='".$balance_credits."' where parent_id='".$data['parent_id']."' ";
        $insert=$this->db->query($sql);
        }else{
          $balance_credits = $total_credits;
        }
*/

        $userData = array(
          //'wallet_balance' => $balance_credits,
          'reason' => $reason,
          'status' => $status,
          'updated_admin_id' => $user_id,
        );
        $this->db->where('id', $booking_id);
        $updateData = $this->db->update('booking_approvals', $userData);
        
        $sql2="select p.parent_name, r.name as student_name,p.email_id as parent_email,ba.payable_amount,ba.parent_id from booking_approvals ba 
        left join parent p on p.parent_id = ba.parent_id
        left join registrations r on r.id = ba.student_id
        where ba.id= '$booking_id'";
        $email_details = $this->db->query($sql2)->row_array();
        if($status == 'Approved'){
            $this->send_email_booked($booking_id, $email_details);
        }
        else if($status == 'Rejected'){
            //
            $credit = $this->db->query('select * from prepaid_credits where parent_id='.$data['parent_id']);
            $creditVal=$credit->row_array();
            $total_credits=$creditVal['balance_credits'];
            $balance_credits=round($total_credits+$email_details['payable_amount'],2);
            $sql="Update  prepaid_credits set balance_credits='".$balance_credits."',total_credits='".$balance_credits."' where parent_id='".$email_details['parent_id']."' ";
            $insert=$this->db->query($sql);
            
            $txn_id = $this->school->getLastEntry('wallet_transactions');
          $wallet_transaction_id = 'WTXNO-'.$txn_id;

          //$inv_id = $this->default->getInvoiceId('wallet_transactions');
          //$invoice_id = 'PS'.date('Y').'-'.$inv_id;
            $booking = $this->db->query('select * from booking_approvals where id='.$booking_id);
        $data=$booking->row_array();
        
          $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'ac_code' => 'REFWTR',
                'wallet_transaction_date' =>$data['checkout_date'],
                'wallet_transaction_type' =>'Credit',
                'wallet_transaction_detail' => 'Slot Booking Fees - Refund',
                'updated_admin_id' => $user_id,
                'reg_id' => $data['student_id'],
                'wallet_transaction_amount' => $data['amount'],
                'gross_amount' => $data['amount'],
                'vat_percentage' => $data['vat_percent'],
                'vat_value' => $data['vat_amount'],
                'net_amount' => $data['net_amount'],
                'credit' => $data['net_amount'],
                'invoice' => '',
                'invoice_id' =>'',
                'slot_booking'=>$booking_id,
                'student_id'=> $data['student_id'],
                'parent_id'=> $data['parent_id'],
                'parent_name'=> $data['parent_name'],
                'parent_mobile'=> $data['parent_mobile'],
                'parent_email_id'=> $data['parent_email'],
                'description'=> 'Slot Booking Fees - Refund',
                'balance_credit'=>$balance_credits,
            );
            $this->db->insert('wallet_transactions', $walletArray); 
            $this->send_email_rejected($booking_id, $email_details);
        }
        $json['status'] = "success";
        $this->session->set_flashdata('success_msg', 'Status updated successfully');
        
    }
    $this->output->set_header('Content-Type: application/json');
    echo json_encode($json);
  }

  public function viewBookingDetails($id){
      $data['title'] = 'Booking Details';
      $this->db->select('bk.*, reg.sid as student_code,p.parent_code, reg.name,p.parent_name, p.parent_code,p.email_id as parent_email, p.mobile_no as parent_mobile, 
        u.user_name, u.role');
        $this->db->from('booking_approvals bk');
        $this->db->join('registrations reg', 'reg.id = bk.student_id','left'); 
        $this->db->join('parent p', 'p.parent_id = bk.parent_id','left'); 
        $this->db->join('users u', 'u.user_id = bk.created_by','left'); 
        $this->db->where('bk.status !=','Approved');
        $this->db->where('bk.id',$id);
        $this->db->order_by('bk.id','ASC');
        $query = $this->db->get();
        $data['bookingList']=  $query->row_array();
        
        $data['bookingList']['activity_id'] = $this->transaction->getActivityDetail($data['bookingList']['activity_id']);
        $data['bookingList']['level_id'] = $this->default->getLevelDetail($data['bookingList']['level_id']);
        $data['bookingList']['user_id'] = $this->transaction->getUserDetail($data['bookingList']['user_id']);
        
        $sql2= "select bs.booking_no,bs.booked_date, g.game,l.location,c.coach_name,lv.level,bs.from_time,bs.to_time,
            lc.lane_court,bs.hours
            from booked_slots bs 
            left join booking_approvals ba on bs.booking_id=ba.id
           left join games g on ba.activity_id=g.game_id
           left join locations l on l.location_id=bs.location_id
           left join game_levels lv on ba.level_id=lv.games_level_id
           left join lane_courts lc on bs.lane_court_id=lc.id
           left join coach c on bs.coach_id=c.coach_id
            where bs.booking_id='$id' and bs.status=1
            ";
        $data['bookingListData'] = $this->db->query($sql2)->result_array();
        //print_r($data);die;
        
        $this->load->view('slot/bookingDetails',$data);
  }
  
  public function swapList($activity_id, $sid){
      $data['title'] = 'Refund Request / Swap slot';
      $slot = $this->db->query("select * from change_slot_reqs where `activity_id` ='".$activity_id."' and `student_id` ='".$sid."'  ");
      $data['slotList']=$slot->result_array();
      foreach($data['slotList'] as $key=>$value){
        $data['slotList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
        $data['slotList'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
        $data['slotList'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
        $data['slotList'][$key]['level_id'] = $this->default->getLevelDetail($value['level_id']);
        $data['slotList'][$key]['lane_court_id'] = $this->default->getLaneDetail($value['lane_court_id']);
      }

      $this->load->view('slot/swaplist',$data);
  }
  
  public function makeBookingDetails()
  {
     $parent_id = $this->input->post('parent_id');
     $sql="SELECT p.parent_code, p.parent_name, p.mobile_no,pc.balance_credits,
                 coalesce(v.percentage,5.00) as percentage FROM `parent` p 
            left join prepaid_credits pc on pc.parent_id=p.parent_id 
            left join vat_setups as v on v.id=1
            where p.parent_id=$parent_id";
    $result = $this->db->query($sql)->row_array();
    echo json_encode($result);
     
  }
  
  public function request_refund()
  {
      $filepath="Refund_images";
	  $uploaded_file = isset($_FILES['file']) && $_FILES['file']['name'] != '' ?$this->file_upload($_FILES['file'],$filepath):'';
	  $reason =$this->input->post('reason');
	  $slot_id = $this->input->post('slot_id');
	  $activity_selection_id = $this->input->post('activity_selection_id');
	  $activity_id = $this->input->post('activity_id');
	
	 
	  $update_arr = array(
	      //'status' => 0,
	      'is_refunded' => 0,
	      'reason' => $reason,
	      'refund_requested' => 1,
	      'refund_requested_on' => date('Y-m-d H:i:s'),
	      'refund_document' => $uploaded_file,
	      'refund_approval_status' => 'Pending',
	      );
	      
      $this->db->where('id', $slot_id);
	 $this->db->update('booked_slots', $update_arr);
	
	 
	 $this->session->set_flashdata('success_msg', 'Refund Requested successfully');
	 redirect('student_profile_slot_booking/swap_slot_list/'.$activity_id.'/'.$activity_selection_id.'/'.$activity_selection_id);
	 
	 
	  
	  
  }
  function file_upload($FILES,$filepath)
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
    		$extensions= array("jpeg","jpg","png","pdf","doc","docx");
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

    public function get_holidays()
    {
        $result = $this->db->query("select select_date from set_academy_holidays")->result_array();
        $result_arr = array();
        foreach($result as $key => $value)
        {
            array_push($result_arr, $value['select_date']);
        }
        echo json_encode($result_arr);
        
    }
    
    public function check_student_to_book()
    {
        $id= $this->input->post('id');
        $activity_id =  $this->input->post('activity_id');
        $sql="select * from registrations where id='$id'";
        $row = $this->db->query($sql)->row();
        //print_r($row->status);die;
        $data=array();
        $data['msg'] = '';
        if($row->status !='Active')
        {
            $data['status'] = 0;
            $data['msg'] = 'Student is not in Active Status';
            echo $data['msg'];die;
            
        }
        
        if($row->approval_status !='Approved')
        {
            $data['status'] = 0;
            $data['msg'] = 'Student is not Approved';
            echo $data['msg'];die;
        }
        
       $sql2="select a_s.* from activity_selections a_s 
        where a_s.student_id='$id' and a_s.activity_id = '$activity_id'";
        $row2 = $this->db->query($sql2)->row();
        if($row2->status !='Active')
        {
            $data['status'] = 0;
            $data['msg'] = 'Student Activity is not in Active Status';
            echo $data['msg'];die;
            
        }
        
        if($row2->approval_status !='Approved')
        {
            $data['status'] = 0;
            $data['msg'] = 'Student Activity is not Approved';
            echo $data['msg'];die;
        }
        
        
        
    }
    
    public function test_invoice()
    {
        $this->invoice_model->send_email_invoice(44, "SlotBookingFees");
    }
}
