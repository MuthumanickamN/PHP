<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_attendance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('School_profile_report_Model', 'schools');
        $this->load->model('School_attendance_Model', 'attendance');
        $this->load->model('Daily_Transaction_Model', 'transaction');
    }
    
    public function index(){
        $data['title'] = 'Schools Attendance / Booking';
        $data['schoolList']='';
        $postdate = $this->input->post('from_date');
        $schoolId = $this->input->post('schoolId');
        $coachId = $this->input->post('coachId');
        $status=$this->input->post('status');
        $from_date = date('Y-m-1');
        $to_date = date('Y-m-d');
        if(isset($postdate)){
            $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
            $to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
        }
        $data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
        $data['toDateVal'] = date('Y-m-d',strtotime($to_date));
        $data['schoolId'] =$schoolId;
        $data['coachId'] =$coachId;
        $data['status']=$status;
        $data['schoolList']= $this->schools->getAllSchoolList();
        $data['coachList'] = $this->transaction->getAllCoachList();
        $where = "where `date` BETWEEN '".$from_date."' AND '".$to_date."'";
        if(isset($schoolId) && $schoolId != ''){
            $where .= " AND `school_id` = '".$schoolId."' ";
        }
        if(isset($coachId) && $coachId != ''){
            $where .= " AND `coach_id` = '".$coachId."' ";
        }
        if(isset($status) && $status != ''){
            $where .= " AND `status` = '".$status."' ";
        }
      
        $query = $this->db->query("select * from school_attendances ".$where);
        $data['bookingList'] = $query->result_array();
        foreach ($data['bookingList'] as $key => $value) {
            $data['bookingList'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
            $data['bookingList'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);    
        }
        $this->load->view('school_attendance/index', $data);
    }

    public function booking(){
        $data['title'] = 'School attendance / Booking';
        $data['schoolList']= $this->schools->getAllSchoolList();
        $data['activityList'] = $this->schools->getAllActivityList();
        $data['coachList'] = $this->transaction->getAllCoachList();
        $this->load->view('school_attendance/booking', $data);
    }

    public function createbooking(){
        $data['created_by'] = $this->session->userid;
        $data['school_id'] = $this->input->post('school_id');
        $data['school_name'] = $this->input->post('school_name');
        $data['location_id'] = $this->input->post('location_id');
        $data['activity_id'] = $this->input->post('activity_id');
        $data['date'] = $this->input->post('date');
        $data['time'] =$this->input->post('time');
        /*if($timeSlot != ''){
        $timerange = explode('-', $timeSlot);
        $data['time_from'] = trim($timerange[0]);
        $data['time_to'] = trim($timerange[1]);
        }*/   
        $data['coach_id'] = $this->input->post('coach_id');
        $lastId = $this->schools->getLastEntry('school_attendances');
        $data['bkid'] = 'BKID-'.$lastId;

        if (empty($data['school_id'])) {
            $json['error']['school_id'] = 'Please select school';
        }
        if (empty($data['school_name'])) {
            $json['error']['school_name'] = 'Please enter school name';
        }
        if (empty($data['location_id'])) {
            $json['error']['school_location'] = 'Please enter location';
        }
        if ($data['activity_id'] == '') {
            $json['error']['activity_id'] = 'Please select activity';
        }
        if (empty($data['date'])) {
            $json['error']['date'] = 'Please enter booking date';
        }
        if ($data['time'] == '') {
            $json['error']['time'] = 'Please enter time range';
        }
        if ($data['coach_id'] == '') {
            $json['error']['coach_id'] = 'Please select coach';
        }
        if (empty($json['error'])) {
            $this->db->insert('school_attendances', $data);
            $insert =  $this->db->insert_id();
            if(isset($insert)){
                $json['status'] = "success";
                $this->session->set_flashdata('success_msg', 'Attendance updated successfully');
                $this->output->set_header('Content-Type: application/json');
                echo json_encode($json);
            }
            //setMessage('New Activity Added Successfully.');
        }else{
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
        } 
       
    }

    public function changestatus($b_id,$status){
        $data = array(
        'status' => $status,
        'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $b_id);
        $this->db->update('school_attendances', $data); 
        $this->session->set_flashdata('success_msg', 'Attendance updated successfully');
        $json['status'] = "success";
         $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
        setMessage('School invoice status updated successfully');
    }
    public function getbookingDetails(){
        $bk_id = $this->input->post('bk_id');
        $query = $this->db->query("select * from school_attendances where `id` = '".$bk_id."' ");
        $json['data'] = $query->row_array();
        $json['data']['activity_id'] = $this->transaction->getActivityDetail($json['data']['activity_id']);
        $json['data']['coach_id'] = $this->transaction->getCoachDetail($json['data']['coach_id']);
        $json['data']['created_at'] = date('d-m-Y h:i a',strtotime($json['data']['created_at']));
        $json['data']['updated_at'] = date('d-m-Y h:i a',strtotime($json['data']['updated_at']));
        $json['data']['created_by'] = $this->transaction->getUserDetail($json['data']['created_by']);
        $json['data']['date'] = date('d-m-Y',strtotime($json['data']['date']));
        if($json['data']['status'] == 0){
            $json['data']['status'] ='Pending';
        }elseif($json['data']['status'] == 1){
            $json['data']['status'] ='Present';
        }else{
            $json['data']['status'] ='Absent';
        }
        
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json); die;
    }
}
