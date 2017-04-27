<?php

Class Timetablemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

       //GET ALL TERMS

              function create_timetable($year_id,$term_id,$class_id,$subject_id,$teacher_id,$day_id,$period_id){
                    $check="SELECT * FROM edu_timetable WHERE class_id='$class_id' AND year_id='$year_id'";

                 $result1=$this->db->query($check);
                 if($result1->num_rows()>=1){
                   $data= array("status" => "Already");
                   return $data;
                 }
                //  exit;

                $count_name = count($teacher_id);
                for($i=0;$i<$count_name ;$i++){
                    $day  = $day_id[$i];
                    $period  =$period_id[$i];
                    $classid=$class_id;
                    $termid=$term_id;
                    $yearid=$year_id;
                    $subjectid=$subject_id[$i];
                    $teacherid=$teacher_id[$i];
                    $query = "INSERT INTO edu_timetable (year_id,term_id,class_id,subject_id,teacher_id,day,period,status,created_at,updated_at) VALUES ('$yearid','$termid','$classid','$subjectid','$teacherid','$day','$period','A',NOW(),NOW())";
                    $resultset=$this->db->query($query);

                  }
                  if($resultset){
                  $data= array("status" => "success");
                  return $data;}
                  else{
                    $data= array("status" => "failure");
                    return $data;
                  }
                }

                //GET ALL Class assisgned for time table

                function view_class_timetable(){
                  $get_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
                  $result1=$this->db->query($get_year);
                  foreach($result1->result() as $res){}
                  $year_id=  $res->year_id;

                  $query="SELECT tt.class_id AS timid,cm.class_sec_id,cm.class,cm.section,c.class_id,tt.year_id,a.from_month,a.to_month,c.class_name,s.sec_name
FROM edu_timetable AS tt  INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
INNER JOIN edu_academic_year AS a ON tt.year_id=a.year_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE tt.year_id='$year_id' GROUP BY c.class_name";
                  $result=$this->db->query($query);
                  return $result->result();


                }


                //GET ALL TIME TABLE
                function view($class_sec_id){
                   $query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_sec_id' ORDER BY tt.table_id ASC";
                   $result=$this->db->query($query);
                   return $result->result();
                }

                //Delete timetable

                function delete_time($class_sec_id){
                  $query="DELETE FROM edu_timetable WHERE class_id='$class_sec_id'";
                  $result=$this->db->query($query);
                  if($result){
                    $data= array("status" => "success");
                    return $data;
                  }
                }
}
?>
