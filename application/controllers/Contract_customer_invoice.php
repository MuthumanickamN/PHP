<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contract_customer_invoice extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Default_Model', 'default');
        $this->load->model('School_profile_report_Model', 'schools');
        $this->load->model('Daily_Transaction_Model', 'transaction');
    }
    public function index(){
        $data['title'] ='Contract Customer Invoice';

        $query = $this->db->query("select c.id, a.psa_id,r.name as student_name,r.parent_name, a.activity_id,a.parent_mobile, c.contract_net_amount as amount,
                                p.balance_credits
                                from contract_details as c
                                LEFT JOIN activity_selections as a on a.id = c.activity_selection_id
                                left join registrations r on r.id = a.student_id
                                LEFT JOIN prepaid_credits as p on p.parent_id = a.user_id
                                order by `id` DESC");
        $arrayList = $query->result_array();
        foreach($arrayList as $key=>$array){
            $arrayList[$key]['activity_id']=$this->transaction->getActivityDetail($array['activity_id']);
        }
        $data['arrayList'] = $arrayList;
        $this->load->view('contract/index', $data);
    }

}