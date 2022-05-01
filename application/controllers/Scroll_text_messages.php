<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Scroll_text_messages extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();

	
	}
	
	public function index()
	{
		$this->load->view('scroll_text_messages_list');
	}
	public function add()
	{
		if($this->input->post('submit'))
		{

		$message=$this->input->post('message');
		$active=$this->input->post('active');
		
		
		$created_at=currentDateTime();

	 $this->db->where('message', $message); 
	  $this->db->where('active', $active);  
             
           $query = $this->db->query('select * from scroll_text_messages where message ="'.$message.'"');  
           // $query1 = $this->db->get('scroll_text_messages');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into scroll_text_messages(message,active,created_at) values('".$message."','".$active."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Message Added Successfully.');
				redirect(base_url().'index.php/scroll_text_messages');
	}
			else 
			{
				setMessage('Scroll Text Message Already Exist');
			redirect(base_url().'index.php/scroll_text_messages');
			}
	}
		$this->load->view('scroll_text_messages');
	}
public function edit($id)
{

	
	$query = $this->db->query('select * from scroll_text_messages where id='.$id);
	$postData=$query->row_array();
	$data['message']=$postData['message'];
	$data['active']=$postData['active'];
	if($this->input->post('submit'))
		{
	    $message=$this->input->post('message');
		$active=$this->input->post('active');
		
        $updated_at=currentDateTime();

		 $sql="Update  scroll_text_messages set message='$message',active='$active',updated_at='$updated_at' where id='$id'";
		 
	
		$insert=$this->db->query($sql);


	
				setMessage('Message Updated Successfully.');
				redirect(base_url().'index.php/scroll_text_messages');
			}

	$this->load->view('scroll_text_messages',$data);


}
public function delete($id)
{
	 $sql="Delete from scroll_text_messages  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Message Deleted Successfully.');
				redirect(base_url().'index.php/scroll_text_messages');
			}

public function view($id)
{
	$query = $this->db->query('select * from scroll_text_messages where id='.$id);
	$postData=$query->row_array();
	$data['message']=$postData['message'];
	$data['active']=$postData['active'];
	$data['id']=$postData['id'];
	
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_messages', $data);
}
}