<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Set_academy_holiday extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
    $this->load->model('Set_Academy_Holiday_Model');
	
	}
	public function index()
	{
		 $this->load->view('set_academy_holiday_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$select_date=$this->input->post('select_date');
		$holiday_name=$this->input->post('holiday_name');
		
	$created_at=currentDateTime();

	      $this->db->where('holiday_name', $holiday_name); 
	        $this->db->where('select_date', $select_date);  
             
           $query = $this->db->get('set_academy_holidays');  
       if($query->num_rows() ==0)  
           {  

        $sql="INSERT into set_academy_holidays(select_date,holiday_name,created_at) values('".$select_date."','".$holiday_name."','".$created_at."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Holiday Added Successfully.');
				redirect(base_url().'set_academy_holiday');
		}
			else
			{
				setMessage('Holiday Already Exist');
			redirect(base_url().'set_academy_holiday');	
			}
	}
	$this->load->view('set_academy_holiday');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from set_academy_holidays where id='.$id);
	$postData=$query->row_array();
	$data['select_date']=$postData['select_date'];
	$data['holiday_name']=$postData['holiday_name'];
	if($this->input->post('submit'))
		{
			$select_date=$this->input->post('select_date');
		$holiday_name=$this->input->post('holiday_name');
		$updated_at=currentDateTime();

		 $sql="Update  set_academy_holidays set select_date='$select_date',holiday_name='$holiday_name',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Holiday Updated Successfully.');
				redirect(base_url().'set_academy_holiday');
			}

	$this->load->view('set_academy_holiday',$data);


}
public function delete($id)
{
	 $sql="Delete from set_academy_holidays  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Holiday Deleted Successfully.');
				redirect(base_url().'set_academy_holiday');
			}

public function view($id)
{
	$query = $this->db->query('select * from set_academy_holidays where id='.$id);
	$postData=$query->row_array();
	$data['select_date']=$postData['select_date'];
	$data['holiday_name']=$postData['holiday_name'];
	$data['id']=$postData['id'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_holiday', $data);
}

}