<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('homeworkmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
        }
         
       
	public function home()
	 {
	 		 	$datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas=$this->homeworkmodel->get_teacher_id($user_id);
			 //print_r($datas);
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}
		
	/* public function get_all_class()
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			//echo $user_id;
			// $teacher_id = $this->homeworkmodel->get_teacher_id($user_id);
			 //$class_name = $this->homeworkmodel->get_class_name($teacher_id);
			 $class_section = $this->homeworkmodel->get_teacher_id($user_id);
			 $datas["res"]=$class_section;
			  
			// echo'<pre>';
			// print_r($class_section);
			// echo'</pre>'; exit;
			
			 //$sec_class_name = $this->homeworkmodel->convert_id_name($class_section);
			// $datas["result"] = $sec_class_name;  
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/add',$datas);
			 $this->load->view('adminteacher/teacher_footer');
	 		 
	 	} */
	
	
	
	
	
	
	
	
	
	
	
	
	
 }