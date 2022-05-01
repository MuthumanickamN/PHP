<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Default_Model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	public function getStudentList(){
	    if($this->session->userdata('role') != "Parent"){
        $this->db->select('*');
        $this->db->from('registrations');  
        $this->db->where('status', 'Active'); 
	    
        $query = $this->db->get();
	    }
	    else
	    {
	       $parent_code = $this->session->userdata('code');
	       $this->db->select('r.*');
        $this->db->from('registrations r');  
        $this->db->join('parent as p', 'p.parent_id=r.parent_user_id');  
        $this->db->where('r.status', 'Active');  
        $this->db->where('p.parent_code', $parent_code);  
	     $query = $this->db->get();  
	     //echo $this->db->last_query();die;
	        
	    }
       return $query->result_array();
    }
    public function getLevelList(){
        $this->db->select('*');
        $this->db->from('game_levels');  
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getLevelDetail($id){
        $this->db->select(array('*'));
        $this->db->from('game_levels ');          
        $this->db->where('games_level_id', $id);  
        $query = $this->db->get();
       return $query->row()->level;
    }
    public function getLaneDetail($id){
        $this->db->select(array('*'));
        $this->db->from('lane_courts ');          
        $this->db->where('id', $id);  
        $query = $this->db->get();
       return $query->row()->lane_court;
    } 
    public function checkexists($table,$field,$value){
        $this->db->where($field,$value);
        $query = $this->db->get($table);
        if (!empty($query->result_array())){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function getParentDetail($email){
        $this->db->select('*');
        $this->db->from('parent');  
        $this->db->where('email_id', $email); 
        $this->db->where('status', 'Active'); 
        $query = $this->db->get();
       return $query->row_array();
    }
    public function getStudentByParent($parent_id){
        $this->db->select('*');
        $this->db->from('registrations');  
        $this->db->where('parent_user_id', $parent_id); 
        $this->db->where('status', 'Active'); 
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getStudentDetails($sid){
        // and r.status ='Active'
        $sql = "select r.*,p.parent_code from registrations r left join parent p on p.parent_id=r.parent_user_id where r.id='$sid'";
        $this->db->select('*');
        $this->db->from('registrations');  
        $this->db->where('id', $sid); 
        //$this->db->where('status', 'Active'); 
        $query = $this->db->get();
       return $query->row_array();
    }
    public function getParentList(){
        $this->db->select('*');
        $this->db->from('parent');  
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getParentDetailById($id){
        $this->db->select('*');
        $this->db->from('parent');  
        $this->db->where('parent_id', $id); 
        $this->db->where('status', 'Active'); 
        $query = $this->db->get();
       return $query->row_array();
    }

    public function getRefundDetails(){
        $this->db->select( 'percentage');
        $this->db->from('refund_discount_percentages');  
        $this->db->where('id', 1);     
        $query = $this->db->get();
        return $query->row()->percentage;
    }

    public function getWalletAmount($parent_id){
        $this->db->select( 'id, parent_id, total_credits');
        $this->db->from('prepaid_credits');  
        $this->db->where('parent_id', $parent_id);     
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getAllSchoolDetails($id){
        $this->db->select('*');
        $this->db->from('school_profile_reports');  
        $this->db->where('status', '1');   
        $this->db->where('id', $id);     
        $query = $this->db->get();
       return $query->row_array();
    }
    public function getInvoiceId($tablename){
        $lastentry = $this->db->query('select id from '.$tablename.' where `invoice` = "yes" ');
        $lastentryId = $lastentry->num_rows();
        if(isset($lastentryId)){
            $trans_id = $lastentryId+1;
        }else{
            $trans_id = 1;
        }
        return $trans_id;
    } 
    public function getDiscountList(){
        $this->db->select('*');
        $this->db->from('discount_setups');  
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getDiscountPercent($id){
        $this->db->select('*');
        $this->db->from('discount_setups');  
        $this->db->where('id', $id);     
        $query = $this->db->get();
       return $query->row()->discount_percentage;
    }
    public function getVatPercentage(){
        $this->db->select('percentage');
        $this->db->from('vat_setups');          
        $this->db->where('id', '1');  
        $query = $this->db->get();
       return $query->row()->percentage;
    }
    public function countries_list(){
        $this->db->select('*');
        $this->db->from('countries');  
        $this->db->where('status', '1'); 
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
}