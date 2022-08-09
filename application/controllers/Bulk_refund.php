<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Bulk_refund extends CI_Controller {  
  	public function __construct(){
		parent::__construct();
		$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	public function index(){
		$data['title'] ='Bulk refund';
		$postdate = $this->input->post('date');
		$data['activity_code'] = $this->input->post('activity_code');
		$data['location_idval'] = $this->input->post('location_idval');
		$data['gameLevelId'] = $this->input->post('gameLevelId');
		$data['coach_idval'] = $this->input->post('coach_idval');
		$data['stud_name'] = $this->input->post('stud_name');
		

		$date = date('Y-m-d');
		if(isset($postdate)){
			$date = date('Y-m-d',strtotime($postdate));
		}
		$data['date'] = $date;
		$data['levelList'] = $this->default->getLevelList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['studentList'] = $this->default->getStudentList();

		$where = "where bs.`booked_date` = '".$date."' and bs.`is_refunded` = '0' and bs.`approval_status` = 'Approved' and bs.status=1 and bs.attendance='Pending' ";
		if(isset($data['stud_name']) && $data['stud_name'] != ''){
			$where .= " AND book.`student_id` = '".$data['stud_name']."' ";
		}
		if(isset($data['activity_code']) && $data['activity_code'] != ''){
			$where .= " AND book.`activity_id` = '".$data['activity_code']."' ";
		}
		if(isset($data['location_idval']) && $data['location_idval'] != ''){
			$where .= " AND bs.`location_id` = '".$data['location_idval']."' ";
		}
		if(isset($data['gameLevelId']) && $data['gameLevelId'] != ''){
			$where .= " AND book.`level_id` = '".$data['gameLevelId']."' ";
		}
		if(isset($data['coach_idval']) && $data['coach_idval'] != ''){
			$where .= " AND bs.`coach_id` = '".$data['coach_idval']."' ";
		}
        
        
 								 
		$query = $this->db->query("select bs.*,book.activity_id,book.level_id,book.student_id, reg.name, reg.sid
								from  booked_slots as bs
								LEFT JOIN  booking_approvals as book  ON bs.booking_id = book.id
							    LEFT JOIN registrations as reg ON book.student_id = reg.id
 								 ".$where);
		$refundList = $query->result_array();
		foreach($refundList as $key=>$refund){
			$refundList[$key]['activity_id']=$this->transaction->getActivityDetail($refund['activity_id']);
			$refundList[$key]['location_id']=$this->transaction->getLocationDetail($refund['location_id']);
			$refundList[$key]['level_id']=$this->default->getLevelDetail($refund['level_id']);
			$refundList[$key]['lane_court_id']=$this->default->getLaneDetail($refund['lane_court_id']);
			$refundList[$key]['coach_id']=$this->transaction->getCoachDetail($refund['coach_id']);
			
		}
		$data['refundList'] = $refundList;
		$this->load->view('slot/bulk_refund', $data);
	}
	public function updateRefund(){
		$data = $this->input->post();
		$user_id = $this->session->userid;
		$user_name = $this->session->name;
		 
    	$refundData = array(
			'is_refunded' => '1',
			'refund_date' => date('Y-m-d H:i:s'),
			'info'=>'Refunded',
			'status'=>0
		);
    	foreach ($data['refund_id'] as $key => $value) {
    		$booking = $this->db->query("select book.parent_id,bs.payable_amount as net_amount,bs.booked_date as checkout_date,bs.id,book.student_id, 
    		p.parent_code,p.parent_name,p.mobile_no,p.email_id
    		from booked_slots bs left join booking_approvals book on bs.booking_id=book.id 
    		left join parent as p on p.parent_id=book.parent_id
    		where bs.`id`='".$value."' and bs.`is_refunded` = '0' ");
    		if($booking->num_rows() > 0){
    		$bookingList = $booking->row_array();

    		$credit = $this->db->query( "select * from prepaid_credits where `parent_id` = '".$bookingList['parent_id']."' ");
	   		$creditArr = $credit->row_array();
	   		
	   		$total_credits = $creditArr['balance_credits'] + $bookingList['net_amount'];
	   		
	   		
	   		$this->db->query( "update prepaid_credits SET total_credits = '".$total_credits."', balance_credits = '".$total_credits."' where `parent_id`  = '".$bookingList['parent_id']."' ");

    		$this->db->where('id', $value);
    		$updateData = $this->db->update('booked_slots', $refundData);

    		$txn_id = $this->schools->getLastEntry('wallet_transactions');
	          $wallet_transaction_id = 'WTXNO-'.$txn_id;
	          $walletArray = array(
	            'wallet_transaction_id' =>$wallet_transaction_id,
	            'ac_code' => 'REFWTR',
	            'wallet_transaction_date' =>$bookingList['checkout_date'],
	            'wallet_transaction_type' =>'Credit',
	            'wallet_transaction_detail' => 'Slot Refund Fees',
	            'updated_admin_id' => $user_id,
	            'reg_id' => $bookingList['parent_id'],
	            'wallet_transaction_amount' => $bookingList['net_amount'],
	            'gross_amount' => $bookingList['net_amount'],
	            //'vat_percentage' => $bookingList['vat_percent'],
	            //'vat_value' => $bookingList['vat_amount'],
	            'net_amount' => $bookingList['net_amount'],
	            'credit' => $bookingList['net_amount'],
	            'slot_booking' =>$bookingList['id'],
	            'student_id'=> $bookingList['student_id'],
	            'parent_id'=> $bookingList['parent_id'],
	            'parent_name'=> $bookingList['parent_name'],
	            'parent_mobile'=> $bookingList['mobile_no'],
	            'parent_email_id'=> $bookingList['email_id'],
	            'description'=> 'Slot Refund Fees',
	            'balance_credit' =>$creditArr['balance_credits'],
	            'total_credit' =>$total_credits,
	            'updated_by' =>$user_id,
	            'updated_by_name' =>$user_name,
	            'created_at' => date('Y-m-d H:i:s')
	        );
	        $checkexists = $this->db->query('select id from wallet_transactions where slot_booking ="'.$bookingList['id'].'" and  ac_code ="REFWTR" and wallet_transaction_type = "Credit"  ');
	        $checkexistsArr = $checkexists->row_array();
	        if (empty($checkexistsArr)){
	          $this->db->insert('wallet_transactions', $walletArray); 
	        }else{
	          $this->db->where('id', $checkexistsArr['id']);
	           $this->db->update('wallet_transactions', $walletArray); 

	        }
    		}
    	}
    	
		$json['status'] = "success";
		$this->session->set_flashdata('success_msg', 'Refund submitted successfully');
    	$this->output->set_header('Content-Type: application/json');
	    echo json_encode($json);
        
	}

	
}