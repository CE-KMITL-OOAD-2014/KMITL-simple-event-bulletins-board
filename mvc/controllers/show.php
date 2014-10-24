<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class show extends CI_Controller {

	public function index($i)
	{
		$this->load->model('eventservice');
		$event = $this->eventservice->loadEvent($i);
		
		$this->load->view('header',$event);
		$this->load->view('topmenu');
		$this->load->view('eventviewer' ,$event);
		
		$this->load->view('footer');
	}
}