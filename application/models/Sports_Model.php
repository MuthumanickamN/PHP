<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Sports_Model extends CI_Model {

	public function add_sports_details($data) {
		
		$query = $this->db->insert('sports', $data);
		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	
	
	public function get_sports_details($id){
		
		$this->db->select('*');
		
		$this->db->from('sports');
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
	public function check_sports_exist($data){
		
		$this->db->select('*');
		$this->db->from('sports');
		if($data['sports_name'] != ''){
			$this->db->where('LOWER(sportsname)', strtolower($data['sports_name']));
		}
		if($data['sports_hidden_id'] != ''){
			$this->db->where('id !=', $data['sports_hidden_id'] );
		}
		
		$query = $this->db->get();
		
if($data['sports_hidden_id'] == ''){
		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
}

if($data['sports_hidden_id'] != ''){
	
	if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if($row['sportsname'] == $data['sports_name'])
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
	
	public function get_sports_details_userview($id){
		//echo $id;exit;
		//$idd=trim($id,'');
		/* $output1 = str_replace("'", "", $id);
		$output = stripslashes(trim($id)); */
		$trim_id=trim($id,"'");
		$id_array=explode(',',$trim_id);
		
		
		$this->db->select('*');
		$this->db->where_in('id',$id_array);
		
		$this->db->from('sports');
		
		
		// if($id != ''){
			// $this->db->where('id', $id );
		// }
		/* $this->db->where('transport_status !=', 2);
		$this->db->order_by('transport_id','DESC'); */
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
	
	public function get_sports_list(){
		
		$this->db->select('*');
		
		$this->db->from('sports');
		
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
	public function update_sports_details($data, $id) {
		$this->db->where('id', $id);
		$query = $this->db->update('sports', $data);
		//$query = $this->db->affected_rows();		
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_sports($id) {
		
		 $this->db->where('id', $id);
          $query=$this->db->delete('sports'); 
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