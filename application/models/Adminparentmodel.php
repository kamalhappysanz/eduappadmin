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


}
?>
