<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class AccountServiceType extends CI_Controller {  
	
        public function __construct()
            {
            parent::__construct();
        
            $this->load->model('AccountServiceType_model');
            }
	    public function index()
            {
            $this->load->view('accountservicetype_list');
            }

		public function add()

        {
                if($this->input->post('submit'))
                {

                    $Name=$this->input->post('Name');
                    $Account_code=$this->input->post('Account_code');
                    $Type=$this->input->post('Type');		
                    $this->db->where('Name', $Name); 
                    $this->db->where('Account_code', $Account_code);
                    $this->db->where('Type', $Type);           
                    $query = $this->db->get('accounts_service');  
                    if($query->num_rows() ==0)  
                    {  
                            $sql="INSERT into accounts_service(Name,Account_code,Type) values('".$Name."','".$Account_code."','".$Type."')";
                            $insert=$this->db->query($sql);
                        // echo $this->db->last_query();die;
                        // print_r ($insert);die;
                            setMessage('New Accounts Service Added Successfully.');
                            redirect(base_url().'accountservicetype');
                        }
                        else
                        {
                            setMessage('AccountsService Already Exist');
                            redirect(base_url().'accountservicetype');	
                        }
                }
                $this->load->view('accountservicetype');
        }
        public function edit($Id)
        {
            $query = $this->db->query('select * from accounts_service where Id='.$Id);
            $postData=$query->row_array();
            $data['Name']=$postData['Name'];
            $data['Account_code']=$postData['Account_code'];
            $data['Type']=$postData['Type'];
            if($this->input->post('submit'))
                {
                        $Name=$this->input->post('Name');
                        $Account_code=$this->input->post('Account_code');
                        $Type=$this->input->post('Type');
                        $sql="Update  accounts_service set Name='$Name', Account_code='$Account_code', Type='$Type' where Id='$Id'";
                        $insert=$this->db->query($sql);
                        //echo $this->db->last_query();die;
                        setMessage('Accounts Service Updated Successfully.');
                        redirect(base_url().'accountservicetype');
                    }

            $this->load->view('accountservicetype',$data);


        }
        public function delete($Id)
            {
                $sql="Delete from accounts_service  where Id='$Id'";
                $insert=$this->db->query($sql);
				setMessage('Accounts Service Deleted Successfully.');
				redirect(base_url().'accountservicetype');
			}

        public function view($Id)
        {
            $query = $this->db->query('select * from accounts_service where Id='.$Id);
            $postData=$query->row_array();
            $data['Name']=$postData['Name'];
            $data['Id']=$postData['Id'];
            $data['Account_code']=$postData['Account_code'];
            $data['Type']=$postData['Type'];
            $this->load->view('view_accountservicetype', $data);
        }
}