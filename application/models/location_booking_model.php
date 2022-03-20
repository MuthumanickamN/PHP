<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class location_booking_model extends CI_Model {

	public function add_location_details($data) {
		
		$query = $this->db->insert('location_booking', $data);
		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	
	
	public function check_location_exist($data){
		
		$this->db->select('*');
		$this->db->from('location_booking');
		if($data['location_name'] != ''){
			$this->db->where('LOWER(location)', strtolower($data['location_name']));
		}
		if($data['location_hidden_id'] != ''){
			$this->db->where('id !=', $data['location_hidden_id'] );
		}
		
		$query = $this->db->get();
		
if($data['location_hidden_id'] == ''){
		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
}

if($data['location_hidden_id'] != ''){
	
	if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if($row['location'] == $data['location_name'])
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
	public function get_location_details($id){
		
		$this->db->select('*');
		
		$this->db->from('location_booking');
		if($id != ''){
			$this->db->where('id', $id );
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
	
	public function get_location_list(){
		
		$this->db->select('*');
		
		$this->db->from('location_booking');
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
	public function update_location_details($data, $id) {
		$this->db->where('id', $id);
		$query = $this->db->update('location_booking', $data);	
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_location($id) {
		
		 $this->db->where('id', $id);
          $query=$this->db->delete('location_booking'); 
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	   

}

?>