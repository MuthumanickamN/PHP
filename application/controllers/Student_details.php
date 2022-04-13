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

			$query2=("select r.*, g.game,gl.level,p.parent_code,rg.sid,rg.name from student_remarks as r 
			left join registrations rg on rg.id=r.student_id
			left join parent p on p.parent_id=rg.parent_user_id
			left join games g on g.game_id=r.activity_id
			left join game_levels gl on gl.games_level_id=r.level_id where r.id=$id");

			$sql1 = $this->db->query($query2);
			$data['list'] = $sql1->result();
			
			//print_r($data);die;
			 $this->load->view('student_details_view', $data);
			}
	
	}
?>
