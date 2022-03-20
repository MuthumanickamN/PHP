<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Activity_approval extends CI_Controller {  
	
	public function __construct(){
		parent::__construct();
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
		$this->load->model('Default_Model', 'default');
	}
	public function index(){
		$data['title'] = 'Activity Approval';
		$query = $this->db->query('select * from activity_selections');
		$activityList=$query->result_array();
		foreach ($activityList as $key => $value) {
			$activityList[$key]['activity'] = $this->transaction->getActivityDetail($value['activity_id']);
		}
		$data['activityList'] = $activityList;
		$this->load->view('activity_approval/index', $data);
	}
	public function edit($id){
		$query = $this->db->query('select * from activity_selections where id='.$id);
		$data=$query->row_array();
		$data['paid_amount'] = 0;		
		if($data['contract'] != 'No'){
			$contract_details = $this->db->query('select * from contract_details where activity_selection_id='.$id)->result_array();
			if(isset($contract_details) && !empty($contract_details)){
				$data['contract_arr'] = $contract_details[0];
				foreach($contract_details as $k=>$cont){
					if($cont['amount'] != 0){
						$data['contractList'][$k] = $cont;
						$data['paid_amount'] += $cont['amount'];
					}
				}
			$data['balance_amount'] = (float)$data['contract_arr']['contract_net_amount'] - (float)$data['paid_amount'];
			}
		}
		$data['discountList'] = $this->default->getDiscountList();
		$data['bankdetails'] = $this->transaction->getAllBankList();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('activity_approval_edit',$data);
	}
public function submit(){
	
	$admin_id = $this->session->userid;
	$id=$this->input->post('id');
	$query = $this->db->query('select * from activity_selections where id='.$id);
	$postData=$query->row_array();
	$activity_id=$this->input->post('activity_id');
	$level_id=$this->input->post('level_id');
	$classes=$this->input->post('classes');
	$contract=$this->input->post('contract');
	$status=$this->input->post('status');
	$approval_status=$this->input->post('approval_status');
	$discount_applicable=$this->input->post('discount_applicable');
	$discount_type=$this->input->post('discount_type');
	$discount_percentage=$this->input->post('discount_percentage');
	$user_id=$this->input->post('user_id');
    $updated_at=currentDateTime();

    if ($activity_id == '') {
        $json['error']['activity_id'] = 'Please select activity ';
    }
    if ($level_id == '') {
        $json['error']['level_id'] = 'Please select level ';
    }
    if ($contract == '') {
        $json['error']['contract'] = 'Please select contract ';
    }
    if ($status == '') {
        $json['error']['status'] = 'Please select status ';
    }
    if ($approval_status == '') {
        $json['error']['approval_status'] = 'Please select approval status ';
    }
    if ($discount_applicable == '') {
        $json['error']['discount_applicable'] = 'Please select discount applicable ';
    }
    if($discount_applicable == 'Yes'){
    	if ($discount_type == '') {
        $json['error']['discount_type'] = 'Please select discount type ';
    	}
    	if ($discount_percentage == '') {
        $json['error']['discount_percentage'] = 'Please select discount percentage ';
    	}
    }
    if($discount_applicable == 'No'){
    	$discount_type = $discount_percentage = '';
    }
    if (empty($json['error']) ) {
		$sql="Update  activity_selections set level_id='".$level_id."',contract='".$contract."',discount_applicable='".$discount_applicable."', discount_type='".$discount_type."',discount_percentage='".$discount_percentage."',status='".$status."',approval_status='".$approval_status."' where id='$id'";
		$update = $this->db->query($sql);
		if($contract != 'No'){
			$getTotalAmount = $this->db->query("select SUM(amount) as amount from contract_details where `activity_selection_id` = '".$id."' ")->row()->amount;
			if($getTotalAmount <= $this->input->post('contract_net_amount') ){
				$Payment_Array = $this->input->post('payment');
				foreach($Payment_Array as $key => $payment){
					$contract_Array = array('activity_selection_id' => $id,
						'student_name' => $postData['student_name'],
						'parent_name' => $postData['parent_name'],
						'student_passport_id' => $this->input->post('student_passport_id'),
						'student_emirates_id' => $this->input->post('student_emirates_id'),
						'student_emirates_id_expiry' => $this->input->post('student_emirates_id_expiry'),
						'parent_passport_id' => $this->input->post('parent_passport_id'),
						'parent_emirates_id' => $this->input->post('parent_emirates_id'),
						'parent_emirates_id_expiry' => $this->input->post('parent_emirates_id_expiry'),
						'year' => $this->input->post('year'),
						'contract_from_date' => $this->input->post('contract_from_date'),
						'contract_to_date' => $this->input->post('contract_to_date'),
						'contract_gross_amount' => $this->input->post('contract_gross_amount'),
						'contract_vat_amount' => $this->input->post('contract_vat_amount'),
						'contract_vat_percentage' => $this->input->post('contract_vat_percentage'),
						'contract_net_amount' => $this->input->post('contract_net_amount'),
						'payment_type' =>$payment['payment_type'],
						'bank' => $payment['bank'],
						'cheque_bank' => $payment['cheque_bank'],
						'cheque_number' => $payment['cheque_number'],
						'cheque_date' => $payment['cheque_date'],
						'payable_date' => $payment['payable_date'],
						'amount' => $payment['amount'],
						'created_admin_id'=>$admin_id, 
						'created_date' => date('Y-m-d'),
						'status' => 'Yes',
						'created_at' => date('Y-m-d H:i:s'),
					);
					
					$checkexists = $this->db->query("select id from contract_details where `activity_selection_id` = '".$id."' and `amount` = '0' ")->row_array();
					if(isset($checkexists) && !empty($checkexists)){
						$this->db->where('id', $checkexists['id']);
		        		$this->db->update('contract_details', $contract_Array); 
		        		$contract_id = $checkexists['id'];
					}else{
						$this->db->insert('contract_details', $contract_Array); 
						$contract_id = $this->db->insert_id();
					}
					if($payment['amount'] != 0){
					//wallet transaction 
           			$vatPercent = $this->input->post('contract_vat_percentage');
           			$paidAmount = $payment['amount'];

           			$vatValue = ($vatPercent / 100) * $paidAmount;
           			$amountWoVat = (float)$paidAmount-(float)$vatValue;

			          $txn_id = $this->schools->getLastEntry('wallet_transactions');
			          $wallet_transaction_id = 'WTXNO-'.$txn_id;

			          $inv_id = $this->default->getInvoiceId('wallet_transactions');
			          $invoice_id = 'PS'.date('Y').'-'.$inv_id;

			          $walletArray = array(
			            'wallet_transaction_id' =>$wallet_transaction_id,
			            'ac_code' => 'Contract',
			            'wallet_transaction_date' =>$payment['payable_date'],
			            'wallet_transaction_type' =>'Debit',
			            'wallet_transaction_detail' => 'Contract Customer Invoice',
			            'updated_admin_id' => $admin_id,
			            'reg_id' => $postData['psa_id'],
			            'wallet_transaction_amount' => $payment['amount'],
			            'gross_amount' => $amountWoVat,
			            'vat_percentage' => $vatPercent,
			            'vat_value' => $vatValue,
			            'net_amount' => $payment['amount'],
			            'debit' => $payment['amount'],
			            'invoice' => 'yes',
			            'invoice_id' =>$invoice_id,
			            'payfee_id'=>$contract_id,
			            'student_id'=> $postData['student_id'],
			            'parent_id'=> $postData['registration_id'],
			            'parent_name'=> $postData['parent_name'],
			            'parent_mobile'=> $postData['parent_mobile'],
			            'parent_email_id'=> $postData['parent_email_id'],
			            'description'=> 'Contract Customer Invoice',
			        );
			        $checkexistsWallet = $this->db->query('select id from wallet_transactions where payfee_id ="'.$contract_id.'" and  ac_code ="Contract" and wallet_transaction_type = "Debit"  ');
			        $checkexistsArr = $checkexistsWallet->row_array();
			        if (empty($checkexistsArr)){
			          $this->db->insert('wallet_transactions', $walletArray); 
			        }else{
			          $this->db->where('id', $checkexistsArr['id']);
			           $this->db->update('wallet_transactions', $walletArray); 

			        }
			    }
				}
			}else{
				$json['status'] = "success";
				$this->output->set_header('Content-Type: application/json');
				$this->session->set_flashdata('success_msg', 'Amount already paid for this contract.');
				echo json_encode($json);
			}

		}
		if(isset($update)){
				$this->session->set_flashdata('success_msg', 'Activity Approved Successfully.');
				$json['status'] = "success";
				$this->output->set_header('Content-Type: application/json');
				echo json_encode($json);
		}
	}else{
		$this->output->set_header('Content-Type: application/json');
		echo json_encode($json);
	}
}
  public function classes(){
	$level_id=$this->input->post('level_id');
	$query=$this->db->query("select * from game_levels where games_level_id='".$level_id."'");
	$row=$query->row_array();
	$data['session']=$row['session'];
	$data['opcode']=3;
	$this->load->view('student_details_ajax', $data);	
}

public function delete($game_id){
	$sql="Delete from games  where game_id='$game_id'";
	$insert=$this->db->query($sql);
	setMessage('Activity Deleted Successfully.');
	redirect(base_url().'index.php/games');
}

public function view($id){
	$data['title'] = 'Activity Selection Details';
	$query = $this->db->query('select a.*, g.level,g.session from activity_selections as a
														LEFT JOIN game_levels as g ON a.level_id = g.games_level_id 
														where id='.$id);
	$data['activity']=$query->row_array();
	$data['activity']['activity_id']=$this->transaction->getActivityDetail($data['activity']['activity_id']);
	$data['activity']['head_coach_id']=($data['activity']['coach_id']!='')?$this->transaction->getCoachDetail($data['activity']['coach_id']):'-';
	$data['activity']['updated_admin_id']=$this->transaction->getUserDetail($data['activity']['updated_admin_id']);
	$this->load->view('activity_approval/view', $data);
}
public function get_discount($discount_type){
	echo $this->default->getDiscountPercent($discount_type);
}

public function getContractDetails($id){
	$data = array();
	$query = $this->db->query('select * from activity_selections where id='.$id);
	$activity=$query->row_array();
	$data['contract_vat_percentage'] = $this->schools->getVatDetails();

	$student_Details = $this->db->query('select name as student_name, passport_id as student_passport_id, emirates_id as student_emirates_id, emirates_id_expire as student_emirates_id_expiry  from registrations where id='.$activity['student_id']);
	$studDetails = $student_Details->row_array();

	//$data = array_merge($data, $studDetails);

	echo json_encode($data);
}

}