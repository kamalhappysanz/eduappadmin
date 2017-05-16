<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('studentkmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('class_manage');
		  $this->load->model('subjectmodel');
		
        }
		public function home()
		{}
         
       
	  public function homework_view()
	   {       
           	$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $user_id;
			$datas['result'] = $this->studentkmodel->get_stu_homework_details($user_id);
			//print_r($datas['result']);exit;
			 if($user_type==3)
			  {
				 $this->load->view('adminstudent/student_header');
				 $this->load->view('adminstudent/homeworkview/hw_view',$datas);
				 $this->load->view('adminstudent/student_footer');
			  }
		   else{
				redirect('/');
		 } 
      }
	  
	  public function view_mark($hw_id)
	  { 
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $user_id; echo $hw_id;exit;
			$datas['res'] = $this->studentkmodel->view_homework_marks($user_id,$hw_id);
			//print_r($datas['res']);exit;
			if($user_type==3)
			  {
				 $this->load->view('adminstudent/student_header');
				 $this->load->view('adminstudent/homeworkview/marks_view',$datas);
				 $this->load->view('adminstudent/student_footer');
			  }
		   else{
				redirect('/');
		 } 
	  }
		
		// ---------------------Examination Marks Result Controller-----------------------------------------
		
		
		public function exam_views()
		{
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['exam']=$this->studentkmodel->get_all_exam($user_id);
			    //echo '<pre>';print_r($datas['exam']);exit;
			    if($user_type==3)
				 {
					 $this->load->view('adminstudent/student_header');
					 $this->load->view('adminstudent/exam_result/add',$datas);
					 $this->load->view('adminstudent/student_footer');
				 }else{
						redirect('/');
				 }
		}
		
		public function exam_result($exam_id)
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->studentkmodel->exam_marks($user_id,$exam_id);
			//echo '<pre>';print_r($datas['result']);exit;
			if($user_type==3)
				 {
					 $this->load->view('adminstudent/student_header');
					 $this->load->view('adminstudent/exam_result/exam_marks',$datas);
					 $this->load->view('adminstudent/student_footer');
				 }else{
						redirect('/');
				 }
		}
	 
	
	
	
	
	
	
	
	
	
 }