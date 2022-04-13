<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Recharge_history extends CI_Controller {  
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_slot_model');
		//$this->load->model('Booking_reports_model');
	}
	public function index()
	{
		//$this->load->view('includes/booking_header');
		//$user_id = $_SESSION['id'];
		$user_id = $this->session->userdata('id');
		$data['getWalletAmount'] = $this->Booking_slot_model->getWalletAmount($user_id);
		$this->load->view('includes/header3',$data);
		$this->load->view('recharge_history_view',$data);
	}
	
	public function ajax_recharge_history()
	{
		$postdata = $this->input->post();
		
		if($postdata)
		{
			//$customer_id = $_SESSION['id'];
			$customer_id = $this->session->userdata('id');

			$from_date = ($_POST['from_date'])?$_POST['from_date'] : "";
			$to_date = ($_POST['to_date'])?$_POST['to_date'] : "";
			$from_date1 = ($from_date != "") ? $this->change_date_format($from_date): "";
			$to_date1 = ($to_date != "") ? $this->change_date_format($to_date): "";
			
			
			$query  = "select rec.*,res.wallet_transaction_date as date, cus.parent_name as user_name,cus.mobile_no as mobile from wallet_transaction as rec LEFT JOIN parent as cus ON cus.parent_id = rec.parent_id where rec.wallet_transaction_details='Prepaid credits'";
			
			if($to_date1 !== "" && $from_date1 !== "")
			{
				
				$query  .=" where rec.wallet_transaction_date >= '$from_date1' and rec.wallet_transaction_date <= '$to_date1'  and cus.parent_id='".$customer_id."'"; 
			
			}
			
			
			$sql_query = $this->db->query($query);				
			
			if($sql_query->num_rows()> 0)
			{
				
				$result_array =  $sql_query->result_array();
				
				foreach($result_array as $row)
				{
					$newDate = date("d-m-Y", strtotime(ucfirst($row['date'])));
					$output .= "<tr>";
					$output .= "<td>". ++$key ."</td>";
					$output .= "<td>". $newDate ."</td>";
					$output .= "<td>". ucfirst($row['wallet_transaction_amount']) ."</td>";
					//$output .= "<td>". ucfirst($row['balance_credits']) ."</td>";

					$output .= "<td>". ucfirst($row['name']) ."</td>";
					$output .= "<td>". ucfirst($row['mobile']) ."</td>";
					$output .= "</tr>";
				}
				echo $output;
			}		
		}
	}
	public function change_date_format($origal_date){
		$newDate = date("Y-m-d", strtotime($origal_date));
		return $newDate;
	}
}