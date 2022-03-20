<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoice_Model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	public function send_email_invoice($wallet_transaction_id, $from=''){
	    $sql="select w.*, r.sid, r.name, p.email_id as parent_email from wallet_transactions w 
	    left join registrations r on r.id = w.student_id 
	    left join parent p on p.parent_id = w.parent_id 
	    where w.id='$wallet_transaction_id'";
	    $row = $this->db->query($sql)->row_array();
	    
	    
	    if(trim($from) == "RegistrationFees")
	    {
	        $this->load->helper('string');
    		$this->load->library('Phpmailer');
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
    		    $mail->addAddress($row['parent_email']);
    		}
    		else
    		{
    		    $mail->addAddress(DEFAULT_MAIL);
    		}
    		
    		
    		
    		
    		
    		$mail->isHTML(true);
    
    		$mail->Subject = "Prime Star Sports Services - Tax Invoice";
    		
    		$body = '';
    		$body .= "<!DOCTYPE>
            <html>
            <head>
                <title></title>
                <style>
                    table, th, td{ border: 1px solid black;
              border-collapse: collapse;
              height: 63px;
                width: -webkit-fill-available;
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
                    <h2>Tax Invoice</h2>
                </div>
                <div style='text-align: right; '>
                <p>Invoice No:<b>".$row['invoice_id']."</b></p>
            	<p>Date:<b>16-12-2019</b></p>
            	</div>
            	<div style='text-align:left'>
            	<h4>Prime Star Sports Services</h4>
            	<p>Po Box:114037, Dubai, UAE<p>
            	<p>Emirate:Dubai</p>
            	<p>TRN 100053127500003</p>
            	<p>E-Mail:<a href='#'>bmr_ind@hotmail.com</a></p>
            	<hr>
            	<p>Customer:</p>
            	<p>TIMRSHAH</p>
            	<p>Emirate:Dubai</p>
            	<p>Country:UAE</p>
            	<p>Place of service:UAE</p>
            	<p></p>
            	<p>Student Name:<b>".$row['name']."</b></p>
            	</div>
                <table style='width:100%;'>
                        <tr>
                            <th>Sl No.</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>VAT(5%)</th>
                        </tr>";
               
                
            
            $body .= "<tr>
                        <td>1.</td>
                        <td> Registration Fees </td>
                        <td>".$row['gross_amount']."</td>
                        <td>".$row['vat_value']."</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Gross Amount:</td>
                            <td>".$row['gross_amount']."</td>
                            <td>".$row['vat_value']."</td>
            			</tr>
            			<tr>
                            <td></td>
                            <td>Net Amount:</td>
                            <td>".$row['net_amount']."</td>
                            <td></td>
            			</tr>
            			<tr>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>AED ".$row['net_amount']."</b></td>
                            <td></td>
            			</tr>
            			";
            
             $body .= "</table>
                <div style='text-align:left'>
            	<p style='text-decoration:underline'>Declaration</p>
            	<p>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
            	<hr>
            	<p>This is a Computer Generated Invoice</p>
            	<hr>
            	<p>Click here for:<a href='www.primestaruae.com'>Terms & Conditions </a></p>
            	<p>Click here to visit our website:<a href='www.primestaruae.com'>www.primestaruae.com</a></p>
            </div>";
            $mail->Body = $body;
    		$mail->AltBody = "This is the plain text version of the email content";
    		
    		if(!$mail->send()) 
    		{
    			
    		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
    		   return false;
    		}
    		else{
    			return true;
    		}
	        
	    }
	    else if(trim($from) == "SlotBookingFees")
	    {
	        $slot_booking_id = $row['slot_booking'];
	        if(!$slot_booking_id)
	        {
	            return false;
	        }
	        $sql2="select g.game, p.email_id, sum(bs.payable_amount) as amount, sum(bs.vat_amount) as vat_amount, count(bs.id) as cnt, sum(deducted_amount) as net_amount from booking_approvals ba 
	        left join booked_slots bs on bs.booking_id = ba.id
	        left join games g on g.game_id = ba.activity_id
	        left join parent p on p.parent_id = ba.parent_id
	        where ba.id=$slot_booking_id and bs.status=1";
	        $result2 = $this->db->query($sql2)->row_array();
	        
	        $this->load->helper('string');
    		$this->load->library('Phpmailer');
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
    		    $mail->addAddress($row['parent_email']);
    		}
    		else
    		{
    		    $mail->addAddress(DEFAULT_MAIL);
    		}
    		
    		
    		
    		
    		
    		$mail->isHTML(true);
    
    		$mail->Subject = "Prime Star Sports Services - Tax Invoice";
    		
    		$body = '';
    		$body .= "<!DOCTYPE>
            <html>
            <head>
                <title></title>
                <style>
                    table, th, td{ border: 1px solid black;
              border-collapse: collapse;
              height: 63px;
                width: -webkit-fill-available;
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
                    <h2>Tax Invoice</h2>
                </div>
                <div style='text-align: right; '>
                <p>Invoice No:<b>".$row['invoice_id']."</b></p>
            	<p>Date:<b>16-12-2019</b></p>
            	</div>
            	<div style='text-align:left'>
            	<h4>Prime Star Sports Services</h4>
            	<p>Po Box:114037, Dubai, UAE<p>
            	<p>Emirate:Dubai</p>
            	<p>TRN 100053127500003</p>
            	<p>E-Mail:<a href='#'>bmr_ind@hotmail.com</a></p>
            	<hr>
            	<p>Customer:</p>
            	<p>TIMRSHAH</p>
            	<p>Emirate:Dubai</p>
            	<p>Country:UAE</p>
            	<p>Place of service:UAE</p>
            	<p></p>
            	<p>Student Name:<b>".$row['name']."</b></p>
            	</div>
                <table style='width:100%;'>
                        <tr>
                            <th>Sl No.</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>VAT(5%)</th>
                        </tr>";
               
                
            
            $body .= "<tr>
                        <td>1.</td>
                        <td> Slot Booking Fees - ".$result2['game']."</td>
                        <td>".$result2['cnt']."</td>
                        <td>".$result2['amount']."</td>
                        <td>".$result2['vat_amount']."</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Gross Amount:</td>
                            <td>".$result2['amount']."</td>
                            <td>".$result2['vat_amount']."</td>
            			</tr>
            			<tr>
                            <td></td>
                            <td></td>
                            <td>Net Amount:</td>
                            <td>".$result2['net_amount']."</td>
                            <td></td>
            			</tr>
            			<tr>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>AED ".$result2['net_amount']."</b></td>
                            <td></td>
            			</tr>
            			";
            
             $body .= "</table>
                <div style='text-align:left'>
            	<p style='text-decoration:underline'>Declaration</p>
            	<p>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
            	<hr>
            	<p>This is a Computer Generated Invoice</p>
            	<hr>
            	<p>Click here for:<a href='www.primestaruae.com'>Terms & Conditions </a></p>
            	<p>Click here to visit our website:<a href='www.primestaruae.com'>www.primestaruae.com</a></p>
            </div>";
            $mail->Body = $body;
    		$mail->AltBody = "This is the plain text version of the email content";
    		
    		if(!$mail->send()) 
    		{
    			
    		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
    		   return false;
    		}
    		else{
    		    //echo 'sent';
    			return true;
    		}
	        
	    }
	    else if($from == "WalletTransaction")
	    {
	        
	        
	        $this->load->helper('string');
    		$this->load->library('Phpmailer');
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
    		    $mail->addAddress($row['parent_email']);
    		}
    		else
    		{
    		    $mail->addAddress(DEFAULT_MAIL);
    		}
    		
    		
    		
    		
    		
    		$mail->isHTML(true);
    
    		$mail->Subject = "Prime Star Sports Services - Tax Invoice";
    		
    		$body = '';
    		$body .= "<!DOCTYPE>
            <html>
            <head>
                <title></title>
                <style>
                    table, th, td{ border: 1px solid black;
              border-collapse: collapse;
              height: 63px;
                width: -webkit-fill-available;
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
                    <h2>Tax Invoice</h2>
                </div>
                <div style='text-align: right; '>
                <p>Invoice No:<b>".$row['invoice_id']."</b></p>
            	<p>Date:<b>16-12-2019</b></p>
            	</div>
            	<div style='text-align:left'>
            	<h4>Prime Star Sports Services</h4>
            	<p>Po Box:114037, Dubai, UAE<p>
            	<p>Emirate:Dubai</p>
            	<p>TRN 100053127500003</p>
            	<p>E-Mail:<a href='#'>bmr_ind@hotmail.com</a></p>
            	<hr>
            	<p>Customer:</p>
            	<p>TIMRSHAH</p>
            	<p>Emirate:Dubai</p>
            	<p>Country:UAE</p>
            	<p>Place of service:UAE</p>
            	<p></p>
            	<p>Student Name:<b>".$row['name']."</b></p>
            	</div>
                <table style='width:100%;'>
                        <tr>
                            <th>Sl No.</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>VAT(5%)</th>
                        </tr>";
               
                
            
            $body .= "<tr>
                        <td>1.</td>
                        <td> ".$row['ac_code']."</td>
                        <td>".$row['gross_amount']."</td>
                        <td>".$row['vat_value']."</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Gross Amount:</td>
                            <td>".$row['gross_amount']."</td>
                            <td>".$row['vat_value']."</td>
            			</tr>
            			<tr>
                            <td></td>
                            <td>Net Amount:</td>
                            <td>".$row['net_amount']."</td>
                            <td></td>
            			</tr>
            			<tr>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>AED ".$row['net_amount']."</b></td>
                            <td></td>
            			</tr>
            			";
            
             $body .= "</table>
                <div style='text-align:left'>
            	<p style='text-decoration:underline'>Declaration</p>
            	<p>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
            	<hr>
            	<p>This is a Computer Generated Invoice</p>
            	<hr>
            	<p>Click here for:<a href='www.primestaruae.com'>Terms & Conditions </a></p>
            	<p>Click here to visit our website:<a href='www.primestaruae.com'>www.primestaruae.com</a></p>
            </div>";
            $mail->Body = $body;
    		$mail->AltBody = "This is the plain text version of the email content";
    		
    		if(!$mail->send()) 
    		{
    			
    		   //echo "Mailer Error: " . $mail->ErrorInfo;die;
    		   return false;
    		}
    		else{
    			return true;
    		}
	    }
	}
	
	public function send_email_invoice_monthly($student_id){
	    
	    
	}
}
?>