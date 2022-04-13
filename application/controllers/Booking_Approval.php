<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_Approval extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }

        $this->load->model('Booking_Approval_Model', 'booking_approval_model');
        $this->load->model('Regular_booking_model','regular_booking_model');
		$this->load->model('School_profile_report_Model', 'school');
    }

    public function index(){
        $data = array();
        $data['title'] = 'Customer Booking Approval';
        $data['username'] = $this->session->userdata('username');
        $data['form_action'] = base_url().'booking_approval/booking_rejected';
        $this->load->view('includes/header3');
        //$this->load->view('templates_booking/header');
        $this->load->view('booking_approval',$data);
        //$this->load->view('templates_booking/footer');
    }
    
    public function get_booking_list(){
        $data = array();
        $data['id'] = '';
        $id='';
        $get_details = $this->booking_approval_model->get_customerbookinglist($id);
       
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {   
                    $output .= "<tr>";
                    $output .= "<td data-id='".$get_list['booking_id']."' class='details-control'></td>"; 
                    $output .= "<td>".++$key."</td>"; 
                    $output .= "<td>". ucfirst($get_list['customer_name']) ."</td>";
                    $output .= "<td>". $get_list['customer_mobile'] ."</td>"; 
                    $output .= "<td>". $get_list['booking_no'] ."</td>"; 
                    //$output .= "<td>". $this->get_booked_fromdate($get_list['booking_id'])."</td>";
                  //  $output .= "<td>". ucfirst($get_list['location']) ."</td>";
                   // $output .= "<td>". $this->get_booked_slot($get_list['booking_id']) ."</td>";                    
                   // $output .= "<td>". $this->get_booked_courtname($get_list['booking_id']) ."</td>";                    
                    $output .= "<td><button data-bid='".$get_list['booking_id']."' data-loading-text='Loading...' title='Approve' class='btn btn-success btn-xs approve_btn'><i class='fa fa-check-circle' aria-hidden='true'></i></button></td>";
                    $output .= "<td><a href='javascript:void(0);' data-bid='".$get_list['booking_id']."' title='Reject' class='btn btn-danger btn-xs reject_btn' data-toggle='modal' data-target='#rejectModal'><i class='fa fa-ban' aria-hidden='true'></i></a></td>";
                    $output .= "</tr>";
                }
        }
        echo $output;
    }
    
    public function get_bookingslot_list(){
        $data = array();
        $booking_id = ($this->input->post('id')) ? $this->input->post('id') : '';
        $get_details = $this->booking_approval_model->get_customerbookingslotlist($booking_id);
       
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {   
                    $output .= "<tr>"; 
                    $output .= "<td>".++$key."</td>";                    
                    $output .= "<td>". date('d-m-Y', strtotime($get_list['fromdate']))."</td>";
                    $output .= "<td>". date('h:i A', strtotime($get_list['booking_fromtime'])).'-'.date('h:i A', strtotime($get_list['booking_totime'])) ."</td>";                    
                    $output .= "<td>".$get_list['sportsname']."</td>";
                    $output .= "<td>".$get_list['location']."</td>";
                    $output .= "<td>". ucfirst($get_list['courtname']) ."</td>";                    
                    $output .= "</tr>";
                }
        }
        echo $output;
    }
    
     public function get_booked_fromdate($booking_id){
        $get_details = $this->booking_approval_model->get_customerbookingslotlist($booking_id);
        //date('d-m-Y', strtotime($get_list['fromdate']));
        $booking_from_date = array();
        if($get_details){                
            foreach($get_details as $key => $get_list)
            {  
                $booking_from_date[] = date('d-m-Y', strtotime($get_list['fromdate']));
            }                
        }
        $new_array = $this->display_arrayvalues($booking_from_date);
        return $new_array;
     }
     
     public function display_arrayvalues($array){         
         $unique_array = array_unique($array);
         $display_array = '';         
         foreach($unique_array as $key => $array_list)
            {  
                $display_array .= $array_list;
                $display_array .= '<br/>';
            }  
            return $display_array;
     }
     
     public function get_booked_slot($booking_id){
        $get_details = $this->booking_approval_model->get_customerbookingslotlist($booking_id);
        //date('d-m-Y', strtotime($get_list['fromdate']));
        $booking_slot = array();
        if($get_details){                
            foreach($get_details as $key => $get_list)
            {  
                $booking_slot[] = date('h:i A', strtotime($get_list['booking_fromtime'])).'-'.date('h:i A', strtotime($get_list['booking_totime']));
            }                
        }
        $new_array = $this->display_arrayvalues($booking_slot);
        return $new_array;
     }
     
     public function get_booked_courtname($booking_id){
        $get_details = $this->booking_approval_model->get_customerbookingslotlist($booking_id);
        //date('d-m-Y', strtotime($get_list['fromdate']));
        $booking_courtname = array();
        if($get_details){                
            foreach($get_details as $key => $get_list)
            {  
                $booking_courtname[] = ucfirst($get_list['courtname']);
            }                
        }
        $new_array = $this->display_arrayvalues($booking_courtname);
        return $new_array;
     }
     
     public function booking_rejected(){
        $reason = ($this->input->post('reason')) ? $this->input->post('reason') : '';
        $id = ($this->input->post('hidden_id')) ? $this->input->post('hidden_id') : '';
        $booking_details = $this->booking_details($id);
        $customerid = ($booking_details!='')  ? $booking_details['customerid'] : '';
        $update_data = array(
            'reject_reason' => $reason,
            'cancelled_on' => date('Y-m-d'),
            'bstatus' => '2',
            'blocked_status' => '2'
        );
        //$update = $this->booking_approval_model->update_booking_details($update_data, $id);
        //echo json_encode($update); 
        if($this->booking_approval_model->update_booking_details($update_data, $id))
        {
			$arr = array('cancelled'=>1);
			$this->db->where('bid', $id);
			$this->db->update('bookingslot', $arr);
            $this->send_email_booked_rejected($id);
            $this->session->set_flashdata('success_message', 'Booking details Rejected successfully!');
            redirect('booking_approval');
        }else{
            $this->session->set_flashdata('error_message', 'Data are not updated Properly!');
            redirect('booking_approval');
        }
     }
     
     public function booking_approved(){
        $id = ($this->input->post('id')) ? $this->input->post('id') : '';
        $exist_result = '';
        if(in_array("1", $this->check_already_approved($id))) {
            $exist_result = 'exist';
           // echo $exist_result; 
        }else{
            $booking_details = $this->booking_details($id);
            $total_amount = ($booking_details!='') ? $booking_details['total_amount'] : '';
            $wallet_amount = ($booking_details!='')  ? $booking_details['wallet_amount'] : '';
            $customerid = ($booking_details!='')  ? $booking_details['customerid'] : '';
            $update_data = array(
                'bstatus' => '1',
                //'paidamt' => $total_amount,
                'blocked_status' => '1'
            );
            if($this->booking_approval_model->update_booking_details($update_data, $id))
            {             
                /*$new_wallet_amount = $wallet_amount - $total_amount;       
                $customer_update_data = array(
                    'amount' => $new_wallet_amount
                );
                $update = $this->booking_approval_model->update_customerWallet_details($customer_update_data, $customerid);
				*/
                //if($this->send_email($id,$customerid,1)){
                if($this->send_email_booked_direct($id)){
                    $exist_result = 'Not exist';
                }
            }
        }
        echo $exist_result;  
        
     }
     
     public function check_already_approved($booking_id){
        $get_bookingslot_list = $this->booking_approval_model->get_customerbookingslotlist($booking_id);
        $result = array();
        if($get_bookingslot_list) {
            foreach($get_bookingslot_list as $key => $row){
               // $location_id = $row['lid'];
                $court_id = $row['courtid'];
                $from_date = $row['fromdate'];
                $to_date = $row['todate'];
                $day_id = $row['days'];
                $from_time = $row['booking_fromtime'];
                $to_time = $row['booking_totime'];
                $check_booked_slot = $this->booking_approval_model->check_bookedslot_exist($court_id, $from_time, $to_time, $from_date, $to_date, $day_id);
                if($check_booked_slot){
                    array_push($result, '1');
                }
            }
        }
        return $result;
    }
     
     public function booking_details($booking_id){
        $get_details = $this->booking_approval_model->get_customerbookinglist($booking_id); 
        $result = array();
        if($get_details) {
            foreach($get_details as $key => $row){
                $result['total_amount'] = $row['total_amount'];
                $result['wallet_amount'] = $row['wallet_amount'];
                $result['customerid'] = $row['customerid'];
            }
        }
        return $result;
     }
     
     private function get_customer_details($id) {
        $customer_details = $this->regular_booking_model->get_customerDetails($id);
        return $customer_details;
    }
     
     public function send_email($booking_id,$customer_id,$blocked_status)
    {
        $customer_details = $this->get_customer_details($customer_id);
        $booking_details = $this->regular_booking_model->view_booking_details($booking_id);
        
        $email = $customer_details['email'];
        $name = ucfirst($customer_details['name']);
        $this->load->helper('string');
        $this->load->library('phpmailer');
        require_once(APPPATH.'libraries/class.smtp.php');
        
        $mail =  $this->phpmailer;
        $mail->SMTPDebug = 0;  
        $mail->isSMTP();                           
         $mail->Host = smpt_host;
        $mail->SMTPAuth = false;                              
        $mail->Username = smpt_username;                 
        $mail->Password = smpt_password;                           
        //$mail->SMTPSecure = "tls";                           

        $mail->Port = 25;                                   

        $mail->From = smpt_fromaddress;
        $mail->FromName = smpt_fromname;

        $mail->addAddress($email, $name);
        $mail->addCC(smpt_fromaddress, smpt_fromname);
        
        $mail->isHTML(true);
        if($blocked_status == '2'){           
            $mail->Subject = "Booking Cancelled";
        }else{
            $mail->Subject = "Court Booking Primestar Sports Services";
        }
        $mail->AddEmbeddedImage('images/logo.jpg','logo');
        $reset_password_link = base_url().'admin/';
        header('Content-type: text/plain');
        $url = base_url();
        $mail->Body = $this->email_template($customer_details,$booking_details, $blocked_status);
        
        $mail->AltBody = "This is the plain text version of the email content";
		//$hash ="";
        if(!$mail->send()) 
        {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {          
            return true;           
        }                
    }
    
	
	
	public function send_email_booked_direct($booking_id)
	{
		
		$sql="select p.* from booking b left join parent p on p.parent_id = b.customerid where b.id='$booking_id'";
		$row = $this->db->query($sql)->row_array();
		
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
		    $mail->addAddress($row['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Courts Booking Approved";
		
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
        <p>Dear <b>".$row['parent_name'].",</b></p>
        <p>We are pleased to inform you that your Court booking is successful.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Time</th>
                <th>Court</th>
                
            </tr>";
            $sql ="select b.booking_no,bs.fromdate  as booked_date, s.sportsname as game,l.location,c.courtname,bs.booking_fromtime as from_time,bs.booking_totime as to_time
            from booking b 
            left join bookingslot bs on bs.bid=b.id
           left join sports s on bs.sid=s.id
           left join location_booking l on l.id=bs.lid
           left join court c on bs.courtid=c.id
           where b.id='$booking_id' and b.bstatus=1 and b.blocked_status=0 and bs.cancelled !=1
            ";
            
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['courtname']."</td>
                
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
	
	public function send_email_booked_rejected($booking_id)
	{
		
		$sql="select p.*,sum(bs.amount) as amount, bs. from booking b left join bookingslot bs on bs.bid=b.id 
		left join parent p on p.parent_id = b.customerid where b.id='$booking_id'";
		$row = $this->db->query($sql)->row_array();
		$parent_id = $row['parent_id'];
		$amount = $row['amount'];
		
		$vat_val = round((($amount*5)/100),2);
		$gross_amount = $amount-$vat_val;
		$credit = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
		$creditVal=$credit->row_array();
		$total_credits=$creditVal['balance_credits'];
		$balance_credits=round($total_credits+$row['amount'],2);
		$sql="Update  prepaid_credits set balance_credits='".$balance_credits."',total_credits='".$balance_credits."' where parent_id='".$row['parent_id']."' ";
		$insert=$this->db->query($sql);
		
		$txn_id = $this->school->getLastEntry('wallet_transactions');
	  $wallet_transaction_id = 'WTXNO-'.$txn_id;

	  //$inv_id = $this->default->getInvoiceId('wallet_transactions');
	  //$invoice_id = 'PS'.date('Y').'-'.$inv_id;
		
	
	  $walletArray = array(
			'wallet_transaction_id' =>$wallet_transaction_id,
			'ac_code' => 'REFWTR',
			'wallet_transaction_date' =>date('Y-m-d'),
			'wallet_transaction_type' =>'Credit',
			'wallet_transaction_detail' => 'Court Booking Fees - Refund',
			'updated_admin_id' => $this->session->userdata('user_id'),
			'reg_id' => NULL,
			'wallet_transaction_amount' => $row['amount'],
			'gross_amount' => $gross_amount,
			'vat_percentage' => 5.00,
			'vat_value' => $vat_val,
			'net_amount' => $row['amount'],
			'credit' => $row['amount'],
			'invoice' => '',
			'invoice_id' =>'',
			'slot_booking'=>$booking_id,
			'student_id'=> NULL,
			'parent_id'=> $row['parent_id'],
			'parent_name'=> $row['parent_name'],
			'parent_mobile'=> $row['mobile_no'],
			'parent_email_id'=> $row['mail_id'],
			'description'=> 'Court Booking Fees - Refund',
		);
		$this->db->insert('wallet_transactions', $walletArray);
		
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
		    $mail->addAddress($row['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Your Courts Booking Approved";
		
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
        <p>Dear <b>".$row['parent_name'].",</b></p>
        <p>We are pleased to inform you that your Court booking is successful.</p>
        <table>
            <tr>
                <th>BKId</th>
                <th>Booking Date</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Time</th>
                <th>Court</th>
                
            </tr>";
            $sql ="select b.booking_no,bs.fromdate  as booked_date, s.sportsname as game,l.location,c.courtname,bs.booking_fromtime as from_time,bs.booking_totime as to_time
            from booking b 
            left join bookingslot bs on bs.bid=b.id
           left join sports s on bs.sid=s.id
           left join location_booking l on l.id=bs.lid
           left join court c on bs.courtid=c.id
           where b.id='$booking_id' and b.bstatus=1 and b.blocked_status=0 and bs.cancelled !=1
            ";
            
            foreach($this->db->query($sql)->result_array() as $key => $value) { 
        
        $body .= "<tr>
                <td>".$value['booking_no']."</td>
                <td>".$value['booked_date']."</td>
                <td>".$value['game']."</td>
                <td>".$value['location']."</td>
                <td>".$value['from_time']."-".$value['to_time']."</td>
                <td>".$value['courtname']."</td>
                
            </tr>";
        }
         $body .= "</table>
        <p>Your Wallet details as follows</p>
        <p style='text-align: right;'>Transaction ID :<b>".$walletArray['wallet_transaction_id']."</b></p>
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
                <td>".$row['parent_code']."</td>
                <td>".$walletArray['parent_name']."</td>
                <td>".$walletArray['wallet_transaction_date']."</td>
                <td>".round(sprintf("%2f",$total_credits),2)."</td> 
                <td>".round(sprintf("%2f",$walletArray['wallet_transaction_amount']),2)."</td>
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
	
    private function email_template($customer_details,$booking_details, $blocked_status){
        if($blocked_status == '1'){
            $message = 'Thanks for booking. Your booking court was approved.';
        }else{
            $message = 'Sorry! we are currently unable to process your request';
        }
        $output = '<!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Newsletter</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/jpg" href="images/favicon.jpg" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file: --> 
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        .main_container {
        width: 768px;
        margin: 0 auto;
        }
        @media screen and (max-width: 768px) {
        .main_container {
        width: auto;
        }
        }
        </style>
        </head>
        <body style="padding:20px; margin:0; background:rgba(0, 0, 0, 0.1); font-family:Tahoma, Arial, Helvetica, sans-serif;">
        <div class="main_container" style="background:#FFF; border:1px solid rgba(0, 0, 0, 0.2); padding:1px;"> 
        <!-- HEADER STARTS -->
        <div style="background:#ee1d23; padding:10px; text-align:center; margin-bottom:20px;"> <img src="'.base_url().'images/logo.jpg" alt="" />
        <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
        <!-- NAVIGATION ENDS --> 
        <!-- HEADER ENDS --> 
        <!-- MAIN CONTENT STARTS -->
        <section class="main_container">
		<p style="padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); ">Welcome to <strong style="color:#ee1d23; font-weight:300;">Primestar Sport Academy</strong></p>';
       
        $output .='<p style="padding:0px 20px 10px 20px; text-align:center; font-size:28px; line-height:36px; margin:0px; color:#000; border-bottom:1px solid rgba(0, 0, 0, 0.1); ">Court Booking Summary</p>
        <div style="padding:10px 30px; margin:0px; float:left; text-align:left; font-size:14px; line-height:26px; color:#333;">Dear <strong>'.ucfirst($customer_details['name']).' ,</strong></div>
        <div style="padding:10px 30px; margin:0px; float:right; text-align:right; font-size:14px; line-height:26px; color:#333;">Booking ID : <strong>'.$booking_details[0]['booking_no'].'</strong></div>
        <div style="clear:both;"></div>';
        if($blocked_status == '1'){
        $output .='<p style="padding:10px 30px 0px 30px; text-align:left; font-size:13px; line-height:20px; color:#666; margin:0px;">Thanks for booking!. Your booking court was approved and your booking details are given below</p>
        <div style="padding:10px 30px 20px 30px;">
        <table style="width:100%; font-size:13px;" cellpadding="0" cellspacing="0">
        <thead>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Activity</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Booking Date</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Day</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Time</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Court</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Location</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Price(AED)<br/><span class="small">(Inclusive of 5% VAT)</span></th>
        </thead>
        <tbody>';
        $new_output = '';
        foreach($booking_details as $key => $booking_list){
            $new_output .='<tr>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['sportsname']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.date('d-m-Y', strtotime($booking_list['fromdate'])).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.$booking_list['dayname'].'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.date('h:i A', strtotime($booking_list['booking_fromtime'])).'-'.date('h:i A', strtotime($booking_list['booking_totime'])).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['courtname']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['location']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.$booking_list['amount'].'</td>
            </tr>';
        } 
        $output .= $new_output;
        $output .='</tbody> </table></div>';
        }
        else{
            $output .='<p style="padding:10px 30px 0px 30px; text-align:left; font-size:13px; line-height:20px; color:#666; margin:0px;">'.$message.'</p>';
        }
        $primestar_url="http://www.primestaruae.com/";
        $output .='<div style="padding:15px 30px 20px 30px; border-top:1px solid #e5e5e5; background:#fafafa; text-align:left; font-size:13px; line-height:20px; color:#666;">Thank you for booking. Please visit us again..!</div>
        <div style="clear:both;"></div>
		
        <div style="padding:15px 30px 20px 30px; border-top:1px solid #e5e5e5; background:#fafafa; text-align:left; font-size:13px; line-height:20px; color:#666;">Click here to visit our website: <a href="'.$primestar_url.'" target="_blank" style="color:#36F;">www.primestaruae.com</a></div>
        <div style="clear:both;"></div>
        </section>
        <!-- MAIN CONTENT ENDS -->
        <div style="clear:both;"></div>
        </div>
        </body>
        </html>';
        return $output;
    }
	
}

?>