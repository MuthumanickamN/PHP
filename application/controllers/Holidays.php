<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holidays extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');

       if(!$this->session->userdata('id')){
            redirect('logout');
        }
		
		 $this->load->library('form_validation');
		 $this->load->model('Holidays_Model','holidays_model');
    }

	
    public function index(){
		$this->load->view('includes/header3');
		//$this->load->view('templates/header');
        $this->load->view('holidays');
        //$this->load->view('templates/footer');
        // Load our view to be displayed
        // to the user

       
    }
	public function delete_holidays(){
		
		$id = $this->input->post('id');
	
		$get_details = $this->holidays_model->delete_holidays($id);
	}
	public function get_holidays_details(){
        $data = array();
        $get_details = $this->holidays_model->get_holidays_list();
        $output ='';
        if($get_details){
                foreach($get_details as $key => $get_list)
                {
					$newDate = date("d-m-Y", strtotime($get_list['holidaydate']));
                        $output .= "<tr>";
                       // $output .= "<td>". ++$key ."</td>";
                        $output .= "<td>". $newDate ."</td>";
						
						/* $output .= "<td><a href='#' title='Edit' class='btn btn-warning btn-xs edit_sports' data-id='". $get_list['id'] ."' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>"; */
                       $output .= "<td><button type='submit' title='Remove' data-id='". $get_list['id'] ."' class='btn btn-danger btn-xs delete_holidays'><i class='glyphicon glyphicon-trash'></i></button></td>";
                       
                        
                        $output .= "</tr>";
                }
        }
        echo $output;
	}
    
   public function add_holidays(){
		
	
		$this->form_validation->set_rules('datepicker','datepicker','trim|required');
	
		if ($this->form_validation->run() == FALSE) { 
			redirect('holidays');
		}
		else
		{
			$location = $this->input->post('datepicker');
			
		$data = array(
		               'holidaydate' => change_date_format($this->input->post('datepicker'))
					);
			
			if($this->holidays_model->add_holidays_details($data))
				{	
					$this->session->set_flashdata('success_message', 'Holiday date added successfully!');
					redirect('holidays');
				}else{
					$this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
					redirect('holidays');
				}
		
		
		
		
			
		}
		
		
		
	 }
    
   
	
}

?>