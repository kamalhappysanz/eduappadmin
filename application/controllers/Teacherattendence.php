<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherattendence extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('teacherattendencemodel');
			$this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');


 }

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section


	 	public function home(){
	 		 	$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas=$this->teacherattendencemodel->get_teacher_id($user_id);
			 //print_r($datas);
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/attendence/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function attendence($class_id){

				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				 $datas=$this->teacherattendencemodel->check_attendence($class_id);

				 if($datas['status']=="success"){
					 $datas['res']=$this->teacherattendencemodel->get_studentin_class($class_id);
					$datas['class_id']=$class_id;
					$this->load->view('adminteacher/teacher_header');
					$this->load->view('adminteacher/attendence/attendence',$datas);
					$this->load->view('adminteacher/teacher_footer');
				 }else{
					
 					$this->load->view('adminteacher/teacher_header');
 					$this->load->view('adminteacher/attendence/attendence',$datas);
 					$this->load->view('adminteacher/teacher_footer');
		 }
			 }
			 else{
					redirect('/');
			 }
		}

		public function take_attendence(){

				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $student_id=$this->input->post('student_id');
			 $class_id=$this->input->post('class_id');
			 $attendence_val=$this->input->post('attendence_val');
			  $a_taken=$this->input->post('user_id');
		   $datas=$this->teacherattendencemodel->get_attendence_class($class_id,$student_id,$attendence_val,$a_taken);
			 print_r($datas['status']);exit;
			 if($datas['status']=="success"){
				 echo "success";
			 }else{
				  echo "failure";
			 }
			//  $this->load->view('adminteacher/teacher_header');
			//  $this->load->view('adminteacher/attendence/attendence',$datas);
			//  $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}





















}
