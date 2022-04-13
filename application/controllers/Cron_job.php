<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }
	}
    
    public function clear_cart(){
		
		$current_time = time();
		$sql="select * from tmp_booking_court";
		foreach($this->db->query($sql)->result_array() as $key => $value)
		{
			$id = $value['id'];
			$created_at = $value['created_at'];
			if(strtotime($created_at)+300 < $current_time)
			{
				$sql2="Delete from tmp_booking_court where id='$id'";
				$this->db->query($sql2);
			}
		}
		
	}
	
}
?>