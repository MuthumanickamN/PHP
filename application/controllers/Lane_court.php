<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Lane_court extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();

	
	}
	
	public function index()
	{
	    $data= array();
	    $data['list'] = $this->db->query("select * from lane_courts ORDER BY id DESC")->result_array();
		$this->load->view('lane_court_list', $data);
	}
	public function add()
	{
		if($this->input->post('submit'))
		{

		$lane_court=$this->input->post('lane_court');
		
		
		$created_at=currentDateTime();

	 $this->db->where('lane_court', $lane_court);  
             
           $query = $this->db->get('lane_courts');  
       if($query->num_rows() ==0)  
           {  

	    

        $sql="INSERT into lane_courts(lane_court,created_at) values('".$lane_court."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Lane/Court Added Successfully.');
				redirect(base_url().'lane_court');
		}
			else
			{
				setMessage('lane Court Already Exist');
			redirect(base_url().'lane_court/add');
			}
	}
		$this->load->view('lane_court');
	}
public function edit($id)
{

	
	$query = $this->db->query('select * from lane_courts where id='.$id);
	$postData=$query->row_array();
	$data['lane_court']=$postData['lane_court'];
	
	if($this->input->post('submit'))
		{
			$lane_court=$this->input->post('lane_court');
		
		$updated_at=currentDateTime();


		 $sql="Update  lane_courts set lane_court='$lane_court',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Lane/Court Updated Successfully.');
				redirect(base_url().'lane_court');
			}

	$this->load->view('lane_court',$data);


}
public function delete($id)
{
	 $sql="Delete from lane_courts  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Lane/Court Deleted Successfully.');
				redirect(base_url().'lane_court');
			}

public function view($id)
{
	$query = $this->db->query('select * from lane_courts where id='.$id);
	$postData=$query->row_array();
	$data['lane_court']=$postData['lane_court'];
	$data['id']=$postData['id'];
	
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_lane_court', $data);
}
}