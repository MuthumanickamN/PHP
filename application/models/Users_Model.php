<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_Model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	public function get_users(){
        if(!empty($this->input->get("search"))){
          $this->db->like('title', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search")); 
        }
        $query = $this->db->get("users");
        return $query->result();
    }

	public function insert_users()
    {    
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'email' => $this->input->post('email'),
            'encrypted_password' => $this->input->post('password'),
            'mobile' => $this->input->post('mobile'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'status' => $this->input->post('status'),
            'gender' => $this->input->post('gender'),
            'role' => $this->input->post('role'),
        );
        return $this->db->insert('users', $data);
    }

}
