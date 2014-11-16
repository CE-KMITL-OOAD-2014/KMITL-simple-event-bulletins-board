<?php
/**
 * eventlist Class
 *
 * class for eventlist object
 *
 */
class eventlist extends CI_model
{
	private $eventlist = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * initailize $eventlist
	 *
	 * set the $eventlist attr to a new all event list from database
	 * @param boolean mode of function
	 *					true : include out of date event
	 *					(default) false : exclude out of date event
	 *
	 */
	public function initList($outOfDate = false){
		//load all list from db
		$query = "SELECT * FROM event ";
		$this->load->database();
		$eventlist = $this->db->query($query);
		//convert list to array
		$newList = array();
		if ($eventlist->num_rows() > 0){		
			//mode true : include out of date event
			if($outOfDate) 
				foreach ($eventlist->result() as $row) 
					array_push($newList, $row);
			//mode false : exclude out of date event
			else{
				foreach ($eventlist->result() as $row){
					//build event object
					$this->load->model('event');
					$this->event->loadEvent($row->id);
					
					if($this->event->isExpire()); //if expire , not insert to array
					else //else insert to array
						array_push($newList, $row); 
				}
			}
		}
		//set array to attr
		$this->eventlist = $newList;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * get List of event
	 *
	 * @return	array of List
	 */
	public function getList(){
		if(count($this->eventlist) === 0) 
			$this->initList(); //if List is null, init it
		return $this->eventlist;		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * search in attr array of List compare with keyword
	 *
	 * @return	complete search array of List
	 */
	public function searchList($keyword = ''){	
		if(count($this->eventlist) === 0) initList(); //if List is null, init it
		if(!$keyword) $keyword = '';
		//start search
		$newList = array();
		foreach ($this->eventlist as $row){
			//build event object
			$this->load->model('event');
			$this->event->loadEvent($row->id);
			//compare with keyword
			if($this->event->isHave($keyword)) 
				array_push($newList, $row);
		}
		//set array to attr and return
		$this->eventlist = $newList;
		return $this->eventlist;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * sort in attr array of List compare with keyword
	 *
	 * @param string (type) name of database column
	 * @param string (desc) how to sort
	 *					ASC : ascending
	 *					(default) DESC : descending
	 * @return	complete sort array of List
	 */
	public function sortList($type = 'id',$desc = 'DESC'){
		if(!$type||$type === '') $type = 'id';
		if(!$desc||$desc === '') $desc = 'DESC';
		
		$length=count($this->eventlist);
		//ASC mode with Insertion sort
		if($desc === 'ASC'){
			for($i = 1; $i<$length;$i++){
				$element=$this->eventlist[$i];
				$j=$i;
				while($j>0 && $this->eventlist[$j-1]->$type > $element->$type  ) {
					//switch
					$this->eventlist[$j] = $this->eventlist[$j-1];
					$j=$j-1;
				}
				$this->eventlist[$j]=$element;
			}
		}
		//DESC mode with Insertion sort
		else{
			for($i = 1; $i<$length;$i++){
				$element=$this->eventlist[$i];
				$j=$i;
				while($j>0 && $this->eventlist[$j-1]->$type < $element->$type  ) {
					//switch
					$this->eventlist[$j] = $this->eventlist[$j-1];
					$j=$j-1;
				}
            $this->eventlist[$j]=$element;
			}
		}
		//return array of List
		return $this->eventlist;
	}
	
	// --------------------------------------------------------------------
	
}
?>