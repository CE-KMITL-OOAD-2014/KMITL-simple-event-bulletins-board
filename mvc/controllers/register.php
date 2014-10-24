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
		$this->load->database();
		
		$this->signup->genKey();
		
		$this->signup->setForm($this->input->post('username'),$this->encryption->encode($this->input->post('password'),$this->signup->getKey()),$this->input->post('email'));
		
		$this->load->database();
		$this->signup->saveForm();
		
		$this->load->view('footer');
	}
}