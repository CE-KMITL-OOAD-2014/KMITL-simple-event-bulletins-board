<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * register Class
 *
 * class for user to register
 *
 */
class register extends CI_Controller 
{
	//default page : show register form
	public function index()
	{
		$data['title'] = "KMITL-BBS : สมัครสมาชิก";
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$data);
		
		$this->load->view('register');
		
		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
	//submit function to add form to db
	public function submit()
	{
		//init model
		$this->load->model('signup');
		$this->load->model('encryption');
		$this->load->database();
		
		//init value
		$this->signup->genKey();
		$this->signup->setForm(
							$this->input->post('username'),
							$this->encryption->encode($this->input->post('password'),$this->signup->getKey()),
							$this->input->post('email')
						);
						
		//save to db
		$this->signup->saveForm(); 
		
		//set cookie
		$user = array(
					'name'   => 'user',
					'value'  => $this->input->post('username'),
					'expire' => '3600',
				);
		$this->input->set_cookie($user);
		
		//send user back to homepage
		header("location:".base_url());
	}
	
	// --------------------------------------------------------------------
	
	//check available username function
	public function tryUsername(){
		$username = $this->input->post('username');
		
		$this->load->model('authen');
		$getDB = $this->authen->isHave($username ,'username');
		
		if($getDB == null){
			echo 'pass';
		}
		else echo 'fail';
	}
	
	// --------------------------------------------------------------------
	
	//check available email function
	public function tryEmail(){
		$email = $this->input->post('email');
		
		$this->load->model('authen');
		$getDB = $this->authen->isHave($email ,'email');
		
		if($getDB == null){
			echo 'pass';
		}
		else echo 'fail';
	}
	
	// --------------------------------------------------------------------
	
}