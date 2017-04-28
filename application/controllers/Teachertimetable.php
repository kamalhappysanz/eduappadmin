<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachertimetable extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('teacherattendencemodel');
			$this->load->model('timetablemodel');
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
			 $this->load->view('adminteacher/timetable/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function view($class_sec_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['restime']=$this->timetablemodel->view_time($class_sec_id);
		echo "<pre>";print_r($datas['status']);exit;
		 if($user_type==2){
			 if($datas['status']=="success"){
					 print_r($datas);exit;
					$this->load->view('adminteacher/teacher_header');
	 			 $this->load->view('adminteacher/timetable/view',$datas);
	 			 $this->load->view('adminteacher/teacher_footer');
			 }else {
				 print_r($datas['status']);exit;
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/timetable/nodata');
				 $this->load->view('adminteacher/teacher_footer');
			 }

		 }
		 else{
			 redirect('/');
		 }
		}
























}
