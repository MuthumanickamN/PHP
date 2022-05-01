<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Bank_details extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('bank_details_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$bank_name=$this->input->post('bank_name');
		$bank_location=$this->input->post('bank_location');
		
	$created_at=currentDateTime();

	 $this->db->where('bank_name', $bank_name);  
	  $this->db->where('bank_location', $bank_location);  
             
           $query = $this->db->get('bank_details');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into bank_details(bank_name,bank_location,created_at) values('".$bank_name."','".$bank_location."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Bank Added Successfully.');
				redirect(base_url().'index.php/bank_details');
		}
			else
			{
				setMessage('Bank Already Exist');
			redirect(base_url().'index.php/bank_details');
			}
	}
	$this->load->view('bank_details');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from bank_details where id='.$id);
	$postData=$query->row_array();
	$data['bank_location']=$postData['bank_location'];
	$data['bank_name']=$postData['bank_name'];
	if($this->input->post('submit'))
		{
			$bank_location=$this->input->post('bank_location');
		$bank_name=$this->input->post('bank_name');
		$updated_at=currentDateTime();

		 $sql="Update  bank_details set bank_location='$bank_location',bank_name='$bank_name',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Bank Details Updated Successfully.');
				redirect(base_url().'index.php/bank_details');
			}

	$this->load->view('bank_details',$data);


}
public function delete($id)
{
	 $sql="Delete from bank_details  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Bank Details Deleted Successfully.');
				redirect(base_url().'index.php/bank_details');
			}

public function view($id)
{
	$query = $this->db->query('select * from bank_details where id='.$id);
	$postData=$query->row_array();
	$data['id']=$postData['id'];
	$data['bank_location']=$postData['bank_location'];
	$data['bank_name']=$postData['bank_name'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_bank', $data);
}

}