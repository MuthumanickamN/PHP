<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Registration_fees extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
	$this->load->model('Default_Model', 'default');
	$this->load->model('School_profile_report_Model', 'schools');
	$this->load->model('Invoice_Model', 'invoice_model');
	//$this->load->view('registration_fees');
	}
	
	public function index(){
		
		
		$data['title'] = 'Registration Fees';
		$data['studentList'] = $this->default->getStudentList();
		$data['vat_perc'] = $this->default->getVatPercentage();
		$data['edit']=0;
		$data['role']=strtolower($this->session->userdata('role'));
		//$regCharge=$this->db->query("select * from reg_charge_setups where note='Registration fees for Kid'")->row_array();
		//$data['category']=$regCharge['category'];
		//$data['reg_fee']=$regCharge['reg_fee'];
		if($this->input->post('submit')){
			$student_id=$this->input->post('student_id');
			$student_name=$this->input->post('student_name');
			$parent_id=$this->input->post('parent_id');
			$parent_name=$this->input->post('parent_name');
			$parent_contact_no=$this->input->post('parent_contact_no');
			$category=$this->input->post('catagory');
			$vat_percent=$this->input->post('vat_percentage');
			$vat_value=$this->input->post('vat_value');
			$reg_fee_amount=$this->input->post('reg_fee_amount');
			$payment_type=$this->input->post('payment_type');
			$wallet_amount=$this->input->post('wallet_amount');
			$payable_amount=$this->input->post('payable_amount');
			$bank_name=$this->input->post('bank_name');
			$check_date=$this->input->post('check_date');
			$check_number=$this->input->post('check_number');
			$user_id = $this->session->userid;
			
			$created_at=date('Y-m-d H:i:s');
			$creditsDetails = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id)->row_array();
			$balance_credits=$creditsDetails['balance_credits']-$payable_amount;
			
			
			if( $creditsDetails['balance_credits'] >= $payable_amount){
			    $sql="INSERT into registration_fees(student_id,student_name,parent_id,parent_name,parent_contact,reg_fee_category,reg_fee,pay_type,wallet_balance,wallet,created_at,status,vat_percent, vat_value,pay_date, net_amount,fee_pay_type ) values('".$student_id."','".$student_name."','".$parent_id."','".$parent_name."','".$parent_contact_no."','".$category."','".$reg_fee_amount."','".$payment_type."','".$balance_credits."','".$balance_credits."','".$created_at."','Active','".$vat_percent."','".$vat_value."','".date('Y-m-d')."','".$payable_amount."','Registration Fees')";
				$insert=$this->db->query($sql);
				$insert_id = $this->db->insert_id();

				
        
		        $updateCredit=$this->db->query("Update prepaid_credits set balance_credits='".$balance_credits."',total_credits='".$balance_credits."' where parent_id='".$parent_id."' ");
				//wallet transaction
				$txn_id = $this->schools->getLastEntry('wallet_transactions');
		          $wallet_transaction_id = 'WTXNO-'.$txn_id;
		          
		          $inv_id = $this->default->getInvoiceId('wallet_transactions');
              $invoice_id = 'PS'.date('Y').'-'.$inv_id;
              
		          $walletArray = array(
		            'wallet_transaction_id' =>$wallet_transaction_id,
		            'ac_code' => 'RFWTR',
		            'wallet_transaction_date' =>date('Y-m-d'),
		            'wallet_transaction_type' =>'Debit',
		            'wallet_transaction_detail' => 'Registration Fees',
		            'updated_admin_id' => $user_id,
		            'reg_id' => $parent_id,
		            'wallet_transaction_amount' => $reg_fee_amount,
		            'gross_amount' => $reg_fee_amount,
		            'vat_percentage' => $vat_percent,
		            'vat_value' => $vat_value,
		            'net_amount' => $payable_amount,
		            'debit' => $payable_amount,
		            'invoice' => 'yes',
                    'invoice_id' =>$invoice_id,
		            'payfee_id' =>$insert_id,
		            'student_id'=> $student_id,
		            'parent_id'=> $parent_id,
		            'parent_name'=> $parent_name,
		            'parent_mobile'=> $parent_contact_no,
		            //'parent_email_id'=> $data['parent_email'],
		            'description'=> ' Registration Fees',
		            'created_at'=> date('Y-m-d H:i:s'),
		        );
		        
		          $this->db->insert('wallet_transactions', $walletArray); 
		          $wallet_transaction_id = $this->db->insert_id();
		          
			    $this->invoice_model->send_email_invoice($wallet_transaction_id, "RegistrationFees");
					
		        
				
				
				
				$email_data = $this->db->query("SELECT rf.*,
											   r.sid,
											   wt.*,
											   p.parent_code,
											   p.email_id
										FROM   registration_fees AS rf
											   LEFT JOIN registrations AS r
													  ON r.id = rf.student_id
											   LEFT JOIN wallet_transactions AS wt
													  ON wt.student_id = rf.student_id
											   LEFT JOIN parent AS p
													  ON p.parent_id = wt.parent_id
													  where rf.id = ".$insert_id."
													  and wt.payfee_id =".$insert_id."");

																				  
				$email_data_array = $email_data->row_array();					
				
				$this->send_email($email_data_array);

				$this->session->set_flashdata('success_msg', 'Registration fees paid Successfully.');
				redirect(base_url().'registration_fees');
			}else{
				$this->session->set_flashdata('error', 'Prepaid credit value is insufficent.');
				redirect(base_url().'registration_fees');
			}
		}
		else{
			$this->load->view('registration_fees', $data);
		}
}


	public function send_email($email_data_array)
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

		$mail->Subject = "Prime Star Sports Services - Registation fee payment successful from ".$email_data_array['parent_code']." wallet";
		
		$mail->Body = "<!DOCTYPE>
						<html>
						   <head>
							  <title>PSSS</title>
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
							  <div class='logo' style='float: left; width: 100%; text-align: center; background: #ba272d; height: 100px;  margin-bottom: 20px;'>
								 <img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
							  </div>
							  <div class='header' style='float: left; width: 100%; ext-align: center; font-size: 21px;'>
								 <h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h2>
							  </div>
							  <div class='main' style='font-family: sans-serif;'>
								 <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
								 <p>Transaction ID :<b> ".$email_data_array['wallet_transaction_id']." </b></p>
								 <p>Registation fee payment successful from ".$email_data_array['parent_code']." wallet.. now you can continue to select your kids activities in the 'active kids' menu.</p>
								 <table>
									<tr>
									   <th>Parent-Id</th>
									   <th>Parent Name</th>
									   <th>Registation-Id</th>
									   <th>Name</th>
									   <th>Date</th>
									   <th>Payment mode</th>
									   <th>Registration Fees(AED)</th>
									   <th>Previous balance(AED)</th>
									   <th>Deduct amount(AED) & Inclusive of VAT(5%)</th>
									   <th>Wallet Balance(AED)</th>
									</tr>
									<tr>
									   <td>".$email_data_array['parent_code']."</td>
									   <td>".$email_data_array['parent_name']."</td>
									   <td>".$email_data_array['sid']."</td>
									   <td>".$email_data_array['student_name']."</td>
									   <td>".$email_data_array['pay_date']."</td>
									   <td>".Ucfirst($email_data_array['pay_type'])."</td>
									   <td>".sprintf("%.2f", $email_data_array['reg_fee'])."</td>
									   <td>".sprintf("%.2f", $email_data_array['wallet_balance']+$email_data_array['net_amount'])."</td>
									   <td>".sprintf("%.2f", $email_data_array['net_amount'])."</td>
									   <td>".sprintf("%.2f", $email_data_array['wallet_balance'])."</td>
									</tr>
								 </table>
								 <h4>Thanks & Regards</h4>
								 <h4 style='color: grey'>PSSS Admin team</h4>
								 <hr>
								 <p>Click here to visit our website:<a target='_blank' href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
							  </div>
						</body>	  
						</html>";
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

	
	$query = $this->db->query('select * from registration_fees where id='.$id);
	$postData=$query->row_array();
	$data['studentList'] = $this->default->getStudentList();
	$data['title'] = 'Registration Fees';
	$data['student_id']=$postData['student_id'];
	$data['pay_type']=$postData['pay_type'];
	$data['reg_fee_category']=$postData['reg_fee_category'];
	$data['reg_fee']=$postData['reg_fee'];
    $data['wallet_balance']=$postData['wallet_balance'];
		$data['wallet']=$postData['wallet'];
		$data['edit']=1;
		if($this->input->post('submit'))
		{
	    $student_id=$this->input->post('student_id');
		$student_name=$this->input->post('student_name');
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
		$parent_contact_no=$this->input->post('parent_contact_no');
		$category=$this->input->post('catagory');
		$reg_fee_amount=$this->input->post('reg_fee_amount');
		$payment_type=$this->input->post('payment_type');
		$wallet_amount=$this->input->post('wallet_amount');
		$payable_amount=$this->input->post('payable_amount');
		$updated_at=currentDateTime();

		 $sql="Update  registration_fees set student_id='$student_id',parent_id='$parent_id',parent_name='$parent_name',parent_contact='$parent_contact_no',reg_fee_category='$category',pay_type='$payment_type',reg_fee='$reg_fee_amount',wallet_balance='$payable_amount',wallet='$wallet_amount',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Registration Fees Updated Successfully.');
				redirect(base_url().'registration_fees');
			}

	$this->load->view('registration_fees',$data);


}
public function delete($id)
{
	 $sql="Delete from registration_fees  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Registration Fees Deleted Successfully.');
				redirect(base_url().'registration_fees');
			}

