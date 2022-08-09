<?php  
if (!defined('BASEPATH'))
exit('No direct script access allowed');
 class TermsConditions_model extends CI_Model  
 {  
    function __construct()
	{
		parent::__construct();
	}
 
	public function upload_items($id)
	{
        $query = $this->db->query("select * from termsconditionsuploadedfiles where id='$id'");
        $row = $query->result_array();
        return $row;	
	}   
}
?>
 }  
 ?>