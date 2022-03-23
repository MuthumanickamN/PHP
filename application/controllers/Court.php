<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Court extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }
        // Load database
$this->load->library('image_lib');
		 $this->load->library('form_validation');
        $this->load->model('Court_Model','court_model');
		$this->load->model('Sports_Model','sports_model');
		//$this->load->library('upload');
       
    }

	
    public function index(){
        // Load our view to be displayed
        // to the user
        $data = array();
        $data['title'] = 'Court Management';
        $data['username'] = $this->session->userdata('username');
        $data['location_list'] = $this->court_model->get_locationlist();
		$data['sports_list'] = $this->court_model->get_sports_list();
		
        $data['form_action'] = base_url().'court/add_court'; 
		$this->load->view('includes/header3');
        //$this->load->view('templates/header', $data);
        $this->load->view('court', $data);
        //$this->load->view('templates/footer', $data);
       
    }
     public function check_court_exist(){
        $data = array();
		
		$data['sports_id'] = ($this->input->post('sports_id') !='') ? $this->input->post('sports_id'):'';
		$data['location_id'] = ($this->input->post('location_id') !='') ? $this->input->post('location_id'):'';
        $data['court_name'] = ($this->input->post('court_name') !='') ? $this->input->post('court_name'):'';
        $data['hid_id'] = ($this->input->post('hid_id') !='') ? $this->input->post('hid_id'):'';
        $get_details = $this->court_model->check_court_exist($data);
        //header("Content-type: application/json");		
        echo json_encode($get_details);
        //echo $this->db->last_query();
	   
		
    }
   public function delete_court(){
		
		$id = $this->input->post('id');
	
		$get_details = $this->court_model->delete_court($id);
	}
    public function add_court(){
		
		if(!empty($_FILES['court_file']['name'])){
               
        //$config['file_name'] = $_FILES['court_file']['name'];
	    $config['upload_path'] = "uploads/images/";
        $config['upload_url'] = base_url() . "uploads/images/";
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['overwrite'] = TRUE;
        /* $config['max_size'] = "1000KB";
        $config['max_height'] = "200";
        $config['max_width'] = "200"; */
        $config['encrypt_name'] = TRUE;
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('court_file')){


                //resize
		$config_resize['source_image'] = $this->upload->upload_path.$this->upload->file_name;
		$config_resize['maintain_ratio'] = FALSE;
		$config_resize['width'] = 600;
		$config_resize['height'] = 338;
		$this->load->library('image_lib', $config_resize);
		 $this->image_lib->initialize($config_resize);
		$this->image_lib->resize();
		//-resize



                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					
                }else{
                    $picture = 'upload failed'.$_FILES['court_file']['name'];
                }
            }else{
				//$picture = $this->input->post('image_hidden');
				if($this->input->post('image_hidden') != ''){
				          $picture = $this->input->post('image_hidden');
				}
				else{
					$picture = '';
				}
				
            }
		
        if($this->input->post('hidden_id') == ''){

		
            $insert_data = array(
                'sid' => $this->input->post('sports_id'),
                'lid' => $this->input->post('location_id'),
                'courtname' => trim($this->input->post('court_name')),
                'courttype' => $this->input->post('court_type'),
				'from_time' => $this->time_format($this->input->post('timepicker1')),
				'to_time' => $this->time_format($this->input->post('timepicker2')),
				'address' => $this->input->post('court_address'),
				'locationmap' => $this->input->post('court_location_map'),	
                'addinfo' => $this->input->post('court_add_info'),
				'imgfilename' => $picture,
                'status' => '1'				
            );
			//print_r($insert_data);exit;
            if($this->court_model->add_court_details($insert_data))
            {	
                $this->session->set_flashdata('success_message', 'Court Details added successfully!');
                redirect('court');
            }else{
                $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
                redirect('court');
            }
        }
        else{
			$id = $this->input->post('hidden_id');
            $update_data = array(
                'sid' => $this->input->post('sports_id'),
                'lid' => $this->input->post('location_id'),
                'courtname' => trim($this->input->post('court_name')),
                'courttype' => $this->input->post('court_type'),
				'from_time' => $this->time_format($this->input->post('timepicker1')),
				'to_time' => $this->time_format($this->input->post('timepicker2')),
				'address' => $this->input->post('court_address'),
				'locationmap' => $this->input->post('court_location_map'),	
                'addinfo' => $this->input->post('court_add_info'),
				'imgfilename' => $picture			
            );

            if($this->court_model->update_court_details($update_data,$this->input->post('hidden_id')))
            {	
//echo 'update';exit;		
                $this->session->set_flashdata('success_message', 'Court Details Updated successfully!');
                redirect('court');
            }else{
				//echo 'update failed';exit;
                $this->session->set_flashdata('success_message', 'Data are not updated!');
                redirect('court');
            }

        }
	/* } */
        
    }
    public function time_format($time)
	{
	$datetime=date('H:i:s',strtotime($time));
	return $datetime;
	}
    
     public function get_court_details(){
        $id = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $get_details = $this->court_model->get_court_details($id);
        echo json_encode($get_details);
    }
    public function court_status_update(){
		
		$courtid = $this->input->post('courtid');
		$statid = $this->input->post('statid');
		$reg = $this->input->post('reg');
		$update_data = array(
		               'status' => $statid
					   );
			
		
			    if($this->court_model->update_court_details($update_data, $courtid))
				{	
	
					echo 'changed';
				}else{
					
					echo 'not-changed';
				}
	}
     public function get_court_list(){
        $data = array();
        //$data['court_name'] = ($this->input->post('court_name') !='') ? $this->input->post('court_name') : '';
        $get_details = $this->court_model->get_court_list();
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {
                    
                    $output .= "<tr>";
                    $output .= "<td>". ++$key ."</td>";
					$output .= "<td>". $get_list['sportsname'] ."</td>";
					$output .= "<td>". $get_list['location'] ."</td>";
                    $output .= "<td>". ucfirst($get_list['courtname']) ."</td>";
					
                    $output .= "<td><a href='#editModal' data-toggle='modal' class='btn btn-warning btn-xs edit_court' data-id='".$get_list['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true' title='Edit'></i></a></td>";
                    /* $output .= "<td><a href='javascript:void(0)' class='delete_user delete_court' data-id='".$get_list['id']."'><i class='glyphicon glyphicon-trash' aria-hidden='true'  title='Delete Court'></i></a></td>"; */
					
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
//        else{
//                $output .= "<tr><td colspan='4' align='center'>No Record Found!</td></tr>";
//        }
        echo $output;
    }
    
   
	
}

?>