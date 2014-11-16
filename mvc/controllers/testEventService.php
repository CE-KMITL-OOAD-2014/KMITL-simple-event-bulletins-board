<?php
	/**
	* 
	*/
	class testEventService extends CI_Controller
	{	
			private $id;
			private $title;
			private $desc;
			private $author;
			private $postdate;
			private $duedate;
		//private $tmp_event;

		function __construct()
		{
			parent::__construct();
			$this->load->library('unit_test');
		}

		public function index(){
			//
			//init value from session
			$this->load->library('session');
			$post = $this->session->all_userdata();
			//set psudo value to test
			$title = 'Title of event';
			$desc = 'description of event to read';
			$image = '0001.jpg';
			$duedate = "15-10-31";

			$this->load->model('event');
			$this->event->newEvent($title,$desc,$image,$duedate);
			$this->event->saveEvent();
			
			$result = mysql_query('SELECT * FROM event ORDER BY id DESC LIMIT 1;');
			if (mysql_num_rows($result) > 0) {
			   $last_row= mysql_fetch_row($result);
			   $this->unit->run($last_row[1],$title,"Is title valid?"); 
			   $this->unit->run($last_row[2],$desc,"Is desc valid?");
			   $this->unit->run($last_row[3],$image,"Is image valid?");
			   $this->unit->run($last_row[6],"20".$duedate,"Is duedate valid?");
			}

			$this->load->view('testReport');
		}

	}
?>
