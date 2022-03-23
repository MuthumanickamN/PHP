<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Full Stock Model class
*/
Class Pricing_Model extends CI_Model {

    public function add_pricing_details($data) {

        $query = $this->db->insert('pricing', $data);
        if ($query) {
            return $this->db->insert_id();
            //return true;
        } else {
            return false;
        }
    }
    
    public function update_pricing_details($data, $id) {
        $this->db->where('id', $id);
        $query = $this->db->update('pricing', $data);
        //echo $this->db->last_query(); die();
        $query = $this->db->affected_rows();		
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function add_pricing_timeslot_details($data) {

        $query = $this->db->insert('pricingslot', $data);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function update_pricing_timeslot_details($data, $id) {
        $this->db->where('id', $id);
        $query = $this->db->update('pricingslot', $data);
        //$this->db->last_query();
        $query = $this->db->affected_rows();		
        if ($query) {
            return true;
        } else {
            return false;
        }
    }    

    public function get_pricing_list($data){

        $this->db->select('pr.fromday, loc.location, sp.sportsname, pr.today, pr.id, pr.day_type, pr.holiday_id, ct.courtname');
        $this->db->from('pricing as pr');
        $this->db->join('court as ct', 'ct.id = pr.cid', 'left');  
        $this->db->join('location_booking as loc', 'loc.id = pr.lid', 'left');  
        $this->db->join('sports as sp', 'sp.id = pr.sid', 'left');  
        if($data['id'] != ''){
            $this->db->where('pr.id', $data['id'] );
        }
        $this->db->where('pr.delete_status !=', 1);
        $this->db->order_by('pr.id','DESC');
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();

            return $row;
        }else{
            return false;
        }
    }
    
    public function check_courtExist($data){

        $this->db->select('pr.id');
        $this->db->from('pricing as pr');
       // $this->db->join('court as ct', 'ct.id = pr.cid', 'left');  
        if($data['cid'] != ''){
            $this->db->where('pr.cid', $data['cid'] );
        }        
        if($data['id'] != ''){
            $this->db->where('pr.id !=', $data['id'] );
        }
        
        if($data['day_type'] != ''){
            if($data['day_type'] == '0' || $data['day_type'] == '1')
            {
                 $to_day = ($data['today'] !='') ? $data['today'] : $data['fromday'] ;
                 $where = "( ( pr.fromday <= '".$to_day."' AND pr.today >= '".$data['fromday']."' ) OR ( pr.fromday='".$data['fromday']."' AND  pr.today='".$data['today']."' ) )";
                 $this->db->where($where);
                 $this->db->where('pr.day_type !=', 2);
            }else{
                //$where = " pr.holiday_id='".$data['holidays']."' ";
                $this->db->where('pr.holiday_id', $data['holidays']);
                $this->db->where('pr.day_type', 2);
            }            
        }
        $this->db->where('pr.delete_status !=', 1);
        $query = $this->db->get();
        return $query->num_rows();
       
    }
    
    public function get_pricing_details($id){

        $this->db->select('pr.*, ct.courtname, ct.from_time, ct.to_time');
        $this->db->from('pricing as pr');
        $this->db->join('court as ct', 'ct.id = pr.cid', 'left');
        if($id != ''){
            $this->db->where('pr.id', $id );
        }
        $this->db->where('pr.delete_status !=', 1);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_pricingslot_details($id){

        $this->db->select('id, fromtime, totime, cost');
        $this->db->from('pricingslot');
        if($id != ''){
            $this->db->where('pid', $id );
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
    
    public function get_sportslist(){
        $this->db->from('sports');
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }

    public function get_courtlist($data){
        $this->db->from('court');  
        if($data['sports_id'] != ''){
            $this->db->where('sid', $data['sports_id'] );
        }
        if($data['location_id'] != ''){
            $this->db->where('lid', $data['location_id'] );
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_courtdetails($data){
        $this->db->from('court');  
        if($data['id'] != ''){
            $this->db->where('id', $data['id'] );
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function delete_pricing_slot($slotids, $pid){
        //$slotids = join("','",$slotids);
        $this->db->where_not_in('id', $slotids);
        $this->db->where('pid', $pid);        
        $this->db->delete('pricingslot');
    }

    public function get_holidayslist(){
        $this->db->select(" id, DATE_FORMAT(holidaydate,'%d-%m-%Y') as holidaydate", FALSE);
        $this->db->from('holidays');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_holidayDate($id){
        $this->db->select(" DATE_FORMAT(holidaydate,'%d-%m-%Y') as holidaydate", FALSE);
        $this->db->from('holidays');
        if($id != ''){
            $this->db->where('id', $id );
        }
        //$this->db->order_by('id','ASC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }else{
            return false;
        }
    }

    public function get_locationlist($data){
        $this->db->select('loc.location, loc.id as location_id');
        $this->db->from('court as ct');  
        $this->db->join('location_booking as loc', 'loc.id = ct.lid', 'left');  
        if($data['sports_id'] != ''){
            $this->db->where('ct.sid', $data['sports_id'] );
        }
        $this->db->group_by('ct.lid');
        $this->db->order_by('ct.id','DESC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_daylist(){

        $this->db->select('*');
        $this->db->from('dayname_list');
        $this->db->order_by('dayid','ASC');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    
    public function get_dayname($id){

        $this->db->select('*');
        $this->db->from('dayname_list');
        if($id != ''){
            $this->db->where('dayid', $id);
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