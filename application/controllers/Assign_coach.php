<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Assign_coach extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	 $this->load->model('Assign_coaches_Model');
	}
	public function index($game_id='', $coach_id='')
	{
		$data = array();
		$data['coach_id']= $coach_id;
		$data['game_id']= $game_id;
		 $this->load->view('assign_coach', $data);
	}

	public function select_coach()
	{

		$game_id=$this->input->post('game_id');
		$query=$this->db->query("select * from coach where activity_id='".$game_id."' and status='Active'");
		$row=$query->row_array();
		
		$data['role'] = '';
		$data['coach_name']='';
		if(!empty($row['coach_name']))
		{
			$data['coach_name']=$row['coach_name'];
		}
		if(!empty($row['role']))
		{
			$data['role']=$row['role'];
		}
		
		
		
		//$data['opcode']=1;
		//$data['game_id']=$game_id;
		//print_r($data);die;
		//$this->load->view('assign_coach_ajax', $data);	


	} 

public function select_student()
{

	$data['game_id']=$this->input->post('game_id');

		$data['coach_id']=$this->input->post('coach_id');

	$data['opcode']=1;
	
	$this->load->view('assign_coach_ajax', $data);	


}

public function assign_coach(){
	$game_id=$this->input->post('game_id');
	$coach_id=$this->input->post('coach_id');

	if(isset($_POST['sub'])&&($_POST['sub']=='Assign'))
	{ 
		if(('#checkbox' != '') && ($_POST['assign_coach_checkbox'] != ''))
		{
				$checkbox1=$_POST['assign_coach_checkbox'];  
				$chk="";  
				foreach($checkbox1 as $key => $chk1){  
					if(count($checkbox1)==$key+1)
					{
						$chk .= $chk1;  
					}
					else{
						$chk .= $chk1.",";  
					}
				}
		}
		else{
			redirect('Assign_coach/index/'.$game_id.'/'.$coach_id);

		}
		$coach_id=$this->session->userdata('coach_id');
	 	$sql="Update  activity_selections set coach_id='$coach_id' where id in ($chk)";
		//echo $sql;die;
		$insert=$this->db->query($sql);
	//	$sql2="Delete from activity_selections where id='$chk2'";
	//	$insert=$this->db->query($sql2);
		
	}
	if(isset($_POST['sub'])&&($_POST['sub']=='Remove'))
	{ 
		if(('#checkbox' != '') && ($_POST['remove_coach_checkbox'] != ''))
		{
				$checkbox1=$_POST['remove_coach_checkbox'];  
				$chk2="";  
				foreach($checkbox1 as $key => $chk1)
				{  
					if(count($checkbox1)==$key+1)
					{
						$chk2 .= $chk1;  
					}
					else
					{
						$chk2 .= $chk1.",";  
					} 
				}
			}
		else
		{
			redirect('Assign_coach/index/'.$game_id.'/'.$coach_id);
		
		}
	
		$coach_id=$this->session->userdata('coach_id');
		$sql="Update activity_selections set coach_id=' ' where id in ($chk2)";
		//echo $sql;die;
		$insert=$this->db->query($sql);
	}

	//$this->load->view('assign_coach');
     
   redirect('Assign_coach/index/'.$game_id.'/'.$coach_id);

   }
}