<?php  
 class Main_model extends CI_Model  
 {  
      function can_login($username, $password)  
      {  
           $this->db->where('email', $username);  
           $this->db->where('encrypted_password', $password);  
           $this->db->where('deleted !=', 1);  
           $this->db->where('status', 'Active');  
           $query = $this->db->get('users');  
           //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
           if($query->num_rows() > 0)  
           {  
               //  return true;  
               $row = $query->result();
               //return $row[0]->role;
               return $row;
           }  
           else  
           {  
                return false;       
           }  
      }  
 }  
