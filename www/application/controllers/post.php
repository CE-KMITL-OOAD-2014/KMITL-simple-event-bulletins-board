<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * post Class
 *
 * class for user to post event
 *
 */
class post extends CI_Controller 
{
	//default page : show post event form
	public function index()
	{
		$data['title'] = "KMITL-BBS : ประกาศข่าวใหม่";
		
		//user must log in before enter this page
		if($this->input->cookie('user') === false) 
			header("location:".base_url()."index.php/login/index/NOcookie"); //send to log in page
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$data);
		
		$this->load->view('posting');
		
		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
	//upload page : show page to get image from user
	public function upload()
	{
		//set session from post form
		$this->load->library('session');
		if($this->input->post('title')){
			$tmp_post = array(
				'title' => $this->input->post('title'),
				'des' => str_replace("\n", "<br>", $this->input->post('des')),
				'duedate' => $this->input->post('duedate'),
				'image' => ''
			);
			$this->session->set_userdata($tmp_post);
		}
		
		//init value
		$this->load->helper(array('form', 'url'));
		$data['title'] = "KMITL-BBS : อัพโหลดโปสเตอร์";
		$data['image'] = $this->session->userdata('image');
		$data['error'] = $this->session->userdata('error');
		
		// -------------- view : show html ----------------//
		
		$this->load->view('header',$data);
		
		$this->load->view('uploading',$data);
		
		$this->load->view('footer');
	}
	
	// --------------------------------------------------------------------
	
	//upload function : get image from upload form
	public function upload2()
	{
		//config keep image path and type
		$config['upload_path'] = '/var/www/html/assert/upload';
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				
		$this->load->library('session');
		$this->load->library('upload', $config);
		
		//try to upload
		if ( ! $this->upload->do_upload()) //if can't upload
		{
			//init value of error to show
			$error = $this->upload->display_errors();
			$this->session->set_userdata('error' ,$error);
			$this->session->set_userdata('image' ,'');
		}
		else //if can upload
		{
			//init valur of image path to show
			$data = $this->upload->data();
			$this->session->set_userdata('error' ,'');
			$this->session->set_userdata('image' ,base_url()."assert/upload/".$data['file_name']); //set session
		}
		//send back to show image or error in upload page
		header("location:".base_url()."index.php/post/upload");
	}
	
	// --------------------------------------------------------------------

	//finish funtion : to complete the upload
	public function finish()
	{
		//init value from session
		$this->load->library('session');
		$post = $this->session->all_userdata();
		
		//build event object and save
		$this->load->model('event');
		$this->event->newEvent($post['title'],$post['des'],$post['image'],$post['duedate']);
		$this->event->saveEvent();
		
		//send back to homepage
		header("location:".base_url());
	}
	
	// --------------------------------------------------------------------
	
}