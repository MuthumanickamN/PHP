<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_booking extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
		if(!$this->session->userdata('id')){
            redirect('logout');
        }
		
		$this->load->model('Reports_Model', 'reports_model');
       
    }

	
    public function index(){
		
		
		$data = array();
		$userrole = strtolower($this->session->userdata('role'));
		if($userrole == 'parent')
        {
            $userid=$this->session->userdata('id');
            $query = $this->db->query("SELECT parent_id FROM `parent` p
            left join users u on u.code = p.parent_code
            where u.user_id=$userid");
            $parent_id = $query->row()->parent_id;
		    $data['user_name'] = $this->reports_model->get_user($parent_id);
		    $data['from'] = 'Parent';
        }
        else
        {
             $data['user_name'] = $this->reports_model->get_user();
             $data['from'] = 'Admin';
        }
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('reports',$data);
       // $this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	
	public function get_transaction_search_history(){
		
		$from_date = ($this->input->post('from_date'))?$this->input->post('from_date') : "";
		$to_date = ($this->input->post('to_date'))?$this->input->post('to_date') : "";
		$user = ($this->input->post('user'))?$this->input->post('user') : "";
		
		
		$from_date1 = ($from_date != "") ? change_date_format($from_date): "";
		$to_date1 = ($to_date != "") ? change_date_format($to_date): "";
		
		$transaction_details = $this->reports_model->get_transaction_search_history($from_date1,$to_date1,$user);
		$output ='';
		if($transaction_details)
		{
			foreach($transaction_details as $key => $get_list){
				 //$booking_date = date("d-m-Y", strtotime($get_list['bookedon']));
				 
				
					switch($get_list['btype'])
					{
						case '1';
						$booking_status = "Regular";
						break;
						case '2';
						$booking_status = "Bulk";
						break;
						
					}
					if($booking_status == "Regular")
					{
						//$regular_date = $this->reports_model->get_regular_date_range($get_list['id']);
						
						
					}
					if($booking_status == "Bulk")
					{
						//$bulk_date = $this->reports_model->get_bulk_date_range($get_list['id']);
						
						
					}
				        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
						
						if($booking_status == "Regular")
					{
						$reg_date = date("d-m-Y", strtotime($get_list['fromdate']));
                        $output .= "<td>". $reg_date ."</td>";
						$output .= "<td>". $get_list['dayname'] ."</td>";
					}
					if($booking_status == "Bulk")
					{
						$bulk_from_date = date("d-m-Y", strtotime($get_list['fromdate']));
						$bulk_to_date = date("d-m-Y", strtotime($get_list['todate']));
						
						$output .= "<td>". $bulk_from_date ."</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </br>". $bulk_to_date ."</td>";
						//$output .= "<td>". $bulk_date['todate'] ."</td>";
						$output .= "<td>". $get_list['dayname'] ."</td>";
					}
					
					 $date = new DateTime($get_list['booking_fromtime']);
                     $booking_fromtime = $date->format('h:i a') ;
					 
					  $date1 = new DateTime($get_list['booking_totime']);
					  $booking_totime = $date1->format('h:i a') ;
						
						$output .= "<td>". $booking_fromtime ."</td>";
						$output .= "<td>". $booking_totime ."</td>";
						$output .= "<td>". $get_list['cancelled_on'] ."</td>";
						$output .= "<td>". $get_list['location'] ."</td>";
						$output .= "<td>". $booking_status ."</td>";
						$output .= "<td>". $get_list['booking_no'] ."</td>";
						$output .= "<td>". $get_list['sportsname'] ."</td>";
						$output .= "<td>". $get_list['name'] ."</td>";
						$output .= "<td>". $get_list['mobile'] ."</td>";
						//$output .= "<td>". $get_list['email'] ."</td>";
						$output .= "</tr>";
				
				
			}
			
		}
		
		echo $output;		
		
}




public function get_booking_search_history(){
		
		$from_date = ($this->input->post('from_date'))?$this->input->post('from_date') : "";
		$to_date = ($this->input->post('to_date'))?$this->input->post('to_date') : "";
		
		$from_date1 = ($from_date != "") ? change_date_format($from_date): "";
		$to_date1 = ($to_date != "") ? change_date_format($to_date): "";
		$user = ($this->input->post('user'))?$this->input->post('user') : "";
		
		$booking_details = $this->reports_model->get_booking_search_history($from_date1,$to_date1,$user);
		$output ='';
		if($booking_details)
		{
			foreach($booking_details as $key => $get_list){
				//$booking_date = date("d-m-Y", strtotime($get_list['bookedon']));
				
					switch($get_list['btype'])
					{
						case '1';
						$booking_type = "Regular";
						break;
						case '2';
						$booking_type = "Bulk";
						break;
						
					}
					if($booking_type == "Regular")
					{
						//$regular_date = $this->reports_model->get_regular_date_range($get_list['id']);
					}
					if($booking_type == "Bulk")
					{
						//$bulk_date = $this->reports_model->get_bulk_date_range($get_list['id']);
					}
				        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
                    if($booking_type == "Regular")
					{
						$reg_date = date("d-m-Y", strtotime($get_list['fromdate']));
                        $output .= "<td>". $reg_date ."</td>";
						$output .= "<td>". $get_list['dayname'] ."</td>";
					}
					if($booking_type == "Bulk")
					{
						$bulk_from_date = date("d-m-Y", strtotime($get_list['fromdate']));
						$bulk_to_date = date("d-m-Y", strtotime($get_list['todate']));
						
						$output .= "<td>". $bulk_from_date ."</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </br>". $bulk_to_date ."</td>";
						//$output .= "<td>". $bulk_date['todate'] ."</td>";
						$output .= "<td>". $get_list['dayname'] ."</td>";
					}
					 $date = new DateTime($get_list['booking_fromtime']);
                     $booking_fromtime = $date->format('h:i a') ;
					 
					  $date1 = new DateTime($get_list['booking_totime']);
					  $booking_totime = $date1->format('h:i a') ;
					 
					$output .= "<td>". $booking_fromtime ."</td>";
					$output .= "<td>". $booking_totime ."</td>";
					
						$output .= "<td>". $get_list['booking_no'] ."</td>";
						$output .= "<td>". $get_list['location'] ."</td>";
						$output .= "<td>". $get_list['sportsname'] ."</td>";
						$output .= "<td>". $booking_type ."</td>";
						$output .= "<td>". $get_list['totamt'] ."</td>";
						$output .= "<td>". $get_list['discount_amount'] ."</td>";
						$output .= "<td>". $get_list['net_total'] ."</td>";
						$output .= "<td>". $get_list['paidamt'] ."</td>";
						$output .= "<td>". $get_list['name'] ."</td>";
						$output .= "<td>". $get_list['mobile'] ."</td>";
						//$output .= "<td>". $get_list['email'] ."</td>";
						$output .= "</tr>";
				
				
			}
			
		}
		
		echo $output;		
		
}
    
	public function get_cancellation_search_history(){
		
		$from_date = ($this->input->post('from_date'))?$this->input->post('from_date') : "";
		$to_date = ($this->input->post('to_date'))?$this->input->post('to_date') : "";
		
		$from_date1 = ($from_date != "") ? change_date_format($from_date): "";
		$to_date1 = ($to_date != "") ? change_date_format($to_date): "";
		$user = ($this->input->post('user'))?$this->input->post('user') : "";
		$cancellation_details = $this->reports_model->get_cancellation_search_history($from_date1,$to_date1,$user);
		$output ='';
		if($cancellation_details)
		{
			
			foreach($cancellation_details as $key => $get_list){
				$cancellation_date = date("d-m-Y", strtotime($get_list['cancelled_on']));
				
				    switch($get_list['btype'])
					{
						case '1';
						$booking_type = "Regular";
						break;
						case '2';
						$booking_type = "Bulk";
						break;
						
					}
					
					
				        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
                        $output .= "<td>". $cancellation_date ."</td>";
						$output .= "<td>". $booking_type ."</td>";
						$output .= "<td>". $get_list['booking_no'] ."</td>";
						$output .= "<td>". $get_list['paidamt'] ."</td>";
						$output .= "<td>". $get_list['sportsname'] ."</td>";
						$output .= "<td>". $get_list['name'] ."</td>";
						$output .= "<td>". $get_list['mobile'] ."</td>";
						$output .= "</tr>";
				
				
			}
			
		}
		
		echo $output;		
		
}
	
	
    
   
	
}

?>