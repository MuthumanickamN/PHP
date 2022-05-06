<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Daily_Transaction_Model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	public function getAllCoachList(){
        $this->db->select('*');
        $this->db->from('coach a');  
        $this->db->where('a.status', 'Active'); 
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getAllUserList(){
    	$this->db->select('*');
        $this->db->from('users u');  
        $this->db->where('u.status', 'Active'); 
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getAllBankList(){
        $this->db->select('*');
        $this->db->from('bank_details b');   
        $query = $this->db->get();
       return $query->result_array();
    }
    public function getAccountCodeDetail($code){
        $this->db->select(array('*'));
        $this->db->from('account_codes a');  
        $this->db->where('a.status', 'Active'); 
        $this->db->where('a.id', $code);     
        $query = $this->db->get();
       return $query->row()->name_of_service;
    } 
    public function getUserDetail($userid){
        $this->db->select(array('*'));
        $this->db->from('users a');  
        $this->db->where('a.status', 'Active'); 
        $this->db->where('a.user_id', $userid);     
        $query = $this->db->get();
       return $query->row()->user_name;
    } 
     public function getParentCode($id){
        $this->db->select(array('*'));
        $this->db->from('parent p');  
        $this->db->where('p.parent_id', $id); 
        $query = $this->db->get();
        return $query->row()->parent_code;
    } 
    
    public function getUserEmail($userid){
        $this->db->select(array('*'));
        $this->db->from('users a');  
        $this->db->where('a.status', 'Active'); 
        $this->db->where('a.user_id', $userid);     
        $query = $this->db->get();
       return $query->row()->email;
    } 
    public function getActivityDetail($id){
        $this->db->select(array('*'));
        $this->db->from('games');  
        $this->db->where('game_id', $id);  
        $query = $this->db->get();
       return $query->row()->game;
    } 

    public function getLocationDetail($id){
        $this->db->select(array('*'));
        $this->db->from('locations ');          
        $this->db->where('location_id', $id);  
        $query = $this->db->get();
       return $query->row()->location;
    } 

    public function getCoachDetail($id){
        $this->db->select(array('*'));
        $this->db->from('coach ');  
        $this->db->where('status', 'Active');   
        $this->db->where('coach_id', $id);  
        $query = $this->db->get();
       return $query->row()->coach_name;
    } 
    
    public function getAlltransactionList(){
        $this->db->select('*');
        $this->db->from('daily_transactions');  
        $this->db->where('is_reversed', 0);  
        $query = $this->db->get();
       return $query->result_array();
    }
}
