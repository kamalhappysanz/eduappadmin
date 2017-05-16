<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		    $this->load->model('examinationmodel');
		    $this->load->model('subjectmodel');
			$this->load->model('classmodel');
			$this->load->model('class_manage');
			$this->load->model('yearsmodel');
			$this->load->model('teachermodel');

		  $this->load->helper('url');
		  $this->load->library('session');
        }

		 public function details_view()
		 {
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
	 		$datas['result'] = $this->examinationmodel->get_details_view();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('examination/view',$datas);
				 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

	   public function add_exam()
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
	 		$datas['result'] = $this->examinationmodel->get_exam_details();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('examination/add',$datas);
				 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}
		 public function add_exam_detail()
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
                
		   $class_name = $this->input->post('class_id');
		   $datas['filter'] = $this->examinationmodel->search_details_view($class_name);
		  // print_r($datas['filter']);exit;
			
	 		$datas['year'] = $this->examinationmodel->get_exam_details();
			$datas['result1'] = $this->examinationmodel->get_details_view1();
						
			$datas['result'] = $this->examinationmodel->get_details_view();

			$datas['sec'] = $this->subjectmodel->getsubject();
			$datas['class'] = $this->classmodel->getclass();
			$datas['getall_class']=$this->class_manage->getall_class();
			$datas['teacheres'] = $this->teachermodel->get_all_teacher1();

			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('examination/add_exam_details',$datas);
				 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		      public function checker()
               {
					 $classid = $this->input->post('classid');
					//echo $classid;exit;
					 $data=$this->class_manage->get_subject($classid);
					 echo json_encode($data);
               }


		public function create()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');

			 $datas['result'] = $this->yearsmodel->getall_years();

 			 if($user_type==1)
			  {
			     $exam_year=$this->input->post('exam_year');
				 $exam_name=$this->input->post('exam_name');

				 $datas=$this->examinationmodel->exam_details($exam_year,$exam_name);

		     	 //print_r($datas['status']);exit;
			    //print_r($data['exam_name']);exit;

				if($datas['status']=="success"){
					$this->session->set_flashdata('msg','Added Successfully');
					redirect('examination/add_exam');
				}else if($datas['status']=="Exam Name Already Exist")
				{
					$this->session->set_flashdata('msg','Exam Name Already Exist');
					redirect('examination/add_exam');
				}else{
					$this->session->set_flashdata('msg','Failed to Add');
					redirect('examination/add_exam');
				}
			 }
			 else{
					redirect('/');
			 }
		}


		       public function edit_exam($exam_id)
				{
					 $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');

					 $datas['res']=$this->examinationmodel->edit_exam($exam_id);
					 //echo "<pre>";print_r(	$datas['res']);exit;
					 $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('examination/edit',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}
					public function update()
					{
						 $datas=$this->session->userdata();
						 $user_id=$this->session->userdata('user_id');
						 $user_type=$this->session->userdata('user_type');

				          if($user_type==1)
				            {
								$exam_id=$this->input->post('exam_id');
								$exam_year=$this->input->post('exam_year');
								$exam_name=$this->input->post('exam_name');
								$status=$this->input->post('status');

								$datas=$this->examinationmodel->update_exam($exam_id,$exam_year,$exam_name,$status);

								 if($datas['status']=="success")
				                     {
										$this->session->set_flashdata('msg','Updated Successfully');
										redirect('examination/add_exam');
				                     }
					             else{
									 $this->session->set_flashdata('msg','Failed To Updated');
									 redirect('examination/add_exam');
							}
					}
				}


		public function add_exam_details()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			  {
			     //$exam_id=$this->input->post('exam_id');
				 $exam_year=$this->input->post('exam_year');
			     $class_name=$this->input->post('class_name');
				 $subject_name=$this->input->post('subject_id');
				 //print_r($subject_name);exit;
			     $exdate=$this->input->post('exam_dates');
				/*  print_r($exam_date);
				 $edate=new DateTime($exam_date);
                 $exdate=date_format($edate,'Y-m-d' );
			    exit; */
				 $time=$this->input->post('time');
				 //print_r($time);exit;
				 $teacher_id=$this->input->post('teacher_id');
				 //print_r($notes);exit;
           $datas=$this->examinationmodel->add_exam_details($exam_year,$class_name,$subject_name,$exdate,$time,$teacher_id);
			 if($datas['status']=="success"){
					$this->session->set_flashdata('msg','Added Successfully');
                    redirect('examination/add_exam_detail');
				}else if($datas['status']=="Exam Already Exist")
				{
					$this->session->set_flashdata('msg','Exam Already Exist');
					 redirect('examination/add_exam_detail');
				}else{
					$this->session->set_flashdata('msg','Failed to Add');
					redirect('examination/add_exam_detail');
				}
		}
		else{
			 redirect('/');
			 }
		}

		public function edit_exam_details($exam_detail_id)
		{
		             $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');
					 $datas['res']=$this->examinationmodel->edit_exam_details($exam_detail_id);
					 //$datas['result'] = $this->examinationmodel->get_details_view();
					 //echo "<pre>";print_r(	$datas['res']);exit;
					 $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('examination/edit_exam_details',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
		}

		public function update_exam_details()
		{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');

		  if($user_type==1)
			{
				 $id=$this->input->post('id');
			     $exam_year=$this->input->post('eid');
				 //echo $exam_year; 
				 $class_name=$this->input->post('class_name');
				 $subject_name=$this->input->post('subject_name');

				 $exam_date=$this->input->post('exam_date');
				 $dateTime = new DateTime($exam_date);
                 $formatted_date=date_format($dateTime,'Y-m-d' );
				 
				 $time=$this->input->post('time');

				 $teacher_id=$this->input->post('teacher_id');

				 $datas=$this->examinationmodel->update_exam_detail($id,$exam_year,$class_name,$subject_name,$formatted_date,$time,$teacher_id);

				 if($datas['status']=="success")
					 {
						$this->session->set_flashdata('msg','Updated Successfully');
						redirect('examination/add_exam_detail');
					 }else if($datas['status']=="Exam Already Exist")
				       {
					    $this->session->set_flashdata('msg','Exam Already Exist');
					    redirect('examination/add_exam_detail');
				     }else{
					 $this->session->set_flashdata('msg','Failed To Updated');
					 redirect('examination/add_exam_detail');
			}
		}
	}
	
	public function subcheck()
	 {
		 $classid=$this->input->post('clsmasid');
		 $examid=$this->input->post('examid');
		 //echo $examid;echo $classid; exit;
		 $resultset=$this->examinationmodel->check_add_exam($classid,$examid);
		 if ($resultset>0)
		 {
			echo "Already Exam Added";
		 }
		else
		 {
			echo "Add Exam";
		 }
		  
	 }
	 
	 public function marks_status()
	 {
		 $datas=$this->session->userdata();
	 	 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $datas['cls']=$this->examinationmodel->marks_status();
		print_r($datas['cls']);exit;
		 if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('examination/exam_result',$datas);
					 $this->load->view('footer');
					 }
					 else{
						redirect('/');
					 }
		 
	 }
	


 }
