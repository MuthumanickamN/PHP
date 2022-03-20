<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Rajkamal
* Description: Login controller class
*/
class Logout extends CI_Controller{
    
    function __construct(){
        parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');
		
		// Load database
		$this->load->model('login_model');
    }

    public function index(){
        // Removing session data
		$sess_array = array(
			'id' => '',
                        'role' => '',
			'username' => '',
			'email' => ''					
			);
                if($this->session->userdata('role') != '1'){
                    //$this->session->unset_userdata($sess_array);
                    $this->session->unset_userdata('id');
                    $this->session->unset_userdata('role');
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('email');
                    $this->db->cache_delete_all();
                    redirect('login','refresh');
                }else{

                    //$this->session->unset_userdata($sess_array);
                    $this->session->unset_userdata('id');
                    $this->session->unset_userdata('role');
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('email');
                    $this->db->cache_delete_all();
                    redirect('login','refresh');
                }
    }
	
}
?>