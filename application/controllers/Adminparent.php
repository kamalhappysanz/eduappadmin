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
						 $class_sec_id= $rows->class_id;
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
				$datas['total']=$this->adminparentmodel->get_total_working_days();

			 if($stu==1){
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
					 foreach ($datas['stud_details'] as $rows) {}
					 $user_id= $rows->enroll_id;
					 $this->load->view('adminparent/parent_header');
					 $this->load->view('adminparent/attendance/calender',$datas);
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
			$datas['total']=$this->adminparentmodel->get_total_working_days();

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


		public function event(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
					$datas['res']=$this->adminparentmodel->get_event_all();
					// print_r($datas['res']);
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/event/eventview',$datas);
					$this->load->view('adminparent/parent_footer');
				}else{
						 redirect('/');
				}
		}


		public function view_event($event_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
					$datas['res']=$this->adminparentmodel->get_event_list_all($event_id);
					// echo "<pre>";
					// print_r($datas['res']);
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/event/event_list',$datas);
					$this->load->view('adminparent/parent_footer');
				}else{
						 redirect('/');
				}
		}

      public function homework(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
			 $datas['res']=$this->dashboard->stud_details($user_id);
			 $stu= count($datas['res']);
			// echo $stu;exit;

			 if($stu==1){
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
					 foreach ($datas['stud_details'] as $rows) {}
					 $enroll_id= $rows->enroll_id;
					//echo $enroll_id;exit;
					 $datas['result']=$this->adminparentmodel->get_all_homework($enroll_id);
					 $datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
					 $this->load->view('adminparent/parent_header');
					 $this->load->view('adminparent/homework/hw_view',$datas);
					 $this->load->view('adminparent/parent_footer');
			 }else{
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/homework/add',$datas);
				 $this->load->view('adminparent/parent_footer');
			 }
			}
			else{
				 redirect('/');
			}
		}


		public function view_homework(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$enroll_id=$this->input->get('var');
			//echo $enroll_id; exit;
			if($user_type==4){
					 $datas['result']=$this->adminparentmodel->get_all_homework($enroll_id);
					 $datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
					//echo print_r($datas['result']);exit;
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/homework/hw_view',$datas);
					$this->load->view('adminparent/parent_footer');
				}else{
						 redirect('/');
				}
		}

		 public function view_mark()
	     {

		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
            $hw_id=$this->input->get('var1');
            $enroll_id=$this->input->get('var2');
			//echo $hw_id; echo $enroll_id;exit;
			$datas['res'] = $this->adminparentmodel->view_homework_marks($hw_id,$enroll_id);
			//print_r($datas['res']);exit;
			if($user_type==4)
			  {
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/homework/marks_view',$datas);
				 $this->load->view('adminparent/parent_footer');
			  }
		   else{
				redirect('/');
		 }
	   }

	   //----------Examination Result------------------

	   public function exam_result()
	   {
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
			 $datas['res']=$this->dashboard->stud_details($user_id);
			 $stu= count($datas['res']);
			// echo $stu;exit;

			 if($stu==1){
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
					 foreach ($datas['stud_details'] as $rows) {}
					 $enroll_id= $rows->enroll_id;
					//echo $enroll_id;exit;
					 $datas['exam'] = $this->adminparentmodel->view_exam_name($enroll_id);
					 $datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
					 $this->load->view('adminparent/parent_header');
					 $this->load->view('adminparent/exam_result/exam_name',$datas);
					 $this->load->view('adminparent/parent_footer');
			 }else{
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/exam_result/add',$datas);
				 $this->load->view('adminparent/parent_footer');
			 }
			}
			else{
				 redirect('/');
			}

	   }

	   public function exam_name($enroll_id)
	   {
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $enroll_id;exit;
			$datas['exam'] = $this->adminparentmodel->view_exam_name($enroll_id);
			$datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
			//print_r($datas['exam']);exit;
			if($user_type==4)
			  {
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/exam_result/exam_name',$datas);
				 $this->load->view('adminparent/parent_footer');
			  }
		   else{
				redirect('/');
		 }

	   }

	    public function exam_results($exam_id,$stu_id)
	     {
		    //echo $exam_id;echo $stu_id;exit;
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->adminparentmodel->exam_marks($stu_id,$exam_id);

			//echo '<pre>';print_r($datas['result']);exit;

			if($user_type==4)
				 {
					 $this->load->view('adminparent/parent_header');
					 $this->load->view('adminparent/exam_result/exam_marks',$datas);
					 $this->load->view('adminparent/parent_footer');
				 }else{
						redirect('/');
				 }
	    }
	  //---------------Circular---------------------

        public function circular()
	   {
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==4){
			 $datas['res']=$this->dashboard->stud_details($user_id);
			 $stu= count($datas['res']);
			// echo $stu;exit;

			 if($stu==1){
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
					 foreach ($datas['stud_details'] as $rows) {}
					 $enroll_id= $rows->enroll_id;
					//echo $enroll_id;exit;
					 $datas['circular']=$this->adminparentmodel->get_all_classid($enroll_id);
					 //$datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/circular/view_circular',$datas);
					$this->load->view('adminparent/parent_footer');
			 }else{
				 $datas['stud_details']=$this->dashboard->get_students($user_id);
				 $this->load->view('adminparent/parent_header');
				 $this->load->view('adminparent/circular/add',$datas);
				 $this->load->view('adminparent/parent_footer');
			 }
			}
			else{
				 redirect('/');
			}

	   }

	  public function view_circular(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$enroll_id=$this->input->get('var');
			//echo $enroll_id; exit;
			if($user_type==4){
					 $datas['circular']=$this->adminparentmodel->get_all_classid($enroll_id);
					// $datas['stu_id']=$this->adminparentmodel->get_stu_id($enroll_id);
					//echo print_r($datas['circular']);exit;
					$this->load->view('adminparent/parent_header');
					$this->load->view('adminparent/circular/view_circular',$datas);
					$this->load->view('adminparent/parent_footer');
				}else{
						 redirect('/');
				}
		}



}
