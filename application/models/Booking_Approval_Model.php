<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Booking_Approval_Model extends CI_Model {
    
    public function update_booking_details($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('booking', $data);
        $query = $this->db->affected_rows();		
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update_customerWallet_details($data, $id) {
        $this->db->where('custid', $id);
        $this->db->update('wallet', $data);
        $query = $this->db->affected_rows();		
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function get_customerbookinglist($id=''){
        $this->db->select('bk.id as booking_id, bk.customerid, bk.booking_no, bk.totamt as total_amount, wall.balance_credits as wallet_amount, cust.parent_name as customer_name, cust.mobile_no as customer_mobile, cust.email_id as customer_email');
        $this->db->from('booking as bk');
        $this->db->join('parent as cust', 'cust.parent_id = bk.customerid', 'left');
        $this->db->join('prepaid_credits as wall', 'wall.parent_id = bk.customerid', 'left');
        //$this->db->join('location as loc', 'loc.id = bk.lid', 'left');         
        $this->db->where('bk.booked_by !=', '0');
        $this->db->where('bk.bstatus', '1');
        $this->db->where('bk.blocked_status', '0');
        if($id !=''){
            $this->db->where('bk.id', $id);
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
    
    public function get_customerbookingslotlist($booking_id){
        $this->db->select('bst.id, bst.booking_fromtime, bst.booking_totime, bst.fromdate, bst.todate, bst.courtid, bst.days, sp.sportsname, ct.courtname, loc.location ');        
        $this->db->from('bookingslot as bst');
        $this->db->join('location_booking as loc', 'loc.id = bst.lid', 'left'); 
        $this->db->join('sports as sp', 'sp.id = bst.sid', 'left');
        $this->db->join('court as ct', 'ct.id = bst.courtid', 'left'); 
        $this->db->where('bst.bid', $booking_id);  
        $this->db->order_by('bst.booking_fromtime', 'ASC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function check_bookedslot_exist($cid, $fromtime, $totime, $from_date, $to_date, $day_id){
        $this->db->select('bst.id, bst.bid, bk.btype, bk.booked_by, bk.blocked_status, cust.name as customer_name');
        $this->db->from('bookingslot as bst');
        $this->db->join('booking as bk', 'bk.id = bst.bid', 'left');
        $this->db->join('customer as cust', 'cust.id = bk.customerid', 'left');
        if($cid != ''){
            $this->db->where('bst.courtid', $cid );
        } 
        if($fromtime != ''){
            $this->db->where('bst.booking_fromtime', $fromtime);
        }
        if($totime != ''){
            $this->db->where('bst.booking_totime', $totime);
        }
        if($day_id != ''){         
            $this->db->where('bst.days', $day_id);
        }        
        if($from_date != ''){
            $this->db->where('bst.fromdate', $from_date);
        }
        if($to_date != ''){
            $this->db->where('bst.todate', $to_date);  
        }
        $this->db->where('bk.booked_by !=', '0');
        $this->db->where('bk.bstatus', '1');
        $this->db->where('bk.blocked_status', '1');
        $query = $this->db->get();
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