<?php

Class Teacherattendencemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


      function get_cur_year(){
        $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
        $get_year=$this->db->query($check_year);
        foreach($get_year->result() as $current_year){}
        //
        if($get_year->num_rows()==1){
          $acd_year= $current_year->year_id;
          $data= array("status" =>"success","cur_year"=>$acd_year);
          //print_r($data);exit;
           return $data;
        }else{
          $data= array("status" =>"noYearfound");
          return $data;
        }
      }


      function get_teacher_id($user_id){
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
        foreach ($row as $rows1) {
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


       function get_studentin_class($class_id){

         $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
         $get_year=$this->db->query($check_year);
         foreach($get_year->result() as $current_year){}
           $acd_year= $current_year->year_id;
         //return $resultset->result();

         $query="SELECT * FROM edu_enrollment WHERE class_id='$class_id' AND admit_year='$acd_year'";
         $resultset=$this->db->query($query);
         return $resultset->result();
         //print_r($res);exit;


       }


       function get_attendence_class($class_id,$student_id,$attendence_val,$a_taken,$student_count,$get_academic){

           $len=count($student_id);

           if(empty($attendence_val)){
             $at_val=0;
           }else{
               $at_val=count($attendence_val);
           }
          $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
          $cur_d=$dateTime->format("Y-m-d H:i:s");
          $a_pe=$dateTime->format("A");
          if($a_pe=="AM"){
            $a_period="0";
          }else{
            $a_period="1";
          }
            $total_present=$student_count-$at_val;
            //print_r($a_taken);
             $query="INSERT INTO edu_attendence (ac_year,class_id,class_total,no_of_present,no_of_absent,attendence_period,created_by,created_at,status) VALUES('$get_academic','$class_id','$student_count','$total_present','$at_val','$a_period','$a_taken','$cur_d','A')";
             $resultset=$this->db->query($query);
              $last_id=$this->db->insert_id();
              $myArray1 = implode(',', $attendence_val);
              $myArray = explode(',', $myArray1);
              $sp=array_chunk($myArray,3);
              $at_len=count($attendence_val);
              for ($i=0; $i <$at_len; $i++) {
                $a_status= $sp[$i][0];
                $stu_id= $sp[$i][1];
                $a_day= $sp[$i][2];
            //echo count($stu_id);
            $add_att="INSERT INTO edu_attendance_history(attend_id,class_id,student_id,abs_date,a_status,attend_period,a_val,a_taken_by,created_at,status) VALUES('$last_id','$class_id','$stu_id','$cur_d','$a_status','$a_period','0.5','$a_taken',NOW(),'A')";
            $resultset=$this->db->query($add_att);
         }
      if($resultset){
        $data= array("status" =>"success");
        return $data;
      }else{
        $data= array("status" =>"failure");
        return $data;
      }

       }

       function check_attendence($class_id){
         $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
         $cur_d=$dateTime->format("Y-m-d");
         $a_day=$dateTime->format("A");
         if($a_day=="AM"){
           $a_period="0";
         }else{
            $a_period="1";
         }

          $check_leave="SELECT * FROM edu_leaves WHERE leave_date='$cur_d'";
          $get_le=$this->db->query($check_leave);
          if($get_le->num_rows()==0){
            $check_reg_leave="SELECT * FROM edu_holidays_list_history WHERE leave_list_date='$cur_d'";
            $get_re=$this->db->query($check_reg_leave);
            if($get_re->num_rows()==0){
               $check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_d' AND attendence_period='$a_period'";
               $get_att=$this->db->query($check_attendence);
               if($get_att->num_rows()==0){
                 $data= array("status" =>"success");
                 return $data;

               }else{
                 $data= array("status" =>"taken");
                 return $data;

               }
               $data= array("status" =>"success");
              // print_r($data);exit;
              return $data;
            }
            else{
              $data= array("status" =>"regular");
              //print_r($data);exit;
              return $data;

            }
            $data= array("status" =>"success");
            return $data;
          }else{
            $data= array("status" =>"special");
            return $data;

          }

       }


       function get_atten_val($class_id){
         $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
         $cur_d=$dateTime->format("Y-m-d");
//         $get_atten="SELECT ee.name,ea.a_status,ea.a_day ,ea.abs_date FROM edu_enrollment AS ee LEFT JOIN edu_attendence AS ea ON ee.enroll_id=ea.student_id
// WHERE ee.class_id='$class_id'";

 $get_atten="SELECT * FROM (
SELECT ee.enroll_id, ee.name, ea.abs_date, ea.a_day, ea.a_status
FROM edu_enrollment AS ee
LEFT JOIN edu_attendence AS ea ON ee.enroll_id=ea.student_id AND ea.abs_date = '$cur_d'
WHERE ea.attend_id IS NULL AND ee.class_id ='$class_id'
UNION
SELECT ee.enroll_id, ee.name, ea.abs_date, ea.a_day, ea.a_status
FROM edu_enrollment AS ee
INNER JOIN edu_attendence AS ea ON ee.enroll_id=ea.student_id
WHERE ee.class_id='$class_id' AND ea.abs_date = '$cur_d') AS X
ORDER BY x.name";


         $get_year=$this->db->query($get_atten);
         return $get_year->result();
        //  echo "<pre>";
        //  print_r($get_year->result());
        //  exit;
       }








}
?>
