<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Role_delegation extends CI_Controller
{

    function __construct()
    {
      parent::__construct();
      $this->load->model("Roledelegation_model");
    }
    public function index()
    {
      $data['user_id'] = $_GET['id'];
     
      $data['main_menus']=$this->Roledelegation_model->get_main_menus();
      $data['title'] = 'Role Delegation';
      $this->load->view('role_delegation',$data);

    }

    public function assign(){
      $sub_module_id =  $this->input->post('sub_module_id');
      $user_id = $this->input->post('user_id');

      $sql="select * from role_permission where user_id='$user_id' and sub_module_id='$sub_module_id'";
      if($this->db->query($sql)->num_rows() > 0)
      {
        $update_data = array('permission' => 1);
        $this->db->where('user_id', $user_id);
        $this->db->where('sub_module_id', $sub_module_id);
        $this->db->update('role_permission', $update_data);
      }
      else{
        $insert_data = array(
          'user_id' => $user_id,
          'sub_module_id' => $sub_module_id,
          'permission' => 1);
        $this->db->insert('role_permission', $insert_data);
      }
      echo True;
    }

    public function remove(){
      $sub_module_id =  $this->input->post('sub_module_id');
      $user_id = $this->input->post('user_id');
      $sql="delete from role_permission where user_id='$user_id' and sub_module_id='$sub_module_id'";
      $this->db->query($sql);
      echo True;
    }
} 

?>