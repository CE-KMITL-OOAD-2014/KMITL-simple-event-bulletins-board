<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	public function index(){
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
	
	public function manage(){
		if($this->input->post('vertify') === 'pass') $this->input->set_cookie('user','webmaster','1200');
		else if($this->input->cookie('user') !== 'webmaster') header("location:".base_url());
		
		$data['title'] = "Admin Manager";
		$this->load->view('header',$data);

		$this->load->model('listservice');
		$event['eventlist'] = $this->listservice->getList();
		$this->load->view('adminviewer1' ,$event);
		
		$this->load->model('adminservice');
		$user['userlist'] = $this->adminservice->getUserList();
		$this->load->view('adminviewer2' ,$user);
	}
	
	public function delevent(){
		if($this->input->post('eventdelselect')){
			$this->load->database();
			$this->db->query("DELETE FROM event WHERE id=".$this->input->post('eventdelselect'));
		}
		header("location:".base_url()."index.php/admin/manage");
	}
	
	public function deluser(){
		if($this->input->post('userdelselect')){
			$this->load->database();
			$this->db->query("DELETE FROM user WHERE username='".$this->input->post('userdelselect')."'");
		}
		header("location:".base_url()."index.php/admin/manage");
	}
}
?>