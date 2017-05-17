<?php

Class Dashboard extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }


    function get_user_count_student(){
        $query="SELECT COUNT(enroll_id) AS user_count FROM  edu_enrollment WHERE admit_year=1";
        $result=$this->db->query($query);
        return  $result->result();

    }

    function get_user_count_parents(){
        $query="SELECT COUNT(parent_id) AS user_count FROM  edu_parents WHERE STATUS='A'";
        $result=$this->db->query($query);
        return  $result->result();

    }


    function dash_events(){
      $query="SELECT * FROM edu_events WHERE STATUS='A' AND  event_date>=NOW() ORDER BY event_id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();

    }


    function dash_users(){
      $query="SELECT * FROM edu_users WHERE STATUS='A' ORDER BY user_id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();
    }

    function dash_stud_users(){
      $query="SELECT COUNT(enroll_id) AS user_count FROM  edu_enrollment WHERE STATUS='A'";
      $result=$this->db->query($query);
      return  $result->result();
    }


    function dash_comm(){
      $query="SELECT * FROM edu_communication WHERE STATUS='A' ORDER BY commu_id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();
    }

     function save_profile_id($user_profile_id,$status){
        $query="UPDATE edu_users SET status='$status' WHERE user_id='$user_profile_id'";
       $result=$this->db->query($query);
       $data= array("status"=>"success");
       return $data;
     }


      // Search function in Admin Panel

     function search_data($ser_txt,$user_type){
       if($user_type=="students"){
        //  $query="SELECT * FROM edu_enrollment AS ee WHERE ee.name LIKE '$ser_txt%'";
        $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c WHERE e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id  and e.name LIKE '$ser_txt%'";
         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Students</th>
     <th>Adission No</th>
     <th>Class</th>
     <th>Admission Date</th>
     <th>Status</th>
    </tr>
  ';
     foreach($result->result() as $row){
    $output .= '
     <tr>
      <td>'.$row->name.'</td>
      <td>'.$row->admisn_no.'</td>
      <td>'.$row->class_name.'-'.$row->sec_name.'</td>
      <td>'.$row->admit_date.'</td>
      <td>'.$row->status.'</td>
     </tr>
    ';
         }
         echo $output;

       }
       }else if($user_type=="parents"){
        $query="SELECT et.name,et.phone,et.email,c.class_name,s.sec_name,et.status FROM edu_teachers AS et JOIN edu_classmaster AS cm, edu_sections AS s,edu_class AS c WHERE et.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND et.name LIKE '$ser_txt%'";

       }else if($user_type=="teachers"){
         $query="SELECT et.name,et.phone,et.email,c.class_name,s.sec_name,et.status FROM edu_teachers AS et JOIN edu_classmaster AS cm, edu_sections AS s,edu_class AS c WHERE et.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND et.name LIKE '$ser_txt%'";
         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Name </th>
     <th>phone No</th>
     <th>Class Teacher</th>
     <th>Email </th>
     <th>Status</th>
    </tr>
  ';
     foreach($result->result() as $row){
    $output .= '
     <tr>
      <td>'.$row->name.'</td>
      <td>'.$row->phone.'</td>
      <td>'.$row->class_name.'-'.$row->sec_name.'</td>
      <td>'.$row->email.'</td>
      <td>'.$row->status.'</td>
     </tr>
    ';
         }
         echo $output;

       }
     }else{
          echo "No Data Found";
       }

   }

//Admin  Teacher

    function dash_teacher($user_id){
      $get_user_id="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
      $result=$this->db->query($get_user_id);
      foreach ($result->result() as $row) { }
      $teacher_id=$row->teacher_id;
      $query="SELECT  et.*,c.class_name,s.sec_name,esu.subject_name FROM edu_teachers  AS et INNER JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id
INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id INNER JOIN edu_subject AS esu ON et.subject=esu.subject_id
WHERE teacher_id='$teacher_id'";
      $result12=$this->db->query($query);
      return  $result12->result();

    }



    // Admin students

    function dash_students($user_id){
$query="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ea.admission_id,ee.name,ee.class_id,ea.sex,ea.age,ea.dob,ea.mother_tongue,ea.mobile,ea.email,ea.student_pic,c.class_name,s.sec_name FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE ed.user_id='$user_id'";
$result12=$this->db->query($query);
return  $result12->result();
    }



    function get_special(){
      $query="SELECT c.leave_date AS START,c.leaves_name AS title FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday'";
      $res=$this->db->query($query);
      return $res->result();
    }



// Admin Parents


  function dash_parents($user_id){
    $query="SELECT eu.user_id,eu.parent_id,ep.father_name,ep.* FROM edu_users AS eu LEFT JOIN edu_parents AS ep ON eu.parent_id=ep.parent_id WHERE eu.user_id='$user_id'";
    $res=$this->db->query($query);
    return $res->result();
  }
  function get_students($user_id){
    $query="SELECT eu.user_id,eu.parent_id,ep.father_name,ep.admission_id FROM edu_users AS eu LEFT JOIN edu_parents AS ep ON eu.parent_id=ep.parent_id WHERE eu.user_id='$user_id'";
    $res=$this->db->query($query);
    foreach($res->result() as $rows){ }
    $sPlatform= $rows->admission_id;
    $sQuery = "SELECT * FROM edu_enrollment";
    $objRs=$this->db->query($sQuery);
     //print_r($objRs);
    $row=$objRs->result();
    foreach ($row as $rows1) {
    $s= $rows1->enroll_id;
     $sec=$rows1->name;
     $arryPlatform = explode(",", $sPlatform);

    $sPlatform_id  = trim($s);
    $sPlatform_name  = trim($sec);

    if(in_array($sPlatform_id, $arryPlatform )) {
      $e_id[]=$s;
      $name[]=$sec;
        print_r($name);
    //  $sec_n[]=$sec_name;
    }
      }
      if(empty($e_id)){
        $data= array("status" =>"No Record Found");
        print_r( $data);
        exit;
      }else{

        $data= array("subject_id" => $sub_id,"subject_name"=>$sub_name,"status"=>"success");
        print_r( $data);
        exit;
      }




  }

  function stud_details(){

  }
}
?>
