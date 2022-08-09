<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Vat_setup extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	 $this->load->model('Vat_Setup_Model');
	}
	public function index()
	{
		 $this->load->view('vat_setup_list');
		}

		public function add()

       {
		if($this->input->post('submit'))
		{

		$tax=$this->input->post('tax');
		$description=$this->input->post('description');
		$percentage=$this->input->post('percentage');		
		$vat_no=$this->input->post('vat_no');		
		$created_at=currentDateTime();
		   $this->db->where('tax', $tax);  
		    $this->db->where('description', $description);  
		     $this->db->where('percentage', $percentage);  
		     $this->db->where('vat_no', $vat_no);  
             
           $query = $this->db->get('vat_setups');  
       if($query->num_rows() ==0)  
           {  
               
               //print_r($_FILES['vat_pdf']['name']);die;
            
            $filepath="VAT_docs";
			$vat_pdf = isset($_FILES['vat_pdf'])&& $_FILES['vat_pdf']['name'] != ''?$this->file_upload($_FILES['vat_pdf'],$filepath):'';
	    

        $sql="INSERT into vat_setups(tax,description,percentage,created_at, vat_no, vat_pdf) values('".$tax."','".$description."','".$percentage."','".$created_at."', '".$vat_no."', '".$vat_pdf."')";
		$insert=$this->db->query($sql);


	
				setMessage('New Vat Tax Added Successfully.');
				redirect(base_url().'vat_setup');
		}
			else
			{
				setMessage('VAT Already Exist');
			redirect(base_url().'vat_setup');	
			}
	}
	$this->load->view('vat_setup');
}
public function edit($id)
{

	
	$query = $this->db->query('select * from vat_setups where id='.$id);
	$postData=$query->row_array();
	$data['tax']=$postData['tax'];
	$data['description']=$postData['description'];
	$data['percentage']=$postData['percentage'];
	$data['vat_no']=$postData['vat_no'];
	$data['vat_pdf']=$postData['vat_pdf'];
	if($this->input->post('submit'))
		{$tax=$this->input->post('tax');
		$description=$this->input->post('description');
		$percentage=$this->input->post('percentage');	
		$vat_no=$this->input->post('vat_no');	
		$updated_at=currentDateTime();
        $filepath="VAT_docs";
		$vat_pdf = isset($_FILES['vat_pdf'])&& $_FILES['vat_pdf']['name'] != ''?$this->file_upload($_FILES['vat_pdf'],$filepath):'';
			
		 $sql="Update  vat_setups set vat_no='$vat_no', vat_pdf='$vat_pdf', tax='$tax',description='$description',percentage='$percentage',updated_at='$updated_at' where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Vat Tax Updated Successfully.');
				redirect(base_url().'vat_setup');
			}

	$this->load->view('vat_setup',$data);


}
public function delete($id)
{
	 $sql="Delete from vat_setups  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Vat Tax Deleted Successfully.');
				redirect(base_url().'vat_setup');
			}

public function view($id)
{
	$query = $this->db->query('select * from vat_setups where id='.$id);
	$postData=$query->row_array();
		$data['tax']=$postData['tax'];
				$data['id']=$postData['id'];
	$data['description']=$postData['description'];
	$data['percentage']=$postData['percentage'];
	$data['vat_no']=$postData['vat_no'];
	$data['vat_pdf']=$postData['vat_pdf'];
	$data['percentage']=$postData['percentage'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_vat_setup', $data);
}

function file_upload($FILES,$filepath,$insert_id='')
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
        $time = time();
        $flname = (string)$time."_".$file_name;
		$upload_filename = 'assets/'.$filepath.'/'.$flname;
		$makefilepath =  'assets/'.$filepath;
		if (!is_dir($makefilepath)) {
			mkdir('./'. $makefilepath, 0777, TRUE);
		}
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


			return $filepath.'/'.$flname;
				//echo "Success";
		}else{
			return false;
			print_r($errors);
		}
			//exit();
	}
}

}