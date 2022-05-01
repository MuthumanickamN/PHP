<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MPermissions extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MPermissions_Model');
	}

	public function index()
	{
		if ($this->input->post('Save')) {	

			$this->db->or_where('superadmin','1');
			$data['superadmin']=0;
			$this->db->update('module_permission',$data);   
			
			$this->db->or_where('admin','1');
			$data['admin']=0;
			$this->db->update('module_permission',$data);   
			
			$this->db->or_where('headcoach','1');
			$data['headcoach']=0;
			$this->db->update('module_permission',$data);   
			
			$this->db->or_where('coach','1');
			$data['coach']=0;
			$this->db->update('module_permission',$data);   
			
			$this->db->or_where('parent','1');
			$data['parent']=0;
			$this->db->update('module_permission',$data);   
			$data = array();

			if((null !== $this->input->post('superadmin'))){
				foreach($this->input->post('superadmin') as $key=>$value){
					$this->db->where('id',$key);
					$data['superadmin']=1;
					$this->db->update('module_permission',$data);    
				}
			}
			if((null !==$this->input->post('admin'))){
				$data = array();
				foreach($this->input->post('admin') as $key=>$value){
					$this->db->where('id',$key);
					$data['admin']=1;
					$this->db->update('module_permission',$data);    
				}
			}
			if((null !==$this->input->post('headcoach'))){
				$data = array();
				foreach($this->input->post('headcoach') as $key=>$value){
					$this->db->where('id',$key);
					$data['headcoach']=1;
					$this->db->update('module_permission',$data);  
				}
			}
			if((null !==$this->input->post('coach'))){
				$data = array();
				foreach($this->input->post('coach') as $key=>$value){
					$this->db->where('id',$key);
					$data['coach']=1;
					$this->db->update('module_permission',$data);    
				}
			}
			if((null !== $this->input->post('parent'))){
				$data = array();
				foreach($this->input->post('parent') as $key=>$value){
					$this->db->where('id',$key);
					$data['parent']=1; 
					$this->db->update('module_permission',$data);    
				}
			}
		}
		$data = array();
		$mpermission = new MPermissions_Model;
		$data['data'] = $mpermission->get_mpermission();
		/*$this->load->view('includes/header');       
       	$this->load->view('users/list',$data);
       	$this->load->view('includes/footer');*/
		$this->load->view('module_permission/mpermission_list', $data);
	}

	/**
	 * Store Data from this method.
	 *
	 * @return Response
	 */
	public function store()
	{
		/*$users = new Users_Model;
		$users->insert_users();
		redirect(base_url('module_permission'));*/
	}

	public function add()
	{
		/*if ($this->input->post('Save')) {			
			$users = new Users_Model;
			$users->insert_users();
			redirect(base_url('module_permission'));
		}
		$this->load->view('module_permission/users');*/
	}

	public function edit($id)
	{
	}

	public function delete($id)
	{
	}

	public function view($id)
	{
	}
}
