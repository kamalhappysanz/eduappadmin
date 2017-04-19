<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('homemodel');
		  $this->load->helper('url');
		  $this->load->library('session');
        }
         
       
	
	public function get_all_class()
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			//echo $user_id;
                        
                         $teacher_id = $this->homemodel->get_teacher_id($user_id);
                         
                         $class_name = $this->homemodel->get_class_name($teacher_id);
                         
                         $class_section = $this->homemodel->get_class_section($class_name);
                         
                         $sec_class_name = $this->homemodel->convert_id_name($class_section);
                         $datas["result"] = $sec_class_name;  
                         
		    	         $this->load->view('adminteacher/teacher_header');
				 $this->load->view('homework/add',$datas);
				 $this->load->view('adminteacher/teacher_footer');
	 		 
	 	}
	
	
	
	
	
	
	
	
	
	
	
	
	
 }