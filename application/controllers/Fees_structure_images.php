
<?php 
error_reporting(0); 

defined('BASEPATH') OR exit('No direct script access allowed'); 


class Fees_structure_images extends CI_Controller {  
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Fees_Structure_Images_Model');
		$this->load->helper('url', 'form');

	}
	public function index()
	{
		$this->load->view('fees_structure_images_list');
	}

	public function add()

	{

		
		if($this->input->post('submit'))
		{ 
			$file_name = $_FILES['fee_image_file_name']['name'];
//echo '<pre>';print_r($file_name);exit;

			$activity_id=$this->input->post('activity_id');
			$description=$this->input->post('description');
			$fee_image_file_name=$this->input->post('fee_image_file_name');	




			$created_at=currentDateTime();



			$this->db->where('activity_id', $activity_id);  
			$this->db->where('description', $description);  


			$query = $this->db->get('fees_structure_images');  
			if($query->num_rows() ==0)  
			{  

				$this->db->set('activity_id', $activity_id);
				$this->db->set('description', $description);
				$this->db->set('fee_image_file_name', $file_name);
				$this->db->set('created_at', $created_at);
				$this->db->insert('fees_structure_images');







				$email=$this->session->userdata('username');
				$this->db->where('email', $email);  

				$query1 = $this->db->get('users');
				$postData1=$query1->row_array();
				$user_id=$postData1['user_id'];

				$filepath="Fees_structure_images";
				$insert_id=$user_id;
				$test=$this->file_upload($_FILES['fee_image_file_name'],$filepath,$insert_id);



				setMessage('New Fees Structure Images Added Successfully.');
		redirect(base_url().'fees_structure_images');


			}
			else
			{
				setMessage('Fees Structure Image Already Exist');
				redirect(base_url().'fees_structure_images');	
			}
		}
		$this->load->view('fees_structure_images');
	}
	public function edit($id)
	{


		$query = $this->db->query('select * from fees_structure_images where id='.$id);
		$postData=$query->row_array();
		$data['activity_id']=$postData['activity_id'];
		$data['description']=$postData['description'];
		$data['fee_image_file_name']=$postData['fee_image_file_name'];
		if($this->input->post('submit'))
			{ $activity_id=$this->input->post('activity_id');
		$description=$this->input->post('description');
		$fee_image_file_name=$_FILES['fee_image_file_name']['name'];
		if($fee_image_file_name=="")
		{
			 $fee_image_file_name=$this->input->post('fee_image_file_name1');
		}

		$updated_at=currentDateTime();



			$email=$this->session->userdata('username');
				$this->db->where('email', $email);  

				$query1 = $this->db->get('users');
				$postData1=$query1->row_array();
				$user_id=$postData1['user_id'];

				$filepath="Fees_structure_images";
				$insert_id=$user_id;
				$test=$this->file_upload($_FILES['fee_image_file_name'],$filepath,$insert_id);
					$test2=$this->file_upload($_FILES['fee_image_file_name'],$filepath,$insert_id);

		

		

		$sql="Update  fees_structure_images set activity_id='$activity_id',description='$description',fee_image_file_name='$fee_image_file_name',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);



		setMessage('Fees Structure Images Updated Successfully.');
		redirect(base_url().'Fees_structure_images');
	}

	$this->load->view('fees_structure_images',$data);


}
public function delete($id)
{
	$sql="Delete from fees_structure_images  where id='$id'";
	$insert=$this->db->query($sql);


	
	setMessage('Fees Structure Images Deleted Successfully.');
	redirect(base_url().'fees_structure_images');
}

public function view($id)
{
	$query = $this->db->query('select * from fees_structure_images where id='.$id);
	$postData=$query->row_array();
	$data['activity_id']=$postData['activity_id'];
	$data['id']=$postData['id'];
	$data['description']=$postData['description'];
	$data['fee_image_file_name']=$postData['fee_image_file_name'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_fees_structure_images', $data);
}
function file_upload($FILES,$filepath,$insert_id)
{
		//echo '<pre>';print_r($FILES);exit;
	if(isset($FILES)){
			//echo "stringaa";
		$errors= array();
		$file_name = $FILES['name'];
		$file_size =$FILES['size'];
		$file_tmp =$FILES['tmp_name'];
		$file_type=$FILES['type'];


		$file_ext=explode('.',$file_name);
		$file_ext = $file_ext[1];

    
		$upload_filename = 'assets/'.$filepath.'/'.$file_name;
		
		/*$makefilepath =  'assets/'.$filepath.'/'.$insert_id;
		if (!is_dir($makefilepath)) {
			mkdir('./'. $makefilepath, 0777, TRUE);
		}
		*/
			//echo '<pre>';print_r($upload_filename);exit;
		$extensions= array("jpeg","jpg","png");
//    $extensions= array("pdf","doc",'docx','xlsx');

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a pdf or doc file.";
		}

//if($file_size > 2097152){
  //   $errors[]='File size must be excately 2 MB';
// }

		if(empty($errors)==true){
			move_uploaded_file($file_tmp,$upload_filename);


			return true;
				//echo "Success";
		}else{
			return false;
			print_r($errors);
		}
			//exit();
	}
}
}
