<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Events extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('events_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{


		$event_date=$this->input->post('event_date');
		$event_name=$this->input->post('event_name');
		$event_place=$this->input->post('event_place');
		$event_detail=$this->input->post('event_detail');
		
        $created_at=currentDateTime();

	 $this->db->where('event_date', $event_date); 
	  $this->db->where('event_name', $event_name);  
	  $this->db->where('event_place', $event_place); 
	  $this->db->where('event_detail', $event_detail);  
             
           $query = $this->db->get('events');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into events(event_date,event_name,event_place,event_detail,created_at) values('".$event_date."','".$event_name."','".$event_place."','".$event_detail."','".$created_at."')";
		$insert=$this->db->query($sql);
	
				setMessage('New Event Added Successfully.');
				redirect(base_url().'index.php/events');
		}
			else
			{
				setMessage('The Event Already Exist');
			redirect(base_url().'index.php/events');
			}
	}
	$this->load->view('events');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from events where id='.$id);
	$postData=$query->row_array();
	$data['event_date']=$postData['event_date'];
	$data['event_name']=$postData['event_name'];
	$data['event_place']=$postData['event_place'];
	$data['event_detail']=$postData['event_detail'];

	if($this->input->post('submit'))
		{
		$event_date=$this->input->post('event_date');
		$event_name=$this->input->post('event_name');
		$event_place=$this->input->post('event_place');
		$event_detail=$this->input->post('event_detail');
		$updated_at=currentDateTime(); 

		 $sql="Update  events set event_date='$event_date',event_name='$event_name',event_place='$event_place',event_detail='$event_detail',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Event Updated Successfully.');
				redirect(base_url().'index.php/events');
			}

	$this->load->view('events',$data);


}
public function delete($id)
{
	 $sql="Delete from events  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Event Deleted Successfully.');
				redirect(base_url().'index.php/events');
			}

public function view($id)
{
	$query = $this->db->query('select * from events where id='.$id);
	$postData=$query->row_array();
	$data['event_date']=$postData['event_date'];
	$data['event_name']=$postData['event_name'];
	$data['event_place']=$postData['event_place'];
	$data['event_detail']=$postData['event_detail'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_events', $data);
}

}