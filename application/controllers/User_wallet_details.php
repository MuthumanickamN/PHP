<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

  
class User_wallet_details extends CI_Controller {  
	
	public function __construct()
	{
	parent::__construct();
   
	
	}
	public function index()
	{
		 $this->load->view('user_wallet_details');
		}

		
public function edit($id)
{

   
	
	$query = $this->db->query("select pc.*,p.parent_code,p.parent_name,p.email_id,p.mobile_no from prepaid_credits pc left join parent p on p.parent_id=pc.parent_id where pc.id=$id");
	$data=$query->row_array();
    if($this->input->post('submit'))
	{
		$revise_amount=$this->input->post('revise_amount');
		$description=$this->input->post('description');
		
        
        $insert_array = array(
            'balance_credits' => sprintf("%2f",$revise_amount),
            'total_credits' => sprintf("%2f",$revise_amount),
            'description' => $description,
            );
		
		$this->db->where('id',$id);
		$this->db->update('prepaid_credits',$insert_array);
        redirect(base_url().'user_wallet_details');
	}

	$this->load->view('user_wallet_details_edit',$data);



}
  

}