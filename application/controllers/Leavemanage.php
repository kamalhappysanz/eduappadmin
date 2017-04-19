<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leavemanage extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('leavemodel');
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
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('leavemanage/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function add(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
			 	$leave_type=$this->input->post('leave_type');
				$years=$this->input->post('years');
				$days=$this->input->post('days');
				$weeks=$this->input->post('weeks');
				$leave_date=$this->input->post('leave_date');
				$leave_name=$this->input->post('leave_name');
				$leave_status=$this->input->post('leave_status');
				$datas=$this->leavemodel->create_leave($leave_type,$years,$days,$weeks,$leave_date,$leave_name,$leave_status);
				if($datas['status']=="success"){
					echo "success";
					//$this->session->set_flashdata('msg', 'Added Successfully');
					//redirect('leavemanage/view');
				}else if($datas['status']=="regular already"){
					echo "regular already";
					// $this->session->set_flashdata('msg', 'Regular Leave Already Added to this Date');
					// redirect('leavemanage/home');
				}else if($datas['status']=="special already"){
					echo "special already";
					// $this->session->set_flashdata('msg', 'Special Leave Already Added to this Date');
					// redirect('leavemanage/home');
				}
				else{
					$this->session->set_flashdata('msg', 'Something Went Wrong');
					redirect('leavemanage/home');
				}
			 }
			 else{
					redirect('/');
			 }
		}


		public function view(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['regular']=$this->leavemodel->get_regular();
				$datas['special']=$this->leavemodel->get_special();


			 if($user_type==1){
			 $this->load->view('header');
			 $this->load->view('leavemanage/view',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function edit($id){

				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['res']=$this->leavemodel->get_leave_id($id);

			 if($user_type==1){
			 $this->load->view('header');
			 $this->load->view('leavemanage/edit',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}


		public function specialedit($id){

				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['res']=$this->leavemodel->get_special_leave_id($id);
				//print_r($datas['res']);exit;
			 if($user_type==1){
			 $this->load->view('header');
			 $this->load->view('leavemanage/special_edit',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}


		public function special_update(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1){
			$leave_type=$this->input->post('leave_type');
			$leave_id=$this->input->post('leave_id');
			$leave_mas_id=$this->input->post('leave_mas_id');
			$leave_date=$this->input->post('leave_date');
			$leave_name=$this->input->post('leave_name');
			$leave_status=$this->input->post('leave_status');
			$datas=$this->leavemodel->udate_special_leave($leave_type,$leave_id,$leave_mas_id,$leave_date,$leave_name,$leave_status);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg', 'Updated Successfully');
				redirect('leavemanage/view');
			}else if($datas['status']=="regular already"){
				$this->session->set_flashdata('msg', 'Regular Leave Already Added to this Date');
				redirect('leavemanage/view');
			}
			else{
				$this->session->set_flashdata('msg', 'Something Went Wrong');
				redirect('leavemanage/view');
			}
		 }
		 else{
				redirect('/');
		 }
		}


			public function update_regular(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1){
			 $leave_type=$this->input->post('leave_type');
			 $leave_id=$this->input->post('leave_id');
			 $years=$this->input->post('years');
			 $days=$this->input->post('days');
			$weeks=$this->input->post('weeks');
			$leave_mas_id=$this->input->post('leave_masid');

			$leave_status=$this->input->post('leave_status');

			$datas=$this->leavemodel->udate_regular_leave($leave_type,$leave_id,$leave_mas_id,$years,$days,$weeks,$leave_mas_id,$leave_status);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg', 'Updated  Successfully');
				redirect('leavemanage/view');
			}else{
				$this->session->set_flashdata('msg', 'Something Went Wrong');
				redirect('leavemanage/view');
			}
		 }
		 else{
				redirect('/');
		 }
		}

		public function viewdates($leave_masid){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->leavemodel->get_allregular_leave_id($leave_masid);
			if($user_type==1){
				$this->load->view('header');
				$this->load->view('leavemanage/viewdates',$datas);
				$this->load->view('footer');
			}else{

			}
		}


		public function deletedate(){
			  $leave_date_id=$this->input->post('id');
				$datas=$this->leavemodel->udate_regular_leave($leave_date_id);
		}


















}
