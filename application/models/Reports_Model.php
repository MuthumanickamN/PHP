<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Reports_Model extends CI_Model{
	
	public function get_user($parent_id=''){
		
		$this->db->select("*");
		$this->db->from("parent");
		if($parent_id)
		{
		    $this->db->where('parent_id', $parent_id);
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
	
	public function get_transaction_search_history($from_date,$to_date,$user){

		$this->db->select('bs.fromdate, bs.todate, bs.cancelled_on, bs.booking_fromtime, bs.booking_totime, dl.dayname, bok.id, bok.booking_no, bok.bookedon, bok.btype, bs.gross_amount as totamt, bs.amount as net_total, bs.amount as paidamt, bs.discount_amount, spo.sportsname, loc.location, cus.parent_name as name, cus.mobile_no as mobile, cus.email_id as email', false);
		$this->db->from('booking as bok');
		
		$this->db->join('parent as cus','cus.parent_id = bok.customerid','left');
		
		$this->db->join('bookingslot as bs','bs.bid=bok.id','left');
		$this->db->join('sports as spo','spo.id = bs.sid','left');
		$this->db->join('location_booking as loc','loc.id = bs.lid','left');
		$this->db->join('dayname_list as dl','dl.dayid = bs.days','left');
		
		
		if($to_date !== "" && $from_date !== "")
		{
			
			$this->db->where("bs.fromdate >= '$from_date'");
			$this->db->where("bs.todate <= '$to_date'");
		}
		else if($from_date !== "")
		{
			$this->db->where("bs.fromdate = '$from_date'");				
		}
		
if($user != "" && $user != "All")
{
	$this->db->where("cus.parent_id = $user");
}	
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		
		
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
	         return $row;
			
		}
		else{
			
			return false;
		}
		
	}
	
	
	public function get_booking_search_history($from_date,$to_date,$user){

		$this->db->select('bs.fromdate, bs.todate, bs.booking_fromtime, bs.booking_totime, dl.dayname, bok.id, bok.booking_no, bok.bookedon, bok.btype, bs.gross_amount as totamt, bs.amount as net_total, bs.amount as paidamt, bs.discount_amount, spo.sportsname, loc.location, cus.parent_name as name, cus.mobile_no as mobile, cus.email_id as email', false);
		
		$this->db->from('booking as bok');
		$this->db->join('bookingslot as bs','bs.bid=bok.id','left');
		$this->db->join('sports as spo','spo.id = bs.sid','left');
		$this->db->join('location_booking as loc','loc.id = bs.lid','left');
		$this->db->join('parent as cus','cus.parent_id = bok.customerid','left');
		
		
		$this->db->join('dayname_list as dl','dl.dayid = bs.days','left');
		
		
		
		if($to_date !== "" && $from_date !== "")
		{
			$this->db->where("bs.fromdate >= '$from_date'");
			$this->db->where("bs.todate <= '$to_date'");
		}
		else if($from_date !== "")
		{
			$this->db->where("bs.fromdate = '$from_date'");				
		}
		
		if($user != "" && $user != "All")
{
	$this->db->where("cus.parent_id = $user");
}
		$this->db->where("bok.bstatus = 1");
		$this->db->where("bs.cancelled = 0");
		
		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
	         return $row;
			
		}
		else{
			
			return false;
		}
		
	}
	
	
	public function get_cancellation_search_history($from_date,$to_date,$user){

		$this->db->select('bok.booking_no,bs.cancelled_on,bok.btype,bok.totamt,bok.net_total,bok.discount_amount,spo.sportsname,loc.location,cus.parent_name as name, cus.mobile_no as mobile, cus.email_id as email, bs.amount as paidamt', false);
		$this->db->from('booking as bok');
		$this->db->join('bookingslot as bs','bs.bid=bok.id','left');
		$this->db->join('sports as spo','spo.id = bs.sid','left');
		$this->db->join('location_booking as loc','loc.id = bs.lid','left');
		$this->db->join('parent as cus','cus.parent_id = bok.customerid','left');
		
		
		if($to_date !== "" && $from_date !== "")
		{
			$this->db->where("bs.cancelled_on >= '$from_date'");
			$this->db->where("bs.cancelled_on <= '$to_date'");
		}
		else if($from_date !== "")
		{
			$this->db->where("bs.cancelled_on = '$from_date'");				
		}
		
		if($user != "" && $user != "All")
		{
			$this->db->where("cus.parent_id = $user");
		}

		$this->db->where("bs.cancelled = 1");
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
	         return $row;
			
		}
		else{
			
			return false;
		}
		
	}
	
	public function get_regular_date_range($id)
	{
		$this->db->select('bs.fromdate,dl.dayname',false);
		$this->db->join('dayname_list as dl','dl.dayid = bs.days','left');
		$this->db->from("bookingslot as bs");
		$this->db->where('bs.bid', $id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
	         return $row;
			
		}
		else{
			
			return false;
		}
		
		
		
	}
	
	public function get_bulk_date_range($id)
	{
		$this->db->select('bs.fromdate,bs.todate,dl.dayname',false);
		$this->db->join('dayname_list as dl','dl.dayid = bs.days','left');
		$this->db->from("bookingslot as bs");
		$this->db->where('bs.bid', $id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
	         return $row;
			
		}
		else{
			
			return false;
		}
		
		
		
	}
	
		
}









?>


