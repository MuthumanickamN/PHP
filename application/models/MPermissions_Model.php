<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MPermissions_Model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	public function get_mpermission(){
        $query = $this->db->get("module_permission");
        return $query->result();
    }

	public function insert_mpermission()
    {    
        $data = array(
            'module_name' => $this->input->post('module_name'),
            'module_group' => $this->input->post('module_group'),
            'superadmin' => $this->input->post('superadmin'),
            'admin' => $this->input->post('admin'),
            'headcoach' => $this->input->post('headcoach'),
            'coach' => $this->input->post('coach'),
            'gender' => $this->input->post('Parent'),
        );
        return $this->db->insert('module_permission', $data);
    }

    public function get_menu_by_module($role=''){
        $role = (!empty($role)) ? $role : strtolower($this->session->userdata['role']); 
        $this->db->where($role, 1);  
        $query = $this->db->get('module_permission');  
        //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
        if($query->num_rows() > 0)  
        {  
             return $query->result('array');  
        }  
        else  
        {  
             return false;       
        }  

    }

}
