<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Booking_reports extends CI_Controller {  
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_slot_model');
		//$this->load->model('Booking_reports_model');
	}
	public function index()
	{
		//$this->load->view('includes/booking_header');
		//$user_id = $_SESSION['id'];
		$user_id = $this->session->userdata('id');
		$data['getWalletAmount'] = $this->Booking_slot_model->getWalletAmount($user_id);
		$this->load->view('includes/header3',$data);
		$this->load->view('booking_reports_view',$data);
	}
	
	public function ajax_reports()
	{
		$postdata = $this->input->post();
		
		if($postdata['hist'] == "transaction")
		{
		
        //$customer_id = $_SESSION['id'];
		$customer_id = $this->session->userdata('id');

        $from_date = ($postdata['from_date'])?$postdata['from_date'] : "";
		
        $to_date = ($postdata['to_date'])?$postdata['to_date'] : "";
		
		$from_date1 = ($from_date != "") ? $this->change_date_format($from_date): "";
		$to_date1 = ($to_date != "") ? $this->change_date_format($to_date): "";
		
		
		$output ='';
		$query  = "SELECT bs.fromdate,
						   bs.todate,
						   bs.booking_fromtime,
						   bs.booking_totime,
						   dl.dayname,
						   bok.id,
						   bok.booking_no,
						   bok.bookedon,
						   bok.btype,
						   bok.totamt,
						   bok.net_total,
						   bok.paidamt,
						   bok.discount_amount,
						   spo.sportsname,
						   loc.location,
						   cus.user_name,
						   cus.mobile,
						   cus.email
					FROM   booking AS bok
						   LEFT JOIN bookingslot AS bs
								  ON bs.bid = bok.id
						   LEFT JOIN sports AS spo
								  ON spo.id = bs.sid
						   LEFT JOIN location_booking AS loc
								  ON loc.id = bs.lid
						   LEFT JOIN users AS cus
								  ON cus.user_id = bok.customerid
						   LEFT JOIN dayname_list AS dl
								  ON dl.dayid = bs.days";
		
		
		                if($to_date1 !== "" && $from_date1 !== "")
						{
							
							$query  .=" where bs.fromdate >= '$from_date1' and bs.todate <= '$to_date1' and cus.user_id='".$customer_id."'";
						
						}
						else if($from_date1 !== "")
						{
							
							$query  .=" where  bs.fromdate = '$from_date1'  and cus.user_id='".$customer_id."'"; 
							
											
						}
						if($to_date1 == "" && $from_date1 == "")
						{
							$query  .=" where  cus.user_id='".$customer_id."'"; 
						}
		$sql_query = $this->db->query($query);	

		//print_r($sql_query);die;		
		//echo $this->db->lastquery();die;			

		
		if($sql_query->num_rows()> 0)
		{
			
			$result_array =  $sql_query->result_array();
			
			foreach($result_array as $row)
			{
				$booking_date = date("d-m-Y", strtotime($row['bookedon']));

				if($row['btype'] ==1)
				{
					$booking_type = "Regular";
				}else{
					$booking_type = "Bulk";
				}

				$output .= "<tr>";
				$output .= "<td>". ++$key ."</td>";
				if($booking_type == "Regular")
				{
					$reg_date = date("d-m-Y", strtotime($row['fromdate']));
					$output .= "<td>". $reg_date ."</td>";
					$output .= "<td>". $row['dayname'] ."</td>";
				}
				if($booking_type == "Bulk")
				{
					$bulk_from_date = date("d-m-Y", strtotime($row['fromdate']));
					$bulk_to_date = date("d-m-Y", strtotime($row['todate']));

					$output .= "<td>". $bulk_from_date ."</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </br>". $bulk_to_date ."</td>";

					$output .= "<td>". $row['dayname'] ."</td>";
				}
				$date = new DateTime($row['booking_fromtime']);
				$booking_fromtime = $date->format('h:i a') ;

				$date1 = new DateTime($row['booking_totime']);
				$booking_totime = $date1->format('h:i a') ;

				$output .= "<td>". $booking_fromtime ."</td>";
				$output .= "<td>". $booking_totime ."</td>";
				$output .= "<td>". $row['location'] ."</td>";

				$output .= "<td>". $booking_type ."</td>";
				$output .= "<td>". $row['booking_no'] ."</td>";
				$output .= "<td>". $row['sportsname'] ."</td>";
				$output .= "<td>". $row['user_name'] ."</td>";
				$output .= "<td>". $row['mobile'] ."</td>";
				$output .= "</tr>";
					
			}
			echo $output;
		}

		}
	}
	
	public function booking_ajax_reports()
	{
		$postdata = $this->input->post();
		if($postdata['hist'] == "booking")
		{
			//$customer_id = $_SESSION['id'];
			$customer_id = $this->session->userdata('id');
			$from_date = ($postdata['from_date'])?$postdata['from_date'] : "";
			$to_date = ($postdata['to_date'])?$postdata['to_date'] : "";

			$from_date1 = ($from_date != "") ? $this->change_date_format($from_date): "";
			$to_date1 = ($to_date != "") ? $this->change_date_format($to_date): "";

		
			$output ='';
			$query  = "SELECT bs.fromdate,
					   bs.todate,
					   bs.booking_fromtime,
					   bs.booking_totime,
					   dl.dayname,
					   bok.id,
					   bok.booking_no,
					   bok.bookedon,
					   bok.btype,
					   bok.totamt,
					   bok.net_total,
					   bok.paidamt,
					   bok.discount_amount,
					   spo.sportsname,
					   loc.location,
					   cus.user_name,
					   cus.mobile,
					   cus.email
					FROM   booking AS bok
					   LEFT JOIN bookingslot AS bs
							  ON bs.bid = bok.id
					   LEFT JOIN sports AS spo
							  ON spo.id = bs.sid
					   LEFT JOIN location_booking AS loc
							  ON loc.id = bs.lid
					   LEFT JOIN users AS cus
							  ON cus.user_id = bok.customerid
					   LEFT JOIN dayname_list AS dl
							  ON dl.dayid = bs.days";

		                if($to_date1 !== "" && $from_date1 !== "")
						{
							
							$query  .=" where bs.fromdate >= '$from_date1' and bs.todate <= '$to_date1' and bok.bstatus = 1 and cus.user_id='".$customer_id."'";
						
						}
						else if($from_date1 !== "")
						{
							
							$query  .=" where  bs.fromdate = '$from_date1' and bok.bstatus = 1 and cus.user_id='".$customer_id."'"; 
							
											
						}
						if($to_date1 == "" && $from_date1 == "")
						{
							$query  .=" where bok.bstatus = 1 and cus.user_id='".$customer_id."'"; 
						}
		
		$sql_query = $this->db->query($query);				
		
		if($sql_query->num_rows()> 0)
		{
			
			$result_array =  $sql_query->result_array();
			
			foreach($result_array as $row)
			{
				$output .= "<tr>";
				$output .= "<td>". ++$key ."</td>";
				if($row['btype'] == 1)
				{
				$booking_type = "Regular";
				$reg_date = date("d-m-Y", strtotime($row['fromdate']));
				$output .= "<td>". $reg_date ."</td>";
				$output .= "<td>". $row['dayname'] ."</td>";
				}
				else
				{
				$booking_type = "Bulk";
				$bulk_from_date = date("d-m-Y", strtotime($row['fromdate']));
				$bulk_to_date = date("d-m-Y", strtotime($row['todate']));

				$output .= "<td>". $bulk_from_date ."</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </br>". $bulk_to_date ."</td>";

				$output .= "<td>". $row['dayname'] ."</td>";
				}

				$date = new DateTime($row['booking_fromtime']);
				$booking_fromtime = $date->format('h:i a') ;

				$date1 = new DateTime($row['booking_totime']);
				$booking_totime = $date1->format('h:i a') ;

				$output .= "<td>". $booking_fromtime ."</td>";
				$output .= "<td>". $booking_totime ."</td>";
				$output .= "<td>". $row['booking_no'] ."</td>";
				$output .= "<td>". $row['location'] ."</td>";
				$output .= "<td>". $row['sportsname'] ."</td>";
				$output .= "<td>". $booking_type ."</td>";
				$output .= "<td>". $row['totamt'] ."</td>";
				$output .= "<td>". $row['discount_amount'] ."</td>";
				$output .= "<td>". $row['net_total'] ."</td>";
				$output .= "<td>". $row['paidamt'] ."</td>";
				$output .= "<td>". $row['user_name'] ."</td>";
				$output .= "<td>". $row['mobile'] ."</td>";
				$output .= "</tr>";
			}
		}		
		echo $output;
		}
	}
	
	public function cancellation_ajax_reports()
	{
		$postdata = $this->input->post();
		if($_POST['hist'] == "cancellation")
		{
		
	
        //$customer_id = $_SESSION['id'];
		$customer_id = $this->session->userdata('id');

        $from_date = ($_POST['from_date'])?$_POST['from_date'] : "";
		
        $to_date = ($_POST['to_date'])?$_POST['to_date'] : "";
		
		
		$from_date1 = ($from_date != "") ? $this->change_date_format($from_date): "";
		$to_date1 = ($to_date != "") ? $this->change_date_format($to_date): "";
		
		
		$query  = "select bok.booking_no,bok.cancelled_on,bok.btype,bok.totamt,bok.net_total,bok.paidamt,bok.discount_amount,spo.sportsname,loc.location,cus.user_name,cus.mobile,cus.email from booking as bok LEFT JOIN bookingslot as bs ON bs.bid=bok.id LEFT JOIN sports as spo ON spo.id = bs.sid LEFT JOIN location_booking as loc ON loc.id = bs.lid  LEFT JOIN users as cus ON cus.user_id = bok.customerid";
		
		if($to_date1 !== "" && $from_date1 !== "")
		{
			
			$query  .=" where bok.cancelled_on >= '$from_date1' and bok.cancelled_on <= '$to_date1' and bok.bstatus = 2 and cus.user_id='".$customer_id."'"; 
		
		}
		else if($from_date1 !== "")
		{
			
			$query  .=" where bok.cancelled_on = '$from_date1' and bok.bstatus = 2 and cus.user_id='".$customer_id."'"; 
			
							
		}
		
		if($to_date1 == "" && $from_date1 == "")
		{
			$query  .=" where bok.bstatus = 2 and cus.user_id='".$customer_id."'"; 
		}
		//echo $query;exit;
		
		
		$sql_query = $this->db->query($query);				
		
		if($sql_query->num_rows()> 0)
		{
			
			$result_array =  $sql_query->result_array();
			
			foreach($result_array as $row)
			{	
				$cancellation_date = date("d-m-Y", strtotime($row['cancelled_on']));

				if($row['btype'] ==1)
				{
				$booking_type = "Regular";
				}else{
				$booking_type = "Bulk";
				}


				$output .= "<tr>";
				$output .= "<td>". ++$key ."</td>";

				$output .= "<td>". $cancellation_date ."</td>";
				$output .= "<td>". $booking_type ."</td>";
				$output .= "<td>". $row['booking_no'] ."</td>";
				$output .= "<td>". $row['paidamt'] ."</td>";
				$output .= "<td>". $row['sportsname'] ."</td>";
				$output .= "<td>". $row['user_name'] ."</td>";
				$output .= "<td>". $row['mobile'] ."</td>";
				$output .= "</tr>";
			}
			echo $output;	
		}		
		}
	}
	
	public function change_date_format($origal_date){
		$newDate = date("Y-m-d", strtotime($origal_date));
		return $newDate;
	}
	
	

   

}