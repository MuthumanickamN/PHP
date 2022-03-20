<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Slot_refund_request extends CI_Controller {  
      
    
	public function __construct(){
		parent::__construct();
		$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	
	public function index(){
		$data['title'] = 'Slot refund request';
		$username=$this->session->userdata('username');
	    $user_id = $this->session->userid;
	    $parentDetails = $this->default->getParentDetail($username);
	    $data['studentDetails'] = $this->default->getStudentByParent($parentDetails['parent_id']);
	    $query = $this->db->query( "select * from activity_selections where `user_id` ='".$parentDetails['parent_id']."' and `approval_status`= 'Approved' ");
	    $selectedActivities = $query->result_array();
	    foreach($selectedActivities as $key => $value){
	      $selectedActivities[$key]['activity'] = ($value['activity_id'] != '')?$this->transaction->getActivityDetail($value['activity_id']):'--';
	      $selectedActivities[$key]['level_id'] = ($value['level_id'] != '')?$this->default->getLevelDetail($value['level_id']):''; 
	    }
	    $data['selectedActivities'] = $selectedActivities;
		$this->load->view('slotRefund/slot_refund_request', $data);
	}

	public function proceed($id){
		$data['title'] = 'Refund Request / Swap slot';
		$query = $this->db->query( "select * from activity_selections where `activity_id` ='".$id."' ");
	    $data['slotDetails'] = $query->row_array();
	    
	    $booking = $this->db->query( "select id,checkout_date, ticket_no  from booking_approvals  where `checkout_date` >= '".date('Y-m-d')."' and `activity_id` ='".$id."' and `status` = 'Approved' and `is_refunded` =0 and `change_slot_id`=0 ");
	    
	    /*$this->db->select('book.id,book.checkout_date, book.ticket_no ');
	    $this->db->from('booking_approvals book');
	    $this->db->join('change_slot_reqs slot', 'book.ticket_no = slot.ticket_no','left'); 
	    $this->db->where('book.activity_id',$id);
	    $this->db->where('book.status','Approved');
	    $this->db->where('slot.approval_status','Pending');
	    //$this->db->order_by('book.checkout_date','ASC');
	    $booking = $this->db->get();*/
	    $data['bookingDateList'] = $booking->result_array();

	    $slot = $this->db->query( "select days  from slot_selections  where `game_id` ='".$id."' and `status` = 'Active' ");
	    $slotArr = $slot->result_array();
	    $slotList = array_column($slotArr,'days');

	    $weekdays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; 
	    $slotListArr=array_diff($weekdays,$slotList);           
        foreach($slotListArr as $slot) { 
          $dayvalue[] = array_search($slot,$weekdays);
      	}

        $data['daysList'] = implode(',', $dayvalue);
	    $data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
	    

	    $this->load->view('slotRefund/proceed', $data);
	}

	public function getDetailsByDate(){
		$bookingid = $this->input->post('bookingid'); 
		$bookedActivity = $this->db->query( "select ticket_no from booking_approvals where `id` ='".$bookingid."' ");
	  	$bookedData = $bookedActivity->row()->ticket_no;
		$checkExists = $this->default->checkexists('change_slot_reqs','ticket_no', $bookedData);
	   	if($checkExists == 0){
			$this->db->select('book.*, slot.coach_id, slot.level_id,slot.location_id, slot.lane_court_id, slot.slot_class as slot_code, slot.slot_id as slot_count, slot.hour, slot.days, slot.category ');
		    $this->db->from('booking_approvals book');
		    $this->db->join('slot_selections slot', 'book.activityselection_id = slot.id','left'); 
		    $this->db->where('book.id',$bookingid);
		    $this->db->order_by('book.checkout_date','ASC');
		    $booking = $this->db->get();
		    $booking = $booking->row_array();
	    	$booking['activity'] = $this->transaction->getActivityDetail($booking['activity_id']);
	    	$booking['location'] = $this->transaction->getLocationDetail($booking['location_id']);
	    	$booking['coach'] = $this->transaction->getCoachDetail($booking['coach_id']);
	    	$booking['lane_court']=$this->default->getLaneDetail($booking['lane_court_id']);
	    	$booking['level']=$this->default->getLevelDetail($booking['level_id']);
	    	$data['booking'] = $booking;
		    $json['status'] = 'success';  
		    echo json_encode($data);
		}else{
			$json['status'] = 'error';  
          	$this->session->set_flashdata('error', 'Request already submitted. ');
          	echo json_encode($json);
		}
	}

	public function addRequest(){
		$bookedDataArr = $this->input->post();
		
		$email=$this->session->userdata('username');
		$this->db->where('email', $email);  
		$query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_id=$postData1['user_id'];

		if ($bookedDataArr['bookingid'] == '') {
            $json['error']['bookingid'] = 'Please select date';
        }
        if ($bookedDataArr['type'] == '') {
            $json['error']['type'] = 'Please select type';
        }
        $medical_proof_file_name = '';
		if($bookedDataArr['type'] == 'Swap'){
			if (empty($bookedDataArr['change_slot_date'])) {
           	 	$json['error']['change_slot_date'] = 'Please enter change slot date';
        	}
        	if (empty($bookedDataArr['change_slot_time'])) {
           	 	$json['error']['change_slot_time'] = 'Please enter change slot time';
        	}
        }
    	if (empty($bookedDataArr['reason'])) {
       	 	$json['error']['reason'] = 'Please enter reason';
    	}
    	$medical_proof_file_name = isset($_FILES['medical_proof_file_name'])?$_FILES['medical_proof_file_name']['name']:'';
    	if ($medical_proof_file_name == '') {
       	 	$json['error']['medical_proof_file_name'] = 'Please add certificate';
    	}
    	$filepath="Refund_images";
		$insert_id=$user_id;
		$test=($medical_proof_file_name != '')?$this->file_upload($_FILES['medical_proof_file_name'],$filepath,$insert_id):'';
		
		if (empty($json['error']) ) {
			$bookedActivity = $this->db->query( "select id, ticket_no,student_id, parent_id,activity_id, level_id, checkout_date, from_time, to_time,amount, activityselection_id from booking_approvals where `id` ='".$bookedDataArr['bookingid']."' ");
			//$bookedActivity = $this->db->query( "select id, ticket_no,student_id, parent_id,activity_id, level_id, checkout_date, from_time as slot_from_time, to_time as slot_to_time,amount, activityselection_id from booking_approvals where `id` ='".$bookedDataArr['bookingid']."' ");
	   		$bookedData = $bookedActivity->row_array();
	   		$checkExists = $this->default->checkexists('change_slot_reqs','ticket_no', $bookedData['ticket_no']);
	   		if($checkExists == 0){
				$bookedData['bkid'] = $bookedData['id'];				
		   		unset($bookedData['id']);
		   		$bookedData['type'] = $bookedDataArr['type'];
		   		$bookedData['change_slot_date'] = date('Y-m-d', strtotime($bookedDataArr['change_slot_date']));
		   		$bookedData['change_slot_from_time'] = $bookedDataArr['change_slot_from_time'];
		   		$bookedData['change_slot_to_time'] = $bookedDataArr['change_slot_to_time'];
		   		$bookedData['change_activityselection_id'] = $bookedDataArr['change_slot_time'];
		   		$bookedData['reason'] = $bookedDataArr['reason'];
		   		$bookedData['medical_proof_file_name'] = $medical_proof_file_name;
		   		$bookedData['coach_id'] = $bookedDataArr['coach_id'];
		   		$bookedData['level_id'] = $bookedDataArr['level_id'];
		   		$bookedData['location_id'] = $bookedDataArr['location_id'];
		   		$bookedData['lane_court_id'] = $bookedDataArr['lane_court_id'];
		   		$bookedData['slot_class'] = $bookedDataArr['slot_code'];
		   		$bookedData['slot_id'] = $bookedDataArr['slot_count'];
		   		$bookedData['psa_id'] = 'PSA00'.$bookedData['parent_id'];
		   		$bookedData['status'] = 'Active';
		   		$bookedData['approval_status'] = 'Pending';
		   		$bookedData['parent_user_id'] = $insert_id;
		   		$student_details = $this->default->getStudentDetails($bookedData['student_id']);
		   		$bookedData['student_name'] = $student_details['name'];
		   		$bkid = $this->schools->getLastEntry('change_slot_reqs');
				$bookedData['bkid'] = 'SCR#00'.$bkid;
		   		//$bookedData = $bookedDataArr;
		   		$insertBooking = $this->db->insert('change_slot_reqs', $bookedData); 
	            if($insertBooking){
	              $json['status'] = 'success';  
	              $this->session->set_flashdata('success_msg', 'Request added successfully. ');
	              echo json_encode($json);
	            }
	        }else{
	        	$json['status'] = 'success';  
              	$this->session->set_flashdata('error', 'Request already submitted. ');
              	echo json_encode($json);
	        }
		}else{
		    $this->output->set_header('Content-Type: application/json');
		    echo json_encode($json);
		} 
	}
	function file_upload($FILES,$filepath,$insert_id){
	if(isset($FILES)){
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
		$extensions= array("jpeg","jpg","png");
		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a pdf or doc file.";
		}
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,$upload_filename);
			return true;
		}else{
			return false;
			print_r($errors);
		}
	}
	}
	public function list(){
		$data['title'] = 'Request Approve/ Reject';
		$role=$this->session->userdata('role');
		if($role == 'admin' || $role == 'superadmin' ){
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
                            			where  bs.refund_requested=1 order by order_position ASC ,refund_requested_on DESC");
	   		$data['list'] = $slot->result_array();
	   		foreach ($data['list'] as $key => $value) {
	   			$data['list'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
	    		$data['list'][$key]['location_id'] = $this->transaction->getLocationDetail($value['location_id']);
				$data['list'][$key]['coach_id'] = $this->transaction->getCoachDetail($value['coach_id']);
	   		}
			$this->load->view('slotRefund/list', $data);
		}else{
			$this->session->set_flashdata('error', 'You do not have permission to access.');
			redirect('/dashboard');
		}
	}

	public function changestatus(){
		$id = $this->input->post('id_val');
		$comment = $this->input->post('comment');
		$status = $this->input->post('status');
		$user_id = $this->session->userid;
		if ($comment == '') {
            $json['error']['comment'] = 'Please enter comment';
        }
        if ($status == '') {
            $json['error']['status'] = 'Please select status';
        }
        if (empty($json['error']) ) {
        	$slot = $this->db->query( "select bs.*,ba.student_id,ba.parent_id,p.parent_code,p.parent_name,p.email_id,p.mobile_no 
        	from booked_slots bs 
        	left join booking_approvals as ba on bs.booking_id=ba.id 
        	left join parent p on p.parent_id=ba.parent_id
        	where bs.`id` = '".$id."' ");
	   		$slotArray = $slot->row_array();
            $prev_status = $slotArray['refund_approval_status'];
            
            if($prev_status =="Approved" && $status=="Approved")
            {
                $json['status'] = "success";
                $this->session->set_flashdata('success_msg', 'Refund Already Approved.');
            }
            else
            {
                if($prev_status !="Approved" && $status=="Approved")
                {
                    $data = array(
        			  'is_refunded' => 1,
        			  'approval_rejected_reason' => $comment,
        			  'refund_approval_status' => $status,
        			  'approval_status' => $status,
        			  'refund_approved_by' => $user_id,
        			  'refund_date' => date('Y-m-d H:i:s'),
        			  'status' => 0,
        			  'Info' => 'Refunded'
        			);
                }
                else
                {
                    $data = array(
        			  'is_refunded' => 0,
        			  'approval_rejected_reason' => $comment,
        			  'refund_approval_status' => $status,
        			  'approval_status' => $status,
        			  'refund_approved_by' => $user_id,
        			  'refund_date' => date('Y-m-d H:i:s'),
        			  'status' => 1,
        			  'Info' => 'Refund-Rejected'
        			);
                    
                }
    			
    			$this->db->where('id', $id);
    			$updateData = $this->db->update('booked_slots', $data);
    			$json['status'] = "success";
    			
    			
    			
    		//	if($slotArray['type'] == 'Refund'){
    	   		$credit = $this->db->query( "select * from prepaid_credits where `parent_id` = '".$slotArray['parent_id']."' ");
    	   		$creditArr = $credit->row_array();
    	   		
    	   		if($prev_status !="Approved" && $status=="Approved")
                {
    	   		    $balance_credits = $creditArr['balance_credits'] + $slotArray['deducted_amount'];
    	   		    $pay_type='Credit';
    	   		    $refund_amount = $slotArray['deducted_amount'];
                }
                else if($prev_status =="Approved" && $status=="Rejected")
                {
                    $balance_credits = $creditArr['balance_credits'] - $slotArray['deducted_amount'];
                    $pay_type='Debit';
                    $refund_amount = $slotArray['deducted_amount'];
                }
    	   		else
    	   		{
    	   		   $balance_credits = $creditArr['balance_credits']; 
    	   		   $pay_type='';
    	   		   $refund_amount = 0.00;
    	   		}
    	   		
    	   		$this->db->query( "update prepaid_credits SET total_credits = '".$balance_credits."', balance_credits = '".$balance_credits."' where `parent_id`  = '".$slotArray['parent_id']."' ");
                    
                if( $pay_type)
    	        {
    	   		  $txn_id = $this->schools->getLastEntry('wallet_transactions');
    	          $wallet_transaction_id = 'WTXNO-'.$txn_id;
    	          $walletArray = array(
    	            'wallet_transaction_id' =>$wallet_transaction_id,
    	            'ac_code' => 'REFWTR',
    	            'wallet_transaction_date' =>$slotArray['booked_date'],
    	            'wallet_transaction_type' =>$pay_type,
    	            'wallet_transaction_detail' => 'Slot Refund Fees',
    	            'updated_admin_id' => $user_id,
    	            'reg_id' => $slotArray['parent_id'],
    	            'wallet_transaction_amount' => $slotArray['deducted_amount'],
    	            'gross_amount' => $slotArray['payable_amount'],
    	            'vat_percentage' => $slotArray['vat_perc'],
    	            'vat_value' => $slotArray['vat_amount'],
    	            'net_amount' => $slotArray['deducted_amount'],
    	            'credit' => $slotArray['deducted_amount'],
    	            'slot_booking' =>$slotArray['id'],
    	            'student_id'=> $slotArray['student_id'],
    	            'parent_id'=> $slotArray['parent_id'],
    	            'parent_name'=> $slotArray['parent_name'],
    	            'parent_mobile'=> $slotArray['mobile_no'],
    	            'parent_email_id'=> $slotArray['email_id'],
    	            'description'=> 'Slot Refund Fees',
    	            'created_at'=> date('Y-m-d H:i:s')
    	        );
    	        
    	        $checkexists = $this->db->query('select id from wallet_transactions where slot_booking ="'.$id.'" and  ac_code ="REFWTR" and wallet_transaction_type = "Credit"  ');
    	        $checkexistsArr = $checkexists->row_array();
    			
    			
    			$email_data_slot = $this->db->query("SELECT bs.*,
    													   ba.activity_id,
    													   r.NAME AS student_name,
    													   r.sid,
    													   p.parent_name,
    													   p.email_id,
    													   p.parent_code,
    													   a.activity_name,
    													   g.level,
    													   l.location
    												FROM   booked_slots bs
    													   LEFT JOIN booking_approvals ba
    															  ON ba.id = bs.booking_id
    													   LEFT JOIN registrations r
    															  ON r.id = ba.student_id
    													   LEFT JOIN parent p
    															  ON p.parent_id = ba.parent_id
    													   LEFT JOIN activity AS a
    															  ON a.activity_id = ba.activity_id
    													   LEFT JOIN game_levels AS g
    															  ON g.games_level_id = ba.level_id
    													   LEFT JOIN locations AS l
    															  ON l.location_id = bs.location_id
    														  where bs.id = '".$id."' ");
    			
    			$email_data_array = $email_data_slot->row_array();	
    			$email_data_array['prev_wallet_amount'] = $creditArr['balance_credits'];
    			$email_data_array['current_wallet_amount'] = $balance_credits;
    			$email_data_array['refund_amount'] = $refund_amount;
    			$email_data_array['parent_id'] = $slotArray['parent_id'];
    			$email_data_array['parent_name'] = $slotArray['parent_name'];
    			//echo '<pre>'; print_r($email_data_array); echo '</pre>';
    			//echo '<pre>'; print_r($status); echo '</pre>';
    			
    			 $this->send_email($status, $email_data_array);
    			
    			
    	        //if (empty($checkexistsArr)){
    	          $this->db->insert('wallet_transactions', $walletArray); 
    	        //}else{
    	         // $this->db->where('id', $checkexistsArr['id']);
    	          // $this->db->update('wallet_transactions', $walletArray); 
    
    	       // }
    	        }
    	   		$this->session->set_flashdata('success_msg', 'Status updated successfully.');
            }
	   		/* }else{
	   			$refundArr = array(
	   				'checkout_date' =>  $slotArray['change_slot_date'],
	   				'change_slot_id' => $slotArray['id']
	   			);
		   		$this->db->where('ticket_no', $slotArray['ticket_no']);
				$updateData = $this->db->update('booking_approvals', $refundArr);
		    	$this->session->set_flashdata('success_msg', 'Status updated successfully');
			} */
		    $this->output->set_header('Content-Type: application/json');
		    echo json_encode($json);
	    }else{
		    $this->output->set_header('Content-Type: application/json');
		    echo json_encode($json);
		} 
	}
	
	public function send_email($status,$email_data_array)
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
		    $mail->addAddress($email_data_array['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);
        $mail->Subject = "Prime Star Sports Services - Slot refund - $status";
		
		
		$from_html = "";
		$from_html .= "<!DOCTYPE>
<html>
<head>
    <title>Prime Star Sports Services - Slot refund $status </title>
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
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>";
        
        if($status =="Approved")
        {
        $from_html .= "<p>your slot refund approved successfully, your slot booking amount has been refunded successfully to wallet-Id: ".$email_data_array['parent_code']." please proceed to slot booking.</p>";
        }
        else
        {
            $from_html .= "<p>your slot refund request is rejected.</p>";
        
        }
        $from_html .= "
        <table>
            <tr>
                <th>reg-Id</th>
                <th>Psa-Id</th>
                <th>Name</th>
                <th>Bkid</th>
                <th>Date</th>
                <th>Activity</th>
                <th>Level</th>
                <th>Location</th>
                <th>Slot Time</th>
                <th>Status</th>
            </tr>
			
            <tr>
                <td>".$email_data_array['sid']."</td>
                <td>".$email_data_array['parent_code']."</td>
                <td>".$email_data_array['student_name']."</td>
                <td>".$email_data_array['booking_no']."</td>
                <td>".$email_data_array['booked_date']."</td>
                <td>".$email_data_array['activity_name']."</td>
                <td>".$email_data_array['level']."</td>
                <td>".$email_data_array['location']."</td>
                <td>".$email_data_array['from_time']." - ".$email_data_array['to_time']."</td>
                <td>".$email_data_array['approval_status']."</td>
            </tr>
        </table>";
        $from_html .= "<p>Your Wallet details as follows...</p>
        <p>Transaction ID :<b>WTXNO-24822</b></p>
        <table>
            <tr>
                <th>Parent-Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Payment Mode</th>
                <th>Previous balance(AED)</th>
                <th>Refund amount(AED)</th>
                <th>Wallet balance(AED)</th>
            </tr>
            <tr>
                <td>".$email_data_array['parent_code']."</td>
                <td>".$email_data_array['parent_name']."</td>
                <td>".date('d-m-Y')."</td>
                <td>Wallet</td>
                <td>".$email_data_array['prev_wallet_amount']."</td>
                <td>".$email_data_array['refund_amount']."</td>
                <td>".$email_data_array['current_wallet_amount']."</td>
                
            </tr>
        </table>
        <p><span style='background-color: #bfbbbb;border-radius: 6px;padding-bottom: 3px;'><strong style='font-size: 36px;'>...</strong></span></p>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='#'>www.primestaruae.com</a></p>
    </div>";
		$mail->Body = $from_html;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
		}
		else{
			return true;
		}
		
	}

	public function view($id){
		$data['title'] = 'Refund slot Approval';
		$slot = 	$slot = $this->db->query( "select bs.*,ba.activity_id,r.name as student_name,r.sid,p.parent_code from booked_slots bs 
			left join booking_approvals ba on ba.id=bs.booking_id
			left join registrations r on r.id=ba.student_id
			left join parent p on p.parent_id=ba.parent_id
			where bs.id=$id");
	   	$slotArray = $slot->row_array();
	   	$slotArray['activity_id'] = $this->transaction->getActivityDetail($slotArray['activity_id']);
	   	$slotArray['location_id'] = $this->transaction->getLocationDetail($slotArray['location_id']);
	   	$slotArray['coach_id'] = $this->transaction->getCoachDetail($slotArray['coach_id']);
	   	$slotArray['lane_court_id'] = $this->default->getLaneDetail($slotArray['lane_court_id']);
	   	$slotArray['level_id'] = $this->default->getLevelDetail($slotArray['level_id']);
	   	$slotArray['updated_admin_id'] = ($slotArray['updated_admin_id'] != 0)?$this->transaction->getUserDetail($slotArray['updated_admin_id']):'-';
    	$data['slot'] = $slotArray;

	   	$this->load->view('slotRefund/view', $data);
	}

	public function getTimeSlot(){
		$date = $this->input->post('change_slot_date');
		$activity_id = $this->input->post('activity_id');
		$day = date('w',strtotime($date));
		$weekdays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; 

		$slot = $this->db->query( "select id, slot_from_time, slot_to_time  from slot_selections  where `game_id` ='".$activity_id."' and `days` = '".$weekdays[$day]."'and `status` = 'Active' ");
	    $data['slotSelection'] = $slot->result_array();
	    echo  json_encode($data);
		
	}

}