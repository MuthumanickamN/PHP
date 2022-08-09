<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Location extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
    
	
	}
	public function index()
	{
		$this->load->view('location_list');
	}
	public function add()
	{
		if($this->input->post('submit'))
		{

		$location=$this->input->post('location');
		$place=$this->input->post('place');
		$address=$this->input->post('address');
		$created_at=currentDateTime();
		 $this->db->where('location', $location);
		 $this->db->where('place', $place);
		 $this->db->where('address', $address);  
             
           $query = $this->db->get('locations');  
       if($query->num_rows() ==0)  
           {  

	    

        $sql="INSERT into locations(location,place,address,created_at) values('".$location."','".$place."','".$address."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Location Added Successfully.');
				redirect(base_url().'location');
	}
			else
			{
				setMessage('Location Already Exist');
			redirect(base_url().'Location/add');	
			}
	}
	$this->load->view('location');
}
public function edit($location_id)
{

	
	$query = $this->db->query('select * from locations where location_id='.$location_id);
	$postData=$query->row_array();
	$data['location']=$postData['location'];
	$data['place']=$postData['place'];
	$data['address']=$postData['address'];
	if($this->input->post('submit'))
		{
			$location=$this->input->post('location');
		$place=$this->input->post('place');
		$address=$this->input->post('address');
		$updated_at=currentDateTime();

		 $sql="Update  locations set location='$location',place='$place',address='$address',updated_at='$updated_at' where location_id='$location_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Location Updated Successfully.');
				redirect(base_url().'location');
			}

	$this->load->view('location',$data);


}
public function delete($location_id)
{
	 $sql="Delete from locations  where location_id='$location_id'";
		$insert=$this->db->query($sql);


	
				setMessage('Location Deleted Successfully.');
				redirect(base_url().'location');
			}

public function view($location_id)
{
	$query = $this->db->query('select * from locations where location_id='.$location_id);
	$postData=$query->row_array();
	$data['location_id']=$postData['location_id'];
	$data['location']=$postData['location'];
	$data['place']=$postData['place'];
	$data['address']=$postData['address'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_location', $data);
}
}