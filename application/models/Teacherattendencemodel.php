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







}
?>
