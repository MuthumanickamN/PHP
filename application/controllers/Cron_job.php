<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }
	}
    
    public function clear_cart(){
		
		$current_time = time();
		$date = new DateTime(date('Y-m-d'));
		$sql="select * from tmp_booking_court";
		

		$sql="select * from tmp_booking group by parent_id";
		foreach($this->db->query($sql)->result_array() as $key => $value2)
		{
			
			$parent_id = $value2['parent_id'];
			$sql2="select * from tmp_booking where parent_id=$parent_id order by created_at desc limit 1";
			foreach($this->db->query($sql2)->result_array() as $key => $value)
			{
				
				$id = $value['id'];
				$created_at = $value['created_at'];
				if(strtotime($created_at)+300 < $current_time)
				{
					$sql2="Delete from tmp_booking where parent_id='$parent_id'";
					$this->db->query($sql2);
				}
				$checkout_date = $value['checkout_date'];
				
			}
		}
        
        
        /*$sql2="select * from tmp_booking";
		foreach($this->db->query($sql2)->result_array() as $key => $value)
		{
			
			$id = $value['id'];
			$created_at = $value['created_at'];
			
			$checkout_date = $value['checkout_date'];
			if($checkout_date < $date)
			{
				$sql1="Delete from tmp_booking where id='$id'";
				$this->db->query($sql1);	
			}
		}*/
		
		$sql2="select * from tmp_booking_court";
		foreach($this->db->query($sql2)->result_array() as $key => $value)
		{
			
			$id = $value['id'];
			$created_at = $value['created_at'];
			
			$checkout_date = $value['checkout_date'];
			if($checkout_date < $date)
			{
				$sql1="Delete from tmp_booking_court where id='$id'";
				$this->db->query($sql1);	
			}
		}
			
		$sql="select * from tmp_booking_court group by parent_id";
		foreach($this->db->query($sql)->result_array() as $key => $value2)
		{
			
			$parent_id = $value2['parent_id'];
			$sql2="select * from tmp_booking_court where parent_id=$parent_id order by created_at desc limit 1";
			foreach($this->db->query($sql2)->result_array() as $key => $value)
			{
				
				$id = $value['id'];
				$created_at = $value['created_at'];
				if(strtotime($created_at)+300 < $current_time)
				{
					$sql2="Delete from tmp_booking_court where id='$id'";
					$this->db->query($sql2);
				}
				
			}
		}
		
	}
	public function check_contract()
	{
		$month = date('M Y');
		$today = new DateTime(date('Y-m-d'));
		$activity_selection_id = $this->input->post['activity_selection_id'];
		
		$sql="SELECT id,activity_selection_id,contract_from_date,contract_to_date,last_contract_amount_paid_month_year FROM `contract_details` where id = '$activity_selection_id' ";
		foreach($this->db->query($sql)->result_array() as $key => $value)
		{  
			$id = $value['id'];
			$activity_selection_id = $value['activity_selection_id'];
			$lastyear = $value['last_contract_amount_paid_month_year'];
			$from_date = $value['contract_from_date'];
			$to_date = $value['contract_to_date'];

			if($from_date > $today) 
			{
			//	$sql1="Update contract_details as cd  join activity_selections as acs on cd.id = acs.id set cd.active_contract = 0  where cd.id = '$id' ";
			   
			    $sql1="Update contract_details set active_contract = 0 where id = '$id' ";
				$this->db->query($sql1);
				$sql2="Update activity_selections set contract = 'No' where id = '$activity_selection_id' ";
				$this->db->query($sql2);
			}
			if ($to_date < $today) 
			{
				$sql1="Update contract_details set active_contract = 0, status = 0 where id = '$id' ";
				$this->db->query($sql1);
				$sql2="Update activity_selections set contract = 'No' where id = '$activity_selection_id' ";
				$this->db->query($sql2);
			}
			if((($from_date <= $today) && ($to_date >= $today)) && ($lastyear == NULL || $lastyear == $month))
			{
				
				$sql1="Update contract_details set active_contract = 1 where id = '$id' ";
				$this->db->query($sql1);
				$sql2="Update activity_selections set contract = 'Yes' where id = '$activity_selection_id' ";
				$this->db->query($sql2);

			}
			if((($from_date <= $today) && ($to_date >= $today)) && ($lastyear != $month))
			{
				$sql1="Update contract_details set active_contract = 0 where id = '$id' ";
				$this->db->query($sql1);
				$sql2="Update activity_selections set contract = 'Yes' where id = '$activity_selection_id' ";
				$this->db->query($sql2);
			}
		}
	}

	
}
?>