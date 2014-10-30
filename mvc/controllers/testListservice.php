<?php
	
	class testListservice extends CI_Controller{
		private $listing;

		public function __construct(){

			parent::__construct();
			$this->load->library('unit_test');
		}

		public function index(){
			
			$this->load->model('listservice');
			$listing['eventlist'] = $this->listservice->getList();
			$this->load->view('fulleventlist',$listing );

		}
		public function testFulllist(){
			/*-----------------------------------------------------------------------------------------------
			TEST CASE 1
			Check output list without parameter
			-----------------------------------------------------------------------------------------------*/
			$this->load->model('listservice');
			//check output type from listservice model
			$listing['eventlist'] = $this->listservice->getList();
			$this->unit->run($listing,'is_array','TC1_is_Array');
			//check output type in each filed
			if ($listing['eventlist'] ->num_rows() > 0)
			{
				foreach ($listing['eventlist'] ->result() as $row)
				{	

					$this->unit->run($row->id,'is_string','TC1_ID_field is_string');
					$this->unit->run($row->title,'is_string','TC1_title_field is_string');
					$this->unit->run($row->author,'is_string','TC1_author_field is_string');
					$this->unit->run($row->postdate,'is_string','TC1_postdate_field is_string');
					$this->unit->run($row->duedate,'is_string','TC1_duedate_field is_string');
					
					//not check all item in list but check first row
					break;
				}
			}

			$this->load->view('fulleventlist',$listing );
			$this->load->view('testReport');
		}
		public function testSearchList(){
			/*-----------------------------------------------------------------------------------------------
			TEST CASE 2
			Check output with search parameter in setSearchQuery().
			Each title include $keyword.
			-----------------------------------------------------------------------------------------------*/
			$keyword = "2014";
			$from = "title";
			$this->load->model('listservice');
			$this->listservice->setSearchQurey($keyword,$from);
			$listing['eventlist'] = $this->listservice->getList();
			if ($listing['eventlist'] ->num_rows() > 0)
				{
					foreach ($listing['eventlist'] ->result() as $row)
					{	
						//Count keyword in title
						$result = substr_count($row->title,$keyword)>0;
					
						$this->unit->run($result,TRUE,'TC2_SearchStr is_string');
					}
				}
			$this->load->view('fulleventlist',$listing );
			$this->load->view('testReport');
		}
		public function testSortList(){
			/*-----------------------------------------------------------------------------------------------
			TEST CASE 3
			Check sorting output with sort parameter in setSortQuery().
			From example order from max to min id;
			-----------------------------------------------------------------------------------------------*/
			$sortby = 'id';
			$sorting = 'DESC';
			$oldrow = 0;//first loop is false
			$newrow = 0;
			$this->load->model('listservice');
			$this->listservice->setSortQuery($sortby,$sorting);
			$listing['eventlist'] = $this->listservice->getList();
			if ($listing['eventlist'] ->num_rows() > 0)
				{
					foreach ($listing['eventlist'] ->result() as $row)
					{	
						//Count keyword in title
						$newrow = $row->id;
						$this->unit->run($newrow < $oldrow,TRUE,'TC3_Sortting_ID_top > Dowm') ; 
						$oldrow = $newrow;

					}
				}

			$this->load->view('fulleventlist',$listing );
			$this->load->view('testReport');
		}
	}
?>