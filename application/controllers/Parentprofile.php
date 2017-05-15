<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		 $this->load->model('parentprofilemodel');
		 $this->load->model('subjectmodel');
		 $this->load->model('class_manage');
		 $this->load->helper('url');
		 $this->load->library('session');


 }
	public function home()
	{

    }

	public function profile_edit()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 //echo $user_id;exit;
		 $datas['result'] = $this->parentprofilemodel->getuser($user_id);
          // print_r($datas['result']);exit;
		if($user_type==1 || $user_type==2 || $user_type==3 ||$user_type==4 ){
		$this->load->view('adminparent/parent_header',$datas);
		$this->load->view('adminparent/profile_update',$datas);
		$this->load->view('adminparent/parent_footer');
		}
		else{
			 redirect('/');
		}
}

  public function update_parents()
			{
				 $datas=$this->session->userdata();
				 $user_id=$this->session->userdata('user_id');
				 $user_type=$this->session->userdata('user_type');
				 if($user_type==4)
				 {
					$user_id=$this->session->userdata('user_id');
					$parent_id=$this->input->post('parent_id');
					$single=$this->input->post('single');
					$admission_id=$this->input->post('admission_no');
				    $father_name=$this->input->post('father_name');
					$mother_name=$this->input->post('mother_name');
					
					$guardn_name=$this->input->post('guardn_name');
					
					$occupation=$this->input->post('occupation');
					$income=$this->input->post('income');
					$address=$this->input->post('address');
					$email=$this->input->post('email');
					$email1=$this->input->post('email1');
					$home_phone=$this->input->post('home_phone');
				    $office_phone=$this->input->post('office_phone');
					$mobile=$this->input->post('mobile');
					$mobile1=$this->input->post('mobile1');
					
					$father_pic_old=$this->input->post('old_father_pic');
					$mother_pic_old=$this->input->post('old_mother_pic');
					$guardian_pic_old=$this->input->post('old_guardian_pic');
				  
					$father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$admission_id.'-'.$father_pic;
				    $uploaddir = 'assets/admission/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
				
					$mother_pic = $_FILES["mother_pic"]["name"];
					$userFileName1 =$admission_id.'-'.$mother_pic;
					$uploaddir1 = 'assets/admission/parents/';
					$profilepic1 = $uploaddir1.$userFileName1;
					move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					
					$guardn_pic = $_FILES["guardn_pic"]["name"];
					$userFileName2 =$admission_id.'-'.$guardn_pic;
					$uploaddir2 = 'assets/admission/parents/';
					$profilepic2 = $uploaddir2.$userFileName2;
					move_uploaded_file($_FILES['guardn_pic']['tmp_name'], $profilepic2);
					
				if(empty($father_pic))
				{
						$userFileName=$father_pic_old;
				}
				if(empty($mother_pic))
				{
						$userFileName1=$mother_pic_old;
				}
				if(empty($guardn_pic))
{
						$userFileName2=$guardian_pic_old;
				}
				
				$datas=$this->parentprofilemodel->update_parents($user_id,$parent_id,$single,$admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName,$userFileName1,$userFileName2);
				
				//	print_r($datas['status']);exit;
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('parentprofile/profile_edit');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('parentprofile/profile_edit');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('parentprofile/profile_edit');
				}
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


	public function profile()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->teacherprofilemodel->get_teacheruser($user_id);
		 $user_type=$this->session->userdata('user_type');
			// echo $user_type;exit;
			 if($user_type==2){
				$this->load->view('adminteacher/teacher_header',$datas);
		        $this->load->view('adminteacher/resetpassword',$datas);
		        $this->load->view('adminteacher/teacher_footer');
				}
				else{
					 redirect('/');
				}
        }

  public function updateprofile()
  {
	    $datas=$this->session->userdata();
		$user_name=$this->session->userdata('user_name');
		$user_type=$this->session->userdata('user_type');
	 	if($user_type==2)
		{
		 		$user_id=$this->input->post('user_id');
				//echo $user_id;exit;
			
						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));

						 $user_password_old=$this->input->post('user_password_old');

						$res=$this->teacherprofilemodel->updateprofile($user_id,$oldpassword,$newpassword);

						if($res['status']=="success"){
						 $this->session->set_flashdata('msg', 'Update Successfully');
						  redirect('teacherprofile/profile');
							
					      }else{
					 	        $this->session->set_flashdata('msg', 'Failed to update');
								 redirect('teacherprofile/profile');
					          }

	 }
	 else{
			redirect('/');
	 }
  }

	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('/');
	}






}
