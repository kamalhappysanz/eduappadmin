<?php

Class Studentprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION
       function getuser($user_id)
	   {
		    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$student_id=$rows->student_id;
			//echo $parent_id;exit;
			 $query="SELECT * FROM edu_admission WHERE admission_id='$student_id'";
			 $resultset=$this->db->query($query);
			 return $resultset->result();
	   }
      

       function update_details($admission_year,$admission_no,$admission_date,$name,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$mobile,$email,$userFileName,$admission_id)
	   {
		   $query="UPDATE edu_admission SET admisn_year='$admission_year',admisn_no='$admission_no',admisn_date='$admission_date',name='$name',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',mother_tongue='$mother_tongue',mobile='$mobile',email='$email',student_pic='$userFileName' WHERE admission_id='$admission_id'";
		   $res=$this->db->query($query);
			  
				$query6="UPDATE edu_users SET name='$name',user_pic='$userFileName',updated_date=NOW() WHERE student_id='$admission_id' ";
				$res=$this->db->query($query6);
				
				$query7="UPDATE edu_enrollment SET name='$name' WHERE admisn_no='$admission_no' ";
				$res=$this->db->query($query7);

			 if($res){
			 $data= array("status" => "success");
			 return $data;
		   }else{
			 $data= array("status" => "Failed to Update");
			 return $data;
		   }

       }

	    function change_pwd($user_id)
         {
			 $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
			 $resultset=$this->db->query($query);
			 return $resultset->result();
        }
		function updatepwd($user_id,$oldpassword,$newpassword)
		{
			 $checkpassword="SELECT user_id FROM edu_users WHERE user_password='$oldpassword' AND user_id='$user_id'";
			 $res=$this->db->query($checkpassword);
			 if($res->num_rows()==1)
			 {
			   $query="UPDATE edu_users SET user_password='$newpassword',updated_date=NOW() WHERE user_id='$user_id'";
			   $ex=$this->db->query($query);
				$data= array("status" => "success");
			   return $data;
			 }else{
			   $data= array("status" => "failure");
			  return $data;
			 }
		}

}
?>
