<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Wallet_transaction extends CI_Controller {  
	public function __construct(){
		parent::__construct();
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Default_Model', 'default');
		$this->load->model('Daily_Transaction_Model', 'transaction');
		$this->load->model('Invoice_Model', 'invoice_model');
	}
	
	public function index(){
		$data['title'] = 'Wallet Transaction';
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['parentList'] = $this->default->getParentList();
		$data['vatPercent'] = $this->schools->getVatDetails();
		$data['refundPercent'] = $this->default->getRefundDetails();
		$data['credit'] = 0;
		$this->load->view('wallet/wallet_transaction',$data);
	}
	public function save(){
		$user_id = $this->session->userid;
		$data['title'] = 'Wallet Transaction';
		$parent_id=$this->input->post('parent_id');
		$parent_name=$this->input->post('parent_name');
		$parent_mobile=$this->input->post('parent_mobile');
		$parent_email_id=$this->input->post('parent_email_id');
		$wallet_transaction_date=$this->input->post('wallet_transaction_date');
		$wallet_transaction_type=$this->input->post('wallet_transaction_type');
		$account_code=$this->input->post('account_code');
		$student_id=$this->input->post('student_id');
		$total_credit=$this->input->post('total_credit');
		$wallet_transaction_amount=$this->input->post('wallet_transaction_amount');
		$wallet_transaction_detail=$this->input->post('wallet_transaction_detail');
		$vat_percentage=$this->input->post('vat_percentage');
		$vat_value=$this->input->post('vat_value');
		$net_amount=$this->input->post('net_amount');
		$refund_percentage=$this->input->post('refund_percentage');
		$refund_value=$this->input->post('refund_value');
		$txn_id = $this->schools->getLastEntry('wallet_transactions');
		$wallet_transaction_id = 'WTXNO-'.$txn_id;
		$debit = $credit = $amount = 0;
		if($wallet_transaction_type == 'Debit'){
			$debit = $net_amount;
		}else{
			$credit = $net_amount;
		}

		$created_at=date('Y-m-d H:i:s');
		if (empty($wallet_transaction_date)) {
            $json['error']['wallet_transaction_date'] = 'Please enter wallet transaction date';
        }
        if ($wallet_transaction_type == '') {
            $json['error']['wallet_transaction_type'] = 'Please enter wallet transaction type';
        }
        if ($account_code == '') {
            $json['error']['account_code'] = 'Please select account code';
        }
        if ($parent_id == '') {
            $json['error']['parent_id'] = 'Please select parent';
        }
        if ($student_id == '') {
            $json['error']['student_id'] = 'Please select student';
        }
        if (empty($total_credit)) {
            $json['error']['total_credit'] = 'Please enter wallet credit amount';
        }
        if (empty($wallet_transaction_amount)) {
            $json['error']['wallet_transaction_amount'] = 'Please enter transaction amount';
        }
        if (empty($wallet_transaction_detail)) {
            $json['error']['wallet_transaction_detail'] = 'Please enter wallet transaction detail';
        }
        if (empty($net_amount)) {
            $json['error']['net_amount'] = 'Please enter NET amount';
        }
        if (empty($vat_value)) {
            $json['error']['vat_value'] = 'Please enter VAT amount';
        }
        if ($wallet_transaction_type == 'Credit') {
        	if (empty($refund_value)) {
            	$json['error']['refund_value'] = 'Please enter Refund amount';
        	}
        }

        if (empty($json['error']) ) {
        	if($total_credit >= $wallet_transaction_amount){
        		$account_code_name = $this->transaction->getAccountCodeDetail($account_code);
				$idVal = $this->input->post('id'); 
				$data = $this->input->post();
				if($wallet_transaction_type == 'Debit'){
					$data['refund_percentage']= $data['refund_value'] = '';
				}
				if($wallet_transaction_type == 'Debit'){
        		    $data['wallet_transaction_amount'] = $debit;
        		}else{
    				$data['wallet_transaction_amount'] = $credit;
        		}
				
				$data['debit'] = $debit;
				$data['credit'] = $credit;
				$data['gross_amount'] = $wallet_transaction_amount;
				$data['wallet_transaction_id'] = $wallet_transaction_id;
				$data['updated_admin_id'] = $user_id;
				$data['ac_code'] = $account_code_name;
				if($wallet_transaction_type == 'Debit'){
					$data['invoice'] = 'yes';
					$inv_id = $this->default->getInvoiceId('wallet_transactions');
					$data['invoice_id'] = 'PS'.date('Y').'-'.$inv_id;
				}
				else{
					$data['invoice'] = '';
					$data['invoice_id'] = NULL;
				}
          		
	        	if(($this->input->post('id')) !=''){
					$data['updated_at'] = date('Y-m-d H:i:s');
			        $this->db->where('id', $idVal);
			        $this->db->update('wallet_transactions', $data); 
			        $this->session->set_flashdata('success_msg', 'Wallet transaction updated successfully');
			        $json['status'] = "success";
			        $this->output->set_header('Content-Type: application/json');
			        echo json_encode($json);
				}else{
					$data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('wallet_transactions', $data); 
					$wallet_transaction_id = $this->db->insert_id();
					// wallet 
					if($wallet_transaction_type == 'Debit'){
						$wallet_Amount = $total_credit-($net_amount);
						$this->invoice_model->send_email_invoice($wallet_transaction_id, 'WalletTransaction');
					}else{
						$wallet_Amount = $total_credit+($net_amount);
					}
					$walletArray = array(
						'balance_credits' =>$wallet_Amount,
						'total_credits' =>$wallet_Amount,
					);
						$data1 = array('balance_credit' => $wallet_Amount);

						$this->db->where('id', $wallet_transaction_id);
						$this->db->update('wallet_transactions', $data1);
					$this->db->where('parent_id', $data['parent_id']); 
					$this->db->update('prepaid_credits', $walletArray); 

			        $this->session->set_flashdata('success_msg', 'Wallet transaction added successfully');
			        $json['status'] = "success";
			         $this->output->set_header('Content-Type: application/json');
			        echo json_encode($json);
				}
			}else{
				$json['status'] = 'error';  
		        $this->session->set_flashdata('error', 'Prepaid credit value is insufficent. ');
		        echo json_encode($json);
			}
		}else{
			$this->output->set_header('Content-Type: application/json');
	        echo json_encode($json);
		}
		
	}

	public function edit($id){ /* Need to update if we provide option, we swapped Debit and Credit Logic above. old is wrong */
		$query = $this->db->query('select * from wallet_transactions where id='.$id);
		$postData=$query->row_array();
		$data['student_id']=$postData['student_id'];
		$data['parent_id']=$postData['parent_id'];
		$data['account_code']=$postData['account_code'];
		$data['wallet_transaction_date']=$postData['wallet_transaction_date'];
		$data['wallet_transaction_type']=$postData['wallet_transaction_type'];
		$data['wallet_transaction_detail']=$postData['wallet_transaction_detail'];

		$data['wallet_transaction_amount']=$postData['wallet_transaction_amount'];
		$data['credit']=$postData['amount'];
		
		if($this->input->post('submit'))
		{
			$parent_id=$this->input->post('parent_id');
			$parent_name=$this->input->post('parent_name');
			$parent_mobile=$this->input->post('parent_mobile');
			$parent_email_id=$this->input->post('parent_email_id');
			$wallet_transaction_date=$this->input->post('wallet_transaction_date');
			$transaction_type=$this->input->post('transaction_type');
			$account_code=$this->input->post('account_code');
			$student_id=$this->input->post('student_id');
			$wallet_credit=$this->input->post('wallet_credit');
			$transaction_type=$this->input->post('transaction_type');
			$transaction_amount=$this->input->post('transaction_amount');
			$transaction_detail=$this->input->post('transaction_detail');

	
			$email=$this->session->userdata('username');

			$this->db->where('email', $email);  

			$query1 = $this->db->get('users');
			$postData1=$query1->row_array();
			$user_name=$postData1['user_name'];

			
			$updated_at=currentDateTime();

			$updated_date=date("d-m-Y", strtotime("$updated_at"));

			$sql="Update  wallet_transactions set student_id='$student_id',parent_id='$parent_id',parent_mobile='$parent_mobile',account_code='$account_code',wallet_transaction_type='$transaction_type',wallet_transaction_date='$wallet_transaction_date',wallet_transaction_detail='$transaction_detail',amount='$wallet_credit',updated_admin_name='$user_name',updated_admin_email='$email',updated_date='$updated_date',updated_at='$updated_at' where id='$id'";
			$insert=$this->db->query($sql);
			setMessage('Wallet Transaction are Updated Successfully.');
			redirect(base_url().'Wallet_transaction/list_');
		}

		$this->load->view('wallet/Wallet_transaction',$data);
	}

	public function delete($id){
		$sql="Delete from wallet_transactions  where id='$id'";
		$insert=$this->db->query($sql);
		setMessage('Wallet Transaction are Deleted Successfully.');
		redirect(base_url().'Wallet_transaction/list_');
	}

	public function list_(){
		$data['title'] = 'Wallet Transactions';
		$query = $this->db->query("select * from wallet_transactions order by `id` DESC ");
		$transactionList = $query->result_array();
		foreach($transactionList as $key=>$txnval){
			//$transactionList[$key]['account_code_val'] = (isset($txnval['account_code']) && $txnval['account_code']!='')?$this->transaction->getAccountCodeDetail($txnval['account_code']):'-';
			$transactionList[$key]['updated_admin'] = (isset($txnval['updated_admin_id']) && $txnval['updated_admin_id']!='')?$this->transaction->getUserDetail($txnval['updated_admin_id']):'-';
		}

		$data['transactionList'] = $transactionList;
		$this->load->view('wallet/wallet_transaction_list',$data);
	}
	
	public function view($id){
		$query = $this->db->query('select * from wallet_transactions where id='.$id);
		$data=$query->row_array();
		$data['title'] = 'Wallet Transaction details';
		$student_details = ($data['student_id'] != '')?$this->default->getStudentDetails($data['student_id']):'';
		$data['student_id']=$student_details['sid'];
		$data['account_code']=(isset($data['account_code']) && $data['account_code']!='')?$this->transaction->getAccountCodeDetail($data['account_code']):'';
		$data['updated_admin_id'] = ($data['updated_admin_id'] != 0)?$this->transaction->getUserDetail($data['updated_admin_id']):'-';
		$data['updated_admin_email'] = ($data['updated_admin_id'] != 0)?$this->transaction->getUserEmail($data['updated_admin_id']):'-';
		$this->load->view('wallet/view_wallet_transaction', $data);
	}

	public function payment(){
		$parent_id=$this->input->post('parent_id');
		$data['parent_id']=$parent_id;
		$data['opcode']=4;
		$query2=$this->db->query("select * from parent where parent_id='".$parent_id."' and status='Active'");
    	$data['row2']=$query2->row_array();

    	$students=$this->db->query("select id, sid,name from registrations where parent_user_id='".$parent_id."' and status='Active'");
    	$data['studentList']=$students->result_array();
    	if($parent_id != 0){
    		$data['walletAmount'] = $this->default->getWalletAmount($parent_id);
	    }else{
	    	$data['walletAmount']['id'] = '';
	    	$data['walletAmount']['total_credits'] = 0;
	    }

		$this->load->view('wallet/wallet_transaction_ajax', $data);	
	}
}  