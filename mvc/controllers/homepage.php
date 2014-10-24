<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function index()
	{
		$data['title'] = "Welcome!!";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->database();
		$this->load->model('listservice');	
		$listing['eventlist'] = $this->listservice->getList();
		$this->load->view('eventlist' ,$listing);
		
		$this->load->view('userpanel');
		$this->load->view('footer');
	}
}