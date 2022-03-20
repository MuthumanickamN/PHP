<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 
class Prepaid_credits extends CI_Controller {  	
	public function __construct(){
	parent::__construct();
	error_reporting(0);
	$this->load->model('School_profile_report_Model', 'schools');
	$this->load->model('Default_Model', 'default');
	$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	
	public function index(){
		$data['title'] = 'Prepaid Credits';
		$data['parentList'] = $this->default->getParentList();
		$this->load->view('prepaid_credits/index',$data);
	}
	public function save(){
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
	    $parent_mobile=$this->input->post('parent_mobile');
		$parent_email_id=$this->input->post('parent_email_id');
		$total_credits=$this->input->post('total_credits');
		$balance_credits=$this->input->post('total_credits');
		$paid_amount=$this->input->post('paid_amount');
		$description=$this->input->post('description');
		$payment_type=$this->input->post('payment_type');
		$bank=$this->input->post('bank');
		$cheque_no=$this->input->post('cheque_no');
        $cheque_date=$this->input->post('cheque_date');
        $transaction_type = 'Credit';
		$bank = $cheque_no = $cheque_date = '' ;
		$debit = $credit = $amount = 0;
		$user_id = $this->session->userid;
		
		$credit = $paid_amount;
		if ($payment_type == 'Card' || $payment_type == 'Online') {
			$bank = $this->input->post('bank');
			$cheque_no =$cheque_date ='';
			if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
		} else if ($payment_type == 'Cheque') {
			$bank = $this->input->post('bank');
			$cheque_no = $this->input->post('cheque_no');
			$cheque_date = $this->input->post('cheque_date');
			if (empty($cheque_no)) {
	            $json['error']['cheque_no'] = 'Please enter cheque number';
	        }
	        if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
	        if (empty($cheque_date)) {
	            $json['error']['cheque_date'] = 'Please enter cheque date';
	        }
		} else if ($payment_type == 'Cash') {
			$payment_type = $this->input->post('payment_type');
			$bank = $cheque_no =$cheque_date ='';
		}
		if ($parent_id == '') {
            $json['error']['parent_id'] = 'Please select parent';
        }
        if (empty($paid_amount)) {
            $json['error']['paid_amount'] = 'Please enter Amount';
        }
        if (empty($description)) {
            $json['error']['description'] = 'Please enter description';
        }
        if ($payment_type == '') {
            $json['error']['payment_type'] = 'Please enter payment_type';
        }

		if (empty($json['error']) ) {
			  $credit = $this->db->query( "select * from prepaid_credits where `parent_id` = '".$parent_id."' ");
	   		  $creditExists = $credit->row_array();
	   		  if (empty($creditExists)){
	   		  	$sql="INSERT into prepaid_credits(parent_id,name_id,mobile_id,balance_credits,amount_paid,total_credits,description,payment_type,bank,cheque_number,cheque_date,created_at) values('".$parent_id."','".$parent_name."','".$parent_mobile."','".$balance_credits."','".$paid_amount."','".$total_credits."','".$description."','".$payment_type."','".$bank."','".$cheque_no."','".$cheque_date."','".date('Y-m-d H:i:s')."')";
				$insert=$this->db->query($sql);
				$pre_id = $this->db->insert_id();
				$prev_balance = 0.00;
	   		  }else{
	   		      $prev_balance = $creditExists['balance_credits'];
	   		  	$totalamount = $creditExists['total_credits']+$paid_amount;
	   		  	$balanceamount = $creditExists['balance_credits']+$paid_amount;
	   		  	$creditDetails = array(
	   		  		'total_credits'=>$totalamount,
	   		  		'balance_credits'=>$balanceamount,
	   		  	);
	   		  	$this->db->where('id', $creditExists['id']);
	            $this->db->update('prepaid_credits', $creditDetails); 
			    $pre_id = $creditExists['id'];
	   		  }
	   		  
	   		  if($pre_id)
	   		  {
    			  $txn_id = $this->schools->getLastEntry('wallet_transactions');
    			
    	          $wallet_transaction_id = 'WTXNO-'.$txn_id;
    	          $walletArray = array(
    	            'wallet_transaction_id' =>$wallet_transaction_id,
    	            'ac_code' => 'WCTR',
    	            'wallet_transaction_date' =>date('Y-m-d'),
    	            'wallet_transaction_type' =>'Credit',
    	            'wallet_transaction_detail' => 'Prepaid credits',
    	            'updated_admin_id' => $user_id,
    	            'reg_id' => $parent_id,
    	            'wallet_transaction_amount' => $paid_amount,
    	            'gross_amount' => $paid_amount,
    	            'vat_percentage' => '',
    	            'vat_value' =>'',
    	            'net_amount' => $paid_amount,
    	            'credit' => $paid_amount,
    	            'parent_id'=> $parent_id,
    	            'parent_name'=> $parent_name,
    	            'parent_mobile'=> $parent_mobile,
    	            'parent_email_id'=> $parent_email_id,
    	            'payment_type' => $payment_type,
    	            'bank'=> $bank,
    	            'cheque_number'=> $cheque_no,
    	            'cheque_date'=> $cheque_date,
    
    	            'description'=> 'Prepaid credits',
    	            'created_at' => date('Y-m-d H:i:s'),
    	        );
    	        $checkexists = $this->db->query('select id from wallet_transactions where wallet_transaction_date ="'.date('Y-m-d').'" and created_at ="'.date('Y-m-d H:i:s').'" and  ac_code ="WCTR" and wallet_transaction_type = "Credit"  ');
    	        $checkexistsArr = $checkexists->row_array();
    			
    	        if (empty($checkexistsArr)){
    	          $this->db->insert('wallet_transactions', $walletArray); 
    			  $wallet_id = $this->db->insert_id();
    	        }else{
    	          $this->db->where('id', $checkexistsArr['id']);
    	           $this->db->update('wallet_transactions', $walletArray); 
    			   $wallet_id = $checkexistsArr['id'];
    	        }
    			
    						$email_data = $this->db->query("SELECT pc.*,
    															   p.*
    														FROM   prepaid_credits AS pc
    															   LEFT JOIN parent AS p
    																	  ON p.parent_id = pc.parent_id
    														WHERE  pc.id = ".$pre_id."");
    													  
    																				  
    						$email_data_array = $email_data->row_array();
    						
    						
    						$wallet_email_data = $this->db->query("SELECT  * FROM wallet_transactions WHERE id = ".$wallet_id."");
    													  
    																				  
    						$wallet_data_array = $wallet_email_data->row_array();
    						
    				
    			$this->send_email($email_data_array,$wallet_data_array,  $prev_balance);
    	        $this->session->set_flashdata('success_msg', 'Prepaid credit added successfully');
    		    $json['status'] = "success";
    		    $this->output->set_header('Content-Type: application/json');
    		    echo json_encode($json);
	   		  }
	   		  else
	   		  {
	   		    
    	        $this->session->set_flashdata('error', 'Something Went wrong. ');
    		    $json['status'] = "error";
    		    $this->output->set_header('Content-Type: application/json');
    		    echo json_encode($json);
	   		  }

		}else{
			$this->output->set_header('Content-Type: application/json');
	        echo json_encode($json);
		}

       /*$sql="INSERT into prepaid_credits(parent_id,name_id,mobile_id,balance_credits,amount_paid,total_credits,description,payment_type,bank,cheque_number,cheque_date,created_at) values('".$parent_id."','".$parent_name."','".$parent_mobile."','".$balance_credits."','".$paid_amount."','".$total_credits."','".$description."','".$payment_type."','".$bank."','".$cheque_no."','".$cheque_date."','".$created_at."')";
		$insert=$this->db->query($sql);

		setMessage('New Prepaid Credits Added Successfully.');
		redirect(base_url().'prepaid_credits/list');*/
}

	public function send_email($email_data_array,$wallet_data_array, $prev_balance)
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

		$mail->Subject = "Prime Star Sport Services - Prepaid credits from ".$email_data_array['parent_code']." wallet";
		
		$mail->Body = "<!DOCTYPE>
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
        <p>Thanks for your payment, The credits has been updated into your wallet ".$email_data_array['parent_code']." .Wallet details below</p>
        <p>Transaction ID :<b>".$wallet_data_array['wallet_transaction_id']."</b></p>
         <table>
            <tr>
                <th>Parent-Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Previous balance(AED)</th>
                <th>Paid amount(AED)</th>
                <th>Total balance(AED)</th>
            </tr>
            <tr>
                <td>".$email_data_array['parent_code']."</td>
                <td>".$email_data_array['parent_name']."</td>
                <td>".$wallet_data_array['wallet_transaction_date']."</td>
                <td>".$prev_balance."</td>
                <td>".$wallet_data_array['wallet_transaction_amount']."</td>
                <td>".$email_data_array['total_credits']."</td>
            </tr>
        </table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			return true;
		}
		
	}
	
public function edit($id)
{

	
	$query = $this->db->query('select * from prepaid_credits where id='.$id);
	$postData=$query->row_array();
	$data['parent_id']=$postData['parent_id'];
	$data['name_id']=$postData['name_id'];
	$data['mobile_id']=$postData['mobile_id'];
	$data['balance_credits']=$postData['balance_credits'];
    $data['amount_paid']=$postData['amount_paid'];
		$data['total_credits']=$postData['total_credits'];
	
		$data['description']=$postData['description'];
		$data['payment_type']=$postData['payment_type'];
		$data['bank']=$postData['bank'];
		$data['cheque_number']=$postData['cheque_number'];
			$data['cheque_date']=$postData['cheque_date'];
	
		if($this->input->post('submit'))
		{
	$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
	    $parent_mobile=$this->input->post('parent_mobile');
		$parent_email_id=$this->input->post('parent_email_id');
		$total_credits=$this->input->post('total_credits');
		$balance_credits=$this->input->post('total_credits');
		$paid_amount=$this->input->post('paid_amount');
		$description=$this->input->post('description');
		$payment_type=$this->input->post('payment_type');

		if($payment_type=='Card' || $payment_type=='Online')
		{
			$bank=$this->input->post('bank');
		}
		else if($payment_type=='Cheque')
		{
			$bank=$this->input->post('bank');
			$cheque_no=$this->input->post('cheque_no');
            $cheque_date=$this->input->post('cheque_date');
		}
		else if($payment_type=='Cash')
		{
            $payment_type=$this->input->post('payment_type');
		}
$email=$this->session->userdata('username');

	 $this->db->where('email', $email);  
           
           $query1 = $this->db->get('users');
	$postData1=$query1->row_array();
	$user_name=$postData1['user_name'];

			
		$updated_at=currentDateTime();

		 $sql="Update  prepaid_credits set parent_id='$parent_id',name_id='$parent_name',mobile_id='$parent_mobile',balance_credits='$balance_credits',total_credits='$total_credits',amount_paid='$paid_amount',description='$description',payment_type='$payment_type',bank='$bank',cheque_number='$cheque_no',cheque_date='$cheque_date',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Prepaid Credits are Updated Successfully.');
				redirect(base_url().'Prepaid_credits/list');
			}

	$this->load->view('prepaid_credits',$data);


}
public function delete($id){
	$sql="Delete from prepaid_credits  where id='$id'";
	$insert=$this->db->query($sql);
	setMessage('Prepaid Credits are Deleted Successfully.');
	redirect(base_url().'prepaid_credits/list');
}

public function list(){
	$data['title'] ='Prepaid Credits';
	$creditList = $this->db->query( "select pc.*,p.parent_code from prepaid_credits pc left join parent p on pc.parent_id= p.parent_id");
	$data['creditList'] = $creditList->result_array();
	foreach ($data['creditList'] as $key => $value) {
		$totalAmountVal = $this->db->query("SELECT SUM(credit) as total FROM wallet_transactions WHERE parent_id='".$value['parent_id']."' and `ac_code` = 'WCTR'");
		$totalAmount = $totalAmountVal->row_array();
		$data['creditList'][$key]['amount_paid'] = $totalAmount['total'];
		$data['creditList'][$key]['total_credits'] = $totalAmount['total'];
	}
	$this->load->view('prepaid_credits/list', $data);
}
public function view($id){
	$query = $this->db->query('select * from prepaid_credits where id='.$id);
	$postData=$query->row_array();
	$data['parent_id']=$postData['parent_id'];
	$data['name_id']=$postData['name_id'];
	$data['mobile_id']=$postData['mobile_id'];
	$data['balance_credits']=$postData['balance_credits'];
    $data['amount_paid']=$postData['amount_paid'];
	$data['total_credits']=$postData['total_credits'];
	$data['description']=$postData['description'];
	$data['payment_type']=$postData['payment_type'];
	$data['bank']=$postData['bank'];
	$data['cheque_number']=$postData['cheque_number'];
	$data['cheque_date']=$postData['cheque_date'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];

	$this->load->view('prepaid_credits/view', $data);
}

public function payment(){
	$parent_id=$this->input->post('parent_id');
	$data['parent_id']=$parent_id;
	$data['opcode']=4;
	$query2=$this->db->query("select * from parent where parent_id='".$parent_id."' and status='Active'");
    $data['row2']=$query2->row_array();
    $wallet=$this->db->query("select * from prepaid_credits where parent_id='".$parent_id."'");
    $data['wallet']=$wallet->row_array();
	$this->load->view('prepaid_credits/prepaid_credits_ajax', $data);	
}

public function payment_type(){
	$payment_type=$this->input->post('payment_type');
	$data['payment_type']=$payment_type;
	$data['opcode']=1;
	$data['bankdetails'] = $this->transaction->getAllBankList();
	$this->load->view('prepaid_credits/prepaid_credits_ajax', $data);	
}
 public function payment_types(){
	$payment_type=$this->input->post('payment_type');
	$data['payment_type']=$payment_type;
	$data['opcode']=2;
	$data['bankdetails'] = $this->transaction->getAllBankList();
	$this->load->view('prepaid_credits/prepaid_credits_ajax', $data);	
}
 
}  