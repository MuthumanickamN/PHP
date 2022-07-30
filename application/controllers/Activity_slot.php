<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Activity_slot extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('activity_slot_list');
	}
	
	public function add_old(){
	if($this->input->post('submit')){
        //print_r($this->input->post('slot_time_from'));die;
		$game_id=$this->input->post('game_id');
		$location_id=$this->input->post('location_id');
		$lane_court_id=$this->input->post('lane_court_id');
		$level_id=$this->input->post('level_id');
		$coach_id=$this->input->post('coach_id');
		$hour=$this->input->post('hour');
		$slot_time_from=$this->input->post('slot_time_from');
		$slot_time_to=$this->input->post('slot_time_to');
		$slot_code=$this->input->post('slot_code');
		$slot_count=$this->input->post('slot_count');
		$days=$this->input->post('days');
		//print_r($days);die;
		$category=$this->input->post('category');
		$status=$this->input->post('status');
		$created_at=currentDateTime();

		$this->db->where('game_id', $game_id); 
		$this->db->where('level_id', $level_id); 
		$this->db->where('lane_court_id', $lane_court_id); 
		$this->db->where('coach_id', $coach_id); 
		$this->db->where('location_id', $location_id); 
		$this->db->where('slot_from_time', $slot_time_from); 
		$this->db->where('slot_to_time', $slot_time_to); 
		//$this->db->where('slot_id', $slot_count); 
		//$this->db->where('slot_class', $slot_code);  
		$this->db->where('category', $category); 
		$this->db->where('hour', $hour); 
             
        $query = $this->db->get('slot_selections');  
        //echo $this->db->last_query();die;
        if($query->num_rows() ==0){  
            
    		$ins = array(
    		    'game_id' => $game_id,  
    		    'level_id' => $level_id,  
    		    'lane_court_id' => $lane_court_id,  
    		    'coach_id' => $coach_id,  
    		    'location_id' => $location_id,  
    		    'slot_from_time' => $slot_time_from,  
    		    'slot_to_time' => $slot_time_to,  
    		    'hour' => $hour,  
    		    'slot_id' => $slot_count,  
    		    'slot_class' => $slot_code,  
    		    'category' => $category,  
    		    'status' => $status,  
    		    'created_at' => $created_at,  
    		    );
    		$this->db->insert('slot_selections', $ins);
            $insert_id = $this->db->insert_id();
               
    		$insert_arr = array();
    		foreach($days as $key => $value)
    		{
    		    $arr = array(
		            'slot_selections_id' => $insert_id,
		            'days' => $value
		        );
    		        
	            array_push($insert_arr, $arr);
    		}
    		
    		$this->db->insert_batch('slot_selections_days', $insert_arr);
    		setMessage('New Activity Slot Added Successfully.');
    		redirect(base_url().'activity_slot');
		}else{
			setMessage('Activity Slot Already Exist');
			redirect(base_url().'activity_slot/add');
		}
	}

		 $this->load->view('activity_slot');
	
}
public function edit_old($id)
{

	
	$query = $this->db->query('select s.*,GROUP_CONCAT(ssd.days order by ssd.ss_days_id  asc) as days from slot_selections s 
	left join slot_selections_days as ssd on ssd.slot_selections_id = s.id 
	where s.id='.$id);
	$postData=$query->row_array();
	$data['game_id']=$postData['game_id'];
	$data['coach_id']=$postData['coach_id'];
	$data['level_id']=$postData['level_id'];
	$data['location_id']=$postData['location_id'];
	$data['lane_court_id']=$postData['lane_court_id'];
	$data['slot_id']=$postData['slot_id'];
	$data['slot_class']=$postData['slot_class'];
	$data['days']=$postData['days'];
	$data['slot_from_time']=$postData['slot_from_time'];
	$data['slot_to_time']=$postData['slot_to_time'];
	$data['hour']=$postData['hour'];
	$data['category']=$postData['category'];
	$data['status']=$postData['status'];
	$data['slot_count']=$postData['slot_id'];
	$data['slot_code']=$postData['slot_code'];
	
	if($this->input->post('submit')){
    	$game_id=$this->input->post('game_id');
    	$coach_id=$this->input->post('coach_id');
    	$level_id=$this->input->post('level_id');
    	$location_id=$this->input->post('location_id');
    	$lane_court_id=$this->input->post('lane_court_id');
    	$slot_count=$this->input->post('slot_count');
    	$slot_code=$this->input->post('slot_code');
    	$days=$this->input->post('days');
    	$slot_from_time=$this->input->post('slot_time_from');
    	$slot_to_time=$this->input->post('slot_time_to');
    	$hour=$this->input->post('hour');
    	$category=$this->input->post('category');
    	$status=$this->input->post('status');
    	
	
	
		
    	$updated_at=currentDateTime();
    
        $sql="Update  slot_selections set game_id='$game_id',location_id='$location_id',lane_court_id='$lane_court_id',level_id='$level_id',coach_id='$coach_id',hour='$hour',slot_from_time='$slot_from_time',slot_to_time='$slot_to_time',slot_id='$slot_count',slot_class='$slot_code',category='$category',status='$status',updated_at='$updated_at' where id='$id'";
    	//echo $sql;die;
    	$insert=$this->db->query($sql);
    	
    	$sql2="Delete from slot_selections_days where slot_selections_id='$id'";
    	$this->db->query($sql2);
        $insert_arr = array();    
        foreach($days as $key => $value)
        {
            
        $arr = array(
                'slot_selections_id' => $id,
                'days' => $value
            );
    	        
            array_push($insert_arr, $arr);
    	}
    	
    	$this->db->insert_batch('slot_selections_days', $insert_arr);

	setMessage('Activity Slot Updated Successfully.');
	redirect(base_url().'activity_slot');
	}
	$this->load->view('activity_slot', $data);
		
}

public function add(){
	if($this->input->post('submit')){
        //print_r($this->input->post('slot_time_from'));die;
		$game_id=$this->input->post('game_id');
		$location_id=$this->input->post('location_id');
		$lane_court_id=$this->input->post('lane_court_id');
		$level_id=$this->input->post('level_id');
		$coach_id=$this->input->post('coach_id');
		$hour=$this->input->post('hour');
		$slot_time_from=$this->input->post('slot_time_from');
		$slot_time_to=$this->input->post('slot_time_to');
		$slot_code=$this->input->post('slot_code');
		$slot_count=$this->input->post('slot_count');
		$days=$this->input->post('days');
		//print_r($days);die;
		$category=$this->input->post('category');
		$status=$this->input->post('status');
		$created_at=currentDateTime();
		$ds = "'" . implode("','", $days) . "'";
		
		$query1 = $this->db->query("SELECT * FROM slot_selections LEFT JOIN slot_selections_days ON slot_selections.id = slot_selections_days.slot_selections_id WHERE slot_selections.slot_from_time LIKE '".$slot_time_from."' and slot_selections.slot_to_time LIKE '".$slot_time_to."' and slot_selections.lane_court_id='".$lane_court_id."' and slot_selections_days.days IN(".$ds.")");
	
		if($query1->num_rows() >0)
		{
		setMessage('Activity Slot Already Exist');
		redirect(base_url().'activity_slot/add');
		}
		else
		{

		$this->db->where('game_id', $game_id); 
		$this->db->where('level_id', $level_id); 
		$this->db->where('lane_court_id', $lane_court_id); 
		$this->db->where('coach_id', $coach_id); 
		$this->db->where('location_id', $location_id); 
		$this->db->where('slot_from_time', $slot_time_from); 
		$this->db->where('slot_to_time', $slot_time_to); 
		//$this->db->where('slot_id', $slot_count); 
		//$this->db->where('slot_class', $slot_code);  
		$this->db->where('category', $category); 
		$this->db->where('hour', $hour); 
             
        $query = $this->db->get('slot_selections');  
        if($query->num_rows() ==0){  
            
    		$ins = array(
    		    'game_id' => $game_id,  
    		    'level_id' => $level_id,  
    		    'lane_court_id' => $lane_court_id,  
    		    'coach_id' => $coach_id,  
    		    'location_id' => $location_id,  
    		    'slot_from_time' => $slot_time_from,  
    		    'slot_to_time' => $slot_time_to,  
    		    'hour' => $hour,  
    		    'slot_id' => $slot_count,  
    		    'slot_class' => $slot_code,  
    		    'category' => $category,  
    		    'status' => $status,  
    		    'created_at' => $created_at,  
    		    );
    		$this->db->insert('slot_selections', $ins);
            $insert_id = $this->db->insert_id();
               
    		$insert_arr = array();
    		foreach($days as $key => $value)
    		{
    		    $arr = array(
		            'slot_selections_id' => $insert_id,
		            'days' => $value
		        );
    		        
	            array_push($insert_arr, $arr);
    		}
    		
    		$this->db->insert_batch('slot_selections_days', $insert_arr);
    		setMessage('New Activity Slot Added Successfully.');
    		redirect(base_url().'activity_slot');
		}else{
			$id_arr = array();
			foreach($query->result_array() as $key1 => $value1)
			{
				array_push($id_arr, $value1['id']);
			}
			
			$this->db->where_in('slot_selections_id', $id_arr);
			$query2 = $this->db->get('slot_selections_days')->result_array();
			
			
			
			$count = 0;

			foreach ( $query2 as $key3 => $item_values ) {
	
				if( in_array( $item_values['days'], $days )) {
					$count++;
				}
			}
			
			if($count == 0)
			{
				$ins = array(
    		    'game_id' => $game_id,  
    		    'level_id' => $level_id,  
    		    'lane_court_id' => $lane_court_id,  
    		    'coach_id' => $coach_id,  
    		    'location_id' => $location_id,  
    		    'slot_from_time' => $slot_time_from,  
    		    'slot_to_time' => $slot_time_to,  
    		    'hour' => $hour,  
    		    'slot_id' => $slot_count,  
    		    'slot_class' => $slot_code,  
    		    'category' => $category,  
    		    'status' => $status,  
    		    'created_at' => $created_at,  
    		    );
				$this->db->insert('slot_selections', $ins);
				$insert_id = $this->db->insert_id();
				   
				$insert_arr = array();
				foreach($days as $key => $value)
				{
					$arr = array(
						'slot_selections_id' => $insert_id,
						'days' => $value
					);
						
					array_push($insert_arr, $arr);
				}
				
				$this->db->insert_batch('slot_selections_days', $insert_arr);
				setMessage('New Activity Slot Added Successfully.');
				redirect(base_url().'activity_slot');
			}
			else{
				setMessage('Activity Slot Already Exist');
				redirect(base_url().'activity_slot/add');
			}


		}	
		}
	}

		 $this->load->view('activity_slot');
	
}
public function edit($id)
{

	
	$query = $this->db->query('select s.*,GROUP_CONCAT(ssd.days order by ssd.ss_days_id  asc) as days from slot_selections s 
	left join slot_selections_days as ssd on ssd.slot_selections_id = s.id 
	where s.id='.$id);
	$postData=$query->row_array();
	
	$data['game_id']=$postData['game_id'];
	$data['coach_id']=$postData['coach_id'];
	$data['level_id']=$postData['level_id'];
	$data['location_id']=$postData['location_id'];
	$data['lane_court_id']=$postData['lane_court_id'];
	$data['slot_id']=$postData['slot_id'];
	$data['slot_class']=$postData['slot_class'];
	$data['days']=$postData['days'];
	$data['slot_from_time']=$postData['slot_from_time'];
	$data['slot_to_time']=$postData['slot_to_time'];
	$data['hour']=$postData['hour'];
	$data['category']=$postData['category'];
	$data['status']=$postData['status'];
	$data['slot_count']=$postData['slot_id'];
	$data['slot_code']=$postData['slot_class'];
	
	if($this->input->post('submit')){
		
		
		
    	$game_id=$this->input->post('game_id');
    	$coach_id=$this->input->post('coach_id');
    	$level_id=$this->input->post('level_id');
    	$location_id=$this->input->post('location_id');
    	$lane_court_id=$this->input->post('lane_court_id');
    	$slot_count=$this->input->post('slot_count');
    	$slot_code=$this->input->post('slot_code');
    	$days=$this->input->post('days');
    	$slot_from_time=$this->input->post('slot_time_from');
    	$slot_to_time=$this->input->post('slot_time_to');
    	$hour=$this->input->post('hour');
    	$category=$this->input->post('category');
    	$status=$this->input->post('status');
    	$updated_at=currentDateTime();
		$ds = "'" . implode("','", $days) . "'";
		
		$query1 = $this->db->query("SELECT * FROM slot_selections LEFT JOIN slot_selections_days ON slot_selections.id = slot_selections_days.slot_selections_id WHERE id !='".$id."' and slot_selections.slot_from_time LIKE '".$slot_from_time."' and slot_selections.slot_to_time LIKE '".$slot_to_time."' and slot_selections.lane_court_id='".$lane_court_id."' and slot_selections_days.days IN(".$ds.")");
	    
		if($query1->num_rows() >0)
		{
		setMessage('Activity Slot Already Exist');
		redirect(base_url().'activity_slot/edit/'.$id);	
		}
		else
		{
		$this->db->where('game_id', $game_id); 
		$this->db->where('level_id', $level_id); 
		$this->db->where('lane_court_id', $lane_court_id); 
		$this->db->where('coach_id', $coach_id); 
		$this->db->where('location_id', $location_id); 
		$this->db->where('slot_from_time', $slot_from_time); 
		$this->db->where('slot_to_time', $slot_to_time); 
		//$this->db->where('slot_id', $slot_count); 
		//$this->db->where('slot_class', $slot_code);  
		$this->db->where('category', $category); 
		$this->db->where('hour', $hour); 
		$this->db->where('id !=', $id); 
             
        $query = $this->db->get('slot_selections');  
		
		//echo $this->db->last_query();die;
        if($query->num_rows() ==0){  
		
		
			$sql="Update  slot_selections set game_id='$game_id',location_id='$location_id',lane_court_id='$lane_court_id',level_id='$level_id',coach_id='$coach_id',hour='$hour',slot_from_time='$slot_from_time',slot_to_time='$slot_to_time',slot_id='$slot_count',slot_class='$slot_code',category='$category',status='$status',updated_at='$updated_at' where id='$id'";
			//echo $sql;die;
			$insert=$this->db->query($sql);
			
			$sql2="Delete from slot_selections_days where slot_selections_id='$id'";
			$this->db->query($sql2);
			$insert_arr = array();    
			foreach($days as $key => $value)
			{
				
			$arr = array(
					'slot_selections_id' => $id,
					'days' => $value
				);
					
				array_push($insert_arr, $arr);
			}
			
			$this->db->insert_batch('slot_selections_days', $insert_arr);

			setMessage('Activity Slot Updated Successfully.');
			redirect(base_url().'activity_slot');
			
		}
		else{
			$id_arr = array();
			foreach($query->result_array() as $key1 => $value1)
			{
				array_push($id_arr, $value1['id']);
			}
			
			$this->db->where_in('slot_selections_id', $id_arr);
			$query2 = $this->db->get('slot_selections_days')->result_array();
			
			
			
			$count = 0;

			foreach ( $query2 as $key3 => $item_values ) {
	
				if( in_array( $item_values['days'], $days )) {
					$count++;
				}
			}
			
			if($count == 0)
			{
				$sql="Update  slot_selections set game_id='$game_id',location_id='$location_id',lane_court_id='$lane_court_id',level_id='$level_id',coach_id='$coach_id',hour='$hour',slot_from_time='$slot_from_time',slot_to_time='$slot_to_time',slot_id='$slot_count',slot_class='$slot_code',category='$category',status='$status',updated_at='$updated_at' where id='$id'";
				//echo $sql;die;
				$insert=$this->db->query($sql);
				
				$sql2="Delete from slot_selections_days where slot_selections_id='$id'";
				$this->db->query($sql2);
				$insert_arr = array();    
				foreach($days as $key => $value)
				{
					
				$arr = array(
						'slot_selections_id' => $id,
						'days' => $value
					);
						
					array_push($insert_arr, $arr);
				}
				
				$this->db->insert_batch('slot_selections_days', $insert_arr);

				setMessage('Activity Slot Updated Successfully.');
				redirect(base_url().'activity_slot');
			}
			else{
				setMessage('Activity Slot Already Exist');
				redirect(base_url().'activity_slot/edit/'.$id);
			}


			
		}
		
		}	
	}
	$this->load->view('activity_slot', $data);
		
}

public function delete($id)
{
	 $sql="Delete from slot_selections  where id='$id'";
	 $this->db->query($sql);
	 
	 $sql2="Delete from slot_selections_days  where slot_selections_id='$id'";
	 $this->db->query($sql2);

    setMessage('Activity Slot Deleted Successfully.');
	redirect(base_url().'activity_slot');
}
public function view($id)
{
	$query = $this->db->query('select * from slot_selections where id='.$id);
	$postData=$query->row_array();
	$data['id']=$postData['id'];
	$data['game_id']=$postData['game_id'];
	$data['coach_id']=$postData['coach_id'];
	$data['level_id']=$postData['level_id'];
	$data['location_id']=$postData['location_id'];
	$data['id']=$postData['lane_court_id'];
	$data['slot_id']=$postData['slot_id'];
	$data['slot_class']=$postData['slot_class'];
	$data['days']=$postData['days'];
	$data['slot_from_time']=$postData['slot_from_time'];
	$data['slot_to_time']=$postData['slot_to_time'];
	$data['hour']=$postData['hour'];
	$data['category']=$postData['category'];
	$data['status']=$postData['status'];
	$data['coach_id']=$postData['coach_id'];
	$this->load->view('view_activity_slot', $data);
}


		
	}