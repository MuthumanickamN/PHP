<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_credits extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('School_profile_report_Model', 'schools');
        $this->load->model('School_credit_Model', 'credits');
        $this->load->model('Daily_Transaction_Model', 'transaction');
        $this->load->model('Default_Model', 'default');
    }
    public function add()
    {
        $data['page'] = 'schools-reports-add';
        $data['title'] = '';
        $this->load->view('school_credits/add');
    }
    public function index()
    {
        $data['page'] = 'School Credit Invoice';
        $data['title'] = 'School Credit Invoice';
        $data['account_code_data'] = $this->schools->getAccountCodeList();
        $data['schoolList']= $this->schools->getAllSchoolList();
        $data['activityList'] = $this->schools->getAllActivityList();
        $data['vatPercent'] = $this->schools->getVatDetails();
        $this->load->view('school_credits/index', $data);
    }
    public function report(){
        $data['page'] = 'Schools Invoice report';
        $data['title'] = 'Schools Invoice report';
        $data['credit'] = $this->credits->getCreditInvoiceList();
        foreach ($data['credit'] as $key => $value) {
            $data['credit'][$key]['activity_id'] = $this->transaction->getActivityDetail($value['activity_id']);
        }

        $this->load->view('school_credits/report', $data);
    }
    public function getListing()
    {
        $json = array();
        $list = $this->schools->getList();
        $data = array();
        foreach ($list as $element) {
            $row = array();
            $row[] = $element['school_id'];
            $row[] = '-'; //$element['school_id'];
            $row[] = $element['school_name'];
            $row[] = $element['school_location'];
            $row[] = $element['contact'];
            $row[] = $element['contact_person'];
            $row[] = $element['trn_number'];
            $row[] = $element['school_email_id'];
            $row[] = $element['status'];
            //$row[] = $element['last_sign_in_at'];
            $data[] = $row;
        }
        $json['data'] = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->schools->countAll(),
            "recordsFiltered" => $this->schools->countFiltered(),
            "data" => $data,
        );
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json['data']);
    }
    public function save(){
        $json = array();
        $transact_date = $this->input->post('transaction_date');
        $transaction_date = date("Y-m-d",strtotime($this->input->post('transaction_date')));
        $transaction_type = $this->input->post('transaction_type');
        $school_name = $this->input->post('school_name');
        $school_id = $this->input->post('school_id');
        $activity_id = $this->input->post('activity_id');
        $location_id = $this->input->post('location_id');
        $contact = $this->input->post('contact');
        $contact_person = $this->input->post('contact_person');
        $trn_number = $this->input->post('trn_number');
        $email_id = $this->input->post('email_id');
        $gross_amount = $this->input->post('gross_amount');
        $vat_percentage = $this->input->post('vat_percentage');
        $vat_value = $this->input->post('vat_value');
        $net_amount = $this->input->post('net_amount');
        $account_code = $this->input->post('account_code');
        $transaction_amount = $this->input->post('transaction_amount');
        $description = $this->input->post('description');
        

        if (empty($transact_date)) {
            $json['error']['transaction_date'] = 'Please enter transaction date';
        }
        if (empty($transaction_amount)) {
            $json['error']['transaction_amount'] = 'Please enter transaction amount';
        }
        if (empty($transaction_type)) {
            $json['error']['transaction_type'] = 'Please select transaction type';
        }
        if ($activity_id == '') {
            $json['error']['activity_id'] = 'Please select activity';
        }
        if (empty($location_id)) {
            $json['error']['location_id'] = 'Please enter location';
        }
        if (empty($gross_amount)) {
            $json['error']['gross_amount'] = 'Please enter gross amount';
        }
        if (empty($vat_percentage)) {
            $json['error']['vat_percentage'] = 'Please enter vat percentage';
        }
        if (empty($vat_value)) {
            $json['error']['vat_value'] = 'Please enter vat value';
        }
        if (empty($net_amount)) {
            $json['error']['net_amount'] = 'Please enter Net amount';
        }
        if (empty($account_code)) {
            $json['error']['account_code'] = 'Please select account code';
        }
        if (empty(trim($school_name))) {
            $json['error']['school_name'] = 'Please enter school name';
        }

        if (empty(trim($email_id))) {
            $json['error']['email_id'] = 'Please enter email address';
        }

        if ($this->schools->validateEmail($email_id) == FALSE) {
            $json['error']['email_id'] = 'Please enter valid email address';
        }
        if (empty($contact)) {
            $json['error']['contact'] = 'Please enter contact';
        }
        if ($this->schools->validateMobile($contact) == FALSE) {
            $json['error']['contact'] = 'Please enter valid contact no';
        }

        if (empty(trim($trn_number))) {
            $json['error']['trn_number'] = 'Please enter TRN number';
        }
        if (empty(trim($contact_person))) {
            $json['error']['contact_person'] = 'Please enter contact person';
        }
        if (empty(trim($description))) {
            $json['error']['description'] = 'Please enter description';
        }
        if ($school_id == '') {
            $json['error']['school_id'] = 'Please select school';
        }

        if (empty($json['error'])) {
            $this->credits->setTransaction_date($transaction_date);
            $this->credits->setTransaction_type($transaction_type);
            $this->credits->setSchool_name($school_name);
            $this->credits->setSchool_id($school_id);
            $this->credits->setActivity_id($activity_id);
            $this->credits->setLocation_id($location_id);
            $this->credits->setContact($contact);
            $this->credits->setContact_person($contact_person);
            $this->credits->setTrn_number($trn_number);
            $this->credits->setEmail_id($email_id);
            $this->credits->setGross_amount($gross_amount);
            $this->credits->setVat_percentage($vat_percentage);
            $this->credits->setVat_value($vat_value);
            $this->credits->setNet_amount($net_amount);
            $this->credits->setAccount_code($account_code);
            $this->credits->setTransaction_amount($transaction_amount);
            $this->credits->setDescription($description);
            $this->credits->setSchool_id($school_id);
            /*$wtx_idval = $this->getLastEntry();
            $wtx_id = 'WTXNO-'.$wtx_idval;*/
            $txn_id = $this->schools->getLastEntry('wallet_transactions');
            $wallet_transaction_id = 'WTXNO-'.$txn_id;
            $this->credits->setWtx_id($wallet_transaction_id);
            $user_id = $this->session->userid;
            $schoolCode = $this->default->getAllSchoolDetails($school_id);
            
            $inv_id = $this->default->getInvoiceId('wallet_transactions');
            $invoice_id = 'PS'.date('Y').'-'.$inv_id;
            
            $last_id = $this->credits->createCredit();
            //wallet transaction
            
            $account_code_name = $this->transaction->getAccountCodeDetail($account_code);
            $walletArray = array(
                'wallet_transaction_id' =>$wallet_transaction_id,
                'account_code' => $account_code,
                'ac_code' => $account_code_name,
                'wallet_transaction_date' =>$transaction_date,
                'wallet_transaction_type' =>ucfirst($transaction_type),
                'wallet_transaction_detail' => 'School Invoice',
                'updated_admin_id' => $user_id,
                'reg_id' => $schoolCode['school_id'],
                'wallet_transaction_amount' => $gross_amount,
                'gross_amount' => $gross_amount,
                'vat_percentage' => $vat_percentage,
                'vat_value' => $vat_value,
                'net_amount' => $net_amount,
                'debit' => $net_amount,
                'school_invoice_id'=>$last_id,
                //'invoice' => 'yes',
                //'invoice_id' =>$invoice_id,
                'parent_name'=> $school_name,
                'parent_mobile'=> $contact,
                'parent_email_id'=> $email_id,
                'description'=> $description,
            );
            $this->db->insert('wallet_transactions', $walletArray); 
            $json['status'] = "success";
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
            $this->session->set_flashdata('success_msg', 'School credit invoice added successfully. ');    
        }
        
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function getLastEntry(){
        $lastentry = $this->db->query('select * from school_credits order by `id` DESC');
        $lastentryId = $lastentry->row_array();
        if(isset($lastentryId)){
            $trans_id = $lastentryId['id']+1;
        }else{
            $trans_id = 1;
        }
        return $trans_id;
    }
    public function edit()
    {
        $json = array();
        $schoolID = $this->input->post('school_id');
        $this->schools->setSchoolID($schoolID);
        $json['schoolInfo'] = $this->schools->getSchool();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('school_profile_reports/popup/renderEdit', $json);
    }
    public function update()
    {
        $json = array();
        $school_id = $this->input->post('school_id');
        $school_name = $this->input->post('school_name');
        $school_location = $this->input->post('school_location');
        $contact = $this->input->post('contact');
        $contact_person = $this->input->post('contact_person');
        $trn_number = $this->input->post('trn_number');
        $school_email_id = $this->input->post('school_email_id');
        $status = $this->input->post('status');

        if (empty(trim($school_name))) {
            $json['error']['name'] = 'Please enter name';
        }

        if (empty(trim($school_email_id))) {
            $json['error']['school_email_id'] = 'Please enter Email address';
        }

        if ($this->schools->validateEmail($school_email_id) == FALSE) {
            $json['error']['school_email_id'] = 'Please enter valid Email address';
        }
        if (empty($contact)) {
            $json['error']['contact'] = 'Please enter contact';
        }
        if ($this->schools->validateMobile($contact) == FALSE) {
            $json['error']['contact'] = 'Please enter valid contact no';
        }

        if (empty($status)) {
            $json['error']['status'] = 'Please enter status';
        }

        if (empty($json['error'])) {
            $this->schools->setSchoolID($school_id);
            $this->schools->setName($school_name);
            $this->schools->setSchool_location($school_location);
            $this->schools->setContact($contact);
            $this->schools->setContact_person($contact_person);
            $this->schools->setTrn_number($trn_number);
            $this->schools->setEmail($school_email_id);
            $this->schools->setStatus($status);
            try {
                $last_id = $this->schools->updateSchool();;
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($school_id) && $school_id > 0) {
                $this->schools->setSchoolID($school_id);
                $schoolInfo = $this->schools->getSchool();
                $json['school_id'] = $schoolInfo['school_id'];
                $json['name'] = $schoolInfo['school_name'];
                $json['school_email_id'] = $schoolInfo['school_email_id'];
                $json['contact'] = $schoolInfo['contact'];
                $json['contact_person'] = $schoolInfo['contact_person'];
                $json['ustatus'] = $schoolInfo['status'];
                $json['status'] = 'success';
            }
        }
        $this->session->set_flashdata('success_msg', 'School credit invoice updated successfully. ');
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function display()
    {
        $json = array();
        $schoolID = $this->input->post('school_id');
        $this->schools->setSchoolID($schoolID);
        $json['schoolInfo'] = $this->schools->getSchool();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('school_profile_reports/popup/renderDisplay', $json);
    }
    public function delete()
    {
        $json = array();
        $schoolID = $this->input->post('school_id');
        $this->schools->setSchoolID($schoolID);
        $this->schools->deleteSchool();
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    /* added on 28.4.21 */
    public function getSchoolDetails(){
		$json = array();
        $schoolID = $this->input->post('school_id');
        $this->schools->setSchoolID($schoolID);
        $json['schoolInfo'] = $this->schools->getSchool();
        echo json_encode($json);

	}
    public function updatestatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        if ($status == '') {
            $json['error']['status'] = 'Please select status';
        }
        if (empty($json['error'])) {
            $data = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('school_credits', $data); 
            $json['status'] = "success";
             $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
            $this->session->set_flashdata('success_msg', 'School invoice status updated successfully. ');
        }else{
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
        } 
    }
    public function send_mail($id) { 
         $from_email = "rrameshkannan8gmail.com"; 
         //$to_email = $this->input->post('email'); 
         //Load email library 
         $this->load->config('email'); 
   
        $data = $this->credits->getInvoiceDetail($id);
        $data['activity_id'] = $this->transaction->getActivityDetail($data['activity_id']);
        $data['account_code'] = $this->transaction->getAccountCodeDetail($data['account_code']);
        $message = $this->load->view('school_credits/popup/email_invoice', $data,  TRUE);
        $subject ="School Invoice Report";
        $name = "Prime Star Academy";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: '.$from_email."\r\n".
            'Reply-To: '.$from_email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         if(mail($data['email_id'], $subject, $message, $headers)){
            $json['status'] ='success';
        }else{
            $json['status'] ='failure';
         }
        $this->session->set_flashdata('success_msg', 'Invoice sent successfully.');
         $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
        
        
    }
}
