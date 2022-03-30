<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prepaid_credits_booking extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');

       if(!$this->session->userdata('id')){
            redirect('logout');
        }
		$this->load->model('Prepaid_credits_Model', 'prepaid_credits_model');
    }

	
    public function index(){
		  $this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('prepaid_credits_booking');
       // $this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	
	public function get_customer_mobile(){
        $customer_mobile = ($this->input->post('customer_mobile') !='') ? $this->input->post('customer_mobile') : '';
        $get_details = $this->prepaid_credits_model->get_customer_mobile($customer_mobile);
        echo json_encode($get_details);
    }
	
	
	public function get_customer_email(){
        $customer_email = ($this->input->post('customer_email') !='') ? $this->input->post('customer_email') : '';
        $get_details = $this->prepaid_credits_model->get_customer_email($customer_email);
        echo json_encode($get_details);
    }
	
	
	public function get_customer_details(){
		
        $customer_email = ($this->input->post('email_id') !='') ? $this->input->post('email_id') : '';
        $get_details = $this->prepaid_credits_model->get_customer_details($customer_email);
        echo json_encode($get_details);
    }
	
	/*  public function toExcel()
  {
    $this->load->view('spreadsheet_view');
	
	
  } */
	
	public function recharge_process(){
	
	if($this->input->post('cus_hid') !== ''){
		
		$date = date('Y-m-d');
		$id = $this->input->post('cus_hid');
		$amount = $this->input->post('amount_paid');
            $insert_data = array(
                'customer_id' => $this->input->post('cus_hid'),
                'balance_credits' => $this->input->post('balance_credits'),
                'amount_paid ' => $this->input->post('amount_paid'),
               // 'payment_type' => $this->input->post('type'),
			    'payment_type' => 0,
                             'date' => $date
				//'date' => change_date_format($this->input->post('datepicker2'))		
            );
            if($this->prepaid_credits_model->add_recharge_details($insert_data,$id,$amount))
            {	
                $this->session->set_flashdata('success_message', 'Recharge Details added successfully!');
                redirect('prepaid_credits_booking');
            }else{
                $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
                redirect('prepaid_credits_booking');
            }
        }
	
    
	}
    
    public function get_credit_member_list(){
        $data = array();
        //$data['court_name'] = ($this->input->post('court_name') !='') ? $this->input->post('court_name') : '';
        $get_details = $this->prepaid_credits_model->get_credit_member_list();
		//print_r($get_details);exit;
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {
                    
                    $output .= "<tr>";
                    $output .= "<td>". ++$key ."</td>";
                    $output .= "<td>". ucfirst($get_list['name']) ."</td>";
				    $output .= "<td>". ucfirst($get_list['mobile']) ."</td>";
					$output .= "<td>". ucfirst($get_list['amount']) ."</td>";
					//$output .= "<td>nil</td>";
					
				
                    $output .= "</tr>";
                   // href='".base_url()."admin/user_management/edit_user/".$get_list['id']."' data-toggle='modal' data-toggle='tooltip'
                }
        }
        
        echo $output;
    }
	
	
	 public function check_mobile_exist(){
        $data = array();
        $data['customer_mobile'] = $this->input->post('customer_mobile');
        $get_details = $this->prepaid_credits_model->check_mobile_exist($data);
        //header("Content-type: application/json");		
        echo json_encode($get_details);
        //echo $this->db->last_query();
		
    }
	
	public function get_recharge_history(){
        $data = array();
        //$data['court_name'] = ($this->input->post('court_name') !='') ? $this->input->post('court_name') : '';
		 $data['from_date'] = ($this->input->post('from_date') !='')? change_date_format($this->input->post('from_date')) : '';
	$data['to_date'] = ($this->input->post('to_date') !='')? change_date_format($this->input->post('to_date')) : '';
        $get_details = $this->prepaid_credits_model->get_recharge_history($data);
		//print_r($get_details);exit;
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {
                    $newDate = date("d-m-Y", strtotime(ucfirst($get_list['date'])));
                    $output .= "<tr>";
                    $output .= "<td>". ++$key ."</td>";
                    $output .= "<td>". $newDate ."</td>";
				    $output .= "<td>". ucfirst($get_list['amount_paid']) ."</td>";
					$output .= "<td>". ucfirst($get_list['balance_credits']) ."</td>";
					
					$output .= "<td>". ucfirst($get_list['name']) ."</td>";
					$output .= "<td>". ucfirst($get_list['mobile']) ."</td>";
					
					/* $payment_mode = ucfirst($get_list['payment_type']);
					switch($payment_mode)
					{
						case "1":
						$mode = "cash";
						break;
						case "2":
						$mode = "card";
						break;
						case "3":
						$mode = "online";
						break;
						
					}
					$output .= "<td>". $mode ."</td>"; */
					  
					//$output .= "<td>nil</td>";
					
				
                    $output .= "</tr>";
                   // href='".base_url()."admin/user_management/edit_user/".$get_list['id']."' data-toggle='modal' data-toggle='tooltip'
                }
        }
        
        echo $output;
    }
	
	public function get_recharge_history_total(){
		 $data = array();
		
	$data['from_date'] = ($this->input->post('from_date') !='')? change_date_format($this->input->post('from_date')) : '';
	$data['to_date'] = ($this->input->post('to_date') !='')? change_date_format($this->input->post('to_date')) : '';
		
		 $get_details = $this->prepaid_credits_model->get_recharge_history_total($data);
		 
		  echo json_encode($get_details);
		
		
		
	}
	
	
	public function search_email_check(){
		
		$search_value = ($this->input->post('email') != '') ? $this->input->post('email'):"";
		
		$get_details = $this->prepaid_credits_model->search_email_check($search_value);
		echo json_encode($get_details);
	}
	
	
	
	
}

?>