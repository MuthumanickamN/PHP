<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Attendance_book extends CI_Controller {  
  	public function __construct(){
		parent::__construct();
		$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	public function index(){
		$data['title'] ='Attendance Book';
		$postdate = $this->input->post('date');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		$data['parent_idval'] = $this->input->post('parent_idval');
		$data['status'] = $this->input->post('status');
		

		$date = date('Y-m-d');
		if(isset($postdate)){
			$date = date('Y-m-d',strtotime($postdate));
		}
		$data['date'] = $date;
		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['parentList'] = $this->default->getParentList();

		$where = "where bs.`booked_date` = '".$date."' and bs.status=1 and bs.refund_requested=0 ";
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

		$query = $this->db->query("select book.*,bs.attendance,bs.id as slot_id, bs.from_time,bs.to_time,bs.booked_date, slot.location_id, slot.coach_id, slot.lane_court_id,p.parent_code,p.parent_name, reg.name
								from booked_slots bs left join booking_approvals as book on book.id=bs.booking_id
								LEFT JOIN slot_selections as slot ON book.activityselection_id = slot.id
								LEFT JOIN parent as p ON p.parent_id = book.parent_id
								LEFT JOIN registrations as reg ON book.student_id = reg.id
 								 ".$where);
		$attendanceList = $query->result_array();
		//echo $this->db->last_query();die;
		foreach($attendanceList as $key=>$attendance){
			$attendanceList[$key]['activity_id']=$this->transaction->getActivityDetail($attendance['activity_id']);
			$attendanceList[$key]['location_id']=$this->transaction->getLocationDetail($attendance['location_id']);
			$attendanceList[$key]['level_id']=$this->default->getLevelDetail($attendance['level_id']);
			$attendanceList[$key]['lane_court_id']=$this->default->getLaneDetail($attendance['lane_court_id']);
			$attendanceList[$key]['coach_id']=$this->transaction->getCoachDetail($attendance['coach_id']);
			
		}
		$data['attendanceList'] = $attendanceList;
		$this->load->view('attendance/index', $data);
	}
	public function updateAttendance($status){
		$data = $this->input->post();
		$user_id = $this->session->userid;
		if(isset($data['bulk_id']) && $data['bulk_id'] == 'all'){
			if(empty($data['attendance_id'])){
				$this->session->set_flashdata('error', 'Please select checkbox.');
				$json['error']['error_msg'] = 'Please select checkbox';
			}
		}
        if (empty($json['error']) ) {
        	$attendanceData = array(
				'attendance' => $status,
				'attendance_by' => $user_id,
			);
        	foreach ($data['attendance_id'] as $key => $value) {
        		$this->db->where('id', $value);
        		$updateData = $this->db->update('booked_slots', $attendanceData);
        	}
        	
			$json['status'] = "success";
			$this->session->set_flashdata('success_msg', 'Attendance updated successfully');
        }
    	$this->output->set_header('Content-Type: application/json');
	    echo json_encode($json);
        
	}

	
}