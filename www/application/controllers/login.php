<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * login Class
 *
 * class for user to log in
 *
 */
class login extends CI_Controller {

	//default page : show log in form
	public function index($error = '')
	{	
		//init value
		$data['title'] = "KMITL-BBS : เข้าสู่ระบบ";
		$data['error'] = $error;
		
		// -------------- view : show html ----------------//
		$this->load->view('header',$data);
		
		$this->load->view('loginpanel',$data);

		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
	//sumbit function : authetication user
	public function submit()
	{
		//get valur from log in form(POST)
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		//init authen object
		$this->load->model('authen');
		$this->authen->setForm($username,$password);
		
		//authetication
		if($this->authen->loadDB()){ //if username correct
			if($this->authen->isPassMatch()) { //if password correct
				//set cookie
				$user = array(
					'name'   => 'user',
					'value'  => $username,
					'expire' => '3600',
				);
				$this->input->set_cookie($user);
				
				header("location:".base_url()); //send user back to homepage
			}
			else header("location:".base_url()."index.php/login/index/NOpassword");//password incorrect; send to log in page again
		}
		else header("location:".base_url()."index.php/login/index/NOusername");//username incorrect; send to log in page again
	}
	
	// --------------------------------------------------------------------
	
	//log out function
	public function logout(){
		$this->load->helper('cookie');
		$this->input->set_cookie('user','',''); //delete cookie
		
		header("location:".base_url()); //send user back to homepage
	}
	
	// --------------------------------------------------------------------
	
}