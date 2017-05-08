<?php

Class Teachereventmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


      function get_teacher_event($user_id){
         $query="SELECT ev.event_id,ev.event_name,ev.event_date,evc.co_name_id FROM edu_events AS ev  LEFT JOIN edu_event_coordinator AS evc ON ev.event_id= evc.event_id
          WHERE ev.event_date >=NOW() AND evc.co_name_id='$user_id' AND ev.status='A' GROUP BY event_id ";
          $resultset=$this->db->query($query);
          if($resultset->num_rows()==0){
            $data= array("status" => "failure");
            return $data;
          }else{
            $res=$resultset->result();
            $data= array("status" => "success","event_li"=>$res);
            return $data;
          }
       }

       function get_teacher_allevent(){
          $query="SELECT ev.event_id,ev.event_name,ev.event_date,evc.co_name_id FROM edu_events AS ev  LEFT JOIN edu_event_coordinator AS evc ON ev.event_id= evc.event_id
           WHERE ev.event_date >=NOW() AND ev.status='A'  GROUP BY event_id ";
           $resultset=$this->db->query($query);
           if($resultset->num_rows()==0){
             $data= array("status" => "failure");
             return $data;
           }else{
             $res=$resultset->result();
             $data= array("status" => "success","event_li"=>$res);
             return $data;
           }
        }


        function get_teacher_in_event($event_id){
        $query="SELECT ec.event_id,es.event_name,eu.name,es.event_date,ec.sub_event_name FROM  edu_event_coordinator AS ec LEFT JOIN edu_events AS es ON es.event_id=ec.event_id
        INNER JOIN edu_users AS eu ON ec.co_name_id=eu.user_id WHERE ec.event_id='$event_id'";
        $resultset=$this->db->query($query);
        if($resultset->num_rows()==0){
          $data= array("status" => "failure");
          return $data;
        }else{
          $res=$resultset->result();
          $data= array("status" => "success","event_li"=>$res);
          return $data;
        }
        }


        function save_to_do_list($to_do_date,$to_do_list,$to_do_notes,$to_user){
          $query="INSERT INTO edu_reminder (to_do_user_id,to_do_date,to_do_list,to_do_notes,created_at,updated_at) VALUES ('$to_user','$to_do_date','$to_do_list','$to_do_notes',NOW(),NOW())";
          $resultset=$this->db->query($query);
          if($resultset){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failure");
            return $data;
          }
        }

        function view_all_reminder($user_id){
          $query="SELECT to_do_date AS start,to_do_list AS title,to_do_notes AS description FROM edu_reminder AS eh WHERE to_do_user_id='$user_id'";
          $result=$this->db->query($query);
          return $result->result();
        }













}
?>
