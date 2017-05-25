<?php

Class Parentsmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION

        function ad_parents($admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName,$userFileName1,$userFileName2,$status)
		{
		
		$digits = 6;
		$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		//echo $OTP;exit; 		
			
          $check_email="SELECT * FROM edu_parents WHERE email='$email'";
          $result=$this->db->query($check_email);
          if($result->num_rows()==0)
		  {
            $query="INSERT INTO edu_parents(admission_id,father_name,mother_name,guardn_name,occupation,income,address,email,email1,home_phone,office_phone,mobile,mobile1,father_pic,mother_pic,guardn_pic,status,created_at,update_at) VALUES ('$admission_id','$father_name','$mother_name','$guardn_name','$occupation','$income','$address','$email','$email1','$home_phone','$office_phone','$mobile','$mobile1','$userFileName','$userFileName1','$userFileName2','$status',NOW(),NOW())";
            $resultset=$this->db->query($query);
			$insert_id = $this->db->insert_id();
			
			if(empty($father_name && $userFileName)) 
			  {
				$father_name=$guardn_name;
				$userFileName=$userFileName2;
			
			  } 
			  
			   $sql="SELECT count(*) AS parents FROM edu_parents" ;
			 // $resultsql=$this->db->query($sql);
			   $resultsql=$this->db->query($sql);
               $result1= $resultsql->result();
               $cont=$result1[0]->parents;
			   $user_id=$cont+600000;
			   //echo $cont+8000;
			   //exit;
			  
		 // $userFileName;
			 $query1="INSERT INTO edu_users(name,user_name,user_password,user_pic,user_type,parent_id,created_date,updated_date,status) VALUES('$father_name','$user_id',md5($OTP),'$userFileName','4','$insert_id',NOW(),NOW(),'A')";
			
			$resultset=$this->db->query($query1);
			
			$query2="UPDATE edu_admission SET parents_status='1',parnt_guardn_id='$insert_id' WHERE admission_id='$admission_id'";
			$resultset=$this->db->query($query2);
			
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "Email Already Exist");
            return $data;
          }

       }
	   
       //GET ALL Admission Form WHERE status='A'
      function get_all_parents_details()
	  {
         $query3="SELECT * FROM edu_parents ORDER BY parent_id DESC ";
         $res=$this->db->query($query3);
         return $res->result();
       }

       function edit_parents($parent_id){
         $query4="SELECT * FROM edu_parents WHERE parent_id='$parent_id'";
         $res=$this->db->query($query4);
         return $res->result();
       }
	   function  edit_parent($parnt_guardn_id)
	   {
		 $query4="SELECT * FROM edu_parents WHERE parent_id='$parnt_guardn_id'";
         $res=$this->db->query($query4);
         return $res->result();
	   }
      
	  function update_parents($parent_id,$single,$admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName,$userFileName1,$userFileName2,$status)
	  {
		  
           $query5="UPDATE edu_parents SET admission_id='$admission_id',father_name='$father_name',mother_name='$mother_name',guardn_name='$guardn_name',occupation='$occupation',income='$income',address='$address',email='$email',email1='$email1',home_phone='$home_phone',office_phone='$office_phone',mobile='$mobile',mobile1='$mobile1',father_pic='$userFileName',mother_pic='$userFileName1',guardn_pic='$userFileName2',status='$status',update_at=NOW() WHERE  parent_id='$parent_id'";
            $res=$this->db->query($query5);
			 
			
			if(empty($father_name && $userFileName)) 
			  {
				$father_name=$guardn_name;
				$userFileName=$userFileName2;
			  } 
			    
	        $query6="UPDATE edu_users SET name='$father_name',updated_date=NOW() WHERE parent_id='$parent_id' "; 
	        $res=$this->db->query($query6);
		 
		    $query2="UPDATE edu_admission SET parents_status='1',parnt_guardn_id='$parent_id' WHERE admission_id='$single'";
			$resultset=$this->db->query($query2);
			
         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }
	   
	   function search_parent($cell)
	   {
		 $query="SELECT * FROM edu_parents WHERE mobile='$cell'";
         $res1=$this->db->query($query);
		 $result=$res1->result();
		 return $result;
				   
		 /*  if($res1->num_rows()==0)
		 {
			 $datas=array("status" => "success","res1" => $result);
           return $datas; 
		 }else{
			 $datas= array("status" => "Mobile Number Not Found");
             return $datas;
		 }  
		  */
			 
        //return $res1->result();
	   }
		   
	   
		 function getData($email)
		   {
					$query = "select * from  edu_parents WHERE email='".$email."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());
					
           }
		   
		   function checkcellnum($cell)
		   {
			        $query = "select * from  edu_parents WHERE mobile='".$cell."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());
		   }
	
	
}
?>
