<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Prepaid_credits_Model extends CI_Model {

	
        public function add_recharge_details($data,$id,$amount) {
			
			
			$pre_amount = $this->get_amount($id);
		
			
			$amt = $pre_amount['amount'] + $amount;
			
			$update_data = array(
            'amount' => $amt
			);
		
		$query = $this->db->insert('recharge', $data);
		if ($query) {
			
					$this->db->where('custid', $id);
					$query1 = $this->db->update('wallet', $update_data);
					if ($query1) {
					return true;
					}
					else{
						return false;
					}
		} 
		else {
			return false;
		}
	}
	
	public function get_credit_member_list(){
		
		$this->db->select('*');
		$this->db->from('customer as cus');
		
		$this->db->join('wallet as wl', 'cus.id = wl.custid', 'left');
		//$this->db->join('customer as cus', 'cus.id = wl.custid', 'left');
		
		//$this->db->order_by('id','ASC');
		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
	
	
	public function get_recharge_history($data){
		/* $date_from = $data['from_date'].' 00:00:00';
		$date_to = $data['to_date'].' 23:59:59';
		
		$cash_total = "(select sum(amount_paid)  from recharge where payment_type = 1 AND date between '$date_from' and '$date_to')";
		$card_total = "(select sum(amount_paid)  from recharge where payment_type = 2 AND date between '$date_from' and '$date_to')";
		$online_total = "(select sum(amount_paid)  from recharge where payment_type = 3 AND date between '$date_from' and '$date_to')"; */
		
		$this->db->select("rec.*,cus.name,cus.mobile");
		$this->db->from("recharge as rec");
		
		if($data['from_date'] !=''){
                    $this->db->where('rec.date >=', $data['from_date'].' 00:00:00');
		}
		if($data['to_date'] !=''){
                    $this->db->where('rec.date <=', $data['to_date'].' 23:59:59');
		}

		
		$this->db->join('customer as cus', 'cus.id = rec.customer_id', 'left');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
	
	public function get_recharge_history_total($data){
		
		
		$date_from = $data['from_date'].' 00:00:00';
		$date_to = $data['to_date'].' 23:59:59';
		
		$cash_total = "(select DISTINCT sum(amount_paid)  from recharge where payment_type = 1 AND date between '$date_from' and '$date_to')";
		$card_total = "(select DISTINCT sum(amount_paid)  from recharge where payment_type = 2 AND date between '$date_from' and '$date_to')";
		$online_total = "(select DISTINCT sum(amount_paid)  from recharge where payment_type = 3 AND date between '$date_from' and '$date_to')";
		
		$this->db->select("$cash_total as cash_total,$card_total as card_total,$online_total as online_total");
		$this->db->from("recharge as rec");
		
		/* if($data['from_date'] !=''){
                  
					 $this->db->where('rec.date >=', $data['from_date'].' 00:00:00');
		}
		if($data['to_date'] !=''){
                    $this->db->where('rec.date <=', $data['to_date'].' 23:59:59');
		} */
		$this->db->where("rec.date between '$date_from' and '$date_to'");

		
		//$this->db->join('customer as cus', 'cus.id = rec.customer_id', 'left');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ( $query->num_rows() > 0 )
		{
		$row = $query->row_array();
		return $row;
		}else{
			return false;
		}
		
		
		
	}
	
	public function check_mobile_exist($data){
		
		$this->db->select('*');
		$this->db->from('customer');
		if($data['customer_mobile'] != ''){
			$this->db->where('mobile', $data['customer_mobile'] );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
	}
	
	
       	public function get_customer_mobile($customer_mobile){
		$this->db->select('mobile');
		
		$this->db->from('customer');
		$this->db->like('mobile', $customer_mobile);
		
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
	
		public function get_customer_email($customer_email){
		$this->db->select('email');
		
		$this->db->from('customer');
		$this->db->like('email', $customer_email);
		
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
		public function get_amount($id){
		$this->db->select('amount');
		
		$this->db->from('wallet');
		$this->db->where('custid', $id);
		
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
		$row = $query->row_array();
		return $row;
		}else{
			return false;
		}
	}
	
	
		public function get_customer_details($customer_email){
		$this->db->select('*');
                //$this->db->select("ct.*,wal.amount");
		$this->db->from('customer as ct');
		//$this->db->where('ct.mobile',$customer_mobile);
		//$new_mobile = str_replace(' ','+',$customer_mobile);
		
        $this->db->where('ct.email',$customer_email);
		
		
		$this->db->join('wallet as wal', 'ct.id = wal.custid', 'left');
	
		$this->db->order_by('ct.id','DESC');
		
		$query = $this->db->get();
		

		if ( $query->num_rows() > 0 )
		{
		$row = $query->row_array();
		return $row;
		}else{
			return false;
		}
	}
	
	public function search_email_check($search_value){
		
		
		$this->db->select("*");
		$this->db->from("customer");
		$this->db->where('email',$search_value);
		
		$query = $this->db->get(); 
		//echo $this->db->last_query();exit;
		
		if ( $query->num_rows() > 0 )
			{
			$row = $query->row_array();
			return $row;
			}else{
				return false;
			}



	}
	
	

}

?>