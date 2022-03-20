<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Court_Model extends CI_Model {

	public function add_court_details($data) {
		//print_r($data);exit;
		$query = $this->db->insert('court', $data);
		//echo $this->db->last_query();exit;
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_court_details($data, $id) {
		$this->db->where('id', $id);
		$query = $this->db->update('court', $data);
		//echo $this->db->last_query();exit;
		//$query = $this->db->affected_rows();		
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function check_court_exist($data){
		
		$this->db->select('*');
		$this->db->from('court');
		
		if($data['location_id'] != ''){
			     $this->db->where('lid', $data['location_id'] );
		}
		if($data['court_name'] != '')
		{
			$this->db->where('LOWER(courtname)', strtolower($data['court_name']));
			 //$this->db->where('courtname', $data['court_name'] );
			
			
		}
		if($data['sports_id'] != ''){
			     $this->db->where('sid', $data['sports_id'] );
		}

		if($data['hid_id'] != ''){
			$this->db->where('id !=', $data['hid_id'] );
		}

		$query = $this->db->get();
		
		if($data['hid_id'] == ''){
		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}else{
			return false;
		}
   }

   if($data['hid_id'] != ''){
	
	if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if(strtolower($row['courtname']) == strtolower($data['court_name']))
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
	public function delete_court($id) {
		
		 $this->db->where('id', $id);
          $query=$this->db->delete('court'); 
		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	public function get_sports_list(){
		
		$this->db->select('*');
		
		$this->db->from('sports');
		$this->db->where('status','1');
		
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
	
	public function get_court_list(){
		
		$this->db->select('loc.location,spo.sportsname, ct.*');
		
		$this->db->from('court as ct');
		$this->db->join('location_booking as loc', 'ct.lid = loc.id', 'left');
		$this->db->join('sports as spo', 'ct.sid = spo.id', 'left');
	//	$this->db->join('sports as sp', 'ct.sid = sp.id', 'left');
                /* if($data['id'] != ''){
                    $this->db->where('ct.id', $data['id'] );
		} */
		//$this->db->where('status !=', 2);
		$this->db->order_by('ct.id','DESC');
		
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
        
        public function get_locationlist(){
		
		$this->db->select('*');
		$this->db->from('location_booking');
		$this->db->where('status','1');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
        
       	public function get_court_details($id){
		
		//$this->db->select('loc.location, ct.sid, ct.lid, ct.courtname, ct.id');
		$this->db->select('loc.location, ct.*,sp.*');
		
		$this->db->from('court as ct');
		$this->db->join('location_booking as loc', 'ct.lid = loc.id', 'left');
		$this->db->join('sports as sp', 'ct.sid = sp.id', 'left');
                if($id != ''){
                    $this->db->where('ct.id', $id );
		}
		//$this->db->where('status !=', 2);
		$query = $this->db->get();

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