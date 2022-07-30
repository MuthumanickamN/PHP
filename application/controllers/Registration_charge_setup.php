<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Registration_charge_setup extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('registration_charge_setup_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$category=$this->input->post('category');
		$registration_fees=$this->input->post('registration_fees');
		$note=$this->input->post('note');
		
			$created_at=currentDateTime();

	 $this->db->where('category', $category); 
	  //$this->db->where('reg_fee', $registration_fees);  
	   //$this->db->where('note', $note);  
             
           $query = $this->db->get('reg_charge_setups');  
       if($query->num_rows() ==0)  
           {  
	    

        $sql="INSERT into reg_charge_setups(reg_fee,note,category,created_at) values('".$registration_fees."','".$note."','".$category."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Registration Charge Setup Added Successfully.');
				redirect(base_url().'Registration_charge_setup');
		}
			else
			{
				setMessage('Registration Category Already Exist');
			redirect(base_url().'Registration_charge_setup');
			}
	}
	$this->load->view('registration_charge_setup');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from reg_charge_setups where id='.$id);
	$postData=$query->row_array();
	$data['fees']=$postData['reg_fee'];
	$data['category']=$postData['category'];
	$data['note']=$postData['note'];
	if($this->input->post('submit'))
		{
			$fees=$this->input->post('registration_fees');
		$note=$this->input->post('note');
		$category=$this->input->post('category');
		$updated_at=currentDateTime();

		 $sql="Update  reg_charge_setups set reg_fee='$fees',note='$note',category='$category',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Registration Charge Setup Updated Successfully.');
				redirect(base_url().'index.php/registration_charge_setup');
			}

	$this->load->view('registration_charge_setup',$data);


}
public function delete($id)
{
	 $sql="Delete from reg_charge_setups  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Registration Charge Setup Deleted Successfully.');
				redirect(base_url().'index.php/registration_charge_setup');
			}

public function view($id)
{
	$query = $this->db->query('select * from reg_charge_setups where id='.$id);
	$postData=$query->row_array();
	$data['category']=$postData['category'];
	$data['id']=$postData['id'];
	$data['note']=$postData['note'];
	$data['fees']=$postData['reg_fee'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_registration_charge_setup', $data);
}

}