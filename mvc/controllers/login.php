<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	public function index($error = '')
	{
		$data['title'] = "LOGIN";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->view('loginpanel');
		
		echo $error;
		
		$this->load->view('footer');
	}
			
	public function submit(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model('authen');
		$this->authen->setForm($username,$password);
		
		if($this->authen->loadDB()){
			if($this->authen->isPassMatch()) {
				$user = array(
					'name'   => 'user',
					'value'  => $username,
					'expire' => '3600',
				);
				$this->input->set_cookie($user);
				header("location:".base_url());
			}
			else header("location:".base_url()."index.php/login/index/NOpassword");
		}
		else header("location:".base_url()."index.php/login/index/NOusername");
	}
	
	public function logout(){
		$this->load->helper('cookie');
		$this->input->set_cookie('user','','');
		header("location:".base_url());
	}
}