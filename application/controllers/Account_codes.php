<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Account_codes extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('account_codes_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{


		$name_of_service=$this->input->post('name_of_service');
		$description=$this->input->post('description');
		$category=$this->input->post('category');
		$status=$this->input->post('status');
		
		$created_at=currentDateTime();

	 $this->db->where('name_of_service', $name_of_service); 
	  $this->db->where('description', $description);  
	   $this->db->where('category', $category); 
	  
             
           $query = $this->db->get('account_codes');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into account_codes(name_of_service,description,category,status,created_at) values('".$name_of_service."','".$description."','".$category."','".$status."','".$created_at."')";
		$insert=$this->db->query($sql);
	
				setMessage('New Account Code Added Successfully.');
				redirect(base_url().'index.php/account_codes');
			}
			else
			{
				setMessage('Account Code Already Exist');
			redirect(base_url().'index.php/account_codes');
			}
	}
	$this->load->view('account_codes');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from account_codes where id='.$id);
	$postData=$query->row_array();
	$data['name_of_service']=$postData['name_of_service'];
	$data['description']=$postData['description'];
	$data['category']=$postData['category'];
	$data['status']=$postData['status'];

	if($this->input->post('submit'))
		{
		$name_of_service=$this->input->post('name_of_service');
		$description=$this->input->post('description');
		$category=$this->input->post('category');
		$status=$this->input->post('status');
		$updated_at=currentDateTime(); 

		 $sql="Update  account_codes set name_of_service='$name_of_service',description='$description',category='$category',status='$status',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Account Code Updated Successfully.');
				redirect(base_url().'index.php/account_codes');
			}

	$this->load->view('account_codes',$data);


}
public function delete($id)
{
	 $sql="Delete from account_codes  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Account Code Deleted Successfully.');
				redirect(base_url().'index.php/account_codes');
			}

public function view($id)
{
	$query = $this->db->query('select * from account_codes where id='.$id);
	$postData=$query->row_array();
	$data['name_of_service']=$postData['name_of_service'];
	$data['description']=$postData['description'];
	$data['category']=$postData['category'];
	$data['status']=$postData['status'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_account_codes', $data);
}

}