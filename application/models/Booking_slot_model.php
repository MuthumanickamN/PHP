<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Booking_slot_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function getSportsList(){
		$sql = "select * from sports where status='1' order by id desc";
		
		$query = $this->db->query($sql);
		//print_r($query);die;
		if(!empty($query->num_rows()))
		{
			return $query->result_array();
		}	
		
		
    }
	
	public function ajax_getlocation($postdata)
	{
		$sql = "select loc.location, loc.id as location_id from court as ct LEFT JOIN location_booking as loc ON loc.id = ct.lid where ct.sid='".$postdata['sid']."' AND loc.status='1' GROUP BY ct.lid ORDER BY ct.id DESC ";
		
		$query = $this->db->query($sql);
		
		if(!empty($query->num_rows()))
		{
			return $query->result_array();
		}
		
	}
	
	public function getLocationList(){
        
        $sql = "select * from location_booking where status='1' order by id desc ";
		
        $query = $this->db->query($sql);
		
		if(!empty($query->num_rows()))
		{
			return $query->result_array();
		}
       
    }
	
	 public function getCustomerDeductableAmount($user_id){
        
        $sql = "select SUM(totamt) as total_deductable_amount from booking WHERE customerid='$user_id' AND bstatus!='2' AND blocked_status='0' AND booked_by=".$user_id."";   


		$query = $this->db->query($sql);
		
		if(!empty($query->num_rows()))
		{
			return $query->row_array();
		}
    }
	
	public function getWalletAmount($user_id){
        
      
        if($user_id !=''){
           $sql ="select amount from wallet WHERE custid='$user_id'"; 
        }
		else
		{
			$sql = "select amount from wallet";
		}	
        
		$query = $this->db->query($sql);
		//print_r($query);die;
		if(!empty($query->num_rows()))
		{
			return $query->row_array();
		}
		
        
    }
	
	public function ajax_wallet($user_id){
        
      
        if($user_id !=''){
           $sql ="select amount from wallet WHERE custid='$user_id'"; 
        }
		else
		{
			$sql = "select amount from wallet";
		}	
     
		$query = $this->db->query($sql);
		
		if(!empty($query->num_rows()))
		{
			return $query->row_array();
		}
		
        
    }

	
	
	public function show_booking_slot($postdata)
	{
		if( ($postdata['sports'] != '') && ($postdata['location'] !='') && ($postdata['book_date'] !='') ){
			
		
		$sid = $postdata['sports'];
		$lid = $postdata['location'];

		$data = array(
			'sid' =>  $sid,
			'lid' =>  $lid
		);

		
		if($data['sid'] != ''){
			$append_query_1 = "AND pr.sid='".$data['sid']."' ";
		}

		if($data['lid'] != ''){
			$append_query_2 = "AND pr.lid='".$data['lid']."' ";
		} 


		$sql = "SELECT pr.id, pr.cid, ct.courtname, ct.from_time, ct.to_time FROM pricing as pr LEFT JOIN court as ct ON ct.id = pr.cid WHERE pr.delete_status !='1' ".$append_query_1." ".$append_query_1." ORDER BY pr.id ASC";

		$query = $this->db->query($sql);
		//print_r($query);die;
			if(!empty($query->num_rows()))
			{
				return $query->result_array();
			}
		}	
	}
	
	public function get_holidayid($date)
	{
		$sql = "select id from holidays where holidaydate='".$date."'";

		$query = $this->db->query($sql);

		if(!empty($query->num_rows()))
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}
		
	}
	
	public function get_dayid($day_name){
    $sql = "select dayid from dayname_list where dayname='$day_name'";
    $query = $this->db->query($sql);

		if(!empty($query->num_rows()))
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}	
	} 

	
	public function check_timeslot_exist_query($cid, $from_time, $to_time,  $day_id, $holiday_id ){
    $query = "select pst.id, pr.holiday_id from pricingslot as pst LEFT JOIN pricing as pr ON pr.id = pst.pid where pr.delete_status !='1' ";
  
  
	$day_id = $day_id['dayid'];

    if($cid != ''){
        $query .= " AND pr.cid='$cid' ";
    }
    if($from_time != ''){
        $query .= " AND pst.fromtime <= '$from_time' ";
    }
    if($to_time != ''){
        $query .= " AND pst.totime >= '$to_time' ";
    }

    $query .= " AND ( CASE WHEN pr.day_type='1' THEN pr.fromday <= '$day_id' AND pr.today >= '$day_id' WHEN pr.day_type='0' THEN pr.fromday = '$day_id' ELSE pr.holiday_id = '$holiday_id' END )";


		$sql = $this->db->query($query);

		if(!empty($sql->num_rows()))
		{
			return $sql->result_array();
		}
	}
	
	public function check_bookedslot_exist($cid,$from_time, $to_time, $date, $day_id)
	{
		$day_id = $day_id['dayid'];
		$query = "select bst.id, bst.bid, bk.btype, bk.blocked_status, bk.booked_by, cust.name as customer_name from bookingslot as bst LEFT JOIN booking as bk ON bk.id = bst.bid LEFT JOIN customer as cust ON cust.id = bk.customerid where bst.courtid='".$cid."' AND bst.booking_fromtime <= '$from_time' AND bst.booking_totime >='$to_time' AND bst.fromdate <= '".date('Y-m-d',strtotime($date))."' AND bst.todate >= '".date('Y-m-d',strtotime($date))."' AND bst.days='".$day_id."' AND bk.bstatus='1' AND bk.blocked_status !='2' ";
	
		$sql = $this->db->query($query);

		if(!empty($sql->num_rows()))
		{
			return $sql->row_array();
		}
	}
	
	
	public function ajax_booking($postdata)
	{
		
	$_POST = $postdata;
	
	if( ($_POST['show_booking'] == '') && ($_POST['get_courtlist'] =='') && ($_POST['booking_summary'] !='') ){
    $data = array();
    $data['id'] = ($_POST['id'] !='') ? $_POST['id']  : '';
    $data['fromtime'] = ($_POST['fromtime']  !='') ? $_POST['fromtime'] : '';
    $data['totime'] = ($_POST['totime'] !='') ? $_POST['totime'] : ''; 
    $data['booking_date'] = ($_POST['booking_date'] !='') ? $_POST['booking_date'] : '';
    $data['ckbx_id'] = ($_POST['ckbx_id'] !='') ? $_POST['ckbx_id']  : '';
    //$data['li_id'] = ($_POST['li_id'] !='') ? $_POST['li_id']  : '';
    $data['arraykey'] = ($_POST['arraykey'] !='') ? $_POST['arraykey']  : '';
    $data['id_array'] = ($_POST['id_array'] !='') ? $_POST['id_array']  : '';
    
	
	
    $query = "select pst.id, pst.pid, ct.courtname, pr.cid, pr.sid, pr.lid, sp.sportsname, pst.fromtime, pst.totime, pst.cost, loc.location as location_name from pricing as pr LEFT JOIN court as ct ON ct.id = pr.cid LEFT JOIN sports as sp ON sp.id = pr.sid LEFT JOIN location_booking as loc ON loc.id = pr.lid LEFT JOIN pricingslot as pst ON pst.pid = pr.id where pst.id='".$data['id']."' AND pr.delete_status !='1' ORDER BY pr.id DESC ";
   
	$sql = $this->db->query($query);

	if(!empty($sql->num_rows()))
	{
		$get_details = $sql->result_array();
	}
		


   
    //$_SESSION['json'] = (isset($_POST['json'])) ? $_POST['json'] : '';
    
    $output ='';
    if(isset($_SESSION['cart'])){
       $cart =  $_SESSION['cart'];
    }else{
       $cart = array();  
    }
     
    
    if($get_details){  
            $i=0;
            foreach($get_details as $key => $get_list)
            {

                $output .= "<tr>";
                $output .= "<td><input type='hidden' name='hidden_id[]' id='hidden_id' value='".$get_list['id']."'>". ucfirst($get_list['sportsname']);
                $output .= "<input type='hidden' name='hidden_fromtime[]' id='hidden_fromtime' value='".date('H:i:s', strtotime($data['fromtime']))."'>";
                $output .= "<input type='hidden' name='hidden_totime[]' id='hidden_totime' value='".date('H:i:s', strtotime($data['totime']))."'>";
                $output .= "<input type='hidden' name='hidden_sid[]' id='hidden_sid' value='".$get_list['sid']."'>";
                $output .= "<input type='hidden' name='hidden_lid[]' id='hidden_lid' value='".$get_list['lid']."'>";
                $output .= "<input type='hidden' name='hidden_cid[]' id='hidden_cid' value='".$get_list['cid']."'></td>";
                $output .= "<td><input type='hidden' name='hidden_booking_date[]' id='hidden_booking_date' value='".$data['booking_date']."'>".$data['booking_date']."</td>";
                $output .= "<td>".date('h:i A', strtotime($data['fromtime'])).'-'.date('h:i A', strtotime($data['totime']))."</td>";
                $output .= "<td>".ucfirst($get_list['location_name']) ."</td>";
                $output .= "<td>".ucfirst($get_list['courtname']) ."</td>";
                $output .= "<td><input type='hidden' class='hidden_price' name='hidden_cost[]' id='hidden_cost' value='".$get_list['cost']."'>". $get_list['cost'] ."</td>";
                $output .= "<td class='text-center'><button type='button' title='Remove' data-id='".$get_list['id']."' data-ckbxid='".$data['ckbx_id']."' data-arraykey='".$data['arraykey']."' data-idarray='".$data['id_array']."' class='btn btn-danger btn-xs rmve_btn'><i class='glyphicon glyphicon-trash'></i></button></td>";
                $output .= "</tr>";
                
                 $cart[] = array(
                    'hidden_id' => $get_list['id'],
                    'sportsname' => ucfirst($get_list['sportsname']),
                    'from_time' => $data['fromtime'],
                    'to_time' => $data['totime'],
                    'hidden_sid' => $get_list['sid'],
                    'hidden_lid' => $get_list['lid'],
                    'hidden_cid' => $get_list['cid'],
                    'hidden_booking_date' => $data['booking_date'],
                    'hidden_cost' => $get_list['cost'],
                    'ckbxid' => $data['ckbx_id'],
                    'location_name' => ucfirst($get_list['location_name']),
                    'courtname' => ucfirst($get_list['courtname']),
                    'arraykey' => $data['arraykey'],
                    'id_array' => $data['id_array']
                ); 
            }    
            $_SESSION['cart'] = $cart;
           //echo $_SESSION['cart'];            
    }
    echo $output;
    //echo $_SESSION['cart'];
}
	}
	/*
	 public function getWalletAmount($id){
        
        $query = "SELECT u.*,w.* FROM users as u left join wallet as w 
					on w.custid = u.user_id";
        if($id !=''){
           $query .=" WHERE u.user_id='$id'"; 
        }
		
		$sql = $this->db->query($query);

		if(!empty($sql->num_rows()))
		{
			$return = $sql->result_array();
		}
		else
		{
			return 0;
		}	

    }
	*/
	



	


	

	
	
	
	
}
