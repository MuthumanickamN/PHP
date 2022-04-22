<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class Activity_Selections extends CI_Controller {  
      
    
	public function __construct(){
		parent::__construct();
		//$this->load->model('Default_Model', 'default');
		$this->load->model('School_profile_report_Model', 'schools');
		//$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	public function edit($id, $eid, $from=0)
	{
	     
		$query = $this->db->query('select a.*, g.game, p.parent_name, p.parent_code, p.emirate_id as parent_emirate_id,p.emirates_expiry as parent_emirates_expiry,
		p.passport_id as parent_passport, r.name as student_name, r.passport_id as student_passport, r.emirates_id as student_emirate_id, 
		r.emirates_id_expire as student_emirates_expiry,r.id as student_id, p.parent_id 
		from activity_selections a 
		left join games g on game_id=a.activity_id 
		left join parent p on p.parent_id=a.parent_user_id 
		left join registrations r on r.id=a.student_id 
		where a.id='.$id);
    	$data=$query->row_array();
    	$data['back_url'] =$eid;
    	$data['activity_selection_id'] =$id;
    	$data['title'] ="Activity Selections";
    	$data['from'] =$from;
    	
		
		$data['activityList'] = $this->schools->getAllActivityList();
    	
    	$query2 = $this->db->query("select * from game_levels order by games_level_id asc");
    	$data['levels']=$query2->result_array();
    	
    	$query3 = $this->db->query("select * from coach where role='headcoach' and deleted=0  and activity_id='".$data['activity_id']."'");
    	$data['head_coaches']=$query3->result_array();
    	
    	$query4 = $this->db->query("select * from bank_details");
    	$data['banks']=$query4->result_array();
        
        $query5 = $this->db->query("SELECT * FROM fees_yearly_contract");
    	$data['contract_fee']=$query5->row()->fees_amount;
    	
    	$query6 = $this->db->query("SELECT * FROM vat_setups where id=1");
    	$data['vat_perc']=$query6->row()->percentage;
    	
    	$data['vat_val']=  sprintf("%.2f",($data['contract_fee'] * $data['vat_perc'])/100);
    	$data['total_amount'] = sprintf("%.2f", round($data['contract_fee'] + $data['vat_val'],2));
    	
    	$query7 = $this->db->query("select * from discount_setups");
    	$data['discount_list']=$query7->result_array();
    	
    	$this->load->view('activity_selections_view',$data);
	}
	
	public function updateActivity(){
		
		#@set_magic_quotes_runtime(false);
        ini_set('magic_quotes_runtime', 0);
	
		$id = $this->input->post('id');
		$from = $this->input->post('from');
		$contract=$this->input->post('contract');
		$level_id=$this->input->post('level_id');
		$head_coach_id=$this->input->post('head_coach_id');
		$status=$this->input->post('status');
		$discount_applicable=$this->input->post('discount_applicable');
		$discount_type=$this->input->post('discount_type');
		$discount_percentage=$this->input->post('discount_percentage');
		$approval_status=$this->input->post('approval_status');
		
		
		
		if($discount_applicable == "No")
		{
		    $discount_type = NULL;
		    $discount_percentage = 0.00;
		}

		$email=$this->session->userdata('username');
		$this->db->where('email', $email);  
		$query1 = $this->db->get('users');
		$postData1=$query1->row_array();
		$user_id=$postData1['user_id'];
        $json['from'] = 0;
	    if (empty($json['error']) ) {
		    $sql2="select * from  activity_selections  where id='$id'";
        	$previous_approval_status=$this->db->query($sql2)->row()->approval_status;
        	
        	$updated_at = date('Y-m-d H:i:s');	
        	$sql="Update activity_selections set contract='$contract',level_id='$level_id',head_coach_id='$head_coach_id',status='$status',discount_applicable='$discount_applicable',approval_status='$approval_status',updated_at='$updated_at',discount_type='$discount_type',discount_percentage='$discount_percentage' where id='$id'";
        	$update=$this->db->query($sql);
			if(isset($update)){
				
			
					$email_data_slot = $this->db->query("SELECT a.*,
											   g.level,
											   g.session,
											   gs.game,
											   c.coach_name
										FROM   activity_selections AS a
											   LEFT JOIN game_levels AS g
													  ON a.level_id = g.games_level_id
											   LEFT JOIN games AS gs
													  ON gs.game_id = a.activity_id
											   LEFT JOIN coach AS c
													  ON c.coach_id = a.head_coach_id
										WHERE  a.id = ".$id."");
										
				$email_data_array = $email_data_slot->row_array();	
				if($email_data_array['approval_status']=='Approved' && $previous_approval_status != 'Approved')
				{
					$this->send_email($email_data_array);
				}
				
				$json['status'] = "success";
				$json['from'] = $from;
				$this->output->set_header('Content-Type: application/json');
	        	echo json_encode($json);
			}
			$this->session->set_flashdata('success_msg', 'Activity details updated successfully.');
			
	}else{
	    $this->output->set_header('Content-Type: application/json');
	    echo json_encode($json);
	} 
}

	public function send_email($email_data_array)
	{
		
	
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array['parent_email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Activity approved";
		
		
		$from_html = "";
		$from_html .= "<!DOCTYPE>
<html>
<head>
    <title></title>
    <style>
        table, th, td{ border: 1px solid black;
  border-collapse: collapse;
  height: 41px;
    width: -webkit-fill-available;
        }
        th{
            background-color: #f5efef;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class='logo' style='float: left;
    width: 100%;
    text-align: center;
    background: #ba272d;
    height: 100px; 
    margin-bottom: 20px;'>
        <img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
    </div>
    <div class='header' style='float: left;
    width: 100%;
    text-align: center;
    font-size: 21px;'>
        <h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h2>
    </div>
    <div class='main' style='font-family: sans-serif;'>
        <p>Dear <b>".$email_data_array['parent_name'].",</b></p>
        <p>we are pleased to inform you that your kid <b> ".$email_data_array['student_name']." </b> activity has been approved now you can book your slots in active kids menu.. Activity datails as follows.</p>
         <table>
            <tr>
                <th>Reg-ID</th>
                <th>Psa-ID</th>
                <th>Name</th>
                <th>Activity</th>
                <th>Level</th>
                <th>Session</th>
                <th>Head coach</th>
            </tr>
            <tr>
                <td>".$email_data_array['sid']."</td>
                <td>".$email_data_array['psa_id']."</td>
                <td>".$email_data_array['student_name']."</td>
                <td>".$email_data_array['game']."</td>
                <td>".$email_data_array['level']."</td>
                <td>".$email_data_array['session']."</td>
                <td>".$email_data_array['coach_name']."</td>
            </tr>
        </table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
    </div>";
		$mail->Body = $from_html;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			return true;
		}
		
	}
	
	public function send_contract_approval_mail($email_data_array)
	{
		
	
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($email_data_array[0]['parent_email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Contract approval";
		
		
		$from_html = "";
		$from_html .= "<!DOCTYPE>
<html>
<head>
    <title></title>
    <style>
        table, th, td{ border: 1px solid black;
  border-collapse: collapse;
  height: 41px;
    width: -webkit-fill-available;
        }
        th{
            background-color: #f5efef;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class='logo' style='float: left;
    width: 100%;
    text-align: center;
    background: #ba272d;
    height: 100px; 
    margin-bottom: 20px;'>
        <img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
    </div>
    <div class='header' style='float: left;
    width: 100%;
    text-align: center;
    font-size: 21px;'>
        <h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h2>
    </div>
    <p style='color:black;font-weight:700;'>".$email_data_array[0]['parent_name']." ,</p>
    <p>We are pleased to inform you that your kid <b>".$email_data_array[0]['student_name']."</b>`s ".$email_data_array[0]['game']." contract is
    approved by management and waiting for your confirmation to get the contract activated..</p>
    <p>For contract confirmation kindly login with your credentials <a href='".base_url().'login'."'>Login Here</a></p>
    <p>Steps to follow..</p>
    <p>step1: Login with credentials</p>
    <p>step2: Click Student Profile / Slot Booking Menu</p>
    <p>Step3: Click contract form button under contract</p>
    <p>step4: Click agree terms and condition check box below the model</p>
    <p>step5: click approve button</p>
    <p>after reading the contract kindly click approve as an acceptance from your side for the
    contract to get activated..</p>
    <p style='color:black;font-weight:700;'>Contract From ".$email_data_array[0]['contract_from']." To ".$email_data_array[0]['contract_to']."</p>
    
    <table style='width:100%;text-align:center'>
        <tr>
            <th>Sl No.</th>
            <th>Payment Type</th>
            <th>Bank</th>
            <th>Cheque Number</th>
            <th>Cheque Date</th>
		    <th>Payable Date</th>
			<th>Payable Amount</th>
        </tr>";
        foreach($email_data_array as $key=> $value) {
        $from_html .= "<tr>
            <td>".($key+1)."</td>
            <td>".$value['payment_type']."</td>
            <td>".$value['bank_name']."</td>
            <td>".$value['cheque_number']."</td>
            <td>".$value['cheque_date_']."</td>
            <td>".$value['payable_date_']."</td>
            <td>".$value['payable_amount']."</td>
        </tr>";
        }
        
    $from_html .= "</table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
   ";
		$mail->Body = $from_html;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   echo "Mailer Error: " . $mail->ErrorInfo;die;
		}
		else{
			return true;
		}
		
	}

	public function send_contract_rejected_mail($email_data_array)
	{
		
	
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		$mail->addAddress(DEFAULT_MAIL);
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Contract Request is Rejected";
		
		
		$from_html = "";
		$from_html .= "<!DOCTYPE>
<html>
<head>
    <title></title>
    <style>
        table, th, td{ border: 1px solid black;
  border-collapse: collapse;
  height: 41px;
    width: -webkit-fill-available;
        }
        th{
            background-color: #f5efef;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class='logo' style='float: left;
    width: 100%;
    text-align: center;
    background: #ba272d;
    height: 100px; 
    margin-bottom: 20px;'>
        <img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
    </div>
    <div class='header' style='float: left;
    width: 100%;
    text-align: center;
    font-size: 21px;'>
        <h2>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h2>
    </div>
    <p style='color:black;font-weight:700;'> Parent Name: ".$email_data_array[0]['parent_name']." ,</p>
    <p>We are pleased to inform you that parent's kid <b>".$email_data_array[0]['student_name']."</b>`s ".$email_data_array[0]['game']." contract is
    rejected by parent </p>
    <p style='color:black;font-weight:700;'>Contract From ".$email_data_array[0]['contract_from']." To ".$email_data_array[0]['contract_to']."</p>
    
    <table style='width:100%;text-align:center'>
        <tr>
            <th>Sl No.</th>
            <th>Payment Type</th>
            <th>Bank</th>
            <th>Cheque Number</th>
            <th>Cheque Date</th>
		    <th>Payable Date</th>
			<th>Payable Amount</th>
        </tr>";
        foreach($email_data_array as $key=> $value) {
        $from_html .= "<tr>
            <td>".($key+1)."</td>
            <td>".$value['payment_type']."</td>
            <td>".$value['bank_name']."</td>
            <td>".$value['cheque_number']."</td>
            <td>".$value['cheque_date_']."</td>
            <td>".$value['payable_date_']."</td>
            <td>".$value['payable_amount']."</td>
        </tr>";
        }
        
    $from_html .= "</table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
   ";
		$mail->Body = $from_html;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   echo "Mailer Error: " . $mail->ErrorInfo;die;
		}
		else{
			return true;
		}
		
	}
	
	public function send_contract_form_mail($data)
	{
		
	
		
		$login_url = base_url() .'login';
		//return true;
		//die;
		$this->load->helper('string');
		$this->load->library('phpmailer');
		require_once(APPPATH.'libraries/class.smtp.php');
            
		$mail =  $this->phpmailer;
		//$mail->SMTPDebug = 0;  
		//smtp
		//$mail->isSMTP();
		$mail->SMTPDebug = false;                        
	    $mail->Host = EMAIL_HOST;
		$mail->SMTPAuth = SMTPAUTH;                              
		$mail->Username = SMTP_USERNAME;                 
		$mail->Password = SMTP_PASSWORD;                           
		$mail->SMTPSecure = SMTPSECURE;                    
		$mail->Port = SMTP_PORT;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
        $mail->AddCC(CC_ADDRESS);
		$mail->addAttachment(TERMS_CONDITION_ATTACHMENT);
		if(SEND_TO_PARENT != 'NO'){
		    $mail->addAddress($data[0]['parent_email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Contract Form";
		
		
		$from_html = "";
		$from_html .= "<!DOCTYPE>
<html>
<head>
    <title></title>
    <style>
        table, th, td{ border: 1px solid black;
  border-collapse: collapse;
  height: 63px;
        }
		th{
		color:black;
		font-size:25px;
		}
      body{
color: #d7d2d2;;
font-size: 25px;
}	  
    </style>
</head>

<body>
    <div class='logo' style='float: left;
    width: 100%;
    text-align: center;
    height: 100px; 
    margin-bottom: 20px;'>
        <img src='http://sports.primestaruae.com/images/main_logo.jpg' alt='main_logo' style='height: 100px;'></img>
    </div>
    <div class='header' style='float: left;
    width: 100%;
    text-align: center;
    font-size: 21px;'>
        <h1>Welcome to <span style='color:#ba272d'>Prime Star Sports Services</span></h1>
        <h3 style='text-decoration: underline; color:#b13636'>PRIME STAR SPORT SERVICES “YEARLY SPONSORSHIP CONTRACT”</h3>
    </div>";
    
    $from_html .= '<div style="text-align: left; ">
	<p>THIS CONTRACT is made on '.date('d-m-Y').'.</p></div>
	<div style="width:100%; float:left">
	<div style="width:30%; float:left">
	<p>BETWEEN</p>
	</div>
	<div style="width:70%; float:right">
	<p>Prime Star Sports Services, Dubai, UAE PO Box
114037</p>
	</div>
	</div>
	<div style="width:100%; float:left">
	<div style="width:30%; float:left">
	<p>AND</p>
	</div>
	<div style="width:70%; float:right">
	<p>Student Name:<span style="text-decoration:underline"> '.$data[0]['student_name'].'</span></p>
	<p>Student Passport Number:<span style="text-decoration:underline"> '.$data['student_passport'].'</span></p>
	<p>Parents Name:<span style="text-decoration:underline">'.$data[0]['parent_name'].'</span></p>
	<p>Parent Passport Number:<span style="text-decoration:underline"> </span></p><br><br>
	</div>
	</div>
	
	<p>Dear Raghavan NRS</p>
	<p>We are pleased to offer Yearly Sponsorship Contract at Prime Star Sport
Academy for your kid as per the terms and conditions stated below:</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CONTRACT PERIOD:</p>
<p>Yearly sponsorship contract start date will be <span style="text-decoration:underline">'.$data[0]['contract_from'].'</span>, provided you fulfil the
academy’s requirements for said membership.</p>
<p>Membership Duration: '.$data[0]['year'].' Year</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">THE TERM</p>
<ol>
<li>The term of this yearly sponsorship conrtact is for a fixed period of One year,
calculated from your contract start date.</li>
<li>This period of the yearly sponsorship contract may be updated and will reviewed
formally every year annually subject to the consent from both Prime Star and the
Student/Parent/Gaurdian but without any binding obligation to Prime Star.</li>
<li>If Parent / Student / Guardian do not intend to renew your contract upon expiry,
please send written confirmation of your intention three (3) months prior to expiry
or a penalty of three (3) months gross Charges in lieu thereof will be charged.</li>
<li>Without prejudice to any other rights and remedies it may have, Prime Star may
terminate the Sponsorship yearly contract according to the Termination clause set
terminate the Sponsorship yearly contract according to the Termination clause set
out here.</li>
</ol>
<p style="color:#b13636; font-size:20px;font-weight:700;">BENEFITS OF CONTRACT:</p>
<p>As a Yearly Sponsorship Contract member of Prime Star Sport Services, you will be
provided with the best of coaching and support by our staff, for your chosen sport. We
kindly request you to follow the responsibilities outlined to you in your membership
description, this will be presented to you on joining and is available as an appendices to
this contract, the Terms and Conditions below also outline the key considerations for you
in your role.</p>
<p>Yearly Sponsorship Contract Students will get Unlimited classes as per coaches guidance
at Prime Star venues only. These additional classes will be charged at normal fees cost
and will given as discount in every month invoice.</p>
<p>Prime Star Sport Services reserves the right to assign additional rules and
responsibilities to your “Yearly Sponsorship Contract” according to the needs and
requirements of the academy, prevailing at the time.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CANCELLATION OF CONTRACT:</p>
<p style="padding-left: 20px;
    margin-left: 20px;">This is a limited “Yearly Sponsorship Contract” and may be terminated by either party
by issuance of a minimum of <span style="color:red;font-weight:700">90</span> days notice in advance by writing from either side.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">After the sign of Contract between Student / Parent / Guardian & Academy and If
Student / Parent / Guardian, decided to withdraw or the student Terminated by Prime
Star Sport Services for the breach of terms and conditions the entire Sponsored
amount spent by Academy (The monthly discount amount enjoyed as a sponsorship
has to be paid in full upon withdraw or termination.) to be paid back by Parents /
Guaridan / Students.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">In the instance of Disciplinary matters, breach of contract or terminated, the
sponsorship Terms and Conditions set out below.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Prime Star Sport Services disciplinary procedure of terminating immediately shall be
followed, such termination of this Sponsorship contract without due notice will result
in you forfeiting your Contract fee and Termination clause set out here will be
impiimented.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Up on cancellation, Balance cheques will be returned to parent / Guardian / Student by
fulfilling the contract obligation.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Contract obligation: The monthly discount amount enjoyed as a sponsorship has to
be paid in full upon withdraw or termination, to be paid back by Parents / Guaridan /
Students in full payment immediately within 5 working days upon submitting the
notice.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 80%;">STUDENT-ATHLETE COMMITMENT & CODE OF CONDUCT:</h1>
<p><span style="color:black">1.</span> You will pledge to make Academic Studies and Prime Star Sport Services your top
priorities.</p>
<p>2. You are expected to give 100% effort in training</p>
<P>3. You are expected to obey the rules and regulations of our Prime Star Sport Services,
Coaches, and other staff members of the Academy.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">SPORTSMANSHIP:</p>
<p><span style="color:black">1.</span> Give your fullest mental, physical, and emotional effort at every team meeting, training,practice, and game.</p>
<p>a. Be silent, attentive, and an active learner during all instruction</p>
<p>b. Unless instructed otherwise, practice at championship game speed</p>
<p style="padding-bottom:20px">c. Compete with 100% effort at all times and then respectfully accept the results of the
competition (victory or defeat)</p>
<p>2. Respect every person with whom you come in contact with. You will respect all referees
and opposing teams at all times. You are a representative of Prime Star Sport Services
and you are expected to act in a respectful manner at all times, especially in times of
frustration or conflict. You will respect and care for others with:</p>
<p>a. Your words</p>
<p>b. Your positive attitude</p>
<p>c. Your body language</p>
<p style="padding-bottom:20px">d. Your actions</p>
<p>3. With your enthusiasm, hard work, and determination, you can make this season a
terrific experience for yourself and everyone else in the Academy.</p>
<p>a. Praise and encourage your teammates loudly</p>
<p>b. Act courteous and respectful toward every teammate and parent</p>
<p>c. Respect your coaches regardless of who is starting in games, substitution patterns,
practice time and playing time.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">COMPETITON CLAUSE:</p>
<p>Once we sign the yearly contract the Athletes / Players / Students are not allowed to join
any of our direct / indirect competitor clubs / academies in UAE, after the
completion/Termination of contract with Prime Star Sport Services LLC for the period of 1
year.</p>
<p>Upon signing the contract, you are agreeing to this Contract, if any contract terms
breached, then you need to fulfill contract obligation to avoid any legal issues.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CONDUCT CLAUSE:</p>
<p>Any unacceptable conduct of the student resulting in unnecessary hardship to the costudents,
staff and also to the academy in any way will initially be communicated to the
student & Parents in written. In the event our effort do not yield the desired result and the
student continues with his/her unacceptable conduct, the matter will be escalated to the
parents by written and necessary action may be taken which includes the termination for
the student from the Academy.</p>
<p>The property belonging to the Academy as well as to others should be handled with care.
Any cost incurred by the academy to repair/replace such property if damaged as a result
of any deliberate attempt and/or negligence will be charged to the respective student.
Further, the student should take care of their personal belongings and the institute will not
take any responsibility for the safe keeping of such personal belongings.</p>
<p>Prime Star Sport Services LLC reserves the right to exclude any person from lessons for
a breach of these conditions or whom they consider unfit to take the provided sport
activity, a danger to themselves or others or who are displaying abusive or disruptive
behavior.</p>
<p>Only students registered for the course will be permitted on the play area.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">STUDENT OBLIGATION AND COMMITMENT:</p>
<p><span style="color:black">1</span>, Prime Star Students should wear Academy Swim Cap while attending classes and
tournaments.</p>
<p>2, Prime Star Students should wear Academy T-Shirt while coming for classes and
tournaments.</p>
<p>3, Academy will give one T-Shirt and one Swim Cap as welcome Kit.</p>
<p>4, If needed Parents need to buy extra T-Shirt by paying the charges advised by Prime Star
admin staff.</p>
<p>Students must wear the Prime Star uniform to all practical lesson. If this cannot be met,
then students will not be allowed to take class and the same will not be compensated.</p>
<p>If students had two wrong uniform days in a Month, a phone call will be made home.</p>
<p>If students had three wrong uniform days in a Month, then there is a possibility of
disciplinary action will be taken.</p>
<p>Coaches / Management will decide on the event and tournament to be participated, both
students/athletes and parents cannot and should not interfere in Coaches / Management
decision.</p>
<p>By signing below, you agree to the Student-Athlete Commitment & Code of Conduct and
Student Obligation, any breach of this contract could result in suspension or termination
of your membership with Prime Star Sport Services.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">PARENTS CODE OF CONDUCT:</h1>
<p>Parents play an import role in the development of a successful Athlete / player / Sports
Person. Parents MUST be a positive influence in the sports experience. Parents will do
this by:</p>
<p>1. Encouraging good sportsmanship by demonstrating positive support for all players,
coaches, and officials at every game, practice or team function.</p>
<p>2. You will not enter the training area during a game, scrimmage, training session, or
practice unless otherwise asked to do so by the coach.</p>
<p>3. You will not verbally or physically abuse, confront, taunt, harass, or demean a coach,
student /athlete, opposing student-athlete, another parent, or a referee at any time.</p>
<p>4. You understand that parents cannot coach their child or other student-athletes from the
sideline or anywhere else during scrimmages, practices, training sessions, or games.</p>
<p>5. You will make every effort to allow your child to attend all practices, training sessions,
games, tournaments, and team functions. You will need to call in or e-mail or Message the
admin to inform him or her that your child will not be in attendance. You will need to have
an excused absence authorized by the admin / coach in order to miss practice, training, or
a game.</p>
<p>6. You will abide by the “24 hour rule” which means not speaking to your coach, the
management team or other parents about the Issue or your child’s playing time within 24
hours after the Issue.</p>
<p>a. After the “24 hour rule”, you may call the admin / coach and speak over the phone with
him or her or set up an appointment to meet with the coach by admin and address your
concerns regarding the Training / Issue.</p>
<p>b. If you are not satisfied following the meeting with the coach, you may go to the owner to
discuss your concerns. The owner will not address concerns until after a phone
conversation or meeting has taken place with the coach.</p>
<p>7. During practice and training sessions, you will remain in the lobby or observation area
in the training venue. All practices and training sessions are closed to spectators, parents,
and children not participating in that particular session.</p>
<p>8. Coaches / Management will decide on the event and tournament to be participated by
the student/athletes, both students/athletes and parents cannot and should not interfere in
Coaches / Management decision.</p>
<p>By signing below, you agree to the Parent Code of Conduct and any breach of this
contract could result in suspension or termination of your membership with Prime Star
Sport Services.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">FEES AND PRIME STAR SPORT ACADEMY SPONSORSHIP DETAILS:</h1>
<p>To ensure proper functioning of the academy, it is important for all of us to follow certain
terms & conditions and most of them are listed below. We request you to please go thru
them carefully to avoid any ambiguity going forward.</p>
<p>Only Registered Members can take part in Prime Star Sport Services activities</p>
<p>Annual Registration Fees: (Every January): AED 200</p>
<p>Document Required: Filled up agreement form, Singed by parents and athletes, Online
Registrationa and upload all document required (i.e Passport Copy, Emirates ID Copy
Passport Size Photo and sponsor PP copy with visa page and Emirates ID.)</p>
<p>Parents Yearly Contribution: Per Annum AED <span style="text-decoration:underline">18900</span> payable in <span style="text-decoration:underline">1</span> Equal Instalment by Post
Dated Cheques.</p>
<p>Prime Star Sport Services, Supports the Sposnsored Yearly Contract Students by
providing Unlimited classes as per coaches guidance at Prime Star venues only. These
additional classes will be charged at normal fees cost and will given as discount in every
month invoice.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">PARENTS FINANCIAL RESPONSIBILITY & TERMS AND CONDITIONS OF ACADEMY SPONSORSHIP:</h1>
<p>Annual Registration Fees: AED <span style="text-decoration:underline">105</span></p>
<p>Parents Yearly Contribution: Per Annum AED <span style="text-decoration:underline">18900</span> payable in <span style="text-decoration:underline">1</span> Equal Instalment by Post
Dated Cheques.</p>

	<table style="width:100%;text-align:center">
	<tr>
                <th>Sl No.</th>
                <th>Payment Type</th>
                <th>Bank</th>
                <th>Cheque Number</th>
                <th>Cheque Date</th>
			    <th>Payable Date</th>
				<th>Payable Amount</th>
		</tr>';
foreach($data as $key=> $value) {
        $from_html .= "<tr>
            <td>".($key+1)."</td>
            <td>".$value['payment_type']."</td>
            <td>".$value['bank_name']."</td>
            <td>".$value['cheque_number']."</td>
            <td>".$value['cheque_date_']."</td>
            <td>".$value['payable_date_']."</td>
            <td>".$value['payable_amount']."</td>
        </tr>";
        }
		
		
			
$from_html .= '		</table>
		<p>Prime Star Sport Services, Supports the Sponsored Yearly Contract Students by
providing Unlimited classes as per coaches guidance at Prime Star venues only. These
additional classes will be charged at normal fees cost and will given as discount in every
month invoice.</p>
<p>Please obtain all the fees structure and number of classes to be attended from the Coach
& Admin team.</p>
<p>Each month payment includes all holidays, breaks and any potential scheduled or
unscheduled interruptions to training due to matters beyond our reasonable control, e.g.
weather or maintenance. The fees cover coaching services and are not attributable to
individual coaches. Whilst every effort will be taken to ensure that training schedule
individual coaches. Whilst every effort will be taken to ensure that training schedule
remains consistent, occasionally sessions may be reduced and coaches may be
substituted due to tapering and competition commitments.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">STUDENTS WHO WISH WITHDRAW OR TERMINATED BY ACADEMY FOR BREACHING THE TERMS AND CONDITIONS NEED TO FOLLOW THE BELOW CONTRACT OBLIGATION ON FEES & PAYMENT:</p>
<p>Students who availed “Sponsorship – Yearly Contract” from Prime Star Sport Services
upon withdraw / termination for any reason WILL NOT be entitled to any refund.</p>
<p>After the sign of Contract between Student / Parent & Academy and If Student or Parent /
decided to withdraw or the student Terminated by Prime Star Sport Services for the
breach of terms and conditions the entire Sponsored amount spent by Academy (The
monthly discount amount enjoyed as a sponsorship has to be paid in full upon withdraw
or termination.) to be paid back by Parents / Students.</p>
<p>If any payments above are not paid, and collection services are necessary, Prime Star
Sport Services may also recover any and all costs and fees incurred as a result of
collections, including reasonable attorney fees and costs.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">PAYMENT OF FEE:</h1>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Fees must be paid in advance on or before taking the first class of every Qtr.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Please collect the receipt for all the transaction without fail. If receipt not collected
then it will be considered as not paid.</p>
</div>
</div>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">ACADEMY ATTENDANCE:</h1>
<p>There is no doubt that the most influential variable on performance is attendance at
sessions. It has been accepted for a long time that there is a high correlation between
good performance and a consistently high level of attendance at all prescribed training
session.</p>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>The courses are offered for 6 Days a week.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Number of Class & Classes duration are based on levels and as per coach
recommendation.</p>
</div>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Every student is allotted a specific timing for each class and it is very important to
follow these timings. Each student should be present before the beginning of the
class.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>In case the student is unable to attend the classes continuously for more than a
month for whatsoever reason including academic school exams, vacations,
medical reasons etc, such absences should be communicated in writing in the
prescribed format to the Academy. This is important to avoid any possibility of
such student losing already allotted schedules (Coach, Class, Timings etc) due to
such prolonged absence to another student requesting for similar schedules.</p>
</div>
</div>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">REFUND OF FEE</h1>
<ul>
<li>There are no refunds of fee offered to students / parent for any reason.</li>
</ul>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">COMPENSATORY CLASSES IN LIEU OF THE MISSED
CLASSES</h1>
<ul>
<li>Compensatory classes are generally not provided in case of classes missed for
whatever reasons (Holidays, Short term Sickness, School programs etc). However,
at it`s discretion, the Academy may consider granting the compensatory classes
only under the following exception case:<br>
<p>i: Unforeseen circumstances like medical illness, by providing valid medical
certificate compensation classed may be considered by the Academy.</p></li>
<li>Compensatory classes, if any, agreed to be provided by the academy must be taken
as per the availability advised by admin team before the end of the following month
in which it was missed and the compensatory classes will not be carried forward
beyond this period for what so ever reason.</li>
<li>Compensatory classes are NOT provided for the classes, which could not be
conducted as a result of public holidays applicable to the private sector as
published in the local newspapers.</li>
<li>Compensation classes will only be offered when classes have had to be cancelled
by Prime Star Sport Services.</li>
</ul>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">PROGRESS REPORT</h1>
<p>We encourage the parents to obtain feedback regarding the progress of their children at
regular intervals from the Coaches. However, we do not recommend parents directly
calling the Coach/Teachers on their cell phones to discuss any matter including the
progress of their children, since it may disturb their class proceedings. Any requests for
meeting/discussion with the coach/teacher should be routed thru the admin team to
ensure setting up a mutually convenient time for such meeting/discussion.</p>
<p>Under any circumstances, parents and/or any other person will NOT be permitted to enter
the class area whatsoever reason when the class is in progress. Kindly coordinate thru
admin team for any appointment by written.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">MEDIA CONSENT</h1>
<p>Social media can be a useful tool to communicate with teammates, fans, friends, coaches,
and more.</p>
<p>Social media can also be dangerous if you are not careful. Every picture, link, quote,
tweet, status, or post that you or your friends put online is forever part of your digital
footprint. You never know when that will come back to hurt or help your reputation during
the recruiting process, a new job, or other important areas of your life. Parents and
Athletes agree as follows:</p>
<ul>
<li>I will take responsibility for their online profile, including posts and any photos,
videos or other recordings posted by others in which I/my child appear.</li>
<li>I will not degrade opponents before, during or after competitions and or events.</li>
<li>I will post only positive things about my/my child’s teammates, coaches,
opponents, and other athletes and/or coaches/staff in our Prime Star Sport
Academy.</li>
<li>I will use social media to purposefully promote abilities, team, and community
social values.</li>
<li>I will ignore any negative comments not retaliate. I can go to my coach or support
staff to seek support or help with any issue.</li>
<li>If I see a teammate post something potentially negative online, I will have a
conversation with that teammate. If I do not feel comfortable doing so, I will talk to
my coach.</li>
<li>I am aware that I represent my Prime Star Sport Services, team, family and
community at all times, and will do so in a positive manner.</li>
</ul>
<p>In Permitting my Son/Daughter/My Self to take part in Lesson/Class, I am specifically
granting my permission to Prime Star Sport Services LLC to use the Student’s Name,
Picture, Photos, Interview, Voice, Videos and Words in Television, Radio, Film,
Publications, Newspaper, Magazine and other medias and form for the purpose and
communication of Prime Star Sport Services LLC During the tenure of the student and
thereafter.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">DO`S & DON`TS:</h1>
<ul>
<li>Swimming Students should take shower before entering the swimming pool</li>
<li>Swimming Student should wear appropriate swimming dress, goggles and
swimming cap</li>
<li>All known illnesses and allergies of the student must be declared on the enrolment
form.</li>
<li>Swimming Students Should Wear anti-slip shoes / slippers on the poolside.</li>
<li>Running, Jumping and food are NOT allowed in the poolside.</li>
<li>Jewelry and watches NOT to be worn while attending lessons.</li>
<li>Academy Students should wear appropriate sports dress and non-marking shoes.</li>
<li>Parents are NOT allowed to communicate with the Coaches during the class hours.</li>
<li>No liability will attach to the Prime Star Sport Services LLC for incidents, which
occur as a result of breach of terms & conditions.</li>
</ul>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">INSURANCE INFORMATION:</h1>
<p><span style="text-decoration:underline">I Raghavan NRS</span>, the undersigned parent or legal guardian, declare that my child has
medical insurance.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">EMERGENCY AUTHORIZATION:</h1>
<p><span style="text-decoration:underline">I Raghavan NRS</span>, the undersigned parent or legal guardian, hereby authorize the designated instructor or official acting as an activity supervisor, as my agent to seek
medical, surgical, or dental examination and treatment in the event of an emergency.</p>
<h1 style="font-size:37px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 100%;">WAIVER OF LIABILITY AND DISCLAIMER:</h1>
<p><span style="text-decoration:underline">I Raghavan NRS</span>, the undersigned parent or legal guardian, hereby agree to allow the
individual names herein to participate in the aforementioned activity and further agree to
indemnify and hold harmless, Prime Star Sport Services, Dubai, UAE, its employees,
volunteers, and other representatives from any claims arising out of or relating to any
physical injury that may result from the participation in Academy practice, tournaments,
workouts, training sessions, camps, clinics, classes, or activity.</p>
<p><span style="text-decoration:underline">I Raghavan NRS</span>,the undersigned parent or legal guardian, hereby agree that Prime Star
Sport Services, Dubai, UAE, and its staff do not assume liability for any injuries that occur
while at Prime Star Sport Services practices, games, training sessions, events,
tournaments, camps, clinics, or on the way to any Prime Star Sport Services activities.
Parents or guardians should contact their own insurance carrier to get additional
insurance for the participant, if necessary. As a condition of enrollment, the following
disclaimer of liability must be signed and dated by the participant’s parent or legal
guardian. The parent or guardian of the participant is permitting the participant to
participate and recognizes that he/she is doing so at his/her own risk. Prime Star Sport
Academy and its officers, agents, and staff shall not be liable for any damages arising
from personal injury sustained by the participant while at or on the way to and from any
activity. The participant and his or her parent or guardians assume full responsibility for
any damages or injuries which may occur to the participant during the season and so
hereby full and forever exonerate and discharge Prime Star Sport Services, it officers,
agents, and staff from any and all claims, demands, damages, rights of action or causes of
action, present or future, whether the same be known, participated, or unanticipated,
resulting from or arising out of the participants participation in the program, I understand
that Sports activity is a potentially risky activity in which my child might be injured
severely. This includes death. I, therefore, release any and all Prime Star Sport Services
staff members from liability of any kind of injury to my child, however serious it may be,
because of the connection with the activity. I/we allow the use of my/our likeness for the
program publicity. Prime Star Sport Services reserves the right to use any photos or
video taken during clinics, camps, training sessions, workouts, practice, tournaments,
travel tournaments, etc. I acknowledge that I have read the above information and
understand its contents.</p>
<p>By signing below, parents/guardian/student agree to all the above terms and conditions
and Responsibility, any breach of this contract could result in suspension or termination
of your contract with Prime Star Sport Services.</p>
<p>Athlete / Student Name: <span style="text-decoration:underline">Dhanwanth Ragavan</span>
<p>Parent/Guardian Name:<span style="text-decoration:underline"> Mr/Mrs Raghavan NRS</span>
<p>Prime Star Sport Services LLC</p>';
        
        
    $from_html .= "</table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
   ";
		$mail->Body = $from_html;
		$mail->AltBody = "This is the plain text version of the email content";
		
		if(!$mail->send()) 
		{
			return false;
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			return true;
		}
		
	}
	
public function addContractPayment()
{
    
	$activity_selection_id = $this->input->post('activity_selection_id');
	$year=$this->input->post('contract_year');
	$contract_from_date=$this->input->post('contract_from');
	$contract_to_date=$this->input->post('contract_to');
	$contract_gross_amount=$this->input->post('contract_amount');
	$contract_vat_percentage=$this->input->post('vat_percentage');
	$contract_vat_amount=$this->input->post('vat_amount');
	$contract_net_amount=$this->input->post('tot_amount');
	$created_at = date('Y-m-d H:i:s');
	$created_by = $this->session->userdata('userid');
	
    $date1 = str_replace('/', '-', $contract_from_date);
    $contract_from_date = date('Y-m-d', strtotime($date1));
    
    $date2 = str_replace('/', '-', $contract_to_date);
    $contract_to_date = date('Y-m-d', strtotime($date2));
    
    
        	
	$insert_arr = array(
	    'activity_selection_id' => $activity_selection_id,
	    'year' => $year,
	    'contract_from_date' => $contract_from_date,
	    'contract_to_date' => $contract_to_date,
	    'contract_gross_amount' => $contract_gross_amount,
	    'contract_vat_percentage' => $contract_vat_percentage,
	    'contract_vat_amount' => $contract_vat_amount,
	    'contract_net_amount' => $contract_net_amount,
	    'created_at' => $created_at,
	    'created_by' => $created_by
	    );
    $this->db->insert('contract_details' , $insert_arr);
	$insert_id = $this->db->insert_id();
	
	$insert_contract_payments = array();
	$payment_type_arr = $this->input->post('payment_type');
	$payable_date_arr = $this->input->post('payable_date');
	$cheque_date_arr = $this->input->post('cheque_date');
	$payable_amount_arr = $this->input->post('payable_amount');
	$bank_id_arr = $this->input->post('bank_id');
	$cheque_bank_arr = $this->input->post('cheque_bank');
	$cheque_number_arr = $this->input->post('cheque_no');
	
	$contract_student_passport_id=$this->input->post('contract_student_passport_id');
	$contract_student_emirates_id=$this->input->post('contract_student_emirates_id');
	$contract_student_emirates_id_expiry=$this->input->post('contract_student_emirates_id_expiry');
	$student_id=$this->input->post('student_id');
	$parent_id=$this->input->post('parent_id');
	
	$arr_a = array(
	    'emirates_id_expire'=>$contract_student_emirates_id_expiry,
	    'emirates_id'=>$contract_student_emirates_id,
	    'passport_id'=>$contract_student_passport_id,
	    );
    $this->db->where('id', $student_id);
    $this->db->update('registrations', $arr_a);
    
    $contract_parent_passport_id=$this->input->post('contract_parent_passport_id');
	$contract_parent_emirates_id=$this->input->post('contract_parent_emirates_id');
	$contract_parent_emirates_id_expiry=$this->input->post('contract_parent_emirates_id_expiry');
	
	
	$arr_b = array(
	    'emirates_expiry'=>$contract_parent_emirates_id_expiry,
	    'emirate_id'=>$contract_parent_emirates_id,
	    'passport_id'=>$contract_parent_passport_id,
	    );
    $this->db->where('parent_id', $parent_id);
    $this->db->update('parent', $arr_b);
    
    
    
	
	foreach($payment_type_arr as $key => $payment)
	{
	    if($payment !='')
	    {
	        $payable_date = $payable_date_arr[$key];
	        $payable_amount = $payable_amount_arr[$key];
	        $bank_id = $bank_id_arr[$key];
	        $date3 = str_replace('/', '-', $payable_date);
            $payable_date = date('Y-m-d', strtotime($date3));
            
            
            $payable_amount = sprintf("%.2f", round($payable_amount,2));
            
	        if($payment == 'Cash')
	        {
	            $insert_arr2 = array(
            	    'contract_detail_id' => $insert_id,
            	    'payment_type' => $payment,
            	    'bank_id' => NULL,
            	    'cheque_bank' => NULL,
            	    'cheque_number' => NULL,
            	    'cheque_date' => NULL,
            	    'payable_date' => $payable_date,
            	    'payable_amount' => $payable_amount,
            	    'created_on' => $created_at,
            	    'created_by' => $created_by
        	    );
	        }
	        else if($payment == 'Card')
	        {
	             $insert_arr2 = array(
            	    'contract_detail_id' => $insert_id,
            	    'payment_type' => $payment,
            	    'bank_id' => $bank_id,
            	    'cheque_bank' => NULL,
            	    'cheque_number' => NULL,
            	    'cheque_date' => NULL,
            	    'payable_date' => $payable_date,
            	    'payable_amount' => $payable_amount,
            	    'created_on' => $created_at,
            	    'created_by' => $created_by
        	    );
	        }
	        else if($payment == 'Online')
	        {
	            $insert_arr2 = array(
            	    'contract_detail_id' => $insert_id,
            	    'payment_type' => $payment,
            	    'bank_id' => $bank_id,
            	    'cheque_bank' => NULL,
            	    'cheque_number' => NULL,
            	    'cheque_date' => NULL,
            	    'payable_date' => $payable_date,
            	    'payable_amount' => $payable_amount,
            	    'created_on' => $created_at,
            	    'created_by' => $created_by
        	    );
        	    
	            
	        }
	        else if($payment == 'Cheque')
	        {
	            
	            $cheque_date = $cheque_date_arr[$key];
    	        $date4 = str_replace('/', '-', $cheque_date);
                $cheque_date = date('Y-m-d', strtotime($date4));
                
                $cheque_bank = $cheque_bank_arr[$key];
                $cheque_number = $cheque_number_arr[$key];
                 
	            $insert_arr2 = array(
            	    'contract_detail_id' => $insert_id,
            	    'payment_type' => $payment,
            	    'bank_id' => NULL,
            	    'cheque_bank' => $cheque_bank,
            	    'cheque_number' => $cheque_number,
            	    'cheque_date' => $cheque_date,
            	    'payable_date' => $payable_date,
            	    'payable_amount' => $payable_amount,
            	    'created_on' => $created_at,
            	    'created_by' => $created_by
        	    );
	        }
    	    
    	    array_push($insert_contract_payments, $insert_arr2);
	    }
    }
    //print_r($insert_contract_payments);die;
    $this->db->insert_batch('contract_payments' , $insert_contract_payments);
    
    $sql_e = "SELECT *, 
    date_format(str_to_date(c.contract_from_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_from, 
    date_format(str_to_date(c.contract_to_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_to,
	CASE WHEN p.cheque_date is NOT NULL
    THEN date_format(str_to_date(p.cheque_date, '%Y-%m-%d'), '%d-%m-%Y')
	ELSE '' END as cheque_date_,
	CASE WHEN p.payable_date is NOT NULL THEN
    date_format(str_to_date(p.payable_date, '%Y-%m-%d'), '%d-%m-%Y')
	ELSE '' END as payable_date_,
    date_format(str_to_date(c.created_at, '%Y-%m-%d'), '%d-%m-%Y') as created_at
    FROM `contract_details` as c 
left join contract_payments as p on p.contract_detail_id=c.id
left join activity_selections a on a.id= c.activity_selection_id
left join bank_details b on b.id= p.bank_id
left join games g on g.game_id= a.activity_id
WHERE c.id=$insert_id order by p.id asc";
$email_array_query = $this->db->query($sql_e);
if($email_array_query->num_rows() > 0)
{
    $email_array = $email_array_query->result_array();
    if($email_array[0]['contract_form_sent_to_parent'] == 0)
    {
        $this->send_contract_approval_mail($email_array);	
        $sql_u = "Update contract_details set contract_form_sent_to_parent=1 where id=$insert_id";
        $this->db->query($sql_u);
    }
}

	
    echo true;
}

public function contract_approved()
{
    
	$id = $this->input->post('id');
	if($id)
	{
	    
        $sql_u = "Update contract_details set parent_approved='Approved',active_contract='0' where activity_selection_id=$id and status=1";
        $this->db->query($sql_u);
		$sql_e = "SELECT *, 
    date_format(str_to_date(c.contract_from_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_from, 
    date_format(str_to_date(c.contract_to_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_to,
	CASE WHEN p.cheque_date is NOT NULL
    THEN date_format(str_to_date(p.cheque_date, '%Y-%m-%d'), '%d-%m-%Y')
	ELSE '' END as cheque_date_,
	CASE WHEN p.payable_date is NOT NULL THEN
    date_format(str_to_date(p.payable_date, '%Y-%m-%d'), '%d-%m-%Y')
	ELSE '' END as payable_date_,
    date_format(str_to_date(c.created_at, '%Y-%m-%d'), '%d-%m-%Y') as created_at
    FROM `contract_details` as c 
	left join contract_payments as p on p.contract_detail_id=c.id
	left join activity_selections a on a.id= c.activity_selection_id
	left join bank_details b on b.id= p.bank_id
	left join games g on g.game_id= a.activity_id
	WHERE c.activity_selection_id=$id and c.status=1 order by p.id asc";
	$email_array_query = $this->db->query($sql_e);
		if($email_array_query->num_rows() > 0)
		{
			$email_array = $email_array_query->result_array();
			$this->send_contract_form_mail($email_array);	
				
		}
		
	}
}

public function contract_rejected()
{
    
	$id = $this->input->post('id');
	if($id)
	{
	    
		$sql_e = "SELECT *, 
		date_format(str_to_date(c.contract_from_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_from, 
		date_format(str_to_date(c.contract_to_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_to,
		CASE WHEN p.cheque_date is NOT NULL
		THEN date_format(str_to_date(p.cheque_date, '%Y-%m-%d'), '%d-%m-%Y')
		ELSE '' END as cheque_date_,
		CASE WHEN p.payable_date is NOT NULL THEN
		date_format(str_to_date(p.payable_date, '%Y-%m-%d'), '%d-%m-%Y')
		ELSE '' END as payment_date_,
		date_format(str_to_date(c.created_at, '%Y-%m-%d'), '%d-%m-%Y') as created_at
		FROM `contract_details` as c 
		left join contract_payments as p on p.contract_detail_id=c.id
		left join activity_selections a on a.id= c.activity_selection_id
		left join bank_details b on b.id= p.bank_id
		left join games g on g.game_id= a.activity_id
		WHERE c.activity_selection_id=$id and c.status=1 order by p.id asc";
		$email_array_query = $this->db->query($sql_e);

		$sql_u = "Update contract_details set parent_approved='Rejected',active_contract='0',status=0 where activity_selection_id=$id and status=1";
		$this->db->query($sql_u);
			
		if($email_array_query->num_rows() > 0)
		{
			$email_array = $email_array_query->result_array();
				$this->send_contract_rejected_mail($email_array);	
				
		}
		
	}
}

public function contract_form_data()
{
    
    $id = $this->input->post('id');
    $sql = "SELECT *, r.passport_id as student_passport,r.name as student_name,
            date_format(str_to_date(c.contract_from_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_from, 
			date_format(str_to_date(c.contract_to_date, '%Y-%m-%d'), '%d-%m-%Y') as contract_to,
			CASE WHEN p.cheque_date is NOT NULL
			THEN date_format(str_to_date(p.cheque_date, '%Y-%m-%d'), '%d-%m-%Y')
			ELSE '' END as cheque_date_,
			CASE WHEN p.payable_date is NOT NULL THEN
			date_format(str_to_date(p.payable_date, '%Y-%m-%d'), '%d-%m-%Y')
			ELSE '' END as payment_date_,
			date_format(str_to_date(c.created_at, '%Y-%m-%d'), '%d-%m-%Y') as created_at
            FROM `contract_details` as c 
        left join contract_payments as p on p.contract_detail_id=c.id
        left join activity_selections a on a.id= c.activity_selection_id
        left join bank_details b on b.id= p.bank_id
        left join registrations r on r.id= a.student_id
        WHERE c.activity_selection_id=$id";
    
    $data = $this->db->query($sql)->result_array();
    //print_r($data[0]['student_name']);die;    
    $from_html = '<div style="text-align: left; ">
	<p>THIS CONTRACT is made on '.$data[0]['created_at'].'.</p></div>
	<div style="width:100%; float:left">
	<div style="width:30%; float:left">
	<p>BETWEEN</p>
	</div>
	<div style="width:70%; float:right">
	<p>Prime Star Sports Services, Dubai, UAE PO Box
114037</p>
	</div>
	</div>
	<div style="width:100%; float:left">
	<div style="width:30%; float:left">
	<p>AND</p>
	</div>
	<div style="width:70%; float:right">
	<p>Student Name:<span style="text-decoration:underline"> '.$data[0]['student_name'].'</span></p>
	<p>Student Passport Number:<span style="text-decoration:underline"> '.$data[0]['student_passport'].'</span></p>
	<p>Parents Name:<span style="text-decoration:underline">'.$data[0]['parent_name'].'</span></p>
	<p>Parent Passport Number:<span style="text-decoration:underline"> </span></p><br><br>
	</div>
	</div>
	<div class="contract1" style="float:left;width:100%">
	<p>Dear Raghavan NRS</p>
	<p>We are pleased to offer Yearly Sponsorship Contract at Prime Star Sport
Academy for your kid as per the terms and conditions stated below:</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CONTRACT PERIOD:</p>
<p>Yearly sponsorship contract start date will be <span style="text-decoration:underline">'.$data[0]['contract_from'].'</span>, provided you fulfil the
academy’s requirements for said membership.</p>
<p>Membership Duration: '.$data[0]['year'].' Year</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">THE TERM</p>
<ol>
<li>The term of this yearly sponsorship conrtact is for a fixed period of One year,
calculated from your contract start date.</li>
<li>This period of the yearly sponsorship contract may be updated and will reviewed
formally every year annually subject to the consent from both Prime Star and the
Student/Parent/Gaurdian but without any binding obligation to Prime Star.</li>
<li>If Parent / Student / Guardian do not intend to renew your contract upon expiry,
please send written confirmation of your intention three (3) months prior to expiry
or a penalty of three (3) months gross Charges in lieu thereof will be charged.</li>
<li>Without prejudice to any other rights and remedies it may have, Prime Star may
terminate the Sponsorship yearly contract according to the Termination clause set
terminate the Sponsorship yearly contract according to the Termination clause set
out here.</li>
</ol>
<p style="color:#b13636; font-size:20px;font-weight:700;">BENEFITS OF CONTRACT:</p>
<p>As a Yearly Sponsorship Contract member of Prime Star Sport Services, you will be
provided with the best of coaching and support by our staff, for your chosen sport. We
kindly request you to follow the responsibilities outlined to you in your membership
description, this will be presented to you on joining and is available as an appendices to
this contract, the Terms and Conditions below also outline the key considerations for you
in your role.</p>
<p>Yearly Sponsorship Contract Students will get Unlimited classes as per coaches guidance
at Prime Star venues only. These additional classes will be charged at normal fees cost
and will given as discount in every month invoice.</p>
<p>Prime Star Sport Services reserves the right to assign additional rules and
responsibilities to your “Yearly Sponsorship Contract” according to the needs and
requirements of the academy, prevailing at the time.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CANCELLATION OF CONTRACT:</p>
<p style="padding-left: 20px;
    margin-left: 20px;">This is a limited “Yearly Sponsorship Contract” and may be terminated by either party
by issuance of a minimum of <span style="color:red;font-weight:700">90</span> days notice in advance by writing from either side.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">After the sign of Contract between Student / Parent / Guardian & Academy and If
Student / Parent / Guardian, decided to withdraw or the student Terminated by Prime
Star Sport Services for the breach of terms and conditions the entire Sponsored
amount spent by Academy (The monthly discount amount enjoyed as a sponsorship
has to be paid in full upon withdraw or termination.) to be paid back by Parents /
Guaridan / Students.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">In the instance of Disciplinary matters, breach of contract or terminated, the
sponsorship Terms and Conditions set out below.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Prime Star Sport Services disciplinary procedure of terminating immediately shall be
followed, such termination of this Sponsorship contract without due notice will result
in you forfeiting your Contract fee and Termination clause set out here will be
impiimented.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Up on cancellation, Balance cheques will be returned to parent / Guardian / Student by
fulfilling the contract obligation.</p>
<p style="padding-left: 20px;
    margin-left: 20px;">Contract obligation: The monthly discount amount enjoyed as a sponsorship has to
be paid in full upon withdraw or termination, to be paid back by Parents / Guaridan /
Students in full payment immediately within 5 working days upon submitting the
notice.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 56%;">STUDENT-ATHLETE COMMITMENT & CODE OF CONDUCT:</h1>
<p><span style="color:black">1.</span> You will pledge to make Academic Studies and Prime Star Sport Services your top
priorities.</p>
<p>2. You are expected to give 100% effort in training</p>
<P>3. You are expected to obey the rules and regulations of our Prime Star Sport Services,
Coaches, and other staff members of the Academy.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">SPORTSMANSHIP:</p>
<p><span style="color:black">1.</span> Give your fullest mental, physical, and emotional effort at every team meeting, training,practice, and game.</p>
<p>a. Be silent, attentive, and an active learner during all instruction</p>
<p>b. Unless instructed otherwise, practice at championship game speed</p>
<p style="padding-bottom:20px">c. Compete with 100% effort at all times and then respectfully accept the results of the
competition (victory or defeat)</p>
<p>2. Respect every person with whom you come in contact with. You will respect all referees
and opposing teams at all times. You are a representative of Prime Star Sport Services
and you are expected to act in a respectful manner at all times, especially in times of
frustration or conflict. You will respect and care for others with:</p>
<p>a. Your words</p>
<p>b. Your positive attitude</p>
<p>c. Your body language</p>
<p style="padding-bottom:20px">d. Your actions</p>
<p>3. With your enthusiasm, hard work, and determination, you can make this season a
terrific experience for yourself and everyone else in the Academy.</p>
<p>a. Praise and encourage your teammates loudly</p>
<p>b. Act courteous and respectful toward every teammate and parent</p>
<p>c. Respect your coaches regardless of who is starting in games, substitution patterns,
practice time and playing time.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">COMPETITON CLAUSE:</p>
<p>Once we sign the yearly contract the Athletes / Players / Students are not allowed to join
any of our direct / indirect competitor clubs / academies in UAE, after the
completion/Termination of contract with Prime Star Sport Services LLC for the period of 1
year.</p>
<p>Upon signing the contract, you are agreeing to this Contract, if any contract terms
breached, then you need to fulfill contract obligation to avoid any legal issues.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">CONDUCT CLAUSE:</p>
<p>Any unacceptable conduct of the student resulting in unnecessary hardship to the costudents,
staff and also to the academy in any way will initially be communicated to the
student & Parents in written. In the event our effort do not yield the desired result and the
student continues with his/her unacceptable conduct, the matter will be escalated to the
parents by written and necessary action may be taken which includes the termination for
the student from the Academy.</p>
<p>The property belonging to the Academy as well as to others should be handled with care.
Any cost incurred by the academy to repair/replace such property if damaged as a result
of any deliberate attempt and/or negligence will be charged to the respective student.
Further, the student should take care of their personal belongings and the institute will not
take any responsibility for the safe keeping of such personal belongings.</p>
<p>Prime Star Sport Services LLC reserves the right to exclude any person from lessons for
a breach of these conditions or whom they consider unfit to take the provided sport
activity, a danger to themselves or others or who are displaying abusive or disruptive
behavior.</p>
<p>Only students registered for the course will be permitted on the play area.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">STUDENT OBLIGATION AND COMMITMENT:</p>
<p><span style="color:black">1</span>, Prime Star Students should wear Academy Swim Cap while attending classes and
tournaments.</p>
<p>2, Prime Star Students should wear Academy T-Shirt while coming for classes and
tournaments.</p>
<p>3, Academy will give one T-Shirt and one Swim Cap as welcome Kit.</p>
<p>4, If needed Parents need to buy extra T-Shirt by paying the charges advised by Prime Star
admin staff.</p>
<p>Students must wear the Prime Star uniform to all practical lesson. If this cannot be met,
then students will not be allowed to take class and the same will not be compensated.</p>
<p>If students had two wrong uniform days in a Month, a phone call will be made home.</p>
<p>If students had three wrong uniform days in a Month, then there is a possibility of
disciplinary action will be taken.</p>
<p>Coaches / Management will decide on the event and tournament to be participated, both
students/athletes and parents cannot and should not interfere in Coaches / Management
decision.</p>
<p>By signing below, you agree to the Student-Athlete Commitment & Code of Conduct and
Student Obligation, any breach of this contract could result in suspension or termination
of your membership with Prime Star Sport Services.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 30%;">PARENTS CODE OF CONDUCT:</h1>
<p>Parents play an import role in the development of a successful Athlete / player / Sports
Person. Parents MUST be a positive influence in the sports experience. Parents will do
this by:</p>
<p>1. Encouraging good sportsmanship by demonstrating positive support for all players,
coaches, and officials at every game, practice or team function.</p>
<p>2. You will not enter the training area during a game, scrimmage, training session, or
practice unless otherwise asked to do so by the coach.</p>
<p>3. You will not verbally or physically abuse, confront, taunt, harass, or demean a coach,
student /athlete, opposing student-athlete, another parent, or a referee at any time.</p>
<p>4. You understand that parents cannot coach their child or other student-athletes from the
sideline or anywhere else during scrimmages, practices, training sessions, or games.</p>
<p>5. You will make every effort to allow your child to attend all practices, training sessions,
games, tournaments, and team functions. You will need to call in or e-mail or Message the
admin to inform him or her that your child will not be in attendance. You will need to have
an excused absence authorized by the admin / coach in order to miss practice, training, or
a game.</p>
<p>6. You will abide by the “24 hour rule” which means not speaking to your coach, the
management team or other parents about the Issue or your child’s playing time within 24
hours after the Issue.</p>
<p>a. After the “24 hour rule”, you may call the admin / coach and speak over the phone with
him or her or set up an appointment to meet with the coach by admin and address your
concerns regarding the Training / Issue.</p>
<p>b. If you are not satisfied following the meeting with the coach, you may go to the owner to
discuss your concerns. The owner will not address concerns until after a phone
conversation or meeting has taken place with the coach.</p>
<p>7. During practice and training sessions, you will remain in the lobby or observation area
in the training venue. All practices and training sessions are closed to spectators, parents,
and children not participating in that particular session.</p>
<p>8. Coaches / Management will decide on the event and tournament to be participated by
the student/athletes, both students/athletes and parents cannot and should not interfere in
Coaches / Management decision.</p>
<p>By signing below, you agree to the Parent Code of Conduct and any breach of this
contract could result in suspension or termination of your membership with Prime Star
Sport Services.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 63%;">FEES AND PRIME STAR SPORT ACADEMY SPONSORSHIP DETAILS:</h1>
<p>To ensure proper functioning of the academy, it is important for all of us to follow certain
terms & conditions and most of them are listed below. We request you to please go thru
them carefully to avoid any ambiguity going forward.</p>
<p>Only Registered Members can take part in Prime Star Sport Services activities</p>
<p>Annual Registration Fees: (Every January): AED 200</p>
<p>Document Required: Filled up agreement form, Singed by parents and athletes, Online
Registrationa and upload all document required (i.e Passport Copy, Emirates ID Copy
Passport Size Photo and sponsor PP copy with visa page and Emirates ID.)</p>
<p>Parents Yearly Contribution: Per Annum AED <span style="text-decoration:underline">18900</span> payable in <span style="text-decoration:underline">1</span> Equal Instalment by Post
Dated Cheques.</p>
<p>Prime Star Sport Services, Supports the Sposnsored Yearly Contract Students by
providing Unlimited classes as per coaches guidance at Prime Star venues only. These
additional classes will be charged at normal fees cost and will given as discount in every
month invoice.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 93%;">PARENTS FINANCIAL RESPONSIBILITY & TERMS AND CONDITIONS OF ACADEMY SPONSORSHIP:</h1>
<p>Annual Registration Fees: AED <span style="text-decoration:underline">105</span></p>
<p>Parents Yearly Contribution: Per Annum AED <span style="text-decoration:underline">18900</span> payable in <span style="text-decoration:underline">1</span> Equal Instalment by Post
Dated Cheques.</p>

	<table style="width:100%;text-align:center">
	<tr>
                <th>Sl No.</th>
                <th>Payment Type</th>
                <th>Bank</th>
                <th>Cheque Number</th>
                <th>Cheque Date</th>
			    <th>Payable Date</th>
				<th>Payable Amount</th>
		</tr>';
foreach($data as $key=> $value) {
        $from_html .= "<tr>
            <td>".($key+1)."</td>
            <td>".$value['payment_type']."</td>
            <td>".$value['bank_name']."</td>
            <td>".$value['cheque_number']."</td>
            <td>".$value['cheque_date_']."</td>
            <td>".$value['payment_date_']."</td>
            <td>".$value['payable_amount']."</td>
        </tr>";
        }
		
		
			
$from_html .= '		</table>
		<p>Prime Star Sport Services, Supports the Sponsored Yearly Contract Students by
providing Unlimited classes as per coaches guidance at Prime Star venues only. These
additional classes will be charged at normal fees cost and will given as discount in every
month invoice.</p>
<p>Please obtain all the fees structure and number of classes to be attended from the Coach
& Admin team.</p>
<p>Each month payment includes all holidays, breaks and any potential scheduled or
unscheduled interruptions to training due to matters beyond our reasonable control, e.g.
weather or maintenance. The fees cover coaching services and are not attributable to
individual coaches. Whilst every effort will be taken to ensure that training schedule
individual coaches. Whilst every effort will be taken to ensure that training schedule
remains consistent, occasionally sessions may be reduced and coaches may be
substituted due to tapering and competition commitments.</p>
<p style="color:#b13636; font-size:20px;font-weight:700;">STUDENTS WHO WISH WITHDRAW OR TERMINATED BY ACADEMY FOR BREACHING THE TERMS AND CONDITIONS NEED TO FOLLOW THE BELOW CONTRACT OBLIGATION ON FEES & PAYMENT:</p>
<p>Students who availed “Sponsorship – Yearly Contract” from Prime Star Sport Services
upon withdraw / termination for any reason WILL NOT be entitled to any refund.</p>
<p>After the sign of Contract between Student / Parent & Academy and If Student or Parent /
decided to withdraw or the student Terminated by Prime Star Sport Services for the
breach of terms and conditions the entire Sponsored amount spent by Academy (The
monthly discount amount enjoyed as a sponsorship has to be paid in full upon withdraw
or termination.) to be paid back by Parents / Students.</p>
<p>If any payments above are not paid, and collection services are necessary, Prime Star
Sport Services may also recover any and all costs and fees incurred as a result of
collections, including reasonable attorney fees and costs.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 18%;">PAYMENT OF FEE:</h1>

<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Fees must be paid in advance on or before taking the first class of every Qtr.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Please collect the receipt for all the transaction without fail. If receipt not collected
then it will be considered as not paid.</p>
</div>
</div>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 25%;">ACADEMY ATTENDANCE:</h1>
<p>There is no doubt that the most influential variable on performance is attendance at
sessions. It has been accepted for a long time that there is a high correlation between
good performance and a consistently high level of attendance at all prescribed training
session.</p>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>The courses are offered for 6 Days a week.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Number of Class & Classes duration are based on levels and as per coach
recommendation.</p>
</div>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>Every student is allotted a specific timing for each class and it is very important to
follow these timings. Each student should be present before the beginning of the
class.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="width:3%;float:left;margin-left:30px">
<p>- </p></div>
<div style="width:90%;float:left;">
<p>In case the student is unable to attend the classes continuously for more than a
month for whatsoever reason including academic school exams, vacations,
medical reasons etc, such absences should be communicated in writing in the
prescribed format to the Academy. This is important to avoid any possibility of
such student losing already allotted schedules (Coach, Class, Timings etc) due to
such prolonged absence to another student requesting for similar schedules.</p>
</div>
</div>
</div>
<div class="contract2" style="float:left;width:100%">
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 16%;">REFUND OF FEE</h1>
<ul>
<li>There are no refunds of fee offered to students / parent for any reason.</li>
</ul>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 57%;">COMPENSATORY CLASSES IN LIEU OF THE MISSED
CLASSES</h1>
<ul>
<li>Compensatory classes are generally not provided in case of classes missed for
whatever reasons (Holidays, Short term Sickness, School programs etc). However,
at it`s discretion, the Academy may consider granting the compensatory classes
only under the following exception case:<br>
<p>i: Unforeseen circumstances like medical illness, by providing valid medical
certificate compensation classed may be considered by the Academy.</p></li>
<li>Compensatory classes, if any, agreed to be provided by the academy must be taken
as per the availability advised by admin team before the end of the following month
in which it was missed and the compensatory classes will not be carried forward
beyond this period for what so ever reason.</li>
<li>Compensatory classes are NOT provided for the classes, which could not be
conducted as a result of public holidays applicable to the private sector as
published in the local newspapers.</li>
<li>Compensation classes will only be offered when classes have had to be cancelled
by Prime Star Sport Services.</li>
</ul>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 19%;">PROGRESS REPORT</h1>
<p>We encourage the parents to obtain feedback regarding the progress of their children at
regular intervals from the Coaches. However, we do not recommend parents directly
calling the Coach/Teachers on their cell phones to discuss any matter including the
progress of their children, since it may disturb their class proceedings. Any requests for
meeting/discussion with the coach/teacher should be routed thru the admin team to
ensure setting up a mutually convenient time for such meeting/discussion.</p>
<p>Under any circumstances, parents and/or any other person will NOT be permitted to enter
the class area whatsoever reason when the class is in progress. Kindly coordinate thru
admin team for any appointment by written.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 17%;">MEDIA CONSENT</h1>
<p>Social media can be a useful tool to communicate with teammates, fans, friends, coaches,
and more.</p>
<p>Social media can also be dangerous if you are not careful. Every picture, link, quote,
tweet, status, or post that you or your friends put online is forever part of your digital
footprint. You never know when that will come back to hurt or help your reputation during
the recruiting process, a new job, or other important areas of your life. Parents and
Athletes agree as follows:</p>
<ul>
<li>I will take responsibility for their online profile, including posts and any photos,
videos or other recordings posted by others in which I/my child appear.</li>
<li>I will not degrade opponents before, during or after competitions and or events.</li>
<li>I will post only positive things about my/my child’s teammates, coaches,
opponents, and other athletes and/or coaches/staff in our Prime Star Sport
Academy.</li>
<li>I will use social media to purposefully promote abilities, team, and community
social values.</li>
<li>I will ignore any negative comments not retaliate. I can go to my coach or support
staff to seek support or help with any issue.</li>
<li>If I see a teammate post something potentially negative online, I will have a
conversation with that teammate. If I do not feel comfortable doing so, I will talk to
my coach.</li>
<li>I am aware that I represent my Prime Star Sport Services, team, family and
community at all times, and will do so in a positive manner.</li>
</ul>
<p>In Permitting my Son/Daughter/My Self to take part in Lesson/Class, I am specifically
granting my permission to Prime Star Sport Services LLC to use the Student’s Name,
Picture, Photos, Interview, Voice, Videos and Words in Television, Radio, Film,
Publications, Newspaper, Magazine and other medias and form for the purpose and
communication of Prime Star Sport Services LLC During the tenure of the student and
thereafter.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 16%;">DO`S & DON`TS:</h1>
<ul>
<li>Swimming Students should take shower before entering the swimming pool</li>
<li>Swimming Student should wear appropriate swimming dress, goggles and
swimming cap</li>
<li>All known illnesses and allergies of the student must be declared on the enrolment
form.</li>
<li>Swimming Students Should Wear anti-slip shoes / slippers on the poolside.</li>
<li>Running, Jumping and food are NOT allowed in the poolside.</li>
<li>Jewelry and watches NOT to be worn while attending lessons.</li>
<li>Academy Students should wear appropriate sports dress and non-marking shoes.</li>
<li>Parents are NOT allowed to communicate with the Coaches during the class hours.</li>
<li>No liability will attach to the Prime Star Sport Services LLC for incidents, which
occur as a result of breach of terms & conditions.</li>
</ul>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 28%;">INSURANCE INFORMATION:</h1>
<p><span style="text-decoration:underline">'.$data[0]['parent_name'].'</span>, the undersigned parent or legal guardian, declare that my child has
medical insurance.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 31%;">EMERGENCY AUTHORIZATION:</h1>
<p><span style="text-decoration:underline">'.$data[0]['parent_name'].'</span>, the undersigned parent or legal guardian, hereby authorize the designated instructor or official acting as an activity supervisor, as my agent to seek
medical, surgical, or dental examination and treatment in the event of an emergency.</p>
<h1 style="font-size:25px;border-bottom:2px dotted #b13636;color:#b13636;font-weight:700;width: 40%;">WAIVER OF LIABILITY AND DISCLAIMER:</h1>
<p><span style="text-decoration:underline">'.$data[0]['parent_name'].'</span>, the undersigned parent or legal guardian, hereby agree to allow the
individual names herein to participate in the aforementioned activity and further agree to
indemnify and hold harmless, Prime Star Sport Services, Dubai, UAE, its employees,
volunteers, and other representatives from any claims arising out of or relating to any
physical injury that may result from the participation in Academy practice, tournaments,
workouts, training sessions, camps, clinics, classes, or activity.</p>
<p><span style="text-decoration:underline">'.$data[0]['parent_name'].'</span>,the undersigned parent or legal guardian, hereby agree that Prime Star Sport Services, Dubai, UAE, and its staff do not assume liability for any injuries that occur
while at Prime Star Sport Services practices, games, training sessions, events,
tournaments, camps, clinics, or on the way to any Prime Star Sport Services activities.
Parents or guardians should contact their own insurance carrier to get additional
insurance for the participant, if necessary. As a condition of enrollment, the following
disclaimer of liability must be signed and dated by the participant’s parent or legal
guardian. The parent or guardian of the participant is permitting the participant to
participate and recognizes that he/she is doing so at his/her own risk. Prime Star Sport
Academy and its officers, agents, and staff shall not be liable for any damages arising
from personal injury sustained by the participant while at or on the way to and from any
activity. The participant and his or her parent or guardians assume full responsibility for
any damages or injuries which may occur to the participant during the season and so
hereby full and forever exonerate and discharge Prime Star Sport Services, it officers,
agents, and staff from any and all claims, demands, damages, rights of action or causes of
action, present or future, whether the same be known, participated, or unanticipated,
resulting from or arising out of the participants participation in the program, I understand
that Sports activity is a potentially risky activity in which my child might be injured
severely. This includes death. I, therefore, release any and all Prime Star Sport Services
staff members from liability of any kind of injury to my child, however serious it may be,
because of the connection with the activity. I/we allow the use of my/our likeness for the
program publicity. Prime Star Sport Services reserves the right to use any photos or
video taken during clinics, camps, training sessions, workouts, practice, tournaments,
travel tournaments, etc. I acknowledge that I have read the above information and
understand its contents.</p>
<p>By signing below, parents/guardian/student agree to all the above terms and conditions
and Responsibility, any breach of this contract could result in suspension or termination
of your contract with Prime Star Sport Services.</p>
<p>Athlete / Student Name: <span style="text-decoration:underline">'.$data[0]['student_name'].'</span>
<p>Parent/Guardian Name:<span style="text-decoration:underline"> '.$data[0]['parent_name'].'</span>
<p>Prime Star Sport Services LLC</p>
</div>';
        
        
    $from_html .= "</table>";
    
    echo $from_html;
}
	
}

?>