<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$this->load->view('register_view');
	}

	public function adduser()
	{
		$checkUsername = $this->common_mdl->get_table_by('user',array('username'=>$this->input->post('username')),'id');
		if($checkUsername) {
			echo json_encode(array(
					'status'=>'error',
					'msg'=>'<strong>ERROR!</strong> Username is already registered.'
				));
				exit;
		}

		$checkUseremail = $this->common_mdl->get_table_by('user',array('email'=>$this->input->post('email')),'id');
		if($checkUseremail) {
			echo json_encode(array(
					'status'=>'error',
					'msg'=>'<strong>ERROR!</strong> Email is already registered.'
				));
				exit;
		}


		$imgUpload = $this->common_mdl->singleImageUpload('user_image','jpg',1);

		if($imgUpload['upload'] == True) {
			
			$data_insert = array(
						'username'          => $this->input->post('username'),
						'email'             => $this->input->post('email'),
						'mobileno'          => $this->input->post('mobileno'),
						'address'           => $this->input->post('address'),
						'password'          => md5($this->input->post('password')),
						'image'          	=> $imgUpload['data']['file_name']
			);

			$insertData = $this->common_mdl->insert('user',$data_insert);
			if($insertData) {
				echo json_encode(array(
					'status'=>'success',
					'msg'=>'<strong>SUCCESS!</strong> You are successfully registed.'
				));
				exit;
			} else {
				echo json_encode(array(
					'status'=>'error',
					'msg'=>'<strong>ERROR!</strong> Please try again after sometime.'
				));
				exit;
			}
		} else {
			echo json_encode(array(
				'status'=>'error',
				'msg'=>'<strong>ERROR!</strong> There was problem in image uploading.'
			));
			exit;
		}




	}
}
