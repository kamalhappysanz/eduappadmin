<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classmanage extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('sectionmodel');
			$this->load->model('subjectmodel');
			$this->load->model('classmodel');
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
	 // Class section


	 	public function home(){
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
	 		$datas['sec'] = $this->sectionmodel->getsection();
			$datas['class'] = $this->classmodel->getclass();
			$datas['getall_class']=$this->class_manage->getall_class();
			$datas['subres'] = $this->subjectmodel->getsubject();
			//print_r($datas['getall_class']);exit;
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('classmanage/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function assign(){
			 	$sec_id=$this->input->post('section_name');
				$class_id=$this->input->post('class_name');
				$sub=$this->input->post('subject');
				$subject = implode(',',$sub);
				$data=$this->class_manage->assign($sec_id,$class_id,$subject);
				if($data['status']=="success"){
						$this->session->set_flashdata('msg', 'Successfully Added');
						redirect('classmanage/home');
				}
				elseif($data['status']=="Already Exist"){
					$this->session->set_flashdata('msg', 'Already Added ');
						redirect('classmanage/home');
				}
				else{
					$this->session->set_flashdata('msg', 'Something Went wrong');
						redirect('classmanage/home');
				}

		}

		public function editcs($class_sec_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['res']=$this->class_manage->edit_cs($class_sec_id);
			//echo "<pre>"; print_r($datas['res']);exit;
			$datas['sec'] = $this->sectionmodel->getsection();
			$datas['clas'] = $this->classmodel->getclass();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			$this->load->view('header');
			$this->load->view('classmanage/edit',$datas);
			$this->load->view('footer');
			}
			else{
				 redirect('/');
			}
		}


		public function update_cs(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$sub=$this->input->post('subject');
				$subject = implode(',',$sub);
				$class_sec_id=$this->input->post('class_sec_id');
				$class=$this->input->post('class_name');
				$section=$this->input->post('section_name');
				$datas=$this->class_manage->save_cs($class_sec_id,$class,$section,$subject);
			//	print_r($datas);exit;
				if($datas['status']=="success"){
						$this->session->set_flashdata('msg', 'Successfully Updated');
						redirect('classmanage/home');
				}
				elseif($datas['status']=="alreadySaved"){
					$this->session->set_flashdata('msg', 'Already Saved');
						redirect('classmanage/home');
				}
				else{
					$this->session->set_flashdata('msg', 'Something Went wrong');
						redirect('classmanage/home');
				}
			}
			else{
				 redirect('/');
			}
		}




		public function deletecs($class_sec_id){
			$data=$this->class_manage->delete_cs($class_sec_id);
			if($data['status']=="success"){
				$this->session->set_flashdata('msg', 'Deleted Successfully');
				redirect('classmanage/home');
			}else{
				$this->session->set_flashdata('msg', 'Something Went wrong');
					redirect('classmanage/home');
			}
		}

















}
