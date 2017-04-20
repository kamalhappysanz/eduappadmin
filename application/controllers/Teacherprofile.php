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
	public function home()
	{

 // 	$schoolid=$this->input->post('school_id');
	$email=$this->input->post('email');
	$password=md5($this->input->post('password'));
	 $result = $this->login->login($email,$password);
	 $msg=$result['msg'];
	//echo  $msg1=$result['status'];exit;
	 
			if($result['status']=='DA'){
				$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
				$this->session->set_flashdata('msg', ' Account Deactivated');
				 redirect('/');
			}
			if($result['status']=='notRegistered'){
				$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
				$this->session->set_flashdata('msg', 'UserName Invalid');
				 redirect('/');
			}
			$user_type=$this->session->userdata('user_type');
			$user_type1=$result['user_type'];
					if($result['status']=='A'){
						switch($user_type1){
							case '1':
								$user_name=$result['user_name'];$msg=$result['msg'];$name=$result['name'];$user_type=$result['user_type'];$status=$result['status'];$user_id=$result['user_id'];$user_pic=$result['user_pic'];
								$datas= array("user_name"=>$user_name, "msg"=>$msg,"name"=>$name,"user_type"=>$user_type,"status"=>$status,"user_id"=>$user_id,"user_pic"=>$user_pic);
								//$this->session->userdata($user_name);
								$session_data=$this->session->set_userdata($datas);
								$this->load->view('header',$datas);
								$this->load->view('home');
								$this->load->view('footer');
							break;
							case '2':
							$user_name=$result['user_name'];$msg=$result['msg'];$name=$result['name'];$user_type=$result['user_type'];$status=$result['status'];$user_id=$result['user_id'];$user_pic=$result['user_pic'];
							$datas= array("user_name"=>$user_name, "msg"=>$msg,"name"=>$name,"user_type"=>$user_type,"status"=>$status,"user_id"=>$user_id,"user_pic"=>$user_pic);
							$session_data=$this->session->set_userdata($datas);
							$this->load->view('adminteacher/teacher_header',$datas);
							$this->load->view('adminteacher/home');
							$this->load->view('adminteacher/teacher_footer');
							break;
							case '3':
							$user_name=$result['user_name'];$msg=$result['msg'];$name=$result['name'];$user_type=$result['user_type'];$status=$result['status'];$user_id=$result['user_id'];$user_pic=$result['user_pic'];
							$datas= array("user_name"=>$user_name, "msg"=>$msg,"name"=>$name,"user_type"=>$user_type,"status"=>$status,"user_id"=>$user_id,"user_pic"=>$user_pic);
							//print_r($datas); echo "<br>"; echo "Access Granted AS Student";
							$this->load->view('adminstudent/student_header',$datas);
							$this->load->view('adminstudent/home');
							$this->load->view('adminstudent/student_footer');
							break;
							case '4':
							$user_name=$result['user_name'];$msg=$result['msg'];$name=$result['name'];$user_type=$result['user_type'];$status=$result['status'];$user_id=$result['user_id'];$user_pic=$result['user_pic'];
							$datas= array("user_name"=>$user_name, "msg"=>$msg,"name"=>$name,"user_type"=>$user_type,"status"=>$status,"user_id"=>$user_id,"user_pic"=>$user_pic);
							$session_data=$this->session->set_userdata($datas);
							$this->load->view('adminparent/parent_header',$datas);
							$this->load->view('adminparent/home');
							$this->load->view('adminparent/parent_footer');
							break;

						}


	 			}
				elseif($msg=="Password Wrong"){
					$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
					 $this->session->set_flashdata('msg', 'Password Wrong');
						redirect('/');

				}

				else{
					$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
					$this->session->set_flashdata('msg', ' Email invalid');
					 redirect('/');
				}


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
				
						$name=$this->input->post('name');
						$user_pic_old=$this->input->post('user_pic_old');
						$profile = $_FILES["profile"]["name"];
						$userFileName = time().'-'.$profile;
						$uploaddir = 'assets/teacher/profile/';
						$profilepic = $uploaddir.$userFileName;
						move_uploaded_file($_FILES['profile']['tmp_name'], $profilepic);
						if(empty($profile)){
							$userFileName=$user_pic_old;
						}
						$res=$this->login->profileupdate($userFileName,$user_id,$name);
						if($res['status']=="success"){
						 $this->session->set_flashdata('msg', 'Update Successfully');
						 redirect('adminlogin/profilepic');
						}else{
						 $this->session->set_flashdata('msg', 'Failed to update');
						  redirect('adminlogin/profilepic');
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
