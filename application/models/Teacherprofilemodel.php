<?php

Class Teacherprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  function getuser($user_id)
   {
         $query="SELECT * FROM edu_teachers WHERE teacher_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
   }
  
 
 
 
  function teacherprofileupdate($user_id,$teachername,$email,$sex,$dob,$age,$nationality,$religion,$mobile,$community_class,$community,$address,$userFileName)
    {
	 $query="UPDATE edu_teachers SET name='$teachername',email='$email',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',phone='$mobile',address='$address',profile_pic='$userFileName',update_at=NOW() WHERE teacher_id='$user_id'";
	
	  $query1="UPDATE edu_users SET name='$teachername',user_pic='$userFileName',updated_date=NOW() WHERE teacher_id='$user_id' ";
	  $res1=$this->db->query($query1);
	  
    	 $res=$this->db->query($query);
         if($res)
		 {
         $data= array("status" => "success");
         return $data;
        }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }
 }
 
}