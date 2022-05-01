<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Discount_setup extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('discount_setup_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$discount_name=$this->input->post('discount_name');
		$discount_percentage=$this->input->post('discount_percentage');
		
		$created_at=currentDateTime();

	 $this->db->where('discount_name', $discount_name); 
	  $this->db->where('discount_percentage', $discount_percentage);  
             
           $query = $this->db->get('discount_setups');  
       if($query->num_rows() ==0)  
           {  

	    

        $sql="INSERT into discount_setups(discount_name,discount_percentage,created_at) values('".$discount_name."','".$discount_percentage."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Discount Setup Added Successfully.');
				redirect(base_url().'index.php/discount_setup');
		}
			else
			{
				setMessage('Discount Setup Already Exist');
			redirect(base_url().'index.php/discount_setup');
			}
	}
	$this->load->view('discount_setup');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from discount_setups where id='.$id);
	$postData=$query->row_array();
	$data['discount_name']=$postData['discount_name'];
	$data['discount_percentage']=$postData['discount_percentage'];
	if($this->input->post('submit'))
		{
			$discount_name=$this->input->post('discount_name');
		$discount_percentage=$this->input->post('discount_percentage');
		$updated_at=currentDateTime(); 
		
		 $sql="Update  discount_setups set discount_name='$discount_name',discount_percentage='$discount_percentage',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Discount Setups Updated Successfully.');
				redirect(base_url().'index.php/discount_setup');
			}

	$this->load->view('discount_setup',$data);


}
public function delete($id)
{
	 $sql="Delete from discount_setups  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Discount Setup Deleted Successfully.');
				redirect(base_url().'index.php/discount_setup');
			}

public function view($id)
{
	$query = $this->db->query('select * from discount_setups where id='.$id);
	$postData=$query->row_array();
	$data['id']=$postData['id'];
	$data['discount_name']=$postData['discount_name'];
	$data['discount_percentage']=$postData['discount_percentage'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_discount_setup', $data);
}

}