<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$this->load->view('login_view');
	}

	public function do_login()
	{
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			
			$details   = $this->common_mdl->login($_POST['username'],$_POST['password']);
			if($details)
			{
				$this->session->set_userdata('userdata', $details);
				echo json_encode(array(
					'status'=>'success',
					'msg'=>'<strong>SUCCESS!</strong> You are logedin successfully...',
				));
				exit;
			}
			else
			{
				echo json_encode(array(
					'status'=>'error',
					'msg'=>'<strong>ERROR!</strong> Invalid username or password'
				));
			}
			//end
				
            	
			
        }
		else
		{
			echo json_encode(array(
				'status'=>'redirect',
				'msg'=>'redirect'
			));
		}
	}
}
