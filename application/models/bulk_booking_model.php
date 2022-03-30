<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Bulk_Booking_Model extends CI_Model {
    
    //select id,pid,cost from pricingslot where pid='2' and fromtime <= '09:00:00'  and  totime >= '10:00:00'
    public function check_availability_pricing_timeslot($data, $holiday_id){
/*
        $this->db->select('pst.id, pst.pid, pst.fromtime, pst.totime, pst.cost, pr.cid, pr.day_type, ct.courtname, pr.fromday, pr.today, pr.holiday_id');
        $this->db->from('pricingslot as pst');
        $this->db->join('pricing as pr', 'pr.id = pst.pid', 'left');
        $this->db->join('court as ct', 'ct.id = pr.cid', 'left');  
        if($data['sid'] != ''){
            $this->db->where('pr.sid', $data['sid'] );
        }
        if($data['lid'] != ''){
            $this->db->where('pr.lid', $data['lid'] );
        }
        if($data['cid'] != ''){
            $this->db->where('pr.cid', $data['cid'] );
        }  
        if(!empty($holiday_id)){
         //$holiday_id = join(",",$holiday_ids);
         //$where = "( CASE WHEN pr.day_type='1' THEN pr.fromday <= '".$data['day_name']."' AND pr.today >= '".$data['day_name']."' WHEN pr.day_type='0' THEN pr.fromday = '".$data['day_name']."' ELSE pr.holiday_id IN ($holiday_id) END )";
         $where = "( pr.holiday_id IN ($holiday_id) )";
        }
        else{
           $holiday_id = ''; 
           $where = "( CASE WHEN pr.day_type='1' THEN pr.fromday <= '".$data['day_name']."' AND pr.today >= '".$data['day_name']."' WHEN pr.day_type='0' THEN pr.fromday = '".$data['day_name']."' END )";
        }
        // echo $where = "( CASE WHEN pr.day_type='1' THEN pr.fromday <= '".$data['day_name']."' AND pr.today >= '".$data['day_name']."' WHEN pr.day_type='0' THEN pr.fromday = '".$data['day_name']."' ELSE pr.holiday_id IN ($holiday_id) END )";
         $this->db->where($where);

        $this->db->where('pr.delete_status !=', 1);
        $this->db->order_by('pst.id','ASC');
        $query = $this->db->get();


        */


        $sql="select pst.id, pst.pid, pst.fromtime, pst.totime, pst.cost, pr.cid, pr.day_type, ct.courtname, pr.fromday, pr.today, pr.holiday_id 
        from pricingslot as pst 
        left join pricing as pr on pr.id = pst.pid 
        left join court as ct on ct.id = pr.cid 
        where 1 ";
        
        if($data['sid'] != ''){
            $sql .="AND pr.sid='".$data['sid']."' ";  
        }
        if($data['lid'] != '')
        {
            $sql .="AND pr.lid='".$data['lid']."' ";
        }
        if($data['cid'] != ''){
            $sql .="AND pr.cid='".$data['cid']."' ";
        } 
        if(!empty($holiday_id)){
            $sql .="AND ( pr.holiday_id IN ($holiday_id) ) ";
        }
        else{
            $holiday_id = ''; 
            $sql .="AND ( CASE WHEN pr.day_type='1' THEN pr.fromday <= '".$data['day_name']."' AND pr.today >= '".$data['day_name']."' WHEN pr.day_type='0' THEN pr.fromday = '".$data['day_name']."' END ) ";
         }
        $sql .= "AND pr.delete_status !=1 ";
        $sql .= "order by pst.id ASC ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();die;
        
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    public function get_slotprice($pid, $fromtime, $totime, $holiday_id, $sid, $lid){
        
        $this->db->select('pst.id, pst.pid, pst.fromtime, pst.totime, pst.cost, pr.cid, ct.courtname');
        $this->db->from('pricingslot as pst');
        $this->db->join('pricing as pr', 'pr.id = pst.pid', 'left');
        $this->db->join('court as ct', 'ct.id = pr.cid', 'left');  
        if($pid != ''){
            $this->db->where('pr.id', $pid );
        }
        if($sid != ''){
            $this->db->where('pr.sid', $sid );
        }
        if($lid != ''){
            $this->db->where('pr.lid', $lid );
        }
        if($holiday_id != ''){
            $this->db->where('pr.holiday_id', $holiday_id );
        }
        else{
            if($fromtime != ''){
                $this->db->where('pst.fromtime <=', $fromtime);
            }
            if($totime != ''){
                $this->db->where('pst.totime >=', $totime);
            }
        }
        
        
        $this->db->where('pr.delete_status !=', 1);
        $this->db->order_by('pst.id','ASC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
        
    }
    
    public function check_availability_booking_timeslot($data){
        $this->db->select('bst.id, bst.bid, pt.parent_name as customer_name');
        $this->db->from('bookingslot as bst');
        $this->db->join('booking as bk', 'bk.id = bst.bid', 'left');
        $this->db->join('parent as pt', 'pt.parent_id = bk.customerid', 'left');
        if($data['cid'] != ''){
            $this->db->where('bst.courtid', $data['cid']);
        }
        if($data['sid'] != ''){
            $this->db->where('bst.sid', $data['sid']);
        }
        if($data['lid'] != ''){
            $this->db->where('bst.lid', $data['lid']);
        }
        if($data['day_name'] != ''){
            $this->db->where('bst.days', $data['day_name']);
        }
        if($data['from_time'] != '' && $data['to_time'] != ''){
            //$where = " bst.booking_fromtime  > '".$data['from_time']."' AND bst.booking_fromtime  < '".$data['to_time']."' OR bst.booking_totime > '".$data['from_time']."' AND bst.booking_totime  < '".$data['to_time']."' ";
            $where = " bst.booking_fromtime  < '".$data['to_time']."' AND bst.booking_totime > '".$data['from_time']."'  ";
            $this->db->where('('.$where.')');        
        }   
        if($data['from_date'] != '' && $data['to_date'] != ''){
          //  $where1 = "bst.fromdate  >= '".$data['from_date']."' AND bst.fromdate  <= '".$data['to_date']."' OR bst.todate >= '".$data['from_date']."' AND bst.todate  <= '".$data['to_date']."' ";
            $where1 = "bst.fromdate  <= '".$data['to_date']."' AND bst.todate >= '".$data['from_date']."' ";
            $this->db->where('('.$where1.')');       
        }     
        
        $this->db->where('bk.bstatus', 1);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_bulk_booking_list(){
        $this->db->select('bst.id, bst.bid, bst.fromdate, bst.todate, bst.booking_fromtime, bst.booking_totime, bst.days, pt.parent_name as customer_name, pt.mobile_no as customer_mobile, bk.bookedon, bk.paystatus, bk.customerid, bk.booking_no, bk.totamt as gross_amount, bk.net_total as net_amount, bk.btype as booking_type, bk.discount_amount, bk.advance_amount, bk.balamt as balance_amount, bk.paidamt as paid_amount, bk.customerid, ct.courtname ');
        $this->db->from('bookingslot as bst');
        $this->db->join('booking as bk', 'bk.id = bst.bid', 'left');
        $this->db->join('parent as pt', 'pt.parent_id = bk.customerid', 'left');
        $this->db->join('court as ct', 'ct.id = bst.courtid', 'left');  
        $this->db->where('bk.btype', 2);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_daysName($dayid){

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
    
    public function get_holiday_id($date){

        $this->db->select('*');
        $this->db->from('holidays');
        if($date != ''){
            $this->db->where('holidaydate', $date);
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

}

?>