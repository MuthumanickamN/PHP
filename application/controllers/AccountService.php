<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class AccountService extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
	$this->load->model('Accountservice_model');
	$this->load->library('upload');
	}
    public function index(){
	
		$data['title'] = 'AccountService';
		$data['account_service'] = $this->Accountservice_model->gettype();
		$data['vat_perc'] = $this->Accountservice_model->getVatPercentage();
		$data['vat_value']=$this->Accountservice_model->getVatPercentage();
		if($this->input->post('submit')){
			$type=$this->input->post('type');
			$paid = $this->input->post('paid_amount');
			$account_service=$this->input->post('account_service');
			$service=$this->input->post('service');
			$vat_percent=$this->input->post('vat_percentage');
			$vat_value= $this->input->post('vat_value');
			$payable_amount=$this->input->post('payable_amount');
			$payable_date=$this->input->post('payable_date');
			$created_at=date('Y-m-d H:i:s');
			if ($type == 'Expense' || $type == 'Income') {
				$service = $this->input->post('service');
				if (empty($service)) {
					$json['error']['service'] = 'Please enter service';
				}
			} 
			$sql="INSERT into accounts_service_entries(accountservice_id	,gross_amount,vat_percentage,vat_amount,payable_amount,payable_date,created_at)values('".$service."','".$paid."','".$vat_percent."','".$vat_value."','".$payable_amount."','".$payable_date."','".$created_at."')";
		    $insert=$this->db->query($sql);	
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
			redirect(base_url().'accountservice');	
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
		$data['account_service'] = $this->Accountservice_model->getlist();
		$this->load->view('all_list',$data);
	}
	public function account_edit($id) 	{
		$data['result'] = $this->Accountservice_model->edit($id);
		$data['upload_items'] = $this->Accountservice_model->upload_items($id);
		$data['account_service'] = $this->Accountservice_model->gettype();
		
		$this->load->view('account_edit',$data);
	}
	public function remove_upload() 	{
		 $id =  $this->input->post('id');
		 $this->db->delete('accountserviceuploadedfiles', array('id' => $id)); 
	}
}

?>



