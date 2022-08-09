<?php
	class Accountsreport_model extends CI_model
	{
		 
		public function coach_wise_revenue_model($from_date, $to_date,$revenue) 
		{
			
			$postdate = $from_date;
			$where="";
	
			if(isset($postdate))
			{
				if( $from_date != "" && $to_date != "" )
				{
					$from_date = date('Y-m-d',strtotime($from_date));
					$to_date = date('Y-m-d',strtotime($to_date));
					$where = " and bs.booked_date >= '".$from_date."' and bs.booked_date <= '".$to_date."'";
				}
			}
		
			if($revenue=='Monthly')
			{
				$Monthly=$this->db->query("SELECT c.coach_name as Coach, l.location as Location, g.game as Activity,
				date_format(str_to_date(bs.booked_date, '%Y-%m-%d'), '%Y-%m') as Date,
				bs.amount as Revenue FROM booked_slots as bs left join booking_approvals as ba on bs.booking_id = ba.id
				left join coach as c on c.coach_id = bs.coach_id 
				left join locations as l on l.location_id=bs.location_id 
				left join games as g on g.game_id=ba.activity_id 
				where bs.status =1".$where);
				
				return $Monthly->result_array();
				
			
			}
			else if($revenue=="Yearly")
			{
					$Yearly=$this->db->query("SELECT c.coach_name as Coach, l.location as Location, g.game as Activity,
				date_format(str_to_date(bs.booked_date, '%Y-%m-%d'), '%Y') as Date,
				bs.amount as Revenue FROM booked_slots as bs left join booking_approvals as ba on bs.booking_id = ba.id
				left join coach as c on c.coach_id = bs.coach_id 
				left join locations as l on l.location_id=bs.location_id 
				left join games as g on g.game_id=ba.activity_id 
				where bs.status =1".$where);
				return $Yearly->result_array();
			}
			else if($revenue=="Quarterly")
			{
				/*$Quarterly=$this->db->query("SELECT c.coach_name as Coach, l.location as Location, g.game as Activity,
				CASE WHEN (QUARTER(booked_slots.booked_date)=1 
                THEN CONCAT(YEAR(booked_slots.booked_date)-1, '-',DATE_FORMAT(booked_slots.booked_date,'%y'), '-Q',QUARTER(booked_slots.booked_date)+3)
                ELSE concat(YEAR(booked_slots.booked_date), '-',DATE_FORMAT(booked_slots.booked_date,'%y')+1,'-Q',QUARTER(booked_slots.booked_date)-1) 
                (date_format(str_to_date(bs.booked_date, '%Y-%m-%d'), '%Y-%m-%d')))as Date,
               
				(bs.amount) as Revenue FROM booked_slots as bs left join booking_approvals as ba on bs.booking_id = ba.id
				left join coach as c on c.coach_id = bs.coach_id 
				left join locations as l on l.location_id=bs.location_id 
				left join games as g on g.game_id=ba.activity_id 
				where bs.status =1".$where);
				return $Quarterly->result_array();*/

				$Quarterly=$this->db->query("SELECT c.coach_name as Coach, l.location as Location, g.game as Activity,
				quarter(date_format(str_to_date(bs.booked_date, '%Y-%m-%d'), '%Y-%m-%d')) as Date,
				(bs.amount) as Revenue FROM booked_slots as bs left join booking_approvals as ba on bs.booking_id = ba.id
				left join coach as c on c.coach_id = bs.coach_id 
				left join locations as l on l.location_id=bs.location_id 
				left join games as g on g.game_id=ba.activity_id 
				where bs.status =1".$where);
				return $Quarterly->result_array();
			} 
			
         //   // echo $sql;die;
		//	$query = $this->db->query($sql);
		//	return $query->result_array();

	
		}
	
            public function location_wise_revenue_model()
            {
            	$sql="SELECT booked_slots.location_id, locations.location, sum(booked_slots.payable_amount) as revenue 
				FROM booked_slots 
				LEFT JOIN locations ON locations.location_id=booked_slots.location_id 
				where booked_slots.status=1 $where GROUP BY booked_slots.coach_id";
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