<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Court_booking extends CI_Controller{
    
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
	    $this->load->model('Court_booking_model', 'court_booking_model');
        $this->load->model('Bulk_Booking_Model','bulk_booking_model');
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
        $data['title'] = 'Court Booking';
        $data['username'] = $this->session->userdata('username');
        $data['sports_list'] = $this->court_booking_model->get_sportslist();
        //$data['location_list'] = $this->pricing_model->get_locationlist();
        $data['form_action'] = base_url().'Court_booking/add_booking_details'; 
        $this->load->view('includes/header3');
       // $this->load->view('templates/header', $data);
        $this->load->view('court_booking', $data);
       // $this->load->view('templates/footer', $data);
        
    }
    
    public function add_booking_details(){
        //die()
        //print_r($_POST);die;
        $pay_mode = $this->input->post('pay_mode');
        if($pay_mode == '1'){
            if($this->input->post('hidden_advance_amount') !=''){
                $paid_amount = $this->input->post('hidden_advance_amount');
            }else{
                $paid_amount = $this->input->post('hidden_balance_amount');
            }
        }else{
            $paid_amount = $this->input->post('advance_amount');
        }
        $paid_status = ($this->input->post('hidden_balance_amount') > 0) ? 2 : 1;
        $parent_id = $this->input->post('cus_hid');
        $insert_data = array(
			'booking_no' => 'NULL',
           // 'sid' => $this->input->post('sports'),
            //'lid' => $this->input->post('location'),
            'customerid' => $this->input->post('cus_hid'),
            'btype' => '1',
            'bstatus' => '1',
            'bookedon' => date('Y-m-d'),
            'cancelled_on' => '0000-00-00',
            'paymode' => $this->input->post('pay_mode'),
            'Remarks' => '',
            'paystatus' => '1',
            'net_total' => $this->input->post('hidden_net_amount'),
            'discount_amount' => ($this->input->post('hidden_discount_amount') != '') ? $this->input->post('hidden_discount_amount') : '0',
            'advance_amount' => ($this->input->post('hidden_advance_amount') != '') ?  $this->input->post('hidden_advance_amount') : '0',
            'totamt' => $this->input->post('hidden_gross_amount'),	
            'paidamt' => $this->input->post('hidden_net_amount'),
            'balamt' => '0',
            'booked_by' => '0',
			'blocked_status' => '1',
			'reject_reason' => 'NULL',
            'booking_for' => $this->input->post('booking_for')
            
        ); 
        $cus_wallet_amount = $this->input->post('customer_wallet_amount');
        
        $hidden_id = $this->input->post('hidden_id', TRUE); 
        $hidden_booking_date = $this->input->post('hidden_booking_date', TRUE); 
        $hidden_fromtime = $this->input->post('hidden_fromtime', TRUE);
        $hidden_totime = $this->input->post('hidden_totime', TRUE);
        $hidden_sid = $this->input->post('hidden_sid', TRUE);
        $hidden_lid = $this->input->post('hidden_lid', TRUE);
        $hidden_cid = $this->input->post('hidden_cid', TRUE);
        $hidden_cost = $this->input->post('hidden_cost', TRUE);
        $booking_for = $this->input->post('booking_for', TRUE);
        $vat_perc = $this->input->post('hidden_vat_perc', TRUE);
        
        $insert_booking_slot_details = array(
            'slot_ids' => $hidden_id,
            'booked_date' => $hidden_booking_date,
            'fromdate' => $hidden_booking_date,
            'todate' => $hidden_booking_date,
            'slot_fromtimes' => $hidden_fromtime,
            'slot_totimes' => $hidden_totime,
            'sports_ids' => $hidden_sid,
            'location_ids' => $hidden_lid,
            'court_ids' => $hidden_cid,
            'slot_price' => $hidden_cost,
            'booking_for' => $booking_for,
        );

        $data2 = array(
            'vat_perc'=>$this->input->post('hidden_vat_perc'),
            'discount'=>$this->input->post('discount_amount')
        );
        $insert_id = $this->court_booking_model->add_booking_details($insert_data);
		
        if($insert_id !='')
        {
            $this->add_booking_slot($insert_booking_slot_details,$insert_id, $data2);
            
            if($pay_mode == '1'){
                $this->update_wallet_amount($insert_data['totamt'], $insert_data['discount_amount'], $insert_data['customerid'], $insert_id, 'court_booking_regular');
            }
            

            $sql="DELETE from tmp_booking_court where parent_id='$parent_id'";
            $this->db->query($sql);

            $booking_status = '1';
            //$this->send_email($insert_id,$this->input->post('cus_hid'),$booking_status);
            $this->load->helper('cookie');    
            $past = time() - 3600;
            foreach ( $_COOKIE as $key => $value )
            {
                //echo $key.'----'.$value.'<br/>';
                if($key != 'ci_session'){
                    setcookie($key, '', $past);
                    setcookie( $key, '', $past, '/' );
                }

            }
            $this->session->set_flashdata('success_message', 'Booking details added successfully!');
            redirect('Court_booking');
        }else{
            $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
            redirect('Court_booking');
        }
       
    } 
    
    public function send_email($booking_id,$customer_id, $booking_status)
    {
        $customer_details = $this->get_customer_details($customer_id);
        $booking_details = $this->court_booking_model->view_booking_details($booking_id);
		
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
        if($booking_status == '2'){           
            $mail->Subject = "Booking Cancelled";
        }else{
            $mail->Subject = "Court Booking Primestar Sport Academy";
        }
        $mail->isHTML(true);

        //$mail->Subject = "Court Booking Primestar Sport Academy";

        $mail->AddEmbeddedImage('images/logo.jpg','logo');
        $reset_password_link = base_url().'admin/';
        header('Content-type: text/plain');
        $url = base_url();
        $mail->Body = $this->email_template($customer_details,$booking_details,$booking_status);
        
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
    
    private function email_template($customer_details,$booking_details,$booking_status){ 
     
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
        if($booking_status == '1'){
            $output .='<p style="padding:10px 30px 0px 30px; text-align:left; font-size:13px; line-height:20px; color:#666; margin:0px;">You are booked under Regular Booking. And your booking details are below</p>
            <div style="padding:10px 30px 20px 30px;">
            <table style="width:100%; font-size:13px;" cellpadding="0" cellspacing="0">
            <thead>
            <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">Activity</th>
            <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">From Date</th>
            <th style="border:1px solid #e9e9e9; padding:5px; text-align:left; color:#222; background:#f8f8f8; font-weight:600;">To Date</th>
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
            </div>';
        }
        else{
            $output .='<p style="padding:10px 30px 0px 30px; text-align:left; font-size:13px; line-height:20px; color:#666; margin:0px;">Sorry! we are currently unable to process your request</p>';
        }
        $primestar_url= USER_PATH;
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
    
    private function get_customer_details($id) {
        $customer_details = $this->court_booking_model->get_customerDetails($id);
        return $customer_details;
    }
    
    public function update_booking_details($booking_id){
      
        $update_data = array(
            'Remarks' => $this->input->post('remarks'),
            'paystatus' => '1',	
            'balamt' => '0'
        ); 
        
        if($this->court_booking_model->update_booking_details($update_data, $booking_id))
        {
            $this->session->set_flashdata('success_message', 'Booking details updated successfully!');
            redirect('Court_booking');
        }else{
            $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
            redirect('Court_booking');
        }
    }
    
    private function add_booking_slot($insert_booking_slot_details, $booking_id, $data2){
        $length = $this->count_digit($booking_id);
        $booking_no = $this->create_booking_no($booking_id, $length);
        $update_data = array(
            'booking_no' => $booking_no
        );
        $this->court_booking_model->update_booking_details($update_data, $booking_id);

        $discount_each = round($data2['discount']/count($insert_booking_slot_details['court_ids']),2);
        if(!empty($insert_booking_slot_details)){
            for($i=0; $i<count($insert_booking_slot_details['court_ids']); $i++){
                    //echo  $key.'-->'.$value[$i].'<br/>';
                    $sports_id = $insert_booking_slot_details['sports_ids'][$i];
                    $location_id = $insert_booking_slot_details['location_ids'][$i];
                    $court_id = $insert_booking_slot_details['court_ids'][$i];
                    $fromdate = $insert_booking_slot_details['fromdate'][$i];
                    $todate = $insert_booking_slot_details['todate'][$i];
                    $fromtime = $insert_booking_slot_details['slot_fromtimes'][$i];
                    $totime =  $insert_booking_slot_details['slot_totimes'][$i];
                    $amount =  $insert_booking_slot_details['slot_price'][$i];

                    $amount2 = $amount-$discount_each;
                    $vat_amount = round(($amount2*$data2['vat_perc'])/100,2);
                    $net_amount = round($amount2+$vat_amount,2);
                    $insert_booking_slot_data = array(
                        'bid' => $booking_id,
                        'sid' => $sports_id,
                        'lid' => $location_id,
                        'courtid' => $court_id,
                        'booked_date' => date('Y-m-d', strtotime($fromdate)),
                        'fromdate' => date('Y-m-d', strtotime($fromdate)),
                        'todate' => date('Y-m-d', strtotime($todate)),
                        'days' => $this->get_dayid(date('l', strtotime($fromdate))),
                        'booking_fromtime' => $fromtime,
                        'booking_totime' => $totime,
                        'gross_amount' => $amount,
                        'discount_amount' => $discount_each,
                        'vat_perc' => $data2['vat_perc'],
                        'vat_amount' => $vat_amount,
                        'amount' => $net_amount,
                    );
                    $this->court_booking_model->add_bookingslot_details($insert_booking_slot_data);
                    //print_r($insert_booking_slot_data);
            }
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
    
    private function update_wallet_amount($amount, $discount, $id, $booking_id, $from){
        //echo $booking_id;die;
        /*$update_data = array(
            'amount' => $amount
        );
        $this->court_booking_model->update_wallet_amount($update_data,$id);*/

        if ($from=="court_booking_regular"){
            $vat_val1 =  sprintf("%2f",(($amount-$discount)*5)/100);
            $tot_amount = ($amount-$discount) + $vat_val1;

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
        elseif ($from=="court_booking_regular_cancellation"){
            $vat_val1 =  sprintf("%2f",(($amount-$discount)*5)/100);
            $tot_amount = ($amount-$discount) + $vat_val1;


            $creditsDetails1 = $this->db->query('select * from prepaid_credits where parent_id='.$id);
            $creditsDetailsData1 = $creditsDetails1->row_array();
            $wallet_amount = $creditsDetailsData1['balance_credits'];
            
            $balance_credits = sprintf("%2f",$wallet_amount + $tot_amount);

            $update2=array(
                'balance_credits' => $balance_credits,
                'total_credits' => $balance_credits,
            );
            
            $this->db->where('parent_id',$id);
            $this->db->update('prepaid_credits', $update2);
            
            $txn_id = $this->school->getLastEntry('wallet_transactions');
            $wallet_transaction_id = 'WTXNO-'.$txn_id;

            
            $sqlp="SELECT p.parent_code, p.parent_name, p.mobile_no,p.email_id FROM `parent` p 
            where p.parent_id=$id";
            $resultp = $this->db->query($sqlp)->row_array();
            
                
            $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'ac_code' => 'REFWTR',
                'discount_percentage' => 0.00,
                'discount_value' => $discount,
                'wallet_transaction_date' =>date('Y-m-d'),
                'wallet_transaction_type' =>'Credit',
                'wallet_transaction_detail' => 'Court Booking Fees - Cancellation',
                'updated_admin_id' => $id,
                'reg_id' => NULL,
                'wallet_transaction_amount' => $tot_amount,
                'gross_amount' => $amount,
                'vat_percentage' => 5,
                'vat_value' => $vat_val1,
                'net_amount' => $tot_amount,
                'debit' => $tot_amount,
                'invoice' => '',
                'invoice_id' =>'',
                'slot_booking'=>$booking_id,
                'student_id'=> NULL,
                'parent_id'=> $id,
                'parent_name'=> $resultp['parent_name'],
                'parent_mobile'=> $resultp['mobile_no'],
                'parent_email_id'=> $resultp['email_id'],
                'description'=> 'Court Booking Fees',
                'created_at' => date('Y-m-d H:i:s'),
                'module' => 'Court Booking - Cancellation'
            );
            

            if($discount)
            {
                $walletArray['wallet_transaction_detail']= 'Court Booking Fees Discount Cancellation';
                $walletArray['description']= 'Court Booking Fees Discount Cancellation';
            }

            
            
            $this->db->insert('wallet_transactions', $walletArray); 
            $wallet_transaction_id = $this->db->insert_id();
            

            //Invoice 
            $this->send_email_booked_direct_cancelled($booking_id, $walletArray,  $resultp['parent_code'], $wallet_amount, $balance_credits);
            
        }
        elseif ($from=="court_booking_regular_cancellation_bulk"){
            //echo 'inside';die;
            $vat_val1 =  sprintf("%2f",($amount*5)/100);
            $vat_val1 = 0.00;
            $tot_amount = $amount + $vat_val1-$discount;

            $creditsDetails1 = $this->db->query('select * from prepaid_credits where parent_id='.$id);
            $creditsDetailsData1 = $creditsDetails1->row_array();
            $wallet_amount = $creditsDetailsData1['balance_credits'];
            
            $balance_credits = sprintf("%2f",$wallet_amount + $tot_amount);

            $update2=array(
                'balance_credits' => $balance_credits,
                'total_credits' => $balance_credits,
            );
            
            $this->db->where('parent_id',$id);
            $this->db->update('prepaid_credits', $update2);
            
            $txn_id = $this->school->getLastEntry('wallet_transactions');
            $wallet_transaction_id = 'WTXNO-'.$txn_id;

            
            $sqlp="SELECT p.parent_code, p.parent_name, p.mobile_no,p.email_id FROM `parent` p 
            where p.parent_id=$id";
            $resultp = $this->db->query($sqlp)->row_array();
            
                
            $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'ac_code' => 'REFWTR',
                'discount_percentage' => 0.00,
                'discount_value' => $discount,
                'wallet_transaction_date' =>date('Y-m-d'),
                'wallet_transaction_type' =>'Credit',
                'wallet_transaction_detail' => 'Court Booking Fees - Cancellation Bulk',
                'updated_admin_id' => $id,
                'reg_id' => NULL,
                'wallet_transaction_amount' => $tot_amount,
                'gross_amount' => $amount,
                'vat_percentage' => 5,
                'vat_value' => $vat_val1,
                'net_amount' => $tot_amount,
                'debit' => $tot_amount,
                'invoice' => '',
                'invoice_id' =>'',
                'slot_booking'=>$booking_id,
                'student_id'=> NULL,
                'parent_id'=> $id,
                'parent_name'=> $resultp['parent_name'],
                'parent_mobile'=> $resultp['mobile_no'],
                'parent_email_id'=> $resultp['email_id'],
                'description'=> 'Court Booking Fees',
                'created_at' => date('Y-m-d H:i:s'),
                'module' => 'Court Booking - Cancellation Bulk'
            );
            
            //print_r($walletArray);die;
            if($discount)
            {
                $walletArray['wallet_transaction_detail']= 'Court Booking Fees Discount Cancellation Bulk';
                $walletArray['description']= 'Court Booking Fees Discount Cancellation Bulk';
            }

            
            
            $this->db->insert('wallet_transactions', $walletArray); 
            $wallet_transaction_id = $this->db->insert_id();
            

            $this->send_email_booked_direct_cancelled($booking_id, $walletArray,  $resultp['parent_code'], $wallet_amount, $balance_credits);
            
        }

    }
    
    public function send_email_booked_direct_cancelled($booking_id,$wallet_data_array, $parent_code, $wallet_amount, $balance_credits)
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

		$mail->Subject = "Prime Star Sports Services - Court Booking Cancelled.";
		
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
        <p>We are pleased to inform you that your Court booking is cancelled successfully.</p>
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
           where bs.id='$booking_id' and b.bstatus=1 and b.blocked_status=1 and bs.cancelled=1
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
                <th>Credited amount(AED)</th>
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
           where b.id='$booking_id' and b.bstatus=1 and b.blocked_status=1 and bs.cancelled !=1
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
    
    public function cancel_booking(){
        $data['customer_id'] = ($this->input->post('customer_id') !='') ? $this->input->post('customer_id') : '';
        $data['remarks'] = ($this->input->post('remarks') !='') ? $this->input->post('remarks') : '';
        $data['booking_id'] = ($this->input->post('booking_id') !='') ? $this->input->post('booking_id') : '';
        $data['bookingslot_id'] = ($this->input->post('bookingslot_id') !='') ? $this->input->post('bookingslot_id') : '';
        $data['paid_amount'] = ($this->input->post('paid_amount') !='') ? $this->input->post('paid_amount') : '';
        $bid = $data['bookingslot_id'];
        $sql="select gross_amount,discount_amount from bookingslot where id='$bid'";
        
        $data['gross_amount'] = $this->db->query($sql)->row()->gross_amount;
        $data['discount_amount'] = $this->db->query($sql)->row()->discount_amount;
        $update_data = array(
            'bstatus' => '2',
            'cancelled_on' => date('Y-m-d'),
            //'paidamt' => '0'
        );

        $update_data2 = array(
            'cancelled' => 1,
            'cancelled_on' => date('Y-m-d H:i:s'),
            'remarks' => $data['remarks']
        );
        //return true;
        if($this->court_booking_model->update_booking_details_slot($update_data2, $data['booking_id'], $data['bookingslot_id'], $data['paid_amount'])){
            $wallet_amount = $this->get_customer_wallet_amount($data['customer_id']);
            $update_wallet_amount = $wallet_amount + $data['paid_amount']; 
            $booking_status = '2';
            //$this->send_email($data['booking_id'],$data['customer_id'],$booking_status);
            //$this->update_wallet_amount($update_wallet_amount,$data['customer_id']);

            $this->update_wallet_amount($data['gross_amount'], $data['discount_amount'], $data['customer_id'], $data['bookingslot_id'], 'court_booking_regular_cancellation');
            return true;
        }
    }

    public function cancel_booking_bulk(){
        $data['customer_id'] = ($this->input->post('customer_id') !='') ? $this->input->post('customer_id') : '';
        $data['booking_id'] = ($this->input->post('booking_id') !='') ? $this->input->post('booking_id') : '';
        $data['paid_amount'] = ($this->input->post('paid_amount') !='') ? $this->input->post('paid_amount') : '';
        $update_data = array(
            'bstatus' => '2',
            'cancelled_on' => date('Y-m-d'),
            'paidamt' => '0'
        );

        

        if($this->court_booking_model->update_booking_details($update_data, $data['booking_id'])){
            $wallet_amount = $this->get_customer_wallet_amount($data['customer_id']);
            $update_wallet_amount = $wallet_amount + $data['paid_amount']; 
            $booking_status = '2';
            //$this->send_email($data['booking_id'],$data['customer_id'],$booking_status);
            //$this->update_wallet_amount($update_wallet_amount,$data['customer_id']);
            $update_data2 = array(
                'cancelled' => 1,
            );

            $this->db->where('bid', $data['booking_id']);
            $this->db->update('bookingslot', $update_data2);
            //echo $this->db->last_query();die;

            $this->update_wallet_amount($data['paid_amount'], 0, $data['customer_id'], $data['booking_id'], 'court_booking_regular_cancellation_bulk');
            return true;
        }
    }
    
    
    public function show_booking_timeslot(){
        $data = array();
        $data['sid'] = ($this->input->post('sid') !='') ? $this->input->post('sid') : '';
        $data['lid'] = ($this->input->post('lid') !='') ? $this->input->post('lid') : '';
        $data['date'] = ($this->input->post('date') !='') ? change_date_format($this->input->post('date')) : '';
        $data['day'] = $this->get_dayid(date('l', strtotime($data['date'])));
        $get_details = $this->court_booking_model->show_booking_timeslot($data);
        
        if($get_details)
        {
        $distMatrix = array();
        $new_array = $this->array_group_by($get_details, 'courtname' );
        //print_r($new_array);die;
        $time_slot_set = array();
        foreach($get_details as $key => $value) { // city_b headings
            $from_time = strtotime($value['from_time']);
            $to_time = strtotime($value['to_time']);
            $time_diff = $to_time - $from_time;
            $postive =  ($time_diff / 600) / 6 ;
            //echo $postive;die;
            for($i = 1 ; $i <= $postive ; $i++ ){                
                $timestamp = $from_time + ( 60*60) ;
                $time = date('h:i A', $timestamp);
                $new_fromtime = $time;
                //$time_slot_set[] = date('h:i A', $from_time).'--'.$new_fromtime;
                $time_slot_set[] = array(
                    'from_time' => $from_time,
                    'to_time' => strtotime($new_fromtime),
                    'cid' => $value['cid']
                 );
                $from_time = strtotime($new_fromtime);
                
            }            
        }
        //print_r($time_slot_set);die;
        sort($time_slot_set);
        $time_slot_set = array_map("unserialize", array_unique(array_map("serialize", $time_slot_set)));
        //print_r($time_slot_set);die;
        $new_output = '<tr>';
        $new_output .='<th>Time slot</th>';
        foreach($new_array as $key => $courtnames) { // city_b headings
            $new_output .= '<th>'.ucfirst($key).'</th>';
        }
        $new_output .= '</tr>';

        foreach($time_slot_set as $i => $value) { 
            $new_output .= '<tr>';
            $new_output .='<td>'.date('h:i A', $value['from_time']).'-'.date('h:i A', $value['to_time']).'</td>'; // city_a ad
            foreach($new_array as $key => $courtnames) { // city_b headings
                $holiday_id = $this->get_holiday_id($data['date']);
                $new_output .= "<td>".$this->check_timeslot_exist($i.'_'.$key.'_'.strtotime($data['date']),$courtnames,date('H:i:s', $value['from_time']), date('H:i:s', $value['to_time']), $data['date'], $holiday_id, $value['cid'])."</td>";
            }
            $new_output .='</tr>';
        }
        }
        else{
            $new_output = '<tr><td colspan="3"><span>No slots available for the selected day!</span></td></tr>';
        }
        
        echo $new_output;
    }
    
    public function get_dayid($dayname){
        $dayid = '';
        $get_details = $this->court_booking_model->get_dayslist($dayname);
        if($get_details){
            $dayid = $get_details['dayid'];
        }
        return $dayid;
    }
    
    private function check_timeslot_exist($i,$courtnames, $fromtime, $totime, $date, $holiday_id, $activity_id, $location_id, $parent_id, $court_id, $date_info) { 
        $cid = '';
        foreach($courtnames as $k => $court){
            $cid = $court['cid'];
        }
        $day_id = $this->get_dayid(date('l', strtotime($date)));
        $check = $this->court_booking_model->check_timeslot_exist($cid, $fromtime, $totime, $day_id, $holiday_id);  
		$booked_slot = $this->court_booking_model->slot_availability($court_id, $fromtime, $date, $totime); 
		if($booked_slot) { 
		$slot_booked ='disabled style="background-color:orange!important; border-color:orange !important;"';
		if($booked_slot['parent_id'] == $parent_id) 
		{
		$slot_status = 'Added to Cart';	
		}
		else 
		{ 
		$slot_status = 'Book';	
		}		
		}
		else { 
		$slot_booked ='';
		$slot_status = 'Book';
		}
//        print_r($check);
        //echo $this->db->last_query(); 
//        die();
        $pstid = '';
        $hid = '';
        if($check){
            
            
           $check_booked_slot =  $this->court_booking_model->check_bookedslot_exist($cid, $fromtime, $totime, $date, $day_id);
          
          //echo $this->db->last_query(); 
          //die();
           if($check_booked_slot){    
               if($check_booked_slot['btype'] == '1'){
                    $booked_by = ($check_booked_slot['booked_by'] == '0') ? 'btn-danger' : (($check_booked_slot['blocked_status'] == '0') ? 'btn-warning' : 'btn-danger' );
                    if($check_booked_slot['booking_for']=='')
                    {
                        if($date_info=="today")
                        {
						    $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn $booked_by view-booked-timeslot'>".ucfirst($check_booked_slot['customer_name'])."</button>"; 
                        }
                        else{
                            $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn $booked_by view-booked-timeslot' disabled>".ucfirst($check_booked_slot['customer_name'])."</button>";
                        }
                    }else{
						if($date_info=="today")
                        {
                         $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn $booked_by view-booked-timeslot' >".ucfirst($check_booked_slot['customer_name'])."-".($check_booked_slot['booking_for'])."</button>"; 
                        }
                        else{
                            $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn $booked_by view-booked-timeslot' disabled>".ucfirst($check_booked_slot['customer_name'])."-".($check_booked_slot['booking_for'])."</button>"; 
                        }
                    }
                  
               }else{
                    if($date_info=="today")
                    {
                    $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn btn-info view-booked-timeslot'>".ucfirst($check_booked_slot['customer_name'])."</button>"; 
                    }
                    else{
                        $value = "<button type='button' data-id='".$check_booked_slot['id']."' data-toggle='modal' data-target='#viewModal' class='btn btn-info view-booked-timeslot' disabled>".ucfirst($check_booked_slot['customer_name'])."</button>"; 
                    }
               }
           }else{  
                $this->load->helper('cookie');
               $i = str_replace(' ','',$i);
               $cookie = ( isset($_COOKIE[$i]) == '1' ) ? 'btn-primary' : 'btn-success'; 
               $cookie = 'btn-success';
               if(count($check) > 1){
               $new_array = $this->search_in_array($holiday_id, $check);
               foreach($new_array as $ck => $chk){
                   $pstid = $chk['id'];
                   $hid = $chk['holiday_id'];
               }

               if($date_info=="today")
                {

                    $value = "<button type='button' id='$i' data-id='".$pstid."' data-holiday_id='".$hid."' data-arraykey='".$i."' data-parent_id='".$parent_id."' data-activity_id='".$activity_id."'  data-location_id='".$location_id."'  data-court_id='".$court_id."' data-date='".$date."' data-fromtime='".$fromtime."' data-totime='".$totime."' onclick='addSlot(this)' class='btn booking-timeslot 123 $cookie ' $slot_booked>$slot_status</button>"; 
                }
                else{
                    $value = "<button type='button' id='$i' data-id='".$pstid."' data-holiday_id='".$hid."' data-arraykey='".$i."' data-parent_id='".$parent_id."' data-activity_id='".$activity_id."'  data-location_id='".$location_id."'  data-court_id='".$court_id."' data-date='".$date."' data-fromtime='".$fromtime."' data-totime='".$totime."' onclick='addSlot(this)' class='btn booking-timeslot $cookie ' $slot_booked disabled>$slot_status</button>"; 
                }
               }else{

                    if($date_info=="today")
                    {



                        $value = "<button type='button' id='$i' data-id='".$check[0]['id']."' data-holiday_id='".$check[0]['holiday_id']."' data-arraykey='".$i."' data-parent_id='".$parent_id."' data-activity_id='".$activity_id."'  data-location_id='".$location_id."' data-court_id='".$court_id."'  data-date='".$date."' data-fromtime='".$fromtime."' data-totime='".$totime."'  onclick='addSlot(this)' class='btn booking-timeslot $cookie' $slot_booked>$slot_status</button>";  


                    }  
                    else{
                        $value = "<button type='button' id='$i' data-id='".$check[0]['id']."' data-holiday_id='".$check[0]['holiday_id']."' data-arraykey='".$i."' data-parent_id='".$parent_id."' data-activity_id='".$activity_id."'  data-location_id='".$location_id."' data-court_id='".$court_id."'  data-date='".$date."' data-fromtime='".$fromtime."' data-totime='".$totime."' onclick='addSlot(this)' class='btn booking-timeslot $cookie'  $slot_booked disabled>$slot_status</button>";    
                    }
               }
           }
        }else{
            $value = "--";
        }
        return $value;
    }
    
    function search_in_array($holidayid, $array) {
        foreach($array as $key => $value) {
            if ($value['holiday_id'] != $holidayid) {
                unset($array[$key]);
            }
        }
       // print_r($array);
        return $array;
   }
    
    public function get_holiday_id($date){
        $dayid = '';
        $get_details = $this->bulk_booking_model->get_holiday_id($date);
        if($get_details){
            $dayid = $get_details['id'];
        }
        return $dayid;
    }
    
    public function get_customerPendingDeductableAmount(){
        $customer_email = ($this->input->post('email') !='') ? $this->input->post('email') : '';
        $customer_id = $this->getCustomerid($customer_email);
        $get_details = $this->court_booking_model->get_customer_booking_details($customer_id);
        echo json_encode($get_details);
    }
    
    public function getCustomerid($customer_email){
        $id = '';
        $get_details = $this->court_booking_model->getCustomerid($customer_email);
        if($get_details){
            $id = $get_details['id'];
        }
        return $id;
    }
    
    
    public function get_bookedslot_details(){
        $booked_slotid = ($this->input->post('booked_slotid') !='') ? $this->input->post('booked_slotid') : '';
        $booking_details = $this->court_booking_model->get_booking_details($booked_slotid);
        $output = ''; 
        if($booking_details){
            $booking_type = ($booking_details['booking_type'] == '1') ? 'Regular' : 'Bulk';
            $cust_wallamt = $this->get_customer_wallet_amount($booking_details['customerid']);
            $output .= '<div class="modal-dialog">';
            $output .= '<div class="modal-content">';
            $output .= '<div class="modal-header">';
            $output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $output .= '<h4 class="modal-title">Booking Details</h4>';
            $output .= '</div>';
            $output .= '<div class="modal-body">';
            $output .= '<form action="'.base_url().'Court_booking/update_booking_details/'.$booking_details['bid'].'" name="update_booking_form" id="" method="post">';
            $output .= '<div class="table-responsive">';
            $output .= '<table class="table table-bordered table-striped">';
            $output .= '<tbody>';
                    $output .= '<tr>';
                            $output .= '<td><input type="hidden" name="booking_id" id="booking_id" value="'.$booking_details['bid'].'"><input type="hidden" name="bookingslot_id" id="bookingslot_id" value="'.$booking_details['id'].'"><strong>Booking ID :</strong>&nbsp;&nbsp;'.ucfirst($booking_details['customer_name']).'&nbsp;&nbsp;'.$booking_details['booking_no'].'</td>';
                            $output .= '<td><strong>Member? :</strong> No</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                            $output .= '<td><input type="hidden" name="customer_id" id="customer_id" value="'.$booking_details['customerid'].'"><strong>Mobile :</strong> '.$booking_details['customer_mobile'].'</td>';
                            $output .= '<td><input type="hidden" name="customer_wallamt" id="customer_wallamt" value="'.$cust_wallamt.'"><strong>Court/Slot:</strong>&nbsp;&nbsp;'.ucfirst($booking_details['courtname']).'@'.date('h:i A', strtotime($booking_details['booking_fromtime'])).'-'.date('h:i A', strtotime($booking_details['booking_totime'])).'</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                            $output .= '<td><strong>Extras :</strong> No</td>';
                            $output .= '<td><strong>Booking Type :</strong>'.$booking_type.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                            $output .= '<td><strong>Gross Amt :</strong>'.$booking_details['gross_amount'].'</td>';
                            $output .= '<td><strong>Discount Amt:</strong>'.$booking_details['discount_amount'].'</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                    $output .= '<td><strong>Vat % :</strong>'.$booking_details['vat_perc'].'</td>';
                    $output .= '<td><strong>Vat Amt :</strong>'.$booking_details['vat_amount'].'</td>';
            $output .= '</tr>';
                    $output .= '<tr>';
                            $output .= '<td><input type="hidden" name="update_balance_amount" id="update_balance_amount" value="'.$booking_details['balance_amount'].'"><strong>Net Amt :</strong>'.$booking_details['net_amount'].'</td>';
                            $output .= '<td><input type="hidden" name="paid_amount" id="paid_amount" value="'.$booking_details['paid_amount'].'"><strong>Advance :</strong>'.$booking_details['advance_amount'].'</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                            $output .= '<td>';
                            $output .= '<strong>Balance :</strong>'.$booking_details['balance_amount'];
//                            if($booking_details['paystatus'] == '2') {
//                            $output .= '<button type="button" id="sbt_btn" class="btn btn-primary" style="min-width: auto;">&nbsp;&nbsp;Pay&nbsp;&nbsp;</button>'; 
//                            }
                            $output .= '</td>';
                            $output .= '<td><strong>Refund :</strong> No Refund</td>';
                    $output .= '</tr>';
                    $output .= '<tr>';
                    if($booking_details['paystatus'] == '2') {
                            $output .= '<td colspan="2"><strong>Remarks :</strong> <input type="text" name="remarks" id="remarks" value="'.$booking_details['remarks'].'" ></td>';
                    }else{
                        $output .= '<td colspan="2"><strong>Remarks :</strong> <input type="text" name="remarks" id="remarks" value="'.$booking_details['remarks'].'" ></td>';
                    }
                    $output .= '</tr>';
            $output .= '</tbody>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '<div class="col-sm-12 col-md-12 pad_lef_0 pad_rig_0">';
            $curdate=strtotime(date('Y-m-d'));
            //$mydate=strtotime($booking_details['fromdate']);
            $getdate = $this->getDaysDate($booking_details['days'],$booking_details['fromdate'],$booking_details['todate']);
            $mydate = ($booking_details['booking_type'] == '1') ? strtotime($booking_details['fromdate']) : strtotime($getdate[0]) ;
            if($curdate <= $mydate)
            {
                if($booking_details['booking_type'] == '1'){                    
                    $output .= '<button type="button" title="Checkout" class="btn btn-danger pull-left booking-cancel">';
                    $output .= '<i class="glyphicon glyphicon-remove"></i> &nbsp; Cancel Booking</button>';
                }
                //$output .= '<button type="button" id="sbt_btn" class="btn btn-primary pull-right" >Update</button>';
            }
            
            $output .= '</div>';            
            $output .= '</form>';
            $output .= '<div class="clearfix"></div>';
            $output .= '<div class="clearfix"></div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        echo $output;
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
    
    private function get_cid($cname) {
        $details = $this->court_booking_model->get_courtid($cname);
        return $details['id'];
    }
    
    private function get_customer_wallet_amount($id) {
        $details = $this->court_booking_model->get_customerDetails($id);
        return $details['amount'];
    }
    
    private function array_group_by($array, $key) {
        $return = array();
        foreach($array as $i => $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }
    
    public function show_timeslot_details_old(){
        $data = array();
        $data['id'] = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $data['fromtime'] = ($this->input->post('fromtime') !='') ? $this->input->post('fromtime') : '';
        $data['totime'] = ($this->input->post('totime') !='') ? $this->input->post('totime') : '';
        $data['date'] = ($this->input->post('date') !='') ? $this->input->post('date') : '';
        $data['btnid'] = ($this->input->post('btnid') !='') ? $this->input->post('btnid') : '';
        $get_details = $this->court_booking_model->show_timeslot_details($data);
        $output ='';
        if($get_details){  
                
                foreach($get_details as $key => $get_list)
                {
                    
                    $output .= "<tr>";
                    $output .= "<td><input type='hidden' name='hidden_id[]' id='hidden_id' value='".$get_list['id']."'>". ucfirst($get_list['sportsname']);
                    $output .= "<input type='hidden' name='hidden_fromtime[]' id='hidden_fromtime' value='".date('H:i:s', strtotime($data['fromtime']))."'>";
                    $output .= "<input type='hidden' name='hidden_totime[]' id='hidden_totime' value='".date('H:i:s', strtotime($data['totime']))."'>";
                    $output .= "<input type='hidden' name='hidden_sid[]' id='hidden_sid' value='".$get_list['sid']."'>";
                    $output .= "<input type='hidden' name='hidden_cid[]' id='hidden_cid' value='".$get_list['cid']."'></td>";
                    $output .= "<td><input type='hidden' name='hidden_booking_date[]' id='hidden_booking_date' value='".date('d-m-Y', strtotime($data['date']))."'>".  date('d-m-Y', strtotime($data['date']))."</td>";
                    $output .= "<td>".  date('h:i A', strtotime($data['fromtime'])).'-'.date('h:i A', strtotime($data['totime']))."</td>";
                    $output .= "<td><input type='hidden' name='hidden_lid[]' id='hidden_lid' value='".$get_list['lid']."'>". ucfirst($get_list['location']) ."</td>";
                    $output .= "<td>". ucfirst($get_list['courtname']) ."</td>";
                    $output .= "<td><input type='hidden' class='hidden_price' name='hidden_cost[]' id='hidden_cost' value='".$get_list['cost']."'>". $get_list['cost'] ."</td>";
                    $output .= "<td><button type='button' data-btnid='".$data['btnid']."' title='Remove' data-id='".$get_list['id']."' class='btn btn-danger btn-xs rmve_btn'><i class='glyphicon glyphicon-trash'></i></button></td>";
                    $output .= "</tr>";
                    
                }
                
        }
        echo $output;
    }

    public function show_timeslot_details(){
        
        $parent_id = ($this->input->post('parent_id') !='') ? $this->input->post('parent_id') : '';
        $get_details = $this->court_booking_model->show_timeslot_details($parent_id);
        $output ='';
        if($get_details){  
                
                foreach($get_details as $key => $get_list)
                {
                    
                    $output .= "<tr>";
                    $output .= "<td><input type='hidden' name='hidden_id[]' id='hidden_id' value='".$get_list['id']."'>". ucfirst($get_list['sportsname']);
                    $output .= "<input type='hidden' name='hidden_fromtime[]' id='hidden_fromtime' value='".date('H:i:s', strtotime($get_list['from_time']))."'>";
                    $output .= "<input type='hidden' name='hidden_totime[]' id='hidden_totime' value='".date('H:i:s', strtotime($get_list['to_time']))."'>";
                    $output .= "<input type='hidden' name='hidden_sid[]' id='hidden_sid' value='".$get_list['activity_id']."'>";
                    $output .= "<input type='hidden' name='hidden_cid[]' id='hidden_cid' value='".$get_list['court_id']."'></td>";
                    $output .= "<td><input type='hidden' name='hidden_booking_date[]' id='hidden_booking_date' value='".date('d-m-Y', strtotime($get_list['checkout_date']))."'>".  date('d-m-Y', strtotime($get_list['checkout_date']))."</td>";
                    $output .= "<td>".  date('h:i A', strtotime($get_list['from_time'])).'-'.date('h:i A', strtotime($get_list['to_time']))."</td>";
                    $output .= "<td><input type='hidden' name='hidden_lid[]' id='hidden_lid' value='".$get_list['location_id']."'>". ucfirst($get_list['location']) ."</td>";
                    $output .= "<td>". ucfirst($get_list['courtname']) ."</td>";
                    $output .= "<td><input type='hidden' class='hidden_price' name='hidden_cost[]' id='hidden_cost' value='".$get_list['amount']."'>". $get_list['amount'] ."</td>";
                    $output .= "<td><button type='button' title='Remove' data-id='".$get_list['id']."' class='btn btn-danger btn-xs rmve_btn'><i class='glyphicon glyphicon-trash'></i></button></td>";
                    $output .= "</tr>";
                    
                }
                
        }
        echo $output;
    }
    
    public function total_price_cost(){
        $data = array();
        $data['id'] = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $get_details = $this->court_booking_model->show_timeslot_details($data);
        $cost ='';
        if($get_details){ 
            foreach($get_details as $key => $get_list)
            {

               $cost = $get_list['cost'];

            }
        }
        echo $cost;
    }
    
    public function get_locationnames(){
        $data = array();
        $data['sports_id'] = ($this->input->post('sports_id') !='') ? $this->input->post('sports_id') : '';
        $get_details = $this->court_booking_model->get_locationlist($data);
        $output = '<option value="">- Select Location -</option>';
        if($get_details){        
            foreach($get_details as $list){ 
                $output .='<option value="'.$list['location_id'].'">'.$list['location'].'</option>';
            }
        }
        echo $output;
    }
    
    public function get_events($activity_id, $location_id, $parent_id){
        $data_events = array();
        $start =date('Y-m-d', strtotime($this->input->get("start")));
        $end =date('Y-m-d', strtotime($this->input->get("end")));
        /*$username=$this->session->userdata('username');
        $parentDetails = $this->default->getParentDetail($username);*/
        
        
        $events = $this->db->query("select *,bs.sid as activity_id, bs.booked_date as checkout_date,bs.booking_fromtime as from_time, bs.booking_totime as to_time,p.parent_name from booking ba 
        left join bookingslot as bs on bs.bid = ba.id
        left join parent p on p.parent_id = ba.customerid
        where ba.`customerid` ='".$parent_id."' and bs.`sid` ='".$activity_id."' and ba.bstatus=1 and bs.cancelled = 0 and bs.booked_date BETWEEN '".$start."' AND '".$end."' and (ba.`blocked_status` = 1) ");
        
        
        $eventList=$events->result_array();
        //echo $this->db->last_query();die;
    
        $cartList = $this->db->query("select tb.*, p.parent_name from tmp_booking_court tb 
        left join parent p on p.parent_id = tb.parent_id
        where tb.`parent_id` ='".$parent_id."' and tb.`activity_id` ='".$activity_id."' and tb.`checkout_date` BETWEEN '".$start."' AND '".$end."' ");
        $cartEvent=$cartList->result_array();
    
        $colorArray = ['#FF0000', '#006400','#00008B','#800080','#8B0000','#556B2F'];
        $studentArr =[];
        foreach($eventList as $key => $value) { 
          $startTime = $value['checkout_date'].' '.$value['from_time'];
          $endTime = $value['checkout_date'].' '.$value['to_time'];
          $activity_name= $this->transaction->getActivityDetail($value['activity_id']);
          $studentArr[] = $value['customerid'];
          $studArray = array_values(array_unique($studentArr)); 
          $keyvalue = array_search($value['customerid'],$studArray); 
              $data_events[] = array(
                  "id" => $value['id'],
                  //"title" => 'PS00'.$value['student_id'].'('. $value['from_time'].'-'.$value['to_time'].')',
                  "title" => $value['parent_name'].'-'.$activity_name.'</br> (Timing: '.$value['from_time'].'-'.$value['to_time'].')',
                  "start" => date('Y-m-d H:i:s', strtotime($startTime)),
                  "end" => date('Y-m-d H:i:s', strtotime($endTime)),
                  "color" => $colorArray[$keyvalue],
                  "textColor" => '#fff'
              );
          }
          foreach($cartEvent as $key => $value) { 
          $startTime = $value['checkout_date'].' '.$value['from_time'];
          $endTime = $value['checkout_date'].' '.$value['to_time'];
          $activity_name= $this->transaction->getActivityDetail($value['activity_id']);
              $data_events[] = array(
                  "id" => $value['id'],
                  //"title" => 'PS00'.$value['student_id'].'('. $value['from_time'].'-'.$value['to_time'].')',
                  "title" => 'My Cart -'.$value['parent_name'].'-'.$activity_name.'</br> (Timing: '.$value['from_time'].'-'.$value['to_time'].')',
                  "start" => date('Y-m-d H:i:s', strtotime($startTime)),
                   "end" => date('Y-m-d H:i:s', strtotime($endTime)),
                  "textColor" => '#fff'
              );
          }
        echo json_encode($data_events);
        
        die;
    }
    
    public function set_form_slot()
    {
        $activity_id = $this->input->post('activity_id');
        $location_id=$this->input->post('location_id');
        $day=$this->input->post('clickDay');
        $date=$this->input->post('date');
        $parent_id=$this->input->post('parent_id');
        
        $data['sid'] = ($this->input->post('activity_id') !='') ? $this->input->post('activity_id') : '';
        $data['lid'] = ($this->input->post('location_id') !='') ? $this->input->post('location_id') : '';
        $data['date'] = ($this->input->post('date') !='') ? change_date_format($this->input->post('date')) : '';
        $data['day'] = $this->get_dayid(date('l', strtotime($data['date'])));
        $get_details = $this->court_booking_model->show_booking_timeslot($data);

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
    public function set_form(){
        $data = array();
        $data['sid'] = ($this->input->post('activity_id') !='') ? $this->input->post('activity_id') : '';
        $data['lid'] = ($this->input->post('location_id') !='') ? $this->input->post('location_id') : '';
        $data['parent_id'] = ($this->input->post('parent_id') !='') ? $this->input->post('parent_id') : '';
        $data['date'] = ($this->input->post('date') !='') ? change_date_format($this->input->post('date')) : '';
        $data['day'] = $this->get_dayid(date('l', strtotime($data['date'])));
        $data['date_info'] = ($this->input->post('date_info') !='') ? $this->input->post('date_info') : '';
        $get_details = $this->court_booking_model->show_booking_timeslot($data);

        $activity_id = $data['sid']; 
        $location_id = $data['lid']; 
        $day_value = $data['day'];
        $parent_id = $data['parent_id'];
		$dates= $data['date'];
		$date_info = $data['date_info'];
		
        $new_output = '';
        if($get_details)
        {
        $distMatrix = array();
        $new_array = $this->array_group_by($get_details, 'courtname' );
        //print_r($new_array);die;
        $time_slot_set = array();
        foreach($get_details as $key => $value) { // city_b headings
            $from_time = strtotime($value['from_time']);
            $to_time = strtotime($value['to_time']);
            $time_diff = $to_time - $from_time;
            $postive =  ($time_diff / 600) / 6 ;
            //echo $postive;die;
            for($i = 1 ; $i <= $postive ; $i++ ){                
                $timestamp = $from_time + ( 60*60) ;
                $time = date('h:i A', $timestamp);
                $new_fromtime = $time;
                //$time_slot_set[] = date('h:i A', $from_time).'--'.$new_fromtime;
                $time_slot_set[] = array(
                    'from_time' => $from_time,
                    'to_time' => strtotime($new_fromtime),
                    'cid' => $value['cid']
                 );
                $from_time = strtotime($new_fromtime);
                
            }            
        }
        //print_r($time_slot_set);die;
        sort($time_slot_set);
        $time_slot_set = array_map("unserialize", array_unique(array_map("serialize", $time_slot_set)));
        //print_r($time_slot_set);die;
        $new_output .= '<thead>';
		$new_output .= '<tr>';
        $new_output .='<th><button class="btn btn-info" style=cursor:pointer onclick=set_form("'.$activity_id.'","'.$location_id.'","'.$parent_id.'","'.$day_value.'","'.$dates.'","'.$date_info.'")>Refresh</button></th>';
		 $new_output .= '</tr>';
        $new_output .= '<tr>';
        $new_output .='<th>Time slot</th>';
        foreach($new_array as $key => $courtnames) { // city_b headings
            $new_output .= '<th>'.ucfirst($key).'</th>';
        }
        $new_output .= '</tr>';
        $new_output .= '</thead>';
        $new_output .= '<tbody>';

        foreach($time_slot_set as $i => $value) { 
            
            /*<form id="addSlotSelection_'.$i.'" class="form-horizontal " name="form" method="POST" >
            <input type="hidden" name="dates" id="dates"  class="dates" >
            <input type="hidden" name="activity_id" id="activity_id" value="'.$activity_id.'">
            <input type="hidden" name="location_id" id="location_id"  value="'.$location_id.'">
            <input type="hidden" name="parent_id" id="parent_id" value="'.$parent_id.'">
            <input type="hidden" name="day_val" id="day_val" value="'.$day_value.'">*/
            $new_output .= '<tr class="daysDiv showDays_'.$day_value.'">
            ';       
            
            

            $new_output .='<td>'.date('h:i A', $value['from_time']).'-'.date('h:i A', $value['to_time']).'</td>'; // city_a ad
            foreach($new_array as $key => $courtnames) { // city_b headings
                $holiday_id = $this->get_holiday_id($data['date']);
                $new_output .= "<td>".$this->check_timeslot_exist($i.'_'.$key.'_'.strtotime($data['date']),$courtnames,date('H:i:s', $value['from_time']), date('H:i:s', $value['to_time']), $data['date'], $holiday_id, $activity_id, $location_id, $parent_id, $value['cid'],$data['date_info'])."</td>";
            }
            //$new_output .='</form>';
            $new_output .='</tr>';
           
        }
        }
        else{
            $new_output = '<tr><td colspan="3"><span>No slots available for the selected day!</span></td></tr>';
        }
        $new_output .= '</tbody>';
        echo $new_output;
    }
   
    public function add_slot_booking(){
        //echo $this->input->post('activity_id');die;
        if($this->input->post('activity_id')){
         $location_id=$this->input->post('location_id');
         $parent_id=$this->input->post('parent_id');
         $court_id=$this->input->post('court_id');
         $activity_id=$this->input->post('activity_id');
         $slot_from_time=$this->input->post('slot_from_time');
         $slot_to_time=$this->input->post('slot_to_time');
         $dates=$this->input->post('dates');
         $from = $this->input->post('slot_from_time');
         $to = $this->input->post('slot_to_time');
         $day = $this->get_dayid(date('l', strtotime($dates)));
    
       $email=$this->session->userdata('username');
       $user_id = $this->session->userid;
      $discount_val = 0.00;
      $discount_percentage = 0.00;
      $parentDetails = $this->default->getParentDetailById($parent_id);
      
      $query1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
      $postData1=$query1->row_array();
      if(empty($postData1)){
          $json['status'] = 'error';  
          echo json_encode($json);
          $this->session->set_flashdata('error', 'Please add prepaid credit to book slot.');
      }else{
        
       $s_fee = "select COALESCE(ps.cost,0.00) as fees from pricing p 
        left join pricingslot ps on ps.pid=p.id
        where p.sid='$activity_id' and p.lid='$location_id' and p.cid='$court_id' and ((p.fromday ='$day' and p.today='0') or (p.fromday <='$day' and p.today >='$day')) and ( ps.fromtime <='$slot_from_time' and ps.totime >='$slot_to_time' )   and p.delete_status=0 order by fees desc limit 1;";
        $f_query = $this->db->query($s_fee);

        

        //echo $s_fee;die;
        if($f_query->num_rows() > 0)
        {
            $fees= sprintf("%2f",$f_query->row()->fees);
            
        }
        else
        {
           $fees=100.00;  
        }
        //echo $fees_price.' '.$fees;die;
        $status='Approved';
        $checkexists = $this->db->query('select * from tmp_booking_court where parent_id ="'.$parent_id.'" and activity_id ="'.$activity_id.'"  and checkout_date ="'.$dates.'"  and from_time="'.$from.'" and 
        to_time="'.$to.'"');
        if (empty($checkexists->result_array())){
              $getRowsCount = $this->db->query('SELECT * FROM `tmp_booking_court`');
              $count =  $getRowsCount->num_rows();
              $ticket = $this->school->getLastEntry('booking');
              $ticketVal = $ticket + $count;
              $ticket_no='BKNO-000'.$ticketVal;
              $created_at=date("Y-m-d H:i:s");
              
              $sql1="INSERT into tmp_booking_court(ticket_no,parent_id,activity_id,checkout_date,status,amount,created_at,user_id,from_time,to_time,discount,discount_percentage, location_id,court_id) values('".$ticket_no."','".$parent_id."','".$activity_id."','".$dates."','".$status."','".$fees."','".$created_at."','".$user_id."','".$from."','".$to."','".$discount_val."','".$discount_percentage."','".$location_id."','".$court_id."')";
              $insert=$this->db->query($sql1);
              
              if(isset($insert)){
                $getRows = $this->db->query('SELECT * FROM `tmp_booking_court` where parent_id ="'.$parent_id.'" and activity_id ="'.$activity_id.'" ');
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
        //$this->load->view('slot_booking_activity_calander');
      }
    
    }

    public function remove_cart_item()
    {
        $id = $this->input->post('id');
        $sql="DELETE from tmp_booking_court where id='$id'";
        $this->db->query($sql);
        return true;
    }
	
}

?>