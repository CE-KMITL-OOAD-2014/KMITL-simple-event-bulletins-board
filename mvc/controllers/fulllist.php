<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fulllist extends CI_Controller {
	public function index()
	{
		$data['title'] = "Result";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->model('listservice');
		
		$this->listservice->setSearchQurey($this->input->get('keyword'),$this->input->get('from'));
		$this->listservice->setSortQuery($this->input->get('sort'),$this->input->get('desc'));
		$listing['eventlist'] = $this->listservice->getList();
		$this->load->view('fulleventlist' ,$listing);

		$this->load->view('footer');
		
		$this->input->set_cookie('search',$this->input->get('keyword')."|".$this->input->get('from')."|".$this->input->get('sort')."|".$this->input->get('desc'),'1200');
	}
	
	public function sortby($type){
		$search = explode("|",$this->input->cookie('search'));
		$keyword = $search[0];
		$from = $search[1];
		$sort = $search[2];
		$desc = $search[3];
		
		if($sort !== $type) {
			$sort = $type;
			$desc = 'DESC';
		}
		else{
			if($desc === 'DESC') $desc = 'ASC';
			else $desc = 'DESC';
		}
		
		header("location:".base_url()."index.php/fulllist?keyword=".$keyword."&from=".$from."&sort=".$sort."&desc=".$desc);
	}
}