<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
class TermsConditions extends CI_Controller {  
      
    
	public function __construct()
	{
	parent::__construct();
	$this->load->model('TermsConditions_model');
	$this->load->library('upload');
	}

	Private function set_upload_options()
	{   
	//upload an image options
	$config = array();
	$config['upload_path'] = './assets/termsandconditions_documents/';
	$config['allowed_types'] = '*';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
	}
	public function index() 	
	{
		$data['upload_items'] = $this->TermsConditions_model->upload_items(1);
		//print_r ($data);die;
		$this->load->view('termsconditions',$data);
	}

	

	public function edit_details()
	{	
		$id = $this->input->post('id');				
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$myFile = $_FILES['userfile'];
		for($i=0; $i<$cpt; $i++)
			{   
				$error = $myFile["error"][$i];
				if ($error == '4')  
				{
				}
				else
				{
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('userfile');
							
					//$sql1="INSERT into termsconditionsuploadedfiles(filename) values('".$files['userfile']['name'][$i]."')";
					$sql1="Update  termsconditionsuploadedfiles set filename='".$files['userfile']['name'][$i]."' where id = 1 ";
					//print_r ($sql1);die;
					$this->db->query($sql1);
				}
			}				
			
			redirect(base_url().'TermsConditions/');	
			
	}
}





?>
