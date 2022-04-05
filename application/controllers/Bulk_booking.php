<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bulk_booking extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }
        // Load library
        $this->load->library('form_validation');
        
        // Load database
        $this->load->model('Bulk_Booking_Model','bulk_booking_model');
	    $this->load->model('Regular_booking_model','regular_booking_model');
        $this->load->model('Pricing_Model','pricing_model');
        $this->load->model('Default_Model', 'default');
        $this->load->model('School_profile_report_Model', 'school');
        $this->load->model('Daily_Transaction_Model', 'transaction');
        $this->load->model('Invoice_Model', 'invoice_model');
    }
	
    public function index(){
	// Load our view to be displayed
        // to the user	        
        $data = array();
        $data['title'] = 'Bulk Booking';
        $data['username'] = $this->session->userdata('username');
        $data['sports_list'] = $this->regular_booking_model->get_sportslist();
        //$data['location_list'] = $this->pricing_model->get_locationlist();
        $data['day_list'] = $this->pricing_model->get_daylist();
        $data['form_action'] = base_url().'bulk_booking/add_booking_details'; 
        $this->load->view('includes/header3');
        //$this->load->view('templates/header', $data);
        $this->load->view('bulk_booking', $data);
        //$this->load->view('templates/footer', $data);
        
    }
    
    public function add_booking_details(){
        //die();
        $pay_mode = $this->input->post('pay_mode');
        
        $paid_status = ($this->input->post('hidden_balance_amount') > 0) ? 2 : 1;
        $insert_data = array(
			'booking_no' => 'NULL',
//            'sid' => $this->input->post('sports'),
//            'lid' => $this->input->post('location'),
            'customerid' => $this->input->post('cus_hid'),
            'btype' => '2',
            'bstatus' => '1',
            'bookedon' => date('Y-m-d'),
            'cancelled_on' => '0000-00-00',
            'paymode' => $this->input->post('pay_mode'),
            'Remarks' => 'NULL',
            'paystatus' => '1',
            'net_total' => $this->input->post('hidden_net_amount'),
            'discount_amount' => ($this->input->post('hidden_discount_amount') != '') ? $this->input->post('hidden_discount_amount') : '0',
            'advance_amount' => ($this->input->post('hidden_advance_amount') != '') ?  $this->input->post('hidden_advance_amount') : '0',
            'totamt' => $this->input->post('hidden_gross_amount'),	
           // 'paidamt' => (($this->input->post('hidden_net_amount')*5)/100)+$this->input->post('hidden_net_amount'),
           'paidamt' => $this->input->post('hidden_net_amount'),
            'balamt' => '0',
            'booked_by' => '0',
			'blocked_status' => '1',
			'reject_reason' => 'NULL'
        ); 
        $cus_wallet_amount = $this->input->post('customer_wallet_amount');
//        echo '<pre>';
//        print_r($insert_data);
//        print_r($insert_booking_slot_details);
//        die();

        /*$data = array();
        $data['sid'] = ($this->input->post('sports') !='') ? $this->input->post('sports') : '';
        $data['lid'] = ($this->input->post('location') !='') ? $this->input->post('location') : '';
        $data['cid'] = ($this->input->post('court') !='') ? $this->input->post('court') : '';
        $data['day_name'] = ($this->input->post('day_name') !='') ? $this->input->post('day_name') : '';     
        $data['from_date'] = change_date_format($this->input->post('from_date_bulk'));
        $data['to_date'] = change_date_format($this->input->post('to_date_bulk'));
        $data['from_time'] = date('H:i:s', strtotime($this->input->post('from_time')));
        $data['to_time'] = date('H:i:s', strtotime($this->input->post('to_time')));new*/

        $insert_id = $this->regular_booking_model->add_booking_details($insert_data);
        if($insert_id !='')
        {
            if($pay_mode == '1'){
                //$this->update_wallet_amount($cus_wallet_amount,$this->input->post('cus_hid'));
                $this->update_wallet_amount($insert_data['paidamt'], $insert_data['discount_amount'], $insert_data['customerid'], $insert_id, 'court_booking_regular');
            }
            
           /* $holiday_dates = $this->getDaysDate($this->input->post('day_name'),change_date_format($this->input->post('from_date_bulk')),change_date_format($this->input->post('to_date_bulk')));  
            //print_r($holiday_dates);die;
            $get_slotprice_details = array();
            //$pricing_details = array();
            foreach($holiday_dates as $key => $holiday_date){
                $holiday_id = $this->get_holiday_id($holiday_date);
            
                //$holiday_id = array_filter($holiday_id);
                $pricing_details = $this->bulk_booking_model->check_availability_pricing_timeslot($data, $holiday_id);
                //print_r($pricing_details);die;
                if($pricing_details)
                {
                    $booked_details = $this->bulk_booking_model->check_availability_booking_timeslot($data);
                    //print_r($booked_details);die;
                    if($booked_details){                
                        $array = array('msg'=> '0', 'data' => $booked_details);
                    }else{
                        $result = $this->get_price_timeslot($pricing_details, $data); 
                        //print_r($result);die;
                        $result['date'] = $holiday_date;
                        array_push($get_slotprice_details, $result);
                    }
                }
            }
            
            $insert_booking_slot_details = array();
            foreach($get_slotprice_details as $keyi => $valuei )
            {
                $insert_booking_slot_details2 = array(
                    'bid' => $insert_id,
                    'sid' => $this->input->post('sports'),
                    'lid' => $this->input->post('location'),
                    'courtid' => $this->input->post('court'),
                    'fromdate' => $valuei['date'],
                    'todate' => $valuei['date'],
                    'days' => $this->input->post('day_name'),
                );
                foreach($valuei as $keyi2 => $valuei2 )
                {
                    if(is_array($valuei2))
                    {
                        $insert_booking_slot_details2['booking_fromtime']= $valuei2['from_time_new'];
                        $insert_booking_slot_details2['booking_totime']= $valuei2['to_time_new'];
                        $insert_booking_slot_details2['amount']= $valuei2['cost'];
                    }
                }

                array_push($insert_booking_slot_details, $insert_booking_slot_details2);
            }

            $this->add_booking_slot_bulk($insert_booking_slot_details, $insert_id); new*/

            //old
            $insert_booking_slot_details = array(
                'bid' => $insert_id,
                'sid' => $this->input->post('sports'),
                'lid' => $this->input->post('location'),
                'courtid' => $this->input->post('court'),
                'fromdate' => change_date_format($this->input->post('from_date_bulk')),
                'todate' => change_date_format($this->input->post('to_date_bulk')),
                'days' => $this->input->post('day_name'),
                'booking_fromtime' => date('H:i:s', strtotime($this->input->post('from_time'))),
                'booking_totime' => date('H:i:s', strtotime($this->input->post('to_time'))),
                'amount' => $this->input->post('hidden_gross_amount')
            );
            $this->add_booking_slot($insert_booking_slot_details, $insert_id);/**/ // old code
            //$this->send_email($insert_id,$this->input->post('cus_hid'));
            $this->session->set_flashdata('success_message', 'Booking details added successfully!');
            redirect('bulk_booking');
        }else{
            $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
            redirect('bulk_booking');
        }
       
    }  
    
    
     public function send_email($booking_id,$customer_id)
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

        $mail->Subject = "Court Booking Primestar Sport Academy";

        $mail->AddEmbeddedImage('images/logo.jpg','logo');
        $reset_password_link = base_url().'admin/';
        header('Content-type: text/plain');
        $url = base_url();
        $mail->Body = $this->email_template($customer_details,$booking_details);
        
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
    
    private function email_template($customer_details,$booking_details){        
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
        <div style="clear:both;"></div>
        <p style="padding:10px 30px 0px 30px; text-align:left; font-size:13px; line-height:20px; color:#666; margin:0px;">You are booked under Bulk Booking. And your booking details are below</p>
        <div style="padding:10px 30px 20px 30px;">
        <table style="width:100%; font-size:13px;" cellpadding="0" cellspacing="0">
        <thead>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Activity</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">From Date</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">To Date</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Day</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Time Slot</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Court</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Location</th>
        <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Price(AED)<br/><span class="small">(Inclusive of 5% VAT)</span></th>
        </thead>
        <tbody>';
        $new_output = '';
		$primestar_url="http://www.primestaruae.com/booking/";
        foreach($booking_details as $key => $booking_list){
            $new_output .='<tr>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['sportsname']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.date('d-m-Y', strtotime($booking_list['fromdate'])).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.date('d-m-Y', strtotime($booking_list['todate'])).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.$booking_list['dayname'].'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.date('h:i A', strtotime($booking_list['booking_fromtime'])).'-'.date('h:i A', strtotime($booking_list['booking_totime'])).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['courtname']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.ucfirst($booking_list['location']).'</td>
            <td style="border:1px solid #F4F4F4; padding:5px; text-align:left; color:#666;">'.$booking_list['amount'].'</td>
            </tr>';
        } 
        $output .= $new_output;
        $output .='</tbody>
        </table>
        </div>
		<div style="padding:15px 30px 20px 30px; border-top:1px solid #e5e5e5; background:#fafafa; text-align:left; font-size:13px; line-height:20px; color:#666;">Thank you for booking. Please visit us again..!</div>
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
    
    private function get_customer_details($id) {
        $customer_details = $this->regular_booking_model->get_customerDetails($id);
        return $customer_details;
    }
    
    private function add_booking_slot($insert_booking_slot_details, $booking_id){
        $length = $this->count_digit($booking_id);
        $booking_no = $this->create_booking_no($booking_id, $length);
        $update_data = array(
            'booking_no' => $booking_no
        );
        $this->regular_booking_model->update_booking_details($update_data, $booking_id);
        if(!empty($insert_booking_slot_details)){          
            $this->regular_booking_model->add_bookingslot_details($insert_booking_slot_details);
        }
    }

    private function add_booking_slot_bulk($insert_booking_slot_details, $booking_id){
        $length = $this->count_digit($booking_id);
        $booking_no = $this->create_booking_no($booking_id, $length);
        $update_data = array(
            'booking_no' => $booking_no
        );
        $this->regular_booking_model->update_booking_details($update_data, $booking_id);
        if(!empty($insert_booking_slot_details)){          
            $this->regular_booking_model->add_bookingslot_details_bulk($insert_booking_slot_details);
        }
    }

    
    private function update_wallet_amount_old($amount, $id){
        $update_data = array(
            'amount' => $amount
        );
        $this->regular_booking_model->update_wallet_amount($update_data,$id);
    }

    private function update_wallet_amount($amount, $discount=0, $id, $booking_id, $from){
        $update_data = array(
            'amount' => $amount
        );
        $this->regular_booking_model->update_wallet_amount($update_data,$id);

        $vat_val1 =  sprintf("%2f",($amount*5)/100);
        $tot_amount = $amount + $vat_val1-$discount;

        $creditsDetails1 = $this->db->query('select * from prepaid_credits where parent_id='.$id);
        $creditsDetailsData1 = $creditsDetails1->row_array();
        $wallet_amount = $creditsDetailsData1['balance_credits'];
        
        $balance_credits = sprintf("%2f",$wallet_amount - $tot_amount);

        $update2=array(
            'balance_credits' => $balance_credits,
            'total_credits' => $balance_credits,
        );
        
        $this->db->where('parent_id',$id);
        $this->db->update('prepaid_credits', $update2);
        
        $txn_id = $this->school->getLastEntry('wallet_transactions');
        $wallet_transaction_id = 'WTXNO-'.$txn_id;

        $inv_id = $this->default->getInvoiceId('wallet_transactions');
        $invoice_id = 'PS'.date('Y').'-'.$inv_id;
        $sqlp="SELECT p.parent_code, p.parent_name, p.mobile_no,p.email_id FROM `parent` p 
        where p.parent_id=$id";
        $resultp = $this->db->query($sqlp)->row_array();
        
            
          $walletArray = array(
            'wallet_transaction_id' =>$wallet_transaction_id,
            'ac_code' => 'SBWT',
            'discount_percentage' => 0.00,
            'discount_value' => $discount,
            'wallet_transaction_date' =>date('Y-m-d'),
            'wallet_transaction_type' =>'Debit',
            'wallet_transaction_detail' => 'Court Booking Fees',
            'updated_admin_id' => $id,
            'reg_id' => NULL,
            'wallet_transaction_amount' => $tot_amount,
            'gross_amount' => $amount,
            'vat_percentage' => 5,
            'vat_value' => $vat_val1,
            'net_amount' => $tot_amount,
            'debit' => $tot_amount,
            'invoice' => 'yes',
            'invoice_id' =>$invoice_id,
            'slot_booking'=>$booking_id,
            'student_id'=> NULL,
            'parent_id'=> $id,
            'parent_name'=> $resultp['parent_name'],
            'parent_mobile'=> $resultp['mobile_no'],
            'parent_email_id'=> $resultp['email_id'],
            'description'=> 'Court Booking Fees',
            'created_at' => date('Y-m-d H:i:s'),
            'module' => 'Court Booking'
        );
        

        if($discount)
        {
            $walletArray['wallet_transaction_detail']= 'Court Booking Fees Discount';
            $walletArray['description']= 'Court Booking Fees Discount';
        }

        
        $checkexists = $this->db->query('select id from wallet_transactions where slot_booking ="'.$booking_id.'" and  ac_code ="SBWT" and wallet_transaction_type = "Debit" and module="Court Booking" ');
        $checkexistsArr = $checkexists->row_array();
        if (empty($checkexistsArr)){
          $this->db->insert('wallet_transactions', $walletArray); 
          $wallet_transaction_id = $this->db->insert_id();
        }else{
          $this->db->where('id', $checkexistsArr['id']);
          $this->db->update('wallet_transactions', $walletArray); 
          $wallet_transaction_id = $checkexistsArr['id'];
        }

        //Invoice 
        $this->send_email_booked_direct($booking_id, $walletArray,  $resultp['parent_code'], $wallet_amount, $balance_credits);
        $this->invoice_model->send_email_invoice($wallet_transaction_id, "CourtBooking");

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

		$mail->Subject = "Prime Star Sports Services - Your Courts Booked";
		
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
        <p>Dear <b>".$wallet_data_array['parent_name'].",</b></p>
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
           where b.id='$booking_id' and b.bstatus=1 and b.blocked_status=1
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

    
    private function count_digit($number) {
        return strlen((string) $number);
    }
    
    private function create_booking_no($id, $length) {
        if($length == '1'){
            $value = 'BKNO-000'.$id;
        }
        elseif($length == '2'){
            $value = 'BKNO-00'.$id;
        }
        elseif($length == '3'){
            $value = 'BKNO-0'.$id;
        }
        elseif($length > 3 ){
            $value = 'BKNO-'.$id;
        }
        return $value;
    }
    
    public function check_availability_timeslot(){
        $data = array();
        $data['sid'] = ($this->input->post('sid') !='') ? $this->input->post('sid') : '';
        $data['lid'] = ($this->input->post('lid') !='') ? $this->input->post('lid') : '';
        $data['cid'] = ($this->input->post('cid') !='') ? $this->input->post('cid') : '';
        $data['day_name'] = ($this->input->post('day_name') !='') ? $this->input->post('day_name') : '';     
        $data['from_date'] = ($this->input->post('from_date') !='') ? change_date_format($this->input->post('from_date')) : '';
        $data['to_date'] = ($this->input->post('to_date') !='') ? change_date_format($this->input->post('to_date')) : '';
        $data['from_time'] = ($this->input->post('from_time') !='') ? date('H:i:s', strtotime($this->input->post('from_time'))) : '';
        $data['to_time'] = ($this->input->post('to_time') !='') ? date('H:i:s', strtotime($this->input->post('to_time')))  : '';
        
        $holiday_dates = $this->getDaysDate($data['day_name'],$data['from_date'],$data['to_date']);  
		//print_r($holiday_dates);die;
        $get_slotprice_details = array();
        //$pricing_details = array();
        foreach($holiday_dates as $key => $holiday_date){
            $holiday_id = $this->get_holiday_id($holiday_date);
            
            //$holiday_id = array_filter($holiday_id);
            $pricing_details = $this->bulk_booking_model->check_availability_pricing_timeslot($data, $holiday_id);
            //print_r($pricing_details);die;
            if($pricing_details)
            {
                $booked_details = $this->bulk_booking_model->check_availability_booking_timeslot($data);
                //print_r($booked_details);die;
                if($booked_details){                
                    $array = array('msg'=> '0', 'data' => $booked_details);
                }else{
                    $result = $this->get_price_timeslot($pricing_details, $data); 
					//print_r($result);die;
                    $result['date'] = $holiday_date;
                    array_push($get_slotprice_details, $result);
                }
            }
            else{
                $array = array('msg'=> '0', 'data' => '');
            }
        }       
        //print_r($get_slotprice_details);die;     
        if($get_slotprice_details){   
            $sum = array_sum(array_map(function($var) {
            return $var['slot_price'];
            }, $get_slotprice_details));
            $get_slotprice_details['price'] = $sum;
            //print_r($get_slotprice_details);die;
            $array = array('msg'=> '1', 'data' => $get_slotprice_details);
        }else{
            $array = array('msg'=> '0', 'data' => '');
        }
                
        echo json_encode($array);
    }
    
   private function get_price_timeslot($pricing_details, $data){
       $time_slot_set = array();
//        echo '<pre>';
//        print_r($pricing_details);
//        die();
        foreach($pricing_details as $key => $value) { // city_b headings
            $posted_from_time = strtotime($data['from_time']);
            $posted_to_time = strtotime($data['to_time']);
            $from_time = strtotime($value['fromtime']);
            $to_time = strtotime($value['totime']);
            $time_diff = $to_time - $from_time;
            $postive =  ($time_diff / 600) / 6 ;
            //echo $postive;
            for($i = 1 ; $i <= $postive ; $i++ ){                 
                $timestamp = $from_time + ( 60*60) ;
                $time = date('h:i A', $timestamp);
                $new_fromtime = $time;
                //$time_slot_set[] = date('h:i A', $from_time).'--'.$new_fromtime;
                $time_slot_set[] = array(
                    'pid' => $value['pid'],
                    'from_time' => $from_time,
                    'to_time' => strtotime($new_fromtime),
                    'from_day' => $value['fromday'],
                    'to_day' => $value['today'],
                    'holiday_id' => $value['holiday_id'],
                    'day_type' => $value['day_type'],
                    'sid' => $data['sid'],
                    'lid' => $data['lid'],
                 );
                $from_time = strtotime($new_fromtime);
            }            
        }
        sort($time_slot_set);        
        $holiday_dates = $this->getDaysDate($data['day_name'],$data['from_date'],$data['to_date']);
        $filteredArray = $this->filterArray($time_slot_set, $data['day_name'], $holiday_dates);        
        $slot_price = 0;
        $new_array = array();        
        foreach($filteredArray as $array_key => $times){
            if($posted_from_time <= $times['from_time'] && $posted_to_time >= $times['to_time'] ){
                    $new_array[] = array(
                       'pid' => $times['pid'],
                       'from_time_new' => date('H:i:s',$times['from_time']),
                       'to_time_new' => date('H:i:s',$times['to_time']),
                       'cost' => $this->get_slotprice($times['pid'], date('H:i:s',$times['from_time']), date('H:i:s',$times['to_time']), $times['holiday_id'], $times['sid'], $times['lid'] ),
                    );
                    $slot_price = $slot_price + $this->get_slotprice($times['pid'], date('H:i:s',$times['from_time']), date('H:i:s',$times['to_time']), $times['holiday_id'], $times['sid'], $times['lid'] );
            }
        }  
        
        $new_array_slot = $this->filtercostArray($new_array);
//        echo '<pre>';
//        print_r($new_array);
//        die();
        $new_array_slot = array_reduce($new_array_slot, function ($a, $b) {
            isset($a[$b['from_time_new']]) ? $a[$b['from_time_new']]['cost'] += $b['cost'] : $a[$b['from_time_new']] = $b;  
            return $a;
        });
        $day_count = $this->countDaysByName($data['day_name'],$data['from_date'],$data['to_date']);
        //$new_array_slot['slot_count'] = count($new_array_slot);
        $new_array_slot['slot_count'] = count((array)$new_array_slot);
        $new_array_slot['slot_price'] = $slot_price;
        $new_array_slot['day_count_display'] = ($day_count > 1 ) ? $day_count.'&nbsp;Days' : $day_count.'&nbsp;Day';
        $new_array_slot['day_count'] = $day_count; 
        return $new_array_slot;
   }

   
   public function filterArray($array,$day_name, $holiday_dates){
       $new_array = array();
       $holiday_id = array();
        foreach($holiday_dates as $key => $holiday_date){
            $holiday_id[] = $this->get_holiday_id($holiday_date); 
        }
        foreach($array as $array_key => $times){
            if($times['holiday_id'] > 0){
                if($times['day_type'] == '1'){               
                    if( ( $times['from_day'] <= $day_name && $times['to_day'] >= $day_name ) &&  ( in_array($times['holiday_id'], $holiday_id) ) ){
                        $new_array[] = $times;
                    }
                }
                elseif($times['day_type'] == '0'){
                    if( ( $times['from_day'] == $day_name ) &&  ( in_array($times['holiday_id'], $holiday_id) ) ){
                        $new_array[] = $times;
                    }
                }
                else{
                   if( in_array($times['holiday_id'], $holiday_id) ){
                        $new_array[] = $times;
                    } 
                }
            }else{
                if($times['day_type'] == '1'){               
                    if( ( $times['from_day'] <= $day_name && $times['to_day'] >= $day_name ) ){
                        $new_array[] = $times;
                    }
                }
                elseif($times['day_type'] == '0'){
                    if( ( $times['from_day'] == $day_name ) ){
                        $new_array[] = $times;
                    }
                }
            }
        }
       // }
        return $new_array;
    }
    
    public function filtercostArray($array){
       $new_array = array();
        foreach($array as $array_key => $times){
            if( $times['cost'] !='' ){
                $new_array[] = $times;
            }            
        }
        return $new_array;
    }
   
   public function get_bulkBooking_list(){
       $output = '';
       $get_list = $this->bulk_booking_model->get_bulk_booking_list();
       if($get_list){
        foreach($get_list as $key => $get_details){
        $output .= '<tr>';
        $output .= '<td>'.ucfirst($get_details['customer_name']).'</td>';
        $output .= '<td>'.$get_details['customer_mobile'].'</td>';
        $output .= '<td>'.date('d-m-Y',strtotime($get_details['fromdate'])).'&nbsp;-&nbsp;'.date('d-m-Y',strtotime($get_details['todate'])).'</td>';
        //$output .= '<td>'.date('d-m-Y',strtotime($get_details['fromdate'])).'</td>';

        $output .= '<td>'.date('h:i A', strtotime($get_details['booking_fromtime'])).'-'.date('h:i A', strtotime($get_details['booking_totime'])).'</td>';
        $output .= '<td>'.substr($this->get_dayNameById($get_details['days']),0,3).'</td>';
        $output .= '<td>'.ucfirst($get_details['courtname']).'</td>';
        $output .= '<td>'.$get_details['gross_amount'].'</td>';
        $output .= '<td>'.$get_details['discount_amount'].'</td>';
        $output .= '<td>'.$get_details['net_amount'].'</td>';
        $output .= '<td>'.$get_details['paid_amount'].'</td>';
        //$output .= '<td>'.$get_details['balance_amount'].'</td>';
        $curdate=strtotime(date('Y-m-d'));
        //$mydate=strtotime($get_details['fromdate']);
        $getdate = $this->getDaysDate($get_details['days'],$get_details['fromdate'],$get_details['todate']);
        //print_r($getdate);die;
        $mydate = ($get_details['booking_type'] == '1') ? strtotime($get_details['fromdate']) : strtotime($getdate[0]) ;
//        echo '<pre>';
//        print_r($getdate);
        
        if($curdate < $mydate)
        {
        $output .= '<td><button type="button" class="btn btn-danger btn-xs booking-cancel" style="min-width: auto;" data-custid="'.$get_details['customerid'].'" data-bid="'.$get_details['bid'].'" data-id="'.$get_details['id'].'" data-paidamount="'.$get_details['paid_amount'].'" ><i class="glyphicon glyphicon-remove"></i></button></td>';
        }
        else{
          $output .= '<td>--</td>';  
        }
        $output .= '</tr>';
        }
       }else{
          $output .= '<tr>';
          $output .= '<td colspan="11">Sorry, No Record Found!</td>';
          $output .= '</tr>';
       }
       echo $output;
   }
    
   private function get_slotprice($pid, $fromtime, $totime, $holiday_id, $sid, $lid){
        $get_details = $this->bulk_booking_model->get_slotprice($pid, $fromtime, $totime, $holiday_id, $sid, $lid);
        $cost = '';
        if($get_details){
             $cost = $get_details['cost'];
        }       
       return $cost;
   }
   
    private function countDaysByName($dayid, $start_date, $end_date)
    {
        $no = 0;
        $start = new DateTime($start_date);
        $new_end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        $end   = new DateTime($new_end_date);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        foreach ($period as $dt)
        {
        if ($dt->format('N') == $dayid)
        {
        $no++;
        }
        }
        return $no;
    }
    
    private function getDaysDate($dayid, $start_date, $end_date)
    {
        
        $dates = array();
        for ($i = strtotime($start_date); $i <= strtotime($end_date); $i = strtotime('+1 day', $i)) {
            if (date('N', $i) == $dayid) //Monday == 1
              $dates[] = date('Y-m-d', $i); //prints the date only if it's a Monday
        }
        
        return $dates;
    }
    
    public function get_dayNameById($dayid){
        $dayname = '';
        $get_details = $this->bulk_booking_model->get_daysName($dayid);
        if($get_details){
            $dayname = $get_details['dayname'];
        }
        return $dayname;
    }
    
    public function get_holiday_id($date){
        $dayid = '';
        $get_details = $this->bulk_booking_model->get_holiday_id($date);
        if($get_details){
            $dayid = $get_details['id'];
        }
        return $dayid;
    }
    
    public function get_locationnames(){
        $data = array();
        $data['sports_id'] = ($this->input->post('sports_id') !='') ? $this->input->post('sports_id') : '';
        $get_details = $this->regular_booking_model->get_locationlist($data);
        $output = '<option value="">- Select Location -</option>';
        if($get_details){        
            foreach($get_details as $list){ 
                $output .='<option value="'.$list['location_id'].'">'.$list['location'].'</option>';
            }
        }
        echo $output;
    }
	
}

?>