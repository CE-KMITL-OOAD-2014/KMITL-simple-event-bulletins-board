<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * show Class
 *
 * class for control eventviewer
 *
 */
class show extends CI_Controller {

	//default page : show page following $id of event in SQL database
	public function index($i)
	{
		//load event from db
		$this->load->model('event');
		$this->event->loadEvent($i);
		//get data to variable
		$event = $this->event->getEvent();
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$event);
		
		$this->load->view('eventviewer' ,$event);
		
		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
}