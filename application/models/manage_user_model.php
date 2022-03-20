<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class manage_user_model extends CI_Model {

	public function add_user_details($data) {
		
		$query = $this->db->insert('customer', $data);
		$insert_id = $this->db->insert_id();

  // echo $this->db->last_query();exit;
		
		if ($query) {
			//return true;
			return  $insert_id;
			
		} else {
			return false;
			
			
		}
	}
	public function add_wallet_details($insert_id) {
		
		 $data = array(
			    'custid' => $insert_id,
                'amount' => 0
			);
		
		$query = $this->db->insert('wallet', $data);
		
		if ($query) {
			return true;
			
			
		} else {
			return false;
			
			
		}
	}
	
	
	public function get_user_details($id){
		
		$this->db->select('*');
		
		$this->db->from('customer');
		if($id != ''){
			$this->db->where('id', $id );
		}
		/* $this->db->where('transport_status !=', 2);
		$this->db->order_by('transport_id','DESC'); */
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
		$row = $query->row_array();
		return $row;
		}else{
			return false;
		}
	}
	
	public function get_user_list(){
		
		$this->db->select('*');
		
		$this->db->from('customer');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
	public function get_user_list_view($id){
		
		if($id != ''){
			$this->db->where('id', $id );
		}
		
		$this->db->select('*');
		
		$this->db->from('customer');
		//$this->db->order_by('id','DESC');
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
		$row = $query->row_array();
		return $row;
		}else{
			return false;
		}
	}
	
	
	
	public function update_user_details($data, $id) {
		$this->db->where('id', $id);
		$query = $this->db->update('customer', $data);
		//$query = $this->db->affected_rows();		
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_user($id) {
		
		 $this->db->where('id', $id);
          $query=$this->db->delete('customer'); 
		
		if ($query) {
			
			$this->db->where('custid', $id);
          $query1=$this->db->delete('wallet');
			
			if ($query1) {
						   
						   $this->db->where('customerid', $id);
                           $query2=$this->db->delete('booking');
			               
						  if ($query2) { 
						   return true;
						  }
			
						  
			}
			
		} else {
			return false;
			
		}
	}
	
	public function check_mobile_exist($data){
		
		$this->db->select('*');
		$this->db->from('customer');
		
		if($data['mobile_number'] != ''){
			//$mobile_number = str_replace(' ','+',$data['mobile_number']);
			$this->db->where('mobile', $data['mobile_number'] );
		}
		if($data['user_hidden_id'] != ''){
			$this->db->where('id !=', $data['user_hidden_id'] );
		}
		//$this->db->where('status !=', 2);
		$query = $this->db->get();

		if($data['user_hidden_id'] == ''){
		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
}

if($data['user_hidden_id'] != ''){
	
	if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if($row['mobile'] == $data['mobile_number'])
			{
				return $row;
			}
			else{
				return false;
			}
			
		}else{
			return false;
		}
}
	}
	
	public function check_email_exist($data){
		
		$this->db->select('*');
		$this->db->from('customer');
		if($data['user_email'] != ''){
			$this->db->where('email', $data['user_email'] );
		}
		if($data['user_hidden_id'] != ''){
			$this->db->where('id !=', $data['user_hidden_id'] );
		}
		//$this->db->where('status !=', 2);
		$query = $this->db->get();
		
		if($data['user_hidden_id'] == ''){
		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
}

if($data['user_hidden_id'] != ''){
	
	if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if($row['email'] == $data['user_email'])
			{
				return $row;
			}
			else{
				return false;
			}
			
		}else{
			return false;
		}
}

		
	}
	
	
	
	   

}

?>