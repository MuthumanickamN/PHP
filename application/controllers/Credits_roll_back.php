<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Credits_roll_back extends CI_Controller {  
      
    
	public function __construct(){
	parent::__construct();
	$this->load->model('School_profile_report_Model', 'schools');
	}
	
	public function index()
	{
		if($this->input->post('submit'))
		{
			
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
	    $parent_mobile=$this->input->post('parent_mobile');
		$parent_email_id=$this->input->post('parent_email_id');
		$total_credits=$this->input->post('total_credits');
		$balance_credits=$this->input->post('balance_credits');
		$roll_back_amount=$this->input->post('roll_back_amount');
		$description=$this->input->post('description');
		$prepaid_credit_id=$this->input->post('prepaid_credit_id');
	    $created_at=currentDateTime();
	    $walletAmount = $this->input->post('balance_credits');
	    $user_id = $this->session->userid;
	    $user_name = $this->session->name;
	    if( $walletAmount >= $roll_back_amount){
			$sql="INSERT into credits_roll_backs(prepaid_credit_id,parent_id,name_id,mobile_id,email_id,balance_credits,rollback_amount,total_credits,description,created_at,updated_by,updated_by_name) values('".$prepaid_credit_id."','".$parent_id."','".$parent_name."','".$parent_mobile."','".$parent_email_id."','".$balance_credits."','".$roll_back_amount."','".$total_credits."','".$description."','".$created_at."','".$user_id."','".$user_name."')";
			$insert=$this->db->query($sql);
			$insert_id = $this->db->insert_id();

            if($prepaid_credit_id !=0)
            {
			$sql2="Update prepaid_credits set balance_credits='$total_credits',total_credits='$total_credits' where id='$prepaid_credit_id'";
			$insert2=$this->db->query($sql2);
            }
            else
            {
                $insert_arr_pc= array(
                    'parent_id'=>$parent_id,
                    'name_id'=>$parent_name,
                    'mobile_id'=>$parent_mobile,
                    'balance_credits'=>$total_credits,
                    'total_credits'=>$total_credits,
                    'amount_paid'=>$total_credits,
                    'mobile_id'=>$parent_mobile,
                    'created_at' => date('Y-m-d H:i:s')
                    
                    );
                $this->db->insert('prepaid_credits', $insert_arr_pc);
            }
		
			//wallet transaction
			$txn_id = $this->schools->getLastEntry('wallet_transactions');
	         $wallet_transaction_id = 'WTXNO-'.$txn_id;

	          $walletArray = array(
	            'wallet_transaction_id' =>$wallet_transaction_id,
	            'ac_code' => 'WCTRRB',
	            'wallet_transaction_date' =>date('Y-m-d'),
	            'wallet_transaction_type' =>'Debit',
	            'wallet_transaction_detail' => 'Credits Roll Back',
	            'updated_admin_id' => $user_id,
	            'reg_id' => $parent_id,
	            'wallet_transaction_amount' => $roll_back_amount,
	            'gross_amount' => $roll_back_amount,
	            'net_amount' => $roll_back_amount,
	            'debit' => $roll_back_amount,
	            'parent_id'=> $parent_id,
	            'parent_name'=> $parent_name,
	            'parent_mobile'=> $parent_mobile,
	            'parent_email_id'=> $parent_email_id,
	            'description'=> 'Credits Roll Back',
	            'roll_back_id'=>$insert_id,
	            'balance_credit' =>$balance_credits,
	            'total_credit' =>$total_credits,
	            'updated_by' =>$user_id,
	            'updated_by_name' =>$user_name,
	            'created_at' => date('Y-m-d H:i:s'),
	        );
			
	        $checkexists = $this->db->query('select id from wallet_transactions where roll_back_id ="'.$insert_id.'" and  ac_code ="WCTRRB" and wallet_transaction_type = "Debit"');
	        $checkexistsArr = $checkexists->row_array();
			
			if (empty($checkexistsArr)){
				$this->db->insert('wallet_transactions', $walletArray); 
			//$sql = "";
			}else{
				$this->db->where('id', $checkexistsArr['id']);
				$this->db->update('wallet_transactions', $walletArray); 
			}


			$sql_query = "SELECT crb.*,
								   wt.wallet_transaction_id,
								   p.parent_code
							FROM   credits_roll_backs AS crb
								   LEFT JOIN wallet_transactions AS wt
										  ON wt.roll_back_id = crb.id
								   LEFT JOIN parent AS p
										  ON p.parent_id = crb.parent_id
									WHERE crb.id = ".$insert_id."";
										  
			$sql_array = $this->db->query($sql_query);
			$email_result = $sql_array->row_array();
			
			$this->send_email($email_result);
	
	        $this->session->set_flashdata('success_msg', 'New Credits Roll Back Amount Added Successfully.');
			redirect(base_url().'credits_roll_back/list');
			}else{
				$this->session->set_flashdata('error', 'Prepaid credit value is insufficent.');
				redirect(base_url().'credits_roll_back');
			}
	}
else
{
	$this->load->view('credits_roll_back');
}
}


	public function send_email($email_result)
	{
		
	
		
		$date_only = strtotime($email_result['created_at']);
		$newformat = date('d-m-Y',$date_only);


		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('Phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
	//	$mail->isSMTP();
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
		$mail->addAddress($email_result['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Credits Roll Back Details";
		
		$mail->Body = "<!DOCTYPE>
						<html>

						<head>
							<title>Credits Roll Back</title>
							<style>
								table, th, td{ border: 1px solid black;
						  border-collapse: collapse;
						  height: 63px;
								}
								th{
									background-color: #f5efef;
									text-align: left;
								}
							</style>
						</head>
						<body>
							<div style='width:1000px; margin:0 auto'>
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
								<p>Dear <b>".$email_result['name_id'].",</b></p>
								<p>We're contacting you to notify you that, That credits has been roll,back from your wallet. Wallet details below</p>
								<p>Transaction ID : <b>".$email_result['wallet_transaction_id']."</b></p>
								<table>
									<tr>
										<th>Parent-ID</th>
										<th>Name</th>
										<th>Date</th>
										<th>Previous balance(AED)</th>
										<th>Roll amount(AED)</th>
										<th>Total balance(AED)</th>
										<th>Reason</th>
									</tr>
									<tr>
										<td>".$email_result['parent_code']."</td>
										<td>".$email_result['name_id']."</td>
										<td>".$newformat."</td>
										<td>".$email_result['balance_credits']."</td>
										<td>".$email_result['rollback_amount']."</td>
										<td>".$email_result['total_credits']."</td>
										<td>".$email_result['description']."</td>
									</tr>
								</table>
								<h4>Thanks & Regards</h4>
								<h4 style='color: grey'>PSSS Admin team</h4>
							</div>
							</div>
							</body>
							</html>";
		$mail->AltBody = "This is the plain text version of the email content";
		
		
		
		
		if(!$mail->send()) 
		{
			return false;
		//	return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
		//	echo '<pre>'; print_r($mail); echo '</pre>';
			return true;
		}
		
	}
	

public function edit($id)
{

	
	$query = $this->db->query('select * from credits_roll_backs where id='.$id);
	$postData=$query->row_array();
	$data['parent_id']=$postData['parent_id'];
	$data['name_id']=$postData['name_id'];
	$data['mobile_id']=$postData['mobile_id'];
	$data['email_id']=$postData['email_id'];
	$data['balance_credits']=$postData['balance_credits'];
    $data['rollback_amount']=$postData['rollback_amount'];
		$data['total_credits']=$postData['total_credits'];
	
		$data['description']=$postData['description'];
		
	
		if($this->input->post('submit'))
		{
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
	    $parent_mobile=$this->input->post('parent_mobile');
		$parent_email_id=$this->input->post('parent_email_id');
		$total_credits=$this->input->post('total_credits');
		$balance_credits=$this->input->post('total_credits');
		$roll_back_amount=$this->input->post('roll_back_amount');
		$description=$this->input->post('description');
		$prepaid_credit_id=$this->input->post('prepaid_credit_id');

	
$email=$this->session->userdata('username');

	 $this->db->where('email', $email);  
           
           $query1 = $this->db->get('users');
	$postData1=$query1->row_array();
	$user_name=$postData1['user_name'];

			
		$updated_at=currentDateTime();
		$updated_date=date("d-m-Y", strtotime("$updated_at"));

		 $sql="Update  credits_roll_backs set parent_id='$parent_id',name_id='$parent_name',mobile_id='$parent_mobile',email_id='$parent_email_id',balance_credits='$balance_credits',total_credits='$total_credits',rollback_amount='$roll_back_amount',description='$description',updated_at='$updated_at',updated_name='$user_name',updated_email='$email',updated_date='$updated_date' where id='$id'";
		$insert=$this->db->query($sql);

		$sql1="Update  prepaid_credits set balance_credits='$balance_credits',total_credits='$total_credits' where id='$prepaid_credit_id'";
		$insert1=$this->db->query($sql1);


	
				setMessage('Credits Roll Back are Updated Successfully.');
				redirect(base_url().'credits_roll_back/list');
			}

	$this->load->view('credits_roll_back',$data);


}
public function delete($id)
{
	 $sql="Delete from credits_roll_backs  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Credits Roll Back are Deleted Successfully.');
				redirect(base_url().'credits_roll_back/list');
			}

public function list()
{
    $data = array();
    $data['list'] = $this->db->query("select c.*,p.parent_name,p.parent_code from credits_roll_backs c left join parent p on p.parent_id=c.parent_id")->result_array();
    $this->load->view('credits_roll_back_list', $data);
}
public function view($id)
{
	$query = $this->db->query('select * from credits_roll_backs where id='.$id);
	$postData=$query->row_array();
	$data['parent_id']=$postData['parent_id'];
	$data['name_id']=$postData['name_id'];
	$data['mobile_id']=$postData['mobile_id'];
	$data['email_id']=$postData['email_id'];
	$data['balance_credits']=$postData['balance_credits'];
    $data['rollback_amount']=$postData['rollback_amount'];
		$data['total_credits']=$postData['total_credits'];
	
		$data['description']=$postData['description'];
	
$data['created_at']=$postData['created_at'];
$data['updated_at']=$postData['updated_at'];

	$data['updated_name']=$postData['updated_name'];
		$data['updated_email']=$postData['updated_email'];
		$data['updated_date']=$postData['updated_date'];

	$this->load->view('view_credits_roll_back', $data);
}

	


	 public function payment()
    {

    	$parent_id=$this->input->post('parent_id');
        
        
    	$data['parent_id']=$parent_id;
    	$data['opcode']=4;
    	
    	$this->load->view('credits_roll_back_ajax', $data);	


    }

  
 

		
}  