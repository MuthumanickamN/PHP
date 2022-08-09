<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	public function activity($report){
		if($report == 'daily_activity'){
			$data['title'] = 'Daily activity Report';
			$postdate = $this->input->post('date');
			$date = date('Y-m-d');
			if(isset($postdate)){
				$date = date('Y-m-d',strtotime($postdate));
			}
			
			$data['date'] = $date;
			$where = "where bs.`booked_date` = '".$date."' and bs.status=1 ";
		}elseif($report == 'slot_schedule'){
			$data['title'] = 'Slot Schedule Report';
			$postdate = $this->input->post('from_date');
			$from_date = date('Y-m-01');
			$to_date = date('Y-m-d');
			if(isset($postdate)){
				$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
				$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
			}
			
			$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
			$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
			$where = "where bs.status=1 and bs.`booked_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		}
		
		$data['report'] = $report;
		$data['stud_name'] = $this->input->post('stud_name');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		
		
		$data['studentList'] = $this->default->getStudentList();
		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		
		if(isset($data['stud_name']) && $data['stud_name'] != ''){
			$where .= " AND book.`student_id` = '".$data['stud_name']."' ";
		}
		if(isset($data['activity_code']) && $data['activity_code'] != ''){
			$where .= " AND book.`activity_id` = '".$data['activity_code']."' ";
		}
		if(isset($data['location_idval']) && $data['location_idval'] != ''){
			$where .= " AND slot.`location_id` = '".$data['location_idval']."' ";
		}
		if(isset($data['gameLevelId']) && $data['gameLevelId'] != ''){
			$where .= " AND book.`level_id` = '".$data['gameLevelId']."' ";
		}
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND slot.`coach_id` = '".$data['coach_idval']."' ";
		}
//slot.student_signature,
		$query = $this->db->query("select bs.*,
									   book.activity_id,
									   book.level_id,
									   reg.name,
									   reg.sid,
									   slot.location_id,
									   slot.coach_id,
									   slot.lane_court_id,
									   book.ticket_no,
									   p.parent_code
								from booked_slots bs
									LEFT JOIN booking_approvals as book
										ON book.id = bs.booking_id
									LEFT JOIN registrations as reg
										ON book.student_id = reg.id
									LEFT JOIN parent as p
										ON p.parent_id = reg.parent_user_id
									LEFT JOIN slot_selections as slot
										ON book.activityselection_id = slot.id " .$where);
		$activitylist = $query->result_array();
		//echo $this->db->last_query();die;
		foreach($activitylist as $key=>$activity){
			$activitylist[$key]['activity_id']=$this->transaction->getActivityDetail($activity['activity_id']);
			$activitylist[$key]['location_id']=$this->transaction->getLocationDetail($activity['location_id']);
			$activitylist[$key]['level_id']=$this->default->getLevelDetail($activity['level_id']);
			$activitylist[$key]['lane_court_id']=$this->default->getLaneDetail($activity['lane_court_id']);
			$activitylist[$key]['coach_id']=$this->transaction->getCoachDetail($activity['coach_id']);
		}

		$data['activityListing'] = $activitylist;
		$this->load->view('reports/daily_activity', $data);
	}
	
	public function student_profile_tried(){
	$data['title'] = 'Student Profile Report';
	$this->db->select('fees.id as fees_id,reg.id,reg.sid, reg.name, reg.role, reg.parent_user_id, reg.parent_name, reg.parent_mobile, reg.parent_email_id,reg.status, fees.pay_date, fees.expiry_on, reg.created_at, reg.approval_status');
    $this->db->from('registrations reg');
    $this->db->join('registration_fees fees', 'reg.id = fees.student_id','left'); 
    $this->db->order_by('reg.id','ASC');
    $query = $this->db->get();
    //echo $this->db->last_query();die;
    $studentList =  $query->result_array();
    foreach ($studentList as $key => $value) {
    	if($value['expiry_on'] != ''){
	    	$endDate = $value['expiry_on'];
	    	$startDate = date('Y-m-d');
	    }else{
	    	$endDate = date('Y-m-d');
	    	$startDate = $value['created_at'];
	    }
        
        $date1=date_create($startDate);
        $date2=date_create($endDate);
        $diff2=date_diff($date2,$date1);
        echo $plus_m = $diff2->format("%R");
        echo ' '.$days = (int)$diff2->format("%a");
        echo ' '.$months = (int)$diff2->format("%m");
        echo ' '.$years = (int)$diff2->format("%y");
        
    	//$diff = abs(strtotime($endDate) - strtotime($startDate));
    	//echo $years = floor($diff / (365*60*60*24));
		//echo ' '.$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		//echo ' '.$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));die;

    	if($value['expiry_on'] != ''){
    	    if($plus_m == '+')
    	    {
        	    if($years <= 0)
        	    {
            		if($months == 0){
            			if($days == 0){

            				$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid Today</label>";
            				$studentList[$key]['fees_paid_key'] = "Paid";
            			}else{
            				$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid ".$days." days ago</label>";
            				$studentList[$key]['fees_paid_key'] = "Paid";
            			}
            		}else{
        	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid ".$months." months ago</label>";
        	    		$studentList[$key]['fees_paid_key'] = "Paid";
        	    	}
        	    }
        	    else
        	    {
        	        if($months == 0){

            			$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$days." days</label>";
            			$studentList[$key]['fees_paid_key'] = "Due";
            		}else{
        	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$months." months</label>";

        	    		$studentList[$key]['fees_paid_key'] = "Due";
        	    	}
        	    }
    	    }
	    }else{
	    	if($months == 0){
    			$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$days." days</label>";
    			$studentList[$key]['fees_paid_key'] = "Due";
    		}else{
	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$months." months</label>";
	    		$studentList[$key]['fees_paid_key'] = "Due";
	    	}
	    }
    }
    
    $data['studentList'] = $studentList;
    $data['role'] = strtolower($this->session->userdata('role'));
    $this->load->view('reports/student_profile', $data);
	}
	
	public function student_profile(){
	$data['title'] = 'Student Profile Report';
	$this->db->select('fees.id as fees_id,reg.id,reg.sid, reg.name, reg.role, reg.parent_user_id, reg.parent_name, reg.parent_mobile, reg.parent_email_id,reg.status, fees.pay_date, fees.expiry_on, reg.created_at, reg.approval_status');
    $this->db->from('registrations reg');
    $this->db->join('registration_fees fees', 'reg.id = fees.student_id','left'); 
    $this->db->order_by('reg.id','ASC');
    $query = $this->db->get();
    //echo $this->db->last_query();die;
    $studentList =  $query->result_array();
    foreach ($studentList as $key => $value) {
    	if($value['pay_date'] != ''){
	    	$endDate = $value['pay_date'];
	    	$startDate = date('Y-m-d');
	    }else{
	    	$endDate = date('Y-m-d');
	    	$startDate = $value['created_at'];
	    }
  
    	$diff = abs(strtotime($endDate) - strtotime($startDate));
    	$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    	if($value['pay_date'] != ''){
    	    if($years <= 0)
    	    {
        		if($months == 0){
        			if($days == 0){
        				$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid Today</label>";
        				$studentList[$key]['fees_paid_key'] = "Paid";
        			}else{
        				$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid ".$days." days ago</label>";
        				$studentList[$key]['fees_paid_key'] = "Paid";
        			}
        		}else{
    	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-success'>Paid ".$months." months ago</label>";
    	    		$studentList[$key]['fees_paid_key'] = "Paid";
    	    	}
    	    }
    	    else
    	    {
    	        if($months == 0){

        			$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$days." days</label>";
        			$studentList[$key]['fees_paid_key'] = "Due";
        		}else{
    	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$months." months</label>";
    	    		$studentList[$key]['fees_paid_key'] = "Due";
    	    	}
    	    }
	    }else{
	    	if($months == 0){

    			$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$days." days</label>";
    			$studentList[$key]['fees_paid_key'] = "Due";
    		}else{
	    		$studentList[$key]['fees_paid'] = "<label class='badge2 badge-danger'>Due ".$months." months</label>";
	    		$studentList[$key]['fees_paid_key'] = "Due";
	    	}
	    }
    }
    
    $data['studentList'] = $studentList;
    $data['role'] = strtolower($this->session->userdata('role'));
    $this->load->view('reports/student_profile', $data);
	}
	public function activity_slot(){
		$data['title'] = 'Activity Slot Report';
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');

		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		if($data['activity_code'] != '' || $data['activity_code'] !='all'){
			$activity_id = $data['activity_code'];
			$locationList = $this->db->query('select DISTINCT locations.location_id,locations.location from locations
                              INNER JOIN slot_selections ON locations.location_id=slot_selections.location_id  
                              where slot_selections.game_id = "'.$activity_id.'" order by locations.location_id ');
	    	$data['locationList'] = $locationList->result_array();
	    	$coachList = $this->db->query('select DISTINCT coach.coach_id,coach.coach_name from coach
	                              INNER JOIN slot_selections ON coach.coach_id=slot_selections.coach_id  
	                              where slot_selections.game_id = "'.$activity_id.'" order by coach.coach_id ');
	    	$data['coachList'] = $coachList->result_array();
		}
		if($data['activity_code'] == 'all' || $data['activity_code'] == ''){
			$query = $this->db->query("select * from slot_selections ");
		}else{
			$where = "where `game_id` = '".$data['activity_code']."' ";
			if(isset($data['location_idval']) && $data['location_idval'] != ''){
				$where .= " AND `location_id` = '".$data['location_idval']."' ";
			}
			if(isset($data['gameLevelId']) && $data['gameLevelId'] != ''){
				$where .= " AND `level_id` = '".$data['gameLevelId']."' ";
			}
			if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
				$where .= " AND `coach_id` = '".$data['coach_idval']."' ";
			}

			$query = $this->db->query("select * from slot_selections ".$where);
		}
		$activitySlotListing = $query->result_array();
		foreach($activitySlotListing as $key=>$activity){
			$activitySlotListing[$key]['activity']=$this->transaction->getActivityDetail($activity['game_id']);
			$activitySlotListing[$key]['location']=$this->transaction->getLocationDetail($activity['location_id']);
			$activitySlotListing[$key]['level']=$this->default->getLevelDetail($activity['level_id']);
			$activitySlotListing[$key]['lane_court']=$this->default->getLaneDetail($activity['lane_court_id']);
			$activitySlotListing[$key]['coach']=$this->transaction->getCoachDetail($activity['coach_id']);
			
		}

		$data['activitySlotListing'] = $activitySlotListing;

		$this->load->view('reports/activity_slot_new', $data);
	}
	public function selectbyActivity(){
		$activity_id = $this->input->post('activity_id');
		$locationList = $this->db->query('select DISTINCT locations.location_id,locations.location from locations
                              INNER JOIN slot_selections ON locations.location_id=slot_selections.location_id  
                              where slot_selections.game_id = "'.$activity_id.'" order by locations.location_id ');
    	$data['locationList'] = $locationList->result_array();
    	$coachList = $this->db->query('select DISTINCT coach.coach_id,coach.coach_name from coach
                              INNER JOIN slot_selections ON coach.coach_id=slot_selections.coach_id  
                              where slot_selections.game_id = "'.$activity_id.'" order by coach.coach_id ');
    	$data['coachList'] = $coachList->result_array();

    	echo json_encode($data);
	}

	public function coach_profile(){
		$data['title'] = 'Coach Profile Report';
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['coach_idval'] = $this->input->post('coach_idval');

		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();

		$where = "where `coach_name` != '' ";
		if(isset($data['activity_code']) && $data['activity_code'] != ''){
			$where .= " AND `activity_id` = '".$data['activity_code']."' ";
		}
		if(isset($data['location_idval']) && $data['location_idval'] != ''){
			$where .= " AND `location_id` = '".$data['location_idval']."' ";
		}
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND `coach_id` = '".$data['coach_idval']."' ";
		}
		$query = $this->db->query("select * from coach ".$where);
		$coachListing = $query->result_array();
		foreach($coachListing as $key=>$coach){
			$coachListing[$key]['activity_id']=$this->transaction->getActivityDetail($coach['activity_id']);
			$coachListing[$key]['location_id']=$this->transaction->getLocationDetail($coach['location_id']);
		}

		$data['coachListing'] = $coachListing;

		$this->load->view('reports/coach_profile', $data);

	}

	public function changestatus($table, $id, $field, $value){
		$userData = array(
		  $field => $value,
		);
		if($table == 'coach'){
			$this->db->where('coach_id', $id);
		}else{
		$this->db->where('id', $id);
		}
		$updateData = $this->db->update($table, $userData);
		$json['status'] = "success";
	    $this->session->set_flashdata('success_msg', 'Status updated successfully');
	    $this->output->set_header('Content-Type: application/json');
	    echo json_encode($json);
	}
	public function attendance_tracking(){
		$data['title'] ='Attendance Tracking Report';
		$postdate = $this->input->post('from_date');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['status'] = $this->input->post('status');
		

		$from_date = date('Y-m-01');
		$to_date = date('Y-m-d');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['parentList'] = $this->default->getParentList();

		$where = "where bs.`booked_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($data['activity_code']) && $data['activity_code'] != ''){
			$where .= " AND book.`activity_id` = '".$data['activity_code']."' ";
		}
		if(isset($data['location_idval']) && $data['location_idval'] != ''){
			$where .= " AND slot.`location_id` = '".$data['location_idval']."' ";
		}
		if(isset($data['gameLevelId']) && $data['gameLevelId'] != ''){
			$where .= " AND book.`level_id` = '".$data['gameLevelId']."' ";
		}
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND slot.`coach_id` = '".$data['coach_idval']."' ";
		}
		if(isset($data['parent_idval']) && $data['parent_idval'] != ''){
			$where .= " AND book.`parent_id` = '".$data['parent_idval']."' ";
		}
		if(isset($data['status']) && $data['status'] != ''){
			$where .= " AND book.`attendance` = '".$data['status']."' ";
		}

		$query = $this->db->query("select bs.*,
									   book.activity_id,
									   book.level_id,
									   reg.name,
									   pt.parent_code,
									   slot.location_id,
									   slot.coach_id,
									   slot.lane_court_id
								from booked_slots bs
									LEFT JOIN booking_approvals as book
										ON book.id = bs.booking_id
									LEFT JOIN registrations as reg
										ON book.student_id = reg.id
									LEFT JOIN parent as pt
										ON book.parent_id = pt.parent_id
									LEFT JOIN slot_selections as slot
										ON book.activityselection_id = slot.id ".$where);
										
										
		$attendanceList = $query->result_array();
		foreach($attendanceList as $key=>$attendance){
			$attendanceList[$key]['activity_id']=$this->transaction->getActivityDetail($attendance['activity_id']);
			$attendanceList[$key]['location_id']=$this->transaction->getLocationDetail($attendance['location_id']);
			$attendanceList[$key]['level_id']=$this->default->getLevelDetail($attendance['level_id']);
			$attendanceList[$key]['lane_court_id']=$this->default->getLaneDetail($attendance['lane_court_id']);
			$attendanceList[$key]['coach_id']=$this->transaction->getCoachDetail($attendance['coach_id']);
			
		}
		$data['attendanceList'] = $attendanceList;
		$this->load->view('reports/attendance_tracking', $data);
	}

	public function Request_approve_reject(){
		$data['title'] ='Request Approve/ Reject Report';
		$postdate = $this->input->post('from_date');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['status'] = $this->input->post('status');
		

		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$where = "  bs.`booked_date` BETWEEN '".$from_date."' AND '".$to_date."' and ";
		/*$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['parentList'] = $this->default->getParentList();

		$where = "where book.`checkout_date` BETWEEN '".$from_date."' AND '".$to_date."'";

		$query = $this->db->query("select book.*, slot.location_id, slot.coach_id, slot.lane_court_id, reg.name, reg.sid
								from change_slot_reqs as book 
								LEFT JOIN slot_selections as slot ON book.activityselection_id = slot.id
								LEFT JOIN registrations as reg ON book.student_id = reg.id
 								 ".$where);
		$arrayList = $query->result_array();
		foreach($arrayList as $key=>$value){
			$arrayList[$key]['activity_id']=$this->transaction->getActivityDetail($value['activity_id']);
			$arrayList[$key]['location_id']=$this->transaction->getLocationDetail($value['location_id']);
			$arrayList[$key]['level_id']=$this->default->getLevelDetail($value['level_id']);
			$arrayList[$key]['lane_court_id']=$this->default->getLaneDetail($value['lane_court_id']);
			$arrayList[$key]['coach_id']=$this->transaction->getCoachDetail($value['coach_id']);
			
		}
		$data['arrayList'] = $arrayList;
		$this->load->view('reports/approve_reject', $data);*/

		$data['title'] = 'Request Approve/ Reject';
		$role=$this->session->userdata('role');
		
		$slot = $this->db->query( "select bs.*,ba.activity_id,r.name as student_name,r.sid,p.parent_code,
                                        CASE 
                                        WHEN bs.refund_approval_status = 'Approved' THEN 3
                                        WHEN bs.refund_approval_status = 'Rejected' THEN 2
                                        ELSE 1 
                                        END as order_position
                                        from booked_slots bs 
                            			left join booking_approvals ba on ba.id=bs.booking_id
                            			left join registrations r on r.id=ba.student_id
                            			left join parent p on p.parent_id=ba.parent_id
                            			where $where bs.refund_requested=1 order by order_position ASC ,refund_requested_on DESC");
	   		$data['list'] = $slot->result_array();
	   		foreach ($data['list'] as $key => $value) {
	   			$data['list'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
	    		$data['list'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
				$data['list'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
	   		}
			$this->load->view('reports/approve_reject', $data);

	}
	public function class_report($type){
		$data['title'] ='Class '.ucfirst($type).' Report';
		$data['type'] = $type;
		$postdate = $this->input->post('from_date');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		$data['parent_idval'] = $this->input->post('parent_idval');
		if($type == 'booked'){
			$data['status'] = $this->input->post('status');
		}else if($type == 'attended'){
			$data['status'] = 'Present';
		}else if($type == 'missed'){
			$data['status'] = 'Absent';
		}
		

		$from_date = date('Y-m-01');
		$to_date = date('Y-m-d');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['parentList'] = $this->default->getParentList();

		$where = "where bs.`booked_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($data['activity_code']) && $data['activity_code'] != ''){
			$where .= " AND book.`activity_id` = '".$data['activity_code']."' ";
		}
		if(isset($data['location_idval']) && $data['location_idval'] != ''){
			$where .= " AND slot.`location_id` = '".$data['location_idval']."' ";
		}
		if(isset($data['gameLevelId']) && $data['gameLevelId'] != ''){
			$where .= " AND book.`level_id` = '".$data['gameLevelId']."' ";
		}
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND slot.`coach_id` = '".$data['coach_idval']."' ";
		}
		if(isset($data['parent_idval']) && $data['parent_idval'] != ''){
			$where .= " AND book.`parent_id` = '".$data['parent_idval']."' ";
		}
		if(isset($data['status']) && $data['status'] != ''){
			$where .= " AND book.`attendance` = '".$data['status']."' ";
		}


		
		$query = $this->db->query("select bs.*,
								   book.activity_id,
								   book.level_id,
								   reg.name,
								   reg.sid,
								   slot.location_id,
								   slot.coach_id,
								   slot.lane_court_id
							from booked_slots bs
								LEFT JOIN booking_approvals as book
									ON book.id = bs.booking_id
								LEFT JOIN registrations as reg
									ON book.student_id = reg.id
								LEFT JOIN slot_selections as slot
									ON book.activityselection_id = slot.id
									".$where);
		$attendanceList = $query->result_array();
		foreach($attendanceList as $key=>$attendance){
			$attendanceList[$key]['activity_id']=$this->transaction->getActivityDetail($attendance['activity_id']);
			$attendanceList[$key]['location_id']=$this->transaction->getLocationDetail($attendance['location_id']);
			$attendanceList[$key]['level_id']=$this->default->getLevelDetail($attendance['level_id']);
			$attendanceList[$key]['lane_court_id']=$this->default->getLaneDetail($attendance['lane_court_id']);
			$attendanceList[$key]['coach_id']=$this->transaction->getCoachDetail($attendance['coach_id']);
			
		}
		$data['attendanceList'] = $attendanceList;
		$this->load->view('reports/class_report', $data);

	}

	public function activity_list(){
		$data['title'] ='Activity list Report';
		/*$query = $this->db->query("select book.*, reg.name, reg.sid, reg.status, reg.approval_status
								from booking_approvals as book 
								LEFT JOIN registrations as reg ON book.student_id = reg.id group by book.activity_id ");*/
		$query = $this->db->query("select *
								from activity_selections ");
		$arrayList = $query->result_array();
		foreach($arrayList as $key=>$value){
			$arrayList[$key]['activity']=$this->transaction->getActivityDetail($value['activity_id']);
		}
		$data['arrayList'] = $arrayList;
		$this->load->view('reports/activity_list', $data);
	}

	public function slot_swap(){
		$data['title'] ='Slot Swap Report';
		$postdate = $this->input->post('from_date');
		
		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d 00:00:00',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d 23:59:59',strtotime($to_date));
		$where = " and ((bs.`booked_date` BETWEEN '".$data['fromDateVal']."' AND '".$data['toDateVal']."') or (bs2.booked_date BETWEEN '".$data['fromDateVal']."' AND '".$data['toDateVal']."') or (bs2.created_at BETWEEN '".$data['fromDateVal']."' AND '".$data['toDateVal']."'))  ";
		/*$query = $this->db->query("select slot.*, p.parent_name, p.mobile_no
								from change_slot_reqs as slot 
								LEFT JOIN parent as p ON slot.parent_id = p.parent_id ");
		$arrayList = $query->result_array();
		foreach($arrayList as $key=>$value){
			$arrayList[$key]['activity']=$this->transaction->getActivityDetail($value['activity_id']);
			$arrayList[$key]['updated_admin_id']=($value['updated_admin_id'] != 0)?$this->transaction->getUserDetail($value['updated_admin_id']):'-';
		}*/

		$slot = $this->db->query( "select bs.*,ba.activity_id,p.parent_name,p.mobile_no,r.name as student_name,r.sid,p.parent_code,
		bs2.booked_date as old_booked_date, bs2.from_time as old_from_time, bs2.to_time as old_to_time,bs.created_at as swapped_at
                                        from booked_slots bs 
                            			left join booking_approvals ba on ba.id=bs.booking_id
                            			left join registrations r on r.id=ba.student_id
                            			left join parent p on p.parent_id=ba.parent_id
										left join booked_slots bs2 on bs2.id = bs.swapped_slot_id 
                            			where  bs.status=0 and  bs.info = 'Swapped' $where ");
		$data['list'] = $slot->result_array();
		foreach ($data['list'] as $key => $value) {
			$data['list'][$key]['activity'] = $this->transaction->getActivityDetail($value['activity_id']);
			$data['list'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
			$data['list'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['arrayList'] = $data['list'];

		$this->load->view('reports/slot_swap', $data);
	}

	public function getSwapDetails(){
		$id = $this->input->post('id');
		$oldSlot = $this->db->query("select slot.ticket_no, slot.activity_id, slot.checkout_date,sel.location_id,     
								slot.from_time,slot.to_time, sel.hour, sel.coach_id
								from change_slot_reqs as slot 
								LEFT JOIN slot_selections as sel ON slot.activityselection_id = sel.id ");
		$data['oldSlot'] = $oldSlot->row_array();
		$newSlot = $this->db->query("select slot.ticket_no, slot.activity_id, slot.change_slot_date as checkout_date,sel.location_id, 
								slot.change_slot_from_time as from_time,slot.change_slot_to_time as to_time, sel.hour, sel.coach_id
								from change_slot_reqs as slot 
								LEFT JOIN slot_selections as sel ON slot.change_activityselection_id = sel.id ");
		$data['newSlot'] = $newSlot->row_array();
		$data['oldSlot']['activity_id'] =$this->transaction->getActivityDetail($data['oldSlot']['activity_id']);
		$data['newSlot']['activity_id'] =$this->transaction->getActivityDetail($data['newSlot']['activity_id']);

		$data['oldSlot']['location_id'] =$this->transaction->getLocationDetail($data['oldSlot']['location_id']);
		$data['newSlot']['location_id'] =$this->transaction->getLocationDetail($data['newSlot']['location_id']);

		$data['oldSlot']['coach_id'] =$this->transaction->getCoachDetail($data['oldSlot']['coach_id']);
		$data['newSlot']['coach_id'] =$this->transaction->getCoachDetail($data['newSlot']['coach_id']);
		
		$this->load->view('reports/popup/swap_listing', $data);
	}

	public function vat_report(){
		$data['title'] ='VAT Report';
		$postdate = $this->input->post('from_date');
		$data['acc_code'] = $this->input->post('acc_code');
		
		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['account_code_data'] = $this->schools->getAccountCodeList();

		$where = "where wallet.`wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($data['acc_code']) && $data['acc_code'] != ''){
			$where .= " AND wallet.`account_code` = '".$data['acc_code']."' ";
		}

		$query = $this->db->query("select wallet.wallet_transaction_id, wallet.wallet_transaction_date, wallet.ac_code, wallet.wallet_transaction_type,wallet.wallet_transaction_amount, wallet.net_amount, wallet.vat_value
								from wallet_transactions as wallet 
 								 ".$where);

		$arrayList = $query->result_array();
		/*foreach($arrayList as $key=>$value){
			$arrayList[$key]['account_code']=$this->transaction->getAccountCodeDetail($value['account_code']);
		}*/
		$data['arrayList'] = $arrayList;

		$this->load->view('reports/vat', $data);
	}
	public function wallet_transaction_old($type=''){
		$data['title'] = ($type == 'master')?'Master Wallet Transaction Report':'Wallet Transaction Report';
		
		$postdate = $this->input->post('from_date');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['parent_emailval'] = $this->input->post('parent_emailval');
		$data['acc_code'] = $this->input->post('acc_code');
		$data['transDetailVal'] = $this->input->post('transDetailVal');
		$data['paymentTypeVal'] = $this->input->post('paymentTypeVal');
		$data['type'] = $type;
		$data['id_val'] = $this->input->post('id_val');
		

		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['parentList'] = $this->default->getParentList();
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['transactionList'] = $this->transactionDetails();
		$data['userList'] = $this->transaction->getAllUserList();

		$where = "where `wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		//$userWhere = "where w.`wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($data['acc_code']) && $data['acc_code'] != ''){
			$where .= " AND `account_code` = '".$data['acc_code']."' ";
			//$userWhere .= " AND w.`account_code` = '".$data['acc_code']."' ";
		}
		if(isset($data['parent_idval']) && $data['parent_idval'] != ''){
			$where .= " AND `parent_id` = '".$data['parent_idval']."' ";
			//$userWhere .= " AND w.`parent_id` = '".$data['parent_idval']."' ";
		}
		if(isset($data['parent_emailval']) && $data['parent_emailval'] != ''){
			$where .= " AND `parent_id` = '".$data['parent_emailval']."' ";
			//$userWhere .= " AND w.`parent_id` = '".$data['parent_emailval']."' ";
		}
		if(isset($data['transDetailVal']) && $data['transDetailVal'] != ''){
			$where .= " AND `wallet_transaction_detail` = '".$data['transDetailVal']."' ";
			//$userWhere .= " AND w.`wallet_transaction_detail` = '".$data['transDetailVal']."' ";
		}
		if(isset($data['paymentTypeVal']) && $data['paymentTypeVal'] != ''){
			$where .= " AND `payment_type` = '".$data['paymentTypeVal']."' ";
			//$userWhere .= " AND w.`payment_type` = '".$data['paymentTypeVal']."' ";
		}
		if(isset($data['id_val']) && $data['id_val'] != ''){
			$where .= " AND `updated_admin_id` = '".$data['id_val']."' ";
			//$userWhere .= " AND w.`updated_admin_id` = '".$data['id_val']."' ";
		}
		if($type == ''){
			$user_id = $this->session->userid;
			$where .= " AND `updated_admin_id` = '".$user_id."' ";
			//$userWhere .= " AND w.`updated_admin_id` = '".$user_id."' ";
		}

		$query = $this->db->query("select wallet_transaction_id, wallet_transaction_date, ac_code, wallet_transaction_detail,wallet_transaction_amount, net_amount, vat_value, updated_admin_id, reg_id, gross_amount, credit,debit, discount_percentage, discount_value,payment_type,parent_id
								from wallet_transactions 
 								 ".$where. " order by `id` DESC");
		$arrayList = $query->result_array();
		//echo $this->db->last_query();die;
		foreach($arrayList as $key=> $value){
			if(!isset($userArray[$value['updated_admin_id']][$value['payment_type']])){
				$userArray[$value['updated_admin_id']][$value['payment_type']] = 0;
			}
			if(!isset($userArray[$value['updated_admin_id']]['total'])){
				$userArray[$value['updated_admin_id']]['total'] = 0;
			}
			$userArray[$value['updated_admin_id']][$value['payment_type']] += $value['net_amount'];
			$userArray[$value['updated_admin_id']]['total'] += $value['net_amount'];
			$arrayList[$key]['updated_admin_id']=($value['updated_admin_id'] != 0)?$this->transaction->getUserDetail($value['updated_admin_id']):'-';
			$arrayList[$key]['parent_code']=($value['parent_id'] != 0)?$this->transaction->getParentCode($value['parent_id']):'-';
		}
		$data['arrayList'] = $arrayList;
	    $userid =  $this->session->userdata('userid');

		if($type == ''){
			$userWhere = "where u.status = 'Active' and u.user_id=$userid and (u.role='superadmin' or u.role='admin')";
		}
		else
		{
			$userWhere = "where u.status = 'Active' and (u.role='superadmin' or u.role='admin')";
		}
		$userList = $this->db->query("select u.user_id, u.user_name, u.role, u.email from users as u  
 								  ".$userWhere." order by u.user_id");
		$userListArr = $userList->result_array();
		$i =1;
		foreach($userListArr as $k=>$user){
			$userListArray[$user['user_id']]['user_name'] = $user['user_name'];
			$userListArray[$user['user_id']]['role'] = $user['role'];
			$userListArray[$user['user_id']]['email'] = $user['email'];
			$userListArray[$user['user_id']]['total'] = isset($userArray[$user['user_id']]['total'])?$userArray[$user['user_id']]['total']:0;
			/*$userListArray[$user['user_id']]['Cash'] = isset($userArray[$user['user_id']]['Cash'])?$userArray[$user['user_id']]['Cash']:0;
			$userListArray[$user['user_id']]['Online'] = isset($userArray[$user['user_id']]['Online'])?$userArray[$user['user_id']]['Online']:0;
			$userListArray[$user['user_id']]['Cheque'] = isset($userArray[$user['user_id']]['Cheque'])?$userArray[$user['user_id']]['Cheque']:0;
			$userListArray[$user['user_id']]['Card'] = isset($userArray[$user['user_id']]['Card'])?$userArray[$user['user_id']]['Card']:0;
			$userListArray[$user['user_id']]['Wallet'] = isset($userArray[$user['user_id']]['Wallet'])?$userArray[$user['user_id']]['Wallet']:0; */
		}
		$data['userListArray'] = $userListArray;
		$this->load->view('reports/wallet_transaction', $data);

	}
    
    public function wallet_transaction($type=''){
		$data['title'] = ($type == 'master')?'Master Wallet Transaction Report':'Wallet Transaction Report';
		
		$postdate = $this->input->post('from_date');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['parent_emailval'] = $this->input->post('parent_emailval');
		$data['acc_code'] = $this->input->post('acc_code');
		$data['transDetailVal'] = $this->input->post('transDetailVal');
		$data['paymentTypeVal'] = $this->input->post('paymentTypeVal');
		$data['location_id'] = $this->input->post('location_id');
		$data['type'] = $type;
		$data['id_val'] = $this->input->post('id_val');
		

		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['parentList'] = $this->default->getParentList();
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['transactionList'] = $this->transactionDetails();
		$data['userList'] = $this->transaction->getAllUserList();

		$where = "where `wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		//$userWhere = "where w.`wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($data['acc_code']) && $data['acc_code'] != ''){
			$where .= " AND `account_code` = '".$data['acc_code']."' ";
			//$userWhere .= " AND w.`account_code` = '".$data['acc_code']."' ";
		}
		if(isset($data['parent_idval']) && $data['parent_idval'] != ''){
			$where .= " AND `parent_id` = '".$data['parent_idval']."' ";
			//$userWhere .= " AND w.`parent_id` = '".$data['parent_idval']."' ";
		}
		if(isset($data['parent_emailval']) && $data['parent_emailval'] != ''){
			$where .= " AND `parent_id` = '".$data['parent_emailval']."' ";
			//$userWhere .= " AND w.`parent_id` = '".$data['parent_emailval']."' ";
		}
		if(isset($data['transDetailVal']) && $data['transDetailVal'] != ''){
			$where .= " AND `wallet_transaction_detail` = '".$data['transDetailVal']."' ";
			//$userWhere .= " AND w.`wallet_transaction_detail` = '".$data['transDetailVal']."' ";
		}
		if(isset($data['paymentTypeVal']) && $data['paymentTypeVal'] != ''){
			$where .= " AND `payment_type` = '".$data['paymentTypeVal']."' ";
			//$userWhere .= " AND w.`payment_type` = '".$data['paymentTypeVal']."' ";
		}
		if(isset($data['id_val']) && $data['id_val'] != ''){
			$where .= " AND `updated_admin_id` = '".$data['id_val']."' ";
			//$userWhere .= " AND w.`updated_admin_id` = '".$data['id_val']."' ";
		}
		if($type == ''){
			$user_id = $this->session->userid;
			$where .= " AND `updated_admin_id` = '".$user_id."' ";
			//$userWhere .= " AND w.`updated_admin_id` = '".$user_id."' ";
		}

		$query = $this->db->query("select wallet_transaction_id,location_id, wallet_transaction_date, ac_code, wallet_transaction_detail,wallet_transaction_amount, net_amount, vat_value, updated_admin_id, reg_id, gross_amount, credit,debit, discount_percentage, discount_value,payment_type,parent_id
								from wallet_transactions 
 								 ".$where. " order by `id` DESC");
		$arrayList = $query->result_array();
		//echo $this->db->last_query();die;
		foreach($arrayList as $key=> $value){
			if(!isset($userArray[$value['updated_admin_id']][$value['payment_type']])){
				$userArray[$value['updated_admin_id']][$value['payment_type']] = 0;
			}
			if(!isset($userArray[$value['updated_admin_id']]['total'])){
				$userArray[$value['updated_admin_id']]['total'] = 0;
			}
			$userArray[$value['updated_admin_id']][$value['payment_type']] += $value['net_amount'];
			$userArray[$value['updated_admin_id']]['total'] += $value['net_amount'];
			$arrayList[$key]['updated_admin_id']=($value['updated_admin_id'] != 0)?$this->transaction->getUserDetail($value['updated_admin_id']):'-';
			$arrayList[$key]['parent_code']=($value['parent_id'] != 0)?$this->transaction->getParentCode($value['parent_id']):'-';
			$arrayList[$key]['location_id'] =($value['location_id'] != 0)? $this->transaction->getLocationDetail($value['location_id']):'-';
		}
		$data['arrayList'] = $arrayList;
	    $userid =  $this->session->userdata('userid');

		if($type == ''){
			$userWhere = "where u.status = 'Active' and u.user_id=$userid and (u.role='superadmin' or u.role='admin')";
		}
		else
		{
			$userWhere = "where u.status = 'Active' and (u.role='superadmin' or u.role='admin')";
		}
		$userList = $this->db->query("select u.user_id, u.user_name, u.role, u.email from users as u  
 								  ".$userWhere." order by u.user_id");
		$userListArr = $userList->result_array();
		$i =1;
		foreach($userListArr as $k=>$user){
			$userListArray[$user['user_id']]['user_name'] = $user['user_name'];
			$userListArray[$user['user_id']]['role'] = $user['role'];
			$userListArray[$user['user_id']]['email'] = $user['email'];
			
			$userListArray[$user['user_id']]['total'] = isset($userArray[$user['user_id']]['total'])?$userArray[$user['user_id']]['total']:0;
			$userListArray[$user['user_id']]['Cash'] = isset($userArray[$user['user_id']]['Cash'])?$userArray[$user['user_id']]['Cash']:0;
			$userListArray[$user['user_id']]['Online'] = isset($userArray[$user['user_id']]['Online'])?$userArray[$user['user_id']]['Online']:0;
			$userListArray[$user['user_id']]['Cheque'] = isset($userArray[$user['user_id']]['Cheque'])?$userArray[$user['user_id']]['Cheque']:0;
			$userListArray[$user['user_id']]['Card'] = isset($userArray[$user['user_id']]['Card'])?$userArray[$user['user_id']]['Card']:0;
			//$userListArray[$user['user_id']]['Wallet'] = isset($userArray[$user['user_id']]['Wallet'])?$userArray[$user['user_id']]['Wallet']:0; 
		}
		$data['userListArray'] = $userListArray;
		$this->load->view('reports/wallet_transaction', $data);

	}
	
	public function transactionDetails(){
		$transactionDetails = array(
			'Prepaid Credits',
			'Registration Fees',
			'Slot Booking Fees',
			'Slot Booking Fees Discount',
			'Refund Blocked slot reject',
			'Credits Roll Back',
			'Contract Customer Invoice',
			'Slot Refund Fees',
		);
		return $transactionDetails;
	}

	public function invoice_report(){
		$data['title'] ='Invoice Report';
		$postdate = $this->input->post('from_date');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['stud_name'] = $this->input->post('stud_name');
		
		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['parentList'] = $this->default->getParentList();
		$data['studentList'] = $this->default->getStudentList();

		$where = "where `wallet_transaction_date` BETWEEN '".$from_date."' AND '".$to_date."' AND `invoice` = 'yes' ";
		if(isset($data['parent_idval']) && $data['parent_idval'] != ''){
			$where .= " AND `parent_id` = '".$data['parent_idval']."' ";
		}
		if(isset($data['stud_name']) && $data['stud_name'] != ''){
			$where .= " AND `student_id` = '".$data['stud_name']."' ";
		}
		
		$query = $this->db->query("select id, invoice_id, wallet_transaction_id, wallet_transaction_date, ac_code, wallet_transaction_detail,wallet_transaction_amount, net_amount,vat_percentage, vat_value, updated_admin_id, reg_id, gross_amount, credit,debit, discount_percentage, discount_value,payment_type, parent_id, student_id
								from wallet_transactions 
 								 ".$where);
		$arrayList = $query->result_array();
		foreach($arrayList as $key=>$value){
			$student_details = $this->default->getStudentDetails($value['student_id']);
			if(empty($student_details)) {
			$arrayList[$key]['student_id']='';	
			}
			else
			{
			$arrayList[$key]['student_id']=$student_details['sid'];
			}
		}
		$data['arrayList'] = $arrayList;

		$this->load->view('reports/invoice', $data);
	}

	public function rating_review(){
		$data['title'] = 'Rating & Review Report';
		$coachList = $this->db->query("select coach_id, coach_name, role, passport_size_image from coach where status = 'Active' ")->result_array();
		$ratingDetails = $this->db->query("select * from rating_reviews where status = 'Active' ")->result_array();
		$i = $j =1;
		foreach($ratingDetails as $rating){
			if(!isset($ratingArray[$rating['coach_id']][$rating['star_count'].'_star'])){
				$ratingArray[$rating['coach_id']][$rating['star_count'].'_star'] =0;
			}
			if(!isset($ratingArray[$rating['coach_id']]['total_count'])){
				$ratingArray[$rating['coach_id']]['total_count'] = 0;
			}
			if(!isset($ratingArray[$rating['coach_id']]['sum'])){
				$ratingArray[$rating['coach_id']]['sum'] = 0;
			}
			$ratingArray[$rating['coach_id']][$rating['star_count'].'_star'] +=$i;
			$ratingArray[$rating['coach_id']]['total_count'] +=$j;
			$ratingArray[$rating['coach_id']]['sum'] += $rating['star_count'];
		}
		
		foreach($coachList as $key=> $coach){
			$coachListArray[$coach['coach_id']] = $coach;
			$coachListArray[$coach['coach_id']]['1_star'] = isset($ratingArray[$coach['coach_id']]['1_star'])?$ratingArray[$coach['coach_id']]['1_star']:0;
			$coachListArray[$coach['coach_id']]['2_star'] = isset($ratingArray[$coach['coach_id']]['2_star'])?$ratingArray[$coach['coach_id']]['2_star']:0;
			$coachListArray[$coach['coach_id']]['3_star'] = isset($ratingArray[$coach['coach_id']]['3_star'])?$ratingArray[$coach['coach_id']]['3_star']:0;
			$coachListArray[$coach['coach_id']]['4_star'] = isset($ratingArray[$coach['coach_id']]['4_star'])?$ratingArray[$coach['coach_id']]['4_star']:0;
			$coachListArray[$coach['coach_id']]['5_star'] = isset($ratingArray[$coach['coach_id']]['5_star'])?$ratingArray[$coach['coach_id']]['5_star']:0;
			$coachListArray[$coach['coach_id']]['total_count'] = isset($ratingArray[$coach['coach_id']]['total_count'])?$ratingArray[$coach['coach_id']]['total_count']:0;
			$coachListArray[$coach['coach_id']]['average'] = (isset($ratingArray[$coach['coach_id']]['total_count']) && isset($ratingArray[$coach['coach_id']]['sum']))? $ratingArray[$coach['coach_id']]['sum']/$ratingArray[$coach['coach_id']]['total_count']:'0';
			//$coachListArray[$key]['rating'] += $i;
		}
		$data['coachListArray'] = $coachListArray;
		
		$this->load->view('reports/rating', $data);
	}

	public function ledger_report(){		
		$postdate = $this->input->post('from_date');
		$acc_code = $this->input->post('acc_code');
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		$data['title'] = 'Ledger Report';
		if(isset($postdate)){
			$from_date = date('Y-m-d 00:00:00',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d 23:59:59',strtotime($this->input->post('to_date')));
		}
		$where = "where `created_at` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($acc_code) && $acc_code != ''){
			$where .= " AND `account_code` = '".$acc_code."' ";
			$query = "(select a.created_at, a.transaction_id, a.payable_date as transaction_date, s.Name as account_code_val, a.description_detail as transaction_detail, '' as parent_id, 
			CASE WHEN s.Type = 'Expenses' or s.Type = 'Payable' THEN a.payable_amount ELSE '' END as 'debit' ,
			CASE WHEN s.Type = 'Income' or s.Type = 'Receivable' THEN a.payable_amount ELSE '' END as 'credit' 
			from accounts_service_entries a left join accounts_service as s on s.Id = a.accountservice_id $where order by created_at asc)
			";
		}
		else{
			$query = "(select a.created_at, a.transaction_id, a.payable_date as transaction_date, s.Name as account_code_val, a.description_detail as transaction_detail, '' as parent_id, 
		CASE WHEN s.Type = 'Expenses' or s.Type = 'Payable' THEN a.payable_amount ELSE '' END as 'debit' ,
		CASE WHEN s.Type = 'Income' or s.Type = 'Receivable' THEN a.payable_amount ELSE '' END as 'credit' 
		  from accounts_service_entries a left join accounts_service as s on s.Id = a.accountservice_id $where)
		UNION
		(select a.created_at, a.wallet_transaction_id, a.wallet_transaction_date as transaction_date, '' as account_code_val, a.wallet_transaction_detail as transaction_detail, p.parent_code as parent_id, 
		CASE WHEN a.wallet_transaction_type = 'Debit' THEN a.net_amount ELSE '' END as 'debit' ,
		CASE WHEN a.wallet_transaction_type = 'Credit' THEN a.net_amount ELSE '' END as 'credit' 
		  from wallet_transactions a left join parent as p on p.parent_id = a.parent_id $where) order by created_at asc";
		}
		
		
		$query = $this->db->query($query);
		$transactionList = $query->result_array();
		//echo $this->db->last_query();die;
		foreach($transactionList as $key=>$txnval){
			//$transactionList[$key]['account_code_val'] = (isset($txnval['accountservice_id']) && $txnval['accountservice_id']!='')?$this->transaction->getAccountCodeDetail($txnval['accountservice_id']):'-';
			$transactionList[$key]['created_by'] = (isset($txnval['created_by']) && $txnval['created_by']!='')?$this->transaction->getUserDetail($txnval['created_by']):'-';
		}

		$data['transactionList'] = $transactionList;
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['acc_code'] =$acc_code;
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['userList'] = $this->transaction->getAllUserList();
		//print_r($data);die;
		$this->load->view('reports/ledger_report', $data);
	}

	public function coach_roaster(){
		
		$data['title'] = 'Coach Roaster';
		$postdate = $this->input->post('date');
		$date = date('Y-m-d');
		if(isset($postdate)){
			$date = date('Y-m-d',strtotime($postdate));
		}
		
		$data['date'] = $date;
		$where = "where bs.`booked_date` = '".$date."' ";
			
		$data['coach_idval'] = $this->input->post('coach_idval');
		
		
		$data['coachList'] = $this->transaction->getAllCoachList();
		
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND slot.`coach_id` = '".$data['coach_idval']."' ";
		}


										
		$query = $this->db->query("select bs.*,
									   book.activity_id,
									   book.level_id,
									   reg.name,
									   reg.sid,
									   slot.location_id,
									   slot.coach_id,
									   slot.lane_court_id
								from booked_slots bs
									LEFT JOIN booking_approvals as book
										ON book.id = bs.booking_id
									LEFT JOIN registrations as reg
										ON book.student_id = reg.id
									LEFT JOIN slot_selections as slot
										ON book.activityselection_id = slot.id
										".$where);
		$activitylist = $query->result_array();
		foreach($activitylist as $key=>$activity){
			$activitylist[$key]['activity_id']=$this->transaction->getActivityDetail($activity['activity_id']);
			$activitylist[$key]['location_id']=$this->transaction->getLocationDetail($activity['location_id']);
			$activitylist[$key]['level_id']=$this->default->getLevelDetail($activity['level_id']);
			$activitylist[$key]['lane_court_id']=$this->default->getLaneDetail($activity['lane_court_id']);
			$activitylist[$key]['coach_id']=$this->transaction->getCoachDetail($activity['coach_id']);
		}

		$data['activityListing'] = $activitylist;
		$this->load->view('reports/coach_roaster', $data);
	}

	public function contract_payment(){
		$data['title'] = 'Contract Payment Report';
		$postdate = $this->input->post('from_date');
		$data['paymentTypeVal'] = $this->input->post('paymentTypeVal');
		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));

		$where = "where cp.`payable_date` BETWEEN '".$from_date."' AND '".$to_date."'";		
		if(isset($data['paymentTypeVal']) && $data['paymentTypeVal'] != ''){
			$where .= " AND cp.`payment_type` = '".$data['paymentTypeVal']."' ";
		}
		$query = $this->db->query("select 
									   a.student_id,
									   c.id,
									   a.psa_id,
									   r.name as student_name,
									   a.parent_name,
									   cp.payment_type,
									   b.bank_name as bank,
									   cp.cheque_number,
									   cp.cheque_date,
									   cp.payable_date,
									   cp.payable_amount as amount
								from contract_details as c
									LEFT JOIN activity_selections as a
										on a.id = c.activity_selection_id
									left join registrations as r
										on r.id = a.student_id
									left join contract_payments as cp
										on cp.contract_detail_id = c.id
									left join bank_details as b
										on b.id = cp.bank_id
										".$where."
								order by c.id DESC");
 								
		$arrayList = $query->result_array();
		$data['arrayList'] = $arrayList;

		$this->load->view('reports/contract_payment', $data);
	}
	public function wallet_transaction_details_view()
	{
	    
	    $wallet_transaction_id = $this->input->post('wallet_transaction_id');
	    if($wallet_transaction_id)
	    {
    	    $sql="select wt.*, p.parent_code, p.parent_name, p.mobile_no as parent_mobile,
    	    r.name as student_name, r.sid as student_code, wt.description as description_
    	    
    	    from wallet_transactions wt 
    	    left join parent as p on p.parent_id=wt.parent_id
    	    left join registrations r on r.id = wt.student_id
    	    where wallet_transaction_id='$wallet_transaction_id'";
    	    $result = $this->db->query($sql)->row();
    	    echo json_encode($result);
	    }
	    else
	    {
	        echo 0;
	    }
    	    
	}
	public function getDialog1()
	{
		$id = $this->input->post('id');
		$sql="SELECT * FROM `registrations` WHERE id='$id'";
		$result = $this->db->query($sql)->row();
		echo json_encode($result);
	}
	public function getDialog2()
	{
		$id = $this->input->post('id');
		$sql="SELECT reg.*,u.code,r.sid,pc.balance_credits, rc.reg_fee, coalesce(v.percentage,5.00) as vat_perc FROM `registration_fees` reg 
			  left join registrations as r on r.id=reg.id 
			  left join reg_charge_setups rc on rc.category = r.reg_fee_category
			  left join vat_setups as v on v.id=1
			  left join prepaid_credits as pc on pc.parent_id=r.parent_user_id 
			  left join users as u on u.user_name= reg.parent_name WHERE reg.student_id='$id'";
	//	$result = $this->db->query($sql)->row();
	//	$result = $sql->row_array();
		//echo $sql;die;
		if($this->db->query($sql)->num_rows() > 0) 
		{
			$result = query($sql)->row_array();
			echo json_encode($result);
		}
		else
		{
			//$sid = $this->input->post('sid');
			$sql1="SELECT pc.*,r.*,u.code, rc.reg_fee, coalesce(v.percentage,5.00) as vat_perc from registrations r
			left join reg_charge_setups rc on rc.category = r.reg_fee_category
			left join vat_setups as v on v.id=1
				   left join prepaid_credits as pc on pc.parent_id=r.parent_user_id 
				   left join users as u on u.user_name = r.parent_name where r.id ='$id'";
			$result1 = $this->db->query($sql1)->row();
			//echo $sql1;die;
			echo json_encode($result1);
		}
		
	}

	

}
?>