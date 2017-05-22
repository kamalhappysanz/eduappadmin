<?php

Class Studentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL
		function get_stu_homework_details($user_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			$student_id=$row[0]->student_id;
			//echo $student_id;exit;
			$query1="SELECT admission_id,admisn_no,name,parnt_guardn_id FROM edu_admission WHERE admission_id='$student_id' AND status='A'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->admission_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
			$parnt_guardn_id=$row2->parnt_guardn_id;}

			$query2="SELECT * FROM edu_enrollment WHERE admission_id='$admission_id' AND admisn_no='$admisn_no' AND name='$name' AND status='A'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}
			$query3="SELECT h.*,cm.class_sec_id,cm.class,cm.section,c.*,se.* FROM edu_homework AS h,edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE h.class_id='$class_id' AND h.status='A' AND h.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY h.hw_id DESC" ;
			$result2=$this->db->query($query3);
			$row4=$result2->result();
			return $row4;

		}

		function view_homework_marks($user_id,$hw_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;

			$query1="SELECT admission_id,admisn_no,name,parnt_guardn_id FROM edu_admission WHERE admission_id='$student_id' AND status='A'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->admission_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
			$parnt_guardn_id=$row2->parnt_guardn_id;}

			$query="SELECT * FROM edu_class_marks WHERE hw_mas_id='$hw_id' AND enroll_mas_id='$student_id'";
		    $result=$this->db->query($query);
            $marks=$result->result();
			return $marks;


		}

		/// Examination Result Models

		function get_all_exam($user_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			

			 $sql="SELECT m.*,ed.exam_id,ed.exam_year,ed.exam_name FROM edu_exam_marks_status AS m,edu_examination AS ed WHERE  m.status='A' AND m.exam_id=ed.exam_id";
			 $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
		}

		function exam_marks($user_id,$exam_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			//echo $student_id;
			
			$sql="SELECT * FROM edu_enrollment WHERE admission_id='$student_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			//echo $enr_id;exit;
			
			 $sql1="SELECT ms.*,em.* FROM edu_exam_marks AS em,edu_exam_marks_status AS ms WHERE ms.status='A' AND em.exam_id='$exam_id' AND ms.exam_id=em.exam_id  AND em.classmaster_id='$cls_id' AND em.classmaster_id=ms.classmaster_id AND em.stu_id='$enr_id'";
			 $resultset1=$this->db->query($sql1);
			 $res1=$resultset1->result();
             return $res1;
		}



	   function get_student_user($user_id){
       $get_enroll_id="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ee.enroll_id FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id
LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE ed.user_id=$user_id";
        $results=$this->db->query($get_enroll_id);
        foreach($results->result() as $rows){}  $enroll_id=$rows->enroll_id;
      $query="SELECT abs_date AS start FROM edu_attendance_history WHERE student_id='$enroll_id'";
       $resultset1=$this->db->query($query);
			 return $resultset1->result();
     }

     function get_class_id_user(){
        $user_id=$this->session->userdata('user_id');
        $get_enroll_id="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ee.enroll_id,ee.class_id FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id
       LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE ed.user_id='$user_id'";

        $results=$this->db->query($get_enroll_id);
        foreach($results->result() as $rows){}
        return  $class_id=$rows->class_id;
     }

     function get_timetable(){
       $class_id=$this->get_class_id_user();
       $query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_id' ORDER BY tt.table_id ASC";
      $result=$this->db->query($query);
      $time=$result->result();
     if($result->num_rows()==0){
       $data= array("st" => "no data Found");
       return $data;
     }else{
       $data= array("st" => "success","time"=>$time);
       return $data;
   // return $result->result();
     }

     }
	 
	 function get_circular($user_id,$cid){
		 $cid=$this->get_class_id_user();
        //echo $class_id;exit;	
		  $sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$cid',class_id) ORDER BY commu_id DESC ";
		  $res=$this->db->query($sql);
		  $row=$res->result();
		  return $row;
	 }



}
?>
