<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminparent extends CI_Controller {


	function __construct() {
		 parent::__construct();
		  $this->load->model('timetablemodel');
		  $this->load->model('dashboard');
			 $this->load->model('studentmodel');
			 $this->load->model('adminparentmodel');


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
			 if($user_type==4){
	 			$datas['res']=$this->dashboard->stud_details($user_id);
				$stu= count($datas['res']);
				if($stu==1){
					$datas['stud_details']=$this->dashboard->get_students($user_id);
						echo "<pre>";
						print_r($datas['stud_details']);
						exit;

				}else{
					$datas['stud_details']=$this->dashboard->get_students($user_id);
					echo "<pre>";
					print_r($datas['stud_details']);
					exit;
				}
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function timetable(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==4){
				$datas['res']=$this->dashboard->stud_details($user_id);
				 $stu= count($datas['res']);
				if($stu==1){
					$datas['stud_details']=$this->dashboard->get_students($user_id);
						foreach ($datas['stud_details'] as $rows) {}
						echo $class_sec_id= $rows->class_id;
						$datas['restime']=$this->timetablemodel->view_time($class_sec_id);
						//print_r($datas['restime']);exit;
						if($datas['restime']['st']=="no data Found"){
							$data=$datas['restime'];
							$this->load->view('adminparent/parent_header');
							$this->load->view('adminparent/timetable/nodata');
							$this->load->view('adminparent/parent_footer');
						}else {
							$data['restime']=$datas['restime']['time'];
							$this->load->view('adminparent/parent_header');
							$this->load->view('adminparent/timetable/view',$data);
							$this->load->view('adminparent/parent_footer');
						}
				}else{
					$datas['stud_details']=$this->dashboard->get_students($user_id);
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/timetable/add',$datas);
					$this->load->view('adminparent/parent_footer');
				}
			 }
			 else{
					redirect('/');
			 }
		}



		public function view_class_timetable($class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
				$class_sec_id=$class_id;
				$datas['restime']=$this->timetablemodel->view_time($class_sec_id);
				//print_r($datas['restime']);exit;
				if($datas['restime']['st']=="no data Found"){
					$data=$datas['restime'];
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/timetable/nodata');
					$this->load->view('adminparent/parent_footer');
				}else {
					$data['restime']=$datas['restime']['time'];
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/timetable/view',$data);
					$this->load->view('adminparent/parent_footer');
				}
			}else{
				redirect('/');
			}
		}



		public function attendance(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
			 $datas['res']=$this->dashboard->stud_details($user_id);
				 $stu= count($datas['res']);
				// exit;

			 if($stu==1){
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
					 foreach ($datas['stud_details'] as $rows) {}
					 $user_id= $rows->enroll_id;
					 $this->load->view('adminparent/parent_header');
					 $this->load->view('adminparent/attendance/calender');
					 $this->load->view('adminparent/parent_footer');

			 }else{
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/attendance/add',$datas);
				 $this->load->view('adminparent/parent_footer');

			 }
			}
			else{
				 redirect('/');
			}
		}


		public function get_stude(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $user_id='10';
			$datas['stud_details']=$this->dashboard->get_students($user_id);
				foreach ($datas['stud_details'] as $rows) {}
				 $enroll_id= $rows->enroll_id;
					$datas['res']=$this->adminparentmodel->get_stude_attendance($enroll_id);
					echo json_encode($datas['res']);
		}


		public function view_atten($enroll_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $user_id='10';
			if($user_type==4){
					$datas['res']=$this->adminparentmodel->get_stude_attendance($enroll_id);
					//echo json_encode($datas['res']);

					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/attendance/view_calender',$datas);
					$this->load->view('adminparent/parent_footer');
				}else{
						 redirect('/');
				}
		}









}
