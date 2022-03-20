<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Slot_refund_approval extends CI_Controller {  
      
    
	public function __construct(){
		parent::__construct();
	    $this->load->model('Slot_Refund_Approval_Model');
	}
	
	public function index(){
		$data['title'] = 'Slot refund Approval';
		$this->load->view('slot_refund_list');
	}

}