<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Fees_package_setup extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	 $this->load->model('Fees_Package_Setup_Model');
	}
	public function index()
	{
		 $this->load->view('fees_package_setup_list');
		}
	

     /*

	public function add()

       {
		if($this->input->post('submit'))
		{
		$status='Active';
		$game_id=$this->input->post('game_id');
 		$level_id=$this->input->post('level_id');
		$hour=$this->input->post('hour');
		$created_at=currentDateTime();
		  $this->db->where('game_id', $game_id); 
		  $this->db->where('level_id', $level_id); 
		  $this->db->where('hour', $hour);  
             
           $query = $this->db->get('fee_package_setups');  
       if($query->num_rows() ==0)  
           {  


		



        $sql="INSERT into fee_package_setups(game_id,level_id,hour,created_at) values('".$game_id."','".$level_id."','".$hour."','".$created_at."')";
		$insert=$this->db->query($sql);


		$fee_package_setups_id= $this->db->insert_id();

		$slot_classes_min=$this->input->post('slot_classes_min');
		$slot_classes_max=$this->input->post('slot_classes_max');
		$slot_classes_fees=$this->input->post('slot_classes_fees');
		$slot_classes_min1=$this->input->post('slot_classes_min1');
		$slot_classes_max1=$this->input->post('slot_classes_max1');
		$slot_classes_fees1=$this->input->post('slot_classes_fees1');
		$slot_classes_min2=$this->input->post('slot_classes_min2');
		$slot_classes_max2=$this->input->post('slot_classes_max2');
		$slot_classes_fees2=$this->input->post('slot_classes_fees2');
		
		if($slot_classes_min>'0' && $slot_classes_max>'0' && $slot_classes_fees>'0')
		{
		 $sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min."','".$slot_classes_max."','".$slot_classes_fees."','".$status."')";
		$insert=$this->db->query($sql);
		}
		if($slot_classes_min1>'0' && $slot_classes_max1>'0' && $slot_classes_fees1>'0')
		{
		 $sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min1."','".$slot_classes_max1."','".$slot_classes_fees1."','".$status."')";
		$insert=$this->db->query($sql);
		}
		if($slot_classes_min2>'0' && $slot_classes_max2>'0' && $slot_classes_fees2>'0')
		{
		 $sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min2."','".$slot_classes_max2."','".$slot_classes_fees2."','".$status."')";
		$insert=$this->db->query($sql);
		}

		
		

		 
	
	
				setMessage('New Fees Package Setup Added Successfully.');
			redirect(base_url().'index.php/fees_package_setup');
		
		}
			else
			{
				setMessage('Fees Packege Already Exist');
			redirect(base_url().'index.php/fees_package_setup');	
			}
	}
	$this->load->view('fees_package_setup');
}

*/



	public function add()
	{
			
			
		$postdata = $this->input->post();


		
		if($this->input->post('submit'))
		{
			$status='Active';
			$game_id=$this->input->post('game_id');
			$level_id=$this->input->post('level_id');
			$hour=$this->input->post('hour');
			$created_at=currentDateTime();
			$this->db->where('game_id', $game_id); 
			$this->db->where('level_id', $level_id); 
			$this->db->where('hour', $hour);  
			$query = $this->db->get('fee_package_setups');  
		  
			if($query->num_rows() ==0)  
			{  
				$sql="INSERT into fee_package_setups(game_id,level_id,hour,created_at) values('".$game_id."','".$level_id."','".$hour."','".$created_at."')";
				$insert=$this->db->query($sql);


			$fee_package_setups_id= $this->db->insert_id();

		/*
		$slot_classes_min=$this->input->post('slot_classes_min');
		$slot_classes_max=$this->input->post('slot_classes_max');
		$slot_classes_fees=$this->input->post('slot_classes_fees');
		$slot_classes_min1=$this->input->post('slot_classes_min1');
		$slot_classes_max1=$this->input->post('slot_classes_max1');
		$slot_classes_fees1=$this->input->post('slot_classes_fees1');
		$slot_classes_min2=$this->input->post('slot_classes_min2');
		$slot_classes_max2=$this->input->post('slot_classes_max2');
		$slot_classes_fees2=$this->input->post('slot_classes_fees2');
		
		
		
		*/
		$slot_classes_min = $postdata['slot_classes_min'];
		$slot_classes_max = $postdata['slot_classes_max'];
		$slot_classes_fees = $postdata['slot_classes_fees'];
		if(!empty($slot_classes_min))
		{
			foreach($slot_classes_min as $keys => $values)
			{
				$this->db->set('fee_package_setups_id',$fee_package_setups_id);
				//$this->db->set('slot_classes_min',$values);
				$this->db->set('slot_classes_min',1);
				$this->db->set('slot_classes_max',$slot_classes_max[$keys]);
				$this->db->set('fees',$slot_classes_fees[$keys]);
				$this->db->set('status',$status);
				$this->db->insert('slot_class_registrations');
			}
		}	
		
		/*
		
		if($slot_classes_min>'0' && $slot_classes_max>'0' && $slot_classes_fees>'0')
		{
		$sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min."','".$slot_classes_max."','".$slot_classes_fees."','".$status."')";
		$insert=$this->db->query($sql);
		}
		if($slot_classes_min1>'0' && $slot_classes_max1>'0' && $slot_classes_fees1>'0')
		{
		$sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min1."','".$slot_classes_max1."','".$slot_classes_fees1."','".$status."')";
		$insert=$this->db->query($sql);
		}
		if($slot_classes_min2>'0' && $slot_classes_max2>'0' && $slot_classes_fees2>'0')
		{
		$sql="INSERT into slot_class_registrations(fee_package_setups_id,slot_classes_min,slot_classes_max,fees,status) values('".$fee_package_setups_id."','".$slot_classes_min2."','".$slot_classes_max2."','".$slot_classes_fees2."','".$status."')";
		$insert=$this->db->query($sql);
		}

		*/
		setMessage('New Fees Package Setup Added Successfully.');
		redirect(base_url().'fees_package_setup');
		
		}
		else
		{
			setMessage('Fees Packege Already Exist');
		redirect(base_url().'fees_package_setup');	
		}
	}
	$this->load->view('fees_package_setup');
}
	
	
	public function edit($fee_package_setups_id)
	{

		
		$query = $this->db->query('select * from fee_package_setups where fee_package_setups_id='.$fee_package_setups_id);
		$postData=$query->row_array();
		$fee_package_setups_id = $postData['fee_package_setups_id'];

		$query1 = $this->db->query('select * from slot_class_registrations where fee_package_setups_id='.$fee_package_setups_id);
		
		
		#echo $sql = "select * from slot_class_registrations where fee_package_setups_id=".$fee_package_setups_id;
		
		$data['slot_class'] = $query1->result_array();
		$status='Active';
		/*
		$data['slot_classes_min'] = array();
		$data['slot_classes_max'] = array();
		$data['fees'] = array();
		
		
		foreach($postData1 as $values)
		{
			$data['slot_classes_min'][] = $values['slot_classes_min'];
			$data['slot_classes_max'][] = $values['slot_classes_max'];
			$data['fees'][] = $values['fees'];
		}
			// $data['slot_classes_min']=$postData1['slot_classes_min'];
			// $data['slot_classes_max']=$postData1['slot_classes_max'];
			//  $data['fees']=$postData1['fees'];
		*/
		
		$data['game_id']=$postData['game_id'];
		$data['level_id']=$postData['level_id'];
		$data['fee_package_setups_id']=$fee_package_setups_id;
		
		$data['hour']=$postData['hour'];
			
			if($this->input->post('submit'))
			{
				$getpostdata = $this->input->post();
				
				
				$game_id = $this->input->post('game_id');
				$level_id = $this->input->post('level_id');
				$hour = $this->input->post('hour');
				
				//$slot_classes_fees=$this->input->post('slot_classes_fees');
				//$slot_classes_min=$this->input->post('slot_classes_min');
				//$slot_classes_max=$this->input->post('slot_classes_max');
				
				
				$updated_at=currentDateTime();
		
				$sql="Update  fee_package_setups set game_id='$game_id',hour='$hour',level_id='$level_id',updated_at='$updated_at' where fee_package_setups_id='$fee_package_setups_id'";
				$insert=$this->db->query($sql);


				$slot_classes_min = $getpostdata['slot_classes_min'];
				$slot_classes_max = $getpostdata['slot_classes_max'];
				$slot_classes_fees = $getpostdata['slot_classes_fees'];
				
				
				$sql="Delete from slot_class_registrations where fee_package_setups_id='$fee_package_setups_id'";
				$insert=$this->db->query($sql);
		
				if(!empty($slot_classes_min))
				{
					foreach($slot_classes_min as $keys => $values)
					{
						$this->db->set('fee_package_setups_id',$fee_package_setups_id);
						//$this->db->set('slot_classes_min',$values);
						$this->db->set('slot_classes_min',1);
						$this->db->set('slot_classes_max',$slot_classes_max[$keys]);
						$this->db->set('fees',$slot_classes_fees[$keys]);
						$this->db->set('status',$status);
						$this->db->insert('slot_class_registrations');
					}
				}
		

				/*
				echo $sql1="Update  slot_class_registrations set slot_classes_min='$slot_classes_min',slot_classes_max='$slot_classes_max',fees='$slot_classes_fees',fee_package_setups_id='$fee_package_setups_id' where id='$id'";
				$insert1=$this->db->query($sql1);
				*/

			
				setMessage('Fees Package Setup Updated Successfully.');
				redirect(base_url().'fees_package_setup');
			}

			$this->load->view('fees_package_setup',$data);
	}

