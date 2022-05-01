<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Refund_discount_percentages extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	 $this->load->model('Refund_Discount_Percentages_Model');
	}
	public function index()
	{
		 $this->load->view('refund_discount_percentages_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$percentage=$this->input->post('percentage');		
		$created_at=currentDateTime();
	       $this->db->where('name', $name);  
	       $this->db->where('description', $description);  
	       $this->db->where('percentage', $percentage);  
             


           $query = $this->db->get('refund_discount_percentages');  
       if($query->num_rows() ==0)  
           {  


        $sql="INSERT into refund_discount_percentages(name,description,percentage,created_at) values('".$name."','".$description."','".$percentage."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Refund Discount Percentage Added Successfully.');
				redirect(base_url().'index.php/refund_discount_percentages');
	}
			else
			{
				setMessage('Refund Discount Percentages Already Exist');
			redirect(base_url().'index.php/refund_discount_percentages');	
			}
	}
	$this->load->view('refund_discount_percentages');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from refund_discount_percentages where id='.$id);
	$postData=$query->row_array();
	$data['name']=$postData['name'];
	$data['description']=$postData['description'];
	$data['percentage']=$postData['percentage'];
	if($this->input->post('submit'))
		{$name=$this->input->post('name');
		$description=$this->input->post('description');
		$percentage=$this->input->post('percentage');	
		$updated_at=currentDateTime();
		 $sql="Update  refund_discount_percentages set name='$name',description='$description',percentage='$percentage',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Refund Discount Percentage Updated Successfully.');
				redirect(base_url().'index.php/refund_discount_percentages');
			}

	$this->load->view('refund_discount_percentages',$data);


}
public function delete($id)
{
	 $sql="Delete from refund_discount_percentages  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Refund Discount Percentage Deleted Successfully.');
				redirect(base_url().'index.php/refund_discount_percentages');
			}

public function view($id)
{
	$query = $this->db->query('select * from refund_discount_percentages where id='.$id);
	$postData=$query->row_array();
		$data['name']=$postData['name'];
				$data['id']=$postData['id'];
	$data['description']=$postData['description'];
	$data['percentage']=$postData['percentage'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_refund_discount_percentages', $data);
}

}