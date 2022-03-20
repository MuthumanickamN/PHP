<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Activity_level extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('activity_level_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$level=$this->input->post('level');
		$session=$this->input->post('session');
		
			$created_at=currentDateTime();

	 $this->db->where('level', $level);
	 $this->db->where('session', $session);  
             
           $query = $this->db->get('game_levels');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into game_levels(level,session,created_at) values('".$level."','".$session."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Activity Level Added Successfully.');
				redirect(base_url().'index.php/activity_level');
		}
			else
			{
				setMessage('Activity Level Already Exist');
			redirect(base_url().'index.php/activity_level/add');
			}
	}
	$this->load->view('activity_level');
}
public function edit($games_level_id)
{

	
	$query = $this->db->query('select * from game_levels where games_level_id='.$games_level_id);
	$postData=$query->row_array();
	$data['level']=$postData['level'];
	$data['session']=$postData['session'];
	if($this->input->post('submit'))
		{
			$level=$this->input->post('level');
		$session=$this->input->post('session');
		$updated_at=currentDateTime();

		 $sql="Update  game_levels set level='$level',session='$session',updated_at='$updated_at' where games_level_id='$games_level_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Level Updated Successfully.');
				redirect(base_url().'index.php/activity_level');
			}

	$this->load->view('activity_level',$data);


}
public function delete($games_level_id)
{
	 $sql="Delete from game_levels  where games_level_id='$games_level_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Level Deleted Successfully.');
				redirect(base_url().'index.php/activity_level');
			}

public function view($games_level_id)
{
	$query = $this->db->query('select * from game_levels where games_level_id='.$games_level_id);
	$postData=$query->row_array();
	$data['level']=$postData['level'];
	$data['games_level_id']=$postData['games_level_id'];
	$data['session']=$postData['session'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_activity_level', $data);
}

}