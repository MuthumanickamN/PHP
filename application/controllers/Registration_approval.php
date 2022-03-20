<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 
class Registration_approval extends CI_Controller {  
	public function __construct(){
	parent::__construct();
	}
	public function index(){
		$query = $this->db->query('select r.*,p.parent_code,p.email_id from registrations r
		left join parent p on p.parent_id=r.parent_user_id order by r.id desc
		');
		$data['student']=$query->result_array();
		$this->load->view('registration_approval', $data);
	}
}