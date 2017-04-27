<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('yearsmodel');
			$this->load->model('subjectmodel');
			$this->load->model('teachermodel');
			$this->load->model('class_manage');
			$this->load->model('timetablemodel');
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
				$datas['getall_class1']=$this->timetablemodel->view_class_timetable();
				//print_r($datas['getall_class1']);exit;

				$datas['getall_class']=$this->class_manage->getall_class();
				$datas['subres'] = $this->subjectmodel->getsubject();
				$datas['teacheres'] = $this->teachermodel->get_all_teacher();
  			$datas['years'] = $this->yearsmodel->getall_years();
				$datas['resterms'] = $this->yearsmodel->getall_terms();
			 if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('timetable/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function create_timetable(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1){
			 $class_id=$this->input->post('class_id');
			 $year_id=$this->input->post('year_id');
			 $term_id=$this->input->post('term_id');
			 $subject_id=$this->input->post('subject_id');
			 $teacher_id=$this->input->post('teacher_id');

			 $day_id=$this->input->post('day_id');
			 $period_id=$this->input->post('period_id');

			 $datas=$this->timetablemodel->create_timetable($year_id,$term_id,$class_id,$subject_id,$teacher_id,$day_id,$period_id);
			 //print_r($datas['status']);exit;
			 if($datas['status']=='Already'){
				 $this->session->set_flashdata('msg', 'Time Table Already Assigned to this Class');
				 redirect('timetable/home');
			 }elseif($datas['status']=='success'){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				redirect('timetable/manage');
			 }
			 else{
				 redirect('timetable/manage');
			 }
		 }
		 else{
			 redirect('/');
		 }
		}

		public function manage(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['getall_class1']=$this->timetablemodel->view_class_timetable();
			//echo "<pre>";print_r($datas['restime']);exit;
		 if($user_type==1){
			 $this->load->view('header');
			$this->load->view('timetable/manage',$datas);
			$this->load->view('footer');
		 }
		 else{
			 redirect('/');
		 }
		}


		public function view($class_sec_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['restime']=$this->timetablemodel->view($class_sec_id);
			//echo "<pre>";print_r($datas['restime']);exit;
		 if($user_type==1){
			 $this->load->view('header');
 			$this->load->view('timetable/view',$datas);
 			$this->load->view('footer');
		 }
		 else{
			 redirect('/');
		 }
		}


		public function delete(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 $class_sec_id=$this->input->post('val');
			$datas=$this->timetablemodel->delete_time($class_sec_id);
		 if($user_type==1){
			 if($datas['status']=="success"){
				 echo "success";
			  // $this->session->set_flashdata('msg', 'Deleted Successfully');
			  // redirect('/timetable/manage');
			}else{
				echo "failure";
			}
		 }
		 else{
			 redirect('/');
		 }
		}














}
