<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User_model extends CI_Model {
    private $_userID;
    private $_name;   
    private $_code;   
    private $_email;
    private $_role;
    private $_mobile;
    private $_status;
    private $_encryptedpassword;
    private $_gender;
    private $_dateofbirth;

    public function setUserID($user_id) {
        $this->_userID = $user_id;
    }
    public function setName($name) {
        $this->_name = $name;
    }
    public function setCode($code) {
        $this->_code = $code;
    }
    public function setEmail($email) {
        $this->_email = $email;
    }
    public function setRole($role) {
        $this->_role = $role;
    }
    public function setStatus($status) {
        $this->_status = $status;
    }
    public function setMobile($mobile) {
        $this->_mobile = $mobile;
    }    
    public function setEncryptedPassword($encryptedpassword) {
        $this->_encryptedpassword = $encryptedpassword;
    }
    public function setGender($gender) {
        $this->_gender = $gender;
    }
    public function setDateOfBirth($dateofbirth) {
        $this->_dateofbirth = $dateofbirth;
    }
    var $table = 'users';
    var $column_order = array('s.user_id',null, 's.user_name','s.email','s.role','s.status','s.mobile','s.current_sign_in_at','s.sign_in_count','s.last_sign_in_at',null);
    var $column_search = array('s.user_name','s.email','s.mobile','s.role');
    var $order = array('user_id' => 'DESC');

    private function getQuery(){        
        if(!empty($this->input->post('name'))){
            $this->db->like('s.user_name', $this->input->post('name'), 'both');
        }     
        if(!empty($this->input->post('role'))){
            $this->db->like('s.role', $this->input->post('role'), 'both');
        }
        if(!empty($this->input->post('email'))){
            $this->db->like('s.email', $this->input->post('email'), 'both');
        }
        if(!empty($this->input->post('mobile'))){
            $this->db->like('s.mobile', $this->input->post('mobile'), 'both');
        }
        $this->db->select('*');
        $this->db->from('users as s');
        $i = 0;    
        foreach ($this->column_search as $item){
            if(!empty($_POST['search']['value'])){                
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }        
        if(!empty($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(!empty($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    private function getQuerybyRole($role, $userrole='', $userid=''){        
        
        $this->db->select('*');
        $this->db->from('users as s');
        if($role != 'all')
        {
        $this->db->where('role', $role);
        }
        if($userrole == 'parent')
        {
            $this->db->where('user_id', $userid);
        }
        $i = 0;    
        foreach ($this->column_search as $item){
            if(!empty($_POST['search']['value'])){                
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }        
        if(!empty($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(!empty($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    public function getUserList() {
        $this->getQuery();
        if(!empty($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else {
            $_POST['length']= $_POST['length'];
        }        
        if(!empty($_POST['start']) && $_POST['start'] > 1) {
        $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);       
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getUserListbyRole($role, $userrole='', $userid='') {
        $this->getQuerybyRole($role, strtolower($userrole), $userid);
        if(!empty($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else {
            $_POST['length']= $_POST['length'];
        }        
        if(!empty($_POST['start']) && $_POST['start'] > 1) {
        $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);       
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    public function countFiltered($role, $userrole='', $userid=''){
        $this->getQuerybyRole($role, strtolower($userrole), $userid);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countAll($role, $userrole='', $userid=''){
        $this->getQuerybyRole($role, strtolower($userrole), $userid);
        $query = $this->db->get();
        return $query->num_rows();
    }    
    public function createUser() { 
        $data = array(
            'user_name' => $this->_name,
            'code' => $this->_code,
            'email' => $this->_email,
            'role' => $this->_role,
            'mobile' => $this->_mobile,
            'status' => $this->_status,
            'encrypted_password' => $this->_encryptedpassword,
            'gender' => $this->_gender,
            'date_of_birth' => $this->_dateofbirth,
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }    
    public function updateUser() { 
        $data = array(
            'user_name' => $this->_name,            
            'email' => $this->_email,
            'role' => $this->_role,
            'mobile' => $this->_mobile,
            'status' => $this->_status,
            'encrypted_password' => $this->_encryptedpassword,
            'gender' => $this->_gender,
            'date_of_birth' => $this->_dateofbirth,
        );
        $this->db->where('user_id', $this->_userID);
        $this->db->update('users', $data);
    }   
    public function getUser() {        
        $this->db->select(array('s.user_id', 's.user_name', 's.email', 's.role', 's.mobile', 's.status', 's.encrypted_password', 's.gender', 's.date_of_birth'));
        $this->db->from('users s');  
        $this->db->where('s.user_id', $this->_userID);     
        $query = $this->db->get();
       return $query->row_array();
    } 
    public function deleteUser() {         
        $this->db->where('user_id', $this->_userID);
        $this->db->delete('users');  
    }  
    public function validateEmail($email) {
        //return preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)?TRUE:FALSE;
        return preg_match('/^[^\@]+@.*.[a-z]$/i', $email)?TRUE:FALSE;
    }   
    public function validateMobile($mobile){
        //return preg_match('/^[0-9]{10}+$/', $mobile)?TRUE:FALSE;
        return preg_match('/^[0-9]+$/', $mobile)?TRUE:FALSE;
    }    
}