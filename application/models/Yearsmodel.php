<?php

Class Yearsmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		 function add_years($from_month,$end_month)
		 {
			 $check_month="SELECT * FROM  edu_academic_year WHERE from_month='$from_month' OR to_month='$end_month' OR '$from_month'='$end_month'";
			 $result=$this->db->query($check_month);
			  if($result->num_rows()==0)
			  {
			  $query="INSERT INTO edu_academic_year(from_month,to_month,status,created_date)VALUES('$from_month','$end_month','A',NOW())";
			  $resultset=$this->db->query($query);
			  $data= array("status"=>"success");
			  return $data;
			  }else{
					$data= array("status"=>"Already Exist The Year And Dates Are Same");
					return $data;
				  }
		 }

		 function add_terms($year_id,$terms,$formatted_date,$formatted_date1)
		 {
			 $check_month="SELECT * FROM edu_terms WHERE from_date='$formatted_date' OR to_date='$formatted_date1' OR term_name='$terms'";
			$result=$this->db->query($check_month);
			  if($result->num_rows() == 0)
			  {
			  $query="INSERT INTO edu_terms(year_id,from_date,to_date,term_name,status,created_date)VALUES('$year_id','$formatted_date','$formatted_date1','$terms','A',NOW())";
			  $resultset=$this->db->query($query);
			  $data= array("status"=>"success");
			  return $data;
			  }else{
					$data= array("status"=>"Already Exist The Terms And Dates Are Same");
					return $data;
				  }

		 }

		 function edit_year($year_id)
		 {
			 $query1="SELECT * FROM   edu_academic_year WHERE year_id='$year_id'";
             $res=$this->db->query($query1);
             return $res->result();
		 }


		 function edit_term($term_id)
		 {
			 $query1="SELECT * FROM   edu_terms WHERE term_id='$term_id'";
             $res=$this->db->query($query1);
             return $res->result();
		 }



		 function update_years($year_id,$from_month,$end_month)
		 {

			 $query="UPDATE edu_academic_year SET from_month='$from_month',to_month='$end_month' WHERE 	year_id='$year_id'";
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


		 function update_terms($terms_id,$year_id,$terms,$from_month,$end_month)
		 {
			 //UPDATE `edu_terms` SET `term_id`=[value-1],`year_id`=[value-2],`from_date`=[value-3],`to_date`=[value-4],`term_name`=[value-5],`status`=[value-6],`created_date`=[value-7] WHERE 1

			 $query="UPDATE edu_terms SET year_id='$year_id',from_date='$from_month',to_date='$end_month',term_name='$terms' WHERE 	term_id='$terms_id'";
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

		 function admisn_year()
		 {
			$query="SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_enrollment AS e,edu_academic_year AS y WHERE e.admit_year=y.year_id";
			 $result=$this->db->query($query);
             return $result->result();
		 }

//GET ALL Years

       function getall_years(){
         $query="SELECT * FROM edu_academic_year";
          $result=$this->db->query($query);
          return $result->result();
       }

       //GET ALL TERMS

              function getall_terms(){
                $query="SELECT * FROM edu_terms";
                 $result=$this->db->query($query);
                 return $result->result();
              }


}
?>
