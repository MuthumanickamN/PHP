<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accountservice_model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}
    public function gettype($selected='Expenses'){
        $this->db->select('*');
        $this->db->from('accounts_service');          
        $this->db->where('Type', $selected);  
        $query = $this->db->get();
       return $query->result_array();
    }

    public function getVatPercentage(){
      $this->db->select('percentage');
      $this->db->from('vat_setups');          
      $this->db->where('id', '1');  
      $query = $this->db->get();
     return $query->row()->percentage;
     }
	 public function getlist($where)
	 {
      $query = $this->db->query("select ase.*,acs.Name,acs.Type from accounts_service_entries as ase left join accounts_service as acs on acs.Id=ase.accountservice_id $where");
	   	$row = $query->result_array();
       //echo $this->db->last_query();die;
	  	return $row;
		
	 }
	 public function edit($id)
	 {
		
        $query = $this->db->query("select * from accounts_service_entries where Id='$id'");
        $row = $query->row_array();
        return $row;	
	 }
	 public function upload_items($id)
	 {
        $query = $this->db->query("select * from accountserviceuploadedfiles where accountservice_id='$id'");
        $row = $query->result_array();
        return $row;	
	 }
   public function getname()
	 {
      $query = $this->db->query('select Name from accounts_service ');
	   	$row = $query->result_array();
	  	return $row;
		
	 }


   
}
?>