public function view($id)
{
	$query = $this->db->query('select * from registration_fees where id='.$id);
	$postData=$query->row_array();

	$data['id']=$postData['id'];
$data['student_id']=$postData['student_id'];
$data['student_name']=$postData['student_name'];
$data['parent_id']=$postData['parent_id'];
$data['parent_contact']=$postData['parent_contact'];
$data['parent_name']=$postData['parent_name'];

$data['student_id']=$postData['student_id'];
	$data['pay_type']=$postData['pay_type'];
	$data['reg_fee_category']=$postData['reg_fee_category'];
	$data['reg_fee']=$postData['reg_fee'];
    $data['wallet_balance']=$postData['wallet_balance'];
		$data['wallet']=$postData['wallet'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_registration_fees', $data);
}

public function list(){
    $data = array();
    $data['data']=$this->db->query("select * from registration_fees order by id desc")->result_array();
	$this->load->view('registration_fees_list', $data);
}
public function student_details(){
	$student_id=$this->input->post('student_id');
	$student=$this->db->query("select * from registrations where id='".$student_id."' and status='Active'")->row_array();
	
	$parent=$this->db->query("select * from parent where parent_id='".$student['parent_user_id']."' and status='Active'")->row_array();

	$data=$parent;
	$data['name']=$student['name'];

	$data['opcode']=1;
	
	$this->load->view('student_details_ajax', $data);	


}
public function wallet_details(){
	$parent_id=$this->input->post('parent_id');
	$wallet = $this->db->query("select ROUND(balance_credits,2) as balance_credits from prepaid_credits where parent_id='".$parent_id."' ")->row_array();
	$data['wallet_amount'] = isset($wallet['balance_credits'])?$wallet['balance_credits']:0.00;
	$data['opcode']=2;
	//print_r($data);die;
	$this->load->view('student_details_ajax', $data);	


}
public function get_category_fees()
{
    $data = array();
    $student_id=$this->input->post('student_id');
    $sql="select DATE_FORMAT(FROM_DAYS(DATEDIFF(CURDATE(),dob)), '%Y')+0 AS age from registrations where id='$student_id'";
    $age = $this->db->query($sql)->row()->age;
    if($age<19)
    {
        $sql2="select reg_fee from reg_charge_setups where category='Kid'";
        $reg_fee = $this->db->query($sql2)->row()->reg_fee;
        $category = 'Kid';
    }
    else
    {
        $sql2="select reg_fee from reg_charge_setups where category='Adult'";
        $reg_fee = $this->db->query($sql2)->row()->reg_fee;
        $category = 'Adult';
    }
    
    $data['reg_fee'] = $reg_fee;
    $data['category'] = $category;
    echo json_encode($data);
    
    
    
}

}