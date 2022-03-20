<?php
	class Roledelegation_model extends CI_model
	{
      public function get_main_menus()
      {
         $sql="SELECT * from main_menu_modules  order by position";             
         $query = $this->db->query($sql);
         return $query->result();
         
      }
		
	}
?>