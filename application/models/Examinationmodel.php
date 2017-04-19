<?php

Class Examinationmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  function get_exam_details()
	 {
		$query="SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_examination AS e,edu_academic_year AS y WHERE e.exam_year=y.year_id";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	  function get_details_view()
	 {
		 $query="select ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.times,ex.classmaster_id,cm.	class_sec_id,ex.notes,s.subject_name,c.class_name,se.sec_name  FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se WHERE  ex.subject_id=s.subject_id AND ex.classmaster_id=cm.	class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section";


		// select ex.classmaster_id,c.class_name,s.sec_name FROM  edu_exam_details AS ex,edu_classmaster AS cm, edu_class AS c,edu_sections AS s WHERE c.class_id =cm.class AND s.sec_id=cm.section


         $resultset=$this->db->query($query);
         return $resultset->result();
	 }



    function exam_details($exam_year,$exam_name)
    {
	  $check_exam_name="SELECT * FROM edu_examination WHERE exam_name='$exam_name'";
	  $result=$this->db->query($check_exam_name);
      if($result->num_rows()==0)
	  {
	  $query="INSERT INTO edu_examination(exam_year,exam_name,status,created_at,updated_at)VALUES('$exam_year','$exam_name','A',NOW(),NOW())";
	  $resultset=$this->db->query($query);
      $data= array("status"=>"success");
      return $data;
	  }else{
            $data= array("status"=>"Exam Name Already Exist");
            return $data;
          }
    }

	 function add_exam_details($exam_year,$class_name,$subject_name,$formatted_date,$time,$notes)
	{
	  $check_exam_name="SELECT * FROM edu_exam_details WHERE exam_id='$exam_year' AND subject_id='$subject_name' AND classmaster_id='$class_name' AND exam_date='$formatted_date' AND times='$time'";
	  $result=$this->db->query($check_exam_name);
      if($result->num_rows()==0)
	  {
		$query="INSERT INTO edu_exam_details(exam_id,subject_id,exam_date,times,classmaster_id,notes,status,created_at) VALUES ('$exam_year','$subject_name','$formatted_date','$time','$class_name','$notes','A',NOW())";
		$resultset=$this->db->query($query);
        $data= array("status" => "success");
        return $data;
		}else{
            $data= array("status"=>"Exam Already Exist");
            return $data;
          }

	}
	function edit_exam($exam_id)
	{
		 $query1="SELECT * FROM  edu_examination WHERE exam_id='$exam_id'";
         $res=$this->db->query($query1);
         return $res->result();
	}
	function update_exam($exam_id,$exam_year,$exam_name)
	{
		$query="UPDATE edu_examination SET exam_year='$exam_year',exam_name='$exam_name' WHERE exam_id='$exam_id'";
		$res=$this->db->query($query);

		//return $res->result();
		if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }
	}

	function edit_exam_details($exam_detail_id)
	{
		 $query1="SELECT * FROM  edu_exam_details WHERE exam_detail_id='$exam_detail_id'";
         $res=$this->db->query($query1);
         return $res->result();
	}

	function update_exam_details($id,$exam_year,$class_name,$subject_name,$formatted_date,$time,$notes)
	{
	    $query="UPDATE edu_exam_details SET exam_id='$exam_year',subject_id='$subject_name',exam_date='$formatted_date',times='$time',classmaster_id='$class_name',notes='$notes',updated_at='NOW()' WHERE exam_detail_id='$id' ";
		$res=$this->db->query($query);

		//return $res->result();$notes
		if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }
	}



}
?>
