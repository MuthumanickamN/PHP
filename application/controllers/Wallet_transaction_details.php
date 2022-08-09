<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Wallet_transaction_details extends CI_Controller {  
	public function __construct(){
		parent::__construct();
		$this->load->model('School_profile_report_Model', 'schools');
		$this->load->model('Default_Model', 'default');
		$this->load->model('Daily_Transaction_Model', 'transaction');
	}
	
	public function index(){
	    $userrole = strtolower($this->session->userdata('role'));
	    $userid =  $this->session->userdata('userid');
	    
	    $query = $this->db->query("SELECT parent_id FROM `parent` p
        left join users u on u.code = p.parent_code
        where u.user_id=$userid");
        $parent_id = $query->row()->parent_id;
        
        
		$data['title'] = 'Wallet Transaction';
		$qry = "select wt.*, p.parent_code, r.sid from wallet_transactions wt
	    left join parent p on p.parent_id= wt.parent_id
	    left join registrations r on r.id= wt.student_id
	    where wt.parent_id= $parent_id order by wt.created_at asc";
		$data = $this->db->query($qry)->result_array();
	    $output = '';
	    
	    foreach($data as $key => $value)
	    {
		
	        $output .="<tr>";
	        $output .="<td>";
	        $output .=$value['wallet_transaction_id'];
	        $output .="</td>";
	        
	        $output .="<td><span style='display:none;'>";
	        //$output .= strtotime($value['created_at']);
	        $output .='</span>';
	        
	        $output .= date('d/m/Y H:i', strtotime($value['created_at']));
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['wallet_transaction_detail'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['parent_code'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['sid'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['gross_amount'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['discount_percentage'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['vat_percentage'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['vat_value'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['credit'];
	        $output .="</td>";
	        
	        $output .="<td>";
	        $output .=$value['debit'];
	        $output .="</td>";
	        
	        
	        $output .="</tr>";
	        
	    }
	    $data['output'] = $output;
		
		$this->load->view('wallet/wallet_transaction_parent',$data);
	}
	
}
?>