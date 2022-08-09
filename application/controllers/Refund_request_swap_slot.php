<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Refund_request_swap_slot extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
	
	
	}
	public function index()
	{
		$this->load->view('refund_request_swap_slot');
	}

	public function request($id)
    {
		$data['id']=$id;
		$this->load->view('refund_request',$data);
	}
	
	}