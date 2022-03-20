<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class School_profile_reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('School_profile_report_Model', 'schools');
    }
    public function index()
    {
        $data['page'] = 'schools-list';
        $data['title'] = 'School Registration/ profile report';
        $this->load->view('school_profile_reports/index', $data);
    }
    public function getListing()
    {
        $json = array();
        $list = $this->schools->getList();
        $data = array();
        foreach ($list as $element) {
            $row = array();
            $row[] = $element['id'];
            $row[] = $element['school_id'];
            $row[] = $element['school_name'];
            $row[] = $element['school_location'];
            $row[] = $element['contact'];
            $row[] = $element['contact_person'];
            $row[] = $element['trn_number'];
            $row[] = $element['school_email_id'];
            $row[] = ($element['status']==1)?'Active':'Inactive';
            
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
    public function save()
    {
        $json = array();
        $school_name = $this->input->post('school_name');
        $school_location = $this->input->post('school_location');
        $school_email_id = $this->input->post('school_email_id');
        $contact = $this->input->post('contact');
        $contact_person = $this->input->post('contact_person');
        $trn_number = $this->input->post('trn_number');
        $status = $this->input->post('status');
        $scl_id = $this->schools->getLastEntry('school_profile_reports');
        $school_id = 'SCL00'.$scl_id;


        if (empty(trim($school_name))) {
            $json['error']['school_name'] = 'Please enter School name';
        }
        if (empty(trim($school_location))) {
            $json['error']['school_location'] = 'Please enter school location';
        }

        if (empty(trim($school_email_id))) {
            $json['error']['school_email_id'] = 'Please enter school Email address';
        }
        if (empty(trim($trn_number))) {
            $json['error']['trn_number'] = 'Please enter trn_number';
        }

        if ($this->schools->validateEmail($school_email_id) == FALSE) {
            $json['error']['school_email_id'] = 'Please enter valid school Email address';
        }
        if (empty($contact)) {
            $json['error']['contact'] = 'Please enter contact';
        }
        if ($this->schools->validateMobile($contact) == FALSE) {
            $json['error']['contact'] = 'Please enter valid contact person no';
        }

        if ($status == '') {
            $json['error']['status'] = 'Please enter status';
        }

        if (empty($json['error'])) {
            $this->schools->setSchoolName($school_name);
            $this->schools->setSchool_location($school_location);
            $this->schools->setEmailId($school_email_id);
            $this->schools->setContact_person($contact_person);
            $this->schools->setStatus($status);
            $this->schools->setContact($contact);
            $this->schools->setTrn_number($trn_number);
            $this->schools->setSclId($school_id);
            
            try {
                $last_id = $this->schools->createSchool();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($last_id) && $last_id > 0) {
                $schoolID = $last_id;
                $this->schools->setSchoolID($schoolID);
                $schoolInfo = $this->schools->getSchool();
                $json['school_id'] = $schoolInfo['school_id'];
                $json['name'] = $schoolInfo['school_name'];
                $json['school_email_id'] = $schoolInfo['school_email_id'];
                $json['contact'] = $schoolInfo['contact'];
                $json['contact_person'] = $schoolInfo['contact_person'];
                $json['status'] = $schoolInfo['status'];
                $json['status'] = 'success';
            }
        }
        $this->session->set_flashdata('success_msg', 'School profile added successfully.');
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
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
            $json['error']['school_name'] = 'Please enter School name';
        }
        if (empty(trim($school_location))) {
            $json['error']['school_location'] = 'Please enter school location';
        }

        if (empty(trim($school_email_id))) {
            $json['error']['school_email_id'] = 'Please enter school Email address';
        }
        if (empty(trim($trn_number))) {
            $json['error']['trn_number'] = 'Please enter trn_number';
        }

        if ($this->schools->validateEmail($school_email_id) == FALSE) {
            $json['error']['school_email_id'] = 'Please enter valid school Email address';
        }
        if (empty($contact)) {
            $json['error']['contact'] = 'Please enter contact';
        }
        if ($this->schools->validateMobile($contact) == FALSE) {
            $json['error']['contact'] = 'Please enter valid contact person no';
        }

        if ($status == '') {
            $json['error']['status'] = 'Please enter status';
        }

        if (empty($json['error'])) {
            $this->schools->setSchoolID($school_id);
            $this->schools->setSchoolName($school_name);
            $this->schools->setSchool_location($school_location);
            $this->schools->setEmailId($school_email_id);
            $this->schools->setContact_person($contact_person);
            $this->schools->setStatus($status);
            $this->schools->setContact($contact);
            $this->schools->setTrn_number($trn_number);
            
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
                $json['status'] = $schoolInfo['status'];
                //$json['status'] = '1';
            }
        }
        $this->session->set_flashdata('success_msg', 'School profile updated successfully.');
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
}
