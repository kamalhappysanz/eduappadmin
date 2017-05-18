<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teachercommunication extends CI_Controller
{
      function __construct()
      {
		  parent::__construct();
		  $this->load->model('teachercommunicationmodel');
		  //$this->load->model('subjectmodel');
		  //$this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');
      }
	  
      public function home()
	 {
	 		 $datas=$this->session->userdata();
  	 		 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['result']=$this->teachercommunicationmodel->getall_details($user_id);
			 //print_r($datas); exit;
			 if($user_type==2){
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/communication/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}
		public function view_circular()
		{
			 $datas=$this->session->userdata();
  	 		 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['circular']=$this->teachercommunicationmodel->getall_circular_details($user_id);
			 //print_r($datas['circular']);exit;
			 if($user_type==2){
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/communication/view',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
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
			 //echo $user_type;exit;
			 $leave_type=$this->input->post('leave_type');
			 $leave_date=$this->input->post('leave_date');
			 $frm_time=$this->input->post('frm_time');
			 $to_time=$this->input->post('to_time');
			 $leave_description=$this->input->post('leave_description');
			 
			 $dateTime = new DateTime($leave_date);
             $formatted_date=date_format($dateTime,'Y-m-d' );

			 $datas=$this->teachercommunicationmodel->create_leave($user_type,$user_id,$leave_type,$formatted_date,$frm_time,$to_time,$leave_description);
			 
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('teachercommunication/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Added');
                redirect('teachercommunication/home',$datas);	  
			  }
			
		}
		
		public function edit($leave_id)
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->teachercommunicationmodel->edit_leave($user_id,$leave_id);
			//print_r($datas['res']);exit;
			 if($user_type==2){
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/communication/edit',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
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
			
			 $leave_type=$this->input->post('leave_type');
			 $leave_date=$this->input->post('leave_date');
			 $frm_time=$this->input->post('frm_time');
			 $to_time=$this->input->post('to_time');
			 $leave_description=$this->input->post('leave_description');
			 $leave_id=$this->input->post('leave_id');
			 
			 $dateTime = new DateTime($leave_date);
             $formatted_date=date_format($dateTime,'Y-m-d' );
			 
			 $datas=$this->teachercommunicationmodel->update_leave($leave_id,$user_type,$user_id,$leave_type,$formatted_date,$frm_time,$to_time,$leave_description);
			 if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Updated Successfully');
                redirect('teachercommunication/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Updated');
                redirect('teachercommunication/home',$datas);	  
			  }
			
		}
		
}