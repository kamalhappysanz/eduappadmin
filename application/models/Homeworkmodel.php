<?php

Class Homeworkmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

      /*  function get_teacher_id($user_id)
	   {
             $query="SELECT teacher_id from edu_users WHERE user_id='$user_id'";
             $resultset=$this->db->query($query);
             $results = $resultset->result();
             return $results[0]->teacher_id;
       }
       
        function get_class_name($teacher_id)
        {
            $query="SELECT class_name from edu_teachers WHERE teacher_id='$teacher_id'";
            $resultset1=$this->db->query($query);
            $result1= $resultset1->result();
            return $result1[0]->class_name;
        }
        
        function get_class_section($class_name)
        {
            $query="SELECT * from edu_classmaster WHERE class_sec_id IN ($class_name)";
            $resultset2=$this->db->query($query);
            $result2= $resultset2->result();
            return $result2;
            //return $result2[0]->class_name;  
        }
        function convert_id_name($class_section)
        {
			    //print_r($class_section);
				//exit;
            foreach($class_section as $id )
            {
				
                $query="select c.class_name,s.sec_name FROM edu_class AS c,edu_sections AS s WHERE c.class_id ='".$id->class."' AND s.sec_id='".$id->section."'";
                $resultset2=$this->db->query($query);
                $result2[]= $resultset2->result();
                
            }
            return $result2;
        } */

		
		 function get_teacher_id($user_id)
		 {
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $get_classes="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
			 $resultset1=$this->db->query($get_classes);
			 $teacher_row=$resultset1->result();
			  foreach($teacher_row as $teacher_rows){}
			$teach_id=$teacher_rows->class_name;
			
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
			$row=$objRs->result();
			foreach ($row as $rows1)
			{
			$s= $rows1->class_sec_id;
			$sec=$rows1->class;
			$clas=$rows1->class_name;
			$sec_name=$rows1->sec_name;
			$arryPlatform = explode(",", $teach_id);
		   $sPlatform_id  = trim($s);
		   $sPlatform_name  = trim($sec);
				 if(in_array($sPlatform_id, $arryPlatform )) {
					 $class_id[]=$s;
			 $class_name[]=$clas;
			 $sec_n[]=$sec_name;
 			 }
 			 }
      // print_r($sec_n);exit
      if(empty($class_id)){
        $data= array("status" =>"No Record Found");
        return $data;
      }else{

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"Record Found");
        return $data;
      }
        //print_r($data);exit;


       }
	   
	   function create($class_id,$user_id,$test_type,$title,$subject_name,$formatted_date,$details)
	   {
		      $check_test_date="SELECT * FROM edu_homework WHERE test_date='$tet_date' AND subject_id='$subject_name'";
			  $result=$this->db->query($check_test_date);
			  if($result->num_rows()==0)
			  {
			  $query="INSERT INTO edu_homework(class_id,teacher_id,hw_type,subject_id,title,test_date,hw_details,created_at)VALUES('$class_id','$user_id','$test_type','$subject_name','$title','$formatted_date','$details',NOW())";
			  $resultset=$this->db->query($query);
			  $data= array("status"=>"success");
			  return $data;
			  }else{
					$data= array("status"=>"Test Date Already Exist");
					return $data;
				  }
				   
	   }
	   
	   function getall_details()
	   {
		  $query="SELECT eh.*,cm.*,c.*,s.*,su.* FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s WHERE eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id";
          $result=$this->db->query($query);
          return $result->result();
	   }
	  function get_stu_details($hw_id)
	  {
		  $query="SELECT eh.*,cm.*,c.*,s.*,su.*,ed.* FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s,edu_enrollment AS ed WHERE ed.class_id=eh.class_id AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id And eh.hw_id='$hw_id'";
		  $result=$this->db->query($query);
          return $result->result();
	  }
	  
	  function enter_marks($enroll,$hwid,$marks,$remarks)
	  {
		   $count_name = count($marks);
				//echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$enroll=$enroll;
			$hwid=$hwid;
			$marks=$marks[$i];
			$remarks=$remarks[$i];
			
			
		  $query="INSERT INTO edu_class_marks(enroll_mas_id,hw_mas_id,marks,remarks,status,created_at) VALUES ('$enroll','$hwid','$marks','$remarks','A',NOW())";
		  $result=$this->db->query($query);
          //return $result->result();
		  $data= array("status"=>"success");
		  }
		   return $data;
	  }
	   


}
?>
