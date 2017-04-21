<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		 $this->load->model('teacherprofilemodel');
		 $this->load->model('subjectmodel');
		 $this->load->model('class_manage');
		 $this->load->helper('url');
		 $this->load->library('session');


 }


	public function home()
	{

    }



	public function profilepic()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $datas['result'] = $this->teacherprofilemodel->getuser($user_id);
		 $datas['resubject'] = $this->subjectmodel->getsubject();
		 $datas['getall_class']=$this->class_manage->getall_class();
		if($user_type==1 || $user_type==2 || $user_type==3 ||$user_type==4 ){
		$this->load->view('adminteacher/teacher_header',$datas);
		$this->load->view('adminteacher/profile_update',$datas);
		$this->load->view('adminteacher/teacher_footer');
		}
		else{
			 redirect('/');
		}
}

	public function profileupdate(){
			$datas=$this->session->userdata();
			$user_name=$this->session->userdata('user_name');
			$user_type=$this->session->userdata('user_type');
		 	if($user_type==1 || $user_type==2 || $user_type==3 ||$user_type==4 )
			{
				        $user_id=$this->input->post('user_id');
			          	//echo $user_id;exit;
						$teachername=$this->input->post('name');
						$user_pic_old=$this->input->post('user_pic_old');
						
						$sex=$this->input->post('sex');
			            $dob=$this->input->post('dob');
			            $age=$this->input->post('age');
		                $nationality=$this->input->post('nationality');
			            $religion=$this->input->post('religion'); 
                        $mobile=$this->input->post('mobile');
						$community_class=$this->input->post('community_class');
		                $community=$this->input->post('community');
			            $address=$this->input->post('address');
						$email=$this->input->post('email');
						   
				      $student_pic = $_FILES["teacher_pic"]["name"];
				      $userFileName =time().'-'.$student_pic;
				      $uploaddir = 'assets/teacher/profile/';
					  $profilepic = $uploaddir.$userFileName;
					  move_uploaded_file($_FILES['teacher_pic']['tmp_name'], $profilepic);
					  if(empty($student_pic)){
					   $userFileName=$user_pic_old;
				       }
					
						$res=$this->teacherprofilemodel->teacherprofileupdate($user_id,$teachername,$email,$sex,$dob,$age,$nationality,$religion,$mobile,$community_class,$community,$address,$userFileName);
						
						if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Update Successfully');
					 redirect('teacherprofile/profilepic');
				    }else{
					 $this->session->set_flashdata('msg', 'Failed to update');
					  redirect('teacherprofile/profilepic');
				  }
				 
		          
			
		 }
	}




	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('/');
	}






}
