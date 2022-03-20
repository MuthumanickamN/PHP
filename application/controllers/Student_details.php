<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Student_details extends CI_Controller
	{
			public function __construct(){
	        parent::__construct();
	        }
		 
		public function index($id) 
		{

			

			$query=("SELECT r.id as id, r.sid as student_id, r.name as student_name, p.parent_code as parent_id,p.parent_name,p.mobile_no,p.email_id,r.status,r.approval_status  FROM `registrations` r 
left join parent p on p.parent_id=r.parent_user_id where r.id=$id");
			$sql = $this->db->query($query);
			
			$data['Student_detail'] = $sql->result();
			//print_r($data);die;

			$this->load->view("student_details_view",$data);
		}
	}
?>
