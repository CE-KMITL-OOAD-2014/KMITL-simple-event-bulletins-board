<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * fulllist Class
 *
 * class for show search and sort list
 *
 */
class fulllist extends CI_Controller 
{
	//default page : show search and sort list
	public function index()
	{
		//init value
		$data['title'] = "KMITL-BBS : ผลลัพธ์การค้นหา";
		
		//init search and sort list
		$this->load->model('eventlist');
		$this->eventlist->initList(true);
		$listing['eventlist'] = $this->eventlist->searchList($this->input->get('keyword'));
		$listing['eventlist'] = $this->eventlist->sortList($this->input->get('sort'),$this->input->get('desc'));
		
		//set cookie for sort again
		$this->input->set_cookie(
			'search',$this->input->get('keyword').
			"|".$this->input->get('from').
			"|".$this->input->get('sort').
			"|".$this->input->get('desc'),'1200'
		);
		
		// -------------- view : show html ----------------//
		$this->load->view('header',$data);
		
		$this->load->view('fulleventlist' ,$listing);

		$this->load->view('footer');		
	}
	
	// --------------------------------------------------------------------
	
	//sort function : to swich mode of sort
	// @param	string (type)name of column in event db
	public function sortby($type)
	{
		//get value from cookie
		$search = explode("|",$this->input->cookie('search'));
		$keyword = $search[0];
		$from = $search[1];
		$sort = $search[2];
		$desc = $search[3];
		
		//new mode if type is not same with old one
		if($sort !== $type) {
			$sort = $type;
			$desc = 'DESC';
		}
		//swich mode if type is same with old one
		else{
			if($desc === 'DESC') $desc = 'ASC';
			else $desc = 'DESC';
		}
		//go to page which show search and sort list
		header("location:".base_url()."index.php/fulllist?keyword=".$keyword."&from=".$from."&sort=".$sort."&desc=".$desc);
	}
	
	// --------------------------------------------------------------------
	
}