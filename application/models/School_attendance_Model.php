<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_attendance_Model extends CI_Model {
	public function getAllBookingList(){
		$this->db->select('*');
        $this->db->from('school_attendances');  
        $query = $this->db->get();
       	return $query->result_array();
	}
            
}