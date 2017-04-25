<?php

Class Teacherattendencemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


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


       function get_attendence_class($class_id,$student_id,$attendence_val,$a_taken){
         $myArray1 = implode(',', $attendence_val);
         $myArray = explode(',', $myArray1);
         $sp=array_chunk($myArray,3);
          $len=count($sp);
          $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
          $cur_d=$dateTime->format("y-m-d H:i:s");
         for ($i=0; $i <$len ; $i++) {

            $a_status= $sp[$i][0];
            $stu_id= $sp[$i][1];
            $a_day= $sp[$i][2];
            echo  $query="INSERT INTO edu_attendance (class_id,student_id,a_status,a_day,a_val,abs_date,a_taken_by,created_at) VALUES('$class_id[$i]','$stu_id','$a_status','$a_day','1','$cur_d','$a_taken[$i]',NOW())";echo "<br>";

        $resultset=$this->db->query($query);

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
         $check_attendence="SELECT * FROM edu_attendance WHERE class_id='$class_id' AND DATE_FORMAT(abs_date, '%Y-%m-%d')='$cur_d' AND a_day='$a_day'";
          $get_att=$this->db->query($check_attendence);
          if($get_att->num_rows()==0){
            $data= array("status" =>"success");
            return $data;

          }else{
            $data= array("status" =>"failure");
            return $data;

          }
       }







}
?>
