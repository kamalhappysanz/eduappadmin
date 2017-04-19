<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	public function hitURLToSendMsg($mobileNo, $msg)
	{
/*		//Your authentication key
		$authKey = "127473A2NPXPY5I57f60347";

		//Multiple mobiles numbers separated by comma
		$mobileNumber = $mobileNo;

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "MVIPGP";

		//Your message to send, Add URL encoding here.
		$message = urlencode($msg);

		//Define route 
		$route = "Transactional Route";

		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);

		//API URL
		$url="https://control.msg91.com/api/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));


		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		//get response
		$output = curl_exec($ch);

		//Print error if any
		if(curl_errno($ch))
		{
			echo 'error:' . curl_error($ch);
		}

		curl_close($ch);
		*/
	}
	
	public function generateOTP()
	{
		$digits = 4;
		$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		return $OTP;
	}
	
	public function checkmobilenoexists($mobileno,$userid)
	{
		$sql="select * from members where mobile_no='".$mobileno."' and is_active='Active'";
		if($userid != '' || $userid != 0)
		{
			$sql .= " and cust_id = $userid";
		}
		$result = $this->db->query($sql);
		return $result->result();	
	}
	
	public function checkmobilenoexistsGP($mobileno,$userid)
	{
		$sql="select * from gp_doctor where mobile_no='".$mobileno."'";
		if($userid != '' || $userid != 0)
		{
			$sql .= " and id = $userid";
		}
		$result = $this->db->query($sql);
		return $result->result();	
	}
	
	public function checkemailexists($email,$userid)
	{
		$sql="select * from members where email='".$email."' and is_active='Active'";
		if($userid != '' || $userid != 0)
		{
			$sql .= " and cust_id = $userid";
		}
		$result = $this->db->query($sql);
		return $result->result();	
	}
	
	public function registerUser($mobileno,$email,$password,$OTP)
	{
		$sql = "INSERT INTO members SET
					email = '".mysql_real_escape_string($email)."',
					mobile_no = '".mysql_real_escape_string($mobileno)."',
					password = md5('".$password."'),
					mob_verification_code = $OTP";
		$result = $this->db->query($sql);
		$user_id = $this->db->insert_id();
		
		//$msg="Dear $username: Thanks for Register.Kindly Login With Your username : $mobileno and password : $password";
		//$this->hitURLToSendMsg($mobileno,$msg);
		
		$arr = array("email" => $email,"mobile" => $mobileno,"OTP" => $OTP);
		echo $arr;
		//return $arr;
	}
	
	public function verifyotpPatient($mobileno,$email,$OTP)
	{
		$sql = "SELECT * FROM customers WHERE mobile_no='".$mobileno."' and email='".$email."' and mob_verification_code=".$OTP." and is_active='Active'";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function updatePatientonOTP($mobileno,$email,$OTP)
	{
		$sql = "UPDATE customers SET is_mobile_verified=1,login_count=1,last_logindate='".date('Y-m-d H:s:i')."' WHERE mobile_no='".$mobileno."' and email='".$email."' and mob_verification_code = $OTP and is_active='Active'";
		$result = $this->db->query($sql);
	}
	
	public function updatePatientLogin($email,$password)
	{
		$sql = "UPDATE customers SET login_count=login_count + 1,last_logindate='".date('Y-m-d H:s:i')."' WHERE email='".$email."' and password=md5('".$password."') and is_active='Active'";
		$result = $this->db->query($sql);
	}
	
	public function updateGPLogin($email,$password)
	{
		$sql = "UPDATE users SET login_count=login_count + 1,last_logindate='".date('Y-m-d H:s:i')."' WHERE email='".$email."' and password=md5('".$password."') and is_active='Active' and gp_doctor_id!=0";
		$result = $this->db->query($sql);
	}
	
	public function adminlogin($email,$password)
	{

		$sql = "SELECT u.user_id,u.name,u.name,u.user_name,u.user_pic,u.user_type,r.role_name AS user_type_name FROM edu_users  AS u
INNER JOIN edu_role AS r ON u.user_type=r.role_id WHERE user_name ='".$email."' and user_password = md5('".$password."') and u.status='A'";
		$result = $this->db->query($sql);
                  foreach ($result->result() as $rows)
		  {
		   $select_id=$rows->user_id;
		  $sql1 = "UPDATE edu_users SET updated_date=NOW() WHERE user_id='$select_id'";
		   $result2 = $this->db->query($sql1);
		  }
		return $result->result();
	}
	
	public function checkloginGP($email,$password)
	{
		$sql = "SELECT u.*,gp.mobile_no,CONCAT(gp.first_name,' ',gp.last_name) as name FROM users u
				LEFT JOIN gp_doctor gp ON gp.id=u.gp_doctor_id
				WHERE u.email='".$email."' and u.password=md5('".$password."') and u.is_active='Active' and u.gp_doctor_id!=0";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	
	public function updatePersonaldetails($firstname,$lastname,$postalcode,$addressline1,$addressline2,$city,$gender,$dob,$age,$session,$usertype)
	{
		if($usertype == 'Patient')
		{
			$sql = "SELECT * FROM cust_address WHERE cust_id=".$session;
			$result = $this->db->query($sql);
			if(count($result->result()) == 1){
				$sql = "UPDATE cust_address SET 
					first_name = '".mysql_real_escape_string($firstname)."',
					last_name = '".mysql_real_escape_string($lastname)."',
					postal_code = '".mysql_real_escape_string($postalcode)."',
					address_line1 = '".mysql_real_escape_string($addressline1)."',
					address_line2 = '".mysql_real_escape_string($addressline2)."',
					address_line3 = '".mysql_real_escape_string($city)."',
					gender = '".$gender."',
					dob = '".$dob."',
					updated_date = '".date('Y-m-d H:s:i')."',
					age = $age WHERE cust_id=".$session;
			}else{
				$sql = "INSERT INTO cust_address SET 
					first_name = '".mysql_real_escape_string($firstname)."',
					last_name = '".mysql_real_escape_string($lastname)."',
					postal_code = '".mysql_real_escape_string($postalcode)."',
					address_line1 = '".mysql_real_escape_string($addressline1)."',
					address_line2 = '".mysql_real_escape_string($addressline2)."',
					address_line3 = '".mysql_real_escape_string($city)."',
					gender = '".$gender."',
					dob = '".$dob."',
					is_primary = 1,
					cust_id = $session,
					created_date = '".date('Y-m-d H:s:i')."',
					age = ".$age;
			}
		}
		
		if($usertype == 'Doctor')
		{
			$sql = "UPDATE gp_doctor SET 
					first_name = '".mysql_real_escape_string($firstname)."',
					last_name = '".mysql_real_escape_string($lastname)."',
					postal_code = '".mysql_real_escape_string($postalcode)."',
					address_line1 = '".mysql_real_escape_string($addressline1)."',
					address_line2 = '".mysql_real_escape_string($addressline2)."',
					address_line3 = '".mysql_real_escape_string($city)."',
					gender = '".$gender."',
					date_of_birth = '".$dob."',
					updated_by = '".$session."',
					updated_date = '".date('Y-m-d H:s:i')."',
					age = $age WHERE id=".$session;
		}
		
		$result = $this->db->query($sql);
		return;
	}
	
	public function updateOTPforgotPassword($mobileno,$OTP)
	{
		$sql = "UPDATE customers SET mob_verification_code = ".$OTP." WHERE mobile_no=".$mobileno;
		$result = $this->db->query($sql);
		return;
	}
	
	public function updateOTPforgotPasswordGP($mobileno,$OTP)
	{
		$sql = "UPDATE gp_doctor SET mob_verification_code = ".$OTP." WHERE mobile_no=".$mobileno;
		$result = $this->db->query($sql);
		return;
	}
	
	public function forgotpasswordverifyotp($mobileno,$OTP,$user)
	{
		if($user == 'Patient'){
			$sql = "SELECT * FROM customers WHERE mobile_no='".$mobileno."' and mob_verification_code=".$OTP." and is_active='Active'";
		}else if($user == 'Doctor'){
			$sql = "SELECT * FROM gp_doctor WHERE mobile_no='".$mobileno."' and mob_verification_code=".$OTP;
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function updateforgotpassword($password,$session,$usertype)
	{
		if($usertype == 'Patient'){
			$sql = "UPDATE customers SET password = md5('".$password."') WHERE cust_id=".$session;
		}else if($usertype == 'Doctor'){
			$sql = "UPDATE gp_doctor SET password = md5('".$password."') WHERE id=".$session;
		}
		$result = $this->db->query($sql);
		return;
	}
	
	public function updatechangepassword($session,$oldpassword,$newpassword,$usertype)
	{
		if($usertype == 'Patient'){
			$sql = "UPDATE customers SET password = md5('".$newpassword."') WHERE cust_id=".$session." and password = md5('".$oldpassword."')";
		}else if($usertype == 'Doctor'){
			$sql = "UPDATE gp_doctor SET password = md5('".$newpassword."') WHERE id=".$session." and password = md5('".$oldpassword."')";
		}
		$result = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function getProfiledetails($sessionid,$sessionusertype)
	{
		if($sessionusertype == 'Patient'){
			$sql = "SELECT c.email,c.mobile_no,c.alternative_no,ca.* FROM customers c
					LEFT JOIN cust_address ca ON ca.cust_id = c.cust_id
					WHERE c.cust_id='".$sessionid."' and c.is_active='Active'";
		}else if($sessionusertype == 'Doctor'){
			$sql = "SELECT gp.*,GROUP_CONCAT(aa.postal_code) as service_postal_code FROM gp_doctor gp
					LEFT JOIN gp_address gpa ON gpa.gp_doctor_id = gp.id
					LEFT JOIN avail_address aa ON aa.id = gpa.address_id
					WHERE gp.id='".$sessionid."'";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function cancelRequest($sessionid,$sessionusertype)
	{
		if($sessionusertype == 'Patient'){
			$sql = "UPDATE customers SET is_active='Deleted',is_deleted=1 WHERE cust_id=".$sessionid;
		}else if($sessionusertype == 'Doctor'){
			$sql = "UPDATE users SET is_active='Deleted',is_deleted=1 WHERE user_id=".$sessionid;
		}
		$result = $this->db->query($sql);
		return $affected = $this->db->affected_rows();
	}
	
	public function getWaitingappointmentList($sessionid,$sessionusertype)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){
			/*$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3 FROM booking b
					LEFT JOIN cust_booking_address cba ON cba.id=b.cust_address_id AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN avail_address aa ON aa.postal_code=cba.postal_code AND aa.is_active=1
					LEFT JOIN gp_address ga ON ga.address_id=aa.id AND ga.gp_doctor_id=".$sessionid."
					WHERE b.status='Open'";*/
			
			$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3 FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.status='Open' AND b.gp_address_id IS NULL";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getConfirmedappointmentList($sessionid,$sessionusertype)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){	
			$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3 FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id AND b.gp_address_id=ga.id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.status='Confirmed' AND b.gp_address_id IS NOT NULL";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getMyappointmentList($sessionid,$sessionusertype,$fromDate,$toDate)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){	
			$sql = "SELECT DISTINCT date_format(b.booking_datetime,'%d-%m-%Y') as booking_date FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id AND b.gp_address_id=ga.id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.status='Confirmed' AND b.gp_address_id IS NOT NULL AND date(b.booking_datetime) >= '".$fromDate."' AND date(b.booking_datetime) <= '".$toDate."'";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getMyappointmentonDateList($sessionid,$sessionusertype,$currDate)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){	
			$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3 FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id AND b.gp_address_id=ga.id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.status='Confirmed' AND b.gp_address_id IS NOT NULL AND date(b.booking_datetime) = '".$currDate."'";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getCompletedappointmentList($sessionid,$sessionusertype)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){	
			$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3 FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id AND b.gp_address_id=ga.id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.status='Completed' AND b.gp_address_id IS NOT NULL";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getAppointmentDetails($sessionid,$sessionusertype,$bookingId)
	{
		if($sessionusertype == 'Patient'){
			$sql = "";
		}else if($sessionusertype == 'Doctor'){	
			$sql = "SELECT b.id as appointment_id,b.booking_id,b.cust_id,b.booking_datetime,cba.postal_code,cba.address_line1,cba.address_line2,cba.address_line3,CONCAT (ca.first_name,' ',ca.last_name) AS customername,b.cust_id as customerid,c.mobile_no as cmobile,gd.gp_id,gd.mobile_no as gpmobile FROM gp_address ga
					LEFT JOIN avail_address aa ON aa.id=ga.address_id AND aa.is_active=1
					LEFT JOIN cust_booking_address cba ON cba.postal_code=aa.postal_code AND cba.is_current_address=1 AND cba.is_active=1
					LEFT JOIN booking b ON b.cust_address_id=cba.id AND b.gp_address_id=ga.id
					LEFT JOIN cust_address ca ON ca.cust_id=cba.cust_id
					LEFT JOIN customers c ON c.cust_id=cba.cust_id
					LEFT JOIN gp_doctor gd ON gd.id=ga.gp_doctor_id
					WHERE ga.gp_doctor_id=".$sessionid." AND b.gp_address_id IS NOT NULL AND b.id=".$bookingId;
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	
	
	function teacher_login_data($email,$password){

		 $sql = "SELECT * FROM edu_users WHERE user_name ='".$email."' and user_password = md5('".$password."') and status='A'";
		$result1 = $this->db->query($sql);
		 $ress= $result1->result();
		
		 
		if($result1->num_rows()==1)
		{
			
			foreach ($result1->result() as $rows) 
		  {
		   $select_id=$rows->user_id;
		  $sql1 = "UPDATE edu_users SET updated_date=NOW() WHERE user_id='$select_id'";
		   $result2 = $this->db->query($sql1);
		  }
			 $teacher_id=$rows->teacher_id;
			
			 $teacher_query="SELECT t.teacher_id,t.name,t.sex,t.age,t.nationality,t.religion,t.community_class,t.community,t.address,
t.email,t.phone,t.sec_email,t.sec_phone,t.profile_pic,t.update_at,t.class_name AS lclass,t.class_teacher,ss.sec_name,c.class_name FROM edu_teachers AS t INNER JOIN edu_classmaster AS cm ON t.class_teacher=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE t.teacher_id='$teacher_id'";

			$teacher_res = $this->db->query($teacher_query);
		    $teacher_res1= $teacher_res->result();
			
			foreach($teacher_res1 as $rows1){ }
			$class_teacher=$rows1->class_teacher;
		 	
			 $timetable_query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period,ss.sec_name,c.class_name
FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id
INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE  tt.teacher_id='$class_teacher'";
			$timetable_res = $this->db->query($timetable_query);
			 if($timetable_res->num_rows()==0){
				 $timetable_res1 = array("status" => "timetable", "msg" => "no timeTable found");

			}else{
				$timetable_res1= $timetable_res->result();
			}  
		  
					//print_r($timetable_res1);exit;
				  
				  
			
			
			
			$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress,"teacherProfile" =>$teacher_res1,"timeTable"=>$timetable_res1);
			echo json_encode($response);
			return;
		}
		else
		{
			$response = array("status" => "error", "msg" => "Invalid login");
			echo json_encode($response);
			return;
		}
		
		/* $query="SELECT class_teacher FROM edu_teachers WHERE teacher_id='$teacher_id'";
		$result = $this->db->query($query);
		foreach($result->result() as $rows){ }
			$class_id= $rows->class_teacher;
			
		$query1="SELECT  e.*,c.class_name,ss.sec_name FROM edu_enrollment  AS e INNER JOIN edu_class AS c ON e.class=c.class_id INNER JOIN edu_sections AS ss ON e.section=ss.sec_id WHERE class='$class_id'";
		$listofstudent = $this->db->query($query1); */
		
		
		
		return $resultset->result();
			
		
		
	}
	
	
	function list_student($teacher_id){
		$query="SELECT class_teacher FROM edu_teachers WHERE teacher_id='$teacher_id'";
		$result = $this->db->query($query);
		foreach($result->result() as $rows){ }
			$class_id= $rows->class_teacher;
			
		$query1="SELECT  e.*,c.class_name,ss.sec_name FROM edu_enrollment  AS e INNER JOIN edu_class AS c ON e.class=c.class_id INNER JOIN edu_sections AS ss ON e.section=ss.sec_id WHERE class='$class_id'";
		$resultset = $this->db->query($query1);
		return $resultset->result();
		
		
		
	}
	
	
	
}

?>