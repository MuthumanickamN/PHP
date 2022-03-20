<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Activity_remark extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
	    $data['id'] = "";
		 $this->load->view('activity_remark',$data);
		}
			public function add()
	{
		 $this->load->view('activity_remark');
		}

			public function list()
	{
	    
	    	
    $query2=$this->db->query("select r.*, g.game,gl.level,p.parent_code,rg.sid,rg.name from student_remarks as r 
    left join registrations rg on rg.id=r.student_id
    left join parent p on p.parent_id=rg.parent_user_id
    left join games g on g.game_id=r.activity_id
    left join game_levels gl on gl.games_level_id=r.level_id
    ");
    $data['list']=$query2->result_array();
		 $this->load->view('activity_remark_list', $data);
		}

		
public function edit($id="")
{
    if($id)
    {
        
    	$query2=$this->db->query("select r.*, g.game,gl.level,p.parent_code,rg.sid,rg.name from student_remarks as r 
        left join registrations rg on rg.id=r.student_id
        left join parent p on p.parent_id=rg.parent_user_id
        left join games g on g.game_id=r.activity_id
        left join game_levels gl on gl.games_level_id=r.level_id
        where r.id=$id");
        $data=$query2->row_array();
        
    	if($this->input->post('submit'))
    	{
    		$student_id=$this->input->post('student_id');
        	$activity_id=$this->input->post('activity_id');
        	$level_id=$this->input->post('level_id');
        	$remark=$this->input->post('remark');
        	$updated_at=Date('Y-m-d H:i:s');
        	$userid=$this->session->userdata('userid');
        
            $update_array = array(
                'student_id' => $student_id,
                'activity_id' => $activity_id,
                'level_id' => $level_id,
                'remark' => $remark,
                'updated_at' => $updated_at,
            );
            $this->db->where('id', $id);
            $this->db->update('student_remarks', $update_array);
            
            $this->session->set_flashdata('success_msg', 'Remark Updated successfully');
        	redirect(base_url().'Activity_remark/list');
    	}
    	
    	$this->load->view('activity_remark',$data);
    }
    else
    {
        if($this->input->post('submit'))
    	{
    		$student_id=$this->input->post('student_id');
        	$activity_id=$this->input->post('activity_id');
        	$level_id=$this->input->post('level_id');
        	$remark=$this->input->post('remark');
        	$updated_at=Date('Y-m-d H:i:s');
        	$userid=$this->session->userdata('userid');
        
            $update_array = array(
                'student_id' => $student_id,
                'activity_id' => $activity_id,
                'level_id' => $level_id,
                'remark' => $remark,
                'updated_at' => $updated_at,
            );
            
            $this->db->insert('student_remarks', $update_array);
            
            $this->session->set_flashdata('success_msg', 'Remark Added successfully');
        	redirect(base_url().'Activity_remark/list');
    	}
    }

    
}

public function delete($id)
{
	 $sql="Delete from student_remarks  where id='$id'";
		$insert=$this->db->query($sql);


	
				setMessage('Student Remarks Deleted Successfully.');
				redirect(base_url().'Activity_remark/list');
			}
			


 public function student_details()
{

	$student_id=$this->input->post('student_id');
	$eid =$this->input->post('eid'); 
   
    if(!$student_id)
    {
        $row=$this->db->query("select r.student_id,r.level_id,r.activity_id,g.game,gl.level from student_remarks r 
        left join games g on g.game_id=r.activity_id
        left join game_levels gl on gl.games_level_id=r.level_id
        where r.id=$eid")->row();   
        
        $student_id = $row->student_id;
        $data = $this->db->query("select * from registrations where id=$student_id")->row_array();
        $data['level_id'] = $row->level_id;
         $data['activity_id'] = $row->activity_id;
         $data['activity'] = $row->game;
         $data['level'] = $row->level;
        
        
    }
    else
    {
        $data = $this->db->query("select * from registrations where id=$student_id")->row_array();
    }
     
    
     
    $data['eid'] = $eid;
     $query2=$this->db->query("select a.*, g.game,gl.level from activity_selections as a 
    left join games g on g.game_id=a.activity_id
    left join game_levels gl on gl.games_level_id=a.level_id
    where a.student_id=$student_id");
    $data['list']= $query2->result_array();
    
    $this->load->view('activity_remark_ajax', $data);	


}
}