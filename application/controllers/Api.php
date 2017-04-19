<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	 

	function __construct()
    {
        parent::__construct();
		$this->load->model("apimodel");
		
    }

	
	/*
		Response-code: 
		200 - Successfully
		201 - Field Missing
		202 - Value Already Exists
		203 - Request Method Not Suppoted
		204 - Input error
		205 - Not allowed
		206 - Invalid input value (field name)
		207 - Empty Result
		1107 - Required field missing
		1108 - Insufficient Credit
		1109 - Promocode not available
		1110 - Seat not available
		1111 - Invalid Token or Token expired
		1112 - Error updating Citytix
		1113 - Insufficient Inventory. Please try some other Date and Tour Time
	*/
	
	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";
			
			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}
	
	
	public function login()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);
		
		if(!$this->checkMethod())
		{
			return FALSE;
		}
	
		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";
		
			echo json_encode($res);
			return;
		}
	
		$email = '';
		$password = '';
		
		$email = $this->input->post("username");
		$password = $this->input->post("password");
		
		if($email == "" || $password == "")
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Please Pass all the Required Fields.");
			echo json_encode($arr);
			return;
		}
		
		if($email == NULL || $email == '')
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Required field missing (EMAIL).");
			echo json_encode($arr);
			return;
		}
		
		/*if ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$arr = array("opn" => "Register","scode" => 206,"message" => "Invalid input value (EMAIL).");
			echo json_encode($arr);
			return;
		}*/
		
		if($password == NULL || $password == '')
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Required field missing (PASSWORD).");
			echo json_encode($arr);
			return;
		}
		
		$ress = $this->apimodel->adminlogin($email,$password);
		
		
		
		if(count($ress) > 0)
		{
			$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress);
			echo json_encode($response);
			return;
		}
		else
		{
			$response = array("status" => "error", "msg" => "Invalid login");
			echo json_encode($response);
			return;
		}
		
	}
	
	
	//List of Student for particular class based on teacher id
	
	public function teacher_login(){
		
		
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);
		
		 $email = $this->input->post("username");
		 $password = $this->input->post("password");
		
			
		//$teacher_id=$this->input->post('teacher_id');
		$data['result']=$this->apimodel->teacher_login_data($email,$password);
		$response=$data['result'];
		echo json_encode($response);
		
		//print_r($data['result']);exit;
	}
	
	
	

	
	
	//Sample
	
	
		public function list_student(){
		
		
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);
		
		$teacher_id=$this->input->post('teacher_id');
		$data['result']=$this->apimodel->list_student($teacher_id);
		$response=$data['result'];
		echo json_encode($response);
		//print_r($data['result']);exit;
	}
	
	
	
	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */