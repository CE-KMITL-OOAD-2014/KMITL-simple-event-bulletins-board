<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function index()
	{
		$data['title'] = "Welcome!!";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		
		$this->load->database();
		$this->load->model('listservice');	
		
		$this->input->set_cookie('search','','');
		$this->listservice->setSearchQurey('','title',true);
		$this->listservice->setSortQuery();
		$listing['eventlist'] = $this->listservice->getList();
		$this->load->view('eventlist' ,$listing);
		
		$this->load->helper('cookie');
		if($this->input->cookie('user') === false) $this->load->view('loginpanel');
		else {
			$cookie['value'] = $this->input->cookie('user');
			$this->load->view('userpanel' ,$cookie);
		}
		$this->load->view('footer');
	}
}