<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set("date.timezone", "Asia/Kolkata");



if ( ! function_exists('is_logged_in'))
{
	function is_logged_in() {
		// Get current CodeIgniter instance
		$CI =& get_instance();
		// We need to use $CI->session instead of $this->session
		$user = $CI->session->userdata('id');
		//if (!isset($user)) { return false; } else { return true; }
		return $user;
	}
}
if ( ! function_exists('change_date_format'))
{
	function change_date_format($origal_date){
		$newDate = date("Y-m-d", strtotime($origal_date));
		return $newDate;
	}
	
}

if ( ! function_exists('is_admin_logged_in'))
{
	function is_admin_logged_in() {
		// Get current CodeIgniter instance
		$CI =& get_instance();
		// We need to use $CI->session instead of $this->session
		$user = $CI->session->userdata('admin_id');
		//if (!isset($user)) { return false; } else { return true; }
		return $user;
	}
}

if ( ! function_exists('user_permission'))
{
	function user_permission() {
            // Get current CodeIgniter instance
            $CI =& get_instance();
            $id = $CI->session->userdata('id');
            $CI->load->model('login_model');
            $user_details = $CI->login_model->get_user_details($id);      
            return $user_details->user_permission;
	}
}

if ( ! function_exists('go_back'))
{
	function go_back() {
            $path = base_url(uri_string()); 
           // echo dirname($path);  
            return dirname($path);
	}
}

if ( ! function_exists('go_back_edit'))
{
	function go_back_edit() {
            $path = base_url(uri_string()); 
           // echo dirname($path);  
            return dirname(dirname($path));
	}
}


//echo current_url();