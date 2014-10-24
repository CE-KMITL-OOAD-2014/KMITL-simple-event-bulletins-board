<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['title'] = "LOGIN";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->view('userpanel');
		
		$this->load->view('footer');
	}
			
	public function submit(){
		
		$data['title'] = "LOGIN RESULT";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->model('authen');
		$this->authen->setForm($this->input->post('username'),$this->input->post('password'));
		
		$this->load->database();
		if($this->authen->loadDB()){
			if($this->authen->isMatch()) echo "SUCCESS";
			else echo "fail2</br>";
		}
		else echo "fail1</br>";
		
		$this->load->view('footer');
	}
}