<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class AccountService extends CI_Controller {  
      
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Accountservice_model');
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Daily_Transaction_Model', 'transaction');
		$this->load->library('upload');
	}
    public function index(){
		$data['title'] = 'AccountService';
		$data['account_service'] = $this->Accountservice_model->gettype();
		$data['vat_perc'] = $this->Accountservice_model->getVatPercentage();
		
		if($this->input->post('submit')){
			$type=$this->input->post('type');
			$paid = $this->input->post('paid_amount');
			$account_service=$this->input->post('account_service');
			$service=$this->input->post('service');
			$vat_percent=$this->input->post('vat_percentage');
			$description_detail = $this->input->post('description_detail');
			$payment_type = $this->input->post('payment_type');
			$vat_value= $this->input->post('vat_value');
			$payable_amount=$this->input->post('payable_amount');
			$payable_date=$this->input->post('payable_date');
			$created_at=date('Y-m-d H:i:s');
			$txn_id = $this->schools->getLastEntry('wallet_transactions');
			$wallet_transaction_id = 'TXNO-'.$txn_id;

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
	

			if ($type == 'Expense' || $type == 'Income') {
				$service = $this->input->post('service');
				if (empty($service)) {
					$json['error']['service'] = 'Please enter service';
				}
			} 
			$sql="INSERT into accounts_service_entries(transaction_id, accountservice_id,gross_amount,vat_percentage,vat_amount,payable_amount,description_detail,payable_date,payment_type,bank,cheque_number,cheque_date,created_at, created_by)values('".$wallet_transaction_id."','".$service."','".$paid."','".$vat_percent."','".$vat_value."','".$payable_amount."','".$description_detail."','".$payable_date."','".$payment_type."','".$bank."','".$cheque_number."','".$cheque_date."','".$created_at."', '".$this->session->userid."')";
		    $insert=$this->db->query($sql);	
			//print_r ($sql);die;
			$lastid = $this->db->insert_id();
				/***** Upload multiple files ********/	
				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['userfile']['name']);
				$myFile = $_FILES['userfile'];
				for($i=0; $i<$cpt; $i++)
				{   
					$error = $myFile["error"][$i];
					 if ($error == '4')  // error 4 is for "no file selected"
             {
             }
            else
             {
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('userfile');
					
		$sql1="INSERT into accountserviceuploadedfiles(accountservice_id,filename) values('".$lastid."','".$files['userfile']['name'][$i]."')";
		$this->db->query($sql1);
				}
				}				
				/***************************End**********************************/
			//$this->session->set_flashdata('success_msg', 'Accounts Details Added Successfully.');
			redirect(base_url().'AccountService');	
		}
		
		   
		else
		{
		$this->load->view('accountservice',$data);
		}
	}
	Private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $config['upload_path'] = './assets/accounts_documents/';
	$config['allowed_types'] = '*';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    return $config;
}
    public function service_list() {
         $selected = $this->input->post('selected');
         $get_details = $this->Accountservice_model->gettype($selected);
         $html ="";
         $html .= '<option val="">SELECT</option>';
         if($get_details)
		 {
	          foreach($get_details as $key => $value){
		       $Id = $value['Id'];
		       $Name = $value['Name'];
		   
		       $html .= "<option value='".$Id."'>".$Name."</option>";
		
	     }
	}

    echo $html;
}
	public function all_list() 	{	

		$postdate = $this->input->post('from_date');
		$Name = $this->input->post('Name');
		
		
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		if(isset($postdate)){
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		$where = "where `payable_date` BETWEEN '".$from_date."' AND '".$to_date."'";
		if(isset($Name) && $Name != ''){
			$where .= " AND acs.`Name` = '".$Name."' ";
		}
	
		$data['title'] = 'Daily transaction report';
		//$query = $this->db->query("select ase.*,acs.Name,acs.Type from accounts_service_entries as ase left join accounts_service as acs on acs.Id=ase.accountservice_id ".$where.' order by `id` DESC');
		$query = $this->db->query("select * from accounts_service");
		$serviceList = $query->result_array();
		
		//if(isset($serviceList['Name']) && $serviceList['Name'] != ''){
		//	$where .= " AND `id` = '".$serviceList['Name']."' ";}


		/*foreach($serviceList as $key=>$service){
			$serviceList[$key]['Name'] =$this->Accountservice_model->getname($service['Name']);
	     
		}*/

		$data['serviceList'] = $serviceList;
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		$data['Name'] =$Name;
		//$data['account_service_name'] = $this->Accountservice_model->getname();
		$data['account_service'] = $this->Accountservice_model->getlist($where);


		$this->load->view('all_list',$data);

	}
	public function account_edit($id) 	{
		$data['result'] = $this->Accountservice_model->edit($id);
		$data['upload_items'] = $this->Accountservice_model->upload_items($id);
		$data['account_service'] = $this->Accountservice_model->gettype();
		$data['bankdetails'] = $this->transaction->getAllBankList();
		$data['vat_perc'] = $this->Accountservice_model->getVatPercentage();
		//print_r ($data);die;
		$this->load->view('account_edit',$data);
	}
	public function remove_upload() 	{
		 $id =  $this->input->post('id');
		 $this->db->delete('accountserviceuploadedfiles', array('id' => $id)); 
	}
	public function edit_details()
	{	
			$id = $this->input->post('id');
			$type=$this->input->post('type');
			$paid = $this->input->post('paid_amount');
			$account_service=$this->input->post('account_service');
			$service=$this->input->post('service');
			$vat_percent=$this->input->post('vat_percentage');
			$vat_value= $this->input->post('vat_value');
			$payable_amount=$this->input->post('payable_amount');
			$description_detail = $this->input->post('description_detail');
			$payment_type = $this->input->post('payment_type');
			$bank = $this->input->post('bank');
			$cheque_number = $this->input->post('cheque_number');
			$cheque_date = $this->input->post('cheque_date');
			$payable_date=$this->input->post('payable_date');
			$created_at=date('Y-m-d H:i:s');

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
	

			if ($type == 'Expense' || $type == 'Income') {
				$service = $this->input->post('service');
				if (empty($service)) {
					$json['error']['service'] = 'Please enter service';
				}
			} 
			$sql="update accounts_service_entries set accountservice_id	='".$service."',gross_amount='".$paid."',vat_percentage='".$vat_percent."',vat_amount='".$vat_value."',payable_amount='".$payable_amount."',description_detail ='".$description_detail."',payable_date='".$payable_date."',payment_type='".$payment_type."',bank= '".$bank."',cheque_number= '".$cheque_number."',cheque_date = '".$cheque_date."',created_at='".$created_at."' where Id='".$id."'";
		    $insert=$this->db->query($sql);	
			$lastid = $id;
				/***** Upload multiple files ********/	
				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['userfile']['name']);
				$myFile = $_FILES['userfile'];
				for($i=0; $i<$cpt; $i++)
				{   
					$error = $myFile["error"][$i];
					 if ($error == '4')  // error 4 is for "no file selected"
             {
             }
            else
             {
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('userfile');
					
		$sql1="INSERT into accountserviceuploadedfiles(accountservice_id,filename) values('".$lastid."','".$files['userfile']['name'][$i]."')";
		$this->db->query($sql1);
				}
				}				
				/***************************End**********************************/
			//$this->session->set_flashdata('success_msg', 'Accounts Details Added Successfully.');
			redirect(base_url().'AccountService/all_list');	
			
	}
	public function delete($id){
		
		$this->db->delete('accounts_service_entries', array('Id' => $id)); 
		
		$this->db->delete('accountserviceuploadedfiles', array('accountservice_id' => $id)); 
		
		redirect(base_url().'AccountService/all_list');	
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
}

?>



