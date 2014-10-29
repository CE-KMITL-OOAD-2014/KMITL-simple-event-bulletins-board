<?php
class listservice extends CI_model
{
	private $query;
	
	public function __construct(){
		$this->query = "SELECT * FROM event ";
	}
	
	public function setSearchQurey($keyword,$from = 'title',$outOfDate = false){
		if(!$from||$from === '') $from = 'title';
		$this->query = $this->query."WHERE $from LIKE '%$keyword%' ";
		if($outOfDate) $this->query = $this->query."AND duedate >= CURDATE() ";
		
		
	}
	
	public function setSortQuery($type = 'id',$desc = 'DESC'){
		if(!$type||$type === '') $type = 'id';
		if(!$desc||$desc === '') $desc = 'DESC';
		$this->query = $this->query."ORDER BY $type $desc ";
	}
	
	public function getList(){
		$this->load->database();
		$eventlist = $this->db->query($this->query);
		return $eventlist;
	}
}
?>