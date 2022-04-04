<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Search_Model extends CI_Model{
	
	public function get_records($customer_email){
		$this->db->select("email_id");
		$this->db->distinct();
		$this->db->from("parent");
		$this->db->like('email_id',$customer_email);
		$this->db->get(); 
		$query1 = $this->db->last_query();
        //return $query1;

		$this->db->select("booking_no as email_id");
		$this->db->distinct();
		$this->db->from("booking");
		$this->db->like("booking_no",$customer_email);
		$this->db->get(); 
		$query2 =  $this->db->last_query();
		//return $query2;


		$query = $this->db->query($query1." UNION ".$query2); 
		//$query =("SELECT email_id from parent UNION SELECT booking_no as email_id from booking order by email_id,$customer_email");
		$this->db->get();
		//echo $this->db->last_query();die; 
		//return $query;
		
       if ( $query->num_rows() > 0 )
		{
		$row = $query->result_array();
		return $row;
		}else{
			return false;
		}
		
	}
	 
	public function get_cus_id($mobile_booking_id){
		$this->db->select("cus.id");
		$this->db->from("customer as cus");
		$this->db->join('booking as bok','cus.id = bok.customerid','left');
		$this->db->or_like(array('cus.email' => $mobile_booking_id, 'bok.booking_no' => $mobile_booking_id));
		$query = $this->db->get();	
		if ( $query->num_rows() > 0 )
			{
			$row = $query->row_array();
			return $row;
			}else{
				return false;
			}
}
	
	
	public function get_booking_details($cus_id,$search_value){
		
		$this->db->select("*");
		$this->db->from("booking");
		
		$rest = substr($search_value, 0, 4);
		if($rest == 'BKNO')
		{
			$this->db->where('booking_no',$search_value);
			
		}
		else{
			
			$this->db->where('customerid',$cus_id);
		}
		
		
		
		$query = $this->db->get();		
		if ( $query->num_rows() > 0 )
			{
			$row = $query->result_array();
			return $row;
			}else{
				return false;
			}
	}

	public function get_view_details($booking_id){
		$place = "(select location from location as loc where loc.id = bs.lid)";
		$sports = "(select sportsname from sports as spo where spo.id = bs.sid)";
		$this->db->select("bok.*,cus.name,cus.mobile,cus.email,$place as place, $sports as sports");
		$this->db->from('booking as bok');
		$this->db->join('bookingslot as bs','bs.bid=bok.id','left');
		$this->db->join('customer as cus','cus.id = bok.customerid','left');
		$this->db->where('bok.id',$booking_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
			return $row;
		}
		else{
		   return false;
		}
		
	}

	public function get_slot_details($booking_id){
		$place = "(select location from location as loc where loc.id = bs.lid)";
		$sports = "(select sportsname from sports as spo where spo.id = bs.sid)";
		$court_name = "(select courtname from court as ct where ct.id = bs.courtid)";
		$this->db->select("bs.*, $court_name as courtname,$place as place, $sports as sports");
		$this->db->from('bookingslot as bs');
		$this->db->where('bs.bid',$booking_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
			return $row;
		}
		else{
			return false;
		}
		
	  }
          
    public function get_dayslist($dayid){

        $this->db->select('*');
        $this->db->from('dayname_list');
        if($dayid != ''){
            $this->db->where('dayid', $dayid);
        }
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
    }
	
	
	
	
	public function search_email_check($cus_id,$search_value){
		
		
		$this->db->select("cus.id");
		$this->db->from("customer as cus");
		$this->db->join('booking as bok','cus.id = bok.customerid','left');
		
		$rest = substr($search_value, 0, 1);
		if($rest == 'B')
		{
			$this->db->where('bok.booking_no',$search_value);
			
		}
		else{
			
			$this->db->where('cus.email',$search_value);
		}
		
		
		$query = $this->db->get(); 
		//echo $this->db->last_query();exit;
		
		if ( $query->num_rows() > 0 )
			{
			$row = $query->row_array();
			return $row;
			}else{
				return false;
			}



	}
		
}









?>


