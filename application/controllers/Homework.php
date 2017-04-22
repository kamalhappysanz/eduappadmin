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
		
		public function add_test()
		{
			  
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result'] = $this->homeworkmodel->getall_details();
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/add_test',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
			
		} 
	public function create()
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			$test_type=$this->input->post('test_type');
			
			$class_id=$this->input->post('class_id');
			$title=$this->input->post('title');
			$tet_date=$this->input->post('tet_date');
			
			$dateTime = new DateTime($tet_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );
				 
			$details=$this->input->post('details');

		    $home_work=$this->homeworkmodel->create($class_id,$user_id,$test_type,$title,$formatted_date,$details);
			//$datas["res"]=$home_work;
			// echo'<pre>';
			// print_r($datas["res"]);
			// echo'</pre>'; 
			 
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('homework/add_test',$datas);
			   //redirect('add_test');		
			}else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('homework/add_test',$datas);
			}
	 		 
	 	} 
	
 
	
	
	
	
	
	
	
	
	
	
	
 }