<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('studentmodel');
      $this->load->model('teachereventmodel');
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
			$datas['result'] = $this->studentmodel->get_stu_homework_details($user_id);
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
			$datas['res'] = $this->studentmodel->view_homework_marks($user_id,$hw_id);
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
				$datas['exam']=$this->studentmodel->get_all_exam($user_id);
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
			$datas['result']=$this->studentmodel->exam_marks($user_id,$exam_id);
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


	   public function attendance(){
       $datas=$this->session->userdata();
       $user_id=$this->session->userdata('user_id');
       $user_type=$this->session->userdata('user_type');
       if($user_type==3)
          {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/attendance/calender',$datas);
            $this->load->view('adminstudent/student_footer');
          }else{
             redirect('/');
          }
     }

     public function get_attendance_user(){
       $datas=$this->session->userdata();
       $user_id=$this->session->userdata('user_id');
       $user_type=$this->session->userdata('user_type');
       $datas['res']=$this->studentmodel->get_student_user($user_id);
       echo json_encode($datas['res']);
     }



     public function timetable(){
       $datas=$this->session->userdata();
       $user_id=$this->session->userdata('user_id');
       $user_type=$this->session->userdata('user_type');
       if($user_type==3)
          {
            $datas['restime']=$this->studentmodel->get_timetable($user_id);
            if($datas['restime']['st']=="no data Found"){
     				 $data=$datas['restime'];
     				 $this->load->view('adminstudent/student_header');
     				 $this->load->view('adminstudent/timetable/nodata');
     				 $this->load->view('adminstudent/student_footer');
     			 }else {
     				 $data['restime']=$datas['restime']['time'];
     				 $data['class_id']=$class_sec_id;
     				 $data['user_id']=$user_id;$data['user_type']=$user_type;
     				 $this->load->view('adminstudent/student_header');
     				 $this->load->view('adminstudent/timetable/view',$data);
     				 $this->load->view('adminstudent/student_footer');
     			 }
          }else{
             redirect('/');
          }
     }


     public function event(){
       $datas=$this->session->userdata();
       $user_id=$this->session->userdata('user_id');
       $user_type=$this->session->userdata('user_type');
      if($user_type==3){
      //$datas['res']=$this->teachereventmodel->get_teacher_event($user_id);
      $datas['event_all']=$this->teachereventmodel->get_teacher_allevent();
      //print_r(  $datas['event_all']);exit;
      $this->load->view('adminstudent/student_header');
      $this->load->view('adminstudent/event/eventview',$datas);
      $this->load->view('adminstudent/student_footer');
      }
      else{
         redirect('/');
      }
     }
     public function view_event($event_id){
         $datas=$this->session->userdata();
         $user_id=$this->session->userdata('user_id');
         $user_type=$this->session->userdata('user_type');
        if($user_type==3){
        $datas['res']=$this->teachereventmodel->get_teacher_in_event($event_id);
       //  echo "<pre>";
       //  print_r( $datas['res']);exit;
        $this->load->view('adminstudent/student_header');
        $this->load->view('adminstudent/event/event_list',$datas);
        $this->load->view('adminstudent/student_footer');
        }
        else{
           redirect('/');
        }
     }



 }
