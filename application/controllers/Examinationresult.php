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
			 //echo '<pre>';print_r($datas['result']);exit;
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
				 //echo '<pre>'; print_r($datas['cls_id']);echo '</pre>'; exit;
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

			 // $datas['sub']=$this->examinationresultmodel->getall_subname($user_id,$cls_masid,$exam_id);
			  $datas['stu']=$this->examinationresultmodel->getall_stuname($user_id,$cls_masid,$exam_id);
			  $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
			  $datas['res']=$this->examinationresultmodel->getall_cls_sec_stu($user_id,$cls_masid,$exam_id);
			 // echo '<pre>';print_r($datas['sub']);
			 // echo '<pre>';print_r($datas['stu']); exit;
			
			 if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/marks',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}

		}
		
		public function exam_mark_details_cls_teacher()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
				
			  $cls_masid=$this->input->get('var1');
			  $exam_id=$this->input->get('var2');
			  //echo $cls_masid;echo $exam_id;exit;
			  
			  $datas=$this->examinationresultmodel->getall_subname($user_id,$cls_masid,$exam_id);
			  $datas['stu']=$this->examinationresultmodel->getall_stuname($user_id,$cls_masid,$exam_id);
			  $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
			  $datas['marks1']=$this->examinationresultmodel->getall_marks_details1($user_id,$cls_masid);
			  //echo '<pre>';print_r($datas);
			 //echo '<pre>';print_r($datas['stu']); exit;
			
			 if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/class_marks',$datas);
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
		
		public function marks_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsmastid');
			  $subid=$this->input->post('subid');
			  $sutid=$this->input->post('sutid');
			  $teaid=$this->input->post('teaid');
			  $marks=$this->input->post('marks');
			  //echo $exam_id;
			  //echo $subid;print_r($sutid);echo $teaid;print_r($marks);exit;
			
		   $datas=$this->examinationresultmodel->exam_marks_details($exam_id,$subid,$sutid,$clsmastid,$teaid,$marks);
		   //print_r($datas);
			 if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('examinationresult/marks_details_view',$datas);
			   //redirect('add_test');		
			  }else if($datas['status']=="Already Added"){
				  $this->session->set_flashdata('msg','Already Added');
                   redirect('examinationresult/marks_details_view',$datas);
			  }else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('examinationresult/marks_details_view',$datas);
			}
		}
		
		public function marks_details_view()
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			
			$datas['marks']=$this->examinationresultmodel->getall_marks_details($user_id);
			//echo '<pre>';print_r($datas['marks']);
			if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/view',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}
			
		}
		
		public function exam_mark_edit_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
				
			  $subid=$this->input->get('var1');
			  
			  $clsmasid=$this->input->get('var2');
			  //echo $subid;echo $clsmasid;
			  $datas['edit']=$this->examinationresultmodel->edit_marks_details($user_id,$subid,$clsmasid);
			 //  echo '<pre>';print_r($datas['edit']);exit;
			if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/edit_mark',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}
			
		}
		
		public function update_marks_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsmastid');
			  $subid=$this->input->post('subid');
			  $sutid=$this->input->post('sutid');
			 // print_r($sutid);exit;
			  $teaid=$this->input->post('teaid');
			  $marks=$this->input->post('marks');
			  //echo $exam_id;echo $subid;print_r($sutid);echo $teaid;print_r($marks);exit;
			  $datas=$this->examinationresultmodel->update_marks_details($teaid,$clsmastid,$exam_id,$subid,$marks,$sutid);
			 // print_r($datas);exit;
			  if($datas['status']="success")
			  {
				$this->session->set_flashdata('msg','Updated Successfully');
                redirect('examinationresult/marks_details_view',$datas);
			   //redirect('add_test');		
			  }else{
				$this->session->set_flashdata('msg','Falid To Updated');
                redirect('examinationresult/marks_details_view',$datas);
			}
		}
		
 }