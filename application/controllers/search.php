<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
           if(!$this->session->userdata('id')){
            redirect('logout');
           }
       $this->load->model('search_model');
    }

	
    public function index(){
		
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('search');
        //$this->load->view('templates/footer');

	}
	
	public function get_records(){
		
		$customer_email = ($this->input->post('customer_email') != '') ? $this->input->post('customer_email'):"";
		$get_details = $this->search_model->get_records($customer_email);
		echo json_encode($get_details);
	}
	
	public function get_cus_id(){
		$mobile_booking_id = ($this->input->post('mobile_booking_id') != '') ? $this->input->post('mobile_booking_id'):"";
        $get_details = $this->search_model->get_cus_id($mobile_booking_id);
		echo json_encode($get_details);
	}
	
	public function get_booking_details(){
		$cus_id = ($this->input->post('cus_id') != '') ? $this->input->post('cus_id'):"";
		$search_value = ($this->input->post('search_value') != '') ? $this->input->post('search_value'):"";
		
        $get_details = $this->search_model->get_booking_details($cus_id,$search_value);
		$output ='';
        if($get_details){
                foreach($get_details as $key => $get_list)
                {
//                    switch($get_list['btype'])
//                    {
//                            case "1":
//                            $booking_status = "Booked";
//                            break;
//
//                            case "2":
//                            $booking_status = "Cancelled";
//                            break;
//                    }
                    $booking_status = ($get_list['bstatus'] == '1') ? 'Booked' : 'Cancelled';
                         $output .= "<tr>";
                         $output .= "<td>". ++$key ."</td>";
                         $output .= "<td>". $get_list['booking_no'] ."</td>";
						 $output .= "<td>". $booking_status ."</td>";
						 $output .= "<td><a href='#' title='View' class='btn btn-primary btn-xs view' data-id='". $get_list['id'] ."' data-toggle='modal' ><i class='fa fa-eye' aria-hidden='true'></i></a></td>";
                         $output .= "</tr>";
                }
        }
        else{
            
            $output .= "<tr><td colspan='8' align='center'>No Record Found!</td></tr>";
          }
        echo $output;
	}
	
	
	public function get_view_details(){
		
		$booking_id = ($this->input->post('booking_id')!="")? $this->input->post('booking_id'):"";
		$get_view_details = $this->search_model->get_view_details($booking_id);
		$output="";
		$output .='<table class="table table-bordered table-striped" id="view_table">
	<tbody>';
		$arr_count = count($get_view_details);
		
		//print_r($get_view_details);exit;
		if($get_view_details)
		{
			
			$i = 1;
			foreach($get_view_details  as $key => $get_list)
			{
				$bookedon_date = date("d-m-Y", strtotime($get_list['bookedon']));
				if($key == 0)
				{
					$output .= "<tr>
				<td><strong>Name :</strong></td>
				<td>".$get_list['name']."</td>
				<td><strong>Mobile :</strong></td>
				<td>".$get_list['mobile']."</td>
			</tr>
			<tr>
				<td><strong>Email :</strong> </td>
				<td>".$get_list['email']."</td>
				<td><strong>Booking ID :</strong> </td>
				<td>".$get_list['booking_no']."</td>
				
			</tr>
			<tr>
				<td><strong>Booking Date :</strong></td>
				<td>".$bookedon_date."</td>
				<td><strong>Gross :</strong></td>
				<td>".$get_list['totamt']."</td>
			</tr>
			<tr>
			   <td><strong>Discount :</strong></td>
				<td>".$get_list['discount_amount']."</td>
				<td><strong>Net Amt :</strong></td>
				<td>".$get_list['net_total']."</td>
			</tr>
			<tr>
				<td><strong>Paid Amt :</strong></td>
				<td>".$get_list['paidamt']."</td>
				<td><strong>Balance Amt :</strong></td>
				<td>".$get_list['balamt']."</td>
			</tr>
			<tr>
				<td><strong>Sport :</strong></td>
				<td>".$get_list['sports']."</td>
				<td><strong>Place :</strong></td>
				<td>".$get_list['place']."</td>
			</tr>";
				}
				
				
				if($arr_count == $i)
				{
					$output .='</tbody></table>';
					
					$get_slot_details = $this->search_model->get_slot_details($booking_id);
					
							if($get_slot_details)
							{
								$output .='<h3> Slot Details </h3>';
							
								$output .='<table class="table table-bordered table-striped" id="view">
	                                       <tbody>
											<thead>
											<tr>
											<th>S.No</th>
											<th>Activity</th>
											<th>Court</th>
											<th>Location</th>
											<th>Slot</th>
											<th>Amount</th>
											</tr>
											</thead>';
							
								foreach($get_slot_details as $key => $get_list)
								{
									$bok_from_time =  date('g:i a', strtotime($get_list['booking_fromtime']));
									$bok_to_time =  date('g:i a', strtotime($get_list['booking_totime']));
								$output .='<tr>
								<td>'.++$key.'</td>
								<td>'.$get_list['sports'].'</td>
								<td>'.$get_list['courtname'].'</td>
								<td>'.$get_list['place'].'</td>
								<td>'.$bok_from_time.' - '.$bok_to_time.'</td>
								<td>'.$get_list['amount'].'</td>
								</tr>';

								}
								$output .='</tbody> </table>';
                      }
					
				}
				$i++;
			}
		}
	else{	
		    $output .="<tr><td colspan='4' align='center'>No Record Found!</td></tr>";
			$output .='</tbody></table>';
         }
	echo $output;
	}
	
	
	public function search_email_check(){
		
		$cus_id = ($this->input->post('cus_id') != '') ? $this->input->post('cus_id'):"";
		$search_value = ($this->input->post('search_value') != '') ? $this->input->post('search_value'):"";
		
		$get_details = $this->search_model->search_email_check($cus_id,$search_value);
		echo json_encode($get_details);
	}
}



?>