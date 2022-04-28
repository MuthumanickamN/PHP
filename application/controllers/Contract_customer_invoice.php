<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contract_customer_invoice extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Default_Model', 'default');
        $this->load->model('School_profile_report_Model', 'school');
        $this->load->model('Daily_Transaction_Model', 'transaction');
		$this->load->model('Invoice_Model', 'invoice_model');
    }
    public function index(){
        $data['title'] ='Contract Customer Invoice';

        $query = $this->db->query("select c.id,c.last_contract_amount_paid_month_year,c.year,c.contract_gross_amount,ROUND((c.contract_net_amount/(c.year*12)),2) as monthly_amount, a.psa_id,r.name as student_name,r.parent_name, a.activity_id,a.parent_mobile, c.contract_net_amount as amount,
                                p.balance_credits
                                from contract_details as c
                                LEFT JOIN activity_selections as a on a.id = c.activity_selection_id
                                left join registrations r on r.id = a.student_id
                                LEFT JOIN prepaid_credits as p on p.parent_id = a.user_id
                                WHERE c.status=1 and c.parent_approved='Approved' order by `id` DESC");
        $arrayList = $query->result_array();
        foreach($arrayList as $key=>$array){
            $arrayList[$key]['activity_id']=$this->transaction->getActivityDetail($array['activity_id']);
        }
        $data['arrayList'] = $arrayList;
        $this->load->view('contract/index', $data);
    }
    public function invoice()
    {
        //print_r($_POST);die;
        $contract_id_arr = $this->input->post('contract_id');
        if(count($contract_id_arr) > 0)
        {
            foreach($contract_id_arr as $key => $contract_id)
            {
                $sql="select cd.*,r.name as student_name,a_s.student_id,a_s.parent_user_id,ROUND((cd.contract_gross_amount/(cd.year*12)),2) as monthly_amount,p.parent_code from contract_details cd 
                left join activity_selections as a_s on a_s.id=cd.activity_selection_id
                left join parent p on p.parent_id=a_s.parent_user_id
                left join registrations r on r.id = a_s.student_id
                where cd.id=$contract_id";
                $row = $this->db->query($sql)->row_array();

                #wallettransaction & invoice
                $parent_id = $row['parent_user_id'];
                $student_id = $row['student_id'];
                $student_name = $row['student_name'];
                $creditsDetails1 = $this->db->query('select * from prepaid_credits where parent_id='.$parent_id);
                $creditsDetailsData1 = $creditsDetails1->row_array();
                $wallet_amount = $creditsDetailsData1['balance_credits'];
                $gross = $row['monthly_amount'];
                $vat_amount = (sprintf("%2f", ($row['monthly_amount']*5)/100)); 
                $net_amount = sprintf("%2f", $gross+$vat_amount);
                $balance_credits = sprintf("%2f",$wallet_amount - $net_amount);
                
                $update2=array(
                    'balance_credits' => $balance_credits,
                    'total_credits' => $balance_credits,
                );
                
                $this->db->where('parent_id',$parent_id);
                $this->db->update('prepaid_credits', $update2);
                $txn_id = $this->school->getLastEntry('wallet_transactions');
                $wallet_transaction_id = 'WTXNO-'.$txn_id;
        
                $inv_id = $this->default->getInvoiceId('wallet_transactions');
                $invoice_id = 'PS'.date('Y').'-'.$inv_id;
                $sqlp="SELECT p.parent_code, p.parent_name, p.mobile_no,p.email_id FROM `parent` p 
                where p.parent_id=$parent_id";
                $resultp = $this->db->query($sqlp)->row_array();

                $walletArray = array(
                    'wallet_transaction_id' =>$wallet_transaction_id,
                    'ac_code' => 'SBWT',
                    'wallet_transaction_date' =>date('Y-m-d'),
                    'wallet_transaction_type' =>'Debit',
                    'wallet_transaction_detail' => 'Contract Amount - '.date('M Y'),
                    'updated_admin_id' => $parent_id,
                    'reg_id' => $student_id,
                    'wallet_transaction_amount' => $net_amount,
                    'gross_amount' => $gross,
                    'vat_percentage' => 5.00,
                    'vat_value' => $vat_amount,
                    'net_amount' => $net_amount,
                    'debit' => $net_amount,
                    'invoice' => 'yes',
                    'invoice_id' =>$invoice_id,
                    'slot_booking'=>'',
                    'student_id'=> $student_id,
                    'parent_id'=> $parent_id,
					'balance_credit'=>$balance_credits,
                    'parent_name'=> $resultp['parent_name'],
                    'parent_mobile'=> $resultp['mobile_no'],
                    'parent_email_id'=> $resultp['email_id'],
                    'description'=> 'Contract Amount -'.date('M Y'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                $this->db->insert('wallet_transactions', $walletArray); 
                $wallet_transaction_id = $this->db->insert_id();
                $this->send_email_wt($walletArray, $resultp['parent_code'], $wallet_amount, $balance_credits, $resultp, $student_name);
                $this->invoice_model->send_email_invoice($wallet_transaction_id, "Contract");
                $this->db->where('id', $contract_id);
                $this->db->update('contract_details', array('active_contract'=>1, last_contract_amount_paid_month_year=>date('M Y')) );

                $this->db->where('id',$row['activity_selection_id']);
                $this->db->update('activity_selections', array('contract'=>'Yes') );
            }
        }

        return true;
    }

    public function send_email_wt($wallet_data_array, $parent_code, $wallet_amount, $balance_credits, $email_data_array, $student_name)
	{
		$login_url = base_url() .'login';
		//return true;
		//die;
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
		    $mail->addAddress($email_data_array['email_id']);
		}
		else
		{
		    $mail->addAddress(DEFAULT_MAIL);
		}
        
		
		
		
		
		$mail->isHTML(true);

		$mail->Subject = "Prime Star Sports Services - Contract Amount Debited";
		
		$body = '';
		$body .= "<!DOCTYPE>
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
        <p>We are pleased to inform you that your contract amount of ".date('M Y')." for your kid ".$student_name." is debited from your wallet.</p>
        
        <p>Your Wallet details as follows</p>
        <p style='text-align: right;'>Transaction ID :<b>".$wallet_data_array['wallet_transaction_id']."</b></p>
         <table>
            <tr>
                <th>Parent-Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Previous balance(AED)</th>
                <th>Detected amount(AED)</th>
                <th>Total balance(AED)</th>
            </tr>
            <tr>
                <td>".$parent_code."</td>
                <td>".$wallet_data_array['parent_name']."</td>
                <td>".$wallet_data_array['wallet_transaction_date']."</td>
                <td>".round(sprintf("%2f",$wallet_amount),2)."</td> 
                <td>".round(sprintf("%2f",$wallet_data_array['wallet_transaction_amount']),2)."</td>
                <td>".round(sprintf("%2f",$balance_credits),2)."</td>
            </tr>
        </table>
        <h4>Thanks & Regards</h4>
        <h4 style='color: grey'>PSSS Admin team</h4>
        <hr>
        <p>Click here to visit our website:<a href='http://sports.primestaruae.com/'>www.primestaruae.com</a></p>
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