<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Daily_transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}

	public function index()
	{
		$data['title'] = 'Daily Transaction';
		$data['transaction_date'] = date('Y-m-d');
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['userList'] = $this->transaction->getAllUserList();
		$data['vatPercent'] = $this->schools->getVatDetails();
		$data['transactionList'] = $this->transaction->getAlltransactionList();
		$invoice_id = $this->schools->getLastEntry('daily_transactions');
		$data['invoice_id'] = 'INVNO-'.$invoice_id;
		
		$this->load->view('daily_transaction',$data);
	}
	public function checkexists($table,$field,$value){
	    $this->db->where($field,$value);
	    $query = $this->db->get($table);
	    if (!empty($query->result_array())){
	        return 1;
	    }
	    else{
	        return 0;
	    }
	}
	public function list_(){
		$data['title'] = "Daily Transaction";
		$query = $this->db->query("select * from daily_transactions order by `id` DESC ");
		$transactionList = $query->result_array();
		foreach($transactionList as $key=>$txnval){
			$transactionList[$key]['account_code_val'] = (isset($txnval['account_code']) && $txnval['account_code']!='')?$this->transaction->getAccountCodeDetail($txnval['account_code']):'-';
			$transactionList[$key]['updated_admin'] = (isset($txnval['updated_admin_id']) && $txnval['updated_admin_id']!='')?$this->transaction->getUserDetail($txnval['updated_admin_id']):'-';
		}

		$data['transactionList'] = $transactionList;
		
		$this->load->view('daily_transaction_list', $data);
	}
	
	public function save()
	{
		$user_id = $this->session->userid;
		$transact_date = $this->input->post('transaction_date');
		$transaction_date = date('Y-m-d', strtotime($transact_date));
		$transaction_type = $this->input->post('transaction_type');
		$account_code = $this->input->post('account_code');
		$activity_id = $this->input->post('activity_id');
		$location_id = $this->input->post('location_id');
		$coach_id = $this->input->post('coach_id');
		$approved_by = $this->input->post('approved_by');
		$settled_by = $this->input->post('settled_by');
		$invoice = $this->input->post('invoice');
		$invoice_date = $this->input->post('invoice_date');
		$trn_no = $this->input->post('trn_no');
		$paid_to = $this->input->post('paid_to');
		$transaction_detail = $this->input->post('transaction_detail');
		$transaction_amount = $this->input->post('transaction_amount');
		$vat_percentage = $this->input->post('vat_percentage');
		$vat_amount = $this->input->post('vat_value');
		$net_amount = $this->input->post('net_amount');
		$payment_type = $this->input->post('payment_type');
		$is_submit = $this->input->post('is_submit');
	
		
		$txn_id = $this->schools->getLastEntry('daily_transactions');
		$transaction_id = 'TXNO-'.$txn_id;
		$bank = $cheque_number = $cheque_date = '' ;
		$debit = $credit = $amount = 0;
		if($transaction_type == 'Debit'){
			$debit = $net_amount;
		}else{
			$credit = $net_amount;
		}
		if ($payment_type == 'Card' || $payment_type == 'Online') {
			$bank = $this->input->post('bank');
			$cheque_number =$cheque_date ='';
			if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
		} else if ($payment_type == 'Cheque') {
			$bank = $this->input->post('bank');
			$cheque_number = $this->input->post('cheque_number');
			$cheque_date = $this->input->post('cheque_date');
			if (empty($cheque_number)) {
	            $json['error']['cheque_number'] = 'Please enter cheque number';
	        }
	        if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
	        if (empty($cheque_date)) {
	            $json['error']['cheque_date'] = 'Please enter cheque date';
	        }
		} else if ($payment_type == 'Cash') {
			$payment_type = $this->input->post('payment_type');
			$bank = $cheque_number =$cheque_date ='';
		}

		if (empty($transact_date)) {
            $json['error']['transaction_date'] = 'Please enter transaction date';
        }
        if (empty($transaction_type)) {
            $json['error']['transaction_type'] = 'Please enter transaction type';
        }
        if ($account_code == '') {
            $json['error']['account_code'] = 'Please select account code';
        }
        if ($approved_by == '') {
            $json['error']['approved_by'] = 'Please select Approved person';
        }
        if ($settled_by == '') {
            $json['error']['settled_by'] = 'Please select Settled by person';
        }
        if ($paid_to == '') {
            $json['error']['paid_to'] = 'Please select paid to';
        }
       
        if (empty($invoice)) {
            $json['error']['invoice'] = 'Please enter invoice Number';
        }
        if (empty($invoice_date)) {
            $json['error']['invoice_date'] = 'Please enter invoice date';
        }
        if (empty($trn_no)) {
            $json['error']['trn_no'] = 'Please enter TRN no';
        }
        if (empty($transaction_detail)) {
            $json['error']['transaction_detail'] = 'Please enter transaction detail';
        }
        if (empty($transaction_amount)) {
            $json['error']['transaction_amount'] = 'Please enter transaction amount';
        }
        if (empty($vat_amount)) {
            $json['error']['vat_amount'] = 'Please enter VAT amount';
        }
        if (empty($net_amount)) {
            $json['error']['net_amount'] = 'Please enter net amount';
        }
        if (empty($payment_type)) {
            $json['error']['payment_type'] = 'Please enter payment type';
        }
        $json['status'] = 'error';
        
		$created_at = currentDateTime();

		$activity_id = $this->input->post('activity_id');
		$location_id = $this->input->post('location_id');
		$coach_id = $this->input->post('coach_id');
		$approved_by = $this->input->post('approved_by');
		$settled_by = $this->input->post('settled_by');
		$invoice = $this->input->post('invoice');
		$invoice_date = $this->input->post('invoice_date');
		$trn_no = $this->input->post('trn_no');
		$paid_to = $this->input->post('paid_to');
		$transaction_detail = $this->input->post('transaction_detail');
		$transaction_amount = $this->input->post('transaction_amount');
		$vat_percentage = $this->input->post('vat_percentage');
		$vat_amount = $this->input->post('vat_value');
		$net_amount = $this->input->post('net_amount');
		$payment_type = $this->input->post('payment_type');

		
		if (empty($json['error']) ) {
			if(($this->input->post('id')) !=''){
				$idVal = $this->input->post('id'); 
				$data = $this->input->post();
				$data['debit'] = $debit;
				$data['credit'] = $credit;
				$data['gross_amount'] = $transaction_amount;
				$data['updated_admin_id'] = $user_id;
				$data['bank'] = $bank;
				$data['cheque_number'] = $cheque_number;
				$data['cheque_date'] = $cheque_date;
				$data['updated_at'] = date('Y-m-d H:i:s');
				
		        $this->db->where('id', $idVal);
		        $this->db->update('daily_transactions', $data); 
		        $this->session->set_flashdata('success_msg', 'Daily transaction voucher updated successfully');
		        $json['status'] = "success";
		         $this->output->set_header('Content-Type: application/json');
		        echo json_encode($json);
			}else{
				if($is_submit == 0){
					$json['status'] = "popup";
					 $this->output->set_header('Content-Type: application/json');
		        	echo json_encode($json);
				}else{
				$checkexists = $this->checkexists('daily_transactions','invoice',$invoice);
				if($checkexists == 0){
					$sql = "INSERT into daily_transactions(transaction_date,transaction_type,account_code,transaction_detail,transaction_amount,vat_percentage,vat_value,net_amount,bank,cheque_number,cheque_date,payment_type,created_at, transaction_id, activity_id, location_id, coach_id, approved_by, settled_by, invoice, invoice_date, trn_no, paid_to, credit, debit, amount, updated_admin_id, gross_amount) values('" . $transaction_date . "','" . $transaction_type . "','" . $account_code . "','" . $transaction_detail . "','" . $transaction_amount . "','" . $vat_percentage . "','" . $vat_amount . "','" . $net_amount . "','" . $bank . "','" . $cheque_number . "','" . $cheque_date . "','" . $payment_type . "','" . $created_at . "','".$transaction_id."','".$activity_id."','".$location_id."','".$coach_id."','".$approved_by."','".$settled_by."','".$invoice."','".$invoice_date."','".$trn_no."','".$paid_to."','".$credit."','".$debit."','".$amount."','".$user_id."','".$transaction_amount."')";
					$insert = $this->db->query($sql);
					if(isset($insert)){
						$json['status'] = "success";
						 $this->output->set_header('Content-Type: application/json');
			        	echo json_encode($json);
					}
					//setMessage('New Activity Added Successfully.');
					$this->session->set_flashdata('success_msg', 'New transaction Added Successfully.');
				}
			}
		}
			//redirect(base_url() . 'Daily_transaction/list');
		}else{
	        $this->output->set_header('Content-Type: application/json');
	        echo json_encode($json);
		} 
	}

	public function edit($id)
	{

		
		$query = $this->db->query('select * from daily_transactions where id=' . $id);
		$data = $query->row_array();
		//print_r($data); die;
		$data['title'] ="Edit - Daily transaction";
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['activityList'] = $this->schools->getAllActivityList();
		$data['locationList'] = $this->schools->getAllLocationList();
		$data['coachList'] = $this->transaction->getAllCoachList();
		$data['userList'] = $this->transaction->getAllUserList();
		$data['vatPercent'] = $this->schools->getVatDetails();
		$data['transactionList'] = $this->transaction->getAlltransactionList();		
		$data['bankdetails'] = $this->transaction->getAllBankList();
		/*$data['transaction_date'] = $postData['transaction_date'];
		$data['transaction_type'] = $postData['transaction_type'];
		$data['account_code'] = $postData['account_code'];
		$data['transaction_detail'] = $postData['transaction_detail'];
		$data['transaction_amount'] = $postData['transaction_amount'];
		$data['vat_percentage'] = $postData['vat_percentage'];

		$data['vat_value'] = $postData['vat_value'];
		$data['net_amount'] = $postData['net_amount'];
		$data['bank'] = $postData['bank'];
		$data['cheque_number'] = $postData['cheque_number'];
		$data['cheque_date'] = $postData['cheque_date'];
		$data['payment_type'] = $postData['payment_type'];*/
		//$data = $postData;
		if ($this->input->post('submit')) {
			$transaction_date = $this->input->post('transaction_date');
			$transaction_type = $this->input->post('transaction_type');
			$account_code = $this->input->post('account_code');
			$transaction_detail = $this->input->post('transaction_detail');
			$transaction_amount = $this->input->post('transaction_amount');
			$vat_percentage = $this->input->post('vat_percentage');
			$vat_amount = $this->input->post('vat_amount');
			$net_amount = $this->input->post('net_amount');
			$payment_type = $this->input->post('payment_type');
			$bank = $this->input->post('bank');
			$cheque_number = $this->input->post('cheque_number');
			$cheque_date = $this->input->post('cheque_date');
			$email = $this->session->userdata('username');

			$this->db->where('email', $email);

			$query1 = $this->db->get('users');
			$postData1 = $query1->row_array();
			$user_name = $postData1['user_name'];


			$updated_at = currentDateTime();
			$debit = $credit = $amount = 0;
			if($transaction_type == 'Debit'){
				$debit = $net_amount;
			}else{
				$credit = $net_amount;
			}
			if ($payment_type == 'Card' || $payment_type == 'Online') {
			$bank = $this->input->post('bank');
			if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
			} else if ($payment_type == 'Cheque') {
			$bank = $this->input->post('bank');
			$cheque_number = $this->input->post('cheque_number');
			$cheque_date = $this->input->post('cheque_date');
			if (empty($cheque_number)) {
	            $json['error']['cheque_number'] = 'Please enter cheque number';
	        }
	        if (empty($bank)) {
	            $json['error']['bank'] = 'Please enter bank';
	        }
	        if (empty($cheque_date)) {
	            $json['error']['cheque_date'] = 'Please enter cheque date';
	        }
		} else if ($payment_type == 'Cash') {
			$payment_type = $this->input->post('payment_type');
		}

			$sql = "Update  daily_transactions set transaction_date='$transaction_date',transaction_type='$transaction_type',account_code='$account_code',transaction_detail='$transaction_detail',transaction_amount='$transaction_amount',gross_amount='$transaction_amount',vat_percentage='$vat_percentage',vat_value='$vat_amount',net_amount='$net_amount',payment_type='$payment_type',updated_at='$updated_at',updated_admin_name='$user_name',updated_admin_email='$email', debit='$debit', credit='$credit' where id='$id'";
			$insert = $this->db->query($sql);



			setMessage('Transaction are Updated Successfully.');
			redirect(base_url() . 'daily_transaction/list_');
		}

		$this->load->view('daily_transaction', $data);
	}
	public function delete($id)
	{
		$sql = "Delete from daily_transactions  where id='$id'";
		$insert = $this->db->query($sql);



		setMessage('Transaction are Deleted Successfully.');
		redirect(base_url() . 'daily_transaction/list_');
	}

	public function getdetail()
	{
		$txn_idVal = $this->input->post('transaction_idVal');
		$query = $this->db->query("select * from daily_transactions where `id` = '".$txn_idVal."' ");
		$json['data'] = $query->row_array();
		$json['data']['account_code'] = $this->transaction->getAccountCodeDetail($json['data']['account_code']);
		$json['data']['approved_by'] = $this->transaction->getUserDetail($json['data']['approved_by']);
		$json['data']['settled_by'] = $this->transaction->getUserDetail($json['data']['settled_by']);
		$json['data']['paid_to'] = $this->transaction->getUserDetail($json['data']['paid_to']);

		$json['data']['activity_id'] = ($json['data']['activity_id'] != 0)?$this->transaction->getActivityDetail($json['data']['activity_id']):'-';
		$json['data']['location_id'] = ($json['data']['location_id'] != 0)?$this->transaction->getLocationDetail($json['data']['location_id']):'-';
		$json['data']['coach_id'] = ($json['data']['coach_id'] != 0)?$this->transaction->getCoachDetail($json['data']['coach_id']):'-';
		$json['data']['created_on'] = date('d-m-Y',strtotime($json['data']['created_at']));
		$json['data']['created_at'] = date('d-m-Y h:i a',strtotime($json['data']['created_at']));
		$json['data']['transaction_date'] = date('d-m-Y',strtotime($json['data']['transaction_date']));
		$json['data']['cheque_date'] = date('d-m-Y',strtotime($json['data']['cheque_date']));
		$json['data']['created_by'] = $this->transaction->getUserDetail($json['data']['updated_admin_id']);

		
		$this->output->set_header('Content-Type: application/json');
        echo json_encode($json); die;
	}

	public function reversalrequest(){
		$txn_idVal = $this->input->post('transaction_idVal');
		$refund_reason = $this->input->post('refund_reason');
		if (empty($txn_idVal)) {
            $json['error']['transaction_idVal'] = 'Please select transaction ID';
        }
        if (empty($refund_reason)) {
            $json['error']['refund_reason'] = 'Please enter reason for reversal';
        }
        if (empty($json['error'])) {
			$data = array(
            'refund_reason' => $refund_reason,
            'is_reversed' => 1,
            'updated_at' => date('Y-m-d H:i:s')
	        );
	        $this->db->where('id', $txn_idVal);
	        $this->db->update('daily_transactions', $data);	
	       /*$query=$this->db->query("update daily_transactions SET refund_reason='".$refund_reason."',updated_at='".date('Y-m-d H:i:s')."' where id='$id'");*/

	        $json['status'] = "success";
				 $this->output->set_header('Content-Type: application/json');
	        	echo json_encode($json);
		}else{
	        $this->output->set_header('Content-Type: application/json');
	        echo json_encode($json);
		} 

	}

	public function report()
	{
		$postdate = $this->input->post('from_date');
		$acc_code = $this->input->post('acc_code');
		$id_val = $this->input->post('id_val');
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		$where = "where `transaction_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($acc_code) && $acc_code != ''){
			$where .= " AND `account_code` = '".$acc_code."' ";
		}
		if(isset($id_val) && $id_val != ''){
			$where .= " AND `updated_admin_id` = '".$id_val."' ";
		}
		$data['title'] = 'Daily transaction report';
		$query = $this->db->query("select * from daily_transactions ".$where.' order by `id` DESC');
		$transactionList = $query->result_array();
		foreach($transactionList as $key=>$txnval){
			$transactionList[$key]['account_code_val'] = (isset($txnval['account_code']) && $txnval['account_code']!='')?$this->transaction->getAccountCodeDetail($txnval['account_code']):'-';
			$transactionList[$key]['updated_admin'] = (isset($txnval['updated_admin_id']) && $txnval['updated_admin_id']!='')?$this->transaction->getUserDetail($txnval['updated_admin_id']):'-';
		}

		$data['transactionList'] = $transactionList;
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['acc_code'] =$acc_code;
		$data['id_val'] =$id_val;
		$data['account_code_data'] = $this->schools->getAccountCodeList();
		$data['userList'] = $this->transaction->getAllUserList();
		
		$this->load->view('daily_transaction_report', $data);
	}

	public function view($id)
	{
		$query = $this->db->query('select * from daily_transactions where id=' . $id);
		$postData = $query->row_array();
		$data['transaction_date'] = $postData['transaction_date'];
		$data['id'] = $postData['id'];

		$data['transaction_type'] = $postData['transaction_type'];
		$data['account_code'] = $postData['account_code'];
		$data['transaction_detail'] = $postData['transaction_detail'];
		$data['transaction_amount'] = $postData['transaction_amount'];
		$data['vat_percentage'] = $postData['vat_percentage'];

		$data['vat_value'] = $postData['vat_value'];
		$data['net_amount'] = $postData['net_amount'];
		$data['bank'] = $postData['bank'];
		$data['cheque_number'] = $postData['cheque_number'];
		$data['cheque_date'] = $postData['cheque_date'];
		$data['payment_type'] = $postData['payment_type'];
		$data['created_at'] = $postData['created_at'];
		$data['updated_at'] = $postData['updated_at'];
		$data['updated_admin_name'] = $postData['updated_admin_name'];
		$data['updated_admin_email'] = $postData['updated_admin_email'];
		$this->load->view('view_daily_transaction', $data);
	}


	public function payment_type()
	{
		$payment_type = $this->input->post('payment_type');
		$data['payment_type'] = $payment_type;
		if($payment_type == 'Cheque')
			$data['opcode'] = 2;
		else
			$data['opcode'] = 1;
		$data['bankdetails'] = $this->transaction->getAllBankList();
		$this->load->view('daily_transaction_ajax', $data);
	}
	public function payment_types()
	{
		$payment_type = $this->input->post('payment_type');
		$data['payment_type'] = $payment_type;
		$data['opcode'] = 2;
		$this->load->view('daily_transaction_ajax', $data);
	}
}