/*
public function edit($fee_package_setups_id)
{

	//print_r($fee_package_setups_id);
	$query = $this->db->query('select * from fee_package_setups where fee_package_setups_id='.$fee_package_setups_id);
	$postData=$query->row_array();
	$fee_package_setups_id = $postData['fee_package_setups_id'];

	$query1 = $this->db->query('select * from slot_class_registrations where fee_package_setups_id='.$fee_package_setups_id);
	
	$postData1=$query1->result_array();
	
	
	$data['slot_classes_min'] = array();
	$data['slot_classes_max'] = array();
	$data['fees'] = array();
	foreach($postData1 as $values)
	{
		$data['slot_classes_min'][] = $values['slot_classes_min'];
		$data['slot_classes_max'][] = $values['slot_classes_max'];
		$data['fees'][] = $values['fees'];
	}
	
	
	
	
   // $data['slot_classes_min']=$postData1['slot_classes_min'];
   // $data['slot_classes_max']=$postData1['slot_classes_max'];
	
  //  $data['fees']=$postData1['fees'];
	$data['game_id']=$postData['game_id'];
	$data['level_id']=$postData['level_id'];
	$data['fee_package_setups_id']=$fee_package_setups_id;
	$data['hour']=$postData['hour'];
	if($this->input->post('submit'))
		{
		$slot_classes_fees=$this->input->post('slot_classes_fees');
		$game_id=$this->input->post('game_id');
		$slot_classes_min=$this->input->post('slot_classes_min');
		$slot_classes_max=$this->input->post('slot_classes_max');
		$level_id=$this->input->post('level_id');
		$hour=$this->input->post('hour');
		$updated_at=currentDateTime();

		 echo $sql="Update  fee_package_setups set game_id='$game_id',hour='$hour',level_id='$level_id',updated_at='$updated_at' where fee_package_setups_id='$fee_package_setups_id'";
		$insert=$this->db->query($sql);


		 echo $sql1="Update  slot_class_registrations set slot_classes_min='$slot_classes_min',slot_classes_max='$slot_classes_max',fees='$slot_classes_fees',fee_package_setups_id='$fee_package_setups_id' where id='$id'";
		$insert1=$this->db->query($sql1);


	
				setMessage('Fees Package Setup Updated Successfully.');
				redirect(base_url().'index.php/fees_package_setup');
			}

	$this->load->view('fees_package_setup',$data);


}
*/
public function delete($fee_package_setups_id)
{
		$sql="Delete from fee_package_setups where fee_package_setups_id='$fee_package_setups_id'";
		$insert=$this->db->query($sql);



        $sql="Delete from slot_class_registrations where fee_package_setups_id='$fee_package_setups_id'";
		$insert=$this->db->query($sql);
		
		setMessage('Fees Package Setup Deleted Successfully.');
		redirect(base_url().'fees_package_setup');
}

