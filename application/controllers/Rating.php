<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Rating extends CI_Controller {  
 
    public function __construct(){
		parent::__construct();
		error_reporting(0);
	    $this->load->model('Default_Model', 'default');
	    $this->load->model('Daily_Transaction_Model', 'transaction');
	}
    public function index($coach_id,$psa_id,$activity_id)
    { 
			$query2 = "SELECT c.*,u.* FROM coach as c left join users as u on u.code = c.code
			where 1 and u.user_id =".$coach_id."";

			$get_coach_result = $this->db->query($query2);

			if($get_coach_result->num_rows() > 0)
			{
				$data['result_row'] = $get_coach_result->result_array();
				$data['psa_id'] = $psa_id;
				$data['activity_id'] = $activity_id;

				
			}
			else
			{
				$data['result_row'] = "";
				$data['psa_id'] =  "";
				$data['activity_id'] = "";
			}

			$this->load->view('single_rating_view',$data);
			
			
    } 
	
	public function rating_review_submit()
	{
			$postdata = $this->input->post();
			$this->db->set('parent_id',$postdata['parent_id']);
			$this->db->set('activity_selection_id',$postdata['activity_id']);
			$this->db->set('coach_id',$postdata['coach_id']);
			$this->db->set('star_count',$postdata['star_rating']);
			$this->db->set('review',$postdata['coach_review']);
			$this->db->set('status','Active');
			$this->db->insert('rating_reviews');
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				echo 1;
			}
			else
			{
				echo 2;
			}	
	}
	
	public function rating_review_report()
	{
		
	/*	$query2 = "SELECT c.*,u.* FROM coach as c left join users as u on u.code = c.code
			where 1 and u.user_id =".$coach_id."";
			*/
		
		$coach_id = $_SESSION['userid'];
		$coach_detail = "SELECT c.*,u.* FROM coach as c left join users as u on u.code = c.code
			where 1 and u.user_id =".$coach_id."";
		$coach_profile = $this->db->query($coach_detail);	
		
		if($coach_profile->num_rows() > 0)
		{
			$result_array = $coach_profile->result_array();
			$data['coach_profile'] = $result_array[0];
		}
		else
		{
			$data['coach_profile'] = "";
		}
		
		
		$review = "SELECT * FROM rating_reviews where 1 and coach_id =".$coach_id."";
		$review_detail = $this->db->query($review);	
		
		if($review_detail->num_rows() > 0)
		{
			$data['review_detail'] = $review_detail->result_array();
			//$data['review_count'] = $review_detail->num_rows();
		}
		else
		{
			$data['review_detail'] = '';
		}	
		
		$this->load->view('rating_review_report_view',$data);
	}
	
	public function rating_review_detail($coach_id)
	{
		$coach_detail = "SELECT c.*,u.* FROM coach as c left join users as u on u.code = c.code
			where 1 and u.user_id =".$coach_id."";
		$coach_profile = $this->db->query($coach_detail);	
		
		if($coach_profile->num_rows() > 0)
		{
			$result_array = $coach_profile->result_array();
			$data['coach_profile'] = $result_array[0];
		}
		else
		{
			$data['coach_profile'] = "";
		}
		
		$review = "SELECT a_s.*,rr.* FROM activity_selections as a_s right join rating_reviews as rr on rr.activity_selection_id = a_s.id where rr.coach_id=".$coach_id."";
		$review_detail = $this->db->query($review);	
		
		if($review_detail->num_rows() > 0)
		{
			$data['review_detail'] = $review_detail->result_array();
			//$data['review_count'] = $review_detail->num_rows();
		}
		else
		{
			$data['review_detail'] = '';
		}
	
		$this->load->view('rating_review_single_view',$data);
		
	}
}
?>
