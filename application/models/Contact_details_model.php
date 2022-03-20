<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact_details_model extends CI_Model {
	
	public function get_contact_details($postdata)
    {
		$qry1 = $this->_get_datatables_query($postdata);
		if($_POST['start'] != "" && $_POST['length'] != ""){
			if($_POST['length'] != -1){
				$qry1 .= " LIMIT ".$_POST['length']." OFFSET ".$_POST['start'];
			}			
		}
		$query = $this->db->query($qry1);
		return $query->result_array();
    }   
	
	
	private function _get_datatables_query($postdata)
    {
		
		#ssecho '< pre>'; print_r($postdata); echo '</pre>';
		
		$column_order = array('ca.id','r.name','r.father_name','a1.activity_name','ca.contract_from_date','ca.contract_to_date','ca.contract_vat_amount','ca.contract_net_amount'); 
        $column_search = array('r.name','r.father_name','a1.activity_name','ca.contract_from_date','ca.contract_to_date','ca.contract_vat_amount','ca.contract_net_amount'); 
        
        $order = array('ca.id' => 'desc');
       
	   
	    if(!empty($postdata['start_date']))
		 {
			 $fromdate = date("Y-m-d", strtotime(str_replace('/', '-', $postdata['start_date'])));
		 }
		 else
		 {
			$fromdate = "";
		 } 
		 if(!empty($postdata['end_date']))
		 {
			 $todate = date("Y-m-d", strtotime(str_replace('/', '-', $postdata['end_date'])));
		 }
		 else
		 {
			 $todate = "";
		 }	 
		 

	   if($fromdate != '' && $todate != ''){
		$query_form = " AND ca.contract_from_date >= '".$fromdate."'  AND  ca.contract_from_date <=  '".$todate."' ";
		}
		else
		{
			$query_form = '';
		}


	
       
        $i = 0;
        $where = '';
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                   $where .= "AND ( $item  LIKE '%".$_POST['search']['value']."%' ";
                }
                else
                {                    
                    $where .= " OR $item LIKE '%".$_POST['search']['value']."%' ";
                    
                }
               
                if(count($column_search) - 1 == $i) //last loop
                     $where .= " ) ";//close bracket
            }
            $i++;
           
        }      
        

        $order_by = '';
        if(isset($_POST['order'])) // here order processing
        {
           
		   if($_POST['order']['0']['column']==0)
		   {
			   $order_by = "ORDER BY ca.id desc";
		   }
		   else
		   {
            $order_by = "ORDER BY ".$column_order[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
		   }
      }
	  
	  
				 $sql = "SELECT ca.*,a.student_id,r.name,r.father_name,a1.activity_name FROM contract_details as ca
					join activity_selections as a
					on a.id = ca.activity_selection_id
					left join registrations as r 
					on r.id = a.student_id
					left join activity as a1
					on a1.activity_id = a.activity_id
					where 1
					".$where." ".$query_form." ".$order_by." ";
				
		return $sql;
					
    }
	
	public function count_all($postdata)
    {

        $column_search = array('r.name','r.father_name','a1.activity_name','ca.contract_from_date','ca.contract_to_date','ca.contract_vat_amount','ca.contract_net_amount');
        
		
		if(!empty($postdata['start_date']))
		 {
			 $fromdate = date("Y-m-d", strtotime($postdata['start_date']));
		 }
		 else
		 {
			$fromdate = "";
		 } 
		 if(!empty($postdata['end_date']))
		 {
			 $todate = date("Y-m-d", strtotime($postdata['end_date'])); 
		 }
		 else
		 {
			 $todate = "";
		 }
	   
	   
        $i = 0;
        $where = '';
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                   $where .= "AND ( $item  LIKE '%".$_POST['search']['value']."%' ";
                }
                else
                {                    
                    $where .= " OR $item LIKE '%".$_POST['search']['value']."%' ";
                    
                }
               
                if(count($column_search) - 1 == $i) //last loop
                     $where .= " ) ";//close bracket
            }
            $i++;
           
        }   
		
		
	   if($fromdate != '' && $todate != ''){
		$query_form = "AND ca.contract_from_date >= '".$fromdate."'  AND  ca.contract_from_date <=  '".$todate."'";
		}
		else
		{
			$query_form = '';
		}	
		
	$sql = "SELECT ca.*,a.student_id,r.name,r.father_name,a1.activity_name FROM contract_details as ca
				join activity_selections as a
				on a.id = ca.activity_selection_id
				left join registrations as r 
				on r.id = a.student_id
				left join activity as a1
				on a1.activity_id = a.activity_id
				where 1
				".$where." ".$query_form."";

    	$query = $this->db->query($sql);
		$total = $query->num_rows();
	    return $total;
    }
	
	public function show_student_details($contact_id)
	{
		$sql = "SELECT ca.*,a.student_id,r.name,r.father_name,a1.activity_name FROM contract_details as ca
					join activity_selections as a
					on a.id = ca.activity_selection_id
					left join registrations as r 
					on r.id = a.student_id
					left join activity as a1
					on a1.activity_id = a.activity_id
					where ca.id = ".$contact_id."";
		$query = $this->db->query($sql);
		$result_array = $query->result_array();
	    return $result_array;
	}
	
	public function show_student_payment($contact_id)
	{
		$sql = "SELECT cp.* FROM contract_payments as cp
					where cp.contract_detail_id = ".$contact_id."";
		$query = $this->db->query($sql);
		$result_array = $query->result_array();
	    return $result_array;
		
		
	}
	


		
}