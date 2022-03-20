<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Dashboard extends CI_Controller {  
      
	public function __construct(){
	parent::__construct();
	}
	
	public function index(){
		$data['title'] = 'Prime Star Sports Academy LLC';
		$query = $this->db->query("select * from scroll_text_messages");
		$data['scroll_Text'] = $query->row_array();
		$event = $this->db->query("select * from events where event_date >= '".date('Y-m-d')."' order by event_date ASC ");
		$data['eventList'] = $event->result_array();
		$holidays = $this->db->query("select * from set_academy_holidays order by select_date ASC ");
		$data['holidaysList'] = $holidays->result_array();
		$this->load->view('dashboard', $data);
	}
	

		
}  