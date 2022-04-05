<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        if(!$this->session->userdata('id')){
            redirect('logout');
        }
        // Load library
        $this->load->library('form_validation');
        
        // Load database
	$this->load->model('Pricing_Model', 'pricing_model');
        $this->load->model('Court_Model','court_model');
       
    }

	
    public function index(){
        // Load our view to be displayed
        // to the user
        $data = array();
        $data['title'] = 'Settings:: Pricing List';
        $data['username'] = $this->session->userdata('username');
        $this->load->view('includes/header3');
       // $this->load->view('templates/header', $data);
        $this->load->view('pricing', $data);
        //$this->load->view('templates/footer', $data);
    }
    
    public function add_pricing(){
        // Load our view to be displayed
        // to the user
        $data = array();
        $data['title'] = 'Settings:: Add Pricing';
        $data['username'] = $this->session->userdata('username');        
        $data['sports_list'] = $this->pricing_model->get_sportslist();
        //$data['location_list'] = $this->pricing_model->get_locationlist();
        $data['holidays'] = $this->pricing_model->get_holidayslist();
        $data['day_list'] = $this->pricing_model->get_daylist();
        $data['id'] = '';
        $data['form_action'] = base_url().'pricing/add_pricing_details'; 
		$this->load->view('includes/header3');
       // $this->load->view('templates/header', $data);
        $this->load->view('pricing_form', $data);
       // $this->load->view('templates/footer', $data);
       
    }
    
    public function edit_pricing($id){
        // Load our view to be displayed
        // to the user
        $data = array();
        $data['title'] = 'Settings:: Edit Pricing';
        $data['username'] = $this->session->userdata('username');
        $data['id'] = $id;
        $data['sports_list'] = $this->pricing_model->get_sportslist();
        //$data['location_list'] = $this->pricing_model->get_locationlist();
        $data['holidays'] = $this->pricing_model->get_holidayslist();
        $data['day_list'] = $this->pricing_model->get_daylist();
        $data['pricing_details'] = $this->pricing_model->get_pricing_details($id);
        $data['pricing_slot_details'] = $this->pricing_model->get_pricingslot_details($id);
        $data['form_action'] = base_url().'pricing/add_pricing_details'; 
		$this->load->view('includes/header3');
        //$this->load->view('templates/header', $data);
        $this->load->view('pricing_form', $data);
       // $this->load->view('templates/footer', $data);
       
    }
    
    public function add_pricing_details(){
        //die();
        if($this->input->post('hidden_id') == '')
        {
            $insert_data = array(
                'sid' => $this->input->post('sports'),
                'lid' => $this->input->post('location'),
                'cid' => $this->input->post('court'),
                'day_type' => $this->input->post('day_type'),
                'fromday' => ($this->input->post('from_day') !='') ? $this->input->post('from_day') : '0',
                'today' => ($this->input->post('to_day') !='') ? $this->input->post('to_day') : '0',	
                'holiday_id' => ($this->input->post('holidays') !='') ? $this->input->post('holidays') : '0',
                'modified_date' => date('Y-m-d H:i:s'),
                'delete_status' => '0'
            );    
//            echo '<pre>';
//            print_r($insert_data);
//            die();
            $count = $this->input->post('slotcount');
            $fromTimes = $this->input->post('from_time', TRUE);
            $toTimes = $this->input->post('to_time', TRUE);
            $slot_price = $this->input->post('slot_price', TRUE);
            $insert_id = $this->pricing_model->add_pricing_details($insert_data);
            if($insert_id !='')
            {
                $this->add_pricing_timeslot_details($fromTimes, $toTimes, $slot_price, $insert_id);
                $this->session->set_flashdata('success_message', 'Pricing details added successfully!');
                redirect('pricing');
            }else{
                $this->session->set_flashdata('error_message', 'Data are not inserted Properly!');
                redirect('pricing');
            }
        }
        else{
            
            $update_data = array(
                'sid' => $this->input->post('sports'),
                'lid' => $this->input->post('location'),
                'cid' => $this->input->post('court'),
                'day_type' => $this->input->post('day_type'),
                'fromday' => ($this->input->post('from_day') !='') ? $this->input->post('from_day') : '0',
                'today' => ($this->input->post('to_day') !='') ? $this->input->post('to_day') : '0',	
                'holiday_id' => ($this->input->post('holidays') !='') ? $this->input->post('holidays') : '0',
                'modified_date' => date('Y-m-d H:i:s')
                
            );    
            $count = $this->input->post('slotcount');
            $fromTimes = $this->input->post('from_time', TRUE);
            $toTimes = $this->input->post('to_time', TRUE);
            $slot_price = $this->input->post('slot_price', TRUE);
            $pricing_timeslot_id = $this->input->post('pricing_timeslot_id', TRUE);
            $price_slot_details = array(
                'count' => $count,
                'pricing_timeslot_id' => $pricing_timeslot_id,
                'pricing_id' => $this->input->post('hidden_id'),
                'fromTimes' => $fromTimes,
                'toTimes' => $toTimes,
                'slot_price' => $slot_price                
            );    
           
            if($this->pricing_model->update_pricing_details($update_data,$this->input->post('hidden_id')))
            {
                $this->update_pricing_timeslot_details($price_slot_details);
                $this->session->set_flashdata('success_message', 'Pricing details updated successfully!');
                redirect('pricing');
            }else{
                $this->session->set_flashdata('error_message', 'Data are not updated Properly!');
                redirect('pricing');
            }
            
        }
       
    }
    
    public function add_pricing_timeslot_details($fromTimes,$toTimes,$slot_price,$id){
        if (is_array($fromTimes) && is_array($toTimes)) {
            foreach( $fromTimes as $key => $fromTime ) {                
            $insert_data = array(
                'pid' => $id,
                'fromtime' => date("H:i:s", strtotime($fromTimes[$key])),
                'totime' => date("H:i:s", strtotime($toTimes[$key])),
                'cost' => $slot_price[$key]		
            );    
            $this->pricing_model->add_pricing_timeslot_details($insert_data);        
            }
        } 
    }
    
    public function update_pricing_timeslot_details($price_slot_details){
        $slotids = array();
        //echo '<pre>';
        for($i=0; $i<$price_slot_details['count']; $i++){
            if($price_slot_details['pricing_timeslot_id'][$i] !=''){
                $update_data = array(
                    'pid' => $price_slot_details['pricing_id'],
                    'fromtime' => date("H:i", strtotime($price_slot_details['fromTimes'][$i])),
                    'totime' => date("H:i", strtotime($price_slot_details['toTimes'][$i])),
                    'cost' => $price_slot_details['slot_price'][$i]		
                );   
                $this->pricing_model->update_pricing_timeslot_details($update_data, $price_slot_details['pricing_timeslot_id'][$i]);
                array_push($slotids,$price_slot_details['pricing_timeslot_id'][$i]);
            }
            else{
                $insert_data = array(
                    'pid' => $price_slot_details['pricing_id'],
                    'fromtime' => date("H:i", strtotime($price_slot_details['fromTimes'][$i])),
                    'totime' => date("H:i", strtotime($price_slot_details['toTimes'][$i])),
                    'cost' => $price_slot_details['slot_price'][$i]		
                );  
                $insert_id = $this->pricing_model->add_pricing_timeslot_details($insert_data);
                array_push($slotids,$insert_id);
            }
        }
        $this->delete_pricing_slot($slotids, $price_slot_details['pricing_id']);
    }
    
    private function delete_pricing_slot($slotids, $pid){      
        $this->pricing_model->delete_pricing_slot($slotids, $pid);        
    }
    
    public function delete_pricing_details(){
        $pricing_id = ($this->input->post('pid') !='') ? $this->input->post('pid') : '';
        $update_data = array(
            'delete_status' => '1'	
        );   
        $this->pricing_model->update_pricing_details($update_data,$pricing_id);
    }
    
    public function get_courtnames(){
        $data = array();
        $data['sports_id'] = ($this->input->post('sports_id') !='') ? $this->input->post('sports_id') : '';
        $data['location_id'] = ($this->input->post('location_id') !='') ? $this->input->post('location_id') : '';
        $get_details = $this->pricing_model->get_courtlist($data);
        if($get_details){
        $output = '<option value="">- Select Court -</option>';
        foreach($get_details as $list){ 
            $output .='<option value="'.$list['id'].'">'.$list['courtname'].'</option>';
        }
        }else{
            $output .='<option value="">Court not available</option>';
        }
        echo $output;
    }
    
    public function get_pricing_list(){
        $data = array();
        //$data['id'] = ($this->input->post('id') !='') ? $this->input->post('id') : '';
        $data['id'] = '';
        $get_details = $this->pricing_model->get_pricing_list($data);
        $output ='';
        if($get_details){                
                foreach($get_details as $key => $get_list)
                {
                    $fromday = $this->get_daynames($get_list['fromday']);
                    $today = $this->get_daynames($get_list['today']);
                    if($get_list['day_type'] == '0'){
                       $day_type = 'Single';
                    }
                    elseif($get_list['day_type'] == '1'){
                       $day_type = 'Multiple';
                    }else{
                       $day_type = 'Holiday'; 
                    }
                    $output .= "<tr>";
                    $output .= "<td>".++$key."</td>";
                    $output .= "<td>". ucfirst($get_list['courtname']) ."</td>";
                    $output .= "<td>". ucfirst($get_list['sportsname']) ."</td>";
                    $output .= "<td>". ucfirst($get_list['location']) ."</td>";                    
                    $output .= "<td>". $day_type ."</td>";
                    if($get_list['day_type'] == '1'){
                        $output .= "<td>". ucfirst(substr($fromday, 0, 3)).'-'.ucfirst(substr($today, 0, 3))."</td>";
                    }
                    elseif($get_list['day_type'] == '0'){
                        $output .= "<td>". ucfirst(substr($fromday, 0, 3))."</td>";
                    }else{
                        $output .= "<td>". $this->get_holidayDate($get_list['holiday_id'])."</td>";
                    }
                    //$output .= "<td><a href='".base_url()."pricing/edit_pricing/".$get_list['id']."' data-toggle='modal' class='btn btn-warning btn-xs edit_court'><i class='fa fa-pencil-square-o' aria-hidden='true' title='Edit'></i></a></td>";
					$output .= "<td><a data-id='".$get_list['id']."' data-toggle='modal' class='btn btn-warning btn-xs edit_court'><i class='fa fa-pencil-square-o' aria-hidden='true' title='Edit'></i></a></td>";
                    
                    $output .= "<td><a href='javascript:void(0)' class='delete_user' data-id='".$get_list['id']."'><i class='glyphicon glyphicon-trash' aria-hidden='true'  title='Delete Court'></i></a></td>";
                    $output .= "</tr>";
                }
        }
//        else{
//                $output .= "<tr><td colspan='6' align='center'>No Record Found!</td></tr>";
//        }
        echo $output;
    }
    
    public function get_daynames($id){
        $dayname = '';
        $get_details = $this->pricing_model->get_dayname($id);
        if($get_details){
            $dayname = $get_details['dayname'];
        }
        return $dayname;
    }
    
    public function get_holidayDate($id){
        $holidaydate = '';
        $get_details = $this->pricing_model->get_holidayDate($id);
        if($get_details){
            $holidaydate = $get_details['holidaydate'];
        }
        return $holidaydate;
    }
    
    public function get_courtdetails(){
        $data = array();
        $data['id'] = ($this->input->post('cid') !='') ? $this->input->post('cid') : '';
        $result = array();
        $get_details = $this->pricing_model->get_courtdetails($data);
        if($get_details){
            $result['from_time'] = date('h:i A', strtotime($get_details['from_time']));
            $result['to_time'] = date('h:i A', strtotime($get_details['to_time']));            
        }
        echo json_encode($result);
    }
    
    public function check_courtExist(){
        $data = array();
        $data['cid'] = ($this->input->post('cid') !='') ? $this->input->post('cid') : '';
        $data['day_type'] = ($this->input->post('day_type') !='') ? $this->input->post('day_type') : '';
        $data['id'] = ($this->input->post('hidden_id') !='') ? $this->input->post('hidden_id') : '';
        $data['fromday'] = ($this->input->post('fromday') !='') ? $this->input->post('fromday') : 0;
        $data['today'] = ($this->input->post('today') !='') ? $this->input->post('today') : 0;
        $data['holidays'] = ($this->input->post('holidays') !='') ? $this->input->post('holidays') : 0;
        $get_details = $this->pricing_model->check_courtExist($data);
        //echo $this->db->last_query(); die();
        echo $get_details;
        //return $dayname;
    }
    
    public function get_locationnames(){
        $data = array();
        $data['sports_id'] = ($this->input->post('sports_id') !='') ? $this->input->post('sports_id') : '';
        $get_details = $this->pricing_model->get_locationlist($data);
        $output = '<option value="">- Select Location -</option>';
        if($get_details){        
            foreach($get_details as $list){ 
                $output .='<option value="'.$list['location_id'].'">'.$list['location'].'</option>';
            }
        }
        echo $output;
    }
    
   
	
}

?>