<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Games extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('games_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$game=$this->input->post('game');
		$game_code=$this->input->post('game_code');
		
		
		$created_at=currentDateTime();

	 $this->db->where('game', $game);  
             
           $query = $this->db->get('games');  
          
       if($query->num_rows() ==0)  
           {  

	    

        $sql="INSERT into games(game,game_code,created_at) values('".$game."','".$game_code."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Activity Added Successfully.');
				redirect(base_url().'games');
			}
			else
			{
				setMessage('Activity Already Exist');
			    redirect(base_url().'games');
			}
	}
	$this->load->view('games');
}
public function edit($game_id)
{

	
	$query = $this->db->query('select * from games where game_id='.$game_id);
	$postData=$query->row_array();
	$data['game']=$postData['game'];
	$data['game_code']=$postData['game_code'];
	if($this->input->post('submit'))
		{
			$game=$this->input->post('game');
		$game_code=$this->input->post('game_code');
		$updated_at=currentDateTime();

		 $sql="Update  games set game='$game',game_code='$game_code',updated_at='$updated_at' where game_id='$game_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Updated Successfully.');
				redirect(base_url().'games');
			}

	$this->load->view('games',$data);


}
public function delete($game_id)
{
	 $sql="Delete from games  where game_id='$game_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Activity Deleted Successfully.');
				redirect(base_url().'games');
			}

public function view($game_id)
{
	$query = $this->db->query('select * from games where game_id='.$game_id);
	$postData=$query->row_array();
	$data['game']=$postData['game'];
	$data['game_id']=$postData['game_id'];
	$data['game_code']=$postData['game_code'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_games', $data);
}

}