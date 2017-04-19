<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Communication extends CI_Controller
{
      function __construct()
      {
      parent::__construct();
      $this->load->model('Communicationmodel');
      $this->load->model('subjectmodel');
      $this->load->model('class_manage');
      $this->load->helper('url');
      $this->load->library('session');
      }
      public function add_communication()
      {
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('user_id');
      $datas['teacher']=$this->Communicationmodel->get_teachers();
      $datas['getall_class']=$this->class_manage->getall_class();
      $user_type=$this->session->userdata('user_type');
      if($user_type==1)
      {
      $this->load->view('header');
      $this->load->view('communication/add',$datas);
      $this->load->view('footer');
      }
      else{
      redirect('/');
      }
      }
      public function create()
      {
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('user_id');
      $user_type=$this->session->userdata('user_type');
      if($user_type==1)
      {
      $teacher_name=$this->input->post('teacher');
      //$teacher = implode(',',$teacher_name);
      $clas=$this->input->post('class_name');
     // $class_name = implode(',',$clas);
     
      if($teacher_name=='')
		{
			 $teacher ="null";
		}else{
			$teacher = implode(',',$teacher_name);
		}
		if($clas=='')
		{
			 $class_name ="null";
		}else{
			 $class_name = implode(',',$clas);
		}
     
      $title=$this->input->post('title');
      $date=$this->input->post('date');
      $dateTime = new DateTime($date);
      $formatted_date=date_format($dateTime,'Y-m-d' );
      $notes=$this->input->post('notes');
      $datas=$this->Communicationmodel->communication_create($title,$notes,$formatted_date,$teacher,$class_name);
      if($datas['status']=="success")
      {
      $this->session->set_flashdata('msg', 'Added Successfully');
      redirect('communication/view');
      }
      else{
      $this->session->set_flashdata('msg', 'Failed to Add');
      redirect('communication/view');
      }
      }
      }
          public function view()
          {
          $datas=$this->session->userdata();
          $user_id=$this->session->userdata('user_id');
          $datas['result']=$this->Communicationmodel->view();
          $class_id=$this->Communicationmodel->get_class_id($user_id);
          //echo $class_id;
          // exit;
          $cls_id['result']=$this->Communicationmodel->get_class_name($class_id);
          // print_r($cls_id['result']);
          // exit;
          $user_type=$this->session->userdata('user_type');
          if($user_type==1)
          {
          $this->load->view('header');
          $this->load->view('communication/view',$datas);
          $this->load->view('footer');
          }
          else{
          redirect('/');
          }
          }
          public function edit_commu($commu_id)
          {
          $datas=$this->session->userdata();
          $user_id=$this->session->userdata('user_id');
          $datas['teacher']=$this->Communicationmodel->get_teachers();
          $datas['getall_class']=$this->class_manage->getall_class();
          $datas['res']=$this->Communicationmodel->edit_data($commu_id);
          $user_type=$this->session->userdata('user_type');
          if($user_type==1)
          {
          $this->load->view('header');
          $this->load->view('communication/edit',$datas);
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
          $id=$this->input->post('comid');
         // $teacher_name=$this->input->post('teacher');
          //$teacher = implode(',',$teacher_name);
         // $clas=$this->input->post('class_name');
          //$class_name = implode(',',$clas);
           $teacher_name=$this->input->post('teacher');
      //$teacher = implode(',',$teacher_name);
      $clas=$this->input->post('class_name');
     // $class_name = implode(',',$clas);
     
      if($teacher_name=='')
		{
			 $teacher ="null";
		}else{
			$teacher = implode(',',$teacher_name);
		}
		if($clas=='')
		{
			 $class_name ="null";
		}else{
			 $class_name = implode(',',$clas);
		}
     
          $title=$this->input->post('title');

          $date=$this->input->post('date');
          $dateTime = new DateTime($date);
          $formatted_date=date_format($dateTime,'Y-m-d' );

          $notes=$this->input->post('notes');
          $datas=$this->Communicationmodel->communication_update($id,$title,$notes,$formatted_date,$teacher,$class_name);
          if($datas['status']=="success")
          {
          $this->session->set_flashdata('msg','Updated Successfully');
          redirect('communication/view');
          }
          else{
          $this->session->set_flashdata('msg','Failed To Updated');
          redirect('communication/view');
          }
          }
          }
}
