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
			$user_id = $this->session->userdata('id');
			$userrole = strtolower($this->session->userdata('role'));


			$from_date = ($_POST['from_date'])?$_POST['from_date'] : "";
			$to_date = ($_POST['to_date'])?$_POST['to_date'] : "";
			$from_date1 = ($from_date != "") ? $this->change_date_format($from_date): "";
			$to_date1 = ($to_date != "") ? $this->change_date_format($to_date): "";
		
			
			//$query  = "select rec.*,res.wallet_transaction_date as date, cus.parent_name as user_name,cus.mobile_no as mobile from wallet_transaction as rec LEFT JOIN parent as cus ON cus.parent_id = rec.parent_id where rec.wallet_transaction_details='Prepaid credits'";

			$query = "select rec.wallet_transaction_date as date, rec.wallet_transaction_amount , pt.parent_name, pt.mobile_no as mobile from wallet_transactions as rec left join  parent as pt on pt.parent_id = rec.parent_id where rec.wallet_transaction_detail = 'Prepaid credits' ";
			
			if($to_date1 !== "" && $from_date1 !== "")
			{
				if($userrole=='parent')
				{
					$query1 = $this->db->query("SELECT parent_id FROM `parent` p
					left join users u on u.code = p.parent_code
					where u.user_id=$user_id");
					$parent_id = $query1->row()->parent_id;

				$query  .=" and  rec.wallet_transaction_date >= '$from_date1' and rec.wallet_transaction_date <= '$to_date1' and pt.parent_id='".$parent_id."' "; 
				}
				else
				{
					$query  .=" and  rec.wallet_transaction_date >= '$from_date1' and rec.wallet_transaction_date <= '$to_date1'";
				}
			}
			//and cus.parent_id='".$customer_id."'

			/*if($data['from_date'] !=''){
				$this->db->where('rec.wallet_transaction_date >=', $data['from_date']);
			}
			if($data['to_date'] !=''){
				$this->db->where('rec.wallet_transaction_date <=', $data['to_date']);
			}*/

			//echo $query;die;
			
			$sql_query = $this->db->query($query);				
			
			if($sql_query->num_rows() > 0)
			{
				
				$result_array =  $sql_query->result_array();
				//print_r($result_array);die;
				//echo $this->db->last_query();die;
				foreach($result_array as $row)
				{
					$newDate = date("d-m-Y", strtotime(ucfirst($row['date'])));
					$output .= "<tr>";
					$output .= "<td>". ++$key ."</td>";
					$output .= "<td>". $newDate ."</td>";
					$output .= "<td>". ucfirst($row['wallet_transaction_amount']) ."</td>";
					//$output .= "<td>". ucfirst($row['balance_credits']) ."</td>";

					$output .= "<td>". ucfirst($row['parent_name']) ."</td>";
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