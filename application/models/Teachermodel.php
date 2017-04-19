<?php

Class Teachermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION


        function teacher_create($name,$email,$sec_email,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mobile,$sec_phone,$address,$class_teacher,$class_name,$subject,$userFileName)

		{
          $check_email="SELECT * FROM edu_teachers WHERE email='$email'";
          $result=$this->db->query($check_email);
          if($result->num_rows()==0){

          $query="INSERT INTO edu_teachers (name,email,sec_email,sex,dob,age,nationality,religion,community_class,community,phone,sec_phone,address,class_teacher,class_name,subject,profile_pic,created_at,update_at,status) VALUES ('$name','$email','$sec_email','$sex','$dob','$age','$nationality','$religion','$community_class','$community','$mobile','$sec_phone','$address','$class_teacher','$class_name','$subject','$userFileName',NOW(),NOW(),'A')";

           $resultset=$this->db->query($query);
           $insert_id = $this->db->insert_id();

		   $sql="SELECT count(*) AS teacher FROM edu_teachers" ;
			 // $resultsql=$this->db->query($sql);
			   $resultsql=$this->db->query($sql);
               $result1= $resultsql->result();
               $cont=$result1[0]->teacher;
			   $user_id=$cont+800000;


            $query="INSERT INTO edu_users (name,user_name,user_password,user_pic,user_type,teacher_id,created_date,updated_date,status) VALUES ('$name','$user_id',md5(123),'$userFileName','2','$insert_id',NOW(),NOW(),'A')";
          $resultset=$this->db->query($query);
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "Email Already Exist");
            return $data;
          }

       }


       //GET ALL Admission Form

       function get_all_teacher(){
         $query="SELECT *,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_name FROM edu_teachers AS tt  INNER JOIN edu_classmaster AS cm ON tt.class_teacher=cm.class_sec_id
         INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id ORDER BY teacher_id DESC";
         $res=$this->db->query($query);
         return $res->result();
       }

       function get_teacher_id($teacher_id){
         $query="SELECT * FROM edu_teachers WHERE teacher_id='$teacher_id'";
         $res=$this->db->query($query);
         return $res->result();
       }
       function check_email($email){
         echo $query="SELECT * FROM edu_admission WHERE email='$email'";
         $res=$this->db->query($query);
         if($res->num->rows()!=0){
           $data="Email Already Exist";
           return $data;
         }
       }

       function save_teacher($name,$email,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mobile,$address,$userFileName,$class_teacher,$class_name,$subject,$status,$teacher_id){
            $query="UPDATE edu_teachers SET name='$name',email='$email',sex='$sex',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',phone='$mobile',address='$address',profile_pic='$userFileName',class_teacher='$class_teacher',class_name='$class_name',subject='$subject',status='$status',update_at=NOW() WHERE teacher_id='$teacher_id'";

       $res=$this->db->query($query);
         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }
                 function getemail($email)
		   {
					$query = "SELECT * FROM edu_teachers WHERE email='".$email."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());

           }
		   function get_all_teacher1()
		   {
			      $query = "SELECT * FROM edu_teachers ";
				  $resultset = $this->db->query($query);
				  return $resultset->result();
		   }

}
?>
