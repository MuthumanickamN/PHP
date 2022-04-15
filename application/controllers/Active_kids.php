<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Active_kids extends CI_Controller {  
 
    public function __construct(){
		parent::__construct();
		error_reporting(0);
	    //$this->load->model('Student_Model');
	    $this->load->model('Default_Model', 'default');
	    //$this->load->model('School_profile_report_Model', 'schools');
	    $this->load->model('Daily_Transaction_Model', 'transaction');
	}
    public function index()
    { 
        $userid =  $this->session->userdata('userid');
        
        $role =  $this->session->userdata('role');
        $query = $this->db->query("SELECT parent_id FROM `parent` p
            left join users u on u.code = p.parent_code
            where u.user_id=$userid");

        $parent_id = $query->row()->parent_id;
        $data['parent_id'] = $parent_id;
        
        $query2 = "select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(CURDATE(),dob)), '%Y')+0 AS age from registrations where parent_user_id='$parent_id' order by dob asc";

        $data['students'] = $this->db->query($query2)->result_array();
        
        $query3 = $this->db->query('select game_id,game from games where active=1');
    	$data['games']=$query3->result_array();
    	//print_r($data);die;
    	$data['role'] = $role;
        $this->load->view('active_kids', $data);
    } 
}
?>
