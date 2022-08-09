<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_profile_report_Model extends CI_Model {
    private $_schoolID;
    private $_name;   
    private $_email;
    private $_contact;
    private $_school_location;
    private $_contact_person;
    private $_trn_number;
    private $_status;
    private $_school_id;

    public function setSchoolID($school_id) {
        $this->_id = $school_id;
    }
    public function setSchoolName($school_name) {
        $this->_school_name = $school_name;
    }
    public function setSchool_location($school_location) {
        $this->_school_location = $school_location;
    }
    public function setContact($contact) {
        $this->_contact = $contact;
    }
    public function setContact_person($contact_person) {
        $this->_contact_person = $contact_person;
    }
    public function setTrn_number($trn_number) {
        $this->_trn_number = $trn_number;
    }
    public function setEmailId($email) {
        $this->_school_email_id = $email;
    }  
    public function setStatus($status) {
        $this->_status = $status;
    }
    public function setSclId($school_id) {
        $this->_school_id = $school_id;
    }      
    var $table = 'school_profile_reports';
    var $column_order = array('s.school_id',null, 's.user_name','s.email','s.role','s.status','s.mobile','s.current_sign_in_at','s.sign_in_count','s.last_sign_in_at',null);
    var $column_search = array('s.user_name','s.email','s.mobile','s.role');
    var $order = array('school_id' => 'DESC');

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
        $this->db->from('school_profile_reports as s');
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
    public function getList() {
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
    public function countFiltered(){
        $this->getQuery();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }    
    public function createSchool() { 
        $data = array(
            'school_name' => $this->_school_name,
            'contact' => $this->_contact,
            'school_location' => $this->_school_location,
            'contact_person' => $this->_contact_person,
            'trn_number' => $this->_trn_number,
            'school_email_id' => $this->_school_email_id,
            'status' => $this->_status,
            'school_id' => $this->_school_id,
        );
        $this->db->insert('school_profile_reports', $data);
        return $this->db->insert_id();
    }    
    public function updateSchool() { 
        $data = array(
            'school_name' => $this->_school_name,
            'contact' => $this->_contact,
            'school_location' => $this->_school_location,
            'contact_person' => $this->_contact_person,
            'trn_number' => $this->_trn_number,
            'school_email_id' => $this->_school_email_id,
            'status' => $this->_status,
        );
        $this->db->where('id', $this->_id);
        $this->db->update('school_profile_reports', $data);
    }   
    public function getSchool() {      
        $this->db->select(array('s.id', 's.school_id', 's.school_name', 's.contact', 's.school_location', 's.contact_person','s.trn_number','s.school_email_id', 's.status','s.created_at','s.updated_at'));
        $this->db->from('school_profile_reports s');  
        $this->db->where('s.id', $this->_id);     
        $query = $this->db->get();
       return $query->row_array();
    } 
    public function deleteSchool() {         
        $this->db->where('id', $this->_id);
        $this->db->delete('school_profile_reports');  
    }  
    public function validateEmail($email) {
        return preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)?TRUE:FALSE;
    }   
    public function validateMobile($mobile){
        return preg_match('/^[0-9]{10}+$/', $mobile)?TRUE:FALSE;
    } 
    /* added on 28.4.21 */
    public function getAccountCodeList(){
		$this->db->select(array('a.Id as id', 'a.Name as name_of_service'));
        $this->db->from('accounts_service a');  
        //$this->db->where('a.status', 'Active');     
        $query = $this->db->get();
       return $query->result_array();
	}   
	public function getAllSchoolList(){
		$this->db->select(array('s.id', 's.school_name','s.contact'));
        $this->db->from('school_profile_reports s');  
        $this->db->where('s.status', '1');     
        $query = $this->db->get();
       return $query->result_array();
	} 
	public function getAllActivityList(){
		$this->db->select(array('*'));
        $this->db->from('games a');  
        $query = $this->db->get();
       return $query->result_array();
	}    
	public function getVatDetails(){
		$this->db->select( 'v.percentage');
        $this->db->from('vat_setups v');  
        $this->db->where('v.id', 1);     
        $query = $this->db->get();
       return $query->row()->percentage;
	}
    public function getAllLocationList(){
        $this->db->select('*');
        $this->db->from('locations a');  
        $query = $this->db->get();
       return $query->result_array();
    }

    public function getLastEntry($tablename){
        if($tablename == "wallet_transactions")
        {
            $lastentry = $this->db->query('select * from '.$tablename.'');
            $lastentryId1 = $lastentry->num_rows();

            $lastentry = $this->db->query('select * from accounts_service_entries');
            $lastentryId2 = $lastentry->num_rows();
            
            $lastentryId = $lastentryId1+$lastentryId2;
        }
        else{
            $lastentry = $this->db->query('select * from '.$tablename.'');
            $lastentryId = $lastentry->num_rows();
        }
        
        if(isset($lastentryId)){
            $trans_id = $lastentryId+1;
        }else{
            $trans_id = 1;
        }
        return $trans_id;
    }
	
}
