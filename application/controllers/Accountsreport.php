<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Accountsreport extends CI_Controller 
{
	
	function __construct(){
        parent::__construct();
        
		$this->load->model("Accountsreport_model");

		
    }
	
	public function coach_wise_revenue()
	{  
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		$data = array();
		$data['title'] = 'Coach Wise Revenue';
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		
		$this->load->view('reports/coach_wise_revenue', $data);
    }
	
	public function coach_wise_revenue_list()
	{
		
		$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		$result=$this->Accountsreport_model->coach_wise_revenue_model($from_date, $to_date);
		
		$output = '';
		foreach($result as $key => $val)
		{
			$output .= '<tr>';
			$output .= '<td>';
			$output .= '';
			$output .= '</td>';
			$output .= '<td>';
			$output .= $val->coach_name;
			$output .= '</td>';
			
			$output .= '<td>';
			$output .= $val->revenue;
			$output .= '</td>';
			
			$output .= '</tr>'; 
			
		}
		echo $output;
	}


	public function location_wise_revenue()
	{  
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		$data = array();
		$data['title'] = 'Location Wise Revenue';
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		
		$this->load->view('reports/location_wise_revenue', $data);
    }
	
	public function location_wise_revenue_list()
	{
		
		$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		$result=$this->Accountsreport_model->location_wise_revenue_model($from_date, $to_date);
		
		$output = '';
		foreach($result as $key => $val)
		{
			$output .= '<tr>';
			$output .= '<td>';
			$output .= '';
			$output .= '</td>';
			$output .= '<td>';
			$output .= $val->location;
			$output .= '</td>';
			
			$output .= '<td>';
			$output .= $val->revenue;
			$output .= '</td>';
			
			$output .= '</tr>'; 
			
		}
		echo $output;
	}
	
	
	public function activity_wise_revenue()
	{  
		$from_date = date('Y-m-1');
		$to_date = date('Y-m-d');
		$data = array();
		$data['title'] = 'Activity Wise Revenue';
		$data['fromDateVal'] = date('Y-m-d',strtotime($from_date));
		$data['toDateVal'] = date('Y-m-d',strtotime($to_date));
		
		$this->load->view('reports/activity_wise_revenue', $data);
    }
    public function activity_wise_revenue_list()
	{
		
		$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		$result=$this->Accountsreport_model->activity_wise_revenue_model($from_date, $to_date);
		
		$output = '';
		foreach($result as $key => $val)
		{
			$output .= '<tr>';
			$output .= '<td>';
			$output .= '';
			$output .= '</td>';
			$output .= '<td>';
			$output .= $val->game;
			$output .= '</td>';
			
			$output .= '<td>';
			$output .= $val->revenue;
			$output .= '</td>';
			
			$output .= '</tr>'; 
			
		}
		echo $output;
	}
}
?>


