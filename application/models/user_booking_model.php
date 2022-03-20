<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class User_Model extends CI_Model {

	public function add_user_details($data) {
		
		$query = $this->db->insert('user', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_user_email($data, $id) {
		
		$this->db->where('id', $id);
		$query = $this->db->update('user', $data);
		
		//$query = $this->db->affected_rows();		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	public function update_user_password($data, $id) {
		
		$this->db->where('id', $id);
		$query = $this->db->update('user', $data);
		
		//$query = $this->db->affected_rows();		
		if ($query) {
			return true;
			
		} else {
			return false;
			
		}
	}
	
	
	public function get_user_list($data){
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role', 'user.role_id = user_role.role_id', 'left'); 
                if($data['role_id'] != ''){
                    $this->db->where('user.role_id', $data['role_id'] );
		}
		//$this->db->where('status !=', 2);
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
        
        public function get_user_roles(){
		
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->where('role_status !=', 2);
		$this->db->order_by('role_name','ASC');
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
	}
	
	public function get_user_details($id){
		
		$this->db->select('*');
		$this->db->from('user');
		//$this->db->join('user_role', 'user.role_id = user_role.role_id', 'left'); 
		if($id != ''){
                    $this->db->where('id', $id );
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
	
    public function check_user_exist($data){

        $this->db->select('*');
        $this->db->from('user');
        if($data['user_email'] != ''){
                $this->db->where('user_email', $data['user_email'] );
        }
        if($data['userid'] != ''){
                $this->db->where('userid', $data['userid'] );
        }
        if($data['id'] != ''){
                $this->db->where('id !=', $data['id'] );
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
    
    public function check_employee_code_exist($data){

        $this->db->select('*');
        $this->db->from('user');
        if($data['employee_code'] != ''){
                $this->db->where('user_employee_code', $data['employee_code'] );
        }
        if($data['id'] != ''){
                $this->db->where('id !=', $data['id'] );
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
    
    public function get_email_users($data){
		
		$this->db->select('*');
		$this->db->from('user');
		//$this->db->join('user_role', 'user.role_id = user_role.role_id', 'left'); 
                if($data['user_email'] != ''){
                    $this->db->where('user_email', $data['user_email'] );
		}
                $this->db->where('role_id', 1);
		//$this->db->where('status !=', 2);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
                    $row = $query->row();
                    return $row;
		}else{
			return false;
		}
	}
        
        public function add_reset_login_details($data) {
		
		$query = $this->db->insert('reset_password', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
        
        public function check_email_exist($id){

        $this->db->select('*');
        $this->db->from('reset_password');
        if($id != ''){
                $this->db->where('user_id', $id );
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