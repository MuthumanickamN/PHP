<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Holidays_Model extends CI_Model {

	public function add_holidays_details($data) {
		
		
		$query = $this->db->insert('holidays', $data);
		
		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	
	
	
	
	public function get_holidays_list(){
		
		$this->db->select('*');
		
		$this->db->from('holidays');
		
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
	
	public function delete_holidays($id) {
		
		 $this->db->where('id', $id);
          $query=$this->db->delete('holidays'); 
		/* $query = $this->db->affected_rows();		
		if ($query) {
			return true;
		} else {
			return false;
		} */
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	   

}

?>