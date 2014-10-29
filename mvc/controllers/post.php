<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	public function index()
	{
		if($this->input->cookie('user') === false) header("location:".base_url()."index.php/login/index/NOcookie");
		
		$data['title'] = "POSTING";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		$this->load->view('posting');
		
		$this->load->view('footer');
	}
	
	public function upload(){
		$this->load->helper(array('form', 'url'));
		
		$data['title'] = "POSTING";
		$this->load->view('header',$data);
		$this->load->view('topmenu');
		
		
		$this->load->view('uploading');
		
		$this->load->view('footer');
		
		
		$this->load->library('session');
		$tmp_post = array(
			'title' => $this->input->post('title'),
			'des' => $this->input->post('des'),
			'due_date' => $this->input->post('due_date')
		);
		$this->session->set_userdata($tmp_post);
	}
	
	public function upload2(){
		$config['upload_path'] = '/var/www/html/assert/upload';
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				
		$this->load->library('session');
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = $this->upload->display_errors();
			$this->session->set_userdata('error' ,$error);
			$this->session->set_userdata('image' ,'');
			header("location:".base_url()."index.php/post/preview/");
		}
		else
		{
			$data = $this->upload->data();
			$this->session->set_userdata('error' ,'');
			$this->session->set_userdata('image' ,base_url()."assert/upload/".$data['file_name']);
			header("location:".base_url()."index.php/post/preview/");
		}
	}
	
	public function preview()
	{
		$this->load->library('session');
		$post = $this->session->all_userdata();
		
		echo $post['error'];
		
		$this->load->model('eventservice');
		$event = $this->eventservice->newEvent($post['title'],$post['des'],$post['image'],$post['due_date']);
		
		$this->load->view('header',$event);
		$this->load->view('topmenu');
		
		echo '<input type="button" value="POST" onclick="window.location.href='."'".base_url()."index.php/post/finish'".'">';
		$this->load->view('eventviewer' ,$event);
		
		$this->load->view('footer');
	}
	
	public function finish()
	{
		$this->load->library('session');
		if($this->session->userdata('image') !== ''){
			//$this->session->set_userdata('image' ,base_url()."assert/upload/".$data['file_name']);
			//rename('/var/www/html/assert/upload/', '/var/www/html/assert/upload/222'.$data['file_name'])
		}
		$post = $this->session->all_userdata();
		
		$this->load->model('eventservice');
		$this->eventservice->newEvent($post['title'],$post['des'],$post['image'],$post['due_date']);
		$this->eventservice->saveEvent();
		//header("location:".base_url());
	}
}