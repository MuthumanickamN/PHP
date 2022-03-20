<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sports extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
if(!$this->session->userdata('id')){
            redirect('logout');
        }
		$this->load->library('form_validation');
		 $this->load->model('sports_model');
       
    }

	
    public function index(){
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('sports');
        //$this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	public function check_sports_exist(){
        $data = array();
        $data['sports_name'] = $this->input->post('sports_name');
        $data['sports_hidden_id'] = $this->input->post('sports_hidden_id');
        $get_details = $this->sports_model->check_sports_exist($data);	
		/* if($get_details)
		{
			echo 'false';
		}
		else{
			echo 'true';
		} */
        echo json_encode($get_details);
		
    }
    
   public function get_sports(){
        $id = $this->input->post('id');
        $get_details = $this->sports_model->get_sports_details($id);
        echo json_encode($get_details);
    }
	public function delete_sports(){
		
		$id = $this->input->post('id');
	
		$get_details = $this->sports_model->delete_sports($id);
		return $get_details;
	}
	public function sports_status_update(){
		
		$sportsid = $this->input->post('sportsid');
		$statid = $this->input->post('statid');
		$reg = $this->input->post('reg');
		$update_data = array(
		               'status' => $statid
					   );
			
		
			    if($this->sports_model->update_sports_details($update_data, $sportsid))
				{	
	
					echo 'changed';
				}else{
					
					echo 'not-changed';
				}
	}
	
	public function get_sports_details(){
        $data = array();
        $get_details = $this->sports_model->get_sports_list();
        $output ='';
        if($get_details){
                foreach($get_details as $key => $get_list)
                {
					
                        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
                        $output .= "<td>". $get_list['sportsname'] ."</td>";
						
						$output .= "<td><a href='#' title='Edit' class='btn btn-warning btn-xs edit_sports' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                       /* $output .= "<td><button type='submit' title='Remove' data-id='". $get_list['id'] ."' class='btn btn-danger btn-xs delete_sports'><i class='glyphicon glyphicon-trash'></i></button></td>"; */
						if($get_list['status']==0)
						{
						$bt_cls="btn-danger";
						$cls="fa-times";
						}else{
						$bt_cls="btn-success";
						$cls="fa-check";
						}

						$output .= "<td><a class='". $bt_cls." btn-xs comp' href='javascript:;'  id='".$get_list['id']."' stat_at='".$get_list['status']."'>
						<i class='fa ".$cls."'  aria-hidden='true'></i>
						</a></td>";
                       
                        
                        $output .= "</tr>";
                }
        }
        echo $output;
	}
	
	public function add_sports(){
		
	
		$this->form_validation->set_rules('sports','sports','trim|required|xss_clean');
	
		if ($this->form_validation->run() == FALSE) { 
			redirect('sports');
		}
		else
		{
			$sports = trim($this->input->post('sports'));
			$id = $this->input->post('sports_hidden_id');
		
			
		if($this->input->post('sports_hidden_id') == ''){
			 $update_data = array(
		               'sportsname' => $sports,
					   'status' => '1'
					);
			
		
			if($this->sports_model->add_sports_details($update_data))
				{	
					$this->session->set_flashdata('success_message', 'sportsname added successfully!');
					redirect('sports');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
					redirect('sports');
				}
			
			
			
		}
		else{
			 $update_data = array(
		                'id' => $this->input->post('sports_hidden_id'),
		                'sportsname' => trim($this->input->post('sports'))
					);
			if($this->sports_model->update_sports_details($update_data, $id))
				{	
					$this->session->set_flashdata('success_message', 'sportsname updated successfully!');
					redirect('sports');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not updated Properly!');
					redirect('sports');
				}
			
				
		}
		
		
		
			
		}
		
		
		
	 }
    
   
	
}

?>