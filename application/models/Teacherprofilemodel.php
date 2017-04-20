<?php

Class Teacherprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  function getuser($user_id){
         $query="SELECT * FROM edu_teachers WHERE teacher_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }
  
 }