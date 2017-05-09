<?php

Class Class_manage extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

       function assign($sec_id,$class_id,$subject){
          $query="SELECT * FROM edu_classmaster WHERE class='$class_id' AND section='$sec_id'";
          $resultset=$this->db->query($query);
          if($resultset->num_rows()==0){
          $query="INSERT INTO edu_classmaster (class,section,subject,status,created_at) VALUES ($class_id,'$sec_id','$subject','A',NOW())";
          $resultset=$this->db->query($query);
          $data= array("status" => "success");
           return $data;
          }else{
            $data= array("status" => "Already Exist");
             return $data;
           }

       }


       function getall_class(){
         $query="SELECT c.class_name,s.sec_name,cm.class_sec_id FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
         $result=$this->db->query($query);
         return $result->result();
       }

       function edit_cs($class_sec_id){
          $query="SELECT c.class_name,c.class_id,s.sec_name,s.sec_id,cm.class_sec_id,cm.subject FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id AND cm.class_sec_id='$class_sec_id'";
          $result=$this->db->query($query);
          return $result->result();
       }


       function save_cs($class_sec_id,$class,$section,$subject){
                $check_class="SELECT * FROM edu_classmaster WHERE class='$class' AND section='$section'";
               $resultset=$this->db->query($check_class);
               if($resultset->num_rows()==0){
                 $query="UPDATE edu_classmaster SET class='$class',section='$section',subject='$subject' WHERE class_sec_id='$class_sec_id'";
                 $resultset=$this->db->query($query);
                 if($resultset){
                 $data= array("status" => "success");
                  return $data;
                 }
               }else{
                 $data= array("status" => "alreadySaved");
                 return $data;
               }
       }


       function delete_cs($class_sec_id){
         $query="DELETE FROM edu_classmaster WHERE class_sec_id='$class_sec_id'";
         $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;
       }

        public function get_subject($classid)
         {
			$query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$classid'";
              $resultset=$this->db->query($query);
			  $row=$resultset->result();
			 // print_r($row);exit;
			 if(empty($row))
			 {
				 $data= array("status" => "Subject Not Found");
				 return $data;
			 }
			  foreach($row as $rows)
			  { }
				        $id=$rows->subject;
						 //echo $id;exit;
						// $id=$rows->subject;
					   $sQuery = "SELECT * FROM edu_subject";
					   $objRs=$this->db->query($sQuery);
					   $rows=$objRs->result();
					   foreach ($rows as $rows1)
					   {
						   $s= $rows1->subject_id;
						   $sec=$rows1->subject_name;
						   $arryPlatform = explode(",",$id);
						   $sPlatform_id  = trim($s);
						   $sPlatform_name  = trim($sec);
						   if(in_array($sPlatform_id, $arryPlatform ))
							   {
								  $sub_name[]=$sec;
								  $sub_id[]=$s;
							   }
						 //return $a;
					  }

					  $data= array("status" => "Success","subject_id" => $sub_id,"subject_name"=>$sub_name);
					 return $data;
      //  print_r($id1);
      }
 }
?>
