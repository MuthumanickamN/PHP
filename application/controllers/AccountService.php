<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class AccountService extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
	$this->load->model('Accountservice_model');
	}
    public function index(){
	
		$data['title'] = 'AccountService';
		$data['account_service'] = $this->Accountservice_model->gettype();
		$data['vat_perc'] = $this->Accountservice_model->getVatPercentage();
		$data['vat_value']=$this->Accountservice_model->getVatPercentage();
		if($this->input->post('submit')){
			$type=$this->input->post('type');
			$account_service=$this->input->post('account_service');
			$service=$this->input->post('service');
			$vat_percent=$this->input->post('vat_percentage');
			$vat_value=$this->input->post('vat_value');
			$payable_amount=$this->input->post('payable_amount');
			$payable_date=$this->input->post('payable_date');
			$created_at=date('Y-m-d H:i:s');
			if ($type == 'Expense' || $type == 'Income') {
				$service = $this->input->post('service');
				if (empty($service)) {
					$json['error']['service'] = 'Please enter service';
				}
			} 
			$sql="INSERT into accounts_service_entries(vat_percentage,vat_amount,payable_amount,payable_date,created_at) values('".$vat_percent."','".$vat_value."','".$payable_amount."','".$payable_date."','".$created_at."')";
		    $insert=$this->db->query($sql);	
		}
		
		   
		else
		{
		$this->load->view('accountservice',$data);
		}
	}		
    public function service_list() {
         $selected = $this->input->post('selected');
         $get_details = $this->Accountservice_model->gettype($selected);
         $html ="";
         $html .= '<option val="">SELECT</option>';
         if($get_details){
	          foreach($get_details as $key => $value){
		       $Id = $value['Id'];
		       $Name = $value['Name'];
		   
		       $html .= "<option value='".$Id."'>".$Name."</option>";
		
	    }
	}

    echo $html;
}

		
}?>