public function view($fee_package_setups_id)
{
	$query = $this->db->query('select * from fee_package_setups where fee_package_setups_id='.$fee_package_setups_id);
	$postData=$query->row_array();
	$data['count']=$query->num_rows();
	$data['game_id']=$postData['game_id'];
	
	$data['level_id']=$postData['level_id'];
	$data['hour']=$postData['hour'];
	$query11 = $this->db->query('select * from slot_class_registrations where fee_package_setups_id='.$fee_package_setups_id);
	$postData11=$query11->row_array();
    $data['slot_classes_min']=$postData11['slot_classes_min'];
    $data['slot_classes_max']=$postData11['slot_classes_max'];
    $data['fees']=$postData11['fees'];
	$data['created_at']=$postData['created_at'];
	$data['updated_at']=$postData['updated_at'];
	$this->load->view('view_fees_package_setup', $data);
}


 public function slot_classes1()
{


	$data['opcode']=1;
	$data['slot_classes_max'] = $this->input->post('slot_classes_max');
	
	$this->load->view('fees_package_setup_ajax', $data);	


}
 public function slot_classes3()
{


	$data['opcode']=3;
	$data['slot_classes_max']=$this->input->post('slot_classes_max');
	$this->load->view('fees_package_setup_ajax', $data);	


}
public function slot_classes2()
{


	$data['opcode']=2;
	$data['slot_classes_max1']=$this->input->post('slot_classes_max1');
	$this->load->view('fees_package_setup_ajax', $data);	


}
public function slot_classes4()
{


	$data['opcode']=4;
	$data['slot_classes_max1']=$this->input->post('slot_classes_max1');
	$this->load->view('fees_package_setup_ajax', $data);	


}
}