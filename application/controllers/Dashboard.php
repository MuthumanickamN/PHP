<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Dashboard extends CI_Controller {  
      
	public function __construct(){
	parent::__construct();
	}
	
	public function index(){
	    
	    $userrole = strtolower($this->session->userdata('role'));
	    $userid =  $this->session->userdata('userid');
	    
		$data['title'] = 'Prime Star Sports Academy LLC';
		$query = $this->db->query("select * from scroll_text_messages");
		$data['scroll_Text'] = $query->row_array();
		$event = $this->db->query("select * from events where event_date >= '".date('Y-m-d')."' order by event_date ASC ");
		$data['eventList'] = $event->result_array();
		$holidays = $this->db->query("select * from set_academy_holidays order by select_date ASC ");
		$data['holidaysList'] = $holidays->result_array();
        
        if($userrole == 'superadmin') { 
		$active_kid = $this->db->query("select count(0) as cnt from registrations where status = 'Active'")->row()->cnt;
		$data['active_kids'] = $active_kid;

		$active_students = $this->db->query("select count(0) as cnt from activity_selections where status = 'Active' and approval_status='Approved'")->row()->cnt;
		$data['active_student'] = $active_students;

		$active_swimming = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Swimming' and status ='Active' and approval_status='Approved' ")->row()->cnt;
        $data['active_swim']=$active_swimming;

		$active_Badminton = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Badminton' and status ='Active' and approval_status='Approved'")->row()->cnt;
        $data['active_Bad']=$active_Badminton;

		$active_Chess = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Chess' and status ='Active' and approval_status='Approved'")->row()->cnt;
        $data['active_chess']=$active_Chess;
		
		$active_Tabletennis = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Table Tennis' and status ='Active' and approval_status='Approved'")->row()->cnt;
        $data['active_tennis']=$active_Tabletennis;

		$active_Karate = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Karate' and status ='Active' and approval_status='Approved'")->row()->cnt;
        $data['active_karate']=$active_Karate;

		$active_football = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Football' and status ='Active' and approval_status='Approved'")->row()->cnt;
        $data['active_foot_ball']=$active_football;
		
		$inactive_students = $this->db->query("select count(0) as cnt from registrations where status = 'Inactive'")->row()->cnt;
		$data['inactive_student'] = $inactive_students;

		$inactive_swimming = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Swimming' and status ='Inactive'")->row()->cnt;
        $data['inactive_swim']=$inactive_swimming;

		$inactive_Badminton = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Badminton' and status ='Inactive'")->row()->cnt;
        $data['inactive_Bad']=$inactive_Badminton;

		$inactive_Chess = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Chess' and status ='Inactive'")->row()->cnt;
        $data['inactive_chess']=$inactive_Chess;

		$inactive_Tabletennis = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Table Tennis' and status ='Inactive'")->row()->cnt;
        $data['inactive_tennis']=$inactive_Tabletennis;

		$inactive_Karate = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Karate' and status ='Inactive'")->row()->cnt;
        $data['inactive_karate']=$inactive_Karate;

		$inactive_football = $this->db->query("SELECT count(0) as cnt FROM `activity_selections` 
		                                     left join games on games.game_id = activity_selections.activity_id
		                                     where games.game='Football' and status ='Inactive'")->row()->cnt;
        $data['inactive_foot_ball']=$inactive_football;

		$active_parents = $this->db->query("select count(0) as cnt from parent where status = 'Active'")->row()->cnt;
		$data['active_parent'] = $active_parents;

		$inactive_parents = $this->db->query("select count(0) as cnt from parent where status = 'Inactive'")->row()->cnt;
		$data['inactive_parent'] = $inactive_parents;

		$active_coaches = $this->db->query("select count(0) as cnt from coach where status = 'Active'")->row()->cnt;
		$data['active_coach'] = $active_coaches;

		$inactive_coaches = $this->db->query("select count(0) as cnt from coach where status = 'Inactive'")->row()->cnt;
		$data['inactive_coach'] = $inactive_coaches;

		$transaction = $this->db->query("select count(0) as cnt from wallet_transactions")->row()->cnt;
		$data['transactions'] = $transaction;
		
		$invoices = $this->db->query("select count(0) as cnt from wallet_transactions where invoice='yes'")->row()->cnt;
		$data['invoices'] = $invoices;

		$activity_slot = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
		left join  booking_approvals as ba on ba.id = bs.booking_id 
		left join games g on g.game_id = ba.activity_id where bs.status=1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
		$data['total_activityslot'] = $activity_slot;

		$swimming = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Swimming' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['swim']=$swimming;


        $Badminton = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Badminton' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['active_Badmiton']=$Badminton;

        $Chess = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Chess' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['chess']=$Chess;

        $Tabletennis = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Table Tennis' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['tennis']=$Tabletennis;

        $Karate = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Karate' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['karate']=$Karate;

		$football = $this->db->query("SELECT count(0) as cnt FROM `booked_slots` bs 
                                        left join booking_approvals ba on ba.id = bs.booking_id
                                        left join games on games.game_id = ba.activity_id
                                        where games.game='Football' and bs.status =1 and  bs.booked_date =date('Y-m-d');")->row()->cnt;
        $data['foot_ball']=$football;

        $d_transaction = $this->db->query("select count(0) as cnt from wallet_transactions where wallet_transaction_date=date('Y-m-d')")->row()->cnt;
        $data['daily_transactions'] = $d_transaction;
        
        $d_invoice = $this->db->query("select count(0) as cnt from wallet_transactions where wallet_transaction_date=date('Y-m-d') and invoice='yes'")->row()->cnt;
        $data['daily_invoices'] = $d_invoice;
        $this->load->view('dashboard', $data);
        }
        elseif($userrole == 'parent')
        {
            $query = $this->db->query("SELECT parent_id FROM `parent` p
            left join users u on u.code = p.parent_code
            where u.user_id=$userid");
            $parent_id = $query->row()->parent_id;

			$query = ("SELECT bs.attendance as Attendance,r.name as Name, c.coach_name as Coach, l.location as Location, g.game as Activity,bs.from_time as start, bs.to_time as end,
			bs.booked_date as Date,lc.lane_court as Lane
			FROM booked_slots as bs 
			left join booking_approvals as ba on bs.booking_id = ba.id
			left join registrations as r on r.id=ba.student_id
			left join coach as c on c.coach_id = bs.coach_id 
			left join locations as l on l.location_id=bs.location_id 
			left join games as g on g.game_id=ba.activity_id 
			left join lane_courts as lc on lc.id = bs.lane_court_id
			where bs.status=1 and ba.parent_id=$parent_id and Month(bs.booked_date) = Month(NOW()) AND YEAR(bs.booked_date) = YEAR(NOW()) ");
			$sql = $this->db->query($query);
			
			$data['ActivityDetails'] = $sql->result();
			$query2 = $this->db->query("select coalesce(balance_credits,0.00) as wallet from prepaid_credits where parent_id=$parent_id");
			$wallet = 0.00;
			if($query2->num_rows() > 0)
			{
			    $wallet = $query2->row()->wallet;
			}
			
	        	$data['walletbalance']=$wallet;
			//print_r($data);die;
			$this->load->view('dashboard_parent', $data);
            
        }
        else
        {
            //$this->load->view('dashboard_parent', $data);
            echo '';die;
        }
        
		
	}
	

		
}  