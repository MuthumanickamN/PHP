<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_credit_model extends CI_Model {
		private $transaction_date;
		private $transaction_type;
		private $school_name;
		private $school_id;
		private $activity_id;
		private $location_id;
		private $contact;
		private $contact_person;
		private $trn_number;
		private $email_id;
		private $gross_amount;
		private $vat_percentage;
		private $vat_value;
		private $net_amount;
		private $account_code;
		private $transaction_amount;

		
		public function setTransaction_date($transaction_date) {
        	$this->transaction_date = $transaction_date;
	    }
	    public function setTransaction_amount($transaction_amount) {
        	$this->transaction_amount = $transaction_amount;
	    }
	    public function setTransaction_type($transaction_type) {
	        $this->transaction_type = $transaction_type;
	    }
	    public function setSchool_name($school_name) {
	        $this->school_name = $school_name;
	    }
	    public function setSchool_id($school_id) {
	        $this->school_id = $school_id;
	    }
	    public function setActivity_id($activity_id) {
	        $this->activity_id = $activity_id;
	    }
	    public function setLocation_id($location_id) {
	        $this->location_id = $location_id;
	    }
	    public function setContact($contact) {
	        $this->contact = $contact;
	    }  
	    public function setContact_person($contact_person) {
        $this->contact_person = $contact_person;
	    }
	    public function setTrn_number($trn_number) {
	        $this->trn_number = $trn_number;
	    }
	    public function setEmail_id($email_id) {
	        $this->email_id = $email_id;
	    }
	    public function setGross_amount($gross_amount) {
	        $this->gross_amount = $gross_amount;
	    }
	    public function setVat_percentage($vat_percentage) {
	        $this->vat_percentage = $vat_percentage;
	    }
	    public function setVat_value($vat_value) {
	        $this->vat_value = $vat_value;
	    }
	    public function setNet_amount($net_amount) {
	        $this->net_amount = $net_amount;
	    } 
	    public function setAccount_code($account_code) {
	        $this->account_code = $account_code;
	    }
	    public function setDescription($description) {
	        $this->description = $description;
	    }  
	    public function setWtx_id($wtx_id) {
	        $this->wtx_id = $wtx_id;
	    }  
	    
	    

	    public function createCredit() { 
	    	$user_id = $this->session->userid;
	        $data = array(
	            'transaction_date' => $this->transaction_date,
	            'transaction_type' => $this->transaction_type,
	            'school_name' => $this->school_name,
	            'school_id' => $this->school_id,
	            'activity_id' => $this->activity_id,
	            'location_id' => $this->location_id,
	            'contact' => $this->contact,
	            'contact_person' => $this->contact_person,
	            'trn_number' => $this->trn_number,
	            'email_id' => $this->email_id,
	            'gross_amount' => $this->gross_amount,
	            'vat_percentage' => $this->vat_percentage,
	            'vat_value' => $this->vat_value,
	            'net_amount' => $this->net_amount,
	            'account_code' => $this->account_code,
	            'transaction_amount' => $this->transaction_amount,
	            'description' =>$this->description,
	            'amount' => $this->net_amount,
	            'credit' => $this->net_amount,
	            'status' => 0,
	            'wtx_id' => $this->wtx_id,
	            'updated_admin_id' => $user_id,
	            
	        );
	        $this->db->insert('school_credits', $data);
	        return $this->db->insert_id();
    	}  

    	public function getCreditInvoiceList(){
    		$this->db->select(array('c.*'));
	        $this->db->from('school_credits c');  
	        $query = $this->db->get();
	       return $query->result_array();
    	}
    	public function getInvoiceDetail($id){
    		$this->db->select(array('*'));
	        $this->db->from('school_credits'); 
	        $this->db->where('id', $id); 
	        $query = $this->db->get();
	       return $query->row_array();
    	}
            
            
}