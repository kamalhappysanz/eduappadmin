<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examinationresult extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('examinationresultmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('class_manage');
		  $this->load->model('subjectmodel');
		
        }
         
       
	public function home()
	 {
	 		 	$datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2)
			 {
			 $datas['result']=$this->examinationresultmodel->get_teacher_id($user_id);
			 //print_r($datas['result']);exit;
			 //$datas['result'] = $this->examinationresultmodel->getall_details();
			 //print_r($datas);
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/examination_result/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}
		
		public function class_section($exam_id)
		{
			    $exam_year=$this->input->post('$exam_year');
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			    if($user_type==2)
			    {
			     $datas=$this->examinationresultmodel->getall_cls_sec($user_id);
				 $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
				// echo '<pre>';
				// print_r($datas['result']);
				// echo '</pre>';
				//	 exit;
			     $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/cls_sec',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				 }
				 else{
						redirect('/');
				 }
		}
		
		public function exam_mark_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
				
			  $cls_masid=$this->input->get('var1');
			  $exam_id=$this->input->get('var2');
			  //echo $cls_masid;echo $exam_id;exit;
			  $datas['res']=$this->examinationresultmodel->getall_cls_sec_stu($user_id,$cls_masid,$exam_id);
			 // $datas['res1']=$this->examinationresultmodel->getall_stuname($user_id,$cls_masid,$exam_id);
			  //echo '<pre>';print_r($datas['res1']);exit;
			 if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/marks',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}
			 
			 
			
		}
		
		
		public function checker()
		{
			$classid=$this->input->post('id');
		    $data=$this->class_manage->get_subject($classid);
			echo json_encode($data);
		}
		
 }