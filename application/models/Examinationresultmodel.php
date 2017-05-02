<?php

Class Examinationresultmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  
  function get_teacher_id($user_id)
		 {
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $sql="SELECT * FROM edu_examination";
			 $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
         // print_r($sec_n);exit
        //print_r($data);exit;
       }
	   
	   
	   function getall_cls_sec($user_id)
	   {
		  
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $get_classes="SELECT class_name,class_teacher FROM edu_teachers WHERE teacher_id='$teacher_id'";
			 $resultset1=$this->db->query($get_classes);
			 $teacher_row=$resultset1->result();
			  foreach($teacher_row as $teacher_rows){}
			  $teach_id=$teacher_rows->class_name;
			  $cls_te=$teacher_rows->class_teacher;
			
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
			if(in_array($sPlatform_id, $arryPlatform ))
			   {
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

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"cls_id"=>$cls_te,"status"=>"Record Found");
        return $data;
      }
        //print_r($data);exit;


       }
	   
	   function getall_exam_details($exam_id)
	   {
		   $sql="SELECT * FROM edu_exam_details WHERE exam_id='$exam_id' ";
		   $resultset1=$this->db->query($sql);
		   $res=$resultset1->result();
           return $res;
	   }
	   
	   function getall_cls_sec_stu($user_id,$cls_masid,$exam_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			//echo $teacher_id;exit;
			$sql="SELECT t.*,su.*,en.* FROM edu_subject AS su,edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND t.subject=su.subject_id AND en.class_id='$cls_masid'";
			
			$res=$this->db->query($sql);
			$result=$res->result();
			return $result;

	   }
	  
	   public function getall_subname($user_id,$cls_masid,$exam_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;

			$query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$cls_masid'";
            $resultset=$this->db->query($query);
			$row=$resultset->result();
			 //print_r($row);exit;
			 if(empty($row))
			 {
				 $data= array("status" =>"Subject Not Found");
				 return $data;
			 }
			  foreach($row as $rows)
			  { }
				    $id=$rows->subject;
						//echo $id;
					   // $id=$rows->subject;
					$sQuery="SELECT * FROM edu_subject";
					$objRs=$this->db->query($sQuery);
					$rows=$objRs->result();
					 // echo'<pre>';  print_r($rows);exit;
					   foreach ($rows as $rows1) 
					   {
						   $s= $rows1->subject_id;
						   $sec=$rows1->subject_name;

						   $arryPlatform = explode(",",$id);
						   $sPlatform_id  = trim($s);
						   $sPlatform_name  = trim($sec);
						   
						   
						   if(in_array($sPlatform_id,$arryPlatform))
							   {
								  $sub_name[]=$sec;
								  $sub_id[]=$s;
							   }
						 //return $a;
	                   }
					$datas= array("status" =>"Success","subject_id"=>$sub_id,"subject_name"=>$sub_name);
					return $datas;

	   }
	   
	   public function getall_stuname($user_id,$cls_masid,$exam_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			//echo $teacher_id;exit;
		    //$sql="SELECT t.teacher_id,t.class_teacher,t.name,t.subject,en.enroll_id,en.name,en.admisn_no,en.class_id FROM edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND en.class_id='$cls_masid'";
			
		     $sql="SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.subject_id,m.classmaster_id,m.marks FROM edu_enrollment AS en,edu_exam_marks AS m WHERE en.class_id='$cls_masid' AND en.enroll_id=m.stu_id ";
			$res=$this->db->query($sql); 
			$rows=$res->result();
			return $rows;
	   }
	   

	   
	   function exam_marks_details($exam_id,$subid,$sutid,$clsmastid,$teaid,$marks)
	   {
		   
		   $count_name = count($marks);
		 // echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$sutid1=$sutid[$i];
			//print_r($enroll);
			$subid1=$subid;
			$clsmastid1=$clsmastid;
			$teaid1=$teaid;
			$examid1=$exam_id;
			$marks1=$marks[$i];

		  $query="INSERT INTO edu_exam_marks(exam_id,teacher_id,subject_id,stu_id,classmaster_id,marks,created_at)VALUES('$examid1','$teaid1','$subid1','$sutid1','$clsmastid1','$marks1',NOW())";
		  $resultset=$this->db->query($query);
		  }
		  $datas=array("status"=>"success");
		  return $datas;
		  
	 }
	 function getall_marks_details($user_id)
	 {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			
			$sql="SELECT em.*,t.name,t.teacher_id,t.subject,su.* FROM edu_exam_marks AS em,edu_teachers AS t,edu_subject AS su WHERE em.teacher_id='$teacher_id' AND t.teacher_id='$teacher_id' AND t.subject=su.subject_id  GROUP BY classmaster_id";
			$resultset=$this->db->query($sql);
			return $resultset->result();
	 }
	   function getall_marks_details1($user_id,$cls_masid)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			//$teacher_id=$rows->teacher_id;
            			
			//$sql="SELECT subject_id,classmaster_id,marks FROM edu_exam_marks WHERE classmaster_id='$cls_masid'  ";
			//$resultset=$this->db->query($sql);
			//$res=$resultset->result();
			//$datas=array("status"=>"success","marks"=>$res);
		    return $row;
	   }
	   
	   function edit_marks_details($user_id,$subid,$clsmasid)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			
			$sql="SELECT m.*,en.enroll_id,en.admit_year,en.name,en.class_id,en.admisn_no FROM edu_exam_marks AS m,edu_enrollment AS en WHERE m.subject_id='$subid' AND m.classmaster_id='$clsmasid' AND m.teacher_id='$teacher_id' AND en.class_id='$clsmasid' AND en.enroll_id=m.stu_id ";
			$resultset=$this->db->query($sql);
			$res=$resultset->result();
			return $res;

	   }
	   function update_marks_details($teaid,$clsmastid,$exam_id,$subid,$marks,$sutid)
	   {
		   $count_name = count($marks);
		  echo $count_name;
           for($i=0;$i<$count_name;$i++)
		   {
			$sutid1=$sutid[$i];
			//print_r($enroll);
			 $subid1=$subid;
			 $clsmastid1=$clsmastid;
			 $teaid1=$teaid;
			 $examid1=$exam_id;
			$marks1=$marks[$i];
			print_r($marks1);
		   $update="UPDATE edu_exam_marks SET marks='$marks1',updated_at=NOW() WHERE exam_id='$examid1' AND teacher_id='$teaid1' AND classmaster_id='$clsmastid1' AND subject_id='$subid1' AND stu_id='$sutid1'";
		   $resultset=$this->db->query($update);
		   
		  }
		    $datas=array("status"=>"success");
		    return $datas;
	   }
	   
} 