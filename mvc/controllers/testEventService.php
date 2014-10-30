<?php
	/**
	* 
	*/
	class testEventService extends CI_Controller
	{
		private $tmp_event;
		function __construct()
		{
			parent::__construct();
			$this->load->library('unit_test');
		}

		public function index(){
			//
			
			$this->load->model('eventservice');
			$id = 6;
			$event = $this->eventservice->loadEvent($id);
			$this->load->view('eventviewer' ,$event);
			
		}
		public function testLoad(){
			$this->load->model('eventservice');
			//set id to load event
			$id = 6;
			$tmp_event = $this->eventservice->loadEvent($id);
			$this->unit->run($tmp_event,'is_array','TC1_type of event');
			foreach ($tmp_event as $field) {
				$this->unit->run($field,'is_string','field is_string');
			}
			$this->load->view('eventviewer' ,$tmp_event);
			$this->load->view('testReport');
		}
		public function testNewEvent(){
			$this->load->model('eventservice');

			//set psudo value to test
			$title = 'Title of event';
			$des = 'description of event to read';
			$image = '0001.jpg';
			$duedate = '14-10-31';

			$tmp_event = $this->eventservice->newEvent($title,$des,$image,$duedate);
			$this->unit->run($tmp_event,'is_array','type is array');

			$this->load->view('eventviewer' ,$tmp_event);
			$this->load->view('testReport');
		}

	}
?>