<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Location_based_games extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('location_based_games_list');
		}

	public function add()
	{


		if($this->input->post('submit'))
		{

		$game_id=$this->input->post('game_id');
		$location_id=$this->input->post('location_id');
		
		$created_at=currentDateTime();
	     $this->db->where('game_id', $game_id); 
	     $this->db->where('location_id', $location_id);  
             
           $query = $this->db->get('location_based_games');  
       if($query->num_rows() ==0)  
           {  

        $sql="INSERT into location_based_games(game_id,location_id,created_at) values('".$game_id."','".$location_id."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Activity Based Location Added Successfully.');
				redirect(base_url().'index.php/location_based_games');
	}
			else
			{
				setMessage('Location Based Activity Already Exist');
			redirect(base_url().'index.php/location_based_games/add');
			}
	}
	$this->load->view('location_based_games');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from location_based_games where id='.$id);
	$postData=$query->row_array();
	$data['location_id']=$postData['location_id'];
	$data['game_id']=$postData['game_id'];
	
	if($this->input->post('submit'))
		{
			$location_id=$this->input->post('location_id');
		$game_id=$this->input->post('game_id');
		
		$updated_at=currentDateTime();

		 $sql="Update  location_based_games set location_id='$location_id',game_id='$game_id',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Based Location Updated Successfully.');
				redirect(base_url().'index.php/location_based_games');
			}

	$this->load->view('location_based_games',$data);


}
public function delete($id)
{
	 $sql="Delete from location_based_games  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Based Location Deleted Successfully.');
				redirect(base_url().'index.php/location_based_games');
			}

public function view($id)
{
	$query = $this->db->query('select * from location_based_games where id='.$id);
	$postData=$query->row_array();
	$data['location_id']=$postData['location_id'];
	$data['game_id']=$postData['game_id'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_location_based_games', $data);
}
}