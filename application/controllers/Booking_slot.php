<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Booking_slot extends CI_Controller {  
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_slot_model');
	}
	public function index()
	{
		//$this->load->view('includes/booking_header');
		$data['sportslist'] = $this->Booking_slot_model->getSportsList();
		$data['getLocationList'] = $this->Booking_slot_model->getLocationList();
		
		//$user_id = $_SESSION['id'];
		$user_id = $this->session->userdata('id');
		$data['getCustomerDeductableAmount'] = $this->Booking_slot_model->getCustomerDeductableAmount($user_id);
		
		$data['getWalletAmount'] = $this->Booking_slot_model->getWalletAmount($user_id);
		$this->load->view('includes/header3',$data);
		$this->load->view('booking_slot_view',$data);
	}
	
	public function ajax_getlocation()
	{
		$postdata = $this->input->post();
		$crtldata =  $this->Booking_slot_model->ajax_getlocation($postdata);
		$output = '';
		foreach($crtldata as $key=>$values)
		{
			 $output .='<option value="'.$values['location_id'].'">'.$values['location'].'</option>';
		}
		echo $output;
	}
	
	public function show_booking_slot()
	{
		$postdata = $this->input->post();
		$get_details =  $this->Booking_slot_model->show_booking_slot($postdata);
					
		if($get_details)
        {
			$distMatrix = array();
			$new_array = $this->array_group_by($get_details, 'courtname' );
				
			$time_slot_set = array();
			foreach($get_details as $key => $value) { 
				$from_time = strtotime($value['from_time']);
				$to_time = strtotime($value['to_time']);
				$time_diff = $to_time - $from_time;
				$postive =  ($time_diff / 600) / 6 ;
			   
				for($i = 1 ; $i <= $postive ; $i++ ){                
					$timestamp = $from_time + ( 60*60) ;
					$time = date('h:i A', $timestamp);
					$new_fromtime = $time;
				   
					$time_slot_set[] = array(
						'from_time' => $from_time,
						'to_time' => strtotime($new_fromtime)
					 );
					$from_time = strtotime($new_fromtime);
					
				}            
			}
			sort($time_slot_set);
			$time_slot_set = array_map("unserialize", array_unique(array_map("serialize", $time_slot_set)));

			$new_output = '<tr>';
			$new_output .='<th>Time slot</th>';
			foreach($new_array as $key => $courtnames) { 
				$new_output .= '<th>'.ucfirst($key).'</th>';
			}
		
			$new_output .= '</tr>';

			foreach($time_slot_set as $i => $value) { 
				$new_output .= '<tr>';
				$new_output .='<td>'.date('h:i A', $value['from_time']).'-'.date('h:i A', $value['to_time']).'</td>'; // city_a ad
				foreach($new_array as $key => $courtnames) { // city_b headings
					$book_date = $postdata['book_date'];
					$new_date = date('Y-m-d', strtotime($book_date));
					$holiday_id = $this->Booking_slot_model->get_holidayid($new_date);
			  
					$new_output .= "<td>".$this->check_timeslot_exist($i.'_'.$key.'_'.strtotime($book_date),$courtnames,date('H:i:s', $value['from_time']), date('H:i:s', $value['to_time']), $book_date, $holiday_id)."</td>";
				}
				$new_output .='</tr>';
			}
        }
		else
		{
            $new_output = '<tr><td colspan="3"><span>No slots available for the selected day!</span></td></tr>';
        }
		echo $new_output;
	}
	
	
	public function check_timeslot_exist($i,$courtnames, $fromtime, $totime, $date, $holiday_id) { 
        $cid = '';
        foreach($courtnames as $k => $court){
            $cid = $court['cid'];
        }
        $day_name = date('l', strtotime($date));
        $day_id = $this->Booking_slot_model->get_dayid($day_name);
        $check = $this->Booking_slot_model->check_timeslot_exist_query($cid, $fromtime, $totime, $day_id, $holiday_id); 
        $pstid = '';
        $hid = '';
        if($check){
           $check_booked_slot =  $this->Booking_slot_model->check_bookedslot_exist($cid, $fromtime, $totime, $date, $day_id);
           if($check_booked_slot){    
				$blocked_status_class = ($check_booked_slot['blocked_status'] == '0' && $check_booked_slot['booked_by'] != '0') ? 'btn-warning' : 'btn-danger' ;
				$blocked_status= ($check_booked_slot['blocked_status'] == '0' ) ? 'Blocked' : 'Booked' ;
				$value = "<button type='button' data-toggle='modal' class='btn $blocked_status_class'>$blocked_status</button>";                
           }else{  
                $new_date1 = strtotime(date('Y-m-d H:i:s'));
                $new_date2 = strtotime($date.' '.$fromtime);
                  if($new_date1 < $new_date2){                    
                    $i = str_replace(' ','',$i);
                    $cookie = ( isset($_COOKIE[$i]) == 'booking_cookie' ) ? 'btn-info' : 'btn-success'; 
					 
                    if(count($check) > 1){
                        $new_array = $this->search_in_array($holiday_id, $check);
					
                        foreach($new_array as $ck => $chk){
                            $pstid = $chk['id'];
                            $hid = $chk['holiday_id'];
                        }
                                                
                        $value = "<button type='button' id='$i' data-id='".$pstid."' data-holiday_id='".$hid."' data-arraykey='".$i."' data-fromtime='".$fromtime."' data-totime='".$totime."' class='btn booking-timeslot $cookie '>Book</button>"; 
                    }else{
					
                        $value = "<button type='button' id='$i' data-id='".$check[0]['id']."' data-holiday_id='".$check[0]['holiday_id']."' data-arraykey='".$i."' data-fromtime='".$fromtime."' data-totime='".$totime."' class='btn booking-timeslot $cookie'>Book</button>";  
                    }
                }
                else{
                    $value = "<button type='button' class='btn btn-success disabled'>Book</button>";
                }
			}
		}
		else
		{
            $value = "--";
        }
        return $value;
	}

	public function array_group_by($array, $key) {
		$return = array();
		foreach($array as $i => $val) {
			$return[$val[$key]][] = $val;
		}
		return $return;
	}
 
	public function search_in_array($holiday, $array) {

		foreach($array as $key => $value) {
			if ($value['holiday_id'] != $holidayid) {
				unset($array[$key]);
			}
		}
		return $array;
	}
	
	public function ajax_booking()
	{
		$postdata = $this->input->post();
		$crtldata = $this->Booking_slot_model->ajax_booking($postdata);
	}
	
	public function ajax_wallet()
	{
		$postdata = $this->input->post();
		
		//$user_id = $_SESSION['id'];
		$user_id = $this->session->userdata('id');
		$crtldata = $this->Booking_slot_model->ajax_wallet($user_id);
		if($crtldata)
		{
			$amount = $crtldata['amount'];
		}
		echo $amount;
	}
	
	public function getGross_ajax_wallet()
	{
		$postdata = $this->input->post();
		//$customer_id = $_SESSION['user_id'];
		$customer_id = $this->session->userdata('id');
		$net_amount = array_sum(array_column($_SESSION['cart'], 'hidden_cost')); 
		echo $net_amount;		
	}
	
	public function booking_submit()
	{
		$postdata = $this->input->post();
		
		if($postdata)
		{
			//$customer_id = $_SESSION['id'];
			$customer_id = $this->session->userdata('id');
			$cid = $postdata['cid'];
			$btype = 1;
			$bstatus = 1;
			$booked_on = date('Y-m-d');
			$payment_mode = 1;
			$remarks = '';
			$paystatus = 1;
			$hidden_net_amount = $postdata['hidden_net_amount'];
			$hidden_total_price = $postdata['hidden_total_price'];
			$hidden_gross_amount = $postdata['hidden_gross_amount'];
			
			$query = "INSERT INTO booking(booking_no, customerid, btype, bstatus, bookedon, cancelled_on, paymode, Remarks, paystatus, net_total, discount_amount, advance_amount, totamt, paidamt, balamt, booked_by, blocked_status, reject_reason) ";
			$query .= " VALUES('NULL', '$customer_id', '$btype', '$bstatus', '$booked_on', '0000-00-00', '$payment_mode', '$remarks', '$paystatus', '$hidden_net_amount', '0', '0', '$hidden_total_price', '0', '$hidden_total_price', '$customer_id', '0', 'NULL')";
	

			if (!$this->db->query($query)) {
				echo "FALSE";
			}
			else {
				$this->db->query($query);
				$insert_id = $this->db->insert_id();
				
				
        if($insert_id !=''){
            $length = $this->count_digit($insert_id);
            $booking_no = $this->create_booking_no($insert_id, $length);
            $wallet_amount = $_POST['wallet_amount'];
            $booking_date = $_POST['booking_date'];

            $upd_query = "UPDATE booking SET booking_no='$booking_no' where id='$insert_id'";
			
			
            $update = $this->db->query($upd_query);
            
            /*** Data to be insert in bookingslot table ***/
            $sql_query = "INSERT INTO bookingslot(bid, sid, lid, courtid, fromdate, todate, days, booking_fromtime, booking_totime, amount) VALUES ";
            $hidden_balance_amount = $_POST['hidden_balance_amount'];
            for($i=0; $i < count($_POST['hidden_id']); $i++){
                $sid = $_POST['hidden_sid'][$i];
                $lid = $_POST['hidden_lid'][$i];
                $court_id = $_POST['hidden_cid'][$i];
                $from_date = date('Y-m-d', strtotime($_POST['hidden_booking_date'][$i]));
                $from_time = $_POST['hidden_fromtime'][$i];
                $to_time = $_POST['hidden_totime'][$i];
                $get_day_id = $this->Booking_slot_model->get_dayid(date('l', strtotime($_POST['hidden_booking_date'][$i])));
			
				
				$dayid = $get_day_id['dayid'];
                $amount = $_POST['hidden_cost'][$i];
                $sql_query .= " ('$insert_id', '$sid', '$lid', '$court_id', '$from_date', '$from_date', '$dayid', '$from_time', '$to_time', '$amount'),";
            }
            $sql= $this->removeLastString($sql_query);
			$insert_slot = $this->db->query($sql);
			$insert_id_1 = $this->db->insert_id();
             /*** Data to be insert in bookingslot table ***/
            unset($_SESSION['cart']);
           // send_email($insert_id, $customer_id, $conn);
            $messages = 'Thank you for booking. Confirmation email will be sent to your registered email address.';
			
			$this->session->set_flashdata('messages', 'Thank you for booking. Confirmation email will be sent to your registered email address.');
			redirect("Booking_slot");
            //FlashMessages::add($messages);
            //header('Location:booking_slot.php');
        }
		
			}
		}
	}
	
	
	public function count_digit($number) {
		return strlen((string) $number);
	}
	
	public function create_booking_no($id, $length) {
    if($length == '1'){
        $value = 'BKNO-000'.$id;
    }
    elseif($length == '2'){
        $value = 'BKNO-00'.$id;
    }
    elseif($length == '3'){
        $value = 'BKNO-0'.$id;
    }
    elseif($length > 3 ){
        $value = 'BKNO-'.$id;
    }
    return $value;
}	

function removeLastString($string){
    return substr($string, 0, -1);
}

   

}