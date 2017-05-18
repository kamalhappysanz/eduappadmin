<?php

Class Adminparentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		 function get_stude_attendance($enroll_id)
		 {

       $query="SELECT abs_date AS start FROM edu_attendance_history WHERE student_id='$enroll_id'";
        $resultset1=$this->db->query($query);
        return $resultset1->result();
		 }


     function get_event_all(){
       $query="SELECT * FROM edu_events ORDER BY event_date DESC";
       $resultset1=$this->db->query($query);
       return $resultset1->result();
     }

     function get_event_list_all($event_id){
       $query="SELECT ec.sub_event_name,ec.co_name_id,eu.name,ev.* FROM edu_events AS ev LEFT JOIN edu_event_coordinator AS ec ON ev.event_id=ec.event_id LEFT JOIN edu_users AS eu ON ec.co_name_id=eu.user_id WHERE ev.event_id='$event_id'";
       $resultset1=$this->db->query($query);
       return $resultset1->result();
     }

}
?>
