<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Mail extends CI_Controller {  
	
	public function __construct()
	{
	    error_reporting(0);
	parent::__construct();
   
	
	}
	public function index()
	{
	    $data = array();
	    $email = $_REQUEST['email'];
        $osql2 = "select * from users where email='$email'"; 
        $user_id = $this->db->query($osql2)->row()->user_id;
       
	    $data['email'] = $_REQUEST['email']; 
	    $data['user_id'] = $user_id;
		$this->load->view('email_text', $data);
	}

	
}