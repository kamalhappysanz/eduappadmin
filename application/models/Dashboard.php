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
         $query="SELECT * FROM edu_enrollment AS ee WHERE ee.name LIKE '$ser_txt%'";
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
      <td>'.$row->class_id.'</td>
      <td>'.$row->admit_date.'</td>
      <td>'.$row->status.'</td>
     </tr>
    ';
         }
         echo $output;

       }
       }else if($user_type=="parents"){
         echo "parents";
       }else if($user_type=="teachers"){
         echo "teachers";
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



}
?>
