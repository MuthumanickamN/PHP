<?php
	class Accountsreport_model extends CI_model
	{
		public function coach_wise_revenue_model($from_date, $to_date) 
		{
			$where = '';
			if($from_date !='' && $to_date!='')
			{
				$where .= " AND booked_slots.booked_date BETWEEN '".$from_date."' AND '".$to_date."'";
			}
		
            $sql="SELECT booked_slots.coach_id, coach.coach_name, sum(booked_slots.payable_amount) as revenue 
			FROM booked_slots 
			LEFT JOIN coach ON coach.coach_id=booked_slots.coach_id 
			where booked_slots.status=1 $where GROUP BY booked_slots.coach_id";    
            $query = $this->db->query($sql);
            //echo $sql;die;
            return $query->result();
		}

            public function location_wise_revenue_model()
            {
            	$sql="SELECT booked_slots.location_id, locations.location, sum(booked_slots.payable_amount) as revenue 
				FROM booked_slots 
				LEFT JOIN locations ON locations.location_id=booked_slots.location_id 
				where booked_slots.status=1 $where GROUP BY booked_slots.location_id";
	            $query = $this->db->query($sql);
	            return $query->result();
            }
            public function activity_wise_revenue_model()
            {

            	$sql="SELECT booking_approvals.activity_id,games.game, sum(booked_slots.payable_amount)as revenue 
                      FROM booked_slots 
                      left join booking_approvals on booking_approvals.id= booked_slots.booking_id
                      left join games on games.game_id=booking_approvals.activity_id where booked_slots.status = 1
                      group by booking_approvals.activity_id";
	            $query = $this->db->query($sql);
	            return $query->result();
            }
        }

?>