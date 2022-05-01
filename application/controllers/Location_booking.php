<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_booking extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
if(!$this->session->userdata('id')){
            redirect('logout');
        }
		 $this->load->library('form_validation');
		 $this->load->model('Location_booking_model','location_booking_model');
       
    }

	
    public function index(){

		
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('location_booking');
        //$this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	
	public function get_location(){
        $id = $this->input->post('id');
        $get_details = $this->location_booking_model->get_location_details($id);
        echo json_encode($get_details);
    }
	public function delete_location(){
		
		$id = $this->input->post('id');
	
		$get_details = $this->location_booking_model->delete_location($id);
	}
	public function check_location_exist(){
        $data = array();
        $data['location_name'] = $this->input->post('location_name');
        $data['location_hidden_id'] = $this->input->post('location_hidden_id');
        $get_details = $this->location_booking_model->check_location_exist($data);	
        echo json_encode($get_details);
		
    }
public function location_status_update(){
		
		$loc_id = $this->input->post('locationid');
		$statid = $this->input->post('statid');
		$reg = $this->input->post('reg');
		$update_data = array(
		               'status' => $statid
					   );
			
		
			    if($this->location_booking_model->update_location_details($update_data, $loc_id))
				{	
	
					echo 'changed';
				}else{
					
					echo 'not-changed';
				}
	}
	
	public function get_location_details(){
        $data = array();
        $get_details = $this->location_booking_model->get_location_list();
        $output ='';
        if($get_details){
                foreach($get_details as $key => $get_list)
                {
					
                        $output .= "<tr>";
                        $output .= "<td>". ++$key ."</td>";
                        $output .= "<td>". $get_list['location'] ."</td>";
						
						$output .= "<td><a href='#' title='Edit' class='btn btn-warning btn-xs edit_location' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
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
	
	public function add_location(){
		
	
		$this->form_validation->set_rules('location','location','trim|required');
	
		if ($this->form_validation->run() == FALSE) { 
			redirect('location_booking');
		}
		else
		{
			$location = trim($this->input->post('location'));
			$id = $this->input->post('location_hidden_id');
		
			
		if($this->input->post('location_hidden_id') == ''){
			 $update_data = array(
		               'location' => $location,
					   'status' => '1'
					);
			
		
			if($this->location_booking_model->add_location_details($update_data))
				{	
					$this->session->set_flashdata('success_message', 'Location added successfully!');
					redirect('location_booking');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
					redirect('location_booking');
				}
			
			
			
		}
		else{
			 $update_data = array(
		                'id' => $this->input->post('location_hidden_id'),
		                'location' => trim($this->input->post('location'))
					);
			if($this->location_booking_model->update_location_details($update_data, $id))
				{	
					$this->session->set_flashdata('success_message', 'Location updated successfully!');
					redirect('location_booking');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not updated Properly!');
					redirect('location_booking');
				}
			
				
		}
		
		
		
			
		}
		
		
		
	 }
    
   
    
   
	
}

?>