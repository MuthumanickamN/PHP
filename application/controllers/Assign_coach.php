<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Assign_coach extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	 $this->load->model('Assign_coaches_Model');
	}
	public function index()
	{
		 $this->load->view('assign_coach');
		}

		 public function select_coach()
{

	$game_id=$this->input->post('game_id');
	$query=$this->db->query("select * from coach where activity_id='".$game_id."' and status='Active'");
	$row=$query->row_array();
    
    
	if(!empty($row['coach_name']))
	{
		$data['coach_name']=$row['coach_name'];
	}
	if(!empty($row['role']))
	{
		$data['role']=$row['role'];
	}
    
	
	
	$data['opcode']=1;
		$data['game_id']=$game_id;
	
	$this->load->view('assign_coach_ajax', $data);	


}

 public function select_student()
{

	$data['game_id']=$this->input->post('game_id');

		$data['coach_id']=$this->input->post('coach_id');

	$data['opcode']=2;
	
	$this->load->view('assign_coach_ajax', $data);	


}
public function assign_coach(){
	if(isset($_POST['sub'])){ 
		$checkbox1=$_POST['assign_coach_checkbox'];  
		$chk="";  
		foreach($checkbox1 as $chk1){  
	      $chk .= $chk1.",";  
	   }  
		$coach_id=$this->session->userdata('coach_id');
	 	$sql="Update  activity_selections set coach_id='$coach_id' where id='$chk'";
		$insert=$this->db->query($sql);
	}
	$this->load->view('assign_coach');

}

}