<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends CI_Controller {
	public function index()
	{

		$data['title'] = "Reigster";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->view('register');
		$this->load->view('footer');
	}
	
	public function submit(){
		$data['title'] = "Reigster Complete";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->model('signup');
		$this->load->model('encryption');
		
		$this->signup->genKey();
		$this->signup->setForm($this->input->post('username'),$this->encryption->encode($this->input->post('password'),$this->signup->getKey()),$this->input->post('email'));
		
		$this->load->database();
		$this->signup->saveForm();
		
		echo 'complete';
		
		$this->load->view('footer');
	}
	
	public function tryUsername(){
		$username = $this->input->post('username');
		
		$this->load->model('authen');
		$getDB = $this->authen->isHave($username ,'username');
		if($getDB == null){
			echo 'pass';
		}
		else echo 'fail';
	}
	
	public function tryEmail(){
		$email = $this->input->post('email');
		
		$this->load->model('authen');
		$getDB = $this->authen->isHave($email ,'email');
		if($getDB == null){
			echo 'pass';
		}
		else echo 'fail';
	}
}