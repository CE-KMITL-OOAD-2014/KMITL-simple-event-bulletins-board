<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Homepage Class
 *
 * class for first homepage
 *
 */
class Homepage extends CI_Controller {

	//default page : default homepage
	public function index()
	{
		//init value
		$data['title'] = "KMITL-BBS : ยินดีต้อนรับ";
		$data['error'] = '';
		
		$this->load->helper('cookie');
		$this->input->set_cookie('search','',''); //clear search
		
		//init event list
		$this->load->model('eventlist');	
		$this->eventlist->initList();
		$listing['eventlist'] = $this->eventlist->sortList();
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$data);

		$this->load->view('eventlist' ,$listing); //show event list
		
		if($this->input->cookie('user') === false) //if not log in ; show log in panel
			$this->load->view('loginpanel',$data);
		else {	//else user is already log in ; show user panal
			$cookie['value'] = $this->input->cookie('user');
			$this->load->view('userpanel' ,$cookie);
		}
		
		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
}