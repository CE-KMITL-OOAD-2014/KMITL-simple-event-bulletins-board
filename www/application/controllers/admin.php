<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * admin Class
 *
 * class for webmaster to manage website
 *
 */
class admin extends CI_Controller 
{
	//default homepage : for webmaster log in
	public function index(){
		//javascript to log in dialog
		//keep it SECRET
		echo 
			'<form id="admin" method="post" action="'.base_url().'index.php/admin/manage">
				<input type="hidden" value="pass" name="vertify">
			</from>
			
			<script language="JavaScript">
			var password;
			var pass1="ooad";
			password=prompt("Enter Password "," ");
			if (password==pass1){
				alert("Welcome,Web Master.");
				document.getElementById("admin").submit();
			}
			else
			{
				window.location="'.base_url().'";
			}
			</script>'
		;
		
	}
	
	// --------------------------------------------------------------------
	
	//manage page : main page for webmaster
	public function manage(){
		
		if($this->input->post('vertify') === 'pass') //if webmaster access from admin/index
			$this->input->set_cookie('user','webmaster','1200'); //set cookie for webmaster user
			
		else if($this->input->cookie('user') !== 'webmaster') //else if user is not webmaster
			header("location:".base_url()); //back to hompage
		
		
		$data['title'] = "KMITL-BBS : Webmaster Manager";
		
		//init all event list
		$this->load->model('eventlist');
		$this->eventlist->initList(true);
		$event['eventlist'] = $this->eventlist->sortList('id','ASC');
		//init all user list
		$this->load->model('adminservice');
		$user['userlist'] = $this->adminservice->getUserList();
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$data);

		$this->load->view('adminviewer1' ,$event);
		
		$this->load->view('adminviewer2' ,$user);
		
	}
	
	// --------------------------------------------------------------------
	
	//delete event function
	public function delevent(){
		//delete selected event
		if($this->input->post('eventdelselect')){
			$this->load->database();
			$this->db->query("DELETE FROM event WHERE id=".$this->input->post('eventdelselect'));
		}
		//back to manage page again 
		header("location:".base_url()."index.php/admin/manage");
	}
	
	// --------------------------------------------------------------------
	
	//delete user function
	public function deluser(){
		//delete selected user
		if($this->input->post('userdelselect')){
			$this->load->database();
			$this->db->query("DELETE FROM user WHERE username='".$this->input->post('userdelselect')."'");
		}
		//back to manage page again 
		header("location:".base_url()."index.php/admin/manage");
	}
}
?>