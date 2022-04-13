<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accountservice_model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}
    public function gettype($selected='Income'){
        $this->db->select('*');
        $this->db->from('accounts_service');          
        $this->db->where('Type', $selected);  
        $query = $this->db->get();
       return $query->result_array();
    }

/*
    public function gettype($selected)
    {
      $where="";
        if($selected=='Expense')
          {
            $Expense=$this->db->query("select  Name from accounts_service where Type='Expense'".$where);
            return $Expense->result_array();
          }
         else if($selected=='Income')
          {
            $Income=$this->db->query("select  Name from accounts_service where Type='Income'".$where);
            return $Income->result_array();
          }
    }*/
    

    public function getVatPercentage(){
      $this->db->select('percentage');
      $this->db->from('vat_setups');          
      $this->db->where('id', '1');  
      $query = $this->db->get();
     return $query->row()->percentage;
     }
	 public function getlist()
	 {
		$query = $this->db->query('select * from accounts_service_entries');
		$row = $query->result_array();
		return $row;
		
	 }
	 public function edit($id)
	 {
		$this->db->select('*');
        $this->db->from('accounts_service_entries');
        $this->db->where('Id', $id);

        $query = $this->db->get();
        $row = $query->row_array();
        return $row;	
	 }
	 public function upload_items($id)
	 {
		$this->db->select('*');
        $this->db->from('accountserviceuploadedfiles');
        $this->db->where('accountservice_id', $id);

        $query = $this->db->get();
        $row = $query->result_array();
        return $row;	
	 }
}
?>