<?php

Class Usermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		 function get_parents()
		 {

       $query="SELECT * FROM edu_users WHERE user_type='4'";
       $result=$this->db->query($query);
       return $result->result();


		 }
     function get_staff()
     {

        $query="SELECT * FROM edu_users WHERE user_type='2'";
        $result=$this->db->query($query);
        return $result->result();


     }
     function get_student()
     {

        $query="SELECT * FROM edu_users WHERE user_type='3'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function get_userid($user_id_profile)
     {

         $query="SELECT * FROM edu_users WHERE user_id='$user_id_profile'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function save_profile_id($user_profile_id,$status){
        $query="UPDATE edu_users SET status='$status' WHERE user_id='$user_profile_id'";
       $result=$this->db->query($query);
       $data= array("status"=>"success");
       return $data;
     }


}
?>
