<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accountservice_model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}
    public function gettype($selected='Income'){
        $this->db->select('Name');
        $this->db->from('accounts_service');          
        $this->db->where('Type', $selected);  
        $query = $this->db->get();
       return $query->result_array();
    }


   /* public function gettype($selected)
    {
      $where="";
        if($selected=='Expense')
          {
            $Expense=$this->db->query("select  Name from accounts_service where Type='Expense'".$where);
            return $Expense->result_array();
          }
         else if($selected=='Income')
          {
            $Expense=$this->db->query("select  Name from accounts_service where Type='Income'".$where);
            return $Expense->result_array();
          }
    }*/
    

    public function getVatPercentage(){
      $this->db->select('percentage');
      $this->db->from('vat_setups');          
      $this->db->where('id', '1');  
      $query = $this->db->get();
     return $query->row()->percentage;
     }
}
?>