<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Login Model class
*/
Class Login_Model extends CI_Model {

	// Read data using username and password
	public function login($data,$role) {

		//$condition = "userid =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "' ";
                $condition = "user_email =" . "'" . $data['email'] . "' ";
                if($role == 'admin'){
                    $condition .= " AND role_id = '1' ";
                }else{
                   $condition .= " AND role_id != '1' "; 
                }
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
//echo $this->db->last_query();exit;
		if($query->num_rows() == 1) {
                    //return true;					
                    return $query->result();
		} else {
                    return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($post_data) {

		$condition = "userid =" . "'" . $post_data['username'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
        
        // Read data from database to show data in admin page
	public function get_user_details($id) {

		$condition = "id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
        
        public function delete_reset_login_details($id) {
            $this->db->where('user_id', $id);
            $this->db->delete('reset_password');
	}

}

?>